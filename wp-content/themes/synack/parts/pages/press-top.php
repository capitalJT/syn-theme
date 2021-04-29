<?php
/**
 * Template Part for Press Room top portion
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
    'posts_per_page'         => 3,
);

$query = new WP_Query( $args );
if($query->have_posts()){ ?>
        <div class="sides sides_main" >
            <div class="vR vR_x5">
                <ol class="vList mix-vList_defineSpace js-pressView-featuredPanelList">
                    <?php while($query->have_posts()){
                        $query->the_post();
                        $meta = new SYNMeta(get_the_ID());
                        $termsIDs   = array();

                        if ( wp_get_post_terms( get_the_ID(), 'release-type', array( 'fields' => 'ids' ) ) ) {
                            $termsIDs = wp_get_post_terms( get_the_ID(), 'release-type', array( 'fields' => 'ids' ) );
                        }

                        $url = ($meta->getMeta('url_to_press_release'))
                            ? $meta->getMeta('url_to_press_release')
                            : get_the_permalink();

                        $termsIDs   = implode( ' ', $termsIDs ); ?>
                        <li class="js-pressView-originalItem" data-category-id="<?php echo $termsIDs;?>">
                            <a href="<?php echo $url;?>" class="feature"
                                <?php if ($meta->getMeta('url_to_press_release')) {
                                    echo 'target="_blank"';
                                } ?> >
                                <?php if($meta->getMeta('featured_thumbnail')){?>
                                    <div class="feature-media">
                                        <?php $imgData =  SYNImages::getImageData($meta->getMeta('featured_thumbnail')); ?>
                                        <img src="<?php echo $imgData['urls']['pressSquareThumbnail'];?>" alt="<?php echo $imgData['alt'];?>">
                                    </div>
                                <?php } ?>

                                <div class="feature-bd">
                                    <div class="feature-bd-detail">
                                        <?php the_time('M j, Y'); ?>
                                    </div>
                                    <div class="feature-bd-hd">
                                        <?php the_title();?>
                                    </div>
                                    <?php if($meta->getMeta('short_description')){?>
                                        <div class="feature-bd-content">
                                            <?php echo $meta->getMeta('short_description'); ?>
                                        </div>
                                    <?php } ?>
                                    <div class="feature-bd-cta">
                                        Read Article
                                    </div>
                                </div>
                            </a>
                        </li>
                    <?php } wp_reset_postdata();?>
                </ol>
            </div>
        </div>

<?php }
