<template>
    <div id="mapbox-container" class="mapbox-container">
        <img
            width="163"
            height="163"
            ref="map-pin-blue"
            style="display: none;"
            src="/wp-content/themes/synack/next/static/images/map-pin-blue.png"
        />
        <img
            width="163"
            height="163"
            ref="map-pin-red"
            style="display: none;"
            src="/wp-content/themes/synack/next/static/images/map-pin-red.png"
        />
        <img
            width="163"
            height="163"
            ref="map-pin-green"
            style="display: none;"
            src="/wp-content/themes/synack/next/static/images/map-pin-green.png"
        />
        <div class="legend">
            <div>
                <img
                    width="31"
                    height="31"
                    src="/wp-content/themes/synack/next/static/images/legend-pin-blue.png"
                />
                <span class="label">Synack Office</span>
            </div>

            <div>
                <img
                    width="31"
                    height="31"
                    src="/wp-content/themes/synack/next/static/images/legend-pin-green.png"
                />
                <span class="label">Partner</span>
            </div>
        </div>
    </div>
</template>

<script>
import mapboxgl from 'mapbox-gl'

// helper to render popup html
const getPopupHtml = (title, description) => {
    return `
        <div class="popup">
            <h3>${title}</h3>
            <div class="description">${description}</div>
        </div>
    `.trim()
}

let map,
    geoData,
    lastClick = new Date().getTime()
export default {
    props: {
        locations: {
            type: Array,
            default: () => []
        }
    },
    mounted() {
        // init map
        mapboxgl.accessToken =
            'pk.eyJ1Ijoiam9obmRpZ2l0YWwiLCJhIjoiY2pzNHhjOTc4MDlzaTQzcGFzYjljb3JnYSJ9.7dNA8VyjV5_cwwfh-NLxbA'
        map = new mapboxgl.Map({
            container: 'mapbox-container',
            style: 'mapbox://styles/johndigital/cjs4xdw9413jz1gpfsm9qeyls',
            center: [-40.266293, 20],
            zoom: 0
        })

        // resize map if app ever triggers resize
        this.$root.$on('resize', this.resizeMap)

        // add layer
        map.on('load', this.onMapLoad)
    },
    methods: {
        resizeMap() {
            if (map) {
                map.resize()
            }
        },
        mapLocationsToGeoData(locations) {
            return {
                type: 'FeatureCollection',
                features: locations.map(loc => {
                    return {
                        type: 'Feature',
                        properties: {
                            title: loc.title,
                            description: loc.description
                        },
                        geometry: {
                            coordinates: [
                                parseFloat(loc.longitude),
                                parseFloat(loc.latitude)
                            ],
                            type: 'Point'
                        }
                    }
                })
            }
        },
        onPinClick(e) {
            if (new Date().getTime() - lastClick < 10) return
            lastClick = new Date().getTime()

            var coordinates = e.features[0].geometry.coordinates.slice()
            var title = e.features[0].properties.title
            var description = e.features[0].properties.description

            if (!title && !description) {
                return
            }

            // Ensure that if the map is zoomed out such that multiple
            // copies of the feature are visible, the popup appears
            // over the copy being pointed to.
            while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
                coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360
            }

            // create popup
            new mapboxgl.Popup()
                .setLngLat(coordinates)
                .setHTML(getPopupHtml(title, description))
                .addTo(map)
        },
        onMapLoad() {
            ;['blue', 'green' /*, 'red'*/].forEach(color => {
                const locationsByColor = this.locations.filter(loc => {
                    return loc.color === color
                })

                // Add this pin color to map
                const domEl = this.$refs[`map-pin-${color}`]
                map.addImage(`map-pin-${color}`, domEl, {
                    pixelRatio: 2
                })

                // add places layer
                map.addLayer({
                    id: `places-${color}`,
                    type: 'symbol',
                    source: {
                        type: 'geojson',
                        data: this.mapLocationsToGeoData(locationsByColor)
                    },
                    layout: {
                        'icon-image': `map-pin-${color}`,
                        'icon-allow-overlap': true
                    }
                })

                // handle places click
                map.on('click', `places-${color}`, this.onPinClick)

                // Change the cursor to a pointer when the mouse is over the places layer.
                map.on('mouseenter', `places-${color}`, function() {
                    map.getCanvas().style.cursor = 'pointer'
                })

                // Change it back to a pointer when it leaves.
                map.on('mouseleave', `places-${color}`, function() {
                    map.getCanvas().style.cursor = ''
                })
            })
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

$text-color: #8696ad;
$legend-text-color: #535f75;

.mapbox-container {
    // close button
    .mapboxgl-popup-close-button {
        transition: color 200ms;
        font-family: $font-body;
        box-sizing: content-box;
        color: $text-color;
        font-size: 18px;
        padding: 5px 10px 10px;
        width: 18px;
    }
    .not-mobile & .mapboxgl-popup-close-button:hover,
    .not-mobile & .mapboxgl-popup-close-button:focus {
        background-color: transparent;
        color: $navy;
    }
    .legend {
        position: absolute;
        right: 30px;
        bottom: 30px;
        background: $white;
        font-size: 12px;
        font-weight: 500;
        letter-spacing: 2px;
        color: $legend-text-color;
        box-shadow: rgba(#00193e, 0.14) 0 12px 34px;
        z-index: 5;
        text-transform: uppercase;
        padding: 20px 30px;

        & > div {
            display: flex;
            align-items: center;
        }
        img {
            width: 24px;
            height: 24px;
            position: relative;
            top: 1px;
            margin-right: 5px;
            padding: 4px 0 8px;
            margin-right: 10px;
        }
    }

    // popup content
    .popup {
        color: $text-color;
        line-height: 1.5;
        font-size: 20px;
        max-width: 27vw;
        min-width: 20vw;
        padding: 25px;

        h3 {
            text-transform: uppercase;
            margin: 0;
            margin-bottom: 25px;
            font-size: 24px;
            color: $navy;
        }
    }

    // mobile
    @media #{$lt-phone} {
        .popup {
            font-size: 14px;
            max-width: 50vw;
            padding: 10px;

            h3 {
                font-size: 16px;
            }
        }
    }
}
</style>
