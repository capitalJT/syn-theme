<?php
    $module_heading = get_sub_field('module_heading');
    $module_subheading = get_sub_field('module_subheading');
    $module_body_copy = get_sub_field('module_body_copy');

    $heading_text_align = get_sub_field('hero_text_alignment');

    $hero_thumbnail_toggle = get_sub_field('hero_use_thumbnail_image');

    $module_thumbnail = get_sub_field('module_thumbnail');
    $module_thumbnail_position_toggle_left = get_sub_field('module_thumbnail_position_toggle_left');
    $module_thumbnail_size = 'full'; // (thumbnail, medium, large, full or custom size)

    $module_background_color = get_sub_field('module_background_color');
    $module_background_image = get_sub_field('module_background_image');
    $hero_text_color = get_sub_field('hero_text_color');

    // CTA Button Fields
    $cta_button = get_sub_field('cta_button');
    $cta_button_text = $cta_button['cta_button_text'];
    $cta_button_url = $cta_button['cta_button_url'];
    $cta_button_id = $cta_button['cta_button_id'];
    $cta_button_classes = $cta_button['cta_button_classes'];
?>


<?php
    $imageWrapperClasses = "";
    $contentWrapperClasses = "";
    if ( $module_thumbnail_position_toggle_left ){
        $imagePositionClasses = "md-up-order-1";
        $contentPositionClasses = "md-up-order-2";
    } else {
        $imagePositionClasses = "md-up-order-2";
        $contentPositionClasses = "md-up-order-1";
    }
?>

<?php
// Logic for one or two cols depending if img thumbnail is true
if ($hero_thumbnail_toggle){
    $content_col_class = "span6";
} else {
    $content_col_class = "span12";
}
?>

<?php
// Heading text alignment logic
    $heading_text_align_class = "";
    if ( $heading_text_align == 'left' ) {
        $heading_text_align_class = "text-align-left";
    } elseif ( $heading_text_align == 'center' ) {
        $heading_text_align_class = "text-align-center";
    } elseif ( $heading_text_align == 'right' ) {
        $heading_text_align_class = "text-align-right";
    }
?>

<div class="synack-module hero" style="background-color: <?= $module_background_color ?>; background-image: url(<?= $module_background_image['url'] ?>); background-repeat: no-repeat; background-position: center center; background-size: cover;" >
    <div class="synack-container">
        <div class="row-fluid md-up-d-flex md-up-align-items-center p-y-lg <?= $heading_text_align_class; ?>">
            <?php if ($hero_thumbnail_toggle && $module_thumbnail): ?>
                <div class="span6 <?php echo $imagePositionClasses; ?>">
                    <div class="hero-thumbnail-wrapper border mobile-m-b">
                        <img class="d-block" src="<?php echo esc_url($module_thumbnail['url']); ?>" alt="<?php echo esc_attr($module_thumbnail['alt']); ?>" />
                    </div>
                </div>
            <?php endif; ?>


            <div class="<?php echo $content_col_class . " " . $contentPositionClasses; ?>">

                <?php if ($module_heading): ?>
                    <h1 class="hero-heading display-3 m-b-sm" style="color: <?= $hero_text_color; ?>";><?php echo $module_heading; ?></h1>
                <?php endif; ?>

                <?php if ($module_subheading): ?>
                    <h3 class="hero-subheading m-b" style="color: <?= $hero_text_color; ?>";><?php echo $module_subheading; ?></h3>
                <?php endif; ?>

                <?php if ($module_body_copy): ?>
                    <div class="hero-body-copy" style="color: <?= $hero_text_color; ?>";><?php echo $module_body_copy; ?></div>
                <?php endif; ?>

                <?php if ($cta_button_url ) {
                    $cta_button_href = $cta_button_url ? $cta_button_url : '#';
                }?>

                <?php if ($cta_button_text && $cta_button_url): ?>
                    <a id="<?= $cta_button_id; ?>" class="button <?= $cta_button_classes; ?>" href="<?= $cta_button_href; ?>"><?= $cta_button_text; ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery( document ).ready(function($) {
        if ($('.header-hero-wrapper').length){
            var $headerWrapper = $('.header-hero-wrapper').outerHeight();

            $('.synack-module.hero').css({'margin-top' : '-' + $headerWrapper + 'px', 'padding-top' : $headerWrapper + 'px'});
        }
    });
</script>