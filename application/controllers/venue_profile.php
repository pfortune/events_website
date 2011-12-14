<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Venue_profile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('venue_m');
		$this->load->library('googlemaps');
	}

	public function profile()
	{
		$data['venue'] = $this->venue_m->get_venue($this->uri->segment(4));
		$data['upcoming_events'] = $this->venue_m->get_upcoming_events($this->uri->segment(4));
		
		if($data['venue']->geo_lat != 0 && $data['venue']->geo_long != 0)
		{
			$this->googlemaps->initialize();
			$data['map'] = $this->googlemaps->create_map();
		}
		else
		{
			$data['map']['html'] = "No map to display, sorry.";
			$data['map']['js'] = "";
		}
		
		$data['map'] = $this->_map($data['venue']->geo_lat, $data['venue']->geo_long); 

		$this->template->set_layout('one_col');
		$this->template->title($data['venue']->name." venue in ". $data['venue']->county);
		// does venue have proper co-ordinates? if so, append map js to header
		if ($data['venue']->geo_lat != 0 && $data['venue']->geo_long != 0)
		{
		    $this->template->append_metadata($data['map']['js']);
		}
		$this->template->build('venue_profile/profile', $data);
	}
	
	public function events()
	{
		$this->load->view('venue_profile/events', $data);
	}
	
	public function past_events()
	{
		$this->venue_m->get_past_events();
		
		$this->load->view('venue_profile/past_events', $data);
	}
	
	public function _map($geo_lat, $geo_long)
	{
		$this->load->library('googlemaps');
		
		// initialise map
		$config['center'] = "$geo_lat, $geo_long";
		$config['zoom'] = 16;
		$this->googlemaps->initialize($config);

		// Add the first marker
		$marker = array();
		$marker['position'] = "$geo_lat, $geo_long";
		$marker['infowindow_content'] = '1- Hello World!';
		$this->googlemaps->add_marker($marker);
		
		return $this->googlemaps->create_map();
	}
	
}

/* End of file venue_profile.php */
/* Location: ./application/controllers/venue_profile.php */