<?php
/**
 * Template Part for latest blog post
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 *
 */
$nextPost = get_previous_post();

if( ! empty($nextPost->ID) ) { ?>

        <div class="preFooter preFooter_particles mix-preFooter_bg">
            <div class="preFooter-inner mix-preFooter-inner_full">
                <a class="preFooter-inner-section mix-preFooter-inner-section_space" href="<?php echo get_the_permalink($nextPost->ID); ?>">
                    <h3 class="preFooter-inner-section-subHd">
                       Last Article
                    </h3>
                    <h3 class="preFooter-inner-section-hd">
                        <?php echo get_the_title($nextPost->ID); ?>
                    </h3>
                    <div class="preFooter-inner-section-hr preFooter-inner-section-hr_simple"></div>
                    <div class="preFooter-inner-section-bd mix-preFooter-inner-section-bd_tight">
                        <div class="listH listH_divided mix-listH_dividedLight mix-listH_small">
                            <div>By <?php echo get_the_author_meta('display_name', $nextPost->post_author); ?></div>
                            <div><?php echo get_the_time('M j, Y', $nextPost->ID); ?></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

<?php }
