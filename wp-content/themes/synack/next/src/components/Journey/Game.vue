<template>
    <div class="journey-game">
        <div class="primary-content">
            <!-- Content -->
            <div>
                <transition name="fade" mode="out-in">
                    <wp-content
                        :html="cmpContent.content"
                        :key="cmpContent.key"
                    />
                </transition>
            </div>

            <!-- Generate Report or Reset Button -->
            <transition name="fade" appear>
                <journey-accented-button
                    @button-clicked="
                        $store.state.journey.showReport
                            ? $store.commit('RESET_JOURNEY')
                            : $store.commit('TOGGLE_REPORT')
                    "
                    :class="[
                        'special-action',
                        { 'show-replay': $store.state.journey.showReport }
                    ]"
                    v-if="$store.state.journey.appliedPatches.length"
                >
                    <span v-if="$store.state.journey.showReport" key="replay">
                        <journey-svg-arrow-replay />
                        <span>Replay</span>
                    </span>
                    <span v-else key="generate">Generate Report</span>
                </journey-accented-button>
            </transition>
        </div>

        <!-- Feed -->
        <transition name="fade" mode="out-in" appear>
            <div
                class="legend-and-feed"
                v-if="!$store.state.journey.showReport"
                key="legend-and-feed"
            >
                <journey-legend />
                <journey-feed
                    key="feed"
                    v-if="!$store.state.journey.showReport"
                />
            </div>

            <!-- Report -->
            <journey-report key="report" v-else />
        </transition>

        <!-- Hover tooltip -->
        <transition name="fade">
            <journey-hover-ui
                :title="cmpTooltipTitle"
                :content="cmpTooltipContent"
                :target="hovering"
                :mouseDown="mouseDown"
                @surfaceSelected="surfaceSelected"
                v-if="hovering && !$store.state.journey.currentSurface"
            />
        </transition>

        <!-- Patch verification -->
        <transition name="fade">
            <journey-patch-verification
                :target="active"
                v-if="cmpShowPatchVerification"
                @patch-done="$emit('patch-done')"
            />
        </transition>
    </div>
</template>

<script>
import Vue from 'vue'

const journey = pageData.options

export default {
    data() {
        return {
            hovering: null,
            active: null,
            mouseDown: false,
            showReport: false
        }
    },
    async mounted() {
        await Vue.nextTick()

        const links = [...document.querySelectorAll('a[data-map-link]')]

        // prep links
        links.forEach(link => {
            // hover to set currently hovering
            ;['mouseenter', 'focus'].forEach(e =>
                link.addEventListener(e, evt => {
                    this.hovering = evt.target
                })
            )

            // blur to cancel currently hovering
            ;['mouseleave', 'blur'].forEach(e =>
                link.addEventListener(e, evt => {
                    this.hovering = null
                    this.mouseDown = false
                })
            )

            // click to set currently hovering
            ;['mousedown', 'touchstart'].forEach(e =>
                link.addEventListener(e, evt => {
                    this.mouseDown = true
                })
            )

            // click to set currently hovering
            ;['mouseup', 'touchend'].forEach(e =>
                link.addEventListener(e, evt => {
                    this.mouseDown = false
                })
            )
        })

        // send start message
        this.$store.commit('ADD_SYNACK_ITEM', {
            content: 'System ready to start...'
        })
    },
    computed: {
        cmpContent() {
            const content = {
                scoping: {
                    key: 'scoping',
                    content: journey.scoping_content
                },
                deployment: {
                    key: 'deployment',
                    content: journey.deployment_content
                },
                patch: {
                    key: 'patch',
                    content: journey.patch_verification
                },
                report: {
                    key: 'report',
                    content: journey.reporting_content
                }
            }

            let key = 'scoping'

            if (this.$store.state.journey.currentSurface) {
                key = 'deployment'
            }
            if (
                this.$store.state.journey.appliedPatches.length ||
                this.$store.state.journey.patchQueue.length
            ) {
                key = 'patch'
            }
            if (this.$store.state.journey.showReport) {
                key = 'report'
            }

            return content[key]
        },
        cmpTooltipTitle() {
            switch (this.$store.state.journey.hoveringSurface) {
                case 'web':
                    return 'Web App Asset'
                case 'mobile':
                    return 'Mobile App Asset'
                default:
                    return 'Host Asset'
            }
        },
        cmpTooltipContent() {
            return 'Click to test this attack surface.'
        },
        patchReady() {
            return this.$store.state.journey.patchQueue.length
        },
        cmpShowReportButton() {
            // TODO: update
            return true
        },
        cmpShowPatchVerification() {
            return this.active && this.patchReady
        }
    },
    methods: {
        surfaceSelected() {
            this.active = this.hovering
            let surface = this.hovering
                .getAttribute('xlink:href')
                .replace('#', '')
            this.$store.commit('SET_CURRENT_SURFACE', { surface })

            const casedSurface =
                surface.charAt(0).toUpperCase() + surface.slice(1)
            this.$store.commit('ADD_HYDRA_ITEM', {
                content: casedSurface + ' attack surface selected.'
            })
        }
    },
    watch: {
        hovering(newVal) {
            if (newVal == null) {
                this.$store.commit('CLEAR_JOURNEY_HOVER')
                return
            }

            const surface = newVal.getAttribute('xlink:href').replace('#', '')
            this.$store.commit('SET_JOURNEY_HOVER', { surface })
        },
        cmpShowPatchVerification(newVal) {
            if (newVal) {
                this.$store.commit('PAUSE_ANIMATION')
            } else {
                this.$store.commit('RESUME_ANIMATION')
            }
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';
$background: #001e3e;
$subtitle: #13f7e2;
$paragraph: #8695ae;

.journey-game {
    @include fill;
    z-index: 10;
    padding: 75px 30px 0;
    display: grid;
    grid-template-columns: [content] 1fr [legend] 1fr [feed] 1fr;
    grid-column-gap: 20px;
    grid-auto-flow: dense;
    height: 30vh;
    transition: height 1.3s;
    pointer-events: none;

    & > * {
        &:nth-child(2):not(.fade-leave-active):not(.journey-hover-ui) {
            transition-delay: 0.5s;
        }
        &:nth-child(3):not(.fade-leave-active):not(.journey-hover-ui) {
            transition-delay: 0.6s;
        }
    }

    // Content
    .primary-content {
        height: 100%;
        overflow-x: visible;

        h2 {
            color: $white;
            font-size: 32px;
            font-weight: 400;
            margin-top: 0;
            margin-bottom: 10px;
        }
        h3 {
            color: $subtitle;
            font-size: 18px;
            font-weight: 400;
            margin-top: 0;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
            color: $paragraph;
        }
    }

    .special-action {
        margin-top: 20px;
        margin-left: 5px;
        grid-column: content;
        pointer-events: all;

        .central-button {
            transition: background 0.4s;

            .journey-svg-arrow-replay {
                position: relative;
                top: 2px;
                margin-right: 10px;
            }
        }
        &.show-replay {
            width: 210px;

            .decoration {
                border: 2px solid rgba($white, 0.2);
            }
            .central-button {
                width: 100%;
                background: rgba($blue, 0);
                border: 2px solid rgba(#4d6178, 1);
                padding: 15px 30px;
            }
        }
    }

    .legend-and-feed {
        grid-column: legend / -1;
        display: flex;
        justify-content: space-between;

        & > * {
            width: calc(50% - 10px);
        }
    }

    // Feed
    .journey-feed {
        height: 100%;
        overflow-y: auto;
        grid-column: 3 / span 1;
    }

    // Report
    .is-report & {
        height: 60vh;
    }

    @media #{ $lt-phone } {
        pointer-events: none;
    }
}
</style>
