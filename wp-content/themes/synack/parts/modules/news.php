<?php
/**
 * Template Part for News
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 */

$args = array(
    'post_type'      => array( 'synack-press', 'synack-projects' ),
    'post_status'    => 'publish',
    'posts_per_page' => 4,
    'tax_query'      => array(
        array(
            'taxonomy' => 'featured-news',
            'field'    => 'id',
            'terms'    => get_sub_field( 'news_category' ),
        ),
    ),
);

$query = new WP_Query( $args );
if($query->have_posts()) { ?>
    <!-- Recent News -->
    <div class="moduleSupplement moduleSupplement_secondary">
        <h3 class="u-isVisuallyHidden">Recent News</h3>
        <div class="moduleSupplement-inner">
            <div class="moduleSupplement-inner-bd">
                <ol class="blocksScroll mix-blocksScroll_define">
                    <?php while($query->have_posts()){
                        $query->the_post();
                        $meta = new SYNMeta(get_the_ID());
                        $url = ($meta->getMeta('url_to_press_release'))
                            ? $meta->getMeta('url_to_press_release')
                            : get_the_permalink();
                        ?>
                        <li class="blocksScroll-item">
                            <a href="<?php echo $url;?>" class="cardContinue"
                                <?php if ($meta->getMeta('url_to_press_release')) {
                                    echo 'target="_blank"';
                                } ?>>

                                <?php if($meta->getMeta('featured_thumbnail')){
                                    $imgData =  SYNImages::getImageData($meta->getMeta('featured_thumbnail')); ?>
                                    <div class="cardContinue-bg"
                                         style="background-image: url('<?php echo $imgData['urls']['rectangleThumb'];?>');">
                                    </div>
                                <?php } ?>

                                <div class="cardContinue-main">
                                    <div class="cardContinue-main-bd">
                                        <div class="cardContinue-main-bd-detail">
                                            <?php echo get_the_time('M j, Y'); ?>
                                        </div>
                                        <div class="cardContinue-main-bd-content">
                                            <?php the_title();?>
                                        </div>
                                    </div>
                                    <div class="cardContinue-main-cta">Read Article</div>
                                </div>
                            </a>
                        </li>
                    <?php }
                    wp_reset_postdata(); ?>
                </ol>
            </div>
        </div>
    </div>
<?php }
