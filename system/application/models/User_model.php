<?php

class User_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_options() {
        ini_set('max_execution_time', 0);
        $this->db->select('*');
        $this->db->from('cms_options');
        $this->db->order_by('id', 'asc');
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function GetByRow($table, $eventid, $field) {
        //echo $eventid;
        $this->db->where(array($field => $eventid));
        return $result = $this->db->get($table)->row();
    }

    function GetByResult($table, $order_column, $order_type) {
        //echo $eventid;
        $this->db->order_by($order_column, $order_type);
        return $result = $this->db->get($table)->result();
    }

    function DeleteById($table, $id, $field) {
        //echo $id;
        $this->db->where(array($field => $id));
        $this->db->delete($table);
    }

    function adduser() {
        $msg = $this->input->post('password');
        //$key = 'habitat-godland';
        $encrypted_string = $this->encryption->encrypt($msg);

        $all_serv = '';
        if ($this->input->post('services') != '') {

            $services = $this->input->post('services');

            $all_serv = '+';
            foreach ($services as $serv) {
                $all_serv .= $serv . '+';
            }
        }

        $additional_data = array(
            'passwords' => $encrypted_string,
            'firstname' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'user_type' => $this->input->post('user_type'),
            'services_tree' => $all_serv,
        );

        $username = $this->input->post('email');
        $password = $this->input->post('password');
        $email = $this->input->post('email');

        $this->ion_auth->register($username, $password, $email, $additional_data);
    }

    function edituser($id) {

        $data = array(
            'firstname' => $this->input->post('firstname'),
            'phone' => $this->input->post('phone'),
            
        );

        $this->db->where('id', $id);
        $this->db->update('users', $data);

    }

    function save_new_username($id) {

        $data2 = array(
            'username' => $this->input->post('new_username'),
        );

        $this->db->where('id', $id);
        $this->db->update('users', $data2);
    }

    function getusername_profile2($id) {
        $loged_username = $id;

        $check_user = $this->input->post('new_username');

        $this->db->where('id !=', $loged_username);
        $this->db->where('username', $check_user);
        $val = $this->db->get('users');
        //print_r($val);
        return $val->num_rows();
        /*
          if($val->num_rows()=='0') return '0';
          else  return '1';
         */
    }

    function count_all_users() {

	if ($this->uri->segment(3) != '0') {
            $sess_val = $this->uri->segment(3);
            $s_a = str_replace("123", "&", $sess_val);
            $s_a = str_replace("-", " ", $s_a);
			$s_a = trim($s_a);
            $this->db->like('username', $s_a);
			$this->db->or_like('firstname', $s_a);
			$this->db->or_like('phone', $s_a);
           
        }
		
    $query = $this->db->get('users');
    return $query->num_rows;
	
    }

    function list_user($perpage, $rec_from) {

	if ($this->uri->segment(3) != '0') {
            $sess_val = $this->uri->segment(3);
            $s_a = str_replace("123", "&", $sess_val);
            $s_a = str_replace("-", " ", $s_a);
			$s_a = trim($s_a);
            $this->db->like('username', $s_a);
			$this->db->or_like('firstname', $s_a);
			$this->db->or_like('phone', $s_a);
           
        }
	$this->db->order_by('id', 'DESC');	
    $query = $this->db->get('users');
    return $query->result();
    }

    function save_new_password($id) {

        $msg = $this->input->post('password');
        //$key = 'gl-godland';
        $encrypted_string = $this->encryption->encrypt($msg);

        $username = $this->input->post('username');

        $new_password = $this->input->post('password');

        $oldpassword = $this->input->post('oldpassword');

        $data2 = array(
            'passwords' => $encrypted_string
        );

        $this->db->where('id', $id);
        $this->db->update('users', $data2);

        $this->ion_auth->change_password($username, $oldpassword, $new_password);
    }

    public function personal_titles() {
        $personal_titles = array('Mr', 'Miss', 'Mrs', 'Ms', 'Dr');
        return $personal_titles;
    }

    public function country_list() {
        $this->db->select('*');
        $this->db->from('cms_locations');
        $this->db->where('location_type_id', '1');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function TrashById($table, $id, $field) {
        $data = array(
            'trash_status' => 'yes',
            'active_status' => 'd',
            'date_deleted' => date("Y-m-d H:i:s")
        );

        $this->db->where(array($field => $id));
        $this->db->update($table, $data);
    }

    function get_user_address($userid) {
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->where('user_id', $userid);
        $query = $this->db->get('ec_user_address');

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function update_admin_user_address($gl_address_type, $gl_userid) {
        $userid = $gl_userid;
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->where('user_id', $userid);
        $existing = $this->db->get('ec_user_address');

        $data_delivery_address = array(
            'frm_title' => $this->input->post('frm_title'),
            'frm_email' => $this->input->post('frm_email'),
            'frm_first_name' => $this->input->post('frm_first_name'),
            'frm_last_name' => $this->input->post('frm_last_name'),
            'frm_phoneno' => $this->input->post('frm_phoneno'),
            'frm_pincode' => $this->input->post('frm_pincode'),
            'frm_locality' => $this->input->post('frm_locality'),
            'frm_address' => $this->input->post('frm_address'),
            'frm_city' => $this->input->post('frm_city'),
            'frm_state' => $this->input->post('frm_state'),
            'frm_country' => $this->input->post('frm_country'),
            'frm_landmark' => $this->input->post('frm_landmark'),
            'frm_alt_phone' => $this->input->post('frm_alt_phone'),
            'frm_delivery_type' => $this->input->post('frm_delivery_type'),
        );

        $delivery_address = json_encode($data_delivery_address);

        $data = array(
            'delivery_address' => $delivery_address,
            'date_modified' => date('Y-m-d H:i:s'),
            'trash_status' => 'no',
            'active_status' => 'a',
        );
        $frm_address_id = $this->input->post('frm_address_id');
        $this->db->where('id', $frm_address_id);
        $this->db->update('ec_user_address', $data);
        // Adding delivery address to Session
        $gl_cart_session = $this->session->userdata('gl_cart');
        if ($existing->num_rows() < 1) {

            $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'session_billing_address_id', $frm_address_id);
            $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'session_delivery_address_id', $frm_address_id);
        } else {

            if ($gl_address_type == "delivery_type") {

                $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'session_delivery_address_id', $frm_address_id);
            } else if ($gl_address_type == "billing_type") {

                $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'session_billing_address_id', $frm_address_id);
                $frm_same_as_billing = $this->input->post('frm_same_as_billing');
                if ($frm_same_as_billing == "yes") {
                    $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'session_delivery_address_id', $frm_address_id);
                }
            }
        }

        $this->session->set_userdata('gl_cart', $gl_cart_session);
        //EOC Adding delivery address to Session
    }

    function admin_save_user_address($gl_address_type, $gl_userid) {

        $userid = $gl_userid;

        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->where('user_id', $userid);
        $existing = $this->db->get('ec_user_address');

        $data_delivery_address = array(
            'frm_title' => $this->input->post('frm_title'),
            'frm_email' => $this->input->post('frm_email'),
            'frm_first_name' => $this->input->post('frm_first_name'),
            'frm_last_name' => $this->input->post('frm_last_name'),
            'frm_phoneno' => $this->input->post('frm_phoneno'),
            'frm_pincode' => $this->input->post('frm_pincode'),
            'frm_locality' => $this->input->post('frm_locality'),
            'frm_address' => $this->input->post('frm_address'),
            'frm_city' => $this->input->post('frm_city'),
            'frm_state' => $this->input->post('frm_state'),
            'frm_country' => $this->input->post('frm_country'),
            'frm_landmark' => $this->input->post('frm_landmark'),
            'frm_alt_phone' => $this->input->post('frm_alt_phone'),
            'frm_delivery_type' => $this->input->post('frm_delivery_type'),
        );

        $delivery_address = json_encode($data_delivery_address);

        $data = array(
            'user_id' => $userid,
            'delivery_address' => $delivery_address,
            'date_created' => date('Y-m-d H:i:s'),
            'trash_status' => 'no',
            'active_status' => 'a',
        );

        if ($existing->num_rows() < 1) {

            $data = $this->common_model->array_push_assoc($data, "default_delivery_address_status", "yes");
            $data = $this->common_model->array_push_assoc($data, "default_billing_address_status", "yes");
        }
        $this->db->insert('ec_user_address', $data);
        $ec_user_address_id = $this->db->insert_id();

        // Adding delivery address to Session
        $gl_cart_session = $this->session->userdata('gl_cart');
        if ($existing->num_rows() < 1) {

            $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'session_billing_address_id', $ec_user_address_id);
            $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'session_delivery_address_id', $ec_user_address_id);
        } else {

            if ($gl_address_type == "delivery_type") {

                $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'session_delivery_address_id', $ec_user_address_id);
            } else if ($gl_address_type == "billing_type") {

                $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'session_billing_address_id', $ec_user_address_id);
                $frm_same_as_billing = $this->input->post('frm_same_as_billing');
                if ($frm_same_as_billing == "yes") {
                    $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'session_delivery_address_id', $ec_user_address_id);
                }
            }
        }

        $this->session->set_userdata('gl_cart', $gl_cart_session);
        //EOC Adding delivery address to Session

        $existing_meta = $this->common_model->GetByRow_notrash('users', $userid, 'user_id');
        if ($existing_meta->address == "") {

            $data_meta = array(
                'phone' => $this->input->post('frm_phoneno'),
                'lastname' => $this->input->post('frm_last_name'),
                'title' => $this->input->post('frm_title'),
                'address' => $delivery_address,
            );
            $this->db->where('user_id', $userid);
            $this->db->update('users', $data_meta);
        }
    }

    function admin_set_user_address_default_type() {

        $userid = $this->input->post('userid');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->where('user_id', $userid);
        $existing = $this->db->get('ec_user_address');
        $addressid = $this->input->post('addressid');
        $addresstype = $this->input->post('addresstype');

        if ($existing->num_rows() >= 1) {

            if ($addresstype == "delivery_type") {
                $data_update_no = array(
                    'default_delivery_address_status' => 'no',
                );
                $data_update_yes = array(
                    'default_delivery_address_status' => 'yes',
                );
            }

            if ($addresstype == "billing_type") {
                $data_update_no = array(
                    'default_billing_address_status' => 'no',
                );
                $data_update_yes = array(
                    'default_billing_address_status' => 'yes',
                );
            }
            $this->db->where('user_id', $userid);
            $this->db->update('ec_user_address', $data_update_no);

            $this->db->where('id', $addressid);
            $this->db->update('ec_user_address', $data_update_yes);
        }
    }
    
    function countUserOrders($userid) {

        $this->db->where('user_id', $userid);

        $this->db->order_by('id', 'desc');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');

        $val = $this->db->get('ec_orders');
        return $val->num_rows();
    }
    function countUserCoupons($userid) {

        $this->db->where('user_id', $userid);

        $this->db->order_by('id', 'desc');
        $this->db->where('trash_status', 'no');
        $val = $this->db->get('ec_coupon');
        return $val->num_rows();
    }
    function countUserAddress($userid) {

        $this->db->where('user_id', $userid);
        $this->db->where('trash_status', 'no');
        $val = $this->db->get('ec_user_address');
        return $val->num_rows();
    }

    function GetByResult_notrash_users(){
           $this->db->where('email !=', '');
             return $query = $this->db->get('users')->result();
       
    }
	
function add_subadmin_user() {    
	  
	  	$passwd1 = $this->input->post('passwd1');		
        $encrypted_string = $this->encryption->encrypt($passwd1);  

        $data = array(
		
			'type' => $this->input->post('usertype'),
            'name' => $this->input->post('name'),
			'phone' => $this->input->post('phone'),
			'username' => $this->input->post('username'),
			'password' => $encrypted_string,
			'trash_status' => 'no',
			'active_status' => 'a',

        );
        $this->db->insert('admin', $data);
		
		$insertid = $this->db->insert_id();

if(isset($_POST['location_country']))
{

		/*
         * location function 
         */
        $location_country = $this->input->post("location_country");
        $location_state = $this->input->post("location_state");
        $location_city = $this->input->post("location_city");

        if (!empty($location_country) && !empty($location_state) && !empty($location_city)) {

            $location_country_tree = "+";
            foreach ($location_country as $location_country_item) {
                $location_country_tree .= $location_country_item . "+";
            }
            $location_state_tree = "+";
            foreach ($location_state as $location_state_item) {
                $location_state_tree .= $location_state_item . "+";
            }
            $location_city_tree = "+";
            foreach ($location_city as $location_city_item) {
                $location_city_tree .= $location_city_item . "+";
            }
                      
                $data_location = array(
                    "location_country" => $location_country_tree,
                    "location_state" => $location_state_tree,
                    "location_city" => $location_city_tree);

                $this->db->where('id', $insertid);
                $this->db->update('admin', $data_location);
               
            
        }

        /*
         * EOF location function 
         */		
		
		
}

if(isset($_POST['user_district']))
{
$user_district = $this->input->post("user_district");	
$locations_details = $this->common_model->GetByRow('cms_locations', $user_district, 'id');

$location_country_tree = '+'.$locations_details->main_parent_id.'+';
$location_state_tree = '+'.$locations_details->parent_id.'+';	
$location_city_tree = '+'.$locations_details->id.'+';

					$data_location = array(
                    "location_country" => $location_country_tree,
                    "location_state" => $location_state_tree,
                    "location_city" => $location_city_tree);

                $this->db->where('id', $insertid);
                $this->db->update('admin', $data_location);	
	
}


if(!empty($this->session->userdata('logged_admin_id')))
{

$logged_admin_id = $this->session->userdata('logged_admin_id');

			$data2 = array(
                    "created_userid" => $logged_admin_id,
					);

                $this->db->where('id', $insertid);
                $this->db->update('admin', $data2);		
	
}


    }		
	
	    function count_all_subadmin_users() {

$usertype_array = array('super', 'adminorderuser');

if($this->session->userdata('logged_admin_type') == 'subadmin')
{
$logged_admin_id = $this->session->userdata('logged_admin_id');
$this->db->where('created_userid', $logged_admin_id);
}

        $this->db->where('trash_status', 'no');
		//$this->db->where('active_status', 'a');
		$this->db->where_not_in('type', $usertype_array);
        $val = $this->db->get('admin');
        return $val->num_rows();
    }

    /*
     * End of Count all Category
     */

    /*
     * List all Category 
     */

    function list_subadmin_users($perpage, $rec_from) {

$usertype_array = array('super', 'adminorderuser');

if($this->session->userdata('logged_admin_type') == 'subadmin')
{
$logged_admin_id = $this->session->userdata('logged_admin_id');
$this->db->where('created_userid', $logged_admin_id);
}

        $this->db->where('trash_status', 'no');
		//$this->db->where('active_status', 'a');
		$this->db->where_not_in('type', $usertype_array);
        $this->db->limit($perpage, $rec_from);
        return $this->db->get('admin')->result();
    }
		
function sort_subadmin_users()
{
	
	       if (isset($_GET['name'])) {

            $sess_val = $_GET['name'];

            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('name', $s_a);
        }
       
       $this->db->order_by('id', 'DESC');
       	
}

function edit_subadmin_user($id) {

        $data = array(
            'name' => $this->input->post('name'),
            'phone' => $this->input->post('phone'),
			'active_status' => $this->input->post('active_status'),
            
        );

        $this->db->where('id', $id);
        $this->db->update('admin', $data);
		
if(isset($_POST['location_country']))
{

		/*
         * location function 
         */
        $location_country = $this->input->post("location_country");
        $location_state = $this->input->post("location_state");
        $location_city = $this->input->post("location_city");

        if (!empty($location_country) && !empty($location_state) && !empty($location_city)) {

            $location_country_tree = "+";
            foreach ($location_country as $location_country_item) {
                $location_country_tree .= $location_country_item . "+";
            }
            $location_state_tree = "+";
            foreach ($location_state as $location_state_item) {
                $location_state_tree .= $location_state_item . "+";
            }
            $location_city_tree = "+";
            foreach ($location_city as $location_city_item) {
                $location_city_tree .= $location_city_item . "+";
            }
                      
                $data_location = array(
                    "location_country" => $location_country_tree,
                    "location_state" => $location_state_tree,
                    "location_city" => $location_city_tree);

                $this->db->where('id', $id);
                $this->db->update('admin', $data_location);
               
            
        }

        /*
         * EOF location function 
         */		
				
}

if(isset($_POST['user_district']))
{
$user_district = $this->input->post("user_district");	
$locations_details = $this->common_model->GetByRow('cms_locations', $user_district, 'id');

$location_country_tree = '+'.$locations_details->main_parent_id.'+';
$location_state_tree = '+'.$locations_details->parent_id.'+';	
$location_city_tree = '+'.$locations_details->id.'+';

					$data_location = array(
                    "location_country" => $location_country_tree,
                    "location_state" => $location_state_tree,
                    "location_city" => $location_city_tree);

                $this->db->where('id', $insertid);
                $this->db->update('admin', $data_location);	
	
}

if(!empty($this->session->userdata('logged_admin_id')))
{

$logged_admin_id = $this->session->userdata('logged_admin_id');

			$data2 = array(
                    "created_userid" => $logged_admin_id,
					);

                $this->db->where('id', $insertid);
                $this->db->update('admin', $data2);		
	
}		
	
    }	
	
function save_new_subadmin_username($id) {

        $data2 = array(
            'username' => $this->input->post('username'),
        );

        $this->db->where('id', $id);
        $this->db->update('admin', $data2);
    }	
	
function save_subadmin_password($id) {

        $msg = $this->input->post('password');
       
        $encrypted_string = $this->encryption->encrypt($msg);

        $data2 = array(
            'password' => $encrypted_string,
        );

        $this->db->where('id', $id);
        $this->db->update('admin', $data2);

    }	
		
	 function getlocation($parent_location) {
        $this->db->where('parent_id', $parent_location);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('cms_locations')->result();
    }
		
}
