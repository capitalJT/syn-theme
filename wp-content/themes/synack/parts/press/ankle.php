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
        <div class="preFooter-inner-section">
            <h2 class="preFooter-inner-section-subHd mix-preFooter-inner-section-subHd_space">About Synack</h2>
            <div class="preFooter-inner-section-bd mix-preFooter-inner-section-bd_spacedOut mix-preFooter-inner-section-bd_sm">
                <?php $content = get_option('options_about_us_press_release');
                $content = apply_filters('the_content', $content );
                echo $content; ?>
            </div>
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
