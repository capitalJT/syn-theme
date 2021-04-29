<template>
    <section class="careers-alternating-columns">
        <!-- Title -->
        <div class="title-wrap">
            <svg-crossed-swords class="icon" />
            <h3 class="title">{{ title }}</h3>
        </div>

        <!-- Columns -->
        <ul class="column-wrap">
            <li v-for="(item, i) in columns" :key="i" class="item">
                <img
                    class="image"
                    :src="item.image.url"
                    :alt="item.image.alt"
                />
                <div class="text-wrap">
                    <h4 class="headline">{{ item.headline }}</h4>
                    <div class="content" v-html="item.text" />
                </div>
            </li>
        </ul>
    </section>
</template>

<script>
export default {
    props: {
        title: String,
        columns: Array
    }
}
</script>

<style lang="scss">
.careers-alternating-columns {
    .title-wrap {
        text-align: center;
        margin-top: 60px;

        .title {
            margin: 0;
            font-size: 50px;
            margin-top: 20px;
        }
    }

    // columns
    .column-wrap {
        list-style: none;
        margin: 40px auto 0;
        padding: 0;

        @media (max-width: 800px) {
            padding: 0 20px;
        }

        .item {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-column-gap: 80px;
            max-width: 700px;
            margin: 15px auto 0;

            @media (max-width: 800px) {
                grid-template-columns: 100%;
                margin-top: 30px;
            }

            .image {
                width: 100%;
            }
            .headline {
                margin: 40px 0 0;
                color: #016bff;
                font-weight: 300;
                font-size: 24px;

                @media (max-width: 800px) {
                    margin-top: 15px;
                }
            }
            .content {
                margin-top: 30px;

                @media (max-width: 800px) {
                    margin-top: 15px;
                }
            }

            &:nth-child(even) {
                @media (min-width: 800px) {
                    .text-wrap {
                        grid-column-start: 1;
                        grid-row-start: 1;
                        text-align: right;
                    }
                }
            }
        }
    }
}
</style>
