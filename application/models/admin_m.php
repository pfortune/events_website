<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*

The purpose of the Admin Model is to initialise and update the Events database.

*/

class Admin_m extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('home_m');
		
		log_message('debug', 'Admin Model Initialised');
	}
	
	public function counties_list()
	{
		return $this->home_m->get_counties();
	}
	
	public function add($data, $id)
	{
		$this->db->select('event_id')->from('events')->where('event_id', $id);

		$query = $this->db->get();

		if ($query->num_rows === 0)
		{
			if($this->db->insert('events', $data))
			{
				return TRUE;
			}

			return FALSE;
		}
	}

	public function update($data, $id)
	{
		$this->db->where('event_id', $id);
		
		if($this->db->update('events', $data))
		{
			return TRUE;
		}

		return FALSE;
	}
	
	public function add_and_update($data, $id)
	{
		$this->db->select('event_id')->from('events')->where('event_id', $id);

		$query = $this->db->get();

		if ($query->num_rows === 0)
		{
			if($this->db->insert('events', $data))
			{
				return TRUE;
			}

			return FALSE;
		}
		else
		{
			$this->update($data, $id);
		}
	}
	
	public function add_venue($data, $id)
	{
		$this->db->select('venue_id')->from('venues')->where('venue_id', $id);
		
		$query = $this->db->get();
		
		if ($query->num_rows === 0)
		{
			if($this->db->insert('venues', $data))
			{
				return TRUE;
			}
			
			return FALSE;
		}
		else
		{
			$this->update_venue($data, $id);
		}
	}
	
	public function update_venue($data, $id)
	{
		$this->db->where('venue_id', $id);
		
		if($this->db->update('venues', $data))
		{
			return TRUE;
		}
		
		return FALSE;
	}
	
	public function venues($city)
	{
		if( $city !== FALSE )
		{
			$this->db->select('venue_id')->from('venues')->where('city', $city);
		}
		else
		{
			$this->db->select('venue_id')->from('venues');
		}
		
		return $this->db->get();
	}
	
	public function venues_with_events()
	{
		$this->db->select('venue_id')->from('events')->distinct();
		
		return $this->db->get();
	}

	public function select_all()
	{
		$this->db->select('event_id');
		$this->db->from('events');
		$query = $this->db->get();

		return $query->result();
	}

	public function event_ids($limit=FALSE)
	{
		return $this->db->select('event_id')->limit($limit)->get('events')->result();
	}

	public function create_table()
	{
		$this->load->dbforge();

		$fields = array(
				'event_id' => array(
						'type' => 'INT',
						'constraint' => '10',
				),
				'title' => array(
						'type' => 'VARCHAR',
						'constraint' => '128',
				),
				'artists' => array(
						'type' => 'TEXT'
				),
				'headliner' => array(
						'type' => 'VARCHAR',
						'constraint' => '128',
				),
				'venue_id' => array(
						'type' => 'INT',
						'constraint' => '10',
				),
				'start_date' => array(
						'type' => 'INT',
						'constraint' => '10',
				),
				'description' => array(
						'type' => 'TEXT'
				),
				'small_image' => array(
						'type' => 'VARCHAR',
						'constraint' => '256',
				),
				'medium_image' => array(
						'type' => 'VARCHAR',
						'constraint' => '256',
				),
				'large_image' => array(
						'type' => 'VARCHAR',
						'constraint' => '256',
				),
				'extralarge_image' => array(
						'type' => 'VARCHAR',
						'constraint' => '256',
				),
				'website' => array(
						'type' => 'VARCHAR',
						'constraint' => '256',
				),
				'published' => array(
						'result' => 'INT',
						'constraint' => '1',
						'default' => '0',
				),
		);

		$this->dbforge->add_key('event_id', TRUE)->add_field($fields);
		
		if($this->dbforge->create_table('events', TRUE))
		{
			return TRUE;
		}

		return FALSE;
	}
	
}