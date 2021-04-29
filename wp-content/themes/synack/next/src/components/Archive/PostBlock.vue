<template>
    <a :class="[{ featured }, 'archive-post-block']" :href="post.permalink">
        <div class="block-image">
            <responsive-image
                class="background"
                :src="cmpImage.url"
                :width="cmpImage.width"
                :height="cmpImage.height"
                :alt="cmpAlt"
                :fill-space="true"
            >
                <archive-color-overlay :color="color" />
            </responsive-image>
        </div>
        <div class="content-wrap">
            <h2 class="title" ref="title" v-html="post.title" />
            <div class="author" v-html="post.author" />

            <div class="date-wrap">
                <span class="number">{{ cmpDate.getDate() }}</span>
                <span class="month">
                    {{ $root.months[cmpDate.getMonth()] }}
                </span>
            </div>
        </div>
    </a>
</template>

<script>
import clamp from 'clamp-js'

export default {
    props: {
        post: {
            type: Object,
            default: () => {}
        },
        featured: {
            type: Boolean,
            default: false
        },
        color: {
            type: String,
            default: 'red'
        }
    },
    async mounted() {
        await this.$nextTick()
        clamp(this.$refs.title, { clamp: 3 })
    },
    computed: {
        cmpImage() {
            return _get(this.post, 'featuredAttachment.sizes.full', {})
        },
        cmpAlt() {
            return _get(this.post, 'featuredAttachment.alt', '')
        },
        cmpDate() {
            return new Date(this.post.date)
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

.archive-post-block {
    display: flex;
    flex-direction: column;
    @include featured-block-shadow;
    color: $black;
    text-decoration: none;
    position: relative;
    z-index: 5;

    .block-image {
        height: 40%;
        position: relative;

        img {
            filter: grayscale(95%);
        }
    }
    .content-wrap {
        background: $white;
        padding: 30px 30px 50px;
        flex: 1;
        display: grid;
        grid-template-rows: [headline] 1fr [author] auto [date] auto;
    }
    .title {
        margin: 0 0 50px;
        font-size: 24px;
    }
    .author {
        color: $blue;
        font-size: 16px;
        margin-bottom: 10px;
        white-space: nowrap;
        width: 100%;
    }
    .date-wrap {
        color: $date-gray;
        font-size: 14px;
        text-transform: uppercase;
        font-weight: 500;
        letter-spacing: 3px;
    }

    &.featured {
        display: block;

        .block-image {
            height: 180px;
        }
        .content-wrap {
            height: 260px;
            box-sizing: border-box;
            padding: 30px 30px 30px;
        }
        .title {
            line-height: 1.4;
            width: 100%;
        }
    }

    // non-featured block - rows
    &:not(.featured) {
        background: transparent;
        box-shadow: transparent 0 12px 34px;
        transition: background 0.3s, box-shadow 0.3s;
        flex-direction: row;
        position: relative;

        .block-image {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            width: 40%;
            height: 100%;
        }
        .content-wrap {
            margin-left: calc(40% + 50px);
            padding: 35px 30px 35px 0;
        }
        .title {
            margin-bottom: 10px;
        }

        .not-mobile &:hover,
        .not-mobile &:focus {
            @include featured-block-shadow;
            background: $white;
        }
    }

    // Mobile
    @media #{$lt-phone} {
        box-shadow: none;

        .content-wrap {
            padding: 10px 0;
        }

        .title {
            margin-bottom: 15px;
        }
        .date-wrap {
            padding-bottom: 10px;
        }

        &:not(.featured) {
            display: block;

            .block-image {
                position: relative;
                width: 100%;
                padding-bottom: 45%;
            }
            .content-wrap {
                width: 100%;
                margin-left: 0;
                padding: 10px;
            }
            .title {
                font-size: 20px;
                line-height: 1.5;
                margin-bottom: 10px;
            }
            & + .archive-post-block {
                margin-top: 0;
            }
        }
        &.featured {
            height: initial;

            .block-image {
                position: relative;
                width: 100%;
                padding-bottom: 45%;
                height: 0;
                min-height: 0;
            }
            .content-wrap {
                height: initial;
            }
        }
    }
}
</style>
