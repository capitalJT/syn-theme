<template>
    <div class="shared-fading-border"></div>
</template>

<script>
export default {}
</script>

<style lang="scss">
@import 'src/styles/vars';

$border-teal: #0b5663;

.shared-fading-border {
    background: linear-gradient(
        to bottom,
        rgba($border-teal, 0.35) 0%,
        rgba($border-teal, 0.05) 100%
    );
    border: 1px solid $border-teal;
    border-radius: 10px;
    @include fill;

    -webkit-mask-image: linear-gradient(
        to top,
        rgba(0, 0, 0, 1) 40%,
        rgba(0, 0, 0, 0.5) 100%
    );
    mask-image: linear-gradient(
        to top,
        rgba(0, 0, 0, 1) 40%,
        rgba(0, 0, 0, 0.5) 100%
    );
}
</style>
