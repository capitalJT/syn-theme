<?php
/**
 * Main Functions File
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 *
 */
define('SYNACK_THEME_DIR', get_template_directory());
define('SYNACK_THEME_URI', get_template_directory_uri());

//Define global URLs for things like careers and authors
define('SYNACK_CAREER_ROOT_URI','company/careers');
define('SYNACK_PROJECT_AUTHOR_ROOT_URI', 'rd-projects/authors');

/**
 * Theme setup file
 */
require_once(SYNACK_THEME_DIR . '/lib/Theme/Setup.php');

/**
 * Helper classes
 */
require_once(SYNACK_THEME_DIR . '/lib/Theme/Images.php');
require_once(SYNACK_THEME_DIR . '/lib/Theme/Meta.php');

/**
 * Helper functions
 */
require_once(SYNACK_THEME_DIR . '/lib/Theme/Helpers.php');

/**
 * Career Rewrite and API connections
 */
require_once(SYNACK_THEME_DIR . '/lib/Theme/CareersRewrite.php');
require_once(SYNACK_THEME_DIR . '/lib/Theme/CareersAPI.php');

/**
 * Nav Walkers
 */
require_once(SYNACK_THEME_DIR . '/lib/Theme/NavWalkers/MainWalker.php');
require_once(SYNACK_THEME_DIR . '/lib/Theme/NavWalkers/FooterWalker.php');
require_once(SYNACK_THEME_DIR . '/lib/Theme/NavWalkers/FooterUtilityWalker.php');
/**
 * AJAX
 */
require_once(SYNACK_THEME_DIR . '/lib/Theme/Ajax.php');

/**
 * Authors for Projects
 */
require_once(SYNACK_THEME_DIR . '/lib/Theme/AuthorsProjectRewrite.php');

/**
 * Shortcodes and TinyMCE files
 */
require_once(SYNACK_THEME_DIR . '/lib/Theme/Shortcodes.php');
require_once(SYNACK_THEME_DIR . '/lib/Theme/TinyMce/TinyMce.php');

/**
 * Next Theme Functions
 */
require_once(SYNACK_THEME_DIR . '/next/functions.php');

/**
 * Custom Landing Page Sidebar - JT
 */
function custom_landing_page_sidebar() {
    register_sidebar(
        array (
            'name' => __( 'Landing Page Sidebar', 'synack' ),
            'id' => 'custom-side-bar',
            'description' => __( 'Custom Sidebar', 'synack' ),
            'before_widget' => '<div class="widget-content">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'custom_landing_page_sidebar' );

// REMOVE WIDGET TITLE IF IT BEGINS WITH EXCLAMATION POINT
add_filter( 'widget_title', 'remove_widget_title' );
function remove_widget_title( $widget_title ) {
    if ( substr ( $widget_title, 0, 1 ) == '!' ){
        return;
    } else {
        return ( $widget_title );
    }
}

/**
 * Utility Class Styles and Cache-Busting Global Variable - JT
 */
// Shared variable between uitlity class styles (utility-class.css) and landing page styles (header-landing.php)
define('SYNACK_CACHE_BUST_DATE', "2021.04.04");

function synack_enqueue_util_styles() {
    if ( is_page_template('templates/template-modules.php') || is_page_template('templates/template-trust-report.php') || is_singular('synack-lp') ){
        wp_register_style('util-classes', get_stylesheet_directory_uri().'/assets/styles/utility-classes.css', false ,''. SYNACK_CACHE_BUST_DATE .'');
        wp_enqueue_style( 'util-classes' );
    }

}
add_action( 'wp_enqueue_scripts', 'synack_enqueue_util_styles', 10);


/**
 * Custom Column with Currently Active Page Template - JT
 * https://www.isitwp.com/custom-column-with-currently-active-page-template/
 */
function page_column_views( $defaults ) {
    $defaults['page-layout'] = __('Template');
    return $defaults;
}
add_filter( 'manage_pages_columns', 'page_column_views' );

function page_custom_column_views( $column_name, $id ) {
    if ( $column_name === 'page-layout' ) {
        $set_template = get_post_meta( $id, '_wp_page_template', true );
        if ( 'default' === $set_template ) {
            echo 'Default';
        }
        $templates = get_page_templates();
        ksort( $templates );
        foreach ( array_keys( $templates ) as $template ) :
            if ( $set_template == $templates[$template] ) echo $template;
        endforeach;
    }
}
add_action( 'manage_pages_custom_column', 'page_custom_column_views', 5, 2 );

/**
 * Make the page-layout column sortable in admin pages table.
 *
 * @param array $columns array of columns.
 * @return array $columns updated columns with page-layout set as sortable.
 */
function syn_make_page_template_column_sortable( $columns ) {
    $columns['page-layout'] = 'page-layout';
    return $columns;
}
add_filter( 'manage_edit-page_sortable_columns', 'syn_make_page_template_column_sortable' );

/**
 * Sort the pages table by page template.
 *
 * @param object $query instance of WP_Query class.
 * @return void
 */
function syn_sort_page_template_column_query( $query ) {
    global $pagenow;

    if ( is_admin() && 'edit.php' === $pagenow && 'page' === $_GET['post_type'] ) {
        $orderby = $query->get( 'orderby' );

        if ( 'page-layout' === $orderby ) {
            $query->set( 'meta_key', '_wp_page_template' );
            $query->set( 'orderby', 'meta_value' );
        }
    }
}
add_action( 'pre_get_posts', 'syn_sort_page_template_column_query' );


/**
 * Disable Content Editor for Specific Page Template - JT
 * https://www.isitwp.com/disable-content-editor-for-specific-page-template
 */
add_action( 'admin_init', 'hide_editor' );
function hide_editor() {
//    $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
//    if ( !isset( $post_id ) ) return;

    if ( isset ( $_GET['post'] ) ){
        $post_id = $_GET['post'];
    } else if ( isset ( $_POST['post'] ) ){
        $post_id = $_POST['post'];
    }

    if ( !isset ( $post_id ) || empty ( $post_id ) ){
        return;
    }

    $template_file = get_post_meta($post_id, '_wp_page_template', true);

    if ($template_file == 'templates/template-modules.php'){ // edit the template name
        remove_post_type_support('page', 'editor');
    }
}


/**
 * CUSTOM ACF MIN HEIGHT ROWS - JT
 */
add_filter( 'admin_head', 'textarea_temp_fix' );
function textarea_temp_fix() {
    echo '<style type="text/css">.acf_postbox .field textarea {min-height:0 !important;}
	.acf-flexible-content .layout .acf-fc-layout-handle { background: #0073aa !important;color: #fff !important;font-weight: bold;    font-size: 18px !important;line-height: 18px !important; } .acf-oembed .canvas { min-height:100px !important; }</style>';
}


/**
 * CUSTOM ACF STYLING - JT
 * Add borders to the top of each row to make the content easier to scan
 * https://stackoverflow.com/questions/46736025/how-do-you-style-the-admin-backend-of-the-acf-advanced-custom-fields-wordpress/46962215
 */
function my_acf_admin_head() {
	?>
	<style type="text/css">

        .acf-repeater.-row > table > tbody > tr > td,
        .acf-repeater.-block > table > tbody > tr > td {
            border-top: 2px solid #202428;
        }

        .acf-repeater .acf-row-handle {
            vertical-align: top !important;
            padding-top: 16px;
        }

        .acf-repeater .acf-row-handle span {
            font-size: 20px;
            font-weight: bold;
            color: #202428;
        }
	</style>
	<?php
}
add_action('acf/input/admin_head', 'my_acf_admin_head');

include get_template_directory() . "/includes/synack-cta-shortcodes.php";