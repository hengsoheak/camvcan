<?php
/**
 * The front-page template file.
 *
 * @package Acme Themes
 * @subpackage Mercantile
 * @since Mercantile 1.1.0
 */
get_header();
/**
 * mercantile_action_front_page hook
 * @since Mercantile 1.1.0
 *
 * @hooked mercantile_featured_slider -  10
 * @hooked mercantile_front_page -  20
 */
do_action( 'mercantile_action_front_page' );

get_footer();