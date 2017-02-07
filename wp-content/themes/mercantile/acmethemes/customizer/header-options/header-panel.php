<?php
/*adding header options panel*/
$wp_customize->add_panel( 'mercantile-header-panel', array(
    'priority'       => 160,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Header Options', 'mercantile' ),
    'description'    => __( 'Customize your awesome site header ', 'mercantile' )
) );

/*
* file for header top options
*/
require mercantile_file_directory('acmethemes/customizer/header-options/header-top.php');

/*
* file for header logo options
*/
require mercantile_file_directory('acmethemes/customizer/header-options/header-logo.php');

/*
* file for social options
*/
require mercantile_file_directory('acmethemes/customizer/header-options/social-options.php');

/*
 * file for menu options
*/
require mercantile_file_directory('acmethemes/customizer/header-options/menu-options.php');

/*adding header image inside this panel*/
$wp_customize->get_section( 'header_image' )->panel = 'mercantile-header-panel';
$wp_customize->get_section( 'header_image' )->description = __( 'Applied to header image of inner pages.', 'mercantile' );