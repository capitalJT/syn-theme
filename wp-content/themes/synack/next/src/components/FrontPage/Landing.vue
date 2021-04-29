<template>
    <transition :css="false" @beforeEnter="beforeEnter" @enter="enter" appear>
        <section class="globe" v-full-height.min>
            <!-- Background triangles -->
            <div class="grid-background" />

            <!-- Globe -->
            <front-page-globe-new
                v-full-height
                class="front-page-model-globe"
            />

            <div class="content-wrap contained" ref="content">
                <!-- Link carousel -->
                <slide-show
                    class="link-carousel"
                    :slides="cmpLinkSlides"
                    :infinite="true"
                    force-transition="fade"
                >
                    <a
                        class="single-link"
                        slot="slide"
                        slot-scope="{ slide }"
                        :href="slide.url"
                        target="_blank"
                    >
                        <span class="new">New</span>
                        <span class="text">{{ slide.text }}</span>
                        <span class="arrow">
                            <svg-arrow-right />
                        </span>
                    </a>
                </slide-show>

                <!-- Main content -->
                <wp-content :html="$store.state.pageData.content" />
            </div>

            <!-- Globe info box (placed here to z-index correctly) -->
            <front-page-info-box />

            <!-- Bottom dots -->
            <shared-light-dots />
        </section>
    </transition>
</template>

<script>
import { beforeEnter, enter } from './animations/landing'
import Vue from 'vue'
import Rellax from 'rellax'

export default {
    computed: {
        cmpLinkSlides() {
            return _get(
                this.$store,
                'state.pageData.acf.announcement_ticker',
                []
            )
        }
    },
    async mounted() {
        await Vue.nextTick()

        new Rellax(this.$refs.content)
    },
    methods: {
        beforeEnter,
        enter
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

$gray: #bfc6d2;

.globe {
    background: $indigo;
    background-size: 50px;
    color: $white;
    display: flex;
    align-items: center;
    overflow: hidden;
    position: relative;

    .grid-background {
        @include fill;
        background: url('images/patterns/triangles.png');
        background-size: 50px;
        opacity: 0.07;
        pointer-events: none;
    }
    // position main globe
    .front-page-model-globe {
        position: absolute;
        top: 0;
        bottom: 0;
        width: 200%;
        transform: translateX(-50%);
        // background: radial-gradient(rgba(#12203f, 1), rgba(#020f37, 0.1));

        @media #{$lt-phone} {
            width: 100%;
            transform: none;
        }
    }
    .content-wrap {
        padding-top: 90px;
        padding-right: 30px;
        padding-bottom: 90px;
        padding-left: 16vw;
        box-sizing: border-box;

        .link-carousel {
            font-size: 16px;
            height: 2em;
            overflow: visible;

            .single-link {
                color: $white;
                display: flex;
                align-items: center;
                text-decoration: none;

                .new {
                    border: 1px solid $red;
                    text-transform: uppercase;
                    font-size: 12px;
                    letter-spacing: 2px;
                    padding: 6px 8px 7px 10px;
                    border-radius: 6px;
                    margin-right: 15px;
                    font-weight: 500;
                }
                .text {
                    position: relative;
                    bottom: 2px;
                }
                .arrow {
                    position: relative;
                    top: 0px;
                    left: 5px;
                }
            }
        }
        .wp-content {
            margin-top: 50px;
            font-size: 20px;

            h2,
            h3 {
                margin: 0;
                font-size: 60px;
                line-height: 1.05;

                .blast {
                    // display: inline-block;
                }
            }
            h3 + p {
                margin-top: 25px;
            }
            p {
                line-height: 1.4;
                color: $gray;
                margin: 50px auto;
            }
        }
    }

    // dots at bottom of page
    .dotted {
        bottom: 0;
        top: initial;
    }

    // tablet breakpoints
    @media #{ $lt-desktop } {
        min-height: initial !important;

        .content-wrap.contained {
            padding-top: 65vw;
        }
    }

    // Mobile
    @media #{$lt-phone} {
        .content-wrap {
            max-width: 100%;
            margin: auto auto 30px;
            padding: 40px $mobile-padding 0;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;

            .link-carousel {
                padding: 0 20px;
                position: relative;

                .slide-wrap {
                    width: calc(100% - 45px);
                }
            }
            .wp-content {
                font-size: 16px;
                text-align: center;
                margin-top: 30px;

                h3 {
                    font-size: 30px;
                    margin-bottom: 20px;
                }
                p {
                    margin: 20px auto;
                }
                & > p:last-child {
                    position: relative;
                    display: flex;
                    justify-content: center;
                }
                .shortcode-button {
                    padding: 15px 20px;
                    white-space: nowrap;

                    &.primary {
                        padding-top: 18px;
                    }
                }
            }
        }
    }
}
</style>
