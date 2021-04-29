import browser from './browser'
import journey from './journey'
import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        browser,
        journey
    },
    state: {
        pageData,
        activeTeamBlock: 0,

        // info-box for globe
        showInfoBox: false,
        infoBoxX: 0,
        infoBoxY: 0,
        infoBoxTitle: '',
        infoBoxContent: '',

        // tooltip for show-all
        showTooltip: false,
        tooltipAlignment: false,
        tooltipX: 0,
        tooltipY: 0,
        tooltipContent: '',
        tooltipStamp: null,

        // index for product grid mobile
        productGridMobileIndex: 0,

        // search
        searchTerm: '',
        searchCategory: ''
    },
    mutations: {
        SET_ACTIVE_TEAM_BLOCK: (state, idx) => {
            state.activeTeamBlock = idx
        },
        REMOVE_ACTIVE_TEAM_BLOCK: state => {
            state.activeTeamBlock = -1
        },
        UPDATE_INFO_BOX: (state, { show, x, y, title, content }) => {
            state.showInfoBox = show
            state.infoBoxX = x
            state.infoBoxY = y
            state.infoBoxTitle = title
            state.infoBoxContent = content
        },
        SET_ACTIVE_TOOLTIP: (state, { x, y, content, alignment }) => {
            state.showTooltip = true
            state.tooltipX = x
            state.tooltipY = y
            state.tooltipContent = content
            state.tooltipAlignment = alignment || false
            state.tooltipStamp = new Date().getTime()
        },
        REMOVE_ACTIVE_TOOLTIP: state => {
            state.showTooltip = false
            state.tooltipStamp = null
        },
        SET_SEARCH_TERM: (state, term) => {
            state.searchTerm = term
        },
        SET_SEARCH_CATEGORY: (state, cat) => {
            state.searchCategory = cat
        },
        SET_PRODUCT_GRID_MOBILE_INDEX: (state, index) => {
            state.productGridMobileIndex = index
        }
    },
    actions: {}
})
