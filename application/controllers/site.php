<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Site extends Public_Controller
{

    public function about()
    {
        $data['counties'] = $this->home_m->get_counties();
        $this->template
                ->set_layout('default')
                ->build('site/about', $data);
    }

    public function contact()
    {
        // handle forms
        $data['counties'] = $this->home_m->get_counties();
        $this->template
                ->set_layout('default')
                ->build('site/contact', $data);
    }

    public function company()
    {
        //handle forms
        $data['counties'] = $this->home_m->get_counties();
        $this->load->view('site/company');
    }

    public function privacy()
    {
        $data['counties'] = $this->home_m->get_counties();
        $this->load->view('site/privacy');
    }

}

/* End of file site.php */
/* Location: ./application/controllers/site.php */