<?php 
/**
 * All the ajax functions thoughout the site.
 * For more on how Ajax is handled in WordPress read the Codex docs.
 * https://codex.wordpress.org/AJAX_in_Plugins
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0 
 * 
 */

/**
 * Add our AJAX actions
 * The 'loadMorePosts' part of this has to match the action sent over
 * by the ajax request. 
 *
 */
add_action('wp_ajax_loadMorePosts', 'SYNLoadingCallback');
add_action('wp_ajax_nopriv_loadMorePosts', 'SYNLoadingCallback');

add_action('wp_ajax_loadSearchResults', 'SYNSearchCallback');
add_action('wp_ajax_nopriv_loadSearchResults', 'SYNSearchCallback');

add_action('wp_ajax_loadPostByAuthor', 'SYNAuthorCallback');
add_action('wp_ajax_nopriv_loadPostByAuthor', 'SYNAuthorCallback');

/**
 * Our ajax function to load More posts
 * 
 * @return JSON Object
 */
function SYNLoadingCallback()
{
    $category = '';
    $page = absint($_POST['page']); //The page number to grab
    $posttype = sanitize_text_field($_POST['post_type']); //The post type we are getting

    $offset = '';

    //get the number of posts per page, default to the setting default
    switch ($posttype) {
        case 'synack-resources':
            $limit = get_option('options_resources_limit' );
            $label = '';
            break;
        case 'synack-projects':
            $limit = get_option('options_projects_limit' );
            $label = 'View Project';
            break;
        case 'synack-press':
            $limit = get_option('options_press_limit' );
            $label = 'Read Article';
            $offset = (get_option('options_press_limit') * ($page - 1)) + 3; //Limit * (page - 1) + offset number
            break;
        default:
            $limit = get_option('posts_per_page');
            $label = 'Read Article';
            break;
    }

    if(isset($_POST['cat'])){
        $category = absint( $_POST['cat'] );
    }

    $args = array(
        'post_type'   => $posttype,
        'post_status' => 'publish',
        'order'       => 'DESC',
        'orderby'     => 'date',
        'posts_per_page' => $limit,
    );

     // WordPress does not like offset and pagination parameters being used
     // together in queries so we cheat a little here when there needs to be
     // offset value, using offset instead of pagination.
    if(!empty($offset)){
        $args['offset'] = $offset;
    }else {
        $args['paged'] = $page;
    }

    //if we have a category id we need to check if it's a custom
    //taxonomy of just a default category
    if( ! empty($category) ) {
        if ('synack-press' === $posttype) {
            $args['tax_query'] = array(
                'relation'  => 'AND',
                array(
                    'taxonomy'         => 'release-type',
                    'field'            => 'id',
                    'terms'            => $category,
                    'operator'         => 'IN'
                )
            );

            if($page  === 1){
                $args['posts_per_page'] = 7;
                $args['offset'] = 0;
            }

            // If it's the first page only show seven
            if($page > 1){
                $args['offset'] = (get_option('options_press_limit') * ($page - 2)) + 7; //Limit * (page - 1) + offset number
            }


        } elseif ( 'synack-resources' === $posttype ) {
            $args['tax_query'] = array(
                'relation'  => 'AND',
                array(
                    'taxonomy'         => 'resource-type',
                    'field'            => 'id',
                    'terms'            => $category,
                    'operator'         => 'IN'
                )
            );
        } elseif ('post' === $posttype) {
            $args['cat'] = $category;
        }

    }

    $wp_query = new WP_Query( $args );
    
    $returnArray['results'] = array();
    
    if ( $wp_query->have_posts() ) {
       
        while ( $wp_query->have_posts() ) { $wp_query->the_post();
            global $post;
            $meta = new SYNMeta(get_the_ID());
            $resourceType = ''; 
            $author = '';
            $isResource = false;
            
            if($post->post_type == 'post'){
                $cats = wp_get_post_categories( get_the_ID(), array('fields' => 'ids'));
                $author =  get_the_author_meta('display_name', $post->post_author);
                $url = get_the_permalink();
            }elseif($post->post_type == 'synack-resources') {
                $isResource = true;
                if(wp_get_post_terms( get_the_ID(), 'resource-type', array('fields' => 'names') )){
                    $resourceType =  implode(' ',  wp_get_post_terms( get_the_ID(), 'resource-type', array('fields' => 'names') ));
                }
                $label = $meta->getMeta('call_to_action_label');
                $cats = wp_get_post_terms( get_the_ID(), 'resource-type', array('fields' => 'ids') );
                $url = ($meta->getMeta('call_to_action_url'))
                    ? $meta->getMeta('call_to_action_url')
                    : get_the_permalink();
            }elseif($post->post_type == 'synack-press') {
                $cats = wp_get_post_terms( get_the_ID(), 'release-type', array('fields' => 'ids') );
                $author =  get_the_author_meta('display_name', $post->post_author);
                $url = ($meta->getMeta('url_to_press_release'))
                    ? $meta->getMeta('url_to_press_release')
                    : get_the_permalink();
            }else{
                $cats = array();
                $url = get_the_permalink();
            }

            $result = array(
                'title' => get_the_title(),
                'datetime' => get_the_time('U'),
                'url' => $url,
                'description' => '',
                'thumbnail' => array(),
                'author' => $author,
                'label' => $label,
                'cats' => $cats,
                'postType' => $post->post_type,
                'isResource' => $isResource,
                'resourceType' => $resourceType
            );

            if($meta->getMeta('featured_thumbnail')){
                $imgData =  SYNImages::getImageData($meta->getMeta('featured_thumbnail'));
                $result['thumbnail']['url'] = $imgData['urls']['postThumbnail'];
                $result['thumbnail']['alt'] = $imgData['alt'];
                $result['bgImage'] =  $imgData['urls']['rectangleThumb'];
                $result['squareThumb'] = $imgData['urls']['pressSquareThumbnail'];
            }

            if($meta->getMeta('short_description')){
                $result['description'] =  $meta->getMeta('short_description'); 
            }

            $result['total_posts'] = SYNGetTotalPosts($posttype);
                
            array_push($returnArray['results'], $result);

        }
        //Send back json to be handled by the client-side
        wp_send_json($returnArray);
        wp_reset_postdata(); /* Restore original Post Data */
    } else {
        return false;
    }

   
    die(); // must die here. 
}

/**
 * Our ajax function to send back search results
 * 
 * @return JSON Object
 */
function SYNSearchCallback()
{
  
    $page       = absint($_POST['page']); //The page number to grab
    $posttype   = sanitize_text_field($_POST['post_type']); //The post type we are getting
    $query      = sanitize_text_field($_POST['s']);

    //get the number of posts per page, default to the setting default
    switch ($posttype) {
        case 'synack-resources':
            $limit = get_option('options_resources_limit' );
            $label = '';
            break;
        case 'synack-projects':
            $limit = get_option('options_projects_limit' );
            $label = 'View Project';
            break;
        case 'synack-press':
            $limit = get_option('options_press_limit' );
            $label = 'Read Article';
            break;
        default:
            $limit = get_option('posts_per_page');
            $label = 'Read Article';
            break;
    }

    $args = array(
        'post_type'      => $posttype,
        'post_status'    => 'publish',
        's'              => $query,
        'paged'          => $page,
        'posts_per_page' => $limit,
    );
    
    $wp_query = new WP_Query( $args );
    
    $returnArray['results'] = array();
    
    if ( $wp_query->have_posts() ) {
       
        while ( $wp_query->have_posts() ) { $wp_query->the_post();
            global $post;
            $meta = new SYNMeta(get_the_ID());
            $resourceType = '';

            $label = ($post->post_type == 'synack-resources') 
                ? $meta->getMeta('call_to_action_label')
                : $label;
            
            if($post->post_type == 'post'){
                $cats = wp_get_post_categories( get_the_ID(), array('fields' => 'ids'));
                $url = get_the_permalink();
            }elseif($post->post_type == 'synack-resources') {
                $resourceType =  explode(' ',  wp_get_post_terms( get_the_ID(), 'resource-type', array('fields' => 'name') )); 
                $cats = wp_get_post_terms( get_the_ID(), 'resource-type', array('fields' => 'ids') );
                $url = ($meta->getMeta('call_to_action_url'))
                    ? $meta->getMeta('call_to_action_url')
                    : get_the_permalink();
            }elseif($post->post_type == 'synack-press') {
                $cats = wp_get_post_terms( get_the_ID(), 'release-type', array('fields' => 'ids') );
                $url = ($meta->getMeta('url_to_press_release'))
                    ? $meta->getMeta('url_to_press_release')
                    : get_the_permalink();
            }else{
                $cats = array();
                $url = get_the_permalink();
            }


            $result = array(
                'title' => get_the_title(),
                'datetime' => get_the_time('U'),
                'url' => $url,
                'description' => '',
                'thumbnail' => array(),
                'author' => get_the_author_meta('display_name', $post->post_author),
                'label' => $label,
                'cats' => $cats,
                'resourceType' => $resourceType
            );


            if($meta->getMeta('featured_thumbnail')){
                $imgData =  SYNImages::getImageData($meta->getMeta('featured_thumbnail'));
                $result['thumbnail']['url'] = $imgData['urls']['postThumbnail'];
                $result['thumbnail']['alt'] = $imgData['alt'];
                $result['bgImage'] =  $imgData['urls']['rectangleThumb'];
            }

            if($meta->getMeta('short_description')){
                $result['description'] =  $meta->getMeta('short_description'); 
            }
                
            array_push($returnArray['results'], $result);
                
        }
        //Send back json to be handled by the client-side
        wp_send_json($returnArray);
    } else {
        return false;
    }
    wp_reset_postdata(); /* Restore original Post Data */
   
    die(); // must die here. 
}


/**
 * Our ajax function to send back author posts
 *
 * @return JSON Object
 */
function SYNAuthorCallback()
{

    $page       = absint($_POST['page']); //The page number to grab
    $author     = sanitize_text_field($_POST['author']);


    $label = 'Read Article';

    $args = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'paged'          => $page,
        'posts_per_page' => get_option('posts_per_page'),
        'author' => $author
    );

    $wp_query = new WP_Query( $args );

    $returnArray['results'] = array();

    if ( $wp_query->have_posts() ) {

        while ( $wp_query->have_posts() ) { $wp_query->the_post();
            global $post;
            $meta = new SYNMeta(get_the_ID());

            $url = get_the_permalink();

            $cats = wp_get_post_categories( get_the_ID(), array('fields' => 'ids'));

            $result = array(
                'title' => get_the_title(),
                'datetime' => get_the_time('U'),
                'url' => $url,
                'thumbnail' => array(),
                'author' => get_the_author_meta('display_name', $post->post_author),
                'label' => $label,
                'cats' => $cats,
            );


            if($meta->getMeta('featured_thumbnail')){
                $imgData =  SYNImages::getImageData($meta->getMeta('featured_thumbnail'));
                $result['thumbnail']['url'] = $imgData['urls']['postThumbnail'];
                $result['thumbnail']['alt'] = $imgData['alt'];
                $result['bgImage'] =  $imgData['urls']['rectangleThumb'];
            }

            if($meta->getMeta('short_description')){
                $result['description'] =  $meta->getMeta('short_description');
            }

            array_push($returnArray['results'], $result);

        }
        //Send back json to be handled by the client-side
        wp_send_json($returnArray);
    } else {
        return false;
    }
    wp_reset_postdata(); /* Restore original Post Data */

    die(); // must die here.
}
