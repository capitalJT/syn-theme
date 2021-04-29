<?php get_template_part('next/header'); ?>

    <div id="app"></div>
    <?php SYN_write_page_data(SYN_get_page_data(get_post())); ?>
    <script src="https://boards.greenhouse.io/embed/job_board/js?for=synack"></script>

<?php get_template_part('next/footer'); ?>
