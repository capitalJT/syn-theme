<template>
    <div :class="classes">
        <svg
            width="550px"
            height="685px"
            viewBox="-30 -5 550 685"
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
        >
            <!-- Synack Platform -->
            <image
                class="synackos"
                xlink:href="/wp-content/themes/synack/next/static/images/solutions/synackos.png"
                width="550"
                height="355"
                x="0"
                y="325"
            />
            <image
                class="synackos activestate"
                xlink:href="/wp-content/themes/synack/next/static/images/solutions/synackos-active.png"
                width="550"
                height="355"
                x="0"
                y="325"
            />

            <!-- Disclose -->
            <image
                class="disclose"
                xlink:href="/wp-content/themes/synack/next/static/images/solutions/disclose.png"
                width="550"
                height="328"
                x="0"
                y="260"
            />
            <image
                class="disclose activestate"
                xlink:href="/wp-content/themes/synack/next/static/images/solutions/disclose-active.png"
                width="550"
                height="328"
                x="0"
                y="260"
            />

            <!-- SmartScan -->
            <image
                class="smartscan"
                xlink:href="/wp-content/themes/synack/next/static/images/solutions/smartscan.png"
                width="550"
                height="328"
                x="0"
                y="195"
            />
            <image
                class="smartscan activestate"
                xlink:href="/wp-content/themes/synack/next/static/images/solutions/smartscan-active.png"
                width="550"
                height="328"
                x="0"
                y="195"
            />

            <!-- Discover -->
            <image
                class="discover"
                xlink:href="/wp-content/themes/synack/next/static/images/solutions/discover.png"
                width="550"
                height="328"
                x="0"
                y="130"
            />
            <image
                class="discover activestate"
                xlink:href="/wp-content/themes/synack/next/static/images/solutions/discover-active.png"
                width="550"
                height="328"
                x="0"
                y="130"
            />

            <!-- Certify -->
            <image
                class="certify"
                xlink:href="/wp-content/themes/synack/next/static/images/solutions/certify.png"
                width="550"
                height="328"
                x="0"
                y="65"
            />
            <image
                class="certify activestate"
                xlink:href="/wp-content/themes/synack/next/static/images/solutions/certify-active.png"
                width="550"
                height="328"
                x="0"
                y="65"
            />

            <!-- Defend -->
            <image
                class="defend"
                xlink:href="/wp-content/themes/synack/next/static/images/solutions/defend.png"
                width="550"
                height="328"
                x="0"
                y="0"
            />
            <image
                class="defend activestate"
                xlink:href="/wp-content/themes/synack/next/static/images/solutions/defend-active.png"
                width="550"
                height="328"
                x="0"
                y="0"
            />

            <!-- Buttons -->
            <polygon
                @click="onClick(0)"
                @mouseenter="hoverIdx = 0"
                @mouseleave="hoverIdx = -1"
                transform="translate(0, 325)"
                class="button"
                points="-10,165 275,0 560,165 275,330"
            />
            <polygon
                @click="onClick(1)"
                @mouseenter="hoverIdx = 1"
                @mouseleave="hoverIdx = -1"
                transform="translate(0, 260)"
                class="button"
                points="-10,165 275,0 560,165 275,330"
            />
            <polygon
                @click="onClick(2)"
                @mouseenter="hoverIdx = 2"
                @mouseleave="hoverIdx = -1"
                transform="translate(0, 195)"
                class="button"
                points="-10,165 275,0 560,165 275,330"
            />
            <polygon
                @click="onClick(3)"
                @mouseenter="hoverIdx = 3"
                @mouseleave="hoverIdx = -1"
                transform="translate(0, 130)"
                class="button"
                points="-10,165 275,0 560,165 275,330"
            />
            <polygon
                @click="onClick(4)"
                @mouseenter="hoverIdx = 4"
                @mouseleave="hoverIdx = -1"
                transform="translate(0, 65)"
                class="button"
                points="-10,165 275,0 560,165 275,330"
            />
            <polygon
                @click="onClick(5)"
                @mouseenter="hoverIdx = 5"
                @mouseleave="hoverIdx = -1"
                class="button"
                points="-10,165 275,0 560,165 275,330"
            />

            <products-solutions-legend :active-index="activeIndex" />
        </svg>
    </div>
</template>

<script>
export default {
    props: {
        activeIndex: {
            type: Number,
            default: 0
        }
    },
    data() {
        return {
            hoverIdx: -1
        }
    },
    computed: {
        classes() {
            return [
                'solutions-vector',
                `active-${this.activeIndex}`,
                `hover-${this.hoverIdx}`
            ]
        }
    },
    methods: {
        onClick(i) {
            this.$emit('layer-click', i)
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

.solutions-vector {
    padding-bottom: 107%;
    position: relative;
    height: 0;

    .button {
        cursor: pointer;
        fill: transparent;
    }

    & > svg {
        position: absolute;
        height: 100%;
        width: 100%;
    }
    image {
        transition: opacity 450ms ease, transform 300ms ease;
    }
    .activestate {
        opacity: 0;
    }

    &.hover-0 .synackos,
    &.hover-1 .disclose,
    &.hover-2 .smartscan,
    &.hover-3 .discover,
    &.hover-4 .certify,
    &.hover-5 .defend {
        transform: translateY(-5px);

        &.activestate {
            transform: translateY(-5px);
            opacity: 0.08;
        }
    }
    &.active-0 .synackos.activestate,
    &.active-1 .disclose.activestate,
    &.active-2 .smartscan.activestate,
    &.active-3 .discover.activestate,
    &.active-4 .certify.activestate,
    &.active-5 .defend.activestate {
        opacity: 1;
    }
}
</style>
