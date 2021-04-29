<template>
    <defs>
        <filter
            x="-28.4%"
            y="-47.6%"
            width="156.8%"
            height="195.2%"
            id="map-offset-and-blur"
            filterUnits="objectBoundingBox"
        >
            <feOffset
                dx="0"
                dy="76"
                in="SourceAlpha"
                result="shadowOffsetOuter1"
            ></feOffset>
            <feGaussianBlur
                stdDeviation="36.5"
                in="shadowOffsetOuter1"
                result="shadowBlurOuter1"
            ></feGaussianBlur>
            <feColorMatrix
                values="0 0 0 0 0.055421526   0 0 0 0 0.167456028   0 0 0 0 0.349665987  0 0 0 0.182118663 0"
                type="matrix"
                in="shadowBlurOuter1"
                result="shadowMatrixOuter1"
            ></feColorMatrix>
            <feMerge>
                <feMergeNode in="shadowMatrixOuter1"></feMergeNode>
                <feMergeNode in="SourceGraphic"></feMergeNode>
            </feMerge>
        </filter>
        <linearGradient
            x1="-1.11022302e-14%"
            y1="50%"
            x2="100%"
            y2="50%"
            id="map-linear-gradient"
        >
            <stop stop-color="#C4CFE0" offset="0%"></stop>
            <stop stop-color="#6D82A3" offset="100%"></stop>
        </linearGradient>

        <linearGradient id="hydra-gradient" x1="0" x2="0" y1="0" y2="1">
            <stop offset="0%" stop-color="#ff3655" stop-opacity="0.4" />
            <stop offset="100%" stop-color="#ff3655" stop-opacity="0" />
        </linearGradient>

        <mask id="journey-mask">
            <polygon fill="#fff" points="422,100 944,400 422,700 -100,400" />
        </mask>
    </defs>
</template>
