<template>
    <vue-three-wrap :start="start" :update="update" :inject-shaders="true">
        <script type="shader/vertex">
            #include <snoise>

            varying vec2 vUv;
            varying vec4 worldPos;
            varying vec2 gridCoordinates;
            varying float width;
            varying float height;
            varying float aspect;
            varying vec2 viewport;

            uniform float texWidth;
            uniform float texHeight;
            uniform float time;
            uniform float animationProgress;

            void main(){
                vUv = uv;
                worldPos = modelMatrix * vec4(position, 1.);

                // texture dimensions in px
                aspect = texWidth / texHeight;

                // dot count across x and y axes of globe
                width = 440.;
                height = width / aspect;

                // get grid position
                gridCoordinates = uv * vec2(width, height);

                // scale out to animate in
                vec3 scalePos = position + normal * 3.;

                // final position, taking into account animation
                vec3 finalPos = mix(scalePos, position, animationProgress);

                gl_Position = projectionMatrix * modelViewMatrix * vec4(finalPos, 1.0);

                // (0,0)..(1,1) viewport coordinates
                //https://stackoverflow.com/a/26969699/3856675
                vec3 ndc = gl_Position.xyz / gl_Position.w;
                viewport = ndc.xy * 0.5 + 0.5;
            }
        </script>

        <script type="shader/fragment">
            #include <snoise>

            varying vec2 vUv;
            varying vec4 worldPos;
            varying vec2 gridCoordinates;
            varying float width;
            varying float height;
            varying float aspect;
            varying vec2 viewport;

            uniform sampler2D texture;
            uniform float texWidth;
            uniform float texHeight;
            uniform float time;
            uniform float maxDotBrightness;
            uniform float animationProgress;
            uniform float highlightedRow;

            float getColorMultiplier(vec2 uv, float offset){

                // convert snoise's -1..1 to 0.25..1.25
                return (((snoise(uv + offset) + 1.) / 2.) + 0.25) * maxDotBrightness;
            }

            void main(){

                // starting color bottom: rgb(15 20 39), top: rgb(25 42 77)
                vec3 color = mix(vec3(.038, .058, .113), vec3(.098, .165, .302), viewport.y);
                float a = 1.;

                // adjust vUv so we get uv matching aspect ratio
                // vUv is (0,0)..(1,1)
                // uv should be something like (0,0)..(1.778,1)
                vec2 uv = vUv * vec2(aspect, 1.);

                // get local grid coordinates (0,0)..(1,1)
                vec2 local = fract(gridCoordinates);

                // sample the original texture at the current UV to determine
                // if there's a landmass there or not
                // (hasDot == 0: no landmass, hasDot == 1: landmass)
                vec2 sampleTexUv = floor(gridCoordinates) / vec2(width, height);
                float hasDot = texture2D(texture, sampleTexUv).r;
                hasDot = 1. - step(0.9, hasDot);

                // draw a circle in the center of the current grid cell
                float dotRadius = .3;
                float radiusBlur = .05;
                float dotStrength = hasDot * (1. - smoothstep(dotRadius - radiusBlur, dotRadius, distance(local, vec2(0.5, 0.5))));
                dotStrength *= getColorMultiplier(floor(gridCoordinates), time);
                color = mix(color, color * 1.6, dotStrength);

                // intro colors and alphas
                float introA = 1. - step(hasDot, 0.1);
                vec3 introColor = color * step(color.r, a);
                introA = mix(0., a, color.b);

                color = mix(introColor, color, animationProgress);
                a = mix(introA, a, animationProgress);

                // red scan line
                // rgb(255, 54, 85)
                vec3 lineColor = vec3(1., 0.2117, 0.3333);
                float lineStrength = smoothstep(vUv.y - 0.0004, vUv.y, highlightedRow) - smoothstep(vUv.y, vUv.y + 0.0004, highlightedRow);
                lineStrength += (smoothstep(vUv.y - 0.0004, vUv.y, highlightedRow) - smoothstep(vUv.y, vUv.y + 0.1, highlightedRow)) * 0.4;

                color = mix(color, color + lineColor, lineStrength);

                // set the pixel color
                gl_FragColor = vec4( color, a );

            }
        </script>
    </vue-three-wrap>
</template>

<script>
import * as THREE from 'three'
import asyncTextureLoad from '../../libs/asyncTextureLoader'
import Raycaster from 'vue-three-wrap/extras/raycaster'
import { keyframes, tween, easing } from 'popmotion'
import _sampleSize from 'lodash/sampleSize'
import _lowerCase from 'lodash/lowerCase'

const ref = {}
const radius = 5.7
const texWidth = 634
const texHeight = 477
const maxRotationSpeed = 0.001

export default {
    data() {
        return {
            uniforms: {
                texture: { value: null },
                texWidth: { value: texWidth },
                texHeight: { value: texHeight },
                time: { value: 0 },
                maxDotBrightness: { value: 2.8 },
                animationProgress: { value: 0 },
                highlightedRow: { value: 0 }
            },
            glitterSpeed: 0.01,
            rotationSpeed: maxRotationSpeed,
            currentHoverIndex: -1,
            infoBoxX: 600,
            infoBoxY: 200
        }
    },
    methods: {
        async start({ scene, camera, vertexShader, fragmentShader }) {
            // radius, heightSegments, widthSegments
            const geo = new THREE.SphereGeometry(radius, 128, 128)

            // load ping texture
            ref.ping = await asyncTextureLoad(
                '/wp-content/themes/synack/next/static/images/ping.png'
            )
            ref.srt = await asyncTextureLoad(
                '/wp-content/themes/synack/next/static/images/map-pin-red.png'
            )

            // load earth map texture
            const texture = await asyncTextureLoad(
                '/wp-content/themes/synack/next/static/images/634x477.png'
            )
            // save texture
            this.uniforms.texture.value = texture

            // create globe
            const mat = new THREE.ShaderMaterial({
                uniforms: this.uniforms,
                vertexShader,
                fragmentShader
            })
            ref.sphere = new THREE.Mesh(geo, mat)
            scene.add(ref.sphere)

            // position & rotate globe
            this.refreshPosition()

            // add points
            ref.points = []
            this.locations.forEach(location => {
                const point = this.addPoint(
                    location.lat,
                    location.lng,
                    location.color
                )
                point.name = location.name

                // Only enable hover if there's a name
                if (location.name) {
                    ref.points.push(point)
                }
            })

            // prep raycaster
            ref.raycaster = new Raycaster({
                el: this.$el,
                camera
            })

            // start intro
            if (!this.$store.getters.isMobile) {
                tween({ duration: 3000 }).start(v => {
                    this.uniforms.animationProgress.value = v
                })
            } else {
                this.uniforms.animationProgress.value = 1
            }

            // scan row
            tween({ duration: 8000, loop: Infinity, to: 1.1 }).start(v => {
                this.uniforms.highlightedRow.value = v
            })
        },
        update({ camera }) {
            // sphere's not ready, so we can't run yet
            if (!ref.sphere) return

            // check mouse
            const intersects = ref.raycaster.intersectObjects(ref.points)
            // get objects from intersections
            const intersectedObjects = intersects.map(i => i.object)

            let index = -1
            let hasInfo = false

            if (intersectedObjects.length) {
                index = ref.points.findIndex(
                    p => p.name == intersectedObjects[0].name
                )
                hasInfo = _get(this.locations, `[${index}]`, {}).info
            }

            if (hasInfo) {
                this.currentHoverIndex = index
                const { x, y } = this.getScreenFromPoint(
                    ref.points[this.currentHoverIndex].position,
                    camera
                )
                this.infoBoxX = x
                this.infoBoxY = y
                if (this.rotationSpeed === maxRotationSpeed) {
                    // slow down rotation
                    tween({
                        from: this.rotationSpeed,
                        to: 0,
                        duration: 800
                    }).start(v => (this.rotationSpeed = v))
                }
            } else {
                // rotate if we're not hovering over anything
                ref.sphere.rotation.y += this.rotationSpeed
                this.currentHoverIndex = -1

                if (this.rotationSpeed === 0) {
                    // slow down rotation
                    tween({
                        from: 0,
                        to: maxRotationSpeed,
                        duration: 800
                    }).start(v => (this.rotationSpeed = v))
                }
            }

            // setting rotation here ensures the pins are rotated correctly
            ref.sphere.rotation.x = 0.6

            // update time
            this.uniforms.time.value += this.glitterSpeed
        },
        addPoint(lat, lng, color) {
            if (!ref.sphere) return

            // ping wrapper
            const pingMat = new THREE.MeshBasicMaterial({
                transparent: true,
                side: THREE.DoubleSide,
                opacity: 0
            })
            const pingGeo = new THREE.PlaneGeometry(0.2, 0.2)
            const ping = new THREE.Mesh(pingGeo, pingMat)

            // white dot
            const map = color == 'red' ? ref.srt : ref.ping
            const mat = new THREE.MeshBasicMaterial({
                map,
                side: THREE.DoubleSide,
                transparent: true
            })
            const geo = new THREE.PlaneGeometry(0.4, 0.4)
            const dot = new THREE.Mesh(geo, mat)
            ping.add(dot)

            ref.sphere.add(ping)
            const coords = this.latLngToVector3(lat, lng)

            ping.position.set(coords.x, coords.y, coords.z)

            ping.lookAt(ref.sphere.position)

            // move dot out slightly
            dot.position.lerpVectors(
                ping.position,
                new THREE.Vector3(0, 0, 0),
                1.0001
            )

            return ping
        },
        latLngToVector3(lat, lng) {
            // tweak so we end up in the right place
            lng += 81
            lat *= (texHeight / texWidth) * 1.08

            // from stackoverflow
            const phi = Math.PI * (0.5 - lat / 180)
            const theta = Math.PI * (lng / 180)
            const spherical = THREE.Spherical(radius + 0.01 || 1, phi, theta)
            return new THREE.Vector3().setFromSpherical(spherical)
        },
        getScreenFromPoint(point, camera) {
            const width = this.$el.offsetWidth
            const height = this.$el.offsetHeight
            const widthHalf = width / 2
            const heightHalf = height / 2

            let pos = new THREE.Vector3()
            pos = pos.setFromMatrixPosition(
                ref.points[this.currentHoverIndex].matrixWorld
            )
            pos.project(camera)
            pos.x = pos.x * widthHalf + widthHalf
            pos.y = -(pos.y * heightHalf) + heightHalf
            return pos
        },
        updateInfoBox() {
            this.$store.commit('UPDATE_INFO_BOX', {
                show: this.currentHoverIndex != -1,
                x: this.infoBoxX,
                y: this.infoBoxY,
                title: this.cmpHoveredLocation.name,
                content: this.cmpHoveredLocation.info
            })
        },
        refreshPosition() {
            // ignore if we haven't set up the scene yet
            if (!ref.sphere) return

            if (this.$store.getters.isMobile) {
                ref.sphere.position.z = -15
                ref.sphere.position.y = 4
                ref.sphere.rotation.y = -1.5
            } else {
                ref.sphere.position.z = -9
                ref.sphere.rotation.y = -1.5
                ref.sphere.position.y = 0
            }
        }
    },
    computed: {
        cmpHoveredLocation() {
            return _get(this.locations, `[${this.currentHoverIndex}]`, {})
        },
        locations() {
            const sampleCount = 20

            const raw = _get(this, '$store.state.pageData.acf.locations', [])

            if (!raw) {
                return []
            }

            const forced = raw.filter(x => x.include)
            const sampled = _sampleSize(
                raw.filter(x => !x.include),
                sampleCount
            )

            const unfiltered = [].concat(forced, sampled)

            const result = unfiltered.map(location => {
                return {
                    name: location.name,
                    lat: parseFloat(location.latitude),
                    lng: parseFloat(location.longitude),
                    info: location.info,
                    color: _lowerCase(location.pin_color)
                }
            })

            return result
        }
    },
    watch: {
        infoBoxX() {
            this.updateInfoBox()
        },
        infoBoxY() {
            this.updateInfoBox()
        },
        currentHoverIndex() {
            this.updateInfoBox()
        },
        '$store.getters.isMobile'() {
            this.refreshPosition()
        }
    }
}
</script>
