<?php
    /**
     * Template Name: Modules Template
     *
     * @package WordPress
     * @subpackage Synack
     * @author Jabal Torres <info@jabaltorres.com>
     * @since 1.0
     *
     */

    add_filter( 'body_class', 'modules_body_class');
    function modules_body_class( $classes ) {
        if ( is_page() ){
            $classes[] = 'synack-modules-template';
            return $classes;
        }
    }

    get_header('modules');
?>


</div><?php  // End header-hero-wrapper (header-modules.php) ?>

<?php get_template_part('template-parts/modules'); ?>


<?php get_footer('modules'); ?>