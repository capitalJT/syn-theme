<template>
    <button :class="['products-solution-indicator', { active }]">
        <div class="circle" :style="circleStyle" />
        <div class="step-label">{{ name }}</div>
        <transition name="arrow">
            <span v-show="active" class="down-caret">
                <svg
                    width="14px"
                    height="7px"
                    viewBox="0 0 14 7"
                    version="1.1"
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                >
                    <g
                        transform="translate(-1259.000000, -444.000000)"
                        fill="#8695AE"
                    >
                        <g transform="translate(230.000000, 120.000000)">
                            <g transform="translate(0.000000, 234.000000)">
                                <g transform="translate(0.000000, 82.000000)">
                                    <polyline
                                        fill="#8695AE"
                                        transform="translate(1036.000000, 8.000000) rotate(-45.000000) translate(-1036.000000, -8.000000) "
                                        points="1041 13 1031 13 1031 3"
                                    ></polyline>
                                </g>
                            </g>
                        </g>
                    </g>
                </svg>
            </span>
        </transition>
    </button>
</template>

<script>
import _kebabCase from 'lodash/kebabCase'

export default {
    props: {
        step: {
            type: Object,
            required: true
        },
        active: {
            type: Boolean,
            default: false
        }
    },
    computed: {
        name() {
            return _get(this, 'step.name')
        },
        slug() {
            return _kebabCase(this.name)
        },
        iconUrl() {
            return `/wp-content/themes/synack/next/static/images/solutions-icon/${
                this.slug
            }.png`
        },
        color() {
            return _get(this, 'step.color')
        },
        circleStyle() {
            return {
                'background-image': `url(${this.iconUrl})`
            }
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/easings';
@import 'src/styles/vars';

$inactive-text: #8695ae;
$active-text: #535f75;

.products-solution-indicator {
    position: relative;
    text-align: center;

    .circle {
        transition: filter 350ms;
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
        filter: grayscale(100%);
        border-radius: 100%;
        margin: 0 auto;
        margin-bottom: 15px;
        height: 32px;
        width: 32px;
    }
    .not-mobile &:not(.active):hover .circle,
    .not-mobile &:not(.active):focus .circle {
        filter: grayscale(75%);
    }
    &.active .circle {
        filter: grayscale(0%);
    }
    .step-label {
        transition: color 350ms;
        font-family: $font-display;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: 500;
        font-size: 14px;
        color: $inactive-text;
    }
    .down-caret {
        position: absolute;
        margin-left: -7px;
        display: block;
        bottom: -37px;
        font-size: 0;
        left: 50%;
    }
    .not-mobile &.active .step-label,
    .not-mobile &:hover .step-label {
        color: $active-text;
    }

    // caret transition
    .arrow-enter-active,
    .arrow-leave-active {
        transition: transform 150ms $easeInOutQuad,
            clip-path 150ms $easeInOutQuad;
    }
    .arrow-enter,
    .arrow-leave-to {
        -webkit-clip-path: polygon(0 100%, 100% 100%, 100% 100%, 0% 100%);
        clip-path: polygon(0 100%, 100% 100%, 100% 100%, 0% 100%);
        transform: translateY(-100%);
    }
    .arrow-enter-to,
    .arrow-leave {
        -webkit-clip-path: polygon(0 100%, 100% 100%, 100% 100%, 0% 100%);
        clip-path: polygon(0 0, 100% 0, 100% 100%, 0% 100%);
    }
}

// mobile breakpoints
@media #{ $lt-phone } {
    .products-solution-indicator {
        align-items: center;
        display: flex;

        .circle {
            margin-right: 8px;
            margin-bottom: 0;
            margin-left: 0;
        }
        .down-caret {
            display: none !important;
        }
    }
}
</style>
