<template>
    <div class="platform-slideshow">
        <responsive-image
            :key="`${cmpDisplayIndex}-preview`"
            :src="cmpNextSlide.url"
            :alt="cmpNextSlide.alt"
            :fill-space="true"
            fit="contain"
            :height="cmpNextSlide.height"
            :width="cmpNextSlide.width"
            class="preview"
            ref="preview"
        />

        <transition name="current-slide">
            <responsive-image
                v-for="(slide, i) in cmpSlides"
                v-if="i == cmpDisplayIndex"
                :key="i"
                :src="cmpCurrentSlide.url"
                :alt="cmpCurrentSlide.alt"
                :fill-space="true"
                fit="contain"
                :height="cmpCurrentSlide.height"
                :width="cmpCurrentSlide.width"
                class="current"
                ref="current"
            />
        </transition>
    </div>
</template>

<script>
const lingerTime = 6000

export default {
    data() {
        return {
            pageData,
            index: 0
        }
    },
    mounted() {
        setTimeout(this.nextSlide, lingerTime)
    },
    computed: {
        cmpSlides() {
            return _get(this, 'pageData.acf.platform_slideshow', []).map(
                slide => slide.image
            )
        },
        cmpDisplayIndex() {
            return this.index % this.cmpSlides.length
        },
        cmpCurrentSlide() {
            return this.cmpSlides[this.cmpDisplayIndex]
        },
        cmpNextSlide() {
            const index = (this.cmpDisplayIndex + 1) % this.cmpSlides.length
            return this.cmpSlides[index]
        }
    },
    methods: {
        nextSlide() {
            if (!this || !this.$el) return

            this.index++
            setTimeout(this.nextSlide, lingerTime)
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';
$transition-duration: 0.8s;

.platform-slideshow {
    img {
        object-position: center left !important;
    }

    .current {
        transform: scale(1.05) translateX(5%);
    }

    .current-slide-enter {
        transform: scale(1) translateX(0);
    }
    .current-slide-enter-to {
        transform: scale(1.05) translateX(5%);
    }
    .current-slide-leave-to {
        transform: scale(1.1) translateX(10%);
        opacity: 0;
        z-index: 5;
    }
    .current-slide-enter-active,
    .current-slide-leave-active {
        transition: transform 1s, opacity 1s;
    }
    .current-slide-leave-active {
        z-index: 5;
    }

    @media #{$lt-phone} {
        .responsive-image.preview {
            transform: translateX(-5%);
        }
    }
}
</style>
