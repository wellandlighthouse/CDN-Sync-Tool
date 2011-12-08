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
		self::loadOptions();
		self::displayPage('options');
	}

	/**
	 * Gets the options from the database and populates and array
	 * 
	 */
	function loadOptions() {
		parent::$options['cst-cdn'] = get_option('cst-cdn');
		parent::$options['cst-s3-accesskey'] = get_option('cst-s3-accesskey');
		parent::$options['cst-s3-secretkey'] = get_option('cst-s3-secretkey');
	}

	/**
	 * Function to be run once the form is submitted
	 * 
	 */
	function formSubmitted() {
		if (wp_verify_nonce($GLOBALS['nonce'], 'cst-nonce')) {
			update_option('cst-cdn', $_POST['options']['cdn']);
			update_option('cst-s3-accesskey', $_POST['options']['cst-s3-accesskey']);
			update_option('cst-s3-secretkey', $_POST['options']['cst-s3-secretkey']);
		} else {
			_e('Security error');
			die;
		}
	}
}