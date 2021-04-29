<template>
    <section
        :class="[
            'partner-child-breakout',
            { 'has-bg-image': cmpBreakoutImage }
        ]"
        v-full-height.min
        v-rellax="{ selector: '.image-wrap', speed: -6 }"
    >
        <div class="waves-decoration" />

        <div v-if="cmpBreakoutImage" class="image-wrap">
            <img
                class="background-logo"
                src="/wp-content/themes/synack/next/static/images/background-srt-logo-blue.png?v=2"
                alt="Synack Red Team logo. A red bird-like shape with wings spread."
                width="1687"
                height="1457"
            />
            <img
                class="background-logo-glow"
                src="/wp-content/themes/synack/next/static/images/background-srt-logo-blue.png?v=2"
                aria-hidden="true"
                width="1687"
                height="1457"
            />
        </div>

        <div class="content-wrap">
            <wp-content :html="cmpBreakoutCopy" v-in-view />
        </div>

        <!-- Logo Grid -->
        <partner-child-breakout-logos
            v-if="cmpBreakoutLogos && cmpBreakoutLogos.length"
            :items="cmpBreakoutLogos"
        />
    </section>
</template>

<script>
export default {
    computed: {
        cmpBreakoutCopy() {
            return _get(this.$store, 'state.pageData.acf.breakout_content', '')
        },
        cmpBreakoutImage() {
            return _get(
                this.$store,
                'state.pageData.acf.breakout_background_image'
            )
        },
        cmpBreakoutLogos() {
            return _get(this.$store, 'state.pageData.acf.breakout_logos') || []
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

$em-color: #777;
$body-color: #8696ad;

.partner-child-breakout {
    background: $indigo;
    color: $white;
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;

    .waves-decoration {
        @include fill;

        background: url('images/patterns/wave.png');
        background-size: 100px;
        opacity: 0.07;
    }
    .image-wrap {
        position: absolute;
        top: 80px;
        right: -40vw;
        bottom: 0;
        left: 60vw;
        margin: auto;

        .background-logo,
        .background-logo-glow {
            height: auto;
            width: 100%;
            object-position: center;
            object-fit: contain;
        }
        .background-logo-glow {
            top: 0;
            left: 0;
            position: absolute;
            opacity: 0.5;
            animation: glow 5s infinite;
        }
    }
    .content-wrap {
        max-width: 1200px;
        margin: 0 auto;
        padding: 80px 20px 100px;
        position: relative;
        width: 100%;

        .wp-content {
            & > * {
                max-width: 600px;
                margin-left: 0;
                transition: transform 0.4s, opacity 0.4s;

                .page-id-7339 & {
                    margin-right: auto;
                    margin-left: auto;
                }

                @for $i from 1 through 15 {
                    &:nth-child(#{$i}) {
                        transition-delay: #{0.1s * $i};
                    }
                }
            }

            &.below-view:not(.fired-once) {
                & > * {
                    transform: translateY(50px);
                    opacity: 0;
                }
            }

            p {
                clear: both;
            }
            img.alignleft {
                float: left;
                max-width: 28%;
                margin-right: 40px;
                height: auto;
                clear: both;

                & + p {
                    float: right;
                    margin-top: 0;
                    width: 60%;
                    clear: initial;

                    &::after {
                        content: '';
                        clear: both;
                    }
                }

                @media (max-width: 950px) {
                    float: initial;
                    max-width: initial;
                    margin-right: initial;

                    & + p {
                        float: initial;
                        width: initial;
                        max-width: initial;
                    }
                }
            }

            .learn-more-cta {
                @include shortcode-button($blue, $blue);
                transition: opacity 0.3s;

                &:hover,
                &:focus {
                    opacity: 0.7;
                }
            }
        }

        h5 {
            color: $blue;
            font-size: 16px;
            margin: 0;
            text-transform: uppercase;
            font-weight: 400;
            letter-spacing: 2px;
        }
        h3 {
            margin: 15px auto 0;
            font-size: 60px;

            em {
                font-style: normal;
                color: $em-color;
            }
        }
        p {
            font-size: 18px;
            margin-top: 30px;
            line-height: 1.4;
            color: $body-color;

            em {
                font-style: normal;
                text-transform: uppercase;
                color: $white;
            }
        }
        .single-feature {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 40px;

            &:first-of-type {
                margin-top: 70px;
            }

            svg {
                width: 100px;
            }
            .feature-description {
                width: calc(100% - 140px);

                display: flex;
                flex-direction: column;
                justify-content: space-between;

                .title {
                    font-size: 24px;
                    font-weight: 700;
                }
                .content {
                    line-height: 1.3;
                    color: $body-color;
                    margin-top: 20px;
                }
            }
        }
        .single-feature + p {
            margin-top: 60px;
        }
    }
    &:not(.has-bg-image) {
        flex-direction: column;
    }
    &:not(.has-bg-image) .content-wrap {
        margin-right: auto;
        margin-left: auto;
        max-width: 850px;

        @media #{$lt-phone} {
            padding-top: 60px;
        }
    }

    // Mobile
    @media #{$lt-phone} {
        .image-wrap {
            right: -15vw;
            left: -15vw;
        }

        .content-wrap {
            padding: 310px $mobile-padding 140px;
            max-width: 100%;
            margin: 0;
            text-align: center;

            h3 {
                font-size: 30px;
                white-space: normal;
            }
            p {
                font-size: 16px;
                line-height: 2;
            }

            .single-feature {
                flex-direction: column;

                &:first-of-type {
                    margin-top: 55px;
                }
                .feature-description {
                    width: 100%;
                    margin-top: 30px;

                    .title {
                        font-size: 20px;
                        line-height: 1.8;
                    }
                    .content {
                        font-size: 16px;
                        line-height: 1.8;
                    }
                }
                & + .single-feature {
                    margin-top: 60px;
                }
                & + p {
                    font-size: 20px;
                }
                & ~ p .shortcode-button {
                    border-radius: 40px;
                    width: 49%;
                    box-sizing: border-box;
                    margin: 0;
                }
            }
        }
    }
}
</style>
