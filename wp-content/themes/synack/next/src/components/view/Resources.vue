<template>
    <main class="resources">
        <!-- landing -->
        <landing-section :title="title" :content="content" />

        <!-- Search bar -->
        <shared-search-bar :options="cmpResourceTypes" />

        <!-- Resource grid -->
        <div class="resource-grid contained">
            <div
                class="resource-wrap"
                v-for="(resource, i) in cmpResources"
                :key="i"
            >
                <transition name="fade" appear>
                    <resource-block :resource="resource" />
                </transition>
            </div>

            <!-- Next page -->
            <!-- <load-on-view :url="nextUrl" @data="loadNext" /> -->
        </div>
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
            nextUrl: pageData.nextPostsLink + '?contentType=json',
            loadedResources: []
        }
    },
    methods: {
        loadNext(data) {
            this.loadedResources = this.loadedResources.concat(
                _get(data, 'posts', [])
            )
            this.nextUrl = data.nextPostsLink
        }
    },
    computed: {
        cmpResourceTypes() {
            let output = _get(this, 'pageData.resourceTypes', [])

            // fixing a weird object/array bug
            if (typeof output === 'object' && output !== null) {
                output = Object.values(output)
            }

            return output
        },
        content() {
            return _get(this.pageData, 'options.resources_info', '')
        },
        title() {
            return _get(this.pageData, 'options.resources_title', 'Resources')
        },
        cmpAllResources() {
            return this.pageData.posts.concat(this.loadedResources)
        },
        cmpSearching() {
            return (
                this.$store.state.searchTerm ||
                (this.$store.state.searchCategory &&
                    this.$store.state.searchCategory != 'All')
            )
        },
        cmpResources() {
            // if we're not searching, get all resources
            if (!this.cmpSearching) {
                return this.cmpAllResources
            }

            // if we are searching, prep for results
            let output = this.cmpAllResources

            // first filter by resource type
            if (
                this.$store.state.searchCategory &&
                this.$store.state.searchCategory != 'All'
            ) {
                output = output.filter(post => {
                    const postCategories = _get(
                        post,
                        'terms["resource-type"]',
                        []
                    ).map(cat => cat.name.toLowerCase())
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
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

.resources {
    .landing-section {
        .title {
            font-size: 125px;
        }
        .info {
            padding-bottom: 80px;
        }
    }
    .shared-search-bar {
        margin-top: -190px;
    }
    .resource-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        grid-gap: 40px 25px;
        padding: 0 30px 80px;
        position: relative;
    }
    .next-page {
        font-size: 24px;
        font-weight: 700;
        color: $blue;
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 1px;
        grid-column-start: 1;
        margin: 30px 0 15px;
        display: block;
    }

    // Mobile
    @media #{ $lt-phone } {
        .landing-section {
            padding-top: 90px;
            padding-bottom: 210px;

            .title {
                font-size: 50px;
            }
            .info .wp-content {
                display: none;
            }
        }
        .shared-search-bar {
            margin: -260px $mobile-padding 30px;
            width: calc(100% - #{$mobile-padding * 2});
        }

        .resource-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media only screen and (max-width: 500px) {
        .resource-grid {
            padding: 0 $mobile-padding 30px;
            display: block;

            .resource-wrap + .resource-wrap {
                margin-top: 25px;
            }
        }
    }
}

// @media only screen and (min-height: 700px) {
//     main.resources .landing-section .title {
//         font-size: 105px;
//     }
// }
</style>
