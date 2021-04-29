<?php 
/**
 * Template Part for heading
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0 
 */

?>
<div class="heading heading_pushed">
    <h1 class="heading-bd">
        <?php if(is_post_type_archive('synack-projects')){
            echo '<abbr title="Research and Development">R&amp;D</abbr> Projects';
        }elseif(is_post_type_archive('synack-resources')){
            echo 'Resources';
        }elseif(is_home()){
            echo get_the_title(get_option('page_for_posts'));
        }elseif(is_category()){
            echo single_cat_title( '', false );
        }else {
            the_title();
        }?>
    </h1>
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