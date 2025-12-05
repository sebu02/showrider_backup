<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contentadmin extends CI_Controller {
	
	var $data = array();

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('common_model');
        $this->load->model('content_model');
        $this->load->model('uploadlibrary_model');
        $this->load->model('route_model');
       
        //$this->output->enable_profiler(TRUE);
        //session_start();

        if ($this->session->userdata('logged_adminpanel') != 'true') {
            redirect('admin/login');
        }       
    }

    public function index() {
        
    }
   
    function addcategory() {
        $_SESSION['seaval'] = '';
        //$this->load->library('fckeditor'); 
        $data['catname'] = array('name' => 'catname', 'id' => 'catname', 'value' => set_value('catname'), 'class' => 'inputfieldStyle');

        $data['submit'] = array('name' => 'submit', 'value' => 'Add', 'class' => 'btn_apply');
        $data['reset'] = array('name' => 'reset', 'value' => 'Reset', 'class' => 'btn_apply');

        $fixed_type = "cms_type";
        $table = "ec_categorytypes";
        $other_condtion_array = [];
        
        $data['all_pages_list'] = $this->content_model->listAllPages();
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('catname', 'Categoryname', 'required');
        $this->form_validation->set_rules('order_number', 'Order number', 'required');
        $this->form_validation->set_rules('slug', 'Slug name', 'required|callback_handle_category_slug');
//        $this->form_validation->set_rules('final_images', 'final_images', 'trim');

        if ($this->form_validation->run($this) == FALSE) {
            $data['values'] = $this->uploadlibrary_model->Get_fileData();
            $this->template->load('admin', 'content/addcategory', $data);
        } else {
            $id = $this->content_model->add_category();            
            
            $this->session->set_flashdata('message', "Added Successfully!..");
            $per_page = '';         
            redirect('contentadmin/addcategory');			 
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

    function handle_category_slug() {
        $route_type = 'content_category';

        if ($this->input->post('url_type') == 'seo_url') {

            if ($this->input->post('parentname') != 0) {

                $full_slug = $this->input->post('full_url_sec') . '/' . $this->input->post('slug');
            } else {

                $full_slug = $this->input->post('slug');
            }


            $ret = $this->content_model->select_category_slug();
            $ret_route = $this->route_model->route_check($full_slug, $route_type);
        } elseif ($this->input->post('url_type') == 'force_url') {

            $full_slug = $this->input->post('slug');
            $ret = $this->content_model->select_category_slug();
            $ret_route = $this->route_model->route_check($full_slug, $route_type);
        } elseif ($this->input->post('url_type') == 'auto_url') {
            $ret = FALSE;
            $ret_route = FALSE;
        }


        if ($ret == TRUE || $ret_route == TRUE) {
            $this->form_validation->set_message('handle_category_slug', 'This URL Already Exists.');

            return FALSE;
        } else {

            return TRUE;
        }
    }

    function handle_category_slug1() {


        $route_type = 'content_category';

        if ($this->input->post('url_type') == 'seo_url') {

            if ($this->input->post('parentname') != 0) {

                $full_slug = $this->input->post('full_url_sec') . '/' . $this->input->post('slug');
            } else {

                $full_slug = $this->input->post('slug');
            }


            $ret = $this->content_model->select_category_slug1();
            $ret_route = $this->route_model->route_check($full_slug, $route_type);
        } elseif ($this->input->post('url_type') == 'force_url') {

            $full_slug = $this->input->post('slug');
            $ret = $this->content_model->select_category_slug1();
            $ret_route = $this->route_model->route_check($full_slug, $route_type);
        } elseif ($this->input->post('url_type') == 'auto_url') {
            $ret = FALSE;
            $ret_route = FALSE;
        }


        if ($ret == TRUE || $ret_route == TRUE) {

            $this->form_validation->set_message('handle_category_slug1', 'This URL Already Exists.');

            return FALSE;
        } else {

            return TRUE;
        }
    }

    function viewcategory($page_position = 0) {
        $sear = $this->uri->segment(5);
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



//         dump($offset);die();
        $_SESSION['seaval'] = '';
        $this->load->library('pagination');
        $data['cms_type_array'] = $this->content_model->cms_arr;
        $config['base_url'] = base_url() . 'contentadmin/viewcategory?' . $urisegments;
        $config['total_rows'] = $this->content_model->count_all_cate();
        $config['enable_query_strings'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['per_page'] = '10';
        $config['num_links'] = 10;
        $config['uri_segment'] = 3;

        $config['prev_link'] = ' Previous';
        $config['prev_tag_open'] = '';
        $config['prev_tag_close'] = '';
        $config['next_link'] = ' Next';
        $config['next_tag_open'] = '';
        $config['next_tag_close'] = '';

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['categories'] = $this->content_model->listcate($config['per_page'], $offset);
        //        dump($config['total_rows']);die();
        $data['page_position'] = $offset;
        $this->template->load('admin', 'content/viewcategory_new', $data);
    }

    function edit() {

        $id = '';
        if (isset($_GET['id'])) {

            $id = $_GET['id'];
        }
        
        $loged_type = '';
       
        $_SESSION['seaval'] = '';
        $this->file_name = '';

        $data['cat'] = $this->content_model->GetByRow_notrash('cms_dynamic_category', $id, 'id');
        $data['catname'] = array('name' => 'catname', 'id' => 'catname', 'value' => $data['cat']->category, 'class' => 'inputfieldStyle');

        $fixed_type = "cms_type";
        $table = "ec_categorytypes";
        $other_condtion_array = [];
        
        $data['all_pages_list'] = $this->content_model->listAllPages();

        $data['submit'] = array('name' => 'submit', 'value' => 'Update', 'class' => 'btn_apply');
        $data['reset'] = array('name' => 'reset', 'value' => 'Reset', 'class' => 'btn_apply');
        
//        $data['pages_list'] = $this->content_model->listAllPages();
        
        $data['values'] = $this->uploadlibrary_model->Get_fileData();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('catname', 'Categoryname', 'required');
        $this->form_validation->set_rules('order_number', 'Order number', 'required');
        $this->form_validation->set_rules('slug', 'Slug name', 'required|callback_handle_category_slug1');
//        $this->form_validation->set_rules('final_images', 'final_images', 'trim');


        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'content/editcategory', $data);
        } else {

            $this->content_model->edit_category($id);
            
            $this->session->set_flashdata('message', "Updated Successfully!..");

            $per_page = '';
            if (isset($_GET['per_page'])) {
                $per_page = '&per_page=' . $_GET['per_page'];
            }
		
		redirect('contentadmin/viewcategory');	 
			
        }
    }

    function edit_category2() {

        $id = '';
        if (isset($_GET['id'])) {

            $id = $_GET['id'];
        }

        $this->data['single_detail'] = $this->content_model->GetByRow_notrash('cms_dynamic_category', $id, 'id');
        $this->data['values'] = $this->uploadlibrary_model->Get_fileData();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('final_images', 'Category Picture', 'trim'); //Don't Delete this line to preserve set values
//        $this->form_validation->set_rules('final_images_b', 'Banner Picture', 'trim'); //Don't Delete this line to preserve set values

        if ($this->form_validation->run($this) == FALSE) {

            $this->template->load('admin', 'content/edit_category2', $this->data);
        } else {

            $this->content_model->edit_category2($id);
            $this->session->set_flashdata('message', "Edited Successfully!..");

            $per_page = '';
            if (isset($_GET['per_page'])) {
                $per_page = '&per_page=' . $_GET['per_page'];
            }
            redirect('contentadmin/viewcategory?' . $per_page);
        }
    }

    /*
     * 08-06-2017
     * Author :sinto
     * Use: trashCategory
     */

    function trashCategory() {

        $id = '';
        if (isset($_GET['id'])) {

            $id = $_GET['id'];
        }

        $this->content_model->TrashById('cms_dynamic_category', $id, 'id');
        $route_type = 'content_category';
        $action_type = 'trash';
        $quick_link_type = 'content_category';
//        $this->common_model->quick_link_delete($id, $quick_link_type, $action_type);
        $this->route_model->routeTrashById('cms_routes', $id, 'slug_ref_id', $route_type);
        $this->route_model->save_routes($route_type);
        $this->session->set_flashdata('message', "Deleted Successfully!..");
//        redirect('contentadmin/viewcategory/');
        $per_page = '';
        if (isset($_GET['per_page'])) {
            $per_page = '&per_page=' . $_GET['per_page'];
        }
        redirect('contentadmin/viewcategory?' . $per_page);
    }

    /*
     * EOF trashCategory
     */
   
    function trash_viewcategory($page_position = 0) {
        $_SESSION['seaval'] = '';
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'contentadmin/trash_viewcategory';
        $config['total_rows'] = $this->content_model->trash_count_all_cate();
        $config['per_page'] = '10';
        $config['num_links'] = 10;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['categories'] = $this->content_model->trash_listcate($config['per_page'], $page_position);
        $data['page_position'] = $page_position;
        $this->template->load('admin', 'content/trash_viewcategory', $data);
    }

    /*
     * EOF trash view Category
     */
  
    function restoreCategory($id) {
        $this->content_model->RestoreById('cms_dynamic_category', $id, 'id');
        $route_type = 'content_category';
        $action_type = 'restore';
        $quick_link_type = 'content_category';
        $this->common_model->quick_link_delete($id, $quick_link_type, $action_type);
        $this->route_model->routeRestoreById('cms_routes', $id, 'slug_ref_id', $route_type);
        $this->route_model->save_routes($route_type);
        $this->session->set_flashdata('message', "Restored Successfully!..");
        redirect('contentadmin/trash_viewcategory/');
    }

    /*
     * EOF restoreCategory
     */

    function deleteCategory($id) {
        $delete_status = $this->common_model->DeleteById('cms_dynamic_category', $id, 'id');
        if ($delete_status == TRUE) {
            $route_type = 'content_category';
            $action_type = 'delete';
            $quick_link_type = 'content_category';
            $this->common_model->quick_link_delete($id, $quick_link_type, $action_type);
            $this->route_model->routeDeleteById('cms_routes', $id, 'slug_ref_id', $route_type);
            $this->route_model->save_routes($route_type);
            $this->session->set_flashdata('message', "Deleted Successfully!..");
        } else {
            $this->session->set_flashdata('message', "This data can not be deleted.");
        }

        redirect('contentadmin/trash_viewcategory/');
    }

    /*
     * EOF deleteCategory permanently
     */

    function addsubcategory() {
        $_SESSION['seaval'] = '';
        //$this->load->library('fckeditor'); 
        $data['catname'] = array('name' => 'catname', 'id' => 'catname', 'value' => set_value('catname'), 'class' => 'inputfieldStyle');

        $data['submit'] = array('name' => 'submit', 'value' => 'Add', 'class' => 'btn_apply');
        $data['reset'] = array('name' => 'reset', 'value' => 'Reset', 'class' => 'btn_apply');

        $data['categorylist'] = $this->content_model->showcats();

        $this->load->library('form_validation');
        $this->form_validation->set_rules('parentname', 'Parent Category', 'required');

        $this->form_validation->set_rules('catname', 'Categoryname', 'required');

        $this->form_validation->set_rules('order_number', 'Order number', 'required');
        $this->form_validation->set_rules('slug', 'Slug name', 'required|callback_handle_category_slug');
        $this->form_validation->set_rules('final_images', 'final_images', 'trim');

        if ($this->form_validation->run($this) == FALSE) {

            //$this->template->write_view('content','addsubcategory',$data,TRUE);
            //$this->template->render();
            $data['values'] = $this->uploadlibrary_model->Get_fileData();
            $this->template->load('admin', 'content/addsubcategory', $data);
        } else {

            $this->content_model->add_subcategory();
            $this->session->set_flashdata('message', "Added Successfully!..");
            redirect('contentadmin/addsubcategory');
        }
    }

    function subcategory($page_position = 0) {
        $_SESSION['seaval'] = '';

        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'contentadmin/subcategory';

        $config['total_rows'] = $this->content_model->count_all_subcate();
        $config['per_page'] = 10;
        $config['num_links'] = 3;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['categories'] = $this->content_model->GetAllCategorySub($config['per_page'], $page_position);
        $data['page_position'] = $page_position;
        $this->template->load('admin', 'content/viewsubcategory', $data);
    }

    function editSub($id) {
        $_SESSION['seaval'] = '';
        $data['cat'] = $this->content_model->GetByRow('cms_dynamic_category', $id, 'id');
        $data['categorylist'] = $this->content_model->showcats();
        $data['catname'] = array('name' => 'catname', 'id' => 'catname', 'value' => $data['cat']->category, 'class' => 'inputfieldStyle');
        $data['submit'] = array('name' => 'submit', 'value' => 'Update', 'class' => 'btn_apply');
        $data['reset'] = array('name' => 'reset', 'value' => 'Reset', 'class' => 'btn_apply');

        $this->load->library('form_validation');
        $this->form_validation->set_rules('parentname', 'Parent Category', 'required');
        $this->form_validation->set_rules('catname', 'Categoryname', 'required');
        $this->form_validation->set_rules('order_number', 'Order number', 'required');
        $this->form_validation->set_rules('slug', 'Slug name', 'required|callback_handle_category_slug1');
        $this->form_validation->set_rules('final_images', 'final_images', 'trim');


        if ($this->form_validation->run($this) == FALSE) {
            //$this->template->write_view('content','editsubcategory', $data,TRUE);
            //$this->template->render();
            $data['values'] = $this->uploadlibrary_model->Get_fileData();
            $this->template->load('admin', 'content/editsubcategory', $data);
        } else {

            $this->content_model->edit_subcategory($id);
            $this->session->set_flashdata('message', "Updated Successfully!..");

            redirect('contentadmin/subcategory/');
        }
    }
    
    function trashSubcategory($id) {

        $this->content_model->TrashById('cms_dynamic_category', $id, 'id');
        $this->session->set_flashdata('message', "Deleted Successfully!..");
        redirect('contentadmin/subcategory/');
    }

    /*
     * EOF trashCategory
     */

    function trash_viewSubcategory($page_position = 0) {
        $_SESSION['seaval'] = '';

        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'contentadmin/trash_viewSubcategory';

        $config['total_rows'] = $this->content_model->trash_count_all_subcate();
        $config['per_page'] = 10;
        $config['num_links'] = 3;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['categories'] = $this->content_model->trash_GetAllCategorySub($config['per_page'], $page_position);
        $data['page_position'] = $page_position;
        $this->template->load('admin', 'content/trash_viewSubcategory', $data);
    }

    /*
     * EOF trash view Category
     */

    function restoreSubcategory($id) {
        $this->content_model->RestoreById('cms_dynamic_category', $id, 'id');
        $this->session->set_flashdata('message', "Restored Successfully!..");
        redirect('contentadmin/trash_viewcategory/');
    }

    /*
     * EOF restoreCategory
     */

    function deleteSubcategory($id) {
        $delete_status = $this->common_model->DeleteById('cms_dynamic_category', $id, 'id');
        if ($delete_status == TRUE) {
            $this->session->set_flashdata('message', "Deleted Successfully!..");
        } else {
            $this->session->set_flashdata('message', "This data can not be deleted.");
        }

        redirect('contentadmin/trash_viewcategory/');
    }

    /*
     * EOF deleteCategory permanently
     */
            
    function handle_content_slug() {

        $route_type = 'content_item';

        if ($this->input->post('url_type') == 'seo_url') {

            $full_slug = $this->input->post('full_url_sec') . '/' . $this->input->post('route');
            $ret = $this->content_model->select_content_slug();
            $ret_route = $this->route_model->route_check($full_slug, $route_type);
        } elseif ($this->input->post('url_type') == 'force_url') {

            $full_slug = $this->input->post('route');
            $ret = $this->content_model->select_content_slug();
            $ret_route = $this->route_model->route_check($full_slug, $route_type);
        } elseif ($this->input->post('url_type') == 'auto_url') {
            $ret = FALSE;
            $ret_route = FALSE;
        }


$msg_text = "This URL Already Exist. We Prefer Auto URL.";		
 if (isset($_GET['feature_id'])) {
	$msg_text = "Unique identifier is already exist.";	 
 }
 


        if ($ret == TRUE || $ret_route == TRUE) {
            $this->form_validation->set_message('handle_content_slug', $msg_text);

            return FALSE;
        } else {

            return TRUE;
        }
    }

    function handle_content_slug1() {


        $route_type = 'content_item';

        if ($this->input->post('url_type') == 'seo_url') {

            $full_slug = $this->input->post('full_url_sec') . '/' . $this->input->post('route');
            $ret = $this->content_model->select_content_slug1();
            $ret_route = $this->route_model->route_check($full_slug, $route_type);
        } elseif ($this->input->post('url_type') == 'force_url') {

            $full_slug = $this->input->post('route');
            $ret = $this->content_model->select_content_slug1();
            $ret_route = $this->route_model->route_check($full_slug, $route_type);
        } elseif ($this->input->post('url_type') == 'auto_url') {
            $ret = FALSE;
            $ret_route = FALSE;
        }

        if ($ret == TRUE || $ret_route == TRUE) {

            $this->form_validation->set_message('handle_content_slug1', 'This URL Already Exist. We Prefer Auto URL.');

            return FALSE;
        } else {

            return TRUE;
        }
    }

    function viewcontent() {

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
        $config['base_url'] = base_url() . 'contentadmin/viewcontent?' . $urisegments;
        $config['total_rows'] = $this->content_model->count_all_content();
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
        $data['images'] = $this->content_model->listcontent($config['per_page'], $offset);
        $data['page_position'] = $offset;
        
        $data['list_categories'] = $this->content_model->showcats();
        $data['all_pages_list'] = $this->content_model->listAllPages();

        $this->template->load('admin', 'content/view_contents', $data);
    }

    /*
     * Bulk delete functions 
     */

    function set_and_unset_session() {

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

        $session_val = $this->input->post('session_val');

        if ($session_val == 'checkall') {
            $_SESSION['content_check_status'] = $session_val;
            echo $checked_ids = $this->content_model->get_full_content();
        } else if ($session_val == 'uncheckall') {
            $_SESSION['content_check_status'] = '';
            echo $checked_ids = '*****';
        } else if ($session_val == 'custom') {
            $_SESSION['content_check_status'] = $session_val;
            $check_type = $this->input->post('check_type');
            $check_id = $this->input->post('check_id');
            $all_ids = $this->input->post('all_ids');
            echo $checked_ids = $this->content_model->custom_check_id($check_type, $check_id, $all_ids);
        }

        $get_split = explode('*****', $checked_ids);


        $_SESSION['content_checked_ids'] = $get_split[0];
        $_SESSION['content_checked_count'] = $get_split[1];
    }

    function delete_opertion() {
        $delete_opr = $this->input->post('delete_opr');
        $all_cont_ids = json_decode($this->input->post('all_cont_ids'), true);
        $seg3 = $this->input->post('seg3');
        $seg4 = $this->input->post('seg4');
        $seg5 = $this->input->post('seg5');
        $seg6 = $this->input->post('seg6');
        switch ($delete_opr) {
            case 'delete':

                foreach ($all_cont_ids as $cont_id) {
                    $this->content_model->trash_content($cont_id);
                }

                $this->session->set_flashdata('message', "Deleted Successfully!..");

                break;

            case 'deactivate':

                foreach ($all_cont_ids as $cont_id) {
                    $this->content_model->content_deactivate_activate($cont_id, $delete_opr);
                }
                $this->session->set_flashdata('message', "Deactivated Successfully!..");
                break;

            case 'activate':
                foreach ($all_cont_ids as $cont_id) {
                    $this->content_model->content_deactivate_activate($cont_id, $delete_opr);
                }
                $this->session->set_flashdata('message', "Activated Successfully!..");
                break;
        }

        $_SESSION['content_checked_ids'] = '';
        $_SESSION['content_checked_count'] = '';
        $_SESSION['content_check_status'] = '';
    }

    /*
     * EOF Bulk delete functions
     */

    function view_content_gallery() {
        $id = $this->uri->segment(3);
        $data['values'] = $this->content_model->list_news_gallery($id);
        $this->template->load('admin', 'content/view_content_gallery', $data);
    }

    function view_content_video_gallery() {
        $id = $this->uri->segment(3);
        $data['values'] = $this->content_model->list_news_gallery($id);
        $this->template->load('admin', 'content/view_video_gallery', $data);
    }

    function edit_content_image($id, $order) {

        $data['values1'] = $this->content_model->GetByRow('cms_media', $id, 'id');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('product_name', 'Picture Name', 'required');
        $this->form_validation->set_rules('final_images', 'final_images', 'trim');

        if ($this->form_validation->run($this) == FALSE) {

            $data['values'] = $this->uploadlibrary_model->Get_fileData();
            $this->template->load('admin', 'content/edit_content_image', $data);
        } else {

            $this->content_model->up_news_images($id, $order);
            
            $this->session->set_flashdata('message', "Updated Successfully!..");
            
            redirect('contentadmin/view_content_gallery/' . $id);
        }
    }

    function delete_content_image($id, $order) {
        $this->content_model->del_media_img($id, $order);

        $this->session->set_flashdata('message', "Deleted Successfully!..");
        redirect('contentadmin/view_content_gallery/' . $id);
    }  
   
    function trashContent($id) {
        $this->content_model->TrashById('cms_media', $id, 'id');
        $route_type = 'content_item';
        $quick_link_type = 'content';
        $action_type = 'trash';
        $this->route_model->routeTrashById('cms_routes', $id, 'slug_ref_id', $route_type);
        $this->route_model->save_routes($route_type);
//        $this->common_model->quick_link_delete($id, $quick_link_type, $action_type);
        $this->session->set_flashdata('message', "Deleted Successfully!..");
        redirect('contentadmin/viewcontent/');
    }

    /*
     * EOF trashContent
     */

    function trash_viewContent($cid = 0, $sport = 0, $sear = 0, $page_position = 0) {
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'contentadmin/trash_viewContent/' . $cid . '/' . $sport . '/' . $sear;
        $config['total_rows'] = $this->content_model->trash_count_all_content();
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
        $data['images'] = $this->content_model->trash_listcontent($config['per_page'], $page_position);
        $data['page_position'] = $page_position;

        $data['list_categories'] = $this->content_model->showcats();
        $this->template->load('admin', 'content/trash_viewContent', $data);
    }

    /*
     * EOF trash view Content
     */

    function restoreContent($id) {
        $this->content_model->RestoreById('cms_media', $id, 'id');
        $route_type = 'content_item';
        $action_type = 'restore';
        $quick_link_type = 'content';
        $this->common_model->quick_link_delete($id, $quick_link_type, $action_type);
        $this->route_model->routeRestoreById('cms_routes', $id, 'slug_ref_id', $route_type);
        $this->route_model->save_routes($route_type);
        $this->session->set_flashdata('message', "Restored Successfully!..");
        redirect('contentadmin/trash_viewContent/');
    }

    /*
     * EOF restoreContent
     */

    function deleteContent($id) {
        $delete_status = $this->common_model->DeleteById('cms_media', $id, 'id');
        if ($delete_status == TRUE) {
            $route_type = 'content_item';
            $action_type = 'delete';
            $quick_link_type = 'content';
            $this->common_model->quick_link_delete($id, $quick_link_type, $action_type);
            $this->route_model->routeDeleteById('cms_routes', $id, 'slug_ref_id', $route_type);
            $this->route_model->save_routes($route_type);
            $this->session->set_flashdata('message', "Deleted Successfully!..");
        } else {
            $this->session->set_flashdata('message', "This data can not be deleted.");
        }

        redirect('contentadmin/trash_viewContent/');
    }

    /*
     * EOF deleteContent permanently
     */

    function up_m() {
        $results = $this->db->get('cms_media')->result();

        foreach ($results as $row) {
            if ($row->prod_cat != '') {

                $parent_details = $this->content_model->get_first_parent($row->prod_cat);
                $parent_splited = explode('**', $parent_details);

                $images = $row->images;

                $data = array(
                    'main_parent_id' => $parent_splited[0],
                    'main_parent_slug' => $parent_splited[2],
                );

                $this->db->where('id', $row->id);
                $this->db->update('cms_media', $data);
            }
        }
    }

    function editvideo($id, $order) {
        $data['videos'] = $this->content_model->GetByRow('cms_media', $id, 'id');
        $data['values'] = $this->uploadlibrary_model->Get_fileData();

        $this->load->library('form_validation');
//        $this->form_validation->set_rules('order_number', 'Order', 'required');
        $this->form_validation->set_rules('source', 'Source', 'required');


        if ($this->form_validation->run($this) == FALSE) {

            $this->template->load('admin', 'content/edit_video', $data);
        } else {

            $this->content_model->edit_video($id, $order);
            $this->session->set_flashdata('message', "Updated Successfully!..");

            redirect('contentadmin/view_content_video_gallery/' . $this->uri->segment(3) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6));
        }
    }

    function delete_content_video($id, $order) {
        $this->content_model->del_media_video($id, $order);
        $this->session->set_flashdata('message', "Deleted Successfully!..");
        redirect('contentadmin/view_content_video_gallery/' . $id);
    }
       
    function viewAllContentGallery(){
        $id = $this->uri->segment(3);
        $data['content_details'] = $this->content_model->GetByRow('cms_media',$id,'id');
        $this->template->load('admin','content/view_all_content_gallery',$data);
    }
    
    function view_content_gallery2() {
        $id = $this->uri->segment(3);
        $data['values'] = $this->content_model->list_news_gallery($id);
        $this->template->load('admin', 'content/view_content_gallery2', $data);
    }

    function edit_content_image2($id, $order) {
        $data['values1'] = $this->content_model->GetByRow('cms_media', $id, 'id');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('product_name', 'Picture Name', 'required');
        $this->form_validation->set_rules('final_images', 'final_images', 'trim');

        if ($this->form_validation->run($this) == FALSE) {
            $data['values'] = $this->uploadlibrary_model->Get_fileData();
            $this->template->load('admin', 'content/edit_content_image2', $data);
        } else {
            $this->content_model->up_news_images2($id, $order);
            redirect('contentadmin/view_content_gallery2/' . $id);
        }
    }

    function delete_content_image2($id, $order) {
        $this->content_model->del_media_img2($id, $order);
        $this->session->set_flashdata('message', "Deleted Successfully!..");
        redirect('contentadmin/view_content_gallery2/' . $id);
    }

    function get_dual_list_val(){
        $this->content_model->getDualListVal();            
    }

    function add_content(){
        $data['cms_detail_view'] = array();

        $_SESSION['seaval'] = '';
        //$this->load->library('fckeditor'); 

        $data['categorylist'] = $this->content_model->showcats_sorted();

        $this->load->library('form_validation');
        $this->form_validation->set_rules('catname', 'Content Name', 'required');
        $this->form_validation->set_rules('order_number', 'Order number', 'required');

        $this->form_validation->set_rules('cat', 'Content Category', 'required');

        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'content/add_content_new', $data);
        }else{
            $id = $this->content_model->addContent();
            
            $this->session->set_flashdata('message', "Added Successfully!..");
            
            redirect('contentadmin/edit_content_2/' . $id .'/');
        }
        
    }
    
    function edit_content_2($id){
        $data["current_id"] = $id;
        $data['images'] = $this->content_model->GetByRow_notrash('cms_media', $id, 'id');
        $data['values'] = $this->uploadlibrary_model->Get_fileData();
        
        $this->load->library('form_validation');        
        $this->form_validation->set_rules('brief_description', 'Description', 'trim');
        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'content/edit_content_2_new', $data);
        }else{
            $this->content_model->editContent2($id);
            
            $this->session->set_flashdata('message', "Updated Successfully!..");            
            redirect('contentadmin/viewcontent/?' .$_SERVER['QUERY_STRING']);
        }        
    }
    
    function edit_content($id){
        $data["current_id"] = $id;
        $data['images'] = $this->content_model->GetByRow_notrash('cms_media', $id, 'id');
        $data['categorylist'] = $this->content_model->showcats_sorted();
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('catname', 'Content Name', 'required');
        $this->form_validation->set_rules('order_number', 'Order number', 'required');
        $this->form_validation->set_rules('cat', 'Content Category', 'required');
        $data['values'] = array();
        
        if ($this->form_validation->run($this) == FALSE) {            
            $this->template->load('admin', 'content/edit_content_new', $data);
        }else{
            $this->content_model->editContent($id);            
            $this->session->set_flashdata('message', "Updated Successfully!..");
            
            redirect('contentadmin/edit_content_2/' . $id . '/?' . $_SERVER['QUERY_STRING']);
        }        
    }

    function viewcomments() {
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
        $config['base_url'] = base_url() . 'contentadmin/viewcomments?' . $urisegments;
        $config['total_rows'] = $this->content_model->count_all_comments();
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
        $data['comments'] = $this->content_model->listcomments($config['per_page'], $offset);
        $data['page_position'] = $offset;
        $this->template->load('admin', 'content/view_comments', $data);
    }

    function delete_comments($commentid) {
        $this->content_model->del_comments($commentid);
        $this->session->set_flashdata('message', "Deleted Successfully!..");
        redirect('contentadmin/viewcomments' . $id);
    }

    function get_categorylist_by_page(){
        $page_id = $this->input->post('page_id');
        $data['cat_list'] = $this->content_model->getCategoryListByPage($page_id);
        $cat_list_view = $this->load->view("content/sorted_cat_list_view", $data , TRUE);
        echo $cat_list_view;
    }
       
}
