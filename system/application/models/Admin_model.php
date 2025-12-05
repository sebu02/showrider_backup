<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_model
        extends CI_Model {

    var $data = '';

   function checkModelStatus(){
          // echo "test";
   }

   function login(){
        $username = $this->input->post('username');
		$password = $this->input->post('password');		

        $this->db->where('username',$username);
		$this->db->where('trash_status','no');
		$this->db->where('active_status','a');

        $admin_details=$this->db->get('admin')->row();	

        $msg1 = $admin_details->password;

        $encrypted_string1 = $this->encryption->decrypt($msg1); 

        if($encrypted_string1==$password && $username==$admin_details->username)
		{
			return 1;
		}else{
            return 0;
        }
   }

   function countAllList(){
      return 50;
   }

   function getAllList($perpage , $rec_from){
      $result = array();
      return $result;
   }

   function getpassword()
   {   
            $check_password = $this->input->post('old');
            $username = $this->session->userdata('logged_username');

            $this->db->where('username', $username);
            $admin_details = $this->db->get('admin')->row();

            $msg1 = $admin_details->password;
        // $key1 = 'football-godland';
            $encrypted_string1 = $this->encryption->decrypt($msg1);
            if ($encrypted_string1 == $check_password) {
                return 1;
            } else {
                return 0;
            }
   }

   function update_password()
   {    
        $msg = $this->input->post('new');
        // $key = 'football-godland';
        $encrypted_string = $this->encryption->encrypt($msg);

        $data = array(
            'password' => $encrypted_string,
        );

        $check_password = $this->input->post('old');

        $username = $this->session->userdata('logged_username');

        $this->db->where('username', $username);

        $this->db->update('admin', $data);

        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }

        return FALSE;
   }  
 
}
