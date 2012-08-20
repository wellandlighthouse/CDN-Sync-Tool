<?php

/**
 * @group connection
 */
class FTPConnectionTest extends WP_UnitTestCase {
	public $plugin_slug = 'cdn-sync-tool';

	public function setUp() {
		parent::setUp();
		$this->cst = $GLOBALS['core'];
	}

	public function testGoodFTPSettings() {
		require CST_DIR.'tests/CST/ConnectionTests/FTPConnectionSettings.php';
		update_option('cst-ftp-server', $server);
		update_option('cst-ftp-username', $username);
		update_option('cst-ftp-password', $password);
		update_option('cst-ftp-port', $port);

		$this->cst->connectionType = 'FTP';
		$this->cst->createConnection();

		$this->assertNotNull($this->cst->getConnection());
		$this->assertInternalType('resource', $this->cst->getConnection(), 'Couldn\'t create FTP connection');
	}

	public function testBadFTPSettings() {
		require CST_DIR.'tests/CST/ConnectionTests/FTPConnectionSettings.php';
		$this->cst->connectionType = 'FTP';

		// Incorrect server
		update_option('cst-ftp-server', 'example.com');
		update_option('cst-ftp-username', $username);
		update_option('cst-ftp-password', $password);
		update_option('cst-ftp-port', $port);
		$this->cst->createConnection();
		$this->assertFalse($this->cst->getConnection());

		// Nonexistant server
		update_option('cst-ftp-server', 'dontexist334.com');
		update_option('cst-ftp-username', $username);
		update_option('cst-ftp-password', $password);
		update_option('cst-ftp-port', $port);
		$this->cst->createConnection();
		$this->assertFalse($this->cst->getConnection());
	}

}