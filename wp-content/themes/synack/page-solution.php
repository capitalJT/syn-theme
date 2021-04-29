<?php
/**
 * Template Name: Solution
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 *
 */
get_header();?>
<div class="splitter js-splitter">
    <div class="splitter-inner js-splitter-inner">

        <div class="splitter-inner-left js-splitter-left">
            <?php get_template_part('parts/solutions/people');?>
            <button type="button" class="splitter-inner-left-nav js-splitter-back"><span class="splitter-inner-left-nav-label">Overview</span></button>
        </div>

			<div class="splitter-inner-center js-splitter-center">
				<?php get_template_part('parts/solutions/main');?>
			</div>

			<div class="splitter-inner-right js-splitter-right">
	            <?php get_template_part('parts/solutions/tech');?>
	            <button type="button" class="splitter-inner-right-nav js-splitter-back"><span class="splitter-inner-right-nav-label">Overview</span></button>
	        </div>

	    </div>
	</div>
<?php get_footer();
