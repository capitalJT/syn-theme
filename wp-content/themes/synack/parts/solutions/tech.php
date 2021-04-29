<?php
/**
 * Template Part for the tech part of solutions
 *
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 * @package WordPress
 * @subpackage Synack
 *
 */
?>
<div class="wrapper mix-wrapper_contain">
    <!-- Marquee -->
    <div class="moduleImgTxtHero">
        <div class="moduleImgTxtHero-hd">
            <div class="heading">
                <h1 class="heading-bd heading-bd_lg">
                    The Ultimate Hacker Toolkit
                </h1>
                <div class="heading-divider">
                    <div class="ruler ruler_center mix-ruler_tight">
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
        <div class="moduleImgTxtHero-media moduleImgTxtHero-media_alt">
            <img src="<?php echo get_template_directory_uri();?>/assets/media/images/hand.png" alt="">
        </div>
        <div class="moduleImgTxtHero-bd">
            <div class="heading">
                <h2 class="heading-bd heading-bd_small">A Powerful Platform that Shows You What the Attacker Sees</h2>
                <div class="heading-divider">
                    <div class="ruler ruler_center mix-ruler_tight">
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
            <div class="moduleImgTxtHero-bd-article">
                <p>The Synack Hydra Technology is an advanced vulnerability intelligence platform that together with the SRT, gives the enterprise an adversarial perspective of their digital assets. Hydra combines the power of a modern vulnerability scanner with the expertise and creativity found in individual hacker toolkits to provide actionable intelligence to the Synack Red Team (SRT) so that they can locate, confirm and report exploitable bugs with unprecedented efficiency and scale</p>
                <p style="margin-bottom:0 !important;">The SRT receives real-time insights from Hydra into possible attack vectors to investigate and confirm exploitability. Acting as a closely integrated extension of internal security teams, the Hydra-enabled SRT delivers exploitation intelligence that reduces windows of exposure and provides comprehensive testing coverage across large, complex enterprise assets. At the same time, the enterprise benefits from Hydra's continuous network and application monitoring for changes and potential vulnerabilities.</p>
            </div>
        </div>
        <div class="moduleImgTxtHero-ft">
            <?php $uploadDir = wp_upload_dir(); ?>
            <a href="https://www.youtube.com/watch?v=RUa8EKZ9CaQ" class="btn btn_primary" target="_blank" style="margin-top:30px !important;">See How It Works</a>
        </div>
    </div>
</div>
    <!-- //END Marquee -->

<!-- Hydra Intelligence -->
<div class="vR vR_x6">
    <div class="moduleSupplement moduleSupplement_secondary mix-moduleSupplement_release">
        <div class="heading heading_constrain">
            <h2 class="heading-bd heading-bd_small">Hydra Intelligence Applied</h2>
            <div class="heading-divider">
                <div class="ruler ruler_center mix-ruler_tight">
                    <div class="ruler-icon">
                        <span class="icon icon_ruler">
                            <svg class="icon-inner">
                                <use xlink:href="#icon-ruler"></use>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
            <div class="heading-text heading-text_tight">
                <div class="blocks mix-blocks_collapse blocks_2up mix-blocks_1to2 mix-blocks_wide">
                    <div>
                        <div class="wysiwyg wysiwyg_lite">
                            <p><strong>The Ultimate Synack Red Team Toolkit</strong></p>
                            <p>Hydra alerts researchers of possible vulnerabilities, changes, or events. The intelligence immediately prompts the researcher to validate known vulnerabilities and investigate potential attack vectors, streamlining the reconnaisance phase of the testing process and ultimately eliminating windows of exposure at unprecedented rates.</p>
                        </div>
                        <a href="<?php echo bloginfo('url');?>/red-team/" class="btn btn_primary">Learn More</a>
                    </div>
                    <div>
                        <div class="wysiwyg wysiwyg_lite">
                            <p><strong>Continuous Perimeter Vigilance for the Enterprise</strong></p>
                            <p>Hydra's continuous monitoring capabilities provide your internal team with a comprehensive and continuous situational awareness of your global perimeter. We monitor for changes and anomalies and make them immediately visible to your team.</p>
                        </div>
                        <?php $uploadDir = wp_upload_dir(); ?>
                        <a href="<?php echo $uploadDir['baseurl'];?>/2015/10/hydra_datasheet.pdf" class="btn btn_primary" target="_blank">Download the Hydra Datasheet</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- //END Hydra Intelligence -->

<div class="wrapper">
    <!-- Benefits of Hydra -->
    <div class="vR vR_x6">
        <div class="sides sides_secondary">
            <div class="heading">
                <h2 class="heading-bd heading-bd_small">Benefits of Hydra</h2>
                <div class="heading-divider">
                    <div class="ruler ruler_center mix-ruler_md">
                        <div class="ruler-icon">
                        <span class="icon icon_ruler">
                            <svg class="icon-inner">
                                <use xlink:href="#icon-ruler"></use>
                            </svg>
                        </span>
                        </div>
                    </div>
                </div>
            </div><!-- /.heading -->
            <div class="blocks blocks_4up mix-blocks_1to4">
                <div class="tout tout_static">
                    <div class="tout-md tout-md_wide">
                        <div class="tout-md-inner">
                        <span class="icon icon_flag">
                            <svg class="icon-inner">
                                <use xlink:href="#icon-flag"></use>
                            </svg>
                        </span>
                        </div>
                    </div>
                    <h4 class="tout-hd mix-tout-bd_small">
                        Built To Integrate With Human Beings
                    </h4>
                    <div class="tout-bd mix-tout-bd_small">
                        <p>Hydra is purpose-built to produce intelligence that is immediately actionable by the SRT, making their discovery processes more efficient and targeted than ever before.</p>
                    </div>
                </div>
                <div class="tout tout_static">
                    <div class="tout-md tout-md_wide">
                        <div class="tout-md-inner">
                        <span class="icon icon_documents">
                            <svg class="icon-inner">
                                <use xlink:href="#icon-documents"></use>
                            </svg>
                        </span>
                        </div>
                    </div>
                    <h4 class="tout-hd mix-tout-bd_small">
                        Actionable Intelligence, Not Information Overload
                    </h4>
                    <div class="tout-bd mix-tout-bd_small">
                        <p>Hydra delivers contextualized, ongoing change detection, allowing researchers to immediately investigate potential security issues and determine which vulnerabilities are exploitable. No multipage reports or machine language translation that you have to sift through.</p>
                    </div>
                </div>
                <div class="tout tout_static">
                    <div class="tout-md tout-md_wide">
                        <div class="tout-md-inner">
                        <span class="icon icon_screens">
                            <svg class="icon-inner">
                                <use xlink:href="#icon-screens"></use>
                            </svg>
                        </span>
                        </div>
                    </div>
                    <h4 class="tout-hd mix-tout-bd_small">
                        Continuous Perimeter Monitoring
                    </h4>
                    <div class="tout-bd mix-tout-bd_small">
                        <p>As you digitize your business at an accelerated pace, maintain control and visibility of your internet-facing assets. </p>
                    </div>
                </div>
                <div class="tout tout_static">
                    <div class="tout-md tout-md_wide">
                        <div class="tout-md-inner">
                        <span class="icon icon_clock">
                            <svg class="icon-inner">
                                <use xlink:href="#icon-clock"></use>
                            </svg>
                        </span>
                        </div>
                    </div>
                    <h4 class="tout-hd mix-tout-bd_small">
                        Save Time and Money
                    </h4>
                    <div class="tout-bd mix-tout-bd_small">
                        <p>Hydra is hosted in the cloud, meaning no physical or virtual appliance to install, no software to deploy, and no infrastructure to acquire and maintain.</p>
                    </div>
                </div>
            </div><!-- /.blocks -->
        </div>
    </div>
</div>
    <!-- //END Benefits of Hydra -->

<?php get_template_part('parts/solutions/prefooter');
