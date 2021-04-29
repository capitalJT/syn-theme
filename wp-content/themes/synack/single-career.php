<?php
/**
 * Template for Single Career Page
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 */

get_header();

    $career = new SYNCareer(esc_html(get_query_var('career')));

    //echo $career->getJobTitle();
    //echo html_entity_decode($career->getJobContent());
    //echo $career->getJobLocation();
    //echo $career->getJobDepartment();
    //echo $career->getJobURL();

    $title = ($career->error)
                ? 'Invalid Job Opportunity'
                : $career->getJobTitle();
    $content = ($career->error)
                ? ''
                : html_entity_decode($career->getJobContent());

    ?>

    <div class="wrapper mix-wrapper_contain">

        <div class="heading heading_pushed">
            <?php if($career->getJobLocation()){?>
                <div class="heading-hd">
                   <span><?php echo $career->getJobLocation();?></span>
                </div>
            <?php } ?>

            <h1 class="heading-bd" itemprop="headline">
                <?php echo $title;?>
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

            <?php if($career->getJobURL()) {?>
                <div class="heading-ft">
                    <a href="<?php echo $career->getJobURL();?>" class="btn btn_primary">Apply Now</a>
                </div>
            <?php } ?>
        </div>

        <div class="grid" itemscope itemtype="http://schema.org/Article">
            <div class="grid-col grid-col_6of10 mix-grid-col_prefix2of10 mix-grid-col_suffix2of10">

                <div class="box">
                    <div class="wysiwyg">
                        <?php echo $content; ?>
                    </div>
                </div>
                
            </div>
        </div>

    </div><!-- /.wrapper -->

<?php get_footer();
