<?php
/**
 * Image Helper Class
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 */
class SYNImages
{
    /**
     * GetImageData
     *
     * Gets the image data based on an attachment ID
     * 
     * @param  int   $ID  The attachment ID
     * @return array      The image meta array
     * @since 1.0
     */
    public static function getImageData($ID)
    {
        $meta       = array();

        if(!wp_attachment_is_image($ID)) {
            return false;
        }

        $slugs = get_intermediate_image_sizes();
        $image = get_post($ID);

        $meta['title']          = $image->post_title;
        $meta['caption']        = $image->post_excerpt;
        $meta['description']    = $image->post_content;
        $meta['alt']            = get_post_meta($image->ID, '_wp_attachment_image_alt', true);
        $meta['href']           = get_permalink($image->ID);
        $meta['src']            = $image->guid;

        foreach($slugs as $slug) {

            $img = wp_get_attachment_image_src($image->ID, $slug);

            $meta['sizes'][$slug] = array(
                'width' => $img[1],
                'height' => $img[2],
            );

            $meta['urls'][$slug] = $img[0];
        }

        return $meta;
    }

    
    /**
     * getImageURL
     *
     * return image url based on size and ID
     * 
     * @param  int    $imageID Image attachment ID
     * @param  string $size    The image size
     * @return string          Image URL
     * @since 1.0
     */
    public static function getImageURL($imageID, $size)
    {
        $imageData = self::getImageData($imageID);
        if(isset($imageData['urls'][$size]))
            return $imageData['urls'][$size];
    }
}
