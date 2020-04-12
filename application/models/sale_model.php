<?php  
 class sale_model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }

    public function get_sales($sales_id = FALSE, $limit = false, $offset = false){
        if($limit){
            $this->db->limit($limit, $offset);
        }

        if($sales_id === FALSE){
			$this->db->order_by('id', 'DESC');
			$this->db->select("id, starting_date, ending_date, customerCount, revenue, date_created, datediff(ending_date, starting_date) as days");
            $query = $this->db->get('sales');
            return $query->result_array();
        }
            $query = $this->db->get_where('sales', array('id' => $sales_id));
            return $query->row_array();
    }

    public function update_sale(){
        $data = array(
            'month' => $this->input->post('month'),
            'year' => $this->input->post('year'),
            'revenue' => $this->input->post('revenue')
        );

        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('sales', $data);
    }

    public function delete_sale(){
        $this->db->where('id', $this->input->post('id'));
        $this->db->delete('sales');
        return true;
    }

    public function create_sales($customerCount, $revenue){
        $data = array(
            'starting_date' => $this->input->post('startingDate'),
            'ending_date' => $this->input->post('endingDate'),
			'customerCount' => $customerCount,
			'revenue' => $revenue
        );

        return $this->db->insert('sales', $data);
    }
 }
