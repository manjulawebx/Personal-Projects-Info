<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends CI_Controller {

	public $data;

	public function __construct()
    {
            parent::__construct();
            
            $this->load->model("Client_model");
    }
	
	
	/**
	 * Index Page for this controller.
	 *
	 */
	public function index()
	{
		$clients = new Client_model();
		$this->data['clients'] = $clients->all();
		
		$this->load->view('clients', $this->data);
	}
	
	/**
	 * Add a Client
	 */
	public function add(){
		$this->data['action'] = "add";
		
		if($this->input->post()){
						
			$client = new Client_model();
			$client->insert();
			
			redirect(base_url("index.php/clients"));
		}
		
		$this->load->view('clients', $this->data);
	}
	
	/**
	 * Edit a client
	 */
	public function edit($id=-1){
		
		if($id>!0){
			redirect(base_url("index.php/clients?error=No_ID"));
		}
		
		$this->data['action'] = "edit";
		$client = new Client_model();
		
		if($this->input->post() && $this->input->post('id')>0){
			//Update record
			$client->id = $this->input->post('id');
			$client->name = $this->input->post('client_name');
			$client->email = $this->input->post('client_email');
			$client->telephone = $this->input->post('client_tele');
			
			$client->update();
			
			$this->data['message'] = "Updated";
		}
		
		//Load single client data
		$client->id = $id;
		$client->load();
		
		$this->data['client'] = $client;
		//$this->data['clients'] = $clients->all();
		
		$this->load->view('clients', $this->data);
	}
}
