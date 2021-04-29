<template>
    <main class="front-page">
        <!-- globe graphic, landing text -->
        <front-page-landing />

        <!-- stats -->
        <front-page-stats />

        <!-- Your journey with Synack -->
        <journey-section v-if="!$store.getters.isMobile" key="desktop" />
        <journey-mobile-section v-else key="mobile" />

        <!-- SRT info -->
        <front-page-red-team />

        <!-- Results -->
        <front-page-results />
    </main>
</template>

<script>
export default {
    data() {
        return {
            pageData: pageData
        }
    },
    computed: {
        content() {
            return _get(this.$store.state, 'pageData.content', '')
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

body.home #app {
    background-color: $navy;
    min-height: 100vh;
}

main.front-page {
    h1 {
        font-size: 5em;
    }
}
</style>
