<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Public_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('event_m');
		$this->load->library('geo');
	}

	public function index()
	{	
		$is_ireland = $this->is_ireland();

		if ( $is_ireland === TRUE)
		{
			$data['county'] = $this->geo->getCounty();
			$data['local'] = $this->home_m->get_local($data['county']);
		}
		else
		{
			$data['county'] = 'Dublin';
			$data['local'] = $this->home_m->get_local();
		}
		
		$data['counties'] = $this->home_m->get_counties();
		$data['events'] = $this->home_m->get_latest(10);
		
		$this->template
			->set_layout('default')
                        ->title("Events in Ireland, Updated Daily. Things to do in Ireland.")
			->build('home/index', $data);
	}
	
	public function is_ireland()
	{
		$country = $this->geo->getCountryName();
		
		if ($country === 'Ireland')
		{
			return TRUE;
		}
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */