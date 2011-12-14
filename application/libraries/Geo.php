<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Geo extends GeoAPI {
	private $_ci;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->_ci =& get_instance();

		log_message('debug', 'Geo IP class Initialized');
	}
	
	public function getCounty()
	{
		// County Waterford
		$string = $this->getRegion();
		
		// Remove "County " from $string
		$county = substr_replace($string, "", 0, 7);
		
		return $county;
	}
}

class GeoAPI {
	
	private $ip;
	private $data = array();
	

	public function __construct()
	{
		$this->ip = $_SERVER['REMOTE_ADDR'];
		
		$serialized_request = file_get_contents("http://www.geoplugin.net/php.gp?ip=$this->ip");
		$this->data = unserialize($serialized_request);
	}
	
	public function getIP()
	{
		return $this->ip;
	}
	
	public function getCity()
	{
		return $this->data['geoplugin_city'];
	}
	
	public function getRegion()
	{
		return $this->data['geoplugin_region'];
	}
	
	public function getCountryCode()
	{
		return $this->data['geoplugin_countryCode'];
	}
	
	public function getCountryName()
	{
		return $this->data['geoplugin_countryName'];
	}
	
	public function getContinentCode()
	{
		return $this->data['continentCode'];
	}
	
	public function getLatitude()
	{
		return $this->data['latitude'];
	}
	
	public function getLongitude()
	{
		return $this->data['longitude'];
	}
	
	public function getCurrencyCode()
	{
		return $this->data['currencyCode'];
	}
	
	public function __toString()
	{
		$this->locate();
		$desc = "You are located in ". $this->getCity();
		$desc .= " and your IP is: ". $this->getIP();
		
		return $desc; 
	}
}