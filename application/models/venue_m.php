<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Venue_m extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
		log_message('debug', 'Venue Model Initialised');
	}
	
	public function get_venue($venue_id)
	{
		$this->db->select('*');
        $this->db->from('venues');
        $this->db->where('venue_id', $venue_id);
        $query = $this->db->get();

        return $query->row();
	}
	
	// Return the 5 most upcoming events
	public function get_upcoming_events($venue_id)
	{
		$now = strtotime('now');
		
	    $this->db->select('events.event_id, events.title, events.start_date, venues.city, venues.name');
	    $this->db->from('events');
		$this->db->join('venues', 'venues.venue_id = events.venue_id', 'inner');
		$this->db->where("venues.venue_id", $venue_id);
		$this->db->where("events.start_date >= $now");
		$this->db->order_by('start_date', 'ASC');
        $this->db->limit(95);
        $query = $this->db->get();
		
		if ($query->num_rows > 0)
        {
             return $query->result();
        }
        else
        {
             return FALSE;
        }
	}
	
	public function get_events()
	{
		return $data;
	}
	
	public function get_past_events()
	{
		return $data;
	}
}


/* End of file venue_m.php */
/* Location: ./application/models/venue_m.php */