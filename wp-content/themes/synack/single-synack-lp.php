<?php
    /**
    * Template Name: Single Synack LP
    *
    * @link https://codex.wordpress.org/Template_Hierarchy
    *
    * @package The Authority
    */

    add_filter( 'body_class', 'lp_body_class');

    function lp_body_class( $classes ) {
        if ( is_singular( 'synack-lp' ) ) {
            $classes[] = 'synack-lp-template';
        }
        return $classes;
    }

    get_header('landing');
?>

<?php
    include "includes/lp_gating_logic.php";

    $lp_hero_heading = get_field('lp_hero_heading');
    $lp_hero_subheading = get_field('lp_hero_subheading');
    $lp_cta_card_group_display = get_field('lp_cta_card_group_display');
    $lp_cta_card_group = get_field('lp_cta_card_group');
    $lp_template_sidebar_options = get_field('lp_template_sidebar_options');
    $lp_template_form_content = $lp_template_sidebar_options['lp_template_form_content'];
    $lp_template_marketo_form_embed_code = $lp_template_sidebar_options['lp_template_marketo_form_embed_code'];
    $lp_template_form_confirmation_message = $lp_template_sidebar_options['lp_template_form_confirmation_message'];
?>
    <?php if ($lp_hero_heading || $lp_hero_subheading): ?>
        <div class="hero">
            <div class="container">
                <div class="container_inner">
                    <?php if ($lp_hero_heading): ?><h1 class="text-center m-b-sm"><?php echo $lp_hero_heading; ?></h1><?php endif; ?>
                    <?php if ($lp_hero_subheading): ?><h2 class="hero-sub-heading text-center"><?php echo $lp_hero_subheading; ?></h2><?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    </div><!-- End .header-hero-wrapper (header-landing.php) -->


    <div class="content">
        <div class="container">
            <div class="container_inner">
                <div id="primary" class="content-area-full">

                    <main id="main" class="site-main content-sidebar" role="main">
                        <div class="content-wrapper">
                            <div class="content-container">
                                <?php syn_content_gating(); ?>  
                    
                                <?php // while ( have_posts() ) : the_post(); ?>
                                    <?php // the_content(); ?>
                                <?php // endwhile; ?>
                            </div>
                        </div>
                    </main><!-- #main -->

                    <aside id="sidebar" class="m-b-md">
                        <div class="sidebar-container">
                            <?php // dynamic_sidebar( 'custom-side-bar' ); ?>

                            <?php if ( synIsPageUngated()) :?>
                                <div class="lp-template-form-content">
                                    <?php
                                        if ($lp_template_form_confirmation_message){
                                            echo $lp_template_form_confirmation_message;
                                        }
                                    ?>

                                    <?php if (synIsHardUngated('ung8')): ?>
                                        <script>
                                            jQuery(document).ready(function( $ ) {
                                                synackSetCookie('synack-hard-ungated', 'true', 7);
                                            });
                                        </script>
                                    <?php endif; ?>
                                </div>

                            <?php else: ?>
                                <?php if ($lp_template_form_content) :?>
                                    <div class="lp-template-form-content">
                                        <?php echo $lp_template_form_content; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($lp_template_sidebar_options['lp_template_marketo_form_embed_code']) :?>
                                    <div class="lp-template-marketo-form-embed-code">
                                        <script src="//app-ab15.marketo.com/js/forms2/js/forms2.min.js"></script>
                                        <?php echo $lp_template_sidebar_options['lp_template_marketo_form_embed_code']; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </aside>

                </div><!-- #primary -->
            </div>
        </div>
    </div>

<?php get_template_part('template-parts/modules'); ?>

<?php
    $additional_resources_post_object = get_field('additional_resources_post_object');
    // $count_featured_resources = count(get_field('additional_resources_post_object'));
    $max_featured_resources = 3;

    if ( $additional_resources_post_object ): ?>

        <div id="gated-content-featured-resources" class="lp-ctas">
            <div class="container">
                <div class="container_inner">
                    <?php foreach( array_slice($additional_resources_post_object, 0, $max_featured_resources) as $post ):
                        // Setup this post for WP functions (variable must be named $post).
                        setup_postdata($post); ?>
                        <div class="lp-cta-col">
                            <div class="lp-cta-col-inner">

                                <div class="lp-cta-col-content">
                                    <h3 class="lp-cta-col-title"><?php the_title(); ?></h3>
                                </div>

                                <?php
                                    // https://wordpress.stackexchange.com/questions/189055/displaying-the-category-name-of-a-custom-post-type
                                    $terms = get_the_terms( $post->ID , 'resource-type' );
                                    if ( is_array( $terms ) ) {
                                        foreach ( $terms as $term ) {
                                            $terms_result =  $term->name;
                                        }
                                    } else {
                                        $terms_result = "Resource";
                                    }
                                    echo '<span class="resource-category d-block m-b">' . $terms_result . '</span>';
                                ?>

                                <a class="button btn-primary" href="<?php the_field( 'call_to_action_url' ); ?>" target="_blank"><?php the_field( 'call_to_action_label' ); ?></a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    <?php
        // Reset the global post object so that the rest of the page works correctly.
        wp_reset_postdata();
    ?>

<?php endif; ?>

<?php if ($lp_cta_card_group && $lp_cta_card_group_display): ?>
    <div class="lp-ctas">
        <div class="container">
            <div class="container_inner">
                <div class="lp-cta-col">
                    <div class="lp-cta-col-inner">
                        <h3 class="lp-cta-col-title"><?php echo $lp_cta_card_group['lp_cta_card_1']['lp_cta_card_1_title']; ?></h3>
                        <div class="lp-cta-col-content">
                            <?php echo $lp_cta_card_group['lp_cta_card_1']['lp_cta_card_1_content']; ?>
                        </div>
                        <a href="<?php echo $lp_cta_card_group['lp_cta_card_1']['lp_cta_card_1_button_url']; ?>" class="button btn-primary"><?php echo $lp_cta_card_group['lp_cta_card_1']['lp_cta_card_1_button_text']; ?></a>
                    </div>
                </div>
                <div class="lp-cta-col">
                    <div class="lp-cta-col-inner">
                        <h3 class="lp-cta-col-title"><?php echo $lp_cta_card_group['lp_cta_card_2']['lp_cta_card_2_title']; ?></h3>
                        <div class="lp-cta-col-content">
                            <?php echo $lp_cta_card_group['lp_cta_card_2']['lp_cta_card_2_content']; ?>
                        </div>
                        <a href="<?php echo $lp_cta_card_group['lp_cta_card_2']['lp_cta_card_2_button_url']; ?>" class="button btn-primary"><?php echo $lp_cta_card_group['lp_cta_card_2']['lp_cta_card_2_button_text']; ?></a>
                    </div>
                </div>
                <div class="lp-cta-col">
                    <div class="lp-cta-col-inner">
                        <h3 class="lp-cta-col-title"><?php echo $lp_cta_card_group['lp_cta_card_3']['lp_cta_card_3_title']; ?></h3>
                        <div class="lp-cta-col-content">
                            <?php echo $lp_cta_card_group['lp_cta_card_3']['lp_cta_card_3_content']; ?>
                        </div>
                        <a href="<?php echo $lp_cta_card_group['lp_cta_card_3']['lp_cta_card_3_button_url']; ?>" class="button btn-primary"><?php echo $lp_cta_card_group['lp_cta_card_3']['lp_cta_card_3_button_text']; ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php
    // Get Gated Content Type
    $resource_type_val = get_field('gated_content_type');

    // strip out all whitespace
    $resource_type_val = preg_replace( '/\s*/', '', $resource_type_val );

    // convert the string to all lowercase
    $resource_type_cookie_name = strtolower( $resource_type_val );
?>

<script>
    function synackSetCookie(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    function synackGetCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) === ' ') {
                c = c.substring(1, c.length);
            }
            if (c.indexOf(nameEQ) === 0) {
                return c.substring(nameEQ.length, c.length);
            }
        }
        return null;
    }

    function synackEraseCookie(name) {
        document.cookie = name + '=; Max-Age=-99999999;';
    }

    // https://stackoverflow.com/questions/486896/adding-a-parameter-to-the-url-with-javascript
    function synackInsertParam(key, value) {
        key = encodeURI(key);
        value = encodeURI(value);

        var kvp = document.location.search.substr(1).split('&');

        var i = kvp.length;
        var x;
        while (i--) {
            x = kvp[i].split('=');

            if (x[0] === key) {
                x[1] = value;
                kvp[i] = x.join('=');
                break;
            }
        }

        if (i < 0) {
            kvp[kvp.length] = [key, value].join('=');
        }

        // this will reload the page, it's likely better to store this until finished
        document.location.search = kvp.join('&');
    }

    // Get Query Params
    // https://github.com/westonruter/pantheon-documentation/blob/master/source/docs/articles/architecture/edge/pantheon_stripped-get-parameter-values.md
    function getQueryParams(qs) {
        qs = qs.split("+").join(" ");
        var params = {}, tokens, re = /[?&]?([^=]+)=([^&]*)/g;

        while (tokens = re.exec(qs)) {
            params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]);
        }

        return params;
    }

    // Check if hidden field exists
    // TODO: add gated-hidden-field-functionality.html functionality here. Temp removed to avoid errors.
    document.addEventListener('DOMContentLoaded', function() {

        // Get the ID of the first form
        var formId;
        if ( document.getElementsByTagName('form').length ){
            formId = document.getElementsByTagName('form')[0].id;
        } else {
            formId = 'FallbackForm_123';
        }

        // https://stackoverflow.com/questions/10003683/how-can-i-extract-a-number-from-a-string-in-javascript
        // This could be.. var formId = "#div-name-1234-characteristic:561613213213";
        var synMktoFormNumb = formId.match(/\d/g);
        synMktoFormNumb = synMktoFormNumb.join("");
        // console.log(synMktoFormNumb);

        var synMktoForm = document.querySelector('#' + formId + '');

        if (synMktoForm){
            synMktoForm.addEventListener("submit", function (e) {
                synackSetCookie('synack-last-gated-content-type', '<?php echo $resource_type_cookie_name; ?>', 7);

                // scroll to top of page
                // window.scrollTo(0, 0);

                // this will reload the page,
                // synackInsertParam("actn", "sbmtd");

                // check if newsletter subscription checkbox is checked
                // if (document.querySelector("input[type=checkbox][data-name='subscribe_to_newsletter']").checked) {
                    // alert("checked") ;
                    // synackSetCookie('synack-subscribed', 'newsletter', 7);
                // }
            });
        }

        if (typeof MktoForms2 !== "undefined"){
            MktoForms2.loadForm("//app-ab15.marketo.com", "738-OEX-476", synMktoFormNumb, function(form) {
                //Add an onSuccess handler
                form.onSuccess(function(values, followUpUrl) {
                    // Take the lead to a different page on successful submit, ignoring the form's configured followUpUrl
                    // location.href = "https://google.com/?q=marketo+forms+v2+examples";
                    // Return false to prevent the submission handler continuing with its own processing
                    // return false;
                    synackSetCookie('synack-form-success', 'true', 7);
                });
            });
        }

    });

    // jQuery(document).ready(function( $ ) {
    //     var jt_query_params = getQueryParams(document.location.search);
    //     console.log(jt_query_params);
    // });
</script>


<?php get_footer('landing'); ?>