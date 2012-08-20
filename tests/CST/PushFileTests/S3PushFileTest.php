<?php

class S3PushFileTest extends WP_UnitTestCase {
	public function setUp() {
		parent::setUp();
		$this->cst = $GLOBALS['core'];
	}

	public function testS3UploadImage() {
		require CST_DIR.'tests/CST/ConnectionTests/S3ConnectionSettings.php';
		update_option('cst-s3-accesskey', $accesskey);
		update_option('cst-s3-secretkey', $secretkey);
		update_option('cst-s3-bucket', $bucket);
		$this->cst->connectionType = 'S3';
		$this->cst->createConnection();

		$this->cst->pushFile(CST_DIR.'tests/CST/PushFileTests/300x120.gif', 'image.gif');
	}
}
