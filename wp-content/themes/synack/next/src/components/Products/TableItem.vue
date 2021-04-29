<template>
    <div v-if="blank" class="products-table-item is-blank" />
    <div v-else class="products-table-item">
        <span class="name">{{ item.name }}</span>
        <button
            v-if="hasTooltip"
            ref="tooltip"
            @mouseenter="activateTooltip"
            @mouseleave="hoverOff"
            @focus="activateTooltip"
            @blur="removeTooltip"
            class="tooltip-trigger"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink"
                x="0px"
                y="0px"
                width="16px"
                height="16px"
                viewBox="0 0 16 16"
                xml:space="preserve"
            >
                <g>
                    <circle
                        fill-rule="evenodd"
                        fill="#E6E9EE"
                        cx="8"
                        cy="8"
                        r="8"
                    />
                    <path
                        fill-rule="evenodd"
                        fill="#8695AE"
                        d="M7.25,13v-1.5h1.5V13H7.25z M8,3c1.66,0,3,1.34,3,3 c0,1.88-2.25,2.06-2.25,3.75h-1.5C7.25,7.31,9.5,7.5,9.5,6c0-0.82-0.68-1.5-1.5-1.5S6.5,5.18,6.5,6H5C5,4.34,6.34,3,8,3z"
                    />
                </g>
            </svg>
        </button>
    </div>
</template>

<script>
export default {
    props: {
        item: {
            type: [Object, Boolean],
            required: true
        }
    },
    data() {
        return {
            timer: null
        }
    },
    watch: {
        '$store.state.tooltipStamp'() {
            clearTimeout(this.timer)
        }
    },
    computed: {
        blank() {
            return this.item === false
        },
        hasTooltip() {
            return _get(this.item, 'has_tooltip', false)
        }
    },
    methods: {
        mouseEnterTooltip() {
            if (
                this.$refs.tooltip &&
                this.$refs.tooltip.getBoundingClientRect
            ) {
                this.$refs.tooltip.focus()
            }
        },
        activateTooltip() {
            if (
                this.$refs.tooltip &&
                this.$refs.tooltip.getBoundingClientRect
            ) {
                const { left, top } = this.$refs.tooltip.getBoundingClientRect()
                const { winWidth } = this.$store.state.browser

                // detect and set alignment
                let alignment = false
                if (winWidth - 200 < left) {
                    alignment = 'right'
                } else if (left < 200) {
                    alignment = 'left'
                }

                // set tooltip
                this.$store.commit('SET_ACTIVE_TOOLTIP', {
                    alignment,
                    x: left,
                    y: top,
                    content: this.item.tooltip_content || ''
                })

                window.addEventListener('scroll', this.removeTooltip)
                window.addEventListener('resize', this.removeTooltip)
            }
        },
        hoverOff() {
            this.timer = setTimeout(this.removeTooltip, 500)
        },
        removeTooltip() {
            window.removeEventListener('scroll', this.removeTooltip)
            window.addEventListener('resize', this.removeTooltip)
            this.$store.commit('REMOVE_ACTIVE_TOOLTIP')
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

$tooltip_fill: #e6e9ee;

.products-table-item {
    .tooltip-trigger {
        height: 16px;
        width: 16px;
    }
    .tooltip-trigger {
        margin-right: -18px;
        position: relative;
        margin-left: 2px;
        top: 3px;
    }
    .not-mobile & .tooltip-trigger:hover svg circle,
    .not-mobile & .tooltip-trigger:focus svg circle {
        fill: darken($tooltip_fill, 7%);
    }
    svg circle {
        transition: fill 250ms;
    }
}
</style>
