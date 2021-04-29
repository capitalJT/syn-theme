import { transform } from 'popmotion'
const { interpolate } = transform
import _throttle from 'lodash/throttle'

export default {
    data() {
        return {
            clientRect: null,
            rectThrottle: 150,
            normalizedX: 0,
            normalizedY: 0,
            bottomLeft: { x: 0, y: 0 },
            topRight: { x: 1, y: 1 }
        }
    },
    mounted() {
        window.addEventListener(
            'scroll',
            _throttle(this.setRect, this.rectThrottle)
        )
        window.addEventListener(
            'resize',
            _throttle(this.setRect, this.rectThrottle)
        )
        this.$nextTick(this.setRect)
        this.$el.addEventListener('mousemove', this.updateNormalizedCoordinates)
    },
    beforeDestroy() {
        if (this.$el) {
            this.$el.removeEventListener(
                'mousemove',
                this.updateNormalizedCoordinates
            )
        }
    },
    computed: {
        normalizedCoordinates() {
            return { x: this.normalizedX, y: this.normalizedY }
        }
    },
    methods: {
        setRect() {
            if (this.$el && this.$el.getBoundingClientRect)
                this.clientRect = this.$el.getBoundingClientRect()
        },
        updateNormalizedCoordinates(evt) {
            if (!evt || !this.clientRect) return

            const { clientX, clientY } = evt
            const coords = {
                x: clientX - this.clientRect.x,
                y: this.clientRect.height - (clientY - this.clientRect.y)
            }
            this.normalizedX = interpolate(
                [0, this.clientRect.width],
                [this.bottomLeft.x, this.topRight.x]
            )(coords.x)
            this.normalizedY = interpolate(
                [0, this.clientRect.height],
                [this.bottomLeft.y, this.topRight.y]
            )(coords.y)
        }
    }
}
