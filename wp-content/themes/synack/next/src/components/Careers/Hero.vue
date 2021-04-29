<template>
    <section class="careers-hero">
        <!-- Hero and content -->
        <div class="hero">
            <img :src="image.url" class="background" />
            <!-- <div class="gradient" /> -->
            <div class="content" v-html="content" />
        </div>

        <!-- Gallery -->
        <div class="gallery-band">
            <div class="image-wrap" v-for="({ image }, i) in gallery" :key="i">
                <img :src="image.url" />
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props: {
        image: Object,
        content: String,
        gallery: Array
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

.careers-hero {
    .hero {
        position: relative;

        .background {
            width: 100%;
            @include fill;
            height: 100%;
            object-fit: cover;
        }
        .gradient {
            @include fill;
            background: linear-gradient(to top right, #390577, #1c48bf);
            mix-blend-mode: hard-light;
        }
        .content {
            color: $white;
            display: flex;
            justify-content: center;
            flex-direction: column;
            padding: 120px 100px 120px 15px;
            text-align: left;
            max-width: 1200px;
            margin: auto;
            box-sizing: border-box;
            position: relative;

            @media (max-width: 800px) {
                position: relative;
                padding-top: 100px;
                padding-right: 30px;
            }

            h3 {
                font-size: 60px;
                font-weight: 700;
                margin: 0;

                @media (max-width: 800px) {
                    font-size: 32px;
                }
            }
            h4 {
                font-size: 30px;
                font-weight: 500;
                margin: 20px 0;

                @media (max-width: 800px) {
                    font-size: 18px;
                }
            }
            a:only-child {
                @include shortcode-button($white, $white, $black);
                transition: opacity 0.3s;

                &:hover,
                &:focus {
                    opacity: 0.7;
                }
            }
        }
    }
    .gallery-band {
        display: grid;
        width: 100%;
        grid-template-columns: repeat(6, 1fr);

        .image-wrap {
            position: relative;
            height: 0;
            width: 100%;
            padding-bottom: 100%;

            img {
                @include fill;
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
        }
    }
}
</style>
