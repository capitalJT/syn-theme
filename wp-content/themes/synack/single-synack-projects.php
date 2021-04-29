<?php
/**
 * Single Projects Template
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 *
 */
get_header(); ?>

    <div class="wrapper mix-wrapper_contain">

        <?php if(have_posts()){
            while(have_posts()){ the_post(); ?>
                <div class="secondaryLayout" itemscope itemtype="http://schema.org/Article">
                    <div class="secondaryLayout-hd">
                        <?php get_template_part('parts/shared/headingAdvanced' ); ?>
                    </div>
                    <div class="secondaryLayout-bd">

                        <div class="secondaryLayout-bd-primary">
                            <div class="wysiwyg wysiwyg_article" itemprop="articleBody">

                                <?php the_content(); ?>
                            </div>

                        </div>

                        <div class="secondaryLayout-bd-secondary">
                            <div class="articleInfo">
                                <?php get_template_part('parts/pages/projects', 'aside');?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
        } ?>

    </div><!-- /.wrapper -->

<?php get_footer();
