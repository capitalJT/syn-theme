<?php
    $section_id = get_sub_field('section_id');
    $title = get_sub_field('title');
    $image_left_or_right = get_sub_field('image_left_or_right');

    $content = get_sub_field('content');
    $link = get_sub_field('link');
    $link_text = get_sub_field('link_text');
    $link_target_blank = get_sub_field('link_target_blank');

    $target_attr = "";
    if ($link_target_blank){
        $target_attr = 'target="_blank"';
    }

    // assign `$section_id` to `$section_container_id` if has value
    $section_container_id = $section_id ? $section_id : "";

    // Image variables.
    $image = get_sub_field('image');
    $url = $image['url'];
    $image_title = $image['title'];
    $alt = $image['alt'];
    $caption = $image['caption'];

    // Thumbnail size attributes.
    $size = 'large'; // (thumbnail, medium, large, or custom size)
    $thumb = $image['sizes'][ $size ];
    // $width = $image['sizes'][ $size . '-width' ];
    // $height = $image['sizes'][ $size . '-height' ];
?>

<div id="<?php echo $section_container_id; ?>" class="synack-container p-y-md module-two-col-image-and-content">
    <div class="row-fluid md-up-d-flex md-up-align-items-center">

        <?php
            $imageWrapperClasses = "";
            $contentWrapperClasses = "";
            if ( $image_left_or_right ){
                $imageWrapperClasses = "md-up-order-1";
                $contentWrapperClasses = "md-up-order-2";
            } else {
                $imageWrapperClasses = "md-up-order-2";
                $contentWrapperClasses = "md-up-order-1";
            }
        ?>
        <div class="span6 img-wrapper <?php echo $imageWrapperClasses; ?>">
            <?php if( $image ):
                // Begin caption wrap.
                if( $caption ): ?>
                    <div class="wp-caption">
                <?php endif; ?>

                    <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" />

                <?php
                // End caption wrap.
                if( $caption ): ?>
                    <p class="wp-caption-text m-b-0"><?php echo esc_html($caption); ?></p>
                    </div><!-- end .wp-caption -->
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <div class="span6 <?php echo $contentWrapperClasses; ?>">
            <?php if ($title): ?>
                <h3 class="h2 m-b-sm"><?php echo $title; ?></h3>
            <?php endif; ?>

            <?php if ($content): ?>
                <div class="content-wrapper m-b-sm"><?php echo $content; ?></div>
            <?php endif; ?>

            <?php if ($link && $link_text): ?>
                <a class="button btn-primary" href="<?php echo $link; ?>" <?php echo $target_attr; ?>><?php echo $link_text; ?></a>
            <?php endif; ?>
        </div>
    </div>
</div>
