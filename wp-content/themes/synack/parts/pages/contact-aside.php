<?php
/**
 * Template Part for Contact Aside
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 *
 */
?>

<div class="box">
    <ul class="listV mix-listV_spaceXlg">
        <li itemscope itemtype="http://schema.org/LocalBusiness" class="contactListing">
            <div class="contactListing-hd">Contact Us</div>

            <?php if(get_option('options_contact_title')){ ?>
                <div itemprop="name" class="contactListing-text">
                    <?php echo get_option('options_contact_title'); ?>
                </div>
            <?php } ?>

            <?php if(get_option('options_contact_address')){ ?>
                <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress" class="contactListing-text">
                   <?php echo wpautop( get_option('options_contact_address'), true); ?>
                </div>
            <?php } ?>

            <?php if(get_option('options_contact_phone_number')){ ?>
                <div itemprop="telephone" class="contactListing-text">
                    <?php echo get_option('options_contact_phone_number'); ?>
                </div>
            <?php } ?>

         </li>

        <?php if( have_rows('contact_blocks', 'option') ){
            // loop through the rows of data
            while ( have_rows('contact_blocks', 'option') ) { the_row(); ?>

                <li>
                    <div class="contactListing">
                    <?php if(get_sub_field('contact_label')){?>
                            <div class="contactListing-hd">
                                <?php the_sub_field('contact_label'); ?>
                            </div>
                    <?php } ?>

                    <?php if(get_sub_field('contact_email_address')){?>
                        <a href="mailto:<?php the_sub_field('contact_email_address'); ?>" class="contactListing-link">
                            <?php the_sub_field('contact_email_address'); ?>
                        </a>
                    <?php } ?>
                    </div>
                </li>

            <?php }
        } ?>
    </ul>
</div>
