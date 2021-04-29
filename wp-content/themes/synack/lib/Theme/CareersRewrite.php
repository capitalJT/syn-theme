<?php
/**
 * Adds custom rewrite rules for single career pages
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 * 
 */

/**
 * The url based where single careers can be accessed from
 * @todo This should probably be a global option 
 * 
 * @var string
 */
$CAREER_URL_BASE = SYNACK_CAREER_ROOT_URI;

/**
 * The query var to look for in the URL
 * @var string
 */
$careerQueryVar = 'career';

/**
 * Actions and Filters
 *
 * Register the rewrite rules and look for the query var and assign a template for it. 
 */
add_action( 'init','careerAddRewriteRules');
add_action( 'template_redirect', 'careerQueryVarTemplate' );
add_filter( 'query_vars', 'careerRegisterPrefixQueryVar' );


function careerAddRewriteRules( $wp_rewrite ) 
{
    global $CAREER_URL_BASE;
    global $careerQueryVar;
    add_rewrite_rule($CAREER_URL_BASE.'/([^/]+)?$', 'index.php?pagename='.$CAREER_URL_BASE.'/&'.$careerQueryVar.'=$matches[1]', 'top' );
}

function careerRegisterPrefixQueryVar( $vars ) 
{
    global $careerQueryVar;
    $vars[] = $careerQueryVar;
 
    return $vars;
}

function careerQueryVarTemplate() 
{
    global $careerQueryVar;
    if ( get_query_var( $careerQueryVar )) {
        add_filter( 'template_include', function() {
            return SYNACK_THEME_DIR . '/single-career.php';
        });
    }
 
}