<?php

class CstTest extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->cst = $GLOBALS['core'];
	}

	public function testCstObject() {
		$this->assertInstanceOf('Cst', $this->cst);
	}
}
