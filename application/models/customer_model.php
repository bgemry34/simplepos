<?php
class customer_model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }

    public function get_customers($customer_id = FALSE, $limit = false, $offset = false){
        if($limit){
            $this->db->limit($limit, $offset);
        }

        if($customer_id === FALSE){
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get('customers');
            return $query->result_array();
        }
            $query = $this->db->get_where('customers', array('id' => $customer_id));
            return $query->row_array();
    }


    public function create_customer(){
        $data = array(
            'name' => $this->input->post('Created_name'),
            'address' => $this->input->post('Created_address'),
            'contactno' => $this->input->post('contactno'),
        );

        return $this->db->insert('customers', $data);
    }

    public function delete_customer(){
        $this->db->where('id', $this->input->post('customer_id'));
        $this->db->delete('customers');
        return true;
    }

    public function create_company(){
        $data = array(
            'companyName' => $this->input->post('Created_name')
        );

        return $this->db->insert('companies', $data);
    }

    public function update_customer(){
        $data = array(
            'name' => $this->input->post('Edited_name'),
            'address' => $this->input->post('Edited_address'),
            'contactno' => $this->input->post('Edited_contact')
        );

        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('items', $data);
    }

}
