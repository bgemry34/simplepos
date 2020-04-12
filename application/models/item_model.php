<?php
	class item_model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}

		public function get_items($item_id = FALSE, $limit = false, $offset = false){
			if($limit){
				$this->db->limit($limit, $offset);
			}

			if($item_id === FALSE){
				$this->db->order_by('id', 'DESC');
				$query = $this->db->get('items');
				return $query->result_array();
			}
				$query = $this->db->get_where('items', array('id' => $item_id));
				return $query->row_array();
		}

		public function get_itemsArchived($item_id = FALSE, $limit = false, $offset = false){
			if($limit){
				$this->db->limit($limit, $offset);
			}

			if($item_id === FALSE){
				$this->db->order_by('id', 'DESC');
				$query = $this->db->get('itemsArchived');
				return $query->result_array();
			}
				$query = $this->db->get_where('itemsArchived', array('id' => $item_id));
				return $query->row_array();
		}

		public function update_item(){
			$data = array(
				'name' => $this->input->post('name'),
				'price' => $this->input->post('price'),
				'discount' => $this->input->post('discount'),
				'qty' => $this->input->post('qty')
			);

			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('items', $data);
		}



		public function create_item(){
			$data = array(
				'name' => $this->input->post('Created_name'),
				'price' => $this->input->post('Created_price'),
				'discount' => $this->input->post('Created_discount'),
				'qty' => $this->input->post('Created_qty')
			);

			return $this->db->insert('items', $data);
		}

		public function delete_item(){
			$data=$this->get_items($this->input->post('id'));
			$this->db->insert('itemsArchived', $data);
			$this->db->where('id', $this->input->post('id'));
			$this->db->delete('items');
			return true;
		}

		public function search_item(){
			$this->db->order_by('id', 'DESC');
			$this->db->like('name', $this->input->post('toSearch'));
			$query = $this->db->get('items');

			return $query->result_array();
		}

		public function search_item_api($item){
			$this->db->order_by('id', 'DESC');
			$this->db->like('name', $item);
			$query = $this->db->get('items');

			return $query->result_array();
		}

		public function get_item_return( $item_id = FALSE, $limit = false, $offset = false ){
			if($limit){
				$this->db->limit($limit, $offset);
			}

			if($item_id === FALSE){
				$this->db->order_by('itemreturns.id', 'DESC');
				$this->db->select('items.name as item_name, comments, date_created');
				$this->db->join('items', 'itemreturns.item_id = items.id');
				$query = $this->db->get('itemreturns');
				return $query->result_array();
			}
				$this->db->select('items.name as item_name, comments');
				$this->db->join('items', 'itemreturns.item_id = items.id');
				$query = $this->db->get_where('itemreturns', array('itemreturns.id' => $item_id));
				return $query->row_array();
		}

		public function recover_item(){
			$data=$this->get_itemsArchived($this->input->post('itemId'));
			$this->db->insert('items', $data);
			$this->db->where('id', $this->input->post('itemId'));
			$this->db->delete('itemsArchived');
			return true;
		}
	}
