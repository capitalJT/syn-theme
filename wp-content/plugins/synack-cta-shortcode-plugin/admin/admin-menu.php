<?php // Synack - Admin Menu

// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// add sub-level administrative menu
//function synack_add_sublevel_menu() {
//
//	add_submenu_page(
//		'options-general.php',
//		esc_html__('CTA Settings', 'synack'),
//		esc_html__('synack CTA', 'synack'),
//		'manage_options',
//		'synack',
//		'synack_display_settings_page'
//	);
//}
//add_action( 'admin_menu', 'synack_add_sublevel_menu' );


// add top-level administrative menu
function synack_add_toplevel_menu() {

	/*

	add_menu_page(
		string   $page_title,
		string   $menu_title,
		string   $capability,
		string   $menu_slug,
		callable $function = '',
		string   $icon_url = '',
		int      $position = null
	)

	*/

	add_menu_page(
		esc_html__('CTA Settings', 'synack'),
		esc_html__('Synack CTA', 'synack'),
		'manage_options',
		'synack',
		'synack_display_settings_page',
		'dashicons-admin-generic',
		null
	);

}
add_action( 'admin_menu', 'synack_add_toplevel_menu' );