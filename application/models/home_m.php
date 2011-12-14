<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home_m extends CI_Model
{

    protected $categories = array();
    protected $featured = array();
    protected $bydate = array();
    protected $byloc = array();
    protected $new = array();
    protected $counties = array('Dublin',
        'Belfast',
        'Carlow',
        'Cavan',
        'Clare',
        'Cork',
        'Donegal',
        'Galway',
        'Kerry',
        'Kildare',
        'Kilkenny',
        'Laois',
        'Leitrim',
        'Limerick',
        'Longford',
        'Louth',
        'Mayo',
        'Meath',
        'Monaghan',
        'Offaly',
        'Roscommon',
        'Sligo',
        'Tipperary',
        'Waterford',   
        'Westmeath',
        'Wexford',
        'Wicklow'
    );

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('event_m');
	}

    public function get_latest($limit=5)
    {
        $this->load->model('event_m');

        return $this->event_m->get_events_ireland($limit);
    }

    public function get_counties()
    {
        return $this->counties;
    }

	public function get_local($city='Dublin')
	{
		return $this->event_m->get_events($city);
	}

}

/* End of file home_m.php */
/* Location: ./application/models/home_m.php */