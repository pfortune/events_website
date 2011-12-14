<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event_profile extends Public_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('event_m');
		$this->load->model('venue_m');
	}

	// dublin/events/katie-perry-the-o2/302933
	public function profile()
	{
		
		$event_id = $this->uri->segment(4);
		$county = $this->uri->segment(1);
		$data['event'] = $this->event_m->get_event($event_id);
		$data['venue'] = $this->venue_m->get_venue($data['event']->venue_id);
		$data['similar_events'] = $this->event_m->similar_to($data['event']->title, $county, $event_id);

		$data['map'] = $this->_map($data['venue']->geo_lat, $data['venue']->geo_long); 
		
		$this->template->set_layout('one_col');
		$this->template->title($data['event']->title." event at ". $data['venue']->name." in ". $data['venue']->county." on ". start_date($data['event']->start_date, 'day-month-year'));
		// does venue have proper co-ordinates? if so, append map js to header
		if ($data['venue']->geo_lat != 0 && $data['venue']->geo_long != 0)
		{
		    $this->template->append_metadata($data['map']['js']);
		}
		$this->template->build('event_profile/profile', $data);
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

/* End of file event_profile.php */
/* Location: ./application/controllers/event_profile.php */