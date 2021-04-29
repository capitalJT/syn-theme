<template>
    <g class="journey-svg-map">
        <image
            xlink:href="/wp-content/themes/synack/next/static/images/journey-map3.png"
            height="781"
            width="1142"
        />
        <polygon
            class="hover-area"
            points="599,165 1150,475 599,800 0,475"
            fill="transparent"
            @mousemove="updateMouse"
        />

        <svg
            version="1.1"
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            x="0"
            y="0"
            :transform="`translate(${mouseX},${mouseY})`"
            width="89.4px"
            height="52px"
            viewBox="0 0 89.4 52"
            style="enable-background:new 0 0 89.4 52;"
            xml:space="preserve"
            class="map-cursor"
        >
            <g id="XMLID_cursor_1_">
                <ellipse
                    id="XMLID_cursor_10_"
                    class="st0"
                    cx="44.7"
                    cy="26"
                    rx="44.2"
                    ry="25.5"
                />
                <path
                    id="XMLID_cursor_9_"
                    class="st1"
                    d="M29.1,17l8.9,5.2c-3.7,2.1-3.7,5.6,0,7.7s9.7,2.1,13.4,0l8.9,5.2"
                />
                <path
                    id="XMLID_cursor_8_"
                    class="st1"
                    d="M60.3,35c8.6-5,8.6-13.1,0-18s-22.6-5-31.2,0l-6.7-3.9C10,20.2,10,31.8,22.4,38.9
		s32.3,7.1,44.6,0L60.3,35z"
                />
                <line
                    id="XMLID_cursor_7_"
                    class="st1"
                    x1="67"
                    y1="38.9"
                    x2="72.1"
                    y2="41.9"
                />
                <line
                    id="XMLID_cursor_6_"
                    class="st1"
                    x1="22.4"
                    y1="13.1"
                    x2="17.2"
                    y2="10.2"
                />
                <line
                    id="XMLID_cursor_5_"
                    class="st1"
                    x1="44.7"
                    y1="26"
                    x2="72.1"
                    y2="10.2"
                />
                <line
                    id="XMLID_cursor_4_"
                    class="st1"
                    x1="38"
                    y1="29.9"
                    x2="17.2"
                    y2="41.9"
                />
                <ellipse
                    id="XMLID_cursor_3_"
                    class="st2"
                    cx="44.7"
                    cy="26"
                    rx="3.2"
                    ry="1.8"
                />
                <ellipse
                    id="XMLID_cursor_2_"
                    class="st3"
                    cx="44.7"
                    cy="26"
                    rx="38.8"
                    ry="22.4"
                />
            </g>
        </svg>
    </g>
</template>

<script>
import preloadImage from '../../../libs/preloadImage'

export default {
    data() {
        return {
            mouseX: 0,
            mouseY: 0
        }
    },
    mounted() {
        preloadImage(
            '/wp-content/themes/synack/next/static/images/surface-web-active.png'
        )
        preloadImage(
            '/wp-content/themes/synack/next/static/images/surface-api-active.png'
        )
    },
    methods: {
        updateMouse(evt) {
            const rect = evt.target.getBoundingClientRect()

            const scale = {
                x: this.$store.state.browser.winWidth / rect.width
            }

            this.mouseX = evt.x * scale.x
            this.mouseY = evt.y - 200
        }
    }
}
</script>

<style lang="scss">
.journey-svg-map {
    .hover-area {
        cursor: pointer;
        // cursor: url(/wp-content/themes/synack/next/static/images/target4.svg),
        //     auto;
    }
    image {
        transition: transform 0.4s;
        transform: translate(-150px, 25px) scale(1);
    }
    .map-cursor {
        transition: opacity 0.4s 0.6s;
        display: none;
    }
    .st0 {
        opacity: 0.2;
        fill: none;
        stroke: #ff3655;
        stroke-miterlimit: 10;
    }
    .st1 {
        fill: none;
        stroke: #b2bfd3;
        stroke-miterlimit: 10;
    }
    .st2 {
        fill: #ff3655;
    }
    .st3 {
        fill: none;
        stroke: #ff3655;
        stroke-miterlimit: 10;
    }
}

.is-landing .journey-svg-map {
    .map-cursor {
        opacity: 0;
    }
    .hover-area {
        cursor: initial;
    }
}
</style>
