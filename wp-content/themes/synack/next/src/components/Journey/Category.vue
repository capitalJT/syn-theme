<template>
    <div class="journey-category">
        <span class="fill" :style="cmpStyle" />
        <span class="category label" v-html="label" />
    </div>
</template>

<script>
import { chain, tween, delay } from 'popmotion'

export default {
    props: {
        label: {
            type: String,
            default: ''
        },
        amount: {
            type: Number,
            default: 0.5
        },
        delay: {
            type: Number,
            default: 0
        }
    },
    data() {
        return {
            displayAmount: 0
        }
    },
    mounted() {
        chain(
            delay(this.delay + 1000),
            tween({
                to: this.amount,
                duration: 800
            })
        ).start(v => {
            if (v) {
                this.displayAmount = v
            }
        })
    },
    computed: {
        cmpStyle() {
            return { width: this.displayAmount * 100 + '%' }
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

.journey-category {
    background: #052847;
    position: relative;

    .fill {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        background: #0085a2;
    }
    & > .category.label {
        position: relative;
        padding: 10px 10px 8px;
        color: $white;
        display: block;
        text-align: left;
        text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.2);
    }
}
</style>
