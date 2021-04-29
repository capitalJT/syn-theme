<template>
    <section
        :class="['red-team-join-team', `slide-${nearestSlideIndex}`]"
        :style="cmpStyle"
    >
        <div class="animation-wrap" v-full-height>
            <!-- Dots decoration -->
            <shared-light-dots />

            <div class="content">
                <!-- All slides -->
                <div class="slide" v-for="(section, i) in sections" :key="i">
                    <!-- hardcoded 'join the red team' -->
                    <h1 v-if="i == 0">Join the Red Team</h1>

                    <!-- slide content -->
                    <wp-content class="body" :html="section" />
                </div>
            </div>

            <transition name="fade">
                <div
                    :class="[
                        'silhouette-wrap',
                        { 'highlighted-figure': cmpFiguresHighlighted }
                    ]"
                    v-show="!lastSlideDisplayed"
                >
                    <svg-silhouette-field
                        v-if="!$store.getters.isMobile"
                        key="desktop"
                        ref="silhouettes"
                    />
                    <svg-silhouette-field-tall
                        v-else
                        key="mobile"
                        ref="silhouettes"
                    />
                </div>
            </transition>

            <!-- Pager -->
            <svg-red-team-pager />

            <!-- Mouse -->
            <div class="mouse-icon-wrap">
                <svg-icon-mouse />
            </div>
        </div>
    </section>
</template>

<script>
import { keyframes, styler, tween } from 'popmotion'
import buildTimelineAnimation from './animations/timeline'
import smoothScroll from '../../libs/smoothScroll'
import Vue from 'vue'

let animation = null
let timelineAnimation = null
let scrollAnimation = null

export default {
    mixins: [smoothScroll(10)],
    data() {
        return {
            pageData,
            scrubPosition: 0
        }
    },
    computed: {
        sections() {
            // split content by <h2>, filter out empty sections,
            // and prepend the <h2>
            return this.pageData.acf.join_srt_content
                .split('<h2>')
                .filter(entry => entry)
                .map(entry => '<h2>' + entry)
        },
        percentages() {
            // start with 100%
            const output = [1]

            // for each section with a valid number, convert that
            // number to a percentage between 0-1
            this.sections.forEach(section => {
                const matches = section.match(/^\<h2\>(\d+)/)
                if (matches && matches.length > 1) {
                    const int = parseInt(matches[1])
                    output.push(int / 100)
                }
            })

            return output
        },
        sectionCount() {
            return this.sections.length
        },
        cmpStyle() {
            return {
                height:
                    this.$store.state.browser.winHeight * this.sectionCount +
                    'px'
            }
        },
        nearestSlideIndex() {
            return Math.floor(this.scrubPosition * this.sectionCount)
        },
        cmpFiguresHighlighted() {
            return this.sectionCount - this.nearestSlideIndex <= 2
        },
        lastSlideDisplayed() {
            return this.nearestSlideIndex >= this.sectionCount - 1
        }
    },
    async mounted() {
        await Vue.nextTick()

        // build timeline
        this.buildTimeline()

        // mouse scroll animation
        const scrollWheel = styler(this.$el.querySelector('.scroll-wheel'))
        const scrollAnimation = keyframes({
            values: [
                { opacity: 1, y: 0 },
                { opacity: 0, y: 20 },
                { opacity: 0, y: 0 },
                { opacity: 1, y: 0 }
            ],
            times: [0, 0.3, 0.6, 0.8],
            loop: Infinity,
            duration: 2000
        }).start(scrollWheel.set)
    },
    watch: {
        ssTop(newVal) {
            if (!this || !this.$el) return

            // get start position
            const scrubbableArea =
                this.$el.offsetHeight - this.$store.state.browser.winHeight

            const zeroedScrollPos =
                this.$store.state.browser.sTop - this.$el.offsetTop

            this.scrubPosition = Math.max(0, zeroedScrollPos / scrubbableArea)

            if (timelineAnimation) {
                // animation.seek(this.scrubPosition)
                timelineAnimation.seek(this.scrubPosition)
            }
        },
        async '$store.getters.isMobile'(newVal) {
            await Vue.nextTick()
            // rebuild timeline if we change breakpoints
            this.buildTimeline()
        },
        '$store.state.browser.sTop'(newVal, oldVal) {
            // ignore for now
            return

            // ignore if we're already animating
            if (scrollAnimation) return

            const zeroedScrollPos =
                this.$store.state.browser.sTop - this.$el.offsetTop
            const finishLine =
                this.$el.offsetHeight - this.$store.state.browser.winHeight
            const totalSlides = Math.floor(
                this.$el.offsetHeight / this.$store.state.browser.winHeight
            )

            // if we're in the JoinTeam slideshow...
            if (zeroedScrollPos > 0 && finishLine > zeroedScrollPos) {
                // ...figure out if we're scrolling down...
                const scrollingDown = newVal > oldVal
                // ...and figure out our current slide index...
                const currentSlide = Math.floor(
                    zeroedScrollPos / this.$store.state.browser.winHeight
                )

                // ...then, if we're not leaving the scroll area...
                if (
                    (scrollingDown && currentSlide >= totalSlides - 1) ||
                    (!scrollingDown && currentSlide === 0)
                ) {
                    return
                }

                const targetSlide = currentSlide + (scrollingDown ? 1 : 0)
                const currentSlideTop =
                    this.$el.offsetTop +
                    this.$store.state.browser.winHeight * currentSlide

                // ...animate to the next slide
                scrollAnimation = tween({
                    from: currentSlideTop,
                    to:
                        this.$el.offsetTop +
                        this.$store.state.browser.winHeight * targetSlide,
                    duration: 2000
                }).start({
                    update: v => {
                        window.scrollTo(0, v)
                    },
                    complete: () => {
                        // setTimeout(() => {
                        scrollAnimation = null
                        // }, 2000)
                    }
                })
            }
        }
    },
    methods: {
        buildTimelineAnimation,
        buildTimeline() {
            timelineAnimation = this.buildTimelineAnimation(this.percentages)
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

$navy: #00111f;
$title-red: #e9023e;
$body-gray: #8695ae;
$selected-figure-fill: #ff3655;

.red-team-join-team {
    background: $navy;
    position: relative;
    color: $white;

    .animation-wrap {
        position: -webkit-sticky;
        position: sticky;
        top: 0;
        // padding: 15vh 0 0;
        box-sizing: border-box;
        text-align: center;
        overflow-x: hidden;
        overflow-y: hidden;
        // max-width: $max-width;
        margin: auto;

        .content {
            height: 40vh;
            width: 100%;
            position: absolute;
            top: 5vh;
            left: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

            .slide {
                @include fill;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;

                &:first-child {
                    position: relative;
                    width: 100%;

                    .wp-content h2 {
                        font-size: 60px;
                        margin-bottom: 25px;
                    }
                }
                &:last-child {
                    height: 95vh;
                }

                h1 {
                    margin: 0;
                    text-align: center;
                    font-size: 16px;
                    text-transform: uppercase;
                    letter-spacing: 2px;
                    font-weight: 400;
                    color: $title-red;
                }
                .wp-content {
                    width: 100%;
                    h2 {
                        font-size: 120px;
                        margin: 1.25vh auto 0;
                    }
                    p {
                        font-size: 20px;
                        font-size: 1.7vh;
                        color: $body-gray;
                        line-height: 1.4;
                        width: 50%;
                        margin: auto;

                        em {
                            color: $title-red;
                            font-style: normal;
                            font-weight: 500;
                        }
                    }
                    img {
                        max-height: 35vh;
                        width: auto;
                        margin: 25px auto;
                    }
                    .shortcode-button {
                        margin: 20px 0;
                    }
                }

                // non-first-children
                & + .slide {
                    .wp-content {
                        p {
                            font-size: 24px;
                            color: $white;
                        }
                    }
                }
            }
        }
        .silhouette-wrap {
            position: absolute;
            top: 45vh;
            right: 5vw;
            bottom: 10vh;
            left: 5vw;

            .silhouette-field {
                @include fill;
                width: 100%;
                height: 100%;
                object-fit: contain;
            }
            &.highlighted-figure .selected {
                fill: $selected-figure-fill;
            }
            .selected {
                transition: fill 0.4s;
            }
        }

        // Pager
        .red-team-pager {
            position: absolute;
            top: 0;
            right: 20px;
            bottom: 0;
            margin: auto;
            transition: opacity 0.4s;

            rect {
                transition: opacity 0.4s, transform 0.4s;
            }
        }

        // Mouse icon
        .icon-mouse {
            position: absolute;
            right: 0;
            bottom: 2vh;
            left: 0;
            margin: auto;
        }
    }

    // pager styling
    &.slide-0 .red-team-pager {
        opacity: 0;
    }
    @for $i from 1 through 6 {
        &.slide-#{ $i } .red-team-pager rect:nth-child(#{$i}) {
            opacity: 1;
            transform: scale(0.4, 1) translateX(25px);
        }
    }

    @media #{$lt-phone} {
        padding: 0 10px;

        .animation-wrap {
            .silhouette-wrap {
                top: 45vh;
                right: 15px;
                bottom: 15vh;
                left: 15px;
            }
            .content {
                top: 55px;
                justify-content: initial;

                .slide,
                .slide:first-child {
                    .wp-content {
                        h2 {
                            font-size: 26px;
                            margin-bottom: 10px;
                        }
                        p {
                            width: 100%;
                            font-size: 13px;
                        }
                    }

                    & + .slide .wp-content {
                        p {
                            font-size: 18px;
                        }
                    }
                }
            }
            .red-team-pager {
                display: none;
            }
        }
    }
}
</style>
