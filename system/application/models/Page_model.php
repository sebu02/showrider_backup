<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Page_model
        extends CI_Model {

    function __construct() {
        parent::__construct();
        //$this->output->enable_profiler(TRUE);
        $this->tree = array();
        $this->parent = '';
        $this->arr = array();
        $this->arr2 = array();
        $this->arrz = array();
        $this->arrs = array();
        $this->arrow = '|';
        $this->arrzz = array();

        date_default_timezone_set('Asia/Calcutta');
       
    }

    function DeleteById($table, $id, $field) {
        //echo $id;
        $this->db->where(array(
            $field => $id));
        $this->db->delete($table);
    }

    function GetByRow($table, $eventid, $field) {
        //echo $eventid;
        $this->db->where(array(
            $field => $eventid));
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $result = $this->db->get($table)->row();
    }

    function GetByRow_array_notrash($table, $eventid, $field) {
        //echo $eventid;
        $this->db->where(array(
            $field => $eventid));
        return $result = $this->db->get($table)->row_array();
    }

    function GetByRow_notrash($table, $eventid, $field) {
        //echo $eventid;
        $this->db->where(array(
            $field => $eventid));
        return $result = $this->db->get($table)->row();
    }

    function TrashById($table, $id, $field) {
        $data = array(
            'trash_status' => 'yes',
            'active_status' => 'd',
            'date_deleted' => date("Y-m-d H:i:s")
        );

        $this->db->where(array(
            $field => $id));
        $this->db->update($table, $data);
    }

    function RestoreById($table, $id, $field) {
        $data = array(
            'trash_status' => 'no',
            'active_status' => 'a',
            'date_restored' => date("Y-m-d H:i:s")
        );

        $this->db->where(array(
            $field => $id));
        $this->db->update($table, $data);
    }

    function array_push_assoc($array, $key, $value) {
        $array[$key] = $value;
        return $array;
    }

    function insert_meta() {
        $full_slug = $this->input->post('slug');
        $pg_type = ''; 
        
        $extra_codelist = array();
        $extra_codelist[0]=$this->input->post('extra_code');
        $extra_code = json_encode($extra_codelist);

        $data = array(
            'page' => $this->input->post('page'),
            'type' => 'main_page',
            'slug' => $this->input->post('slug'),
            'slug2' => $this->input->post('slug'),
            'url_key' => 'page_route',
            'slug_type' => $this->input->post('url_type'),
            'full_slug' => $full_slug,
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'keywords' => $this->input->post('keywords'),
            'page_type' => $this->input->post('page_type'),
            'trash_status' => 'no',
            'active_status' => 'a',
            'showsuper' => $this->input->post('show_super_status'),
            'extra_code' =>  $extra_code,
            'page_description' => $this->input->post('short_description'),
        );
        
        $this->db->insert('cms_pages', $data);
        $pageid = $this->db->insert_id();   

        $data2 = array(
            'page_id' => $pageid
        );
        $this->db->where('id', $pageid);
        $this->db->update('cms_pages', $data2);

        $page_id = $pageid;
      
        return array(
            "id" => $pageid,
            "return_string" => ""
        );
    }  
    
    function list_all_pages() {
        $this->db->where('type', 'main_page');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('page', 'ASC');
        return $this->db->get('cms_pages')->result();
    }
    
    function count_all_meta() {			
        $this->page_model->listing_page_sort();        
        $this->db->where('type', 'main_page');
        $this->db->where('trash_status', 'no');
        $val = $this->db->get('cms_pages');
        return $val->num_rows();
    }

    function list_meta($perpage, $rec_from) {        
        $this->page_model->listing_page_sort();        
        $this->db->where('type', 'main_page');
        $this->db->where('trash_status', 'no');
        $this->db->limit($perpage, $rec_from);
        return $this->db->get('cms_pages')->result();
    }
	
function listing_page_sort()
{    
    $loged_type = '';
        if ($this->session->userdata('logged_adminpanel') == 'true') {

            $log_usernamez = $this->session->userdata('logged_username');
            $this->db->where('username', $log_usernamez);
            $loged_details = $this->db->get('admin')->row();
            $loged_type = $loged_details->type;
		
            if ($loged_type != 'super') {	
                $this->db->where('showsuper !=', 'yes');
            }
        }   

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->db->where('id', $id);
        }

        if (isset($_GET['name'])) {
            $search = $_GET['name'];
            $s_a = str_replace("123", "&", $search);
            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('page', $s_a);
        }

            if (isset($_GET['order'])) {
            $order = $_GET['order'];
            $this->db->order_by('page', $order);
//            $this->db->order_by('id', $order);
        } else {
            $this->db->order_by('id', 'DESC');
        }

        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            $this->db->where('active_status', $status);
        } else {
            $this->db->where('active_status', 'a');
        }

}
	
    function admin_or_super() {
        $loged_type = '';
        if ($this->session->userdata('logged_adminpanel') == 'true') {

            $log_usernamez = $this->session->userdata('logged_username');
            $this->db->where('username', $log_usernamez);
            $loged_details = $this->db->get('admin')->row();
            $loged_type = $loged_details->type;
        }
        return $loged_type;
    }
    function trash_count_all_meta() {
        if (isset($_GET['name'])) {
            $search = $_GET['name'];
            $s_a = str_replace("123", "&", $search);
            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('page', $s_a);
        }

        if (isset($_GET['order'])) {
            $order = $_GET['order'];
            $this->db->order_by('id', $order);
        }

        $this->db->where('type', 'main_page');
        $this->db->where('trash_status', 'yes');
        $this->db->where('active_status', 'd');
        $val = $this->db->get('cms_pages');
        return $val->num_rows();
    }

    function trash_list_meta($perpage, $rec_from) {
        if (isset($_GET['name'])) {
            $search = $_GET['name'];
            $s_a = str_replace("123", "&", $search);
            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('page', $s_a);
        }

        if (isset($_GET['order'])) {
            $order = $_GET['order'];
            $this->db->order_by('id', $order);
        } else {
            $this->db->order_by('id', 'DESC');
        }

        $this->db->where('type', 'main_page');
        $this->db->where('trash_status', 'yes');
        $this->db->where('active_status', 'd');
        $this->db->limit($perpage, $rec_from);
        return $this->db->get('cms_pages')->result();
    }

    function edit_pages($id) {
        $full_slug = $this->input->post('slug');
        $pg_type = "";

        $extra_codelist = array();
        $extra_codelist[0]=$this->input->post('extra_code');
        $extra_code = json_encode($extra_codelist);
        //dump($extra_code);die();
      
            $data = array(
                'page' => $this->input->post('page'),
                'type' => 'main_page',
                'slug' => $this->input->post('slug'),
                'slug2' => $this->input->post('slug'),
                'url_key' => 'page_route',
                'slug_type' => $this->input->post('url_type'),
                'full_slug' => $full_slug,
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'keywords' => $this->input->post('keywords'),
                'trash_status' => 'no',
                'active_status' => 'a',
                'showsuper' => $this->input->post('show_super_status'),
                'page_type' => $this->input->post('page_type'),
                'extra_code'  => $extra_code,
                'page_description' => $this->input->post('short_description'),   
            );

            $this->db->where('id', $id);
            $this->db->update('cms_pages', $data);
            $page_id = $id;

        return $page_id;
    }

    function update_common_wrapper_p_type_id($page_id) {

    }

    function select_page_slug() {
        if ($this->input->post('url_type') == 'seo_url') {
            $full_slug = $this->input->post('slug');
        } elseif ($this->input->post('url_type') == 'force_url') {
            $full_slug = $this->input->post('slug');
        }
        $this->db->where('full_slug', $full_slug);
        return $this->db->get('cms_pages')->row();
    }

    function select_page_slug1() {
        $id = $this->uri->segment(3);
        if ($this->input->post('url_type') == 'seo_url') {
            $full_slug = $this->input->post('slug');
        } elseif ($this->input->post('url_type') == 'force_url') {
            $full_slug = $this->input->post('slug');
        }
        $this->db->where('full_slug', $full_slug);
        $this->db->where('id !=', $id);
        return $this->db->get('cms_pages')->row();
    }   
    
    function randomColor() {
        $result = array(
            'rgb' => '',
            'hex' => '');
        foreach (array(
    'r',
    'b',
    'g') as $col) {
            $rand = mt_rand(102, 255);
            $result['rgb'][$col] = $rand;
            $dechex = dechex($rand);
            if (strlen($dechex) < 2) {
                $dechex = '0' . $dechex;
            }
            $result['hex'] .= $dechex;
        }
        return $result;
    }

    /*
     * End of To get Random Colors in RGB or in HEX format
     */
   
    function orderExistOrNot($order, $page_id) {
        $this->db->where('page_id', $page_id);
        $this->db->where('order_no', $order);
        $val = $this->db->get('cms_pages');
        $count_row = $val->num_rows();
        return $count_row;
    }    

    function count_all_subcategory($id) {
        if ($this->uri->segment(5) != '0') {
            $sess_val = $this->uri->segment(5);
            $s_a = str_replace("123", "&", $sess_val);
            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('category', $s_a);
        }
        $this->db->where('parent_id', $id);
        $this->db->where('type', 'image');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $val = $this->db->get('cms_dynamic_category');
        return $val->num_rows();
    }

    function GetAllCategorySub($perpage, $rec_from, $id) {
        if ($this->uri->segment(5) != '0') {
            $sess_val = $this->uri->segment(5);
            $s_a = str_replace("123", "&", $sess_val);
            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('category', $s_a);
        }
        $this->db->where('parent_id ', $id);
        $this->db->where('type', 'image');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('order', 'ASC');
        $this->db->order_by('id', 'ASC');
        $this->db->limit($perpage, $rec_from);
        return $this->db->get('cms_dynamic_category')->result();
    }
   
    public function getMediaData($catid) {
        $this->db->select('*');
        $this->db->from('cms_media');
        $this->db->like('category_tree', '+' . $catid . '+');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->where('type !=', 'content_image');
        $this->db->where('type2 !=', 'video_gallery');
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getMediaData_gallery($catid) {
        $this->db->select('*');
        $this->db->from('cms_media');
        $this->db->like('category_tree', '+' . $catid . '+');
        $this->db->where('trash_status', 'no');
        $this->db->where('type_trash', 'no');
        $this->db->where('active_status', 'a');
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_menu_data($catid) {
        $this->db->select('*');
        $this->db->from('cms_menu');
        $this->db->like('menu_type_tree', '+' . $catid . '+');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }
       
    function get_visitor_count_by_id($page_id) {
        $this->db->where('pageid', $page_id);
        $query = $this->db->get('cms_visitors');
        $query_num = $query->num_rows();
        return $query_num;
    }

    function clean_name($string) {
        $string = trim($string);
        $string = str_replace(" ", "-", $string);
        $string = str_replace("&", "and", $string);
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
        $string = preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
        $string = strtolower($string);
        return $string;
    }

    function get_page_maximum_orderno($page_id) {
        $this->db->select_max('order_no');
        $this->db->where('page_id', $page_id);
        return $this->db->get('cms_pages')->row();
    }
   
    function admin_or_super_admin() {
        $loged_type = '';
        $show_hide = '';
        if ($this->session->userdata('logged_adminpanel') == 'true') {

            $log_usernamez = $this->session->userdata('logged_username');
            $this->db->where('username', $log_usernamez);
            $loged_details = $this->db->get('admin')->row();
            $loged_type = $loged_details->type;
        }
        if ($loged_type == "admin") {
            $show_hide = " hide ";
        }
        return $show_hide;
    }

}
