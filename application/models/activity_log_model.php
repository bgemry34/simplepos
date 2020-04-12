<?php
    class activity_log_model extends CI_Model{
        public function __construct(){
            $this->load->database();
        }

        public function get_activity_logs($log_id = FALSE, $limit = false, $offset = false){
            if($limit){
                $this->db->limit($limit, $offset);
            }
    
            if($log_id === FALSE){
                $this->db->order_by('id', 'DESC');
                $query = $this->db->get('activity_logs');
                return $query->result_array();
            }
                $query = $this->db->get_where('activity_logs', array('id' => $log_id));
                return $query->row_array();
		}
		
		public function create_log($username, $action){
				$data = array(
					'username' => $username,
					'action' => $action
				);
	
				return $this->db->insert('activity_logs', $data);
		}
    }
