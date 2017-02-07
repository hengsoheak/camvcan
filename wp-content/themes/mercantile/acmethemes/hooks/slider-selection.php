<?php
/**
 * Display default slider
 *
 * @since Mercantile 1.0.0
 *
 * @param int $post_id
 * @return void
 *
 */
if ( !function_exists('mercantile_default_slider') ) :
    function mercantile_default_slider(){
        ?>
        <?php
        $bg_image_style = '';
        if ( get_header_image() ) :
            $bg_image_style .= 'background-image:url(' . esc_url( get_header_image() ) . ');background-repeat:no-repeat;background-size:cover;background-attachment:scroll;background-position: center;';
        else:
            $bg_image_style .= 'background-image:url(' . esc_url( get_template_directory_uri()."/assets/img/startup-slider.jpg" ) . ');background-repeat:no-repeat;background-size:cover;background-attachment:scroll;background-position: center;';
        endif; // End header image check.

        $text_align = 'text-center';
        $animation1 = 'fadeInRightBig1';
        $animation2 = 'fadeInLeftBig2';
        $animation3 = 'fadeInRightBig3';
        ?>
        <div class="image-slider-wrapper home-fullscreen ">
            <div class="item" style="<?php echo $bg_image_style; ?>">
                <div class="slider-content <?php echo $text_align;?>">
                    <div class="container">
                        <div class="banner-title <?php echo $animation1;?>">
                            <?php _e('Welcome to Mercantile','mercantile' );?>
                        </div>
                        <div class="image-slider-caption <?php echo $animation2;?>">
                            <?php _e('The Most advanced free multipurpose WordPress theme','mercantile' );?>
                        </div>
                        <a href="<?php the_permalink()?>" class="<?php echo $animation3;?> btn btn-primary outline-outward banner-btn">
                            <?php _e('Know More','mercantile'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
endif;

/**
 * Featured Slider display
 *
 * @since Mercantile 1.0.0
 *
 * @param null
 * @return void
 */

if ( ! function_exists( 'mercantile_feature_slider' ) ) :

    function mercantile_feature_slider( ){
        global $mercantile_customizer_all_values;
        $mercantile_feature_page = $mercantile_customizer_all_values['mercantile-feature-page'];
        $mercantile_featured_slider_number = $mercantile_customizer_all_values['mercantile-featured-slider-number'];
        $mercantile_feature_slider_text_align = $mercantile_customizer_all_values['mercantile-feature-slider-text-align'];
        $mercantile_feature_slider_enable_animation = $mercantile_customizer_all_values['mercantile-feature-slider-enable-animation'];
        $mercantile_slider_know_more_text = $mercantile_customizer_all_values['mercantile-slider-know-more-text'];

        if( 0 != $mercantile_feature_page ) :
            $mercantile_child_page_args = array(
                'post_parent'         => $mercantile_feature_page,
                'posts_per_page'      => $mercantile_featured_slider_number,
                'post_type'           => 'page',
                'no_found_rows'       => true,
                'post_status'         => 'publish'
            );
            $slider_query = new WP_Query( $mercantile_child_page_args );
            if ( !$slider_query->have_posts() ){
                $mercantile_child_page_args = array(
                    'page_id'         => $mercantile_feature_page,
                    'posts_per_page'      => $mercantile_featured_slider_number,
                    'post_type'           => 'page',
                    'no_found_rows'       => true,
                    'post_status'         => 'publish'
                );
                $slider_query = new WP_Query( $mercantile_child_page_args );
            }
            /*The Loop*/
            if ( $slider_query->have_posts() ):
                ?>

                <div class="image-slider-wrapper home-fullscreen" id="acme-full-slider">
                    <div class="acme-owl-carausel">
                        <?php
                        $text_align = '';
                        $animation1 = '';
                        $animation2 = '';
                        $animation3 = '';

                        if( 'alternate' != $mercantile_feature_slider_text_align ){
                            $text_align = $mercantile_feature_slider_text_align;
                        }
                        $slider_index = 1;
                        while( $slider_query->have_posts() ):$slider_query->the_post();
                            
                            if( 'alternate' == $mercantile_feature_slider_text_align ){
                                if( 1 == $slider_index ){
                                    $text_align = 'text-left';
                                }
                                elseif ( 2 == $slider_index ){
                                    $text_align = 'text-center';
                                }
                                else{
                                    $text_align = 'text-right';
                                }
                            }
                            if( 1 == $mercantile_feature_slider_enable_animation ){
                                if( 1 == $slider_index ){
                                    $animation1 = 'fadeInLeftBig1';
                                    $animation2 = 'fadeInLeftBig2';
                                    $animation3 = 'fadeInLeftBig3';
                                }
                                elseif ( 2 == $slider_index ){
                                    $animation1 = 'fadeInRightBig1';
                                    $animation2 = 'fadeInLeftBig2';
                                    $animation3 = 'fadeInRightBig3';
                                }
                                else{
                                    $animation1 = 'fadeInRightBig1';
                                    $animation2 = 'fadeInRightBig2';
                                    $animation3 = 'fadeInRightBig3';
                                }
                            }
                            if (has_post_thumbnail()) {
                                $image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                            }
                            else {
                                $image_url[0] = get_template_directory_uri().'/assets/img/startup-slider.jpg';

                            }
                            $bg_image_style = 'background-image:url(' . esc_url( $image_url[0] ) . ');background-repeat:no-repeat;background-size:cover;background-attachment:scroll;background-position: center;';
                            ?>
                            <div class="item" style="<?php echo $bg_image_style; ?>">
                                <div class="slider-content <?php echo $text_align;?>">
                                    <div class="container">
                                        <div class="banner-title <?php echo $animation1;?>"><?php the_title()?></div>
                                        <div class="image-slider-caption <?php echo $animation2;?>">
                                            <?php the_excerpt();?>
                                        </div>
                                        <?php
                                        if( !empty( $mercantile_slider_know_more_text) ){
                                           ?>
                                            <a href="<?php the_permalink()?>" class="<?php echo $animation3;?> btn btn-primary outline-outward banner-btn">
                                                <?php echo esc_html( $mercantile_slider_know_more_text ); ?>
                                            </a>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $slider_index ++;
                            if( 3 < $slider_index ){
                                $slider_index = 1;
                            }
                        endwhile;
                        ?>
                    </div>
                </div>

                <?php
            endif;
            ?>
        <?php
        else:
            mercantile_default_slider();
        endif;
        wp_reset_postdata();
    }
endif;
add_action( 'mercantile_action_feature_slider', 'mercantile_feature_slider', 0 );