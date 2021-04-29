<?php
/**
 * Template Part of Sales Force Form
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 *
 */
 ?>
<div class="box">
    <form action="https://www.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8" method="post" class="js-validationView">

        <input type=hidden name="oid" value="00DF00000006tAk">
        <input type=hidden name="retURL" value="<?php echo esc_url( get_permalink( get_option('options_thank_you_page') ) );?>">
        <input type=hidden name="lead_source" value="Contact Us - Webpage">
        <input id="hidden-captcha" style="display:none; opacity:0;" type="text" name="website" value="" />
        <?php
            /**
             * NOTE: These fields are optional debugging elements. These will be displayed if
             * SALESFORCE_DEBUG is true in the wp-config.php file.
             */
            if(defined('SALESFORCE_DEBUG') && SALESFORCE_DEBUG === true){
                echo '<input type="hidden" name="debug" value=1>';

                if(defined('SALESFORCE_DEBUG_EMAIL')){
                    echo '<input type="hidden" name="debugEmail" value="' . SALESFORCE_DEBUG_EMAIL . '">';
                }
            }
        ?>

        <div class="vR vR_x2">
            <fieldset>
                <legend class="legendLabel">Get Started with Synack</legend>
                <ol class="blocks blocks_lg">
                    <li>
                        <ol class="blocks blocks_2up blocks_lg mix-blocks_collapse mix-blocks_1to2">
                            <li>
                                <label for="first_name" class="u-isVisuallyHidden">First Name</label>
                                <input id="first_name" maxlength="40" name="first_name" type="text" placeholder="First Name*" class="field  field_textBold" data-validation-type="required" data-validation-message="This field is required" />
                            </li>
                            <li>
                                <label for="last_name" class="u-isVisuallyHidden">Last Name</label>
                                <input  id="last_name" maxlength="80" name="last_name" type="text" placeholder="Last Name*" class="field field_textBold" data-validation-type="required" data-validation-message="This field is required" />
                            </li>
                        </ol>
                    </li>
                    <li>
                        <label for="email" class="u-isVisuallyHidden">Email</label>
                        <input id="email" maxlength="80" name="email" type="email" placeholder="Email*" class="field field_textBold" data-validation-type="email" data-validation-message="Please enter a valid email address" />
                    </li>
                    <li>
                        <label for="company" class="u-isVisuallyHidden">Company</label>
                        <input  id="company" maxlength="40" name="company" type="text" placeholder="Company" class="field field_textBold"/>
                    </li>
                    <li>
                        <label for="title" class="u-isVisuallyHidden">Title</label>
                        <input  id="title" maxlength="40" name="title" type="text" placeholder="Title" class="field field_textBold"/>
                    </li>
                    <li>
                        <label for="phone" class="u-isVisuallyHidden">Phone</label>
                        <input id="phone" maxlength="40" name="phone" type="text" placeholder="Phone" class="field field_textBold" />
                    </li>
                    <li>
                         <textarea  id="00NF000000CGH3T" name="00NF000000CGH3T" rows="8" class="field field_textBold" placeholder="Message*" data-validation-type="required" data-validation-message="This field is required"></textarea>
                    </li>
                </ol>
            </fieldset>
        </div>
        <input type="submit" name="submit" class="btn btn_primary btn_block" />
    </form>
</div>
