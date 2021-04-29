<template>
    <section class="journey-mobile-section">
        <transition name="fade" mode="out-in">
            <!-- Landing -->
            <div class="landing" v-if="isLanding" key="landing">
                <img
                    src="wp-content/themes/synack/next/static/images/header-badge.png"
                    alt="A decorative graphic resembling two crossed blue swords."
                    class="header-badge"
                />
                <wp-content :html="cmpLandingContent" />
                <journey-accented-button @button-clicked="isLanding = false">
                    <span>See How We Work</span>
                </journey-accented-button>

                <img
                    src="/wp-content/themes/synack/next/static/images/map-small.png"
                    width="688"
                    height="408"
                    class="map"
                />
            </div>

            <!-- Slideshow -->
            <journey-mobile-slideshow v-else key="slideshow" />
        </transition>
    </section>
</template>

<script>
export default {
    data() {
        return {
            isLanding: true
        }
    },
    computed: {
        cmpLandingContent() {
            return _get(pageData, 'acf.journey_mobile.landing_content', '')
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

$landing-gradient-start: #fff;
$landing-gradient-end: #edf4ff;
$paragraph-blue: #3e4d66;

.journey-mobile-section {
    position: relative;
    min-height: 730px;
    height: 130vw;

    .landing {
        @include fill;

        background: linear-gradient(
            to bottom,
            $landing-gradient-start,
            $landing-gradient-end
        );
        margin: 0 auto 0;
        padding: 60px $mobile-padding 0;
        text-align: center;
        z-index: 5;

        .header-badge {
            margin: 0 auto 10px;
            display: block;
            width: 100px;
            height: auto;
            position: relative;
            z-index: 5;
        }
        .wp-content {
            position: relative;
            z-index: 5;
            h2 {
                font-size: 60px;
                line-height: 1.1;
                margin: 0 auto 20px;
            }
            h3 {
                font-size: 24px;
                line-height: 1.5;
                margin-bottom: 15px;
            }
            p {
                color: $paragraph-blue;
                line-height: 1.5;
                margin-top: 0;
                font-size: 20px;
            }
        }
        .journey-accented-button {
            margin-top: 20px;
            position: relative;
            z-index: 5;
        }
        .map {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: auto;
        }
    }
}
</style>
