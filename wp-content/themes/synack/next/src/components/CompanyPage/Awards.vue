<template>
    <section class="company-page-awards">
        <div class="gradient" />
        <shared-light-dots />

        <div class="contained" v-in-view>
            <div class="titles">
                <h5 v-if="label">{{ label }}</h5>
                <h3 v-if="title">{{ title }}</h3>
            </div>

            <ul class="awards-grid">
                <li
                    v-for="(award, i) in items"
                    v-if="award.logo"
                    class="award-block"
                    :key="i"
                >
                    <component
                        :is="awardUrl(award) ? 'a' : 'div'"
                        :href="awardUrl(award)"
                        target="_blank"
                        rel="noreferrer noopener"
                    >
                        <shared-fading-border />
                        <div
                            class="award-logo"
                            :style="{
                                backgroundImage: `url(${getAwardLogo(award)})`
                            }"
                        />
                    </component>
                </li>
            </ul>
        </div>
    </section>
</template>

<script>
export default {
    props: {
        label: String,
        title: String,
        items: {
            type: Array,
            default: () => []
        }
    },
    methods: {
        getAwardLogo(award) {
            return _get(award, 'logo.sizes.large', '')
        },
        awardUrl(award) {
            return _get(award, 'url', '')
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

.company-page-awards {
    padding: 150px $desktop-padding 140px;
    position: relative;

    // backgrounds
    .gradient {
        @include fill;
        background: linear-gradient(
            180deg,
            rgba(6, 17, 35, 1) 0%,
            rgba(14, 38, 71, 1) 100%
        );
    }

    // titles/info
    .titles {
        text-align: center;
        max-width: 960px;
        margin: auto;
        margin-bottom: 80px;

        h5 {
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 500;
            font-size: 18px;
            color: $red;
            margin: 0;
        }
        h3 {
            font-size: 60px;
            margin: 30px 0;
            color: $white;
        }
    }

    // investors
    .awards-grid {
        grid-template-columns: repeat(4, 1fr);
        list-style-type: none;
        grid-gap: 25px;
        display: grid;
        padding: 0;
        margin: 0;
    }

    .award-block {
        position: relative;
        text-align: center;
        padding: 30px;

        .award-logo {
            margin: auto;
            @include contain;
            padding-bottom: 45%;
            margin-bottom: 10px;
        }
    }

    // WIV styling
    .in-view {
        .award-block {
            transition: opacity 600ms, transform 600ms;
            transition-delay: 400ms;
        }
        $max: 16;
        @for $i from 1 through $max {
            .award-block:nth-child(#{$max}n + #{$i}) {
                transition-delay: #{400 + ($i * 75)}ms;
            }
        }
    }
    .below-view {
        .award-block {
            transform: translateY(10%);
            opacity: 0;
        }
    }
}

// mobile breakpoints
@media #{ $lt-phone } {
    .company-page-awards {
        padding-right: $mobile-padding;
        padding-left: $mobile-padding;
        padding-bottom: 60px;
        padding-top: 70px;

        .dotted {
            display: none;
        }

        .titles {
            margin-bottom: 40px;

            h5 {
                font-size: 18px;
            }
            h3 {
                font-size: 28px;
                margin: 20px 0;
            }
        }

        .awards-grid {
            grid-template-columns: 1fr 1fr;
            grid-gap: $mobile-padding;
        }
        .award-block {
            padding: 20px 15px;

            .shared-fading-border {
                -webkit-mask-image: linear-gradient(
                    0deg,
                    black 40%,
                    rgba(0, 0, 0, 0) 120%
                );
                mask-image: linear-gradient(
                    0deg,
                    black 40%,
                    rgba(0, 0, 0, 0) 120%
                );
            }
        }
    }
}
</style>
