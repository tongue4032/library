<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('session');	
		$this->load->helper('url');
		$this->load->model('user_model');
    	$this->load->library('form_validation');

	}




}









