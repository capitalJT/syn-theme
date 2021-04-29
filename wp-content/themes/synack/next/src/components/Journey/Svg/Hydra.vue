<template>
    <g :class="['journey-svg-hydra', { paused: $store.state.journey.paused }]">
        <g class="line-wrap">
            <g class="full-line">
                <g stroke="#ff3655" stroke-width="2">
                    <path d="M0,0 l560,0" />
                    <rect
                        width="545.5"
                        height="100"
                        stroke="none"
                        fill="url(#hydra-gradient)"
                        class="gradient"
                    />
                </g>
            </g>
            <g class="hydra-line">
                <g transform="translate(-450, -30)">
                    <g class="hydra-bubble">
                        <path
                            class="st2"
                            d="M1029.9,38.5c-0.2-0.9-0.9-1.7-2.1-2.4c-2.9-1.7-7.5-1.7-10.4,0c-1.2,0.7-1.9,1.5-2.1,2.4"
                        />
                        <path
                            class="st3"
                            d="M1022.6,31.7c-4.1,0-7.3,3.3-7.3,7.3h0c0,1.1,0.7,2.2,2.2,3c2.9,1.7,7.5,1.7,10.4,0
                			c1.4-0.8,2.2-1.9,2.2-3C1029.9,35,1026.7,31.7,1022.6,31.7z"
                        />
                        <path
                            class="st4"
                            d="M1029.9,39c0-4.1-3.3-7.3-7.3-7.3s-7.3,3.3-7.3,7.3"
                        />
                        <path
                            class="st4"
                            d="M1022.6,31.7c-4.1,0-7.3,3.3-7.3,7.3h0c0,1.1,0.7,2.2,2.2,3c2.9,1.7,7.5,1.7,10.4,0
                			c1.4-0.8,2.2-1.9,2.2-3C1029.9,35,1026.7,31.7,1022.6,31.7z"
                        />
                    </g>

                    <g class="st5 hydra-text">
                        <defs>
                            <polygon
                                id="SVGID_hydra_line_2_"
                                class="st5"
                                points="1032.6,27.4 1079.7,0 1089,5.3 1041.9,32.7 			"
                            />
                        </defs>
                        <clipPath id="SVGID_hydra_line_3_">
                            <use
                                xlink:href="#SVGID_hydra_line_2_"
                                style="overflow:visible;"
                            />
                        </clipPath>
                        <g class="st6">
                            <polyline
                                class="st7"
                                points="1049,28.6 1039.8,23.2 1038.6,23.9 1042.8,26.3 1037.9,29.1 1033.7,26.7 1032.6,27.4 1041.9,32.7
    				1043,32.1 1038.9,29.7 1043.8,26.8 1047.9,29.2 1049,28.6 			"
                            />
                            <polyline
                                class="st7"
                                points="1050.2,17.1 1048.9,17.9 1050.7,21.9 1050.6,21.9 1043.7,20.9 1042.4,21.7 1051.2,22.9 1055,25.1
    				1056.1,24.4 1052.3,22.2 1050.2,17.1 			"
                            />
                            <path
                                class="st7"
                                d="M1055,15.5l1.8-1c1.1-0.6,2.2-0.9,3.4-0.9c1.2,0.1,2.4,0.4,3.5,1.1c1.1,0.7,1.7,1.3,1.8,2
    				c0.1,0.7-0.4,1.4-1.6,2l-1.7,1L1055,15.5 M1064.7,14c-1-0.6-2-0.9-3-1.1c-1-0.2-2-0.2-3-0.1c-1,0.2-2,0.5-2.8,1l-3,1.7l9.3,5.3
    				l2.8-1.7c0.9-0.5,1.5-1.1,1.8-1.7c0.3-0.6,0.2-1.2-0.1-1.8C1066.4,15.2,1065.7,14.6,1064.7,14"
                            />
                            <path
                                class="st7"
                                d="M1065.4,9.5l2-1.1c0.7-0.4,1.4-0.6,2.1-0.6c0.6,0,1.2,0.2,1.8,0.5c0.6,0.3,0.8,0.7,0.8,1
    				c0,0.4-0.4,0.8-1.1,1.2l-2,1.2L1065.4,9.5 M1079.1,11.1l-5.9-1c0.4-0.5,0.5-0.9,0.3-1.3c-0.2-0.4-0.6-0.8-1.2-1.2
    				c-0.5-0.3-1.1-0.5-1.8-0.7c-0.6-0.1-1.3-0.1-2,0c-0.7,0.1-1.4,0.4-2.1,0.8l-3.1,1.8l9.3,5.3l1.1-0.6l-3.6-2.1l2-1.2
    				c0.1,0,0.2-0.1,0.2-0.1l5.6,1L1079.1,11.1"
                            />
                            <path
                                class="st7"
                                d="M1079.9,6.4l-2.7-3.3l0.1,0l5.6,1.6L1079.9,6.4 M1089,5.3L1076.3,2l-1.1,0.7l5.9,7.3l1.2-0.7l-1.7-2.1
    				l3.7-2.2l3.6,1L1089,5.3"
                            />
                        </g>
                    </g>
                </g> </g
        ></g>

        <!-- <g class="hide-border">
            <polygon
                fill="#001e3e"
                points="421.5,100 1050,-350 0,-350 -88,402"
            />
        </g> -->
    </g>
</template>

<script>
export default {}
</script>

<style lang="scss">
$animation-duration: 4s;

.journey-svg-hydra {
    transition: opacity 0.4s;

    &.paused {
        opacity: 0 !important;
    }

    .line-wrap {
        animation: scan #{$animation-duration} infinite,
            hydra-pulse #{$animation-duration} infinite;
    }

    .full-line {
        transform: rotate(-60deg) skewY(29.5deg);
        transform-origin: 560px 0;
    }
    .hydra-line {
        transform: scale(0.6) translate(370px, 0);
    }
    .gradient {
        animation: gradient-pulse #{$animation-duration} infinite;
    }
    .hydra-bubble {
        transform: translate(-7px, -11px);
    }
    .hydra-text {
        transform: translate(-7px, -11px);

        animation: hydra-pulse #{$animation-duration} infinite;
    }

    .st1 {
        fill: none;
        stroke: #ff3655;
        stroke-width: 2;
        stroke-miterlimit: 10;
    }
    .st2 {
        opacity: 0.4;
        fill: none;
        stroke: #ff3655;
        stroke-width: 0.5;
        stroke-miterlimit: 10;
    }
    .st3 {
        opacity: 0.3;
        fill: #ff3655;
    }
    .st4 {
        fill: none;
        stroke: #ff3655;
        stroke-miterlimit: 10;
    }
    .st5 {
        enable-background: new;
    }
    .st7 {
        fill: #ff3655;
    }
}

@keyframes scan {
    0% {
        transform: translate(465px, 427px);
    }
    100% {
        transform: translate(-269px, 4px);
    }
}

@keyframes hydra-pulse {
    0% {
        opacity: 0;
    }
    10% {
        opacity: 0;
    }
    15% {
        opacity: 1;
    }
    40% {
        opacity: 1;
    }
    48% {
        opacity: 0;
    }
    100% {
        opacity: 0;
    }
}

@keyframes gradient-pulse {
    0% {
        transform: scaleY(0.5);
    }
    25% {
        transform: scaleY(1);
    }
    51% {
        transform: scaleY(0.5);
    }
    100% {
        transform: scaleY(1);
    }
}
</style>
