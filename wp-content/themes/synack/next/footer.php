<?php
/**
 * 2019 footer file
 *
 * @package WordPress
 * @subpackage Synack
 * @author John Robson <j@hn.digital>
 * @since 2.0
 */
    get_template_part('parts/shared/footer' );

    // Change this when forcing a cache clear
    $version_number = "1.38";?>
        </div>

        <!-- Marketo form -->
        <script src="//app-ab15.marketo.com/js/forms2/js/forms2.min.js"></script>
        <script src="<?php echo get_stylesheet_directory_uri();?>/next/static/bundle.js?v<?php echo $version_number; ?>" type="text/javascript" /></script>
        <script type="text/javascript">
            console.log('v<?php echo $version_number; ?>');
        </script>

        <?php wp_footer(); ?>

        <?php // get_template_part('parts/shared/analytics' ); ?>
        <?php // get_template_part('parts/shared/gclid' ); ?>
    </body>
</html>
