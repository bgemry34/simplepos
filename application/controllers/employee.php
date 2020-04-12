<?php
class employee extends CI_Controller{
    public function index(){
		if(!$this->session->userdata('logged_in') && $this->session->userdata('userType')!=2){
				$this->session->set_flashdata('not_login', 'You must logged in!');
				redirect('users/login');
		}
		$this->load->model('employee_model');
		$data['customers'] = $this->customer_model->get_customers();
		$data['paymentTypes'] = $this->employee_model->get_paymentTypes();
    $this->load->view('employee/index', $data);
	}
	
	public function addreceipts(){
		$this->load->model('employee_model');

		$receipt_id = $this->employee_model->generate_latest_receiptId();
		$itemIds = $this->input->post('itemid');
		
		$item_qty = $this->input->post('qty');

		foreach($itemIds as $index=>$itemId){
			$itemCheck = $this->item_model->get_items($itemId);
			if(!$itemCheck['qty']>0 || $itemCheck['qty']==null){
				$this->session->set_flashdata('receipt_error', 'Error Something is Wrong!');
				redirect('employee');
			}
			$this->employee_model->addreceipt($receipt_id, $itemId, $item_qty[$index]);
			$this->employee_model->updateItem($itemId, $item_qty[$index]);
			
		}

		if($this->input->post('itemid')!==null)
		{
			$this->session->set_flashdata('receipt_generate', 'Receipt Generated');
			$this->activity_log_model->create_log($this->session->userdata('username'), "Generates receipt id # $receipt_id");

		}else{
			$this->session->set_flashdata('receipt_error', 'Must Add Items!');
		}
		redirect('employee');
	}

	public function item_return(){
		$data['items'] = $this->item_model->get_items();
		$this->load->view('employee/item_return', $data);
	}
	
	public function customer_detail($offset=0){
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
 
			$this->load->view('employee/customer_detail', $data);
	}

	public function addItemReturn(){
		$this->employee_model->create_item_return();

		$itemid=$this->input->post('itemId');
		$this->activity_log_model->create_log($this->session->userdata('username'), "Added ItemReturn id # $item_id");
	
		$this->session->set_flashdata('addedItemReturn', 'Item Return Submitted Successfully!');
		
		redirect('employee/itemreturn');
	}
}
