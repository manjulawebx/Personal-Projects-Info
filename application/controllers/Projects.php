<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Projects extends CI_Controller {

	public $data;

	//Holds clients array with ID, Name
	public $clients;
	


	public function __construct()
    {
            parent::__construct();
            
            
            date_default_timezone_set('Asia/Colombo');
            
            $this->load->model("Client_model");
            $this->load->model("Projects_model");
            
            //Get list of all clients
			$clients = new Client_model();
			$this->clients = $clients->all_id_name();
			$this->data["clients"] = $this->clients;
    }


	/**
	 * Index Page for this controller.
	 *
	 */
	public function index()
	{
		//TODO get all project records to show
		$projects = new Projects_model();
		$this->data['projects'] = $projects->all();
		
		$this->load->view('projects', $this->data);
	}
	
	/**
	 * Add Project Step 1
	 */
	public function add($id=-1){
		$this->data["action"] = "Add";

		if(isset($id) && $id>0){
			//Show Project data for edit
			//set a id hidden field in the form
			$this->data["action"] = "Edit"; 
			
			//Load project record
			$project_edit = new Projects_model();
			$project_edit->id = $id;
			$project_edit->load();
			
			//Decode encrypted data to display
			$project_edit->prj_prod_admin_pw    = $this->encrypt->decode($project_edit->prj_prod_admin_pw);
			$project_edit->prj_testing_admin_pw = $this->encrypt->decode($project_edit->prj_testing_admin_pw);
			$project_edit->prj_host_pw          = $this->encrypt->decode($project_edit->prj_host_pw);
			$project_edit->prj_ftp_pw           = $this->encrypt->decode($project_edit->prj_ftp_pw);
		
			$this->data['project_edit'] = $project_edit;
			
		}
		
		//Process form Submit
		if($this->input->post()){
						
			$project = new Projects_model();
			
			if(isset($_POST['id']) && $_POST['id']>0){
				$project->id           = $_POST['id'];
			}
			$project->client_id           = $_POST['prj_client_id'];
			$project->prj_name            = $_POST['prj_name']; 
            $project->prj_description     = $_POST['prj_desc'];
            $project->prj_quotation_amount = $_POST['prj_value'];
            
            $project->prj_prod_url        = $_POST['prj_url_production'];
            
            $project->prj_prod_admin_url = $_POST['prj_url_production_admin'];
            $project->prj_prod_admin_un  = $_POST['prj_production_admin_un'];
            $project->prj_prod_admin_pw  = $this->encrypt->encode($_POST['prj_production_admin_pw']);
        
            $project->prj_local_url       = $_POST['prj_url_local']; 
            $project->prj_local_admin_url = $_POST['prj_url_local_admin'];
            $project->prj_local_admin_un  = $_POST['prj_local_admin_un'];
            $project->prj_local_admin_pw  = $_POST['prj_local_admin_pw'];
        
            $project->prj_testing_url      = $_POST['prj_url_testing'];
            $project->prj_testing_admin_url= $_POST['prj_url_testing_admin'];
            $project->prj_testing_admin_un = $_POST['prj_testing_admin_un'];
            $project->prj_testing_admin_pw = $this->encrypt->encode($_POST['prj_testing_admin_pw']);
        
            $project->prj_host_url         = $_POST['prj_host_url'];
            $project->prj_host_un          = $_POST['prj_host_un'];
            $project->prj_host_pw          = $this->encrypt->encode($_POST['prj_host_pw']);
        
            $project->prj_git_repo_url     = $_POST['prj_git_url'];
            
            $project->prj_ftp_server       = $_POST['prj_ftp_server'];
            $project->prj_ftp_path         = $_POST['prj_ftp_path'];
            $project->prj_ftp_un           = $_POST['prj_ftp_un'];
            $project->prj_ftp_pw           = $this->encrypt->encode($_POST['prj_ftp_pw']);
            
			$project->save();
			
			$this->data['message'] = "Done";
			
			//TODO: Later redirect to View Project
			//redirect(base_url("index.php/projects"));
		}
		
		
		//Display Add Form
		$this->load->view('projects_add', $this->data);
	}
	
	//View Project
	public function view($id=-1){
		if($id>0){
			//Load project record
			$project_view = new Projects_model();
			$project_view->id = $id;
			$project_view->load();
			
			//Decode encrypted data to display
			$project_view->prj_prod_admin_pw    = $this->encrypt->decode($project_view->prj_prod_admin_pw);
			$project_view->prj_testing_admin_pw = $this->encrypt->decode($project_view->prj_testing_admin_pw);
			$project_view->prj_host_pw          = $this->encrypt->decode($project_view->prj_host_pw);
			$project_view->prj_ftp_pw           = $this->encrypt->decode($project_view->prj_ftp_pw);
		
			//Add more data like Client Name
			$project_view->cient_name           = $this->clients[$project_view->client_id];
		
			$this->data['project_view'] = $project_view;
			
			$this->load->view('projects_view', $this->data);
			
		}
			

	}
}
