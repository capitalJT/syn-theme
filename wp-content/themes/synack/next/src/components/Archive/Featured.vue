<template>
    <section class="archive-featured">
        <archive-main-featured :post="cmpMainPost" />

        <archive-post-block
            v-for="(post, i) in cmpOtherPosts"
            :post="post"
            :featured="true"
            :key="i"
            :color="colors[i]"
        />
    </section>
</template>

<script>
export default {
    props: {
        posts: {
            type: Array,
            default: () => []
        }
    },
    data() {
        return {
            colors: ['purple', 'red', 'purple', 'green']
        }
    },
    computed: {
        cmpMainPost() {
            return _get(this, 'posts[0]', {})
        },
        cmpOtherPosts() {
            // empty array if not enough posts
            if (this.posts.length <= 1) {
                return []
            }

            // otherwise,return all posts after the first one
            return _get(this, 'posts', []).slice(1)
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

.archive-featured {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-gap: 20px;
    grid-auto-flow: dense;

    .archive-main-featured {
        grid-column: 1 / span 3;
    }
    .archive-post-block:nth-child(4) {
        grid-column: 2 / span 2;
    }

    // Mobile
    @media #{$lt-phone} {
        grid-template-columns: 1fr;

        .archive-main-featured,
        & > .archive-post-block,
        & > .archive-post-block:nth-child(4) {
            grid-column: 1 / span 1;
        }
    }
}
</style>
