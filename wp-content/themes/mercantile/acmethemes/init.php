<?php
/**
 * Main include functions ( to support child theme ) that child theme can override file too
 *
 * @since Mercantile 1.0.0
 *
 * @param string $file_path, path from the theme
 * @return string full path of file inside theme
 *
 */
if( !function_exists('mercantile_file_directory') ){

    function mercantile_file_directory( $file_path ){
        if( file_exists( trailingslashit( get_stylesheet_directory() ) . $file_path) ) {
            return trailingslashit( get_stylesheet_directory() ) . $file_path;
        }
        else{
            return trailingslashit( get_template_directory() ) . $file_path;
        }
    }
}

/*
* file for customizer theme options
*/
require mercantile_file_directory('acmethemes/customizer/customizer.php');

/*
* file for additional functions files
*/
require mercantile_file_directory('acmethemes/functions.php');

/*
* files for hooks
*/
require mercantile_file_directory('acmethemes/hooks/front-page.php');

require mercantile_file_directory('acmethemes/hooks/slider-selection.php');

require mercantile_file_directory('acmethemes/hooks/header.php');

require mercantile_file_directory('acmethemes/hooks/social-links.php');

require mercantile_file_directory('acmethemes/hooks/dynamic-css.php');

require mercantile_file_directory('acmethemes/hooks/footer.php');

require mercantile_file_directory('acmethemes/hooks/comment-forms.php');

require mercantile_file_directory('acmethemes/hooks/excerpts.php');

require mercantile_file_directory('acmethemes/hooks/siteorigin-panels.php');

/*
* file for sidebar and widgets
*/

require mercantile_file_directory('acmethemes/sidebar-widget/acme-featured-page.php');

require mercantile_file_directory('acmethemes/sidebar-widget/acme-featured.php');

require mercantile_file_directory('acmethemes/sidebar-widget/acme-service.php');

require mercantile_file_directory('acmethemes/sidebar-widget/acme-testimonial.php');

require mercantile_file_directory('acmethemes/sidebar-widget/acme-team.php');

require mercantile_file_directory('acmethemes/sidebar-widget/acme-client.php');

require mercantile_file_directory('acmethemes/sidebar-widget/acme-contact.php');

require mercantile_file_directory('acmethemes/sidebar-widget/acme-col-posts.php');

require mercantile_file_directory('acmethemes/sidebar-widget/acme-portfolio.php');

require mercantile_file_directory('acmethemes/sidebar-widget/sidebar.php');

/*file for metaboxes*/
require mercantile_file_directory('acmethemes/metabox/metabox.php');

/*
* file for core functions imported from functions.php while downloading Underscores
*/
require mercantile_file_directory('acmethemes/core.php');