<?php
class employee_model extends CI_Model{
	public function __construct(){
		$this->load->database();
	}

	public function get_paymentTypes(){
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get('paymenttype');
		return $query->result_array();
	}

	public function addreceipt($receipt_id, $item_id, $item_qty){
		$data = array(
			'receipt_id' => $receipt_id,
			'customer_id' => $this->input->post('customerId'),
			'item_id' => $item_id,
			'qty' => $item_qty,
			'paymentTypeId' => $this->input->post('paymentTypeId'),
			'totalPrice' => $this->input->post('totalPrice'),
			'cashReceived' => $this->input->post('cashReceived')
		);

		return $this->db->insert('receipt', $data);
	}

	public function updateItem($item_id, $item_qty){
		$this->db->set('qty', 'qty - ' . (int) $item_qty, FALSE);
		$this->db->where('id', $item_id);
		return $this->db->update('items');
	}

	public function generate_latest_receiptId(){
		$this->db->select_max('receipt_id');
		$query = $this->db->get('receipt');
		return $query->row(0)->receipt_id==NULL ? 1 : $query->row(0)->receipt_id+1;
	}

	public function get_latest_receiptId(){
		$this->db->select_max('receipt_id');
		$query = $this->db->get('receipt');
		return $query->row(0)->receipt_id;
	}

	public function create_item_return(){
		$data = array(
			'item_id' => $this->input->post('itemId'),
			'comments' => $this->input->post('comment'),
		);	

		return $this->db->insert('itemreturns', $data);
	}
	
}
