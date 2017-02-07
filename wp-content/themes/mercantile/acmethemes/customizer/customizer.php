<?php
/**
 * Mercantile Theme Customizer.
 *
 * @package Acme Themes
 * @subpackage Mercantile
 */

/*
* file for upgrade to pro
*/
require mercantile_file_directory('acmethemes/customizer/customizer-pro/class-customize.php');

/*
* file for customizer core functions
*/
require mercantile_file_directory('acmethemes/customizer/customizer-core.php');

/*
* file for customizer sanitization functions
*/
require mercantile_file_directory('acmethemes/customizer/sanitize-functions.php');

/**
 * Adding different options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if ( !function_exists('mercantile_customize_register') ) :
    function mercantile_customize_register( $wp_customize ) {

        $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
        $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

        /*saved options*/
        $options  = mercantile_get_theme_options();

        /*defaults options*/
        $defaults = mercantile_get_default_theme_options();

        /*
         * file for feature panel of home page
         */
        require mercantile_file_directory('acmethemes/customizer/feature-section/feature-panel.php');

        /*
        * file for header panel
        */
        require mercantile_file_directory('acmethemes/customizer/header-options/header-panel.php');

        /*
        * file for customizer footer section
        */
        require mercantile_file_directory('acmethemes/customizer/footer-options/footer-panel.php');

        /*
        * file for design/layout panel
        */
        require mercantile_file_directory('acmethemes/customizer/design-options/design-panel.php');

        /*
         * file for options panel
         */
        require mercantile_file_directory('acmethemes/customizer/options/options-panel.php');
    }
endif;

add_action( 'customize_register', 'mercantile_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if ( !function_exists('mercantile_customize_preview_js') ) :

    function mercantile_customize_preview_js() {
        wp_enqueue_script( 'mercantile-customizer', get_template_directory_uri() . '/acmethemes/core/js/customizer.js', array( 'customize-preview' ), '1.1.0', true );
    }
endif;

add_action( 'customize_preview_init', 'mercantile_customize_preview_js' );