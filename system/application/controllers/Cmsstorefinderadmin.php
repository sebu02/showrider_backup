<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cmsstorefinderadmin extends CI_Controller {
	
	var $data = array();

    public function __construct() {
        parent::__construct();
        $this->load->helper('dump');
        $this->load->model('common_model');

        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('store_model');
        $this->load->model('uploadlibrary_model');
        
        //session_start();

        if ($this->session->userdata('logged_adminpanel') != 'true') {
            redirect('admin/login');
        }

    }

    public function index() {
        
    }

    public function add_location_type() {
        $data['values'] = $this->store_model->get_location_types();

        $this->form_validation->set_rules('parent_id', 'parent', 'required');
        $this->form_validation->set_rules('location_type', 'location_type_name', 'required');
        $this->form_validation->set_rules('location_key', 'location_key', 'callback_location_key_check');
        $this->form_validation->set_rules('order_no', 'order_no', 'required');


        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'store/add_location_type', $data);
        } else {

            $this->store_model->add_location_type();
            $this->session->set_flashdata('message', "Added Successfully!..");
            redirect('cmsstorefinderadmin/add_location_type/');
        }
    }

    public function location_key_check() {
        $data = $this->store_model->location_key_check();

        if ($data) {
            $this->form_validation->set_message('location_key_check', 'This location_key already exists');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function location_key_check1() {
        $data = $this->store_model->location_key_check1();
//        echo $pid;
//        die();
        if ($data) {
            $this->form_validation->set_message('location_key_check1', 'This location_key already exists');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function view_location_type() {

        $urisegments = $_SERVER['QUERY_STRING'];

        $offset = 0;

        if (isset($_GET['per_page'])) {

            $remove_segment = '&per_page=' . $_GET['per_page'];

            $urisegments = str_replace($remove_segment, '', $urisegments);

            if ($_GET['per_page'] != '') {
                $offset = $_GET['per_page'];
            } else {
                $offset = 0;
            }
        }




        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'cmsstorefinderadmin/view_location_type?' . $urisegments;
        $config['total_rows'] = $this->store_model->count_all_location_types();


        $config['page_query_string'] = TRUE;
        $config['reuse_query_string'] = true;

        $config['per_page'] = '10';
        $config['num_links'] = 5;
        $config['uri_segment'] = 7;

        $config['prev_link'] = ' Previous';
        $config['prev_tag_open'] = '';
        $config['prev_tag_close'] = '';
        $config['next_link'] = ' Next';
        $config['next_tag_open'] = '';

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['values'] = $this->store_model->list_location_types($config['per_page'], $offset);
        $data['page_position'] = $offset;


        $this->template->load('admin', 'store/view_location_type', $data);
    }

    function delete_location_type() {

        if (isset($_GET['id'])) {

            $id = $_GET['id'];
        }
        $this->load->common_model->TrashById('cms_location_types', $id, 'id');
        $this->session->set_flashdata('message', "Deleted Successfully!..");

        $uristrings = $_SERVER['QUERY_STRING'];
        if (isset($_GET['id'])) {

            $remove_seg3 = 'id=' . $_GET['id'];
            $newuristrings = str_replace($remove_seg3, '', $uristrings);
        }
        redirect('cmsstorefinderadmin/view_location_type?' . $newuristrings);
    }

    function edit_location_type() {

        if (isset($_GET['id'])) {

            $id = $_GET['id'];
        }

        $data['val'] = $this->common_model->GetByRow_noactive('cms_location_types', $id, 'id');
        $data['values'] = $this->store_model->get_location_types();



        $this->load->library('form_validation');
        $this->form_validation->set_rules('parent_id', 'parent', 'required');
        $this->form_validation->set_rules('location_type', 'location_type_name', 'required');
        $this->form_validation->set_rules('order_no', 'order_no', 'required');
        $this->form_validation->set_rules('location_key', 'location_key', 'callback_location_key_check1');

        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'store/edit_location_type', $data);
        } else {
            $this->store_model->edit_location_type($id);
            $this->session->set_flashdata('message', "Edited Successfully!..");

            $uristrings = $_SERVER['QUERY_STRING'];
            if (isset($_GET['id'])) {

                $remove_seg3 = 'id=' . $_GET['id'];
                $newuristrings = str_replace($remove_seg3, '', $uristrings);
            }
            redirect('cmsstorefinderadmin/view_location_type?' . $newuristrings);
        }
    }

    function view_trash_location_type() {

        $urisegments = $_SERVER['QUERY_STRING'];

        $offset = 0;

        if (isset($_GET['per_page'])) {

            $remove_segment = '&per_page=' . $_GET['per_page'];

            $urisegments = str_replace($remove_segment, '', $urisegments);

            if ($_GET['per_page'] != '') {
                $offset = $_GET['per_page'];
            } else {
                $offset = 0;
            }
        }


        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'cmsstorefinderadmin/view_trash_location_type?' . $urisegments;
        $config['total_rows'] = $this->store_model->count_all_trash_location_types();


        $config['page_query_string'] = TRUE;
        $config['reuse_query_string'] = true;

        $config['per_page'] = '10';
        $config['num_links'] = 5;
        $config['uri_segment'] = 7;

        $config['prev_link'] = ' Previous';
        $config['prev_tag_open'] = '';
        $config['prev_tag_close'] = '';
        $config['next_link'] = ' Next';
        $config['next_tag_open'] = '';

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['values'] = $this->store_model->list_trash_location_types($config['per_page'], $offset);
        $data['page_position'] = $offset;

//$data['districts'] = $this->store_model->get_districts();

        $this->template->load('admin', 'store/view_trash_location_type', $data);
    }

    function restore_location_type() {

        if (isset($_GET['id'])) {

            $id = $_GET['id'];
        }
        $this->load->common_model->RestoreById('cms_location_types', $id, 'id');
        $this->session->set_flashdata('message', "Restored Successfully!..");

        $uristrings = $_SERVER['QUERY_STRING'];
        if (isset($_GET['id'])) {

            $remove_seg3 = 'id=' . $_GET['id'];
            $newuristrings = str_replace($remove_seg3, '', $uristrings);
        }
        redirect('cmsstorefinderadmin/view_trash_location_type?' . $newuristrings);
    }

    function permanent_delete_location_type() {

        if (isset($_GET['id'])) {

            $id = $_GET['id'];
        }
        $delete_status = $this->load->common_model->DeleteById('cms_location_types', $id, 'id');
        if($delete_status == TRUE){
        $this->session->set_flashdata('message', "Permanently Deleted Successfully!..");
        } else {
            $this->session->set_flashdata('message', "This data can not be deleted.");
        }


        $uristrings = $_SERVER['QUERY_STRING'];
        if (isset($_GET['id'])) {

            $remove_seg3 = 'id=' . $_GET['id'];
            $newuristrings = str_replace($remove_seg3, '', $uristrings);
        }
        redirect('cmsstorefinderadmin/view_trash_location_type?' . $newuristrings);
    }

    public function add_location() {
//        $data['values'] = $this->store_model->get_location_types();
        $data['types'] = $this->common_model->GetByResultActive('cms_location_types', 'order_no', 'asc');
        $data['main'] = $this->common_model->GetByRow_noactive('cms_location_types', '0', 'parent_id');
        $data['child'] = $this->common_model->GetByRow_noactive('cms_location_types', $data['main']->id, 'parent_id');


        $data['main_list'] = $this->store_model->get_country_dropdown($data['main']->id, $data['main']->parent_id);



        $this->template->load('admin', 'store/add_location', $data);
    }

    public function add_location_detail() {



        $this->store_model->add_location();
    }

    public function get_location_dropdown() {

        $location_id = $this->input->post('location_id');
        $loaction_type_id = $this->input->post('loaction_type_id');

        $type = $this->input->post('type');
        if ($type == 'add') {

            $data['id'] = '';
        } elseif ($type == 'edit') {

            $data['id'] = $this->input->post('id');
        }


        $data['values'] = $this->store_model->get_location_dropdown($location_id, $loaction_type_id);
        $data['child'] = $this->input->post('child');
        $data['child_id'] = $this->input->post('child_id');

        $data['child2'] = $this->common_model->GetByRow_noactive('cms_location_types', $data['child_id'], 'parent_id');

        $parent_type_location_id_data = $this->common_model->GetByRow_noactive('cms_location_types', $data['child_id'], 'id');


        $data['parent_type_location_key'] = $parent_type_location_id_data->location_key;

        if ($data['values'] != NULL) {
            echo $this->load->view('store/location_dropdown', $data);
        } else {
            return;
        }
    }

    public function unique_location_name_check() {


        $data = $this->store_model->unique_location_name_check();

        echo $data;

//        if($data==true){
//            echo "1";
//        }elseif($data==false){
//            echo "0"; 
//        }
    }

    function view_location() {

        $urisegments = $_SERVER['QUERY_STRING'];

        $offset = 0;

        if (isset($_GET['per_page'])) {

            $remove_segment = '&per_page=' . $_GET['per_page'];

            $urisegments = str_replace($remove_segment, '', $urisegments);

            if ($_GET['per_page'] != '') {
                $offset = $_GET['per_page'];
            } else {
                $offset = 0;
            }
        }




        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'cmsstorefinderadmin/view_location?' . $urisegments;
        $config['total_rows'] = $this->store_model->count_all_location();


        $config['page_query_string'] = TRUE;
        $config['reuse_query_string'] = true;

        $config['per_page'] = '10';
        $config['num_links'] = 5;
        $config['uri_segment'] = 7;

        $config['prev_link'] = ' Previous';
        $config['prev_tag_open'] = '';
        $config['prev_tag_close'] = '';
        $config['next_link'] = ' Next';
        $config['next_tag_open'] = '';

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['values'] = $this->store_model->list_location($config['per_page'], $offset);
        $data['page_position'] = $offset;

//$data['districts'] = $this->store_model->get_districts();

        $this->template->load('admin', 'store/view_location', $data);
    }

    function delete_location() {

        if (isset($_GET['id'])) {

            $id = $_GET['id'];
        }
        $this->load->common_model->TrashById('cms_locations', $id, 'id');
        $this->session->set_flashdata('message', "Deleted Successfully!..");

        $uristrings = $_SERVER['QUERY_STRING'];
        if (isset($_GET['id'])) {

            $remove_seg3 = 'id=' . $_GET['id'];
            $newuristrings = str_replace($remove_seg3, '', $uristrings);
        }
        redirect('cmsstorefinderadmin/view_location?' . $newuristrings);
    }

    function view_trash_location() {

        $urisegments = $_SERVER['QUERY_STRING'];

        $offset = 0;

        if (isset($_GET['per_page'])) {

            $remove_segment = '&per_page=' . $_GET['per_page'];

            $urisegments = str_replace($remove_segment, '', $urisegments);

            if ($_GET['per_page'] != '') {
                $offset = $_GET['per_page'];
            } else {
                $offset = 0;
            }
        }


        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'cmsstorefinderadmin/view_trash_location?' . $urisegments;
        $config['total_rows'] = $this->store_model->count_all_trash_location();


        $config['page_query_string'] = TRUE;
        $config['reuse_query_string'] = true;

        $config['per_page'] = '10';
        $config['num_links'] = 5;
        $config['uri_segment'] = 7;

        $config['prev_link'] = ' Previous';
        $config['prev_tag_open'] = '';
        $config['prev_tag_close'] = '';
        $config['next_link'] = ' Next';
        $config['next_tag_open'] = '';

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['values'] = $this->store_model->list_trash_location($config['per_page'], $offset);
        $data['page_position'] = $offset;

//$data['districts'] = $this->store_model->get_districts();

        $this->template->load('admin', 'store/view_trash_location', $data);
    }

    function restore_location() {

        if (isset($_GET['id'])) {

            $id = $_GET['id'];
        }
        $this->load->common_model->RestoreById('cms_locations', $id, 'id');
        $this->session->set_flashdata('message', "Restored Successfully!..");

        $uristrings = $_SERVER['QUERY_STRING'];
        if (isset($_GET['id'])) {

            $remove_seg3 = 'id=' . $_GET['id'];
            $newuristrings = str_replace($remove_seg3, '', $uristrings);
        }
        redirect('cmsstorefinderadmin/view_trash_location?' . $newuristrings);
    }

    function permanent_delete_location() {

        if (isset($_GET['id'])) {

            $id = $_GET['id'];
        }
        $delete_status = $this->load->common_model->DeleteById('cms_locations', $id, 'id');
        if($delete_status == TRUE){
        $this->session->set_flashdata('message', "Permanently Deleted Successfully!..");
        } else {
            $this->session->set_flashdata('message', "This data can not be deleted.");
        }


        $uristrings = $_SERVER['QUERY_STRING'];
        if (isset($_GET['id'])) {

            $remove_seg3 = 'id=' . $_GET['id'];
            $newuristrings = str_replace($remove_seg3, '', $uristrings);
        }
        redirect('cmsstorefinderadmin/view_trash_location?' . $newuristrings);
    }

    function edit_location() {

        if (isset($_GET['id'])) {

            $id = $_GET['id'];
        }

        $data['types'] = $this->common_model->GetByResultActive('cms_location_types', 'order_no', 'asc');

        $data['value'] = $this->common_model->GetByRow_noactive('cms_locations', $id, 'id');
        $data['parent_value'] = $this->common_model->GetByRow_noactive('cms_locations', $data['value']->parent_id, 'id');

        $data['type_value'] = $this->common_model->GetByRow_noactive('cms_location_types', $data['value']->location_type_id, 'id');
        $data['parent_type_value'] = $this->common_model->GetByRow_noactive('cms_location_types', $data['type_value']->parent_id, 'id');

        $data['main'] = $this->common_model->GetByRow_noactive('cms_location_types', '0', 'parent_id');
        $data['child'] = $this->common_model->GetByRow_noactive('cms_location_types', $data['main']->id, 'parent_id');


        $data['main_list'] = $this->store_model->get_country_dropdown($data['main']->id, $data['main']->parent_id);

        $data['country_list'] = $this->store_model->get_country_list();

        $this->template->load('admin', 'store/edit_location', $data);
    }

    public function edit_location_detail() {


        $this->store_model->edit_location();
    }

    public function add_branch() {

//        $loc_pids = $this->store_model->get_location_parent_ids();
//        $loc_pids_arr = json_decode($loc_pids, true);
//        $parent_ids = array_column($loc_pids_arr, 'parent_id');
//        $data['parent_ids'] = $parent_ids;
//        $data['values1'] = $this->store_model->get_locations();

        $data['location_types'] = $this->common_model->GetByResultActive('cms_location_types', 'order_no', 'asc');
        $data['country_list'] = $this->store_model->get_country_list();

        $data['values'] = $this->uploadlibrary_model->Get_fileData();

//        $this->form_validation->set_rules('location_id', 'location', 'required');
        $this->form_validation->set_rules('branch_name', 'branch', 'required');
        $this->form_validation->set_rules('uniq_branch_name', 'unique branch name', 'callback_uniq_branch_name_check');
//        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('final_images', 'final_images', 'trim');
//        $this->form_validation->set_rules('latitude', 'latitude', 'required');
//        $this->form_validation->set_rules('longitude', 'longitude', 'required');
//        $this->form_validation->set_rules('ip_address', 'ip_address', 'required');
//        $this->form_validation->set_rules('extra_items', 'extra items', 'required');



        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'store/add_branch', $data);
        } else {

            $this->store_model->add_branch();
           // $this->store_model->UpdateAllBranchStatusInLocations();
            $this->session->set_flashdata('message', "Added Successfully!..");
            redirect('cmsstorefinderadmin/add_branch/');
        }
    }

    public function uniq_branch_name_check() {

        $data = $this->store_model->uniq_branch_name_check();

        if ($data) {
            $this->form_validation->set_message('uniq_branch_name_check', 'This unique branch name already exists');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function uniq_branch_name_check1() {

        $data = $this->store_model->uniq_branch_name_check1();

        if ($data) {
            $this->form_validation->set_message('uniq_branch_name_check1', 'This unique branch name already exists');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function view_branch() {

        $urisegments = $_SERVER['QUERY_STRING'];

        $offset = 0;

        if (isset($_GET['per_page'])) {

            $remove_segment = '&per_page=' . $_GET['per_page'];

            $urisegments = str_replace($remove_segment, '', $urisegments);

            if ($_GET['per_page'] != '') {
                $offset = $_GET['per_page'];
            } else {
                $offset = 0;
            }
        }




        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'cmsstorefinderadmin/view_branch?' . $urisegments;
        $config['total_rows'] = $this->store_model->count_all_branches();


        $config['page_query_string'] = TRUE;
        $config['reuse_query_string'] = true;

        $config['per_page'] = '10';
        $config['num_links'] = 5;
        $config['uri_segment'] = 7;

        $config['prev_link'] = ' Previous';
        $config['prev_tag_open'] = '';
        $config['prev_tag_close'] = '';
        $config['next_link'] = ' Next';
        $config['next_tag_open'] = '';

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['values'] = $this->store_model->list_branches($config['per_page'], $offset);
        $data['page_position'] = $offset;


        $this->template->load('admin', 'store/view_branch', $data);
    }

    function delete_branch() {

        if (isset($_GET['id'])) {

            $id = $_GET['id'];
        }
        $this->load->common_model->TrashById('cms_branches', $id, 'id');
        $this->session->set_flashdata('message', "Deleted Successfully!..");

        $uristrings = $_SERVER['QUERY_STRING'];
        if (isset($_GET['id'])) {

            $remove_seg3 = 'id=' . $_GET['id'];
            $newuristrings = str_replace($remove_seg3, '', $uristrings);
        }
        redirect('cmsstorefinderadmin/view_branch?' . $newuristrings);
    }

    function edit_branch() {

        if (isset($_GET['id'])) {

            $id = $_GET['id'];
        }
        $data['val'] = $this->common_model->GetByRow_noactive('cms_branches', $id, 'id');
//        $data['values1'] = $this->store_model->get_locations();
//        $loc_pids = $this->store_model->get_location_parent_ids();
//        $loc_pids_arr = json_decode($loc_pids, true);
//        $parent_ids = array_column($loc_pids_arr, 'parent_id');
//        $data['parent_ids'] = $parent_ids;

        $data['location_types'] = $this->common_model->GetByResultActive('cms_location_types', 'order_no', 'asc');
        $data['country_list'] = $this->store_model->get_country_list();

        $this->load->library('form_validation');
//        $this->form_validation->set_rules('location_id', 'location', 'required');
        $this->form_validation->set_rules('branch_name', 'branch', 'required');
        $this->form_validation->set_rules('uniq_branch_name', 'unique branch name', 'callback_uniq_branch_name_check1');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('final_images', 'final_images', 'trim');
//        $this->form_validation->set_rules('latitude', 'latitude', 'required');
//        $this->form_validation->set_rules('longitude', 'longitude', 'required');
//        $this->form_validation->set_rules('ip_address', 'ip_address', 'required');
//        $this->form_validation->set_rules('extra_items', 'extra items', 'required');

        if ($this->form_validation->run($this) == FALSE) {

            $data['values'] = $this->uploadlibrary_model->Get_fileData();
            $this->template->load('admin', 'store/edit_branch', $data);
        } else {

            $this->store_model->edit_branch($id);
            $this->store_model->UpdateAllBranchStatusInLocations();
            $this->session->set_flashdata('message', "Edited Successfully!..");

            $uristrings = $_SERVER['QUERY_STRING'];
            if (isset($_GET['id'])) {

                $remove_seg3 = 'id=' . $_GET['id'];
                $newuristrings = str_replace($remove_seg3, '', $uristrings);
            }
            redirect('cmsstorefinderadmin/view_branch?' . $newuristrings);
        }
    }

    function view_trash_branch() {

        $urisegments = $_SERVER['QUERY_STRING'];

        $offset = 0;

        if (isset($_GET['per_page'])) {

            $remove_segment = '&per_page=' . $_GET['per_page'];

            $urisegments = str_replace($remove_segment, '', $urisegments);

            if ($_GET['per_page'] != '') {
                $offset = $_GET['per_page'];
            } else {
                $offset = 0;
            }
        }


        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'cmsstorefinderadmin/view_trash_branch?' . $urisegments;
        $config['total_rows'] = $this->store_model->count_all_trash_branches();


        $config['page_query_string'] = TRUE;
        $config['reuse_query_string'] = true;

        $config['per_page'] = '10';
        $config['num_links'] = 5;
        $config['uri_segment'] = 7;

        $config['prev_link'] = ' Previous';
        $config['prev_tag_open'] = '';
        $config['prev_tag_close'] = '';
        $config['next_link'] = ' Next';
        $config['next_tag_open'] = '';

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['values'] = $this->store_model->list_trash_branches($config['per_page'], $offset);
        $data['page_position'] = $offset;

//$data['districts'] = $this->store_model->get_districts();

        $this->template->load('admin', 'store/view_trash_branch', $data);
    }

    function restore_branch() {

        if (isset($_GET['id'])) {

            $id = $_GET['id'];
        }
        $this->load->common_model->RestoreById('cms_branches', $id, 'id');
        $this->session->set_flashdata('message', "Restored Successfully!..");

        $uristrings = $_SERVER['QUERY_STRING'];
        if (isset($_GET['id'])) {

            $remove_seg3 = 'id=' . $_GET['id'];
            $newuristrings = str_replace($remove_seg3, '', $uristrings);
        }
        redirect('cmsstorefinderadmin/view_trash_branch?' . $newuristrings);
    }

    function permanent_delete_branch() {

        if (isset($_GET['id'])) {

            $id = $_GET['id'];
        }
        $delete_status = $this->load->common_model->DeleteById('cms_branches', $id, 'id');
        if($delete_status == TRUE){
            $this->store_model->UpdateAllBranchStatusInLocations();
        $this->session->set_flashdata('message', "Permanently Deleted Successfully!..");
        } else {
            $this->session->set_flashdata('message', "This data can not be deleted.");
        }


        $uristrings = $_SERVER['QUERY_STRING'];
        if (isset($_GET['id'])) {

            $remove_seg3 = 'id=' . $_GET['id'];
            $newuristrings = str_replace($remove_seg3, '', $uristrings);
        }
        redirect('cmsstorefinderadmin/view_trash_branch?' . $newuristrings);
    }

    public function fetchManipdata() {

        $comboid = $this->input->post('comboid');
        $this->uploadlibrary_model->fetchManipdata($comboid);
    }

    public function delete_upload_image() {
        $img = $this->input->post('img');
        $this->uploadlibrary_model->delete_upload_image($img);
    }

    public function deleteFilechange() {

        $finalFiles = $this->input->post('finalFiles');
        $this->uploadlibrary_model->deleteFilechange($finalFiles);
    }

    function bannerUpload() {

        $input_name = $this->input->post('file_input_name');
        $combo_name = $this->input->post('combo_name');

        if (isset($_FILES[$input_name]['name'])) {
            
//            $fileName = "images"; //$fileName=file type name
            $fileName = $input_name; //$fileName=file type name
            $comboID = $this->input->post($combo_name); //comboid
            $this->uploadlibrary_model->uploadLibrary($fileName, $comboID);
        }
        
    }

    /*     * Used of data merging * */

//    function InsertCountry() {
//         $this->store_model->InsertCountry();
//           $this->session->set_flashdata('message', "Uploaded Successfully!..");
//              redirect('cmsstorefinderadmin/view_location');
//    }
//    function InsertState() {
//         $this->store_model->InsertState();
//          $this->session->set_flashdata('message', "Uploaded Successfully!..");
//        redirect('cmsstorefinderadmin/view_location');
//    }
//    function InsertCityasDistrict() {
//         $this->store_model->InsertCity();
//          $this->session->set_flashdata('message', "Uploaded Successfully!..");
//        redirect('cmsstorefinderadmin/view_location');
//    }
    function InsertStoreRooms() {
        $this->store_model->InsertStoreRooms();
        $this->session->set_flashdata('message', "Uploaded Successfully!..");
        redirect('cmsstorefinderadmin/view_location');
    }

    /*     * Used of data merging * */

    public function get_location_list() {

        $p_id = $this->input->post('p_id');
        $l_id = $this->input->post('l_id');

        $data['val'] = $this->store_model->get_location_by_parent($p_id, $l_id);

        echo $this->load->view('store/location_list', $data);
    }

    public function UpdateAllBranchesAndLocations() {
        $this->store_model->UpdateAllBranchesAndLocations();
        $this->session->set_flashdata('message', "Updated Successfully!..");
//        echo "Updated Successfully";
        redirect('cmsstorefinderadmin/view_branch');
    }

    public function UpdateAllBranchStatusInLocations() {
        $this->store_model->UpdateAllBranchStatusInLocations();
        $this->session->set_flashdata('message', "Updated Successfully!..");
        redirect('cmsstorefinderadmin/view_branch');
    }      

}
