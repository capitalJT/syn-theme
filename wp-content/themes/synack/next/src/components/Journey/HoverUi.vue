<template>
    <div class="journey-hover-ui" :style="cmpStyle">
        <div class="icon">
            <journey-svg-mobile-icon :progress="progress" />
        </div>
        <div class="content-wrap">
            <h3 class="title" v-html="title" />
            <wp-content class="content" :html="content" />
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            default: ''
        },
        content: {
            type: String,
            default: ''
        },
        target: null,
        mouseDown: {
            type: Boolean,
            default: false
        },
        holdDuration: {
            type: Number,
            default: 1
        }
    },
    data() {
        return {
            startHold: 0,
            progress: 0
        }
    },
    computed: {
        cmpStyle() {
            if (!this.target) return {}

            const rect = this.target.getBoundingClientRect()

            let left = rect.right + 30
            // see if tooltip would be offscreen
            // (tooltip is 400px wide)
            const difference = this.$store.state.browser.winWidth - (left + 400)
            if (difference < 0) {
                left += difference - 20
            }

            return {
                top: rect.top + rect.height / 2 + 'px',
                left: left + 'px'
            }
        }
    },
    methods: {
        mouseDownUpdate() {
            if (!this.mouseDown) return

            this.progress = (Date.now() - this.startHold) / this.holdDuration
            if (this.progress >= 1.05) {
                this.$emit('surfaceSelected')
            } else {
                requestAnimationFrame(this.mouseDownUpdate)
            }
        }
    },
    watch: {
        mouseDown(newVal) {
            if (newVal) {
                this.startHold = Date.now()
                this.mouseDownUpdate()
            } else {
                this.progress = 0
            }
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

$background: #061023;
$icon-background: #ff3655;
$body-text: #8695ae;

.journey-hover-ui {
    height: 75px;
    display: grid;
    grid-template-columns: 75px 1fr;
    background: $background;
    width: 400px;
    clip-path: polygon(
        20px 0,
        100% 0%,
        100% calc(100% - 20px),
        calc(100% - 20px) 100%,
        0% 100%,
        0% 20px
    );
    pointer-events: none;
    position: fixed;
    transform: translateY(-50%);

    .icon {
        background: $icon-background;
        width: 75px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .circle-solid {
        stroke-dasharray: 160px;
        stroke-dashoffset: 160px;
        transform: rotateZ(-90deg);
        transform-origin: 26.5px;
    }
    .content-wrap {
        padding: 10px 30px 10px 20px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .title {
        color: $white;
        margin: 0 0 5px;
        font-size: 13px;
        color: #ffffff;
        letter-spacing: 2px;
        text-transform: uppercase;
        font-weight: 400;
    }
    .wp-content {
        color: $body-text;
        font-size: 12px;
        letter-spacing: 0;
        line-height: 21px;
    }
}
</style>
