<?php

class S3ConnectionTest extends WP_UnitTestCase {
	public $plugin_slug = 'cdn-sync-tool';

	public function setUp() {
		parent::setUp();
		$this->cst = $GLOBALS['core'];
	}

	public function testGoodS3ConnectionSettings() {
		require CST_DIR . 'tests/CST/ConnectionTests/S3ConnectionSettings.php';
		update_option('cst-s3-accesskey', $accesskey);
		update_option('cst-s3-secretkey', $secretkey);
		$this->cst->connectionType = 'S3';
		$this->cst->createConnection();
		$this->assertNotNull($this->cst->getConnection(), 'CDN Connection has not been created correctly');
	}

	public function testBadS3ConnectionSettings() {
		require CST_DIR . 'tests/CST/ConnectionTests/S3ConnectionSettings.php';
		// Check incorrect accesskey
		update_option('cst-s3-accesskey', 'askdjadjs');
		update_option('cst-s3-secretkey', $secretkey);
		$this->cst->connectionType = 'S3';
		$this->cst->createConnection();
		$this->assertFalse($this->cst->getConnection(), 'CDN Connection was still created on false credentials');
		
		// Check incorrect secretkey
		update_option('cst-s3-accesskey', $accesskey);
		update_option('cst-s3-secretkey', 'asdjasldkjalksd');
		$this->cst->connectionType = 'S3';
		$this->cst->createConnection();
		$this->assertFalse($this->cst->getConnection(), 'CDN Connection was still created on false credentials');
		
		// Check incorrect both
		update_option('cst-s3-accesskey', 'alksdjalksd');
		update_option('cst-s3-secretkey', 'aksdjkjf');
		$this->cst->connectionType = 'S3';
		$this->cst->createConnection();
		$this->assertFalse($this->cst->getConnection(), 'CDN Connection was still created on false credentials');
	}

}