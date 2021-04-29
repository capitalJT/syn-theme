<?php
    // add Journey options page
    if (function_exists('acf_add_options_page')){
        acf_add_options_page(array(
    		'page_title' 	=> 'Journey Settings',
    		'menu_title'	=> 'Journey'
    	));
    }

    // Add featured image support
    add_theme_support( 'post-thumbnails' );

    // load the correct number of resources on archive pages
    function modify_resources_query( $wp_query ) {
        // Commented out and replaced this line to resolve the following error message: Undefined index: post_type in /Users/jtorres/Sites/synack-marketing-site/wp-content/themes/synack/next/functions.php  on line 16
//        if ( $wp_query->query_vars['post_type'] != 'synack-resources' ) return;

        // This conditional resolved the error.
        if ( !is_page( 'Resources' ) ) return;
        $wp_query->query_vars['posts_per_page'] = get_option('posts_per_page');
    }
    add_filter( 'pre_get_posts', 'modify_resources_query' );

    // Get primary data for this page
    // and echo it as JSON
    function SYN_get_page_data($target_post){
        $page_data = array();

        // serialize posts if we're on an archive page
        if (is_home() || is_post_type_archive('synack-resources') || is_archive() || is_search() || is_category()) {
            // some basics
            $page_data = array(
                'isBlogPage'        => is_home(),
                'isResourcesPage'   => is_post_type_archive('synack-resources'),
                'isSinglePost'      => is_single(),
                'isSearch'          => is_search(),
                'isCategory'        => is_category(),
                'posts'             => array(),
                'featuredPosts'     => array(),
                'categories'        => array(),
                'resourceTypes'     => array(),
                'prevPostsLink'     => get_previous_posts_page_link(),
                'nextPostsLink'     => get_next_posts_page_link(),
                'blogLink'          => get_the_permalink(get_option('page_for_posts')),
                'options'       => get_fields('options')
            );

            // serialize all the posts and attach to page data
            if(have_posts()){
                while(have_posts()){
                    $post = get_post();
                    $page_data['posts'][] = apply_filters('SYN_serialize_post', $post);
                    the_post();
                }
            }

            // serialize featured posts
            $args = array(
                'posts_per_page'   => 5,
            	'category_name'    => 'featured'
            );
            $featured_posts = get_posts($args);

            // attach featured posts to page data
            $page_data['featuredPosts'] = array_map(function($item){
                return apply_filters('SYN_serialize_post', $item);
            }, $featured_posts);

            // categories
            $all_categories = get_categories();
            $page_data['categories'] = (array)array_map(function($cat){
                return array(
                    'name'      => $cat->cat_name,
                    'slug'      => $cat->slug,
                    'id'        => $cat->term_id,
                    'link'      => get_category_link($cat->term_id)
                );
            }, $all_categories);

            // resource types
            $all_resource_types = get_terms(array('taxonomy' => 'resource-type'));
            $page_data['resourceTypes'] = array_map(function($resource_type){
                return $resource_type->name;
            }, $all_resource_types);

        } else {
            // use default page serializer
            $page_data = apply_filters('SYN_serialize_post', $target_post);
        }

        // if we're a single post or resource, add related posts
        if (is_single() || is_singular('synack-resources')) {
            // get categories
            $cats = wp_get_post_categories($target_post->ID);

            $target_type = is_singular('synack-resources') ? 'synack-resources' : 'post';

            $args = array(
            	'posts_per_page'   => 3,
            	'cat'              => implode(',', $cats),
                'post__not_in'     => array($target_post->ID),
            	'post_type'        => $target_type,
            );
            $related = array_slice(get_posts( $args ), 0, 3);

            $page_data['related'] = array_map(function($item) {
                return apply_filters('SYN_serialize_post', $item);
            }, $related);
        }

        return $page_data;
    }

    function SYN_write_page_data($page_data){
        $json = json_encode($page_data);
        ob_start();
        ?>
            <script type='text/javascript'>
                /* <![CDATA[ */
                var pageData = <?php echo $json; ?>;
                /* ]]> */
            </script>
        <?php
        echo ob_get_clean();
    }

    // Utility used on array_filter to remove $key
    // with leading underscore ( _fails )
    function filter_leading_underscore( $key ){
        return ! preg_match('/^_/', $key);
    }

    // Function to serialize a single page/post
    function SYN_serialize_post( $target_post ){

        // Get all meta fields without leading underscore
        $meta = get_post_meta( $target_post->ID, '', true );
        $filtered_meta = array();
        if (is_array($meta)){
            $filtered_meta = array_filter( $meta, 'filter_leading_underscore', ARRAY_FILTER_USE_KEY );
        }

        setup_postdata($target_post);
        $excerpt = get_the_excerpt($target_post->ID);
        if ( !$excerpt ) {
            $content = get_post_field('post_content', $target_post->ID);
            $trimmed = apply_filters('wp_trim_excerpt', $content);
            $excerpt = apply_filters('the_excerpt', $trimmed);
        }
        $output = array(
            'author'        => get_the_author_meta('display_name', $target_post->post_author),
            'id'            => $target_post->ID,
            'title'         => get_the_title($target_post),
            'content'       => apply_filters('the_content', $target_post->post_content),
            'excerpt'       => $excerpt,
            'rawExcerpt'    => get_the_excerpt($target_post->ID),
            'permalink'     => get_permalink($target_post),
            'slug'          => $target_post->post_name,
            'relativePath'  => wp_make_link_relative( get_permalink($target_post) ),
            'meta'          => array_map( 'reset', $filtered_meta ),
            'options'       => get_fields('options'),
            'date'          => get_the_date('U', $target_post->ID),
            'template'      => $target_post->_wp_page_template,
            'isFrontPage'   => get_option('page_on_front') == $target_post->ID,
            'isBlogPage'    => is_home(),
            'date'          => get_the_date('U', $target_post->ID) * 1000,
            'isSingleResource'  => is_singular('synack-resources')
        );

        // if we have a featured image, add it
        if ( $thumbnail_id = get_post_thumbnail_id( $target_post->ID ) ){
            $output['featuredAttachment'] = apply_filters('SYN_serialize_attachment', get_post($thumbnail_id));
        }

        // Add terms
        $taxonomy_names = get_post_taxonomies($target_post->ID);
        foreach($taxonomy_names as $taxonomy_name) {
            $terms = wp_get_post_terms( $target_post->ID, $taxonomy_name);
            if( !empty($terms) ) {
                $output['terms'][$taxonomy_name] = $terms;
            }
        }

        // Add post type
        $output['postType'] = get_post_type($target_post);

        return $output;
    }
    add_filter('SYN_serialize_post', 'SYN_serialize_post', 1);


    // function to serialize a single attachment
    function SYN_serialize_attachment( $attachment ){
        $output = array();

        // get all sizes
        $sizes = array_merge(get_intermediate_image_sizes(), array('full'));

        // save alt text
        $alt_text = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
        if(empty($alt_text)) {
            // Try the caption if no alt text
            $alt_text = trim(strip_tags( $attachment->post_excerpt ));
        }
        if(empty($alt_text)) {
            // Try the title if no caption
            $alt_text = trim(strip_tags( $attachment->post_title ));
        }

        // Get all meta fields without leading underscore
        $meta = get_post_meta( $attachment->ID, '', true );
        $filtered_meta = array_filter( $meta, 'filter_leading_underscore', ARRAY_FILTER_USE_KEY );

        // Save attachment data
        $output['ID'] = $attachment->ID;
        $output['title'] = get_the_title($attachment->ID);
        $output['alt'] = $alt_text;
        $output['caption'] = trim(strip_tags( $attachment->post_excerpt ));
        $output['description'] = trim(strip_tags( $attachment->post_content ));
        $output['meta'] = array_map(function($i){ return $i[0]; }, $filtered_meta);

        // build out sizes
        foreach ( $sizes as $size ){
            $img_data = wp_get_attachment_image_src($attachment->ID, $size);

            $output['sizes'][$size] = array(
                'url'       => $img_data[0],
                'width'     => $img_data[1],
                'height'    => $img_data[2],
                'html'      => wp_get_attachment_image($attachment->ID, $size),
            );
        }

        // Add post type
        $output['postType'] = get_post_type($attachment);

        return $output;
    }
    add_filter('SYN_serialize_attachment', 'SYN_serialize_attachment', 1);

 /*
  * Serialize ACF content with get_field to respect ACF custom formatting
  */
     function serialize_custom_acf_content($post_data){
         // check to make sure we have ACF installed
         if (!function_exists('get_fields')){
             return $post_data;
         }
         // get ACF fields attached to target post
         $acf_fields = get_fields($post_data['id']);

         // prep to save serialized fields
         $post_data['acf'] = array();
         if( !empty($acf_fields) ){
             // serialize ACF fields
             foreach( $acf_fields as $name => $value ){
                 $post_data['acf'][$name] = $value;
             }
         }
         return $post_data;
     }
     add_filter('SYN_serialize_post', 'serialize_custom_acf_content', 5);

// Button shortcode - format:
// [button primary? text="Text" link="url"]
function SYN_register_button_shortcode( $atts ) {
	$a = shortcode_atts( array(
		'text' => 'Click Here',
        'link'  => '#url'
	), $atts );

    // figure out if we need the 'primary' class
    // (https://wordpress.stackexchange.com/a/250249/105855)
    $is_primary = is_int(array_search('primary', $atts));

    // build our class list
    $classes = "shortcode-button clip-button";
    if ($is_primary){
        $classes .= " primary";
    }

    ob_start(); ?>

    <a href="<?php echo $a['link']; ?>" class="<?php echo $classes; ?>">
        <span class="background"></span>
        <span class="text"><?php echo $a['text']; ?></span>
    </a>

    <?php

	return ob_get_clean();
}
add_shortcode( 'button', 'SYN_register_button_shortcode' );

// SRT feature shortcode - format:
// [srt-feature icon="ICON-NAME" title="title"]Text[/srt-feature]
function SYN_register_srt_feature_shortcode( $atts, $content = '' ) {
	$a = shortcode_atts( array(
		'icon' => '',
        'title'  => ''
	), $atts );

    ob_start(); ?>
    <div class="single-feature">
        <svg-<?php echo $a['icon']; ?>></svg-<?php echo $a['icon']; ?>>
        <div class="feature-description">
            <div class="title"><?php echo $a['title']; ?></div>
            <div class="content"><?php echo $content; ?></div>
        </div>
    </div>
    <?php

	return ob_get_clean();
}
add_shortcode( 'srt-feature', 'SYN_register_srt_feature_shortcode' );

// Product Pillar shortcode - format:
// [product-pillar icon="ICON-NAME" title="title"]Text[/product-pillar]
function SYN_register_product_pillar_shortcode( $atts, $content = '' ) {
	$a = shortcode_atts( array(
		'icon' => '',
        'title'  => ''
	), $atts );

    // map of available icon names
    $icon_map = array(
        'DESKTOP'       => 'svg-desktop-computer',
        'MOBILE'        => 'svg-mobile-phone',
        'SERVER'        => 'svg-server-stack',
        'CLIENT'        => 'svg-person',
        'RESEARCHER'    => 'svg-researcher',
        'PLUS'          => 'svg-icon-plus',
        'CLOUD'         => 'svg-icon-cloud'
    );

    ob_start(); ?>
    <div class="product-pillar-feature">
        <?php if (isset($icon_map[$a['icon']])): ?>
            <<?php echo $icon_map[$a['icon']]; ?>></<?php echo $icon_map[$a['icon']]; ?>>
        <?php endif; ?>
        <div class="feature-description">
            <div class="title"><?php echo $a['title']; ?></div>
            <div class="content"><?php echo custom_filter_shortcode_text($content); ?></div>
        </div>
    </div>
    <?php

	return ob_get_clean();
}
add_shortcode( 'product-pillar', 'SYN_register_product_pillar_shortcode' );


/**
 * Utility function to clean up the way WordPress auto formats text in a shortcode.
 *
 * @param string $text A stirng of HTML text
 */
    function custom_filter_shortcode_text($text = '') {
        // Replace all the poorly formatted P tags that WP adds by default.
        $tags = array("<p>", "</p>");
        $text = str_replace($tags, "\n", $text);
        // Remove any BR tags
        $tags = array("<br>", "<br/>", "<br />");
        $text = str_replace($tags, "", $text);
        // Add back in the P and BR tags again, this will remove empty ones
        return apply_filters('the_content', $text);
    }

/*
 * Output JSON data when requested
 */
	function SYN_output_api_data($wp){
        // detect if client is trying to get json
		$json_header = isset($_REQUEST['CONTENT_TYPE']) && $_SERVER['CONTENT_TYPE'] == 'application/json';
		$json_type = isset($_REQUEST['contentType']) && $_REQUEST['contentType'] == 'json';
        // if so...
		if ( $json_header || $json_type ){

            // notify client we are sending json
			header('Content-Type: application/json');

            // serialize 404 or data

            if (is_404()){
                $all_data = array('is404' => true);
            } else {
                $all_data = SYN_get_page_data(get_post());
            }

            // load data, encode, output
			echo json_encode($all_data);
			exit();
		}
	}
	add_action('wp', 'SYN_output_api_data');

/*
 * Set up 5 minute cron schedule to ping assertible webhook
 */
	function SYN_setup_cron_interval( $schedules ) {
		$schedules['five_minutes'] = array(
			'interval' => 300,
			'display' => __('Every Five Minutes')
		);
		return $schedules;
	}

    // Add 5 min interval to schedules
	add_filter( 'cron_schedules', 'SYN_setup_cron_interval' );

    // Define work function for cron
    function SYN_run_webhook_cron(){
        if ( get_option('SYN_content_has_updated') ){

            // Run webhook
            $assertible_hook = 'https://assertible.com/apis/f65e762c-c024-4ff1-a9a5-e0147d79ab6a/run?api_token=GEZb5Peyu21ef8Ar';
            wp_remote_get($assertible_hook);

            // Reset updated flag
            update_option('SYN_content_has_updated', false);
        }
    }

    // Hook cron to work function
    add_action( 'SYN_webhook', 'SYN_run_webhook_cron' );

    // Schedule cron if necessary
	if ( ! wp_next_scheduled( 'SYN_webhook' ) ) {
        wp_schedule_event( time(), 'five_minutes', 'SYN_webhook' );
	}

    // Update SYN_content_has_updated option to true
    function SYN_set_content_updated_option() {
        update_option('SYN_content_has_updated', true);
    }
    add_action( 'save_post', 'SYN_set_content_updated_option' );
