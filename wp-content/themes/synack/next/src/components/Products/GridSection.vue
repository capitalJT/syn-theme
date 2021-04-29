<template>
    <div :class="['products-grid-section', { opened }]">
        <button class="toggle" @click="opened = !opened">
            {{ toggleRow.text }}
        </button>

        <table v-if="opened" class="table">
            <products-row
                v-for="(row, i) in rows.slice(1)"
                :key="i"
                :row="row"
            />
        </table>
    </div>
</template>

<script>
export default {
    props: ['rows'],
    data() {
        return {
            opened: true
        }
    },
    computed: {
        toggleRow() {
            return this.rows[0]
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

.products-grid-section {
    .toggle {
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: 500;
        text-align: center;
        font-size: 20px;
        width: 100%;
        padding: 20px 0;
        background: $grid-toggle
            url(/wp-content/themes/synack/next/static/images/toggle.png);
        background-position: calc(100% - 10px) center;
        background-repeat: no-repeat;
        background-size: 8px 15px;
        transition: background 0.3s;
        font-family: $font-display;

        &:active {
            color: inherit;
        }

        .not-mobile &:hover,
        .not-mobile &:focus {
            background: lighten($grid-toggle, 10%)
                url(/wp-content/themes/synack/next/static/images/toggle.png);
            background-position: calc(100% - 10px) center;
            background-repeat: no-repeat;
            background-size: 8px 15px;
        }
    }
    &:not(.opened) .toggle {
        border-bottom: 1px solid $grid-border;
    }
    .table {
        display: grid;
        grid-row-gap: 1px;
    }
}
</style>
