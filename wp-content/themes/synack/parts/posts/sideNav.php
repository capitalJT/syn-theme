<?php
/**
 * Template Part for Sidebar Post Nav
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0 
 */
global $post;
?>
<ul class="navigator mix-navigator_hasExitBtn">
    <li>
        <a href="<?php echo esc_url( home_url() ) ;?>/blog" title="Back to Overview Page" class="navigator-item-link">
            <span class="icon icon_x">
                <svg class="icon-inner">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-x"></use>
                </svg>
            </span>
        </a>
    </li>
    <?php if(get_adjacent_post(false,'',false)){?>
        <li>
            <a href="<?php echo get_permalink(get_adjacent_post(false,'',false)); ?>" title="Previous Article" class="navigator-item-link">
                <span class="icon icon_lt">
                    <svg class="icon-inner">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-lt"></use>
                    </svg>
                </span>
            </a>
        </li>
    <?php } ?>
    <?php if(get_adjacent_post(false,'',true)){ ?>
        <li>
            <a href="<?php echo get_permalink(get_adjacent_post(false,'',true)); ?>" title="Next Article" class="navigator-item-link">
                <span class="icon icon_gt">
                    <svg class="icon-inner">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-gt"></use>
                    </svg>
                </span>
            </a>
        </li>
    <?php } ?>

</ul>