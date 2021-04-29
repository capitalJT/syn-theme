<template>
    <transition name="tooltip">
        <div
            v-if="isActive"
            :key="`${left}:${top}`"
            @mouseenter="resetData"
            @mouseleave="removeTooltip"
            :class="classes"
            :style="styles"
        >
            <div class="content" v-html="content" />
            <span class="triangle" />
        </div>
    </transition>
</template>

<script>
export default {
    computed: {
        styles() {
            const { winHeight, winWidth } = this.$store.state.browser
            const bottom = `${winHeight - this.top + 28}px`
            if (this.alignRight) {
                return {
                    right: `${winWidth - this.left - 8}px`,
                    bottom
                }
            } else {
                return {
                    left: `${this.left}px`,
                    bottom
                }
            }
        },
        classes() {
            return [
                'products-tooltip',
                { 'aligned-right': this.alignRight },
                { 'aligned-left': this.alignLeft }
            ]
        },
        isActive() {
            return this.$store.state.showTooltip
        },
        alignRight() {
            return this.$store.state.tooltipAlignment === 'right'
        },
        alignLeft() {
            return this.$store.state.tooltipAlignment === 'left'
        },
        left() {
            return this.$store.state.tooltipX
        },
        top() {
            return this.$store.state.tooltipY
        },
        content() {
            return this.$store.state.tooltipContent
        }
    },
    methods: {
        resetData() {
            // set tooltip
            this.$store.commit('SET_ACTIVE_TOOLTIP', {
                alignment: this.$store.state.tooltipAlignment,
                x: this.$store.state.tooltipX,
                y: this.$store.state.tooltipY,
                content: this.$store.state.tooltipContent || ''
            })
        },
        removeTooltip() {
            this.$store.commit('REMOVE_ACTIVE_TOOLTIP')
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

.products-tooltip {
    box-shadow: 0 12px 34px 0 rgba(0, 25, 62, 0.14);
    background-color: $white;
    box-sizing: border-box;
    margin-left: -190px;
    padding: 40px 50px;
    position: fixed;
    width: 380px;
    z-index: 20;

    a {
        transition: border-color 250ms;
        border-bottom: 1px dashed rgba($blue, 0.25);
        text-decoration: none;
        display: inline-block;
        padding-bottom: 4px;
        position: relative;
        color: $blue;

        .not-mobile &:hover,
        .not-mobile &:focus {
            border-color: rgba($blue, 0.75);
        }
    }
    .content {
        color: #8696ad;

        & > *:first-child {
            margin-top: 0;
        }
        & > *:last-child {
            margin-bottom: 0;
        }

        strong {
            font-size: 20px;
            color: $navy;
        }
    }
    .triangle {
        transform: translateX(-6px) rotate(45deg);
        transform-origin: center;
        background-color: $white;
        pointer-events: none;
        position: absolute;
        bottom: -13px;
        height: 26px;
        width: 26px;
        left: 50%;
    }

    // alignment
    &.aligned-right .triangle {
        transform: translateX(-13px) rotate(45deg);
        -webkit-clip-path: polygon(0 0, 0% 100%, 100% 100%);
        clip-path: polygon(0 0, 0% 100%, 100% 100%);
        left: 100%;
    }
    &.aligned-left {
        margin-left: 0;
    }
    &.aligned-left .triangle {
        transform: translateX(-13px) rotate(45deg);
        -webkit-clip-path: polygon(100% 0, 0 0, 100% 100%);
        clip-path: polygon(100% 0, 0 0, 100% 100%);
        left: 0;
    }

    // in/out transition
    &.tooltip-enter-active,
    &.tooltip-leave-active {
        transition: opacity 400ms ease, transform 250ms ease;
    }
    &.tooltip-enter,
    &.tooltip-leave-to {
        opacity: 0;
    }
    &.tooltip-enter {
        transform: translateY(30px);
    }
}

// mobile breakpoints
@media #{ $lt-phone } {
    .products-tooltip {
        padding-right: $mobile-padding;
        padding-left: $mobile-padding;
        white-space: initial;
        font-size: 14px;
        width: 80%;

        strong {
            font-size: 16px;
        }
    }
}
</style>
