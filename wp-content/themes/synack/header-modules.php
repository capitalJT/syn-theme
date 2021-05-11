<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <!-- META DATA -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!--[if IE]><meta http-equiv="cleartype" content="on" /><![endif]-->
        <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge" /><![endif]-->

        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	    <?php get_template_part('template-parts/synack-favicon'); ?>

        <!-- fonts -->
        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/next/static/fonts/fonts.css">

        <link rel="stylesheet" href="/wp-content/themes/synack/assets/styles/main.css?ver=<?php echo SYNACK_CACHE_BUST_VER; ?>">

        <link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri();?>/next/static/images/favicon.png?">
        <link rel="apple-touch-icon" type="image/png" href="<?php echo get_stylesheet_directory_uri();?>/assets/media/images/favicon.png?" />

        <title><?php wp_title(); ?></title>

        <?php wp_head(); ?>

    </head>

    <?php
        $body_class = 'legacy-site ';
        $body_class .= wp_is_mobile() ? 'is-mobile' : 'not-mobile';
    ?>

    <body <?php body_class($body_class); ?> itemscope itemtype="http://schema.org/WebPage">

        <?php get_template_part('parts/shared/gtm-noscript'); ?>

        <?php
            // LP Synack Red Team Options - ACF Field Group
            $synack_red_logo_options = get_field('synack_red_logo_options');

            if ( $synack_red_logo_options ){
                $lp_header_logo = '/wp-content/themes/synack/assets/media/images/lp/Synack-SRT-logo-horizontal.svg';
            } else {
                $lp_header_logo = '/wp-content/themes/synack/assets/media/images/lp/Synack_E_Horizontal_Lockup.svg';
            }
        ?>

        <?php get_template_part('parts/shared/header'); ?>