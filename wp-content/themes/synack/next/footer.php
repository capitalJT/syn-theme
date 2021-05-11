<?php
    /**
     * 2019 footer file
     *
     * @package WordPress
     * @subpackage Synack
     * @author John Robson <j@hn.digital>
     * @since 2.0
     */
    get_template_part('parts/shared/footer');
?>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/next/static/bundle.js?v<?php echo SYNACK_CACHE_BUST_VER; ?>" type="text/javascript"/></script>

<?php wp_footer(); ?>

</body>
</html>
