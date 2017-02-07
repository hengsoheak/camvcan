<?php
/*Menu Section*/
$wp_customize->add_section( 'mercantile-menu-options', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Menu Options', 'mercantile' ),
    'panel'          => 'mercantile-header-panel'
) );

/*show menu*/
$wp_customize->add_setting( 'mercantile_theme_options[mercantile-enable-sticky]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['mercantile-enable-sticky'],
    'sanitize_callback' => 'mercantile_sanitize_checkbox'
) );

$wp_customize->add_control( 'mercantile_theme_options[mercantile-enable-sticky]', array(
    'label'		=> __( 'Enable Sticky', 'mercantile' ),
    'section'   => 'mercantile-menu-options',
    'settings'  => 'mercantile_theme_options[mercantile-enable-sticky]',
    'type'	  	=> 'checkbox',
    'priority'  => 20
) );

/*header logo/text display options*/
$wp_customize->add_setting( 'mercantile_theme_options[mercantile-menu-active-hover-options]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['mercantile-menu-active-hover-options'],
    'sanitize_callback' => 'mercantile_sanitize_select'
) );
$choices = mercantile_menu_active_hover_options();
$wp_customize->add_control( 'mercantile_theme_options[mercantile-menu-active-hover-options]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Menu Active/Hover Color Options', 'mercantile' ),
    'description'		=> __( 'Either change text color or change background color', 'mercantile' ),
    'section'   => 'mercantile-menu-options',
    'settings'  => 'mercantile_theme_options[mercantile-menu-active-hover-options]',
    'type'	  	=> 'select',
    'priority'  => 30
) );

/*disable sticky-menu*/
$wp_customize->add_setting( 'mercantile_theme_options[mercantile-enable-search]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['mercantile-enable-search'],
    'sanitize_callback' => 'mercantile_sanitize_checkbox'
) );
$wp_customize->add_control( 'mercantile_theme_options[mercantile-enable-search]', array(
    'label'		=> __( 'Enable Search On Menu', 'mercantile' ),
    'section'   => 'mercantile-menu-options',
    'settings'  => 'mercantile_theme_options[mercantile-enable-search]',
    'type'	  	=> 'checkbox',
    'priority'  => 70
) );

if( class_exists( 'WooCommerce' ) ){
    
    /*disable sticky-menu*/
    $wp_customize->add_setting( 'mercantile_theme_options[mercantile-enable-woo-cart]', array(
        'capability'		=> 'edit_theme_options',
        'default'			=> $defaults['mercantile-enable-woo-cart'],
        'sanitize_callback' => 'mercantile_sanitize_checkbox'
    ) );
    $wp_customize->add_control( 'mercantile_theme_options[mercantile-enable-woo-cart]', array(
        'label'		=> __( 'Enable WooCommerce Cart On Menu', 'mercantile' ),
        'section'   => 'mercantile-menu-options',
        'settings'  => 'mercantile_theme_options[mercantile-enable-woo-cart]',
        'type'	  	=> 'checkbox',
        'priority'  => 70
    ) );
    
}