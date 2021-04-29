<template>
    <section class="shared-promise-carousel">
        <div class="contained">
            <div class="stage">
                <div class="meta" v-html="testimonialsContent" />
                <div class="shadow" />
                <div class="carousel">
                    <transition name="carousel" mode="out-in" :duration="700">
                        <div class="active-quotation" :key="activeQuotation">
                            <svg-quotation-left />
                            <span class="text">{{ activeTestimonial }}</span>
                            <svg-quotation-right />
                        </div>
                    </transition>
                    <button class="nav prev" @click="goPrev">
                        <svg-carousel-arrow-left />
                    </button>
                    <button class="nav next" @click="goNext">
                        <svg-carousel-arrow-right />
                    </button>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            pageData,
            activeQuotation: 0
        }
    },
    computed: {
        testimonials() {
            return _get(this.pageData, 'acf.testimonials', [])
        },
        testimonialsContent() {
            return _get(this.pageData, 'acf.testimonials_content')
        },
        activeTestimonial() {
            return _get(
                this.testimonials,
                `[${this.activeQuotation}].quotation`,
                ''
            )
        }
    },
    methods: {
        goNext() {
            this.activeQuotation =
                (this.activeQuotation + 1) % this.testimonials.length
        },
        goPrev() {
            let prevIdx = this.activeQuotation - 1
            if (prevIdx < 0) prevIdx = this.testimonials.length - 1
            this.activeQuotation = prevIdx
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/easings';
@import 'src/styles/vars';

$quote-color: #535f75;

.shared-promise-carousel {
    padding: 120px $desktop-padding 60px;
    position: relative;
    margin-top: -120px;
    overflow: hidden;

    .stage {
        background-color: $white;
        box-shadow: 0px 12px 34px 0 rgba(0, 25, 62, 0.14);
        margin-top: -120px;
        padding: 60px;
    }
    .meta {
        padding-bottom: 50px;
        text-align: center;
        font-size: 20px;
        color: #91a0b6;
        margin: auto;
        line-height: 1.5;

        h3 {
            font-size: 60px;
            color: $navy;
            margin: 0;
        }
        p {
            max-width: 700px;
            margin-right: auto;
            margin-left: auto;
        }
    }
    .shadow {
        background-image: url('images/carousel-shadow.png');
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        height: 33px;
        max-width: 740px;
        width: 100%;
        margin: auto;
    }
    .carousel {
        line-height: 1.6;
        padding: 30px 120px 25px;
        color: $quote-color;
        text-align: center;
        position: relative;
        min-height: 220px;
        font-size: 20px;
        display: flex;

        .active-quotation {
            max-width: 720px;
            margin: auto;
        }
        .svg-quotation-left {
            margin-right: 10px;
            margin-left: -45px;
        }
        .svg-quotation-right {
            vertical-align: bottom;
            position: relative;
            margin-left: 10px;
            margin-right: -45px;
            top: 0.5em;
        }
        .nav {
            position: absolute;
            margin-top: -30px;
            font-size: 0;
            top: 50%;

            &.prev {
                left: 0;
            }
            &.next {
                right: 0;
            }

            path {
                transition: transform 250ms ease;
            }
            .not-mobile &.prev:hover path,
            .not-mobile &.prev:focus path {
                transform: translateX(-2px);
            }
            .not-mobile &.next:hover path,
            .not-mobile &.next:focus path {
                transform: translateX(2px);
            }
        }
    }

    // carousel transition
    .carousel-enter-active > *,
    .carousel-leave-active > * {
        transition: opacity 350ms $easeInOutQuad, transform 500ms;
    }
    .carousel-leave-active {
        .text {
            transition-delay: 200ms;
        }
    }
    .carousel-enter > *,
    .carousel-leave-to > * {
        opacity: 0;
    }
    .carousel-enter > * {
        transform: translateY(-10px);
    }
}

// mobile breakpoints
@media #{ $lt-phone } {
    .shared-promise-carousel {
        padding-right: calc(#{$mobile-padding} - 10px);
        padding-left: calc(#{$mobile-padding} - 10px);
        padding-bottom: 40px;
        padding-top: 20px;

        .meta {
            padding-bottom: 30px;
        }
        .meta h3 {
            font-size: 28px;
        }
        .stage {
            margin-top: -20px;
            padding: 25px;
        }

        .carousel {
            padding: 25px 0;
            display: block;

            .nav {
                position: static;
                margin-right: 10px;
                margin-left: 10px;
                margin-top: 30px;
            }
        }
        .active-quotation {
            .svg-quotation-left,
            .svg-quotation-right {
                margin: 0;
            }
            .text {
                display: block;
            }
        }
    }
}
</style>
