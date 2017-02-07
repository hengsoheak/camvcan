<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Acme Themes
 * @subpackage Mercantile
 */

/**
 * mercantile_action_after_content hook
 * @since Mercantile 1.0.0
 *
 * @hooked null
 */
do_action( 'mercantile_action_after_content' );

/**
 * mercantile_action_before_footer hook
 * @since Mercantile 1.0.0
 *
 * @hooked null
 */
do_action( 'mercantile_action_before_footer' );

/**
 * mercantile_action_footer hook
 * @since Mercantile 1.0.0
 *
 * @hooked mercantile_footer - 10
 */
do_action( 'mercantile_action_footer' );

/**
 * mercantile_action_after_footer hook
 * @since Mercantile 1.0.0
 *
 * @hooked null
 */
do_action( 'mercantile_action_after_footer' );

/**
 * mercantile_action_after hook
 * @since Mercantile 1.0.0
 *
 * @hooked mercantile_page_end - 10
 */
do_action( 'mercantile_action_after' );
wp_footer();
?>
</body>
</html>