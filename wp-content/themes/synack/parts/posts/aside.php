<?php 
/**
 * Template Part for post aside
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0 
 * 
 */


global $post;
$categories = wp_get_post_categories( $post->ID );
?>

<div class="articleInfo-primary">
    <?php echo get_avatar(get_the_author_meta('email', $post->post_author));?>
    <div class="articleInfo-primary-hdg">Author</div>
    <div class="articleInfo-primary-bd"><?php echo get_the_author_meta('display_name', $post->post_author);?></div>
    <a href="<?php echo get_author_posts_url($post->post_author); ?>" class="articleInfo-primary-link">All Articles</a>
</div>

<div class="articleInfo-secondary">
    <div class="articleInfo-secondary-cta">
        <a class="btn btn_primary mix-btn_icon" href="<?php echo bloginfo('atom_url'); ?>">Get RSS Feed
            <span class="btn-icon">
                <span class="icon icon_logoRSS">
                    <svg class="icon-inner">
                        <use xlink:href="#icon-logoRSS"></use>
                    </svg>
                </span>
            </span>
        </a>
    </div>
    <div class="articleInfo-secondary-hdg">
        Categories
    </div>
    <ul class="articleInfo-secondary-bd">
        <?php foreach($categories as $c) {
            $cat = get_category( $c );?>
        <li>
            <a href="<?php echo get_category_link($cat->term_id);?>">
                <?php echo $cat->name;?>
            </a>
        </li>
        <?php } ?>
    </ul>
</div>

