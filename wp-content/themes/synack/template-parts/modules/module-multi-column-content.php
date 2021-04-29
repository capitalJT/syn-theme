<?php
    $module_custom_id = get_sub_field('module_custom_id');
    $module_additional_classes = get_sub_field('module_additional_classes');
    $module_heading_text_alignment = get_sub_field('module_heading_text_alignment');
    $module_heading = get_sub_field('module_heading');
    $module_subheading = get_sub_field('module_subheading');
    $module_background_color = get_sub_field('module_background_color');
    $module_background_image = get_sub_field('module_background_image');
    $column_content_custom_class = get_sub_field('column_content_custom_class');
    $column_content_count = count(get_sub_field('column_content'));

    // CTA Button
    $show_module_cta = get_sub_field('show_module_cta');
    $cta_button = get_sub_field('cta_button');
    $cta_button_text = $cta_button['cta_button_text'];
    $cta_button_url = $cta_button['cta_button_url'];
    $cta_button_id = $cta_button['cta_button_id'];



    switch ($column_content_count) {
        case "1":
            $columnClass = "span12";
            break;
        case "2":
            $columnClass = "span6";
            break;
        case "3":
            $columnClass = "span4";
            break;
        case "4":
            $columnClass = "span3";
            break;
        default:
            echo "xspan";
    }
?>

<div <?php if ($module_custom_id) { echo 'id="' . $module_custom_id . '"';} ?> class="multi-column-content <?= $module_additional_classes; ?>" style="background-color: <?= $module_background_color; ?>; background-image: url(<?= $module_background_image['url'] ?>); background-repeat: no-repeat; background-position: center center; background-size: cover;">
    <div class="synack-container">
        <?php if ($module_heading || $module_subheading): ?>
            <div class="row-fluid m-b">
                <div class="span12 text-align-<?= strtolower($module_heading_text_alignment); ?>">
                    <?php if ($module_heading): ?>
                        <h2 class="module-heading"><?php echo $module_heading; ?></h2>
                    <?php endif; ?>
                    <?php if ($module_subheading): ?>
                        <h3 class="module-subheading"><?php echo $module_subheading; ?></h3>
                    <?php endif; ?>

                    <?php if ($show_module_cta && $cta_button_text && $cta_button_url): ?>
                        <a href="<?= $cta_button_url; ?>" class="module-cta">
                            <button id="<?= $cta_button_id; ?>" class="button m-t-sm btn-light btn-lg"><?php echo $cta_button_text; ?></button>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="row-fluid">
            <?php

            // Check rows exists.
            if ( have_rows('column_content') ):

                // Loop through rows.
                while( have_rows('column_content') ) : the_row();

                    // Load sub field value.
                    $column_heading = get_sub_field('column_heading');

                    // The 2 false params will prevent formatting.
                    $column_body = get_sub_field('column_body', false, false);

	                echo '<div class="multi-column-content-column ' . $columnClass . ' ' . $column_content_custom_class . '">';
                        if ($column_heading){
                            echo '<h3 class="column-heading">' . $column_heading . '</h3>';
                        }

                        if ($column_body){
                            echo '<div class="column-body">' . $column_body . '</div>';
                        }

                        get_template_part( 'parts/modules/synGlobalButton' );

                    echo '</div>';

                    // End loop.
                endwhile;

            // No value.
            else :
                // Do something...
            endif;

            ?>
        </div>
    </div>

</div>

