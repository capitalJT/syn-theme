<template>
    <tr class="products-row">
        <products-cell
            v-for="(cell, i) in cells"
            :key="i"
            v-bind="cell"
            :index="i"
            :th="i == 0 || columnHeaders"
            :column="columnHeaders"
        />
    </tr>
</template>

<script>
const columnCount = 5

export default {
    props: {
        row: {
            type: Object,
            default: () => {}
        },
        columnHeaders: {
            type: Boolean,
            default: false
        }
    },
    computed: {
        cells() {
            let output = []
            for (let i = 0; i < columnCount; i++) {
                const toAdd = {
                    checkbox: this.row[`${i}_checkbox`],
                    icon: this.row[`${i}_icon`],
                    text: this.row[`${i}_text`],
                    tooltip: this.row[`${i}_tooltip`]
                }
                output.push(toAdd)
            }

            if (this.$store.getters.isMobile) {
                const index = this.$store.state.productGridMobileIndex + 1
                output = [output[0], output[index]]
            }

            return output
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

.products-row {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    align-items: center;
    grid-gap: 1px;

    @media #{$lt-phone} {
        grid-template-columns: repeat(2, 1fr);
    }
}
</style>
