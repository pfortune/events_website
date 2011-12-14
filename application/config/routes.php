<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There is one reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
*/

$route['default_controller'] = "home";

/**
* Admin Routing
*/

$route['admin'] = 'admin/init';
$route['admin/login'] = "admin/login";
$route['admin/update'] = 'admin/update';

/*

High level event route

*/
$route['events'] = "events/all_ireland";


/**
* County Array for Event Routing
*/
$counties = array('Dublin', 'Belfast', 'Wicklow', 'Wexford', 'Carlow', 'Kildare', 'Meath', 'Louth', 'Monaghan', 'Cavan', 'Longford', 'Westmeath', 'Offaly', 'Laois', 'Kilkenny', 'Waterford', 'Cork', 'Kerry', 'Limerick', 'Tipperary', 'Clare', 'Galway', 'Mayo', 'Roscommon', 'Sligo', 'Leitrim', 'Donegal');

foreach($counties as $county){
	/*
	* Event List Routing
	*/
	$route[strtolower($county)."/events"] = "events/index/{$county}";
	
	/*
	* Event Pagination Routing
	*/
	$route[strtolower($county)."/events/page/(:any)"] = "events/index/{$county}/$1";
	
	/*
	* Event Profile Routing
	*/
	$route[strtolower($county).'/events/(:any)/(:num)'] = 'event_profile/profile/$1/$2';
	
	/*
	* Venue Profile Routing
	*/
	$route[strtolower($county).'/venues/(:any)/(:num)'] = 'venue_profile/profile/$1/$2';
	
	//wexford/events/recital-with-pam-chowhan/1630785
	
}


/**
* Standard Site Page Routing
*/

$route['about'] = 'site/about';
$route['feedback'] = 'site/feedback';
$route['contact'] = 'site/contact';
$route['terms'] = 'site/terms';
$route['privacy'] = 'site/privacy';

/**
* Testing Purposes
*/

$route['test'] = 'home/test';


/* End of file routes.php */
/* Location: ./application/config/routes.php */