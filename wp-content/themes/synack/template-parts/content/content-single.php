<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>

<?php
    $post_published_day = get_the_date('d');
    $post_published_month = get_the_date('F');
    $post_published_year = get_the_date('Y');
?>

<div class="contained content-single-content">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <div class="entry-header single-featured-image" style="position: initial;">
            <div class="rsp-image-module responsive-image fit-cover fill-space">
                <div class="image-sizer">
		            <?php the_post_thumbnail(); ?>
                </div>
                <div class="archive-color-overlay" style="--start-color:#FF3655; --end-color:#061023;"></div>
            </div>


            <div class="content-wrap">
                <span class="date-number"><?= $post_published_day; ?></span>
                <span class="month-year-wrap">
                    <span class="date-month"><?= $post_published_month; ?></span>
                    <span class="line"></span>
                    <span class="date-year"><?= $post_published_year; ?></span>
                </span>
	            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                <div class="author"><?= get_the_author_meta( 'display_name', $author_id ); ?></div>
            </div>
        </div><!-- .entry-header -->

        <div class="entry-content">
			<?php the_content(); ?>
        </div><!-- .entry-content -->

    </article><!-- #post-<?php the_ID(); ?> -->
</div>

