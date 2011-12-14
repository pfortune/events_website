

<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Start Date
 *
 * Takes a Unix timestamp and returns a date in the format of "Monday 7th November 2010"
 *
 * @access	public
 * @param	array or object
 */

if ( ! function_exists('start_date'))
{
	function start_date($timestamp, $option)
	{
            switch ($option):
                case 'no-year':
                    return date('l jS F', $timestamp);
                    break;
                case 'short-day':
                    return date('D jS F', $timestamp);
                    break;
                default:
                    return date('l jS F Y', $timestamp);
                    break;
            endswitch;
		
	}
}

/**
 * Start Time
 *
 * Takes a Unix timestamp and returns a time in the format of "8:03PM"
 *
 * @access	public
 * @param	array or object
 */

if ( ! function_exists('start_time'))
{
	function start_time($timestamp)
	{
		return date('g:iA', $timestamp);
	}
}

/**
 * Start Time
 *
 * Takes a Unix timestamp and returns a time in the format of "8:03PM"
 *
 * @access	public
 * @param	array or object
 */

if ( ! function_exists('in_past'))
{
	function in_past($timestamp)
	{
		if($timestamp < time())
                {
                    ;
                }
	}
}

/**
 * Event Link
 *
 * Takes a Unix timestamp and returns a time in the format of "8:03PM"
 *
 * @access	public
 * @param	array or object
 */
if ( ! function_exists('event_link'))
{
	function event_link($county, $title, $id)
	{
		return anchor('/'.strtolower($county).'/events/'.url_title(substr($title,0,50), 'dash', TRUE).'/'.$id.'/', $title);
	}	
}

/**
 * Events Link
 *
 * Takes a Unix timestamp and returns a time in the format of "8:03PM"
 *
 * @access	public
 * @param	array or object
 */
if ( ! function_exists('events_link'))
{
	function events_link($county)
	{
		return anchor('/'.strtolower($county).'/events/', ucfirst($county));
	}	
}


/**
 * Venue Link
 *
 * Takes a Unix timestamp and returns a time in the format of "8:03PM"
 *
 * @access	public
 * @param	array or object
 */
if ( ! function_exists('venue_link'))
{
	function venue_link($id, $county, $name)
	{
		return anchor('/'.strtolower($county).'/venues/'.url_title(substr($name,0,50), 'dash', TRUE).'/'.$id.'/', $name);
	}	
}