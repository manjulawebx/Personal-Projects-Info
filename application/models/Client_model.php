<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_model extends CI_Model {

        public $id;
        public $name;
        public $email;
        public $telephone;
        
        //Added Date/Time
        public $added;
        
        //Modified Date/Time
        public $modified;

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                
                date_default_timezone_set('Asia/Colombo');
        }


		//Return All records
		public function all(){
			$query = $this->db->get('clients');
			if($query->num_rows()>0){
				return $query->result();
			}else{
				return FALSE;
			}
		}
		
		//Return all records as ID and Clinet Name array
		public function all_id_name(){
			$clinets = $this->all();
			
			$clients_array = array();
			
			foreach($clinets as $client){
				$clients_array[$client->id] = $client->name;
			}
			
			return $clients_array;
		}
		
		//Return or Load single record
		public function load(){
			if(isset($this->id) && $this->id > 0){
				$query  = $this->db->get_where('clients', array('id'=>$this->id));
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
                $this->name      = $_POST['client_name']; // please read the below note
                $this->email     = $_POST['client_email'];
                $this->telephone = $_POST['client_tele'];
                $this->added     = date('Y-m-d H:i:s');
                $this->modified  = date('Y-m-d H:i:s');

                $this->db->insert('clients', $this);
        }

        public function update()
        {
			$this->modified = date('Y-m-d H:i:s');
			unset($this->added);//to avoid overwriting added field with empty value
			
	        $this->db->update ('clients', $this, array('id'=>$this->id));
	    }

}