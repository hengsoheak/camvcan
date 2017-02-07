<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package Acme Themes
 * @subpackage Mercantile
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.me/support/infinite-scroll/
 * See: https://jetpack.me/support/responsive-videos/
 */

if ( ! function_exists( 'mercantile_jetpack_setup' ) ) :
	function mercantile_jetpack_setup() {
		// Add theme support for Infinite Scroll.
		add_theme_support( 'infinite-scroll', array(
			'container' => 'main',
			'render'    => 'mercantile_infinite_scroll_render',
			'footer'    => 'page',
		) );

		// Add theme support for Responsive Videos.
		add_theme_support( 'jetpack-responsive-videos' );
	}
endif;
add_action( 'after_setup_theme', 'mercantile_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
if ( ! function_exists( 'mercantile_jetpack_setup' ) ) :
	function mercantile_jetpack_setup() {
		while ( have_posts() ) {
			the_post();
			if ( is_search() ) :
				get_template_part( 'template-parts/content', 'search' );
			else :
				get_template_part( 'template-parts/content', get_post_format() );
			endif;
		}
	}
endif;
