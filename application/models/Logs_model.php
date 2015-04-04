<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs_model extends CI_Model {

		const DB_TABLE = 'projects_log';
		const DB_TABLE_PK = 'id';
		
        public $id;
        public $project_id;
        public $log_details;
                
        public $log_created;
        public $log_modified;
        
        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                
                date_default_timezone_set('Asia/Colombo');
        }


		//Return All records. Project ID must be set
		public function all(){
			if($this->project_id>0){
				$this->db->where("project_id", $this->project_id);
				$query = $this->db->get($this::DB_TABLE);
				if($query->num_rows()>0){
					return $query->result();
				}else{
					return FALSE;
				}
			}else{
				return FALSE;
			}
		}
		
		//Return all records with ID in array index
		public function all_id_array(){
			$projects = $this->all();
			
			$logs_array = array();
			
			foreach($logs_array as $log){
				$prj_array[$project->id] = $log;
			}
			
			return $logs_array;
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
                $this->log_created     = date('Y-m-d H:i:s');
                $this->log_modified  = date('Y-m-d H:i:s');

                $this->db->insert($this::DB_TABLE, $this);
        }

        public function update()
        {
			$this->log_modified = date('Y-m-d H:i:s');
			unset($this->log_created);
			
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
	    
	    //Delete record
	    public function delete(){
		    if (isset($this->{$this::DB_TABLE_PK})) {
	            $this->db->delete($this::DB_TABLE, array($this::DB_TABLE_PK=>$this->{$this::DB_TABLE_PK}));
	        }
	    }

}