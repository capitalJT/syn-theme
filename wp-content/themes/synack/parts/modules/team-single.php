<?php
/**
 * Template Part for filter Team Module
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 */

$args = array(
    'post_type' => 'synack-people',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'tax_query' => array(
        array(
            'taxonomy'         => 'departments',
            'field'            => 'id',
            'terms'            => get_sub_field('team_category'),
            'include_children' => true,
            'operator'         => 'IN'
        ),

    ),
);
$query = new WP_Query($args);

if($query->have_posts()){

    $color = (get_sub_field('icon_and_button_color'))
        ? get_sub_field('icon_and_button_color')
        : '';

    $btnClass = ($color == 'red')
        ? 'btn_red'
        : 'btn_primary';

    if(get_sub_field('section_title')){ ?>
        <div class="wrapper">
            <div class="box">
                <div class="vR vR_x5">
                    <div class="heading mix-heading_tight">
                        <h3 class="heading-bd heading-bd_small">
                            <?php echo get_sub_field('section_title'); ?>
                        </h3>
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
                        <?php if(get_sub_field('subtext')){ ?>
                            <div class="heading-text heading-text_spaced heading-text_tight mix-heading_centerMd">
                                <?php echo get_sub_field('subtext');?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php }?>

    <div class="wrapper">
        <div class="grid">
            <div class="grid-col mix-grid-col_10to8">
                <div class="vR vR_x6">
                    <ul class="blocks mix-blocks_2to4 mix-blocks_tight">
                        <?php while($query->have_posts()){
                            $query->the_post();
                            $meta = new SYNMeta(get_the_ID()); ?>
                            <li>
                                <a href="javascript:void(0);" class="infoTile" itemscope itemtype="http://schema.org/Person">
                                    <div class="infoTile-content">

                                        <div class="infoTile-content-name" itemprop="name">
                                            <?php the_title();?>
                                        </div>

                                        <?php if($meta->getMeta('role')) {?>
                                            <div class="infoTile-content-role" itemprop="jobTitle">
                                                <?php echo $meta->getMeta('role');?>
                                            </div>
                                        <?php } ?>

                                        <?php if($meta->getMeta('short_description')) {?>
                                            <div class="infoTile-content-meta">
                                                <p><?php echo $meta->getMeta('short_description');?></p>
                                            </div>
                                        <?php } ?>

                                    </div>

                                    <?php if($meta->getMeta('profile_image')) {

                                        $img = SYNImages::getImageData($meta->getMeta('profile_image'));?>
                                        <img src="<?php echo $img['urls']['peopleThumbnail'];?>" alt="<?php echo $img['alt'];?>" class="infoTile-figure" itemprop="image" />
                                    <?php } ?>

                                </a>
                            </li>
                        <?php }
                            wp_reset_postdata(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <?php if(get_sub_field('call_to_action_url') && get_sub_field('call_to_action_label')){ ?>
        <div class="wrapper">
            <div class="vR vR_x8">
                <div class="median median_center">
                    <a href="<?php echo get_sub_field('call_to_action_url');?>" class="btn <?php echo $btnClass;?>">
                        <?php echo get_sub_field('call_to_action_label') ?>
                    </a>
                </div><!-- /.median -->
            </div><!-- /.vR -->
        </div>
    <?php }
}
