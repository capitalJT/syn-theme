<template>
    <section class="government-landing">
        <shared-clipped-landing :title="title" />

        <div class="content-wrap contained">
            <wp-content :html="content" />
            <div class="image-wrap">
                <responsive-image :src="heroSrc" :video-src="video" />
            </div>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            pageData
        }
    },
    computed: {
        title() {
            return _get(this.pageData, 'title')
        },
        content() {
            return _get(this.pageData, 'content')
        },
        heroSrc() {
            return _get(this.pageData, 'acf.hero_image.url')
        },
        video() {
            return _get(this.pageData, 'acf.hero_video')
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

$background-color: #edf4ff;
$body-color: #8694af;
$strong-color: #535e76;

body.page-template-template-government #app {
    background-color: $navy;
    min-height: 100vh;
}

.government-landing {
    background: $background-color;
    padding-bottom: 80px;
    overflow-x: hidden;

    .company-page-landing {
        -webkit-clip-path: polygon(
            100% 0px,
            110% 80%,
            19.8% 100%,
            -10% 92%,
            0px 0px
        );
        clip-path: polygon(100% 0px, 110% 80%, 19.8% 100%, -10% 92%, 0px 0px);
        position: relative;
        z-index: 5;
        padding: 135px 0 155px;

        .title h2 {
            font-size: 14.5vmin;
        }
    }
    .content-wrap {
        display: grid;
        grid-template-columns: 50% 50%;
        grid-column-gap: 40px;
        transform: translateY(-50px);
        min-height: 60vh;

        .wp-content {
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding-bottom: 40px;

            h3 {
                font-size: 60px;
                margin-top: 160px;
            }
            p {
                color: $body-color;
                font-size: 20px;
                line-height: 30px;

                strong {
                    color: $strong-color;
                    font-size: 18px;
                    letter-spacing: 2px;
                    text-transform: uppercase;
                    font-weight: 400;
                }
            }
        }
        .image-wrap {
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin-top: 160px;
        }
    }

    @media #{$lt-phone} {
        padding-bottom: 0;

        .company-page-landing {
            .title h2 {
                font-size: 13vmin;
            }
        }
        .content-wrap {
            display: block;
            padding: 60px 20px 0;

            .wp-content {
                padding-bottom: 0;

                h3 {
                    font-size: 30px;
                    margin-bottom: 0;
                }
                & > *:last-child {
                    margin-bottom: 0;
                }
            }
        }
    }
}
</style>
