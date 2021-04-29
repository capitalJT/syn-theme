<?php
/**
 * Template Part for Perks
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 */

if(have_rows('perks_&_benefits', 'option')){ ?>
    <div class="box">
        <div class="heading">
            <h2 class="heading-bd heading-bd_sm">
                Perks &amp; Benefits
            </h2>
            <div class="heading-ft">
                <div class="ruler ruler_center">
                    <div class="ruler-icon">
                        <span class="icon icon_ruler">
                            <svg class="icon-inner">
                                <use xlink:href="#icon-ruler"></use>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="vR vR_x10">
            <div class="blocks blocks_3up mix-blocks_2to3">
                <?php while(have_rows('perks_&_benefits', 'option')){ the_row(); ?>
                    <div class="tout">
                        <div class="tout-md tout-md_sm tout-md_noBottom">
                            <?php $imgID = get_sub_field('image');
                            if(!empty($imgID)){
                                $imgData = SYNImages::getImageData($imgID); ?>
                                <img src="<?php echo $imgData['urls']['perkBenefitThumbnail'];?>" alt="<?php echo $imgData['alt'];?>">
                            <?php } ?>
                        </div>
                        <h3 class="tout-hd">
                            <?php echo get_sub_field('text');?>
                        </h3>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php }