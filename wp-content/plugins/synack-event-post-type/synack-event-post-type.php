<?php
/*
Plugin Name: Synack Event Post Type
Plugin URI: http://synack.com
Description: Adds the event post type separate from the theme
Version: 1.0
Author: Mike Sawicki <msawicki@nerdery.com>
Author URI: http://www.nerdery.com/
*/


/**
* Registers The Event Post Type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
function SYNACKEventPostType() {

    $labels = array(
        'name'                => __( 'Events', 'text-domain' ),
        'singular_name'       => __( 'Event', 'text-domain' ),
        'add_new'             => _x( 'Add New Event', 'text-domain', 'text-domain' ),
        'add_new_item'        => __( 'Add New Event', 'text-domain' ),
        'edit_item'           => __( 'Edit Event', 'text-domain' ),
        'new_item'            => __( 'New Event', 'text-domain' ),
        'view_item'           => __( 'View Event', 'text-domain' ),
        'search_items'        => __( 'Search Events', 'text-domain' ),
        'not_found'           => __( 'No Events found', 'text-domain' ),
        'not_found_in_trash'  => __( 'No Events found in Trash', 'text-domain' ),
        'parent_item_colon'   => __( 'Parent Event:', 'text-domain' ),
        'menu_name'           => __( 'Events', 'text-domain' ),
    );

    $args = array(
        'labels'              => $labels,
        'hierarchical'        => false,
        'description'         => 'description',
        'taxonomies'          => array(),
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => null,
        'menu_icon'           => 'dashicons-calendar-alt',
        'show_in_nav_menus'   => true,
        'publicly_queryable'  => false,
        'exclude_from_search' => true,
        'has_archive'         => true,
        'query_var'           => true,
        'can_export'          => true,
        'rewrite'             => array(
            'slug' => 'events'
        ),
        'capability_type'     => 'post',
        'supports'            => array(
            'title', 'editor', 'author','revisions',  
            )
    );

    register_post_type( 'synack-events', $args );
}

add_action( 'init', 'SYNACKEventPostType' );
