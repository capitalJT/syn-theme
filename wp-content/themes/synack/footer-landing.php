<?php
    // LP Synack Red Team Options - ACF Field Group
    $synack_red_logo_options = get_field('synack_red_logo_options');

    if ( $synack_red_logo_options ){
        $lp_footer_logo = '/wp-content/themes/synack/assets/media/images/lp/Synack-SRT-logomark.png';
    } else {
        $lp_footer_logo = '/wp-content/themes/synack/assets/media/images/lp/synack-logo.svg';
    }
?>

        <div class="lp-footer">
            <div class="container">
                <div class="container_inner text-center">
                    <img  class="lp-footer-logo" src="<?= $lp_footer_logo; ?>" alt="Synack footer logo">
                    <span>Copyright &copy; <?php echo date("Y"); ?> Synack.com</span>
                    <ul>
                        <li><a href="/privacy-policy/">Privacy</a></li>
                        <li><a href="/terms-of-use/">Terms</a></li>
                        <li><a href="/patent/">Patent Info</a></li>
                        <li><a href="/disclosure-policy/">Disclosure Policy</a></li>
                        <li><a href="/security/">Security</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <?php wp_footer(); ?>

        <?php // get_template_part('parts/shared/analytics' ); ?>
        <?php // get_template_part('parts/shared/gclid' ); ?>

    </body>
</html>