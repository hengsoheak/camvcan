<?php
/*adding sections for footer background image*/
$wp_customize->add_section( 'mercantile-footer-bg-img', array(
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Footer Background Image', 'mercantile' ),
    'panel'          => 'mercantile-footer-panel',
) );

/*footer background image*/
$wp_customize->add_setting( 'mercantile_theme_options[mercantile-footer-bg-img]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['mercantile-footer-bg-img'],
    'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'mercantile_theme_options[mercantile-footer-bg-img]',
        array(
            'label'		=> __( 'Footer Background Image', 'mercantile' ),
            'section'   => 'mercantile-footer-bg-img',
            'settings'  => 'mercantile_theme_options[mercantile-footer-bg-img]',
            'type'	  	=> 'image',
            'priority'  => 10
        )
    )
);