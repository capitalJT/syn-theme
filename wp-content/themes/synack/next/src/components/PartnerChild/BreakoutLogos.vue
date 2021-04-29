<template>
    <section class="partner-child-breakout-logos">
        <div class="contained" v-in-view>
            <ul class="awards-grid">
                <li
                    v-for="(award, i) in items"
                    v-if="award.image"
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
        items: {
            type: Array,
            default: () => []
        }
    },
    methods: {
        getAwardLogo(award) {
            return _get(award, 'image.sizes.large', '')
        },
        awardUrl(award) {
            return _get(award, 'link', '')
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

.partner-child-breakout-logos {
    padding: 0 $desktop-padding 140px;
    position: relative;
    width: 100%;

    // investors
    .awards-grid {
        grid-template-columns: repeat(5, 1fr);
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
    .partner-child-breakout-logos {
        padding-right: $mobile-padding;
        padding-left: $mobile-padding;
        padding-bottom: 60px;
        padding-top: 70px;

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
