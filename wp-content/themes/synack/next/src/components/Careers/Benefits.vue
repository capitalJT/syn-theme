<template>
    <section class="career-benefits">
        <div class="intro" v-html="intro" />

        <ul class="items">
            <li v-for="(item, i) in items" :key="i" class="item">
                <img class="image" :src="item.icon.url" :alt="item.icon.alt" />
                <div class="content" v-html="item.text" />
            </li>
        </ul>
    </section>
</template>

<script>
export default {
    props: {
        intro: String,
        items: Array
    }
}
</script>

<style lang="scss">
.career-benefits {
    @media (max-width: 800px) {
        padding: 0 20px;
    }

    // intro
    .intro {
        margin-top: 80px;

        * {
            margin: 0;
            text-align: center;
        }
        h3 {
            font-size: 52px;

            @media (max-width: 800px) {
                font-size: 36px;
                margin-bottom: 10px;
            }
        }
    }

    // items
    .items {
        list-style: none;
        padding: 0;
        margin: 60px 0 0;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;

        .item {
            text-align: center;
            width: 120px;
            margin: 20px 60px;

            @media (max-width: 800px) {
                width: 100px;
                margin: 20px;
            }

            .content {
                margin-top: 10px;
            }
        }
    }
}
</style>
