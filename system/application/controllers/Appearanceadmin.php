<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appearanceadmin
        extends CI_Controller {

    var $data = array();

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('common_model');
        $this->load->model('menu_model');        
        $this->load->model('uploadlibrary_model');
        $this->load->model('route_model');

//        $this->output->enable_profiler(TRUE);
        // session_start();

        if ($this->session->userdata('logged_adminpanel') != 'true') {
            redirect('admin/login');
        }
    }

    public function index() {
        
    }
    
    function handleslug() {
        $route_type = 'menu';

        if ($this->input->post('url_type') == 'seo_url') {

            if ($this->input->post('parentid') != 0) {

                $full_slug = $this->input->post('full_url_sec') . '/' . $this->input->post('mslug');
            } else {

                $full_slug = $this->input->post('mslug');
            }


            $ret = $this->menu_model->select_handleslug();
            $ret_route = $this->route_model->route_check($full_slug, $route_type);
        } elseif ($this->input->post('url_type') == 'force_url') {

            $full_slug = $this->input->post('mslug');
            $ret = $this->menu_model->select_handleslug();
            $ret_route = $this->route_model->route_check($full_slug, $route_type);
        } elseif ($this->input->post('url_type') == 'auto_url') {
            $ret = FALSE;
            $ret_route = FALSE;
        }


        if ($ret == TRUE || $ret_route == TRUE) {
            $this->form_validation->set_message('handleslug', 'This URL Already Exist. We Prefer Auto URL.');

            return FALSE;
        } else {

            return TRUE;
        }
    }    
    
    function show_column() {
        $table = $this->input->post('tablename');
        $this->menu_model->GetAllColumn($table);
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
  
    function viewmenu($sport = 0, $sear = 0, $page_position = 0) {
//        $data['categorylist'] = $this->menu_model->get_all_menus();

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
//        $config['base_url'] = base_url() . 'appearanceadmin/viewmenu/' . $sport . '/' . $sear;
        $config['base_url'] = base_url() . 'appearanceadmin/viewmenu?' . $urisegments;

        $config['total_rows'] = $this->menu_model->count_all_menu();

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
        $data['categories'] = $this->menu_model->list_menus($config['per_page'], $offset);
        $data['page_position'] = $offset;
        $this->template->load('admin', 'menu/viewmenu', $data);
    }

    /*
     * 22-05-2017
     * Author :sinto
     * Use: trashMenu
     */

    function trashMenu($id) {

        $this->menu_model->TrashById('cms_menu', $id, 'id');
//        $this->menu_model->TrashById('cms_pages', $id, 'menu_id');
        $route_type = 'menu';
        $action_type = 'trash';
        $quick_link_type = 'menu';
//        $this->common_model->quick_link_delete($id, $quick_link_type, $action_type);

        $this->route_model->routeTrashById('cms_routes', $id, 'slug_ref_id', $route_type);
        $this->route_model->save_routes($route_type);
        $this->session->set_flashdata('message', "Deleted Successfully!..");
        redirect('appearanceadmin/viewmenu/');
    }

    /*
     * EOF trashMenu
     */



    /*
     * 22-05-2017
     * Author:Sinto
     * Use: trash view menu
     */

    function trash_viewmenu($sport = 0, $sear = 0, $page_position = 0) {
        $data['categorylist'] = $this->menu_model->get_all_menus();

        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'appearanceadmin/trash_viewmenu/' . $sport . '/' . $sear;
        $config['total_rows'] = $this->menu_model->count_all_trash_menu();
        $config['per_page'] = '10';
        $config['num_links'] = 10;
        $config['uri_segment'] = 5;
        $config['prev_link'] = 'Previous';
        $config['prev_tag_open'] = ' ';
        $config['prev_tag_close'] = ' ';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = ' ';
        $config['next_tag_close'] = ' ';
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['categories'] = $this->menu_model->list_trash_menus($config['per_page'], $page_position);
        $data['page_position'] = $page_position;
        $this->template->load('admin', 'menu/trashMenu', $data);
    }

    /*
     * EOF trash view menu
     */


    /*
     * 22-05-2017
     * Author:Sinto
     * Use:restoreMenu
     */

    function restoreMenu($id) {
        $this->menu_model->RestoreById('cms_menu', $id, 'id');
//        $this->menu_model->RestoreById('cms_pages', $id, 'menu_id');
        $route_type = 'menu';
        $action_type = 'restore';
        $quick_link_type = 'menu';
        $this->common_model->quick_link_delete($id, $quick_link_type, $action_type);
        $this->route_model->routeRestoreById('cms_routes', $id, 'slug_ref_id', $route_type);
        $this->route_model->save_routes($route_type);
        $this->session->set_flashdata('message', "Restored Successfully!..");
        redirect('appearanceadmin/trash_viewmenu/');
    }

    /*
     * EOF restoreMenu
     */



    /*
     * 22-05-2017
     * Author:Sinto
     * Use:deleteMenu permanently
     */

    function deleteMenu($id) {
        $delete_status = $this->menu_model->DeleteById('cms_menu', $id, 'id');

        if ($delete_status == TRUE) {
            $route_type = 'menu';
            $action_type = 'delete';
            $quick_link_type = 'menu';
            $this->common_model->quick_link_delete($id, $quick_link_type, $action_type);
            $this->route_model->routeDeleteById('cms_routes', $id, 'slug_ref_id', $route_type);
            $this->route_model->save_routes($route_type);
            $this->session->set_flashdata('message', "Deleted Successfully!..");
        } else {
            $this->session->set_flashdata('message', "This data can not be deleted.");
        }

        redirect('appearanceadmin/trash_viewmenu/');
    }

    /*
     * EOF deleteMenu permanently
     */

    function view_content_gallery() {
        $id = $this->uri->segment(3);
        $data['values'] = $this->menu_model->list_news_gallery($id);
        $this->template->load('admin', 'menu/view_content_gallery', $data);
    }

    function edit_content_image($id, $order) {

        $data['values1'] = $this->menu_model->GetByRow('cms_featuredbox', $id, 'id');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('product_name', 'Picture Name', 'required');
        $this->form_validation->set_rules('final_images', 'final_images', 'trim');

        if ($this->form_validation->run($this) == FALSE) {

            $data['values'] = $this->uploadlibrary_model->Get_fileData();
            $this->template->load('admin', 'menu/edit_content_image', $data);
        } else {

            $this->menu_model->up_news_images($id, $order);
            redirect('appearanceadmin/view_content_gallery/' . $id);
        }
    }

    function delete_content_image($id, $order) {

        $this->menu_model->del_media_img($id, $order);

        $this->session->set_flashdata('message', "Deleted Successfully!..");
        redirect('appearanceadmin/view_content_gallery/' . $id);
    }  
      
//    menu type start

    function add_menu_type() {
        $_SESSION['seaval'] = '';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('catname', 'Type name', 'required');
        $this->form_validation->set_rules('order_number', 'Order number', 'required');
        $this->form_validation->set_rules('slug', 'Slug name', 'required|callback_handle_menu_type_slug');
//        $this->form_validation->set_rules('final_images', 'final_images', 'trim');

        if ($this->form_validation->run($this) == FALSE) {

            $data['values'] = $this->uploadlibrary_model->Get_fileData();
            $this->template->load('admin', 'menu/add_menu_type', $data);
        } else {

            $this->menu_model->add_menu_type();
            $this->session->set_flashdata('message', "Added Successfully!..");
            redirect('appearanceadmin/add_menu_type');
        }
    }

    function handle_menu_type_slug() {

        $ret = $this->menu_model->select_menu_type_slug();

        if ($ret) {
            $this->form_validation->set_message('handle_menu_type_slug', 'This Slug Is Already Exist!..');

            return FALSE;
        } else {

            return TRUE;
        }
    }

    function handle_menu_type_slug1() {


        $ret = $this->menu_model->select_menu_type_slug1();

        if ($ret) {
            $this->form_validation->set_message('handle_menu_type_slug1', 'This Slug Is Already Exist!..');

            return FALSE;
        } else {

            return TRUE;
        }
    }

    function view_menu_type($page_position = 0) {
        $_SESSION['seaval'] = '';
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'appearanceadmin/view_menu_type';
        $config['total_rows'] = $this->menu_model->count_all_menu_type();
        $config['per_page'] = '10';
        $config['num_links'] = 10;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['categories'] = $this->menu_model->list_menu_type($config['per_page'], $page_position);
        $data['page_position'] = $page_position;
        $this->template->load('admin', 'menu/view_menu_type', $data);
    }

    function edit_menu_type($id) {
        $_SESSION['seaval'] = '';
        $this->file_name = '';
        $data['cat'] = $this->menu_model->GetByRow('cms_dynamic_category', $id, 'id');

        $this->load->library('form_validation');
        $this->form_validation->set_rules('catname', 'Type name', 'required');
        $this->form_validation->set_rules('order_number', 'Order number', 'required');
        $this->form_validation->set_rules('slug', 'Slug name', 'required|callback_handle_menu_type_slug1');
//        $this->form_validation->set_rules('final_images', 'final_images', 'trim');


        if ($this->form_validation->run($this) == FALSE) {

            $data['values'] = $this->uploadlibrary_model->Get_fileData();
            $this->template->load('admin', 'menu/edit_menu_type', $data);
        } else {

            $this->menu_model->edit_menu_type($id);
            $this->session->set_flashdata('message', "Updated Successfully!..");

            redirect('appearanceadmin/view_menu_type');
        }
    }

    function trash_menu_type($id) {

        $this->common_model->TrashById('cms_dynamic_category', $id, 'id');
        $this->session->set_flashdata('message', "Deleted Successfully!..");
        redirect('appearanceadmin/view_menu_type/');
    }

    function restore_menu_type($id) {
        $this->common_model->RestoreById('cms_dynamic_category', $id, 'id');
        $this->session->set_flashdata('message', "Restored Successfully!..");
        redirect('appearanceadmin/trash_view_menu_type/');
    }

    function delete_menu_type($id) {
        $delete_status = $this->common_model->DeleteById('cms_dynamic_category', $id, 'id');
        if ($delete_status == TRUE) {
            $this->session->set_flashdata('message', "Deleted Successfully!..");
        } else {
            $this->session->set_flashdata('message', "This data can not be deleted.");
        }
        redirect('appearanceadmin/trash_view_menu_type/');
    }

    function trash_view_menu_type($page_position = 0) {
        $_SESSION['seaval'] = '';
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'appearanceadmin/trash_view_menu_type';
        $config['total_rows'] = $this->menu_model->trash_count_all_menu_type();
        $config['per_page'] = '10';
        $config['num_links'] = 10;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['categories'] = $this->menu_model->trash_list_menu_type($config['per_page'], $page_position);
        $data['page_position'] = $page_position;
        $this->template->load('admin', 'menu/trash_view_menu_type', $data);
    }
    
    public function handle_title() {
        $name = $this->input->post('name');
        $check_name = $this->menu_model->checkName($name);
        if ($check_name > 0) {
            $this->form_validation->set_message('handle_title', 'The title already exists!!');
            return false;
        } else {
            return true;
        }
    }
    
    public function handle_title_edit() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        $name = $this->input->post('name');

        $check_result = $this->menu_model->check_name_edit($id, $name);

        if ($check_result > 0) {
            $this->form_validation->set_message('handle_title_edit', 'The name already exists !!');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    //ends
    
    function add_menu(){
        $menu_type_cond_arr = array(
            'parent_id' => '0',
            'type' => 'menu_type',
            'trash_status' => 'no',
            'active_status' => 'a',
        );

        $data['target'] = $this->menu_model->targetlist();
        $data['menu_type_result'] = $this->common_model->GetByReturnTypeOrderType('cms_dynamic_category', 'order', 'ASC', $menu_type_cond_arr, $returntype = 'result');
        $data['categorylist'] = $this->menu_model->get_all_menus();
        
        $data['values'] = $this->uploadlibrary_model->Get_fileData();
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('menuname', 'Menu Name', 'required');
        $this->form_validation->set_rules('menu_type', 'Menu Type', 'required');
        
        
        if ($this->form_validation->run($this) == FALSE) {

            $this->template->load('admin', 'menu/add_menu_new', $data);
        }else{
            $id = $this->menu_model->addMenu();
            
            $this->session->set_flashdata('message', "Added Successfully!..");
            
            redirect('appearanceadmin/add_menu/');
        }
    }
    
    function edit_menu($id){
        $data['id'] = $id;
        $data['cat'] = '';
        $data['menuid'] = '';        

        $data['cat'] = $this->menu_model->GetByRow_notrash('cms_menu', $id, 'id');
        $data['menuid'] = $id;
            
        $menu_type_cond_arr = array(
            'parent_id' => '0',
            'type' => 'menu_type',
            'trash_status' => 'no',
            'active_status' => 'a',
        );    
        
        $data['target'] = $this->menu_model->targetlist();
        $data['menu_type_result'] = $this->common_model->GetByReturnTypeOrderType('cms_dynamic_category', 'order', 'ASC', $menu_type_cond_arr, $returntype = 'result');
        $data['categorylist'] = $this->menu_model->get_all_menus();
        
        $data['values'] = $this->uploadlibrary_model->Get_fileData();
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('menuname', 'Menu Name', 'required');
        $this->form_validation->set_rules('menu_type', 'Menu Type', 'required');
        
        
        if ($this->form_validation->run($this) == FALSE) {

            $this->template->load('admin', 'menu/edit_menu_new', $data);
        }else{
            $this->menu_model->editMenu($id);
            
            $this->session->set_flashdata('message', "Edited Successfully!..");
            redirect('appearanceadmin/viewmenu/?' . $_SERVER['QUERY_STRING']);
        }
    }

    function edit_menu_2($id){
        $data['cat'] = $data['values1'] = $this->menu_model->GetByRow_notrash('cms_menu', $id, 'id');
        
        $data['values'] = $this->uploadlibrary_model->Get_fileData();
        $data['menuid'] = $id;
        $data['default_combo_list'] = json_decode($this->common_model->option->default_combo_list, TRUE);
        
        $this->load->library('form_validation');

        $this->form_validation->set_rules('final_images', 'final_images', 'trim');
        
        if ($this->form_validation->run() == FALSE) {

            $this->template->load('admin', 'menu/editmenu2_new', $data);
        }else{
            $this->menu_model->editMenu2New($id);
            
            $this->session->set_flashdata('message', "Edited Successfully!..");
            
            redirect('appearanceadmin/viewmenu/?' . $_SERVER['QUERY_STRING']);
        }

    }
	
}
