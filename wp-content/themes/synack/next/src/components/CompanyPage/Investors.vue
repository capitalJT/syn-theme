<template>
    <section class="company-page-investors">
        <div class="gradient" />
        <div class="dots" />

        <div class="contained" v-in-view>
            <div class="titles">
                <h5>Investors</h5>
                <h3>{{ title }}</h3>
            </div>

            <ul class="partner-grid">
                <li
                    v-for="(partner, i) in items"
                    v-if="partner.logo"
                    class="partner-block"
                    :key="i"
                >
                    <component
                        :is="getPartnerUrl(partner) ? 'a' : 'div'"
                        :href="getPartnerUrl(partner)"
                        target="_blank"
                        rel="noreferrer noopener"
                        class="wrapper"
                    >
                        <div
                            class="partner-logo"
                            :style="{
                                backgroundImage: `url(${getPartnerLogo(
                                    partner
                                )})`
                            }"
                        />
                        <div class="description" v-if="partner.description">
                            {{ partner.description }}
                        </div>
                    </component>
                </li>
            </ul>
        </div>
    </section>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            default: ''
        },
        items: {
            type: Array,
            default: () => []
        }
    },
    computed: {
        cmpPartners() {
            return [
                // example - serialized by ACF
                {
                    logoUrl: '//placehold.it/128x128',
                    info: 'Lorem ipsum info.'
                }
            ]
        }
    },
    methods: {
        getPartnerLogo(partner) {
            return _get(partner, 'logo.sizes.large', '')
        },
        getPartnerUrl(partner) {
            return _get(partner, 'url')
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

$border-color: #dfe5f0;

.company-page-investors {
    padding: 150px $desktop-padding 140px;
    position: relative;

    // backgrounds
    .dots {
        background-image: url('images/patterns/dots.png');
        background-size: 8px;
        position: absolute;
        height: 40px;
        right: 0;
        left: 0;
        top: 3px;
    }
    .gradient {
        @include fill;
        background: linear-gradient(
            0deg,
            rgba(255, 255, 255, 1) 0%,
            rgba(238, 245, 255, 1) 100%
        );
    }

    // titles/info
    .titles {
        text-align: center;
        margin: auto;
        margin-bottom: 80px;

        h5 {
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 500;
            font-size: 18px;
            color: $blue;
            margin: 0;
        }
        h3 {
            font-size: 60px;
            margin: 30px 0;
        }
    }

    // investors
    .partner-grid {
        grid-template-columns: 1fr 1fr 1fr;
        list-style-type: none;
        grid-gap: 25px;
        display: grid;
        padding: 0;
        margin: 0;
    }

    .partner-block {
        .wrapper {
            border: 1px solid $border-color;
            background-color: $white;
            border-radius: 10px;
            text-align: center;
            padding: 60px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: $black;
            height: 100%;
            box-sizing: border-box;

            .partner-logo {
                width: 100%;
                max-width: 75%;
                // margin: auto;
                @include contain;
                padding-bottom: 25%;
                // margin-bottom: 10px;
                filter: invert(100%); // REMOVE ME
            }
            .description {
                margin-top: 10px;
            }
        }
    }

    // WIV styling
    .in-view {
        .partner-block {
            transition: opacity 600ms, transform 600ms;
            transition-delay: 400ms;
        }
        @for $i from 1 through 6 {
            .partner-block:nth-child(6n + #{$i}) {
                transition-delay: #{400 + ($i * 75)}ms;
            }
        }
    }
    .below-view {
        .partner-block {
            transform: translateY(10%);
            opacity: 0;
        }
    }
}

// mobile breakpoints
@media #{ $lt-phone } {
    .company-page-investors {
        padding-right: $mobile-padding;
        padding-left: $mobile-padding;
        padding-bottom: 60px;
        padding-top: 70px;

        .dots {
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

        .partner-grid {
            grid-template-columns: 1fr 1fr;
            grid-gap: $mobile-padding;
        }
        .partner-block .wrapper {
            padding: 40px 20px;
        }
        .partner-block .description {
            display: none;
        }
        .partner-block .wrapper .partner-logo {
            margin-bottom: 0;
        }
    }
}
</style>
