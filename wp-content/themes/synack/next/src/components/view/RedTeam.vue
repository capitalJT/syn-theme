<template>
    <main class="view-red-team">
        <!-- landing - basic info & member of the month -->
        <red-team-landing />

        <!-- platform, down to "Earn guaranteed income" section -->
        <red-team-platform />

        <!-- "join team" scrolling animation -->
        <red-team-join-team />
    </main>
</template>

<script>
export default {}
</script>

<style lang="scss">
@import 'src/styles/vars';

body.page-template-template-red-team #app {
    background-color: $navy;
    min-height: 100vh;
}

.view-red-team {
}
</style>
