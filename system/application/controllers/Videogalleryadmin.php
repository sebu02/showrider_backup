<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Videogalleryadmin extends CI_Controller {
	
	var $data = array();

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('video_model');
        $this->load->model('common_model');
        $this->load->model('route_model');
        $this->load->model('uploadlibrary_model');
        
        //$this->output->enable_profiler(TRUE);
        //session_start();

        if ($this->session->userdata('logged_adminpanel') != 'true') {
            redirect('admin/login');
        }       
    }

    public function index() {
        
    }      

   public function trash_video($id) {
        $this->common_model->TrashById('cms_video_gallery' , $id , 'id');
        $this->session->set_flashdata('message', "Deleted Successfully!..");
        redirect('videogalleryadmin/view_videos');
    }
      
    function add_video(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Title', 'required');
        
        if(isset($_FILES['video_file']['name'])){
            if($_FILES['video_file']['name'] != ""){
                $this->form_validation->set_rules('video_file', 'video upload', 'callback_handle_video_properties');  
            }                      
        }        
                
        $this->form_validation->set_rules('cat', 'Category', 'required');
        
        $data['values'] = array();
        $data['main_categories'] = $this->video_model->getAllMainCategories();
        
        if ($this->form_validation->run($this) == FALSE) {            
            $this->template->load('admin', 'video/add_video', $data);
        }else{

            if($_FILES['video_file']['name'] != ""){
                $up_status = $this->upload_videos(); 

                if($up_status){
                    $up_file_name = $this->upload->file_name;
                    $this->video_model->addVideo($up_file_name);
                    $this->session->set_flashdata('message', "Added Successfully!..");
                }else{
                    $this->session->set_flashdata('message', "Sorry, Invalid Request!..");
                }
            }else{
                    $up_file_name = "";
                    $this->video_model->addVideo($up_file_name);
                    $this->session->set_flashdata('message', "Added Successfully!..");
            }  
                                                                                           
            redirect('videogalleryadmin/add_video');
        }
    }
    
    function view_videos($cid = 0, $sport = 0, $sear = 0, $page_position = 0){
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'videogalleryadmin/view_videos/' . $cid . '/' . $sport . '/' . $sear;
        $config['total_rows'] = $this->video_model->countAllVideos();        
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
        $data['videos'] = $this->video_model->listVideos($config['per_page'], $page_position);
        
        $data['page_position'] = $page_position;
        
        $this->template->load('admin', 'video/view_videos', $data);
    }
    
    function edit_video($id){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Title', 'required');
        
        $this->form_validation->set_rules('cat', 'Category', 'required');

        if(isset($_FILES['video_file']['name'])){
            if($_FILES['video_file']['name'] != ""){
                $this->form_validation->set_rules('video_file', 'video upload', 'callback_handle_video_properties');  
            }                      
        }
        
        $data['video'] = $this->common_model->GetByRow_notrash('cms_video_gallery' , $id , 'id');
        $data['main_categories'] = $this->video_model->getAllMainCategories();
        
        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'video/edit_video', $data);
        } else {

            if($_FILES['video_file']['name'] != ""){
                $up_status = $this->upload_videos(); 

                if($up_status){
                    $up_file_name = $this->upload->file_name;
                    $this->video_model->editVideo($id , $up_file_name);
                    $this->session->set_flashdata('message', "Updated Successfully!..");
                }else{
                    $this->session->set_flashdata('message', "Sorry, Invalid Request!..");
                }
            }else{
                $up_file_name = "";
                $this->video_model->editVideo($id , $up_file_name);            
                $this->session->set_flashdata('message', "Updated Successfully!..");            
                redirect('videogalleryadmin/view_videos');
            }
            
        }
    }
    
    function add_category(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('catname', 'Categoryname', 'required');
        $this->form_validation->set_rules('order_number', 'Order number', 'required');
        $this->form_validation->set_rules('slug', 'Slug name', 'required|callback_handle_category_slug');
        
        $data['values'] = array();
        
        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'video/addcategory', $data);
        } else {
            $this->video_model->addCategory();            
            $this->session->set_flashdata('message', "Added Successfully!..");
            redirect('videogalleryadmin/add_category');
        }
    }
    
    function handle_category_slug() {
        $ret = $this->video_model->select_category_slug();
        if ($ret) {
            $this->form_validation->set_message('handle_category_slug', 'This Slug Is Already Exist!..');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    function view_category($page_position = 0){
        $_SESSION['seaval'] = '';
        $this->load->library('pagination');        
        $config['base_url'] = base_url() . 'videogalleryadmin/view_category';
        $config['total_rows'] = $this->video_model->countAllCats();
        $config['per_page'] = '10';
        $config['num_links'] = 10;
        $config['uri_segment'] = 3;        
        $this->pagination->initialize($config);        
        $data['pagination'] = $this->pagination->create_links();
        $data['categories'] = $this->video_model->listCats($config['per_page'], $page_position);
        $data['page_position'] = $page_position;        
        $this->template->load('admin', 'video/viewcategory', $data);
    }
    
    function edit_category($id){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('catname', 'Categoryname', 'required');
        $this->form_validation->set_rules('order_number', 'Order number', 'required');
        $this->form_validation->set_rules('slug', 'Slug name', 'required|callback_handle_category_slug1');        
        $data['cat'] = $this->video_model->GetByRow('cms_dynamic_category', $id, 'id');
        
        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'video/editcategory', $data);
        } else {
            $this->video_model->editCategory($id);            
            $this->session->set_flashdata('message', "Updated Successfully!..");
            redirect('videogalleryadmin/view_category');
        }
    }
    
    function handle_category_slug1() {
        $ret = $this->video_model->select_category_slug1();
        if ($ret) {
            $this->form_validation->set_message('handle_category_slug1', 'This Slug Is Already Exist!..');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    function trashCategory($id) {
        $this->common_model->TrashById('cms_dynamic_category', $id, 'id');
        $this->session->set_flashdata('message', "Deleted Successfully!..");
        redirect('videogalleryadmin/view_category/');
    }

    function handle_video_properties(){
        $current_size = 0;
        $file_size = 10 * 1048576;
        $file_types = array("mp4");
        $check_status = 1;
        $current_type = '';
        $valid_text = '';

        if($_FILES['video_file']['name'] == ""){
            $this->form_validation->set_message('handle_video_properties', "The video upload field is required");
		    return FALSE;
        }else{
            if (isset($_FILES['video_file']['name'])){		
                // dump($_FILES['video_file']);die();	
                $current_size = $_FILES['video_file']['size'];
                $currentname_array=explode('.',$_FILES['video_file']['name']);
                $current_type = $currentname_array[1];	
    
                // dump($current_type);die();	
                
            }

            if($current_size > $file_size){
                $check_status = 0;
                $valid_text="File size must less than 10MB.";
            }

            if(!in_array($current_type,$file_types))
            {
                $check_status = 0;
                $valid_text="Invalid file type.";
            }

            if ($check_status == 0) {
                $this->form_validation->set_message('handle_video_properties', $valid_text);
                return FALSE;
            } else {
                return TRUE;
            }
        }    
                

    }

    function upload_videos(){
        $config['upload_path']   = 'video_library';
        $config['allowed_types'] = 'mp4';
        $config['max_size']      = '10000';
        $config['encrypt_name'] = FALSE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('video_file')){
            return TRUE;
        }else{
           return FALSE;
        }
    }

}
