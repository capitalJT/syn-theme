<?php
/**
 * Adds custom rewrite rules for a special author template
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 * 
 */

/**
 * The url based where single careers can be accessed from
 * 
 * @var string
 */
$AUTHOR_ROOT_URL_BASE = SYNACK_PROJECT_AUTHOR_ROOT_URI;

/**
 * The query var to look for in the URL
 * @var string
 */
$authorRootQueryVar = 'projectAuthor';

/**
 * Actions and Filters
 *
 * Register the rewrite rules and look for the query var and assign a template for it. 
 */
add_action( 'init','SYNProjectAuthorAddRewriteRules');
add_action( 'template_redirect', 'SYNProjectAuthorQueryVarTemplate' );
add_filter( 'query_vars', 'SYNProjectAuthorRegisterPrefixQueryVar' );


function SYNProjectAuthorAddRewriteRules( $wp_rewrite )
{
    global $AUTHOR_ROOT_URL_BASE;
    global $authorRootQueryVar;
    add_rewrite_rule($AUTHOR_ROOT_URL_BASE.'/([^/]+)?$', 'index.php?pagename='.$AUTHOR_ROOT_URL_BASE.'/&'.$authorRootQueryVar.'=$matches[1]', 'top' );
}

function SYNProjectAuthorRegisterPrefixQueryVar( $vars )
{
    global $authorRootQueryVar;
    $vars[] = $authorRootQueryVar;
 
    return $vars;
}

function SYNProjectAuthorQueryVarTemplate()
{
    global $authorRootQueryVar;
    if ( get_query_var( $authorRootQueryVar )) {
        add_filter( 'template_include', function() {
            return SYNACK_THEME_DIR . '/project-byAuthor.php';
        });
    }
 
}