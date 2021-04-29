<?php
/**
 * Template Part to parse Flexble Content
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 */
// check if the flexible content field has rows of data
if( have_rows('flexible_content') ){

     // loop through the rows of data
    while ( have_rows('flexible_content') ) { the_row();

        if( get_row_layout() == 'hero_module' ){

            get_template_part('parts/modules/heroModule');

        } ?>
        <div class="wrapper">
            <?php if( get_row_layout() == 'timeline' ){

                 get_template_part('parts/modules/timeline');

            }elseif( get_row_layout() == 'standard_content_section' ){

                get_template_part('parts/modules/standard');

            }elseif( get_row_layout() == 'wide_content_section' ){

                get_template_part('parts/modules/wideContent');

            }elseif( get_row_layout() == 'quote' ){

                get_template_part('parts/modules/quote');

            }elseif( get_row_layout() == 'hero_carousel' ){

                get_template_part('parts/modules/heroCarousel');

            }elseif( get_row_layout() == 'events' ){

                get_template_part('parts/modules/events');

            }elseif( get_row_layout() == 'news' ){

                get_template_part('parts/modules/news');

            }elseif( get_row_layout() == 'team_module' ){

                get_template_part('parts/modules/team');

            }elseif( get_row_layout() == 'stacked_image_gallery' ){

                get_template_part('parts/modules/stackedImage');
            } ?>
        </div>
    <?php }//endwhile

}
