<template>
    <div class="government-chart-graphic contained">
        <div class="content-wrap">
            <div class="left-line" />
            <div class="spacer">
                <div class="horizontal-line" v-in-view>
                    <svg-bullseye />
                </div>
            </div>
            <wp-content class="centered-copy" :html="cmpText" />
            <div class="spacer" />
        </div>

        <div class="chart-wrap" ref="chart">
            <img
                :src="cmpTiltImage"
                alt="A chart showing revenue sharply increasing from $15 million to $45 million from 2014 to 2018, then continuing to rise to $70 million by 2022."
                width="2276"
                height="1204"
                class="chart"
            />
        </div>
    </div>
</template>

<script>
import VanillaTilt from '../../libs/vanilla-tilt'
import Vue from 'vue'
import { styler, tween } from 'popmotion'

export default {
    data() {
        return {
            pageData
        }
    },
    async mounted() {
        await Vue.nextTick()

        // tilt effect on the 'guaranteed income' graphic
        VanillaTilt.init(this.$refs.chart, {
            // glare: false,
            reverse: true,
            // 'max-glare': 0.1,
            'mouse-event-element': '.government-chart-graphic',
            max: 20
        })
    },
    computed: {
        cmpText() {
            return _get(this.pageData, 'acf.pentagon_stats_content')
        },
        cmpTiltImage() {
            return _get(this.pageData, 'acf.pentagon_tilt_image.url', '')
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

$line-color: #354256;

.government-chart-graphic {
    .content-wrap {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;

        .spacer {
            flex: 1;
        }
        .left-line {
            background: $line-color;
            position: absolute;
            top: 0;
            left: 0;
            bottom: 50%;
            width: 1px;
        }
        .horizontal-line {
            background: $line-color;
            height: 1px;
            width: 70%;
            position: relative;
            transition: transform 0.4s 0.4s, opacity 0.4s 0.4s;
            transform-origin: center left;

            .bullseye {
                position: absolute;
                top: -9px;
                right: -5px;
            }

            &.below-view:not(.fired-once) {
                transform: scaleX(0);
            }
        }
        .wp-content p:first-child {
            margin-top: 0;
        }
    }

    .chart-wrap {
        width: 80%;
        margin: 40px auto 0;

        img {
            width: 100%;
            height: auto;
        }
    }

    @media #{$lt-phone} {
        .content-wrap {
            .horizontal-line {
                position: static;
            }
            .left-line {
                display: none;
            }
            .bullseye {
                top: 0;
                right: 0;
                left: 0;
                margin: auto;
                transform: translate(-2.5px, -50%);
            }
            .wp-content {
                padding: 25px 20px 0;
                font-size: 20px;
            }
        }
    }
}
</style>
