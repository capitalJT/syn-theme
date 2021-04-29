<?php
/**
 * Author Query for projects
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 *
 */
$curauth = (esc_html( get_query_var('projectAuthor') ))
    ? get_user_by('id', esc_html( get_query_var('projectAuthor') ))
    : false;

if(!$curauth){
    global $wp_query;
    $wp_query->set_404();
    status_header( 404 );
    get_template_part( '404' ); exit();
}

get_header(); ?>

    <div class="js-cardCollectionView">

        <div class="wrapper mix-wrapper_contain">

            <div class="grid">
                <div class="grid-col grid-col_8of10 mix-grid-col_prefix1of10 mix-grid-col_suffix1of10">

                    <div class="heading heading_pushed">
                        <h2 class="heading-bd"><abbr title="Research and Development">R&amp;D</abbr> Projects by <?php echo $curauth->display_name;?></h2>
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
                    <?php
                    $authorArgs = array(
                        'post_type' => 'synack-projects',
                        'author'      => esc_html( get_query_var('projectAuthor') ),
                        'post_status' => 'publish',
                        'posts_per_page' => -1
                    );
                    $metaAuthorArgs = array(
                        'post_type' => 'synack-projects',
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
                        'meta_query'	=> array(
                            array(
                                'key'	 	=> 'authors',
                                'value'	  	=> esc_html( get_query_var('projectAuthor') ),
                                'compare' 	=> 'LIKE',
                            )
                        )
                    );
                    $authorPosts = get_posts($authorArgs);
                    $metaAuthorPosts = get_posts($metaAuthorArgs);
                    $mergedposts = array_unique(array_merge($authorPosts, $metaAuthorPosts), SORT_REGULAR);

                    if(count($mergedposts) > 0){ ?>
                        <ol class="blocks mix-blocks_1to3to4 js-cardCollectionView-results">
                            <?php foreach($mergedposts as $post) {
                                setup_postdata($post);

                                get_template_part('parts/pages/projects','loop' );

                            } wp_reset_postdata(); ?>
                        </ol>

                    <?php }else{
                        echo 'Sorry, no search results';
                    } //endif ?>

                </div><!-- /.grid-col -->
            </div><!--/.grid -->

        </div><!-- /.wrapper -->

    </div><!-- /.js-cardCollectionView -->

<?php get_footer();
