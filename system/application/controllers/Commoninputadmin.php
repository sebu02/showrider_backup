<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Commoninputadmin extends CI_Controller {
	
	var $data = array();

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('common_model');        
        $this->load->model('uploadlibrary_model');       
        $this->load->model('route_model');
        
        //session_start();

        if ($this->session->userdata('logged_adminpanel') != 'true') {
            redirect('admin/login');
        }        
    }

    public function index() {
        
    }

    public function bannerUpload() {

        $input_name = $this->input->post('file_input_name');
        $combo_name = $this->input->post('combo_name');


        if (isset($_FILES[$input_name]['name'])) {

//            $fileName = "images"; //$fileName=file type name
            $fileName = $input_name; //$fileName=file type name
            $comboID = $this->input->post($combo_name); //comboid
            $this->uploadlibrary_model->uploadLibrary($fileName, $comboID);
        }
    }

    public function delete_upload_image() {
        /*         * **
         *        No need of muliple copy of code
         */
        $img = $this->input->post('img');
        $this->uploadlibrary_model->delete_upload_image($img);
    }

    public function deleteFilechange() {
        /*         * **
         *        No need of muliple copy of code
         */
        $finalFiles = $this->input->post('finalFiles');
        $this->uploadlibrary_model->deleteFilechange($finalFiles);
    }

    public function fetchManipdata() {
        /*         * **
         *        No need of muliple copy of code
         */
        $comboid = $this->input->post('comboid');
        $this->uploadlibrary_model->fetchManipdata($comboid);
    }

    // End of   file upload common section 
         
}
