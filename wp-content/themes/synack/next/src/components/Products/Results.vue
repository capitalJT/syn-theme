<template>
    <section class="products-results contained">
        <div class="lines-fade">
            <div class="line vertical" />
            <div class="line vertical" />
        </div>

        <div class="title-wrap">
            <div class="line-wrap left" v-in-view>
                <div class="line vertical" />
                <div class="line horizontal" />
                <svg-bullseye />
            </div>
            <h2 class="title">Our Results</h2>
            <div class="line-wrap right" v-in-view>
                <svg-bullseye />
                <div class="line horizontal" />
                <div class="line vertical" />
            </div>
        </div>

        <div class="slideshow-wrap">
            <slide-show
                :slides="cmpSlides"
                :auto="false"
                :index.sync="index"
                :style="{ '--index': index }"
                force-transition="fade"
            >
                <!-- Single slide -->
                <div class="slide" slot="slide" slot-scope="{ slide }">
                    <responsive-image
                        :src="slide.image.url"
                        :alt="slide.image.alt"
                        :fill-space="true"
                    >
                        <div
                            class="content-wrap"
                            v-if="$store.getters.breakpoint != 'mobile'"
                        >
                            <div class="clip-wrap">
                                <h3 class="title" v-html="slide.name" />
                                <wp-content :html="slide.content" />
                            </div>
                        </div>
                    </responsive-image>
                </div>

                <!-- Pagination -->
                <button slot="pagination-item" slot-scope="{ slide }">
                    <span v-html="slide.name" />
                </button>

                <!-- Nav prev -->
                <button slot="nav-prev">
                    <svg-carousel-arrow-left />
                </button>

                <!-- Nav next -->
                <button slot="nav-next">
                    <svg-carousel-arrow-right />
                </button>
            </slide-show>

            <div
                class="slide-content-wrap"
                v-if="$store.getters.breakpoint == 'mobile'"
            >
                <div class="clip-wrap">
                    <h3 class="title" v-html="cmpCurrentSlide.name" />
                    <wp-content :html="cmpCurrentSlide.content" />
                </div>
            </div>
        </div>
    </section>
</template>

<script>
// import { styler, tween } from 'popmotion'

export default {
    data() {
        return {
            pageData,
            index: 0
        }
    },
    computed: {
        cmpSlides() {
            return _get(this, 'pageData.acf.results', [])
        },
        cmpCurrentSlide() {
            return this.cmpSlides[this.index]
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

$inactive-page: #7a72b1;
$body-color: #8695ae;
$accent-color: #ff3655;
$line-color: rgba(#e4e5e9, 0.4);
$max-width: 800px;
$background: #edf4ff;
$pager-width: 230px;

.products-results.contained {
    margin-top: -400px;

    .lines-fade {
        display: flex;
        justify-content: space-between;
        max-width: $max-width;
        height: 180px;
        margin: auto;
        position: absolute;
        right: 0;
        bottom: 100%;
        left: 0;

        .line.vertical {
            background: linear-gradient(to bottom, transparent, $line-color);
        }
    }

    .line {
        background: $line-color;
        height: 1px;

        &.horizontal {
            flex: 1;
        }
        &.vertical {
            width: 1px;
            height: 100%;
            background: linear-gradient(
                to bottom,
                $line-color 0%,
                $line-color calc(50% + 0.5px),
                transparent calc(50% + 0.5px),
                transparent 100%
            );
        }
    }

    .title-wrap {
        display: grid;
        grid-template-columns: 1fr auto 1fr;
        grid-column-gap: 60px;
        max-width: $max-width;
        margin: auto;

        .line-wrap {
            display: flex;
            align-items: center;
        }
        .bullseye use {
            fill: $line-color;
        }
        .bullseye circle:nth-child(2) {
            stroke: $line-color;
        }
    }
    .title {
        font-size: 60px;
        margin: 0;
        text-align: center;
        color: $white;
    }
    .fh-slideshow {
        background-color: #f1f1f1;
        border-radius: 5px;
    }
    .slideshow-wrap {
        position: relative;
        width: calc(100% - 80px);
        margin: auto;
        padding-bottom: 100px;

        .pagination {
            display: flex;
            justify-content: center;
            font-family: $font-display;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 2px;
            font-weight: 400;
            margin-bottom: 40px;
            position: absolute;
            bottom: 100%;
            width: 100%;
            text-align: center;

            .pagination-item {
                position: relative;
                white-space: nowrap;
                text-align: center;

                span {
                    position: relative;

                    &::after {
                        content: '';
                        position: absolute;
                        height: 2px;
                        top: calc(100% + 6px);
                        right: 0;
                        left: 0;
                        background: $accent-color;
                        transform-origin: center left;

                        transition: transform 0.4s;
                        transform: scale(0, 1);
                    }
                }

                button {
                    text-transform: uppercase;
                    letter-spacing: 1px;
                    color: $inactive-page;
                    transition: color 0.3s;
                    position: relative;
                }
            }
            .pagination-item + .pagination-item {
                margin-left: 40px;
            }

            .pagination-item.active {
                span {
                    &::after {
                        transform: scale(1);
                    }
                }
                button {
                    color: $white;
                }
            }
            .not-mobile & .pagination-item:hover,
            .not-mobile & .pagination-item:focus {
                button {
                    color: $white;
                }
            }
        }
        .fh-slideshow {
            margin-top: 95px;
            display: flex;
            flex-direction: column;
            overflow: visible;

            .nav {
                position: absolute;
                top: 0;
                bottom: 0;
                width: 60px;
                height: 60px;
                margin: auto;
                z-index: 5;
                background: $white;
                border-radius: 50%;
                box-shadow: rgba(black, 0.1) 0 12px 34px;
                transition: box-shadow 0.3s;

                circle {
                    stroke: transparent;
                }
                &.prev {
                    left: -30px;
                }
                &.next {
                    right: -30px;
                }

                .not-mobile &:hover,
                .not-mobile &:focus {
                    box-shadow: rgba(black, 0.05) 0 12px 34px;
                }
            }
            .slide-wrap {
                order: 1;
                box-shadow: rgba(#00193e, 0.2) 0 12px 34px;
                position: relative;
                width: 100%;
                height: 0;
                padding-bottom: 56.25%;

                &.fade-leave-active {
                    position: absolute;
                    // transition: opacity 0.4s;
                    // height: initial;
                    // transform: translateY(58px);
                }
                .slide {
                    @include fill;
                }
                .responsive-image {
                    border-radius: 5px;
                    overflow: hidden;

                    .image-sizer {
                        // padding-bottom: 62.5439%;
                    }
                }
                .content-wrap {
                    position: absolute;
                    right: 0;
                    bottom: 0;
                    width: 60%;
                    max-height: 80%;
                    overflow-y: auto;
                    filter: drop-shadow(-10px -10px 25px rgba(black, 0.2));

                    .clip-wrap {
                        background: $white;
                        padding: 55px 40px 65px;

                        clip-path: polygon(
                            30px 0,
                            100% 0,
                            100% 100%,
                            0 100%,
                            0 30px
                        );
                    }
                    .title {
                        color: $black;
                        font-size: 24px;
                        margin: 0;
                        text-align: left;
                        text-transform: uppercase;
                        letter-spacing: 2px;
                    }
                    .wp-content {
                        font-size: 18px;
                        color: $body-color;
                        line-height: 1.5;

                        strong {
                            font-weight: 400;
                            color: $accent-color;
                            text-transform: uppercase;
                            font-size: 16px;
                            letter-spacing: 1px;
                        }
                        p {
                            margin: 40px 0 0;
                        }
                    }
                }
            }
        }
    }

    @media #{$lt-phone} {
        overflow: hidden;
        margin-top: -120px;

        .title {
            font-size: 30px;
        }
        .line,
        .bullseye {
            display: none;
        }
        .slideshow-wrap {
            width: 100%;
            padding: 0 $mobile-padding 50px;
            box-sizing: border-box;
            overflow: hidden;

            .pagination {
                text-align: center;
                margin-left: 50%;
                justify-content: flex-start;
                transform: translateX(calc(-#{$pager-width} * var(--index)));
                transition: transform 0.4s;
                width: initial;
                margin-bottom: 30px;

                .pagination-item {
                    display: inline-block;
                    white-space: nowrap;
                    width: $pager-width;

                    transform: translateX(-50%);
                }
                .pagination-item + .pagination-item {
                    margin-left: 0;
                }
            }
            .fh-slideshow {
                margin-top: 65px;
            }
            .fh-slideshow .slide-wrap {
                box-shadow: none;

                .image-sizer {
                    border-radius: 5px;
                    box-shadow: rgba(#00193e, 0.2) 0 12px 14px;
                }
            }
            .nav {
                display: none;
            }
        }
        .slide-content-wrap {
            position: relative;
            width: 100%;
            background: transparent;
            box-shadow: none;
            text-align: center;

            .title {
                color: $black;
                font-size: 24px;
                margin: 0;
                text-align: left;
                text-transform: uppercase;
                letter-spacing: 2px;
            }
            .wp-content {
                font-size: 18px;
                color: $body-color;
                line-height: 1.5;

                strong {
                    font-weight: 400;
                    color: $accent-color;
                    text-transform: uppercase;
                    font-size: 16px;
                    letter-spacing: 1px;
                }
                p {
                    margin: 40px 0 0;
                }
            }

            .clip-wrap {
                background: transparent;
                padding: 35px 10px 0;
            }
            .title {
                text-align: center;
                font-size: 18px;
            }
            .wp-content > p:first-child {
                margin-top: 15px;
            }
            .wp-content p {
                font-size: 16px;

                strong {
                    font-size: 14px;
                }
            }
        }
    }
}
</style>
