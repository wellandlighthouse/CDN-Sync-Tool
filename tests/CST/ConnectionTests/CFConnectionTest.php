<?php

class CFConnectionTest extends WP_UnitTestCase {
	public function setUp() {
		parent::setUp();
		$this->cst = $GLOBALS['core'];
	}

	public function testGoodCFConnectionSettings() {
		require CST_DIR .'tests/CST/ConnectionTests/CFConnectionSettings.php';
		$this->cst->connectionType = 'Cloudfiles';
		update_option('cst-cf-username', $username);
		update_option('cst-cf-api', $apikey);
		update_option('cst-cf-region', $region);
		update_option('cst-cf-container', $container);
		$this->cst->createConnection();
		$this->assertInstanceOf('CF_Container', $this->cst->getConnection());
	}

	public function testBadCFConnectionSettings() {
		require CST_DIR .'tests/CST/ConnectionTests/CFConnectionSettings.php';

		// Bad username
		update_option('cst-cf-username', 'fakeuser28374');
		update_option('cst-cf-api', $apikey);
		update_option('cst-cf-region', $region);
		update_option('cst-cf-container', $container);
		$this->cst->createConnection();
		$this->assertFalse($this->cst->getConnection());

		// Bad apikey
		update_option('cst-cf-username', $username);
		update_option('cst-cf-api', 'aklsjdahf');
		update_option('cst-cf-region', $region);
		update_option('cst-cf-container', $container);
		$this->cst->createConnection();
		$this->assertFalse($this->cst->getConnection());
	}

}
