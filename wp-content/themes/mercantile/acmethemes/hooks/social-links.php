<?php
/**
 * Display Social Links
 *
 * @since Mercantile 1.0.0
 *
 * @param null
 * @return void
 *
 */

if ( !function_exists('mercantile_social_links') ) :

    function mercantile_social_links( ) {

        global $mercantile_customizer_all_values;
        ?>
        <ul class="socials">
            <?php
            if ( !empty( $mercantile_customizer_all_values['mercantile-facebook-url'] ) ) { ?>
                <li class="facebook">
                    <a href="<?php echo esc_url( $mercantile_customizer_all_values['mercantile-facebook-url'] ); ?>" title="<?php esc_attr_e( 'Facebook','mercantile');?>" target="_blank"><i class="fa fa-facebook"></i></a>
                </li>
            <?php }
            if ( !empty( $mercantile_customizer_all_values['mercantile-twitter-url'] ) ) { ?>
                <li class="twitter">
                    <a href="<?php echo esc_url( $mercantile_customizer_all_values['mercantile-twitter-url'] ); ?>" title="<?php esc_attr_e( 'Twitter','mercantile');?>" target="_blank"><i class="fa fa-twitter"></i></a>
                </li>
            <?php }
            if ( !empty( $mercantile_customizer_all_values['mercantile-youtube-url'] ) ) { ?>
                <li class="youtube">
                    <a href="<?php echo esc_url( $mercantile_customizer_all_values['mercantile-youtube-url'] ); ?>" title="<?php esc_attr_e( 'Youtube','mercantile');?>" target="_blank"><i class="fa fa-youtube"></i></a>
                </li>
            <?php }
            if ( !empty( $mercantile_customizer_all_values['mercantile-google-plus-url'] ) ) {
                ?>
                <li class="google-plus">
                    <a href="<?php echo esc_url( $mercantile_customizer_all_values['mercantile-google-plus-url'] ); ?>" title="<?php esc_attr_e( 'Google Plus','mercantile');?>" target="_blank"><i class="fa fa-google-plus"></i></a>
                </li>
                <?php
            }
            ?>
        </ul>
        <?php
    }

endif;

add_filter( 'mercantile_action_social_links', 'mercantile_social_links', 10 );