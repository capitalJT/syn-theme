<?php
/**
 * Single Press Release Template
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 *
 */
global $post;
$meta = new SYNMeta($post->ID);
if ($meta->getMeta('url_to_press_release') ) {
    wp_redirect($meta->getMeta( 'url_to_press_release' ) );
    exit;
}

get_header(); ?>

    <div class="wrapper mix-wrapper_contain">
        <?php
            // needed to reset The Loop (not sure why - is it being set incorrectly elsewhere?)
            rewind_posts();
        ?>
        <?php if(have_posts()){
            while(have_posts()){ the_post(); ?>

                <div class="secondaryLayout" itemscope itemtype="http://schema.org/Article">
                    <div class="secondaryLayout-hd">
                        <?php get_template_part('parts/shared/headingAdvanced' ); ?>
                    </div>
                    <div class="secondaryLayout-bd secondaryLayout-bd_single">
                        <div class="secondaryLayout-bd-primary">
                            <div class="wysiwyg wysiwyg_article" itemprop="articleBody">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php }
        } ?>

    </div><!-- /.wrapper -->

    <?php get_template_part('parts/press/ankle');

get_footer();
