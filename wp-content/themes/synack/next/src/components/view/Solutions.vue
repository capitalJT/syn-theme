<template>
    <main class="view-solutions">
        <!-- grid -->
        <products-grid />
    </main>
</template>

<script>
export default {
    mounted() {
        document.body.classList.add('light-theme')
    }
}
</script>

<style lang="scss">
body.page-template-template-solutions {
    #app {
        min-height: 100vh;
    }
    header {
        position: absolute;
    }
}
</style>
