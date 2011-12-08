<?php
/*
Plugin Name: CDN Sync Tool
Plugin URI: http://www.olliearmstrong.co.uk
Description: Allows wordpress owners to sync their static files to CDN
Author: Fubra Limited
Author URI: http://www.catn.com
Version: 3.0
*/

define('CST_DIR', dirname(__FILE__).'/');
define('CST_VERSION', '1.0');
define('CST_URL', admin_url('options-general.php'));
define('CST_FILE', __FILE__);

if (is_admin()) {
	require_once CST_DIR.'lib/Cst.php';
	$core = new Cst();
}