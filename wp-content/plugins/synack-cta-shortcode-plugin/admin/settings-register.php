<?php // Synack - Register Settings


// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// register plugin settings
function synack_register_settings() {

	register_setting( 
		'synack_options',
		'synack_options',
		'synack_callback_validate_options'
	); 


	/* Login Page Section */
	add_settings_section( 
		'synack_section_cta',
		esc_html__('Customize the CTA', 'synack'),
		'synack_callback_section_login',
		'synack'
	);


	/* Login Page Fields */
	add_settings_field(
		'custom_title',
		esc_html__('CTA Title', 'synack'),
		'synack_callback_field_text',
		'synack',
		'synack_section_cta',
		[ 'id' => 'custom_title', 'label' => esc_html__('Custom title attribute for the CTA', 'synack') ]
	);

	add_settings_field(
		'custom_message',
		esc_html__('CTA Message', 'synack'),
		'synack_callback_field_textarea',
		'synack',
		'synack_section_cta',
		[ 'id' => 'custom_message', 'label' => esc_html__('Custom text and/or markup', 'synack') ]
	);

	add_settings_field(
		'custom_button_text',
		esc_html__('CTA Button Text', 'synack'),
		'synack_callback_field_text',
		'synack',
		'synack_section_cta',
		[ 'id' => 'custom_button_text', 'label' => esc_html__('Custom button text for the CTA', 'synack') ]
	);

	add_settings_field(
		'custom_url',
		esc_html__('CTA URL', 'synack'),
		'synack_callback_field_text',
		'synack',
		'synack_section_cta',
		[ 'id' => 'custom_url', 'label' => esc_html__('Custom URL for the CTA link', 'synack') ]
	);

	add_settings_field(
		'custom_target',
		esc_html__('CTA Target', 'synack'),
		'synack_callback_field_radio',
		'synack',
		'synack_section_cta',
		[ 'id' => 'custom_target', 'label' => esc_html__('Custom target for the CTA', 'synack') ]
	);

}

add_action( 'admin_init', 'synack_register_settings' );