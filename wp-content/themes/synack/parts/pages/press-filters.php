<?php
/**
 * Template Part for Press Room Filter Section
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 */
$categories = get_terms('release-type');
?>


    <div class="vR vR_x3">
        <div class="listingControls listingControls_2up">

            <div role="combobox" class="comboBoxTabs comboBoxTabs_noBorders comboBoxTabs_blockOnSm listingControls-tabs js-pressView-comboBoxView">
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
                <ul role="listbox" aria-expanded="false" class="comboBoxTabs-list comboBoxTabs-list_centered js-comboBoxView-list">
                    <li role="option" tabindex="-1" data-category-id="0" class="comboBoxTabs-list-item isActive">All</li>
                    <?php foreach($categories as $cat){ ?>
                        <li role="option" tabindex="-1" data-category-id="<?php echo $cat->term_id;?>" class="comboBoxTabs-list-item">
                            <?php echo $cat->name;?>
                        </li>
                    <?php } ?>
                </ul>
            </div>

            <div class="listingControls-search">
                <form action="<?php echo esc_url( home_url() ) ;?>" method="get">
                    <input type="hidden" value="synack-press" name="post_type" />
                    <button type="submit" class="listingControls-search-form-icon"><span class="u-isVisuallyHidden">Search</span></button>
                    <input type="search" maxlength="50" name="s" placeholder="Search" class="field field_text mix-field_text_insetSlim" />
                </form>
            </div>
        </div>
    </div>
