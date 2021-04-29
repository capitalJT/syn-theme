<?php
/**
 * Tab Carousel Module template.
 *
 * Show a carousel with tab navigation in the top.
 *
 * @package Synack/modules/module-tab-carousel
 */

$section_tabs = get_sub_field( 'tabs' );

get_template_part('parts/modules/synModuleIdsClasses');

?>

<section id="<?php synack_module_global_id(); ?>" class="synack-module section-tab-carousel js-fadein-section <?php synack_module_global_classes(); ?>">
	<div class="container">
        <?php get_template_part('parts/modules/synModuleTitles');?>

		<?php if ( $section_tabs ) : ?>
			<div class="section-tab-carousel-tab">
				<div class="section-tab-carousel__nav m-b">
					<?php
					foreach ( $section_tabs as $key => $section_tab ) :
						$active_class = '';
						if ( 0 === $key ) {
							$active_class = ' is-active';
						}
						echo sprintf( '<button class="section-tab-carousel__button%s" data-slide="%d">%s</button>', $active_class, esc_attr( $key ), esc_html( $section_tab['title'] ) );
					endforeach;
					?>
				</div>
				<div class="section-tab-carousel-slider has-boxshadow">
					<?php
					foreach ( $section_tabs as $section_tab ) :
						$tab_title       = $section_tab['title'];
						$tab_description = $section_tab['description'];
						$tab_image       = $section_tab['image'];
						?>
						<div class="tab-carousel-item">
							<?php
							echo wp_get_attachment_image(
								$tab_image,
								'full',
								false,
								array(
									'class' => 'tab-carousel-item__image',
									'alt'   => esc_attr( $tab_title ),
								)
							);
							?>
							<div class="tab-carousel-item__content has-boxshadow">
								<h3 class="tab-carousel-item__title"><?php echo esc_html( $tab_title ); ?></h3>
								<div class="tab-carousel-content__description"><?php echo wp_kses_post( $tab_description ); ?></div>
							</div>
						</div>
					<?php
					endforeach;
					?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>

<script>
    (function($){
        'use strict';
        $(function() {
            $('.section-tab-carousel-slider').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                fade: true,
                dots: false,
                asNavFor: '.section-tab-carousel__nav',
                responsive: [
                    {
                        breakpoint: 767,
                        settings: {
                            arrows: false,
                        }
                    }
                ]
            });

            $('.section-tab-carousel__nav').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                asNavFor: '.section-tab-carousel-slider',
                dots: false,
                arrows: false,
                // centerMode: true,
                focusOnSelect: true,
                variableWidth: true,
            });

        });
    })(jQuery);
</script>