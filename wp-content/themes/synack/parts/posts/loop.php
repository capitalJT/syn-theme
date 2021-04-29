<?php
/**
 * Template Part for blog loop
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 */

global $post;
$meta = new SYNMeta($post->ID);
$cats = array();
if(wp_get_post_categories( get_the_ID(), array('fields' => 'ids'))) {
    $cats = wp_get_post_categories( get_the_ID(), array( 'fields' => 'ids' ) );
}
$cats = implode(' ', $cats);
?>

<li>
    <div class="box box_thin">
        <div class="card js-cardCollectionView-card" data-category="<?php echo $cats; ?>">

            <?php if($meta->getMeta('featured_thumbnail')){?>
                <?php $imgData =  SYNImages::getImageData($meta->getMeta('featured_thumbnail')); ?>
                <img src="<?php echo $imgData['urls']['postThumbnail'];?>" alt="<?php echo $imgData['alt'];?>" class="card-figure js-cardCollectionView-card-thumbnail" />
            <?php } ?>

            <div class="card-hd">
                <div data-datetime="<?php the_time('U');?>" class="js-cardCollectionView-card-datetime"><?php the_time('M j, Y');?></div>

                <div class="js-cardCollectionView-card-author"><?php echo get_the_author_meta('display_name', $post->post_author);?></div>
            </div>

            <div class="card-bd">
                 <div class="js-cardCollectionView-card-title"><?php the_title();?></div>
            </div>

            <?php if( $meta->getMeta( 'short_description' ) ){?>
                <div class="card-mid">
                    <?php echo $meta->getMeta( 'short_description' ); ?>
                </div>
            <?php } ?>

            <div class="card-ft">
                <a href="<?php the_permalink();?>" class="link mix-link_uppercase js-cardCollectionView-card-url">Read Blog</a>
            </div>

        </div>
    </div>
</li>
