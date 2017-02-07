<?php
/**
 * The left sidebar containing the main widget area.
 */
if ( ! is_active_sidebar( 'mercantile-sidebar' ) ) {
    return;
}
$sidebar_layout = mercantile_sidebar_selection();
?>
<?php if( $sidebar_layout == "left-sidebar" ) : ?>
    <div id="secondary-left" class="widget-area at-remove-width sidebar secondary-sidebar" role="complementary">
        <div id="sidebar-section-top" class="widget-area sidebar clearfix">
            <?php dynamic_sidebar( 'mercantile-sidebar' ); ?>
        </div>
    </div>
<?php endif;