<?php
    $wysiwyg_editor_id = get_sub_field('wysiwyg_editor_id');
    $wysiwyg_editor_classes = get_sub_field('wysiwyg_editor_classes');
    $wysiwyg_editor = get_sub_field('wysiwyg_editor', false, false);

    //remove_filter ('acf_the_content', 'wpautop');
?>
<div id="<?php if ($wysiwyg_editor_id){ echo $wysiwyg_editor_id;} ?>" class="module-wysiwyg <?php if ($wysiwyg_editor_classes){ echo $wysiwyg_editor_classes;} ?>">
    <?php echo $wysiwyg_editor; ?>
</div>