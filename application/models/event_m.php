<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Event_m extends CI_Model
{

    private $now;

    public function __construct()
    {
        parent::__construct();

        log_message('debug', 'Event Model Initialised');
        $this->now = time();
    }

    // Return a single event
    public function get_event($event_id)
    {
        $this->db->select('*');
        $this->db->from('events');
        $this->db->where('event_id', $event_id);
        $query = $this->db->get();

        return $query->row();
    }

    public function get_events($county="dublin", $limit=10, $offset=NULL)
    {

        $this->db->select('events.event_id, events.title, events.start_date, venues.city, venues.county, venues.venue_id, venues.name AS venue');
        $this->db->from('events');
        $this->db->join('venues', 'venues.venue_id = events.venue_id', 'inner');
        $this->db->where("venues.city", $county);
        $this->db->where("events.start_date >= $this->now");
        $this->db->order_by('start_date', 'ASC');
        $this->db->limit($limit);
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

    public function get_events_ireland($limit)
    {

        $this->db->select('events.event_id, events.title, events.start_date, venues.city, venues.venue_id, venues.county, venues.name AS venue');
        $this->db->from('events');
        $this->db->join('venues', 'venues.venue_id = events.venue_id', 'inner');
        $this->db->where("events.start_date >= $this->now");
        $this->db->order_by('start_date', 'ASC');
        $this->db->limit($limit);
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

    public function get_featured()
    {
        $data = array('event' => 'Oxygen',
            'month' => 'September',
            'county' => 'Waterford'
        );

        return $data;
    }

    public function similar_to($title, $county="dublin", $limit=10)
    {

        $this->db->select('events.event_id, events.title, events.start_date, venues.city, venues.name AS venue');
        $this->db->from('events');
        $this->db->join('venues', 'venues.venue_id = events.venue_id', 'inner');
        $this->db->where("venues.city", $county);
        $this->db->where("events.start_date >= $this->now");
        $this->db->like('title', $title);
        $this->db->order_by('start_date', 'ASC');
        $this->db->limit($limit);
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

}

/* End of file event_m.php */
/* Location: ./application/models/event_m.php */