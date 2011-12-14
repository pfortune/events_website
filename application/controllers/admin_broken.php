<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*

  The purpose of the Admin Controller is to Initialise and Update the events database.
  This is going to be some pretty messy code, and I'm not proud of it :-(

 */

class Admin extends Admin_Controller
{

    private $result = FALSE;
    private $county = "";
	private $count = 0;

    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(TRUE);

        $this->load->library('lastfm');
        $this->load->model('admin_m');
    }

    /*

      This method cycles through a list of Counties from the Admin_m model
      and adds all the venues from the Lastfm request to the database and
      updates existing ones.

      It also filters out Irish names for Cork and Kilkenny and replaces them
      with english names.

     */

    public function grab_venues($page=NULL)
    {
        $list = $this->admin_m->counties_list();

        foreach ($list as $county)
        {
            $this->county = $county;
            $data = $this->lastfm->venue_search($county, $county, $page, '500');

            foreach ($data->results->venuematches->venue as $venue)
            {
                if ($venue->location->country === 'Ireland')
                {
                    if ($venue->location->city === 'Cill Chainnigh')
                    {
                        $city = 'Kilkenny';
                    }
                    elseif ($venue->location->city === 'Corcaigh')
                    {
                        $city = 'Cork';
                    }
                    else
                    {
                        $city = $venue->location->city;
                    }

                    foreach ($venue->image as $image)
                    {
                        switch ($image->size)
                        {
                            case "large":
                                $large = $image->{'#text'};
                                break;
                            case "mega":
                                $mega_image = $image->{'#text'};
                                break;
                        }
                    }

                    $this->admin_m->update_venue(array('venue_id' => $venue->id,
                        'name' => $venue->name,
                        'city' => $city,
                        'county' => $this->county,
                        'street' => $venue->street,
                        'country' => $venue->location->country,
                        'geo_lat' => $venue->location->{'geo:point'}->{'geo:lat'},
                        'geo_long' => $venue->location->{'geo:point'}->{'geo:long'},
                        'large_image' => $large,
                        'mega_image' => $mega_image
                            ), $venue->id);

                    $count++;
                }
            }
        }

        echo "<strong>Venues</strong>: {$count} venues added or updated.";
    }

    /*

      Display all venues

     */

    public function venues($city=FALSE)
    {
        set_time_limit(0);

        $query = $this->admin_m->venues_with_events();
		
        foreach ($query->result() as $venue)
        {
			$this->new_events($venue->venue_id);
        } 

		if ($this->count > 0)
        {
            echo $this->count . " events added! <br>";

            echo "<br>";
        }
    }

    /*

      This method adds upcoming events for the specified venue once given a venue_id.

     */
	public function new_events($venue_id)
	{
	    $data = $this->lastfm->venue_events($venue_id);

	    if (isset($data->events->event))
	    {
	        foreach ($data->events->event as $event)
	        {

	            if ($event->id < 8000000 && is_numeric($event->id))
	            {
	                $entry['event_id'] = $event->id;
	                $entry['title'] = $event->title;
	                $entry['venue_id'] = $event->venue->id;
	                $entry['start_date'] = strtotime($event->startDate);
	                $entry['description'] = $event->description;
					
	                foreach ($event->image as $image)
	                {

	                    switch ($image->size)
	                    {
	                        case "small":
	                            $entry['small_image'] = $image->{'#text'};
	                            break;
	                        case "medium":
	                            $entry['medium_image'] = $image->{'#text'};
	                            break;
	                        case "large":
	                            $entry['large_image'] = $image->{'#text'};
	                            break;
	                        case "extralarge":
	                            $entry['extralarge_image'] = $image->{'#text'};
	                            break;
	                        case "mega":
	                            $entry['mega_image'] = $image->{'#text'};
	                            break;
	                    }
	                }

	                $result = $this->admin_m->add($entry, $event->id);
	                if ($result === TRUE)
	                {
						echo $entry['venue_id'] . " venue with event " . $entry['event_id'] . " Added! <br>";
	                    $this->count++;
	                }

	                continue;
	            }
	        }
	    }

	    return $count;
	}

    public function grab_past_venue_events($venue_id)
    {
        $data = $this->lastfm->venue_past_events($venue_id);
        $count = 0;

        if (isset($data->events->event))
        {
            foreach ($data->events->event as $event)
            {
                if (isset($event->id) && $event->id < 8000000)
                {
                    $this->admin_m->add(array('event_id' => $event->id,
                        'title' => $event->title,
                        'venue_id' => $event->venue->id,
                        'start_date' => strtotime($event->startDate),
                        'description' => $event->description
                            ), $event->id);

                    $count++;
                    continue;
                }
                elseif (isset($data->events->event->id) && $data->events->event->id < 8000000)
                {
                    $this->admin_m->add(array('event_id' => $data->events->event->id,
                        'title' => $data->events->event->title,
                        'venue_id' => $data->events->event->venue->id,
                        'start_date' => strtotime($data->events->event->startDate),
                        'description' => $data->events->event->description
                            ), $data->events->event->id);

                    $count++;
                    continue;
                }
                else
                {
                    echo "<b>Error: Investigate when you have more time. </b><br>";
                }
            }
        }

        return $count;
    }

}