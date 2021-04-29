<?php
/*
Plugin Name: Synack People Post Type
Plugin URI: http://synack.com
Description: Adds the People post type separate from the theme
Version: 1.0
Author: Mike Sawicki <msawicki@nerdery.com>
Author URI: http://www.nerdery.com/
*/


/**
* Registers The People Post Type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
function SYNACKPeoplePostType() {

    $labels = array(
        'name'                => __( 'People', 'synack' ),
        'singular_name'       => __( 'People', 'synack' ),
        'add_new'             => _x( 'Add New People', 'synack', 'synack' ),
        'add_new_item'        => __( 'Add New People', 'synack' ),
        'edit_item'           => __( 'Edit People', 'synack' ),
        'new_item'            => __( 'New People', 'synack' ),
        'view_item'           => __( 'View People', 'synack' ),
        'search_items'        => __( 'Search People', 'synack' ),
        'not_found'           => __( 'No People found', 'synack' ),
        'not_found_in_trash'  => __( 'No People found in Trash', 'synack' ),
        'parent_item_colon'   => __( 'Parent People:', 'synack' ),
        'menu_name'           => __( 'People', 'synack' ),
    );

    $args = array(
        'labels'              => $labels,
        'hierarchical'        => false,
        'description'         => 'description',
        'taxonomies'          => array('departments'),
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => null,
        'menu_icon'           => 'dashicons-groups',
        'show_in_nav_menus'   => true,
        'publicly_queryable'  => false,
        'exclude_from_search' => true,
        'has_archive'         => false,
        'query_var'           => true,
        'can_export'          => true,
        'rewrite'             => array(
            'slug' => 'employees'
        ),
        'capability_type'     => 'post',
        'supports'            => array(
            'title', 'editor', 'author','revisions',  
            )
    );

    register_post_type( 'synack-people', $args );
}

add_action( 'init', 'SYNACKPeoplePostType' );

