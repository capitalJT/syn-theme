<?php

/* START CTA SHORTCODES */

/*
 * Download CTA
 * shortcode: [cta-download cta_title="" cta_subtitle="" cta_content="" cta_link=""]
 */
function cta_download($atts){
	$cta_title = '';
	$cta_subtitle = '';
	$cta_content = '';
	$cta_link = '';
	extract(
		shortcode_atts(
			array(
				'cta_title' => '',
				'cta_subtitle' => '',
				'cta_content' => '',
				'cta_link' => ''
			), $atts
		)
	);

	$cta_download_html = "<div class='cta cta-download'>";
	$cta_download_html .= "<div class='cta-download-inner'>";
	$cta_download_html .= "<div class='col-1'>";
	if($cta_title !== '') {
		$cta_download_html .= "<h3 class='cta-title'>$cta_title</h3>";
	} else {
		$cta_download_html .= "<h3 class='cta-title'>We are Synack, the most trusted Crowdsourced Security Platform.</h3>";
	}

	if($cta_subtitle !== '') {
		$cta_download_html .= "<h4 class='cta-subtitle'>$cta_subtitle</h4>";
	}

	if($cta_content !== '') {
		$cta_download_html .= "<p class='cta-paragraph'>$cta_content</p>";
	} else {
		$cta_download_html .= "<p class='cta-paragraph'>Comprehensive penetration testing with actionable results. Continuous security scaled by the world’s most skilled ethical hackers and AI technology.</p>";
	}
	$cta_download_html .= "</div>";
	$cta_download_html .= "<div class='col-2'>";
	if($cta_link !== '') {
		$cta_download_html .= "<a class='cta-button' href='$cta_link'>Get Started</a>";
	} else {
		$cta_download_html .= "<a class='btn cta-button has-shadow' href='/contact/?utm_source=synack-cta'>Get Started</a>";
	}
	$cta_download_html .= "</div>";
	$cta_download_html .= "</div>";
	$cta_download_html .= "</div>";

	return $cta_download_html;
}

add_shortcode('cta-download', 'cta_download');

/* END CTA SHORTCODES */