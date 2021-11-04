<?php 

class Index extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index($page = "welcome")
	{
		$this->load->view("statics/header");
		$this->load->view("statics/navbar");		
		$this->load->view("statics/".$page);
		$this->load->view("statics/footer");
	}
}

 ?>