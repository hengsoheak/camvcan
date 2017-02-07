<?php
/*adding sections for enabling feature section in front page*/
$wp_customize->add_section( 'mercantile-enable-feature', array(
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Enable Feature Section', 'mercantile' ),
    'panel'          => 'mercantile-feature-panel'
) );

/*enable feature section*/
$wp_customize->add_setting( 'mercantile_theme_options[mercantile-enable-feature]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['mercantile-enable-feature'],
    'sanitize_callback' => 'mercantile_sanitize_checkbox'
) );

$wp_customize->add_control( 'mercantile_theme_options[mercantile-enable-feature]', array(
    'label'		=> __( 'Enable Feature Section', 'mercantile' ),
    'description'	=> __( 'Feature section will display on front/home page.', 'mercantile' ),
    'section'   => 'mercantile-enable-feature',
    'settings'  => 'mercantile_theme_options[mercantile-enable-feature]',
    'type'	  	=> 'checkbox',
    'priority'  => 10
) );