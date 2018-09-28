<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {
	function __construct(){
	parent:: __construct();
	$this->load->helper('url');
}
	public function index()
	{
		$data = file_get_contents('https://api.themoviedb.org/3/movie/popular?api_key=278352cf67036f6735e44d7dabce2cd8&language=en-US');  
		// $this->load->view('index', $data);
		 $api = json_decode($data, true);
		$apidata['movie']  =  $api['results'];

		//top rated api
		$trdata = file_get_contents('https://api.themoviedb.org/3/movie/top_rated?api_key=278352cf67036f6735e44d7dabce2cd8&language=en-US');
		// $this->load->view('index', $data);
		 $trapi = json_decode($trdata, true);
		$apidata['trmovie']  =  $trapi['results'];
		// $this->load->view('index', $apidata);

		$tmdata = file_get_contents('https://api.themoviedb.org/3/trending/movie/week?api_key=278352cf67036f6735e44d7dabce2cd8');
		 $tmapi = json_decode($tmdata, true);
		$apidata['tmmovie']  =  $tmapi['results'];
		$this->load->view('index', $apidata);
	}

	//movie details
	function movie_details(){
		$id = $this->uri->segment(2);
		$data = file_get_contents('https://api.themoviedb.org/3/movie/'.$id.'?api_key=278352cf67036f6735e44d7dabce2cd8&language=en-US');
		// $this->load->view('index', $data);
		 $api = json_decode($data, true);
		$apidata['mdmovie']  =  $api;
		// print_r($apidata['movie']);
		$ucdata = file_get_contents('https://api.themoviedb.org/3/movie/upcoming?api_key=278352cf67036f6735e44d7dabce2cd8&language=en-US&page=1');
		// $this->load->view('index', $data);
		 $ucapi = json_decode($ucdata, true);
		$apidata['ucmovie']  =  $ucapi['results'];

		$this->load->view('single', $apidata);

	}
}
