<template>
    <main class="view-products">
        <!-- landing -->
        <landing-section :title="title" :content="content" />

        <!-- pancake graphic -->
        <transition name="load-fade" appear>
            <products-solutions-graphic />
        </transition>

        <!-- pillars graphic -->
        <products-pillars-graphic />

        <!-- "our promise" carousel -->
        <products-results />
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
        title() {
            return _get(this.pageData, 'title')
        },
        content() {
            return _get(this.pageData, 'content')
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';
$gradient-bottom: #edf4ff;

body.page-template-template-products #app {
    background-color: $navy;
    min-height: 100vh;
}

.view-products {
    background: linear-gradient(to bottom, $white, $gradient-bottom);

    // fade transition
    .fade-enter-active,
    .fade-leave-active {
        transition: opacity 150ms;
    }
    .fade-enter,
    .fade-leave-to {
        opacity: 0;
    }
}
</style>
