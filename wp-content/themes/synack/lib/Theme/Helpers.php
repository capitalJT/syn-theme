<?php
/**
 * A few general helper functions to be used throughout the site.
 *
 * @package WordPress
 * @subpackage Synack
 * @since 1.0
 * @author Mike Sawicki <msawicki@nerdery.com>
 */


/**
 * Get Minutes to Read
 * @param  String $content HTML content
 * @return Interger        Number of Minutes to read
 *
 */
function SYNGetMinutesToRead($content)
{

    //Count the number of words in the content
    $numberOfWords = str_word_count(strip_tags($content));

    //Average person reads 200 to 300 wpm
    $minutes = floor($numberOfWords / 200);
    $seconds = floor($numberOfWords % 200 / (200 / 60));

    //Round up the seconds
    if($seconds >= 30) {
        $minutes = $minutes + 1;
    }

    //Make sure we at least return 1 if it takes less than a minute to read
    if($minutes < 1) {
        $minutes = 1;
    }

    return $minutes;
}

/**
 * Get sticky posts from site options
 *
 * @param  Interger $count The current loop count
 * @return String The html of the social post
 */
function SYNGetStickySocialPosts($count, $redteamOnly = false)
{
    $url = '';
    $class = '';
    $text = '';

    if($redteamOnly) {
        if($count == 2) {
            //If we are only on the R&D page and it's the second post, add the Red Team stuff
            $url = get_option('options_sticky_post_red_team');
            $url = get_permalink($url);
            $class = 'tile_redTeam';
            $text = '<div class="tile-hd">Join the</div> <div class="tile-bd">Synack Red Team</div><div class="tile-ft"><span class="btn btn_mutedArrow">Learn More</span></div>';
        }
    }else{
        switch ($count) {
            case 3:
                $url = get_option('options_sticky_post_facebook');
                $class = 'tile_facebook';
                $text = '<div class="tile-hd">Follow Us On</div> <div class="tile-bd">Facebook</div>';
                break;
            case 6:
                $url = get_option('options_sticky_post_twitter');
                $class = 'tile_twitter';
                $text = '<div class="tile-hd">Follow Us On</div> <div class="tile-bd">Twitter</div>';
                break;
            case 7:
                $url = get_option('options_sticky_post_red_team');
                $url = get_permalink($url);
                $class = 'tile_redTeam';
                $text = '<div class="tile-hd">Join the</div> <div class="tile-bd">Synack Red Team</div><div class="tile-ft"><span class="btn btn_mutedArrow">Read Article</span></div>';
                break;
            case 9:
                $url = get_option('options_sticky_post_linkedin');
                $class = 'tile_linkedIn';
                $text = '<div class="tile-hd">Follow Us On</div> <div class="tile-bd">LinkedIn</div>';
                break;
        }
    }

    if(!empty($url)){ ?>
        <li>
            <div class="box box_thin">

                <a href="<?php echo $url;?>" target="_blank" class="tile <?php echo $class;?>">
                    <?php echo $text; ?>
                </a>

            </div>

        </li>
    <?php }
}

/**
 * Helper function to loop through all the conditions
 * to display the page title
 * @return String Page title
 */
function SYNGetPageTitleTag()
{
    global $post;
    if(is_home()){
        if(get_post_meta(get_option('page_for_posts'), 'title_tag', true)){
            echo esc_html(get_post_meta(get_option('page_for_posts'), 'title_tag', true));
        }else {
            wp_title();
        }
    }elseif(!is_tax() && !is_category() && !is_search()) {
        if(isset($post->ID) && get_post_meta($post->ID, 'title_tag', true)){
            echo esc_html(get_post_meta($post->ID, 'title_tag', true));
        }elseif(get_query_var('projectAuthor')) {
            $curauth = get_user_by('id', esc_html( get_query_var('projectAuthor') ));
            echo 'Projects by '. $curauth->display_name;
        }else {
            wp_title('-');
        }
    }else {
        wp_title('-');
    }

}

/**
 * Function to alter the default WordPress title
 */
function alter_wordpress_title( $title, $sep ) {
    return get_bloginfo('name') . $title;
}
add_filter('wp_title', 'alter_wordpress_title', 10, 2);

/**
 * Helper function to display the user defined meta Description
 *
 * @return String The meta description
 */
function SYNGetMetaDescription()
{
    global $post;

    if(isset($post->ID) && get_post_meta($post->ID, 'meta_description', true )) {
        echo '<meta name="description" content="'.esc_html(get_post_meta($post->ID, 'meta_description', true )).'">';
    }
}

/**
 * Helper function that cleans up looking for red page
 *
 * @return Boolean
 */
 function SYNIsRedTeamPage()
 {
     return (is_page_template('page-redTeam.php'))
         ? true
         : false;
 }
 /**
 * Helper function that cleans up looking for red page blank
 *
 * @return Boolean
 */
function SYNIsRedTeamBlank()
 {
     return (is_page_template('pageDark.php'))
         ? true
         : false;
 }


/**
 * Helper function to get total post count
 *
 * @param $postType The post type
 * @param $category The category, default null
 * @return Integer Number of posts
 *
 */
 function SYNGetTotalPosts($postType, $category = null)
 {
     $args = array(
         'posts_per_page' => -1,
         'post_type' => $postType,
         'post_status' => 'publish'
     );
     if( !empty( $category ) ){
         $args['cat'] = $category;
     }
     $query = new WP_Query($args);
     return $query->found_posts;

 }

function SYNAddExtraQueryVarsIfYouTube($maybeYoutube) {
    // use preg_match to find iframe src
    preg_match('/src="(.+?)"/', $maybeYoutube, $matches);
    $src = $matches[1];
    //if this is not a youtube video return early
    if ( ! strpos($src, 'youtu.be') && ! strpos($src, 'youtube.com')  ) {
        return $maybeYoutube;
    }
    // add extra params to iframe src
    $params = array(
        'controls' => 1,
        'showinfo' => 0,
        'autoplay' => 0,
        'modestbranding' => 1,
        'theme' => 'light',
        'color' => 'white',
        'vq' => 'hd720',
        'rel' => 0,
        'enablejsapi' => 1,
    );

    $new_src = add_query_arg($params, $src);

    $maybeYoutube = str_replace($src, $new_src, $maybeYoutube);

    // add extra attributes to iframe html
    $attributes = 'frameborder="0"';

    $maybeYoutube = str_replace('></iframe>', ' ' . $attributes . '></iframe>',$maybeYoutube);

    return $maybeYoutube;
}
