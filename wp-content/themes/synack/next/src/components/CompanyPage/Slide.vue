<template>
    <a-div
        :class="['company-page-slide', { 'has-content': content }]"
        :href="link"
        :style="styles"
    >
        <div :class="['images']">
            <responsive-image
                v-if="imageSrc"
                class="image"
                :src="imageSrc"
                fill-space
            />
            <div class="overlay" />
        </div>
        <div class="link-icon" v-if="link">
            <svg-arrow-up-right />
        </div>
        <wp-content class="slide-content" :html="content" />
    </a-div>
</template>

<script>
export default {
    props: {
        slide: {
            type: Object,
            required: true
        }
    },
    computed: {
        styles() {
            if (!this.color) return {}
            return {
                '--slide-highlight-color': this.color
            }
        },
        imageSrc() {
            return _get(this.slide, 'image.sizes.heroCarouselSlide')
        },
        link() {
            return _get(this.slide, 'link', '')
        },
        color() {
            return _get(this.slide, 'color', '')
        },
        content() {
            return _get(this.slide, 'content', '')
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

.company-page-slide {
    --slide-highlight-color: #{$navy};
    box-shadow: 0 12px 34px 0 rgba(0, 25, 62, 0.14);
    background-color: $white;
    box-sizing: border-box;
    text-decoration: none;
    padding: 110px 100px;
    position: relative;
    min-width: 750px;
    display: block;
    height: 500px;
    width: 60%;

    &:not(.has-content) {
        padding: 0;

        .images {
            -webkit-clip-path: none !important;
            clip-path: none !important;
        }
    }

    .images {
        -webkit-clip-path: polygon(0 0, 100% 0, 100% 100%, 67% 29%);
        clip-path: polygon(0 0, 100% 0, 100% 100%, 67% 29%);
        @include fill;
    }
    .overlay {
        transition: background 250ms ease;
        background-color: rgba($black, 0.25);
        @include fill;
    }
    .not-mobile .company-page-initiatives:not(.hide-filter) &:hover .images,
    .not-mobile .company-page-initiatives:not(.hide-filter) &:focus .images {
        filter: url(#shared-glitch-filter);
        // background-color: rgba($black, 0.45);
    }

    .link-icon {
        transition: transform 200ms $easeInOutSine;
        position: absolute;
        padding: 35px;
        right: 0;
        top: 0;
    }
    &:hover .link-icon {
        transform: translate(3px, -3px);
    }
    .slide-content {
        padding: 110px 100px;
        position: absolute;
        line-height: 1.6;
        color: #8694af;
        width: 58%;
        bottom: 0;
        left: 0;

        h3 {
            font-weight: 500;
            font-size: 40px;
            line-height: 1;
            color: $navy;
            margin: 0;
        }
        h4 {
            font-family: $font-body;
            font-weight: 400;
            font-size: 24px;
            margin: 15px 0;
            color: $navy;
            color: var(--slide-highlight-color);
        }

        & > *:last-child {
            margin-bottom: 0;
        }
    }
}

// tablet breakpoints
@media only screen and (max-width: 1400px) {
    .company-page-slide {
        .images {
            -webkit-clip-path: polygon(0 0, 100% 0, 100% 100%, 67% 29%);
            clip-path: polygon(0 0, 100% 0, 100% 100%, 77% 19%);
        }
    }
}
</style>
