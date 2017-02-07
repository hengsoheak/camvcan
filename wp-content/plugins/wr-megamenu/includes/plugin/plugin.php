<?php
/**
 * @version    $Id$
 * @package    WR MegaMenu
 * @author     WooRockets Team <support@woorockets.com>
 * @copyright  Copyright (C) 2014 WooRockets.com All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Websites: http://www.woorockets.com
 * Technical Support:  Feedback - http://www.woorockets.com
 */

/**
 * WR MegaMenu plugin initialization.
 *
 * @package  WR_Megamenu
 * @since	1.0.0
 */

class WR_Megamenu_Plugin {
	/**
	 * Initialize WR Sample plugin.
	 *
	 * @return  void
	 */
	public static function init() {
		global $wp_widget_factory, $mega_menu, $wr_megamenu_element, $wr_megamenu_widgets;

		// Init neccessary WR Library classes
		WR_Megamenu_Init_Admin_Menu::hook();
		// Load required assets
		WR_Megamenu_Assets::init();

		WR_Megamenu_Init_Assets	::hook();
		// Load update simulator
		WR_Megamenu_Update_Simulator::hook();

		// Init element
		$wr_megamenu_element = new WR_Megamenu_Element();
		$wr_megamenu_element->init();

		//
		if ( is_admin() ){
			$mega_menu = new WR_Megamenu_Core_Backend();

			// Insert WooRockets banner
			global $pagenow;
			$post_type = '';
			if ( ( $pagenow == 'post-new.php' ) && ( isset( $_REQUEST['post_type'] ) ) ) {
				$post_type = $_REQUEST['post_type'];
			}
			elseif ( ( $pagenow == 'post.php' ) && ( isset( $_REQUEST['post'] ) ) ) {
				$post_type = get_post_type( $_REQUEST['post'] );
			}
			if ( $post_type == 'wr_megamenu_profile' ) {
				self::insert_banner();
			}
		} else {
			// Process menu frontend
			$frontend = new WR_Megamenu_Core_Frontend();
			$frontend->apply_megamenu();
		}

		// Register 'admin_menu' action
		add_action( 'admin_menu', array( __CLASS__, 'admin_menu' ) );

		// Register 'wr_mm_installed_product' filter
		add_filter( 'wr_mm_installed_product', array( __CLASS__, 'register_product' ) );

		// Initialize widget support
		$wr_megamenu_widgets = ! empty( $wr_megamenu_widgets ) ? $wr_megamenu_widgets : WR_Megamenu_Helpers_Functions::widgets();


	}

	/**
	 * Do 'admin_menu' action.
	 *
	 * @return  void
	 */
	public static function admin_menu() {
		// Register admin menu
		WR_Megamenu_Admin_Menu::init();
	}

	/**
	 * Apply 'wr_mm_installed_product' filter.
	 *
	 * @param   array  $plugins  Array of installed WooRockets product.
	 *
	 * @return  array
	 */
	public static function register_product( $plugins ) {
		// Register product identification
		$plugins[] = WR_MEGAMENU_IDENTIFIED_NAME;

		return $plugins;
	}

	/**
	 * Insert WooRockets banner.
	 * 
	 * @return void
	 */
	public static function insert_banner() {

		$style = '
			/*** Premium ***/
			#wr-promo-ab {
				background: url(' . WR_MEGAMENU_ROOT_URL . 'assets/woorockets/images/about-us/bg-wr-promo.jpg) center top no-repeat;
				background-size: cover;
				text-align: center;
				overflow: hidden;
				font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
				padding: 100px 0;
			}
			#wr-promo-ab .logo-slogan p {
				color: #fff;
				font-size: 18px;
				font-weight: bold;
				margin: 20px 0 50px;
			}

			#wr-promo-ab .btn-premium {
				margin: 0;
			}

			#wr-promo-ab .btn-premium a {
			    display: inline-block;   
			    margin: 0;
			    background: #418858;
			    color: #fff;
			    padding: 10px 25px;
			    border-radius: 3px;
			    -o-border-radius: 3px;
			    -ms-border-radius: 3px;
			    -moz-border-radius: 3px;
			    -webkit-border-radius: 3px;
			    font-size: 11px;
			    box-shadow: 0 4px 0 0 #2a6d40;
			    -o-box-shadow: 0 4px 0 0 #2a6d40;
			    -ms-box-shadow: 0 4px 0 0 #2a6d40;
			    -moz-box-shadow: 0 4px 0 0 #2a6d40;
			    -webkit-box-shadow: 0 4px 0 0 #2a6d40;
			    text-decoration: none;
			    transition: all 0.3s;
			    -o-transition: all 0.3s;
			    -ms-transition: all 0.3s;
			    -moz-transition: all 0.3s;
			    -webkit-transition: all 0.3s;
			    font-size: 13px;
			}
			#wr-promo-ab .btn-premium a:hover {
			    background: #2a6d40;
			    text-decoration:none;
			    box-shadow: 0 4px 0 0 #418858;
			    -o-box-shadow: 0 4px 0 0 #418858;
			    -ms-box-shadow: 0 4px 0 0 #418858;
			    -moz-box-shadow: 0 4px 0 0 #418858;
			    -webkit-box-shadow: 0 4px 0 0 #418858;
			}
        ';
		WR_Megamenu_Init_Assets::inline( 'css', $style );

		$content = '<div id=\"wr-promo-ab\"> <div class=\"logo-slogan\"> <img src=\"http://www.woorockets.com/images/nitro-logo-white.png\" /> <p>' . __( 'Universal WooCommerce Theme from ecommerce experts', WR_MEGAMENU_TEXTDOMAIN ) . '</p> </div> <p class=\"btn-premium\"><a href=\"http://www.woorockets.com/themes/?utm_source=MegaMenu&utm_medium=About&utm_campaign=Cross%20Promo%20Banner\" target=\"_blank\">' . __( 'Explore Now', WR_MEGAMENU_TEXTDOMAIN ) . '</a></p> </div> ';

		$script = '
			$("#side-sortables").append("' . $content . '");
		';
		WR_Megamenu_Init_Assets::inline( 'js', $script );
	}

	/**
	 * Fired when plugin is activated.
	 *
	 * @return void
	 */
	public static function on_activation() {
		update_option( 'wr_megamenu_do_activation_redirect', 'Yes' );
	}

	/**
	 * Do activation redirect
	 *
	 * @return void
	 */
	public static function do_activation_redirect() {
		if ( get_option( 'wr_megamenu_do_activation_redirect', 'No' ) == 'Yes' ) {
			update_option( 'wr_megamenu_do_activation_redirect', 'No' );
			wp_redirect( admin_url( 'edit.php?post_type=wr_megamenu_profile&page=wr-megamenu-about-us' ) );
		}
	}

}
