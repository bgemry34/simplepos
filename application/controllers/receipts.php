<?php
    class receipts extends CI_Controller{
        public function index($offset = 0){
			if(!$this->session->userdata('logged_in')){
				$this->session->set_flashdata('not_login', 'You must logged in!');
				redirect('users/login');
			}
            //pagination config
            $config['base_url'] = base_url().'receipts/index/';
            $config['total_rows'] = $this->db->count_all('receipt');
            $config['per_page'] = 10;
            $config['uri_segment'] = 3;
            $config['attributes'] = array('class' => 'pagination-link');
            $config['num_links'] = 3;

            //init pagination
            $this->pagination->initialize($config);

            $data['title'] = 'Receipts';
            $data['receipts'] = $this->receipt_model->get_receipts(FALSE, $config['per_page'], $offset);
            $data['items'] = $this->receipt_model->get_items();
 
            $this->load->view('templates/header');
            $this->load->view('receipts/index', $data);
            $this->load->view('templates/footer');
    }

    public function create(){
		if(!$this->session->userdata('logged_in')){
			$this->session->set_flashdata('not_login', 'You must logged in!');
			redirect('users/login');
		}

        $this->receipt_model->create_receipts();
		
		$this->activity_log_model->create_log($this->session->userdata('username'), "Creates new receipts");
        header("location: ".base_url()."receipts");
    }

    public function update(){
		if(!$this->session->userdata('logged_in')){
			$this->session->set_flashdata('not_login', 'You must logged in!');
			redirect('users/login');
		}

		$id = $this->input->post('id');
		$this->receipt_model->update_receipts();
		$this->activity_log_model->create_log($this->session->userdata('username'), "Updates receipt id # $id");

        redirect('receipts');
    }

    public function delete(){
		if(!$this->session->userdata('logged_in')){
			$this->session->set_flashdata('not_login', 'You must logged in!');
			redirect('users/login');
		}

		$id = $this->input->post('id');
		$this->receipt_model->delete_receipts();
		$this->activity_log_model->create_log($this->session->userdata('username'), "Delete receipt id # $id");

        redirect('receipts');
	}
}
