<?php
/**
 * Function describe for Tech Mag 
 * 
 * @package megamag
 */

add_action( 'wp_enqueue_scripts', 'megamag_enqueue_styles', 999 );
function megamag_enqueue_styles() {
  $parent_style = 'megamag-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'megamag-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style )
    );
    wp_enqueue_script('megamag-customscript', get_stylesheet_directory_uri() . '/js/megamag-customscript.js', array('jquery'));

}

function megamag_theme_setup() {
    
    load_child_theme_textdomain( 'megamag', get_stylesheet_directory() . '/languages' );
    
    add_image_size( 'firstmag-carousel', 278, 430, true );
    
    // Add Custom logo Support
		add_theme_support( 'custom-logo', array(
			'height'      => 100,
			'width'       => 400,
			'flex-height' => true,
			'flex-width'  => true,
		) );
		
		// Add Custom Background Support
		$args = array(
			'default-color' => 'ffffff',
		);
		add_theme_support( 'custom-background', $args );
    
}
add_action( 'after_setup_theme', 'megamag_theme_setup' );

// remove admin options

function megamag_admin_remove( $wp_customize ) {
    
    $wp_customize->remove_control( 'header-logo' );
    $wp_customize->remove_section( 'site_bg_section' );
}

add_action( 'customize_register', 'megamag_admin_remove', 100);

