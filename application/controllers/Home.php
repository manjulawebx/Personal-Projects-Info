<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Home extends CI_Controller {

	public $data;


	


	public function __construct()
    {
            parent::__construct();
            
            
            date_default_timezone_set('Asia/Colombo');
            
            //$this->load->model("Client_model");
    }


	/**
	 * Index Page for this controller.
	 *
	 */
	public function index()
	{
		//echo "HOME";
		//$this->load->view('projects', $this->data);
		redirect(base_url("index.php/projects"));
	}
	
}
