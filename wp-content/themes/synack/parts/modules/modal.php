<?php
/**
 * Template Part for Modal
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 */

$args = array(
	'post_type' => 'synack-people',
	'posts_per_page' => -1,
	'post_status' => 'publish',
	'tax_query' => array(
		array(
			'taxonomy' => 'departments',
			'field'    => 'slug',
			'terms'    => 'executive-team',
		),
	),
);
$query = new WP_Query($args);

if($query->have_posts()){ ?>
	<script id="executiveModal-inlineTpl" type="text/x-handlebars-template">
		<div class="modal modal_opaque mix-modal_start">
			<div class="modal-underlay js-modal-underlay"></div>
			<div class="modal-inner js-modal-content">
				<div class="dialog" tabindex="-1" role="alertdialog" aria-labelledby="dialog-hd" aria-describedby="dialog-bd">
					<div class="u-isVisuallyHidden" id="dialog-hd">
						Executive Team
					</div>
					<div id="dialog-bd">
						<div class="wrapper">
							<div class="cycler js-cyclerView">

								<div class="cycler-nav">

									<ol class="navigator mix-navigator_abs mix-navigator_hasExitBtn">
										<li>
											<button type="button" class="navigator-item-link js-modal-accept">
		                                        <span class="icon icon_x">
		                                            <svg class="icon-inner">
			                                            <title>Close Modal</title>
			                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-x"></use>
		                                            </svg>
		                                        </span>
											</button>
										</li>
										<li>
											<button type="button" class="navigator-item-link js-cyclerView-prev">
		                                        <span class="icon icon_lt">
		                                            <svg class="icon-inner">
			                                            <title>Previous Slide</title>
			                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-lt"></use>
		                                            </svg>
		                                        </span>
											</button>
										</li>
										<li>
											<button type="button" class="navigator-item-link js-cyclerView-next">
		                                        <span class="icon icon_gt">
		                                            <svg class="icon-inner">
			                                            <title>Next Slide</title>
			                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-gt"></use>
		                                            </svg>
		                                        </span>
											</button>
										</li>
									</ol>

								</div>

								<ol class="cycler-list js-cyclerView-list">
									<?php
									while($query->have_posts()){
										$query->the_post();
										$meta = new SYNMeta(get_the_ID()); ?>
										<li class="cycler-list-item">
											<div class="media">

												<?php if($meta->getMeta('profile_image')){
													$imgID = $meta->getMeta('profile_image');
													$imgData = SYNImages::getImageData($imgID); ?>
													<picture class="media-figure">
														<?php if(!empty($imgData['urls']['peopleThumbnailLg'])){ ?>
															<source srcset="<?php echo $imgData['urls']['peopleThumbnailLg'];?>" media="(min-width: 1080px)" />
														<?php } ?>
														<?php if(!empty($imgData['urls']['peopleThumbnail'])){ ?>
															<img srcset="<?php echo $imgData['urls']['peopleThumbnail'];?>" alt="<?php echo $imgData['alt'];?>" />
														<?php } ?>
													</picture>
												<?php } ?>

												<div class="media-bd">
													<div class="box box_thick">
														<div class="infoBox">
															<div class="infoBox-hd">

																<div class="infoBox-hd-hdg">
																	<?php the_title();?>
																</div>

																<?php if($meta->getMeta('role')){?>
																	<div class="infoBox-hd-subHdg">
																		<?php echo $meta->getMeta('role'); ?>
																	</div>
																<?php } ?>

															</div>

															<?php if($meta->getMeta('long_description')){?>
																<div class="infoBox-bd">
																	<div class="wysiwyg">
																		<?php echo $meta->getMeta('long_description');?>
																	</div>
																</div>
															<?php } ?>

															<?php $socialLinks = $meta->parseRepeater(
																	'social_media_links',
																	array(
																		'social_media_url',
																		'social_media_type'
																	)
																);

															if($socialLinks){ ?>
																<ul class="infoBox-ft">
																	<?php foreach($socialLinks as $link){ ?>
																		<li class="infoBox-ft-cta">

																			<a href="<?php echo $link['social_media_url'];?>" target="_blank" class="infoBox-ft-cta-link">

					                                                            <span class="icon icon_<?php echo $link['social_media_type'];?> mix-icon_<?php echo $link['social_media_type'];?>_colorized">
					                                                                <svg class="icon-inner">
						                                                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-<?php echo $link['social_media_type'];?>"></use>
					                                                                </svg>
					                                                            </span>
																				<span class="infoBox-ft-cta-link-label mix-infoBox-ft-cta-link-label_<?php echo $link['social_media_type'];?>">
																					<?php echo ucfirst($link['social_media_type']);?>
																				</span>
																			</a>
																		</li>
																	<?php } ?>
																</ul>
															<?php } ?>

														</div>
													</div>
												</div>
											</div>
										</li>
									<?php } //endwhile
									wp_reset_postdata(); ?>
								</ol>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</script>
<?php } //endif
