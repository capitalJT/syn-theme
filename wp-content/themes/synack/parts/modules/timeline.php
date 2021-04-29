<?php
/**
 * Template part for timelime module
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
$wowDelay = 0;
$wowOffset = 30;
?>

<?php if(get_sub_field('section_title')){ ?>
    <div class="vR vR_x4">
        <div class="heading">
            <h2 class="heading-bd">
                <?php echo get_sub_field('section_title'); ?>
            </h2>
            <div class="heading-ft">
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
        </div><!-- /.heading -->
    </div><!-- /.vR -->
<?php } ?>

<?php if(have_rows('timeline_events')){ ?>
    <div class="vR vR_x4">
        <div class="timeline">
            <?php while(have_rows('timeline_events')){ the_row(); ?>
                <div class="timeline-row">
                    <div class="timeline-item js-wow fadeIn" data-wow-offset="-<?php echo $wowOffset;?>" data-wow-delay="<?php echo $wowDelay;?>s">
                         <span class="timeline-line"></span>
                        <?php if(get_sub_field('title')){ ?>
                            <h3 class="timeline-hd">
                                <?php echo get_sub_field('title'); ?>
                            </h3>
                        <?php }?>
                        <?php if(get_sub_field('details')){ ?>
                            <p class="timeline-bd">
                                <?php echo get_sub_field('details'); ?>
                            </p>
                        <?php } ?>
                   </div>
                </div>
            <?php
                $wowOffset = $wowOffset + 60;
                $wowDelay  = $wowDelay+ 0.5;
            } //endwhile ?>
        </div><!-- /.timeline -->
    </div><!-- /.vR -->
<?php } ?>

<?php if(get_sub_field('call_to_action_url') && get_sub_field('call_to_action_label')){ ?>
    <div class="vR vR_x10">
        <div class="median median_center">
            <a href="<?php echo get_sub_field('call_to_action_url');?>" class="btn <?php echo $btnClass;?>">
                <?php echo get_sub_field('call_to_action_label') ?>
            </a>
        </div><!-- /.median -->
    </div><!-- /.vR -->
<?php } ?>