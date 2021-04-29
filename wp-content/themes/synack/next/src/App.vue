<template>
    <div class="app-wrap">
        <shared-glitch-filter />
        <component :is="template" />
    </div>
</template>

<script>
import store from '~/src/store'
import _kebabCase from 'lodash/kebabCase'
import screenMouse from './libs/screenMouse'

export default {
    el: '#app',
    mixins: [
        screenMouse({ bottomLeft: { x: -1, y: 1 }, topRight: { x: 1, y: -1 } })
    ],
    store,
    data() {
        return {
            months: [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December'
            ]
        }
    },
    computed: {
        template() {
            // use front page if we're the front page
            if (_get(pageData, 'isFrontPage', false)) {
                return 'view-front-page'
            }
            // same for blog
            if (
                _get(pageData, 'isBlogPage', false) ||
                _get(pageData, 'isArchive', false) ||
                _get(pageData, 'isSearch', false) ||
                _get(pageData, 'isCategory', false)
            ) {
                return 'view-archive'
            }
            // same for resources
            if (_get(pageData, 'isResourcesPage', false)) {
                return 'view-resources'
            }

            // otherwise, look for the appropriate view
            const templates = {
                'next/template-company': 'view-company-page',
                'next/template-contact': 'view-contact',
                'next/template-products': 'view-products',
                'next/template-government': 'view-government',
                'next/template-red-team': 'view-red-team',
                'next/template-page-layout': 'view-page-layout',
                'next/template-solutions': 'view-solutions',
                'next/template-partner-program': 'view-partner-program',
                'next/template-partner-child': 'view-partner-child',
                'next/template-careers': 'view-careers',

                default: 'view-single'
            }

            // get template name from page data
            let templateName = _get(pageData, 'template', 'default')
            // remove file extension
            templateName = templateName.replace('.php', '')

            // return found template or default
            return templates[templateName] || templates['default']
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/base';
</style>
