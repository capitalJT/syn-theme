<?php
// LP Synack Red Team Options - ACF Field Group
$synack_red_logo_options = get_field('synack_red_logo_options');

if ($synack_red_logo_options) {
    $lp_footer_logo = '/wp-content/themes/synack/assets/media/images/lp/Synack-SRT-logomark.png';
} else {
    $lp_footer_logo = '/wp-content/themes/synack/assets/media/images/lp/synack-logo.svg';
}
?>

<?php get_template_part('parts/shared/footer'); ?>
<?php wp_footer(); ?>

</body>
</html>