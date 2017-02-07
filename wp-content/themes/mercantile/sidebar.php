<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Acme Themes
 * @subpackage Mercantile
 */

if ( ! is_active_sidebar( 'mercantile-sidebar' ) ) {
	return;
}
$sidebar_layout = mercantile_sidebar_selection();
if( $sidebar_layout == "right-sidebar" || empty( $sidebar_layout ) ) : ?>
	<div id="secondary-right" class="at-remove-width widget-area sidebar secondary-sidebar" role="complementary">
		<div id="sidebar-section-top" class="widget-area sidebar clearfix">
			<?php dynamic_sidebar( 'mercantile-sidebar' ); ?>
		</div>
	</div>
<?php endif;