<template>
    <section class="stats" v-in-view.appear="{ onEnter, padding: 0.4 }">
        <slide-show
            @before-enter="prepForAnimation"
            :enter="runAnimation"
            :slides="cmpSlides"
            :css="false"
            :interval="6500"
        >
            <div class="contained" slot="slide" slot-scope="{ slide }">
                <div
                    v-for="(stat, i) in slide"
                    :key="i"
                    :class="['stat-block', { ready }]"
                >
                    <span class="metric" v-html="stat.metric" />
                    <span class="description" v-html="stat.description" />
                </div>
            </div>
        </slide-show>
    </section>
</template>

<script>
import Blast from '../Shared/blast-vanilla/'
import Vue from 'vue'
import { styler, stagger, tween } from 'popmotion'
import _sample from 'lodash/sample'

// outside Vue so we don't have to react to changes
let letters = null

export default {
    data() {
        return {
            entered: false,
            ready: false,
            // every letter below this one will be replaced with a glitch character
            clearLetterIndex: -1
        }
    },
    async mounted() {
        // wait for render
    },
    computed: {
        cmpSlides() {
            const pool = _get(this.$store, 'state.pageData.acf.stats', [])
            const output = []

            const statsPerSlide = this.$store.getters.isMobile ? 1 : 3
            let i = 0
            while (i < pool.length) {
                output.push(pool.slice(i, i + statsPerSlide))
                i += statsPerSlide
            }
            return output
        }
    },
    methods: {
        onEnter(el) {
            // only run once
            if (this.entered) return
            this.entered = true

            // if our letters are populated, fade them in
            // if (letters) {
            //     this.fadeInLetters()
            // }
        },
        prepForAnimation(slide) {
            // blast stats
            const blocks = [...slide.querySelectorAll('.stat-block')]
            blocks.forEach(
                block =>
                    new Blast(block, {
                        delimiter: 'letter'
                    })
            )

            // get all stat letters, including their original text
            // and a function to run their own glitch timeouts
            const glitchPool = '?*()<>#@!$1234567890-_.abcdef'.split('')
            letters = [...slide.querySelectorAll('.blast')].map(
                (letterEl, i) => {
                    const originalText = letterEl.innerHTML
                    return {
                        el: letterEl,
                        originalText,
                        resetToOriginal: function() {
                            // glitchy animation - run through a couple glitch characters,
                            // then reset to the original text
                            this.el.classList.add('fixed-width')
                            this.el.innerHTML = _sample(glitchPool)
                            setTimeout(() => {
                                this.el.innerHTML = _sample(glitchPool)
                            }, 100)
                            setTimeout(() => {
                                this.el.innerHTML = _sample(glitchPool)
                            }, 200)
                            setTimeout(() => {
                                this.el.innerHTML = this.originalText
                                this.el.classList.remove('fixed-width')
                            }, 300)
                        }
                    }
                }
            )

            // set all letters to invisible
            letters.forEach(letter => {
                letter.el.style.opacity = 0
            })
        },
        runAnimation(slide, done) {
            this.clearLetterIndex = 0

            // styler for each letter
            const stylers = letters.map(letter => styler(letter.el))

            // prep the fade-in
            const fadeIn = tween({
                from: { opacity: 0 },
                to: { opacity: 1 },
                duration: 80
            })

            // fade-in per letter
            const sequence = new Array(letters.length).fill(fadeIn)

            // fade in sequentially
            stagger(sequence, 10).start({
                update: values => {
                    values.forEach((v = null, i) => {
                        if (v != null) {
                            stylers[i].set(v)

                            // if the last clear letter index is below this index,
                            // increment the last clear letter index
                            if (this.clearLetterIndex < i) {
                                this.clearLetterIndex = i
                                if (letters[i]) {
                                    letters[i].resetToOriginal()
                                }
                            }
                        }
                    })
                },
                complete: done
            })
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

$gradient-purple: #390577;
$gradient-blue: #1c48bf;

.front-page .stats {
    background: linear-gradient(to right, $gradient-purple, $gradient-blue);
    color: $white;
    height: 240px;
    position: relative;

    .fh-slideshow {
        @include fill;
    }
    .contained {
        max-width: 1250px;
        margin: auto;
        display: flex;
        padding: 0 30px;
    }
    .stat-block {
        display: flex;
        flex-direction: column;
        text-align: center;
        margin: 65px auto 80px;

        & + .stat-block {
            margin-left: 20px;
        }
        .fixed-width {
            display: inline-block;
        }
    }
    .metric {
        font-size: 60px;
        font-family: $font-display;
        white-space: nowrap;
        font-weight: 700;

        .fixed-width {
            width: 30px;
        }
    }
    .description {
        font-size: 20px;
        white-space: nowrap;

        .fixed-width {
            width: 9px;
        }
    }
}
</style>
