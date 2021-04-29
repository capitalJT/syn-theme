<?php
/**
 * Default Index file
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 *
 */
get_header(); ?>
     <div class="js-cardCollectionView">
        <div class="wrapper">
            <div class="grid">
                <div class="grid-col grid-col_8of10 mix-grid-col_prefix1of10 mix-grid-col_suffix1of10">

                    <?php get_template_part('parts/shared/heading');

                    if(have_posts()){
                        $count = 0;
                        get_template_part('parts/posts/filters'); ?>

                            <ol class="blocks mix-blocks_tight mix-blocks_1to3to4 js-cardCollectionView-results">
                                <?php while (have_posts()) { the_post();

                                   /**
                                    * A helper function that 'injects' the social posts into the main loop
                                    * based on the current loop count. See /lib/Theme/Helpers.php for function details
                                    */
                                    $count++;
                                    SYNGetStickySocialPosts($count);
                                    get_template_part('parts/posts/loop' );

                                } ?>
                            </ol>
                            <div class="js-cardCollectionView-noResults u-isHidden">
                                <div class="box">
                                    No results in this category. Try a different category.
                                </div>
                            </div>
                    <?php } //endif ?>

                </div><!-- /.grid-col -->
            </div><!--/.grid -->
        </div>
        <button type="button" data-action="loadMorePosts" data-post-type="post" class="loadBtn js-cardCollectionView-loadMoreBtn">Load More Posts</button>
    </div><!-- /.js-cardCollectionView -->

<?php get_footer();
