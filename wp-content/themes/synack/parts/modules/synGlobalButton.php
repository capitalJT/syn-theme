<style>
    .arrow {
        border: solid black;
        border-width: 0 3px 3px 0;
        display: inline-block;
        padding: 3px;
    }

    .right {
        transform: rotate(-45deg);
        -webkit-transform: rotate(-45deg);
    }
</style>
<?php
	// Button ACF Clone
	$button = get_sub_field('synack_global_button_group');
	$buttonText = $button['syn_button_text'];
	$buttonUrl = $button['syn_button_url'];
	$buttonExtLink = $button['syn_button_external_link'];

	// Primary Secondary Outlined
	$buttonStyle = $button['syn_button_style'];
	if ( $buttonStyle == "Primary"){
		$button_style_class = "btn-primary";
	} elseif ( $buttonStyle == "Light" ) {
		$button_style_class = "btn-light";
	} elseif ( $buttonStyle == "Outlined Light" ) {
		$button_style_class = "btn-outlined-light";
	} else {
		$button_style_class = "";
	}

	if ($buttonExtLink){
		$buttonTarget = '_blank';
	} else {
		$buttonTarget = '_self';
	}

	if ($buttonText &&  $buttonUrl){
		echo '<a class="button ' . $button_style_class . '" target="'. $buttonTarget . '" href="' . $buttonUrl . '">' . $buttonText. ' <!-- <i class="arrow right"></i> --></a>';
	}
?>