<?php
	class customers extends CI_Controller{
		public function index($offset = 0){
			if(!$this->session->userdata('logged_in')){
				$this->session->set_flashdata('not_login', 'You must logged in!');
				redirect('users/login');
			}
				//pagination config
				$config['base_url'] = base_url().'customers/index/';
				$config['total_rows'] = $this->db->count_all('customers');
				$config['per_page'] = 10;
				$config['uri_segment'] = 3;
				$config['attributes'] = array('class' => 'pagination-link');
				$config['num_links'] = 3;
	
				//init pagination
				$this->pagination->initialize($config);
				
				$data['title'] = 'Customers';
				$data['customers'] = $this->customer_model->get_customers(FALSE, $config['per_page'], $offset);
	 
				$this->load->view('templates/header');
				$this->load->view('customers/index', $data);
				$this->load->view('templates/footer');
		}

		public function create(){
			if(!$this->session->userdata('logged_in')){
				$this->session->set_flashdata('not_login', 'You must logged in!');
				redirect('users/login');
			}
			
			$name = $this->input->post('Created_name');
			$this->customer_model->create_customer();
			$this->activity_log_model->create_log($this->session->userdata('username'), "Created Customer $name");	
			header("location: ".base_url()."customers");
		}

		public function delete(){
			if(!$this->session->userdata('logged_in')){
				$this->session->set_flashdata('not_login', 'You must logged in!');
				redirect('users/login');
			}
			$id = $this->input->post('customer_id');
			$this->customer_model->delete_customer();
			$this->activity_log_model->create_log($this->session->userdata('username'), "Delete Item id # $id");
			//set message
			redirect('customers');
		}

		public function create_company(){
			if(!$this->session->userdata('logged_in')){
				$this->session->set_flashdata('not_login', 'You must logged in!');
				redirect('users/login');
			}
			
			$name = $this->input->post('Created_name');
			$this->customer_model->create_company();
			$this->activity_log_model->create_log($this->session->userdata('username'), "Create Company $name");	
			header("location: ".base_url()."customers");
		}

		public function edit(){
			if(!$this->session->userdata('logged_in')){
				$this->session->set_flashdata('not_login', 'You must logged in!');
				redirect('users/login');
			}
			
			$id = $this->input->post('id');
			$this->customer_model->update_customer();
			$this->activity_log_model->create_log($this->session->userdata('username'), "Updates customer id # $id");
			//set message
			redirect('sales');
		}

		
	}
