<template>
    <section class="products-grid">
        <!-- dots decoration -->
        <shared-light-dots />

        <!-- pattern + gradient decoration -->
        <div class="pattern" />
        <div class="gradient" />

        <div class="contained">
            <!-- Titles -->
            <div class="meta">
                <h5>Solutions</h5>
                <h3>{{ solutionsTitle }}</h3>
            </div>

            <!-- Sticky header -->
            <products-header :sticky-header="stickyHeader" />

            <!-- Grid -->
            <div class="grid-wrap contained">
                <table class="times-row">
                    <products-row :row="rows[0]" />
                </table>
                <products-grid-section
                    v-for="(section, i) in sections"
                    :key="i"
                    :rows="section"
                />
            </div>

            <!-- Tooltips -->
            <products-tooltip />
        </div>
    </section>
</template>

<script>
export default {
    computed: {
        acf() {
            return _get(this.$store, 'state.pageData.acf', {})
        },
        rows() {
            return this.acf.grid || []
        },
        sections() {
            const output = []
            let current = null

            this.rows.slice(1).forEach(row => {
                if (row.acf_fc_layout == 'section_toggle') {
                    if (current) output.push(current)
                    current = [row]
                } else {
                    current.push(row)
                }
            })
            output.push(current)
            return output
        },
        solutionsTitle() {
            return this.acf.solutions_grid_title
        },
        stickyHeader() {
            return this.acf.sticky_header
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

.products-grid {
    position: relative;
    padding-top: 130px;
    padding-bottom: 140px;

    // titles
    @include products-solutions-titles;
    // background pattern and gradient
    @include background-pattern-decoration;

    .meta {
        h5 {
            margin-top: 0;
        }
    }

    // Grid
    .grid-wrap {
        text-align: left;
        border: 1px solid $grid-border;
        border-radius: 12px;
        background: $grid-border;
        overflow: hidden;
        box-shadow: 2px 2px 10px rgba(0, 25, 62, 0.03);
    }
    th,
    td {
        background: $white;
        width: 100%;
        height: 100%;
    }
    tr,
    table {
        padding: 0;
        vertical-align: initial;
        border: none;
    }
    table {
        padding: 1px 0;

        // Top row
        &.times-row {
            padding: 0 0 1px;
            border-spacing: 0;
            width: 100%;

            .products-cell {
                justify-content: center;
            }
            .products-cell .text-wrap {
                font-weight: 500;
                color: $grid-text-heavy;
            }
        }
    }

    // Mobile
    @media #{$lt-phone} {
        .meta {
            h3 {
                font-size: 30px;
            }
        }

        // Grid wrap
        .grid-wrap {
            margin-right: 20px;
            margin-left: 20px;
        }
    }
}
</style>
