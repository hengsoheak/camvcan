<?php
/*adding feature options panel*/
$wp_customize->add_panel( 'mercantile-feature-panel', array(
    'priority'       => 160,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Featured Section Options', 'mercantile' ),
    'description'    => __( 'Customize your awesome site feature section ', 'mercantile' )
) );

/*
* file for feature section enable
*/
require mercantile_file_directory('acmethemes/customizer/feature-section/feature-enable.php');

/*
* file for feature slider category
*/
require mercantile_file_directory('acmethemes/customizer/feature-section/feature-slider.php');