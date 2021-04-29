<?php
/**
 * Shortcode Class
 *
 * Simple class to add shortcodes
 *
 * @author  Mike Sawicki <msawicki@nerdery.com>
 * @package WordPress
 * @subpage Synack
 * @since   1.0.0
 */


class SYNShortcode
{
    /**
     * Constructor
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        add_shortcode( 'synack-tooltip', array(&$this, 'tooltip') );
    }

    public function tooltip($atts)
    {
        $a = shortcode_atts( array(
            'link' => '',
            'title' => '',
            'body' => '',
        ), $atts );

        $output = '';
        $id = rand(0,1000);
        $output .= '<span class="js-tooltip tooltip">';
        $output .= '<span class="js-tooltipLink tooltip-link" aria-describedby="tip-'.$id.'">'.$a['link'].'</span>';
            $output .= '<span id="tip-'.$id.'" class="js-tooltipTip tooltip-tip" role="tooltip" aria-hidden="true">';
                $output .= '<span class="tooltip-hd">'.$a['title'].'</span>';
                $output .= '<span class="tooltip-bd">'.$a['body'].'</span>';
            $output .= '</span>';
        $output .= '</span>';

        return $output;
    }


}

new SYNShortcode();