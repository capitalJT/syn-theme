<template>
    <ul class="journey-feed">
        <li
            v-for="(item, i) in $store.state.journey.feed"
            :key="i"
            :class="['item', item.className]"
        >
            <span class="speaker">&lt;{{ item.speaker }}></span>
            <!-- <text-typer class="content" :html="item.content" /> -->
            <span class="content" v-html="item.content" />
        </li>
    </ul>
</template>

<script>
import Vue from 'vue'

export default {
    watch: {
        '$store.state.journey.feed'() {
            if (
                this.$el.scrollTop >=
                    this.$el.scrollHeight - this.$el.offsetHeight ||
                this.$el.scrollTop == 0
            ) {
                this.$nextTick(() => {
                    this.$el.scrollTop = this.$el.scrollHeight
                })
            }
        }
    }
}
</script>

<style lang="scss">
$normal-color: #8795ae;
$positive-color: #b7fff8;
$negative-color: #ff8a9c;

.journey-feed {
    padding: 0;
    margin: 0;
    list-style: none;
    line-height: 1.4;
    font-family: 'Roboto Mono', monospace;
    font-size: 14px;

    .item {
        display: grid;
        grid-template-columns: 80px 1fr;
        grid-gap: 10px;

        & + .item {
            margin-top: 20px;
        }
        .speaker {
            text-align: right;
        }
        &:last-child {
            padding-bottom: 10px;
        }
    }
    .normal {
        color: $normal-color;
    }
    .positive {
        color: $positive-color;
    }
    .negative {
        color: $negative-color;
    }

    .content {
    }
}
</style>
