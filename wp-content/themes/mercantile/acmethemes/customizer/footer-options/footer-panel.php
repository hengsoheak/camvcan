<?php
/*adding footer options panel*/
$wp_customize->add_panel( 'mercantile-footer-panel', array(
    'priority'       => 170,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Footer Options', 'mercantile' ),
    'description'    => __( 'Customize your awesome site footer ', 'mercantile' )
) );

/*
* file for footer background
*/
require mercantile_file_directory('acmethemes/customizer/footer-options/footer-bg-img.php');

/*
* file for footer copyright
*/
require mercantile_file_directory('acmethemes/customizer/footer-options/footer-copyright.php');

/*
* file for footer social
*/
require mercantile_file_directory('acmethemes/customizer/footer-options/social-options.php');