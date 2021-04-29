<template>
    <section class="partner-program-opportunities">
        <ul class="ul-reset grid">
            <li class="item" v-for="(item, i) in items" :key="i">
                <img :src="item.icon" class="icon" />
                <h4 class="title">{{ item.title }}</h4>
                <div class="content" v-html="item.content" />
                <a :href="item.link_url" class="end-link">
                    {{ item.link_text }}
                </a>
            </li>
        </ul>
    </section>
</template>

<script>
export default {
    props: {
        items: Array
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

.partner-program-opportunities {
    padding: 0 30px;
    margin: 60px auto 40px;
    max-width: 1200px;

    @media (max-width: 800px) {
        max-width: 500px;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-column-gap: 70px;
        list-style: none;
        margin: 0;
        padding: 0;
        text-align: center;

        @media (max-width: 800px) {
            grid-template-columns: 100%;
            grid-row-gap: 40px;
        }

        .icon {
            width: 100px;
            height: 100px;
            margin: auto;
        }
        .title {
            font-size: 40px;
            line-height: 1.1 !important;
            font-weight: 500;
            margin: 25px 0 0;

            @media (max-width: 800px) {
                font-size: 26px;
            }
        }
        .content {
            color: #8695ae;
            margin-top: 25px;
        }
        .end-link {
            @include shortcode-button($blue, $blue);
            transition: opacity 0.3s;

            &:hover,
            &:focus {
                opacity: 0.7;
            }
        }
    }
}
</style>
