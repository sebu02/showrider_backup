<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Commonimageadmin extends CI_Controller {
	
	var $data = array();

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('image_model');
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

    function addcategory() {
        $_SESSION['seaval'] = '';
        //$this->load->library('fckeditor'); 
        $data['catname'] = array('name' => 'catname', 'id' => 'catname', 'value' => set_value('catname'), 'class' => 'inputfieldStyle');

        $data['submit'] = array('name' => 'submit', 'value' => 'Add', 'class' => 'btn_apply');
        $data['reset'] = array('name' => 'reset', 'value' => 'Reset', 'class' => 'btn_apply');

        $this->load->library('form_validation');
        $this->form_validation->set_rules('catname', 'Categoryname', 'required');
        $this->form_validation->set_rules('order_number', 'Order number', 'required');
        $this->form_validation->set_rules('slug', 'Slug name', 'required|callback_handle_category_slug');
//        $this->form_validation->set_rules('final_images', 'final_images', 'trim');

        $this->form_validation->set_rules('parent_type', 'Parent type', 'required');

        if ($this->form_validation->run($this) == FALSE) {

            $data['values'] = $this->uploadlibrary_model->Get_fileData();
            $this->template->load('admin', 'image/addcategory', $data);
        } else {

            $this->image_model->add_category();
            $this->session->set_flashdata('message', "Added Successfully!..");
            redirect('commonimageadmin/addcategory');
        }
    }
    
   function bannerUpload(){
      if (isset($_FILES['images']['name'])){         
                  $fileName="images"; //$fileName=file type name
                  $comboID = $this->input->post('combo'); //comboid
                  $this->uploadlibrary_model->uploadLibrary($fileName,$comboID);          
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
    function upload() {
        $this->load->library('upload');
        $config['upload_path'] = 'upload/category/';
        $config['allowed_types'] = 'jpg|jpeg|gif|png';
        //$config['max_size'] = '5000000';
        //$config['max_width'] = '2000';
        //$config['max_height'] = '2000';
        $this->file_name = $config['file_name'] = $this->randomvalue() . '.' . end(explode('.', $_FILES['cat_picture']['name']));
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('cat_picture')) {
            //echo "test";
            $info = $this->upload->data();
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('message', $error);
        } else {
            /* To create thumb image */
            $info = $this->upload->data();
            $this->session->set_flashdata('message', "File Successfully uploaded");
            $this->image_thumb($info);

            //unlink($info['full_path']);
        }
    }

    function image_thumb($uploaddata) {
        $config = array();

        // create resized image
        $config['image_library'] = 'GD2';
        $config['source_image'] = $uploaddata['full_path'];
        $config['new_image'] = 'upload/category/thumb/' . $uploaddata['file_name'];
        $config['create_thumb'] = false;
        $config['maintain_ratio'] = true;
        $config['width'] = 120;
        $config['height'] = 120;

        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        $this->image_lib->display_errors();
        $this->image_lib->clear();
        $config = array();

        // create thumb
        $config['image_library'] = 'GD2';
        $config['source_image'] = $uploaddata['full_path'];
        $config['new_image'] = 'upload/category/medium/' . $uploaddata['file_name'];
        $config['create_thumb'] = false;
        $config['maintain_ratio'] = true;
        $config['width'] = 260;
        $config['height'] = 228;

        $this->image_lib->initialize($config);
        $this->image_lib->resize();

        //print_r($this->image_lib->display_errors());
    }

    function randomvalue() {
        $chars = "abcdefghijkmnopqrstuvwxyz023456789";
        srand((double) microtime() * 1000000);
        $i = 0;
        $pass = '';

        while ($i <= 5) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $pass = $pass . $tmp;
            $i++;
        }
        return $pass;
    }

    function handle_category_slug() {
        $ret = $this->image_model->select_category_slug();
        if ($ret) {
            $this->form_validation->set_message('handle_category_slug', 'This Slug Is Already Exist!..');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function handle_category_slug1() {
        $ret = $this->image_model->select_category_slug1();
        if ($ret) {
            $this->form_validation->set_message('handle_category_slug1', 'This Slug Is Already Exist!..');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function viewcategory($page_position = 0) {
        $_SESSION['seaval'] = '';
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'commonimageadmin/viewcategory';
        $config['total_rows'] = $this->image_model->count_all_cate();
        $config['per_page'] = '10';
        $config['num_links'] = 10;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['categories'] = $this->image_model->listcate($config['per_page'], $page_position);
        $data['page_position'] = $page_position;
        $this->template->load('admin', 'image/viewcategory', $data);
    }

    function edit($id) {
        $_SESSION['seaval'] = '';
        $this->file_name = '';
        $data['cat'] = $this->image_model->GetByRow('cms_dynamic_category', $id, 'id');
        $data['catname'] = array('name' => 'catname', 'id' => 'catname', 'value' => $data['cat']->category, 'class' => 'inputfieldStyle');

        $data['submit'] = array('name' => 'submit', 'value' => 'Update', 'class' => 'btn_apply');
        $data['reset'] = array('name' => 'reset', 'value' => 'Reset', 'class' => 'btn_apply');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('catname', 'Categoryname', 'required');
        $this->form_validation->set_rules('order_number', 'Order number', 'required');
        $this->form_validation->set_rules('slug', 'Slug name', 'required|callback_handle_category_slug1');
//        $this->form_validation->set_rules('final_images', 'final_images', 'trim');

        $this->form_validation->set_rules('parent_type', 'Parent type', 'required');

        if ($this->form_validation->run($this) == FALSE) {            
            $data['values'] = $this->uploadlibrary_model->Get_fileData();
            $this->template->load('admin', 'image/editcategory', $data);
        } else {
            $this->image_model->edit_category($id);
            $this->session->set_flashdata('message', "Updated Successfully!..");

            redirect('commonimageadmin/viewcategory');
        }
    }

    function addsubcategory() {
        $_SESSION['seaval'] = '';
        //$this->load->library('fckeditor'); 
        $data['catname'] = array('name' => 'catname', 'id' => 'catname', 'value' => set_value('catname'), 'class' => 'inputfieldStyle');
        $data['submit'] = array('name' => 'submit', 'value' => 'Add', 'class' => 'btn_apply');
        $data['reset'] = array('name' => 'reset', 'value' => 'Reset', 'class' => 'btn_apply');
        $data['categorylist'] = $this->image_model->showcats();

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
            $this->template->load('admin', 'image/addsubcategory', $data);
        } else {
            $this->image_model->add_subcategory();
            $this->session->set_flashdata('message', "Added Successfully!..");
            redirect('commonimageadmin/addsubcategory');
        }
    }

    function subcategory($page_position = 0) {
        $_SESSION['seaval'] = '';
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'commonimageadmin/subcategory';
        $config['total_rows'] = $this->image_model->count_all_subcate();
        $config['per_page'] = 10;
        $config['num_links'] = 3;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['categories'] = $this->image_model->GetAllCategorySub($config['per_page'], $page_position);
        $data['page_position'] = $page_position;
        $this->template->load('admin', 'image/viewsubcategory', $data);
    }

    function editSub($id) {
        $_SESSION['seaval'] = '';
        $data['cat'] = $this->image_model->GetByRow('cms_dynamic_category', $id, 'id');
        $data['categorylist'] = $this->image_model->showcats();
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
            $this->template->load('admin', 'image/editsubcategory', $data);
        } else {
            $this->image_model->edit_subcategory($id);
            $this->session->set_flashdata('message', "Updated Successfully!..");
            redirect('commonimageadmin/subcategory/');
        }
    }

    function addimages() {
        $this->load->library('form_validation');

//        $data['categorylist'] = $this->image_model->showcats();
        $data['main_categories'] = $this->image_model->get_all_main_categories();
        $data['values'] = $this->uploadlibrary_model->Get_fileData();

        $data['products_list'] = $this->image_model->getProductsList();

        $this->form_validation->set_rules('cat', 'Category Name', 'required|callback_handle_category');
//        $this->form_validation->set_rules('title[0]', 'title and image', 'required');
        $this->form_validation->set_rules('order_number', 'Order', 'required');
        $this->form_validation->set_rules('final_images', 'final_images', 'trim');

       // $this->form_validation->set_rules('image_type', 'Type', 'required');

        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'image/add_image', $data);
        } else {
            $this->image_model->insertimages();
            $this->session->set_flashdata('message', "Added Successfully!..");
            redirect('commonimageadmin/addimages/');
        }
    }

    function handle_category() {
        $cid = $this->input->post('cat');
        $check_prt = $this->image_model->chk_parent_category($cid);
        if ($check_prt) {
            $this->form_validation->set_message('handle_category', 'Please select subcategory');
            return FALSE;
        } else {
            return TRUE;
        }
    }
 
    function viewimages($cid = 0, $sport = 0, $sear = 0, $page_position = 0) {
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'commonimageadmin/viewimages/' . $cid . '/' . $sport . '/' . $sear;
        $config['total_rows'] = $this->image_model->count_all_imag();
        //echo $config['total_rows'];
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
        $data['images'] = $this->image_model->listimages($config['per_page'], $page_position);
        $data['page_position'] = $page_position;

        $data['list_categories'] = $this->image_model->showcats();
        $this->template->load('admin', 'image/view_images', $data);
    }

    function viewall() {
        redirect('commonimageadmin/viewimages');
    }

    function editimage($id) {
        $data['images'] = $this->image_model->GetByRow('cms_media', $id, 'id');
//        $data['categorylist'] = $this->image_model->showcats();
        $data['main_categories'] = $this->image_model->get_all_main_categories();
        $data['values'] = $this->uploadlibrary_model->Get_fileData();

        $data['products_list'] = $this->image_model->getProductsList();

        $this->load->library('form_validation');
        $this->form_validation->set_rules('cat', 'Category Name', 'required|callback_handle_category');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('order_number', 'Order', 'required');
        $this->form_validation->set_rules('final_images', 'final_images', 'trim');
        //$this->form_validation->set_rules('image_type', 'Type', 'required');
        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'image/edit_image', $data);            
        } else {
            $this->image_model->edit_images($id);
            $this->session->set_flashdata('message', "Updated Successfully!..");

            redirect('commonimageadmin/viewimages/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6) . '/' . $this->uri->segment(7));
        }
    } 

    function up_m() {
        $results = $this->db->get('cms_media')->result();

        foreach ($results as $row) {
            if ($row->prod_cat != '') {

                $parent_details = $this->image_model->get_first_parent($row->prod_cat);
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

    function view_featured_images() {
        $data['videos'] = $this->image_model->get_fetred_images();
        $this->template->load('admin', 'image/view_featured', $data);
    }

    function edit_featured($id) {
        $this->form_validation->set_rules('f_order', 'f_order', 'required');
        $data['product'] = $p = $this->image_model->GetByRow('cms_media', $id, 'id');
        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'image/edit_featured', $data);
        } else {
            $data = array(
                'featured_products' => $this->input->post('featured'),
                'f_order' => $this->input->post('f_order'),
            );
            $this->db->where('id', $id);
            $this->db->update('cms_media', $data);
            $this->session->set_flashdata('message', "Edited Successfully!..");
            redirect('commonimageadmin/view_featured_images/');
        }
    }

    function delete_featured($id) {
        $data = array(
            'featured_products' => '',
            'f_order' => '',
        );
        $this->db->where('id', $id);
        $this->db->update('cms_media', $data);

        $this->session->set_flashdata('message', "Removed Successfully!..");
        redirect('commonimageadmin/view_featured_images/');
    }   
    
    function trashImage($id) {
            $this->common_model->TrashById('cms_media', $id, 'id');
            $this->session->set_flashdata('message', "Deleted Successfully!..");
            redirect('commonimageadmin/viewimages/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6) . '/' . $this->uri->segment(7));
    }
        
        function trashCategory($id) {
            $this->common_model->TrashById('cms_dynamic_category', $id, 'id');
            $this->session->set_flashdata('message', "Deleted Successfully!..");
            redirect('commonimageadmin/viewcategory/');
        }
    
    function trashSubcategory($id) {
            $this->common_model->TrashById('cms_dynamic_category', $id, 'id');
            $this->session->set_flashdata('message', "Deleted Successfully!..");
            redirect('commonimageadmin/subcategory/');
        }

    function restoreImage($id) {
            $this->common_model->RestoreById('cms_media', $id, 'id');
            $this->session->set_flashdata('message', "Restored Successfully!..");
            redirect('commonimageadmin/trash_viewImage/');
        }

    function deleteImage($id) {
            $delete_status = $this->common_model->DeleteById('cms_media', $id, 'id');
            if($delete_status == TRUE){
                $this->session->set_flashdata('message', "Deleted Successfully!..");
            } else {
                $this->session->set_flashdata('message', "This data can not be deleted.");
            }
            redirect('commonimageadmin/trash_viewImage/');
        }

    function restoreSubcategory($id) {
            $this->common_model->RestoreById('cms_dynamic_category', $id, 'id');
            $this->session->set_flashdata('message', "Restored Successfully!..");
            redirect('commonimageadmin/trash_viewSubcategory/');
        }

    function deleteSubcategory($id) {
            $delete_status = $this->common_model->DeleteById('cms_dynamic_category', $id, 'id');
            if($delete_status == TRUE){
                $this->session->set_flashdata('message', "Deleted Successfully!..");
            } else {
                $this->session->set_flashdata('message', "This data can not be deleted.");
            }
            redirect('commonimageadmin/trash_viewSubcategory/');
        }

    function restoreCategory($id) {
            $this->common_model->RestoreById('cms_dynamic_category', $id, 'id');
            $this->session->set_flashdata('message', "Restored Successfully!..");
            redirect('commonimageadmin/trash_viewcategory/');
    }

    function deleteCategory($id) {
            $delete_status = $this->common_model->DeleteById('cms_dynamic_category', $id, 'id');
            if($delete_status == TRUE){
                $this->session->set_flashdata('message', "Deleted Successfully!..");
            } else {
                $this->session->set_flashdata('message', "This data can not be deleted.");
            }
            redirect('commonimageadmin/trash_viewcategory/');
    }
        
//    commonimageadmin
    function trash_viewcategory($page_position = 0) {
            $_SESSION['seaval'] = '';
            $this->load->library('pagination');
            $config['base_url'] = base_url() . 'commonimageadmin/trash_viewcategory';
            $config['total_rows'] = $this->image_model->trash_count_all_cate();
            $config['per_page'] = '10';
            $config['num_links'] = 10;
            $config['uri_segment'] = 3;
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $data['categories'] = $this->image_model->trash_listcate($config['per_page'], $page_position);
            $data['page_position'] = $page_position;
            $this->template->load('admin', 'image/trash_viewcategory', $data);
        }
        
    function trash_viewSubcategory($page_position = 0) {
            $_SESSION['seaval'] = '';

            $this->load->library('pagination');
            $config['base_url'] = base_url() . 'commonimageadmin/trash_viewSubcategory';

            $config['total_rows'] = $this->image_model->trash_count_all_subcate();
            $config['per_page'] = 10;
            $config['num_links'] = 3;
            $config['uri_segment'] = 3;
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $data['categories'] = $this->image_model->trash_GetAllCategorySub($config['per_page'], $page_position);
            $data['page_position'] = $page_position;
            $this->template->load('admin', 'image/trash_viewSubcategory', $data);
        }

    function trash_viewImage($cid = 0, $sport = 0, $sear = 0, $page_position = 0) {
                $this->load->library('pagination');
                $config['base_url'] = base_url() . 'commonimageadmin/trash_viewImage/' . $cid . '/' . $sport . '/' . $sear;
                $config['total_rows'] = $this->image_model->trash_count_all_imag();
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
                $data['images'] = $this->image_model->trash_listimages($config['per_page'], $page_position);
                $data['page_position'] = $page_position;

                $data['list_categories'] = $this->image_model->showcats();
                $this->template->load('admin', 'image/trash_viewImage', $data);
            }

    function get_image_attributes(){                
                $data['cat_id'] = $cat_id = $this->input->post('catid');                
                $attributes_view = $this->load->view('image/attributes_view', $data, true);                
                echo $attributes_view;
            }            

}
