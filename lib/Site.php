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
		ob_start(array($this, 'changeBuffer'));
	}

	public function stopOb() {
		ob_end_flush();
		return true;
	}

	public function changeBuffer($buffer) {
		if (get_option('cst-css-combine') == 'yes') {
			$buffer = $this->combineFiles($buffer, 'css');
		}
		return $buffer;
	}

	public function combineFiles($buffer, $filetype) {
		$stylesheetCombined = '';
		$stylesheets = array();
		$exclude = get_option('cst-'.$filetype.'-exclude');

		if ($filetype == 'css') {
			// Find all stylesheet links
			preg_match_all('$<link.*rel=[\'"]stylesheet[\'"].*?>$', $buffer, $stylesheets);
		}

		foreach ($stylesheets[0] as $stylesheet) {

			// Get the filepath
			$regex = '$';
			if ($filetype == 'css') {
				$regex .= 'href';
			} else {
				$regex .= 'src';
			}
			$regex .= '=[\'"]'.get_bloginfo('wpurl').'(.*?)\??[\'"]$';
			preg_match($regex, $stylesheet, $href);
			$path = $href[1];
			$path = preg_replace('$\.'.$filetype.'(\?.*)$', '.'.$filetype, $path);
			$path = ltrim($path, '/');

			// Check if exclude
			if (strpos($exclude, $path) !== false) {
				// File is excluded so skip
				continue;
			}
			
			// Remove the link from $buffer
			$buffer = str_replace($stylesheet, '', $buffer);

			$file = file_get_contents(ABSPATH.$path);

			if ($filetype == 'css') {
				// Replace relative urls with absolute urls to cdn
				$directory = str_replace(ABSPATH, '', dirname($path));
				$urls = array();
				preg_match_all('$url\((.*?)\)$', $file, $urls);
				$i = 0;
				foreach ($urls[1] as $url) {
					if (preg_match('$https?://|data:$', $url))
						continue;
					$newurl = get_option('ossdl_off_cdn_url').'/'.$directory.'/'.$url;
					$file = str_replace($urls[0][$i], 'url('.$newurl.')', $file);
					$i++;
				}
			}

			$stylesheetCombined .= $file;
		}

		// Create unique filename based on the md5 of the content
		$hash = md5($stylesheetCombined);
		$combinedFilename = ABSPATH.get_option('cst-'.$filetype.'-savepath').'/'.$hash.'.'.$filetype;

		if (!is_readable($combinedFilename)) {
			// File needs saving and syncing
			file_put_contents($combinedFilename, $stylesheetCombined);
			require_once CST_DIR.'lib/Cst.php';
			$core = new Cst;
			$core->createConnection();
			$core->pushFile($combinedFilename, get_option('cst-'.$filetype.'-savepath').'/'.$hash.'.'.$filetype);
		}
		
		// File can be loaded
		$fileUrl = get_option('ossdl_off_cdn_url').'/'.get_option('cst-'.$filetype.'-savepath').'/'.$hash.'.'.$filetype;
		if ($filetype == 'css') {
			$linkTag = '<link rel="stylesheet" type="text/css" href="'.$fileUrl.'" />';
		}
		$buffer = preg_replace('$<head[^er]*>$', '<head>'.$linkTag, $buffer);

		return $buffer;
	}
}
