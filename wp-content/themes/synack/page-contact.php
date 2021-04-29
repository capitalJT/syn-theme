<?php
/**
 * Template Name: Contact Page
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 *
 */
get_header(); ?>

    <div class="wrapper mix-wrapper_contain">

        <?php if(have_posts()){
            while(have_posts()){ the_post();
                get_template_part('parts/shared/heading'); ?>

                    <div class="box box_clipped">
                        <div class="wrapper wrapper_tight">
                            <div class="wysiwyg">
                                <?php the_content(); ?>
                            </div>

                            <div class="grid">
                                <div class="grid-col grid-col_7of10 mix-grid-col_borderRight">
                                  <div>
                                    <legend class="legendLabel" style="padding-bottom:15px;">Get Started with Synack</legend>
                                    <script src="//app-ab15.marketo.com/js/forms2/js/forms2.min.js"></script>
                                    <form id="mktoForm_1205"></form>
                                    <script>MktoForms2.loadForm("//app-ab15.marketo.com", "738-OEX-476", 1205);</script>
                                  </div>
                                </div>

                                <div class="grid-col grid-col_3of10">
                                    <?php get_template_part('parts/pages/contact', 'aside');?>
                                </div>
                            </div>
                            <div style="height:45px; width:100%;"></div>
                        </div>
                    </div>
            <?php }
        } ?>

    </div><!-- /.wrapper -->

        <script>
          (function (){
            // Please include the email domains you would like to block in this list
            var invalidDomains = ["@gmail.","@yahoo.","@hotmail.","@live.","@aol.","@outlook."];

            MktoForms2.whenReady(function (form){
              form.onValidate(function(){
                var email = form.vals().Email;
                if(email){
                  if(!isEmailGood(email)) {
                    form.submitable(false);
                    var emailElem = form.getFormElem().find("#Email");
                    form.showErrorMessage("Must be Business email.", emailElem);
                  }else{
                    form.submitable(true);
                  }
                }
              });
            });

            function isEmailGood(email) {
              for(var i=0; i < invalidDomains.length; i++) {
                var domain = invalidDomains[i];
                if (email.indexOf(domain) != -1) {
                  return false;
                }
              }
              return true;
            }

          })();
    </script>

<?php get_footer();
