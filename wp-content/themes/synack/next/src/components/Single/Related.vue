<template>
    <nav class="single-related contained">
        <h2 class="title" v-html="title" />

        <ul class="list">
            <li v-for="(post, i) in posts" :key="i">
                <a :href="post.permalink" class="related-link">
                    <responsive-image
                        aspect="50"
                        class="image"
                        :src="getImage(post).url"
                        :alt="
                            post.featuredAttachment
                                ? post.featuredAttachment.alt
                                : ''
                        "
                    />
                    <div class="text-wrap">
                        <h3 class="post-title" v-html="post.title" />
                        <div class="bottom-section">
                            <div class="author" v-html="post.author" />
                            <div class="date" v-html="getDate(post)" />
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    props: {
        posts: {
            type: Array,
            default: () => []
        },
        title: {
            type: String,
            default: 'Related Resources'
        }
    },
    methods: {
        getDate(targetPost) {
            const date = new Date(targetPost.date)
            const number = date.getDate()
            const month = this.$root.months[date.getMonth()]

            return `${number} ${month}`
        },
        getImage(targetPost) {
            return _get(targetPost, 'featuredAttachment.sizes.full', {})
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';
$link-color: #00193e;
$date-color: #d0d3d8;

.single-related {
    padding: 0 30px 80px;

    & > .title {
        font-size: 48px;
        margin-bottom: 30px;
    }
    .list {
        padding: 0;
        margin: 0;
        list-style: none;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-column-gap: 25px;
    }
    .related-link {
        font-size: 20px;
        font-weight: 700;
        line-height: 1.5;
        text-decoration: none;
        color: $link-color;
        display: flex;
        flex-direction: column;
        height: 100%;
        @include featured-block-shadow;

        .text-wrap {
            padding: 0 30px 35px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .bottom-section {
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            flex: 1;
        }
        .post-title {
            margin-bottom: 10px;
            line-height: 1.4;
        }
        .author {
            color: $blue;
            font-weight: 400;
            font-size: 16px;
        }
        .date {
            font-size: 14px;
            font-weight: 500;
            text-transform: uppercase;
            color: $date-color;
            letter-spacing: 3px;
        }
    }

    // Mobile
    @media #{$lt-phone} {
        padding: 0 $mobile-padding 80px;

        .list {
            grid-template-columns: 1fr;
            grid-row-gap: 15px;
        }
    }
}
</style>
