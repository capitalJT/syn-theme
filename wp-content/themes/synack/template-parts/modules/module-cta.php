<?php

    if (get_sub_field('module_custom_id')){
	    $module_custom_id = get_sub_field('module_custom_id') ?: 'module-cta';
    }

    if (get_sub_field('module_background_color')){
	    $module_background_color = get_sub_field('module_background_color');
    }

    function ctaModuleBgImgUrl() {
	    if (get_sub_field('module_background_image')){
		    $module_background_image = get_sub_field('module_background_image');
	    } else {
		    $module_background_image = "";
	    }
	    echo $module_background_image;
    }

    if (get_sub_field('cta_module_heading')){
	    $cta_module_heading = get_sub_field('cta_module_heading');
    }

    if (get_sub_field('cta_module_subheading')){
	    $cta_module_subheading = get_sub_field('cta_module_subheading');
    }

    if (get_sub_field('cta_module_body_copy')){
	    $cta_module_body_copy = get_sub_field('cta_module_body_copy');
    }

    if (get_sub_field('cta_button')){
	    $cta_button = get_sub_field('cta_button');
    }

?>

<div id="<?= $module_custom_id; ?>"
     class="synack-module cta"
     style="background-color: <?= $module_background_color ?>; background-image: url(<?php ctaModuleBgImgUrl(); ?>); background-repeat: no-repeat; background-position: center center; background-size: cover;" >
    <div class="synack-container p-y-lg text-align-center">
        <div class="row-fluid">
            <div class="span12">
                <h3 class="cta-heading h2"><?= $cta_module_heading; ?></h3>
                <h4 class="cta-subheading h3 m-b-sm"><?= $cta_module_subheading; ?></h4>

                <div class="module-body-copy"><?= $cta_module_body_copy; ?></div>

                <?php if ( have_rows('cta_button') ):

	                while( have_rows('cta_button') ): the_row();
                        $cta_button_opens_in_new_tab = $cta_button['cta_button_opens_in_new_tab'];
                        $cta_button_text = $cta_button['cta_button_text'];
                        $cta_button_url = $cta_button['cta_button_url'];
                        $cta_button_id = $cta_button['cta_button_id'];
                        $cta_button_classes = $cta_button['cta_button_classes'];
                    ?>

                        <a id="<?= $cta_button_id; ?>" class="button btn-primary btn-lg <?= $cta_button_classes; ?>" href="<?= $cta_button_url; ?>" <?php if ($cta_button_opens_in_new_tab){ echo 'target="_blank"';} ?>><?= $cta_button_text; ?></a>

	                <?php endwhile; ?>

                <?php else: ?>
                // no rows found
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
