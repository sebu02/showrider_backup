<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pageadmin extends CI_Controller {
	
	var $data = array();

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('common_model');
        $this->load->model('page_model');
        $this->load->model('route_model');
        $this->load->model('uploadlibrary_model');
       
        //session_start();

        if ($this->session->userdata('logged_adminpanel') != 'true') {
            redirect('admin/login');
        }
       
//        date_default_timezone_set('Asia/Calcutta');
    }

    public function index() {
        
    }
    
    function add_pages() {        
        $this->load->library('form_validation');

        $data['values2'] = array();
        $this->form_validation->set_rules('page', 'Page', 'required');
        $this->form_validation->set_rules('slug', 'Url', 'required|callback_handle_meta_slug');
        $this->form_validation->set_rules('keywords', 'Keywords', 'required');

        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'page/add_pages_new', $data);
        } else {
            $retundata = $this->page_model->insert_meta();
            $id=$retundata['id'];
            $redirection= "pageadmin/add_pages";          		 
			 
            $this->session->set_flashdata('message', "Added Successfully!..");
            redirect($redirection);
        }
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

//   file upload common section 
    public function delete_upload_image() {
        $img = $this->input->post('img');
        $this->uploadlibrary_model->delete_upload_image($img);
    }

    public function deleteFilechange() {
        $finalFiles = $this->input->post('finalFiles');
        $this->uploadlibrary_model->deleteFilechange($finalFiles);
    }

    public function fetchManipdata() {
        $comboid = $this->input->post('comboid');
        $this->uploadlibrary_model->fetchManipdata($comboid);
    }

    // End of   file upload common section  

    function view_pages($sear = 0, $page_position = 0) {

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
		
		$data['option'] = $this->common_model->option;

        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'pageadmin/view_pages?' . $urisegments;
        $config['total_rows'] = $this->page_model->count_all_meta();
        $config['enable_query_strings'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['per_page'] = '10';
        $config['num_links'] = 5;
        $config['uri_segment'] = 6;
        $config['prev_link'] = ' Previous';
        $config['prev_tag_open'] = '';
        $config['prev_tag_close'] = '';
        $config['next_link'] = ' Next';
        $config['next_tag_open'] = '';
        $config['next_tag_close'] = '';

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['metas'] = $this->page_model->list_meta($config['per_page'], $offset);
        $data['page_position'] = $offset;
//dump($this->db->last_query());
        $this->template->load('admin', 'page/view_pages', $data);
    }

    function edit_pages($id) {
//        $rand_code = $this->common_model->get_rand_alphanumeric(3);

        $this->data['meta_details'] = $this->page_model->GetByRow('cms_pages', $id, 'id');
		
        $this->data['values2'] = array();
        $this->load->library('form_validation');

        $this->form_validation->set_rules('page', 'Page', 'required');
        $this->form_validation->set_rules('slug', 'Url', 'required|callback_handle_meta_slug1');
        $this->form_validation->set_rules('keywords', 'Keywords', 'required');

        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'page/edit_pages_new', $this->data);
        } else {

            $id = $this->page_model->edit_pages($id);           
            $this->session->set_flashdata('message', "Edited Successfully!..");            
            $uristrings = $_SERVER['QUERY_STRING'];
         
            redirect('pageadmin/view_pages?'.$uristrings);
        }
    }
   
    function trashPage($id) {
        $this->page_model->TrashById('cms_pages', $id, 'id');
        $route_type = 'page';

        $action_type = 'trash';
        $quick_link_type = 'page';

        $this->route_model->routeTrashById('cms_routes', $id, 'slug_ref_id', $route_type);
        $this->route_model->save_routes($route_type);
        $this->session->set_flashdata('message', "Deleted Successfully!..");
        redirect('pageadmin/view_pages/');
    }

    /*
     * EOF trashContent
     */
    
    function trash_viewPage($sear = 0, $page_position = 0) {
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
        $config['base_url'] = base_url() . 'pageadmin/trash_viewPage?' . $urisegments;
        $config['total_rows'] = $this->page_model->trash_count_all_meta();

        $config['enable_query_strings'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['per_page'] = '10';
        $config['num_links'] = 5;
        $config['uri_segment'] = 6;
        $config['prev_link'] = ' Previous';
        $config['prev_tag_open'] = '';
        $config['prev_tag_close'] = '';
        $config['next_link'] = ' Next';
        $config['next_tag_open'] = '';
        $config['next_tag_close'] = '';

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['metas'] = $this->page_model->trash_list_meta($config['per_page'], $offset);
        $data['page_position'] = $offset;
        $this->template->load('admin', 'page/trash_viewPage', $data);
    }

    /*
     * EOF trash_viewPage
     */

    function restorePage($id) {
        $this->page_model->RestoreById('cms_pages', $id, 'id');
        $route_type = 'page';

        $action_type = 'restore';
        $quick_link_type = 'page';
        $this->common_model->quick_link_delete($id, $quick_link_type, $action_type);

        $this->route_model->routeRestoreById('cms_routes', $id, 'slug_ref_id', $route_type);
        $this->route_model->save_routes($route_type);
        $this->session->set_flashdata('message', "Restored Successfully!..");
        redirect('pageadmin/trash_viewPage/');
    }

    /*
     * EOF restorePage
     */

    function deletePage($id) {
        $delete_status = $this->common_model->DeleteById('cms_pages', $id, 'id');
        if ($delete_status == TRUE) {
            $route_type = 'page';
            $action_type = 'delete';
            $quick_link_type = 'page';
            $this->common_model->quick_link_delete($id, $quick_link_type, $action_type);
            $this->route_model->routeDeleteById('cms_routes', $id, 'slug_ref_id', $route_type);
            $this->route_model->save_routes($route_type);
            $this->session->set_flashdata('message', "Deleted Successfully!..");
        } else {
            $this->session->set_flashdata('message', "This data can not be deleted.");
        }

        redirect('pageadmin/trash_viewPage/');
    }

    /*
     * EOF delete page permanently
     */

    function handle_meta_slug() {

        $route_type = 'page';
        if ($this->input->post('url_type') == 'seo_url') {

            $full_slug = $this->input->post('slug');

            $ret = $this->page_model->select_page_slug();
            $ret_route = $this->route_model->route_check($full_slug, $route_type);
        } elseif ($this->input->post('url_type') == 'force_url') {

            $full_slug = $this->input->post('slug');
            $ret = $this->page_model->select_page_slug();
            $ret_route = $this->route_model->route_check($full_slug, $route_type);
        } elseif ($this->input->post('url_type') == 'auto_url') {
            $ret = FALSE;
            $ret_route = FALSE;
        }

        if ($ret == TRUE || $ret_route == TRUE) {
            $this->form_validation->set_message('handle_meta_slug', 'This URL Already Exists.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function handle_meta_slug1() {
        $route_type = 'page';
        if ($this->input->post('url_type') == 'seo_url') {

            $full_slug = $this->input->post('slug');

            $ret = $this->page_model->select_page_slug1();
            $ret_route = $this->route_model->route_check($full_slug, $route_type);
        } elseif ($this->input->post('url_type') == 'force_url') {

            $full_slug = $this->input->post('slug');
            $ret = $this->page_model->select_page_slug1();
            $ret_route = $this->route_model->route_check($full_slug, $route_type);
        } elseif ($this->input->post('url_type') == 'auto_url') {
            $ret = FALSE;
            $ret_route = FALSE;
        }

        if ($ret == TRUE || $ret_route == TRUE) {
            $this->form_validation->set_message('handle_meta_slug1', 'This URL Already Exists.');
            return FALSE;
        } else {
            return TRUE;
        }
    }    
   
    function orderExistOrNot() {
        $order = $this->input->post('order');
        $page_id = $this->input->post('page_id');
        $count_row = $this->page_model->orderExistOrNot($order,$page_id);
        echo $count_row;
    }        
	 
}
