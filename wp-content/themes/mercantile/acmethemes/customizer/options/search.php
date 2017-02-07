<?php
/*adding sections for Search Placeholder*/
$wp_customize->add_section( 'mercantile-search', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Search', 'mercantile' ),
    'panel'          => 'mercantile-options'
) );

/*Search Placeholder*/
$wp_customize->add_setting( 'mercantile_theme_options[mercantile-search-placholder]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['mercantile-search-placholder'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'mercantile_theme_options[mercantile-search-placholder]', array(
    'label'		=> __( 'Search Placeholder', 'mercantile' ),
    'section'   => 'mercantile-search',
    'settings'  => 'mercantile_theme_options[mercantile-search-placholder]',
    'type'	  	=> 'text',
    'priority'  => 10
) );