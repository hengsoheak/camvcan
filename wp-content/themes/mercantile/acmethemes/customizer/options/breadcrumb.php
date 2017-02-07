<?php
/*adding sections for breadcrumb */
$wp_customize->add_section( 'mercantile-breadcrumb-options', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Breadcrumb Options', 'mercantile' ),
    'panel'          => 'mercantile-options'
) );

/*show breadcrumb*/
$wp_customize->add_setting( 'mercantile_theme_options[mercantile-show-breadcrumb]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['mercantile-show-breadcrumb'],
    'sanitize_callback' => 'mercantile_sanitize_checkbox'
) );

$wp_customize->add_control( 'mercantile_theme_options[mercantile-show-breadcrumb]', array(
    'label'		=> __( 'Enable Breadcrumb', 'mercantile' ),
    'section'   => 'mercantile-breadcrumb-options',
    'settings'  => 'mercantile_theme_options[mercantile-show-breadcrumb]',
    'type'	  	=> 'checkbox',
    'priority'  => 10
) );