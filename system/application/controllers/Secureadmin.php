<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Secureadmin extends CI_Controller {
	
	var $data = array();

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->library('session');
        //	$this->load->library('FCKeditor');
        $this->load->model('common_model');
        $this->load->model('secureadmin_model');
        $this->load->library('encryption');

        // error_reporting(0);

       date_default_timezone_set('Asia/Calcutta');

       if ($this->session->userdata('logged_adminpanel') != 'true') {
            redirect('admin/login');
        }
    }

    public function index() {
         /* $msg = 'admin';
         echo $encrypted_string = $this->encryption->encrypt($msg);*/
    }

    function logout() {        
        redirect('admin/logout');
    }

}
