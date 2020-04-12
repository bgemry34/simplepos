<?php
 class users extends CI_Controller{

	public function index($offset = 0){
		if(!$this->session->userdata('logged_in')){
			$this->session->set_flashdata('not_login', 'You must logged in!');
			redirect('users/login');
		}
			//pagination config
			$config['base_url'] = base_url().'users/index/';
			$config['total_rows'] = $this->db->count_all('users');
			$config['per_page'] = 10;
			$config['uri_segment'] = 3;
			$config['attributes'] = array('class' => 'pagination-link');
			$config['num_links'] = 3;

			//init pagination
			$this->pagination->initialize($config);

			$data['title'] = 'Items';
			$data['items'] = $this->user_model->get_users(FALSE, $config['per_page'], $offset);
 
			$this->load->view('templates/header');
			$this->load->view('users/accounts', $data);
			$this->load->view('templates/footer');
	}

	public function createuserpage(){
			$this->load->view('templates/header');
			$this->load->view('users/createuser');
			$this->load->view('templates/footer');
	}


	public function login(){
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$data['usertypes'] = $this->user_model->get_usertypes();

		if($this->form_validation->run() === FALSE){
			$this->load->view('users/login', $data);
		}

		else {
			
			// Get username
			$username = $this->input->post('username');
			// Get the password
			$password = $this->input->post('password');
			// Login user
			$user_id = $this->user_model->login($username, $password);
			$user_type = $this->user_model->checkUserType($username, $password);
			$isLogin = $this->user_model->checkIsLogin($username, $password);
			if($user_id){
				if($user_type==$this->input->post('userType') && $user_type==1){
				if($isLogin){
					$this->session->set_flashdata('alreadyLogged', 'Already Logged In!');
					redirect('users/login');
				}
				// Create session
				$user_data = array(
					'user_id' => $user_id,
					'username' => $username,
					'userType' => $user_type,
					'logged_in' => true
				);
				$this->session->set_userdata($user_data);
				// Set message
				$this->session->set_flashdata('user_loggedin', 'You are now logged in');

				$this->user_model->udpateLoginstatus($user_id, 1);
				
				$this->activity_log_model->create_log($this->session->userdata('username'), "Logged-in");
				redirect('items');
				}
				else if($user_type==$this->input->post('userType') && $user_type==2){
					if($isLogin){
						$this->session->set_flashdata('alreadyLogged', 'Already Logged In!');
						redirect('users/login');
					}
					// Create session
					$user_data = array(
						'user_id' => $user_id,
						'username' => $username,
						'userType' => $user_type,
						'logged_in' => true
					);
					$this->session->set_userdata($user_data);
					// Set message
					$this->session->set_flashdata('user_loggedin', 'You are now logged in');

					$this->user_model->udpateLoginstatus($user_id, 1);

					$this->activity_log_model->create_log($this->session->userdata('username'), "Logged-in");
					redirect('employee');
				}
				else{
					$this->session->set_flashdata('login_failed', 'Invalid Authentication');
				redirect('users/login');
				}
				
			} else {
				// Set message
				$this->session->set_flashdata('login_failed', 'Invalid Username and Password');
				redirect('users/login');
			}		
		}
		
	}

	//user log out
	public function logout(){
		//unset user data
		$this->user_model->udpateLoginstatus($this->session->userdata('user_id'), "0");

		$this->activity_log_model->create_log($this->session->userdata('username'), "Logged-out");
		
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('userType');

		$this->session->set_flashdata('user_loggedout', 'You are now logged out!');
		redirect('users/login');
	}	 

	public function backupdatabase(){
				
		//load helpers

		$this->load->helper('file');
		$this->load->helper('download');
		$this->load->library('zip');

		//load database
		$this->load->dbutil();

		//create format
		$db_format=array('format'=>'zip','filename'=>'backup.sql');

		$backup=& $this->dbutil->backup($db_format);

		// file name

		$dbname='backup-on-'.date('d-m-y H:i').'.zip';
		$save='assets/db_backup/'.$dbname;

		// write file

		write_file($save,$backup);

		// and force download
		force_download($dbname,$backup);
	}

	public function createAccount(){
		$this->user_model->create_user();
		redirect('accounts');
	}
 }
