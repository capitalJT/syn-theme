<?php
/**
 * Template Name: Red Team
 *
 * @package WordPress
 * @subpackage Synack
 * @author John Robson <j@hn.digital>
 * @since 2.0
 */

    get_template_part('next/header');
?>

<div id="app"></div>
<?php SYN_get_page_data(get_post()); ?>

<?php
    get_template_part('next/footer');
