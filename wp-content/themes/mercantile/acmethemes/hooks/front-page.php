<?php
/**
 * Front page hook for all WordPress Conditions
 *
 * @since Mercantile 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'mercantile_featured_slider' ) ) :

    function mercantile_featured_slider() {
        global $mercantile_customizer_all_values;

        $mercantile_enable_feature = $mercantile_customizer_all_values['mercantile-enable-feature'];
        if( is_front_page() && 1 == $mercantile_enable_feature  ) :
            do_action( 'mercantile_action_feature_slider' );
        endif;
    }

endif;
add_action( 'mercantile_action_front_page', 'mercantile_featured_slider', 10 );

if ( ! function_exists( 'mercantile_front_page' ) ) :

    function mercantile_front_page() {
        global $mercantile_customizer_all_values;

        $mercantile_hide_front_page_content = $mercantile_customizer_all_values['mercantile-hide-front-page-content'];

        /*show widget in front page, now user are not force to use front page*/
        if( is_active_sidebar( 'mercantile-home' ) ){
            dynamic_sidebar( 'mercantile-home' );
        }
        if( 1 != $mercantile_hide_front_page_content ){
            if ( 'posts' == get_option( 'show_on_front' ) ) {
                include( get_home_template() );
            }
            else {
                include( get_page_template() );
            }
        }


    }
endif;
add_action( 'mercantile_action_front_page', 'mercantile_front_page', 20 );