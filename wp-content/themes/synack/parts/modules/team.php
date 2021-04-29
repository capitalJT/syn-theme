<?php
/**
 * Template Part for team toggle
 *
 * @package WordPress
 * @subpackage Synack
 * @author Mike Sawicki <msawicki@nerdery.com>
 * @since 1.0
 */
if(get_sub_field('team_category')){
    get_template_part('parts/modules/team', 'single' );
}else {
    get_template_part('parts/modules/team', 'filter' );
}
