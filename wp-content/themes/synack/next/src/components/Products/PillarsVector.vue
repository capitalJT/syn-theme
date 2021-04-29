<template>
    <svg
        :class="['products-pillars-vector', active]"
        width="100%"
        height="100%"
        viewBox="0 0 815 1365"
        xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink"
    >
        <g clip-path="url(#pillarclip)">
            <!-- hydra (back) -->
            <image
                class="hydra inactivestate"
                xlink:href="/wp-content/themes/synack/next/static/images/pillars/hydra-inactive.png"
                width="507"
                height="1293"
                x="0"
                y="610"
            />
            <image
                class="hydra activestate"
                xlink:href="/wp-content/themes/synack/next/static/images/pillars/hydra-active.png"
                width="507"
                height="1293"
                x="0"
                y="610"
            />

            <!-- lp -->
            <image
                class="lp inactivestate"
                xlink:href="/wp-content/themes/synack/next/static/images/pillars/LP-inactive.png"
                width="511"
                height="1303"
                x="304"
                y="610"
            />
            <image
                class="lp activestate"
                xlink:href="/wp-content/themes/synack/next/static/images/pillars/LP-active.png"
                width="511"
                height="1303"
                x="304"
                y="610"
            />

            <!-- hydra (front) -->
            <image
                class="hydra-front inactivestate"
                xlink:href="/wp-content/themes/synack/next/static/images/pillars/hydra-inactive-front.png"
                width="507"
                height="1293"
                x="0"
                y="610"
            />
            <image
                class="hydra-front activestate"
                xlink:href="/wp-content/themes/synack/next/static/images/pillars/hydra-active-front.png"
                width="507"
                height="1293"
                x="0"
                y="610"
            />

            <!-- apollo -->
            <image
                class="apollo inactivestate"
                xlink:href="/wp-content/themes/synack/next/static/images/pillars/apollo-inactive.png"
                width="511"
                height="1186"
                x="202"
                y="844"
            />
            <image
                class="apollo activestate"
                xlink:href="/wp-content/themes/synack/next/static/images/pillars/apollo-active.png"
                width="511"
                height="1186"
                x="202"
                y="844"
            />
        </g>

        <clipPath id="pillarclip">
            <polygon points="407 1365, 815 1131, 815 -1000, 0 -1000, 0 1131" />
        </clipPath>
    </svg>
</template>

<script>
export default {
    props: {
        active: {
            type: String
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/easings';
@import 'src/styles/vars';

.products-pillars-vector {
    image {
        transition: transform 600ms $easeInOutQuad, opacity 300ms linear;
    }

    .activestate {
        opacity: 0.15;
    }

    &.hydra-active {
        .hydra.activestate,
        .hydra-front.activestate {
            opacity: 1;
        }
        // .hydra-front.inactivestate,
        // .hydra.inactivestate {
        //     opacity: 0;
        // }
        .hydra,
        .hydra-front {
            transform: translateY(-600px);
        }
    }

    &.lp-active {
        .lp.activestate {
            opacity: 1;
        }
        .lp {
            transform: translateY(-600px);
        }
    }

    &.apollo-active {
        .apollo.activestate {
            opacity: 1;
        }
        .apollo {
            transform: translateY(-600px);
        }
    }
}
</style>
