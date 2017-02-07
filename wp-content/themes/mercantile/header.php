<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Acme Themes
 * @subpackage mercantile
 */

/**
 * mercantile_action_before_head hook
 * @since Mercantile 1.0.0
 *
 * @hooked mercantile_set_global -  0
 * @hooked mercantile_doctype -  10
 */
do_action( 'mercantile_action_before_head' );?>
	<head>

		<?php
		/**
		 * mercantile_action_before_wp_head hook
		 * @since Mercantile 1.0.0
		 *
		 * @hooked mercantile_before_wp_head -  10
		 */
		do_action( 'mercantile_action_before_wp_head' );

		wp_head();
		?>

	</head>
<body <?php body_class();?>>

<?php
/**
 * mercantile_action_before hook
 * @since Mercantile 1.0.0
 *
 * @hooked mercantile_site_start - 20
 */
do_action( 'mercantile_action_before' );

/**
 * mercantile_action_before_header hook
 * @since Mercantile 1.0.0
 *
 * @hooked mercantile_skip_to_content - 10
 */
do_action( 'mercantile_action_before_header' );


/**
 * mercantile_action_header hook
 * @since Mercantile 1.0.0
 *
 * @hooked mercantile_header - 10
 */
do_action( 'mercantile_action_header' );


/**
 * mercantile_action_after_header hook
 * @since Mercantile 1.0.0
 *
 * @hooked null
 */
do_action( 'mercantile_action_after_header' );


/**
 * mercantile_action_before_content hook
 * @since Mercantile 1.0.0
 *
 * @hooked null
 */
do_action( 'mercantile_action_before_content' );