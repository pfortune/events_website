<?php

/**
 * Description of MY_Controller
 *
 * @author Peter
 */
class MY_Controller extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }
}

class Public_Controller extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		
                //$this->output->enable_profiler(TRUE);
                $this->load->model('home_m');
               

		/*
		if($this->config->item('site_closed') === TRUE)
		{
			show_error('Sorry the site is down for maintenance.');
		}
		
		$data['site_name'] = 'Culture Crawl Ireland';
		
		$this->template->set_theme('sunburst');
		$this->template->set_layout('default');
		$this->template->enable_parser(FALSE);
		*/
	}
}

class Admin_Controller extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		
	}
}