<template>
    <main :class="['blog']">
        <!-- landing -->
        <landing-section />

        <!-- Search bar -->
        <shared-search-bar
            placeholder="Search the Synack blog"
            :options="cmpCategories.map(cat => cat.name)"
        />

        <!-- Featured posts (only if not searching) -->
        <transition name="fade">
            <archive-featured
                class="contained"
                v-if="!cmpSearching"
                :posts="cmpFeaturedPosts"
            />
        </transition>

        <!-- List of links -->
        <ul
            :class="['links', 'contained', { 'showing-results': cmpSearching }]"
        >
            <li v-for="(post, i) in cmpPosts" :key="i">
                <transition name="fade" appear>
                    <archive-post-block
                        :post="post"
                        :color="colors[i % colors.length]"
                    />
                </transition>
            </li>
            <!-- <li v-if="this.pageData.nextPostsLink" class="load-trigger">
                <load-on-view :url="nextUrl" @data="loadNext" />
            </li> -->
        </ul>
    </main>
</template>

<script>
export default {
    async mounted() {
        let latest = null
        let canFetch = true
        while (canFetch) {
            latest = await fetch(this.nextUrl).then(res => {
                if (res.status >= 400) {
                    canFetch = false
                    return null
                } else {
                    return res.json()
                }
            })
            if (canFetch) {
                this.loadNext(latest)
            }
        }
    },
    data() {
        return {
            pageData,
            colors: ['green', 'blue', 'green', 'red', 'purple'],
            nextUrl: pageData.nextPostsLink + '?contentType=json',
            loadedPosts: []
        }
    },
    methods: {
        loadNext(data) {
            this.loadedPosts = this.loadedPosts.concat(_get(data, 'posts', []))
            this.nextUrl = data.nextPostsLink
        }
    },
    computed: {
        cmpAllPosts() {
            return _get(this, 'pageData.posts', []).concat(this.loadedPosts)
        },
        cmpFeaturedPosts() {
            return _get(this, 'pageData.featuredPosts', [])
        },
        cmpPosts() {
            // if we're not searching, get a list of all non-featured posts
            if (!this.cmpSearching) {
                const featuredIds = this.cmpFeaturedPosts.map(p => p.id)
                return this.cmpAllPosts.filter(p => !featuredIds.includes(p.id))
            }

            // if we are searching, prep for results
            let output = this.cmpAllPosts

            // first filter by category
            if (
                this.$store.state.searchCategory &&
                this.$store.state.searchCategory != 'All'
            ) {
                output = output.filter(post => {
                    const postCategories = _get(post, 'terms.category', []).map(
                        cat => cat.name.toLowerCase()
                    )
                    return postCategories.includes(
                        this.$store.state.searchCategory.toLowerCase()
                    )
                })
            }

            // next filter by title
            if (this.$store.state.searchTerm) {
                const titleMatches = output.filter(post => {
                    return post.title
                        .toLowerCase()
                        .includes(this.$store.state.searchTerm.toLowerCase())
                })

                const bodyMatches = output.filter(post => {
                    return post.content
                        .toLowerCase()
                        .includes(this.$store.state.searchTerm.toLowerCase())
                })

                output = [...new Set([...titleMatches, ...bodyMatches])]
            }

            return output
        },
        cmpCategories() {
            let output = _get(this, 'pageData.categories', [])

            // fixing a weird object/array bug
            if (typeof output === 'object' && output !== null) {
                output = Object.values(output)
            }

            return output
        },
        cmpSearching() {
            return (
                this.$store.state.searchTerm ||
                (this.$store.state.searchCategory &&
                    this.$store.state.searchCategory != 'All')
            )
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';
$search-results-input-border: #dfe6ee;

body.blog #app,
body.archive #app,
body.search #app {
    min-height: 100vh;
}
body.search header {
    position: absolute;
}

main.blog {
    padding: 0 30px;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-gap: 20px;

    .landing-section {
        padding: 0;
        height: 400px;
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
    }
    .search-title {
        margin-top: 100px;
        margin-bottom: 20px;
        grid-column: 1 / -1;
        font-size: 48px;
        width: 100%;

        & + .shared-search-bar {
            margin-top: 20px;
        }
    }
    .shared-search-bar {
        margin-top: 120px;
        margin-bottom: 30px;
        grid-column: 1 / -1;
    }
    .archive-featured {
        margin-bottom: 80px;
        position: relative;
        grid-column: 1 / -1;
    }
    .archive-category-list {
        height: 100%;
    }
    & > .links {
        grid-column: 1 / -1;
        list-style: none;
        padding: 0;
        margin: 0 auto 110px;
        width: 100%;
        max-width: 1000px;
        background: $white;

        li {
            width: 100%;

            a {
                width: 100%;
            }

            & + li {
                margin-top: 30px;
            }
        }
    }
    .more-posts {
        margin-top: 30px;
        color: $blue;
        text-transform: uppercase;
        font-size: 20px;
        font-weight: 500;
        text-decoration: none;
        letter-spacing: 1px;
        display: block;
    }

    // special search results styling
    &.search-results {
        grid-auto-flow: dense;
        grid-column-gap: 60px;

        & > .links {
            grid-column: 2 / span 3;
        }
        .shared-search-bar {
            grid-column: 2 / -1;
            margin: 0;
            width: 100%;

            svg circle,
            svg path {
                stroke: $blue;
            }
            .input {
                width: 100%;
                color: $black;
                border-bottom: 1px solid $search-results-input-border;

                &::-webkit-input-placeholder {
                    color: $black;
                }
            }
            .select,
            .arrow-down {
                display: none;
            }
        }
        .archive-category-list {
            grid-row: 2 / span 2;
        }
    }

    // Mobile
    @media #{$lt-phone} {
        padding: 0 $mobile-padding;

        .archive-featured {
            margin-bottom: 0;
        }
        &.search-results {
            display: block;
        }
        .shared-search-bar {
            margin-top: 80px;
        }
        .links {
            margin-bottom: 100px;

            li:last-child {
                text-align: center;
                margin-top: 85px;
            }
        }
    }
}
</style>
