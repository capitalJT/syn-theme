<?php
/**
 * Template Part for Resources Loop
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerderylabs.com>
 * @since 1.0
 */

$meta       = new SYNMeta( get_the_ID() );
$termsNames = array();
$termsIDs   = array();

if ( wp_get_post_terms( get_the_ID(), 'resource-type', array( 'fields' => 'names' ) ) ) {
    $termsNames = wp_get_post_terms( get_the_ID(), 'resource-type', array( 'fields' => 'names' ) );
}

if ( wp_get_post_terms( get_the_ID(), 'resource-type', array( 'fields' => 'ids' ) ) ) {
    $termsIDs = wp_get_post_terms( get_the_ID(), 'resource-type', array( 'fields' => 'ids' ) );
}

$termsIDs   = implode( ' ', $termsIDs );
$termsNames = implode( ' ', $termsNames );
?>

<li>
    <div class="box box_thin">
        <div class="card js-cardCollectionView-card" data-category="<?php echo $termsIDs; ?>">

            <?php if($meta->getMeta('featured_thumbnail')){?>
                <?php $imgData =  SYNImages::getImageData($meta->getMeta('featured_thumbnail')); ?>
                <img src="<?php echo $imgData['urls']['postThumbnail'];?>" alt="<?php echo $imgData['alt'];?>" class="card-figure js-cardCollectionView-card-thumbnail" />
            <?php } ?>

            <div class="card-hd">
                <div class="js-cardCollectionView-card-resourceType"><?php echo $termsNames ?></div>
            </div>

            <div class="card-bd">
                <div class="js-cardCollectionView-card-title"><?php the_title();?></div>
            </div>

            <?php if($meta->getMeta('short_description')){?>
                <div class="card-mid">
                    <div class="js-cardCollectionView-card-desc"><?php echo $meta->getMeta('short_description'); ?></div>
                </div>
            <?php } ?>

            <div class="card-ft">
                <?php if($meta->getMeta('call_to_action_url') && $meta->getMeta('call_to_action_label')){?>
                    <a href="<?php echo $meta->getMeta('call_to_action_url');?>" class="link mix-link_uppercase js-cardCollectionView-card-url" target="_blank">
                        <?php echo $meta->getMeta('call_to_action_label') ?>
                    </a>
                <?php } ?>
            </div>

        </div>
    </div>
</li>
