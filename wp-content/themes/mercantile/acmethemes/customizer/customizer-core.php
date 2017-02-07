<?php
/**
 * Header Top Left Options
 *
 * @since Mercantile 1.0.0
 *
 * @param null
 * @return array $mercantile_header_top_left_options
 *
 */
if ( !function_exists('mercantile_header_top_left_options') ) :
    function mercantile_header_top_left_options() {
        $mercantile_header_top_left_options =  array(
            'email' => __( 'Email', 'mercantile' ),
            'phone' => __( 'Phone', 'mercantile' ),
            'both' =>  __( 'Both', 'mercantile' ),
            'none' =>  __( 'None', 'mercantile' )
        );
        return apply_filters( 'mercantile_header_top_left_options', $mercantile_header_top_left_options );
    }
endif;

/**
 * Header Top Right Options
 *
 * @since Mercantile 1.0.0
 *
 * @param null
 * @return array $mercantile_header_top_right_options
 *
 */
if ( !function_exists('mercantile_header_top_right_options') ) :
    function mercantile_header_top_right_options() {
        $mercantile_header_top_right_options =  array(
            'social' => __( 'Social Links', 'mercantile' ),
            'none' =>  __( 'None', 'mercantile' )
        );
        return apply_filters( 'mercantile_header_top_right_options', $mercantile_header_top_right_options );
    }
endif;

/**
 * Header Top Left Options
 *
 * @since Mercantile 1.0.0
 *
 * @param null
 * @return array $mercantile_menu_active_hover_options
 *
 */
if ( !function_exists('mercantile_menu_active_hover_options') ) :
    function mercantile_menu_active_hover_options() {
        $mercantile_menu_active_hover_options =  array(
            'bg-color' => __( 'Background Color', 'mercantile' ),
            'text-color' => __( 'Text Color', 'mercantile' )
        );
        return apply_filters( 'mercantile_menu_active_hover_options', $mercantile_menu_active_hover_options );
    }
endif;

/**
 * Featured Slider Number
 *
 * @since Mercantile 1.0.0
 *
 * @param null
 * @return array $mercantile_featured_slider_number
 *
 */
if ( !function_exists('mercantile_featured_slider_number') ) :
    function mercantile_featured_slider_number() {
        $mercantile_featured_slider_number =  array(
            1 => __( '1', 'mercantile' ),
            2 => __( '2', 'mercantile' ),
            3 =>  __( '3', 'mercantile' )
        );
        return apply_filters( 'mercantile_featured_slider_number', $mercantile_featured_slider_number );
    }
endif;

/**
 * Header logo/text display options alternative
 *
 * @since Mercantile 1.0.2
 *
 * @param null
 * @return array $mercantile_header_id_display_opt
 *
 */
if ( !function_exists('mercantile_header_id_display_opt') ) :
    function mercantile_header_id_display_opt() {
        $mercantile_header_id_display_opt =  array(
            'logo-only' => __( 'Logo Only ( First Select Logo Above )', 'mercantile' ),
            'title-only' => __( 'Site Title Only', 'mercantile' ),
            'title-and-tagline' =>  __( 'Site Title and Tagline', 'mercantile' ),
            'disable' => __( 'Disable', 'mercantile' )
        );
        return apply_filters( 'mercantile_header_id_display_opt', $mercantile_header_id_display_opt );
    }
endif;

/**
 * Feature slider selection
 *
 * @since Mercantile 1.0.0
 *
 * @param null
 * @return array $mercantile_slider_text_align
 *
 */
if ( !function_exists('mercantile_slider_text_align') ) :
    function mercantile_slider_text_align() {
        $mercantile_slider_text_align =  array(
            'alternate'   => __( 'Alternate', 'mercantile' ),
            'text-left'   => __( 'Left', 'mercantile' ),
            'text-right'  => __( 'Right', 'mercantile' ),
            'text-center' => __( 'Center', 'mercantile' )
        );
        return apply_filters( 'mercantile_slider_text_align', $mercantile_slider_text_align );
    }
endif;

/**
 * Sidebar layout options
 *
 * @since Mercantile 1.0.0
 *
 * @param null
 * @return array $mercantile_sidebar_layout
 *
 */
if ( !function_exists('mercantile_sidebar_layout') ) :
    function mercantile_sidebar_layout() {
        $mercantile_sidebar_layout =  array(
            'right-sidebar'=> __( 'Right Sidebar', 'mercantile' ),
            'left-sidebar'=> __( 'Left Sidebar' , 'mercantile' ),
            'no-sidebar'=> __( 'No Sidebar', 'mercantile' )
        );
        return apply_filters( 'mercantile_sidebar_layout', $mercantile_sidebar_layout );
    }
endif;

/**
 * Blog layout options
 *
 * @since Mercantile 1.0.0
 *
 * @param null
 * @return array $mercantile_blog_layout
 *
 */
if ( !function_exists('mercantile_blog_layout') ) :
    function mercantile_blog_layout() {
        $mercantile_blog_layout =  array(
            'full-image' => __( 'Show Image', 'mercantile' ),
            'no-image' => __( 'No Image', 'mercantile' )
        );
        return apply_filters( 'mercantile_blog_layout', $mercantile_blog_layout );
    }
endif;

/**
 *  Default Theme layout options
 *
 * @since Mercantile 1.0.0
 *
 * @param null
 * @return array $mercantile_theme_layout
 *
 */
if ( !function_exists('mercantile_get_default_theme_options') ) :
    function mercantile_get_default_theme_options() {

        $default_theme_options = array(
            /*header*/
            'mercantile-header-top-left-option'  => 'none',
            'mercantile-phone-number'  => '',
            'mercantile-top-email'  => '',
            'mercantile-header-top-right-option'  => 'none',
            'mercantile-enable-sticky'  => 1,
            'mercantile-menu-active-hover-options'  => 'text-color',
            'mercantile-enable-search'  => '',
            'mercantile-enable-woo-cart'  => '',
            

            /*feature section options*/
            'mercantile-feature-page'  => 0,
            'mercantile-featured-slider-number'  => 2,
            'mercantile-enable-feature'  => '',
            'mercantile-feature-slider-text-align'  => 'alternate',
            'mercantile-feature-slider-enable-animation'  => 1,
            'mercantile-slider-know-more-text'  => __( "Know More", "mercantile" ),

            /*header options*/
            'mercantile-header-id-display-opt' => 'title-only',
            'mercantile-facebook-url'  => '',
            'mercantile-twitter-url'  => '',
            'mercantile-youtube-url'  => '',
            'mercantile-google-plus-url'  => '',
            'mercantile-enable-social'  => '',

            /*footer options*/
            'mercantile-footer-copyright'  => __( '&copy; All right reserved 2016', 'mercantile' ),
            'mercantile-footer-bg-img'  => '',

            /*layout/design options*/
            'mercantile-hide-front-page-content'  => '',
            'mercantile-sidebar-layout'  => 'right-sidebar',
            'mercantile-blog-archive-layout'  => 'full-image',
            'mercantile-primary-color'  => '#2196F3',

            'mercantile-blog-archive-more-text'  => __( 'Read More', 'mercantile' ),

            /*theme options*/
            'mercantile-search-placholder'  => __( 'Search', 'mercantile' ),
            'mercantile-show-breadcrumb'  => 0
        );

        return apply_filters( 'mercantile_default_theme_options', $default_theme_options );
    }
endif;


/**
 *  Get theme options
 *
 * @since Mercantile 1.0.0
 *
 * @param null
 * @return array mercantile_theme_options
 *
 */
if ( !function_exists('mercantile_get_theme_options') ) :
    function mercantile_get_theme_options() {

        $mercantile_default_theme_options = mercantile_get_default_theme_options();
        $mercantile_get_theme_options = get_theme_mod( 'mercantile_theme_options');
        if( is_array( $mercantile_get_theme_options )){
            return array_merge( $mercantile_default_theme_options ,$mercantile_get_theme_options );
        }
        else{
            return $mercantile_default_theme_options;
        }

    }
endif;