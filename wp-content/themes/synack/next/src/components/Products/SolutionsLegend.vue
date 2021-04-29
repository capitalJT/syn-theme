<template>
    <svg
        :class="['products-solutions-legend', `active-${activeIndex}`]"
        width="21.5"
        height="400"
        x="-60"
        y="134"
        viewBox="0 0 24 400"
        xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink"
    >
        <line
            x1="12"
            y1="370"
            x2="12"
            :y2="lineY"
            stroke="#000"
            stroke-width="4"
        />

        <circle class="fill" cx="12" cy="12" :r="sixRadius" />
        <circle class="fill" cx="12" cy="80" :r="fiveRadius" />
        <circle class="fill" cx="12" cy="150" :r="fourRadius" />
        <circle class="fill" cx="12" cy="220" :r="threeRadius" />
        <circle class="fill" cx="12" cy="290" :r="twoRadius" />
        <circle class="fill" cx="12" cy="360" :r="oneRadius" />
    </svg>
</template>

<script>
import { timeline, easing, transform, tween } from 'popmotion'

// create interpolator
const { interpolate, clamp } = transform
const rClamp = clamp(0, 18)

const legendTimeline = timeline(
    [
        {
            track: 'oneRadius',
            from: 0,
            to: 11,
            duration: 400,
            ease: easing.backInOut
        },
        '-300',
        {
            track: 'lineY',
            from: 370,
            to: 290,
            duration: 400,
            ease: easing.linear
        },
        '-100',
        {
            track: 'twoRadius',
            from: 0,
            to: 11,
            duration: 400,
            ease: easing.backInOut
        },
        '-100',
        {
            track: 'lineY',
            from: 290,
            to: 220,
            duration: 400,
            ease: easing.linear
        },
        '-100',
        {
            track: 'threeRadius',
            from: 0,
            to: 11,
            duration: 400,
            ease: easing.backInOut
        },
        '-100',
        {
            track: 'lineY',
            from: 220,
            to: 150,
            duration: 400,
            ease: easing.linear
        },
        '-100',
        {
            track: 'fourRadius',
            from: 0,
            to: 11,
            duration: 400,
            ease: easing.backInOut
        },
        '-100',
        {
            track: 'lineY',
            from: 150,
            to: 80,
            duration: 400,
            ease: easing.linear
        },
        '-100',
        {
            track: 'fiveRadius',
            from: 0,
            to: 11,
            duration: 400,
            ease: easing.backInOut
        },
        {
            track: 'lineY',
            from: 80,
            to: 12,
            duration: 400,
            ease: easing.linear
        },
        '-100',
        {
            track: 'sixRadius',
            from: 0,
            to: 11,
            duration: 400,
            ease: easing.backInOut
        }
    ],
    {
        ease: easing.linear,
        duration: 1800
    }
)

const progMap = {
    0: 0,
    1: 0.23,
    2: 0.4,
    3: 0.59,
    4: 0.8,
    5: 1
}

export default {
    props: {
        activeIndex: {
            type: Number,
            default: 0
        }
    },
    watch: {
        activeIndex(index, fromIndex) {
            if (this.tweenAction) this.tweenAction.stop()
            const diff = Math.abs(index - fromIndex)
            this.tweenAction = tween({
                from: this.timelineProgress,
                to: progMap[index],
                duration: 400 * diff,
                ease: easing.easeOut
            }).start(p => (this.timelineProgress = p))
        },
        timelineProgress(prog) {
            this.timelineAction.seek(prog)
        }
    },
    data() {
        return {
            tweenAction: null,
            timelineAction: null,
            timelineProgress: 0,
            lineY: 370,
            oneRadius: 0,
            twoRadius: 0,
            threeRadius: 0,
            fourRadius: 0,
            fiveRadius: 0,
            sixRadius: 0
        }
    },
    mounted() {
        this.timelineAction = legendTimeline.start(this.applyTimeline)
        this.timelineAction.pause()
        window.timelineAction = this.timelineAction

        if (this.activeIndex != 0) {
            this.tweenAction = tween({
                to: progMap[this.activeIndex],
                duration: 400 * this.activeIndex,
                ease: easing.easeOut
            }).start(p => (this.timelineProgress = p))
        }
    },
    methods: {
        applyTimeline(v) {
            this.lineY = v.lineY
            this.oneRadius = rClamp(v.oneRadius)
            this.twoRadius = rClamp(v.twoRadius)
            this.threeRadius = rClamp(v.threeRadius)
            this.fourRadius = rClamp(v.fourRadius)
            this.fiveRadius = rClamp(v.fiveRadius)
            this.sixRadius = rClamp(v.sixRadius)
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

$teal: #3dcbdc;

.products-solutions-legend {
    circle {
        transition: fill 250ms ease;
    }
    .outline {
        fill: none;
    }
    line {
        transition: stroke 250ms ease;
    }

    // active states
    &.active-0 {
        circle.fill {
            fill: $yellow;
        }
        circle.outline {
            stroke: $yellow;
        }
        line {
            stroke: darken($yellow, 20%);
        }
    }
    &.active-1 {
        circle {
            fill: $green;
        }
        line {
            stroke: darken($green, 20%);
        }
    }
    &.active-2 {
        circle {
            fill: $teal;
        }
        line {
            stroke: darken($teal, 20%);
        }
    }
    &.active-3 {
        circle {
            fill: $blue;
        }
        line {
            stroke: darken($blue, 20%);
        }
    }
    &.active-4 {
        circle {
            fill: $purple;
        }
        line {
            stroke: darken($purple, 20%);
        }
    }
    &.active-5 {
        circle {
            fill: $red;
        }
        line {
            stroke: darken($red, 20%);
        }
    }
}
</style>
