<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiModel extends CI_Model{
	private $dbase;
	private $baseUrl;
	private $key;

	private $baseGenre;

    public function __construct() {
        parent::__construct();
		$this->load->database();
		
		$this->baseUrl = 'https://api.themoviedb.org/3/';
		$this->key = '?api_key=1f54bd990f1cdfb230adb312546d765d';
    }

    public function index($endpoint, $page = null) {
		
		$cURLConnection = curl_init();

		$page = $page != null ? '&page=' . $page : '';
		$url = $this->baseUrl . $endpoint . $this->key . $page;

		curl_setopt($cURLConnection, CURLOPT_URL, $url);
		curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($cURLConnection);
		curl_close($cURLConnection);

		return $response;
	}
	
	public function getUpcomingMovie($page = 1) {
		return $this->index('movie/upcoming', $page);
	}

	public function getTopRatedMovie($page = 1) {
		return $this->index('movie/top_rated', $page);
	}

	public function getGenre($genreId = null) {
		$genreList = $this->index('genre/movie/list');

		if($genreId != null) {
			$teste = json_decode($genreList);
			foreach($teste->genres as $expecGenre):
				if($expecGenre->id == $genreId) :
					return  json_encode($expecGenre);
				endif;
			endforeach;
			return json_encode(['status' => '400', 'message' => 'this genre id does not exists!']);
		}

		return $genreList;
	}

	public function singleMovieVideos($movieid = '') {
		$movieid = $movieid != '' ? $movieid  . '/' : '';
		return $this->index('movie/' . $movieid . 'videos');
	}
}
