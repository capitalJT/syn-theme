<template>
    <main class="view-page-layout">
        <!-- landing -->
        <landing-section :title="title" :content="content" />
        <component
            v-for="section in layoutSections"
            v-bind="section"
            :is="getCmpName(section)"
        />
    </main>
</template>

<script>
export default {
    data() {
        return {
            pageData: pageData
        }
    },
    computed: {
        title() {
            return _get(this.pageData, 'title')
        },
        content() {
            return _get(this.pageData, 'content')
        },
        layoutSections() {
            return _get(this.pageData, 'acf.layout', [])
        }
    },
    methods: {
        getCmpName(section) {
            const slug = _get(section, 'acf_fc_layout')
            return `page-layout-${slug}`
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

$border_color: #d6ddea;
$formtext_color: #8695ae;

body.page-template-template-page-layout #app {
    background-color: $navy;
    min-height: 100vh;
}

.view-page-layout {
    // landing
    .landing-section {
        -webkit-clip-path: polygon(100% 0, 110% 80%, 60% 100%, 0% 100%, 0 0);
        clip-path: polygon(100% 0, 110% 80%, 60% 100%, 0% 100%, 0 0);
        padding-bottom: 130px;
        z-index: 5;
    }
    .landing-section .title {
        font-size: 15vmin;

        @media only screen and (min-height: 700px) {
            font-size: 105px;
        }
    }
    .landing-section .info {
        max-width: 975px;
        margin: auto;

        .wp-content > *:first-child {
            margin-top: 0;
        }
    }
}

// mobile breakpoints
@media #{ $lt-phone } {
    .view-page-layout {
        overflow: hidden;

        .landing-section {
            -webkit-clip-path: polygon(
                100% 0,
                110% 97%,
                55% 100%,
                -10% 96%,
                0 0
            );
            clip-path: polygon(100% 0, 110% 97%, 55% 100%, -10% 96%, 0 0);
            padding-bottom: 70px;

            .title {
                font-size: 60px;
            }
        }
    }
}
</style>
