<?php
class pos_api extends CI_Controller{
    public function get_item($id){
        header('Content-type: text/javascript');
        $data['item'] = $this->item_model->get_items($id);
        echo json_encode($data['item'], JSON_PRETTY_PRINT);
    }

    public function get_item_all(){
        header('Content-type: text/javascript');
        $data['item'] = $this->item_model->get_items();
        echo json_encode($data['item'], JSON_PRETTY_PRINT);
    }

    public function get_sale($id){
        header('Content-type: text/javascript');
        $data['sales'] = $this->sale_model->get_sales($id);
        echo json_encode($data['sales'], JSON_PRETTY_PRINT);
    }

    public function get_receipt($id){
        header('Content-type: text/javascript');
        $data['receipt'] = $this->receipt_model->get_receipts($id);
        echo json_encode($data['receipt'], JSON_PRETTY_PRINT);
	}

	public function get_last_receipt(){
        header('Content-type: text/javascript');
        $data['receipt'] = $this->receipt_model->get_receipts($this->employee_model->get_latest_receiptId());
        echo json_encode($data['receipt'], JSON_PRETTY_PRINT);
	}
	
	public function get_all_receipt(){
        header('Content-type: text/javascript');
        $data['receipt'] = $this->receipt_model->get_receipts();
        echo json_encode($data['receipt'], JSON_PRETTY_PRINT);
    }

    public function get_customer($id){
        header('Content-type: text/javascript');
        $data['receipt'] = $this->customer_model->get_customers($id);
        echo json_encode($data['receipt'], JSON_PRETTY_PRINT);
    }

    public function findItem(){
        header('Content-type: text/javascript');
        $data['item'] = $this->item_model->search_item_api($this->input->post('itemName'));
        echo json_encode($data['item'], JSON_PRETTY_PRINT);
	}
}
