<?php
/**
 * Add Shortcode buttons to tinyMCE editor
 *
 * @author Mike Sawicki <mike@holycrapcreative.com>
 * @since 1.0.0
 * @package WordPress
 * @subpackage Synack
 */

class SYNTinymce
{

    /**
     * Constructor
     *
     * @since  1.0
     */
    public function __construct()
    {
        add_action(
            'init',
            array(&$this,'filters')
        );
    }

    /**
     * Add tinymce button filters
     *
     * @since 1.0
     */
    public function filters()
    {

        add_filter(
            'mce_external_plugins',
            array(&$this,'appendBtns')
        );

        add_filter(
            'mce_buttons',
            array(&$this, 'registerButtons')
        );
    }

    /**
     * Add shortcode buttons to TinyMCE
     *
     * @param  array $plugin_array
     * @return array
     * @since 1.0
     */
    public function appendBtns( $plugin_array )
    {
        $plugin_array['tooltip_btn'] = SYNACK_THEME_URI . '/lib/Theme/TinyMce/tinymce.js';

        return $plugin_array;
    }

    /**
     * Add buttons to tinymce button array
     *
     * @param  array $buttons array of buttons
     * @return array
     * @since  1.0
     */
    public function registerButtons( $buttons )
    {
        array_push( $buttons, 'tooltip_btn' );
        return $buttons;
    }

}

new SYNTinymce();