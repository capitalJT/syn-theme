<template>
    <section class="front-page-results">
        <div class="top-wrap">
            <div class="triangles" />
            <div class="gradient" />
            <shared-promise-carousel />
        </div>

        <div class="bottom-wrap">
            <wp-content class="industries" :html="cmpIndustries" />
            <wp-content class="knowledge" :html="cmpKnowledge" />
        </div>
    </section>
</template>

<script>
export default {
    computed: {
        cmpLearnMoreCopy() {
            return _get(this.$store, 'state.pageData.acf.learn_more_copy', '')
        },
        cmpIndustries() {
            return _get(this.$store, 'state.pageData.acf.industries_copy', '')
        },
        cmpKnowledge() {
            return _get(
                this.$store,
                'state.pageData.acf.knowledge_base_copy',
                ''
            )
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

$blue-1: #106bff;
$blue-2: #0c62ed;
$blue-3: #085be2;
$gradient-start: #fff;
$gradient-end: #edf4ff;

.front-page-results {
    color: $white;
    text-align: center;

    .wp-content {
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 20px 20px;
        box-sizing: border-box;
    }

    .top-wrap {
        background: linear-gradient(to bottom, $gradient-start, $gradient-end);
        min-height: 60vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 20px;
        position: relative;

        // background
        .triangles {
            @include fill;
            top: 120px;
            background-image: url('images/patterns/blue-triangles.png');
            background-size: 100px;
        }
        .gradient {
            @include fill;
            top: 120px;
            background: linear-gradient(
                180deg,
                rgba(255, 255, 255, 1) 10%,
                rgba(255, 255, 255, 0) 100%
            );
        }

        .top-logo {
            width: 220px;
            height: auto;
            margin: 25px;
        }
        .main-results {
            h3,
            p {
                max-width: 760px;
                margin: 0 auto;
            }
            h3 {
                font-size: 48px;
            }
            p {
                font-size: 20px;
                margin-top: 30px;
                line-height: 1.3;
            }
        }
    }

    .bottom-wrap {
        display: flex;

        .wp-content {
            padding-top: 70px;
            padding-bottom: 70px;
        }
        h3,
        p {
            max-width: 400px;
            margin: 0 auto;
        }
        h3 {
            font-size: 40px;
            font-weight: 500;
        }
        p {
            margin-top: 20px;
            line-height: 1.3;
        }
        .shortcode-button {
            margin: 30px auto 0;
        }
    }
    .industries {
        background: $blue-2;
        width: 50%;
    }
    .knowledge {
        background: $blue-3;
        width: 50%;
    }

    // mobile breakpoints
    @media #{ $lt-phone } {
        .top-wrap {
            padding: 20px $mobile-padding;
        }
        .bottom-wrap {
            flex-direction: column;

            .wp-content {
                width: 100%;
                padding: 70px $mobile-padding 60px;
            }
            h3 {
                font-size: 30px;
            }
            .shortcode-button {
                box-sizing: border-box;
                width: 100%;
            }
        }
    }
}
</style>
