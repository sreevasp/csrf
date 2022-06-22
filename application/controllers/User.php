<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function index(){

		// load base_url
		$this->load->helper('url');

		// load view
		$this->load->view('user_view');
	}

	public function userDetails(){

		// POST data
		$postData = $this->input->post();
		
		//load model
		$this->load->model('Main_model');
		
		// get data
		$data = $this->Main_model->getUserDetails($postData);

		// Read token 
		$data['token'] = $this->security->get_csrf_hash();
		
		echo json_encode($data);
	}

}
