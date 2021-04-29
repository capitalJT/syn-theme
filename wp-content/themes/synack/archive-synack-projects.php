<?php
/**
 * R&D Project Archive Template
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 *
 */
get_header(); ?>
    <div class="js-cardCollectionView">

        <div class="vR vR_x9">
            <div class="wrapper mix-wrapper_contain">
                <div class="grid">
                    <div class="grid-col grid-col_8of10 mix-grid-col_prefix1of10 mix-grid-col_suffix1of10">
                        <?php get_template_part('parts/shared/heading');

                        if(have_posts()){
                            $count = 0;?>
                                <ol class="blocks mix-blocks_tight mix-blocks_1to3to3 js-cardCollectionView-results">
                                    <?php while (have_posts()) { the_post();
                                       /**
                                        * A helper function that 'injects' the social posts into the main loop
                                        * based on the current loop count. See /lib/Theme/Helpers.php for function details
                                        */
                                        $count++;
                                        SYNGetStickySocialPosts($count, true);  //@param true = forcing projects only
                                        get_template_part('parts/pages/projects', 'loop');

                                    } ?>
                                </ol>
                             <?php } //endif ?>

                    </div><!-- /.grid-col -->
                </div><!--/.grid -->
            </div><!-- /.wrapper -->
        </div>

        <?php if( SYNGetTotalPosts('synack-projects') > $count) {  //minus three because of the offset ?>
            <button type="button" data-action="loadMorePosts" data-post-type="synack-projects" data-post-type-nicename="Projects" class="loadBtn js-cardCollectionView-loadMoreBtn">Load More Projects</button>
        <?php } ?>

    </div><!-- /.js-cardCollectionView -->

<?php get_footer();
