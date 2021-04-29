<template>
    <div class="products-solutions-all-rows">
        <div v-for="row in rows" class="feature-row">
            <products-table-item
                v-for="(item, i) in row"
                :item="item"
                :key="i"
            />
        </div>
    </div>
</template>

<script>
import _kebabCase from 'lodash/kebabCase'
import _range from 'lodash/range'

export default {
    props: {
        steps: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            pageData
        }
    },
    computed: {
        stepData() {
            return this.steps.map(step => {
                let slug = _kebabCase(step.name)
                if (slug == 'synack-365') {
                    slug = 'defend'
                }
                return _get(this.pageData, `acf.step_${slug}_features`, [])
            })
        },
        columnRange() {
            const lengths = this.stepData.map(features => features.length)
            const maxSize = Math.max(...lengths)
            return _range(maxSize)
        },
        rows() {
            return this.columnRange.map(i => {
                return this.stepData.map(features => {
                    return features[i] || false
                })
            })
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

$border-color: #e8ebf0;
$text-color: #8696ad;

.products-solutions-all-rows {
    text-align: center;
    font-size: 14px;
    color: $text-color;

    .feature-row {
        border-top: 1px solid $border-color;
        padding: 10px 0;
        display: flex;
    }
    .feature-row:first-child {
        background-color: #f9fafd;
        color: #535f75;
        font-weight: 500;
    }
    .feature-row .products-table-item {
        width: 25%;
    }
}
</style>
