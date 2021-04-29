<template>
    <div class="company-page-slideshow">
        <a
            v-for="(slide, i) in cmpSlides"
            class="slide"
            :key="i"
            :href="slide.url"
        >
            <responsive-image class="background-image" :src="slide.imageUrl" />

            <div class="title" v-html="slide.title" />
            <div class="subtitle" v-html="slide.subtitle" />
            <div class="info" v-html="slide.info" />
        </a>
    </div>
</template>

<script>
export default {
    computed: {
        cmpSlides() {
            return [
                // example - will be parsed by ACF
                {
                    title: 'Think Cyber',
                    subtitle: 'Training a Future Cyber Workforce',
                    info: 'The ThinkCyber fellowship (etc)',
                    imageUrl: '//placehold.it/960x540',
                    url: '//google.com'
                }
            ]
        }
    }
}
</script>

<style lang="scss">
.company-page-slideshow {
}
</style>
