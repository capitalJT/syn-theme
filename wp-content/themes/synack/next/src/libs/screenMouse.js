import { schedule, listen, everyFrame, transform } from 'popmotion'
const { interpolate } = transform
import Vue from 'vue'

export default (opts = {}) => {
    // build out default opts
    opts = {
        bottomLeft: { x: 0, y: 0 },
        topRight: { x: 1, y: 1 },
        ...opts
    }

    return {
        data() {
            return {
                screenMouseScheduler: null,
                screenMouse: { x: 0, y: 0 }
            }
        },
        mounted() {
            this.screenMouseScheduler = schedule(
                everyFrame(),
                listen(window, 'mousemove')
            )
                .pipe(e => {
                    return { x: e.clientX, y: e.clientY }
                })
                .start(({ x, y }) => {
                    Vue.set(
                        this.screenMouse,
                        'x',
                        interpolate(
                            [0, window.innerWidth],
                            [opts.bottomLeft.x, opts.topRight.x]
                        )(x)
                    )
                    Vue.set(
                        this.screenMouse,
                        'y',
                        interpolate(
                            [window.innerHeight, 0],
                            [opts.bottomLeft.y, opts.topRight.y]
                        )(y)
                    )
                })
        },
        beforeDestroy() {
            if (this.screenMouseScheduler) {
                this.screenMouseScheduler.stop()
            }
        }
    }
}
