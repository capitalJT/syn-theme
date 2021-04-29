<template>
    <div class="journey-mobile-slideshow" v-full-height.min>
        <slide-show :slides="cmpSlides" :auto="false" :loop="false">
            <!-- Single slide -->
            <div class="slide" slot="slide" slot-scope="{ slide }">
                <div class="text">
                    <h3 class="title" v-html="slide.title" />
                    <h4 class="subtitle" v-html="slide.subtitle" />
                    <wp-content :html="slide.content" />
                </div>

                <div class="image-wrap">
                    <responsive-image :src="slide.image.url" />
                </div>
            </div>

            <!-- Pagination -->
            <span slot="pagination-item">
                <span class="pagination-wrap">
                    <span class="page-button" />
                </span>
            </span>

            <!-- Arrows -->
            <svg-journey-slideshow-arrow-left slot="nav-prev" />
            <svg-journey-slideshow-arrow-right slot="nav-next" />
        </slide-show>
    </div>
</template>

<script>
export default {
    computed: {
        cmpSlides() {
            return _get(pageData, 'acf.journey_mobile.slides')
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

$background-blue: #002130;
$subtitle: #13f7e2;
$paragraph: #8695ae;
$pagination-color: #8695ae;

.journey-mobile-slideshow {
    background: $background-blue;

    .fh-slideshow {
        @include fill;
        display: flex;
        align-items: flex-start;
        justify-content: center;
        padding-top: 10px;
        box-sizing: border-box;

        // Pagination
        .pagination {
            // position: absolute;
            // top: 10px;
            // right: 0;
            // left: 0;
            display: flex;
            align-items: center;
            justify-content: center;

            .pagination-item {
                display: block;
                padding: 20px 7px;

                .page-button {
                    display: flex;
                    width: 10px;
                    height: 10px;
                    background: transparent;
                    border: 1px solid $pagination-color;
                    border-radius: 50%;
                    transition: background 0.3s, transform 0.3s;
                }

                &.active {
                    .page-button {
                        transform: scale(1.6);
                        background: $pagination-color;
                    }
                }
            }
        }

        // Nav
        .nav {
            padding: 18px 25px;
            position: relative;

            svg > g {
                opacity: 1;
                transition: opacity 0.3s;
            }
        }
        &.first-slide .nav.prev {
            svg > g {
                opacity: 0.2;
            }
        }
        &.last-slide .nav.next {
            svg > g {
                opacity: 0.2;
            }
        }
        .nav.next {
            order: 1;
        }

        // Slide
        .slide {
            padding-top: 90px;
            display: flex;
            flex-direction: column;
            height: 100%;
            box-sizing: border-box;

            .title {
                margin: 0 auto;
                color: $white;
                font-size: 24px;
                font-weight: 500;
                text-align: center;
                position: relative;
                z-index: 5;
            }
            .subtitle {
                font-size: 16px;
                text-align: center;
                font-weight: 400;
                color: $subtitle;
                text-align: center;
                margin-top: 25px;
                position: relative;
                z-index: 5;
            }
            .wp-content {
                padding: 0 $mobile-padding;
                font-size: 16px;
                line-height: 1.6;
                color: $paragraph;
                text-align: center;
                position: relative;
                z-index: 5;
            }
            .responsive-image {
                flex: 1;
            }
        }
    }

    @media #{$lt-phone-landscape} {
        .fh-slideshow {
            .pagination {
                position: relative;
                z-index: 10;
            }
            .text {
                background: rgba($background-blue, 0.8);
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                z-index: 5;

                .wp-content {
                    color: $white;
                }
            }

            .nav {
                z-index: 10;
            }
            .image-wrap {
                position: absolute;
                @include fill;
            }
        }
    }
}
</style>
