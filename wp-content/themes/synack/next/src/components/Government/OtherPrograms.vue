<template>
    <section class="government-other-programs">
        <ul class="program-wrap contained">
            <li
                v-for="(program, i) in cmpPrograms"
                :key="i"
                class="program"
                v-in-view="{ paddingBottom: 0.3 }"
            >
                <component
                    class="wrapper"
                    :is="getLink(program) ? 'a' : 'div'"
                    :href="getLink(program)"
                    target="_blank"
                    rel="noreferrer noopener"
                >
                    <responsive-image
                        :src="program.image.url"
                        :alt="program.image.alt"
                        :fill-space="true"
                    />
                    <svg-arrow-up-right v-if="getLink(program)" />
                    <h3 class="title" v-html="program.title" />
                    <h4
                        class="subtitle"
                        v-html="program.subtitle"
                        :style="{ color: getColor(program) }"
                    />
                    <wp-content class="info" :html="program.content" />
                </component>
            </li>
        </ul>
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
        cmpPrograms() {
            return _get(this.pageData, 'acf.programs', [])
        }
    },
    methods: {
        getLink(program) {
            return _get(program, 'link', '')
        },
        getColor(program) {
            return _get(program, 'subtitle_color', '#0b1221')
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

$body-background: #edf4ff;
$shadow: darken($body-background, 50%);

.government-other-programs {
    background: $body-background;
    background-image: url('images/patterns/dots.png');
    background-size: 10px;
    padding-bottom: 45px;

    .program-wrap {
        padding: 0;
        list-style: none;
        transform: translateY(-70px);

        .program {
            transition: transform 0.8s, opacity 0.8s;

            &.below-view:not(.fired-once) {
                transform: translateY(100px);
                opacity: 0;
            }
            & + .program {
                margin-top: 40px;
            }
            .wrapper {
                padding: 180px 100px;
                background: $white;
                position: relative;
                width: 90%;
                min-width: 750px;
                margin: 0 auto;
                box-shadow: 0 0 30px rgba($shadow, 0.1);
                --slide-highlight-color: #{$navy};
                display: block;
                text-decoration: none;
                box-sizing: border-box;
                overflow: hidden;

                .responsive-image {
                    -webkit-clip-path: polygon(
                        100.1% 80%,
                        40% -0.1%,
                        100.1% -1%
                    );
                    clip-path: polygon(100.1% 80%, 40% -0.1%, 100.1% -1%);
                }
                .svg-arrow-up-right {
                    position: absolute;
                    top: 30px;
                    right: 30px;
                }
                .wp-content {
                    width: 75%;
                    line-height: 1.6;
                    color: #8694af;

                    & > *:last-child {
                        margin-bottom: 0;
                    }
                }
                .title {
                    font-weight: 700;
                    font-size: 40px;
                    line-height: 1;
                    color: $navy;
                    margin: 0;
                    width: 58%;
                }
                .subtitle {
                    font-family: $font-body;
                    font-weight: 400;
                    font-size: 24px;
                    margin: 15px 0;
                    color: $navy;
                    color: var(--slide-highlight-color);
                    width: 58%;
                }
            }
        }

        // hover state
        .not-mobile & a.wrapper:hover,
        .not-mobile & a.wrapper:focus {
            .responsive-image {
                filter: url(#shared-glitch-filter);
            }
        }
    }

    @media #{$lt-phone} {
        .program-wrap {
            padding: 0 20px;

            .program .wrapper {
                padding: 50px 30px 100px;
                min-width: initial;
                width: 100%;

                .responsive-image {
                    -webkit-clip-path: polygon(0% 100%, 100% 75%, 100% 100%);
                    clip-path: polygon(0% 100%, 100% 75%, 100% 100%);
                }
                .svg-arrow-up-right {
                    position: absolute;
                    top: initial;
                    bottom: 30px;
                }
                .title {
                    font-size: 26px;
                    width: 100%;
                }
                .subtitle {
                    font-size: 20px;
                    width: 100%;
                    line-height: 1.4;
                }
                .wp-content {
                    width: 100%;
                }
            }
        }
    }
}
</style>
