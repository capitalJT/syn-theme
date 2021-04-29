<template>
    <transition :css="false" @beforeEnter="beforeEnter" @enter="enter" appear>
        <section class="red-team-landing">
            <!-- Synack Red Team copy + Member of the Month -->
            <div class="hero">
                <div class="grid-background" />

                <div class="content-wrap" data-parallax="0.5">
                    <img
                        src="/wp-content/themes/synack/next/static/images/logo-srt.png"
                        alt="Synack Red Team logo. The letters SRT in red in parentheses."
                        width="358"
                        height="244"
                        class="srt-logo"
                        ref="srtLogo"
                    />
                    <wp-content
                        ref="copy"
                        :html="$store.state.pageData.content"
                    />
                </div>

                <!-- Featured Member section + bio -->
                <red-team-featured-member ref="featured" />

                <!-- world map decoration -->
                <img
                    src="/wp-content/themes/synack/next/static/images/world-map.png"
                    alt="A map of the world."
                    width="796"
                    height="528"
                    class="world-map"
                />

                <!-- Bottom dots -->
                <div class="dots-bottom" />
            </div>

            <!-- Announcements -->
            <nav class="announcements">
                <ul>
                    <li
                        v-for="(announcement, i) in cmpAnnouncements"
                        :key="i"
                        class="announcement"
                    >
                        <!-- image -->
                        <responsive-image
                            :src="announcement.logo.url"
                            :alt="announcement.logo.alt"
                        />
                        <!-- content -->
                        <wp-content :html="announcement.description" />
                        <!-- link -->
                        <div class="link-wrap">
                            <a
                                v-if="announcement.action_text"
                                :href="announcement.action_link"
                            >
                                <span v-html="announcement.action_text" />
                                <svg-arrow-right />
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
        </section>
    </transition>
</template>

<script>
import { timeline, styler, easing, value, transform } from 'popmotion'
const { interpolate } = transform
import { smooth } from '@popmotion/popcorn'
import rect from '../../libs/rect'
import Vue from 'vue'

const stylers = {}

export default {
    mixins: [rect],
    data() {
        return {
            pageData,
            screenMouse: null
        }
    },
    async mounted() {
        await Vue.nextTick()

        const parallax = [...this.$el.querySelectorAll('[data-parallax]')]
        const stylers = parallax.map(styler)
        const movement = 10

        // prep the mouse watcher
        this.screenMouse = value({ x: 0, y: 0 })

        // first reaction: move elements marked with data-parallax
        this.screenMouse.subscribe(({ x, y }) => {
            parallax.forEach((el, i) => {
                const multiplier = parseFloat(el.getAttribute('data-parallax'))
                stylers[i].set({
                    x: movement * multiplier * x,
                    y: movement * multiplier * y
                })
            })
        })

        // second reaction: change line height of glitch by y position
        // const glitchStyler = styler(
        //     this.$el.querySelector('.glitch-decoration .text-wrap')
        // )
        // const interpolater = interpolate([1, -1], [2, 5])
        // this.screenMouse.subscribe(v => {
        //     const y = interpolater(v.y)
        //     glitchStyler.set('line-height', y)
        // })
    },
    methods: {
        beforeEnter(el) {
            stylers.logo = styler(this.$refs.srtLogo)
            stylers.copy = styler(this.$refs.copy.$el)
            stylers.portrait = styler(
                this.$refs.featured.$el.querySelector('.hacker-image')
            )
            stylers.featuredLabel = styler(
                this.$refs.featured.$el.querySelector('.label-wrap')
            )
            stylers.openButton = styler(
                this.$refs.featured.$el.querySelector('.open-bio')
            )

            Object.keys(stylers).forEach(key => stylers[key].set('opacity', 0))
        },
        enter(el, done) {
            timeline(
                [
                    { track: 'logo', from: { opacity: 0 }, to: { opacity: 1 } },
                    '-200',
                    {
                        track: 'copy',
                        from: { x: -20, opacity: 0 },
                        to: { x: 0, opacity: 1 }
                    },
                    '-200',

                    {
                        track: 'portrait',
                        from: { y: 40, opacity: 0 },
                        to: { y: 0, opacity: 1 }
                    },
                    '-200',
                    {
                        track: 'openButton',
                        from: { y: 50, opacity: 0 },
                        to: { y: 0, opacity: 1 }
                    },
                    '-200',
                    {
                        track: 'featuredLabel',
                        from: { y: 40, opacity: 0 },
                        to: { y: 0, opacity: 1 }
                    }
                ],
                {
                    duration: 1400,
                    ease: easing.linear
                }
            ).start({
                update: v => {
                    Object.keys(v).forEach(key => {
                        stylers[key].set(v[key])
                    })
                },
                complete: done
            })
        }
    },
    computed: {
        cmpAnnouncements() {
            return this.pageData.acf.announcements
        }
    },
    watch: {
        '$root.screenMouse': {
            handler(newVal) {
                this.screenMouse.update(newVal)
            },
            deep: true
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

$main-background-color: #051d30;
$gradient-red: #ee0034;
$gradient-gray: #011322;
$body-color: #b8c4da;
$body-gray: #8695ae;
$announcement-border: #182339;

.red-team-landing {
    color: $white;
    overflow-x: hidden;
    background: $black;

    .grid-background {
        @include fill;
        background: url('images/patterns/triangles.png');
        background-size: 50px;
        opacity: 0.07;
        pointer-events: none;
    }

    .hero {
        position: relative;
        min-height: 75vh;
        display: flex;
        align-items: center;
        background: linear-gradient(
                rgba($gradient-red, 0.3),
                rgba($gradient-gray, 0)
            ),
            $main-background-color;
    }

    // Content
    .content-wrap {
        @include fill;
        padding: 80px 30px;

        display: flex;
        flex-direction: column;
        justify-content: center;
        margin: auto;
        max-width: $max-width;
        position: relative;
        z-index: 10;
        pointer-events: none;

        .srt-logo {
            width: 170px;
            height: auto;
            position: relative;
            top: 2px;
            right: 12px;
        }
        .wp-content {
            font-size: 24px;
            width: 40%;

            & > *:first-child {
                margin-top: 0;
            }
            h3 {
                font-size: 60px;
                margin-bottom: 25px;
            }
            p {
                color: $body-color;
                line-height: 1.4;
                margin-bottom: 30px;
            }
            a {
                pointer-events: all;
            }
        }
    }

    .world-map {
        position: absolute;
        right: -20px;
        bottom: 65px;
        width: 40%;
        height: auto;
        pointer-events: none;
    }

    // dots at bottom of page
    .dots-bottom {
        position: absolute;
        right: 0;
        bottom: 0;
        left: 0;
        height: 50px;

        background: url('images/patterns/dots.png');
        background-size: 10px;
        opacity: 0.1;
    }

    // Events
    .announcements {
        // background: $black;
        color: $body-gray;
        position: relative;
        z-index: 5;

        ul {
            list-style: none;
            margin: 0 auto;
            padding: 0;
            min-height: 20vh;

            display: grid;
            grid-template-columns: repeat(3, 33.3333%);
            max-width: 1350px;
        }
        .announcement {
            text-align: center;
            line-height: 1.4;
            // max-width: 70%;
            margin: auto;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 20px 0;
            background: $black;

            & + .announcement {
                border-left: 2px solid $announcement-border;
            }
            & > * {
                width: 70%;
                margin: auto;
            }
            .responsive-image {
                max-width: 150px;
            }
            p {
                padding: 0;
                margin: 0;
            }
            a {
                color: $white;
                text-decoration: none;
            }
            .link-wrap {
                text-transform: uppercase;
                font-size: 14px;
                letter-spacing: 1px;
                margin: 30px auto 40px;
                height: 1em;

                a {
                    padding: 10px;
                }
                svg {
                    margin-left: 10px;
                }
            }
        }
    }

    @media #{$lt-phone} {
        overflow: hidden;

        *[data-parallax] {
            transform: none !important;
        }
        .hero {
            display: block;
            overflow-y: hidden;
        }
        .world-map {
            display: none;
        }
        .content-wrap {
            padding-top: 80px;
            padding-bottom: 20px;
            display: block;
            text-align: center;

            .srt-logo {
                position: static;
                margin: auto;
                width: 73px;
            }
            .wp-content {
                width: 100%;
                font-size: 16px;
                h3 {
                    font-size: 30px;
                }
            }
        }
        .announcements {
            ul {
                display: block;
            }
            .announcement {
                padding: 20px 0;

                & + .announcement {
                    border-left: none;
                    border-top: 2px solid $announcement-border;
                }
            }
        }
    }
}
</style>
