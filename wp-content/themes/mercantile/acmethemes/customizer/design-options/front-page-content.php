<?php
/*adding sections for footer social options */
$wp_customize->add_section( 'mercantile-front-page-content', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Front Page Content Options', 'mercantile' ),
    'panel'          => 'mercantile-design-panel'

) );

/*enable social*/
$wp_customize->add_setting( 'mercantile_theme_options[mercantile-hide-front-page-content]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['mercantile-hide-front-page-content'],
    'sanitize_callback' => 'mercantile_sanitize_checkbox',
) );
$wp_customize->add_control( 'mercantile_theme_options[mercantile-hide-front-page-content]', array(
    'label'		 => __( 'Hide Front Page Content', 'mercantile' ),
    'description'=> __( 'You may want to hide front page content( Blog or Static page content). Check this to hide them', 'mercantile' ),
    'section'   => 'mercantile-front-page-content',
    'settings'  => 'mercantile_theme_options[mercantile-hide-front-page-content]',
    'type'	  	=> 'checkbox',
    'priority'  => 100
) );