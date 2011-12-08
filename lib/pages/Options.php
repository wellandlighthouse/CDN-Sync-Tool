<?php
require_once CST_DIR.'lib/Page.php';
/**
 * Options page
 *
 * Class to call the display for options page
 *
 * @author Ollie Armstrong
 * @package CST
 * @copyright All rights reserved 2011
 * @license GNU GPLv2
 */
class CST_Page_Options extends CST_Page {
	/**
	 * Displays the page
	 * 
	 */
	function page() {
		// If this page's form is submitted, run the function before displaying page
		if (isset($_POST['form']) && $_POST['form'] == 'options')
			self::formSubmitted();

		self::displayPage('options');
	}

	/**
	 * Function to be run once the form is submitted
	 * 
	 */
	function formSubmitted() {
		echo 'done';
	}
}