<?php
/**
 * 2019 header file
 *
 * @package WordPress
 * @subpackage Synack
 * @author John Robson <j@hn.digital>
 * @since 2.0
 */
global $post;

// Change this when forcing a cache clear
$version_number = "1.45";

?>
<!DOCTYPE html>
<html lang="en-us">
    <head>

	    <?php get_template_part('parts/shared/google-tags' ); ?>

        <!-- META DATA -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="google-site-verification" content="ZpS_z2LqM0lu41hEK4cmTW4TtGBzeF9z8Et_sdkDVoY" />
        <!--[if IE]><meta http-equiv="cleartype" content="on" /><![endif]-->
        <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge" /><![endif]-->

        <!-- primary stylesheet -->
        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/next/static/bundle.css?v<?php echo $version_number; ?>">

        <!-- fonts -->
        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/next/static/fonts/fonts.css?v<?php echo $version_number; ?>">

        <!-- ICONS -->
        <!-- <link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri();?>/next/static/images/favicon.png?"> -->
        <?php get_template_part('template-parts/synack-favicon'); ?>

        <link rel="apple-touch-icon" type="image/png" href="<?php echo get_stylesheet_directory_uri();?>/assets/media/images/favicon.png?" />

        <!-- <title> --> <?php //SYNGetPageTitleTag(); ?> <!-- </title> -->
        <?php // SYNGetMetaDescription(); ?>

        <title><?php wp_title(); ?></title>

        <?php get_template_part('parts/shared/munchkin'); ?>

        <?php wp_head(); ?>

        <!-- shared styles -->
        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/next/static/shared.css?v<?php echo $version_number; ?>">

        <!-- mapbox styles styles -->
        <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.css' rel='stylesheet' />

        <!-- OG tags -->
        <?php //get_template_part('parts/shared/og-tags'); ?>

        <!-- Third Party -->
        <?php get_template_part('parts/shared/third-party'); ?>
    </head>

    <?php
        $body_class = 'next-site ';
        if (is_single()){
            $body_class .= 'light-theme ';
        }
        $body_class .= wp_is_mobile() ? 'is-mobile' : 'not-mobile';
    ?>
    <body <?php body_class($body_class); ?>>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W82WNBG"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!-- Open Container -->
    <div class="container">
        <?php get_template_part('parts/shared/header'); ?>
