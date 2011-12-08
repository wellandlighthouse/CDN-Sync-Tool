<?php

class Cst {
	protected $awsAccessKey, $awsSecretKey, $cdnConnection, $connectionType;

	function __construct() {
		$this->connectionType = 'S3';
		$this->createConnection();
	}

	function createConnection() {
		if ($this->connectionType = 'S3') {
			require_once CST_DIR.'lib/api/S3.php';
			$this->awsAccessKey = 'AKIAJN7MVVP5GFYINGQQ';
			$this->awsSecretKey = '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';
			$this->cdnConnection = new S3($this->awsAccessKey, $this->awsSecretKey);
		}
	}

	function pushFile() {
		if ($this->connectionType = 'S3') {
			// Puts a file to the bucket
			// putObjectFile(localName, bucketName, remoteName, ACL)
			$this->cdnConnection->putObjectFile('test.txt', 'ollie-armstrong-dev-test', 'test.txt', S3::ACL_PUBLIC_READ);
		}
	}
}