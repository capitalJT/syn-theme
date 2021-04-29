<?php
	// Removing Auto Paragraph and Break Tags from WYSIWYG Fields
	remove_filter('acf_the_content', 'wpautop');
?>

<?php
	// Scripts Toggle
	$synack_modules_styles_and_scripts_option_toggle = get_field('synack_modules_styles_and_scripts_option_toggle');
	$synack_modules_styles_and_scripts = get_field('synack_modules_styles_and_scripts');

	if ($synack_modules_styles_and_scripts_option_toggle){
		echo '<div class="syn-mod-styles-and-scripts">' . $synack_modules_styles_and_scripts . '</div>';
	}

	// Check value exists.
	if ( have_rows('synack_modules') ):

		// Loop through rows.
		while ( have_rows('synack_modules') ) : the_row();

			switch (get_row_layout()) {
				case 'quote':
					get_template_part('template-parts/modules/module-quote');
					break;
				case 'two_col_image_and_content':
					get_template_part('template-parts/modules/module-two-col-image-and-content');
					break;
				case 'two_col_media_and_content':
					get_template_part('template-parts/modules/module-two-col-media-and-content');
					break;
				case 'heading':
					get_template_part('template-parts/modules/module-heading');
					break;
				case 'wysiwyg_module':
					get_template_part('template-parts/modules/module-wysiwyg');
					break;
				case 'spacer_module':
					get_template_part('template-parts/modules/module-spacer');
					break;
				case 'hero_module':
					get_template_part('template-parts/modules/module-hero');
					break;
				case 'multi_column_content_module':
					get_template_part('template-parts/modules/module-multi-column-content');
					break;
				case 'cta_module':
					get_template_part('templates/modules/module-cta');
					break;
				case 'resources_module_static':
					get_template_part('template-parts/modules/module-resources-static');
					break;
				case 'tab_carousel_module':
					get_template_part('template-parts/modules/module-tab-carousel');
					break;
				default:
					echo 'no match';
			}

			// End loop.
		endwhile;

	// No value.
	else :
		// Do something...
	endif;
?>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>