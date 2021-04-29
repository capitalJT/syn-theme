<?php
/**
 * Template Part for Projects Loop
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerderylabs.com>
 * @since 1.0
 */

$meta = new SYNMeta( get_the_ID() );
?>

<li>
    <div class="box box_thin">
        <div class="card js-cardCollectionView-card" data-category="">

            <?php if($meta->getMeta('featured_thumbnail')){?>
                <?php $imgData =  SYNImages::getImageData($meta->getMeta('featured_thumbnail')); ?>
                <img src="<?php echo $imgData['urls']['postThumbnail'];?>" alt="<?php echo $imgData['alt'];?>" class="card-figure" />
            <?php } ?>

            <div class="card-hd">
                 <div><?php the_time('M j, Y');?></div>
            </div>

            <div class="card-bd">
                <div><?php the_title();?></div>
            </div>

            <?php if($meta->getMeta('short_description')){?>
                <div class="card-mid">
                    <div class="js-cardCollectionView-card-desc"><?php echo $meta->getMeta('short_description'); ?></div>
                </div>
            <?php } ?>

            <div class="card-ft">
                 <a href="<?php the_permalink();?>" class="link mix-link_uppercase">View Project</a>
            </div>

        </div>
    </div>
</li>
