<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Projects extends CI_Controller {

	public $data;

	//Holds clients array with ID, Name
	public $clients;
	
	//To hold loaded project data
	public $project;


	public function __construct()
    {
            parent::__construct();
            
            
            date_default_timezone_set('Asia/Colombo');
            
            $this->load->model("Client_model");
            $this->load->model("Projects_model");
            $this->load->model("Logs_model");
            
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

		$this->data['project_edit'] = false;
		
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
			redirect("projects/view/".$project->id);
		}
		
		
		//Display Add Form
		$this->load->view('projects_add', $this->data);
	}
	
	
	//Load single project data with logs for View and Export purpose
	public function load_project($id=-1){
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
		
			//Client Data
			$clientObj =  new Client_model();
			$clientObj->id = $project_view->client_id;
			$clientObj->load();
			
			$project_view->client_name  = $clientObj->name;
			$project_view->client_email = $clientObj->email;
			// End Client Data
		
			//Project Log Data
			$logsObj = new Logs_model();
			
			$logsObj->project_id = $id;
			$logsObj = $logsObj->all();
			
			$this->data["project_logs"] = $logsObj;
			//End Project Log Data
		
			$this->data['project_view'] = $project_view;	
		}
	}
	
	//View Project
	public function view($id=-1){
		if($id>0){
			$this->load_project($id);
						
			$this->load->view('projects_view', $this->data);
			
		}else{
			redirect("index.php/projects");
		}
			
	}
	
	//View the Project Data as export
	public function export_view($id){
		if($id>0){
			$this->load_project($id);
			
			$this->load->helper('file');
			$this->data['css'] = read_file(FCPATH."/css/styles.css");
			//echo $this->data['css'];
			
			//Export project name for file name
			$project_id_paded = str_pad($this->data['project_view']->id, 3, "0", STR_PAD_LEFT);
			
			//Export project id with leading 0s
			$project_name = strtolower(url_title($this->data['project_view']->prj_name));
			
			//Export file name
			$filename = $project_id_paded."_".$project_name.".html";
			
			//Export file data
			$export_file = $this->load->view('export_project', $this->data, TRUE);
			
			//Export
			if(write_file(FCPATH."/exported/".$filename, $export_file)){
				echo "Exported";
			}else{
				echo "Export Fail";
			}
			
			//$this->load->view('export_project', $this->data);
			
		}else{
			redirect("index.php/projects");
		}
	}
	
	//Export all projects
	public function export(){
		$expProjects = new Projects_model();
		$AllProjects = $expProjects->all();
		
		$this->load->helper('file');
		
		//Load CSS data
		$this->data['css'] = read_file(FCPATH."/css/styles.css");
		
		$export_log = array();
		
		
		foreach($AllProjects as $project){
			$this->load_project($project->id);
			
			//Export project name for file name
			$project_id_paded = str_pad($this->data['project_view']->id, 3, "0", STR_PAD_LEFT);
			
			//Export project id with leading 0s
			$project_name = strtolower(url_title($this->data['project_view']->prj_name));
			
			//Export file name
			$filename = $project_id_paded."_".$project_name.".html";
			
			//Export file data
			$export_file = $this->load->view('export_project', $this->data, TRUE);
			
			//Export
			if(write_file(FCPATH."/exported/".$filename, $export_file)){
				$export_log[$project->id]['status'] = "success";
				$export_log[$project->id]['file'] = $filename;
				
			}else{
				$export_log[$project->id]['status'] = "fail";
				$export_log[$project->id]['file'] = $filename;
			}
			
			
		}
		$this->data['export_log'] = $export_log;
		$this->load->view('export', $this->data);
	}
	
	//Add Log Record. Form submit (POST) process
	public function add_log(){
		if($this->input->post("project_id")>0){
			$logsObj = new Logs_model();
			
			$logsObj->project_id = $this->input->post("project_id");
			$logsObj->log_details = $this->input->post("project_log");
			
			$logsObj->save();
			
			redirect("projects/view/".$this->input->post("project_id"));
		}
		
		redirect("index.php/projects");
	}
	
	//Delete Log
	public function delete_log($id=-1){
		if($id>0){
			$logsObj = new Logs_model();
			$logsObj->id = $id;
			$logsObj->load();
			$logsObj->delete();
			
			redirect("projects/view/".$logsObj->project_id);
		}
	}
	
	public function log_edit($log_id=-1){
		
		//Save if Edit form submitted
		if($this->input->post("log_id")>0){
			$logSave = new Logs_model();
			
			$logSave->id = $this->input->post("log_id");
			$logSave->load();
			$logSave->log_details = $this->input->post("log_details");
			$logSave->save();
			
			redirect("projects/view/".$logSave->project_id);
		}
		
		//Display data for edit
		if($log_id>0){
			$logsObj = new Logs_model();
			$logsObj->id = $log_id;
			$logsObj->load();
			
			$projectObj = new Projects_model();
			$projectObj->id = $logsObj->project_id;
			$projectObj->load();
			
			$this->data['log_edit'] = $logsObj;
			$this->data['project_name'] = $projectObj->prj_name;
			$this->data['project_id'] = $projectObj->id;
			
			$this->load->view('projects_log_edit', $this->data);
		}
	}
}
