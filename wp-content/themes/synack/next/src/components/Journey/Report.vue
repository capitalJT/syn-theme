<template>
    <div class="journey-report">
        <div class="report-inner">
            <div class="top-wrap">
                <h2 class="title">Attacker Resistance Score</h2>

                <span class="label vulns">Total Vulns</span>
                <span class="amount vulns">{{ cmpVulns.length }}</span>

                <journey-score-badge class="journey-svg-score" />

                <span class="label patches">Total Patches</span>
                <span class="amount patches">{{ cmpPatches.length }}</span>
            </div>

            <div class="bottom-wrap">
                <span class="label breakdown">Severity Breakdown</span>

                <div class="breakdown-wrap">
                    <div class="breakdown-inner">
                        <journey-svg-breakdown :values="values" />

                        <div class="legend-wrap">
                            <span class="circle low" />
                            <span class="label">Low</span>
                            <span class="circle med" />
                            <span class="label">Med</span>
                            <span class="circle high" />
                            <span class="label">High</span>
                        </div>
                    </div>
                </div>

                <span class="label categories">Top Categories</span>
                <div class="category-grid">
                    <journey-category
                        v-for="(cat, i) in categories"
                        :key="i"
                        :delay="i * 50"
                        :label="cat.label"
                        :amount="cat.amount"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    computed: {
        values() {
            // needs to go high, low, medium
            const highs = this.cmpVulns.filter(vuln => vuln.severity == 'High')
            const lows = this.cmpVulns.filter(vuln => vuln.severity == 'Low')
            const meds = this.cmpVulns.filter(vuln => vuln.severity == 'Medium')

            const total = this.cmpVulns.length
            return [
                highs.length / total,
                lows.length / total,
                meds.length / total
            ]
        },
        cmpVulns() {
            return this.$store.state.journey.vulns
        },
        cmpPatches() {
            return this.$store.state.journey.appliedPatches
        },
        categories() {
            const categoriesRaw = this.cmpVulns.map(vuln => vuln.category)
            const categories = [].concat.apply([], categoriesRaw)

            const counts = {}
            // count each category
            categories.forEach(cat => {
                if (!counts[cat]) {
                    counts[cat] = 1
                } else {
                    counts[cat]++
                }
            })
            // create array of labels and percentages
            const toSort = Object.keys(counts).map(key => {
                return {
                    label: key,
                    // percentage of total categories
                    amount: counts[key] / categories.length
                }
            })
            // sort in descending order by amount
            toSort.sort((a, b) => b.amount - a.amount)

            return toSort
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

$light-gray: #31495f;
$teal: #48d895;
$orange: #ffad39;
$red: #ff3655;

.journey-report {
    grid-column: 2 / span 2;

    .label {
        @include game-legend;
    }
    .report-inner {
        border: 1px solid $light-gray;
        padding: 30px;
    }

    // top section
    .top-wrap {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        padding: 0 30px 30px;
        border-bottom: 1px solid $light-gray;

        .title {
            grid-column: 1 / span 3;
            @include game-legend;
            color: $white;
            font-weight: 400;
            font-size: 14px;
            margin: 0 auto 45px;
        }
        .amount {
            text-align: center;
            color: $white;
            font-weight: 500;
            font-size: 40px;
        }
        .label {
            display: flex;
            align-items: flex-end;
            justify-content: center;
            margin-bottom: 6px;
        }
        .amount {
            margin-top: 6px;
        }
        .label.vulns {
            grid-area: 2 / 1 / span 1 / span 1;
        }
        .amount.vulns {
            grid-area: 3 / 1 / span 1 / span 1;
        }
        .journey-svg-score {
            grid-area: 2 / 2 / span 2 / span 1;
            text-align: center;
            margin: auto;
            width: 100%;
        }
    }

    // bottom section
    .bottom-wrap {
        display: grid;
        grid-template-columns: [breakdown] 1fr [categories] 2fr;
        grid-gap: 40px 100px;
        grid-auto-flow: dense;
        padding: 30px 30px 0;

        .label.breakdown {
            grid-column: breakdown;
        }
        .breakdown-wrap {
            grid-column: breakdown;

            .breakdown-inner {
                display: flex;
            }

            svg {
                margin: auto;
            }
            path {
                stroke: $red;
            }
            path:nth-of-type(2) {
                stroke: $green;
            }
            path:nth-of-type(3) {
                stroke: $orange;
            }

            .legend-wrap {
                display: grid;
                grid-template-columns: [circles] 10px [labels] 1fr;
                grid-gap: 15px 10px;
                align-content: center;
                margin-left: 25px;

                .circle {
                    width: 10px;
                    height: 10px;
                    border-radius: 50%;
                    background: $teal;
                    position: relative;
                    top: 2px;

                    &.med {
                        background: $orange;
                    }
                    &.high {
                        background: $red;
                    }
                }
                .label {
                    text-align: left;
                    font-size: 13px;
                    color: $white;
                    text-transform: none;
                    letter-spacing: initial;
                }
            }
        }
        .label.categories {
            grid-column: categories;
        }
        .category-grid {
            grid-column: categories;
        }
        .journey-category + .journey-category {
            margin-top: 5px;
        }
        .journey-category:nth-child(2) {
            .fill {
                background: #0095d5;
            }
        }
        .journey-category:nth-child(3) {
            .fill {
                background: #1676d9;
            }
        }
        .journey-category:nth-child(4) {
            .fill {
                background: #005c97;
            }
        }
    }
}
</style>
