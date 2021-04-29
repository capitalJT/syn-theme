/**
 * Application configuration declaration.
 *
 * This configuration file is shared between the website and the build script so
 * that values don't have to be duplicated across environments. Any non-shared,
 * environment-specific configuration should placed in appropriate configuration
 * files.
 *
 * Paths to vendor libraries may be added here to provide short aliases to
 * otherwise long and arbitrary paths. If you're using bower to manage vendor
 * scripts, running `grunt inject` will automatically add paths aliases as
 * needed.
 *
 * @example
 *     paths: {
 *         'jquery': '../vendor/jquery/jquery',
 *         'jquery-cookie': '../vendor/jquery-cookie/jquery-cookie'
 *     }
 *
 * Shims provide a means of managing dependencies for non-modular, or non-AMD
 * scripts. For example, jQuery UI depends on jQuery, but it assumes jQuery is
 * available globally. Because RequireJS loads scripts asynchronously, jQuery
 * may or may not be available which will cause a runtime error. Shims solve
 * this problem.
 *
 * @example
 *     shim: {
 *         'jquery-cookie': {
 *             deps: ['jquery'],
 *             exports: null
 *          }
 *     }
 */
require.config({
    paths: {
        // this empty string tells r.js to use single quotes when injecting
        // bower modules automatically. Otherwise it defaults to double quotes.
        'requirejs': '',
        'structurejs': '../vendor/structurejs/js',
        'jquery': '../vendor/jquery/dist/jquery.min',
        'handlebars': '../vendor/handlebars/handlebars.min',
        'templates': './templates',
        'picturefill': '../vendor/picturefill/dist/picturefill.min',
        'Masonry': '../vendor/masonry/dist/masonry.pkgd.min',
        'wow': '../vendor/wow/dist/wow.min',
        'ScrollMagic': '../vendor/ScrollMagic/scrollmagic/minified/ScrollMagic.min',
        'Odometer': '../vendor/odometer/odometer.min',
        'TweenMax': '../vendor/gsap/src/minified/TweenMax.min',
        'TimelineMax': '../vendor/gsap/src/minified/TimelineMax.min',
        'TweenLite': '../vendor/gsap/src/minified/TweenLite.min',
        'CSSPlugin': '../vendor/gsap/src/minified/plugins/CSSPlugin.min',
        'ScrollTo': '../vendor/gsap/src/minified/plugins/ScrollToPlugin.min',
        'animation.gsap': '../vendor/ScrollMagic/scrollmagic/minified/plugins/animation.gsap.min',
        'Snap': '../vendor/snap.svg/dist/snap.svg-min',
        'imagesLoaded': '../vendor/imagesloaded/imagesloaded',
        'eventEmitter': '../vendor/eventEmitter',
        'eventie': '../vendor/eventie'
    },

    shim: {
        'jquery': {
            exports: '$'
        },
        'wow': {
            exports: 'WOW'
        },
        'Masonry': {
            deps: ['jquery']
        }
    },

    waitSeconds: 120

});
