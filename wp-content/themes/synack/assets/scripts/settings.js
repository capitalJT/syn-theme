/**
 * Global constants
 *
 * TODO: ideally these values would be filled in from the server side
 *
 * @class SETTINGS
 * @static
 */
window.SETTINGS = {};

/**
 * Indicates whether we are running on a production environment
 *
 * @property IS_PRODUCTION
 * @type Boolean
 * @final
 */
SETTINGS.IS_PRODUCTION = false;

/**
 * Appended to query string for versioning of network resources (CSS,
 * JavaScript, etc). This version number should be updated in production
 * for every release.
 *
 * @property APP_VERSION
 * @type {String}
 * @final
 */
SETTINGS.APP_VERSION = '@@version';

/**
 * The path to
 *
 * @property VAGRANT_ADDR
 * @type String
 * @final
 */
SETTINGS.AJAX_URL = wpRequireSettings.ajaxUrl;


 /**
 * Set to true to allow application to output to browser console, false
 * to silence all console output. This should be set to `false` on
 * production.
 *
 * @property LOG_CONSOLE
 * @type Boolean
 * @final
 */
SETTINGS.LOG_CONSOLE = !SETTINGS.IS_PRODUCTION;

/**
 * Appended to query string to defeat caching of network resources (CSS,
 * JavaScript, etc). Should be set to '' on production
 *
 * @property CACHE_BUSTER
 * @type String
 * @final
 */
SETTINGS.CACHE_BUSTER = SETTINGS.IS_PRODUCTION ? '' : '&bust=' + Math.random();

/**
 * Root path for all JavaScript files
 *
 * @property SCRIPT_PATH
 * @type String
 * @final
 */
SETTINGS.SCRIPT_PATH = wpRequireSettings.themePath + '/assets/scripts/';

/**
 * Set any RequireJs configuration that is dependent on dynamic
 * configuration variables. Note that this config data is merged into
 * any other require.config() statements defined elsewhere.
 */
require.config({
    // Script path
    baseUrl: SETTINGS.SCRIPT_PATH,

    // Params to append to the end of each js file request
    urlArgs: 'v=' + SETTINGS.APP_VERSION + SETTINGS.CACHE_BUSTER
});

/**
 * Set route and kick off RequireJs, which begins loading of scripts
 * starting from main.js.
 */
require(['main']);