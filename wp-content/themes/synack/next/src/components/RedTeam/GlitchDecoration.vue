<template>
    <div class="glitch-decoration" aria-hidden="true">
        <div class="text-wrap">
            <span class="r" v-html="randomText" />
            <span class="g" v-html="randomText" />
            <span class="b" v-html="randomText" />
        </div>
    </div>
</template>

<script>
import _sample from 'lodash/sample'

export default {
    data() {
        return {
            randomText: ''
        }
    },
    mounted() {
        setTimeout(this.randomizeText, 800)
    },
    methods: {
        randomizeText() {
            this.randomText = ''

            const pool = _get(
                this,
                '$store.state.pageData.acf.srt_member_names',
                ['']
            )
                .filter(obj => obj.name)
                .map(obj => obj.name)
            const name = _sample(pool)

            let accTime = 0

            // type out name
            for (let i = 0; i < name.length; i++) {
                const delay = 150 * Math.random()
                setTimeout(() => {
                    this.randomText += name.charAt(i)
                }, accTime + delay)
                accTime += delay
            }

            // start typing again after a delay
            setTimeout(
                this.randomizeText,
                2000 * Math.random() + accTime + 1500
            )
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

.glitch-decoration {
    text-transform: uppercase;

    .text-wrap {
        position: relative;
        line-height: 2;
    }
    .r {
        color: #f00;
        animation: glitch1 2s infinite;
    }
    .g {
        color: #0f0;
        animation: glitch1 3s infinite;
    }
    .b {
        color: #00f;
        animation: glitch1 4s infinite;
    }

    .r,
    .g,
    .b {
        mix-blend-mode: lighten;
        // display: inline-block;
    }
    .g,
    .b {
        @include fill;
    }
}

@keyframes glitch1 {
    1% {
        transform: scaleY(1);
    }
    1.5% {
        transform: scaleY(1.02) translateX(-8px) skewX(-1deg);
    }
    2% {
        transform: scaleY(1) translateX(0) skewX(0deg);
    }
    51% {
        transform: scaleX(1) scaleY(1) translateY(0px);
    }
    52% {
        transform: scaleX(1.01) scaleY(0.8) translateX(12px) translateY(20px);
    }
    53% {
        transform: scaleX(1) scaleY(1) translateX(0) skewX(1deg) translateY(0px);
    }
    54% {
        transform: scaleX(1) scaleY(1) skewX(0deg);
    }
    100% {
        transform: scaleY(1);
    }
}
</style>
