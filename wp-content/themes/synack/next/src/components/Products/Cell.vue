<template>
    <component
        :is="th ? 'th' : 'td'"
        :scope="column ? 'column' : 'row'"
        key="th"
        :class="[
            'products-cell',
            { 'has-text': text },
            { 'has-tooltip': hasTooltip }
        ]"
    >
        <img
            v-if="checkbox"
            src="/wp-content/themes/synack/next/static/images/checkbox.png"
            alt="Checked."
            class="checkbox"
        />

        <div class="text-wrap" v-if="(icon && icon.url) || text">
            <img v-if="icon && icon.url" :src="icon.url" />
            <div class="text">{{ text }}</div>
        </div>

        <!-- Tooltip -->
        <button
            v-if="hasTooltip"
            class="tooltip-activator"
            v-interact="startHover"
            v-interact.end="endHover"
            ref="tooltip"
        >
            <img
                src="/wp-content/themes/synack/next/static/images/icon-tooltip.png"
                alt="Activate tooltip"
            />
        </button>
    </component>
</template>

<script>
export default {
    props: ['checkbox', 'icon', 'text', 'tooltip', 'index', 'th', 'column'],
    computed: {
        hasTooltip() {
            return this.tooltip
        }
    },
    methods: {
        startHover() {
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
                content: this.tooltip
            })
        },
        endHover() {
            this.$store.commit('REMOVE_ACTIVE_TOOLTIP')
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

.products-cell {
    display: flex;
    align-items: center;
    flex-direction: column;
    text-align: center;
    line-height: 1.3;
    position: relative;

    padding: 15px;
    box-sizing: border-box;
    color: $grid-text;

    &:not(.has-text) {
        justify-content: center;
    }
    &.has-tooltip {
        padding-right: 40px;
        padding-left: 40px;
    }
    &:first-child {
        align-items: flex-start;
        text-align: left;
        justify-content: center;
    }
    img {
        max-width: 24px;
    }
    img[src*='check'] + .text-wrap {
        margin-top: 10px;
    }
    .text-wrap {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        font-size: 14px;
        font-weight: 400;

        img + .text {
            margin-left: 10px;
            font-size: 16px;
            font-weight: 500;
            position: relative;
            top: 2px;
        }
    }
    .checkbox {
        width: 24px;
        height: 24px;
    }
    .tooltip-activator {
        position: absolute;
        top: 0;
        right: 10px;
        bottom: 0;
        margin: auto;
        width: 24px;
        height: 24px;
    }
}

th.products-cell {
    .text-wrap {
        .text {
            font-weight: 500;
        }
        img[src*='bullet'] {
            & + .text {
                font-size: 14px;
                font-weight: 400;
                top: 0;
            }
        }
    }
}
</style>
