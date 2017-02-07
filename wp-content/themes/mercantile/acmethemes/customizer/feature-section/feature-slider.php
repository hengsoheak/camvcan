<?php
/*adding sections for category section in front page*/
$wp_customize->add_section( 'mercantile-feature-page', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Feature Slider Selection', 'mercantile' ),
    'panel'          => 'mercantile-feature-panel'
) );

/* feature parent page selection */
$wp_customize->add_setting( 'mercantile_theme_options[mercantile-feature-page]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['mercantile-feature-page'],
    'sanitize_callback' => 'mercantile_sanitize_number'
) );
$wp_customize->add_control( 'mercantile_theme_options[mercantile-feature-page]', array(
    'label'		    => __( 'Select Parent Page for Feature Slider', 'mercantile' ),
    'description'	=> sprintf( __( 'Recommended to write short title, short content/excerpt and use featured image 1280*610 for the selected page below. If you want to show slider, the page you selected should have %s child pages %s', 'mercantile' ), '<a href="https://www.acmethemes.com/blog/2016/04/how-to-create-child-pages-sub-pages/" target="_blank">','</a>' ),
    'section'       => 'mercantile-feature-page',
    'settings'      => 'mercantile_theme_options[mercantile-feature-page]',
    'type'	  	    => 'dropdown-pages',
    'priority'      => 10
) );

/* number of slider*/
$wp_customize->add_setting( 'mercantile_theme_options[mercantile-featured-slider-number]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['mercantile-featured-slider-number'],
    'sanitize_callback' => 'mercantile_sanitize_select'
) );
$choices = mercantile_featured_slider_number();
$wp_customize->add_control( 'mercantile_theme_options[mercantile-featured-slider-number]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Number Of Slides', 'mercantile' ),
    'section'   => 'mercantile-feature-page',
    'settings'  => 'mercantile_theme_options[mercantile-featured-slider-number]',
    'type'	  	=> 'select',
    'priority'  => 20
) );


/*enable animation*/
$wp_customize->add_setting( 'mercantile_theme_options[mercantile-feature-slider-enable-animation]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['mercantile-feature-slider-enable-animation'],
    'sanitize_callback' => 'mercantile_sanitize_checkbox'
) );
$wp_customize->add_control( 'mercantile_theme_options[mercantile-feature-slider-enable-animation]', array(
    'label'		    => __( 'Enable Animation', 'mercantile' ),
    'section'       => 'mercantile-feature-page',
    'settings'      => 'mercantile_theme_options[mercantile-feature-slider-enable-animation]',
    'type'	  	    => 'checkbox',
    'priority'      => 125
) );

/*Slider Selection From*/
$wp_customize->add_setting( 'mercantile_theme_options[mercantile-feature-slider-text-align]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['mercantile-feature-slider-text-align'],
    'sanitize_callback' => 'mercantile_sanitize_select',
) );
$choices = mercantile_slider_text_align();
$wp_customize->add_control( 'mercantile_theme_options[mercantile-feature-slider-text-align]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Slider Text Align', 'mercantile' ),
    'section'       => 'mercantile-feature-page',
    'settings'  => 'mercantile_theme_options[mercantile-feature-slider-text-align]',
    'type'	  	=> 'select',
    'priority'  => 116
) );


/*know more text*/
$wp_customize->add_setting( 'mercantile_theme_options[mercantile-slider-know-more-text]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['mercantile-slider-know-more-text'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'mercantile_theme_options[mercantile-slider-know-more-text]', array(
    'label'		    => __( 'Slider Button Text', 'mercantile' ),
    'description'   => __( 'Left empty to disable slider button ', 'mercantile' ),
    'section'       => 'mercantile-feature-page',
    'settings'      => 'mercantile_theme_options[mercantile-slider-know-more-text]',
    'type'	  	    => 'text',
    'priority'      => 220
) );