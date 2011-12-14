<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends Public_Controller {

	public $data = array();
	public $date = array();
	
	public function __construct()
	{
		parent::__construct();
                
		$this->load->model('event_m');
		$this->load->library('lastfm');
                
		log_message('debug', 'Events Controller Initialized');
	}
	
	public function all_ireland()
	{
		$data['events'] = $this->event_m->get_events_ireland(100);	
                $data['counties'] = $this->home_m->get_counties();
		$this->template
			->set_layout('default')
                        ->title("Events in Ireland. What's on in Ireland. Upcoming Events in Ireland. ")
			->build('event/index', $data);
	}

	
	public function index($county, $page=NULL)
	{	
		$data['events'] = $this->event_m->get_events($county, 100);
                $data['counties'] = $this->home_m->get_counties();
                
                $county = ucfirst($this->uri->segment(1));
                
		$this->template
			->set_layout('default')
                        ->title($county ." events. What's on in ".$county .". Upcoming ".$county." events listing.")
			->build('event/index', $data);
	}
	
	public function today()
	{
		$this->load->view('event/today', $data);
	}
	
	public function tomorrow()
	{
		$this->load->view('event/tomorrow', $data);
	}
	
	public function next_month()
	{
		$this->load->view('event/next_month', $data);
	}
	
	public function last_month()
	{
		$this->load->view('event/last_month', $data);
	}
	
	public function more()
	{
		$this->load->view('event/more', $data);
	}
}

/* End of file events.php */
/* Location: ./application/controllers/events.php */