<?php
/*
Plugin Name: WR MegaMenu
Plugin URI: http://woorockets.com
Description: This is a Powerful, Responsive, and User-Oriented WordPress menu plugin with a Dedicated, Intuitive menu builder. It gives you a complete control at designing and customizing your menu exactly the way you want. Check new product - <a href="http://nitro.woorockets.com/?utm_source=Megamenu&utm_medium=PluginDescription&utm_campaign=CrossPromoPlugins">Nitro</a>.
Version: 1.1.4
Author: WooRockets
Author URI: http://woorockets.com
License: GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
*/
// Load class auto-loader
require_once dirname( __FILE__ ) . '/includes/loader.php';

// Include constant definition file
include_once dirname( __FILE__ ) . '/defines.php';

// Activate WR MegaMenu plugin
register_activation_hook( WR_MEGAMENU_MAIN_FILE, array( 'WR_Megamenu_Plugin', 'on_activation' ) );
// Redirect after plugin activation
add_action( 'admin_init', array( 'WR_Megamenu_Plugin', 'do_activation_redirect' ) );

// Register WR MegaMenu Plugin initialization
add_action( 'wr_megamenu_init', array( 'WR_Megamenu_Plugin', 'init' ) );
// Initialize WR Library
WR_Megamenu_Init_Plugin::hook();
