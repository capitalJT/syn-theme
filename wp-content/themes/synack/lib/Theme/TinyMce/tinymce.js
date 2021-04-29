/**
 * Adds shortcode buttons to tinyMCE
 *
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0.0
 */

( function() {

    // Register plugin
    tinymce.create( 'tinymce.plugins.synTinyMceBtns', {

        init: function( editor, url )  {

            editor.addButton( 'tooltip_btn', {
                image: url + '/icon-tooltip.png',
                tooltip: 'Insert Tooltip',
                cmd: 'tooltip_command'
            });


            editor.addCommand( 'tooltipls_command', function() {
                // Calls the pop-up modal
                editor.windowManager.open( {
                    title: 'Insert ToolTip',
                    body: [
                        {
                            type: 'textbox',
                            name: 'link',
                            label: 'Tooltip Link'
                        },
                        {
                            type: 'textbox',
                            name: 'title',
                            label: 'Tooltip Title'
                        },
                        {
                            type: 'textbox',
                            name: 'body',
                            label: 'Tooltip Body'
                        }
                    ],
                    onsubmit: function( e ) {
                        editor.insertContent( '[synack-tooltip link="' + e.data.link + '" title="' + e.data.title + '" body="' + e.data.body + '"]');
                    }
                });

            });


        }

    });

    tinymce.PluginManager.add( 'tooltip_btn', tinymce.plugins.synTinyMceBtns );

})();


