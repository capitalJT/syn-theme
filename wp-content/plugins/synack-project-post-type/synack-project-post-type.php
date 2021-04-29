<?php
/*
Plugin Name: Synack R&D Projects Post Type
Plugin URI: http://synack.com
Description: Adds the R&D Projects post type separate from the theme
Version: 1.0
Author: Mike Sawicki <msawicki@nerdery.com>
Author URI: http://www.nerdery.com/
*/


/**
* Registers The R&D Projects Post Type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
function SYNACKProjectPostType() {

    $labels = array(
        'name'                => __( 'R&D Projects', 'synack' ),
        'singular_name'       => __( 'R&D Project', 'synack' ),
        'add_new'             => _x( 'Add New R&D Project', 'synack', 'synack' ),
        'add_new_item'        => __( 'Add New R&D Project', 'synack' ),
        'edit_item'           => __( 'Edit R&D Project', 'synack' ),
        'new_item'            => __( 'New R&D Project', 'synack' ),
        'view_item'           => __( 'View R&D Project', 'synack' ),
        'search_items'        => __( 'Search R&D Projects', 'synack' ),
        'not_found'           => __( 'No R&D Projects found', 'synack' ),
        'not_found_in_trash'  => __( 'No R&D Projects found in Trash', 'synack' ),
        'parent_item_colon'   => __( 'Parent R&D Project:', 'synack' ),
        'menu_name'           => __( 'R&D Project', 'synack' ),
    );

    $args = array(
        'labels'              => $labels,
        'hierarchical'        => false,
        'description'         => 'description',
        'taxonomies'          => array('featured-news'),
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => null,
        'menu_icon'           => 'dashicons-clipboard',
        'show_in_nav_menus'   => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => false,
        'has_archive'         => true,
        'query_var'           => true,
        'can_export'          => true,
        'rewrite'             => array(
            'slug' => 'r-d-projects'
        ),
        'capability_type'     => 'post',
        'supports'            => array(
            'title', 'editor', 'author','revisions',  
            )
    );

    register_post_type( 'synack-projects', $args );
}

add_action( 'init', 'SYNACKProjectPostType' );

// posts per page based on CPT
function SYNACKProjectsCustomPostsPerPage($query)
{
    if ( ! isset( $query->query_vars['post_type'] )) {
        return $query;
    }
    if ( 'synack-projects' === $query->query_vars['post_type'] ) {
        $query->query_vars['posts_per_page'] = get_option('options_projects_limit' );;
    }
    return $query;
}

if( ! is_admin() )
{
    add_filter( 'pre_get_posts', 'SYNACKProjectsCustomPostsPerPage' );
}