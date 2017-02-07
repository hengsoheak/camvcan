<?php
/*header logo/text display options*/
$wp_customize->add_setting( 'mercantile_theme_options[mercantile-header-id-display-opt]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['mercantile-header-id-display-opt'],
    'sanitize_callback' => 'mercantile_sanitize_select'
) );
$choices = mercantile_header_id_display_opt();
$wp_customize->add_control( 'mercantile_theme_options[mercantile-header-id-display-opt]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Logo/Site Title-Tagline Display Options', 'mercantile' ),
    'section'   => 'title_tagline',
    'settings'  => 'mercantile_theme_options[mercantile-header-id-display-opt]',
    'type'	  	=> 'radio',
    'priority'  => 30
) );