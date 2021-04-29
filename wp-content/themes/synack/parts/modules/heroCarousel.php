<?php
/**
 * Template Part for hero carousel
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 */


// Get our quote data
$quote = get_sub_field('quote');
$quoteByline = get_sub_field('byline');

if(have_rows('slides')){
    $totalSlides = 0; ?>
    <div class="triangle">
        <div class="triangle-shape triangle-shape_11 mix-triangle-shape_rev"></div>
        <div class="wrapper">
            <div class="vR vR_x7">
                <div class="cycler js-cyclerView" data-cycler-interval="6000">
                    <ol class="cycler-list js-cyclerView-list">
                        <?php while(have_rows('slides')){ the_row();
                            $totalSlides++;?>
                            <li class="cycler-list-item">

                                <?php if(get_sub_field('image_or_video') == 'image'){

                                    if(get_sub_field('image')){
                                        $imgDataSm = SYNImages::getImageData(get_sub_field('image')); ?>
                                        <picture class="cycler-list-item-figure">

                                            <?php if(get_sub_field('image_lg')){
                                                $imgDataLg = SYNImages::getImageData(get_sub_field('image_lg')); ?>
                                                <source srcset="<?php echo $imgDataLg['urls']['heroCarouselSlide'];?>" media="(min-width: 890px)" />
                                            <?php } ?>

                                            <?php if(get_sub_field('image_md')){
                                                $imgDataMd = SYNImages::getImageData(get_sub_field('image_md')); ?>
                                                <source srcset="<?php echo $imgDataMd['urls']['heroCarouselSlideMedium'];?>" media="(min-width: 400px)" />
                                            <?php } ?>

                                            <img srcset="<?php echo $imgDataSm['urls']['heroCarouselSlideSmall'];?>" alt="<?php echo $imgDataSm['alt'];?>" />

                                        </picture>
                                    <?php }elseif(get_sub_field('image_lg')){
                                        $imgDataLg = SYNImages::getImageData(get_sub_field('image_lg'))?>
                                        <img src="<?php echo $imgDataLg['urls']['heroCarouselSlide'];?>" alt="<?php echo $imgDataLg['alt'];?>" class="cycler-list-item-figure" />
                                    <?php }

                                }elseif(get_sub_field('image_or_video') == 'video'){
                                    if(get_sub_field('video')){ ?>
                                        <div class="video mix-video_full">
                                             <?php $video = SYNAddExtraQueryVarsIfYouTube( get_sub_field('video') );
                                             echo $video; ?>
                                        </div>

                                    <?php }
                                }?>

                            </li>
                        <?php } //end while ?>
                    </ol>

                    <?php if($totalSlides > 1){?>

                        <div class="cycler-nav">
                            <ol class="navigator mix-navigator_abs">
                                <li>
                                    <button title="Previous Slide" class="navigator-item-link js-cyclerView-prev">
                                        <span class="icon icon_lt">
                                            <svg class="icon-inner">
                                                <title>Previous Slide</title>
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-lt"></use>
                                            </svg>
                                        </span>
                                    </button>
                                </li>
                                <li>
                                    <button title="Next Slide" class="navigator-item-link js-cyclerView-next">
                                        <span class="icon icon_gt">
                                            <svg class="icon-inner">
                                                <title>Next Slide</title>
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-gt"></use>
                                            </svg>
                                        </span>
                                    </button>
                                </li>
                            </ol>
                        </div>

                        <ol class="cycler-indicator js-cyclerView-indicator">
                            <?php do{
                                echo '<li></li>';
                                $totalSlides--;
                            }while($totalSlides != 0); ?>
                        </ol>

                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
<?php }

if($quote){ ?>
    <div class="vR vR_x4">
        <blockquote class="blockquote mix-blockquote_spaceSm">
            <div class="blockquote-decoration">&ldquo;&rdquo; </div>
            <div class="blockquote-bd">
                <?php echo $quote; ?>
            </div>
            <div class="blockquote-cite"><?php echo $quoteByline;?></div>
        </blockquote>
    </div>
<?php } ?>
