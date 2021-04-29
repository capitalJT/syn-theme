<?php
/**
 * Template Name: Press Room
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 *
 */
get_header(); ?>

    <div class="wrapper mix-wrapper_contain">
        <?php get_template_part('parts/shared/heading');?>
    </div>

    <div class="js-pressView">

        <div class="wrapper mix-wrapper_contain">
            <?php get_template_part('parts/pages/press', 'filters'); ?>
            <?php get_template_part('parts/pages/press', 'top'); ?>
        </div><!-- /.wrapper -->

        <?php get_template_part('parts/pages/press', 'archive'); ?>

    </div>

    <?php get_template_part('parts/press/ankle', 'landing'); ?>

<?php get_footer();
