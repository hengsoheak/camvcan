<?php
/*customizing default colors section and adding new controls-setting too*/
$wp_customize->add_section( 'colors', array(
    'priority'       => 40,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Colors', 'mercantile' ),
    'panel'          => 'mercantile-design-panel'
) );
/*Primary color*/
$wp_customize->add_setting( 'mercantile_theme_options[mercantile-primary-color]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['mercantile-primary-color'],
    'sanitize_callback' => 'sanitize_hex_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'mercantile_theme_options[mercantile-primary-color]',
        array(
            'label'		=> __( 'Primary Color', 'mercantile' ),
            'section'   => 'colors',
            'settings'  => 'mercantile_theme_options[mercantile-primary-color]',
            'type'	  	=> 'color'
        ) )
);