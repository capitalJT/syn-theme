<?php // Synack - Core Functionality

// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * Custom CTA
 * shortcode: [synack-cta]
 */
function synack_cta(){

	$options = get_option( 'synack_options', synack_options_default() );

	$synack_default_options_array = synack_options_default();

	/*
	 * $synack_cta_default_title = $synack_default_options_array['custom_title'];
	 * $synack_cta_default_message = $synack_default_options_array['custom_message'];
	 * $synack_cta_default_button_text = $synack_default_options_array['custom_button_text'];
	 * $synack_cta_default_url = $synack_default_options_array['custom_url'];
	 * $synack_cta_default_target = $synack_default_options_array['custom_target'];
	 */

	$custom_cta_html = "<div class='cta synack-cta'>";
		$custom_cta_html .= "<div class='synack-cta-inner'>";
			$custom_cta_html .= "<div class='cta-column-1'>";

				if ( isset( $options['custom_title'] ) && ! empty( $options['custom_title'] ) ) {
					$custom_cta_html .= "<h3 class='cta-title'>". $options['custom_title'] ."</h3>";
				} else {
					$custom_cta_html .= "<h3 class='cta-title'>". $synack_default_options_array['custom_title'] ."</h3>";
				}

				$custom_cta_html .= "<div class='cta-content'>";
					if ( isset( $options['custom_message'] ) && ! empty( $options['custom_message'] ) ) {
						$cta_message =  wp_kses_post( $options['custom_message'] );
					} else {
						$cta_message = wp_kses_post( $synack_default_options_array['custom_message'] );
					}
					$custom_cta_html .= $cta_message;
				$custom_cta_html .= "</div><!-- end .cta-content -->";

			$custom_cta_html .= "</div><!-- end .cta-column-1 -->";

			$custom_cta_html .= "<div class='cta-column-2'>";

				if ( isset( $options['custom_url'] ) && ! empty( $options['custom_url'] ) ) {
					$cta_link = esc_url( $options['custom_url'] );
				} else {
					$cta_link = esc_url( $synack_default_options_array['custom_url'] );
				}

				if ( isset( $options['custom_button_text'] ) && ! empty( $options['custom_button_text'] ) ) {
					$cta_button_text = sanitize_text_field( $options['custom_button_text'] );
				} else {
					$cta_button_text = sanitize_text_field( $synack_default_options_array['custom_button_text'] );
				}

				if ( isset( $options['custom_target'] ) && ! empty( $options['custom_target'] ) ) {
					$target = sanitize_text_field( $options['custom_target'] );
				} else {
					$target = sanitize_text_field( $synack_default_options_array['custom_target'] );
				}

				if ( 'blank' === $target ) {
					$cta_target = "_blank";
				} else {
					$cta_target = "_self";
				}

				$custom_cta_html .= "<a class='cta-btn has-shadow' href='". $cta_link ."' target='". $cta_target ."'>". $cta_button_text ."</a>";

			$custom_cta_html .= "</div><!-- end .cta-column-2 -->";
		$custom_cta_html .= "</div><!-- end .synack-cta-inner -->";
	$custom_cta_html .= "</div><!-- end .synack-cta -->";

	return $custom_cta_html;
}


function synack_register_cta_shortcodes() {
	/* Adding Shortcodes */
	add_shortcode('synack-cta', 'synack_cta');

	/* Adding Styles */
	wp_register_style( 'synack_cta_styles', plugins_url('../public/css/synack-cta-styles.css', __FILE__), false, '1.0.0', 'all');
	wp_enqueue_style( 'synack_cta_styles' );

	/* Adding Scripts */
	wp_register_script( 'synack_cta_scripts', plugins_url('../public/js/synack-cta-scripts.js',__FILE__ ));
	wp_enqueue_script('synack_cta_scripts');
}

add_action( 'init', 'synack_register_cta_shortcodes');