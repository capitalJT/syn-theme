<template>
    <svg
        version="1.1"
        xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink"
        x="0px"
        y="0px"
        width="158px"
        height="181px"
        viewBox="0 0 158 181"
        style="enable-background:new 0 0 158 181;"
        xml:space="preserve"
        class="journey-svg-surface-accent"
    >
        <g class="st0">
            <path
                class="st1"
                d="M79.8,2L156,45.6l0,0v5.3v83.6L79,179L2,134.5V50.9v-5.3L79.8,2 M79.8,0c-0.3,0-0.7,0.1-1,0.3L1,43.9
		c-0.6,0.4-1,1-1,1.7v5.3v83.6c0,0.7,0.4,1.4,1,1.7l77,44.5c0.3,0.2,0.7,0.3,1,0.3s0.7-0.1,1-0.3l77-44.5c0.6-0.4,1-1,1-1.7V50.9
		v-5.3c0-0.7-0.4-1.4-1-1.7L80.8,0.3C80.5,0.1,80.1,0,79.8,0L79.8,0z"
            />
            <path
                class="st1"
                d="M79.8,2L156,45.6l0,0v5.3v83.6L79,179L2,134.5V50.9v-5.3L79.8,2 M79.8,0c-0.3,0-0.7,0.1-1,0.3L1,43.9
		c-0.6,0.4-1,1-1,1.7v5.3v83.6c0,0.7,0.4,1.4,1,1.7l77,44.5c0.3,0.2,0.7,0.3,1,0.3s0.7-0.1,1-0.3l77-44.5c0.6-0.4,1-1,1-1.7V50.9
		v-5.3c0-0.7-0.4-1.4-1-1.7L80.8,0.3C80.5,0.1,80.1,0,79.8,0L79.8,0z"
            />
            <path
                class="st1"
                d="M79.8,2L156,45.6l0,0v5.3v83.6L79,179L2,134.5V50.9v-5.3L79.8,2 M79.8,0c-0.3,0-0.7,0.1-1,0.3L1,43.9
		c-0.6,0.4-1,1-1,1.7v5.3v83.6c0,0.7,0.4,1.4,1,1.7l77,44.5c0.3,0.2,0.7,0.3,1,0.3s0.7-0.1,1-0.3l77-44.5c0.6-0.4,1-1,1-1.7V50.9
		v-5.3c0-0.7-0.4-1.4-1-1.7L80.8,0.3C80.5,0.1,80.1,0,79.8,0L79.8,0z"
            />
        </g>
    </svg>
</template>

<script>
export default {}
</script>

<style lang="scss">
.journey-svg-surface-accent {
    transition: opacity 0.4s;

    &:not(.accent) {
        opacity: 0;
    }
    .st1 {
        fill: #ff3655;
    }
    path {
        transform-origin: 79px 90.5px;
        transform: scale(0.4);
        animation: surface-accent 2s infinite;

        & + path {
            animation-delay: 0.2s;

            & + path {
                animation-delay: 0.4s;
            }
        }
    }
}

@keyframes surface-accent {
    0% {
        transform: scale(0.4);
        opacity: 1;
    }
    100% {
        transform: scale(1);
        opacity: 0;
    }
}
</style>
