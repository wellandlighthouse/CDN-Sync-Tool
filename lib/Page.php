<?php
/**
 * Page class
 *
 * Class to contain methods required to display pages
 *
 * @author Ollie Armstrong
 * @package CST
 * @copyright All rights reserved 2011
 * @license GNU GPLv2
 */
class CST_Page {
	/**
	 * Takes the page type and requires the correct file
	 * 
	 * @param $page 
	 */
	function displayPage($page) {
		require_once CST_DIR.'pages/'.$page.'.php';
	}
}