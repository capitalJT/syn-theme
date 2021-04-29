<?php
/*
Plugin Name: Synack Custom Taxonomy Plugin
Plugin URI: http://synack.com
Description: Adds all the custon taxonomies
Version: 1.0
Author: Mike Sawicki <msawicki@nerdery.com>
Author URI: http://www.nerdery.com/
*/

/**
 * Create a taxonomy
 *
 * @uses  Inserts new taxonomy object into the list
 * @uses  Adds query vars
 *
 * @param string  Name of taxonomy object
 * @param array|string  Name of the object type for the taxonomy object.
 * @param array|string  Taxonomy arguments
 * @return null|WP_Error WP_Error if errors, otherwise null.
 */
function SYNReleaseType() {

    $labels = array(
        'name'                    => _x( 'Press Release Types', 'Taxonomy Press Release Types', 'synack' ),
        'singular_name'            => _x( 'Press Release Type', 'Taxonomy Press Release Type', 'synack' ),
        'search_items'            => __( 'Search Press Release Types', 'synack' ),
        'popular_items'            => __( 'Popular Press Release Types', 'synack' ),
        'all_items'                => __( 'All Press Release Types', 'synack' ),
        'parent_item'            => __( 'Parent Press Release Type', 'synack' ),
        'parent_item_colon'        => __( 'Parent Press Release Type', 'synack' ),
        'edit_item'                => __( 'Edit Press Release Type', 'synack' ),
        'update_item'            => __( 'Update Press Release Type', 'synack' ),
        'add_new_item'            => __( 'Add New Press Release Type', 'synack' ),
        'new_item_name'            => __( 'New Press Release Type Name', 'synack' ),
        'add_or_remove_items'    => __( 'Add or remove Press Release Types', 'synack' ),
        'choose_from_most_used'    => __( 'Choose from most used release type', 'synack' ),
        'menu_name'                => __( 'Press Release Type', 'synack' ),
    );

    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'show_in_nav_menus' => true,
        'show_admin_column' => false,
        'hierarchical'      => true,
        'show_tagcloud'     => true,
        'show_ui'           => true,
        'query_var'         => true,
        'rewrite'           => true,
        'query_var'         => true,
        'capabilities'      => array(),
    );

    register_taxonomy( 'release-type', array( 'synack-press' ), $args );
}

add_action( 'init', 'SYNReleaseType' );

/**
 * Create a taxonomy
 *
 * @uses  Inserts new taxonomy object into the list
 * @uses  Adds query vars
 *
 * @param string  Name of taxonomy object
 * @param array|string  Name of the object type for the taxonomy object.
 * @param array|string  Taxonomy arguments
 * @return null|WP_Error WP_Error if errors, otherwise null.
 */
function SYNACKFeaturesNewsTax() {

    $labels = array(
        'name'                    => _x( 'Featured News', 'Taxonomy Featured News', 'synack' ),
        'singular_name'            => _x( 'Featured News', 'Taxonomy Featured News', 'synack' ),
        'search_items'            => __( 'Search Featured News', 'synack' ),
        'popular_items'            => __( 'Popular Featured News', 'synack' ),
        'all_items'                => __( 'All Featured News', 'synack' ),
        'parent_item'            => __( 'Parent Featured News', 'synack' ),
        'parent_item_colon'        => __( 'Parent Featured News', 'synack' ),
        'edit_item'                => __( 'Edit Featured News', 'synack' ),
        'update_item'            => __( 'Update Featured News', 'synack' ),
        'add_new_item'            => __( 'Add New Featured News', 'synack' ),
        'new_item_name'            => __( 'New Featured News Name', 'synack' ),
        'add_or_remove_items'    => __( 'Add or remove Featured News', 'synack' ),
        'choose_from_most_used'    => __( 'Choose from most used synack', 'synack' ),
        'menu_name'                => __( 'Featured News', 'synack' ),
    );

    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'show_in_nav_menus' => true,
        'show_admin_column' => false,
        'hierarchical'      => true,
        'show_tagcloud'     => true,
        'show_ui'           => true,
        'query_var'         => true,
        'rewrite'           => true,
        'query_var'         => true,
        'capabilities'      => array(),
    );

    register_taxonomy( 'featured-news', array( 'synack-project', 'synack-press' ), $args );
}

add_action( 'init', 'SYNACKFeaturesNewsTax' );


/**
 * Create Department Taxonomy
 *
 * @uses  Inserts new taxonomy object into the list
 * @uses  Adds query vars
 *
 * @param string  Name of taxonomy object
 * @param array|string  Name of the object type for the taxonomy object.
 * @param array|string  Taxonomy arguments
 * @return null|WP_Error WP_Error if errors, otherwise null.
 */
function SNYNACKDepartmentTax() {

    $labels = array(
        'name'                    => _x( 'Departments', 'Taxonomy Departments', 'synack' ),
        'singular_name'            => _x( 'Departments', 'Taxonomy Department', 'synack' ),
        'search_items'            => __( 'Search Departments', 'synack' ),
        'popular_items'            => __( 'Popular Departments', 'synack' ),
        'all_items'                => __( 'All Departments', 'synack' ),
        'parent_item'            => __( 'Parent Department', 'synack' ),
        'parent_item_colon'        => __( 'Parent Department', 'synack' ),
        'edit_item'                => __( 'Edit Department', 'synack' ),
        'update_item'            => __( 'Update Department', 'synack' ),
        'add_new_item'            => __( 'Add New Department', 'synack' ),
        'new_item_name'            => __( 'New Department Name', 'synack' ),
        'add_or_remove_items'    => __( 'Add or remove Departments', 'synack' ),
        'choose_from_most_used'    => __( 'Choose from most used department', 'synack' ),
        'menu_name'                => __( 'Department', 'synack' ),
    );

    $args = array(
        'labels'            => $labels,
        'public'            => false,
        'show_in_nav_menus' => true,
        'show_admin_column' => false,
        'hierarchical'      => true,
        'show_tagcloud'     => true,
        'show_ui'           => true,
        'query_var'         => true,
        'rewrite'           => true,
        'query_var'         => true,
        'capabilities'      => array(),
    );

    register_taxonomy( 'departments', array( 'synack-people' ), $args );
}

add_action( 'init', 'SNYNACKDepartmentTax' );


/**
 * Create a taxonomy
 *
 * @uses  Inserts new taxonomy object into the list
 * @uses  Adds query vars
 *
 * @param string  Name of taxonomy object
 * @param array|string  Name of the object type for the taxonomy object.
 * @param array|string  Taxonomy arguments
 * @return null|WP_Error WP_Error if errors, otherwise null.
 */
function SYNACKResourceTypeTax() {

    $labels = array(
        'name'                    => _x( 'Resource Types', 'Taxonomy Resource Types', 'synack' ),
        'singular_name'            => _x( 'Resource Type', 'Taxonomy Resource Type', 'synack' ),
        'search_items'            => __( 'Search Resource Types', 'synack' ),
        'popular_items'            => __( 'Popular Resource Types', 'synack' ),
        'all_items'                => __( 'All Resource Types', 'synack' ),
        'parent_item'            => __( 'Parent Resource Type', 'synack' ),
        'parent_item_colon'        => __( 'Parent Resource Type', 'synack' ),
        'edit_item'                => __( 'Edit Resource Type', 'synack' ),
        'update_item'            => __( 'Update Resource Type', 'synack' ),
        'add_new_item'            => __( 'Add New Resource Type', 'synack' ),
        'new_item_name'            => __( 'New Resource Type Name', 'synack' ),
        'add_or_remove_items'    => __( 'Add or remove Resource Types', 'synack' ),
        'choose_from_most_used'    => __( 'Choose from most used resource types', 'synack' ),
        'menu_name'                => __( 'Resource Type', 'synack' ),
    );

    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'show_in_nav_menus' => true,
        'show_admin_column' => false,
        'hierarchical'      => true,
        'show_tagcloud'     => true,
        'show_ui'           => true,
        'query_var'         => true,
        'rewrite'           => true,
        'query_var'         => true,
        'capabilities'      => array(),
    );

    register_taxonomy( 'resource-type', array( 'synack-resources' ), $args );
}

add_action( 'init', 'SYNACKResourceTypeTax' );

/**
 * Create custom taxonmy for featured events
 *
 * @uses  Inserts new taxonomy object into the list
 * @uses  Adds query vars
 *
 * @param string  Name of taxonomy object
 * @param array|string  Name of the object type for the taxonomy object.
 * @param array|string  Taxonomy arguments
 * @return null|WP_Error WP_Error if errors, otherwise null.
 */
function SYNACKFeaturedEventTax() {

    $labels = array(
        'name'                    => _x( 'Featured Events', 'Taxonomy Featured Events', 'synack' ),
        'singular_name'            => _x( 'Featured Event', 'Taxonomy Featured Event', 'synack' ),
        'search_items'            => __( 'Search Featured Events', 'synack' ),
        'popular_items'            => __( 'Popular Featured Events', 'synack' ),
        'all_items'                => __( 'All Featured Events', 'synack' ),
        'parent_item'            => __( 'Parent Featured Event', 'synack' ),
        'parent_item_colon'        => __( 'Parent Featured Event', 'synack' ),
        'edit_item'                => __( 'Edit Featured Event', 'synack' ),
        'update_item'            => __( 'Update Featured Event', 'synack' ),
        'add_new_item'            => __( 'Add New Featured Event', 'synack' ),
        'new_item_name'            => __( 'New Featured Event Name', 'synack' ),
        'add_or_remove_items'    => __( 'Add or remove Featured Events', 'synack' ),
        'choose_from_most_used'    => __( 'Choose from most used synack', 'synack' ),
        'menu_name'                => __( 'Featured Event', 'synack' ),
    );

    $args = array(
        'labels'            => $labels,
        'public'            => false,
        'show_in_nav_menus' => true,
        'show_admin_column' => false,
        'hierarchical'      => true,
        'show_tagcloud'     => true,
        'show_ui'           => true,
        'query_var'         => true,
        'rewrite'           => true,
        'query_var'         => true,
        'capabilities'      => array(),
    );

    register_taxonomy( 'featured-event', array( 'synack-events' ), $args );
}

add_action( 'init', 'SYNACKFeaturedEventTax' );
