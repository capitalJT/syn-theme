<?php
/**
 * Template Part for Project Heading
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 */
global $post;
?>


<div class="wrapper">
    <div class="heading mix-heading_tight mix-heading_left mix-heading_centerMd">
        <div class="heading-hd">
            <?php if($post->post_type == 'synack-projects'){ ?>
                <abbr title="Research and Development">R&amp;D</abbr> Project &#124; <span> <?php echo get_the_time('F j, Y' )?></span>
            <?php }elseif($post->post_type == 'post'){ ?>
                <span><?php echo get_the_time('F j, Y' )?></span> &#124; <span><?php echo SYNGetMinutesToRead(get_the_content()); ?> Min. Read</span>
            <?php }elseif($post->post_type == 'synack-press'){ ?>
                <span><?php echo get_the_time('F j, Y' )?></span> &#124; <span>Press Release</span>
            <?php } ?>
            <time class="u-isVisuallyHidden" itemprop="datePublished"><?php echo get_the_time('c' )?></time>
        </div>

        <h1 class="heading-bd" itemprop="headline">
            <?php the_title(); ?>
        </h1>

        <div class="heading-divider">
            <div class="ruler ruler_centerMd">
                <div class="ruler-icon">
                    <span class="icon icon_ruler">
                        <svg class="icon-inner">
                            <use xlink:href="#icon-ruler"></use>
                        </svg>
                    </span>
                </div>
            </div>
        </div>

        <div class="navTitle">
            <?php if($post->post_type == 'post'){ ?>
                <div class="navTitle-hdg">Share</div>
                <?php get_template_part('parts/shared/socialShare');?>
            <?php }elseif($post->post_type == 'synack-projects'){ ?>
                <div class="navTitle-hdg">Project <abbr title="Rich Site Summary">RSS</abbr></div>
                <div>
                    <a href="<?php echo get_post_type_archive_link('synack-projects'); ?>feed" class="link link_light">Get the <abbr title="Research and Development">R&amp;D</abbr> <abbr title="Rich Site Summary">RSS</abbr> Feed</a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
