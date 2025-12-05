<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cmsmailsadmin extends CI_Controller {
	
	var $data = array();

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('common_model');
        $this->load->model('mail_model');
        $this->load->model('uploadlibrary_model');
        $this->load->model('route_model');
        
        //$this->output->enable_profiler(TRUE);
       // session_start();
        
        // error_reporting(0);

        if ($this->session->userdata('logged_adminpanel') != 'true') {
            redirect('admin/login');
        }        
    }

    public function index() {
        
    }

    function viewmails() {

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
        $config['base_url'] = base_url() . 'cmsmailsadmin/viewmails/?' . $urisegments;
        $config['total_rows'] = $this->mail_model->countmails();
        $config['enable_query_strings'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['per_page'] = '10';
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
        $data['item_list'] = $this->mail_model->listmails($config['per_page'], $offset);
        $data['page_position'] = $offset;
        $data['mail_type_list'] = $this->common_model->GetAllMailTypes();

        $this->template->load('admin', 'mails/viewmails', $data);
    }

    function trash_mails($id) {
        $this->mail_model->TrashById('cms_form_data', $id, 'id');
        $this->session->set_flashdata('message', "Deleted Successfully!..");
        redirect('cmsmailsadmin/viewmails?' . $_SERVER['QUERY_STRING']);
    }

    function restore_mails($id) {
        $this->mail_model->RestoreById('cms_form_data', $id, 'id');
        $this->session->set_flashdata('message', "Restored Successfully!..");
        redirect('cmsmailsadmin/trash_view_mails/');
    }

    function delete_mails($id) {
        $delete_status = $this->common_model->DeleteById('cms_form_data', $id, 'id');
        if($delete_status == TRUE){
        $this->session->set_flashdata('message', "Deleted Successfully!..");
        } else {
            $this->session->set_flashdata('message', "This data can not be deleted.");
        }
        
        redirect('cmsmailsadmin/trash_view_mails/');
    }

    function trash_view_mails() {
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
        $config['base_url'] = base_url() . 'cmsmailsadmin/trash_view_mails/?' . $urisegments;
        $config['total_rows'] = $this->mail_model->trash_count_all_mails();
        $config['enable_query_strings'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['per_page'] = '10';
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
        $data['item_list'] = $this->mail_model->trash_list_mails($config['per_page'], $offset);
        $data['page_position'] = $offset;
        $data['mail_type_list'] = $this->common_model->GetAllMailTypes();
        $this->template->load('admin', 'mails/trash_view_mails', $data);
    }

    function GetFileNameFromString() {

        ini_set('max_execution_time', 0);
        $this->db->order_by('id', 'desc');
        $this->db->where('form_name', 'career');
        $item_list = $this->db->get('cms_form_data')->result();
        foreach ($item_list as $item_key => $item_row) {

            $form_data_list = json_decode($item_row->form_json_data, TRUE);
            $form_data_list_array = $form_data_list[0];

            if (isset($form_data_list_array['Career_File'])) {
                $form_data = $form_data_list_array['Career_File'];
                $start_string = '';

                $dom = new DOMDocument;
                @$dom->loadHTML($form_data);
                $links = $dom->getElementsByTagName('a');
                foreach ($links as $link) {
                    $form_data = $link->getAttribute('href');
                }
                $form_data = str_replace($start_string, "", $form_data);

                $form_data_list_array = $this->common_model->array_push_assoc($form_data_list_array, 'Career_File', $form_data);
                $form_data_list = array($form_data_list_array);
                $form_json_data = json_encode($form_data_list);

                $data = array(
                    'form_json_data' => $form_json_data,
                );

                $this->db->where('id', $item_row->id);
                $this->db->update('cms_form_data', $data);
            }
        }
        echo "Finished execution";
    }

    function downloadformlist() {                
       $this->mail_model->downloadformlist();            
    }
            
}
