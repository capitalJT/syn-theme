<?php
/**
 * Template Part for Press Room lower archive section
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 */

/**
 * The WordPress Query class.
 * @link http://codex.wordpress.org/Function_Reference/WP_Query
 *
 */
$args = array(
    'post_type'   => 'synack-press',
    'post_status' => 'publish',
    'order'               => 'DESC',
    'orderby'             => 'date',
    'posts_per_page' => get_option('options_press_limit'),
    'offset' => 3
);

$query = new WP_Query( $args );
$totalQuery = 0;
if($query->have_posts()){ ?>
    <div class="js-loadMoreView">

        <div class="vR vR_x3">
            <div class="moduleSupplement moduleSupplement_secondary">
                <h3 class="u-isVisuallyHidden">Recent News</h3>
                <div class="moduleSupplement-inner">
                    <div class="moduleSupplement-inner-bd">
                        <ol class="blocksScroll mix-blocksScroll_define js-loadMoreView-results js-pressView-panelList">
                            <?php while($query->have_posts()){
                                $totalQuery++;
                                $query->the_post();
                                $meta = new SYNMeta(get_the_ID()); $termsIDs   = array();

                                if ( wp_get_post_terms( get_the_ID(), 'release-type', array( 'fields' => 'ids' ) ) ) {
                                    $termsIDs = wp_get_post_terms( get_the_ID(), 'release-type', array( 'fields' => 'ids' ) );
                                }

                                $url = ($meta->getMeta('url_to_press_release'))
                                    ? $meta->getMeta('url_to_press_release')
                                    : get_the_permalink();


                                $termsIDs   = implode( ' ', $termsIDs );?>
                                <li class="blocksScroll-item" data-category-id="<?php echo $termsIDs;?>">
                                    <a href="<?php echo $url;?>" class="cardContinue"
                                        <?php if ($meta->getMeta('url_to_press_release')) {
                                            echo 'target="_blank"';
                                        } ?> >
                                        <?php if($meta->getMeta('featured_thumbnail')){
                                            $imgData =  SYNImages::getImageData($meta->getMeta('featured_thumbnail')); ?>
                                            <div class="cardContinue-bg" style="background-image: url('<?php echo $imgData['urls']['rectangleThumb'];?>');"></div>
                                        <?php } ?>

                                        <div class="cardContinue-main">
                                            <div class="cardContinue-main-bd">
                                                <div class="cardContinue-main-bd-detail">
                                                    <?php the_time('M j, Y'); ?>
                                                </div>
                                                <div class="cardContinue-main-bd-content">
                                                    <?php the_title();?>
                                                </div>
                                            </div>
                                            <div class="cardContinue-main-cta">Read Article</div>
                                        </div>
                                    </a>
                                </li>

                            <?php } wp_reset_postdata(); ?>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <?php if( (SYNGetTotalPosts('synack-press') - 3) > $totalQuery) {  //minus three because of the offset ?>
            <button type="button" data-action="loadMorePosts" data-post-type="synack-press" data-post-type-nicename="Press Releases" class="loadBtn loadBtn_bright js-loadMoreView-loadMoreBtn">Load More Press Releases</button>
        <?php } ?>
    </div>
<?php } ?>
