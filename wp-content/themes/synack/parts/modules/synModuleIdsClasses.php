<?php

/**
 * Template Part to display Module Titles
 *
 * @package WordPress
 * @subpackage Synack
 * @author Jabal Torres <jtorres@synack.com>
 * @since 1.0
 */

// ACF Synack Global Module Ids and Classes Clone

function synack_module_global_id() {
	$synack_module_global_id_and_classes = get_sub_field( 'synack_global_module_ids_and_classes' );
	$synack_module_global_id = $synack_module_global_id_and_classes['synack_module_global_id'];
	if ( $synack_module_global_id ) {
		echo $synack_module_global_id;
	}
}

function synack_module_global_classes() {
	$synack_module_global_id_and_classes = get_sub_field( 'synack_global_module_ids_and_classes' );
	$synack_module_global_classes = $synack_module_global_id_and_classes['synack_module_global_classes'];
	if ( $synack_module_global_classes ) {
		echo $synack_module_global_classes;
	}
}