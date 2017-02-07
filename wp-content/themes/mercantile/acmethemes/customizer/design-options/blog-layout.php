<?php
/*adding sections for blog layout options*/
$wp_customize->add_section( 'mercantile-design-blog-layout-option', array(
    'priority'       => 30,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Default Blog/Archive Layout', 'mercantile' ),
    'panel'          => 'mercantile-design-panel'
) );

/*blog layout*/
$wp_customize->add_setting( 'mercantile_theme_options[mercantile-blog-archive-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['mercantile-blog-archive-layout'],
    'sanitize_callback' => 'mercantile_sanitize_select'
) );
$choices = mercantile_blog_layout();
$wp_customize->add_control( 'mercantile_theme_options[mercantile-blog-archive-layout]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Default Blog/Archive Layout', 'mercantile' ),
    'description'=> __( 'Image display options', 'mercantile' ),
    'section'   => 'mercantile-design-blog-layout-option',
    'settings'  => 'mercantile_theme_options[mercantile-blog-archive-layout]',
    'type'	  	=> 'select'
) );

/*Read More Text*/
$wp_customize->add_setting( 'mercantile_theme_options[mercantile-blog-archive-more-text]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['mercantile-blog-archive-more-text'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'mercantile_theme_options[mercantile-blog-archive-more-text]', array(
    'label'		=> __( 'Read More Text', 'mercantile' ),
    'section'   => 'mercantile-design-blog-layout-option',
    'settings'  => 'mercantile_theme_options[mercantile-blog-archive-more-text]',
    'type'	  	=> 'text'
) );
