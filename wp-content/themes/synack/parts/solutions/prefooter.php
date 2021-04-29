<div class="preFooter preFooter_particles">
    <div class="preFooter-inner">
        <div class="preFooter-inner-section">
            <?php if(get_option('options_marketing_title')){ ?>
                <h3 class="preFooter-inner-section-hd preFooter-inner-section-hd_lg">
                    <?php echo esc_html( get_option('options_marketing_title') ); ?>
                </h3>
                <div class="preFooter-inner-section-hr">
                    <div class="ruler ruler_center ruler_startMd">
                        <div class="ruler-icon">
                            <span class="icon icon_ruler mix-icon_reverse">
                                <svg class="icon-inner">
                                    <use xlink:href="#icon-ruler"></use>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if(get_option('options_marketing_content')){ ?>
                <div class="preFooter-inner-section-bd">
                    <?php echo wpautop(get_option('options_marketing_content')); ?>
                </div>
            <?php } ?>
            <?php if(get_option('options_marketing_cta_url') && get_option('options_marketing_cta_label')){ ?>
                <div class="preFooter-inner-section-cta">
                    <a href="<?php echo esc_url( get_option('options_marketing_cta_url') ); ?>" class="btn btn_reverse"><?php echo esc_html(get_option('options_marketing_cta_label')); ?></a>
                </div>
            <?php } ?>
        </div>
        <div class="preFooter-inner-section preFooter-inner-section_centerContent mix-preFooter-inner-section_notMobile">
            <img src="<?php echo get_template_directory_uri();?>/assets/media/images/logo-grid.png" alt="Synack Logo" />
        </div>
    </div>
</div><!-- /.preFooter -->