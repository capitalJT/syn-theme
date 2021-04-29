<template>
    <a
        class="resource-block"
        :href="cmpLink"
        :target="resource.content ? '' : '_blank'"
    >
        <responsive-image
            :src="cmpImage.url"
            :width="cmpImage.width"
            :height="cmpImage.height"
            aspect="100"
        />
        <div class="content-wrap">
            <h3 class="title" v-html="resource.title" />

            <span class="link">
                <component :is="cmpSvg" class="icon" />
                <span class="cta-label" v-html="cmpCta" />
            </span>
        </div>
    </a>
</template>

<script>
export default {
    props: {
        resource: {
            type: Object,
            default: () => {}
        }
    },
    computed: {
        cmpImage() {
            let output = _get(this.resource, 'acf.featured_image', false)
            if (!output) {
                output = _get(this.resource, 'acf.featured_thumbnail', {})
            }

            return output
        },
        cmpSvg() {
            switch (_get(this.resource, 'acf.icon', 'Paper')) {
                case 'Arrow':
                    return 'svg-icon-resource-arrow'
                case 'Play':
                    return 'svg-icon-resource-play'
                default:
                    return 'svg-icon-resource-paper'
            }
        },
        cmpCta() {
            return _get(this.resource, 'meta.call_to_action_label', '')
        },
        cmpLink() {
            if (this.resource.content) {
                return this.resource.permalink
            }

            return _get(this.resource, 'meta.call_to_action_url', '')
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';
$dark-blue: #00193e;
$bright-blue: #106bff;

.resource-block {
    color: $dark-blue;
    text-decoration: none;
    display: flex;
    flex-direction: column;

    .content-wrap {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;

        .title {
            font-size: 20px;
            line-height: 1.5;
            margin: 15px 0;
        }
        .link {
            svg {
                position: relative;
                top: 2px;
            }
        }
        .cta-label {
            color: $bright-blue;
            font-size: 16px;
            margin-left: 5px;
        }
    }
}
</style>
