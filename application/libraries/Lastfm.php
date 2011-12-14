<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Lastfm Class
 *
 * @category        Libraries
 * @author          Peter Fortune
 * @copyright       Copyright (c) 2010 - 2020, Peter Fortune
 * @created         17/07/2010
 * @updated			24/12/2010
 */

class LastFm
{

          protected $_api_key;
          protected $_api_url = 'http://ws.audioscrobbler.com/2.0/';
          protected $_session_key = '';
          protected $format = 'json';
          protected $result;
          protected $ci; // Codeigniter instance

          public function __construct()
          {
                    $this->ci =& get_instance();

                    $this->ci->config->load('api_keys');
                    $this->_api_key = $this->ci->config->item('lastfm');
          }

          /**
           * Build URL
           *
           * Builds the API url for the API call
           *
           */
          private function _build_url($method, $params)
          {
                    $url = $this->_api_url;

                    $url .= '?method=' . $method . "&" . http_build_query($params);
                    $url .= "&api_key=" . $this->_api_key;
                    $url .= "&format=" . $this->format;

                    return $url;
          }

		  /** 
		   * Make API Call
		   * 
		   * Makes API Call to Last.fm and returns result
		   */
		  protected function _call($method, $params) 
		  { 
					$url = $this->_build_url($method, $params);
					
					$ch = curl_init();
          			curl_setopt($ch, CURLOPT_URL, $url); 
          			curl_setopt($ch, CURLOPT_TIMEOUT, 5); 
					curl_setopt($ch, CURLOPT_HEADER, 0); 
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          			$response = curl_exec($ch); curl_close($ch); 
					
					return json_decode($response); 
		  }

          public function album_info($artist, $album = NULL)
          {
                    return $this->_call("album.getInfo", array(
                        "artist" => $artist,
                        "album" => $album
                    ));
          }

          public function album_tags($artist, $album = NULL, $session_key = NULL)
          {
                    $url = $this->_build_url("album.getTags", array(
                        "artist" => $artist,
                        "album" => $album,
                        "session_key" => $session_key
                    ));

                    return _call($url);
          }

          public function album_search($album, $page = NULL, $limit = NULL)
          {
                    return $this->_call("album.search", array(
                        "album" => $album,
                        "page" => $page,
                        "limit" => $limit
                    ));
          }

          public function artist_events($artist)
          {
                    return $this->_call("artist.getEvents", array(
                        "artist" => $artist
                    ));
          }

          public function artist_images($artist, $page = NULL, $limit = NULL, $order = NULL)
          {
                    return $this->_call("artist.getImages", array(
                        "artist" => $artist,
                        "page" => $page,
                        "limit" => $limit,
                        "order" => $order
                    ));
          }

          public function artist_past_events($artist, $page = NULL, $limit = NULL)
          {
                    return $this->_call("artist.getPastEvents", array(
                        "artist" => $artist,
                        "page" => $page,
                        "limit" => $limit
                    ));
          }

          public function artist_similar($artist, $limit = NULL)
          {
                    return $this->_call("artist.getSimilar", array(
                        "artist" => $artist,
                        "limit" => $limit
                    ));
          }

          public function artist_top_albums($artist)
          {
                    return $this->_call("artist.getTopAlbums", array(
                        "arist" => $artist
                    ));
          }

          public function artist_top_tracks($artist)
          {
                    return $this->_call("artist.getTopTracks", array(
                        "artist" => $artist
                    ));
          }

          public function artist_search($artist, $page = NULL, $limit = NULL)
          {
                    return $this->_call("artist.search", array(
                        "artist" => $artist,
                        "page" => $page,
                        "limit" => $limit
                    ));
          }

          public function event_info($event)
          {
                    return $this->_call("event.getInfo", array(
                        "event" => $event
                    ));
          }

          public function geo_events($location = NULL, $page = 1, $lat = NULL, $long = NULL, $distance = NULL)
          {
                    return $this->_call("geo.getEvents", array(
                                "location" => "$location",
                                "lat" => $lat,
                                "long" => $long,
                                "page" => $page,
                                "distance" => $distance
                            ));
          }

          public function geo_top_artist($country)
          {
                    return $this->_call("geo.getTopArtists", array(
                        "country" => $country
                    ));
          }

          public function geo_top_tracks($country, $location = NULL)
          {
                    return $this->_call("geo.getTopTracks", array(
                        "country" => $country,
                        "location" => $location
                    ));
          }

          public function venue_events($venue_id)
          {
                    return $this->_call("venue.getEvents", array(
                        "venue" => $venue_id
                    ));
          }

          public function venue_past_events($venue_id, $page = 1, $limit = 1000)
          {
                    return $this->_call("venue.getPastEvents", array(
                        "venue" => $venue_id,
                        "page" => $page,
                        "limit" => $limit
                    ));
          }

          public function venue_search($venue, $country = NULL, $page = NULL, $limit = NULL)
          {
                    return $this->_call("venue.search", array(
                        "venue" => $venue,
                        "country" => $country,
                        "page" => $page,
                        "limit" => $limit
                    ));
          }

		  public function total_pages()
	      {
					$data = $this->lastfm->get_events($api_key, $country, $format);
					return $data->events->{'@attr'}->totalPages;
		  }

}