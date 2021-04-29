<template>
    <!-- platform, down to "Earn guaranteed income" section -->
    <section class="red-team-platform" v-full-height.min>
        <shared-light-dots />

        <!-- Main info, including slideshow -->
        <div class="main-info" v-in-view="{ paddingBottom: 0.4 }">
            <div class="copy-wrap">
                <h3 class="label">Our Platform</h3>
                <wp-content :html="cmpPlatformCopy" />
            </div>

            <red-team-platform-slideshow />
        </div>

        <!-- Features grid -->
        <ul class="features-grid" v-in-view="{ paddingBottom: 0.2 }">
            <li
                class="feature-block"
                v-for="(feature, i) in cmpFeatures"
                :key="i"
            >
                <shared-fading-border />
                <div class="feature-logo-wrap">
                    <img
                        :src="feature.image.url"
                        :alt="feature.image.alt"
                        :width="feature.image.width"
                        :height="feature.image.height"
                        class="feature-logo"
                    />
                </div>
                <wp-content :html="feature.content" />
            </li>
        </ul>

        <!-- Levels: Achieve New Heights -->
        <div
            class="section-levels"
            v-in-view.appear="{ paddingBottom: 0.4, onEnter: fadeInLevels }"
        >
            <wp-content :html="cmpLevels" />
            <svg-levels-graphic />
        </div>

        <!-- Guaranteed income -->
        <div class="section-income">
            <div class="graphic-wrap">
                <div class="image-wrap" ref="incomeGraphic">
                    <img
                        src="/wp-content/themes/synack/next/static/images/graphic-income.png"
                        aria-hidden="true"
                        width="1716"
                        height="1280"
                    />
                    <img
                        class="blurred"
                        src="/wp-content/themes/synack/next/static/images/graphic-income-blurred.png"
                        alt="Graphic showing example guaranteed income payments. One says Swift Gazelle - $90, the other Iron Merchant - $240."
                        width="1656"
                        height="1220"
                    />
                </div>
            </div>

            <wp-content :html="cmpIncome" />
        </div>

        <!-- Red gradient decoration -->
        <div class="gradient-bottom" />
    </section>
</template>

<script>
import Vue from 'vue'
import VanillaTilt from '../../libs/vanilla-tilt'
import { styler, stagger, spring } from 'popmotion'

export default {
    data() {
        return {
            pageData,
            fadeInPlayed: false
        }
    },
    async mounted() {
        await Vue.nextTick()

        // tilt effect on the 'guaranteed income' graphic
        VanillaTilt.init(this.$refs.incomeGraphic, {
            glare: false,
            reverse: true,
            reset: false,
            startX: 10,
            startY: 10,
            max: 20,
            'max-glare': 0.3,
            'mouse-event-element': '.red-team-platform'
        })

        // make all badges transparent
        const badges = [...document.querySelectorAll('.section-levels .badge')]
        badges.forEach(badge => {
            styler(badge).set('scale', 0)
        })
    },
    computed: {
        cmpPlatformCopy() {
            return this.pageData.acf.platform_content
        },
        cmpFeatures() {
            return this.pageData.acf.platform_features
        },
        cmpLevels() {
            return this.pageData.acf.levels_content
        },
        cmpIncome() {
            return this.pageData.acf.guaranteed_income_content
        }
    },
    methods: {
        fadeInLevels(el) {
            if (this.fadeInPlayed) return
            this.fadeInPlayed = true

            const badges = [...el.querySelectorAll('.badge')]
            const badgeStylers = badges.map(styler)
            const t = spring({
                from: { scale: 0 },
                to: { scale: 1 },
                damping: 12
            })
            stagger(new Array(badges.length).fill(t), 100).start(values => {
                values.forEach((v = null, i) => {
                    if (v != null) {
                        badgeStylers[i].set(v)
                    }
                })
            })
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

$gradient-start: #000e1a;
$gradient-end: #041829;
$body-color: #8694af;
$contained-max-width: 1100px;
$em-red: #ff3753;
$main-info-padding-top: 160px;

$feature-gray: #8695ae;
$feature-gradient-start: rgba(7, 32, 50, 1);
$feature-gradient-end: rgba(70, 98, 121, 0);
$feature-border: rgba(#0ff9e4, 0.4);

$bottom-gradient-red: #ff3655;

$feature-logo-gradient-start: rgba(0, 11, 21, 1);
$feature-logo-gradient-end: rgba(3, 25, 45, 1);

.red-team-platform {
    position: relative;
    background: linear-gradient($gradient-start, $gradient-end);

    // main info
    .main-info {
        position: relative;
        overflow: hidden;
        transition: transform 0.4s, opacity 0.4s;

        &.below-view:not(.fired-once) {
            transform: translateY(50px);
            opacity: 0;
        }
    }
    .copy-wrap {
        // max-width: $max-width;
        margin: auto;
        padding: $main-info-padding-top 30px;
        max-width: $contained-max-width;
        color: $body-color;

        .label {
            font-size: 18px;
            text-transform: uppercase;
            opacity: 0.4;
            font-weight: 500;
            letter-spacing: 2px;
            margin: 0 auto 15px;
        }
        .wp-content {
            max-width: 40%;

            h3 {
                color: $white;
                font-size: 60px;
                margin: 25px 0 35px;

                em {
                    color: $em-red;
                    font-style: normal;
                    display: block;
                }
            }
            p {
                line-height: 1.5;
                font-size: 20px;
                // color: $body-color;

                em:first-of-type {
                    font-style: normal;
                    color: $white;
                    text-transform: uppercase;
                    letter-spacing: 1px;
                }
            }
        }
    }
    // slideshow
    .platform-slideshow {
        position: absolute;
        top: calc(#{$main-info-padding-top} / 2);
        right: 0;
        bottom: 0;
        width: 100vw;
        transform: translateX(45%);
    }

    // features grid
    .features-grid {
        padding: 0 30px;
        margin: 110px auto 0;
        list-style: none;
        color: $feature-gray;
        max-width: $max-width;

        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-column-gap: 25px;

        &.below-view:not(.fired-once) {
            .feature-block {
                transform: translateY(50px);
                opacity: 0;
            }
        }

        .feature-block {
            text-align: center;
            padding: 30px;
            line-height: 1.4;
            position: relative;
            transition: transform 0.4s, opacity 0.4s;

            @for $i from 1 through 8 {
                &:nth-child(#{$i}) {
                    transition-delay: #{$i * 0.1s};
                }
            }

            .feature-logo-wrap {
                width: 120px;
                height: 120px;
                margin: 10px auto 40px;
                background: linear-gradient(
                    $feature-logo-gradient-start,
                    $feature-logo-gradient-end
                );
                border-radius: 50%;
                position: relative;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .feature-logo {
                width: 40%;
                height: auto;
            }
            strong {
                display: block;
                color: $white;
                margin-bottom: 25px;
                font-size: 20px;
                font-weight: 500;
            }
        }
    }

    // levels section
    .section-levels,
    .section-income {
        padding: 0 30px;
        margin: 140px auto 0;
        color: $feature-gray;
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: $max-width;

        .wp-content {
            width: 50%;
            font-size: 18px;
            line-height: 28px;

            h3 {
                margin: 0 0 30px;
                font-size: 40px;
                color: $white;
                font-weight: 500;
                line-height: 1.3;
            }
            strong {
                font-size: 18px;
                text-transform: uppercase;
                color: $white;
                font-weight: 400;
                letter-spacing: 1px;
            }
        }
        svg {
            width: 35%;
            height: auto;

            // .badge {
            //     opacity: 0;
            // }
        }
        .graphic-wrap {
            width: 35%;
            position: relative;

            .image-wrap {
                transform-style: preserve-3d;
                overflow: visible;
            }
            img {
                width: 100%;
                height: auto;
                transform: translateZ(50px);
            }
            img.blurred {
                @include fill;
                transform: scale(1.07);
                opacity: 0.5;
            }
        }
    }
    .svg-levels-graphic {
        transform: translateZ(0);
    }
    .section-income {
        transform: translateZ(0);
        margin-top: 120px;
    }

    // Gradient decoration
    .gradient-bottom {
        margin-top: 55px;
        height: 80px;
        width: 100%;
        background: linear-gradient(
            rgba($bottom-gradient-red, 0),
            rgba($bottom-gradient-red, 0.4)
        );
    }

    @media #{$lt-phone} {
        // landing & bio
        .main-info {
            display: flex;
            flex-direction: column;

            .platform-slideshow {
                position: relative;
                height: 50vh;
                transform: none;
                width: 100vw;
                top: 0;
                margin-top: 70px;

                img {
                    object-position: center center !important;
                }
            }
            .copy-wrap {
                order: 1;
                padding-top: 70px;
                padding-bottom: 70px;
                text-align: center;

                .wp-content {
                    max-width: 100%;

                    h3 {
                        font-size: 40px;
                    }
                    p {
                        line-height: 1.7;
                    }
                }
            }
        }

        // features
        .features-grid {
            margin-top: 0;
            padding: 0 15px;
            display: block;

            .feature-block {
                max-width: 400px;
                margin: auto;

                & + .feature-block {
                    margin-top: 20px;
                }
            }
        }

        // new heights
        .section-levels,
        .section-income {
            flex-direction: column;
            margin-top: 60px;
            text-align: center;

            .wp-content {
                order: 1;
                width: 100%;
                margin-top: 35px;
                font-size: 16px;

                h3 {
                    font-size: 30px;
                    margin: 0 0 25px;
                }
                strong {
                    font-size: 14px;
                }
            }
            svg,
            .graphic-wrap {
                width: 100%;
                max-width: 300px;
            }
        }
    }
}
</style>
