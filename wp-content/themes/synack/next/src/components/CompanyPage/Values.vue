<template>
    <section class="company-page-values contained">
        <!-- intros -->
        <h3 class="small-intro">{{ team_intro }}</h3>
        <h4 class="values-intro">{{ values_intro }}</h4>

        <!-- alternating columns -->
        <ul class="column-wrap">
            <li
                v-for="(column, i) in alternating_columns"
                :key="i"
                :class="['column', `column-${column.positioning}`]"
            >
                <!-- Image -->
                <img
                    class="image"
                    :src="column.image.url"
                    :alt="column.image.alt"
                    :width="column.image.width"
                    :height="column.image.height"
                />

                <!-- Content -->
                <div class="text-wrap">
                    <h5 class="label">{{ column.label }}</h5>
                    <wp-content class="content" :html="column.content" />
                </div>
            </li>
        </ul>
    </section>
</template>

<script>
export default {
    props: {
        team_intro: { type: String, default: '' },
        values_intro: { type: String, default: '' },
        alternating_columns: { type: Array, default: () => [] }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

.company-page-values {
    .small-intro {
        color: $blue;
        font-size: 18px;
        font-weight: 400;
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-top: 70px;
    }
    .values-intro {
        text-align: center;
        font-size: 60px;
        margin: 0;
    }
    .column-wrap {
        padding: 0;
        margin: 0;
        list-style: none;

        .column {
            display: grid;
            grid-gap: 20px 100px;
            padding-right: 30px;
            padding-left: 30px;
            margin-top: 60px;
            grid-auto-flow: dense;

            &.column-natural:nth-child(odd),
            &.column-image-right {
                grid-template-columns: 3fr 2fr;

                @media (max-width: 800px) {
                    grid-template-columns: 100%;
                }

                .image {
                    grid-column-start: 2;

                    @media (max-width: 800px) {
                        grid-column-start: 1;
                    }
                }
            }
            &.column-natural:nth-child(even),
            &.column-image-left {
                grid-template-columns: 2fr 3fr;

                @media (max-width: 800px) {
                    grid-template-columns: 100%;
                }

                .image {
                    grid-column-start: 1;
                }
            }

            .image {
                width: 100%;
                height: auto;
            }
            .text-wrap {
                h5 {
                    margin: 0;
                    font-size: 40px;
                    font-weight: 400;
                }
                .wp-content {
                    color: #8695ae;
                }
            }
        }
    }
}
</style>
