<?php
/**
 * Footer content
 *
 * @since Mercantile 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'mercantile_footer' ) ) :

    function mercantile_footer() {
        global $mercantile_customizer_all_values;
        $bg_image = esc_url($mercantile_customizer_all_values['mercantile-footer-bg-img']);
        $bg_image_style = '';
        $bg_image_class = '';
        if ( !empty( $bg_image ) ) {
            $bg_image_style .= 'background-image:url(' . $bg_image . ');background-repeat:no-repeat;background-size:cover;background-attachment:fixed;background-position: center;';
            $bg_image_class = 'at-parallax';
        }
        ?>
        <div class="clearfix"></div>
        <footer class="site-footer at-remove-width <?php echo $bg_image_class; ?>" style="<?php echo $bg_image_style; ?>">
            <div class="footer-top-wrapper">
                <div class="container">
                    <div class="row">
                        <?php
                        if(
                            is_active_sidebar( 'mercantile-footer-top-col-one' ) ||
                            is_active_sidebar( 'mercantile-footer-top-col-two' ) ||
                            is_active_sidebar( 'mercantile-footer-top-col-three' )
                        ){
                            $footer_top_col = 'col-sm-4';
                            ?>

                            <div class="footer-columns">
                                <?php if( is_active_sidebar( 'mercantile-footer-top-col-one' ) ) : ?>
                                    <div class="footer-sidebar init-animate fadeInDown1 <?php echo esc_attr( $footer_top_col );?>">
                                        <?php dynamic_sidebar( 'mercantile-footer-top-col-one' ); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if( is_active_sidebar( 'mercantile-footer-top-col-two' ) ) : ?>
                                    <div class="footer-sidebar init-animate fadeInDown1 <?php echo esc_attr( $footer_top_col );?>">
                                        <?php dynamic_sidebar( 'mercantile-footer-top-col-two' ); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if( is_active_sidebar( 'mercantile-footer-top-col-three' ) ) : ?>
                                    <div class="footer-sidebar init-animate fadeInDown1 <?php echo esc_attr( $footer_top_col );?>">
                                        <?php dynamic_sidebar( 'mercantile-footer-top-col-three' ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div><!-- footer-top-wrapper-->
            <div class="footer-bottom-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 init-animate fadeInDown1">
                            <?php
                            if ( 1 == $mercantile_customizer_all_values['mercantile-enable-social'] ) {
                                /**
                                 * Social Sharing
                                 * mercantile_action_social_links
                                 * @since Mercantile 1.1.0
                                 *
                                 * @hooked mercantile_social_links -  10
                                 */
                                echo "<div class='text-center'>";
                                do_action('mercantile_action_social_links');
                                echo "</div>";
                            }
                            ?>
                        </div>
                        <div class="col-sm-4 init-animate fadeInDown1">
                            <?php
                            if( isset( $mercantile_customizer_all_values['mercantile-footer-copyright'] ) ): ?>
                                <p class="text-center">
                                    <?php echo wp_kses_post( $mercantile_customizer_all_values['mercantile-footer-copyright'] ); ?>
                                </p>
                            <?php endif;
                            ?>
                        </div>
                        <div class="col-sm-4 init-animate fadeInDown1">
                            <div class="footer-copyright border text-center">
                                <div class="site-info">
                                    <?php printf( esc_html__( '%1$s by %2$s', 'mercantile' ), 'Mercantile', '<a href="https://www.acmethemes.com/mercantile" rel="designer">Acme Themes</a>' ); ?>
                                </div><!-- .site-info -->
                            </div>
                        </div>
                    </div>
                    <a href="#page" class="sm-up-container"><i class="fa fa-angle-up sm-up"></i></a>
                </div>
            </div>
    </footer>
    <?php
    }
endif;
add_action( 'mercantile_action_footer', 'mercantile_footer', 10 );

/**
 * Page end
 *
 * @since Mercantile 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'mercantile_page_end' ) ) :

    function mercantile_page_end() {
        ?>
        </div><!-- #page -->
    <?php
    }
endif;
add_action( 'mercantile_action_after', 'mercantile_page_end', 10 );