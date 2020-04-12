<?php
    class receipt_model extends CI_Model{
        public function __construct(){
			$this->load->database();
        }
        
		public function get_receipts($receipts_id = FALSE, $limit = false, $offset = false){
			if($limit){
				$this->db->limit($limit, $offset);
			}

				if($receipts_id === FALSE){
				$this->db->select('receipt_id, customers.name as customer_name, items.name as item_name, receipt.qty, paymenttype.paymentType, totalPrice, cashReceived');
				$this->db->join('customers', 'receipt.customer_id = customers.id');
				$this->db->join('items', 'receipt.item_id = items.id');
				$this->db->join('paymenttype', 'receipt.paymentTypeId = paymenttype.id');
				$query = $this->db->get('receipt');
				return $query->result_array();
				}
				$this->db->select('receipt_id, customers.name as customer_name, items.name as item_name, receipt.qty, paymenttype.paymentType, totalPrice, cashReceived');
				$this->db->join('customers', 'receipt.customer_id = customers.id');
				$this->db->join('items', 'receipt.item_id = items.id');
				$this->db->join('paymenttype', 'receipt.paymentTypeId = paymenttype.id');
				$query = $this->db->get_where('receipt', array('receipt_id' => $receipts_id));
				return $query->result_array();
		}
						
		public function get_items(){
			$this->db->order_by('id', 'DESC');
			$query = $this->db->get('items');
			return $query->result_array();
		}

		public function create_receipts(){
			$data = array(
				'item_id' => $this->input->post('item_id'),
				'qty' => $this->input->post('qty')
			);
			
			return $this->db->insert('receipt', $data);
		}

		public function update_receipts(){
			$data = array(
				'item_id' => $this->input->post('item_id'),
				'qty' => $this->input->post('qty')
			);

			$this->db->where('id', $this->input->post('id'));
      return $this->db->update('receipt', $data);
		}

		public function delete_receipts(){
			$this->db->where('id', $this->input->post('id'));
      return $this->db->delete('receipt');
		}

		public function receiptBetweenDates($start, $end){
			$this->db->select("sum(totalPrice) as revenue, datediff('$end', '$start') as days");
			$this->db->where("date_created between '$start' and '$end'");
			$query = $this->db->get('receipt');
			return $query->row_array();
		}

		public function getCustomerCount($start, $end){
			$this->db->select('count(a.recieptToCount) as customerCount');
			$query = $this->db->get("(select count(receipt_id) as recieptToCount from receipt where date_created between '$start' and '$end' group by receipt_id) a");
			return $query->row_array();
		}


}
