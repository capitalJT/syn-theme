import _clamp from 'lodash/clamp'

export default {
    state: {
        // are we showing the landing page?
        showLanding: true,
        hoveringSurface: '',
        // current attack surface - blank if none
        currentSurface: '',
        // score to display to user
        score: {
            ars: 0
        },
        // items to show in event feed
        feed: [],
        // are we showing the current report?
        showReport: false,
        // queues
        vulns: [],
        patchQueue: [],

        // applied patches
        appliedPatches: [],

        // patch status
        patchAuthor: '',
        patchContent: '',

        paused: false
    },
    mutations: {
        START_JOURNEY: state => {
            state.showLanding = false
        },
        TOGGLE_REPORT: state => {
            state.showReport = !state.showReport

            // patch queue will always be cleared when changing this state
            state.patchQueue = []
        },
        RESET_JOURNEY: state => {
            state.hoveringSurface = ''
            state.currentSurface = ''
            state.score.ars = 0
            state.feed = [
                {
                    className: 'normal',
                    speaker: 'Synack',
                    content: 'System ready to start...'
                }
            ]
            state.showReport = false
            state.vulns = []
            state.patchQueue = []
            state.appliedPatches = []
        },
        SET_CURRENT_SURFACE: (state, { surface }) => {
            state.currentSurface = surface
        },
        ADD_FEED_ITEM: (state, { className, speaker, content }) => {
            const toPush = {
                className: className || 'normal',
                speaker: speaker || 'Hydra',
                content: content || ''
            }
            state.feed.push(toPush)

            while (state.feed.length > 3) {
                state.feed.shift()
            }
        },
        ADD_HYDRA_ITEM: (state, { content }) => {
            state.feed.push({
                className: 'normal',
                speaker: 'Hydra',
                content
            })

            while (state.feed.length > 3) {
                state.feed.shift()
            }
        },
        ADD_SRT_ITEM: (state, { content }) => {
            state.feed.push({
                className: 'negative',
                speaker: 'SRT',
                content
            })

            while (state.feed.length > 3) {
                state.feed.shift()
            }
        },
        ADD_SYNACK_ITEM: (state, { content, className }) => {
            state.feed.push({
                className: className || 'normal',
                speaker: 'Synack',
                content
            })

            while (state.feed.length > 3) {
                state.feed.shift()
            }
        },
        TOGGLE_JOURNEY_REPORT: state => {
            state.showReport = !state.showReport
        },
        FIND_VULN: (state, vuln) => {
            state.score.ars -= vuln.point_value
            state.score.ars = _clamp(state.score.ars, 0, 100)
            state.vulns.push(vuln)
        },
        CLEAR_JOURNEY_HOVER: state => {
            state.hoveringSurface = ''
        },
        SET_JOURNEY_HOVER: (state, { surface }) => {
            state.hoveringSurface = surface
        },

        // patches
        SET_PATCH_TO_REVIEW: (state, { author, content, vuln }) => {
            state.patchQueue.push({
                author,
                content,
                vuln
            })
        },
        RESET_CURRENT_PATCH: state => {
            state.patchAuthor = ''
            state.patchContent = ''

            // remove first item
            state.patchQueue.shift()
        },
        ADD_PATCH: state => {
            // assuming we're applying the first patch in the queue
            const patch = state.patchQueue[0]
            state.appliedPatches.push(patch)

            // recalculate ars
            state.score.ars += parseInt(patch.vuln.point_value)
            state.score.ars = Math.min(100, state.score.ars)

            // remove the first patch from the queue
            // state.patchQueue.shift()
        },

        SET_ARS_SCORE: (state, value) => {
            state.score.ars = value
        },
        PAUSE_ANIMATION: state => {
            state.paused = true
        },
        RESUME_ANIMATION: state => {
            state.paused = false
        }
    },
    getters: {
        hoverMobile: state => {
            return state.hoveringSurface == 'mobile'
        },
        hoverApi: state => {
            return state.hoveringSurface == 'host'
        },
        hoverWeb: state => {
            return state.hoveringSurface == 'web'
        }
    }
}
