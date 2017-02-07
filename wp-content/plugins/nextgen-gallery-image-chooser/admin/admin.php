<?php
/**
 * nggicAdminPanel - Admin Section for NextGEN Gallery Image Chooser
 * 
 * @package NextGEN Gallery Image Chooser
 * @author Ulrich Mertin
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GPL Version 2
 */
class nggicAdminPanel{
	
	// constructor
	function __construct() {
		// add the admin menu
		add_action( 'admin_menu', array (&$this, 'add_menu') ); 

		// get the options
		$this->options = get_option('nggic_options');
  }

	// integrate the menu	
	function add_menu()  {
	    $options 	 = add_options_page('NGG Image Chooser', 'NGG Image Chooser', 'manage_options', 'nggic-options', array (&$this, 'show_menu') );

	}

	// load the script for the defined page  and load only this code	
	function  show_menu() {
		include_once (dirname (__FILE__). '/settings.php');		// settings
		nggic_admin_options();
	}

	/**
	 * Display a standard error message (using CSS ID 'message' and classes 'fade' and 'error)
	 *
	 * @param string $message Message to display
	 * @return void
	 **/
	
	function render_error ($message)
	{
		?>
		<div class="wrap"><h2>&nbsp;</h2>
		<div class="error" id="error">
		 <p><strong><?php echo $message ?></strong></p>
		</div></div>
		<?php
	}
	
	/**
	 * Display a standard notice (using CSS ID 'message' and class 'updated').
	 * Note that the notice can be made to automatically disappear, and can be removed
	 * by clicking on it.
	 *
	 * @param string $message Message to display
	 * @param int $timeout Number of seconds to automatically remove the message (optional)
	 * @return void
	 **/
	
	function render_message ($message, $timeout = 0)
	{
		?>
		<div class="wrap"><h2>&nbsp;</h2>
		<div class="fade updated" id="message" onclick="this.parentNode.removeChild (this)">
		 <p><strong><?php echo $message ?></strong></p>
		</div></div>
		<?php	
	}	
	
}
?>