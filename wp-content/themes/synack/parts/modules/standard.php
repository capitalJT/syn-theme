<?php
/**
 * Template Part for standard content section
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 */
$color = (get_sub_field('icon_color'))
            ? get_sub_field('icon_color')
            : '';

$btnClass = ($color == 'red')
    ? 'btn_red'
    : 'btn_primary';
?>

<div class="wrapper">
    <div class="box box_md">
        <div class="moduleTxtHero">
            <div class="moduleTxtHero-hd">

                <?php if(get_sub_field('section_title')){ ?>
                    <div class="heading">
                        <h2 class="heading-bd heading-bd_small">
                            <?php echo get_sub_field('section_title'); ?>
                        </h2>
                        <div class="heading-divider">
                            <div class="ruler ruler_center">
                                <div class="ruler-icon">
                                    <span class="icon icon_ruler <?php if($color == 'red') echo 'mix-icon_ruler-red';?>">
                                        <svg class="icon-inner">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-ruler"></use>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
            <?php if(get_sub_field('content')){ ?>
                <div class="moduleTxtHero-bd">
                    <div class="wysiwyg">
                        <?php $content = get_sub_field('content');
                        $content = apply_filters('the_content', $content );
                        echo $content; ?>
                    </div>
                </div>
            <?php } ?>

            <?php if(get_sub_field('call_to_action_url') && get_sub_field('call_to_action_label')){ ?>
                <div class="moduleTxtHero-ft">
                    <a href="<?php echo get_sub_field('call_to_action_url');?>" class="btn <?php echo $btnClass;?>">
                        <?php echo get_sub_field('call_to_action_label') ?>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
