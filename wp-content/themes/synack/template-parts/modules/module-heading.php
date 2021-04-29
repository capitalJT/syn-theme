<?php
    $heading_tag = get_sub_field('heading_tag');
    $heading_style_utility_class = get_sub_field('heading_style_utility_class');
    $heading_text = get_sub_field('heading_text');
    $heading_text_align = get_sub_field('heading_text_align');
    $heading_margin_top = get_sub_field('heading_margin_top');
    $heading_margin_bottom = get_sub_field('heading_margin_bottom');
?>
<div class="module-heading" style="margin-top: <?php echo $heading_margin_top;?>px; margin-bottom: <?php echo $heading_margin_bottom;?>px;">
    <div class="synack-container">
        <?php
            $heading_text_align_class = "";
            if ( $heading_text_align == 'left' ) {
                $heading_text_align_class = "text-align-left";
            } elseif ( $heading_text_align == 'center' ) {
                $heading_text_align_class = "text-align-center";
            } elseif ( $heading_text_align == 'right' ) {
                $heading_text_align_class = "text-align-right";
            }

            $heading_size_utility_class = "";
            if ( $heading_style_utility_class == 'h1' ) {
                $heading_size_utility_class = "h1";
            } elseif ( $heading_style_utility_class == 'h2' ) {
                $heading_size_utility_class = "h2";
            } elseif ( $heading_style_utility_class == 'h3' ) {
                $heading_size_utility_class = "h3";
            } elseif ( $heading_style_utility_class == 'h4' ) {
                $heading_size_utility_class = "h4";
            } elseif ( $heading_style_utility_class == 'h5' ) {
                $heading_size_utility_class = "h5";
            } elseif ( $heading_style_utility_class == 'h6' ) {
                $heading_size_utility_class = "h6";
            }

            if ( $heading_tag == 'h1' ) {
                echo '<h1 class="'. $heading_text_align_class ." ". $heading_size_utility_class .'">' . $heading_text . '</h1>';
            } elseif ( $heading_tag == 'h2' ){
                echo '<h2 class="'. $heading_text_align_class ." ". $heading_size_utility_class .'">' . $heading_text . '</h2>';
            } elseif ( $heading_tag == 'h3' ){
                echo '<h3 class="'. $heading_text_align_class ." ". $heading_size_utility_class .'">' . $heading_text . '</h3>';
            } elseif ( $heading_tag == 'h4' ){
                echo '<h4 class="'. $heading_text_align_class ." ". $heading_size_utility_class .'">' . $heading_text . '</h4>';
            } elseif ( $heading_tag == 'h5' ){
                echo '<h5 class="'. $heading_text_align_class ." ". $heading_size_utility_class .'">' . $heading_text . '</h5>';
            } elseif ( $heading_tag == 'h6' ){
                echo '<h6 class="'. $heading_text_align_class ." ". $heading_size_utility_class .'">' . $heading_text . '</h6>';
            }
        ?>
    </div>
</div>

