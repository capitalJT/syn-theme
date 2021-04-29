<template>
    <transition name="slide-up">
        <div class="info-box" v-if="show" :style="infoBoxStyle">
            <h2 class="title" v-html="infoBoxContent.name || 'Name'" />
            <wp-content :html="infoBoxContent.content || ''" />
        </div>
    </transition>
</template>

<script>
export default {
    computed: {
        show() {
            return this.$store.state.showInfoBox
        },
        infoBoxStyle() {
            return {
                top: `${this.$store.state.infoBoxY}px`,
                left: `${this.$store.state.infoBoxX}px`
            }
        },
        infoBoxContent() {
            return {
                name: this.$store.state.infoBoxTitle,
                content: this.$store.state.infoBoxContent
            }
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

$background: #061123;
$body: #535f75;
$x: calc(-100vw + 10%);

.info-box {
    position: absolute;
    background: $background;
    color: $body;
    width: 200px;
    padding: 20px;
    transform: translate($x, -50%);
    z-index: 50;

    .title {
        margin-top: 0;
        margin-bottom: 10px;
        font-size: 12px;
        color: $white;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .wp-content {
        font-size: 12px;
        line-height: 1.5;

        & > *:first-child {
            margin-top: 0;
        }
        & > *:last-child {
            margin-bottom: 0;
        }
    }

    // animation
    &.slide-up-enter,
    &.slide-up-leave-to {
        opacity: 0;
        transform: translate($x, -40%);
    }
    &.slide-up-enter-active,
    &.slide-up-leave-active {
        transition-duration: 0.25s;
    }

    @media #{$lt-phone} {
        transform: translate(-50%, -110%);

        &.slide-up-enter,
        &.slide-up-leave-to {
            opacity: 0;
            transform: translate(-50%, -40%);
        }
    }
}
</style>
