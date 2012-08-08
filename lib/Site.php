<?php
/**
 * Class to handle all of the functions for the site frontend
 *
 * @author Ollie Armstrong
 * @package CST
 * @copyright All rights reserved 2012
 * @license GNU GPLv2
 */
class Cst_Site {
	public function __construct() {
		self::_addHooks();
	}

	private function _addHooks() {
		add_action('wp_loaded', array($this, 'startOb'));
		add_action('wp_footer', array($this, 'stopOb'));
	}

	public function startOb() {
		ob_start(array($this, 'combineFiles'));
	}

	public function stopOb() {
		ob_end_flush();
		return true;
	}

	public function combineFiles($buffer) {
		$stylesheetCombined = '';
		$stylesheets = array();
		// Find all stylesheet links
		preg_match_all('$<link.*rel=[\'"]stylesheet[\'"].*?>$', $buffer, $stylesheets);
		foreach ($stylesheets[0] as $stylesheet) {
			// Remove the stylesheet link from $buffer
			$buffer = str_replace($stylesheet, '', $buffer);

			// Get the filepath of the stylesheet
			preg_match('$href=[\'"]'.get_bloginfo('wpurl').'(.*?)\??[\'"]$', $stylesheet, $href);
			$path = $href[1];
			$path = preg_replace('$\.css(\?.*)$', '.css', $path);
			$path = ABSPATH.ltrim($path, '/');

			$file = file_get_contents($path);

			// TODO:
			// * go through stylesheet and replace all urls with absolute paths
			// * check file exclusion list

			$stylesheetCombined .= $file;
		}

		// Create unique filename based on the md5 of the content
		$hash = md5($stylesheetCombined);
		$combinedFilename = ABSPATH.get_option('cst-css-savepath').'/'.$hash.'.css';

		if (!is_readable($combinedFilename)) {
			// File needs saving and syncing
			file_put_contents($combinedFilename, $stylesheetCombined);
			// TODO: sync file
		} else {
			// File can be loaded
			$fileUrl = get_bloginfo('wpurl').'/'.get_option('cst-css-savepath').'/'.$hash.'.css';
			$linkTag = '<link rel="stylesheet" type="text/css" href="'.$fileUrl.'" />';
			$buffer = preg_replace('$<head[^er]*>$', '<head>'.$linkTag, $buffer);
		}

		return $buffer;
	}
}
