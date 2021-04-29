<?php
    $section_id = get_sub_field('section_id');
    $section_classes = get_sub_field('section_classes');
    $title = get_sub_field('title');
    $media_left_or_right = get_sub_field('media_left_or_right');

    $content = get_sub_field('content');
    $link = get_sub_field('link');
    $link_text = get_sub_field('link_text');
    $link_target_blank = get_sub_field('link_target_blank');

    $target_attr = "";
    if ($link_target_blank){
        $target_attr = 'target="_blank"';
    }

    $button_size = get_sub_field('button_size');
    if ( $button_size == "Large"){
        $button_size_class = "btn-lg";
    } else {
        $button_size_class = "";
    }

    // assign `$section_id` to `$section_container_id` if has value
    $section_container_id = $section_id ? $section_id : "";
    $section_container_classes = $section_classes ? $section_classes : "";

    // Image variables.
    $image = get_sub_field('image');
    $url = $image['url'];
    $image_title = $image['title'];
    $alt = $image['alt'];
    $caption = $image['caption'];

    // module_media_type
    $module_media_type = get_sub_field('module_media_type');

    // Thumbnail size attributes.
    $size = 'large'; // (thumbnail, medium, large, or custom size)
    $thumb = $image['sizes'][ $size ];
    // $width = $image['sizes'][ $size . '-width' ];
    // $height = $image['sizes'][ $size . '-height' ];

    // Video Embed Code
    $video_embed_code = get_sub_field('video_embed_code');

    // Section background color
    $media_and_content_module_background_color = get_sub_field('media_and_content_module_background_color');

    // Padding and Margins
    $media_content_module_margin_top = get_sub_field('media_content_module_margin_top');
    $media_content_module_margin_bottom = get_sub_field('media_content_module_margin_bottom');
    $media_content_module_padding_top = get_sub_field('media_content_module_padding_top');
    $media_content_module_padding_bottom = get_sub_field('media_content_module_padding_bottom');
?>
<div id="<?= $section_container_id; ?>" class="<?= $section_container_classes; ?>" style="background-color: <?= $media_and_content_module_background_color; ?>; margin-top: <?= $media_content_module_margin_top; ?>px; margin-bottom: <?= $media_content_module_margin_bottom; ?>px; padding-top: <?= $media_content_module_padding_top; ?>px; padding-bottom: <?= $media_content_module_padding_bottom; ?>px;">
    <div class="synack-container module-two-col-media-and-content">
        <div class="row-fluid md-up-d-flex md-up-align-items-center">

            <?php
                // Image Variables
                $mediaWrapperClasses = "";
                $contentWrapperClasses = "";
                if ( $media_left_or_right ){
                    $mediaWrapperClasses = "md-up-order-1";
                    $contentWrapperClasses = "md-up-order-2";
                } else {
                    $mediaWrapperClasses = "md-up-order-2";
                    $contentWrapperClasses = "md-up-order-1";
                }
            ?>

            <div class="span6 media-wrapper mobile-m-b-sm <?php echo $mediaWrapperClasses; ?>">
                <?php
                    if ($module_media_type) {
                        if ( $module_media_type == "Image" ) {?>
                            <?php if ( $image ): ?>

                                <?php // Begin caption wrap.
                                    if ( $caption ): ?>
                                    <div class="image-has-caption">
                                <?php endif; ?>

                                <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" />

                                <?php // End caption wrap.
                                    if ( $caption ): ?>
                                        <p class="wp-caption-text m-b-0"><?php echo esc_html($caption); ?></p>
                                    </div><!-- end .wp-caption -->
                                <?php endif; ?>
                            <?php endif; ?>

                        <?php } elseif ( $module_media_type == "Video" ) {
                            if ($video_embed_code) {
                                echo $video_embed_code;
                            }
                        }
                    }
                ?>
            </div>
            <div class="span6 content-wrapper <?php echo $contentWrapperClasses; ?>">
                <?php if ($title): ?>
                    <h3 class="content-heading h2 m-b-sm"><?php echo $title; ?></h3>
                <?php endif; ?>

                <?php if ($content): ?>
                    <div class="content-wrapper m-b-sm"><?php echo $content; ?></div>
                <?php endif; ?>

                <?php if ($link && $link_text): ?>
                    <a class="button btn-primary <?= $button_size_class; ?>" href="<?php echo $link; ?>" <?php echo $target_attr; ?>><?php echo $link_text; ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

