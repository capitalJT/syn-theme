<?php
/**
 * Default footer file
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 */
    ?>
            </div>
            <div class="site-ft js-mainNavigation-disabled" role="contentinfo">
                <div class="wrapper">
                    <?php get_template_part('parts/shared/footer' ); ?>
                    <script>
                      window.addEventListener('load',function(){
                        jQuery('.nav-main .navUtility-item a[href="https://www.synack.com/contact/"]').click(function(){
                          ga('send', 'event','button','click','contact us');
                        });
                        jQuery('.moduleGlobe-bd a.btn_primary[href="https://www.synack.com/solution"]').click(function(){
                          ga('send', 'event','button','click','How it Works');
                        });
                      })
                    </script>
                </div>
            </div>
        </div> <!-- // end site -->

        <?php wp_footer(); ?>

        <?php // get_template_part('parts/shared/analytics' ); ?>
        <?php // get_template_part('parts/shared/gclid' ); ?>
    </body>
</html>
