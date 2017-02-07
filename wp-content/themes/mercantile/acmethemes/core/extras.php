<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package AcmeThemes
 * @subpackage Mercantile
 */

/**
 * Adds custom classes to the array of body classes.
 * @package Acme Themes
 * @subpackage Mercantile
 * @param array $classes Classes for the body element.
 * @return array
 */
if ( ! function_exists( 'mercantile_body_classes' ) ) :
	function mercantile_body_classes( $classes ) {
		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		return $classes;
	}
endif;
add_filter( 'body_class', 'mercantile_body_classes' );
