<template>
    <component
        :is="isLink ? 'a' : 'div'"
        :class="[
            'archive-main-featured',
            { 'has-image': Object.keys(cmpImage).length }
        ]"
        :href="isLink ? post.permalink : ''"
    >
        <responsive-image
            class="background"
            :src="cmpImage.url"
            :width="cmpImage.width"
            :height="cmpImage.height"
            :alt="cmpAlt"
            :fill-space="!$store.getters.isMobile"
        >
            <archive-color-overlay color="red" />
        </responsive-image>
        <div class="content-wrap">
            <span class="date-number">{{ cmpDate.getDate() }}</span>
            <span class="month-year-wrap">
                <span class="date-month">{{
                    $root.months[cmpDate.getMonth()]
                }}</span>
                <span class="line" />
                <span class="date-year">{{ cmpDate.getFullYear() }}</span>
            </span>

            <h1 class="title" ref="title" v-html="post.title" />
            <div class="author" v-html="post.author" />
        </div>
    </component>
</template>

<script>
import clamp from 'clamp-js'

export default {
    props: {
        post: {
            type: Object,
            default: () => {}
        },
        isLink: {
            type: Boolean,
            default: true
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
$mobile-color: #8695ae;

.archive-main-featured {
    position: relative;
    color: $black;
    @include featured-block-shadow;
    height: 440px;

    .responsive-image img {
        filter: grayscale(95%);
    }
    .content-wrap {
        position: absolute;
        right: 0;
        bottom: 0;
        width: 85%;
        height: 260px;
        background: $white;
        padding: 40px 40px 30px;
        box-sizing: border-box;
        display: grid;
        grid-template-columns: [date] auto [content] 1fr;
        grid-template-rows: [top] 135px [bottom] auto;
        grid-column-gap: 40px;
        grid-row-gap: 15px;
        clip-path: polygon(101% 0%, 101% 100%, 0% 100%, 0% 30px, 30px 0%);
    }
    .date-number {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 150px;
        font-size: 13vmin;
        font-weight: 700;
        background: url(/wp-content/themes/synack/next/static/images/patterns/dots-dark.png);
        background-size: 4px;
        -webkit-text-fill-color: transparent;
        text-fill-color: transparent;
        -webkit-background-clip: text;
        background-clip: text;
        transform: translateY(1vh);
    }
    .month-year-wrap {
        grid-area: bottom / date / span 1 / span 1;
        font-size: 18px;
        display: flex;
        align-items: flex-end;
        color: $date-gray;
        text-transform: uppercase;

        .line {
            flex: 1;
            height: 2px;
            background: $date-gray;
            margin: 0 10px;
            transform: translateY(-0.5em);
        }
    }
    .date-wrap {
        grid-row: top / span 2;
        padding-right: 25px;
        border-right: 1px solid $light-gray;
    }
    .title {
        font-size: 40px;
        font-weight: 500;
        margin: 0;
    }
    .author {
        color: $blue;
        font-size: 18px;
        display: flex;
        align-items: flex-end;
    }

    // Mobile
    @media #{$lt-phone} {
        text-decoration: none;
        height: initial;

        .content-wrap {
            position: relative;
            bottom: 40px;
            width: 100%;
            box-sizing: border-box;
            padding: 0 0 40px;
            grid-column-gap: 0;
            grid-template-columns: [date] min-content [content] 1fr;
            height: initial;
        }
        .date-number {
            background: url(/wp-content/themes/synack/next/static/images/patterns/dots.png);
            background-size: 4px;
            -webkit-text-fill-color: initial;
            text-fill-color: initial;
            font-size: 60px;
            padding: 10px 20px 0 30px;
            transform: none;
            color: $mobile-color;
            justify-content: flex-start;
        }
        .month-year-wrap {
            background: url(/wp-content/themes/synack/next/static/images/patterns/dots.png);
            background-size: 4px;
            grid-area: initial;
            flex-direction: column;
            color: $mobile-color;
            align-items: flex-start;
            justify-content: center;

            .date-month {
                padding-bottom: 10px;
            }
            .line {
                display: none;
            }
            .date-year {
                padding-bottom: 5px;
            }
        }
        .title {
            grid-column: 1 / -1;
            padding: 0 30px;
            font-size: 30px;
            font-weight: 700;
        }
        .author {
            padding: 0 30px;
            grid-column: 1 / -1;
        }
    }
}
</style>
