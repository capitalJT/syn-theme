<?php
/**
 * Template Part for footer
 *
 * @package WordPress
 * @subpackage Synack
 * @author John Robson
 * @since 2.0
 */
?>

<footer class="syn-footer" aria-label="Company and Website Information">

    <!-- newsletter signup -->
    <div class="newsletter-wrap">
        <form class="newsletter-opt-in" onsubmit="submitMarketo(); return false;">
            <div class="dots-background"></div>

            <div class="content-wrap contained">
                <div class="description">
                    <?php the_field('newsletter_prompt', 'option'); ?>
                </div>

                <div class="email-wrap">
                    <div class="input-wrap">
                        <input
                            type="email"
                            required
                            class="email"
                            id="email-input"
                            placeholder="Your email address">

                        <button class="submit" id="submit-email" type="submit" aria-label="submit">
                            <img
                                class="submit-arrow"
                                src="/wp-content/themes/synack/next/static/images/form-arrow-right.svg"
                                alt="Arrow point right to submit your email."
                                width="15"
                                height="15">
                        </button>
                    </div>

                    <script src="//app-ab15.marketo.com/js/forms2/js/forms2.min.js"></script>
                    <form id="mktoForm_1786" style="display: none;"></form>
                    <script>
                        // this section is set up according to this page:
                        // http://developers.marketo.com/blog/make-a-marketo-form-submission-in-the-background/

                        // set up new form
                        MktoForms2.loadForm("//app-ab15.marketo.com", "738-OEX-476", 1786);

                        // prevent page reloading on submission
                        <?php // https://nation.marketo.com/thread/29126 ?>
                        MktoForms2.whenReady(function(form){
                            form.onSuccess(function(vals,thanksURL){
                                return false;
                            });
                        });

                        function submitMarketo(evt){
                            // get form
                            var myForm = MktoForms2.allForms()[0];
                            myForm.addHiddenFields({
                            	//These are the values which will be submitted to Marketo
                            	"Email": document.getElementById('email-input').value
                            });
                            myForm.submit();

                            var input = document.querySelector('.newsletter-wrap .email-wrap input.email');
                            input.classList.add('submitted');
                            input.value = 'Thanks, we\'ve got you on the list!';
                            input.blur();

                            return false;
                        }
                    </script>
                </div>
            </div>
        </form>
    </div>

    <!-- site menu -->
    <nav class="nav-footer-menu contained">
        <?php
            $locations = get_nav_menu_locations();
            if (!empty($locations) && isset($locations['footer'])) {
                wp_nav_menu(
                    array(
                        'container' => '',
                        'container_class' => '',
                        'theme_location' => 'footer',
                        'menu_class' => 'footer-menu',
                        'items_wrap' => '<ul class="%2$s">%3$s</ul>'
                    )
                );
            }
        ?>
    </nav>

    <!-- bottom wrap -->
    <div class="bottom-wrap contained">

        <!-- contact -->
        <div class="contact-wrap">
            <div class="description">
                <?php the_field('footer_contact', 'option'); ?>
            </div>

            <a href="/contact" class="contact-us clip-button blue">
                <span class="background"></span>
                <span class="text">Contact Us</span>
            </a>
        </div>

        <!-- locations -->
        <div class="location-wrap">
            <?php foreach(get_field('office_locations', 'options') as $office) : ?>
                <div class="office">
                    <span class="initials"><?php echo $office['name']; ?></span>
                    <span class="lat location"><?php echo $office['latitude']; ?></span>
                    <span class="long location"><?php echo $office['longitude']; ?></span>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

    <div class="terms-divider"></div>

    <!-- Terms and socials -->
    <div class="terms-menu contained">

        <!-- Terms menu -->
        <nav class="nav-legal-menu">

            <!-- Logo -->
            <div class="footer-logo">
                <svg class="logo-badge" width="31px" height="26px" viewBox="0 0 31 26" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g transform="translate(-150.000000, -80.000000)" fill="#106BFF" fill-rule="nonzero">
                        <path d="M165.49408,81.6808251 L168.345349,86.5934843 L162.64297,86.5934843 L165.49408,81.6808251 Z M157.517759,84.3922912 C162.607611,86.9072194 164.047199,92.9968979 164.416015,97.1488008 L153.370243,90.6701476 L152.128541,86.7384429 L160.318446,91.543369 C159.377537,89.2828675 158.013266,87.7059899 156.248626,86.8460182 L156.201691,86.8231466 L151.239323,83.923818 L150,80 L157.517759,84.3922912 Z M154.194133,93.2779818 L165.494239,99.8981234 L176.794186,93.2779818 L175.552167,97.2096865 L168.23277,101.502447 L170.060835,102.573468 L170.063848,105.78874 L165.494239,103.108663 L160.924471,105.78874 L160.927484,102.573468 L162.75555,101.502447 L155.436152,97.2096865 L154.194133,93.2779818 Z M174.739376,86.8460182 C172.975053,87.7059899 171.610624,89.2828675 170.669873,91.543369 L178.859937,86.7384429 L177.617759,90.6701476 L166.572304,97.1488008 C166.940803,92.9968979 168.380391,86.9072194 173.470719,84.3922912 L180.988002,80 L179.748679,83.923818 L174.786469,86.8231466 L174.739376,86.8460182 Z"></path>
                    </g>
                </svg>
            </div>

            <!-- Copyright -->
            <div class="copyright">
                &copy; <?php echo date('Y');?> by Synack.com
            </div>

            <!-- Legal menu -->
            <?php
                if (!empty($locations) && isset($locations['footer-utility'])) {
                    wp_nav_menu(
                        array(
                            'container' => '',
                            'container_class' => '',
                            'theme_location' => 'footer-utility',
                            'menu_class' => 'legal-menu',
                            'items_wrap' => '<ul class="%2$s">%3$s</ul>'
                        )
                    );
                }
            ?>


        </nav>

        <!-- Socials menu -->
        <nav class="nav-social-menu">
            <span>Follow Us</span>
            <?php
                if (!empty($locations) && isset($locations['social'])) {
                    wp_nav_menu(
                        array(
                            'container' => '',
                            'container_class' => '',
                            'theme_location' => 'social',
                            'menu_class' => 'social-menu-item',
                            'items_wrap' => '<ul class="%2$s">%3$s</ul>',
                        )
                    );
                }
            ?>
        </nav>

    </div>

</footer>

<?php get_template_part('template-parts/footer/footer-script'); ?>
