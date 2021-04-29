<template>
    <svg
        width="282px"
        height="248px"
        viewBox="0 0 282 248"
        version="1.1"
        xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink"
        class="journey-legend"
    >
        <g class="graphic-wrap">
            <!-- Triangle wrap -->
            <path
                d="M241.287196,84.6468416 C255.990079,59.1806005 256.065385,59.0501648 279.319905,18.7719969 C284.008328,10.6515441 278.147261,0.5 268.770916,0.5 L12.6999157,0.5 C3.32289906,0.5 -2.53766085,10.6512596 2.15092887,18.7720007 C26.7434005,61.3675791 26.8291896,61.5161708 40.5793494,85.3322402 M74.0534176,143.311256 C95.6101156,180.648699 95.8451619,181.055813 130.185927,240.535997 C134.874476,248.656668 146.596356,248.656668 151.284903,240.536001 C185.974893,180.450939 186.227363,180.013645 205.099405,147.326181"
                stroke="#535F75"
                fill-opacity="0"
                fill="#E4E5E9"
            ></path>

            <!-- Score text and graphic -->
            <g transform="translate(72, 15)" class="score-wrap">
                <text
                    font-family="CriqueGrotesk-Medium, Crique Grotesk"
                    font-size="21"
                    font-weight="400"
                    line-spacing="12"
                    letter-spacing="3"
                    fill="#FFFFFF"
                    textLength="48"
                >
                    <tspan x="44" y="19">ARS</tspan>
                </text>

                <!-- Score badge -->
                <g transform="translate(0, 27)">
                    <journey-score-badge width="141" height="121" />
                </g>
            </g>

            <!-- Vulns -->
            <g
                transform="translate(2, 96)"
                :class="['vulns', 'score', { active: vulnsActive }]"
            >
                <rect
                    stroke="#535F75"
                    fill="#002035"
                    x="0.5"
                    y="0.5"
                    width="80"
                    height="25"
                    rx="12.5"
                ></rect>
                <text
                    font-family="CriqueGrotesk-Medium, Crique Grotesk"
                    font-size="10"
                    font-weight="400"
                    letter-spacing="3"
                    fill="#535F75"
                    textLength="51"
                >
                    <tspan x="17.7383402" y="41.7846097">
                        VULNS
                    </tspan>
                </text>
                <text
                    font-family="CriqueGroteskDisplay-Medium, Crique Grotesk Display"
                    font-size="20"
                    font-weight="400"
                    fill="#535F75"
                >
                    <tspan x="20.5766605" y="19.7846097">
                        {{ displayVulns }}
                    </tspan>
                </text>
            </g>

            <!-- Patches -->
            <g
                transform="translate(200, 96)"
                :class="['patches', 'score', { active: patchesActive }]"
            >
                <rect
                    id="Rectangle"
                    stroke="#0B7D72"
                    fill="#002035"
                    x="0.5"
                    y="0.5"
                    width="80"
                    height="25"
                    rx="12.5"
                ></rect>
                <text
                    font-family="CriqueGrotesk-Medium, Crique Grotesk"
                    font-size="10"
                    font-weight="400"
                    letter-spacing="3"
                    fill="#13F7E2"
                    textLength="57"
                >
                    <tspan x="9.14794922" y="42">PATCHES</tspan>
                </text>
                <text
                    font-family="CriqueGroteskDisplay-Medium, Crique Grotesk Display"
                    font-size="20"
                    font-weight="400"
                    fill="#13F7E2"
                >
                    <tspan x="21.0366605" y="19.7846097">
                        {{ displayPatches }}
                    </tspan>
                </text>
            </g>

            <!-- Struts -->
            <g
                transform="translate(42, 27) scale(-1, 1) translate(-42, -27) translate(14, 9)"
                stroke="#535F75"
                class="top-left strut"
            >
                <path d="M52.1493643,4 L3,33.1758377"></path>
                <circle
                    fill="#002035"
                    cx="52.2613"
                    cy="3.62763765"
                    r="2.5"
                ></circle>
                <circle
                    fill="#002035"
                    cx="3.2613"
                    cy="32.6276377"
                    r="2.5"
                ></circle>
            </g>
            <g
                transform="translate(138, 171)"
                stroke="#535F75"
                class="middle strut"
            >
                <path d="M3.5,55.639 L3.5,3" id="Stroke-5"></path>
                <circle fill="#002035" cx="3.5" cy="3.5" r="3"></circle>
                <circle fill="#002035" cx="3.5" cy="55.5" r="3"></circle>
            </g>
            <g
                transform="translate(213.738700, 9.372362)"
                stroke="#535F75"
                class="top-right strut"
            >
                <path d="M52.1493643,4 L3,33.1758377"></path>
                <circle
                    fill="#002035"
                    cx="52.2613"
                    cy="3.62763765"
                    r="2.5"
                ></circle>
                <circle
                    fill="#002035"
                    cx="3.2613"
                    cy="32.6276377"
                    r="2.5"
                ></circle>
            </g>
        </g>
    </svg>
</template>

<script>
export default {
    computed: {
        vulnsActive() {
            return this.$store.state.journey.vulns.length
        },
        patchesActive() {
            return this.$store.state.journey.appliedPatches.length
        },
        displayVulns() {
            return this.$store.state.journey.vulns.length
                .toString()
                .padStart(3, '0')
        },
        displayPatches() {
            return this.$store.state.journey.appliedPatches.length
                .toString()
                .padStart(3, '0')
        }
    }
}
</script>

<style lang="scss">
$gray: #535f75;
$red: #ff3655;
$teal: #13f7e2;

.journey-legend {
    rect {
        transition: stroke 0.3s;
    }
    text {
        transition: fill 0.3s;
        font-family: 'Crique Grotesk';
    }

    .score {
        rect {
            stroke: $gray;
        }
        text {
            fill: $gray;
        }
    }
    .vulns,
    .patches {
        rect {
            fill: transparent;
        }
    }
    .vulns.active {
        rect {
            stroke: $red;
        }
        text {
            fill: $red;
        }
    }
    .patches.active {
        rect {
            stroke: $teal;
        }
        text {
            fill: $teal;
        }
    }
}
</style>
