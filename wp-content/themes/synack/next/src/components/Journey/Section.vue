<template>
    <section
        :class="[
            'journey-section',
            { 'is-landing': $store.state.journey.showLanding },
            { 'is-report': $store.state.journey.showReport }
        ]"
    >
        <shared-light-dots />

        <!-- This will slide up over the background when starting the game -->
        <div class="dark-background" />

        <!-- Landing section -->
        <div
            class="landing-content"
            key="landing"
            v-if="$store.state.journey.showLanding"
        >
            <img
                src="wp-content/themes/synack/next/static/images/header-badge.png"
                alt="A decorative graphic resembling two crossed blue swords."
                class="header-badge"
            />
            <wp-content :html="cmpLandingContent" />
            <journey-accented-button @button-clicked="transitionToGame">
                <svg-icon-play />
                <span>Begin Simulation</span>
            </journey-accented-button>
        </div>

        <!-- Game section -->
        <journey-game key="game" @patch-done="findVuln" v-else />

        <!-- Map (present in both landing and game) -->
        <journey-map-wrapper />
    </section>
</template>

<script>
import _sample from 'lodash/sample'
import transitionToGame from './animation/to-map'

// starting index for vulns
let vulnIndex = Math.floor(Math.random() * 700)

// journey data
const journey = pageData.options

// timeouts
let timeouts = []

export default {
    data() {
        return {
            fullPool: journey.surfaces,
            srtNames: journey.srt_names.split('<br />'),
            landingContent: journey.landing_content
        }
    },
    computed: {
        cmpLandingContent() {
            return this.landingContent
        },
        vulnPool() {
            return this.fullPool.find(
                x => x.surface == this.$store.state.journey.currentSurface
            ).vulns
        }
    },
    methods: {
        transitionToGame,
        findVuln() {
            // only add a vuln if we're not paused and have less than 4 in the queue
            if (
                !this.$store.state.journey.paused &&
                this.$store.state.journey.vulns.length -
                    this.$store.state.journey.appliedPatches.length <
                    4
            ) {
                // cancel if we're done playing
                if (
                    !this.$store.state.journey.currentSurface ||
                    this.$store.state.journey.showReport
                )
                    return

                const index = vulnIndex++
                const vuln = { index, ..._sample(this.vulnPool) }

                // add vuln to queue
                this.$store.commit('FIND_VULN', vuln)

                // notify user
                const isHydra = Math.random() > 0.5

                // Hydra found then verified by SRT
                if (isHydra) {
                    this.$store.commit('ADD_FEED_ITEM', {
                        content: `Vulnerability located [#${vuln.index} ${
                            vuln.name
                        }]`,
                        speaker: 'Hydra'
                    })

                    setTimeout(() => {
                        this.$store.commit('ADD_FEED_ITEM', {
                            content: `Confirmed [#${vuln.index} ${vuln.name}] `,
                            speaker: 'SRT'
                        })
                    }, 1000)
                    setTimeout(() => {
                        this.$store.commit('ADD_FEED_ITEM', {
                            content: `Confirmed [#${vuln.index} ${vuln.name}] `,
                            speaker: 'Synack'
                        })
                    }, 1800)
                }

                // Found by SRT initially
                else {
                    this.$store.commit('ADD_FEED_ITEM', {
                        content: `Vulnerability located [#${vuln.index} ${
                            vuln.name
                        }]`,
                        speaker: 'SRT'
                    })

                    setTimeout(() => {
                        this.$store.commit('ADD_FEED_ITEM', {
                            content: `Confirmed [#${vuln.index} ${vuln.name}] `,
                            speaker: 'Synack'
                        })
                    }, 1300)
                }

                // SRT accepts in a moment
                timeouts.push(
                    setTimeout(
                        () => this.acceptVuln(vuln),
                        Math.random() * 4000 + 4000
                    )
                )
            } else {
                // Find a new vuln in a moment
                if (this.$store.state.journey.currentSurface) {
                    timeouts.push(
                        setTimeout(this.findVuln, Math.random() * 8000)
                    )
                }
            }
        },
        acceptVuln(vuln) {
            // cancel if we're done playing
            if (
                !this.$store.state.journey.currentSurface ||
                this.$store.state.journey.showReport
            )
                this.$store.commit('ADD_SRT_ITEM', {
                    content: `Vuln. #${vuln.index} targeted.`
                })

            // Find and suggest patch suggest in a moment
            timeouts.push(setTimeout(() => this.patchReady(vuln), 4000))
        },
        patchReady(vuln) {
            // cancel if we're done playing
            if (
                !this.$store.state.journey.currentSurface ||
                this.$store.state.journey.showReport
            )
                this.$store.commit('ADD_SYNACK_ITEM', {
                    content: `Incoming patch...`,
                    className: 'positive'
                })

            this.$store.commit('SET_PATCH_TO_REVIEW', {
                author: _sample(this.srtNames),
                content: vuln.patch_content,
                vuln
            })
        }
    },
    watch: {
        '$store.state.journey.currentSurface'(newVal) {
            // cancel if no new surface
            if (!newVal) {
                return
            }

            // set ARS to starting value
            this.$store.commit('SET_ARS_SCORE', 100)

            // find a new vulnerability in 7 seconds after currentSurface changes
            timeouts.push(setTimeout(this.findVuln, 5000))
        },
        '$store.state.journey.showReport'(newVal) {
            // clear all valid timeouts when switching to or from report
            timeouts.filter(t => t).forEach(t => clearTimeout(t))
            timeouts = []
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

$paragraph-blue: #3e4d66;
$blue: #106bff;
$game-background: #001e3e;
$gradient-bottom: #eef5ff;
$gradient-top: #fff;

.journey-section {
    position: relative;
    transition: background 0.4s 1.1s;
    background: linear-gradient(to top, $gradient-bottom, $gradient-top);
    overflow: hidden;
    height: 60vw;
    max-height: 1080px;
    min-height: 750px;

    .dotted {
        opacity: 0.8;
    }
    .dark-background {
        @include fill;
        background: $game-background;
        opacity: 0;
        // transform: translateY(100%);
    }
    &:not(.is-landing) .dark-background {
        opacity: 1;
    }

    .landing-content {
        margin: 0 auto 0;
        max-width: 740px;
        padding: 60px 40px 0;
        text-align: center;
        position: relative;
        z-index: 5;

        .header-badge {
            margin: 0 auto 10px;
            display: block;
            width: 100px;
            height: auto;
        }
        .wp-content {
            h2 {
                font-size: 60px;
                line-height: 1.1;
                margin: 0 auto 20px;
            }
            p {
                color: $paragraph-blue;
                line-height: 1.5;
                margin-top: 0;
                font-size: 20px;
            }
        }
        .journey-accented-button {
            margin-top: 20px;
        }
    }

    // Map
    .journey-map-wrapper {
        position: absolute;
        right: 0;
        bottom: 0;
        left: 0;

        transition: transform 1.3s;
    }

    // Report state
    &.is-report {
        .journey-map-wrapper {
            transform: translateY(40vh);
        }
    }
}
</style>
