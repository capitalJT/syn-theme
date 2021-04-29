<template>
    <main class="view-partner-program">
        <!-- landing -->
        <landing-section :title="title" :content="content" />

        <!-- two columns -->
        <partner-program-two-column
            :left-column="pageData.meta.left_column"
            :right-column="pageData.meta.right_column"
        />

        <!-- opportunities -->
        <h3 class="small-title">
            {{ pageData.meta.partnership_opportunities_title }}
        </h3>

        <partner-program-opportunities :items="cmpPartnerOpportunities" />

        <!-- End link -->
        <!-- <div class="end-link-wrap">
            <a :href="acf.link_url" target="_blank" class="end-link">
                {{ acf.link_text }}
            </a>
        </div> -->

        <!-- Grid -->
        <partner-program-partner-grid v-bind="cmpPartnerLogos" />

        <!-- Existing partners -->
        <div
            class="existing-partners"
            v-html="pageData.acf.existing_partners"
        />
    </main>
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
        cmpPartnerOpportunities() {
            return this.pageData.acf.partnership_opportunities.cells
        },
        cmpPartnerLogos() {
            return {
                introduction: this.pageData.acf.introduction,
                logos: this.pageData.acf.logos
            }
        },
        acf() {
            return this.pageData.acf.partnership_opportunities
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

body.page-template-template-partner-program {
    .view-partner-program {
        background: linear-gradient(to bottom, transparent, #eef4ff);

        .title {
            line-height: 0.78;
        }
    }
    .small-title {
        text-align: center;
        font-size: 60px;
        margin: 0 30px;

        @media (max-width: 800px) {
            font-size: 30px;
        }
    }
    .end-link-wrap {
        text-align: center;

        .end-link {
            @include shortcode-button($blue, $blue);
            transition: opacity 0.3s;

            &:hover,
            &:focus {
                opacity: 0.7;
            }
        }
    }

    .existing-partners {
        background: $blue;
        text-align: center;
        color: $white;
        padding: 95px 30px;
        margin-top: 95px;
        font-size: 20px;
        font-weight: 700;

        @media (max-width: 850px) {
            font-size: 18px;
        }

        img {
            width: 215px;
            height: auto;
        }
        h3 {
            font-size: 60px;

            @media (max-width: 850px) {
                font-size: 40px;
            }
        }
        p {
            max-width: 900px;
            line-height: 1.5;
            margin-right: auto;
            margin-left: auto;
        }
    }
}
</style>
