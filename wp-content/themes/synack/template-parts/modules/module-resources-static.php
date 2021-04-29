<?php
    $resources_static_module_heading = get_sub_field('resources_static_module_heading');
    $resources_static_count = count(get_sub_field('resources_static'));

    // dynamically assign grid classes
    $colSpanClass ="";
    switch ($resources_static_count) {
        case 0:
            $colSpanClass = "0";
            break;
        case 1:
            $colSpanClass = "12";
            break;
        case 2:
            $colSpanClass = "6";
            break;
        case 3:
            $colSpanClass = "4";
            break;
        case 4:
            $colSpanClass = "3";
            break;
    }
?>

<?php if ( have_rows('resources_static') ): ?>

<div class="synack-module module-resources-static p-y-lg" style="background-image: url(/wp-content/themes/synack/assets/media/images/lp/Synack-gradientBar.png); background-repeat: no-repeat; background-position: center center; background-size: cover;">
    <div class="synack-container">
        <?php if ($resources_static_module_heading): ?>
            <div class="row-fluid">
                <div class="span12">
                    <div class="resources-heading h2 m-b text-align-center text-white"><?= $resources_static_module_heading ;?></div>
                </div>
            </div>
        <?php endif;?>
        <div class="row-fluid md-up-d-flex mobile-m-x-0">
            <?php
                $resourceColNum = 0;
                while( have_rows('resources_static') ) : the_row();
                    $resourceColNum++;
                    // Load sub field value.
                    $resource_static_title = get_sub_field('resource_static_title');
                    $resource_static_type = get_sub_field('resource_static_type');

                    // Button ACF Clone
                    $button = get_sub_field('synack_global_button_group');
	                $buttonText = $button['syn_button_text'];
	                $buttonUrl = $button['syn_button_url'];
	                $buttonExtLink = $button['syn_button_external_link'];

	                if ($buttonExtLink){
	                    $buttonTarget = '_blank';
                    } else {
		                $buttonTarget = '_self';
                    }
                ?>

                <div class="resource-card span<?= $colSpanClass; ?> resource-static-col-count-<?= $resources_static_count; ?> col-num-<?= $resourceColNum; ?> text-align-center mobile-m-b border-radius p-a-md bg-white">
                    <div class="">
                        <div class="d-block h3 m-b-sm"><?= $resource_static_title; ?></div>
                        <p class="m-b"><?= $resource_static_type; ?></p>
                        <a class="button btn-primary" target="<?= $buttonTarget ;?>" href="<?= $buttonUrl; ?>"><?= $buttonText; ?></a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>

<?php else: ?>
    <div><?php // no rows found ?></div>
<?php endif; ?>

