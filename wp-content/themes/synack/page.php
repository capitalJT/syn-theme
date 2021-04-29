<?php
/**
 * Default Page Template
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
            while (have_posts()) { the_post(); ?>
                 <div class="secondaryLayout" itemscope itemtype="http://schema.org/Article">

                    <div class="secondaryLayout-hd">
                        <div class="heading">
                            <h1 class="heading-bd">
                                <?php the_title();?>
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

<?php get_footer();
