<template>
    <div class="journey-map-wrapper">
        <svg
            class="map-svg"
            xmlns="http://www.w3.org/2000/svg"
            :width="cmpWidth"
            :height="cmpHeight"
            viewBox="-100 -50 1042 423"
            version="1.1"
        >
            <journey-svg-defs />

            <!-- Main map -->
            <g class="map-wrap">
                <!-- transform="translate(-175, -70)" -->
                <journey-svg-map />
            </g>

            <!-- Hydra scan line -->
            <transition name="fade">
                <journey-svg-hydra v-if="$store.state.journey.currentSurface" />
            </transition>

            <!-- SRT members -->
            <journey-svg-paths />

            <transition name="fade">
                <g v-if="!$store.state.journey.showLanding">
                    <!-- Mobile attack surface -->
                    <g transform="translate(111, 170)">
                        <journey-svg-surface-accent
                            :class="[{ accent: $store.getters.hoverMobile }]"
                        />
                    </g>
                    <g transform="translate(150, 170) scale(0.4)">
                        <g class="intro-wrap mobile">
                            <journey-svg-mobile
                                :style="{
                                    opacity:
                                        $store.state.journey.currentSurface !=
                                        'mobile'
                                            ? 1
                                            : 0
                                }"
                            />
                            <journey-svg-surface-mobile-active
                                v-show="
                                    $store.state.journey.currentSurface ==
                                        'mobile'
                                "
                            />
                        </g>
                    </g>

                    <!-- API attack surface -->
                    <g transform="translate(361, 298)">
                        <journey-svg-surface-accent
                            :class="[{ accent: $store.getters.hoverApi }]"
                        />
                    </g>
                    <g transform="translate(400, 298) scale(0.4)">
                        <g class="intro-wrap api">
                            <journey-svg-api
                                :style="{
                                    opacity:
                                        $store.state.journey.currentSurface !=
                                        'host'
                                            ? 1
                                            : 0
                                }"
                            />
                            <journey-svg-surface-api-active
                                v-show="
                                    $store.state.journey.currentSurface ==
                                        'host'
                                "
                            />
                        </g>
                    </g>

                    <!-- Web attack surface -->
                    <g transform="translate(492, 120)">
                        <journey-svg-surface-accent
                            :class="[{ accent: $store.getters.hoverWeb }]"
                        />
                    </g>
                    <g transform="translate(531, 120) scale(0.4)">
                        <g class="intro-wrap web">
                            <journey-svg-web
                                :style="{
                                    opacity:
                                        $store.state.journey.currentSurface !=
                                        'web'
                                            ? 1
                                            : 0
                                }"
                            />
                            <journey-svg-surface-web-active
                                v-show="
                                    $store.state.journey.currentSurface == 'web'
                                "
                            />
                        </g>
                    </g>
                </g>
            </transition>
        </svg>
    </div>
</template>

<script>
import rect from '../../libs/rect'
import { tween } from 'popmotion'

export default {
    mixins: [rect],
    data() {
        return {}
    },
    computed: {
        cmpWidth() {
            return this.clientRect ? this.clientRect.width : 0
        },
        cmpHeight() {
            return this.clientRect ? this.clientRect.height : 0
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

.journey-map-wrapper {
    @include fill;

    a {
        outline: none;
    }
    .map-svg {
        position: absolute;
        top: 0;
        bottom: 0;
        margin: auto;
        // transform-origin: bottom center;
        transition: transform 0.4s;

        .is-landing & {
            // transform: scale(0.8);
        }
    }
    .map-wrap {
        transform-origin: 421px 186px;
        transition: transform 1s;
    }
    .is-landing & .map-wrap {
        transform: scale(0.4) translateY(100px);
    }
    .journey-svg-api,
    .journey-svg-web,
    .journey-svg-mobile {
        &.no-hover {
            pointer-events: none;
        }
    }
    .intro-wrap {
        opacity: 0;
        transform: none !important;

        &.mobile {
            animation: easy-fade 0.6s 0.7s 1 forwards;
        }
        &.api {
            animation: easy-fade 0.6s 0.8s 1 forwards;
        }
        &.web {
            animation: easy-fade 0.6s 0.9s 1 forwards;
        }
    }
}
</style>
