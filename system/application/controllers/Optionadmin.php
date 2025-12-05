<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Optionadmin extends CI_Controller {
		
	var $data = array();

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('common_model');
        $this->load->model('option_model');
        $this->load->model('uploadlibrary_model');        
        $this->load->library('encryption');

        // error_reporting(0);
        //session_start();

        if ($this->session->userdata('logged_adminpanel') != 'true') {
            redirect('admin/login');
        }      
    }

    public function index() {
        
    }
    
    //   file upload common section 

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

    function viewoptions() {
        $output['values'] = $this->common_model->get_options();
        $this->template->load('admin', 'option/viewoptions', $output);
    }         
    
    function update_cache_settings($id) {
        $cache_date_modified = $this->option_model->update_cache_settings($id);
        echo date("l jS \of F Y H:i:s A", strtotime($cache_date_modified));
    }

    function time_zone_list() {
        $zones_array = array();
        $timestamp = time();
        foreach (timezone_identifiers_list() as $key => $zone) {
//            date_default_timezone_set($zone);
            $zones_array[$key]['zone'] = $zone;
            $zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
        }
        return $zones_array;
    }

    function savevistors() {
        $this->common_model->savevisitors();
    }
    
 function load_table_data(){
     $current_table=$this->input->post("current_table");
     $column_set="";
     if(!empty($current_table)){
             $columns=$this->db->list_fields($current_table);
             
             if(!empty($columns)){
                 
                 foreach($columns as $column){
                     $selected="";
                     if(!empty($this->input->post("column"))){
                         if($this->input->post("column")==$column){
                             $selected=" selected ";
                         }
                     }
                     
                    $column_set.= "<option value='".$column."'  ".$selected.">".$column."</option>"; 
                 }
             }
         }
      echo $column_set;   
     }     
        
    function test()
    {	
     $options = $this->common_model->option;
     $currencySet = $this->common_model->currencySet;
    }

    function user_option_updation() {            
        $this->data['option_row'] = $option_row = $this->common_model->option;          
        $this->load->library('form_validation');		
		$this->form_validation->set_rules('user_option_updation', 'user_option_updation', 'trim');       

        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'option/user_option_updation', $this->data);
        } else {
             $this->option_model->update_user_option();
             $this->session->set_flashdata('message', "Edited Successfully!..");            
             redirect('optionadmin/user_option_updation');           
        }
    }

    function add_mail_data(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('contact_from_email', 'From Email', 'trim');

        $data['option_row'] = $option_row = $this->common_model->option;
        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'option/add_mail_data', $data);
        }else{
            $this->option_model->addMailData();
            
            $this->session->set_flashdata('message', "Edited Successfully!..");
            redirect('optionadmin/viewoptions/');
        }
    }
    
    function add_project_data(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('contact_from_email', 'From Email', 'trim');

        $data['option_row'] = $option_row = $this->common_model->option;
        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'option/add_project_data', $data);
        }else{
            $this->option_model->addProjectData();
            
            $this->session->set_flashdata('message', "Edited Successfully!..");
            redirect('optionadmin/viewoptions/');
        }
    }

    function add_seo_contents(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('seo_title', 'SEO Title', 'required');
        $data['option_row'] = $option_row = $this->common_model->option;

        if ($this->form_validation->run($this) == FALSE){
            $this->template->load('admin', 'option/add_seo_contents', $data);
        }else{
            $this->option_model->addSeoContents();

            $this->session->set_flashdata('message', "Edited Successfully!..");
            redirect('optionadmin/viewoptions/');
        }
    }

    function add_social_media(){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('facebook_fans', 'Facebook Fans', 'trim');
        $this->form_validation->set_rules('twitter_followers', 'Twitter Followers', 'trim');
        $this->form_validation->set_rules('youtube_subscribers', 'YouTube Subscribers', 'trim');
        $this->form_validation->set_rules('instagram_followers', 'Instagram Followers', 'trim');

        $data['option_row'] = $option_row = $this->common_model->option;

        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'option/add_social_media', $data);
        }else{
            $this->option_model->addSocialMediaData();

            $this->session->set_flashdata('message', "Updated Successfully!..");
            redirect('optionadmin/viewoptions/');
        }

    }

    function add_heading_texts(){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('hot_this_week_title', 'Hot this week title', 'trim');
        $this->form_validation->set_rules('past_stories_title', 'Past stories title', 'trim');
        $this->form_validation->set_rules('must_read_title', 'Must read title', 'trim');
        $this->form_validation->set_rules('recent_article_title', 'Recent article title', 'trim');
        $this->form_validation->set_rules('trending_now_title', 'Trending now title', 'trim');

        $data['option_row'] = $option_row = $this->common_model->option;

        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'option/add_heading_texts', $data);
        } else {
            $this->option_model->addSpecialTypesData();

            $this->session->set_flashdata('message', "Updated Successfully!..");
            redirect('optionadmin/viewoptions/');
        }
    } 

}
