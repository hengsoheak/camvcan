<?php
/**
 * Setting global variables for all theme options saved values
 *
 * @since Mercantile 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'mercantile_set_global' ) ) :
    function mercantile_set_global() {
        /*Getting saved values start*/
        $mercantile_saved_theme_options = mercantile_get_theme_options();
        $GLOBALS['mercantile_customizer_all_values'] = $mercantile_saved_theme_options;
        /*Getting saved values end*/
    }
endif;
add_action( 'mercantile_action_before_head', 'mercantile_set_global', 0 );

/**
 * Doctype Declaration
 *
 * @since Mercantile 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'mercantile_doctype' ) ) :
    function mercantile_doctype() {
        ?>
        <!DOCTYPE html><html <?php language_attributes(); ?>>
        <?php
    }
endif;
add_action( 'mercantile_action_before_head', 'mercantile_doctype', 10 );

/**
 * Code inside head tage but before wp_head funtion
 *
 * @since Mercantile 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'mercantile_before_wp_head' ) ) :

    function mercantile_before_wp_head() {
        ?>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        <?php
    }
endif;
add_action( 'mercantile_action_before_wp_head', 'mercantile_before_wp_head', 10 );

/**
 * Add body class
 *
 * @since Mercantile 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'mercantile_body_class' ) ) :

    function mercantile_body_class( $mercantile_body_classes ) {
        global $mercantile_customizer_all_values;

        if ( 'no-image' == $mercantile_customizer_all_values['mercantile-blog-archive-layout'] ) {
            $mercantile_body_classes[] = 'blog-no-image';
        }
        $mercantile_body_classes[] = mercantile_sidebar_selection();

        return $mercantile_body_classes;

    }
endif;
add_action( 'body_class', 'mercantile_body_class', 10, 1);

/**
 * Start site div
 *
 * @since Mercantile 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'mercantile_site_start' ) ) :

    function mercantile_site_start() {
        ?>
        <div class="site" id="page">
        <?php
    }
endif;
add_action( 'mercantile_action_before', 'mercantile_site_start', 20 );
/**
 * Skip to content
 *
 * @since Mercantile 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'mercantile_skip_to_content' ) ) :

    function mercantile_skip_to_content() {
        ?>
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'mercantile' ); ?></a>
        <?php
    }
endif;
add_action( 'mercantile_action_before_header', 'mercantile_skip_to_content', 10 );

/**
 * Main header
 *
 * @since Mercantile 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'mercantile_header' ) ) :
    function mercantile_header() {
        global $mercantile_customizer_all_values, $woocommerce;
        $cart_url = '';
        if( class_exists( 'WooCommerce' ) ){
            $cart_url = $woocommerce->cart->get_cart_url();
        }
        $mercantile_header_top_left_option = $mercantile_customizer_all_values['mercantile-header-top-left-option'];
        $mercantile_header_top_right_option = $mercantile_customizer_all_values['mercantile-header-top-right-option'];
        $mercantile_enable_search = $mercantile_customizer_all_values['mercantile-enable-search'];
        $mercantile_enable_woo_cart = $mercantile_customizer_all_values['mercantile-enable-woo-cart'];
        if( 'none' != $mercantile_header_top_left_option || 'none' != $mercantile_header_top_right_option){
            ?>
            <div class="top-header">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <?php if( 'none' != $mercantile_header_top_left_option ) {
                                 $mercantile_phone_number = $mercantile_customizer_all_values['mercantile-phone-number'];
                                 $mercantile_top_email = $mercantile_customizer_all_values['mercantile-top-email'];
                                 if( !empty( $mercantile_phone_number ) && ( 'phone' == $mercantile_header_top_left_option || 'both' == $mercantile_header_top_left_option ) ){
                                    echo "<a class='top-phone' href='tel:".esc_attr( esc_html( $mercantile_phone_number ))."'><i class='fa fa-phone'></i>".esc_html( $mercantile_phone_number )."</a>";
                                 }
                                 if( !empty( $mercantile_top_email ) && ('email' == $mercantile_header_top_left_option || 'both' == $mercantile_header_top_left_option ) ){
                                    echo "<a class='top-email' href='mailto:".esc_attr( esc_html( $mercantile_top_email ))."'><i class='fa fa-envelope-o'></i>".esc_html( $mercantile_top_email )."</a>";
                                 }
                            }
                            ?>
                        </div>
                        <div class="col-sm-6 text-right">
                            <?php
                            if( 'social' ==  $mercantile_header_top_right_option ) {
                                do_action('mercantile_action_social_links');
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        $mercantile_nav_class = '';
         $mercantile_enable_sticky = $mercantile_customizer_all_values['mercantile-enable-sticky'];
         if( 1 == $mercantile_enable_sticky ){
            $mercantile_nav_class .= ' mercantile-sticky';
        }
        ?>
        <div class="navbar at-navbar <?php echo $mercantile_nav_class; ?>" id="navbar" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></button>
                   <!--added options-->

                    <div class="search-woo responsive-only">
                         <?php
                         if( 1 == $mercantile_enable_search ){
                         ?>
                         <div class="search-wrap">
                            <div class="search-icon">
                                <i class="fa fa-search"></i>
                            </div>
                            <?php get_search_form(); ?>
                         </div>
                         <?php
                         }
                         if( 1 == $mercantile_enable_woo_cart && class_exists( 'WooCommerce' ) ) {?>
                            <div class="cart-wrap">
                                <div class="acme-cart-views">
                                    <a href="<?php echo esc_url( $cart_url ); ?>" class="cart-contents">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span class="cart-value"><?php echo wp_kses_post ( WC()->cart->cart_contents_count ); ?></span>
                                    </a>
                                </div>
                                <?php the_widget( 'WC_Widget_Cart', '' ); ?>
                            </div>
                            <?php
                         }
                         ?>
                    </div>
                    <!--added options end-->

                    <?php
                    if ( 'disable' != $mercantile_customizer_all_values['mercantile-header-id-display-opt'] ):
                        if ( 'logo-only' == $mercantile_customizer_all_values['mercantile-header-id-display-opt'] && function_exists( 'the_custom_logo' ) ):
                           the_custom_logo();
                        else:/*else is title-only or title-and-tagline*/
                            if ( is_front_page() && is_home() ) : ?>
                                <h1 class="site-title">
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                                </h1>
                            <?php else : ?>
                                <p class="site-title">
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                                </p>
                            <?php endif;
                            if ( 'title-and-tagline' == $mercantile_customizer_all_values['mercantile-header-id-display-opt'] ):
                                $description = get_bloginfo( 'description', 'display' );
                                if ( $description || is_customize_preview() ) : ?>
                                    <p class="site-description"><?php echo esc_html( $description ); ?></p>
                                <?php endif;
                            endif;
                            ?>
                            <?php
                        endif;
                    endif;
                    ?>
                </div>
                <!--added options-->
                <div class="search-woo desktop-only">
                     <?php
                     if( 1 == $mercantile_enable_search ){
                     ?>
                     <div class="search-wrap">
                        <div class="search-icon">
                            <i class="fa fa-search"></i>
                        </div>
                        <?php get_search_form(); ?>
                     </div>
                     <?php
                     }
                     if( 1 == $mercantile_enable_woo_cart && class_exists( 'WooCommerce' ) ) {?>
                        <div class="cart-wrap">
                            <div class="acme-cart-views">
                                <a href="<?php echo esc_url( $cart_url ); ?>" class="cart-contents">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span class="cart-value"><?php echo wp_kses_post ( WC()->cart->cart_contents_count ); ?></span>
                                </a>
                            </div>
                            <?php the_widget( 'WC_Widget_Cart', '' ); ?>
                        </div>
                        <?php
                     }
                     ?>
                </div>
                <!--added options end-->
                <div class="main-navigation navbar-collapse collapse">
                    <?php
                    if( is_front_page() && !is_home() && has_nav_menu( 'one-page') ){
                        wp_nav_menu(
                            array(
                                'theme_location' => 'one-page',
                                'menu_id' => 'primary-menu',
                                'menu_class' => 'nav navbar-nav navbar-right acme-one-page',
                            )
                        );
                    }
                    else{
                     wp_nav_menu(
                        array(
                            'theme_location' => 'primary',
                            'menu_id' => 'primary-menu',
                            'menu_class' => 'nav navbar-nav navbar-right acme-normal-page',
                        )
                    );
                    }
                   ?>
                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
        <?php
    }
endif;
add_action( 'mercantile_action_header', 'mercantile_header', 10 );