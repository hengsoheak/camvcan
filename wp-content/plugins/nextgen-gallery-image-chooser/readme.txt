=== NextGEN Gallery Image Chooser ===
Contributors: umertin
Tags: nextgen, gallery, image chooser
Requires at least: 3.3.1
Tested up to: 4.1.1
Stable tag: 1.1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Comfortable Image Chooser for the NextGEN Gallery, based on g2image 

== Description ==

[NextGEN Gallery](http://www.nextgen-gallery.com/) (NGG) is an excellent gallery for WordPress. Its major drawback, as far as I'm concerned, is the minimalistic image chooser. So I've taken the liberty to adapt the equally excellent [g2image](http://g2image.steffensenfamily.com/) image chooser, which also is embedded in the WPG2 connector to Gallery2.

This image chooser allows to browse through hierarchical albums and galleries, insert NGG tags for albums and galleries, as well as NGG and HTML tags for one or more images and thumbnails at a time.

* On the left side of the image chooser pop-up there is the tree view of all albums and galleries. On the top are the albums and their galleries, then follow the galleries, which are not attached to any album.
* On the upper right side there are the controls to insert the tags with their relevant options. Depending on which insert mode (NGG or HTML tag, image or thumbnail) is selected, only the relevant options are shown.
* Below the controls, the thumbnails of the images in the selected gallery are shown, optionally together with their title, summary and description. There multiple images can be selected for insertion. 

At present, the NGG tags [album], [nggallery], [thumb], [singlepic], and [imagebrowser], plus some html links are supported.

Default settings can be altered on the settings page.

At this time, the image chooser is available in English (default) and German. Other translations are welcome and will be included in the next release.

== Installation ==

1. Upload the `nextgen-gallery-image-chooser` directory to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. In the visual editor, you will find a new NGG button which allows adding albums, galleries and images to the post

== Frequently Asked Questions ==

None yet.

== Screenshots ==

1. "Add new post" page with NextGEN Gallery Image Chooser button.
2. Image Chooser page for album (without images).
3. Image Chooser page for gallery (with images). Options for the [singlepic] tag are displayed.
4. Image Chooser page for gallery (with images). Options for the [thumb] tag are displayed.

== Changelog ==

= 1.1.0 =
* Fixed errors with NextGEN Gallery versions greater than 2.0.66
 
= 1.0.1 =
* Fixed problems with special chars (especially double quotation marks) in album or gallery titles
* Fixed minor HTML error (missing blank)

= 1.0.0 =
* Added settings page
* Harmonized internationalization (use Wordpress functionality instead of own gettext)
* Plugin now honors Wordpress language settings

= 0.1.0 =
* Added [imagebrowser] tag
* Disabled insert button for root element of the gallery tree
* Added placeholder image when inserting [album] tag
* Created different placeholder images for albums, galleries and images/thumbnails
* Removed hard link to the TinyMCE editor_plugin.js file
* Added screenshots

= 0.0.2 =
* Added template, mode and link options to NGG tags
* Added quotation marks to user entered options
* Added locale support and German translation

= 0.0.1 =
* Initial version

== Upgrade Notice ==

None yet.
