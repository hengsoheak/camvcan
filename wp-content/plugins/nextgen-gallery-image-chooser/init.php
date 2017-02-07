<?php
/*
    NextGEN Gallery Image Chooser
    Version 1.1.0

    Author: Ulrich Mertin
    
    This plugin is based on g2image by Kirk Steffensen,
    see http://g2image.steffensenfamily.com/ for further contributors.

    Released under the GPL version 2.
    A copy of the license is in the root folder of this plugin.
*/

nggic_setdefaults();

/**
* Sets the default options in the global variable $nggic_options.
*
* @param NULL
* @return NULL
*/
function nggic_setdefaults() {
	global $nggic_options;

	$nggic_options['sortby'] = 'gallery_order';
	$nggic_options['default_action'] = 'ngg_thumb_multi';
	$nggic_options['tag_width'] = '';
	$nggic_options['tag_height'] = '';
	$nggic_options['images_per_page'] = 15;
	$nggic_options['default_alignment'] = 'none';
	$nggic_options['default_mode'] = 'none';
	$nggic_options['custom_url'] = 'http://';
	$nggic_options['display_filenames'] = TRUE;

}

?>
