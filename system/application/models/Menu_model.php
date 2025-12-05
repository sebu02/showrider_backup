<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class menu_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // $this->output->enable_profiler(TRUE);

        /*
         *  menu array set
         */
        $this->tree = array();
        $this->parent = '';
        $this->arr = array();
        $this->product_arr = array();
        $this->arr_m = array();
        $this->arrp = array();
        $this->arr2 = array();
        $this->arrz = array();
        $this->arrs = array();
        $this->arrow = '|';
        $this->arrzz = array();
        $this->subcatarr = array();
        $this->contentarr = array();
        $this->videoarr = array();

        /*
         *  EOF menu array set
         */



        /*
         *  featurebox array set
         */
        $this->f_arr = array();
        $this->f_product_arr = array();
        /*
         *  EOF featurebox array set
         */
		 
	//add all cache session
	// $this->common_model->Update_Page_Featurebox_Cache();
	//add all cache session
		 
		 
    }

    function DeleteById($table, $id, $field) {

        $delete_row = $this->common_model->GetByRow_notrash($table, $id, $field);

        if (!empty($delete_row)) {

            if ($delete_row->fixed_for_software != 'yes') {

                $this->db->where(array($field => $id));
                $this->db->delete($table);

                if ($table == 'cms_menu') {
                    $this->menu_model->delete_menu_id_tree($id);
                }
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    function GetByRow($table, $eventid, $field) {
        //echo $eventid;
        $this->db->where(array($field => $eventid));
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $result = $this->db->get($table)->row();
    }

    function GetByRow_notrash($table, $eventid, $field) {

        $this->db->where(array($field => $eventid));
        return $result = $this->db->get($table)->row();
    }

    function GetByResult($table, $events) {

        foreach ($events as $key => $event) {

            $this->db->where($key, $event);
        }

        return $result = $this->db->get($table)->result();
    }

    function TrashById($table, $id, $field) {
        $data = array(
            'trash_status' => 'yes',
            'active_status' => 'd',
            'date_deleted' => date("Y-m-d H:i:s")
        );

        $this->db->where(array($field => $id));
        $this->db->update($table, $data);

        if ($table == 'cms_menu') {
            $this->delete_menu_id_tree($id);
        }
    }

    function RestoreById($table, $id, $field) {
        $data = array(
            'trash_status' => 'no',
            'active_status' => 'a',
            'date_restored' => date("Y-m-d H:i:s")
        );

        $this->db->where(array($field => $id));
        $this->db->update($table, $data);


        if ($table == 'cms_menu') {
            $this->restoreMenuTree($id);
        }
    }

    public function get_options() {

        $this->db->select('*');
        $this->db->from('cms_options');
        $this->db->order_by('id', 'asc');
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function restoreMenuTree($id) {
        $last_menu = $this->menu_model->GetByRow_notrash('cms_menu', $id, 'id');

        if ($last_menu->menu_type_3 == 'cms_categories' ||
                $last_menu->menu_type_3 == 1 ||
                $last_menu->menu_type_3 == 2) {

            if (strpos($last_menu->menu_category_type_2, 'content_category') !== false) {

                $this->menu_model->create_menu_id_tree($id, $last_menu->menu_category_type_2_value, 'cms_dynamic_category');
            } else if (strpos($last_menu->menu_category_type_2, 'product_category') !== false) {

                $this->menu_model->create_menu_id_tree($id, $last_menu->menu_category_type_2_value, 'ec_category');
            }
        }
    }

    /*            MENU MODULE
     *            In this section includes menu related functions
     *            Updated On 26-05-2017
     * 
     */

    function clean_name($string) {
        $string = trim($string);
        $string = str_replace(" ", "-", $string);
        $string = str_replace("&", "and", $string);
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
        $string = preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
        $product = strtolower($string);
        return $product;
    }

    function get_first_parent($cid) {
        $j = '';
        $i = $cid;
        while ($i > 0) {
            $this->db->where('id', $i);
            $category = $this->db->get('cms_menu')->row();
            $i = $category->parent_id;
            if ($i > 0) {
                $j = $category->parent_id;
            } else
            if ($i == '0') {
                $j = $category->id;
            }
        }
        return $j;
    }

    /*
     * 28-04-2017
     * Author : Sinto
     * Use : Get categories for menu CMS
     */

    function show_gallery_cats() {

        $this->db->where('parent_id', 0);
        $this->db->where('type', 'image');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('order', 'ASC');
        $this->db->order_by('id', 'ASC');
        $rsMain = $this->db->get('cms_dynamic_category')->result();

        if (count($rsMain) >= 1) {
            foreach ($rsMain as $rows_main) {
                $this->arr[] = array('name' => $rows_main->category, 'route' => $rows_main->route, 'id' => $rows_main->id);
                $this->show_gallery_subs($rows_main->id);
            }
            return $this->arr;
        }
    }

    function show_gallery_subs($cat_id, $dashes = '') {

        $dashes .= '__';
        $this->db->where('parent_id', $cat_id);
        $this->db->where('type', 'image');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('order', 'ASC');
        $this->db->order_by('id', 'ASC');
        $rsSub = $this->db->get('cms_dynamic_category')->result();
        if (count($rsSub) >= 1) {
            foreach ($rsSub as $rows_sub) {
                $this->arr[] = array('name' => $dashes . $rows_sub->category, 'route' => $rows_sub->route, 'id' => $rows_sub->id);
                $this->show_gallery_subs($rows_sub->id, $dashes);
            }
        }
    }

    function show_content_cats() {

        $this->db->where('parent_id', 0);
        $this->db->where('type', 'content_management');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('order', 'ASC');
        $this->db->order_by('id', 'ASC');
        $rsMain = $this->db->get('cms_dynamic_category')->result();

        if (count($rsMain) >= 1) {
            foreach ($rsMain as $rows_main) {
                $this->contentarr[] = array('name' => $rows_main->category, 'route' => $rows_main->route, 'id' => $rows_main->id);
                $this->show_content_subs($rows_main->id);
            }
            return $this->contentarr;
        }
    }

    function show_content_subs($cat_id, $dashes = '') {

        $dashes .= '__';
        $this->db->where('parent_id', $cat_id);
        $this->db->where('type', 'content_management');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('order', 'ASC');
        $this->db->order_by('id', 'ASC');
        $rsSub = $this->db->get('cms_dynamic_category')->result();
        if (count($rsSub) >= 1) {
            foreach ($rsSub as $rows_sub) {
                $this->contentarr[] = array('name' => $dashes . $rows_sub->category, 'route' => $rows_sub->route, 'id' => $rows_sub->id);
                $this->show_gallery_subs($rows_sub->id, $dashes);
            }
        }
    }

    function show_video_cats() {

        $this->db->where('parent_id', 0);
        $this->db->where('type', 'video');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('order', 'ASC');
        $this->db->order_by('id', 'ASC');
        $rsMain = $this->db->get('cms_dynamic_category')->result();

        if (count($rsMain) >= 1) {
            foreach ($rsMain as $rows_main) {
                $this->videoarr[] = array('name' => $rows_main->category, 'route' => $rows_main->route, 'id' => $rows_main->id);
                $this->show_video_subs($rows_main->id);
            }
            return $this->videoarr;
        }
    }

    function show_video_subs($cat_id, $dashes = '') {

        $dashes .= '__';
        $this->db->where('parent_id', $cat_id);
        $this->db->where('type', 'video');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('order', 'ASC');
        $this->db->order_by('id', 'ASC');
        $rsSub = $this->db->get('cms_dynamic_category')->result();
        if (count($rsSub) >= 1) {
            foreach ($rsSub as $rows_sub) {
                $this->videoarr[] = array('name' => $dashes . $rows_sub->category, 'route' => $rows_sub->route, 'id' => $rows_sub->id);
                $this->show_gallery_subs($rows_sub->id, $dashes);
            }
        }
    }

    /*
     * EOF Get categories for menu CMS
     */



    /*
     * 28-04-2017
     * Author Sinto
     * Use: get all contents, images, videos
     */

    function image_gallery_list() {

        $this->db->select('*');
        $this->db->from('cms_media');
        $this->db->where('type', 'image');
        $this->db->where('type2', 'gallery');
        $this->db->where('type_trash', 'no');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function content_list() {
        $this->db->select('*');
        $this->db->from('cms_media');
        $this->db->where('type', 'content_management');
        $this->db->where('type2', 'content');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function video_gallery_list() {
        $this->db->select('*');
        $this->db->from('cms_media');
        $this->db->where('type', 'video');
        $this->db->where('type2', 'video_gallery');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    /*
     * EOF get all contents, images, videos
     */


    /*
     * 22-04-2017
     * Author :Sinto
     * use : get default_category type from ec category types
     */

    function default_product_category() {

        $this->db->select('*');
        $this->db->from('ec_categorytypes');
        $this->db->where('type', 'default_category');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    /*
     * EOF get default_category type from ec category types
     */



    /*
     * 22-04-2017
     * Author :Sinto
     * use : get product_category type from ec category types
     */

    function all_product_category() {

        $this->db->select('*');
        $this->db->from('ec_categorytypes');
        $this->db->where('type ', 'product_category');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    /*
     * EOF get product_category type from ec category types
     */



    /*
     * 26-04-2017
     * Author: Sinto
     * use : get product category list
     */

    function getproductcatlist($default_id, $product_id) {

        $this->db->select('*');
        $this->db->from('ec_products');
        $this->db->where('product_categorytype_id ', $product_id);
        $this->db->like('ctypetree ', '+' . $default_id . '+');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function getcategorylist($default_id) {
        $this->db->select('cat.*,cattype.name as ctype_name');
        $this->db->where('cat.parent_id', 0);
        $this->db->where('cat.active_status', 'a');
        $this->db->where('cat.trash_status', 'no');
        $this->db->where('cat.parent_id', 0);
        $this->db->where('cat.ctype', $default_id);
        $this->db->join('ec_categorytypes cattype', 'cat.ctype = cattype.id', 'INNER');
        $rsMain = $this->db->get('ec_category cat')->result();
        if (count($rsMain) >= 1) {
            foreach ($rsMain as $rows_main) {
                $this->subcatarr[] = array('category' => $rows_main->category, 'id' => $rows_main->id);
                $this->showpcatsubs($rows_main->id, $default_id);
            }
            return $this->subcatarr;
        }
    }

    function showpcatsubs($cat_id, $default_id, $dashes = '') {
        $dashes .= '__';
        $this->db->select('cat.*,cattype.name as ctype_name');
        $this->db->where('cat.parent_id', $cat_id);
        $this->db->where('cat.ctype', $default_id);
        $this->db->where('cat.active_status', 'a');
        $this->db->where('cat.trash_status', 'no');
        $this->db->join('ec_categorytypes cattype', 'cat.ctype = cattype.id', 'INNER');
        $rsSub = $this->db->get('ec_category cat')->result();
        if (count($rsSub) >= 1) {
            foreach ($rsSub as $rows_sub) {
                $this->subcatarr[] = array('category' => $dashes . $rows_sub->category, 'id' => $rows_sub->id);
                $this->showpcatsubs($rows_sub->id, $default_id, $dashes);
            }
        }
    }

    /*
     * EOF get  category list
     */

    function show_page_cats() {

        $this->db->where('type', 'main_page');
        //$this->db->where_not_in('type2', 'menu_page');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('id', 'ASC');
        $rsMainp = $this->db->get('cms_pages')->result();


        if (count($rsMainp) >= 1) {
            foreach ($rsMainp as $rows_main) {
                $this->arrp[] = array('name' => $rows_main->page, 'mid' => $rows_main->menu_id, 'slug' => $rows_main->slug, 'id' => $rows_main->id);
            }
            return $this->arrp;
        }
    }

    function show_menu_subs($cat_id, $dashes = '') {

        $dashes .= '__';
        $this->db->where('parent_id', $cat_id);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('order_no', 'ASC');
        $this->db->order_by('id', 'ASC');
        $rsSub = $this->db->get('cms_menu')->result();
        if (count($rsSub) >= 1) {
            foreach ($rsSub as $rows_sub) {
                $this->arr_m[] = array('name' => $dashes . $rows_sub->category,
                    'id' => $rows_sub->id,
                    'manualAuto' => $rows_sub->menu_category_type_3,
                    'slug2' => $rows_sub->slug2,
                    'categoryslugtree' => $rows_sub->categoryslugtree);
                $this->show_menu_subs($rows_sub->id, $dashes);
            }
        }
    }

    function get_all_menus() {

        $this->db->where('parent_id', 0);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('order_no', 'ASC');
        $this->db->order_by('id', 'ASC');
        $rsMain = $this->db->get('cms_menu')->result();

        if (count($rsMain) >= 1) {
            foreach ($rsMain as $rows_main) {
                $this->arr_m[] = array('name' => $rows_main->category,
                    'id' => $rows_main->id,
                    'manualAuto' => $rows_main->menu_category_type_3,
                    'slug2' => $rows_main->slug2,
                    'categoryslugtree' => $rows_main->categoryslugtree);
                $this->show_menu_subs($rows_main->id);
            }
            return $this->arr_m;
        }
    }


    /*
     * Function Get the first parent
     */

    function get_first_parent_tree($cid) {
        $j = '';
        $i = $cid;
        $catids = '';
        $catnames = '';
        $catslugs = '';
        $catfull = '';
        while ($i > 0) {
            $this->db->where('id', $i);
            $this->db->where('trash_status', 'no');
//            $this->db->where('active_status', 'a');
            $category = $this->db->get('cms_menu')->row();
            $i = $category->parent_id;

            $catids .= $category->id . '+';
            $catnames .= strtolower($category->category) . '+';
            $catslugs .= $category->slug . '+';

            $catfull .= $category->id . '__' . strtolower($category->category) . '__' . $category->slug . '+';

            if ($i > 0) {
                $j = $category->parent_id . '**' . $category->category . '**' . $category->slug;

                $catids .= $category->parent_id . '+';
                $catnames .= strtolower($category->category) . '+';
                $catslugs .= $category->slug . '+';

                $catfull .= $category->id . '__' . strtolower($category->category) . '__' . $category->slug . '+';
            } else
            if ($i == '0') {
                $j = $category->id . '**' . $category->category . '**' . $category->slug;

                $catids .= $category->id . '+';
                $catnames .= strtolower($category->category) . '+';
                $catslugs .= $category->slug . '+';

                $catfull .= $category->id . '__' . strtolower($category->category) . '__' . $category->slug . '+';
            }
        }

        $alldata = $catids . '**' . $catnames . '**' . $catslugs . '**' . $catfull;
        return $j . '___' . $alldata;
    }

    /*
     * EOFunction Get the first parent
     */

    /* Function pass_tree_values takes one argument and return an array. */

    function pass_tree_values($catid_val, $c_id) {


        $parent_cat_result = $this->menu_model->get_first_parent_tree($catid_val);
        $current_field = $this->menu_model->GetByRow_notrash('cms_menu', $c_id, 'id');

        if ($current_field->parent_id == 0) {
            $current_ids = '';
            $current_names = '';
            $current_slugs = '';
            $current_full = '';
        } else {
            $current_ids = '+' . $current_field->id;
            $current_names = '+' . strtolower($current_field->category);
            $current_slugs = '+' . $current_field->slug;
            $current_full = '+' . $current_ids . '_' . $current_names . '_' . $current_slugs;
        }


        $parent_cat_result = explode('___', $parent_cat_result);
        $parent_cat_splited = explode('**', $parent_cat_result[0]);
        $cat_parent_id = $parent_cat_splited[0];
        $cat_parent_name = $parent_cat_splited[1];
        $cat_parent_route = $parent_cat_splited[2];

        $parent_cat_splited2 = explode('**', $parent_cat_result[1]);

        $category_ids = $parent_cat_splited2[0];
        $category_ids = explode('+', $category_ids);
        $category_ids = array_filter($category_ids);
        $category_ids = array_unique($category_ids);
        $category_ids = implode('+', $category_ids);
        $category_ids = $current_ids . '+' . $category_ids . '+';

        $category_names = $parent_cat_splited2[1];
        $category_names = explode('+', $category_names);
        $category_names = array_filter($category_names);
        $category_names = array_unique($category_names);
        $category_names = implode('+', $category_names);
        $category_names = $current_names . '+' . $category_names . '+';

        $category_slugs = $parent_cat_splited2[2];
        $category_slugs = explode('+', $category_slugs);
        $category_slugs = array_filter($category_slugs);
        $category_slugs = array_unique($category_slugs);
        $category_slugs = implode('+', $category_slugs);
        $category_slugs = $current_slugs . '+' . $category_slugs . '+';

        $category_full = $parent_cat_splited2[3];
        $category_full = explode('+', $category_full);
        $category_full = array_filter($category_full);
        $category_full = array_unique($category_full);
        $category_full = implode('+', $category_full);
        $category_full = $current_full . '+' . $category_full . '+';

        $tree_arr = array('category_ids' => $category_ids,
            'category_names' => $category_names,
            'category_slugs' => $category_slugs,
            'cat_parent_id' => $cat_parent_id,
            'cat_parent_name' => $cat_parent_name,
            'cat_parent_route' => $cat_parent_route,
        );
        return $tree_arr;
    }

    /* EOF Function pass_tree_values takes one argument and return an array. */

    /*
     * 22-05-2017
     * Author:Sinto
     * Use : check slug already exist or not
     */

    function select_handleslug() {

        if ($this->input->post('url_type') == 'seo_url') {

            if ($this->input->post('parentid') != 0) {

                $full_slug = $this->input->post('full_url_sec') . '/' . $this->input->post('mslug');
            } else {

                $full_slug = $this->input->post('mslug');
            }
        } elseif ($this->input->post('url_type') == 'force_url') {

            $full_slug = $this->input->post('mslug');
        }

        $form_type = $this->input->post('form_type');
        $id = $this->input->post('id');

        $this->db->select('*');
        $this->db->from('cms_menu');
        $this->db->where('full_slug', $full_slug);

        if (!empty($id) && $form_type == "edit") {
            $this->db->where("id !=", $id);
        }
        $query1 = $this->db->get();
        $num1 = $query1->num_rows();

        if ($num1 != 0) {

            return TRUE;
        }
//        }
    }

    /*
     * EOF check slug already exist or not
     */
   
    function replaceFromtree($idtree, $id) {

        $newtree = str_replace("+" . $id . "+", "+", $idtree);
        return $newtree;
    }

    function remove_json_row($json, $field, $to_find) {

        for ($i = 0, $len = count($json); $i < $len; ++$i) {
            if ($json[$i][$field] === $to_find) {
                array_splice($json, $i, 1);
            }
        }
        return $json;
    }

    /*
     * EOF second wizard for menu module
     */
   
    function randomString($length = 6) {
        $str = "";
        $characters = range('a', 'z');
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }

    /*
     * EOF create random string for pages, pagename and slug
     */

    function count_all_menu() {

        if (isset($_GET['sort_radio'])) {
            if (isset($_GET['custom_sort'])) {
                $custom_value = $_GET['custom_sort'];
                $sort_value = $_GET['sort_radio'];

                switch ($sort_value) {
                    case 'id':
                        $this->db->order_by('id', $custom_value);
                        break;

                    case 'order':
                        $this->db->order_by('order_no', $custom_value);
                        break;
                }
            }
        }


        if (isset($_GET['name'])) {

            $search = $_GET['name'];
//            dump($search);die();
            $s_a = str_replace("123", "&", $search);

            $s_a = str_replace("-", " ", $s_a);

            $this->db->like('category', $s_a);
//           $this->db->or_like('field_label', $s_a);
//            $this->db->where("( name LIKE '%".$s_a."%' OR field_label LIKE '%".$s_a."%' )");
        }


        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            $this->db->where('active_status', $status);
        } else {
            // $this->db->where('active_status', 'a');
        }

        if (isset($_GET['ftype'])) {
            $type = '+'.$_GET['ftype'].'+';
            $this->db->like('menu_type_tree', $type);
        }

        if (isset($_GET['category'])) {
            $category = $_GET['category'];
            $this->db->like('id', $category);
        }


//        if ($this->uri->segment(3) != '0' && $this->uri->segment(3) != 'All') {
//
//            $spid = $this->uri->segment(3);
//            $this->db->where('parent_id', $spid);
//        }


        $this->db->where('trash_status', 'no');
//        $this->db->where('active_status', 'a');
        $val = $this->db->get('cms_menu');
        return $val->num_rows();
    }

    function list_menus($perpage, $rec_from) {

        if (isset($_GET['sort_radio'])) {
            if (isset($_GET['custom_sort'])) {
                $custom_value = $_GET['custom_sort'];
                $sort_value = $_GET['sort_radio'];

                switch ($sort_value) {
                    case 'id':
                        $this->db->order_by('id', $custom_value);
                        break;

                    case 'order':
                        $this->db->order_by('order_no', $custom_value);
                        break;
                }
            }
        } else {
            $this->db->order_by('id', 'DESC');
        }



        if (isset($_GET['name'])) {

            $search = $_GET['name'];
//            dump($search);die();
            $s_a = str_replace("123", "&", $search);

            $s_a = str_replace("-", " ", $s_a);

            $this->db->like('category', $s_a);
//           $this->db->or_like('field_label', $s_a);
//            $this->db->where("( name LIKE '%".$s_a."%' OR field_label LIKE '%".$s_a."%' )");
        }


        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            $this->db->where('active_status', $status);
        } else {
            // $this->db->where('active_status', 'a');
        }
        
        if (isset($_GET['ftype'])) {
            $type = '+'.$_GET['ftype'].'+';
            $this->db->like('menu_type_tree', $type);
        }

        if (isset($_GET['category'])) {
            $category = $_GET['category'];
            $this->db->like('id', $category);
        }


//        if ($this->uri->segment(3) != '0' && $this->uri->segment(3) != 'All') {
//
//            $spid = $this->uri->segment(3);
//            $this->db->where('id', $spid);
//        }

        $this->db->where('trash_status', 'no');
//        $this->db->where('active_status', 'a');

        $this->db->limit($perpage, $rec_from);
        return $this->db->get('cms_menu')->result();
    }

    /*
     * List all Categories  and sub categories in a dropdown
     */

    function showcategory() {
        $ctype = '1';
        $category_type_row = $this->menu_model->GetByRow_notrash('ec_categorytypes', 'category', 'fixed_type');
        if (!empty($category_type_row->id)) {
            $ctype = $category_type_row->id;
        }

        $this->db->where('parent_id', 0);
        $this->db->where('ctype', $ctype); // this line used for select category
        $this->db->where('active_status', 'a');
        $this->db->where('trash_status', 'no');
        $rsMain = $this->db->get('ec_category')->result();
        if (count($rsMain) >= 1) {
            foreach ($rsMain as $rows_main) {
                $this->product_arr[] = array('name' => $rows_main->category, 'slug' => $rows_main->slug, 'id' => $rows_main->id);
                //$this->showsubs($rows_main->id);   (Exception case only show parent category only)
            }
            return $this->product_arr;
        }
    }

    function showsubs($cat_id, $dashes = '') {

        $ctype = '1';
        $category_type_row = $this->menu_model->GetByRow_notrash('ec_categorytypes', 'category', 'fixed_type');
        if (!empty($category_type_row->id)) {
            $ctype = $category_type_row->id;
        }

        $dashes .= '__';
        $this->db->where('parent_id', $cat_id);
        $this->db->where('ctype', $ctype); // this line used for select category
        $this->db->where('active_status', 'a');
        $this->db->where('trash_status', 'no');
        $rsSub = $this->db->get('ec_category')->result();
        if (count($rsSub) >= 1) {
            foreach ($rsSub as $rows_sub) {
                $this->product_arr[] = array('name' => $dashes . $rows_sub->category, 'slug' => $rows_sub->slug, 'id' => $rows_sub->id);
                $this->showsubs($rows_sub->id, $dashes);
            }
        }
    }

    /*
     * EOF List all Categories and sub categories in a dropdown
     */

    function count_all_trash_menu() {
        $this->db->where('trash_status', 'yes');
        $this->db->where('active_status', 'd');
        $val = $this->db->get('cms_menu');
        return $val->num_rows();
    }

    function list_trash_menus($perpage, $rec_from) {
        $this->db->where('trash_status', 'yes');
        $this->db->where('active_status', 'd');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($perpage, $rec_from);
        return $this->db->get('cms_menu')->result();
    }
    
    function array_push_assoc($array, $key, $value) {
        $array[$key] = $value;
        return $array;
    }    

    function check_type($id) {
        $this->db->where('id', $id);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('cms_dynamic_category')->row();
    }   
   
    function count_all_pages() {

        $this->db->where('type', 'main_page');
        $this->db->where('active_status', 'a');
        $this->db->where('trash_status', 'no');
        $this->db->order_by('id', 'ASC');
        $numfound = $this->db->get('cms_pages');
        return $numfound->num_rows();
    }

    function listpages($perpage, $rec_from) {

        $this->db->where('type', 'main_page');
        $this->db->where('active_status', 'a');
        $this->db->where('trash_status', 'no');
        $this->db->order_by('id', 'ASC');
        $this->db->limit($perpage, $rec_from);
        return $this->db->get('cms_pages')->result();
    }
   
    function p_showcategory() {

        $ctype = '1';
        $category_type_row = $this->menu_model->GetByRow_notrash('ec_categorytypes', 'category', 'fixed_type');
        if (!empty($category_type_row->id)) {
            $ctype = $category_type_row->id;
        }

        $this->db->where('parent_id', 0);
        $this->db->where('ctype', $ctype); // this line used for select category
        $this->db->where('active_status', 'a');
        $this->db->where('trash_status', 'no');
        $rsMain = $this->db->get('ec_category')->result();
        if (count($rsMain) >= 1) {
            foreach ($rsMain as $rows_main) {
                $this->f_product_arr[] = array('name' => $rows_main->category, 'slug' => $rows_main->slug, 'id' => $rows_main->id);
                $this->showsubs($rows_main->id);
            }
            return $this->f_product_arr;
        }
    }

    function p_showsubs($cat_id, $dashes = '') {

        $ctype = '1';
        $category_type_row = $this->menu_model->GetByRow_notrash('ec_categorytypes', 'category', 'fixed_type');
        if (!empty($category_type_row->id)) {
            $ctype = $category_type_row->id;
        }

        $dashes .= '__';
        $this->db->where('parent_id', $cat_id);
        $this->db->where('ctype', $ctype);   // this line used for select category
        $this->db->where('active_status', 'a');
        $this->db->where('trash_status', 'no');
        $rsSub = $this->db->get('ec_category')->result();
        if (count($rsSub) >= 1) {
            foreach ($rsSub as $rows_sub) {
                $this->f_product_arr[] = array('name' => $dashes . $rows_sub->category, 'slug' => $rows_sub->slug, 'id' => $rows_sub->id);
                $this->showsubs($rows_sub->id, $dashes);
            }
        }
    }
    
    function menu_list() {
        $this->db->select('*');
        $this->db->from('cms_menu');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }  
    
    function targetlist() {

        $tglocation = array('_self', '_blank');
        return $tglocation;
    }
  
    function pagelist() {
        $this->db->select('*');
        $this->db->from('cms_pages');
        $this->db->where('type', 'main_page');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }
       
    function arr_reverse($categryslugs) {
        $categryslugs = explode('+', $categryslugs);
        $categryslugs = array_filter($categryslugs);
        $categryslugs = array_unique($categryslugs);
        $categryslugs = array_reverse($categryslugs);
        $categryslugs = implode('/', $categryslugs);
        return $categryslugs;
    }    

    function get_distinct_menu_type() {
        $this->db->group_by('menu_type');
        $this->db->where('trash_status', 'no');
        return $this->db->get('cms_menu')->result();
    }
	
    function get_all_menu_types() {
        $this->db->where('parent_id', 0);
        $this->db->where('type', 'menu_type');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('cms_dynamic_category')->result();
    }
	

//    menu type start

    function add_menu_type() {
        $category_name = $this->input->post('catname');
        $category_clean_name = $this->menu_model->clean_name($category_name);     

        $data = array(
            'parent_id' => 0,
            'type' => 'menu_type',
            'category' => $this->input->post('catname'),
            'slug' => $this->input->post('slug'),
            'route' => $category_clean_name,
            'order' => $this->input->post('order_number'),
            'date' => date('Y-m-d H:i:s')
        );
        $this->db->insert('cms_dynamic_category', $data);
    }

    function select_menu_type_slug() {
        $slug = $this->input->post('slug');
        $this->db->where('slug', $slug);
        $this->db->where('type', 'menu_type');
        return $this->db->get('cms_dynamic_category')->row();
    }

    function select_menu_type_slug1() {
        $id = $this->uri->segment(3);

        $slug = $this->input->post('slug');
        $this->db->where('slug', $slug);
        $this->db->where('id !=', $id);
        $this->db->where('type', 'menu_type');
        return $this->db->get('cms_dynamic_category')->row();
    }

    function count_all_menu_type() {
        $this->db->where('parent_id', 0);
        $this->db->where('type', 'menu_type');

        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');

        $val = $this->db->get('cms_dynamic_category');
        return $val->num_rows();
    }

    function list_menu_type($perpage, $rec_from) {

        $this->db->where('parent_id', 0);
        $this->db->where('type', 'menu_type');
        $this->db->limit($perpage, $rec_from);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('cms_dynamic_category')->result();
    }

    function edit_menu_type($id) {

        $category_name = $this->input->post('catname');
        $category_clean_name = $this->menu_model->clean_name($category_name);
      
            $data = array(
                'parent_id' => 0,
                'type' => 'menu_type',
                'category' => $this->input->post('catname'),
                'slug' => $this->input->post('slug'),
                'route' => $category_clean_name,
                'order' => $this->input->post('order_number')
            );

        $this->db->where('id', $id);
        $this->db->update('cms_dynamic_category', $data);
    }

    function trash_count_all_menu_type() {
        $this->db->where('parent_id', 0);
        $this->db->where('type', 'menu_type');
        $this->db->where('trash_status', 'yes');
        $this->db->where('active_status', 'd');

        $val = $this->db->get('cms_dynamic_category');
        return $val->num_rows();
    }

    function trash_list_menu_type($perpage, $rec_from) {

        $this->db->where('parent_id', 0);
        $this->db->where('type', 'menu_type');
        $this->db->where('trash_status', 'yes');
        $this->db->where('active_status', 'd');
        $this->db->limit($perpage, $rec_from);
        return $this->db->get('cms_dynamic_category')->result();
    }
    
    function GetAllTables() {
        return $this->db->list_tables();
    }

    function GetAllColumn($table, $table_column = '') {
        $table_column_arr = array();
//        $table_column_arr = json_decode($table_column, TRUE);
        if ($table != '') {
            $data = $this->db->list_fields($table);
            foreach ($data as $key => $option) {
                $selecetd = '';
                if ($option == $table_column) {
                    $selecetd = 'selected';
                }
                echo '<option ' . $selecetd . ' value=' . $option . '>' . $option . '</option>';
            }
        }
    }

    
    public function checkName($name) {
//       $this->db->where('active_status', 'a');
//       $this->db->where('trash_status', 'no');      
    }  

    public function sort_segments() {
        if (isset($_GET['name'])) {
            $s_a = $_GET['name'];

            $this->db->like('name', $s_a);
        }

        if (isset($_GET['sort_radio'])) {
            if (isset($_GET['custom_sort'])) {
                $custom_value = $_GET['custom_sort'];
                $sort_value = $_GET['sort_radio'];

                switch ($sort_value) {
                    case 'id':
                        $this->db->order_by('id', $custom_value);
                        break;

                    case 'name':
                        $this->db->order_by('name', $custom_value);
                        break;
                }
            }
        } else {
            $this->db->order_by('id', 'DESC');
        }

        if (isset($_GET['type'])) {
            $type = $_GET['type'];
            $this->db->where('subtype', $type);
        }
    }

    public function check_name_edit($id, $name) {
        //$this->db->where('trash_status', 'no');
        // $this->db->where('id !=', $id);        
    }
      
    public function getSortArray() {
        $array = array('id', 'name');
        return $array;
    }

    public function getStatusArray() {
        $array = array('asc' => 'ascending', 'desc' => 'descending', 'random' => 'random');
        return $array;
    }
   		
    function addMenu(){
        $menu_type_tree = '';
        if (!empty($this->input->post('menu_type'))) {
                $menu_type_tree .= '+'.$this->input->post('menu_type').'+';

        }
        
        $menu_status = "";
        
        if ($this->input->post('home_menu_status') == 'yes') {
                $menu_status = $this->input->post('home_menu_status');

                $menu_status_exists = $this->common_model->GetByRow('cms_menu', 'yes', 'home_menu_status');

                if (!empty($menu_status_exists)) {
                    $data_exists = array(
                        'home_menu_status' => '',
                    );
                    $this->db->where('id', $menu_status_exists->id);
                    $this->db->update('cms_menu', $data_exists);
                }
            }
            
            
        $sub_menu_status = "";   
        if ($this->input->post('sub_menu_status') == 'yes') {
            $sub_menu_status = $this->input->post('sub_menu_status');
        }
        
            
        
        $type3 = '';
                if ($this->input->post('customlink') == 'internal') {
                    $type2 = 'slug';
                    $type3 = $this->input->post('slug');


                } elseif ($this->input->post('customlink') == 'external') {

                    $type2 = 'link';
                    $type3 = $this->input->post('url');
                }

                $data_link = array(
                    'link_type' => $this->input->post('customlink'),
                    'link_text' => $this->input->post('linktxt'),
                    'target_type' => $this->input->post('target_type'),
                    'type2' => $type2,
                    'type3' => $type3,
                );

                $custom_link_json = json_encode($data_link);   
                        
            
            $data = array(
                'parent_id' => $this->input->post('parentid'),
                'category' => $this->input->post('menuname'),            
                'url_key' => 'menu_route',           
                'order_no' => $this->input->post('order_number'),
                'home_menu_status' => $menu_status,
                'trash_status' => 'no',
                'active_status' => $this->input->post('active_status'),
                'menu_type_tree' => $this->input->post('menu_type'),
                'fixed_link_status' => $this->input->post('fixed_link_status'),
                'sub_menu_type' => 'Normal',
                'sub_menu_status' => $sub_menu_status,
                'custom_link' => $custom_link_json,
                "iconClass" => $this->input->post('icon_class'),
                "attribute" => $this->input->post('attribute')
            );
            
            $this->db->insert('cms_menu', $data);
            $id = $insert_menu_id = $this->db->insert_id();
            
            
            $get_val = $this->menu_model->pass_tree_values($id, $id);

            $parent_id = $this->input->post('parentid');
            if ($parent_id != 0) {

                $main_parent_id = $this->menu_model->get_first_parent($parent_id, $id);
                $data1 = array(
                    'main_parent_id' => $main_parent_id,
                );

                $parent_details = $this->menu_model->GetByRow('cms_menu', $parent_id, 'id');

                $get_val = $this->menu_model->pass_tree_values($parent_id, $id);

                $data2 = array(
                    'categoryidtree' => $get_val['category_ids'],
                    'categorynametree' => $get_val['category_names'],

                    'parent_main_id' => $get_val['cat_parent_id'],

                    'parent_sub_id' => $parent_id
                );
            } else if ($parent_id == 0) {
                $main_parent_id = $id;
                $data1 = array(
                    'main_parent_id' => $main_parent_id,
                );

                $data2 = array(
                    'categoryidtree' => $get_val['category_ids'],
                    'categorynametree' => $get_val['category_names'],

                    'parent_main_id' => $id,

                    'parent_sub_id' => $id
                );
            }
            $this->db->where('id', $id);
            $this->db->update('cms_menu', $data1);


            $this->db->where('id', $id);
            $this->db->update('cms_menu', $data2);        

            return $id;

    }

 function editMenu($id){
     $menu_type_tree = '';
    if (!empty($this->input->post('menu_type'))) {
            $menu_type_tree .= '+'.$this->input->post('menu_type').'+';

    }
    
    $menu_status = "";
    
    if ($this->input->post('home_menu_status') == 'yes') {
            $menu_status = $this->input->post('home_menu_status');

            $menu_status_exists = $this->common_model->GetByRow('cms_menu', 'yes', 'home_menu_status');

            if (!empty($menu_status_exists)) {
                $data_exists = array(
                    'home_menu_status' => '',
                );
                $this->db->where('id', $menu_status_exists->id);
                $this->db->update('cms_menu', $data_exists);
            }
        }
        
    $sub_menu_status = "";   
     if ($this->input->post('sub_menu_status') == 'yes') {
         $sub_menu_status = $this->input->post('sub_menu_status');
     }    
     
      $type3 = '';
            if ($this->input->post('customlink') == 'internal') {
                $type2 = 'slug';
                $type3 = $this->input->post('slug');


            } elseif ($this->input->post('customlink') == 'external') {

                $type2 = 'link';
                $type3 = $this->input->post('url');
            }

            $data_link = array(
                'link_type' => $this->input->post('customlink'),
                'link_text' => $this->input->post('linktxt'),
                'target_type' => $this->input->post('target_type'),
                'type2' => $type2,
                'type3' => $type3,
            );

            $custom_link_json = json_encode($data_link);   
        
     $data = array(
            'parent_id' => $this->input->post('parentid'),
            'category' => $this->input->post('menuname'),           
            'url_key' => 'menu_route',           
            'order_no' => $this->input->post('order_number'),
            'home_menu_status' => $menu_status,
            'trash_status' => 'no',
            'active_status' => $this->input->post('active_status'),
            'menu_type_tree' => $this->input->post('menu_type'),
            'fixed_link_status' => $this->input->post('fixed_link_status'),
            'sub_menu_type' => 'Normal',
            'sub_menu_status' => $sub_menu_status,
            'custom_link' => $custom_link_json,
            'iconClass' => $this->input->post('icon_class'),
            'attribute' => $this->input->post('attribute')
        ); 
     
        $this->db->where('id', $id);
        $this->db->update('cms_menu', $data);
        
        $get_val = $this->menu_model->pass_tree_values($id, $id);
        
        $parent_id = $this->input->post('parentid');
        
        if ($parent_id != 0) {

            $main_parent_id = $this->menu_model->get_first_parent($parent_id, $id);
            $data1 = array(
                'main_parent_id' => $main_parent_id,
            );

            $parent_details = $this->menu_model->GetByRow('cms_menu', $parent_id, 'id');

            $get_val = $this->menu_model->pass_tree_values($parent_id, $id);

            $data2 = array(
                'categoryidtree' => $get_val['category_ids'],
                'categorynametree' => $get_val['category_names'],
                'parent_main_id' => $get_val['cat_parent_id'],
                'parent_sub_id' => $parent_id
            );
        } else if ($parent_id == 0) {
            $main_parent_id = $id;
            $data1 = array(
                'main_parent_id' => $main_parent_id,
            );

            $data2 = array(
                'categoryidtree' => $get_val['category_ids'],
                'categorynametree' => $get_val['category_names'],
                'parent_main_id' => $id,
                'parent_sub_id' => $id
            );
        }
        
        $this->db->where('id', $id);
        $this->db->update('cms_menu', $data1);
        
        $this->db->where('id', $id);
        $this->db->update('cms_menu', $data2);
        
 }                   

 function editMenu2New($id){
        $data = array(
            "iconClass" => $this->input->post('icon_class'),
            "attribute" => $this->input->post('attribute')
        );

        $banner_images_str = $this->input->post('final_images');
        $banner_images = explode(',', $banner_images_str);
        $menu_detail = $this->menu_model->GetByRow_notrash('cms_menu', $id, 'id');
        
        $fixed_link_status = $menu_detail->fixed_link_status;
        
        if($fixed_link_status == 'no'){
            $type3 = '';
            if ($this->input->post('customlink') == 'internal') {
                $type2 = 'slug';
                $type3 = $this->input->post('slug');


            } elseif ($this->input->post('customlink') == 'external') {

                $type2 = 'link';
                $type3 = $this->input->post('url');
            }

            $data_link = array(
                'link_type' => $this->input->post('customlink'),
                'link_text' => $this->input->post('linktxt'),
                'target_type' => $this->input->post('target_type'),
                'type2' => $type2,
                'type3' => $type3,
            );

            $custom_link_json = json_encode($data_link);   
            
            $data = $this->menu_model->array_push_assoc($data, 'custom_link', $custom_link_json);

        }
        
        if ($this->input->post('seo_alt') != "") {

            $seo_alt = $this->input->post('seo_alt');
        } else {

            $seo_alt = $menu_detail->category;
        }
        if ($this->input->post('seo_title') != "") {

            $seo_title = $this->input->post('seo_title');
        } else {

            $seo_title = $menu_detail->category;
        }
        
        $mediaID = $this->input->post('mediaID');
        
        if ($banner_images_str != "") {
            $bannerID = array();


            $data_mediaID = array(
                'type_trash' => 'yes'
            );

            $this->db->where('id', $mediaID);
            $this->db->update('cms_media', $data_mediaID);





            $image_array = array();

            foreach ($banner_images as $banner) {

                $image_array = array(
                    'image' => $banner,
                    'combo' => $this->input->post('combo'),
                    'seo_alt' => $seo_alt,
                    'seo_title' => $seo_title,
                );

                $image_encode = json_encode($image_array);

                $data_media = array(
                    'type' => 'menu_image',
                    'type2' => 'menuimg',
                    'type_trash' => 'no',
                    'images' => $image_encode
                );

                $this->db->insert('cms_media', $data_media);
                $bannerID[] = $this->db->insert_id();
            }

            $image_array1 = array();
            $j = 0;
            foreach ($banner_images as $banner) {

                $image_array1[] = array(
                    'image' => $banner,
                    'combo' => $this->input->post('combo'),
                    'media_id' => $bannerID[$j],
                    'seo_alt' => $seo_alt,
                    'seo_title' => $seo_title
                );
                $j++;
            }

            $image_encode1 = json_encode($image_array1);

            $data = $this->menu_model->array_push_assoc($data, 'images', $image_encode1);
            
            $this->db->where('id', $id);
            $this->db->update('cms_menu', $data);
        }else {
          if($mediaID != ''){          
            $image_detail_a = $this->GetByRow_notrash('cms_media', $mediaID, 'id');
            $exist_image_detail_a = json_decode($image_detail_a->images, TRUE);


            $image_array_a = array(
                'image' => $exist_image_detail_a['image'],
                'combo' => $exist_image_detail_a['combo'],
                'seo_alt' => $seo_alt,
                'seo_title' => $seo_title,
            );


            $image_encode_a = json_encode($image_array_a);

            $data_a = array();
            $data_a = $this->array_push_assoc($data_a, 'images', $image_encode_a);

            $this->db->where('id', $mediaID);
            $this->db->update('cms_media', $data_a);
            
            
           $exist_image_detail_b = json_decode($menu_detail->images, TRUE); 
            $image_array_b[] = array(
                    'image' => $exist_image_detail_b[0]['image'],
                    'combo' => $exist_image_detail_b[0]['combo'],
                    'media_id' => $mediaID,
                    'seo_alt' => $seo_alt,
                    'seo_title' => $seo_title
                );
            
            $image_encode_b = json_encode($image_array_b);

            $data = $this->menu_model->array_push_assoc($data, 'images', $image_encode_b);
            
            
        }
            $this->db->where('id', $id);
            $this->db->update('cms_menu', $data);
      }
 }

}
