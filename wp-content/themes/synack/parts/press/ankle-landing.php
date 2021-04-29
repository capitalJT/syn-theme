<?php
/**
 * Template Part for Press Release Ankle
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 *
 */
?>

<div class="preFooter preFooter_particles mix-preFooter_left mix-preFooter_bg mix-preFooter_split">
    <div class="preFooter-inner">
        <div class="preFooter-inner-section mix-preFooter-inner-section_notMobile">
            <h2 class="preFooter-inner-section-subHd mix-preFooter-inner-section-subHd_space">Download</h2>

            <?php if(get_option('options_media_kit_title' )) { ?>
                <h3 class="preFooter-inner-section-hd">
                    <?php echo get_option('options_media_kit_title' );?>
                </h3>
            <?php } ?>

            <?php if(get_option('options_media_kit_subtext' )) { ?>
                <div class="preFooter-inner-section-bd mix-preFooter-inner-section-bd_spacedOut mix-preFooter-inner-section-bd_sm">
                    <?php echo get_option('options_media_kit_subtext' );?>
                </div>
            <?php } ?>

            <?php if( get_option('options_media_kit')) {
                $fileSize  = '';
                $fileURL   = wp_get_attachment_url(get_option('options_media_kit'));
                $fileData = wp_remote_get($fileURL);
                if(! is_wp_error($fileData)) {
                    if( isset($fileData['headers']['content-length']) && !empty( $fileData['headers']['content-length'])) {
                         $fileSize = number_format($fileData['headers']['content-length'] / 1048576, 1) . 'MB';
                    }
                }
                ?>
                <div class="preFooter-inner-section-cta">

                    <a href="<?php echo $fileURL; ?>" class="btn btn_arrow btn_reverse">Download Media Kit</a>
                    <?php if(!empty($fileSize)) { ?>
                        <span class="preFooter-inner-section-cta-detail"><?php echo $fileSize;?></span>
                    <?php } ?>

                </div>
            <?php } ?>

        </div>
        <div class="preFooter-inner-section mix-preFooter-inner-section_highlight">
            <?php if(get_option('options_media_contact_name')){?>

                <h2 class="preFooter-inner-section-subHd mix-preFooter-inner-section-subHd_space">Media Contact</h2>

                <div class="preFooter-inner-section-hd mix-preFooter-inner-section-hd_sm">
                    <?php echo get_option('options_media_contact_name');?>
                </div>

                <div class="preFooter-inner-section-bd mix-preFooter-inner-section-bd_tight mix-preFooter-inner-section-bd_spacedOut mix-preFooter-inner-section-bd_sm">


                    <?php if(get_option('options_media_contact_title')){?>
                         <div class="preFooter-inner-section-bd-vR">
                            <?php echo get_option('options_media_contact_title');?>
                        </div>
                    <?php } ?>


                    <?php if(get_option('options_media_contact_email_address')){?>

                            <a href="mailto:<?php echo get_option('options_media_contact_email_address');?>"><?php echo get_option('options_media_contact_email_address');?></a><br />

                    <?php } ?>

                    <?php if(get_option('options_media_contact_phone_number')){?>
                            <?php echo get_option('options_media_contact_phone_number');?>
                    <?php } ?>

                </div>

                <svg class="preFooter-inner-section-icon">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-logoIcon"></use>
                </svg>
            <?php } ?>
        </div>
    </div>
</div><!-- /.preFooter -->
