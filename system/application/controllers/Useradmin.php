<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Useradmin extends CI_Controller {
	
	var $data = array();

    public function __construct() {
        parent::__construct();
         $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('common_model');
        $this->load->model('user_model');
        $this->load->model('uploadlibrary_model');
        $this->load->model('route_model');        
        $this->load->library('encryption');

        //session_start();
      
        if ($this->session->userdata('logged_adminpanel') != 'true') {
            redirect('admin/login');
        }
        
    }  
   
function add_users()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_handle_username');
        $this->form_validation->set_rules('passwd1', 'password', 'required|min_length[4]');
        $this->form_validation->set_rules('passwd2', 'Confirm', 'required|min_length[4]|matches[passwd1]');
        $this->form_validation->set_rules('firstname', 'First Name', 'required');
		
		$this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_error_delimiters('<span style="color:#C30;">', '</span>');
        if ($this->form_validation->run($this) == FALSE) // validation hasn't been passed
        {
            $this->template->load('admin', 'users/add_user', '');
        } else {
			
			
            $msg = $this->input->post('passwd1');
            $encrypted_string = $this->encryption->encrypt($msg);
          
            $additional_data = array(
               		'passwords' => $encrypted_string,
                    'firstname' => $this->input->post('firstname'),
                    'phone' => $this->input->post('phone'),
                    'datetime' => date('Y-m-d H:i:s'),
            );
            $username = $this->input->post('email');
            $password = $this->input->post('passwd1');
            $email = $this->input->post('email');
            if ($this->ion_auth->register($username, $password, $email, $additional_data)) {
				
			
			$this->session->set_flashdata('message', "Added Successfully!..");
            redirect('useradmin/add_users/');
									
				
			}
			else
			{
			$this->session->set_flashdata('message', "Error ! Try again later ..");
            redirect('useradmin/add_users/');
								
			}
                    
        }
    }
	    
     function edituser() {
         
         $id=$_GET['id'];
         
        $data['user_details'] = $this->user_model->GetByRow('users', $id, 'id');

        $this->load->library('form_validation');

        
        $this->form_validation->set_rules('firstname', 'Name', 'required');
       
        $this->form_validation->set_rules('phone', 'Phone', 'required');

        if ($this->form_validation->run($this) == FALSE) {

            $this->template->load('admin', 'users/edit_user', $data);
        } else {

            $this->user_model->edituser($id);

            $this->session->set_flashdata('message', "Edited Successfully!..");
            redirect('useradmin/viewusers/');
        }
    }   
    
     function viewusers($sear = 0,$page_position = 0) {
         
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'useradmin/viewusers/' . $sear;
        $config['total_rows'] = $this->user_model->count_all_users();
        $config['per_page'] = 10;
        $config['num_links'] = 3;
        $config['uri_segment'] = 4;
        $config['prev_link'] = ' Previous';
        $config['prev_tag_open'] = '';
        $config['prev_tag_close'] = '';
        $config['next_link'] = ' Next';
        $config['next_tag_open'] = '';
        $config['next_tag_close'] = '';
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['values'] = $this->user_model->list_user($config['per_page'], $page_position);
        $data['page_position'] = $page_position;
        
        $this->template->load('admin', 'users/view_user', $data);
    }
    
    function handle_username() {
        $username = $this->input->post('email');
        if ($this->ion_auth->username_check($username)) {
            $this->form_validation->set_message('handle_username', 'This Username is already exist');
            return FALSE;
        } else {
            return TRUE;
        }
    }
        
    function handle_username_profile2() {
          $id=$_GET['id'];
        
        $username = $this->input->post('email');
        $val = $this->user_model->getusername_profile2($id);
        if ($val > 0) {
            $this->form_validation->set_message('handle_username_profile2', 'This Username is already exist !');
            return FALSE;
        } else {
            return TRUE;
        }
    }     
       
    
    function change_user_username() {

        $id=$_GET['id'];    
            
        $data['user_details'] = $this->user_model->GetByRow('users', $id, 'id');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('new_username', 'Username', 'required|callback_handle_username_profile2');
      
        if ($this->form_validation->run($this) == FALSE) {

            $this->template->load('admin', 'users/edit_user_username', $data);
        } else {

            $this->user_model->save_new_username($id);

            $this->session->set_flashdata('message', "Saved Successfully!..");

           redirect('useradmin/viewusers/');
        }
    }      
    
    function change_user_password() {
        
        $id=$_GET['id'];

        $data['user_details'] = $this->user_model->GetByRow('users', $id, 'id');
       
        $this->load->library('form_validation');

        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('password2', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run($this) == FALSE) {

            $this->template->load('admin', 'users/edit_user_password', $data);
        } else {

            $this->user_model->save_new_password($id);

            $this->session->set_flashdata('message', "Saved Successfully!..");

           redirect('useradmin/viewusers/');
        }
    }   
    
     function deleteuser($id) {
        $delete_status = $this->common_model->DeleteById('users', $id, 'id');
        if($delete_status == TRUE){
            //$this->common_model->DeleteById('meta', $id, 'user_id');
            $this->session->set_flashdata('message', "Deleted Successfully!..");
        } else {
            $this->session->set_flashdata('message', "This data can not be deleted.");
        }

       redirect('useradmin/viewusers/');
    }    
   
    function edit_address() {         
         $data['userid']=$id=$_GET['id'];                 
        $this->load->library('form_validation');        
        $this->form_validation->set_rules('', '', '');
       
        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin_address', 'users/edit_address', $data);
        } else {
            $this->user_model->edit_address($id);
            $this->session->set_flashdata('message', "Edited Successfully!..");
            redirect('useradmin/viewusers/');
        }
    }   
       
     function update_admin_user_address() {
            $gl_address_type = $this->input->post('gl_address_type');
            $gl_userid = $this->input->post('gl_userid');
            $this->user_model->update_admin_user_address($gl_address_type,$gl_userid);

            if ($gl_address_type == "edit_address") {
                echo 'useradmin/edit_address?id='.$gl_userid;
            }       
    }
    
        function admin_save_user_address() {
            $gl_address_type = $this->input->post('gl_address_type');
            $gl_userid = $this->input->post('gl_userid');
            $this->user_model->admin_save_user_address($gl_address_type,$gl_userid);

            if ($gl_address_type == "edit_address") {
                echo 'useradmin/edit_address?id='.$gl_userid;
            }       
        }
    
    
       function admin_set_user_address_default_type() {           
            $this->user_model->admin_set_user_address_default_type();       
       }
    
       function admin_delete_user_address() {      
           
            $userid = $this->input->post('userid');

            $existing_address = $this->user_model->get_user_address($userid);
            if (count($existing_address) > 1 && $existing_address != FALSE) {

                $frm_address_id = $this->input->post('frm_address_id');
                $this->user_model->TrashById('ec_user_address', $frm_address_id, 'id');
                echo 'Deleted Successfully!..';
            } else if ($existing_address != FALSE) {
                echo 'Please add one address after refreshing page';
            }
        
    }
        
    function download_user_mail_list() {
     ini_set('max_execution_time', 0);

        $filename = "Email_id_list-" . date('d-m-Y');

        $cms_form_data = $this->user_model->GetByResult_notrash_users();

        $cms_form_excel_columns_head_list = array('SIno','firstname','email','phone');
        $cms_form_excel_columns_list =  array('id','firstname','email','phone');

        $fielddata = array();
        $file_ending = "xls";
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=$filename.xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        /*         * *****Start of Formatting for Excel****** *///define separator (defines columns in excel & tabs in word)
        $sep = "\t";
    
        foreach ($cms_form_excel_columns_head_list as $key => $value) {
            echo $value . "\t";
        }
        print("\n");
        $j=0;
        foreach ($cms_form_data as $key1 => $cms_form_data_row) {
            $schema_insert = "";
            $j++;    
            foreach ($cms_form_excel_columns_list as $prod_col_name) {

                if($prod_col_name=="id"){
                   $attr_element_field_value=$j; 
                }else{
                    $attr_element_field_value = $cms_form_data_row->$prod_col_name;
                }
           
                $schema_insert .= $attr_element_field_value . $sep;
           
             
            }
       
            $schema_insert = str_replace($sep . "$", "", $schema_insert);
            $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
            $schema_insert .= "\t";
            print(trim($schema_insert));
            print "\n";         
                     
        }
    }
	
    function add_subadmin_users()
    {		
		$data['single_detail'] = array();
		
		$this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|callback_handle_admin_username');
		$this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('passwd1', 'password', 'required|min_length[4]');
        $this->form_validation->set_rules('passwd2', 'Confirm', 'required|min_length[4]|matches[passwd1]');
		
        $this->form_validation->set_error_delimiters('<span style="color:#C30;">', '</span>');
        if ($this->form_validation->run($this) == FALSE) // validation hasn't been passed
        {
            $this->template->load('admin', 'users/add_subadmin_user', $data);
        } else {
						
            $this->user_model->add_subadmin_user();
			
			$this->session->set_flashdata('message', "Added Successfully!..");
            redirect('useradmin/add_subadmin_users/');
									
			    
        }
    }
	

 function handle_admin_username() {
	 
        $username = $this->input->post('username');
		
		$user_details = $this->user_model->GetByRow('admin', $username, 'username');
		
        if ($user_details) {
            $this->form_validation->set_message('handle_admin_username', 'This Username is already exist');
            return FALSE;
        } else {
            return TRUE;
        }
    }	
	
     function view_subadmin_users() {

        $urisegments = $_SERVER['QUERY_STRING'];

        $offset = 0;

        if (isset($_GET['per_page'])) {

            $remove_segment = '&per_page=' . $_GET['per_page'];

            $urisegments = str_replace($remove_segment, '', $urisegments);
//            $urisegments = str_replace('&&', '&', $urisegments);
            if ($_GET['per_page'] != '') {
                $offset = $_GET['per_page'];
            } else {
                $offset = 0;
            }
        }
        
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'ecproductadmin/view_subadmin_users?' . $urisegments;
        $config['total_rows'] = $this->user_model->count_all_subadmin_users();
        $config['enable_query_strings'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['per_page'] = '5';
        $config['num_links'] = 5;
        $config['uri_segment'] = 4;
        $config['prev_link'] = ' Previous';
        $config['prev_tag_open'] = '';
        $config['prev_tag_close'] = '';
        $config['next_link'] = ' Next';
        $config['next_tag_open'] = '';
        $config['next_tag_close'] = '';
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['values'] = $this->user_model->list_subadmin_users($config['per_page'], $offset);
        $data['page_position'] = $offset;
        $this->template->load('admin', 'users/view_subadmin_user', $data);
    }
	
     function edit_subadmin_user($id) {

        $data['user_details'] = $data['single_detail'] = $this->user_model->GetByRow('admin', $id, 'id');

        $this->load->library('form_validation');

        
        $this->form_validation->set_rules('name', 'Name', 'required');
       
        $this->form_validation->set_rules('phone', 'Phone', 'required');

        if ($this->form_validation->run($this) == FALSE) {

            $this->template->load('admin', 'users/edit_subadmin_user', $data);
        } else {

            $this->user_model->edit_subadmin_user($id);

            $this->session->set_flashdata('message', "Edited Successfully!..");
            redirect('useradmin/view_subadmin_users/');
        }
    }
	
function trash_subadmin_user($id) {
	
        $this->user_model->TrashById('admin', $id, 'id');
        $this->session->set_flashdata('message', "Deleted Successfully!..");
        redirect('useradmin/view_subadmin_users?' . $_SERVER['QUERY_STRING']);
		
    }	
	 
    function change_subadmin_user_username($id) {
		
        $data['user_details'] = $this->user_model->GetByRow('admin', $id, 'id');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'required|callback_handle_admin_username');
      
        if ($this->form_validation->run($this) == FALSE) {

            $this->template->load('admin', 'users/edit_subadmin_username', $data);
        } else {

            $this->user_model->save_new_subadmin_username($id);

            $this->session->set_flashdata('message', "Updated Successfully!..");

           redirect('useradmin/view_subadmin_users?' . $_SERVER['QUERY_STRING']);
        }
    }
	
    function change_subadmin_password($id) {

        $data['user_details'] = $this->user_model->GetByRow('admin', $id, 'id');
       
        $this->load->library('form_validation');

        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('password2', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run($this) == FALSE) {

            $this->template->load('admin', 'users/edit_subadmin_password', $data);
        } else {

            $this->user_model->save_subadmin_password($id);

            $this->session->set_flashdata('message', "Updated Successfully!..");

            redirect('useradmin/view_subadmin_users?' . $_SERVER['QUERY_STRING']);
        }
    }	

function get_current_loc_data() {

        $row_id = $this->input->post('row_id');
		
		$data['single_detail'] = array();
		if(!empty($row_id))
		{
        $data['single_detail'] = $this->user_model->GetByRow('admin', $row_id, 'id');
		}
		
        $data['loc_data'] = $loc_data = $this->input->post('loc_data');
        $this->load->view('location_block', $data);
    }
   	
}
