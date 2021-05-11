<?php
/**
 * Default header file
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 */
global $post;
?>
<!doctype html>
<html class="no-js" lang="en-us">
    <head>
        <!-- META DATA -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!--[if IE]><meta http-equiv="cleartype" content="on" /><![endif]-->
        <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge" /><![endif]-->

        <!-- ICONS -->
        <?php get_template_part('template-parts/synack-favicon'); ?>
<!--        <link rel="icon" type="image/png" href="--><?php //echo get_stylesheet_directory_uri();?><!--/next/static/images/favicon.png?">-->
        <link rel="apple-touch-icon" type="image/png" href="<?php echo get_stylesheet_directory_uri();?>/assets/media/images/favicon.png?" />

        <title><?php wp_title(); ?></title>

        <?php wp_head(); ?>

    </head>
    <?php
    /*
        <body <?php if(SYNIsRedTeamPage() or SYNIsRedTeamBlank() or SYNIsRedTeamVeterans() or SYNIsRedTeamPhotos2018()) echo 'class="theme-red"';?>>
    */

    $body_class = 'legacy-site ';
    $body_class .= wp_is_mobile() ? 'is-mobile' : 'not-mobile';
    ?>
    <body <?php body_class($body_class); ?>>

    <?php get_template_part('parts/shared/gtm-noscript'); ?>

    <?php get_template_part('parts/shared/icons'); ?>
    <?php
        // needed to reset The Loop (not sure why - is it being set incorrectly elsewhere?)
        rewind_posts();
    ?>
    <?php
        $particleClass = '';
        $particles = get_option('options_display_particles');
        if($particles[0] === 'true') {
            $particleClass = 'js-particleBg';
        }
    ?>
        <div class="site <?php echo $particleClass;?>" id="js-mainNavigation" data-particle-color="rgb(175, 175, 175)">
            <div class="site-hd js-navScroll-siteHd" role="banner">
                <a href="#main" class="u-isVisuallyHidden js-mainNavigation-disabled">Skip to Content</a>
                <?php get_template_part('parts/shared/header'); ?>
            </div>
            <div class="site-bd js-mainNavigation-disabled" role="main" id="main">
