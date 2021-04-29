<?php
/**
 * Template Part for resource filters
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 */
$categories = get_terms('resource-type');

?>
<div class="vR vR_x2">
    <div class="listingControls">
        <div class="listingControls-search">
            <form action="<?php echo esc_url( home_url() ) ;?>" method="get">
                <button type="submit" class="listingControls-search-form-icon"><span class="u-isVisuallyHidden">Search</span></button>
                <input type="search" maxlength="50" name="s" placeholder="Search for PDF, VIdeos ETC." class="field field_text mix-field_text_insetLg" />
                <input type="hidden" value="synack-resources" name="post_type" />
            </form>
        </div>

        <div class="listingControls-select">
            <form autocomplete="off">
                <div role="combobox" class="comboBox js-cardCollectionView-comboBoxView">
                    <label for="categoryFilter" class="u-isVisuallyHidden">Filter by Type</label>
                    <input readonly
                        type="text"
                        value="All Types"
                        id="categoryFilter"
                        aria-autocomplete="none"
                        aria-readonly="true"
                        class="comboBox-value js-comboBoxView-value"
                    />
                    <ul role="listbox" aria-expanded="false" class="comboBox-list js-comboBoxView-list">
                        <li role="option" tabindex="-1" data-category-id="0">All Types</li>
                        <?php foreach($categories as $cat){ ?>
                            <li role="option" tabindex="-1" data-category-id="<?php echo $cat->term_id;?>">
                                <?php echo $cat->name;?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </form>
        </div>
    </div>
</div>
