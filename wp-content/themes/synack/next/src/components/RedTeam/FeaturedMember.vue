<template>
    <div :class="['red-team-featured-member', { 'bio-opened': bioOpened }]">
        <div class="image-wrap">
            <img
                :src="cmpLandingImage.url"
                :width="cmpLandingImage.width"
                :height="cmpLandingImage.height"
                class="hacker-image"
                data-parallax="-0.1"
            />

            <red-team-glitch-decoration data-parallax="1" />

            <div class="label-wrap">
                <h3 class="label" data-parallax="2">
                    <span>SRT Member</span><br />
                    <span>of the month</span>
                </h3>

                <div class="date" data-parallax="0.4">
                    <span class="year" v-html="cmpYear" />
                    <span class="month">/ {{ cmpMonth }}</span>
                </div>
            </div>
        </div>

        <transition name="fade">
            <aside class="bio" v-show="bioOpened" data-parallax="1">
                <div class="bio-scroll-wrap">
                    <h3 class="title">
                        <span
                            class="name"
                            v-html="pageData.acf.srt_member_name"
                        />
                        <span
                            class="location"
                            v-html="pageData.acf.srt_member_location"
                        />
                    </h3>
                    <wp-content
                        class="stats"
                        :html="pageData.acf.srt_member_stats"
                    />
                    <responsive-image
                        :alt="pageData.acf.srt_member_splash_image.alt"
                        :src="pageData.acf.srt_member_splash_image.url"
                        :width="pageData.acf.srt_member_splash_image.width"
                        :height="pageData.acf.srt_member_splash_image.height"
                        :fill-space="!$store.getters.isMobile"
                        fit="contain"
                        class="image"
                    />
                    <div class="biography-copy">
                        <h4 class="bio-title">Biography</h4>
                        <wp-content
                            class="bio-text"
                            :html="pageData.acf.srt_member_bio"
                        />
                    </div>
                </div>

                <button
                    class="close-bio"
                    @click="bioOpened = false"
                    aria-label="Close bio."
                >
                    <svg-icon-dash />
                </button>
            </aside>
        </transition>

        <button
            :class="['open-bio', { opened: bioOpened }]"
            data-parallax="1"
            @click="bioOpened = !bioOpened"
        >
            <span><svg-icon-cross /></span>
            <span class="label">Open Bio</span>
        </button>
    </div>
</template>

<script>
import Vue from 'vue'

export default {
    data() {
        return {
            pageData,
            bioOpened: false
        }
    },
    computed: {
        cmpYear() {
            const date = this.pageData.acf.srt_member_month
            // get the last digits of the date, which will be the year
            const year = date.match(/\d+$/g)[0]
            // break the year into single digits
            const yearDigits = year.split('')
            // wrap each digit in a span tag, join, and return the result
            return yearDigits.map(d => `<span>${d}</span>`).join('')
        },
        cmpMonth() {
            const months = [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dev'
            ]
            const date = this.pageData.acf.srt_member_month
            const month = date.match(/\/\d+\//)[0].replace('/', '')
            const monthInt = parseInt(month) - 1
            return months[monthInt]
        },
        cmpLandingImage() {
            return _get(this, 'pageData.acf.landing_portrait', {})
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

$transition-duration: 0.4s;
$bio-background-top: rgba(7, 32, 50, 1);
$bio-background-bottom: rgba(70, 98, 121, 0);
$border-top-color: rgba(255, 255, 255, 0);
$border-bottom-color: rgba(15, 249, 228, 0.26);
$gradient-background: linear-gradient(
    $bio-background-top,
    $bio-background-bottom
);
$button-gradient-top: rgba(7, 32, 50, 1);
$button-gradient-bottom: rgba(70, 98, 121, 0);
$gradient-button: linear-gradient(
    $button-gradient-top,
    $button-gradient-bottom
);

@mixin body-styling {
    opacity: 0.7;
}

@mixin hacker-styling {
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 4px;
}

.red-team-featured-member {
    position: absolute;
    right: 30px;
    bottom: 0;
    left: 30px;
    margin: auto;
    max-width: $max-width;
    height: 85%;
    // z-index: 10;

    .image-wrap {
        transition: opacity $transition-duration;
    }
    .hacker-image {
        @include fill;
        width: 100%;
        height: 100%;
        object-fit: contain;
        opacity: 0.8;
        object-position: right bottom;
    }
    .glitch-decoration {
        position: absolute;
        width: 0;
        word-wrap: break-word;
        left: 63%;
        top: 15%;
    }
    .label-wrap {
        position: absolute;
        top: 10%;
        right: 0;
        @include hacker-styling;

        .label {
            font-weight: 400;
            font-family: $font-body;
            box-sizing: border-box;
            position: relative;
            overflow-x: hidden;

            &::before {
                content: '';
                position: absolute;
                top: 0;
                bottom: 1px;
                left: 0;
                width: 1px;
                background: $white;
                z-index: 10;
            }

            & > span {
                display: inline-block;
                border: 1px solid $white;
                padding: 8px 10px 6px;
                // animation: slide-in-featured 0.4s 0.6s forwards;
                // transform: translateX(-100%);

                &:nth-of-type(2) {
                    position: relative;
                    bottom: 1px;
                    animation-delay: 0.8s;
                }
            }
        }
        .date {
            margin-top: 40px;

            .year {
                letter-spacing: 20px;

                span {
                    position: relative;

                    @for $i from 2 through 4 {
                        &:nth-child(#{$i}) {
                            top: 35px * ($i - 1);
                        }
                    }
                }
            }
        }
    }

    // the actual bio
    .bio {
        width: 50%;
        margin: auto;
        position: absolute;
        top: 0;
        right: 0;
        bottom: 117px;
        background: $gradient-background;
        border-radius: 10px;
        padding: 30px 30px 75px;
        border: 1px solid $border-bottom-color;
        box-sizing: border-box;

        .bio-scroll-wrap {
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
            display: grid;
            grid-template-columns: 50% 50%;
            padding: 30px;
            @include fill;
        }

        .title {
            margin: 0;
            font-size: 18px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            line-height: 1.5;
        }
        .name {
            font-weight: 400;
        }
        .location {
            font-family: $font-body;
            font-weight: 400;
            @include body-styling;
        }
        .stats {
            background: transparent;
            @include body-styling;
            text-transform: uppercase;
            line-height: 1.4;
            font-size: 13px;
            letter-spacing: 3px;
            margin-top: 30px;
            grid-column: 1 / span 1;
        }
        .image {
            grid-row: 1 / span 2;
            grid-column: 2 / span 1;
            display: flex;
            align-items: center;
        }
        .biography-copy {
            margin-top: 30px;
            grid-column: 1 / span 2;
            padding-bottom: 75px;

            .bio-title {
                font-weight: 400;
                margin-bottom: 10px;
                text-transform: uppercase;
            }
            .wp-content {
                @include body-styling;
                line-height: 1.4;
            }
        }
    }

    // close bio button
    .close-bio {
        position: absolute;
        right: 0;
        bottom: -21px;
        left: 0;
        width: 42px;
        height: 42px;
        color: $white;
        margin: auto;
        font-size: 0;
        background: $gradient-button;
        border-radius: 50%;
        border: 1px solid $border-bottom-color;
    }

    // open bio button
    .open-bio {
        position: absolute;
        right: 0;
        bottom: 80px;
        left: 50%;
        width: 120px;
        margin: auto;
        color: $white;
        text-align: center;
        @include hacker-styling;
        transition: opacity 0.4s;

        span {
            display: block;
        }
        .label {
            margin-top: 10px;
            transition: opacity $transition-duration;
        }
        .vertical-line {
            transition: transform $transition-duration;
            transform-origin: 9.5px 10px;
            transform: rotate(-90deg);
        }
    }

    // bio-opened state
    &.bio-opened {
        .image-wrap {
            opacity: 0.2;
        }
        .open-bio {
            opacity: 0 !important;

            .vertical-line {
                transform: none;
            }
        }
    }

    @media #{$lt-phone} {
        position: relative;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        min-height: 400px;
        width: 100%;
        padding-bottom: 90px;

        .hacker-image {
            object-fit: contain;
            object-position: center;
        }
        .glitch-decoration {
            top: 60px;
            left: 50px;
        }
        .label-wrap {
            top: 0;
            right: 15px;
        }
        .open-bio {
            bottom: 30px;
            left: 0;
        }

        // Bio
        .bio {
            box-sizing: border-box;
            width: calc(100% - #{$mobile-padding * 2});
            // bottom: 30px;
            // left: 0;
            max-width: 500px;
            position: static;
            padding: 10px;

            .biography-copy {
                padding-bottom: 40px;
            }
            .bio-scroll-wrap {
                position: static;
                padding: 0;

                .image {
                    grid-row: 1 / span 1;
                    grid-column: 1 / span 2;
                    height: 200px;
                    margin: auto;
                    overflow: hidden;

                    .image-sizer {
                        @include fill;
                        padding: 0 !important;
                    }
                }
                .title {
                    grid-row: 2 / span 1;
                    grid-column: 1 / span 2;
                    margin-top: 20px;
                }
                .stats {
                    grid-row: 3 / span 1;
                    grid-column: 1 / span 2;
                    margin-top: 20px;
                }
                .biography-copy {
                    grid-row: 4 / span 1;
                    grid-column: 1 / span 2;
                }
            }
            .close-bio {
                bottom: 68px;
            }
        }

        // opened
        &.bio-opened {
            .image-wrap {
                opacity: 0;
            }
        }
    }
}
</style>
