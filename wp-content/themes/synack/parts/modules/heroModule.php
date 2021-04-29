<?php
/**
 * Template Part for hero module
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 */

$color = (get_sub_field('icon_and_button_color'))
    ? get_sub_field('icon_and_button_color')
    : '';
$btnClass = ($color == 'red')
    ? 'btn_red'
    : 'btn_primary';

?>
    <div class="triangle">
        <div class="triangle-shape triangle-shape_12"></div>
        <div class="wrapper">
            <div class="box">
                <div class="modulePage">

                    <div class="modulePage-hd">
                        <div class="marquee marquee_primary mix-marquee_space">
                            <div class="heading heading_primary">
                                <?php if(get_sub_field('title')){ ?>
                                    <h2 class="heading-bd heading-bd_hero">
                                        <?php echo get_sub_field('title');?>
                                    </h2>
                                <?php } ?>
                                <div class="heading-divider">
                                    <div class="ruler ruler_center">
                                        <div class="ruler-icon">
                                            <span class="icon icon_ruler <?php if($color == 'red') echo 'mix-icon_ruler-red';?>">
                                                <svg class="icon-inner">
                                                    <use xlink:href="#icon-ruler"></use>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if(get_sub_field('subtext')){ ?>
                        <div class="modulePage-bd ">
                            <h3><?php echo get_sub_field('subtext');?></h3>
                        </div>
                    <?php } ?>

                    <?php if(get_sub_field('hero_image')){
                        $img = get_sub_field('hero_image'); ?>
                            <div class="modulePage-bg modulePage-bg_stretch">
                                <img src="<?php echo $img['url'];?>" alt="" class="modulePage-bg-md" />
                            </div>
                    <?php } ?>

                    <?php if(get_sub_field('two_column_content')){ ?>
                        <div class="modulePage-ft">
                            <?php echo get_sub_field('two_column_content');?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
