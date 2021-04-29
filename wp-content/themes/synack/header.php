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

	    <?php get_template_part('parts/shared/google-tags' ); ?>

        <!-- META DATA -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="google-site-verification" content="ZpS_z2LqM0lu41hEK4cmTW4TtGBzeF9z8Et_sdkDVoY" />
        <!--[if IE]><meta http-equiv="cleartype" content="on" /><![endif]-->
        <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge" /><![endif]-->

        <!-- NEXT fonts -->
        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/next/static/fonts/fonts.css">

        <link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri();?>/next/static/images/favicon.png?">
        <link rel="apple-touch-icon" type="image/png" href="<?php echo get_stylesheet_directory_uri();?>/assets/media/images/favicon.png?" />

        <!-- <title> --> <?php //SYNGetPageTitleTag(); ?> <!-- </title> -->
        <?php //SYNGetMetaDescription(); ?>

        <title><?php wp_title(); ?></title>
        <?php get_template_part('parts/shared/munchkin'); ?>
        <?php wp_head() ?>

        <!-- shared styles -->
        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/next/static/shared.css?v1.02">

        <!-- OG tags -->
        <?php //get_template_part('parts/shared/og-tags'); ?>

        <!-- Third Party -->
        <?php get_template_part('parts/shared/third-party'); ?>
    </head>
    <?php
    /*
        <body <?php if(SYNIsRedTeamPage() or SYNIsRedTeamBlank() or SYNIsRedTeamVeterans() or SYNIsRedTeamPhotos2018()) echo 'class="theme-red"';?>>
    */

    $body_class = 'legacy-site ';
    $body_class .= wp_is_mobile() ? 'is-mobile' : 'not-mobile';
    ?>
    <body <?php body_class($body_class); ?>>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W82WNBG"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

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
    } ?>
        <div class="site <?php echo $particleClass;?>" id="js-mainNavigation" data-particle-color="rgb(175, 175, 175)">
            <div class="site-hd js-navScroll-siteHd" role="banner">
                <a href="#main" class="u-isVisuallyHidden js-mainNavigation-disabled">Skip to Content</a>
                <?php get_template_part('parts/shared/header'); ?>
            </div>
            <div class="site-bd js-mainNavigation-disabled" role="main" id="main">
