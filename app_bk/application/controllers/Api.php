<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ApiModel');
        $this->load->helper('url');
    }

    public function index() {
			$endpoints = [
				'upcoming' => ['url' => 'http://localhost/api/upcomming', 'params' => 'page number - ex: upcomming/1'], 
				'top_rated' => ['url' => 'http://localhost/api/top_rated', 'params' => 'page number - ex: top_rated/1'], 
				'genre' => ['url' => 'http://localhost/api/genre', 'params' => 'id number - ex: genre/1'], 
				'singleMovieVideos' => ['url' => 'http://localhost/api/singleMovieVideos', 'params' => 'id number - ex: singleMovieVideos/100'], 
			];

			echo json_encode(['message' => $endpoints]);
		}
		
		public function upcomming($page = 1) {
			$resp = $this->ApiModel->getUpcomingMovie($page);
			echo $resp;
		}

		public function top_rated($page = 1) {
			$resp = $this->ApiModel->getTopRatedMovie($page);
			echo $resp;
		}

		public function singleMovieVideos($id = '') {
			$resp = $this->ApiModel->singleMovieVideos($id);
			echo $resp;
		}

		public function genre($gendeId = null) {
			$resp = $this->ApiModel->getGenre($gendeId);
			echo $resp;
		}
}
