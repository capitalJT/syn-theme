<template>
    <div class="journey-score">
        <svg-score-background />

        <div class="readout vulns">
            <span class="number">{{ $store.state.journey.vulns.length }}</span>
            <span class="label">Vulns</span>
        </div>

        <div class="readout patches">
            <span class="number">{{
                $store.state.journey.appliedPatches.length
            }}</span>
            <span class="label">Patches</span>
        </div>
    </div>
</template>

<script>
export default {}
</script>

<style lang="scss">
@import 'src/styles/vars';

.journey-score {
    position: relative;
    display: grid;
    grid-template-columns: 1.1fr 1fr;
    width: 262px;
    height: 91px;

    svg {
        @include fill;
        width: 100%;
        height: 100%;

        .corners {
            stroke-dasharray: 16px 52px 16px 254px 16px 54px 16px 254px;
            stroke-dashoffset: 6px;
            animation: corner-spin 2s 1 forwards;
        }
    }

    .readout {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: relative;

        .number {
            font-size: 32px;
            color: $white;
        }
        .label {
            @include game-legend;
            margin-top: 6px;
        }
    }
}

@keyframes corner-spin {
    0% {
        stroke-dashoffset: 6px;
    }
    100% {
        stroke-dashoffset: 684px;
    }
}
</style>
