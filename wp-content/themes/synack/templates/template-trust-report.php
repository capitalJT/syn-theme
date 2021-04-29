<?php
    /**
     * Template Name: Trust Report Template
     *
     * @package WordPress
     * @subpackage Synack
     * @author Jabal Torres <info@jabaltorres.com>
     * @since 1.0
     *
     */

    add_filter( 'body_class', 'lp_body_class');
    function lp_body_class( $classes ) {
        if ( is_page() ){
            $classes[] = 'synack-trust-report-template';
            return $classes;
        }
    }

    get_header('landing');
?>

<?php
    $tr_hero_subheading = get_field('tr_hero_subheading');

    $trust_report_hero_thumbnail = get_field('trust_report_hero_thumbnail');
    $trust_report_hero_thumbnail_size = 'full'; // (thumbnail, medium, large, full or custom size)

    $trust_report_hero_cta_button = get_field('trust_report_hero_cta_button');
    $trust_report_file = get_field('trust_report_file');
    $trust_report_file_url = $trust_report_file['url'];
    $trust_report_file_title = $trust_report_file['title'];
?>

    <div class="hero">
        <div class="synack-container">
            <div class="row-fluid md-up-d-flex md-up-align-items-center p-y-md">
                <div class="span6">
                    <?php if ( !empty($trust_report_hero_thumbnail) ): ?>
                        <div class="hero-thumbnail-wrapper border mobile-m-b">
                            <img src="<?php echo esc_url($trust_report_hero_thumbnail['url']); ?>" alt="<?php echo esc_attr($trust_report_hero_thumbnail['alt']); ?>" />
                        </div>
                    <?php endif; ?>
                </div>
                <div class="span6">
                    <h1 class="m-b-sm"><?php the_title(); ?></h1>

                    <?php if ($tr_hero_subheading): ?>
                        <div class="hero-sub-heading"><?php echo $tr_hero_subheading; ?></div>
                    <?php endif; ?>

                    <?php if ($trust_report_hero_cta_button): ?>
                        <button id="lightbox-link" class="button m-t btn-light btn-lg"><?php echo $trust_report_hero_cta_button['trust_report_hero_cta_button_text']; ?></button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>


<?php
//    if ( isset( $_GET['aliId'] ) ) {
//        echo '<h1>' . $trust_report_file_title  . '</h1>';
//        include get_template_directory() . "/includes/open_form_in_new_tab.php";
//    }
?>

</div><?php  // End header-hero-wrapper (header-landing.php) ?>

    <script src="//app-ab15.marketo.com/js/forms2/js/forms2.min.js"></script>
    <form id="mktoForm_2087"></form>
    <script type="text/javascript">
        jQuery( document ).ready(function($) {
            $('#lightbox-link, #recent-report-section a.button').click(function(e){
                // start prevent double click event on submit button - disable button for 2 seconds
                e.preventDefault();
                var el = $(this);
                el.prop('disabled', true);
                setTimeout(function(){el.prop('disabled', false); }, 2000);
                // end prevent double click event on submit button

                MktoForms2.loadForm("//app-ab15.marketo.com", "738-OEX-476", 2087, function (form){
                    MktoForms2.lightbox(form).show();
                    form.onSuccess(function() {
                        window.open('<?php echo $trust_report_file_url; ?>', '_blank');
                    });
                });
            });
        });
    </script>

    <?php while ( have_posts() ) : the_post(); ?>
        <div class="content">
            <div class="container">
                <div class="container_inner">
                    <div id="primary" class="content-area-full">
                        <main id="main" class="site-main" role="main">
                            <div class="content-wrapper">
                                <div class="content-container">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </main><!-- #main -->
                    </div><!-- #primary -->
                </div>
            </div>
        </div>
    <?php endwhile; ?>

    <?php get_template_part('template-parts/modules'); ?>

<?php get_footer('landing'); ?>