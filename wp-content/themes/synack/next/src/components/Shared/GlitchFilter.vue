<template>
    <svg
        width="0"
        height="0"
        class="shared-glitch-filter"
        viewBox="0 0 100 56.25"
        aria-hidden="true"
        :key="key"
    >
        <defs>
            <mask id="glitch-mask">
                <rect width="100" height="56.25" fill="black" />
                <rect width="10" height="56.25" fill="white" />
            </mask>

            <filter id="shared-glitch-filter">
                <!-- red -->
                <feColorMatrix
                    in="SourceGraphic"
                    result="rColor"
                    values="1 0 0 0 0
                            0 0 0 0 0
                            0 0 0 0 0
                            0 0 0 1 0"
                />
                <feOffset in="rColor" result="r" dx="0" />

                <!-- green -->
                <feColorMatrix
                    in="SourceGraphic"
                    result="gColor"
                    values="0 0 0 0 0
                            0 1 0 0 0
                            0 0 0 0 0
                            0 0 0 1 0"
                />
                <feOffset in="gColor" result="g" :dx="dxG" :dy="dyG" />

                <!-- blue -->
                <feColorMatrix
                    in="SourceGraphic"
                    result="bColor"
                    values="0 0 0 0 0
                            0 0 0 0 0
                            0 0 1 0 0
                            0 0 0 1 0"
                />
                <feOffset in="bColor" result="b" :dx="dxB" :dy="dyB" />

                <!-- scanline -->
                <feColorMatrix
                    in="SourceGraphic"
                    out="bColor"
                    values="0 0 0 0 0
                            0 0 0 0 0
                            0 0 0 0 0
                            0 0 0 1 0"
                />
                <!-- blend -->
                <feBlend in="r" in2="g" mode="lighten" result="rg" />
                <feBlend in="rg" in2="b" mode="lighten" />
            </filter>
        </defs>
    </svg>
</template>

<script>
const maxDisplace = 20
const halfDisplace = maxDisplace / 2

export default {
    data() {
        return {
            dxG: -10,
            dyG: 5,
            dxB: 10,
            dyB: -5,
            key: 0
        }
    },
    mounted() {
        this.refreshG()
        this.refreshB()
    },
    methods: {
        refreshG() {
            if (this.dxG != 0) {
                this.dxG = 0
                this.dyG = 0
            } else {
                this.dxG = Math.random() * halfDisplace
                this.dyG = Math.random() * -halfDisplace
            }

            // increment key, forcing rerender
            this.key++

            setTimeout(this.refreshG, Math.random() * 800)
        },
        refreshB() {
            if (this.dxB != 0) {
                this.dxB = 0
                this.dyB = 0
            } else {
                this.dxB = Math.random() * maxDisplace - halfDisplace
                this.dyB = Math.random() * maxDisplace - halfDisplace
            }

            // increment key, forcing rerender
            this.key++

            setTimeout(this.refreshB, Math.random() * 800)
        }
    }
}
</script>

<style lang="scss">
.shared-glitch-filter {
    height: 0;
    font-size: 0;
    position: absolute;
}
</style>
