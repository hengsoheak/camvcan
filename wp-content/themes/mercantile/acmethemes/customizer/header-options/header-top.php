<?php
/*active callback function for header top left*/
if ( !function_exists('mercantile_active_callback_header_top_left_email') ) :
    function mercantile_active_callback_header_top_left_email() {
        $mercantile_customizer_all_values = mercantile_get_theme_options();
        $mercantile_header_top_left_option = $mercantile_customizer_all_values['mercantile-header-top-left-option'];
        if( 'email' == $mercantile_header_top_left_option || 'both' == $mercantile_header_top_left_option ){
            return true;
        }
        return false;
    }
endif;

/*active callback function for header top left*/
if ( !function_exists('mercantile_active_callback_header_top_left_phone') ) :
    function mercantile_active_callback_header_top_left_phone() {
        $mercantile_customizer_all_values = mercantile_get_theme_options();
        $mercantile_header_top_left_option = $mercantile_customizer_all_values['mercantile-header-top-left-option'];
        if( 'phone' == $mercantile_header_top_left_option || 'both' == $mercantile_header_top_left_option ){
            return true;
        }
        return false;
    }
endif;

/*adding sections for header options*/
$wp_customize->add_section( 'mercantile-header-top-option', array(
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Header Top', 'mercantile' ),
    'panel'          => 'mercantile-header-panel',
) );

/*header top left options*/
$wp_customize->add_setting( 'mercantile_theme_options[mercantile-header-top-left-option]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['mercantile-header-top-left-option'],
    'sanitize_callback' => 'mercantile_sanitize_select'
) );
$choices = mercantile_header_top_left_options();
$wp_customize->add_control( 'mercantile_theme_options[mercantile-header-top-left-option]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Left Side Options', 'mercantile' ),
    'section'   => 'mercantile-header-top-option',
    'settings'  => 'mercantile_theme_options[mercantile-header-top-left-option]',
    'type'	  	=> 'select'
) );

/*phone number*/
$wp_customize->add_setting( 'mercantile_theme_options[mercantile-phone-number]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['mercantile-phone-number'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'mercantile_theme_options[mercantile-phone-number]', array(
    'label'		=> __( 'Phone Number', 'mercantile' ),
    'section'   => 'mercantile-header-top-option',
    'settings'  => 'mercantile_theme_options[mercantile-phone-number]',
    'type'	  	=> 'text',
    'active_callback'   => 'mercantile_active_callback_header_top_left_phone'
) );

/*Email*/
$wp_customize->add_setting( 'mercantile_theme_options[mercantile-top-email]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['mercantile-top-email'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'mercantile_theme_options[mercantile-top-email]', array(
    'label'		=> __( 'Email', 'mercantile' ),
    'section'   => 'mercantile-header-top-option',
    'settings'  => 'mercantile_theme_options[mercantile-top-email]',
    'type'	  	=> 'text',
    'active_callback'   => 'mercantile_active_callback_header_top_left_email'
) );

/*header top right options*/
$wp_customize->add_setting( 'mercantile_theme_options[mercantile-header-top-right-option]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['mercantile-header-top-right-option'],
    'sanitize_callback' => 'mercantile_sanitize_select'
) );
$choices = mercantile_header_top_right_options();
$wp_customize->add_control( 'mercantile_theme_options[mercantile-header-top-right-option]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Right Side Options', 'mercantile' ),
    'section'   => 'mercantile-header-top-option',
    'settings'  => 'mercantile_theme_options[mercantile-header-top-right-option]',
    'type'	  	=> 'select'
) );