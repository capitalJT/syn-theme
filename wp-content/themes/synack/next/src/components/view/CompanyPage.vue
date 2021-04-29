<template>
    <main class="company-page">
        <!-- landing text -->
        <shared-clipped-landing :title="title" :content="content" />

        <!-- initiatives -->
        <company-page-initiatives
            :content="initiativesContent"
            :items="initiativeItems"
        />

        <!-- team -->
        <company-page-team :team-members="teamMembers" />

        <!-- careers -->
        <company-page-careers :content="careersContent" />

        <!-- investors -->
        <company-page-investors :title="investorsTitle" :items="investors" />

        <!-- awards -->
        <company-page-awards
            label="Awards"
            :title="awardsTitle"
            :items="awards"
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
        initiativesContent() {
            return _get(this.pageData, 'acf.initiatives_content', '')
        },
        initiativeItems() {
            return _get(this.pageData, 'acf.initiatives', [])
        },
        teamMembers() {
            return _get(this.pageData, 'acf.team_members', [])
        },
        careersContent() {
            return _get(this.pageData, 'acf.careers_content', [])
        },
        investorsTitle() {
            return _get(this.pageData, 'acf.investors_title', '')
        },
        investors() {
            return _get(this.pageData, 'acf.investors', [])
        },
        awardsTitle() {
            return _get(pageData, 'acf.awards_title', '')
        },
        awards() {
            return _get(this.pageData, 'acf.awards', [])
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

main.company-page {
    .company-page-landing {
        .contained {
            padding: 0 30px;

            @media #{$lt-desktop} {
                display: block;
                // text-align: center;
            }
        }
        .title {
            @media #{$lt-desktop} {
                // scale with screen width below desktop sizes
                // font-size: 10vw;
                margin-right: auto;
                margin-left: auto;
                width: 100%;
                text-align: center;
            }
        }
    }
}

// mobile breakpoints
@media #{ $lt-phone } {
    main.company-page {
        .company-page-landing {
            .entry {
                padding-right: $mobile-padding;
                padding-left: $mobile-padding;
            }
        }
    }
}
</style>
