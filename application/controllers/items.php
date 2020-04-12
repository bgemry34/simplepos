<?php
	class items extends CI_Controller{

		public function index($offset = 0){
			if(!$this->session->userdata('logged_in')){
				$this->session->set_flashdata('not_login', 'You must logged in!');
				redirect('users/login');
			}
				//pagination config
				$config['base_url'] = base_url().'items/index/';
				$config['total_rows'] = $this->db->count_all('items');
				$config['per_page'] = 10;
				$config['uri_segment'] = 3;
				$config['attributes'] = array('class' => 'pagination-link');
				$config['num_links'] = 3;
	
				//init pagination
				$this->pagination->initialize($config);
	
				$data['title'] = 'Items';
				$data['items'] = $this->item_model->get_items(FALSE, $config['per_page'], $offset);
	 
				$this->load->view('templates/header');
				$this->load->view('items/index', $data);
				$this->load->view('templates/footer');
		}

		public function update(){
			if(!$this->session->userdata('logged_in')){
				$this->session->set_flashdata('not_login', 'You must logged in!');
				redirect('users/login');
			}
			$id = $this->input->post('id');
			
			$this->item_model->update_item();
			$this->activity_log_model->create_log($this->session->userdata('username'), "Updates Item id # $id");
			//set message
			redirect('items');
		}


		public function delete(){
			if(!$this->session->userdata('logged_in')){
				$this->session->set_flashdata('not_login', 'You must logged in!');
				redirect('users/login');
			}
			$id = $this->input->post('id');
			$this->item_model->delete_item();
			$this->activity_log_model->create_log($this->session->userdata('username'), "Delete Item id # $id");
			//set message
			redirect('items');
		}
		
		public function create(){
			if(!$this->session->userdata('logged_in')){
				$this->session->set_flashdata('not_login', 'You must logged in!');
				redirect('users/login');
			}
			
			$name = $this->input->post('name');
			$this->item_model->create_item();
			$this->activity_log_model->create_log($this->session->userdata('username'), "Create Item $name");	
			header("location: ".base_url()."items");
		}

		public function search(){
			if(!$this->session->userdata('logged_in')){
				$this->session->set_flashdata('not_login', 'You must logged in!');
				redirect('users/login');
			}

			$toSearch = $this->input->post('toSearch');
			$this->activity_log_model->create_log($this->session->userdata('username'), "Searches Item $toSearch");
			$data['title'] = 'Items';
			$data['items'] = $this->item_model->search_item();
	 
			$this->load->view('templates/header');
			$this->load->view('items/index', $data);
			$this->load->view('templates/footer');
		}

		public function itemreturn($offset = 0){
			if(!$this->session->userdata('logged_in')){
				$this->session->set_flashdata('not_login', 'You must logged in!');
				redirect('users/login');
			}
				//pagination config
				$config['base_url'] = base_url().'items/itemreturn/';
				$config['total_rows'] = $this->db->count_all('itemreturns');
				$config['per_page'] = 10;
				$config['uri_segment'] = 3;
				$config['attributes'] = array('class' => 'pagination-link');
				$config['num_links'] = 3;
	
				//init pagination
				$this->pagination->initialize($config);
	
				$data['title'] = 'Item Returns';
				$data['items'] = $this->item_model->get_item_return(FALSE, $config['per_page'], $offset);
	 
				$this->load->view('templates/header');
				$this->load->view('items/itemReturns', $data);
				$this->load->view('templates/footer');
		}

		public function itemsArchived($offset = 0){
			if(!$this->session->userdata('logged_in')){
				$this->session->set_flashdata('not_login', 'You must logged in!');
				redirect('users/login');
			}
				//pagination config
				$config['base_url'] = base_url().'items/itemsArchived/';
				$config['total_rows'] = $this->db->count_all('itemsArchived');
				$config['per_page'] = 10;
				$config['uri_segment'] = 3;
				$config['attributes'] = array('class' => 'pagination-link');
				$config['num_links'] = 3;
	
				//init pagination
				$this->pagination->initialize($config);
	
				$data['title'] = 'Items Archived';
				$data['items'] = $this->item_model->get_itemsArchived(FALSE, $config['per_page'], $offset);
	 
				$this->load->view('templates/header');
				$this->load->view('items/itemsArchived', $data);
				$this->load->view('templates/footer');
		}

		public function item_recovered(){
			$id = $this->input->post('itemId');
			$this->item_model->recover_item();
			$this->activity_log_model->create_log($this->session->userdata('username'), "Recoverd Item id # $id");
			//set message
			redirect('items/itemsArchived');
		}
	}
