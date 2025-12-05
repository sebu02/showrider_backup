<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
class Store_model extends CI_Model {

    function __construct() {
        parent::__construct();
        //$this->output->enable_profiler(TRUE);
        $this->prod_arr = array();
        $this->load->model('common_model');

        $this->tree = array();
        $this->parent = '';
        $this->arr = array();
        $this->arr2 = array();
        $this->arrz = array();
        $this->arrs = array();
        $this->arrow = '|';
        $this->arrzz = array();

    }

    function get_location_types() {
        $this->db->where("trash_status", 'no');
        $this->db->where("active_status", 'a');
        $this->db->where("parent_id", 0);
        $query = $this->db->get("cms_location_types");
        $data = $query->result();
        foreach ($data as $d) {

            $this->prod_arr[] = array('name' => $d->location_type, 'id' => $d->id);

            $this->sub_cat($d->id);
        }
//        print_r($this->prod_arr);
//        die();
        return $this->prod_arr;
    }

    function sub_cat($id, $dash = '') {
        $dash .= "__";
        $this->db->where("trash_status", 'no');
        $this->db->where("active_status", 'a');
        $this->db->where("parent_id", $id);
        $query = $this->db->get("cms_location_types");
        $data1 = $query->result();
        foreach ($data1 as $d) {
            $this->prod_arr[] = array('name' => $dash . $d->location_type, 'id' => $d->id);
            $this->sub_cat($d->id, $dash);
        }
    }

    function add_location_type() {



        $location_type_data = array(
            'location_type' => $this->input->post('location_type'),
            'location_key' => $this->input->post('location_key'),
            'order_no' => $this->input->post('order_no'),
            'parent_id' => $this->input->post('parent_id'),
            'trash_status' => 'no',
            'active_status' => 'a'
        );

        $this->db->insert('cms_location_types', $location_type_data);

        $catid_val = $this->db->insert_id();
        $table = 'cms_location_types';

        if ($this->input->post('parent_id') != 0) {

            $get_val = $this->common_model->pass_tree_values($this->input->post('parent_id'), $catid_val, $table, 'category');

            $data2 = array(
                'location_id_tree' => $get_val['category_ids'],
            );
        } else {

            $get_val = $this->common_model->pass_tree_values($catid_val, $catid_val, $table, 'category');

            $data2 = array(
                'location_id_tree' => $get_val['category_ids'],
            );
        }

        $this->db->where('id', $catid_val);
        $this->db->update('cms_location_types', $data2);


        return $catid_val;
    }

    function location_key_check() {
        $test = $this->input->post('location_key');
        $this->db->where('location_key', $test);
        $query = $this->db->get('cms_location_types');
        return $query->result();
    }

    function location_key_check1() {

        if (isset($_GET['id'])) {

            $id = $_GET['id'];
        }


        $test = $this->input->post('location_key');
        $this->db->where('id !=', $id);
        $this->db->where('location_key', $test);
        $query = $this->db->get('cms_location_types');
        return $query->result();
    }

    function count_all_location_types() {

        if (isset($_GET['seg3'])) {

            $sess_val = $_GET['seg3'];
            $s_a = str_replace("_sbn_", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('location_type', $s_a);
        }


        $this->db->where('trash_status', 'no');
//$this->db->where('active_status', 'a');

        $val = $this->db->get('cms_location_types');
        return $val->num_rows();
    }

    function list_location_types($perpage, $rec_from) {
        if (isset($_GET['seg3'])) {

            $sess_val = $_GET['seg3'];
            $s_a = str_replace("_sbn_", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('location_type', $s_a);
        }


        $this->db->order_by('id', 'ASC');
        $this->db->where('trash_status', 'no');
//$this->db->where('active_status', 'a');

        $this->db->limit($perpage, $rec_from);
        return $this->db->get('cms_location_types')->result();
    }

    function edit_location_type($id) {

        $location_type_data = array(
            'location_type' => $this->input->post('location_type'),
            'location_key' => $this->input->post('location_key'),
            'order_no' => $this->input->post('order_no'),
            'parent_id' => $this->input->post('parent_id'),
            'trash_status' => 'no',
            'active_status' => $this->input->post('active_status')
        );


        $this->db->where('id', $id);
        $this->db->update('cms_location_types', $location_type_data);

        $table = 'cms_location_types';


        if ($this->input->post('parent_id') != 0) {

            $get_val = $this->common_model->pass_tree_values($this->input->post('parent_id'), $id, $table, 'category');


            $data2 = array(
                'location_id_tree' => $get_val['category_ids'],
            );
        } else {

            $get_val = $this->common_model->pass_tree_values($id, $id, $table, 'category');

            $data2 = array(
                'location_id_tree' => $get_val['category_ids'],
            );
        }

        $this->db->where('id', $id);
        $this->db->update('cms_location_types', $data2);
    }

    function count_all_trash_location_types() {

        if (isset($_GET['seg3'])) {

            $sess_val = $_GET['seg3'];
            $s_a = str_replace("_sbn_", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('location_type', $s_a);
        }


        $this->db->where('trash_status', 'yes');
        $this->db->order_by('date_deleted', 'DESC');

        $val = $this->db->get('cms_location_types');
        return $val->num_rows();
    }

    function list_trash_location_types($perpage, $rec_from) {
        if (isset($_GET['seg3'])) {

            $sess_val = $_GET['seg3'];
            $s_a = str_replace("_sbn_", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('location_type', $s_a);
        }


        $this->db->where('trash_status', 'yes');
        $this->db->order_by('date_deleted', 'DESC');

        $this->db->limit($perpage, $rec_from);
        return $this->db->get('cms_location_types')->result();
    }

    function geturiarrays($segmentarrays, $seg) {

        $seg = '&' . $seg . '=';
        unset($segmentarrays[$seg]);

        $newurlvals = '';
        foreach ($segmentarrays as $segkey => $segval) {

            $newurlvals = $newurlvals . $segkey . $segval;
        }


        return $newurlvals;
    }

    function add_location() {

        $location_data = array(
            'location_type_id' => $this->input->post('location_type_id'),
            'location' => $this->input->post('location'),
            'location_code' => $this->input->post('location_code'),
            'uniq_location_name' => $this->input->post('uniq_location_name'),
            'parent_id' => $this->input->post('parent_id'),
            'main_parent_id' => $this->input->post('main_parent_id'),
            'location_id_tree' => $this->input->post('parent_id_tree'),
			'deliverybyamount' => $this->input->post('location_deliverybyamount'),
            'trash_status' => 'no',
            'active_status' => 'a'
        );

        $this->db->insert('cms_locations', $location_data);
        $loc_id = $this->db->insert_id();
        $table = 'cms_locations';

        if ($this->input->post('parent_id') != 0) {
//            $loc_id_tree = $this->input->post('parent_id_tree');
//            $loc_id_tree = $loc_id_tree . $loc_id . '+';
//            $location_data2 = array(
//                'location_id_tree' => $loc_id_tree
//            );
            $get_val = $this->common_model->pass_tree_values($this->input->post('parent_id'), $loc_id, $table, 'category');

            $location_data2 = array(
                'location_id_tree' => $get_val['category_ids'],
            );
        } else {
//            $loc_id_tree = '+' . $loc_id . '+';
//            $location_data2 = array(
//                'location_id_tree' => $loc_id_tree
//            );
            $get_val = $this->common_model->pass_tree_values($loc_id, $loc_id, $table, 'category');

            $location_data2 = array(
                'location_id_tree' => $get_val['category_ids'],
            );
        }


        $this->db->where('id', $loc_id);
        $this->db->update('cms_locations', $location_data2);
    }

    function get_location_dropdown($location_id, $loaction_type_id) {


        $this->db->where("trash_status", 'no');
        $this->db->where("active_status", 'a');
        $this->db->where("parent_id", $location_id);
        $this->db->where("location_type_id !=", $loaction_type_id);
        $query = $this->db->get("cms_locations");

        return $query->result();
    }

    function get_country_dropdown($lid, $pid) {

//        echo $pid;die();
        $this->db->where("trash_status", 'no');
        $this->db->where("active_status", 'a');
        $this->db->where("location_type_id", $lid);
        $query = $this->db->get("cms_locations");
        $query->result();

//        print_r($data);

        return $query->result();
    }

    function unique_location_name_check() {

        $uniq_location_name = $this->input->post('uniq_location_name');

        $type = $this->input->post('type');
        if ($type = 'edit') {
            $id = $this->input->post('id');
            $this->db->where('id !=', $id);
        }
        $this->db->where("trash_status", 'no');
        $this->db->where("active_status", 'a');

        $this->db->where("uniq_location_name", $uniq_location_name);
        $query = $this->db->get("cms_locations");

        $result = $query->row();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function count_all_location() {

        if (isset($_GET['seg3'])) {

            $sess_val = $_GET['seg3'];
            $s_a = str_replace("_sbn_", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('location', $s_a);
//            $this->db->or_like('location_id_tree', '+'.$s_a.'+');
        }


        $this->db->where('trash_status', 'no');

        $val = $this->db->get('cms_locations');
        return $val->num_rows();
    }

    function list_location($perpage, $rec_from) {

        if (isset($_GET['seg3'])) {

            $sess_val = $_GET['seg3'];
            $s_a = str_replace("_sbn_", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('location', $s_a);
//            $this->db->or_like('location_id_tree', '+'.$s_a.'+');
        }


        $this->db->order_by('id', 'ASC');
        $this->db->where('trash_status', 'no');
//$this->db->where('active_status', 'a');

        $this->db->limit($perpage, $rec_from);
        return $this->db->get('cms_locations')->result();
    }

    function count_all_trash_location() {

        if (isset($_GET['seg3'])) {

            $sess_val = $_GET['seg3'];
            $s_a = str_replace("_sbn_", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('location', $s_a);
        }


        $this->db->where('trash_status', 'yes');
        $this->db->order_by('date_deleted', 'DESC');

        $val = $this->db->get('cms_locations');
        return $val->num_rows();
    }

    function list_trash_location($perpage, $rec_from) {
        if (isset($_GET['seg3'])) {

            $sess_val = $_GET['seg3'];
            $s_a = str_replace("_sbn_", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('location', $s_a);
        }


        $this->db->where('trash_status', 'yes');
        $this->db->order_by('date_deleted', 'DESC');

        $this->db->limit($perpage, $rec_from);
        return $this->db->get('cms_locations')->result();
    }

    function get_locations_by_type_id($type_id) {

        $this->db->where("trash_status", 'no');
        $this->db->where("active_status", 'a');
        $this->db->where("location_type_id", $type_id);
        $query = $this->db->get("cms_locations");

        return $query->result();
    }

    function edit_location() {

        $parent_id = $this->input->post('parent_id');
        $id = $this->input->post('id');

        $location_data = array(
            'location_type_id' => $this->input->post('location_type_id'),
            'location' => $this->input->post('location'),
            'location_code' => $this->input->post('location_code'),
            'uniq_location_name' => $this->input->post('uniq_location_name'),
            'parent_id' => $this->input->post('parent_id'),
            'main_parent_id' => $this->input->post('main_parent_id'),
            'location_id_tree' => $this->input->post('parent_id_tree'),
			'deliverybyamount' => $this->input->post('location_deliverybyamount'),
            'trash_status' => 'no',
            'active_status' => $this->input->post('active_status')
        );
        $this->db->where("id", $id);
        $this->db->update('cms_locations', $location_data);
        $table = 'cms_locations';

        if ($parent_id != '0') {

//            $loc_id_tree = $this->input->post('parent_id_tree');
//            $loc_id_tree = $loc_id_tree . $id . '+';
//            $location_data2 = array(
//                'location_id_tree' => $loc_id_tree
//            );
            $get_val = $this->common_model->pass_tree_values($this->input->post('parent_id'), $id, $table, 'category');

            $location_data2 = array(
                'location_id_tree' => $get_val['category_ids'],
            );
        } else {
//            $loc_id_tree = '+' . $id . '+';
//            $location_data2 = array(
//                'location_id_tree' => $loc_id_tree
//            );
            $get_val = $this->common_model->pass_tree_values($id, $id, $table, 'category');
            $location_data2 = array(
                'location_id_tree' => $get_val['category_ids'],
            );
        }


        $this->db->where('id', $id);
        $this->db->update('cms_locations', $location_data2);
    }

    function get_locations() {
        $this->db->where("trash_status", 'no');
        $this->db->where("active_status", 'a');
        $this->db->where("parent_id", 0);
        $query = $this->db->get("cms_locations");
        $data = $query->result();
        foreach ($data as $d) {

            $this->prod_arr[] = array('name' => $d->location, 'id' => $d->id);

            $this->sub_cat1($d->id);
        }

        return $this->prod_arr;
    }

    function sub_cat1($id, $dash = '') {
        $dash .= "__";
        $this->db->where("trash_status", 'no');
        $this->db->where("active_status", 'a');
        $this->db->where("parent_id", $id);
        $query = $this->db->get("cms_locations");
        $data1 = $query->result();
        foreach ($data1 as $d) {
            $this->prod_arr[] = array('name' => $dash . $d->location, 'id' => $d->id);
            $this->sub_cat1($d->id, $dash);
        }
    }

//    nikhil updation 2/5/2018

    function add_branch() {

        $banner_images_str = $this->input->post('final_images');
        $banner_images = explode(',', $banner_images_str);

        $image_array = array();

        $i = 0;
        foreach ($banner_images as $banner) {

            if ($this->input->post('seo_alt')[$i] != "") {

                $seo_alt = $this->input->post('seo_alt')[$i];
            } else {

                $seo_alt = $this->input->post('branch_name');
            }
            if ($this->input->post('seo_title')[$i] != "") {

                $seo_title = $this->input->post('seo_title')[$i];
            } else {

                $seo_title = $this->input->post('branch_name');
            }

            $image_array[] = array(
                'image' => $banner,
                'combo' => $this->input->post('combo'),
                'seo_alt' => $seo_alt,
                'seo_title' => $seo_title,
            );

            $image_encode = json_encode($image_array);

            $data_media = array(
                'type' => 'branch_type',
                'type2' => 'branch',
                'type_trash' => 'no',
                'images' => $image_encode,
            );

            $this->db->insert('cms_media', $data_media);
            $bannerID = $this->db->insert_id();
            $i++;
        }

        $image_array1 = array();

        foreach ($banner_images as $banner) {

            $image_array1[] = array(
                'image' => $banner,
                'combo' => $this->input->post('combo'),
                'media_id' => $bannerID,
                'seo_alt' => $seo_alt,
                'seo_title' => $seo_title,
            );
        }

        $image_encode1 = json_encode($image_array1);


        $catid_val = $this->input->post('sub_location_id');
        $table = 'cms_locations';
        $get_val = $this->common_model->pass_tree_values($catid_val, $catid_val, $table, 'none_category');

        $branch_data = array(
           // 'location_id' => $this->input->post('sub_location_id'),
           // 'sub_location_id' => $this->input->post('sub_location_id'),
            //'main_location_id' => $this->input->post('main_location_id'),
           // 'location_id_tree' => $get_val['category_ids'],
            'branch_name' => $this->input->post('branch_name'),
            'uniq_branch_name' => $this->input->post('uniq_branch_name'),
           // 'image' => $image_encode1,
            'address' => $this->input->post('address'),
            //'latitude' => $this->input->post('latitude'),
            //'longitude' => $this->input->post('longitude'),
            //'map_iframe' => $this->input->post('map'),
            //'ip_address' => $this->input->post('ip_address'),
            //'extra_items' => $this->input->post('gl_extra_value'),
            //'company_rules' => $this->input->post('rules_title_desc'),
            'trash_status' => 'no',
            'active_status' => 'a',
			
			 'pickup_after_time' => $this->input->post('pickup_after_time'),
			 'pickup_after_date' => $this->input->post('pickup_after_date'),
        );

        $this->db->insert('cms_branches', $branch_data);


//        $bid = $this->db->insert_id();
//        $catid_val = $this->input->post('sub_location_id');
//        $table = 'cms_locations';
//        $get_val = $this->common_model->pass_tree_values($catid_val, $catid_val, $table, 'none_category');
//
//
//
//
//        $data2 = array(
//            'location_id_tree' => $get_val['category_ids'],
//        );
//
//
//        $this->db->where('id', $bid);
//        $this->db->update('cms_branches', $data2);
    }

//    nikhil updation 2/5/2018
    function uniq_branch_name_check() {
        $test = $this->input->post('uniq_branch_name');
        $this->db->where('uniq_branch_name', $test);
        $query = $this->db->get('cms_branches');
        return $query->result();
    }

    function uniq_branch_name_check1() {

        if (isset($_GET['id'])) {

            $id = $_GET['id'];
        }

        $test = $this->input->post('uniq_branch_name');
        $this->db->where('id !=', $id);
        $this->db->where('uniq_branch_name', $test);
        $query = $this->db->get('cms_branches');
        return $query->result();
    }

    function count_all_branches() {

        if (isset($_GET['seg3'])) {

            $sess_val = $_GET['seg3'];
            $s_a = str_replace("_sbn_", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('branch_name', $s_a);
        }


        $this->db->where('trash_status', 'no');
//$this->db->where('active_status', 'a');

        $val = $this->db->get('cms_branches');
        return $val->num_rows();
    }

    function list_branches($perpage, $rec_from) {
        if (isset($_GET['seg3'])) {

            $sess_val = $_GET['seg3'];
            $s_a = str_replace("_sbn_", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('branch_name', $s_a);
        }


        $this->db->order_by('id', 'ASC');
        $this->db->where('trash_status', 'no');
//$this->db->where('active_status', 'a');

        $this->db->limit($perpage, $rec_from);
        return $this->db->get('cms_branches')->result();
    }

//    nikhil updation 2/5/2018
    function edit_branch($id) {

        $banner_images_str = $this->input->post('final_images');
        $mediaID = $this->input->post('mediaID');
        $banner_images = explode(',', $banner_images_str);

        $seo_alt = $this->input->post('seo_alt');
        $seo_title = $this->input->post('seo_title');



        $branch_details = $this->common_model->GetByRow('cms_branches', $id, 'id');

        $catid_val = $this->input->post('sub_location_id');
        $table = 'cms_locations';
        $get_val = $this->common_model->pass_tree_values($catid_val, $catid_val, $table, 'none_category');

        if ($banner_images_str != "") {


            $data_mediaID = array(
                'type_trash' => 'yes'
            );


            $this->db->where('id', $mediaID);
            $this->db->update('cms_media', $data_mediaID);

            $image_array = array();

            foreach ($banner_images as $banner) {

                $image_array[] = array(
                    'image' => $banner,
                    'combo' => $this->input->post('combo'),
                    'seo_alt' => $seo_alt,
                    'seo_title' => $seo_title,
                );
            }

            $image_encode = json_encode($image_array);

            $data_media = array(
                'type' => 'branch_type',
                'type2' => 'branch',
                'type_trash' => 'no',
                'images' => $image_encode
            );

            $this->db->insert('cms_media', $data_media);
            $bannerID = $this->db->insert_id();

            $image_array1 = array();

            foreach ($banner_images as $banner) {

                $image_array1[] = array(
                    'image' => $banner,
                    'combo' => $this->input->post('combo'),
                    'media_id' => $bannerID,
                    'seo_alt' => $seo_alt,
                    'seo_title' => $seo_title,
                );
            }

            $image_encode1 = json_encode($image_array1);
            $catid_val = $this->input->post('sub_location_id');
            $table = 'cms_locations';
            $get_val = $this->common_model->pass_tree_values($catid_val, $catid_val, $table, 'none_category');

            $branch_data = array(
               // 'location_id' => $this->input->post('sub_location_id'),
                //'sub_location_id' => $this->input->post('sub_location_id'),
               // 'main_location_id' => $this->input->post('main_location_id'),
               // 'location_id_tree' => $get_val['category_ids'],
                'branch_name' => $this->input->post('branch_name'),
                'uniq_branch_name' => $this->input->post('uniq_branch_name'),
                //'image' => $image_encode1,
                'address' => $this->input->post('address'),
                //'latitude' => $this->input->post('latitude'),
                //'longitude' => $this->input->post('longitude'),
               // 'map_iframe' => $this->input->post('map'),
                //'ip_address' => $this->input->post('ip_address'),
                //'extra_items' => $this->input->post('gl_extra_value'),
               // 'company_rules' => $this->input->post('rules_title_desc'),
                'trash_status' => 'no',
                'active_status' => $this->input->post('active_status'),
				 'pickup_after_time' => $this->input->post('pickup_after_time'),
			 	 'pickup_after_date' => $this->input->post('pickup_after_date'),
            );
        } else {

            $image_list = json_decode($branch_details->image, true);
            $image_detail = $this->common_model->GetByRow_notrash('cms_media', $image_list[0]['media_id'], 'id');

            $exist_image_detail = json_decode($image_detail->images, TRUE);

            $image_array[] = array(
                'image' => $exist_image_detail[0]['image'],
                'combo' => $exist_image_detail[0]['combo'],
                'seo_alt' => $seo_alt,
                'seo_title' => $seo_title,
            );


            $image_encode = json_encode($image_array);
            $data_media = array();
            $data_media = $this->common_model->array_push_assoc($data_media, 'images', $image_encode);
            $this->db->where('id', $image_list[0]['media_id']);
            $this->db->update('cms_media', $data_media);

            
            $exist_image_detail = json_decode($branch_details->image, TRUE);
            if (!empty($exist_image_detail)) {
                $image_array[] = array(
                    'image' => $exist_image_detail[0]['image'],
                    'combo' => $exist_image_detail[0]['combo'],
                    'media_id' => $exist_image_detail[0]['media_id'],
                    'seo_alt' => $seo_alt,
                    'seo_title' => $seo_title,
                );
                $image_encode = json_encode($image_array);
            }
            
            

            $branch_data = array(
                //'location_id' => $this->input->post('sub_location_id'),
               // 'sub_location_id' => $this->input->post('sub_location_id'),
              //  'main_location_id' => $this->input->post('main_location_id'),
              //  'location_id_tree' => $get_val['category_ids'],
                'branch_name' => $this->input->post('branch_name'),
                'uniq_branch_name' => $this->input->post('uniq_branch_name'),
                'address' => $this->input->post('address'),
              //  'image' => $image_encode1,
              //  'latitude' => $this->input->post('latitude'),
              //  'longitude' => $this->input->post('longitude'),
            //    'map_iframe' => $this->input->post('map'),
              //  'ip_address' => $this->input->post('ip_address'),
              //  'extra_items' => $this->input->post('gl_extra_value'),
             //   'company_rules' => $this->input->post('rules_title_desc'),
                'trash_status' => 'no',
                'active_status' => $this->input->post('active_status'),
				 'pickup_after_time' => $this->input->post('pickup_after_time'),
				 'pickup_after_date' => $this->input->post('pickup_after_date'),
            );
        }


        $this->db->where('id', $id);
        $this->db->update('cms_branches', $branch_data);
    }

//    nikhil updation 2/5/2018
    function count_all_trash_branches() {

        if (isset($_GET['seg3'])) {

            $sess_val = $_GET['seg3'];
            $s_a = str_replace("_sbn_", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('branch_name', $s_a);
        }


        $this->db->where('trash_status', 'yes');
        $this->db->order_by('date_deleted', 'DESC');

        $val = $this->db->get('cms_branches');
        return $val->num_rows();
    }

    function list_trash_branches($perpage, $rec_from) {
        if (isset($_GET['seg3'])) {

            $sess_val = $_GET['seg3'];
            $s_a = str_replace("_sbn_", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('branch_name', $s_a);
        }


        $this->db->where('trash_status', 'yes');
        $this->db->order_by('date_deleted', 'DESC');

        $this->db->limit($perpage, $rec_from);
        return $this->db->get('cms_branches')->result();
    }

    function get_location_parent_ids() {


        $this->db->where("trash_status", 'no');
        $this->db->where("active_status", 'a');
        $this->db->select("parent_id");

        $query = $this->db->get("cms_locations");
        $myObj = $query->result();
        $json_pids = json_encode($myObj);

        return $json_pids;
    }

    /*
     * End of Class store_model
     */
    /*
     * Location Data Merging
     */

    function slug_name($string) {
        $string = trim($string);
        $string = str_replace(" ", "-", $string);
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
        $string = preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
        $slug_name = strtolower($string);
        return $slug_name;
    }

    function InsertCountry() {
        ini_set('max_execution_time', 0);
        $tb_country_list = $this->store_model->GetByOld_Country();
        foreach ($tb_country_list as $tb_country_key => $tb_country_value) {
            $uniq_location_name = $this->store_model->slug_name($tb_country_value->country);
            $location_data = array(
                'id' => $tb_country_value->id,
                'location_type_id' => '1',
                'location' => $tb_country_value->country,
                'location_code' => $tb_country_value->code,
                'uniq_location_name' => $uniq_location_name,
                'parent_id' => '0',
                'main_parent_id' => '0',
                'location_id_tree' => '+' . $tb_country_value->id . '+',
                'trash_status' => 'no',
                'active_status' => 'a',
                'merge_type' => 'old',
            );
//   dump($data);
            $this->db->insert('cms_locations', $location_data);
            $loc_id = $this->db->insert_id();




            $loc_id_tree = '+' . $loc_id . '+';



            $location_data2 = array(
                'location_id_tree' => $loc_id_tree
            );

//            $loc_id_tree = $this->input->post('parent_id_tree');
//            $loc_id_tree = $loc_id_tree . $loc_id . '+';
//
//            $location_data2 = array(
//                'location_id_tree' => $loc_id_tree
//            );



            $this->db->where('id', $loc_id);
            $this->db->update('cms_locations', $location_data2);


//if(){
//    
//}
//        dump($data);
        }
    }

    function InsertState() {
        ini_set('max_execution_time', 0);
        $tb_country_list = $this->store_model->GetByOld_States();
        foreach ($tb_country_list as $tb_country_key => $tb_country_value) {
            $uniq_location_name = $this->store_model->slug_name($tb_country_value->country);
            $location_data = array(
                'id' => $tb_country_value->id,
                'location_type_id' => '2',
                'location' => $tb_country_value->country,
                'location_code' => $tb_country_value->code,
                'uniq_location_name' => $uniq_location_name,
                'parent_id' => $tb_country_value->parent_id,
                'main_parent_id' => $tb_country_value->parent_id,
                'location_id_tree' => '+' . $tb_country_value->id . '+',
                'trash_status' => 'no',
                'active_status' => 'a',
                'merge_type' => 'old',
            );
//   dump($location_data);

            $this->db->insert('cms_locations', $location_data);

            $catid_val = $this->db->insert_id();
            $table = 'cms_locations';
            $get_val = $this->common_model->pass_tree_values($catid_val, $catid_val, $table);


            if ($tb_country_value->parent_id != 0) {


                $get_val = $this->common_model->pass_tree_values($tb_country_value->parent_id, $catid_val, $table);


                $data2 = array(
                    'location_id_tree' => $get_val['category_ids'],
                );
            } else {

                $data2 = array(
                    'location_id_tree' => $get_val['category_ids'],
                );
            }

            $this->db->where('id', $catid_val);
            $this->db->update('cms_locations', $data2);
        }
    }

    function InsertCity() {
        ini_set('max_execution_time', 0);
        $tb_city_list = $this->store_model->GetByOld_City();
        foreach ($tb_city_list as $tb_city_key => $tb_city_value) {

//            dump($tb_city_value);
            $uniq_location_name = $this->store_model->slug_name($tb_city_value->city);
            $location_data = array(
//                'id' => $tb_city_value->id,
                'location_type_id' => '3',
                'location' => $tb_city_value->city,
                'location_code' => $tb_city_value->code,
                'uniq_location_name' => $uniq_location_name,
                'parent_id' => $tb_city_value->parent_id,
                'main_parent_id' => $tb_city_value->country,
                'location_id_tree' => '+' . $tb_city_value->id . '+',
                'trash_status' => 'no',
                'active_status' => 'a',
                'merge_type' => 'old',
            );
//            dump($location_data);


            $this->db->insert('cms_locations', $location_data);

            $catid_val = $this->db->insert_id();
            $table = 'cms_locations';
            $get_val = $this->common_model->pass_tree_values($catid_val, $catid_val, $table);


            if ($tb_city_value->parent_id != 0) {


                $get_val = $this->common_model->pass_tree_values($tb_city_value->parent_id, $catid_val, $table);


                $data2 = array(
                    'location_id_tree' => $get_val['category_ids'],
                );
            } else {

                $data2 = array(
                    'location_id_tree' => $get_val['category_ids'],
                );
            }

            $this->db->where('id', $catid_val);
            $this->db->update('cms_locations', $data2);
        }
    }

    function InsertStoreRooms() {

        ini_set('max_execution_time', 0);
        $tb_store_list = $this->store_model->GetByOld_StoreRooms();
//        dump($tb_store_list);
        foreach ($tb_store_list as $tb_store_key => $tb_store_value) {
            // dump($tb_store_value);
            $tb_old_city_value = $this->common_model->GetByRow_notrash('tb_city', $tb_store_value->city, 'id');
//dump($tb_old_city_value);
            $uniq_location_name = $this->store_model->slug_name('-' . $tb_old_city_value->city);
            $cms_locations_row = $this->common_model->GetByRow_notrash('cms_locations', $tb_old_city_value->city, 'location');
            //  $cms_branches_row = $this->common_model->GetByRow_notrash('cms_branches', 3, 'id');
//           dump($cms_branches_row); 




            $banner_images_str = $tb_store_value->image;
            $banner_images = explode(',', $banner_images_str);

            $image_array = array();

            foreach ($banner_images as $banner) {

                $image_array[] = array(
                    'image' => $banner,
                    'combo' => '26',
                );
            }

            $image_encode = json_encode($image_array);

            $branch_data = array(
                'id' => $tb_store_value->id,
                'branch_name' => '-' . $tb_old_city_value->city,
                'uniq_branch_name' => $uniq_location_name,
                'location_id' => $cms_locations_row->id,
                'image' => $image_encode,
                'email' => $tb_store_value->email,
                'address' => $tb_store_value->address,
                'latitude' => $tb_store_value->latitude_map,
                'longitude' => $tb_store_value->longitude_map,
                'map_iframe' => $tb_store_value->iframe,
                'ip_address' => '',
                'extra_items' => '[{"extra_items":""}]',
                'company_rules' => '[]',
                'trash_status' => 'no',
                'active_status' => 'a',
                'merge_type' => 'old',
                'payid' => $tb_store_value->payid,
            );
//            dump($location_data);
            $cms_exist = $this->common_model->GetByRow_notrash('cms_branches', $tb_store_value->id, 'id');
            //dump($tb_store_value->id);
            if ($cms_exist == NULL) {
                $this->db->insert('cms_branches', $branch_data);
            } else {
                $this->db->where('id', $tb_store_value->id);
                $this->db->update('cms_branches', $branch_data);
                //dump('true');
            }



//            if ($tb_store_key == 0) {
//                die();
//            }
        }
    }

    function GetByOld_Country() {

        $this->db->where('parent_id', 0);
        return $result = $this->db->get('tb_country')->result();
    }

    function GetByOld_States() {

        $this->db->where('parent_id != ', 0);
        return $result = $this->db->get('tb_country')->result();
    }

    function GetByOld_City() {


        return $result = $this->db->get('tb_city')->result();
    }

    function GetByOld_StoreRooms() {

        return $result = $this->db->get('tb_map')->result();
    }

    /* Function pass_tree_values takes one argument and return an array. */

    function pass_tree_values($catid_val, $c_id) {
        ini_set('max_execution_time', 0);

        $parent_cat_result = $this->store_model->get_first_parent($catid_val);
        $current_field = $this->common_model->GetByRow('cms_locations', $c_id, 'id');

        if ($current_field->parent_id == 0) {
            $current_ids = '';
            //$current_names = '';
            //$current_slugs = '';
            // $current_full = '';
        } else {
            $current_ids = '+' . $current_field->id;
            //$current_names = '+' . '';
            //$current_slugs = '+' . $current_field->slug;
            //$current_full = '+' . $current_ids . '_' . $current_names . '_' . $current_slugs;
        }



        $parent_cat_result = explode('___', $parent_cat_result);
        $parent_cat_splited = explode('**', $parent_cat_result[0]);
        $cat_parent_id = $parent_cat_splited[0];
        //  $cat_parent_name = $parent_cat_splited[1];
        // $cat_parent_route = $parent_cat_splited[2];

        $parent_cat_splited2 = explode('**', $parent_cat_result[1]);

        $category_ids = $parent_cat_splited2[0];
        $category_ids = explode('+', $category_ids);
        $category_ids = array_filter($category_ids);
        $category_ids = array_unique($category_ids);
        $category_ids = implode('+', $category_ids);
//        $category_ids = $current_ids . '+' . $category_ids . '+';
        $category_ids = '+' . $category_ids . '+';

//        $category_names = $parent_cat_splited2[1];
//        $category_names = explode('+', $category_names);
//        $category_names = array_filter($category_names);
//        $category_names = array_unique($category_names);
//        $category_names = implode('+', $category_names);
////        $category_names = $current_names . '+' . $category_names . '+';
//        $category_names = '+' . $category_names . '+';
//        $category_slugs = $parent_cat_splited2[2];
//        $category_slugs = explode('+', $category_slugs);
//        $category_slugs = array_filter($category_slugs);
//        $category_slugs = array_unique($category_slugs);
//        $category_slugs = implode('+', $category_slugs);
////        $category_slugs = $current_slugs . '+' . $category_slugs . '+';
//        $category_slugs = '+' . $category_slugs . '+';
//        $category_full = $parent_cat_splited2[3];
//        $category_full = explode('+', $category_full);
//        $category_full = array_filter($category_full);
//        $category_full = array_unique($category_full);
//        $category_full = implode('+', $category_full);
////        $category_full = $current_full . '+' . $category_full . '+';
//        $category_full = '+' . $category_full . '+';


        $tree_arr = array('category_ids' => $category_ids,
//            'category_names' => $category_names,
//            'category_slugs' => $category_slugs,
//            'category_full' => $category_full,
//            'cat_parent_id' => $cat_parent_id,
//            'cat_parent_name' => $cat_parent_name,
//            'cat_parent_route' => $cat_parent_route,
        );
        return $tree_arr;
    }

    /* EOF Function pass_tree_values takes one argument and return an array. */



    /*
     * Function Get the first parent
     */

    function get_first_parent($cid) {
        $j = '';
        $i = $cid;
        $catids = '';
        $catnames = '';
        $catslugs = '';
        $catfull = '';
        while ($i > 0) {
            $this->db->where('id', $i);
            $category = $this->db->get('cms_locations')->row();
            $i = $category->parent_id;

            $catids .= $category->id . '+';
            $catnames .= "";
            $catslugs .= "";

            $catfull .= $category->id . '__' . '__' . '+';

            if ($i > 0) {
                $j = $category->parent_id . '**' . '' . '**' . '';

                $catids .= $category->parent_id . '+';
                $catnames .= '';
                $catslugs .= '';

                $catfull .= $category->id . '__' . '' . '__' . '' . '+';
            } else
            if ($i == '0') {
                $j = $category->id . '**' . '' . '**' . '';

                $catids .= $category->id . '+';
                $catnames .= '';
                $catslugs .= '';

                $catfull .= $category->id . '__' . '' . '__' . '' . '+';
            }
        }

        $alldata = $catids . '**' . $catnames . '**' . $catslugs . '**' . $catfull;
        return $j . '___' . $alldata;
    }

    /*
     * EOFunction Get the first parent
     */




    /*
     * End of Location Data Merging
     */

    public function get_country_list() {

        $this->db->where('parent_id', 0);

        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get('cms_locations');
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_location_by_parent($p_id, $l_id) {

        $this->db->where('parent_id', $p_id);
        $this->db->where('location_type_id', $l_id);

        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');

        $query = $this->db->get('cms_locations');
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_child_location_type($p_id) {

        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->where('parent_id', $p_id);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get('cms_location_types');
        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    function get_locations_by_idtree($type_id, $loc_id_tree) {

        foreach ($loc_id_tree as $loc_id) {

            $loc_detail = $this->common_model->GetByRow('cms_locations', $loc_id, 'id');
            if ($type_id == $loc_detail->location_type_id) {

                $this->db->where("trash_status", 'no');
                $this->db->where("active_status", 'a');
                $this->db->where("parent_id", $loc_detail->parent_id);
                $this->db->where("location_type_id", $type_id);
                $query = $this->db->get("cms_locations");

                return $query->result();
            }
        }
    }

    function UpdateAllBranchesAndLocations() {

        $branch_list = $this->common_model->GetByResult_notrash('cms_branches', 'id', 'asc');
        $location_id_array = array();
        foreach ($branch_list as $branch_row) {
            $location_id = $branch_row->location_id;
            $location_detail = $this->common_model->GetByRow('cms_locations', $location_id, 'id');

            $branch_data = array(
                'sub_location_id' => $location_detail->id,
                'main_location_id' => $location_detail->main_parent_id,
                'location_id_tree' => $location_detail->location_id_tree,
            );


            $this->db->where('id', $branch_row->id);
            $this->db->update('cms_branches', $branch_data);

            $location_id_tree = explode('+', $location_detail->location_id_tree);

            foreach ($location_id_tree as $location_id_val) {
                $location_id_array[] = $location_id_val;
            }
        }

        $location_id_array = array_filter($location_id_array);
        $location_id_array = array_unique($location_id_array);

        foreach ($location_id_array as $location_id_row) {

            $location_data = array(
                'branch_status' => 'yes',
            );

            $this->db->where('id', $location_id_row);
            $this->db->update('cms_locations', $location_data);
        }
    }

    function UpdateAllBranchStatusInLocations() {

        $location_data = array(
            'branch_status' => '',
        );

        $this->db->update('cms_locations', $location_data);

        $branch_list = $this->common_model->GetByResult_notrash('cms_branches', 'id', 'asc');
        $location_id_array = array();
        foreach ($branch_list as $branch_row) {
            $location_id = $branch_row->location_id;
            $location_detail = $this->common_model->GetByRow('cms_locations', $location_id, 'id');

            $location_id_tree = explode('+', $location_detail->location_id_tree);

            foreach ($location_id_tree as $location_id_val) {
                $location_id_array[] = $location_id_val;
            }
        }

        $location_id_array = array_filter($location_id_array);
        $location_id_array = array_unique($location_id_array);

        foreach ($location_id_array as $location_id_row) {

            $location_data = array(
                'branch_status' => 'yes',
            );

            $this->db->where('id', $location_id_row);
            $this->db->update('cms_locations', $location_data);
        }
    }

}
