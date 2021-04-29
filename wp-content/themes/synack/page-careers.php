<?php
/**
 * Template Name: Careers
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 *
 */
get_header(); ?>



    <div class="triangle">
        <div class="triangle-shape triangle-shape_1c"></div>

        <!-- Marquee -->
        <div class="wrapper">
            <div class="vR vR_x12to14to7">
                <div class="heading heading_pushedLg">
                    <h1 class="heading-bd mix-heading-bd_tight">
                        We Make the Enterprise Smarter, Faster and Stronger Than the Bad Guys. And We're Excited for You to Be a Part of It.
                    </h1>

                    <div class="heading-divider">
                        <div class="ruler ruler_center">
                            <div class="ruler-icon">
                                <span class="icon icon_ruler">
                                    <svg class="icon-inner">
                                        <use xlink:href="#icon-ruler"></use>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="heading-meta heading-meta_strong mix-heading-meta_tight">
                        The best part – it feels like superhero work but the impact is real.
                    </div>
                    <div class="heading-ft">
                        <a href="#careers" class="btn btn_primary">Join us</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- //END Marquee -->
    </div>

    <div class="wrapper mix-wrapper_contain">
        <!-- The Good Stuff -->
        <div class="vR vR_x4 mix-marquee_space">
            <div class="heading">
                <h2 class="heading-bd mix-heading-bd_tight">
                    The Good Stuff
                </h2>
                <div class="heading-divider">
                    <div class="ruler ruler_center">
                        <div class="ruler-icon">
                            <span class="icon icon_ruler">
                                <svg class="icon-inner">
                                    <use xlink:href="#icon-ruler"></use>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="heading-meta heading-meta_strongLt mix-heading-meta_tight">
                    Being part of a high-impact team comes with high expectations and even higher rewards. Synack takes great care of its people &mdash; here&rsquo;s how.
                </div>
                <div class="heading-text heading-text_tight">
                    <?php get_template_part('parts/pages/careers', 'perks'); ?>
                </div>
            </div>

        </div>
        <!-- //END The Good Stuff -->

        <div id="careers" class="heading">
            <h2 class="heading-bd">Current Openings</h2>
            <div class="heading-ft">
                <div class="ruler ruler_center">
                    <div class="ruler-icon">
                    <span class="icon icon_ruler">
                        <svg class="icon-inner">
                            <use xlink:href="#icon-ruler"></use>
                        </svg>
                    </span>
                    </div>
                </div>
            </div>
            <div class="heading-meta heading-meta_strongLt mix-heading-meta_tight">
                Note: Due to an increased number of applicants and Covid-19 shelter in place laws, response times will be slower than usual. Your interest in Synack is important to us so we apologize and appreciate your patience. 
            </div>
            <div>&nbsp;</div>
            <div>&nbsp;</div>
        </div>

        <div class="grid">
            <div class="grid-col mix-grid-col_10to8 js-careersView">
                <div class="vR vR_x2">
                    <div role="combobox" class="comboBoxTabs js-careersView-comboBoxView">
                        <label for="categoryFilter" class="u-isVisuallyHidden">Filter by Category</label>
                        <input readonly
                               disabled
                               type="text"
                               value="All"
                               id="categoryFilter"
                               aria-autocomplete="none"
                               aria-readonly="true"
                               class="comboBoxTabs-value js-comboBoxView-value"
                            />
                        <ul role="listbox" aria-expanded="false" class="comboBoxTabs-list js-comboBoxView-list">
                            <li role="option" tabindex="-1" data-category-id="0" class="comboBoxTabs-list-item isActive">All</li>
                        </ul>
                    </div>
                </div>

                <div class="vR vR_x4">
                    <ul class="careerList js-careersView-careerList">
                        <li>
                            <div class="median median_center">
                                <img src="<?php echo get_stylesheet_directory_uri();?>/assets/media/images/loading.gif" alt="Loading..." />
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Join Us -->
        <div class="vR vR_x5">
            <div class="heading heading_pushed theme-red">
                <h2 class="heading-bd mix-heading-bd_tight" style="color: red;">
                    Interested in Joining the Synack Red Team?
                </h2>
                <div class="heading-divider">
                    <div class="ruler ruler_center">
                        <div class="ruler-icon">
                                <span class="icon icon_ruler mix-icon_ruler-red">
                                    <svg class="icon-inner">
                                        <use xlink:href="#icon-ruler"></use>
                                    </svg>
                                </span>
                        </div>
                    </div>
                </div>
                <div class="heading-meta heading-meta_strongLt mix-heading-meta_tight">
                    <p>The Synack Red Team gives security researchers across the globe a legal platform to do what they love and get paid for it. Interested in being part of a talented community that's helping to secure the enterprise?</p>
                </div>
                <div class="heading-ft">
                    <a href="<?php echo esc_url( home_url() ); ?>/red-team" class="btn btn_red">Join us</a>
                </div>
            </div>
        </div>

        <div class="box box_md">
            <div class="moduleTxtHero">
                <div class="moduleTxtHero-bd">
                    <div class="wysiwyg">
                        <p>Synack is an Equal Opportunity Employer. We are committed to inclusion and diversity. We make every effort to offer employment and advancement opportunities to all qualified candidates. We do not discriminate based upon race, religion, color, national origin, gender (including pregnancy, childbirth, or related medical condition), sexual orientation, gender identity, gender expression, age, status as a protected veteran, status as an individual with a disability, or other applicable legally protected characteristics. Please see the United States Department of Labor's <a href="https://www.synack.com/wp-content/uploads/2018/02/eeopost.pdf" target="_blank">EEO Poster</a>, <a href="https://www.synack.com/wp-content/uploads/2018/02/OFCCP_EEO_Supplement_Final_JRF_QA_508c.pdf" target="_blank">EEO Poster Supplement</a> and <a href="https://www.synack.com/wp-content/uploads/2018/02/pay-transp_formattedESQA508c.pdf" target="_blank">Pay Transparency Nondiscrimination Provision</a> for additional information.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- //END Join Us -->

    </div><!-- /.wrapper -->

<?php get_footer();
