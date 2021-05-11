<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

        <?php wp_head(); ?>

	    <?php get_template_part('template-parts/synack-favicon'); ?>
        
        <link rel="apple-touch-icon" type="image/png" href="<?php echo get_stylesheet_directory_uri();?>/assets/media/images/favicon.png?" />
        <title><?php wp_title(); ?></title>

        <!-- fonts -->
        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/next/static/fonts/fonts.css">

        <link rel="stylesheet" href="/wp-content/themes/synack/assets/styles/main.css?ver=<?php echo SYNACK_CACHE_BUST_VER; ?>">
    </head>

    <?php
        $body_class = 'legacy-site ';
        $body_class .= wp_is_mobile() ? 'is-mobile' : 'not-mobile';
    ?>

    <body <?php body_class($body_class); ?> itemscope itemtype="http://schema.org/WebPage">
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W82WNBG"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->

        <?php
            // LP Synack Red Team Options - ACF Field Group
            $synack_red_logo_options = get_field('synack_red_logo_options');

            if ( $synack_red_logo_options ){
                $lp_header_logo = '/wp-content/themes/synack/assets/media/images/lp/Synack-SRT-logo-horizontal.svg';
            } else {
                $lp_header_logo = '/wp-content/themes/synack/assets/media/images/lp/Synack_E_Horizontal_Lockup.svg';
            }
        ?>

        <?php get_template_part('parts/shared/headerModules'); ?>