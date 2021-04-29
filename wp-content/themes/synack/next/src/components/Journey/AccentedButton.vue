<template>
    <div class="journey-accented-button">
        <div class="wrap">
            <div class="decoration" />
            <div class="decoration" />
            <div class="decoration" />

            <button class="central-button" @click="$emit('button-clicked')">
                <slot />
            </button>
        </div>
    </div>
</template>

<script>
export default {}
</script>

<style lang="scss">
@import 'src/styles/vars';

.journey-accented-button {
    position: relative;
    display: inline-block;
    margin: 40px auto 15px;

    .wrap {
        position: relative;
    }
    .decoration {
        border-radius: 30px;
        border: 1px solid $blue;
        @include fill;
        animation: highlight-button 1.8s infinite linear;
    }
    .decoration:nth-child(2) {
        animation-delay: 0.6s;
    }
    .decoration:nth-child(3) {
        animation-delay: 1.2s;
    }

    .central-button {
        background: $blue;
        color: $white;
        border-radius: 30px;
        padding: 20px 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0;
        position: relative;

        svg {
            margin-right: 15px;
        }
    }
}

@keyframes highlight-button {
    0% {
        transform: scale(1);
        opacity: 1;
    }
    100% {
        transform: scale(1.15, 1.5);
        opacity: 0;
    }
}
</style>
