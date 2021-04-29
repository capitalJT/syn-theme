<?php 
/**
 * Template Name: Industries Overview
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div class="wrapper">
	<div class="wrapper">
		<div class="box box_md">
			<div class="moduleTxtHero">
				<!-- Top Section -->
		        <div class="moduleTxtHero-hd">
		            <div class="heading">
		                <h1 class="heading-bd heading-bd_lg">
		                    Industries
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
		            </div>
		        </div>
		        <div class="moduleTxtHero-bd">
					<div class="wysiwyg">
	                	<p><strong>Hacker-Powered Intelligence for Enterprises & Government Agencies</strong><br />
						Any industry leveraging technology shares the risk of security issues. Enterprises and government agencies rely on Synack’s hacker-powered intelligence platform to test their high-value assets and assess their resistance to attack, all from a crowdsourced adversarial perspective. Synack works with customers from all industries, including:</p>
					</div>
				</div>
				<div class="industryWrapper">
					<div class="blocks blocks_3up mix-blocks_1to3to3">
		                <div class="moduleImgTxtHero-ft">
		                	<a href="https://www.synack.com/retail/">
			                    <div class="industryBox boxRetail">
			                    	<div class="blueHighlight">
		                        		<p class="highlightText">Retail</p>
			                        </div>
			                    </div>
		                    </a>
		                </div>
		                <div class="moduleImgTxtHero-ft">
		                	<a href="https://www.synack.com/financial-services/">
			                    <div class="industryBox boxFinances">
			                    	<div class="blueHighlight">
			                        	<p class="highlightText">Financial Services</p>
			                        </div>
			                    </div>
		                	</a>
	                	</div>
		                <div class="moduleImgTxtHero-ft">
		                	<a href="https://www.synack.com/government/">
			                    <div class="industryBox boxGovernment">
			                    	<div class="blueHighlight">
			                        	<p class="highlightText">Government</p>
			                        </div>
			                    </div>
		                    </a>
		                </div>
		            </div>
	            </div>
			</div>
		</div>
	</div>
</div>

<?php get_template_part('parts/solutions/prefooter'); ?>
<?php get_footer(); ?>
