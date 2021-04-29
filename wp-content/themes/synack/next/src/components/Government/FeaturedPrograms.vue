<template>
    <section class="government-programs">
        <div class="spaced-dots" />

        <!-- Hack the Pentagon -->
        <div
            class="program-wrap contained"
            v-full-height.min
            v-rellax="{ selector: '.pentagon-image-wrap', speed: 6 }"
        >
            <shared-light-dots />

            <div class="pentagon-image-wrap">
                <img
                    src="/wp-content/themes/synack/next/static/images/icon-pentagon-small.png"
                    alt="A stylized graphic of the Pentagon in shades of green."
                    class="pentagon"
                />
                <img
                    src="/wp-content/themes/synack/next/static/images/icon-pentagon-small.png"
                    aria-hidden="true"
                    class="pentagon"
                />
            </div>

            <div class="spacer" />

            <h2 class="title">Programs</h2>

            <wp-content :html="cmpPentagonContent" />

            <div class="spacer line-container" v-in-view>
                <div class="line-down" />
            </div>
        </div>

        <!-- 3D chart w/ crowdsourced hacking revenue -->
        <government-chart-graphic />

        <div class="agency-grid contained">
            <div class="line-wrap" v-in-view>
                <div class="line-down"><svg-bullseye /></div>
            </div>

            <wp-content :html="cmpAgencyContent" class="centered-copy" />

            <ul class="agencies" v-in-view>
                <li class="agency" v-for="(agency, i) in cmpAgencies" :key="i">
                    <shared-fading-border />
                    <img
                        :src="agency.url"
                        :alt="agency.alt"
                        :width="agency.width"
                        :height="agency.height"
                    />
                </li>
            </ul>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            pageData
        }
    },
    computed: {
        cmpAgencies() {
            return _get(this.pageData, 'acf.civilian_agencies', []).map(
                x => x.logo
            )
        },
        cmpPentagonContent() {
            return _get(this.pageData, 'acf.pentagon_content')
        },

        cmpAgencyContent() {
            return _get(this.pageData, 'acf.civilian_agencies_content')
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

$background-gradient-top: #061123;
$background-gradient-bottom: #0e2749;
$accent-green: #48d895;
$body-color: #8694af;
$strong-color: $white;
$body-color: #8694af;
$line-color: #354256;

.government-programs {
    background: linear-gradient(
        $background-gradient-top,
        $background-gradient-bottom
    );
    overflow: hidden;
    padding: 0 20px 250px;
    position: relative;

    .spaced-dots {
        @include fill;
        background-image: url('images/patterns/dots-spaced.png');
        background-size: 80px;
        opacity: 0.1;
    }
    .program-wrap {
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: relative;

        .spacer {
            flex: 1;
            position: relative;

            // line animation
            &.line-container {
                transition: transform 0.4s, opacity 0.4s;
                transform-origin: center top;

                &.below-view:not(.fired-once) {
                    transform: scaleY(0);
                }
            }
            .line-down {
                position: absolute;
                top: 0;
                left: 0;
                bottom: 0;
                width: 1px;
                background: linear-gradient(
                    to bottom,
                    rgba($line-color, 0),
                    rgba($line-color, 1)
                );
            }
        }
        .title {
            color: $accent-green;
            text-transform: uppercase;
            font-size: 18px;
            letter-spacing: 2px;
            font-weight: 400;
            margin: 0;
        }
        .wp-content {
            width: 50%;
            color: $white;

            h3 {
                font-size: 60px;
                font-weight: 700;
                margin: 30px 0;
            }
            p {
                color: $body-color;
                font-size: 20px;
                line-height: 30px;

                strong {
                    color: $strong-color;
                    font-size: 18px;
                    letter-spacing: 2px;
                    text-transform: uppercase;
                    font-weight: 400;
                }
                &:last-child {
                    margin-bottom: 0;
                }
            }
        }
        .pentagon-image-wrap {
            position: absolute;
            left: 20%;
            bottom: 0;

            img {
                opacity: 0.7;
            }
            img + img {
                @include fill;
                animation: glow 5s infinite;
            }
        }
    }
    .wp-content.centered-copy {
        color: $body-color;
        max-width: 750px;
        margin: auto;
        text-align: center;
        line-height: 34px;
        font-size: 24px;

        strong {
            color: $white;
            font-weight: 500;
        }
    }
    .agency-grid {
        .line-wrap {
            height: 240px;
            position: relative;

            &.below-view:not(.fired-once) {
                .line-down {
                    transform: scaleY(0);
                }
            }
        }
        .line-down {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            width: 1px;
            margin: auto;
            background: linear-gradient(
                to bottom,
                rgba($line-color, 0),
                rgba($line-color, 1)
            );
            transition: transform 0.4s 0.2s, opacity 0.4s;
            transform-origin: center top;

            .bullseye {
                position: absolute;
                bottom: 0;
                left: 0;
                transform: translate(-8.5px, 50%);
            }
        }
        .wp-content {
            margin: 40px auto;
        }
        .agencies {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 25px;

            &.below-view:not(.fired-once) .agency {
                transform: translateY(10px);
                opacity: 0;
            }
            .agency {
                width: 100%;
                position: relative;

                @for $i from 1 through 12 {
                    &:nth-child(#{$i}) {
                        transition: transform 0.4s #{$i * 0.1s},
                            opacity 0.4s #{$i * 0.1s};
                    }
                }

                img {
                    width: 100%;
                    height: auto;
                    margin: auto;
                }
            }
        }
    }

    // Mobile
    @media #{$lt-phone} {
        text-align: center;
        padding-bottom: 120px;

        .program-wrap {
            display: block;

            .pentagon-image-wrap {
                top: 0;
                left: 0;
                width: 140%;
                height: auto;
                transform: translate(5%, -9%);

                img {
                    transform: translate(-15%, -30%) !important;
                    width: 100%;
                }
            }
            .title {
                padding: 40vh 20px 0;
            }
            .wp-content {
                padding: 0 20px;
                width: 100%;
                box-sizing: border-box;

                h3 {
                    font-size: 32px;
                }
            }

            // line above chart
            .wp-content + .line-container {
                height: 220px;
                position: relative;

                .line-down {
                    right: 0;
                    margin: auto;
                    height: 220px;
                }
            }
        }

        // agency grid
        .agency-grid {
            .wp-content {
                margin-bottom: 20px;
            }
            .agencies {
                padding: 0 20px;
                grid-template-columns: repeat(2, 1fr);
                grid-gap: 20px;
            }
        }
    }
}
</style>
