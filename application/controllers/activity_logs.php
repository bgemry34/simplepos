<?php  
    class activity_logs extends CI_Controller{
        public function index($offset=0){
				//pagination config
				$config['base_url'] = base_url().'user_log/index/';
				$config['total_rows'] = $this->db->count_all('activity_logs');
				$config['per_page'] = 10;
				$config['uri_segment'] = 3;
				$config['attributes'] = array('class' => 'pagination-link');
				$config['num_links'] = 3;
	
				//init pagination
				$this->pagination->initialize($config);
	
				$data['title'] = 'Users Log';
				$data['logs'] = $this->activity_log_model->get_activity_logs(FALSE, $config['per_page'], $offset);
	 
				$this->load->view('templates/header');
				$this->load->view('user_log/index', $data);
				$this->load->view('templates/footer');
        }
    }
