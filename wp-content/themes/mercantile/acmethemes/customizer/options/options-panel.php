<?php
/*adding theme options panel*/
$wp_customize->add_panel( 'mercantile-options', array(
    'priority'       => 210,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Theme Options', 'mercantile' ),
    'description'    => __( 'Customize your awesome site with theme options ', 'mercantile' )
) );

/*
* file for header breadcrumb options
*/
require mercantile_file_directory('acmethemes/customizer/options/breadcrumb.php');


/*
* file for header search options
*/
require mercantile_file_directory('acmethemes/customizer/options/search.php');
