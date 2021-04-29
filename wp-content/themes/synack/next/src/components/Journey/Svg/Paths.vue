<template>
    <g class="journey-svg-paths">
        <g class="drawn-paths">
            <path
                v-for="(path, i) in drawnPaths"
                :d="path.d"
                :opacity="path.opacity"
            />
        </g>

        <g class="figures">
            <svg
                v-for="(path, i) in drawnPaths"
                version="1.1"
                xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink"
                :x="path.endpoint.x - 5"
                :y="path.endpoint.y - 18"
                :opacity="path.opacity"
                width="10px"
                height="18px"
                viewBox="0 0 20.3 36.5"
                style="enable-background:new 0 0 20.3 36.5;"
                xml:space="preserve"
                class="srt-figure"
            >
                <defs></defs>
                <path
                    class="st0"
                    d="M3.7,16h12.8c1.5,0,2.7,1.2,2.7,2.7c0,0.4-0.1,0.9-0.3,1.2l-7.6,14.8c-0.3,0.7-1.2,0.9-1.8,0.6
            	c-0.3-0.1-0.5-0.3-0.6-0.6L1.3,19.9c-0.7-1.3-0.2-3,1.2-3.7C2.9,16.1,3.3,16,3.7,16z M10.1,11.9c-3,0-5.4-2.4-5.4-5.4S7.1,1,10.1,1
            	s5.4,2.4,5.4,5.4S13.2,11.9,10.1,11.9z"
                />
            </svg>
        </g>

        <!-- draw a line per path for easier debugging -->
        <!-- <path v-for="(path, i) in paths.api" :d="buildPath(path)" :key="i" /> -->
    </g>
</template>

<script>
import _sample from 'lodash/sample'
import { timeline, easing, tween, chain, delay } from 'popmotion'

const spawnInterval = 3000

export default {
    data() {
        return {
            paths: {
                mobile: [
                    [[480, 138], [-55, 14], [-90, 37], [44, 70], [-80, 15]],
                    [
                        [223, 450],
                        [9, -25],
                        [34, -36],
                        [87, -43],
                        [-51, -65],
                        [-46, 26],
                        [-16, -8]
                    ],
                    [[420, 105], [-174, 101], [51, 67]]
                ],
                host: [
                    [[286, 480], [160, -140]],
                    [[350, 505], [135, -18], [-62, -22], [-39, -13]],
                    [[591, 505], [-65, -82], [-36, 9]]
                ],
                web: [
                    [[480, 310], [50, -143], [90, 53]],
                    [[740, 290], [-130, 29], [-60, 13], [-70, 0]]
                ]
                // [[551, 458], [-34, -44], [-28, -46], [-12, -48], [30, -85]],
                // [[420, 105], [-177, 103], [100, 128]],
                // [[480, 140], [-51, 11], [-94, 40], [43, 67]],
                // [[217, 475], [11, -40], [35, -38], [91, -46], [32, 40]],
                // [[682, 309], [-132, 29], [-67, -2]],
                // [[235, 531], [56, -50], [179, -153]],
                // [[550, 426], [182, -37], [-99, -161]],
                // [[381, 262], [98, -12], [-36, -69], [-100, 21]],
                // [[98, 293], [70, 43], [100, 61], [24, 11], [69, 12]],
                // [[400, 313], [89, -13], [22, -59]]
                // [[376, 262], [-79, 17], [0, 7], [-45, 26], [-32, -18]],
                // [[496, 495], [-109, -36], [50, -6], [49, -12]]
            },
            drawnPaths: [],
            active: false
        }
    },
    methods: {
        addRandomPath() {
            if (this.active && !this.$store.state.journey.paused) {
                const key = this.$store.state.journey.currentSurface || 'mobile'
                this.addPath(_sample(this.paths[key]))
            }

            setTimeout(() => {
                this.addRandomPath()
                if (this.drawnPaths.length >= 10) {
                    this.drawnPaths.shift()
                }
            }, spawnInterval)
        },
        addPath(points) {
            const path = {}

            path.points = points
            const startPoint = { x: points[0][0], y: points[0][1] }
            const start = `M${startPoint.x},${startPoint.y}`
            // build starting d
            path.d = start
            path.start = start
            path.endpoint = startPoint
            path.opacity = 1
            points.forEach((point, i) => {
                if (i != 0) {
                    path.d += ` l0,0`
                }
            })

            let totalLength = 0
            const lengths = []
            const totalDuration = 8000

            // get relative points, skipping the starting point
            let tl = points.slice(1).map((point, i) => {
                const segmentLength = Math.sqrt(
                    Math.pow(point[0], 2) + Math.pow(point[1], 2)
                )
                lengths.push(segmentLength)
                totalLength += segmentLength

                return {
                    track: `l${i}`,
                    from: { x: 0, y: 0 },
                    to: { x: point[0], y: point[1] },
                    ease: easing.linear
                }
            })

            tl = tl.map((item, i) => {
                const percentage = lengths[i] / totalLength
                const duration = percentage * totalDuration
                return {
                    duration,
                    ...item
                }
            })

            path.timeline = timeline(tl, {
                duration: 8000
                // ease: easing.easeOut
            })
                .pipe(v => {
                    let output = start
                    path.endpoint = { x: points[0][0], y: points[0][1] }
                    Object.keys(v).forEach(track => {
                        output += ` l${v[track].x},${v[track].y}`
                        path.endpoint.x += v[track].x
                        path.endpoint.y += v[track].y
                    })
                    return output
                })
                .start({
                    update: v => (path.d = v),
                    complete: () => {
                        // wait a moment, then fade out
                        chain(
                            delay(800),
                            tween({
                                from: 1,
                                to: 0,
                                duration: 1200
                            })
                        ).start(v => (path.opacity = v))
                    }
                })

            this.drawnPaths.push(path)
        },
        buildPath(points) {
            let output = ``
            output += `M${points[0][0]}, ${points[0][1]}`
            points.slice(1).forEach(p => {
                output += ` l${p[0]},${p[1]}`
            })
            return output
        }
    },
    watch: {
        '$store.state.journey.currentSurface'(newVal) {
            if (newVal) {
                this.active = true
                this.addRandomPath()
            } else {
                this.active = false
                this.drawnPaths = []
            }
        },
        // change animation state
        '$store.state.journey.paused'(newVal) {
            if (newVal) {
                this.drawnPaths.forEach(path => path.timeline.pause())
            } else {
                this.drawnPaths.forEach(path => path.timeline.resume())
            }
        }
    }
}
</script>

<style lang="scss">
.journey-svg-paths {
    path {
        stroke: #435268;
        stroke-dasharray: 4px 5px;
        fill: transparent;
    }
    .srt-figure {
        .st0 {
            fill-rule: evenodd;
            clip-rule: evenodd;
            fill: #ffffff;
            stroke: #ff3655;
            stroke-width: 2;
            stroke-miterlimit: 10;
            stroke-dasharray: 0;
        }
    }
}
</style>
