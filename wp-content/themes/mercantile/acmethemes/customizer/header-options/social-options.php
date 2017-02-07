<?php
/*adding sections for header social options */
$wp_customize->add_section( 'mercantile-header-social', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Social Options', 'mercantile' ),
    'panel'          => 'mercantile-header-panel'
) );

/*facebook url*/
$wp_customize->add_setting( 'mercantile_theme_options[mercantile-facebook-url]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['mercantile-facebook-url'],
    'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( 'mercantile_theme_options[mercantile-facebook-url]', array(
    'label'		=> __( 'Facebook url', 'mercantile' ),
    'section'   => 'mercantile-header-social',
    'settings'  => 'mercantile_theme_options[mercantile-facebook-url]',
    'type'	  	=> 'url',
    'priority'  => 10
) );

/*twitter url*/
$wp_customize->add_setting( 'mercantile_theme_options[mercantile-twitter-url]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['mercantile-twitter-url'],
    'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( 'mercantile_theme_options[mercantile-twitter-url]', array(
    'label'		=> __( 'Twitter url', 'mercantile' ),
    'section'   => 'mercantile-header-social',
    'settings'  => 'mercantile_theme_options[mercantile-twitter-url]',
    'type'	  	=> 'url',
    'priority'  => 20
) );

/*youtube url*/
$wp_customize->add_setting( 'mercantile_theme_options[mercantile-youtube-url]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['mercantile-youtube-url'],
    'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( 'mercantile_theme_options[mercantile-youtube-url]', array(
    'label'		=> __( 'Youtube url', 'mercantile' ),
    'section'   => 'mercantile-header-social',
    'settings'  => 'mercantile_theme_options[mercantile-youtube-url]',
    'type'	  	=> 'url',
    'priority'  => 30
) );

/*
 * plus.google url*/
$wp_customize->add_setting( 'mercantile_theme_options[mercantile-google-plus-url]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['mercantile-google-plus-url'],
    'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( 'mercantile_theme_options[mercantile-google-plus-url]', array(
    'label'		=> __( 'Google Plus Url', 'mercantile' ),
    'section'   => 'mercantile-header-social',
    'settings'  => 'mercantile_theme_options[mercantile-google-plus-url]',
    'type'	  	=> 'url',
    'priority'  => 40
) );