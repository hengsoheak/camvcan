<?php
/*adding sections for footer social options */
$wp_customize->add_section( 'mercantile-footer-social', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Social Options', 'mercantile' ),
    'panel'          => 'mercantile-footer-panel'
) );

/*enable social*/
$wp_customize->add_setting( 'mercantile_theme_options[mercantile-enable-social]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['mercantile-enable-social'],
    'sanitize_callback' => 'mercantile_sanitize_checkbox',
) );
$wp_customize->add_control( 'mercantile_theme_options[mercantile-enable-social]', array(
    'label'		=> __( 'Enable social', 'mercantile' ),
    'section'   => 'mercantile-footer-social',
    'settings'  => 'mercantile_theme_options[mercantile-enable-social]',
    'type'	  	=> 'checkbox',
    'priority'  => 100
) );