<?php
/**
 * Theme Setup File. Handles the base setup configurations for the theme.
 *
 * @package    WordPress
 * @subpackage Synack
 * @author     Mike Sawicki <msawicki@nerdery.com>
 * @since      1.0.0
 */
class SYNSetup
{

    /**
     * Constructor
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        // Call all WP Actions and Filters
        $this->actions();
        $this->filters();
    }


    /**
     * All actions that need to be run on instantiation of the theme.
     *
     * @return    SYNSetup
     * @since     1.0.0
     * @chainable
     */
    protected function actions()
    {
        add_action('after_setup_theme', array(&$this, 'init'), 10);
        add_action('wp_enqueue_scripts', array(&$this, 'enqueueStyles'), 99);
        add_action('wp_enqueue_scripts', array(&$this, 'enqueueScripts'));

        return $this;
    }

    /**
     * All filters needed to be run on instantiation of theme.
     *
     * @return    SYNSetup
     * @since     1.0.0
     * @chainable
     */
    protected function filters()
    {
        add_filter(
            'post_thumbnail_html',
            array(
                &$this,
                'removeHeightWidthFromImages'
            ),
            10
        );

        add_filter(
            'image_send_to_editor',
            array(
                &$this,
                'removeHeightWidthFromImages'
            ),
            10
        );
    }

    /**
     * Initialize the Theme Application
     *
     * @return SYNSetup
     * @since  1.0.0
     */
    public function init()
    {
        return $this->registerNavigationMenus()
            ->registerImageSizes()
            ->registerSupportFeatures()
            ->addOptionsPage();
    }

    /**
     * Register all navigation menus with the theme
     *
     * @return    SYNSetup
     * @since     1.0.0
     * @chainable
     */
    protected function registerNavigationMenus()
    {

        register_nav_menus(
            array(
                'primary' => __('Primary Navigation'),
                'footer' => __('Footer Navigation'),
                'social' => __('Social Navigation'),
                'footer-utility' => __('Footer Utility Navigation')
            )
        );

        return $this;
    }

    /**
     * Register custom image sizes
     *
     * @return    SYNSetup
     * @since     1.0.0
     * @chainable
     */
    protected function registerImageSizes()
    {

        add_image_size(
            'perkBenefitThumbnail',
            '280',
            '280',
            true
        );

        add_image_size(
            'postThumbnail',
            '480',
            '9999',
            false
        );

        add_image_size(
            'pressSquareThumbnail',
            '420',
            '420',
            false
        );

        add_image_size(
            'pressArchiveThumbnail',
            '460',
            '660',
            true
        );

        add_image_size(
            'peopleThumbnail',
            '520',
            '520',
            true
        );

        add_image_size(
            'peopleThumbnailLg',
            '720',
            '820',
            true
        );

        add_image_size(
            'heroCarouselSlide',
            '1200',
            '675',
            true
        );

        add_image_size(
            'heroCarouselSlideSmall',
            '320',
            '240',
            true
        );

        add_image_size(
            'heroCarouselSlideMedium',
            '768',
            '432',
            true
        );

        add_image_size(
            'rectangleThumb',
            '260',
            '330',
            true
        );

        add_image_size(
            'uncroppedThumbnail',
            '200',
            '150',
            false
        );


        return $this;
    }

    /**
     * Allows the theme to register support of a certain theme feature.
     *
     * @link  http://codex.wordpress.org/Function_Reference/add_theme_support
     *
     * @return    SYNSetup
     * @since     1.0.0
     * @chainable
     */
    protected function registerSupportFeatures()
    {

        add_theme_support(
            'html5',
            array(
                'comment-list',
                'search-form',
                'comment-form',
                'gallery',
            )
        );

        return $this;
    }



    /**
     * Enqueue CSS Stylesheets
     *
     * @return    SYNSetup
     * @since     1.0.0
     * @chainable
     */
    public function enqueueStyles()
    {
        global $wp_styles;
        $stylesPath = SYNACK_THEME_URI. '/assets/styles/';
        $cacheBustVersionNumCSS = '1.6.2';

        //Register legacy stylesheet
        wp_register_style(
            'Legacy',
            $stylesPath . 'legacy.css',
            array(),
	        $cacheBustVersionNumCSS,
            'all'
        );

        //Register modern stylesheet
        wp_register_style(
            'Modern',
            $stylesPath. 'modern.css',
            array(),
	        $cacheBustVersionNumCSS,
            'all'
        );

        wp_enqueue_style('Modern');

        //Load our IE specific legacy stylesheet
        wp_enqueue_style('Legacy');
        $wp_styles->add_data( 'Legacy', 'conditional', 'lt IE 8' );

        return $this;
    }

    /**
     * Enqueue the JavaScript files
     *
     * @return    SYNSetup
     * @since     1.0.0
     * @chainable
     */
    public function enqueueScripts()
    {
        $scriptsPath = SYNACK_THEME_URI. '/assets/scripts/';
	    $cacheBustVersionNumJS = '1.6.0';

        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }


        //Require Config
        wp_register_script(
            'Require',
            $scriptsPath . '../vendor/requirejs/require.js',
            '',
	        $cacheBustVersionNumJS,
            true
        );

        //Require Config
        wp_register_script(
            'Config',
            $scriptsPath . 'config.js',
            '',
	        $cacheBustVersionNumJS,
            true
        );

        //Require Config
        wp_register_script(
            'JavascriptSettings',
            $scriptsPath . 'settings.js',
            '',
	        $cacheBustVersionNumJS,
            true
        );
        //Require Config
        wp_register_script(
            'HeadScripts',
            $scriptsPath . 'head.js',
            '',
	        $cacheBustVersionNumJS,
            false
        );

        // Localize the Settings
        wp_localize_script(
            'JavascriptSettings',
            'wpRequireSettings',
            array(
                'ajaxUrl' => admin_url('admin-ajax.php'),
                'themePath' =>  SYNACK_THEME_URI,
                'themeVersion' => $cacheBustVersionNumJS,
            )
        );

        wp_enqueue_script('HeadScripts');
        wp_enqueue_script('Require');
        wp_enqueue_script('Config');
        wp_enqueue_script('JavascriptSettings');


        return $this;
    }


    /**
     * Add ACF Options Page
     *
     * @return    SYNSetup
     * @since     1.0.0
     * @chainable
     */
    public function addOptionsPage()
    {
        if(function_exists('acf_add_options_page')){
            acf_add_options_page();
        }

        return $this;
    }

    /**
     * Removes the height and width parameters from uploaded images
     *
     * @param  $html
     * @return mixed
     */
    public function removeHeightWidthFromImages( $html )
    {
        $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
        return $html;
    }

}

new SYNSetup();
