<?php
/*
Plugin Name: Synack Resource Post Type
Plugin URI: http://synack.com
Description: Adds the Resource post type separate from the theme
Version: 1.0
Author: Mike Sawicki <msawicki@nerdery.com>
Author URI: http://www.nerdery.com/
*/


/**
* Registers The Resource Post Type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
function SYNACKResourcePostType() {

    $labels = array(
        'name'                => __( 'Resources', 'synack' ),
        'singular_name'       => __( 'Resource', 'synack' ),
        'add_new'             => _x( 'Add New Resource', 'synack', 'synack' ),
        'add_new_item'        => __( 'Add New Resource', 'synack' ),
        'edit_item'           => __( 'Edit Resource', 'synack' ),
        'new_item'            => __( 'New Resource', 'synack' ),
        'view_item'           => __( 'View Resource', 'synack' ),
        'search_items'        => __( 'Search Resources', 'synack' ),
        'not_found'           => __( 'No Resources found', 'synack' ),
        'not_found_in_trash'  => __( 'No Resources found in Trash', 'synack' ),
        'parent_item_colon'   => __( 'Parent Resource:', 'synack' ),
        'menu_name'           => __( 'Resources', 'synack' ),
    );

    $args = array(
        'labels'              => $labels,
        'hierarchical'        => false,
        'description'         => 'description',
        'taxonomies'          => array('resource-type'),
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => null,
        'menu_icon'           => 'dashicons-media-archive',
        'show_in_nav_menus'   => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => true,
        'has_archive'         => true,
        'query_var'           => true,
        'can_export'          => true,
        'rewrite'             => array(
            'with_front'    => false,
            'slug' => 'resources'
        ),
        'capability_type'     => 'post',
        'supports'            => array(
            'title', 'editor', 'author','revisions',
            )
    );

    register_post_type( 'synack-resources', $args );
}

add_action( 'init', 'SYNACKResourcePostType' );


// posts per page based on CPT
function SYNACKResourceCustomPostsPerPage($query)
{
    if ( ! isset( $query->query_vars['post_type'] )) {
        return $query;
    }
    if ( 'synack-resources' === $query->query_vars['post_type'] ) {
        $query->query_vars['posts_per_page'] = get_option('options_resources_limit' );
    }
    return $query;
}

if( ! is_admin() )
{
    add_filter( 'pre_get_posts', 'SYNACKResourceCustomPostsPerPage' );
}
