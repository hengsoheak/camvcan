<?php
/**
 * Sample implementation of the Custom Header feature.
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Acme Themes
 * @subpackage Mercantile
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses mercantile_header_style()
 */
function mercantile_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'mercantile_custom_header_args', array(
		'default-image'      => get_template_directory_uri() . '/assets/img/startup-slider.jpg',
		'width'              => 1920,
		'height'             => 1280,
		'flex-height'        => true,
		'header-text'        => false
	) ) );
	register_default_headers( array(
		'default-image' => array(
			'url'           => '%s/assets/img/startup-slider.jpg',
			'thumbnail_url' => '%s/assets/img/startup-slider.jpg',
			'description'   => __( 'Default Header Image', 'mercantile' ),
		),
	) );
}
add_action( 'after_setup_theme', 'mercantile_custom_header_setup' );