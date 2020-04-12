<?php
 class user_model extends CI_Model{

    public function login($username, $password){
		// Validate
			//other database
			$DB2 = $this->load->database('default', TRUE);
			$DB2->where('username', $username);
			$DB2->where('password', $password);
			$DB2->where('usertypeId', $this->input->post('userType'));
			
			$result = $DB2->get('users');
			if($result->num_rows() == 1){
				return $result->row(0)->id;
			} else {
				return false;
			}
	 }

	 public function checkUserType($username, $password){
		 //other database
		 $DB2 = $this->load->database('default', TRUE);
		 $DB2->where('username', $username);
		 $DB2->where('password', $password);
		 
		 $result = $DB2->get('users');
		 if($result->num_rows() == 1){
			 return $result->row(0)->usertypeId;
		 } else {
			 return false;
		 }
	 }

	 public function checkIsLogin($username, $password){
		//other database
		$DB2 = $this->load->database('default', TRUE);
		$DB2->where('username', $username);
		$DB2->where('password', $password);
		
		$result = $DB2->get('users');
		if($result->num_rows() == 1){
			return $result->row(0)->isLogin;
		} else {
			return false;
		}
	}

	public function udpateLoginstatus($id, $value){
		$DB2 = $this->load->database('default', TRUE);
		$data = array(
			'isLogin' => $value
		);

		$DB2->where('id', $id);
		return $DB2->update('users', $data);
	}
	 
	 public function get_usertypes(){
		$DB2 = $this->load->database('default', TRUE);
		$query = $DB2->get('usertypes');
		return $query->result_array();
	 }

	 public function get_users($item_id = FALSE, $limit = false, $offset = false){
		if($limit){
			$this->db->limit($limit, $offset);
		}

		if($item_id === FALSE){
			$this->db->order_by('id', 'DESC');
			$this->db->select('users.id, password, username, usertype');
			$this->db->join('usertypes', 'users.usertypeId = usertypes.id');
			$query = $this->db->get('users');
			return $query->result_array();
		}
			$this->db->select('users.id, password, username, usertype');
			$this->db->join('usertypes', 'users.usertypeId = usertypes.id');
			$query = $this->db->get_where('items', array('id' => $item_id));
			return $query->row_array();
	 }

	 public function delete_user(){
		$this->db->where('id', $this->input->post('id'));
		$this->db->delete('items');
		return true;
	}

	public function create_user(){
		$data = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('userPass'),
			'usertypeId' => $this->input->post('usertype')
		);

		return $this->db->insert('users', $data);
	}
 }
