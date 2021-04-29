<template>
    <section
        :class="['company-page-initiatives', { 'hide-filter': hideFilter }]"
    >
        <div class="gradient" />

        <div class="contained information">
            <wp-content class="info-wrap entry" :html="content" />

            <div class="controls" v-if="!$store.getters.isMobile">
                <button
                    @click="goPrev"
                    class="nav prev"
                    :disabled="atFirstSlide"
                >
                    <svg-carousel-arrow-left />
                </button>
                <button
                    @click="goNext"
                    class="nav next"
                    :disabled="atLastSlide"
                >
                    <svg-carousel-arrow-right />
                </button>
            </div>
        </div>
        <div class="initiatives-carousel">
            <div class="carousel-placeholder" />
            <company-page-slide
                v-for="(slide, i) in items"
                :slide="slide"
                :key="i"
            />
        </div>
    </section>
</template>

<script>
import Flickity from 'flickity'

export default {
    props: {
        content: {
            type: String,
            default: ''
        },
        items: {
            type: Array,
            default: () => []
        },
        hideFilter: {
            type: Boolean,
            default: false
        }
    },
    watch: {
        '$store.getters.isMobile'(isMobile) {
            if (isMobile) this.destroyFlickity()
            else this.initFlickity()
        }
    },
    data() {
        return {
            flky: null
        }
    },
    mounted() {
        if (!this.$store.getters.isMobile) {
            this.initFlickity()
        }
    },
    computed: {
        activeIndex() {
            if (this.flky === null) return -1
            return this.flky.selectedIndex
        },
        atFirstSlide() {
            return this.activeIndex === 1
        },
        atLastSlide() {
            return this.activeIndex === this.items.length
        }
    },
    methods: {
        goPrev() {
            this.flky.previous()
        },
        goNext() {
            this.flky.next()
        },
        initFlickity() {
            this.flky = new Flickity('.initiatives-carousel', {
                prevNextButtons: false,
                initialIndex: 1,
                pageDots: false
            })
            this.flky.on('change', i => {
                if (i == 0) this.flky.select(1)
            })
        },
        destroyFlickity() {
            if (this.flky) this.flky.destroy()
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

body.page-template-template-company #app {
    background-color: $navy;
    min-height: 100vh;
}

.company-page-initiatives {
    padding: 100px 0 140px;
    position: relative;
    overflow: hidden;

    // background
    .gradient {
        @include fill;
        background: linear-gradient(
            180deg,
            rgba(255, 255, 255, 1) 0%,
            rgba(238, 245, 255, 1) 100%
        );
    }

    .information {
        padding-right: $desktop-padding;
        padding-left: $desktop-padding;
        margin-bottom: 80px;

        .title {
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 500;
            font-size: 18px;
            color: $red;
            margin: 0;
            margin-bottom: 35px;
        }
        .info-wrap {
            font-size: 20px;
            color: #8694af;
            display: flex;
            flex-direction: column;
            padding: 0 50px;

            & > * {
                // width: 50%;
                margin: 0;
            }
            h3 {
                line-height: 1;
                font-size: 60px;
                color: $navy;
                text-align: left;
            }
            p {
                line-height: 1.5;
                margin-top: 15px;
            }
        }
    }

    .controls {
        transition: opacity 200ms;
        position: absolute;
        margin-left: -50px;
        display: flex;
        left: 100%;
        bottom: 0;

        .nav {
            margin: 0 8px;
        }
        path,
        circle {
            transition: fill 250ms, stroke 250ms;
        }
        .nav:disabled {
            cursor: initial;
        }
        .nav:disabled svg path {
            fill: #c9d5e6;
        }
        .nav:disabled svg circle {
            stroke: #c9d5e6;
        }
    }

    .initiatives-carousel {
        position: relative;

        &:focus {
            outline: none;
        }
    }
    .carousel-placeholder,
    .company-page-slide {
        margin-right: 30px;
    }
    .carousel-placeholder {
        background-image: url('images/patterns/dots.png');
        background-size: 10px;
        min-width: 750px;
        opacity: 0.75;
        height: 500px;
        width: 60%;
    }
}

// Below 1500px, kill the controls
@media only screen and (max-width: 1500px) {
    .company-page-initiatives .controls {
        justify-content: flex-end;
        margin-top: 40px;
        position: static;
    }
    .company-page-initiatives .information {
        margin-bottom: 40px;
    }
}

// mobile breakpoints
@media #{ $lt-phone } {
    .company-page-initiatives {
        padding-bottom: 60px;
        padding-top: 70px;

        .contained {
            padding-right: $mobile-padding;
            padding-left: $mobile-padding;
        }
        .information {
            .title {
                margin-bottom: 0;
            }
            .info-wrap {
                flex-direction: column;

                & > * {
                    width: 100%;
                }
                p {
                    padding-right: 0;
                    padding-left: 0;
                }
            }
            .info-wrap h3 {
                font-size: 32px;
                margin: 30px 0;
            }
        }
        .initiatives-carousel {
            padding-right: $mobile-padding;
            padding-left: $mobile-padding;

            .carousel-placeholder {
                display: none;
            }
            .company-page-slide {
                margin-bottom: 25px;
                min-width: initial;
                padding: 50px 30px;
                padding-bottom: 115px;
                height: auto;
                width: 100%;
            }
            .images {
                top: initial;
                height: 115px;
                -webkit-clip-path: polygon(100% 0, 0% 100%, 100% 100%);
                clip-path: polygon(100% 0, 0% 100%, 100% 100%);
            }
            .company-page-slide .slide-content {
                margin-right: initial;
                width: initial;
                position: relative;
                bottom: initial;
                right: initial;
                left: initial;
                top: initial;
                padding: 0;
            }
            .company-page-slide .link-icon {
                display: none;
            }
        }
    }
}
</style>
