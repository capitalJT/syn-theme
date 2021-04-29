<template>
    <ul class="products-header">
        <li class="empty" />
        <li v-for="(column, i) in stickyHeader" :key="i">
            <component
                :is="$store.getters.isMobile ? 'button' : 'div'"
                @click="$store.getters.isMobile ? setIndex(i) : null"
            >
                <img
                    :src="
                        `/wp-content/themes/synack/next/static/images/grid/${
                            column.icon
                        }.png`
                    "
                    :alt="`${column.icon} icon.`"
                    :class="[
                        'icon',
                        { selected: $store.state.productGridMobileIndex == i }
                    ]"
                />
                <h5>{{ column.title }}</h5>
                <div class="description">{{ column.description }}</div>
            </component>
        </li>
    </ul>
</template>

<script>
export default {
    props: {
        stickyHeader: {
            type: Array,
            default: () => []
        }
    },
    methods: {
        setIndex(index) {
            this.$store.commit('SET_PRODUCT_GRID_MOBILE_INDEX', index)
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

// Sticky header
.products-header {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    list-style: none;
    padding: 85px 0 30px;
    margin: 0 2px;
    background: $white;
    text-align: center;
    position: sticky;
    top: 0;
    z-index: 5;
    border-radius: 12px;

    img {
        width: 48px;
        height: 48px;
      margin-left: auto;
      margin-right: auto;
    }
    h5 {
        font-weight: bold;
        font-size: 20px;
        margin: 10px auto 15px;
    }

    @media #{$lt-phone} {
        grid-template-columns: repeat(2, 1fr);
        grid-row-gap: 45px;
        grid-column-gap: 15px;
        padding-top: 45px;
        margin-right: 20px;
        margin-left: 20px;
        position: static;

        .empty {
            display: none;
        }
        .description {
            font-size: 14px;
        }
        .icon:not(.selected) {
            filter: grayscale(100%);
        }

        .not-mobile & button:hover .icon,
        .not-mobile & button:focus .icon {
            filter: none;
        }
    }
}
</style>
