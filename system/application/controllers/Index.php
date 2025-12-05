<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
	
	 public function __construct(){
		parent::__construct();

		$this->load->helper('cookie');
		$this->load->helper('url');
		$this->load->helper('form');

		$this->load->library('email');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('encryption');
		$this->load->model('common_model');
		$this->load->model('index_model');

		// $this->load->helper('cookie');

		// error_reporting(0);

		date_default_timezone_set('Asia/Calcutta');

		$this->form_validation->set_error_delimiters('', '');

		header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: X-Requested-With');
        header('Content-Type: text/html');
		
	 }

     public function index() {
        $data['values'] = array();
        $data["page_id"] = $page_id = 1;
        $data["page_details"] = $page_details = $this->common_model->GetByRow('cms_pages', $page_id, 'id');

        $data["page_seo_title"] = $page_details->title;
        $data["page_seo_description"] = $page_details->description;
        $data["page_seo_keywords"] = $page_details->keywords;                
        $extra_code = json_decode($page_details->extra_code, TRUE);
        $data["page_seo_extracode"] = $extra_code[0];         
        $data['option_row'] = $option_row = $this->common_model->option;

        $this->template->load('master', 'index/home', $data);

    }

    public function home() {
        $data['values'] = array();
        $data["page_id"] = $page_id = 1;
        $data["page_details"] = $page_details = $this->common_model->GetByRow('cms_pages', $page_id, 'id');

        $data["page_seo_title"] = $page_details->title;
        $data["page_seo_description"] = $page_details->description;
        $data["page_seo_keywords"] = $page_details->keywords;

        $extra_code = json_decode($page_details->extra_code, TRUE);
        $data["page_seo_extracode"] = $extra_code[0];
        $data['option_row'] = $option_row = $this->common_model->option;
                     
        $this->template->load('master', 'index/home', $data);
    }

    public function services() {

        $data['values'] = array();
         $data["page_id"] = $page_id = 3;
        $data["page_details"] = $page_details = $this->common_model->GetByRow('cms_pages', $page_id, 'id');

        $data["page_seo_title"] = $page_details->title;
        $data["page_seo_description"] = $page_details->description;
        $data["page_seo_keywords"] = $page_details->keywords;

        $extra_code = json_decode($page_details->extra_code, TRUE);
        $data["page_seo_extracode"] = $extra_code[0];
        $data['option_row'] = $option_row = $this->common_model->option;    
           
        $this->template->load('master', 'index/services', $data);
    }

    public function about_us() {
        $data['values'] = array();
        $data["page_id"] = $page_id = 2;
        $data["page_details"] = $page_details = $this->common_model->GetByRow('cms_pages', $page_id, 'id');

        $data["page_seo_title"] = $page_details->title;
        $data["page_seo_description"] = $page_details->description;
        $data["page_seo_keywords"] = $page_details->keywords;

        $extra_code = json_decode($page_details->extra_code, TRUE);
        $data["page_seo_extracode"] = $extra_code[0];             
        $this->template->load('master', 'index/about_us', $data);
    } 

	function getTitleHeaderType()
    {

    }

	function page_404() {
        $page_type = '404page';
    }

	function page() 
    {
        //        $data['option'] = $option = $this->common_model->option;
                $last_segment_splited = $this->index_model->get_rsegment();
                $data['pagetype'] = $pagetype = $last_segment_splited[0];
                $data['pagetype_id'] = $pagetype_id = $last_segment_splited[1];
                $data['rsegment_last_string'] = $this->index_model->get_rsegment_last_string();

                switch ($pagetype) {
                    case 'm':
                        
                        break;
                    case 'p':
        
                        
                        break;
                    case 'contentcat':
                        
        
                        break;
                    case 'contentitem':
        
        
                        break;
                    case 'productcat':
                               
                        $data['category_row'] = $category_row = $this->index_model->GetByRow('ec_category', $pagetype_id, 'id');                        
                        $data["page_seo_title"] = $category_row->title;
                        $data["page_seo_description"] = $category_row->description;
                        $data["page_seo_keywords"] = $category_row->keywords;

                        $data["page_id"] = $page_id = 1;
                        $data["page_details"] = $page_details = $this->common_model->GetByRow('cms_pages', $page_id, 'id'); 
                        $extracode = json_decode($page_details->extra_code, TRUE);
                        $data["page_seo_extracode"] = $extracode[0];                        
                        
                        $check_id = '+'. $pagetype_id .'+';
                        
                        $this->db->like('categoryidtree', $check_id);
                        // $this->db->order_by('order_no', 'RANDOM');
                        $this->db->where('active_status', 'a');
                        $this->db->where('trash_status', 'no');
                        
                        $data['products_result'] = $products_result = $this->db->get('ec_products')->result();
                        
                        $this->template->load('master', 'index/services_detail', $data);        
        
                        break;
        
                    case 'productitem':
                
                        $data['product_row'] = $product_row = $this->index_model->GetByRow('ec_products', $pagetype_id, 'id');
                        $data['category_row'] = $category_row = $this->index_model->GetByRow('ec_category', $product_row->parent_main_id, 'id');                        
                        $data['media'] = $media = $this->index_model->GetByRow('cms_media', $product_row->parent_main_id, 'id');
                        $data["page_seo_title"] = $product_row->seo_title;
                        $data["page_seo_description"] = $product_row->seo_description;
                        $data["page_seo_keywords"] = $product_row->seo_keywords; 

                        $data["page_id"] = $page_id = 6;
                        $data["page_details"] = $page_details = $this->common_model->GetByRow('cms_pages', $page_id, 'id'); 
                        $extracode = json_decode($page_details->extra_code, TRUE);
                        $data["page_seo_extracode"] = $extracode[0];                       
                                              
                        $this->template->load('master', 'index/blog_detail', $data);        
        
                        break;
                    default:
                        break;
                }
                
    }

             function associations()            
            {   
                                
                $data['values'] = array();
                $data["page_id"] = $page_id = 4;
                $data["page_details"] = $page_details = $this->common_model->GetByRow('cms_pages', $page_id, 'id');

                $data["page_seo_title"] = $page_details->title;
                $data["page_seo_description"] = $page_details->description;
                $data["page_seo_keywords"] = $page_details->keywords;                
                $extra_code = json_decode($page_details->extra_code, TRUE);
                $data["page_seo_extracode"] = $extra_code[0];         
                $data['option_row'] = $option_row = $this->common_model->option;

                $this->template->load('master', 'index/associations', $data);

            }

            function book_a_show()            
            {  
               
                $data['values'] = array();
                $data["page_id"] = $page_id = 5;
                $data["page_details"] = $page_details = $this->common_model->GetByRow('cms_pages', $page_id, 'id');

                $data["page_seo_title"] = $page_details->title;
                $data["page_seo_description"] = $page_details->description;
                $data["page_seo_keywords"] = $page_details->keywords;   
                
                $extra_code = json_decode($page_details->extra_code, TRUE);
                $data["page_seo_extracode"] = $extra_code[0];         
                $data['option_row'] = $option_row = $this->common_model->option;

                $this->template->load('master', 'index/book_a_show', $data);

            } 

            function news_and_events()            
            {   
              
                $data['values'] = array();
                $data["page_id"] = $page_id = 6;
                $data["page_details"] = $page_details = $this->common_model->GetByRow('cms_pages', $page_id, 'id');

                $data["page_seo_title"] = $page_details->title;
                $data["page_seo_description"] = $page_details->description;
                $data["page_seo_keywords"] = $page_details->keywords;  

                $extra_code = json_decode($page_details->extra_code, TRUE);
                $data["page_seo_extracode"] = $extra_code[0];         
                $data['option_row'] = $option_row = $this->common_model->option;

                $this->template->load('master', 'index/news_and_events', $data);

            }

            function contact_us()            
            {   
               
                $data['values'] = array();
                $data["page_id"] = $page_id = 7;
                $data["page_details"] = $page_details = $this->common_model->GetByRow('cms_pages', $page_id, 'id');

                $data["page_seo_title"] = $page_details->title;
                $data["page_seo_description"] = $page_details->description;
                $data["page_seo_keywords"] = $page_details->keywords;  

                $extra_code = json_decode($page_details->extra_code, TRUE);
                $data["page_seo_extracode"] = $extra_code[0];         
                $data['option_row'] = $option_row = $this->common_model->option;

                $this->template->load('master', 'index/contact_us', $data);

            } 

            function testimonials()            
            {  
                                                                               
                $data['values'] = array();
                $data["page_id"] = $page_id = 8;
                $data["page_details"] = $page_details = $this->common_model->GetByRow('cms_pages', $page_id, 'id');

                $data["page_seo_title"] = $page_details->title;
                $data["page_seo_description"] = $page_details->description;
                $data["page_seo_keywords"] = $page_details->keywords;  

                $extra_code = json_decode($page_details->extra_code, TRUE);
                $data["page_seo_extracode"] = $extra_code[0];         
                $data['option_row'] = $option_row = $this->common_model->option;

                $this->template->load('master', 'index/testimonials', $data);

            } 

            function get_a_quote()            
            {   
               
                $data['values'] = array();
                $data["page_id"] = $page_id = 9;
                $data["page_details"] = $page_details = $this->common_model->GetByRow('cms_pages', $page_id, 'id');

                $data["page_seo_title"] = $page_details->title;
                $data["page_seo_description"] = $page_details->description;
                $data["page_seo_keywords"] = $page_details->keywords; 

                $extra_code = json_decode($page_details->extra_code, TRUE);
                $data["page_seo_extracode"] = $extra_code[0];         
                $data['option_row'] = $option_row = $this->common_model->option;

                $this->template->load('master', 'index/get_a_quote', $data);

            }
            
            function photo_gallery(){
                
                $data['values'] = array();
                $data["page_id"] = $page_id = 10;
                $data["page_details"] = $page_details = $this->common_model->GetByRow('cms_pages', $page_id, 'id');

                $data["page_seo_title"] = $page_details->title;
                $data["page_seo_description"] = $page_details->description;
                $data["page_seo_keywords"] = $page_details->keywords;

                $extra_code = json_decode($page_details->extra_code, TRUE);
                $data["page_seo_extracode"] = $extra_code[0];
                $data['option_row'] = $option_row = $this->common_model->option;
                            
                $this->template->load('master', 'index/photo_gallery', $data);

            }

            public function video_gallery(){

                $data['values'] = array();
                $data["page_id"] = $page_id = 11;
                $data["page_details"] = $page_details = $this->common_model->GetByRow('cms_pages', $page_id, 'id');

                $data["page_seo_title"] = $page_details->title;
                $data["page_seo_description"] = $page_details->description;
                $data["page_seo_keywords"] = $page_details->keywords;

                $extra_code = json_decode($page_details->extra_code, TRUE);
                $data["page_seo_extracode"] = $extra_code[0];
                $data['option_row'] = $option_row = $this->common_model->option;

                $this->template->load('master', 'index/video_gallery', $data);

            }

            public function news_and_events_detail(){
                $id = "";
                if(isset($_GET["id"])){
                    $id = $_GET["id"];
                }

                $data['values'] = array();
                $data["page_id"] = $page_id = 13;
                $data["page_details"] = $page_details = $this->common_model->GetByRow('cms_pages', $page_id, 'id');

                $data["page_seo_title"] = $page_details->title;
                $data["page_seo_description"] = $page_details->description;
                $data["page_seo_keywords"] = $page_details->keywords;

                $extra_code = json_decode($page_details->extra_code, TRUE);
                $data["page_seo_extracode"] = $extra_code[0];
                $data['option_row'] = $option_row = $this->common_model->option;

                $data['content_row'] = $content_row = $this->common_model->GetByRow('cms_media' , $id, 'id');

                $this->template->load('master', 'index/news_and_events_detail', $data);    
            }

            public function associations_detail(){

                $id = "";
                if(isset($_GET["id"])){
                    $id = $_GET["id"];
                }

                $data['values'] = array();
                $data["page_id"] = $page_id = 14;
                $data["page_details"] = $page_details = $this->common_model->GetByRow('cms_pages', $page_id, 'id');

                $data["page_seo_title"] = $page_details->title;
                $data["page_seo_description"] = $page_details->description;
                $data["page_seo_keywords"] = $page_details->keywords;

                $extra_code = json_decode($page_details->extra_code, TRUE);
                $data["page_seo_extracode"] = $extra_code[0];
                $data['option_row'] = $option_row = $this->common_model->option;

                $data['content_row'] = $content_row = $this->common_model->GetByRow('cms_media', $id, 'id');

                $this->template->load('master', 'index/associations_detail', $data);
            }

            function show_event(){
                
                $id = "";
                if(isset($_GET["id"])){
                    $id = $_GET["id"];
                }

                $data['values'] = array();
                $data["page_id"] = $page_id = 15;
                $data["page_details"] = $page_details = $this->common_model->GetByRow('cms_pages', $page_id, 'id');

                $data["page_seo_title"] = $page_details->title;
                $data["page_seo_description"] = $page_details->description;
                $data["page_seo_keywords"] = $page_details->keywords;

                $extra_code = json_decode($page_details->extra_code, TRUE);
                $data["page_seo_extracode"] = $extra_code[0];                               
                
                $data['event_row'] = $this->common_model->GetByRow('ec_services' , $id , 'id');               

                $this->template->load('master', 'index/show_event', $data);
                
            }

            function book_a_show_address(){

                $id = "";
                if(isset($_GET["id"])){
                    $id = $_GET["id"];
                }
                
                $data['values'] = array();
                $data["page_id"] = $page_id = 16;
                $data["page_details"] = $page_details = $this->common_model->GetByRow('cms_pages', $page_id, 'id');

                $data["page_seo_title"] = $page_details->title;
                $data["page_seo_description"] = $page_details->description;
                $data["page_seo_keywords"] = $page_details->keywords;

                $extra_code = json_decode($page_details->extra_code, TRUE);
                $data["page_seo_extracode"] = $extra_code[0];    

                $eventticketcode = $this->input->post("eventticketcode");
                $ticketnumber = $this->input->post("ticketnumber");
                $eventticketid = $this->input->post("eventticketid");
                $ticketprice = $this->input->post("ticketprice");
                
                $final_amount = $this->input->post("final_amount");

                $eventticketid_str = "+";
                $eventticketcode_str = "+";
                $ticketnumber_str = "+";
                $ticketprice_str = "+";

                foreach($eventticketid as $ticketid_key => $ticketid_val){
                    $eventticketid_str = $eventticketid_str . $ticketid_val . '+';
                    $eventticketcode_str = $eventticketcode_str . $eventticketcode[$ticketid_key] . '+';

                    if($ticketnumber[$ticketid_key] == ""){
                        $ticketnumber_str = $ticketnumber_str . '0+';
                    }else{
                        $ticketnumber_str = $ticketnumber_str . $ticketnumber[$ticketid_key] . '+';
                    }                    

                    $ticketprice_str = $ticketprice_str . $ticketprice[$ticketid_key] . '+';
                }
                

                $data["ticketprice_str"] = $ticketprice_str;
                $data["eventticketcode_str"] = $eventticketcode_str;
                
                $data["ticketnumber_str"] = $ticketnumber_str;
                $data["final_amount"] = $final_amount;
                                                                                                      
                $data['event_row'] = $this->common_model->GetByRow('ec_services' , $id , 'id');   
                
                $this->template->load('master', 'index/book_a_show_address', $data);
            }

            function get_a_quote_detail(){

                $id = "";
                if(isset($_GET["id"])){
                    $id = $_GET["id"];
                }

                $data['values'] = array();
                $data["page_id"] = $page_id = 17;
                $data["page_details"] = $page_details = $this->common_model->GetByRow('cms_pages', $page_id, 'id');

                $data["page_seo_title"] = $page_details->title;
                $data["page_seo_description"] = $page_details->description;
                $data["page_seo_keywords"] = $page_details->keywords;

                $extra_code = json_decode($page_details->extra_code, TRUE);
                $data["page_seo_extracode"] = $extra_code[0]; 

                $data['category_row'] = $this->common_model->GetByRow('ec_category' , $id , 'id'); 

                $this->template->load('master', 'index/get_a_quote_detail', $data);
            }

            function get_a_quote_form(){

                $id = "";
                if(isset($_GET["id"])){
                    $id = $_GET["id"];
                }

                $data['values'] = array();
                $data["page_id"] = $page_id = 18;
                $data["page_details"] = $page_details = $this->common_model->GetByRow('cms_pages', $page_id, 'id');

                $data["page_seo_title"] = $page_details->title;
                $data["page_seo_description"] = $page_details->description;
                $data["page_seo_keywords"] = $page_details->keywords;

                $extra_code = json_decode($page_details->extra_code, TRUE);
                $data["page_seo_extracode"] = $extra_code[0]; 

                $data['category_row'] = $this->common_model->GetByRow('ec_category' , $id , 'id'); 

                $packages_arr = $this->input->post("package_val");

                $final_amount = 0;

                if($packages_arr != NULL){                
                    foreach($packages_arr as $packages_val){
                        $final_amount = $final_amount + trim($packages_val);
                    }
                }               

                $data["final_amount"] = $final_amount;

                $this->template->load('master', 'index/get_a_quote_form', $data);
            }

}