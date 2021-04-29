<template>
    <div class="company-page-team-row" :style="styles">
        <div class="flex-wrap">
            <div
                :class="['column', { 'col-active': isColActive(column) }]"
                v-for="(column, i) in columns"
                :style="getColStyle(i)"
            >
                <company-page-team-block
                    class="team-block"
                    v-for="(teamMember, i) in column"
                    :item="teamMember"
                    :key="i"
                />
            </div>
        </div>
    </div>
</template>

<script>
import _isEqual from 'lodash/isEqual'
import _shuffle from 'lodash/shuffle'
import _maxBy from 'lodash/maxBy'
import _clone from 'lodash/clone'

// Take array of items and sort equally across n new arrays
// -- Returns: sorted buckets (array of arrays)
export const sortBuckets = (items, count = 2) => {
    const buckets = Array(count)
        .fill(0)
        .map(v => [])
    let pointer = 0

    items.forEach(item => {
        buckets[pointer].push(item)
        pointer = (pointer + 1) % count
    })

    return buckets
}

const aSwap = (arr, i1, i2) => {
    return ([arr[i1], arr[i2]] = [arr[i2], arr[i1]])
}

export default {
    props: {
        items: {
            type: Array,
            default: () => []
        },
        widthTemplate: {
            type: Array,
            default: () => [40, 31.5, 23]
        }
    },
    watch: {
        '$store.state.activeTeamBlock': 'activateTeamMember'
    },
    data() {
        return {
            rowWidths: []
        }
    },
    created() {
        this.rowWidths = this.widthTemplate
    },
    computed: {
        columns() {
            let count = 3
            if ( this.$store.getters.isMobile ) count = 2
            return sortBuckets(this.items, count)
        },
        longestCol() {
            return _maxBy(this.columns, 'length')
        },
        styles() {
            if ( this.$store.getters.isMobile ) return {}
            return {
                paddingBottom: `${40 * this.longestCol.length}%`
            }
        }
    },
    methods: {
        activateTeamMember(idx) {
            const activeColIdx = this.columns.findIndex(col => {
                return col.find(item => {
                    return item.index === idx
                })
            })
            if (activeColIdx > -1) {
                let a = _clone(this.rowWidths)
                const largestIdx = this.rowWidths.findIndex(v => v === 40)

                a[largestIdx] = a.splice(activeColIdx, 1, a[largestIdx])[0]
                this.rowWidths = a
            } else {
                let a = _clone(this.rowWidths)
                while (_isEqual(this.rowWidths, a)) {
                    a = _shuffle(a)
                }
                this.rowWidths = a
            }
        },
        isColActive(items) {
            return items.find(item => {
                return item.index === this.$store.state.activeTeamBlock
            })
        },
        getColStyle(i){
            if ( this.$store.getters.isMobile ) return {}
            return { width: `${this.rowWidths[i]}%` }
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

.company-page-team-row {
    position: relative;
    padding-bottom: 40%;
    height: 0;

    .flex-wrap {
        @include fill;
        justify-content: space-between;
        align-items: flex-end;
        display: flex;
    }

    &:nth-child(even) .flex-wrap {
        align-items: flex-start;
    }

    .flex-wrap > .column {
        transition: width 400ms $easeInOutQuad;
        width: 33.33%;
    }
    .team-block {
        margin-bottom: 30px;
        overflow: hidden;
        display: block;
        width: 100%;
    }

    &.remaining .team-block {
        transition: width 400ms $easeInOutQuad, width 600ms;
        width: 75%;
    }
    &.remaining .column:first-child .team-block {
        margin-left: auto;
    }
    &.remaining .team-block:first-child {
        width: 100%;
    }
    &.remaining .team-block.is-active {
        width: 100%;
    }
}

// mobile breakpoints
@media #{ $lt-phone } {
    .company-page-team-row {
        padding-bottom: initial;
        height: initial;

        .column {
            margin: 0 7px;
        }
        .column:first-child {
            margin-left: 0;
        }
        .column:last-child {
            margin-right: 0;
        }

        .flex-wrap {
            position: relative;
        }
        .flex-wrap > .column {
            width: 50%;
        }
        .team-block {
            margin-bottom: 14px;
        }
    }
}
</style>
