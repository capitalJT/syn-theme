<?php

	/* Check for URL parameter */
	function synGetUrlParam($synGetUrlParamkey) {
		if ( isset( $_GET[$synGetUrlParamkey] ) ) {
			$synGetUrlParamkey = $_GET[$synGetUrlParamkey];
			return $synGetUrlParamkey;
		}
		return null;
	}

	/* Check if cookie is set */
	function synCheckCookie($synCookieName) {
		if ( isset($_COOKIE[$synCookieName]) ) {
			return $_COOKIE[$synCookieName];
		}
		return null;
	}

	/* Check for HardUngated URL parameter */
	function synIsHardUngated($hardUng8UrlParam) {
		$ungating_url_parameter = get_field('ungating_url_parameter');
//		echo $ungating_url_parameter;
		if (synGetUrlParam($hardUng8UrlParam)){
			if (synGetUrlParam($hardUng8UrlParam) == $ungating_url_parameter){
//				echo $ungating_url_parameter;
				return true;
			}
		}
		return null;
	}

	/* Check if page is ungate via form submission or hard ungating */
	function synIsPageUngated(){
// TODO: Commented out to test issue

//		if ( ((synCheckCookie('synack-form-success')) && (synGetUrlParam('aliId'))) || (synIsHardUngated('ung8'))){
//			return true;
//		}

//		if ( synGetUrlParam('aliId') || synIsHardUngated('ung8') ){
//			return true;
//		}

		$marketoFormUrlParam = array_key_exists("aliId", $_GET);
		if ( $marketoFormUrlParam || synIsHardUngated('ung8') ){
			return true;
		} else {
			return null;
		}

//		return null;
	}

	/* Landing Page Gating */
	function syn_content_gating(){
		$gated_content = get_field('gated_content');
		$ungated_content = get_field('ungated_content');

		if ( synIsPageUngated() ){
			$syn_g8d_result = $ungated_content;
		} else {
			$syn_g8d_result = $gated_content;
		}

		function syn_gated_content_block($syn_g8d_result){
				$output ='<div class="p-a-sm m-b">';
					$output .='<div>'. $syn_g8d_result .'</div>';
				$output .='</div>';
			echo $output;
		}

		syn_gated_content_block($syn_g8d_result);
	}

?>