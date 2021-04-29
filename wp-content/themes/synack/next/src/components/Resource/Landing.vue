<template>
    <div class="resource-landing">
        <div class="text-wrap">
            <h1 class="title" v-html="post.title" />
            <a :href="cmpLink" class="clip-button blue">
                <span class="background"></span>
                <span class="text">
                    <component :is="cmpSvg" class="icon" />
                    <span v-html="cmpCta" />
                </span>
            </a>
        </div>

        <div class="image-wrap">
            <responsive-image
                class="image"
                :src="cmpImage.url"
                :width="cmpImage.width"
                :height="cmpImage.height"
                :fill-space="true"
            />
        </div>
    </div>
</template>

<script>
export default {
    props: {
        post: {
            type: Object,
            default: () => {}
        }
    },
    computed: {
        cmpCta() {
            return _get(this.post, 'meta.call_to_action_label', '')
        },
        cmpImage() {
            return _get(this.post, 'acf.featured_image', {})
        },
        cmpLink() {
            return _get(this.post, 'meta.call_to_action_url', '')
        },
        cmpSvg() {
            switch (_get(this.post, 'acf.icon', 'Paper')) {
                case 'Arrow':
                    return 'svg-icon-resource-arrow'
                case 'Play':
                    return 'svg-icon-resource-play'
                default:
                    return 'svg-icon-resource-paper'
            }
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

.resource-landing {
    display: flex;
    align-items: center;
    position: relative;

    .text-wrap {
        box-shadow: rgba(#00193e, 0.14) 0 12px 34px;
        padding: 30px;
        background: $white;
        width: 60%;
        margin: 50px 0;
        z-index: 5;

        .title {
            margin: 0 0 25px;
            font-size: 48px;
        }
    }
    .image-wrap {
        position: absolute;
        top: 0;
        right: 0;
        height: 100%;
        width: 40%;
    }

    .clip-button {
        background: #106bff;
        padding: 25px 30px;
        border-radius: 40px;
        font-size: 16px;
        white-space: nowrap;
        text-decoration: none;
        color: $white;
        display: inline-block;

        svg {
            position: relative;
            top: 1px;
            margin-right: 5px;

            * {
                stroke: $white;
                transition: 0.3s;
            }
        }
        .text {
            font-weight: 400;
        }

        .not-mobile &:hover,
        .not-mobile &:focus {
            svg {
                * {
                    stroke: $blue;
                }
            }
        }
    }

    @media #{$lt-phone} {
        flex-direction: column;
        width: 100%;

        .text-wrap {
            width: 100%;
            order: 1;
            margin: -30px 0 0;
            box-sizing: border-box;

            .title {
                font-size: 30px;
            }
        }
        .image-wrap {
            position: relative;
            width: 100%;
            padding-bottom: 100%;
        }
        .clip-button {
            width: 100%;
            box-sizing: border-box;
            text-align: center;
        }
    }
}
</style>
