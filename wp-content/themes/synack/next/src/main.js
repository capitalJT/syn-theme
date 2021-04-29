import _kebabCase from 'lodash/kebabCase'
import _throttle from 'lodash/throttle'
import store from '~/src/store'
import App from './App.vue'
import Vue from 'vue'
import VRellax from './libs/v-rellax'
import VInView from './libs/v-in-view'
// need to use local version of a-div that doesn't use <router-link>
// switch back to fh-components/a-div if router-link is desired
import ADiv from './components/shared/ADiv'

// Register components in src/
// ===============================
const components = require.context('~/src/components', true)
components.keys().map(component => {
    // ignore non-vue files
    if (!component.includes('.vue')) return

    // turn './ComponentName.vue' into 'component-name'
    const componentName = _kebabCase(
        component.replace(/^\.\//, '').replace(/\.vue$/, '')
    )
    // register new component globally
    Vue.component(componentName, components(component).default)
})

// Register additional components
// ===============================

// Bootstrap
// ===============================

// resize handler
const setSizes = store => {
    store.commit('SET_WIN_WIDTH', window.innerWidth)
    store.commit('SET_WIN_HEIGHT', window.innerHeight)
    const docHeight = Math.max(
        document.body.scrollHeight,
        document.body.offsetHeight,
        document.documentElement.clientHeight,
        document.documentElement.scrollHeight,
        document.documentElement.offsetHeight
    )
    store.commit('SET_DOC_HEIGHT', docHeight)
}

// scroll handler
const setScroll = store => {
    const sTop = window.pageYOffset || document.documentElement.scrollTop
    store.commit('SET_SCROLL_TOP', sTop)
}

// size/scroll handlers
const onResize = () => setSizes(store)
const onScroll = () => setScroll(store)

// set listeners + kick
window.addEventListener('resize', _throttle(onResize, 50))
window.addEventListener('scroll', _throttle(onScroll, 20))
onResize()
onScroll()

// load fonts
store.dispatch('LOAD_FONTS')

// register global components
Vue.component('responsive-image', require('fh-components/responsive-image'))
Vue.component('split-text', require('fh-components/split-text'))
Vue.component('wp-content', require('fh-components/wp-content'))
Vue.component('slide-show', require('fh-components/slide-show'))
Vue.component('a-div', ADiv)
Vue.component('vue-three-wrap', require('vue-three-wrap'))
Vue.component('text-typer', require('fh-components/text-typer'))
Vue.component('load-on-view', require('fh-components/load-on-view'))

// register global directives
Vue.directive('full-height', require('fh-components/v-full-height'))
Vue.directive('in-view', VInView)
Vue.directive('rellax', VRellax)
Vue.directive('interact', require('fh-components/v-interact'))

// boot app
new Vue(App)
