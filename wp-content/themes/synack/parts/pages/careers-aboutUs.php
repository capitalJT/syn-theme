<?php 
/**
 * Template Part for About Us
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 */
if(get_option('options_about_us_recruiting' )) {
    $content = get_option('options_about_us_recruiting' );
    $content = apply_filters('the_content', $content ); ?>
    
    <div class="heading">
        <h2 class="heading-bd">
            About Synack
        </h2>
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

    <div class="wysiwyg">
        <?php echo $content; ?>
    </div>
<?php }