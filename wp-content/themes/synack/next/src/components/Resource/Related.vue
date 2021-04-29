<template>
    <nav class="resource-related contained">
        <h2 class="title" v-html="title" />

        <ul class="list">
            <li v-for="(post, i) in posts" :key="i">
                <a :href="post.permalink" class="related-link">
                    <responsive-image
                        aspect="100"
                        class="image"
                        :src="getImage(post).url"
                        :alt="
                            post.featuredAttachment
                                ? post.featuredAttachment.alt
                                : ''
                        "
                    />
                    <h3 class="post-title" v-html="post.title" />
                    <span class="link">
                        <component :is="getSvg(post)" class="icon" />
                        <span class="cta-label" v-html="getCta(post)" />
                    </span>
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
        getImage(targetPost) {
            let output = _get(targetPost, 'acf.featured_image', false)
            if (!output) {
                output = _get(targetPost, 'acf.featured_thumbnail', {})
            }
            return output
        },
        getSvg(resource) {
            switch (_get(resource, 'acf.icon', 'Paper')) {
                case 'Arrow':
                    return 'svg-icon-resource-arrow'
                case 'Play':
                    return 'svg-icon-resource-play'
                default:
                    return 'svg-icon-resource-paper'
            }
        },
        getCta(resource) {
            return _get(resource, 'meta.call_to_action_label', '')
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';
$link-color: #00193e;

.resource-related {
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

        .post-title {
            margin-bottom: 10px;
        }
        .cta-label {
            color: $blue;
            font-weight: 400;
            font-size: 16px;
        }
    }

    @media #{$lt-phone} {
        padding: 0 $mobile-padding 80px;

        .list {
            grid-template-columns: 1fr;
            grid-row-gap: 20px;
        }
        .related-link {
            .post-title {
                margin: 10px 0 5px;
            }
        }
    }
}
</style>
