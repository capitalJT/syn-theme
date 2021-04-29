<?php
/**
 * Default Author Template
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 *
 */
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));

get_header(); ?>

    <div class="js-cardCollectionView">

        <div class="wrapper mix-wrapper_contain">
            <div class="grid">
                <div class="grid-col grid-col_8of10 mix-grid-col_prefix1of10 mix-grid-col_suffix1of10">

                    <div class="heading heading_pushed">
                        <h2 class="heading-bd">Posts by <?php echo $curauth->display_name;?></h2>
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
                    <?php if(have_posts()){?>
                        <ol class="blocks mix-blocks_1to3to4 js-cardCollectionView-results">
                            <?php while (have_posts()) { the_post();

                                get_template_part('parts/posts/loop' );

                            } ?>
                        </ol>

                    <?php }else{
                        echo 'Sorry, no search results';
                    } //endif ?>

                </div><!-- /.grid-col -->
            </div><!--/.grid -->
        </div><!-- /.wrapper -->

        <button type="button" data-action="loadPostByAuthor" data-post-type="post" data-post-author="<?php echo $curauth->ID; ?>" class="loadBtn js-cardCollectionView-loadMoreBtn">Load More Results</button>

    </div><!-- /.js-cardCollectionView -->

<?php get_footer();
