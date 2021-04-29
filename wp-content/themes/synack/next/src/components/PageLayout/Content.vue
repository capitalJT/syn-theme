<template>
    <section class="page-layout-content">
        <wp-content class="content" v-html="content" />
    </section>
</template>

<script>
export default {
    props: {
        content: String
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

$body-color: #061023;
$caption-color: #8695ae;

.page-layout-content {
    & > .content {
        margin-top: 70px;
        margin-bottom: 100px;

        & > *:first-child {
            margin-top: 0;
        }
        & > * {
            max-width: 750px;
            margin: 30px auto 0;
        }
        h2 {
            font-size: 40px;
            font-weight: 500;
        }
        ul {
            padding-left: 100px;
            box-sizing: border-box;
            list-style: none;
        }
        li {
            font-size: 20px;
            line-height: 1.6;
            position: relative;

            & + li {
                margin-top: 30px;
            }
            &::before {
                content: '';
                width: 72px;
                height: 1px;
                display: block;
                background-image: url(/wp-content/themes/synack/next/static/images/single-bullet.png);
                background-repeat: no-repeat;
                position: absolute;
                top: 0.8em;
                right: calc(100% + 28px);
            }
        }
        p {
            font-size: 20px;
            line-height: 1.6;
            color: $body-color;
        }
        blockquote {
            font-weight: 500;
            font-size: 24px;
            text-align: center;
            padding: 0 100px;
            box-sizing: border-box;
        }
        img {
            width: 100%;
            height: auto;
        }
        .wp-caption {
            // override some inline styling
            width: 100% !important;
        }
        .wp-caption-text {
            margin: 5px 20px 0;
            font-size: 16px;
            color: $caption-color;
            font-style: italic;
        }
        .gallery {
            max-width: 100%;
            display: grid;
            grid-template-columns: repeat(2, 1fr);

            &[data-image-count='3'] {
                grid-template-columns: repeat(3, 1fr);
            }
            &[data-image-count='4'] {
                grid-template-columns: repeat(4, 1fr);
            }
        }
    }

    // Mobile
    @media #{$lt-phone} {
        padding: 80px $mobile-padding 0;
        margin: 0;

        & > .content {
            blockquote {
                padding: 0 10px;
            }
            .gallery {
                display: block;
            }
        }

        .wp-content {
            margin-top: 0;

            ul {
                padding-left: 50px;
            }
            li {
                &::before {
                    width: 30px;
                    right: calc(100% + 18px);
                }
            }
        }
    }
}
</style>
