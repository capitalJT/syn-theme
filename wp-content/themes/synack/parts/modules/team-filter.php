<?php
/**
 * Template Part for filter Team Module
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 */
$color = (get_sub_field('icon_and_button_color'))
            ? get_sub_field('icon_and_button_color')
            : '';
$btnClass = ($color == 'red')
            ? 'btn_red'
            : 'btn_primary';

if(get_sub_field('section_title')){ ?>
    <div class="vR vR_x4">
        <div class="heading">
            <h2 class="heading-bd">
                <?php echo get_sub_field('section_title'); ?>
            </h2>
            <div class="heading-ft">
                <div class="ruler ruler_center">
                    <div class="ruler-icon">
                        <span class="icon icon_ruler <?php if($color == 'red') echo 'mix-icon_ruler-red';?>">
                            <svg class="icon-inner">
                                <use xlink:href="#icon-ruler"></use>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<div class="grid">
    <div class="grid-col grid-col_8of10 mix-grid-col_prefix1of10 mix-grid-col_suffix1of10 js-teamView">

        <div class="vR vR_x3">
            <?php $terms = get_terms('departments');
            if($terms){ ?>
                <div role="combobox" class="comboBoxTabs js-teamView-comboBoxView">
                    <label for="categoryFilter" class="u-isVisuallyHidden">Filter by Category</label>
                    <input readonly
                        disabled
                        type="text"
                        value="Executive Team"
                        id="categoryFilter"
                        aria-autocomplete="none"
                        aria-readonly="true"
                        class="comboBoxTabs-value js-comboBoxView-value"
                    />
                    <ul role="listbox" aria-expanded="false" class="comboBoxTabs-list js-comboBoxView-list">
                        <?php foreach($terms as $dept) { ?>
                            <li role="option" tabindex="-1" data-category-id="<?php echo $dept->term_id;?>" class="comboBoxTabs-list-item"><?php echo $dept->name;?></li>
                        <?php } ?>
                    </ul>
                </div><!-- /.combobox -->
            <?php } ?>
        </div><!-- /.vR_x3 -->

        <div class="vR vR_x7">
            <?php if($terms){ ?>
                <ul class="js-teamView-panelList">
                    <?php foreach($terms as $dept) { ?>

                        <li data-department-id="<?php echo $dept->term_id; ?>" <?php if($dept->slug != 'executive-team') echo 'class="u-isHidden"'; ?>>
                            <?php $args = array(
                                'post_type' => 'synack-people',
                                'posts_per_page' => -1,
                                'post_status' => 'publish',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'departments',
                                        'field'    => 'slug',
                                        'terms'    => $dept->slug,
                                    ),
                                ),
                            );
                            $query = new WP_Query($args);

                            if($query->have_posts()){ ?>
                                <ul class="blocks mix-blocks_2to4 mix-blocks_tight">
                                    <?php while($query->have_posts()){
                                        $query->the_post();
                                        $meta = new SYNMeta(get_the_ID()); ?>
                                        <li>
                                            <a href="javascript:void(0);" class="infoTile <?php if($dept->slug == 'executive-team'){ ?>infoTile_hasModal js-teamView-executiveTeamMember<?php } ?>"
                                                <?php if($dept->slug == 'executive-team'){ ?>
                                                     data-modal-template="#executiveModal-inlineTpl"
                                                     data-modal-data='{"allowPageScroll": false}'
                                                 <?php } ?>
                                                 itemscope
                                                 itemtype="http://schema.org/Person"
                                                 tabindex="0">
                                                <div class="infoTile-content">

                                                    <div class="infoTile-content-name" itemprop="name">
                                                        <?php the_title();?>
                                                    </div>

                                                    <?php if($meta->getMeta('role')) {?>
                                                        <div class="infoTile-content-role" itemprop="jobTitle">
                                                            <?php echo $meta->getMeta('role');?>
                                                        </div>
                                                    <?php } ?>

                                                    <?php if($meta->getMeta('short_description')) {?>
                                                        <div class="infoTile-content-meta">
                                                            <p><?php echo $meta->getMeta('short_description');?></p>
                                                        </div>
                                                    <?php } ?>

                                                </div>

                                                <?php if($meta->getMeta('profile_image')) {

                                                    $img = SYNImages::getImageData($meta->getMeta('profile_image'));?>
                                                    <img src="<?php echo $img['urls']['peopleThumbnail'];?>" alt="<?php echo $img['alt'];?>" class="infoTile-figure" itemprop="image" />
                                                <?php } ?>

                                            </a>
                                        </li>
                                    <?php }
                                        wp_reset_postdata(); ?>
                                </ul>
                            <?php } ?>
                        </li>
                    <?php } //end foreach ?>
                </ul>
            <?php } //end if ?>
        </div>
    </div>
</div>

<?php if(get_sub_field('call_to_action_url') && get_sub_field('call_to_action_label')){ ?>
    <div class="vR">
        <div class="median median_center">
            <a href="<?php echo get_sub_field('call_to_action_url');?>" class="btn <?php echo $btnClass;?>">
                <?php echo get_sub_field('call_to_action_label') ?>
            </a>
        </div><!-- /.median -->
    </div><!-- /.vR -->
<?php }

get_template_part('parts/modules/modal');
