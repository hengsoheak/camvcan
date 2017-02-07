<?php
/**
 * Class for adding Featured Section Widget
 *
 * @package AcmeThemes
 * @subpackage Mercantile
 * @since 1.0.0
 */
if ( ! class_exists( 'Mercantile_featured' ) ) {

    class Mercantile_featured extends WP_Widget {
        /*defaults values for fields*/
        private function defaults(){
            $defaults = array(
                'unique_id'     => '',
                'page_id'       => '',
                'button_text'   => __( 'View More','mercantile' )
            );
            return $defaults;
        }


        function __construct() {
            parent::__construct(
            /*Base ID of your widget*/
                'mercantile_featured',
                /*Widget name will appear in UI*/
                __('AT Featured Section', 'mercantile'),
                /*Widget description*/
                array( 'description' => __( 'Advanced Featured Section with Parallax Background.', 'mercantile' ), )
            );
        }

        /*Widget Backend*/
        public function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, $this->defaults() );
            /*default values*/
            $unique_id = esc_attr( $instance[ 'unique_id' ] );
            $page_id = absint( $instance[ 'page_id' ] );
            $button_text = esc_attr( $instance[ 'button_text' ] );
            ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'unique_id' ); ?>"><?php _e( 'Section ID', 'mercantile' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'unique_id' ); ?>" name="<?php echo $this->get_field_name( 'unique_id' ); ?>" type="text" value="<?php echo $unique_id; ?>" />
                <br />
                <small><?php _e('Enter a Unique Section ID. You can use this ID in Menu item for enabling One Page Menu.','mercantile')?></small>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'page_id' ); ?>"><?php _e( 'Select Feature Page', 'mercantile' ); ?>:</label>
                <br />
                <small><?php _e( 'Select a Page which have featured image and excerpts. Featured image will be set as background image', 'mercantile' ); ?></small>
                <?php
                /* see more here https://codex.wordpress.org/Function_Reference/wp_dropdown_pages*/
                $args = array(
                    'selected'              => $page_id,
                    'name'                  => $this->get_field_name( 'page_id' ),
                    'id'                    => $this->get_field_id( 'page_id' ),
                    'class'                 => 'widefat',
                    'show_option_none'      => __('Select Page','mercantile'),
                );
                wp_dropdown_pages( $args );
                ?>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php _e( 'Button Text', 'mercantile' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" type="text" value="<?php echo $button_text; ?>" />
            </p>
            <?php
        }
        /**
         * Function to Updating widget replacing old instances with new
         *
         * @access public
         * @since 1.0
         *
         * @param array $new_instance new arrays value
         * @param array $old_instance old arrays value
         * @return array
         *
         */
        public function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $instance[ 'unique_id' ] = sanitize_key( $new_instance[ 'unique_id' ] );
            $instance[ 'page_id' ] = absint( $new_instance[ 'page_id' ] );
            $instance[ 'button_text' ] = sanitize_text_field( $new_instance[ 'button_text' ] );
            return $instance;
        }
        /**
         * Function to Creating widget front-end. This is where the action happens
         *
         * @access public
         * @since 1.0
         *
         * @param array $args widget setting
         * @param array $instance saved values
         * @return array
         *
         */
        public function widget($args, $instance) {
            $init_animate_title = "init-animate fadeInDown1";
            $init_animate_content = "init-animate fadeInDown1";
            $instance = wp_parse_args( (array) $instance, $this->defaults() );
            
            /*default values*/
            $unique_id = !empty( $instance[ 'unique_id' ] ) ? esc_attr( $instance[ 'unique_id' ] ) : esc_attr( $this->id );
            $page_id = absint( $instance[ 'page_id' ] );
            $button_text = esc_html( $instance[ 'button_text' ] );

            echo $args['before_widget'];
            if( !empty ( $page_id ) ) :
                $mercantile_child_page_args = array(
                    'page_id'             => $page_id,
                    'posts_per_page'      => 1,
                    'post_type'           => 'page',
                    'no_found_rows'       => true,
                    'post_status'         => 'publish'
                );
                $featured_page_query = new WP_Query( $mercantile_child_page_args );
                /*The Loop*/
                if ( $featured_page_query->have_posts() ):
                    $i = 0;
                    while( $featured_page_query->have_posts() ):$featured_page_query->the_post();
                        $bg_image_style = '';
                        $bg_image_class = '';

                        if ( has_post_thumbnail() ) {
                            $bg_image = wp_get_attachment_image_src(get_post_thumbnail_id( get_the_ID() ), 'full');
                            $bg_image_style .= 'background-image:url(' . esc_url( $bg_image[0] ) . ');background-repeat:no-repeat;background-size:cover;background-attachment:fixed;';
                            $bg_image_class = 'at-parallax';
                        }

                        ?>
                        <section id="<?php echo $unique_id;?>" class="acme-widgets acme-featured <?php echo $bg_image_class; ?>" style="<?php echo $bg_image_style; ?>">

                            <div class="at-overlay">
                                <div class="featured-section">
                                    <div class="container">
                                        <div class="row">
                                            <div class="main-title col-md-10 <?php echo esc_attr( $init_animate_title ); ?>">
                                                <div class="row">
                                                    <?php
                                                    echo "<div class='col-md-4 text-left'>".$args['before_title'] . esc_html( get_the_title() ) . $args['after_title']. "</div>";
                                                    ?>
                                                    <div class="fs-text-desc col-md-8 text-middle">
                                                        <p><?php the_excerpt(); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if( !empty( $button_text ) ){
                                                ?>
                                                <div class="at-btn-wrap col-md-2 text-right <?php echo esc_attr( $init_animate_content )?>">
                                                    <div class="row">
                                                        <div class="com-sm-12">
                                                            <a class="btn btn-primary" href="<?php the_permalink();?>">
                                                                <?php echo $button_text; ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>  
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <?php $i++;
                    endwhile;
                endif;
            endif;
            echo $args['after_widget'];
        }
    } // Class Mercantile_featured ends here
}
/**
 * Function to Register and load the widget
 *
 * @since 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'mercantile_featured' ) ) :

    function mercantile_featured() {
        register_widget( 'Mercantile_featured' );
    }
endif;
add_action( 'widgets_init', 'mercantile_featured' );