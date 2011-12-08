<?php
/**
 * Core CST class
 *
 * Class that contains all of the methods needed to create connections, push files, etc.
 *
 * @author Ollie Armstrong
 * @package CST
 * @copyright All rights reserved 2011
 * @license GNU GPLv2
 */
class Cst {
	protected $awsAccessKey, $awsSecretKey, $cdnConnection, $connectionType;

	function __construct() {
		$this->connectionType = 'S3';
		$this->createConnection();
		add_action('admin_menu', array($this, 'createPages'));

		// Create nonce
		add_action('init', array($this, 'createNonce'));
	}

	function createNonce() {
		$GLOBALS['nonce'] = wp_create_nonce('cst-nonce');
	}

	/**
	 * Creates the admin page(s) required
	 * 
	 */
	function createPages() {
		require_once CST_DIR.'lib/pages/Options.php';
		add_options_page('CST Options', 'CDN Sync Tool', 'manage_options', 'cst', array('CST_Page_Options', 'page'));
	}

	/**
	 * Initialises the connection to the CDN
	 * 
	 */
	function createConnection() {
		if ($this->connectionType = 'S3') {
			require_once CST_DIR.'lib/api/S3.php';
			$this->awsAccessKey = 'AKIAJN7MVVP5GFYINGQQ';
			$this->awsSecretKey = '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';
			$this->cdnConnection = new S3($this->awsAccessKey, $this->awsSecretKey);
		}
	}

	/**
	 * Pushes a file to the CDN
	 * 
	 */
	function pushFile() {
		if ($this->connectionType = 'S3') {
			// Puts a file to the bucket
			// putObjectFile(localName, bucketName, remoteName, ACL)
			$this->cdnConnection->putObjectFile('test.txt', 'ollie-armstrong-dev-test', 'test.txt', S3::ACL_PUBLIC_READ);
		}
	}
}