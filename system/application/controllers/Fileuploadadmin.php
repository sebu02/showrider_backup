<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fileuploadadmin extends CI_Controller {
	
	var $data = array();

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('common_model');
        $this->load->model('file_model');
        $this->load->model('uploadlibrary_model');
        
        //$this->output->enable_profiler(TRUE);
        //date_default_timezone_set('Asia/Calcutta');
        //error_reporting(0);
        //session_start();

        if ($this->session->userdata('logged_adminpanel') != 'true') {
            redirect('admin/login');
        }     
    }

    public function index() {
        
    }

    /*
     *  upload images
     */

    public function upload_images() {
        if (empty($_FILES["images"])) {
            $data['values'] = $this->uploadlibrary_model->Get_fileData();
            $this->template->load('admin', 'files/add_image', $data);
        } else {            
            $fileName="images";
            $comboID = $this->input->post('combo');
            $this->uploadlibrary_model->uploadLibrary($fileName,$comboID);
        }
    }
  
    public function delete_upload_image(){
         $img= $this->input->post('img');
         $this->uploadlibrary_model->delete_upload_image($img);         
    }
    
    public function deleteFilechange(){
         $finalFiles= $this->input->post('finalFiles');
         $this->uploadlibrary_model->deleteFilechange($finalFiles);
        
    }
    
    public function fetchManipdata(){        
        $comboid= $this->input->post('comboid');
        $this->uploadlibrary_model->fetchManipdata($comboid);
    }
    
    /*
     *  End of upload images
     */   
    
    /*
     *  add extension 
     */

    public function addExtension() {
        $this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('suffix', 'suffix', '');
        $this->form_validation->set_rules('mediatype', 'mediatype', '');
        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'files/addExtension');
        } else {
            $this->file_model->addExtension();
            $this->session->set_flashdata('message', "Added Successfully!..");
            redirect('fileuploadadmin/addExtension');
        }
    }

    public function handle_suffix() {
        $suffix_data = $this->file_model->select_suffix();
        if ($suffix_data) {
            $this->form_validation->set_message('handle_suffix', 'This Suffix Is Already Exist!..');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /*
     *  End of add extension 
     */

    /*
     *  view all Extension
     */

    public function viewExtension($cid = 0, $page_position = 0) {
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'fileuploadadmin/viewExtension/' . $cid;
        $config['total_rows'] = $this->file_model->countExtension();
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
        $data['values'] = $this->file_model->get_allExtension($config['per_page'], $page_position);
        $data['page_position'] = $page_position;
        $this->template->load('admin', 'files/viewExtension', $data);
    }

    /*
     *  End of view Extension
     */

    /*
     *  Edit extension 
     */

    public function editExtension($id) {
        $data['values'] = $this->file_model->GetByRow('cms_mime_types', $id, 'id');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('suffix', 'suffix', 'required|callback_handle_check_suffix');
        $this->form_validation->set_rules('mediatype', 'mediatype', 'required');
        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'files/editExtension', $data);
        } else {
            $this->file_model->editExtension($id);
            $this->session->set_flashdata('message', "Edited Successfully!..");
            redirect('fileuploadadmin/viewExtension');
        }
    }

    public function handle_check_suffix() {
        $editsuffix = $this->file_model->select_editsuffix();
        if ($editsuffix) {
            $this->form_validation->set_message('handle_check_suffix', 'This Suffix Is Already Exist!..');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /*
     *  End of Edit extension 
     */

    function trashExtensions($id) {
        $this->file_model->TrashById('cms_mime_types', $id, 'id');
        // $this->file_model->removeExtid($id);
        $this->session->set_flashdata('message', "Deleted Successfully!..");
        redirect('fileuploadadmin/viewExtension/');
    }

    /*
     * End of Move to Trash Upload_type
     */

    /*
     *  view all trashExtension
     */

    public function trash_viewExtension($cid = 0, $page_position = 0) {
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'fileuploadadmin/trash_viewExtension/' . $cid;
        $config['total_rows'] = $this->file_model->trash_countExtension();
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
        $data['values'] = $this->file_model->trash_get_allExtension($config['per_page'], $page_position);
        $data['page_position'] = $page_position;
        $this->template->load('admin', 'files/trash_viewExtension', $data);
    }

    /*
     *  End of view trashExtension
     */

    function restoreExtensions($id) {
        $this->file_model->RestoreById('cms_mime_types', $id, 'id');
        $this->session->set_flashdata('message', "Restored Successfully!..");
        redirect('fileuploadadmin/trash_viewExtension/');
    }

    /*
     * End of Restore from Trash  Extensions
     */

    /*
     * Delete Extensions
     */

    function deleteExtensions($id) {
        $delete_status = $this->common_model->DeleteById('cms_mime_types', $id, 'id');
        if($delete_status == TRUE){
        $this->session->set_flashdata('message', "Deleted Successfully!..");
        } else {
            $this->session->set_flashdata('message', "This data can not be deleted.");
        }        
        redirect('fileuploadadmin/trash_viewExtension/');
    }

    /*
     * End of Delete Extensions
     */

    public function check_extension() {
        $extension = $this->input->post('extension');
        $img_extensions = array(
            "bmp",
            "gif",
            "jpg",
            "png",
            "tiff",
        );

        $extensions = $this->file_model->GetByRow('cms_mime_types', $extension, 'id');
        $suffix = $extensions->suffix;
        if (in_array($suffix, $img_extensions)) {
            echo "yes";
        } else {
            echo "no";
        }
    }

    /*
     *  add Upload_type 
     */

    public function addUpload_type() {
        $get_all['data'] = $this->file_model->Get_all('cms_mime_types');
		
		//{oldoption}
        //$get_all['options'] = $this->common_model->get_options();
        //$get_all['option'] = $get_all['options'][0];
		//{oldoption}
				
		$get_all['option'] = $this->common_model->get_options();
		
        $this->load->library('form_validation');
        $this->form_validation->set_rules('typename', 'typename', 'required|callback_handle_typename');
        //$this->form_validation->set_rules('extensions', 'extensions', 'required');
        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'files/addUpload_type', $get_all);
        } else {
            $insert_id = $this->file_model->addUpload_type();
            $this->session->set_flashdata('message', "Added Successfully!..");
			
			if($_POST['filestep'] == 'Yes' && $_POST['manipualtion'] == 'Yes')
			{
			redirect('fileuploadadmin/addManipulation?uid='.$insert_id);	
			}
			else
			if($_POST['filestep'] == 'Yes' && $_POST['manipualtion'] == 'No')
			{
			redirect('fileuploadadmin/addCombo?uid='.$insert_id);	
			}
			else
			{
            redirect('fileuploadadmin/addUpload_type');
			}			
        }
    }

    public function handle_typename() {
        $typename_data = $this->file_model->select_typename();
        if ($typename_data) {
            $this->form_validation->set_message('handle_typename', 'This Type Name Is Already Exist!..');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /*
     *  End of add Upload_type 
     */

    /*
     *  view all Upload_type 
     */

    public function viewUpload_type($cid = 0, $page_position = 0) {
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'fileuploadadmin/viewUpload_type/' . $cid;
        $config['total_rows'] = $this->file_model->countUpload_type();
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
        $data['values'] = $this->file_model->get_allUpload_type($config['per_page'], $page_position);
        $data['page_position'] = $page_position;
        $this->template->load('admin', 'files/viewUpload_type', $data);
    }

    /*
     *  End of view Upload_type 
     */

    /*
     *  Edit Upload_type
     */

    public function editUpload_type($id) {
        $data['values'] = $this->file_model->GetByRow('cms_upload_types', $id, 'id');

        $data['data'] = $this->file_model->Get_all('cms_mime_types');

        $this->load->library('form_validation');
        $this->form_validation->set_rules('typename', 'typename', 'required|callback_handle_edit_typename');
        //$this->form_validation->set_rules('extensions', 'extensions', 'required');
        if ($this->form_validation->run($this) == FALSE) {

            $this->template->load('admin', 'files/editUpload_type', $data);
        } else {

            $this->file_model->editUpload_type($id);
            $this->session->set_flashdata('message', "Edited Successfully!..");
            redirect('fileuploadadmin/viewUpload_type');
        }
    }

    public function handle_edit_typename() {
        $edit_typename = $this->file_model->select_edit_typename();
        if ($edit_typename) {
            $this->form_validation->set_message('handle_edit_typename', 'This Suffix Is Already Exist!..');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /*
     *  End of Edit Upload_type
     */

    function trashUpload_type($id) {
        $this->file_model->TrashById('cms_upload_types', $id, 'id');
        $this->session->set_flashdata('message', "Deleted Successfully!..");
        redirect('fileuploadadmin/viewUpload_type/');
    }

    /*
     * End of Move to Trash Upload_type
     */

    /*
     *  view all trashUpload_type
     */

    public function trash_Upload_type($cid = 0, $page_position = 0) {
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'fileuploadadmin/trash_Upload_type/' . $cid;
        $config['total_rows'] = $this->file_model->trash_countUpload_type();
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
        $data['values'] = $this->file_model->trash_get_allUpload_type($config['per_page'], $page_position);
        $data['page_position'] = $page_position;
        $this->template->load('admin', 'files/trash_viewUpload_type', $data);
    }

    /*
     *  End of view trashUpload_type
     */

    function restoreUpload_Type($id) {
        $this->file_model->RestoreById('cms_upload_types', $id, 'id');
        $this->session->set_flashdata('message', "Restored Successfully!..");
        redirect('fileuploadadmin/trash_Upload_type/');
    }

    /*
     * End of Restore from Trash  Upload_Type
     */

    /*
     * Delete Upload_Type
     */

    function deleteUpload_Type($id) {
        $delete_status = $this->common_model->DeleteById('cms_upload_types', $id, 'id');
        if($delete_status == TRUE){
        $this->session->set_flashdata('message', "Deleted Successfully!..");
        } else {
            $this->session->set_flashdata('message', "This data can not be deleted.");
        }
        
        redirect('fileuploadadmin/trash_Upload_type/');
    }

    /*
     * End of Upload_Type
     */

    /*
     *  add manipulation details
     */

    public function addManipulation() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('manipulation_name', 'manipulation_name', 'required|callback_handle_manipulation_name');
        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'files/addManipulation');
        } else {			
            $insert_id = $this->file_model->addManipulation();			
            $this->session->set_flashdata('message', "Added Successfully!..");			
			if(isset($_GET['uid']))
			{
			redirect('fileuploadadmin/addCombo?uid='.$_GET['uid'].'&mid='.$insert_id);	
			}
			else
			{
            redirect('fileuploadadmin/addManipulation');
			}
        }
    }

    public function handle_manipulation_name() {
        $manipulation_name_data = $this->file_model->select_manipulation_name();
        if ($manipulation_name_data) {
            $this->form_validation->set_message('handle_manipulation_name', 'This Manipulation Name Is Already Exist!..');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function check_size_name() {
        if ($this->input->post('size_name')) {
            $this->file_model->check_size_name();
        }
    }

    /*
     *  End of add manipulation details
     */

    /*
     *  view all manipulation types
     */

    public function viewallManipulation($cid = 0, $page_position = 0) {
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'fileuploadadmin/viewallManipulation/' . $cid;
        $config['total_rows'] = $this->file_model->count_allManipulation();
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
        $data['values'] = $this->file_model->get_allManipulation($config['per_page'], $page_position);
        $data['page_position'] = $page_position;
        $this->template->load('admin', 'files/viewallManipulation', $data);
    }

    /*
     *  End of view all manipulation types
     */

    /*
     * Edit image Manipulation
     */

    public function editManipulation($id) {
        $data['values'] = $this->file_model->GetByRow('cms_image_manipulation', $id, 'id');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('manipulation_name', 'manipulation_name', 'required|callback_handle_editmanipulation_name');
        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'files/editManipulation', $data);
        } else {
            $this->file_model->editManipulation($id);			
			$this->common_model->update_filecombo_by_manipulation($id);			
            $this->session->set_flashdata('message', "Edited Successfully!..");
            redirect('fileuploadadmin/viewallManipulation');
        }
    }

    public function handle_editmanipulation_name() {
        $editmanipulation_name_data = $this->file_model->select_editmanipulation_name();
        if ($editmanipulation_name_data) {
            $this->form_validation->set_message('handle_editmanipulation_name', 'This Manipulation Name Is Already Exist!..');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /*
     * End of Edit image Manipulation
     */

    function trashManipulation($id) {
        $this->file_model->TrashById('cms_image_manipulation', $id, 'id');
        $this->session->set_flashdata('message', "Deleted Successfully!..");
        redirect('fileuploadadmin/viewallManipulation/');
    }

    /*
     * End of Move to Trash Manipulation
     */

    /*
     *  view all trashManipulation
     */

    public function trash_Manipulation($cid = 0, $page_position = 0) {
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'fileuploadadmin/trash_Manipulation/' . $cid;
        $config['total_rows'] = $this->file_model->trash_countManipulation();
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
        $data['values'] = $this->file_model->trash_get_allManipulation($config['per_page'], $page_position);
        $data['page_position'] = $page_position;
        $this->template->load('admin', 'files/trash_viewManipulation', $data);
    }

    /*
     *  End of view trashManipulation
     */
    
    function restoreManipulation($id) {
        $this->file_model->RestoreById('cms_image_manipulation', $id, 'id');
        $this->session->set_flashdata('message', "Restored Successfully!..");
        redirect('fileuploadadmin/trash_Manipulation/');
    }

    /*
     * End of Restore from Trash  Manipulation
     */

    /*
     * Delete Manipulation
     */

    function deleteManipulation($id) {
        $delete_status = $this->common_model->DeleteById('cms_image_manipulation', $id, 'id');
        if($delete_status == TRUE){
        $this->session->set_flashdata('message', "Deleted Successfully!..");
        } else {
            $this->session->set_flashdata('message', "This data can not be deleted.");
        }
        
        redirect('fileuploadadmin/trash_Manipulation/');
    }

    /*
     * End of Manipulation
     */

    /*
     *  add Combo details
     */

    public function addCombo() {
        $data['data'] = $this->file_model->Get_all('cms_upload_types');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('combo_name', 'combo_name', 'required|callback_handle_combo_name');
        $this->form_validation->set_rules('uploadtype', 'uploadtype', 'required');
        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'files/addCombo', $data);
        } else {
            $combo_id = $this->file_model->addCombo();			
			$this->common_model->save_combo_option($combo_id);			
            $this->session->set_flashdata('message', "Added Successfully!..");
            redirect('fileuploadadmin/viewallCombo/');
        }
    }

    /*
     *  find manipulation names
     */

    public function fetchManipulation() {
        if ($this->input->post('upload_typeid')) {
            $data = $this->file_model->fetchManipulation();
            if ($data == false) {
                return TRUE;
            }
        }
    }

    /*
     *  End of find manipulation names
     */

    /*
     * find manipulation data
     */

    public function fetchManipulation_data() {
        if ($this->input->post('manipulation_id')) {
            echo $this->file_model->fetchManipulation_data();
        }
    }

    /*
     *  End of find manipulation data
     */

    public function handle_combo_name() {
        $combo_name_data = $this->file_model->select_combo_name();
        if ($combo_name_data) {
            $this->form_validation->set_message('handle_combo_name', 'This Combo Name Is Already Exist!..');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /*
     *  End of add Combo details
     */

    /*
     *  view all combo
     */

    public function viewallCombo($cid = 0, $page_position = 0) {
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'fileuploadadmin/viewallCombo/' . $cid;
        $config['total_rows'] = $this->file_model->count_allCombo();
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
        $data['values'] = $this->file_model->get_allCombo($config['per_page'], $page_position);
        $data['page_position'] = $page_position;
        $this->template->load('admin', 'files/viewallCombo', $data);
    }

    /*
     *  End of view all combo
     */

    /*
     * Edit image Manipulation
     */

    public function editCombo($id) {
        $data['values'] = $this->file_model->GetByRow('cms_image_combo', $id, 'id');
        $data['data'] = $this->file_model->Get_all('cms_upload_types');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('combo_name', 'combo_name', 'required|callback_handle_editCombo_name');
        $this->form_validation->set_rules('uploadtype', 'uploadtype', 'required');
        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'files/editCombo', $data);
        } else {
            $this->file_model->editCombo($id);			
			$this->common_model->save_combo_option($id);			
            $this->session->set_flashdata('message', "Edited Successfully!..");
            redirect('fileuploadadmin/viewallCombo/');
        }
    }

    public function handle_editCombo_name() {
        $editCombo_name_data = $this->file_model->select_editCombo_name();
        if ($editCombo_name_data) {
            $this->form_validation->set_message('handle_editCombo_name', 'This Combo Name Is Already Exist!..');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /*
     * End of Edit image Manipulation
     */
    
    function trashCombo($id) {
        $this->file_model->TrashById('cms_image_combo', $id, 'id');
        $this->session->set_flashdata('message', "Deleted Successfully!..");
        redirect('fileuploadadmin/viewallCombo/');
    }

    /*
     * End of Move to Trash Combo
     */

    /*
     *  view all trashCombo
     */

    public function trash_Combo($cid = 0, $page_position = 0) {
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'fileuploadadmin/trash_Combo/' . $cid;
        $config['total_rows'] = $this->file_model->trash_countCombo();
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
        $data['values'] = $this->file_model->trash_get_allCombo($config['per_page'], $page_position);
        $data['page_position'] = $page_position;
        $this->template->load('admin', 'files/trash_viewCombo', $data);
    }

    /*
     *  End of view trashCombo
     */

    function restoreCombo($id) {
        $this->file_model->RestoreById('cms_image_combo', $id, 'id');
        $this->session->set_flashdata('message', "Restored Successfully!..");
        redirect('fileuploadadmin/trash_Combo/');
    }

    /*
     * End of Restore from Trash  Combo
     */

    /*
     * Delete Manipulation
     */

    function deleteCombo($id) {
        $delete_status = $this->common_model->DeleteById('cms_image_combo', $id, 'id');
        if($delete_status == TRUE){
        $this->session->set_flashdata('message', "Deleted Successfully!..");
        } else {
            $this->session->set_flashdata('message', "This data can not be deleted.");
        }        
        redirect('fileuploadadmin/trash_Combo/');
    }

    /*
     * End of Manipulation
     */      
    
    function edit_combo_img($id) {
        $data['values1'] = $this->file_model->GetByRow('cms_image_combo', $id, 'id');
        $data['values'] = $this->uploadlibrary_model->Get_fileData();
        $data['id'] = $id;

        $this->load->library('form_validation');
        $this->form_validation->set_rules('final_images', 'final images', 'trim');
        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'files/edit_combo_img', $data);
        } else {
            $this->file_model->edit_combo_img($data['values1']->id);			
			$this->common_model->save_combo_option($data['values1']->id);			
            $this->session->set_flashdata('message', "Edited Successfully!..");
            redirect('fileuploadadmin/viewallCombo');
        }
    }    
    
}
