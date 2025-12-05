<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	
	 public function __construct(){
		parent::__construct();

		$this->load->helper('cookie');
		$this->load->helper('url');
		$this->load->helper('form');

		$this->load->library('email');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('encryption');
		$this->load->model('common_model');
		$this->load->model('admin_model');

		// error_reporting(0);

		date_default_timezone_set('Asia/Calcutta');
		
	 }

	public function index()
	{
		
		if ($this->session->userdata('logged_adminpanel') == 'true'){

			    $log_usernamez = $this->session->userdata('logged_username');
                $this->db->where('username', $log_usernamez);
                $loged_details = $this->db->get('admin')->row();

				$loged_type = $loged_details->type;

				$this->session->set_userdata('logged_id', $loged_details->id);

				if($loged_type == 'super'){
					redirect('admin/home');
				}elseif ($loged_type == 'admin'){
					redirect('admin/home');
				}				
		}else{
			redirect('admin/login');
		}
		
	}

	function login(){
		$data = array();

		$this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run($this) == FALSE) {

			if ($this->session->userdata('logged_adminpanel') == 'true'){

			    $log_usernamez = $this->session->userdata('logged_username');
                $this->db->where('username', $log_usernamez);
                $loged_details = $this->db->get('admin')->row();

				$loged_type = $loged_details->type;
				$this->session->set_userdata('logged_id', $loged_details->id);
				$this->session->set_userdata('logged_user_type',  $loged_type);


				if($loged_type == 'super'){
					redirect('admin/home');
				}elseif ($loged_type == 'admin'){
					redirect('admin/home');
				}				
			}else{
				$this->template->load('login_master', 'admin/login', $data);
			}	

		}else{

			$result = $this->admin_model->login();

			if ($result > 0) {

				$username = $this->input->post('username');
                $this->session->set_userdata('logged_adminpanel', 'true');
                $this->session->set_userdata('logged_username', $username);

				$this->db->where('username', $username);
                $loged_details = $this->db->get('admin')->row();
				$loged_type = $loged_details->type;

				$this->session->set_userdata('logged_id', $loged_details->id);
				$this->session->set_userdata('logged_user_type',  $loged_type);

				if($loged_type == 'super'){
					redirect('admin/home');
				} elseif ($loged_type == 'admin'){
					redirect('admin/home');
				}				
			}else{
				$this->session->set_flashdata('message', 'Please enter valid Username and Password.');

				redirect('admin/login');
			}

		}
		
	}
	
	function home(){		

		if ($this->session->userdata('logged_adminpanel') != 'true') {
			$this->session->set_userdata('logged_adminpanel', 'false');
            $this->session->set_userdata('logged_username', '');
			redirect('admin/login');
		}else{
			$data = array();
			$log_usernamez = $this->session->userdata('logged_username');
            $this->db->where('username', $log_usernamez);
            $loged_details = $this->db->get('admin')->row();
            $loged_type = $loged_details->type;
			if ($loged_details->type == 'super') {
				$this->template->load('admin', 'admin/dashboard', $data);
            }elseif ($loged_details->type == 'admin') {            
                $this->template->load('admin', 'admin/dashboard', $data);			   
            }			
		}
		
	}

	function logout(){

		$this->session->set_userdata('logged_adminpanel', 'false');
        $this->session->set_userdata('logged_username', '');
        $this->session->set_userdata('logged_id', '');

		redirect('admin/login');

	}

	function changepassword(){
		if ($this->session->userdata('logged_adminpanel') != 'true') {
			redirect('admin/login');
		}else{

			$_SESSION['seaval'] = '';
			$this->form_validation->set_rules('old', 'old', 'required|max_length[100]|callback_handle_password');
			$this->form_validation->set_rules('new', 'new', 'required|max_length[100]');
			$this->form_validation->set_rules('confirm', 'confirm', 'required|matches[new]|max_length[100]');
			$this->form_validation->set_error_delimiters('<span style="color:#ff0000; position:absolute;">', '</span>');
			if ($this->form_validation->run($this) == FALSE) { // validation hasn't been passed
				$this->template->load('admin', 'admin/changepassword');
			} else {
				if ($this->admin_model->update_password() == TRUE) {
					$this->session->set_flashdata('message', 'Password has been updated successfully.');
					redirect('admin/changepassword');
				} else {

					redirect('admin/changepassword');
				}
			}

		}
	}

	function handle_password() {
        if ($this->input->post('old')) {

            $val = $this->admin_model->getpassword();
            if ($val == 0) {
                $this->form_validation->set_message('handle_password', 'This Password is Wrong !');

                return FALSE;
            } else {
                return TRUE;
            }
        }
    }


}
