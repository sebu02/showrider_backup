<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ecproductadmin
        extends CI_Controller {

    var $data = array();

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('encryption');
      //  error_reporting(0);

        $this->load->model('common_model');
        $this->load->model('product_model');
        $this->load->model('uploadlibrary_model');

        // $this->load->library('ion_auth');

        $this->load->model('route_model');
        //session_start();




        if ($this->session->userdata('logged_adminpanel') != 'true') {
            redirect('admin/login');
        }

        /* if (! $this->ion_auth->logged_in())
          {
          redirect('secureadmin/index');
          } */
    }

    public function index() {
        
    }

    /*
     * Insert Function of Category Type
     */

    function manage_quick_links($quick_link,
            $id,
            $quick_link_name,
            $controller_name,
            $function_name,
            $quick_link_type,
            $insert_type,
            $url) {
        if ($quick_link == 'yes') {
            $this->common_model->manage_quick_link($id, $quick_link_name, $controller_name, $function_name, $quick_link_type, $insert_type, $url);
        } else {
            $action_type = 'trash';
            $this->common_model->quick_link_delete($id, $quick_link_type, $action_type);
        }
    }

    function add_categorytype() {
        $data['main_category_types'] = $this->product_model->load_main_category_types();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('input_name[]', 'Input Name', 'required|callback_handle_unique_name', array(
            'required' => 'You have not provided %s.'
        ));

        if ($this->form_validation->run($this) == FALSE) {

            $this->template->load('admin', 'product/category_type/add_categorytype', $data);
        } else {

            $this->product_model->add_categorytype();
            $this->session->set_flashdata('message', "Added Successfully!..");
            redirect('ecproductadmin/add_categorytype/');
        }
    }

    function handle_unique_name() {
        $ret = $this->product_model->select_by_name();
        if ($ret) {
            $this->form_validation->set_message('handle_unique_name', 'One of the Name Already Exist!..');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /*
     * End of Insert Function of Category Type
     */




    /*
     * View all Category Type with pagination
     */

    function view_categorytype($sear = 0,
            $page_position = 0) {
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'ecproductadmin/view_categorytype/' . $sear;
        $config['total_rows'] = $this->product_model->count_all_categorytype();
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
        $data['view_items_list'] = $this->product_model->list_categorytype($config['per_page'], $page_position);
        $data['page_position'] = $page_position;
        $this->template->load('admin', 'product/category_type/view_categorytype', $data);
    }

    /*
     * End of View all Category Type with pagination
     */


    /*
     * Edit Category Type
     */

    function edit_categorytype($id) {
        $data['main_category_types'] = $this->product_model->load_main_category_types();
        $data['single_detail'] = $this->product_model->GetByRow('ec_categorytypes', $id, 'id');


        $this->load->library('form_validation');
        $this->form_validation->set_rules('input_name', 'Input Name', 'required|callback_handle_unique_name1', array(
            'required' => 'You have not provided %s.'
        ));


        if ($this->form_validation->run($this) == FALSE) {

            $this->template->load('admin', 'product/category_type/edit_categorytype', $data);
        } else {

            $this->product_model->edit_categorytype($id);
            $this->session->set_flashdata('message', "Edited Successfully!..");
            redirect('ecproductadmin/view_categorytype/');
        }
    }

    function handle_unique_name1() {
        $ret = $this->product_model->select_by_name1();
        if ($ret) {
            $this->form_validation->set_message('handle_unique_name1', 'This Name Already Exist!..');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /*
     * End of Edit Category Type
     */



    /*
     * Move to Trash Category Type
     * For using Trash these fields
     * 'trash_status' ,'date_deleted','date_restored'  [,'active_status'] 
     * must be present in table
     */

    function trash_categorytype($id) {
        $this->product_model->TrashById('ec_categorytypes', $id, 'id');

        $prod_cat_details = $this->product_model->GetByRow('ec_categorytypes', $id, 'id');

        if ($prod_cat_details->save_database == 'yes') {
            $this->product_model->removeElementFind('ec_product_attributes', $id);
        }

        $this->session->set_flashdata('message', "Deleted Successfully!..");
        redirect('ecproductadmin/view_categorytype/');
    }

    /*
     * End of Move to Trash Category Type
     */


    /*
     * View all Trash Category Type with pagination
     */

    function trash_view_categorytype($sear = 0,
            $page_position = 0) {
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'ecproductadmin/trash_view_categorytype/' . $sear;
        $config['total_rows'] = $this->product_model->trash_count_all_categorytype();
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
        $data['view_items_list'] = $this->product_model->trash_list_categorytype($config['per_page'], $page_position);
        $data['page_position'] = $page_position;
        $this->template->load('admin', 'product/category_type/trash_view_categorytype', $data);
    }

    /*
     * End of Trash View all Category Type with pagination
     */

    /*
     * Restore from Trash Category Type
     * For using Restore Trash these fields
     * 'trash_status' ,'date_deleted','date_restored' [,'active_status'] 
     * must be present in table
     */

    function restore_categorytype($id) {
        $this->product_model->RestoreById('ec_categorytypes', $id, 'id');

        $prod_cat_details = $this->product_model->GetByRow('ec_categorytypes', $id, 'id');

        if ($prod_cat_details->save_database == 'yes') {
            $this->common_model->createProdAttrOptionArray('ec_product_attributes', $prod_cat_details->id, 'edit');
        }


        $this->session->set_flashdata('message', "Restored Successfully!..");
        redirect('ecproductadmin/trash_view_categorytype/');
    }

    /*
     * End of Restore from Trash Category Type
     */

    /*
     * Delete Category Type
     */

    function delete_categorytype($id) {
        $delete_status = $this->common_model->DeleteById('ec_categorytypes', $id, 'id');
        if ($delete_status == TRUE) {
            $this->session->set_flashdata('message', "Deleted Successfully!..");
        } else {
            $this->session->set_flashdata('message', "This data can not be deleted.");
        }

        redirect('ecproductadmin/trash_view_categorytype/');
    }

    /*
     * End of Delete Category Type
     */

    /*
     * Insert function of Product_Category
     */

    function handle_meta_slug() {

        $route_type = 'page';
        if ($this->input->post('url_type') == 'seo_url') {

            $full_slug = $this->input->post('slug');
            $ret = $this->product_model->select_page_slug();
            $ret_route = $this->route_model->route_check($full_slug, $route_type);
        } elseif ($this->input->post('url_type') == 'force_url') {

            $full_slug = $this->input->post('slug');
            $ret = $this->product_model->select_page_slug();
            $ret_route = $this->route_model->route_check($full_slug, $route_type);
        } elseif ($this->input->post('url_type') == 'auto_url') {
//            $ret = FALSE;
//            $ret_route = FALSE;
            if ($this->input->post('parentname') != 0) {

                $full_slug = $this->input->post('full_url_sec') . '/' . $this->input->post('slug');
            } else {

                $full_slug = $this->input->post('slug');
            }
            $ret = $this->product_model->select_page_slug();
            $ret_route = $this->route_model->route_check($full_slug, $route_type);
        }


        if ($ret == TRUE || $ret_route == TRUE) {
            $this->form_validation->set_message('handle_meta_slug', 'This URL Already Exist..');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function handle_meta_slug1() {
        $route_type = 'page';
        if ($this->input->post('url_type') == 'seo_url') {

            $full_slug = $this->input->post('slug');

            $ret = $this->product_model->select_page_slug1();
            $ret_route = $this->route_model->route_check($full_slug, $route_type);
        } elseif ($this->input->post('url_type') == 'force_url') {

            $full_slug = $this->input->post('slug');
            $ret = $this->product_model->select_page_slug1();
            $ret_route = $this->route_model->route_check($full_slug, $route_type);
        } elseif ($this->input->post('url_type') == 'auto_url') {
//            $ret = FALSE;
//            $ret_route = FALSE;


            if ($this->input->post('parentname') != 0) {

                $full_slug = $this->input->post('full_url_sec') . '/' . $this->input->post('slug');
            } else {

                $full_slug = $this->input->post('slug');
            }

            $ret = $this->product_model->select_page_slug1();
            $ret_route = $this->route_model->route_check($full_slug, $route_type);
        }


        if ($ret == TRUE || $ret_route == TRUE) {
            $this->form_validation->set_message('handle_meta_slug1', 'Already Exist..');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function add_prodcategory() {

        //$data['categorylist'] = $this->product_model->showcategory_classi(1);

        $data['menu_list'] = $this->product_model->get_subcategory_list();
       
        $data['option'] = $this->common_model->get_options();

        $this->load->library('form_validation');
        $this->form_validation->set_rules('input_name', 'Category Name', 'required');
//        $this->form_validation->set_rules('short_name', 'Short Name', 'required');
        $this->form_validation->set_rules('slug', 'Slug/Url name', 'required|callback_handle_unique_category_slug');
//        $this->form_validation->set_rules('slug', 'Slug/Url name', 'required|callback_handle_meta_slug');

        if ($this->form_validation->run($this) == FALSE) {

            $data['values'] = $this->uploadlibrary_model->Get_fileData();
            $this->template->load('admin', 'product/prodcategory/add_prodcategory', $data);
        } else {

            $id = $this->product_model->add_prodcategory();
            
            /*
             * routing section
             */
            $route_chk_tble = 'ec_category';
            $route_type = 'product_category';
            $route_type1 = 'product_category_route';
            $this->route_model->create_route($id, $route_chk_tble, $route_type, $route_type1);
            $this->route_model->save_routes($route_type);
            /*
             * EOF routing section
             */
            $this->session->set_flashdata('message', "Added Successfully!..");

                redirect('ecproductadmin/edit_prodcategory2?id=' . $id );

        }
    }

    function handle_unique_category_slug() {

        $route_type = 'product_category';

        if ($this->input->post('url_type') == 'seo_url') {

            if ($this->input->post('parentname') != 0) {

                $full_slug = $this->input->post('full_url_sec') . '/' . $this->input->post('slug');
            } else {

                $full_slug = $this->input->post('slug');
            }


            $ret = $this->product_model->select_by_category_slug();
            $ret_route = $this->route_model->route_check($full_slug, $route_type);
        } elseif ($this->input->post('url_type') == 'force_url') {

            $full_slug = $this->input->post('slug');
            $ret = $this->product_model->select_by_category_slug();
            $ret_route = $this->route_model->route_check($full_slug, $route_type);
        } elseif ($this->input->post('url_type') == 'auto_url') {
            $ret = FALSE;
            $ret_route = FALSE;
        }



        if ($ret == TRUE || $ret_route == TRUE) {
            $this->form_validation->set_message('handle_unique_category_slug', 'This URL Already Exist. ');

            return FALSE;
        } else {

            return TRUE;
        }
    }

    /*
     * End of Insert function of Product_Category
     */

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








    /*
     * View all Product_Category with pagination
     */

    function view_prodcategory() {


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
        $config['base_url'] = base_url() . 'ecproductadmin/view_prodcategory?' . $urisegments;
        $config['total_rows'] = $this->product_model->count_all_prodcategory();
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
        $data['view_items_list'] = $this->product_model->list_prodcategory($config['per_page'], $offset);
        $data['page_position'] = $offset;
        $this->template->load('admin', 'product/prodcategory/view_prodcategory', $data);
    }

    /*
     * End of View all Product_Category with pagination
     */



    /*
     * Edit Product_Category
     */

    function edit_prodcategory() {

        $id = '';
        if (isset($_GET['id'])) {

            $id = $_GET['id'];
        }

        $this->data['single_detail']=$single_detail = $this->product_model->GetByRow('ec_category', $id, 'id');

        $this->data['categorylist'] = $this->product_model->showcategory_classi(1);       
        $this->data['menu_list'] = $this->product_model->get_subcategory_list();
        //dump($this->data['menu_list']);die();
   
        $this->load->library('form_validation');
        $this->form_validation->set_rules('input_name', 'Category Name', 'required');
//        $this->form_validation->set_rules('short_name', 'Short Name', 'required');
//        $this->form_validation->set_rules('slug', 'Slug/Url name', 'required|callback_handle_meta_slug1');
        $this->form_validation->set_rules('slug', 'Slug/Url name', 'required|callback_handle_unique_category_slug1');
        $this->form_validation->set_rules('final_images', 'Category Picture', 'trim'); //Don't Delete this line to preserve set values
        $this->form_validation->set_rules('final_images_b', 'Banner Picture', 'trim'); //Don't Delete this line to preserve set values

        if ($this->form_validation->run($this) == FALSE) {
            $this->data['values'] = $this->uploadlibrary_model->Get_fileData();
            $this->template->load('admin', 'product/prodcategory/edit_prodcategory', $this->data);
        } else {

            $this->product_model->edit_prodcategory($id);

            /*
             * routing section
             */
            $route_chk_tble = 'ec_category';
            $route_type = 'product_category';
            $route_type1 = 'product_category_route';
            $this->route_model->update_route($id, $route_chk_tble, $route_type, $route_type1);
            $this->route_model->save_routes($route_type);

            $route_type_pro = 'product_item';
            $this->route_model->save_routes($route_type_pro);

            /*
             * EOF routing section
             */

           
            $this->session->set_flashdata('message', "Edited Successfully!..");

            $per_page = '';
            if (isset($_GET['per_page'])) {
                $per_page = '&per_page=' . $_GET['per_page'];
            }
          
             redirect('ecproductadmin/edit_prodcategory2?id='. $id . $per_page);            
                
        }
    }

    function handle_unique_category_slug1() {

        $route_type = 'product_category';
        if ($this->input->post('url_type') == 'seo_url') {

            if ($this->input->post('parentname') != 0) {

                $full_slug = $this->input->post('full_url_sec') . '/' . $this->input->post('slug');
            } else {

                $full_slug = $this->input->post('slug');
            }

            $ret = $this->product_model->select_by_category_slug1();
            $ret_route = $this->route_model->route_check_edit($full_slug, $route_type);
        } elseif ($this->input->post('url_type') == 'force_url') {

            $full_slug = $this->input->post('slug');
            $ret = $this->product_model->select_by_category_slug1();
            $ret_route = $this->route_model->route_check_edit($full_slug, $route_type);
        } elseif ($this->input->post('url_type') == 'auto_url') {
            $ret = FALSE;
            $ret_route = FALSE;
        }


        if ($ret == TRUE || $ret_route == TRUE) {
            $this->form_validation->set_message('handle_unique_category_slug1', 'This URL Already Exist. We Prefer Auto URL.');

            return FALSE;
        } else {

            return TRUE;
        }
    }

    /*
     * End of Edit Product_Category
     */

    function edit_prodcategory2() {

        $id = '';
        if (isset($_GET['id'])) {

            $id = $_GET['id'];
        }

        $this->data['single_detail'] =$single_detail= $this->product_model->GetByRow('ec_category', $id, 'id');
        $data['menu_list'] = $this->product_model->get_subcategory_list();
        $this->data['values'] = $this->uploadlibrary_model->Get_fileData();
        $this->load->library('form_validation');

        $this->form_validation->set_rules('final_images', 'Category Picture', 'trim'); //Don't Delete this line to preserve set values

        // $this->form_validation->set_rules('final_images_b', 'Banner Picture', 'trim'); //Don't Delete this line to preserve set values

        if ($this->form_validation->run($this) == FALSE) {

            $this->template->load('admin', 'product/prodcategory/edit_prodcategory2', $this->data);
        } else {

            $this->product_model->edit_prodcategory2($id);
            
            $this->session->set_flashdata('message', "Edited Successfully!..");

            $per_page = '';
            if (isset($_GET['per_page'])) {
                $per_page = '&per_page=' . $_GET['per_page'];
            }
            
              $uristrings = $_SERVER['QUERY_STRING'];

              redirect('ecproductadmin/edit_prodcategory3?id='. $id . $per_page);
             
        }
    }

    function edit_prodcategory3() {       

        $id = '';
        if (isset($_GET['id'])) {

            $id = $_GET['id'];
        }

        $this->data['single_detail'] =$single_detail= $this->product_model->GetByRow('ec_category', $id, 'id');
        $data['menu_list'] = $this->product_model->get_subcategory_list();
        $this->data['values'] = $this->uploadlibrary_model->Get_fileData();
        $this->load->library('form_validation');

        $this->form_validation->set_rules('final_images', 'Banner Picture', 'trim');

        if ($this->form_validation->run($this) == FALSE) {

            $this->template->load('admin', 'product/prodcategory/edit_prodcategory3', $this->data);
        } else {

            $this->product_model->edit_prodcategory3($id);
            
            $this->session->set_flashdata('message', "Edited Successfully!..");

            $per_page = '';
            if (isset($_GET['per_page'])) {
                $per_page = '&per_page=' . $_GET['per_page'];
            }
            
              $uristrings = $_SERVER['QUERY_STRING'];

              redirect('ecproductadmin/view_prodcategory?'.$per_page);
             
        }

    }

    function sub_cat_tree() {

        if ($this->input->post('category_id') != NULL && $this->input->post('level') != NULL && $this->input->post('top_parent') != NULL) {

            $category_id = $this->input->post('category_id');
            $current_level = $this->input->post('level');
            $top_parent = $this->input->post('top_parent');
        }


        if ($current_level == 1) {
            $span_class = 'label label-info';
        } elseif ($current_level == 2) {
            $span_class = 'label label-warning';
        } elseif ($current_level == 3) {
            $span_class = 'label label-important';
        } elseif ($current_level == 4) {
            $span_class = 'label label-inverse';
        } elseif ($current_level == 5) {
            $span_class = 'label';
        } elseif ($current_level == 6) {
            $span_class = 'label label-info';
        } elseif ($current_level == 7) {
            $span_class = 'label label-warning';
        } elseif ($current_level == 8) {
            $span_class = 'label label-important';
        } else {
            $span_class = 'label label-inverse';
        }
        $level = $current_level + 1;
        $subcategories = $this->product_model->get_subcategory($category_id);

        if ($subcategories) {
            $result = '<ul style="list-style-type: none"> ';

            foreach ($subcategories as
                    $key =>
                    $sub) {

                $old_tree_array = json_decode($this->input->post('old_tree'), TRUE);

                $checked_id = $this->product_model->findID_exist($old_tree_array, 'id', $sub->id);
                if ($checked_id == 'yes') {
                    $new_check = " checked=''";
                } else {
                    $new_check = "";
                }
                $check = $this->product_model->check_subcategories($sub->id);


                if ($check != 0) {
                    $icon = '<span class="icomoon-icon-plus-circle left" style="cursor: pointer;" id="click_' . $sub->id . '" data-parent="' . $top_parent . '" onclick="sub_cat(' . $sub->id . ',' . $level . ',this)"></span>';
                } else {
                    $icon = '<span class="icomoon-icon-grid-3 left"></span> ';
                }

                $result .= '<li>
                            <div class="row-fluid">
                               <div class="span12">
                                ' . $icon . '
                                <input ' . $new_check . ' data-parent="' . $top_parent . '" class="subcat_check left" id="check_' . $sub->id . '" '
                        . ' onchange="create_ids(' . $level . ',' . $sub->id . ',this)"'
                        . 'type="checkbox" value="' . $sub->id . '" data-subcat="' . $sub->id . '" data-cat="' . $category_id . '" name="cate[]" />
                                <span class="' . $span_class . ' left">' . ucwords($sub->category) . '</span>
                                <span id="gl_tree_loader_' . $sub->id . '" 
                                   class="left"
                                   style="display: none"><img src="' . base_url() . 'static/adminpanel/images/loaders/circular/013.gif"></span>    
                             </div>
                         </div>        
                                <div class="sub_category" id="subcat_' . $sub->id . '">

                                </div>
                                </li>';
            }
            $result .= '</ul>';
            echo $result;
        }
    }

    /*
     * Move to Trash Product_Category
     * For using Trash these fields
     * 'trash_status' ,'date_deleted','date_restored'  [,'active_status'] 
     * must be present in table
     */

    function trash_prodcategory() {

        $id = '';
        if (isset($_GET['id'])) {

            $id = $_GET['id'];
        }

        $this->product_model->TrashById('ec_category', $id, 'id');
        $route_type = 'product_category';
        $action_type = 'trash';
        $quick_link_type = 'product_category';
//        $this->common_model->quick_link_delete($id, $quick_link_type, $action_type);
        $this->route_model->routeTrashById('cms_routes', $id, 'slug_ref_id', $route_type);
        $this->route_model->save_routes($route_type);
        $this->session->set_flashdata('message', "Deleted Successfully!..");

        $uristrings = $_SERVER['QUERY_STRING'];
        if (isset($_GET['id'])) {

            $remove_seg3 = 'id=' . $_GET['id'];
            $newuristrings = str_replace($remove_seg3, '', $uristrings);
        }
        redirect('ecproductadmin/view_prodcategory?' . $newuristrings);
    }

    /*
     * End of Move to Trash Product_Category
     */


    /*
     * View all Trash Product_Category with pagination
     */

    function trash_view_prodcategory($sear = 0,
            $ftype = 0,
            $page_position = 0) {
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'ecproductadmin/trash_view_prodcategory/' . $sear . '/' . $ftype;
        $config['total_rows'] = $this->product_model->trash_count_all_prodcategory();
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
        $data['view_items_list'] = $this->product_model->trash_list_prodcategory($config['per_page'], $page_position);
        $data['page_position'] = $page_position;
        $this->template->load('admin', 'product/prodcategory/trash_view_prodcategory', $data);
    }

    /*
     * End of Trash View all Product_Category with pagination
     */

    /*
     * Restore from Trash Product_Category
     * For using Restore Trash these fields
     * 'trash_status' ,'date_deleted','date_restored' [,'active_status'] 
     * must be present in table
     */

    function restore_prodcategory($id,
            $ftype) {
        $this->product_model->RestoreById('ec_category', $id, 'id');
        $route_type = 'product_category';
        $action_type = 'restore';
        $quick_link_type = 'product_category';
        $this->common_model->quick_link_delete($id, $quick_link_type, $action_type);
        $this->route_model->routeRestoreById('cms_routes', $id, 'slug_ref_id', $route_type);
        $this->route_model->save_routes($route_type);
        $this->session->set_flashdata('message', "Restored Successfully!..");
        redirect('ecproductadmin/trash_view_prodcategory/0/' . $ftype);
    }

    /*
     * End of Restore from Trash Product_Category
     */

    /*
     * Delete Product_Category
     */

    function delete_prodcategory($id,
            $ftype) {
        $delete_status = $this->common_model->DeleteById('ec_category', $id, 'id');
        if ($delete_status == TRUE) {
            $route_type = 'product_category';
            $action_type = 'delete';
            $quick_link_type = 'product_category';
            $this->common_model->quick_link_delete($id, $quick_link_type, $action_type);
            $this->route_model->routeDeleteById('cms_routes', $id, 'slug_ref_id', $route_type);
            $this->route_model->save_routes($route_type);
            $this->session->set_flashdata('message', "Deleted Successfully!..");
        } else {
            $this->session->set_flashdata('message', "This data can not be deleted.");
        }

        redirect('ecproductadmin/trash_view_prodcategory/0/' . $ftype);
    }

    /*
     * End of Delete Product_Category
     */







    /*
     * Add Products
     */

    function add_product() {

        $ftype = '';

        $data['product_type_product'] = $this->product_model->get_all_product_type_product();
        
        $data['option'] = $this->common_model->get_options();

        $data['product_sku'] = $data['option']->sku_prefix . $this->common_model->get_rand_alphanumeric(4);
        
        $data['categorylist'] = $this->product_model->showcategory_classi(1);

        $this->load->library('form_validation');

        $this->form_validation->set_rules('cat', 'Category', 'required');

        $this->form_validation->set_rules('product_display_name', 'Product Name', 'trim|required');
        $this->form_validation->set_rules('slug', 'Slug Name', 'trim|required|callback_handle_productslug');
//        $this->form_validation->set_rules('p_name', 'Product Short Name', 'trim');

        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'product/add_product', $data);
        } else {
            $id = $this->product_model->add_product();
            
//            $this->product_model->addBulkProductImages($id);

            /*
             * routing section
             */
            $route_chk_tble = 'ec_products';
            $route_type = 'product_item';
            $route_type1 = 'product_item_route';
            $this->route_model->create_route($id, $route_chk_tble, $route_type, $route_type1);
            $this->route_model->save_routes($route_type);
            /*
             * EOF routing section
             */
            $this->session->set_flashdata('message', "Added Successfully");           

            redirect('ecproductadmin/editProducts2?id=' . $id );

        }
    }

    function handle_productslug() {

        $route_type = 'product_item';

        if ($this->input->post('url_type') == 'seo_url') {
            if($this->input->post('full_url_sec') != ''){
                $full_slug = $this->input->post('full_url_sec') . '/' . $this->input->post('slug');
            }else{
                $full_slug = $this->input->post('slug');
            }            
            $ret = $this->product_model->selectProductSlug();
            $ret_route = $this->route_model->route_check($full_slug, $route_type);
        } elseif ($this->input->post('url_type') == 'force_url') {

            $full_slug = $this->input->post('slug');
            $ret = $this->product_model->selectProductSlug();
            $ret_route = $this->route_model->route_check($full_slug, $route_type);
        } elseif ($this->input->post('url_type') == 'auto_url') {
            $ret = FALSE;
            $ret_route = FALSE;
        }


        if ($ret == TRUE || $ret_route == TRUE) {

            $this->form_validation->set_message('handle_productslug', 'This URL Already Exist. We Prefer Auto URL.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /*
     * EOF Add Products
     */




    /*
     * View all Product with pagination
     */

    function view_product() {

        $ftype = '';

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
        $config['base_url'] = base_url() . 'ecproductadmin/view_product?' . $urisegments;
        $config['total_rows'] = $this->product_model->count_all_product();
        $config['enable_query_strings'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['per_page'] = '20';
        $config['num_links'] = 5;
        $config['uri_segment'] = 6;
        $config['prev_link'] = 'Previous';
        $config['prev_tag_open'] = '';
        $config['prev_tag_close'] = '';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '';
        $config['next_tag_close'] = '';
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['view_items_list'] = $this->product_model->list_product($config['per_page'], $offset);
//        $data['view_items_list'] = $this->product_model->list_product($config['per_page'], $page_position);
        $data['page_position'] = $offset;

        $category_type_row = $this->product_model->GetByRow_notrash('ec_categorytypes', 'category', 'fixed_type');
        $data['list_categories'] = $this->product_model->showcategory_classi($category_type_row->id); // 1 category type id 

        $data['delete_status'] = $this->common_model->delete_status();


        if (isset($_SESSION['check_status'])) {
            if ($_SESSION['check_status'] != '') {

                $sorted_array = $this->product_model->get_full_sorted_product($_SESSION['checked_ids']);
                $get_split = explode('*****', $sorted_array);

                $data['sorted_array'] = $get_split[0];
                $data['num_sorted_array'] = $get_split[1];
            }
        }


        $this->template->load('admin', 'product/view_product', $data);
    }

    /*
     * End of View all Product with pagination
     */

    function update_deafultProductImageStatus() {

        $mediaid = $_POST['mediaid'];
        $productid = $_POST['productid'];
        $this->product_model->update_deafultProductImageStatus($mediaid, $productid);
    }

    function view_allproduct_gallery() {

        $id = $this->uri->segment(3);

        $data['product'] = $this->product_model->GetByRow('ec_products', $id, 'id');
        $this->template->load('admin', 'product/view_allproduct_gallery', $data);
    }

    function view_brochure_gallery() {

        $id = $this->uri->segment(3);

        $data['product'] = $this->product_model->GetByRow('ec_products', $id, 'id');
        $this->template->load('admin', 'product/view_brochure_gallery', $data);
    }

    function delete_product_brochure($order,
            $productid,
            $ftype) {

        $this->product_model->del_brochure_img($order, $productid);
        $this->session->set_flashdata('message', "Deleted Successfully!..");
        redirect('ecproductadmin/view_brochure_gallery/' . $productid . '/' . $ftype);
    }

    function edit_product_brochure($order,
            $productid) {

        $ftype = $this->uri->segment(5);

        $data['product'] = $this->product_model->GetByRow('ec_products', $productid, 'id');

        $this->load->library('form_validation');
        $this->form_validation->set_rules('product_name', 'Picture Name', 'required');
        $this->form_validation->set_rules('final_images', 'final_images', 'trim');

        if ($this->form_validation->run($this) == FALSE) {

            $data['values'] = $this->uploadlibrary_model->Get_fileData();
            $this->template->load('admin', 'product/edit_product_brochure', $data);
        } else {

            $this->product_model->up_brochure_images($order, $productid);
            redirect('ecproductadmin/view_brochure_gallery/' . $productid . '/' . $ftype);
        }
    }

    function view_product_gallery() {

        $id = $this->uri->segment(3);

        $data['product'] = $this->product_model->GetByRow('ec_products', $id, 'id');

        // $data['media_list'] = $this->product_model->list_product_gallery($id);

        $data['media_list_1'] = $this->product_model->listProductGalleryByType($id , "banner_img");
        $data['media_list_2'] = $this->product_model->listProductGalleryByType($id , "default_img");
        $data['media_list_3'] = $this->product_model->listProductGalleryByType($id , "thumbnail");
        $data['media_list_4'] = $this->product_model->listProductGalleryByType($id , "other");

        $this->template->load('admin', 'product/view_product_gallery', $data);
    }

    function edit_product_image($id,
            $productid) {

        $ftype = $this->uri->segment(5);

        $data['product'] = $this->product_model->GetByRow('ec_products', $productid, 'id');
        $data['media'] = $this->product_model->GetByRow('cms_media', $id, 'id');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('product_name', 'Picture Name', 'required');
        $this->form_validation->set_rules('final_images', 'final_images', 'trim');

        if ($this->form_validation->run($this) == FALSE) {

            $data['values'] = $this->uploadlibrary_model->Get_fileData();
            $this->template->load('admin', 'product/edit_product_image', $data);
        } else {

            $this->product_model->up_news_images($id, $productid);
            
            $this->session->set_flashdata('message', "Updated Successfully!..");
            
            redirect('ecproductadmin/view_product_gallery/' . $productid . '/' . $ftype);
        }
    }

    function delete_product_image($id,
            $productid) {

        $ftype = '';
        $delete_status = $this->product_model->del_media_img($id, $productid);
//        dump($delete_status);
        if ($delete_status == FALSE) {
            $this->session->set_flashdata('message', "Default image cannot be able to delete!..");
        } else {
            $this->session->set_flashdata('message', "Deleted Successfully!..");
        }

        redirect('ecproductadmin/view_product_gallery/' . $productid . '/' . $ftype);
    }

    /*
     * Edit Product
     */

    function edit_product() {

        $ftype = '';

        $id = '';
        if (isset($_GET['id'])) {

            $id = $_GET['id'];
        }
        $this->data['wizard_id'] = '';

        $this->data['uniq_wizard_id'] = '';


        $this->data['option'] = $this->common_model->get_options();


        $this->data['product'] = $this->product_model->GetByRow('ec_products', $id, 'id');


        $this->data['product_type_product'] = $this->product_model->get_all_product_type_product();

        
        $this->data['categorylist'] = $this->product_model->showcategory_classi(1);
        
//        $data['product_sku'] = $data['option']->sku_prefix . $this->common_model->get_rand_alphanumeric(4);

        $this->load->library('form_validation');


        $this->form_validation->set_rules('cat', 'Category Name', 'required');

        $this->form_validation->set_rules('product_display_name', 'Product Name', 'trim|required');

        $this->form_validation->set_rules('slug', 'Slug Name', 'trim|required|callback_handle_productslug1');  


        if ($this->form_validation->run($this) == FALSE) {

            $this->template->load('admin', 'product/edit_product', $this->data);
        } else {

            $product_update_id = $this->product_model->edit_product($id);


                /*
                 * routing section
                 */
                $route_chk_tble = 'ec_products';
                $route_type = 'product_item';
                $route_type1 = 'product_item_route';
                $this->route_model->update_route($id, $route_chk_tble, $route_type, $route_type1);
                $this->route_model->save_routes($route_type);
                /*
                 * EOF routing section 
                 */

          
            $this->session->set_flashdata('message', "Edited Successfully!..");

            
             $special_edit = '';
           
            
            $per_page = '';
            if (isset($_GET['per_page'])) {
                $per_page = '&per_page=' . $_GET['per_page'];
            }
            $shop_url = '';
           
                redirect('ecproductadmin/editProducts2?id=' . $id . $per_page);            
                        
        }
    }

    function handle_productslug1() {

        $route_type = 'product_item';

        if ($this->input->post('url_type') == 'seo_url') {
            if($this->input->post('full_url_sec') != ''){
                $full_slug = $this->input->post('full_url_sec') . '/' . $this->input->post('slug');
            }else{
                $full_slug = $this->input->post('slug');
            }
            
            $ret = $this->product_model->selectProductSlug1();
//            dump($this->db->last_query());die();
            $ret_route = $this->route_model->route_check($full_slug, $route_type);
        } elseif ($this->input->post('url_type') == 'force_url') {

            $full_slug = $this->input->post('slug');
            $ret = $this->product_model->selectProductSlug1();
            $ret_route = $this->route_model->route_check($full_slug, $route_type);
        } elseif ($this->input->post('url_type') == 'auto_url') {
            $ret = FALSE;
            $ret_route = FALSE;
        }

        if ($ret == TRUE || $ret_route == TRUE) {
            $this->form_validation->set_message('handle_productslug1', 'This URL Already Exist. We Prefer Auto URL.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /*
     * End of Edit Product
     */
    
    function editProducts2() {

        
        $ftype = '';

        $id = '';
        if (isset($_GET['id'])) {

            $id = $_GET['id'];
        }
        $this->data['wizard_id'] = '';

        $this->data['uniq_wizard_id'] = '';


        $this->data['product'] = $this->product_model->GetByRow('ec_products', $id, 'id');
        
        $this->data['prod_cat_row'] = $this->product_model->GetByRow('ec_category', $this->data['product']->parent_sub_id, 'id');


        $this->data['values'] = $this->uploadlibrary_model->Get_fileData();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('final_images', 'final_images', 'trim');
//        $this->form_validation->set_rules('final_images_b', 'final_images_b', 'trim');
        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'product/edit_product2', $this->data);
        } else {

            $product_update_id = $this->product_model->editProducts2($id);

            
            $this->session->set_flashdata('message', "Edited Successfully!..");
           

            $special_edit = '';

            $per_page = '';
            if (isset($_GET['per_page'])) {
                $per_page = '&per_page=' . $_GET['per_page'];
            }
            $shop_url = '';           

            redirect('ecproductadmin/editProducts3?id=' . $id . $per_page);

        }
    }

    function editProducts3() {

        $ftype = '';
        if (!empty($_GET['ftype'])) {
            $ftype = $_GET['ftype'];
        }


        $id = '';
        if (isset($_GET['id'])) {

            $id = $_GET['id'];
        }
        $this->data['wizard_id'] = '';
        if (isset($_GET['wiz'])) {

            $this->data['wizard_id'] = $_GET['wiz'];
        }
        $this->data['uniq_wizard_id'] = '';
        if (isset($_GET['uniq_wiz'])) {

            $this->data['uniq_wizard_id'] = $_GET['uniq_wiz'];
        }

        $this->data['product'] = $this->product_model->GetByRow('ec_products', $id, 'id');

        $this->data['prod_cat_row'] = $this->product_model->GetByRow('ec_category', $this->data['product']->parent_sub_id, 'id');


        $this->data['values'] = $this->uploadlibrary_model->Get_fileData();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('final_images', 'final_images', 'trim');
        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'product/edit_product3', $this->data);
        } else {

            $product_update_id = $this->product_model->editProducts3($id);            
            $this->session->set_flashdata('message', "Edited Successfully!..");          

            $special_edit = '';
            $per_page = '';
            if (isset($_GET['per_page'])) {
                $per_page = '&per_page=' . $_GET['per_page'];
            }
            $shop_url = '';  
            redirect('ecproductadmin/view_product?' . $per_page);
         }
    }

    function dynamic_wizards() {

        $ftype = '';
        if (!empty($_GET['ftype'])) {
            $ftype = $_GET['ftype'];
        }

        $id = '';
        if (isset($_GET['id'])) {

            $product_id = $_GET['id'];
        }
        $data['wizard_id'] = '';
        if (isset($_GET['wiz'])) {

            $data['wizard_id'] = $_GET['wiz'];
        }
        $data['uniq_wizard_id'] = '';
        if (isset($_GET['uniq_wiz'])) {

            $data['uniq_wizard_id'] = $_GET['uniq_wiz'];
        }
//        $data['wizard_id'] = $this->uri->segment(4);
//        $data['uniq_wizard_id'] = $this->uri->segment(5);
        //{oldoption}
        //$data['options'] = $this->product_model->get_options();
        //$data['option'] = $option_data = $data['options'][0];
        //{oldoption}

        $data['option'] = $option_data = $this->common_model->get_options();

        $data['product'] = $this->product_model->GetByRow('ec_products', $product_id, 'id');


//        $data['product'] = $this->product_model->GetByRow('ec_products', $product_id, 'id');
        $data['wizard_row'] = $this->product_model->GetByRow('ec_wizard', $data['wizard_id'], 'id');

//        $data['hide_product_type_id'] = 4;
//        $data['hide_array_diplay_prodcut'] = array(
//            'qty',
//            'original_price',
//            'discount_status',
//            'discount_type',
//            'discount_value',
//            'discount_text',
//            'selling_price',
//            'featured_products',
//            'healthyretail',
//            'combomenu',
//            'othermenu',
//            'deliverytime');

        $this->load->library('form_validation');
        $this->form_validation->set_rules('final_images', 'final_images', 'trim');
        $this->form_validation->set_rules('final_images_b', 'final_images_b', 'trim');
        $this->form_validation->set_rules('field_elements', 'field_elements', 'required');
        $this->form_validation->set_rules('final_value_set', 'final_value_set', 'required');

        if ($this->form_validation->run($this) == FALSE) {

            $this->template->load('admin', 'product/edit_product_wizard', $data);
        } else {

            $product_update_id = $this->product_model->dynamic_wizards($product_id, $option_data);
            $wiz_id = $this->product_model->dynamic_product_wizard($product_update_id);
            $product_wizards = json_decode($data['wizard_row']->product_wizard, TRUE);
            $wizard_group = json_decode($data['wizard_row']->wizard_group, TRUE);


            $this->common_model->product_qty_updation($product_update_id, 'qty');

            $this->common_model->ProductCalculation($product_update_id);

            $this->common_model->update_display_level($product_update_id);


            $this->session->set_flashdata('message', "Edited Successfully!..");
            $special_edit = '';
            if (isset($_POST['associate']) || isset($_POST['copy'])) {
                if (isset($_POST['associate'])) {
                    $special_edit = '&associate=' . $product_update_id;
                }

                if (isset($_POST['copy'])) {
                    $special_edit = '&copy=' . $product_update_id;
                }
            }
            $per_page = '';
            if (isset($_GET['per_page'])) {
                $per_page = '&per_page=' . $_GET['per_page'];
            }
            $shop_url = '';
            if ($ftype == 'shop') {
                $shop_url = '&ftype=shop';
            }
            if ($product_wizards != NULL) {
                $wiz_len = count($product_wizards);
                foreach ($product_wizards as
                        $key =>
                        $prod_wizard) {

                    $newkey = $key + 1;
                    $wizard_use_status = $this->product_model->findID_exist($wizard_group, 'wizard_item', $prod_wizard['order']);

                    if ($wizard_use_status == 'yes') {

                        $key_set = array_search($data['uniq_wizard_id'], array_column($product_wizards, 'order'));
                        $wiz_set_position = $product_wizards[$key_set]['wizard_position'];

                        if ($prod_wizard['order'] != $data['uniq_wizard_id'] && $wiz_set_position <= $newkey) {

                            redirect('ecproductadmin/dynamic_wizards?id=' . $product_id . $shop_url . '&wiz=' . $wiz_id . '&uniq_wiz=' . $prod_wizard['order'] . $per_page . $special_edit);
//                            redirect('ecproductadmin/dynamic_wizards/' . $product_id . '/' . $wiz_id . '/' . $prod_wizard['order'] . '/' . $this->uri->segment(6) . '/' . $this->uri->segment(7) . $special_edit);
                        }
                    }

                    if ($wiz_len == $newkey) {
                        redirect('ecproductadmin/view_product?' . $shop_url . $per_page);
                    }
                }
            }
        }
    }

    /*
     * Move to Trash Product
     * For using Trash these fields
     * 'trash_status' ,'date_deleted','date_restored'  [,'active_status'] 
     * must be present in table
     */

    function trash_product() {

        if (isset($_GET['id'])) {

            $id = $_GET['id'];
        }
        $this->product_model->TrashById('ec_products', $id, 'id');
        $route_type = 'product_item';
        $action_type = 'trash';
        $quick_link_type = 'product';
//        $this->common_model->quick_link_delete($id, $quick_link_type, $action_type);
        $this->route_model->routeTrashById('cms_routes', $id, 'slug_ref_id', $route_type);
        $this->route_model->save_routes($route_type);
        $this->session->set_flashdata('message', "Deleted Successfully!..");

        $uristrings = $_SERVER['QUERY_STRING'];
        if (isset($_GET['id'])) {

            $remove_seg3 = 'id=' . $_GET['id'] . '&';
            $newuristrings = str_replace($remove_seg3, '', $uristrings);
        }
        redirect('ecproductadmin/view_product?' . $newuristrings);
    }

    /*
     * End of Move to Trash Product
     */


    /*
     * View all Trash Product with pagination
     */

    function trash_view_product($sear = 0,
            $ftype = 0,
            $page_position = 0) {
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'ecproductadmin/trash_view_product/' . $sear . '/' . $ftype;
        $config['total_rows'] = $this->product_model->trash_count_all_product();
        $config['per_page'] = '1';
        $config['num_links'] = 5;
        $config['uri_segment'] = 5;
        $config['prev_link'] = 'Previous';
        $config['prev_tag_open'] = '';
        $config['prev_tag_close'] = '';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '';
        $config['next_tag_close'] = '';
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['view_items_list'] = $this->product_model->trash_list_product($config['per_page'], $page_position);
        $data['page_position'] = $page_position;
        $this->template->load('admin', 'product/trash_view_product', $data);
    }

    /*
     * End of Trash View all Product with pagination
     */

    /*
     * Restore from Trash Product
     * For using Restore Trash these fields
     * 'trash_status' ,'date_deleted','date_restored' [,'active_status'] 
     * must be present in table
     */

    function restore_product($id,
            $ftype) {

        $this->product_model->RestoreById('ec_products', $id, 'id');
        $route_type = 'product_item';
        $action_type = 'restore';
        $quick_link_type = 'product';
        $this->common_model->quick_link_delete($id, $quick_link_type, $action_type);
        $this->route_model->routeRestoreById('cms_routes', $id, 'slug_ref_id', $route_type);
        $this->route_model->save_routes($route_type);
        $this->session->set_flashdata('message', "Restored Successfully!..");
        redirect('ecproductadmin/trash_view_product/0/' . $ftype);
    }

    /*
     * End of Restore from Trash Product
     */

    /*
     * Delete Product
     */

    function delete_product($id,
            $ftype) {
        $delete_status = $this->common_model->DeleteById('ec_products', $id, 'id');
        if ($delete_status == TRUE) {
            $route_type = 'product_item';
            $action_type = 'delete';
            $quick_link_type = 'product';
            $this->common_model->quick_link_delete($id, $quick_link_type, $action_type);
            $this->route_model->routeDeleteById('cms_routes', $id, 'slug_ref_id', $route_type);
            $this->route_model->save_routes($route_type);
            $this->session->set_flashdata('message', "Deleted Successfully!..");
        } else {
            $this->session->set_flashdata('message', "This data can not be deleted.");
        }

        redirect('ecproductadmin/trash_view_product/0/' . $ftype);
    }

    /*
     * End of Delete Product
     */



    /*
     * Insert function of Special features 
     */

    function add_specialfeature() {


        $this->load->library('form_validation');
        $this->form_validation->set_rules('input_name', 'Feature Name', 'required');
        //$this->form_validation->set_rules('slug', 'Slug/Url name', 'required|callback_handle_unique_specialfeature_slug');
        $this->form_validation->set_rules('slug', 'Slug/Url name', 'required');
        $this->form_validation->set_rules('final_images', 'Category Picture', 'trim'); //Don't Delete this line to preserve set values

        if ($this->form_validation->run($this) == FALSE) {

            $data['values'] = $this->uploadlibrary_model->Get_fileData();
            $data['main_category_types'] = $this->product_model->load_main_category_types();
            $data['category_types'] = $this->product_model->load_category_types();
            $this->template->load('admin', 'product/add_specialfeature', $data);
        } else {

            $this->product_model->add_specialfeature();
            $this->session->set_flashdata('message', "Added Successfully!..");
            redirect('ecproductadmin/add_specialfeature?'.$_SERVER['QUERY_STRING']);
        }
    }

    function handle_unique_specialfeature_slug() {
        $ret = $this->product_model->select_by_specialfeature_slug();
        if ($ret) {
            $this->form_validation->set_message('handle_unique_specialfeature_slug', 'This Slug Already Exist!..');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /*
     * End of Insert function of Special features 
     */





    /*
     * View all  Special features with pagination
     */

    function view_specialfeature() {

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
        $config['base_url'] = base_url() . 'ecproductadmin/view_specialfeature?' . $urisegments;
        $config['total_rows'] = $this->product_model->count_all_specialfeature();
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
        $data['view_items_list'] = $this->product_model->list_specialfeature($config['per_page'], $offset);
        $data['page_position'] = $offset;
        $data['category_types'] = $this->product_model->get_load_category_types();
        $data['subcategory_types'] = $this->product_model->get_load_subcategory_types();
        $this->template->load('admin', 'product/view_specialfeature', $data);
    }

    /*
     * End of View all  Special_features  with pagination
     */



    /*
     * Edit Special_features
     */

    function edit_specialfeature($id) {
        $data['single_detail'] = $this->product_model->GetByRow('ec_product_attributes', $id, 'id');
        $data['values'] = $this->uploadlibrary_model->Get_fileData();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('input_name', 'Category Name', 'required');
        //  $this->form_validation->set_rules('slug', 'Slug/Url name', 'required|callback_handle_unique_specialfeature_slug1');
        $this->form_validation->set_rules('slug', 'Slug/Url name', 'required');
        $this->form_validation->set_rules('final_images', 'Feature Image', 'trim'); //Don't Delete this line to preserve set values

        if ($this->form_validation->run($this) == FALSE) {
            $data['main_category_types'] = $this->product_model->load_main_category_types();
            $data['category_types'] = $this->product_model->load_category_types();
            $this->template->load('admin', 'product/edit_specialfeature', $data);
        } else {

            $this->product_model->edit_specialfeature($id);
            $this->session->set_flashdata('message', "Edited Successfully!..");
            redirect('ecproductadmin/view_specialfeature?'.$_SERVER['QUERY_STRING']);
        }
    }

    function handle_unique_specialfeature_slug1() {
        $ret = $this->product_model->select_by_specialfeature_slug1();
        if ($ret) {
            $this->form_validation->set_message('handle_unique_specialfeature_slug1', 'The Entered Slug Already Exist!..');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /*
     * End of Edit Special_features
     */



    /*
     * Move to Trash Special_features
     * For using Trash these fields
     * 'trash_status' ,'date_deleted','date_restored'  [,'active_status'] 
     * must be present in table
     */

    function trash_specialfeature($id) {
        $this->product_model->TrashById('ec_product_attributes', $id, 'id');

        $prod_attr_details = $this->product_model->GetByRow('ec_product_attributes', $id, 'id');
        $prod_cat_details = $this->product_model->GetByRow('ec_categorytypes', $prod_attr_details->type, 'id');

        if ($prod_cat_details->save_database == 'yes') {
            $this->common_model->createProdAttrOptionArray('ec_product_attributes', $prod_cat_details->id, 'edit');
        }



        $this->session->set_flashdata('message', "Deleted Successfully!..");
        redirect('ecproductadmin/view_specialfeature/');
    }

    /*
     * End of Move to Trash Special_features
     */


    /*
     * View all Trash Special_features with pagination
     */

    function trash_view_specialfeature($sear = 0,
            $page_position = 0) {
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'ecproductadmin/trash_view_specialfeature/' . $sear;
        $config['total_rows'] = $this->product_model->trash_count_all_specialfeature();
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
        $data['view_items_list'] = $this->product_model->trash_list_specialfeature($config['per_page'], $page_position);
        $data['page_position'] = $page_position;
        $this->template->load('admin', 'product/trash_view_specialfeature', $data);
    }

    /*
     * End of Trash View all Special_features with pagination
     */

    /*
     * Restore from Trash Special_features
     * For using Restore Trash these fields
     * 'trash_status' ,'date_deleted','date_restored' [,'active_status'] 
     * must be present in table
     */

    function restore_specialfeature($id) {
        $this->product_model->RestoreById('ec_product_attributes', $id, 'id');

        $prod_attr_details = $this->product_model->GetByRow('ec_product_attributes', $id, 'id');
        $prod_cat_details = $this->product_model->GetByRow('ec_categorytypes', $prod_attr_details->type, 'id');

        if ($prod_cat_details->save_database == 'yes') {
            $this->common_model->createProdAttrOptionArray('ec_product_attributes', $prod_cat_details->id, 'edit');
        }


        $this->session->set_flashdata('message', "Restored Successfully!..");
        redirect('ecproductadmin/trash_view_specialfeature/');
    }

    /*
     * End of Restore from Trash Special_features
     */

    /*
     * Delete Special_features
     */

    function delete_specialfeature($id) {
        $delete_status = $this->common_model->DeleteById('ec_product_attributes', $id, 'id');
        if ($delete_status == TRUE) {
            $this->session->set_flashdata('message', "Deleted Successfully!..");
        } else {
            $this->session->set_flashdata('message', "This data can not be deleted.");
        }

        redirect('ecproductadmin/trash_view_specialfeature/');
    }

    /*
     * End of Delete Special_features
     */



    /* 28-07-2017
     * Author:Sinto
     * Use: get category list based on ctype 
     * 
     */

    function getcatlist() {

        $ctype = $this->input->post('ctype');
        if ($this->input->post('crid') != '') {

            $data['crid'] = $this->input->post('crid');
            $data['parent_id'] = $parent_id = $this->input->post('parent_id');
        } else {
            $data['crid'] = '';
            $data['parent_id'] = $parent_id = '';
        }
        $data['categorylist'] = $this->product_model->showcategory_classi($ctype);
        $catlist = $this->load->view('product/category_ctype', $data, true);
        echo $catlist;
    }

    /*
     * EOF  get category list based on ctype 
     */

    /*
     * Insert Full Data
     */

    function get_old_data() {

        $tb_product_list = $this->product_model->GetByResult_notrash('tb_product', 'id', 'ASC');
        foreach ($tb_product_list as
                $tb_product_key =>
                $tb_product_row) {
//            dump($tb_product_row);

            die();
        }
    }

    function get_old_cat_data() {
        $categorylist = $this->product_model->show_jewel_cats();
        foreach ($categorylist as
                $cat) {

            echo "<pre>" . $cat['id'] . "----";
            echo $cat['name'] . "</pre>";
        }
    }

    function get_new_cat_data() {
        $category_list = $this->product_model->showcategory_classi(1);
        foreach ($category_list as
                $cat) {
            echo "<pre>" . $cat['id'] . "----";
            echo $cat['name'] . "</pre>";
        }
    }

    function insert_full_data() {

        ini_set('max_execution_time', 0);
        $data['main_categories'] = $this->product_model->get_all_main_categories();
        $data['brand_categories'] = $this->product_model->get_all_main_brands();
        $data['product_type_categories'] = $this->product_model->get_all_product_type_categories();
        $data['product_type_product'] = $this->product_model->get_all_product_type_product();

        //{oldoption}
        //$data['options'] = $this->product_model->get_options();
        // $data['option'] = $data['options'][0];
        //{oldoption}

        $data['option'] = $this->common_model->get_options();

//        $tb_product_list = $this->product_model->GetByResult_notrash('tb_product', 'id', 'ASC');
//        foreach ($tb_product_list as $tb_product_key => $tb_product_row) {
//
//            $data['tb_product_row'] = $tb_product_row;
//            $id = $this->product_model->insert_from_product($data);
//
//
//        }
        $tb_product_row = $this->product_model->GetByRow('tb_product', 4, 'id');
        $data['tb_product_row'] = $tb_product_row;
        $id = $this->product_model->insert_from_product($data);


//        /*
//         * routing section
//         */
//        $route_chk_tble = 'ec_products';
//        $route_type = 'product_item';
//        $route_type1 = 'product_item_route';
//        $this->route_model->create_route($id, $route_chk_tble, $route_type, $route_type1);
//        $this->route_model->save_routes($route_type);
//        /*
//         * EOF routing section
//         */
    }

    /*
     * Insert Full Data
     */

    /** For User Merging * */
    function insert_user_data() {


        ini_set('max_execution_time', 0);

        $tb_user_list = $this->product_model->GetByResult_notrash('tb_users', 'id', 'ASC');

        foreach ($tb_user_list as
                $tb_user_key =>
                $tb_user_row) {
//            dump($tb_user_row);
            $data['tb_user_row'] = $tb_user_row;
            $id = $this->product_model->insert_user_data($data);
            // if ($tb_user_key == 0) {
            //   dump($id);
            //    die();
            // }
        }
    }

    function insert_user_meta_data() {

        ini_set('max_execution_time', 0);

        $tb_user_list = $this->product_model->GetByResult_notrash('tb_meta1', 'id', 'ASC');
        foreach ($tb_user_list as
                $tb_user_key =>
                $tb_user_row) {

            $data['tb_user_row'] = $tb_user_row;
            $id = $this->product_model->insert_user_meta_data($data);


            //dump($id);
//            if ($tb_user_key == 10) {
//                die();
//            }
        }
    }

    function insert_ec_orders_data() {

        ini_set('max_execution_time', 0);
//        $sample_data = $this->product_model->GetByRow('ec_orders', 14, 'id');
//        dump($sample_data);

        $data['tb_payment'] = $this->product_model->GetByResultArray_notrash('ec_payment_method', 'id', 'ASC');
//                dump($data['tb_payment']);
        $tb_user_list = $this->product_model->GetByResult_notrash('purchase_tb', 'id', 'DESC');
//        SELECT * FROM `purchase_tb` WHERE `order_id` > 0 AND `TransactionID` != '' ORDER BY `order_id` DESC
//        SELECT DISTINCT `status` FROM `purchase_tb` WHERE 1
//        $tb_user_list = $this->product_model->GetByPurchaseResult_notrash('purchase_tb', 'id', 'DESC', '21');
        foreach ($tb_user_list as
                $tb_user_key =>
                $tb_user_row) {

            $data['tb_user_row'] = $tb_user_row;
            $id = $this->product_model->insert_ec_orders_data($data);


            //dump($id);
//            if ($tb_user_key == 0) {
//                die();
//            }
        }
    }

    function insert_ec_order_list_data() {
        ini_set('max_execution_time', 0);

//        $sample_data = $this->product_model->GetByRow('ec_order_list', 14, 'ec_orders_id');
//        dump($sample_data);
//                dump($data['tb_payment']);
        $tb_user_list = $this->product_model->GetByResult_notrash('tb_purchase', 'id', 'DESC');
//        SELECT * FROM `purchase_tb` WHERE `order_id` > 0 AND `TransactionID` != '' ORDER BY `order_id` DESC
//        SELECT DISTINCT `status` FROM `purchase_tb` WHERE 1
//        $tb_user_list = $this->product_model->GetByPurchaseResult_notrash('tb_purchase', 'pid', 'DESC', '6096');
        foreach ($tb_user_list as
                $tb_user_key =>
                $tb_user_row) {

            $data['tb_user_row'] = $tb_user_row;
            $id = $this->product_model->insert_ec_order_list_data($data);


            //dump($id);
//            if ($tb_user_key == 0) {
//                die();
//            }
        }
    }

    function checkorder_data() {
        ini_set('max_execution_time', 0);
        $timeline_first_order_status = $this->product_model->GetByResult('ec_cart_order_status', 'status_order', 'ASC');
//        dump($timeline_first_order_status);
//        dump($timeline_first_order_status[0]->id);
    }

    /** For User Merging * */
    /* for user address merging */

    public function insertUserAddress() {
        ini_set('max_execution_time', 0);
        $ec_orders_adress = $this->product_model->GetByResult_notrash('ec_orders', 'id', 'ASC');
        if ($ec_orders_adress != NULL) {
            foreach ($ec_orders_adress as
                    $ec_adrr =>
                    $ec_orders_adrr) {

                $data['ec_orders_adrr'] = $ec_orders_adrr;
                $addrr_count = $this->product_model->checkaddrExist($data);
                if ($addrr_count == 0) {

                    if ($ec_orders_adrr->billing_address == $ec_orders_adrr->shipping_address) {
                        $this->product_model->insertBillUserAddress($data);
                    } else {
                        $this->product_model->insertBillUserAddress($data);
                        $this->product_model->insertShipUserAddress($data);
                    }
                }
            }
        }

        $ec_orders_adress = $this->product_model->group_user_adresses();

        if ($ec_orders_adress != NULL) {
            foreach ($ec_orders_adress as
                    $ecaddr) {
                $this->product_model->upUserAddress($ecaddr);
            }
        }
    }

    /* EOF for user address merging */


    /* product route updation */

    function productSlugUpdate() {
        ini_set('max_execution_time', 0);
        $ec_products = $this->product_model->GetByResult_notrash('ec_products', 'id', 'DESC');
        if ($ec_products != '') {
            foreach ($ec_products as
                    $products) {
                $data['products'] = $products;
                $this->product_model->productSlugUpdate($data);
            }
        }
    }

    /* EOf product route updation */

    function productcalculation_onform($id) {
        $product_update_id = $this->product_model->dynamic_wizards($id);
        $this->common_model->ProductCalculation($product_update_id);
        $productdata = $this->product_model->GetByRow('ec_products', $product_update_id, 'id');
        echo json_encode($productdata);
    }

    function productShortDescriptionUpdate() {
        ini_set('max_execution_time', 0);
        $ec_products = $this->product_model->GetByResult_notrash('ec_products', 'id', 'DESC');
        if ($ec_products != '') {
            foreach ($ec_products as
                    $products) {
                $short_description = $products->prod_short_description;
                $detail_description = trim(strip_tags($products->prod_brief_description));
                if ($short_description !== '0' || $short_description !== '') {
                    $tabledata = array(
                        'prod_short_description' => $detail_description,
                    );
                    $this->db->where('id', $products->id);
                    $this->db->update('ec_products', $tabledata);
                }
            }
        }
    }

    function downloadproductlist() {
        ini_set('max_execution_time', 0);

        //{oldoption}
        //$options = $this->common_model->get_options();
        // $data['option'] = $option = $options[0];
        //{oldoption}

        $data['option'] = $option = $this->common_model->get_options();


        $filename = "product_list-" . date('d-m-Y');

        $ec_products = $this->common_model->GetLiveProducts('ec_products', 'id', 'DESC');
        $product_excel_columns_list = explode('+', $option->product_excel_columns);
        array_pop($product_excel_columns_list);
        array_shift($product_excel_columns_list);

        $fielddata = array();
        $file_ending = "xls";
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=$filename.xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        /*         * *****Start of Formatting for Excel****** *///define separator (defines columns in excel & tabs in word)
        $sep = "\t";

        foreach ($product_excel_columns_list as
                $prod_col_name) {

            $get_common_input_column_array = $this->common_model->GetValueFromCommonInputsByProductColumnName($prod_col_name, $data);
            $fielddata = $this->common_model->array_push_assoc($fielddata, $prod_col_name, $get_common_input_column_array["column_name_as_label"]);
        }
        foreach ($fielddata as
                $key =>
                $value) {
            echo $value . "\t";
        }
        print("\n");
        foreach ($ec_products as
                $key =>
                $ec_product_row) {
            $schema_insert = "";
            $ec_categorytypes = "";
            $attr_element_field_value = "";
            foreach ($product_excel_columns_list as
                    $prod_col_name) {

                $data['existing_table'] = $ec_product_row;
                switch ($prod_col_name) {
                    case 'product_type2':
                        $ec_categorytypes = $this->common_model->GetByRow_notrash('ec_categorytypes', $ec_product_row->$prod_col_name, 'id');
                        $attr_element_field_value = $ec_categorytypes->name;
                        break;

                    case 'product_categorytype_id':
                        $ec_categorytypes = $this->common_model->GetByRow_notrash('ec_categorytypes', $ec_product_row->$prod_col_name, 'id');
                        $attr_element_field_value = $ec_categorytypes->name;
                        break;

                    default:
                        $attr_element_field_value = $this->common_model->GetProductValueFromCommonInputsData($prod_col_name, $data);
                        break;
                }

                $schema_insert .= $attr_element_field_value . $sep;
            }
            $schema_insert = str_replace($sep . "$", "", $schema_insert);
            $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
            $schema_insert .= "\t";
            print(trim($schema_insert));
            print "\n";
        }
    }

    function update_ec_order_list_character_data() {
        ini_set('max_execution_time', 0);


        $conditional_array = array(
            'merge_type' => 'old',
        );
        $ec_orders = $this->common_model->GetByReturnTypeOrderType('ec_orders', 'id', 'ASC', $conditional_array, 'result');

        if ($ec_orders != FALSE) {
            foreach ($ec_orders as
                    $ec_orders_row) {
                $order_character_type_tree = "+";
                $product_categorytype_id_tree = "+";
                $conditional_array = array(
                    'ec_orders_id' => $ec_orders_row->id
                );
                $ec_orders_list = $this->common_model->GetByReturnTypeOrderType('ec_order_list', 'id', 'ASC', $conditional_array, 'result');
                if ($ec_orders_list != FALSE) {
                    foreach ($ec_orders_list as
                            $ec_orders_list_value) {
                        $conditional_array = array(
                            'id' => $ec_orders_list_value->product_id,
                        );
                        $product_r = $this->common_model->GetByReturnTypeOrderType('ec_products', 'id', 'ASC', $conditional_array, 'row');
                        if ($product_r != FALSE) {
                            if (in_array($product_r->product_type2, $this->common_model->gift_product_type2)) {
                                $order_character_type_tree = $order_character_type_tree . 'gift_card+';
                            } else {
                                $order_character_type_tree = $order_character_type_tree . 'normal+';
                            }

                            $product_categorytype_id_tree = $product_categorytype_id_tree . $product_r->product_categorytype_id . '+';
                        }
                    }
                }

                $data_order_update = array(
                    'order_character_type_tree' => $order_character_type_tree,
                    'product_categorytype_id_tree' => $product_categorytype_id_tree,
                );
                $this->db->where('id', $ec_orders_row->id);
                $this->db->update('ec_orders', $data_order_update);
            }
        }
        echo "Finished Execution";
    }

    function category_discount() {
        ini_set('max_execution_time', 0);
        $data['category_type_list'] = $this->product_model->select_all_category_types();
        $data['main_categories'] = $this->product_model->get_all_main_categories();

        $this->load->library('form_validation');
        $this->form_validation->set_rules('discount', 'Discount', 'required');

        if ($this->form_validation->run($this) == FALSE) {

            $this->template->load('admin', 'product/category_discount', $data);
        } else {

            $this->product_model->category_discount();

            $this->session->set_flashdata('message', "Added Successfully!..");
            redirect('ecproductadmin/category_discount/');
        }
    }

    function insert_ec_order_product_full_info_json_list_data($idfrom = '',
            $idto = '') {
        ini_set('max_execution_time', 0);

        $conditional_array = array(
            'merge_type' => 'old',
        );
        if ($idfrom != '') {
            $conditional_array = $this->common_model->array_push_assoc($conditional_array, 'id >', $idfrom);

            if ($idto != '') {
                $conditional_array = $this->common_model->array_push_assoc($conditional_array, 'id < ', $idto);
            }
        }

        $tb_user_list = $this->common_model->GetByReturnTypeOrderType('ec_order_list', 'id', 'ASC', $conditional_array, $returntype = 'result');

        foreach ($tb_user_list as
                $tb_user_key =>
                $tb_user_row) {
            $data['tb_user_row'] = $tb_user_row;
            $id = $this->product_model->insert_ec_order_product_full_info_json_list_data($data);
        }
        echo "Finished Execution";
    }

    /*
     * Main category types manage section
     * 25-10-2018
     */

    function add_main_category_type() {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('category_type_name', 'main type key', 'required');
        $this->form_validation->set_rules('category_type_value', 'main type value', 'required|callback_handle_unique_main_val');

        if ($this->form_validation->run($this) == FALSE) {

            $this->template->load('admin', 'product/main_category_type/add_main_categorytype');
        } else {

            $this->product_model->add_main_category_type();
            $this->session->set_flashdata('message', "Added Successfully!..");
            redirect('ecproductadmin/add_main_category_type/');
        }
    }

    function handle_unique_main_val() {
        $ret = $this->product_model->select_main_val();
        if ($ret) {
            $this->form_validation->set_message('handle_unique_main_val', 'Category Type Value Already Exist!..');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function view_main_category_type($page_position = 0) {
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'ecproductadmin/view_main_category_type/';
        $config['total_rows'] = $this->product_model->count_main_category_type();
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
        $data['view_items_list'] = $this->product_model->list_main_category_type($config['per_page'], $page_position);
        $data['page_position'] = $page_position;
        $this->template->load('admin', 'product/main_category_type/view_main_category_type', $data);
    }

    function edit_main_categorytype($id) {

        $data['single_detail'] = $this->product_model->GetByRow('ec_categorytypes', $id, 'id');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('category_type_name', 'main type key', 'required');
        $this->form_validation->set_rules('category_type_value', 'main type value', 'required|callback_handle_unique_main_val_edit');

        if ($this->form_validation->run($this) == FALSE) {

            $this->template->load('admin', 'product/main_category_type/edit_main_category_type', $data);
        } else {

            $this->product_model->edit_main_categorytype($id);
            $this->session->set_flashdata('message', "Edited Successfully!..");
            redirect('ecproductadmin/view_main_category_type/');
        }
    }

    function handle_unique_main_val_edit() {
        $ret = $this->product_model->select_main_val_edit();
        if ($ret) {
            $this->form_validation->set_message('handle_unique_main_val_edit', 'Category Type Value Already Exist!..');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function trash_main_category_type($id) {
        $this->product_model->TrashById('ec_categorytypes', $id, 'id');
        $this->session->set_flashdata('message', "Deleted Successfully!..");
        redirect('ecproductadmin/view_main_category_type/');
    }

    function trash_view_main_category_type($page_position = 0) {
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'ecproductadmin/trash_view_main_category_type/';
        $config['total_rows'] = $this->product_model->trash_count_all_main_category_type();
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
        $data['view_items_list'] = $this->product_model->trash_list_main_category_type($config['per_page'], $page_position);
        $data['page_position'] = $page_position;
        $this->template->load('admin', 'product/main_category_type/trash_view_main_category_type', $data);
    }

    function restore_main_category_type($id) {
        $this->product_model->RestoreById('ec_categorytypes', $id, 'id');
        $this->session->set_flashdata('message', "Restored Successfully!..");
        redirect('ecproductadmin/trash_view_main_category_type/');
    }

    function delete_main_category_type($id) {
        $this->product_model->DeleteById('ec_categorytypes', $id, 'id');
        $this->session->set_flashdata('message', "Deleted Successfully!..");
        redirect('ecproductadmin/trash_view_main_category_type/');
    }

    /*
     * EOF Main category types manage section
     */

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
            $_SESSION['check_status'] = $session_val;
            echo $checked_ids = $this->product_model->get_full_product();
        } else if ($session_val == 'uncheckall') {
            $_SESSION['check_status'] = '';
            echo $checked_ids = '*****';
        } else if ($session_val == 'custom') {
            $_SESSION['check_status'] = $session_val;
            $check_type = $this->input->post('check_type');
            $check_id = $this->input->post('check_id');
            $all_ids = $this->input->post('all_ids');
            echo $checked_ids = $this->product_model->custom_check_id($check_type, $check_id, $all_ids);
        }

        $get_split = explode('*****', $checked_ids);

        $_SESSION['checked_ids'] = $get_split[0];
        $_SESSION['checked_count'] = $get_split[1];
    }

    function delete_opertion() {
        $delete_opr = $this->input->post('delete_opr');
        $all_prod_ids = json_decode($this->input->post('all_prod_ids'), true);
        $seg3 = $this->input->post('seg3');
        $seg4 = $this->input->post('seg4');
        $seg5 = $this->input->post('seg5');
        $seg6 = $this->input->post('seg6');
        switch ($delete_opr) {
            case 'delete':

                foreach ($all_prod_ids as
                        $prod_id) {
                    $this->product_model->trash_product($prod_id);
                }

                $this->session->set_flashdata('message', "Deleted Successfully!..");

                break;

            case 'deactivate':

                foreach ($all_prod_ids as
                        $prod_id) {
                    $this->product_model->product_deactivate_activate($prod_id, $delete_opr);
                    $this->common_model->product_qty_updation($prod_id, 'status');
                }
                $this->session->set_flashdata('message', "Deactivated Successfully!..");
                break;

            case 'activate':
                foreach ($all_prod_ids as
                        $prod_id) {
                    $this->product_model->product_deactivate_activate($prod_id, $delete_opr);
                    $this->common_model->product_qty_updation($prod_id, 'status');
                }
                $this->session->set_flashdata('message', "Activated Successfully!..");
                break;
        }

        $_SESSION['checked_ids'] = '';
        $_SESSION['checked_count'] = '';
        $_SESSION['check_status'] = '';
    }

    /*
     * EOF Bulk delete functions
     */

    function resize_prod_img() {

        $this->product_model->resize_prod_img();
    }

    function discount_value_checking() {
        $discount_value = $this->input->post('discount_val');
        $discount_type = $this->input->post('discount_type');
        $original_price = $this->input->post('original_price');
        $discount_type_row = $this->common_model->GetByRow("ec_product_attributes", $discount_type, 'id');
        $selling_price = $original_price;
        if ($discount_type_row->fixed_status == "yes" && $discount_type_row->fixed_type == "percentage") {
            $price_diff_in_amount = $original_price * ($discount_value / 100);
            $price_diff_in_percentage = $discount_value;
            $selling_price_check = $original_price - $price_diff_in_amount;
            if ($selling_price_check > 0) {
                $selling_price = $selling_price_check;
            } else {
                $selling_price = '0';
            }
        }
        if ($discount_type_row->fixed_status == "yes" && $discount_type_row->fixed_type == "amount") {
            $price_diff_in_amount = $discount_value;
            $price_diff_in_percentage = $discount_value / ($original_price / 100);
            $selling_price_check = $original_price - $price_diff_in_amount;
            if ($selling_price_check > 0) {
                $selling_price = $selling_price_check;
            } else {
                $selling_price = '0';
            }
        }

        echo $selling_price;
    }

    function get_current_loc_data() {

        $row_id = $this->input->post('row_id');
        $data['single_detail'] = $this->product_model->GetByRow('ec_category', $row_id, 'id');
        $data['loc_data'] = $loc_data = $this->input->post('loc_data');
        $this->load->view('product/include/location_block', $data);
    }

    function remove_product_related_item() {
        $content_id = $this->input->post('content_id');
        $this->product_model->TrashById('cms_media', $content_id, 'id');
    }
	

function dofulltree()
{


$all_products = $this->db->get('ec_products')->result();

foreach($all_products as $row)
{


//
$full_category_id_tree = $row->full_category_id_tree.$row->brandidtree;
$full_category_id_tree = explode('+',$full_category_id_tree);
$full_category_id_tree = array_filter($full_category_id_tree);
$full_category_id_tree = '+'.implode('+',$full_category_id_tree).'+';
//

	$data3 = array(
	'full_category_id_tree' => $full_category_id_tree,
	);
	
	$this->db->where('id', $row->id);
	$this->db->update('ec_products', $data3);



}
	
	
}

    function add_service() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('service_name', 'Name', 'required');
        $this->form_validation->set_rules('order_number', 'Order number', 'required');
        $this->form_validation->set_rules('final_images', 'final_images', 'trim');
        $this->form_validation->set_rules('event_code', 'Code', 'required');
        
        $data['values1'] = array();

        $data['event_sku'] = "EVENT" . $this->common_model->get_rand_alphanumeric(4);

        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'product/add_service', $data);
        } else {
            $this->product_model->addService();
            $this->session->set_flashdata('message', "Added Successfully!..");
            redirect('ecproductadmin/add_service');
        }
    }
    
    function view_services(){
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
        $config['base_url'] = base_url() . 'ecproductadmin/view_services?' . $urisegments;
        $config['total_rows'] = $this->product_model->countAllServices();
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
        
        $data['view_items_list'] = $this->product_model->listAllServices($config['per_page'], $offset);
        $data['page_position'] = $offset;
        $this->template->load('admin', 'product/view_services', $data);
        
    }
    
    function edit_service(){
        $id = '';
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('service_name', 'Name', 'required');
        $this->form_validation->set_rules('order_number', 'Order number', 'required');
        $this->form_validation->set_rules('event_code', 'Code', 'required');

        $data['single_detail'] = $single_detail = $this->product_model->GetByRow('ec_services', $id, 'id');
        
        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'product/edit_service', $data);
        }else{
            $this->product_model->editService($id);
            $this->session->set_flashdata('message', "Updated Successfully!..");
            redirect('ecproductadmin/view_services');
        }
    }

    function add_ticket_type(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('ticket_name', 'Name', 'required');
        $this->form_validation->set_rules('order_number', 'Order number', 'required');
        $this->form_validation->set_rules('ticket_code', 'Code', 'required');
        $this->form_validation->set_rules('category', 'Event', 'required');

        $data['values1'] = array();
        $data['ticket_sku'] = "TKT" . $this->common_model->get_rand_alphanumeric(4);
        $data['events_list'] = $this->product_model->getAllEvents();

        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'product/add_ticket_type', $data);
        } else {
            $this->product_model->addTicketType();
            $this->session->set_flashdata('message', "Added Successfully!..");
            redirect('ecproductadmin/view_ticket_types');
        }
    }

    function view_ticket_types(){
        $urisegments = $_SERVER['QUERY_STRING'];
        $offset = 0;

        if (isset($_GET['per_page'])) {
            $remove_segment = '&per_page=' . $_GET['per_page'];
            $urisegments = str_replace($remove_segment, '', $urisegments);
            // $urisegments = str_replace('&&', '&', $urisegments);
            if ($_GET['per_page'] != '') {
                $offset = $_GET['per_page'];
            } else {
                $offset = 0;
            }
        }

        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'ecproductadmin/view_ticket_types?' . $urisegments;
        $config['total_rows'] = $this->product_model->countAllTicketTypes();
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

        $data['view_items_list'] = $this->product_model->listAllTicketTypes($config['per_page'], $offset);
        $data['page_position'] = $offset;
        $this->template->load('admin', 'product/view_ticket_types', $data);
    }

    function edit_ticket_type(){
        $id = '';
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('ticket_name', 'Name', 'required');
        $this->form_validation->set_rules('order_number', 'Order number', 'required');
        $this->form_validation->set_rules('ticket_code', 'Code', 'required');
        $this->form_validation->set_rules('category', 'Event', 'required');

        $data['events_list'] = $this->product_model->getAllEvents();

        $data['single_detail'] = $single_detail = $this->product_model->GetByRow('ec_services', $id, 'id');

        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'product/edit_ticket_type', $data);
        }else{
            $this->product_model->editTicketType($id);
            $this->session->set_flashdata('message', "Updated Successfully!..");

            redirect('ecproductadmin/view_ticket_types');
        }
    }

    function add_package(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('package_name', 'Name', 'required');
        $this->form_validation->set_rules('order_number', 'Order number', 'required');
        $this->form_validation->set_rules('final_images', 'final_images', 'trim');
        $this->form_validation->set_rules('package_code', 'Code', 'required');

        // $this->form_validation->set_rules('price', 'Price', 'required');

        // $this->form_validation->set_rules('category', 'Service', 'required');

        $data['values1'] = array();

        $data['package_sku'] = "EVENT" . $this->common_model->get_rand_alphanumeric(4);

        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'product/add_package', $data);
        } else {
            $this->product_model->addPackage();

            $this->session->set_flashdata('message', "Added Successfully!..");
            redirect('ecproductadmin/add_package');

        }
    }

    function view_packages(){
        $urisegments = $_SERVER['QUERY_STRING'];
        $offset = 0;

        if (isset($_GET['per_page'])) {
            $remove_segment = '&per_page=' . $_GET['per_page'];
            $urisegments = str_replace($remove_segment, '', $urisegments);
            // $urisegments = str_replace('&&', '&', $urisegments);
            if ($_GET['per_page'] != '') {
                $offset = $_GET['per_page'];
            } else {
                $offset = 0;
            }
        }

        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'ecproductadmin/view_packages?' . $urisegments;
        $config['total_rows'] = $this->product_model->countAllPackages();
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

        $data['view_items_list'] = $this->product_model->listAllPackages($config['per_page'], $offset);

        $data['page_position'] = $offset;
        $this->template->load('admin', 'product/view_packages', $data);

    }

    function edit_package(){
        $id = '';
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('package_name', 'Name', 'required');
        $this->form_validation->set_rules('order_number', 'Order number', 'required');
        $this->form_validation->set_rules('final_images', 'final_images', 'trim');
        $this->form_validation->set_rules('package_code', 'Code', 'required');

        // $this->form_validation->set_rules('price', 'Price', 'required');

        $data['single_detail'] = $single_detail = $this->product_model->GetByRow('ec_services', $id, 'id');

        if ($this->form_validation->run($this) == FALSE) {
            $this->template->load('admin', 'product/edit_package', $data);
        } else {
            $this->product_model->editPackage($id);

            $this->session->set_flashdata('message', "Updated Successfully!..");
            redirect('ecproductadmin/view_packages');
        }

    }

}
