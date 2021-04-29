<template>
    <main class="view-partner-child">
        <!-- landing -->
        <landing-section :title="title" :content="content" />

        <!-- two columns -->
        <partner-child-two-column
            :centered-column="pageData.meta.centered_column"
            :left-column="pageData.meta.left_column"
            :right-column="pageData.meta.right_column"
        />

        <!-- breakout -->
        <partner-child-breakout />

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
                logos: this.pageData.acf.partner_logos
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

.page-id-7339 .existing-partners {
    margin-top: 0 !important;
}

body.page-template-template-partner-child {
    .view-partner-child {
        background: linear-gradient(
            to bottom,
            rgba(238, 244, 255, 0),
            rgba(238, 244, 255, 1)
        );

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
    .partner-child-two-column {
        strong {
            color: $black;
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
