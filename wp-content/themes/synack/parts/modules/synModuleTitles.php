<?php

/**
 * Template Part to display Module Titles
 *
 * @package WordPress
 * @subpackage Synack
 * @author Jabal Torres <jtorres@synack.com>
 * @since 1.0
 */

// ACF Synack Global Module Titles Clone
$synack_global_module_titles      = get_sub_field( 'synack_global_module_titles' );
$synModuleHeading                 = $synack_global_module_titles['syn_module_heading'];
$synModuleSubheading              = $synack_global_module_titles['syn_module_subheading'];
$syn_module_titles_text_alignment = $synack_global_module_titles['syn_module_titles_text_alignment'];

if ( $synModuleHeading || $synModuleSubheading ):?>
	<header class="module-header text-align-<?= strtolower($syn_module_titles_text_alignment); ?> m-b">
		<?php if ($synModuleHeading):?>
			<h2 class="module-heading"><?php echo wp_kses_post( $synModuleHeading ); ?></h2>
		<?php endif;?>
		<?php if ($synModuleSubheading):?>
			<h3 class="module-subheading"><?php echo wp_kses_post( $synModuleSubheading ); ?></h3>
		<?php endif;?>
	</header>
<?php endif;?>