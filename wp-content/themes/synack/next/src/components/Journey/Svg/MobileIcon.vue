<template>
    <svg
        width="54px"
        height="53px"
        viewBox="0 0 54 53"
        version="1.1"
        xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink"
    >
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g transform="translate(-503.000000, -654.000000)">
                <g transform="translate(461.000000, 611.000000)">
                    <g transform="translate(31.667777, 32.000000)">
                        <g transform="translate(11.000000, 11.000000)">
                            <circle
                                stroke="#FFFFFF"
                                stroke-width="2"
                                opacity="0.300000012"
                                cx="26.5"
                                cy="26.5"
                                r="25.5"
                            ></circle>
                            <circle
                                stroke-dasharray="10px"
                                stroke="#FFFFFF"
                                stroke-width="2"
                                cx="26.5"
                                cy="26.5"
                                r="25.5"
                                class="circle-solid"
                                :style="cmpDashOffset"
                            ></circle>
                            <path
                                d="M34.8285714,15.5971429 C34.8285714,14.0917724 33.642126,12.8714286 32.1785714,12.8714286 L21.5785714,12.8714286 C20.1150168,12.8714286 18.9285714,14.0917724 18.9285714,15.5971429 L18.9285714,37.4028571 C18.9285714,38.9082276 20.1150168,40.1285714 21.5785714,40.1285714 L32.1785714,40.1285714 C33.642126,40.1285714 34.8285714,38.9082276 34.8285714,37.4028571 L34.8285714,15.5971429 Z M32.1785714,34.6771429 L21.5785714,34.6771429 L21.5785714,18.3228571 L32.1785714,18.3228571 L32.1785714,34.6771429 Z"
                                fill="#FFFFFF"
                                fill-rule="nonzero"
                            ></path>
                        </g>
                    </g>
                </g>
            </g>
        </g>
    </svg>
</template>

<script>
export default {
    props: {
        progress: {
            type: Number,
            default: 0
        }
    },
    computed: {
        cmpDashOffset() {
            let offset = (1 - this.progress) * 160
            offset = Math.max(Math.min(offset, 160), 0)
            return { 'stroke-dashoffset': offset + 'px' }
        }
    }
}
</script>
