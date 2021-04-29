<template>
    <nav class="archive-category-list">
        <ul>
            <li>
                <a
                    :href="blogLink"
                    :class="{ 'current-category': cmpCategory == '' }"
                >
                    All
                </a>
            </li>
            <li v-for="(cat, i) in categories" :key="i">
                <a
                    :href="cat.link"
                    v-html="cat.name"
                    :class="{
                        'current-category':
                            cmpCategory == cat.name.toLowerCase()
                    }"
                />
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    props: {
        blogLink: {
            type: String,
            default: pageData.blogLink
        },
        categories: {
            type: Array,
            default: () => []
        }
    },
    computed: {
        cmpCategory() {
            const match = window.location.href.match(/category_name=(.*)/)
            return _get(match, '[1]', '')
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';
$link-black: #061023;
$link-red: #ff3655;

.archive-category-list {
    ul {
        list-style: none;
        margin: 0;
        padding: 0;

        a {
            color: $link-black;
            text-decoration: none;
            text-transform: uppercase;
            transition: color 0.3s;
            padding: 5px 0;
            display: block;
            letter-spacing: 1px;
            line-height: 1.3;

            .not-mobile &:hover,
            .not-mobile &:focus,
            &.current-category {
                color: $link-red;
            }
        }
    }
}
</style>
