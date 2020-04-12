<?php
    class sales extends CI_Controller{
        public function index($offset = 0){
			if(!$this->session->userdata('logged_in')){
				$this->session->set_flashdata('not_login', 'You must logged in!');
				redirect('users/login');
			}
            //pagination config
            $config['base_url'] = base_url().'sales/index/';
            $config['total_rows'] = $this->db->count_all('sales');
            $config['per_page'] = 10;
            $config['uri_segment'] = 3;
            $config['attributes'] = array('class' => 'pagination-link');
            $config['num_links'] = 3;

            //init pagination
            $this->pagination->initialize($config);

            $data['title'] = 'Sales Report';
			$data['sales'] = $this->sale_model->get_sales(FALSE, $config['per_page'], $offset);
			

            $this->load->view('templates/header');
            $this->load->view('sales/index', $data);
            $this->load->view('templates/footer');
    }

    public function update(){
		if(!$this->session->userdata('logged_in')){
			$this->session->set_flashdata('not_login', 'You must logged in!');
			redirect('users/login');
		}
		$id = $this->input->post('id');
		$this->sale_model->update_sale();
		$this->activity_log_model->create_log($this->session->userdata('username'), "Updates sales id # $id");
        //set message
        redirect('sales');
    }


    public function delete(){
		if(!$this->session->userdata('logged_in')){
			$this->session->set_flashdata('not_login', 'You must logged in!');
			redirect('users/login');
		}
		$id = $this->input->post('id');
		$this->sale_model->delete_sale();
		$this->activity_log_model->create_log($this->session->userdata('username'), "Delete Sales id # $id");
        //set message
        redirect('sales');
    }
    
    public function create(){
		// if(!$this->session->userdata('logged_in')){
		// 	$this->session->set_flashdata('not_login', 'You must logged in!');
		// 	redirect('users/login');
		// }
		// $this->sale_model->create_sales();
		// $this->activity_log_model->create_log($this->session->userdata('username'), "Created new sales");
		// header("location: ".base_url()."sales");
		$revenues = $this->receipt_model->receiptBetweenDates($this->input->post('startingDate'), $this->input->post('endingDate'));
		$customerCount = $this->receipt_model->getCustomerCount($this->input->post('startingDate'), $this->input->post('endingDate'));
		if($revenues['days']<0){
			$this->session->set_flashdata('invalid_date', 'Invalid date');
			redirect('sales');
		}
		$this->sale_model->create_sales($customerCount['customerCount'], $revenues['revenue']);
		$this->session->set_flashdata('sales_added', 'Successfully Generated new sales report!');
		redirect('sales');
    }
}
