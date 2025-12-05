<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Video_model extends CI_Model {

    function __construct() {
        parent::__construct();
        //$this->output->enable_profiler(FALSE);
        $this->tree = array();
        $this->parent = '';
        $this->arr = array();
        $this->arr2 = array();
        $this->arrz = array();
        $this->arrs = array();
        $this->arrow = '|';
        $this->arrzz = array();
        
    }

    function GetByRow($table, $eventid, $field) {
        //echo $eventid;
        $this->db->where(array($field => $eventid));

        return $result = $this->db->get($table)->row();
    }
    function array_push_assoc($array, $key, $value) {
        $array[$key] = $value;
        return $array;
    }
    function setSession($data, $obj_vars, $custom_vars) {

        foreach ($obj_vars as $obj_var) {
            $session_data[$obj_var] = $data->$obj_var;
        }

        if ($custom_vars) {
            foreach ($custom_vars as $key => $var) {
                $session_data[$key] = $var;
            }
        }

        $this->session->set_userdata($session_data);
    }

    function DeleteById($table, $id, $field) {
        //echo $id;
        $this->db->where(array($field => $id));

        $this->db->delete($table);
    }

    function add_category() {

        $category_name = $this->input->post('catname');

        $category_clean_name = $this->video_model->clean_name($category_name);
     
        $image_encode1 = '';
        $data = array(
            'parent_id' => 0,
            'type' => 'commonimage',
            'category_picture' => $image_encode1,
            'category' => $this->input->post('catname'),
            'slug' => $this->input->post('slug'),
            'route' => $category_clean_name,
            'order' => $this->input->post('order_number'),
            'date' => date('Y-m-d H:i:s'),
            'active_status' => $this->input->post('active_status'),
        );

        $this->db->insert('cms_dynamic_category', $data);
    }  
    
    function addVideo($filename = ""){
        $video_array = array(
            'video' => $filename
        );

        $video_encode = json_encode($video_array);

        $data = array(
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'video_code' => $this->input->post('video_link'),
            'order_number' => $this->input->post('order_number'),
            'active_status' => $this->input->post('active_status'),
            'main_category' => $this->input->post('cat'),
            'video' => $video_encode,
        );
        
        $this->db->insert('cms_video_gallery', $data);
    }
    
    function countAllVideos(){
        if ($this->uri->segment(5) != '0' && $this->uri->segment(5) != '') {

            $sess_val = $this->uri->segment(5);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('title', $s_a);
        }
        $this->db->where('trash_status', 'no');
//        $this->db->where('active_status', 'a');
        $val = $this->db->get('cms_video_gallery');

        return $val->num_rows();
    }
    
    function listVideos($perpage, $rec_from){
        if ($this->uri->segment(5) != '0' && $this->uri->segment(5) != '') {

            $sess_val = $this->uri->segment(5);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('title', $s_a);
        }
        $this->db->where('trash_status', 'no');
//        $this->db->where('active_status', 'a');
        $this->db->order_by('id', 'DESC');

        $this->db->limit($perpage, $rec_from);
        return $this->db->get('cms_video_gallery')->result();
    }
    
    function editVideo($id , $filename = ""){
        $video_array = array(
            'video' => $filename
        );

        $video_encode = json_encode($video_array);

        if($filename != ""){
            $data = array(
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'video_code' => $this->input->post('video_link'),
                'order_number' => $this->input->post('order_number'),
                'active_status' => $this->input->post('active_status'),
                'main_category' => $this->input->post('cat'),
                'video' => $video_encode,
            );

        }else{
            $data = array(
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'video_code' => $this->input->post('video_link'),
                'order_number' => $this->input->post('order_number'),
                'active_status' => $this->input->post('active_status'),
                'main_category' => $this->input->post('cat'),                
            );
        }
                
        $this->db->where('id', $id);
        $this->db->update('cms_video_gallery', $data);
               
    }
    
    function select_category_slug() {
        $slug = $this->input->post('slug');
        $this->db->where('slug', $slug);
        $this->db->where('type', 'gallery_video');
        return $this->db->get('cms_dynamic_category')->row();
    }
    
    function addCategory(){
        $category_name = $this->input->post('catname');
        $category_clean_name = $this->video_model->clean_name($category_name);
        $image_encode1 = '';
        
        $data = array(
            'parent_id' => 0,
            'type' => 'gallery_video',
            'category_picture' => $image_encode1,
            'category' => $this->input->post('catname'),
            'slug' => $this->input->post('slug'),
            'route' => $category_clean_name,
            'order' => $this->input->post('order_number'),
            'date' => date('Y-m-d H:i:s'),
            'active_status' => $this->input->post('active_status'),
            'type2' => 'video'
        );
        
        $this->db->insert('cms_dynamic_category', $data);
    }
    
    function clean_name($string) {
        $string = trim($string);
        $string = str_replace(" ", "-", $string);
        $string = str_replace("&", "and", $string);
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
        $string = preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
        $product = strtolower($string);
        return $product;
    }
    
    function countAllCats(){
        $this->db->where('parent_id', 0);
        $this->db->where('type', 'gallery_video');
        $this->db->where('trash_status', 'no');
        $val = $this->db->get('cms_dynamic_category');

        return $val->num_rows();
    }
    
    function listCats($perpage, $rec_from){
        $this->db->where('parent_id', 0);
        $this->db->where('type', 'gallery_video');
        $this->db->limit($perpage, $rec_from);
        $this->db->where('trash_status', 'no');
        
        return $this->db->get('cms_dynamic_category')->result();
    }
    
    function select_category_slug1(){
        $id = $this->uri->segment(3);

        $slug = $this->input->post('slug');
        $this->db->where('slug', $slug);
        $this->db->where('id !=', $id);
        $this->db->where('type', 'gallery_video');
        
        return $this->db->get('cms_dynamic_category')->row();
    }
    
    function editCategory($id){
        $category_name = $this->input->post('catname');
        $category_clean_name = $this->video_model->clean_name($category_name);
        
        $image_encode1 = '';
        $data = array(
            'parent_id' => 0,
            'type' => 'gallery_video',
            'category_picture' => $image_encode1,
            'category' => $this->input->post('catname'),
            'slug' => $this->input->post('slug'),
            'route' => $category_clean_name,
            'order' => $this->input->post('order_number'),
            'date' => date('Y-m-d H:i:s'),
            'active_status' => $this->input->post('active_status'),
            'type2' => 'video'
        );
        
        $this->db->where('id', $id);
        $this->db->update('cms_dynamic_category', $data);
    }
    
    function getAllMainCategories(){
        $this->db->where('parent_id', '0');
        $this->db->where('type', 'gallery_video');
        $this->db->where('active_status', 'a');
        return $this->db->get('cms_dynamic_category')->result();
    }

}
