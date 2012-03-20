<?php
/*
Plugin Name: CDN Sync Tool
Plugin URI: http://www.olliearmstrong.co.uk
Description: Allows wordpress owners to sync their static files to CDN
Author: Fubra Limited
Author URI: http://www.catn.com
Version: 2.0
*/

global $wpdb;

define('CST_DIR', dirname(__FILE__).'/');
define('CST_VERSION', '2.0');
define('CST_URL', admin_url('options-general.php'));
define('CST_FILE', __FILE__);
define('CST_TABLE_FILES', $wpdb->get_blog_prefix().'cst_files');
define('CST_CONTACT_EMAIL', 'support@catn.com');


if (is_admin()) {
	require_once CST_DIR.'lib/Cst.php';
	$core = new Cst();
}

function cst_install() {
	global $wpdb;

	if (get_option('cst_cdn')) {
		$cdnOptions = get_option('cst_cdn');
		if ($cdnOptions['provider'] == 'aws') {
			update_option('cst-cdn', 'S3');
			if (isset($cdnOptions['access']))
				update_option('cst-s3-accesskey', $cdnOptions['access']);
			if (isset($cdnOptions['secret']))
				update_option('cst-s3-secretkey', $cdnOptions['secret']);
			if (isset($cdnOptions['bucket_name']))
				update_option('cst-s3-bucket', $cdnOptions['bucket_name']);
		} else if ($cdnOptions['provider'] == 'ftp') {
			update_option('cst-cdn', 'FTP');
			if (isset($cdnOptions['username']))
				update_option('cst-ftp-username', $cdnOptions['username']);
			if (isset($cdnOptions['password']))
				update_option('cst-ftp-password', $cdnOptions['password']);
			if (isset($cdnOptions['server']))
				update_option('cst-ftp-server', $cdnOptions['server']);
			if (isset($cdnOptions['port']))
				update_option('cst-ftp-port', $cdnOptions['port']);
			if (isset($cdnOptions['directory']))
				update_option('cst-ftp-dir', $cdnOptions['directory']);

		}
	}

	$wpdb->query("
		CREATE TABLE IF NOT EXISTS ".CST_TABLE_FILES." (
		  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
		  `file_dir` text NOT NULL,
		  `remote_path` text NOT NULL,
		  `changedate` int(11) DEFAULT NULL,
		  `synced` tinyint(1) NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
	");

	update_option('cst-js-savepath', 'wp-content/uploads');
	wp_schedule_event(time(), 'hourly', 'cron_cst_sync');
}

function cst_deactivate() {
	wp_clear_scheduled_hook('cron_cst_sync');
}

function hourlySync() {
	$core->syncFiles();
}

register_activation_hook(__FILE__, "cst_install");
register_deactivation_hook(__FILE__, 'cst_deactivate');
add_action('cron_cst_sync', 'hourlySync');
