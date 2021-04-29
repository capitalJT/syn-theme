<template>
    <div class="archive-color-overlay" :style="cmpStyle"></div>
</template>

<script>
import _sample from 'lodash/sample'

export default {
    props: {
        color: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            colors: {
                blue: { start: '#106BFF', end: '#106BFF' },
                green: { start: '#48D895', end: '#0E874E' },
                purple: {
                    start: '#B39CFF',
                    end: '#5339A9'
                },
                red: {
                    start: '#FF3655',
                    end: '#061023'
                }
            }
        }
    },
    computed: {
        cmpStyle() {
            return {
                '--start-color': this.colors[this.color].start,
                '--end-color': this.colors[this.color].end
            }
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

.archive-color-overlay {
    @include fill;
    background: linear-gradient(
        to bottom,
        var(--start-color),
        var(--end-color)
    );
    mix-blend-mode: normal;
    opacity: 0.3;
}
</style>
