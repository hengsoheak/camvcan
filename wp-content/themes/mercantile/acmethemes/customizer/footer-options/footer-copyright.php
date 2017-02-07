<?php
/*adding sections for footer options*/
$wp_customize->add_section( 'mercantile-footer-option', array(
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Copyright Text', 'mercantile' ),
    'panel'          => 'mercantile-footer-panel',
) );

/*copyright*/
$wp_customize->add_setting( 'mercantile_theme_options[mercantile-footer-copyright]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['mercantile-footer-copyright'],
    'sanitize_callback' => 'wp_kses_post'
) );
$wp_customize->add_control( 'mercantile_theme_options[mercantile-footer-copyright]', array(
    'label'		=> __( 'Copyright Text', 'mercantile' ),
    'section'   => 'mercantile-footer-option',
    'settings'  => 'mercantile_theme_options[mercantile-footer-copyright]',
    'type'	  	=> 'text',
    'priority'  => 10
) );