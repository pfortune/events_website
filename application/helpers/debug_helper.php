<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Print Nice
 *
 * Takes an array or object. Makes print_r() easier to read in a browser.
 *
 * @access	public
 * @param	array or object
 */

if ( ! function_exists('print_nice'))
{
	function print_nice($array)
	{
		echo "<pre>";
		echo print_r($array);
		echo "</pre>";
	}
}