<?php

/**
 * Adds Mercantile Theme Widgets in SiteOrigin Pagebuilder Tabs
 *
 * @since Mercantile 1.0.0
 *
 * @param null
 * @return null
 *
 */
function mercantile_widgets($widgets) {
    $theme_widgets = array(
        'Mercantile_client',
        'Mercantile_posts_col',
        'Mercantile_contact',
        'Mercantile_fdcolumn',
        'Mercantile_featured',
        'Mercantile_service',
        'Mercantile_team',
        'Mercantile_testimonial',
        'Mercantile_portfolio',
    );
    foreach($theme_widgets as $theme_widget) {
        if( isset( $widgets[$theme_widget] ) ) {
            $widgets[$theme_widget]['groups'] = array('mercantile');
            $widgets[$theme_widget]['icon']   = 'dashicons dashicons-screenoptions';
        }
    }
    return $widgets;
}
add_filter('siteorigin_panels_widgets', 'mercantile_widgets');

/**
 * Add a tab for the theme widgets in the page builder
 *
 * @since Mercantile 1.0.0
 *
 * @param null
 * @return null
 *
 */
function mercantile_widgets_tab($tabs){
    $tabs[] = array(
        'title'  => __('AT Mercantile Widgets', 'mercantile'),
        'filter' => array(
            'groups' => array('mercantile')
        )
    );
    return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'mercantile_widgets_tab', 20);