<?php
/*
Plugin Name: Synack Press Releases Post Type
Plugin URI: http://synack.com
Description: Adds the Press Releases post type separate from the theme
Version: 1.0
Author: Mike Sawicki <msawicki@nerdery.com>
Author URI: http://www.nerdery.com/
*/


/**
* Registers The Press Releases Post Type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
function SYNACKPressPostType() {

    $labels = array(
        'name'                => __( 'Press Releases', 'synack' ),
        'singular_name'       => __( 'Press Release', 'synack' ),
        'add_new'             => _x( 'Add New Press Release', 'synack', 'synack' ),
        'add_new_item'        => __( 'Add New Press Release', 'synack' ),
        'edit_item'           => __( 'Edit Press Release', 'synack' ),
        'new_item'            => __( 'New Press Release', 'synack' ),
        'view_item'           => __( 'View Press Release', 'synack' ),
        'search_items'        => __( 'Search Press Releases', 'synack' ),
        'not_found'           => __( 'No Press Releases found', 'synack' ),
        'not_found_in_trash'  => __( 'No Press Releases found in Trash', 'synack' ),
        'parent_item_colon'   => __( 'Parent Press Release:', 'synack' ),
        'menu_name'           => __( 'Press Release', 'synack' ),
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
        'has_archive'         => false,
        'query_var'           => true,
        'can_export'          => true,
        'rewrite'             => array(
            'slug' => 'press-releases',
            'with_front'    => false
        ),
        'capability_type'     => 'post',
        'supports'            => array(
            'title', 'editor', 'author','revisions',
            )
    );

    register_post_type( 'synack-press', $args );
}

add_action( 'init', 'SYNACKPressPostType' );
