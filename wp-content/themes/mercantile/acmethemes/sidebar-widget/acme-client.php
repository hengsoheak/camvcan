<?php
/**
 * Client Widgets
 *
 * @since Mercantile 1.0.0
 *
 * @param null
 * @return array $mercantile_client_column_number
 *
 */
if ( !function_exists('mercantile_client_column_number') ) :
    function mercantile_client_column_number() {
        $mercantile_client_column_number =  array(
            1 => __( '1', 'mercantile' ),
            2 => __( '2', 'mercantile' ),
            3 => __( '3', 'mercantile' ),
            4 =>  __( '4', 'mercantile' )
        );
        return apply_filters( 'mercantile_client_column_number', $mercantile_client_column_number );
    }
endif;


/**
 * Class for adding Client Section Widget
 *
 * @package Acme Themes
 * @subpackage Mercantile
 * @since 1.0.0
 */
if ( ! class_exists( 'Mercantile_client' ) ) {

    class Mercantile_client extends WP_Widget {
        /*defaults values for fields*/
        private $defaults = array(
            'unique_id'     => '',
            'title'         => '',
            'page_id'       => '',
            'post_number'   => 4,
            'column_number' => 4
        );

        function __construct() {
            parent::__construct(
            /*Base ID of your widget*/
                'mercantile_client',
                /*Widget name will appear in UI*/
                __('AT Client Section', 'mercantile'),
                /*Widget description*/
                array( 'description' => __( 'Show Client Section.', 'mercantile' ), )
            );
        }

        /*Widget Backend*/
        public function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, $this->defaults );
            /*default values*/
            $unique_id = esc_attr( $instance[ 'unique_id' ] );
            $title = esc_attr( $instance[ 'title' ] );
            $page_id = absint( $instance[ 'page_id' ] );
            $post_number = absint( $instance[ 'post_number' ] );
            $column_number = absint( $instance[ 'column_number' ] );
            ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'unique_id' ); ?>"><?php _e( 'Section ID', 'mercantile' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'unique_id' ); ?>" name="<?php echo $this->get_field_name( 'unique_id' ); ?>" type="text" value="<?php echo $unique_id; ?>" />
                <br />
                <small><?php _e('Enter a Unique Section ID. You can use this ID in Menu item for enabling One Page Menu.','mercantile')?></small>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'mercantile' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'page_id' ); ?>"><?php _e( 'Select Page For Client', 'mercantile' ); ?>:</label>
                <br />
                <small><?php _e( 'Select parent page and its subpages will display in the frontend. If page does not have any subpages, then selected single page will display', 'mercantile' ); ?></small>
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
                <label for="<?php echo $this->get_field_id( 'post_number' ); ?>"><?php _e( 'Client Number', 'mercantile' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'post_number' ); ?>" name="<?php echo $this->get_field_name( 'post_number' ); ?>" type="number" value="<?php echo $post_number; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'column_number' ); ?>"><?php _e( 'Column Number', 'mercantile' ); ?>:</label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'column_number' ); ?>" name="<?php echo $this->get_field_name( 'column_number' ); ?>" >
                    <?php
                    $mercantile_client_column_numbers = mercantile_client_column_number();
                    foreach ( $mercantile_client_column_numbers as $key => $value ){
                        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $column_number ); ?>><?php echo esc_attr( $value );?></option>
                        <?php
                    }
                    ?>
                </select>
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
            $instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );

            $instance[ 'page_id' ] = absint( $new_instance[ 'page_id' ] );
            $instance[ 'post_number' ] = absint( $new_instance[ 'post_number' ] );
            $instance[ 'column_number' ] = absint( $new_instance[ 'column_number' ] );

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
            $instance = wp_parse_args( (array) $instance, $this->defaults);

            /*default values*/
            $unique_id = $instance[ 'unique_id' ];
            $title = apply_filters( 'widget_title', !empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );
            $page_id = absint( $instance[ 'page_id' ] );
            $post_number = absint( $instance[ 'post_number' ] );
            $column_number = absint( $instance[ 'column_number' ] );

            echo $args['before_widget'];
            ?>
            <section id="<?php echo esc_attr( $unique_id );?>" class="acme-widgets acme-clients">
                <div class="container">
                    <?php
                    if( !empty( $title ) ) {
                        echo '<div class="main-title init-animate fadeInDown2">';
                        echo $args['before_title'] .esc_html( $title ).$args['after_title'];
                        echo '</div>';
                    }
                    ?>
                    <div class="row">
                        <?php if( !empty ( $page_id ) ) :
                            $mercantile_child_page_args = array(
                                'post_parent'         => $page_id,
                                'posts_per_page'      => $post_number,
                                'post_type'           => 'page',
                                'no_found_rows'       => true,
                                'post_status'         => 'publish'
                            );
                            $client_query = new WP_Query( $mercantile_child_page_args );

                            if ( !$client_query->have_posts() ){
                                $mercantile_child_page_args = array(
                                    'page_id'         => $page_id,
                                    'posts_per_page'      => 1,
                                    'post_type'           => 'page',
                                    'no_found_rows'       => true,
                                    'post_status'         => 'publish'
                                );
                                $client_query = new WP_Query( $mercantile_child_page_args );
                                $column_number = 1;
                            }

                            /*The Loop*/
                            if ( $client_query->have_posts() ):
                                $i = 1;
                                while( $client_query->have_posts() ):$client_query->the_post();
                                    $animation1 = "init-animate fadeInDown1";

                                    if( 1 == $column_number ){
                                        $b_col = "col-sm-12";
                                    }
                                    elseif( 2 == $column_number ){
                                        $b_col = "col-sm-6";
                                    }
                                    elseif( 3 == $column_number ){
                                        $b_col = "col-sm-12 col-md-4";
                                    }
                                    else{
                                        $b_col = "col-sm-12 col-md-3";
                                    }
                                    ?>
                                    <div class="<?php echo esc_attr( $b_col ); ?>">
                                        <div class="client-item <?php echo esc_attr( $animation1 );?>">
                                            <div class="client-author">
                                                <?php
                                                if( has_post_thumbnail( ) ){
                                                    ?>
                                                    <div class="client-image text-center">
                                                        <a href="<?php the_permalink()?>">
                                                            <?php the_post_thumbnail('full'); ?>
                                                        </a>
                                                    </div>
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                    <table class="no-image-table-placeholder post-thumb">
                                                        <tbody>
                                                        <tr valign="middle">
                                                            <td>
                                                                <a href="<?php the_permalink()?>">
                                                                    <?php the_title(); ?>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    if( 0 == $i % $column_number ){
                                        echo "<div class='clearfix'></div>";
                                    }
                                    $i++;
                                endwhile;
                            endif;
                        endif;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </section>
            <?php
            echo $args['after_widget'];
        }
    } // Class Mercantile_client ends here
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
if ( ! function_exists( 'mercantile_client' ) ) :

    function mercantile_client() {
        register_widget( 'Mercantile_client' );
    }
endif;
add_action( 'widgets_init', 'mercantile_client' );