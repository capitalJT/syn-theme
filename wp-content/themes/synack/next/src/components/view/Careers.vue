<template>
    <main class="view-careers">
        <!-- Landing -->
        <landing-section :title="acf.title" :content="acf.content" />

        <!-- Slideshow -->
        <company-page-initiatives
            :content="acf.slideshow_intro"
            :items="acf.slideshow_images"
            hide-filter
        />

        <!-- Team Values -->
        <company-page-values
            :team_intro="acf.team_intro"
            :values_intro="acf.values_intro"
            :alternating_columns="acf.alternating_columns"
        />

        <!-- Benefits -->
        <company-page-benefits
            :icon_grid_headline="acf.icon_grid_headline"
            :icon_grid_intro="acf.icon_grid_intro"
            :icon_grid="acf.icon_grid"
        />

        <!-- Openings intro -->
        <company-page-openings-intro
            :openings_headline="acf.openings_headline"
            :openings_intro="acf.openings_intro"
        />

        <!-- Openings -->
        <div class="openings-wrap">
            <div id="grnhse_app"></div>
            <div v-html="scriptTag" />
        </div>
    </main>
</template>

<script>
export default {
    data() {
        return {
            pageData: pageData,
            scriptTag:
                '<script src="https://boards.greenhouse.io/embed/job_board/js?for=synack"></ ' +
                'script>'
        }
    },
    computed: {
        acf() {
            return _get(this.pageData, 'acf')
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';
$gradient-bottom: #edf4ff;

body.page-template-template-careers #app {
    background-color: $navy;
    min-height: 100vh;

    .openings-wrap {
        #content {
            display: none;
        }
    }
}

main.view-careers {
    .company-page-initiatives .initiatives-carousel .images {
        @media only screen and (max-width: 790px) {
            top: 0;
            height: initial;
        }
    }
    .carousel-placeholder,
    .company-page-slide {
        height: 300px;
        width: 500px;
        min-width: 500px;
    }
    .company-page-initiatives .initiatives-carousel .company-page-slide {
        @media only screen and (max-width: 790px) {
            padding-bottom: 56.25%;
        }
    }
}

.view-products {
    background: linear-gradient(to bottom, $white, $gradient-bottom);

    // fade transition
    .fade-enter-active,
    .fade-leave-active {
        transition: opacity 150ms;
    }
    .fade-enter,
    .fade-leave-to {
        opacity: 0;
    }
}
</style>
