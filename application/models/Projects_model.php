<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projects_model extends CI_Model {

		const DB_TABLE = 'projects';
		const DB_TABLE_PK = 'id';
		
        public $id;
        public $client_id;
        public $prj_name;
        public $prj_description;
        
        public $prj_prod_url;
        public $prj_prod_admin_url;
        public $prj_prod_admin_un;
        public $prj_prod_admin_pw;
        
        public $prj_local_url;
        public $prj_local_admin_url;
        public $prj_local_admin_un;
        public $prj_local_admin_pw;
        
        public $prj_testing_url;
        public $prj_testing_admin_url;
        public $prj_testing_admin_un;
        public $prj_testing_admin_pw;
        
        public $prj_host_url;
        public $prj_host_un;
        public $prj_host_pw;
        
        public $prj_git_repo_url;
        
        public $prj_quotation_amount;
        public $prj_quotation_date;
        
        public $prj_added;
        public $prj_modified;
        
        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                
                date_default_timezone_set('Asia/Colombo');
        }


		//Return All records
		public function all(){
			//TODO: SELECT needed fields only
			$this->db->order_by("prj_name", "ASSC");
			$query = $this->db->get($this::DB_TABLE);
			if($query->num_rows()>0){
				return $query->result();
			}else{
				return FALSE;
			}
		}
		
		//Return all records as ID and Name array
		public function all_id_name(){
			$projects = $this->all();
			
			$prj_array = array();
			
			foreach($projects as $project){
				$prj_array[$project->id] = $project->$prj_name;
			}
			
			return $prj_array;
		}
		
		//Return or Load single record
		public function load(){
			if(isset($this->id) && $this->id > 0){
				$query  = $this->db->get_where($this::DB_TABLE, array('id'=>$this->id));
				if($query->num_rows()==1){
					$this->populate($query->row());
					return $query->row();
				}else{
					return FALSE;
				}
			}else{
				return FALSE;
			}
		}
		
		/**
	     * Populate from an array or standard class.
	     * @param mixed $row
	     */
	    public function populate($row) {
	        foreach ($row as $key => $value) {
	            $this->$key = $value;
	        }
	    }
		
        public function insert()
        {
                $this->prj_added     = date('Y-m-d H:i:s');
                $this->prj_modified  = date('Y-m-d H:i:s');

                $this->db->insert($this::DB_TABLE, $this);
                $this->id = $this->db->insert_id();
                
        }

        public function update()
        {
			$this->prj_modified = date('Y-m-d H:i:s');
			
	        $this->db->update ($this::DB_TABLE, $this, array($this::DB_TABLE_PK=>$this->{$this::DB_TABLE_PK}));
	    }
	    
	    /**
	     * Save the record.
	     */
	    public function save() {
	        
	        if (isset($this->{$this::DB_TABLE_PK})) {
	            $this->update();
	        }
	        else {
	            $this->insert();
	        }
	    }
	    
	    public function search($search_text="9876543210"){
		    $this->db->like("prj_name", $search_text, "both");
		    $this->db->or_like("prj_description", $search_text, "both");
		    $this->db->or_like("prj_prod_url", $search_text, "both");
		    $query = $this->db->get($this::DB_TABLE);
			if($query->num_rows()>0){
				return $query->result();
			}else{
				return FALSE;
			}
	    }

}