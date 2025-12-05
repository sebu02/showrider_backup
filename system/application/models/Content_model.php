<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Content_model
        extends CI_Model {

    function __construct() {
        parent::__construct();
        //$this->output->enable_profiler(FALSE);
        $this->tree = array();
        $this->parent = '';
        $this->arr = array();
        $this->arr_b = array();
        $this->arr2 = array();
        $this->arrz = array();
        $this->arrs = array();
        $this->arrow = '|';
        $this->arrzz = array();
        $this->arr_m = array();

        $this->cms_arr = array(
            'content_management',
            'image',
            'video');
        $this->cms_arr2 = array(
            'content',
            'image_content',
            'video_content');
        $this->cms_type2_arr = array(
            'content',
            'gallery',
            'video_gallery');
      
    }

    function GetByRow($table, $eventid, $field) {
        //echo $eventid;
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->where(array(
            $field => $eventid));

        return $result = $this->db->get($table)->row();
    }

    function GetByRow_notrash($table, $eventid, $field) {

        $this->db->where(array(
            $field => $eventid));
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

        $this->db->where(array(
            $field => $id));

        $this->db->delete($table);
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

    function select_all_category_types() {
        $this->db->where('type', 'default_category');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('ec_categorytypes')->result();
    }

    function showcategory_classi($ctype) {
        $this->db->select('cat.*,cattype.name as ctype_name');
        $this->db->where('cat.parent_id', 0);
        $this->db->where('cat.active_status', 'a');
        $this->db->where('cat.trash_status', 'no');
        $this->db->where('cat.parent_id', 0);
        $this->db->where('cat.ctype', $ctype);
        $this->db->join('ec_categorytypes cattype', 'cat.ctype = cattype.id', 'INNER');
        $rsMain = $this->db->get('ec_category cat')->result();
        if (count($rsMain) >= 1) {
            foreach ($rsMain as $rows_main) {
                $this->arr_b[] = array(
                    'name' => $rows_main->category,
                    'id' => $rows_main->id,
                    'parent_id' => $rows_main->parent_id,
                    'ctype' => $rows_main->ctype,
                    'categoryslugtree' => $rows_main->categoryslugtree,
                    'ctype_name' => $rows_main->ctype_name);
                $this->showsubs_classi($rows_main->id, $ctype);
            }
            return $this->arr_b;
        }
    }

    function showsubs_classi($cat_id, $ctype, $dashes = '') {
        $dashes .= '__';
        $this->db->select('cat.*,cattype.name as ctype_name');
        $this->db->where('cat.parent_id', $cat_id);
        $this->db->where('cat.ctype', $ctype);
        $this->db->where('cat.active_status', 'a');
        $this->db->where('cat.trash_status', 'no');
        $this->db->join('ec_categorytypes cattype', 'cat.ctype = cattype.id', 'INNER');
        $rsSub = $this->db->get('ec_category cat')->result();
        if (count($rsSub) >= 1) {
            foreach ($rsSub as $rows_sub) {
                $this->arr_b[] = array(
                    'name' => $dashes . $rows_sub->category,
                    'id' => $rows_sub->id,
                    'parent_id' => $rows_sub->parent_id,
                    'ctype' => $rows_sub->ctype,
                    'categoryslugtree' => $rows_sub->categoryslugtree,
                    'ctype_name' => $rows_sub->ctype_name);
                $this->showsubs_classi($rows_sub->id, $ctype, $dashes);
            }
        }
    }

    function add_category() {
        
        $content_inputs_tree = '';
        
        if ($this->input->post('url_type') == 'seo_url') {

            if ($this->input->post('parentname') != 0) {

                $full_slug = $this->input->post('full_url_sec') . '/' . $this->input->post('slug');
            } else {

                $full_slug = $this->input->post('slug');
            }
        } elseif ($this->input->post('url_type') == 'force_url') {

            $full_slug = $this->input->post('slug');
        } else {

            $full_slug = $this->input->post('slug');
        }

        $category_name = $this->input->post('catname');

        $category_clean_name = $this->content_model->clean_name($category_name);

        $image_array = array();

        $i = 0;
      
        $image_array1 = array();
        $j = 0;
    
        $data = array(
            'parent_id' => $this->input->post('parentname'),
            'type' => 'content_management',
            'type2' => 'content',
            'category' => $this->input->post('catname'),
            'slug' => $this->input->post('slug'),
            'slug2' => $this->input->post('slug'),
            'url_key' => 'content_category_route',
            'slug_type' => $this->input->post('url_type'),
            'full_slug' => $full_slug,
            'route' => $category_clean_name,
            'order' => $this->input->post('order_number'),
            'cms_type' => 48,
            'date' => date('Y-m-d H:i:s'),
            'trash_status' => 'no',
            'active_status' => $this->input->post('active_status'),
            'category_default_combo_id' => $this->input->post('default_combo_id'),
            'parent_page_id' => $this->input->post('parent_page')
        );

        $this->db->insert('cms_dynamic_category', $data);
        $catid_val = $this->db->insert_id();

        $get_val = $this->content_model->pass_tree_values($catid_val, $catid_val, 'category');

        if ($this->input->post('parentname') != 0) {

            $parent_details = $this->content_model->GetByRow('cms_dynamic_category', $this->input->post('parentname'), 'id');
            $parent_category_slug = $parent_details->slug;
            $get_val = $this->content_model->pass_tree_values($this->input->post('parentname'), $catid_val, 'category');

            $data2 = array(
                'categoryidtree' => $get_val['category_ids'],
                'categorynametree' => $get_val['category_names'],
                'categoryslugtree' => $get_val['category_slugs'],
                'parent_main_slug' => $get_val['cat_parent_route'],
                'parent_main_id' => $get_val['cat_parent_id'],
                'parent_sub_slug' => $parent_details->slug,
                'parent_sub_id' => $this->input->post('parentname')

            );
        } else {

            $option = $this->common_model->get_options();

            $data2 = array(
                'categoryidtree' => $get_val['category_ids'],
                'categorynametree' => $get_val['category_names'],
                'categoryslugtree' => $get_val['category_slugs'],
                'parent_main_slug' => $this->input->post('slug'),
                'parent_main_id' => $catid_val,
                'parent_sub_slug' => $this->input->post('slug'),
                'parent_sub_id' => $catid_val

            );
        }

        $this->db->where('id', $catid_val);
        $this->db->update('cms_dynamic_category', $data2);
        
        return $catid_val;
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

    function select_category_slug() {
        if ($this->input->post('url_type') == 'seo_url') {

            if ($this->input->post('parentname') != 0) {

                $full_slug = $this->input->post('full_url_sec') . '/' . $this->input->post('slug');
            } else {

                $full_slug = $this->input->post('slug');
            }
        } elseif ($this->input->post('url_type') == 'force_url') {

            $full_slug = $this->input->post('slug');
        }
        $this->db->where('full_slug', $full_slug);
        return $this->db->get('cms_dynamic_category')->row();
    }

    function select_category_slug1() {
//        $id = $this->uri->segment(3);
        $id = '';
        if (isset($_GET['id'])) {

            $id = $_GET['id'];
        }

        if ($this->input->post('url_type') == 'seo_url') {

            if ($this->input->post('parentname') != 0) {

                $full_slug = $this->input->post('full_url_sec') . '/' . $this->input->post('slug');
            } else {

                $full_slug = $this->input->post('slug');
            }
        } elseif ($this->input->post('url_type') == 'force_url') {

            $full_slug = $this->input->post('slug');
        }
        $this->db->where('full_slug', $full_slug);
        $this->db->where('id !=', $id);
        return $this->db->get('cms_dynamic_category')->row();
    }

    function count_all_cate() {
        $this->content_model->list_category_sorting();
        $this->db->where('trash_status', 'no');
//        $this->db->where('active_status', 'a');
        $val = $this->db->get('cms_dynamic_category');

        return $val->num_rows();
    }

    function list_category_sorting() {

        if (isset($_GET['sort_radio'])) {
            if (isset($_GET['custom_sort'])) {
                $custom_value = $_GET['custom_sort'];
                $sort_value = $_GET['sort_radio'];

                switch ($sort_value) {
                    case 'id':
                        $this->db->order_by('id', $custom_value);
                        break;

                    case 'order':
                        $this->db->order_by('order', $custom_value);
                        break;
                    case 'title':
                        $this->db->order_by('category', $custom_value);
                        break;
                }
            }
        } else {
//            $this->db->order_by('id', 'DESC');
        }


        if (isset($_GET['name'])) {

            $search = $_GET['name'];

            $this->db->like('category', $search);
        }
        
        if (isset($_GET['parent_page'])) {

            $search = $_GET['parent_page'];

            $this->db->where('parent_page_id', $search);
        }

        if (isset($_GET['category'])) {

            $cat = $_GET['category'];
            $this->db->where('type', $cat);
        } else {
            $this->db->where_in('type', $this->cms_arr);
        }
		
		if (isset($_GET['actiontype']) && isset($_GET['catid'])) {

            $catid = $_GET['catid'];
			$catid = '+'.$catid.'+';
            $this->db->like('categoryidtree', $catid);
			$this->db->where('parent_id >', '0');
        } 
	
        if (isset($_GET['id'])) {

            $search = $_GET['id'];

            $this->db->where('id', $search);
        }
		
    }

    function listcate($perpage, $rec_from) {
        $this->content_model->list_category_sorting();
        $this->db->where('trash_status', 'no');
//        $this->db->where('active_status', 'a');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($perpage, $rec_from);
        return $this->db->get('cms_dynamic_category')->result();
    }

    function trash_count_all_cate() {
//        $this->db->where('parent_id', 0);
//        $this->db->where('type', 'content_management');
        $this->db->where_in('type', $this->cms_arr);
        $this->db->where('trash_status', 'yes');
        $this->db->where('active_status', 'd');
        $val = $this->db->get('cms_dynamic_category');

        return $val->num_rows();
    }

    function trash_listcate($perpage, $rec_from) {

//        $this->db->where('parent_id', 0);
//        $this->db->where('type', 'content_management');
        $this->db->where_in('type', $this->cms_arr);
        $this->db->where('trash_status', 'yes');
        $this->db->where('active_status', 'd');
        $this->db->limit($perpage, $rec_from);
        return $this->db->get('cms_dynamic_category')->result();
    }

    function edit_category($id) {
        
        $content_inputs_tree = '';
        
        if ($this->input->post('url_type') == 'seo_url') {

            if ($this->input->post('parentname') != 0) {

                $full_slug = $this->input->post('full_url_sec') . '/' . $this->input->post('slug');
            } else {

                $full_slug = $this->input->post('slug');
            }
        } elseif ($this->input->post('url_type') == 'force_url') {

            $full_slug = $this->input->post('slug');
        } else {

            $full_slug = $this->input->post('slug');
        }

        $cat_details = $this->content_model->GetByRow_notrash('cms_dynamic_category', $id, 'id');

        $category_name = $this->input->post('catname');

        $category_clean_name = $this->content_model->clean_name($category_name);

            $data = array(
                'parent_id' => $this->input->post('parentname'),
                'type' => 'content_management',
                'type2' => 'content',
                'category' => $this->input->post('catname'),
                'route' => $category_clean_name,
                'slug' => $this->input->post('slug'),
                'slug2' => $this->input->post('slug'),
                'url_key' => 'content_category_route',
                'slug_type' => $this->input->post('url_type'),
                'full_slug' => $full_slug,
                'order' => $this->input->post('order_number'),
                'trash_status' => 'no',
                'active_status' => $this->input->post('active_status'),
                'category_default_combo_id' => $this->input->post('default_combo_id'),
                'parent_page_id' => $this->input->post('parent_page')
            );
     

        $this->db->where('id', $id);
        $this->db->update('cms_dynamic_category', $data);

        $get_val = $this->content_model->pass_tree_values($id, $id, 'category');

        if ($this->input->post('parentname') != 0) {

            $parent_details = $this->content_model->GetByRow('cms_dynamic_category', $this->input->post('parentname'), 'id');
            $parent_category_slug = $parent_details->slug;
            $get_val = $this->content_model->pass_tree_values($this->input->post('parentname'), $id, 'category');

         /*    $data_detail_other = array(
                'content_detail_page' => $content_detail_page);

            $this->db->where('custom_content_detail_status', 'no');
            $this->db->where('prod_cat', $id);
            $this->db->update('cms_media', $data_detail_other);/**/

            $data2 = array(
                'categoryidtree' => $get_val['category_ids'],
                'categorynametree' => $get_val['category_names'],
                'categoryslugtree' => $get_val['category_slugs'],
                'parent_main_slug' => $get_val['cat_parent_route'],
                'parent_main_id' => $get_val['cat_parent_id'],
                'parent_sub_slug' => $parent_details->slug,
                'parent_sub_id' => $this->input->post('parentname')

            );
        } else {

            $option = $this->common_model->get_options();

            $data2 = array(
                'categoryidtree' => $get_val['category_ids'],
                'categorynametree' => $get_val['category_names'],
                'categoryslugtree' => $get_val['category_slugs'],
                'parent_main_slug' => $this->input->post('slug'),
                'parent_main_id' => $id,
                'parent_sub_slug' => $this->input->post('slug'),
                'parent_sub_id' => $id
            );
        }

        $this->db->where('id', $id);
        $this->db->update('cms_dynamic_category', $data2);

        $category_name2 = $this->input->post('catname');
        $category_name2 = strtolower($category_name2);
        $category_slug2 = $this->input->post('slug');

        $query2 = "UPDATE cms_dynamic_category SET "
                . "categorynametree = REPLACE(categorynametree, '+" . strtolower($cat_details->category) . "+', '+" . $category_name2 . "+'), "
                . "categoryslugtree = REPLACE(categoryslugtree, '+" . strtolower($cat_details->slug) . "+', '+" . $category_slug2 . "+') "
                . "WHERE parent_main_id='" . $cat_details->parent_main_id . "'";

        $this->db->query($query2);


        $data_product_main = array(
            'main_parent_name' => $category_name2,
            'main_parent_slug' => $category_slug2,
            'parent_page_id' => $this->input->post('parent_page')
        );
        $this->db->where('main_parent_id', $id);
        $this->db->update('cms_media', $data_product_main);

        $data_product_sub = array(
            'parent_sub_name' => $category_name2,
            'parent_sub_slug' => $category_slug2,
        );
        $this->db->where('prod_cat', $id);
        $this->db->update('cms_media', $data_product_sub);


        $query = "UPDATE cms_media SET "
                . "categorynametree = REPLACE(categorynametree, '+" . strtolower($cat_details->category) . "+', '+" . $category_name2 . "+'), "
                . "categoryslugtree = REPLACE(categoryslugtree, '+" . strtolower($cat_details->slug) . "+', '+" . $category_slug2 . "+') "
                . "WHERE main_parent_id='" . $cat_details->parent_main_id . "'";

        $this->db->query($query);

    }

    function edit_category2($id) {

        $data = array(
            'category_description' => $this->input->post('category_description'),
            'banner_title' => $this->input->post('bannertitle'),
            'banner_description' => $this->input->post('banner_description'),
        );
        $ec_category_detail = $this->GetByRow_notrash('cms_dynamic_category', $id, 'id');

        $seo_alt = $seo_title = $ec_category_detail->category;
        if ($this->input->post('seo_alt') != "") {

            $seo_alt = $this->input->post('seo_alt');
        }
        if ($this->input->post('seo_title') != "") {

            $seo_title = $this->input->post('seo_title');
        }


        /** Categoryb banner Picture file control */
        $banner_images_str = $this->input->post('final_images');
        $banner_images = explode(',', $banner_images_str);


        $mediaID = $this->input->post('mediaID');
        if ($banner_images_str != "") {

            if (!empty($mediaID)) {
                $data_mediaID = array(
                    'type_trash' => 'yes'
                );

                $this->db->where('id', $mediaID);
                $this->db->update('cms_media', $data_mediaID);
            }

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
                'type' => 'product_category',
                'type2' => 'product',
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
                    'seo_title' => $seo_title
                );
            }

            $image_encode1 = json_encode($image_array1);

            $data = $this->content_model->array_push_assoc($data, 'banner_picture', $image_encode1);
        } else {

            $image_detail_a = $this->GetByRow_notrash('cms_media', $mediaID, 'id');
            $exist_image_detail_a = json_decode($image_detail_a->images, TRUE);

            $image_array_a[] = array(
                'image' => $exist_image_detail_a[0]['image'],
                'combo' => $exist_image_detail_a[0]['combo'],
                'seo_alt' => $seo_alt,
                'seo_title' => $seo_title,
            );
            $image_encode_a = json_encode($image_array_a);

            $data_a = array();
            $data_a = $this->array_push_assoc($data_a, 'images', $image_encode_a);

            $this->db->where('id', $mediaID);
            $this->db->update('cms_media', $data_a);


            $exist_image_detail = json_decode($ec_category_detail->banner_picture, TRUE);
            if (!empty($exist_image_detail)) {
                $image_array[] = array(
                    'image' => $exist_image_detail[0]['image'],
                    'combo' => $exist_image_detail[0]['combo'],
                    'media_id' => $exist_image_detail[0]['media_id'],
                    'seo_alt' => $seo_alt,
                    'seo_title' => $seo_title,
                );
                $image_encode = json_encode($image_array);
                $data = $this->content_model->array_push_assoc($data, 'banner_picture', $image_encode);
            }
        }
        /** EOF Category banner Picture file control */
        /** EOF Banner Picture file control */
        $this->db->where('id', $id);
        $this->db->update('cms_dynamic_category', $data);
    }

    function showsubs($cat_id, $dashes = '') {

        $dashes .= '__';
        $this->db->where('parent_id', $cat_id);
//        $this->db->where('type', 'content_management');
        $this->db->where_in('type', $this->cms_arr);
        $this->db->order_by('order', 'ASC');
        $this->db->order_by('id', 'ASC');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $rsSub = $this->db->get('cms_dynamic_category')->result();
        if (count($rsSub) >= 1) {
            foreach ($rsSub as $rows_sub) {
                $this->arr[] = array(
                    'name' => $dashes . $rows_sub->category,
                    'id' => $rows_sub->id,
                    'categoryslugtree' => $rows_sub->categoryslugtree,
                    'type' => $rows_sub->type);
                $this->showsubs($rows_sub->id, $dashes);
            }
        }
    }

    function showcats() {
        
        if (isset($_GET['parent_page']) && ($_GET['parent_page'] != "")) {

            $search = trim($_GET['parent_page']);

            $this->db->where('parent_page_id', $search);
        }

        $this->db->where('parent_id', 0);
//        $this->db->where('type', 'content_management');
        $this->db->where_in('type', $this->cms_arr);
        $this->db->order_by('order', 'ASC');
        $this->db->order_by('id', 'ASC');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $rsMain = $this->db->get('cms_dynamic_category')->result();

        if (count($rsMain) >= 1) {
            foreach ($rsMain as $rows_main) {
                $this->arr[] = array(
                    'name' => $rows_main->category,
                    'id' => $rows_main->id,
                    'categoryslugtree' => $rows_main->categoryslugtree,
                    'type' => $rows_main->type);
                $this->showsubs($rows_main->id);
            }
            return $this->arr;
        }
    }

    function add_subcategory() {

        $category_name = $this->input->post('catname');

        $category_clean_name = $this->content_model->clean_name($category_name);

        $cat_details = $this->content_model->GetByRow('cms_dynamic_category', $this->input->post('parentname'), 'id');

        $parent_category_name = $cat_details->route;

        $banner_images_str = $this->input->post('final_images');
        $banner_images = explode(',', $banner_images_str);

        $image_array = array();

        foreach ($banner_images as $banner) {

            $image_array[] = array(
                'image' => $banner,
                'combo' => $this->input->post('combo'),
            );
        }

        $image_encode = json_encode($image_array);

        $data_media = array(
            'type' => 'content_sub_cat_banner',
            'type2' => 'content',
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
                'media_id' => $bannerID
            );
        }

        $image_encode1 = json_encode($image_array1);

        $data = array(
            'parent_id' => $this->input->post('parentname'),
            'type' => 'content_management',
            'type2' => 'content',
            'route' => $category_clean_name,
            'parent_route' => $parent_category_name,
            'slug' => $this->input->post('slug'),
            'category_picture' => $image_encode1,
            'category' => $this->input->post('catname'),
            'order' => $this->input->post('order_number'),
            'date' => date('Y-m-d H:i:s'),
            'trash_status' => 'no',
            'active_status' => 'a'
        );

        $this->db->insert('cms_dynamic_category', $data);
    }

    function count_all_subcate() {
        $this->db->where('parent_id !=', 0);
        $this->db->where('type', 'content_management');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $val = $this->db->get('cms_dynamic_category');

        return $val->num_rows();
    }

    function GetAllCategorySub($limit, $uri) {
        if ($limit != 0) {
            //echo "uri:".$uri;
            //echo "limit:".$limit;
            $this->uri_seg = $uri;

            $this->db->limit($limit, $uri);
        }
        $this->db->where('parent_id !=', 0);
        $this->db->order_by('id', 'DESC');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->where('type', 'content_management');
        return $this->db->get('cms_dynamic_category')->result();
    }

    function trash_count_all_subcate() {
        $this->db->where('parent_id !=', 0);
        $this->db->where('type', 'content_management');
        $this->db->where('trash_status', 'yes');
        $this->db->where('active_status', 'd');

        $val = $this->db->get('cms_dynamic_category');

        return $val->num_rows();
    }

    function trash_GetAllCategorySub($limit, $uri) {
        if ($limit != 0) {
            //echo "uri:".$uri;
            //echo "limit:".$limit;
            $this->uri_seg = $uri;

            $this->db->limit($limit, $uri);
        }
        $this->db->where('parent_id !=', 0);
        $this->db->order_by('id', 'DESC');
        $this->db->where('trash_status', 'yes');
        $this->db->where('active_status', 'd');
        $this->db->where('type', 'content_management');
        return $this->db->get('cms_dynamic_category')->result();
    }

    function edit_subcategory($id) {

        $category_name = $this->input->post('catname');

        $category_clean_name = $this->content_model->clean_name($category_name);

        $cat_details = $this->content_model->GetByRow('cms_dynamic_category', $this->input->post('parentname'), 'id');

        $parent_category_name = $cat_details->route;


        $banner_images_str = $this->input->post('final_images');
        $mediaID = $this->input->post('mediaID');
        $banner_images = explode(',', $banner_images_str);

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
                );
            }

            $image_encode = json_encode($image_array);

            $data_media = array(
                'type' => 'content_sub_cat_banner',
                'type2' => 'content',
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
                    'media_id' => $bannerID
                );
            }

            $image_encode1 = json_encode($image_array1);
            $data = array(
                'parent_id' => $this->input->post('parentname'),
                'category' => $this->input->post('catname'),
                'slug' => $this->input->post('slug'),
                'type' => 'content_management',
                'type2' => 'content',
                'route' => $category_clean_name,
                'parent_route' => $parent_category_name,
                'order' => $this->input->post('order_number'),
                'category_picture' => $image_encode1,
                'trash_status' => 'no',
                'active_status' => 'a'
            );
        } else {
            $data = array(
                'parent_id' => $this->input->post('parentname'),
                'slug' => $this->input->post('slug'),
                'type' => 'content_management',
                'type2' => 'content',
                'route' => $category_clean_name,
                'parent_route' => $parent_category_name,
                'order' => $this->input->post('order_number'),
                'category' => $this->input->post('catname'),
                'trash_status' => 'no',
                'active_status' => 'a'
            );
        }

        $this->db->where('id', $id);
        $this->db->update('cms_dynamic_category', $data);
    }

    function chk_parent_category($catid) {
        $this->db->select('id,category');
        $this->db->where('parent_id', $catid);

        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $cat = $this->db->get('cms_dynamic_category')->row();
    }

    /*
     * cat tree
     */

    function get_all_main_categories() {
        $this->db->where('parent_id', '0');
//        $this->db->where('type', 'content_management');
//        $this->db->where('type2', 'content');
        $this->db->where_in('type', $this->cms_arr);
        $this->db->where_in('type2', $this->cms_type2_arr);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('cms_dynamic_category')->result();
    }
    
    function get_all_categories($type, $id) {

        if ($type == 'parent') {
            $this->db->where('parent_id', '0');
        }
//        $this->db->where('type', 'content_management');
//        $this->db->where('type2', 'content');
        $this->db->where_in('type', $this->cms_arr);
        $this->db->where_in('type2', $this->cms_type2_arr);
        $this->db->where('id', $id);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('cms_dynamic_category')->result();
    }
   
    function check_subcategories($category_id) {
        $this->db->where('parent_id', $category_id);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('cms_dynamic_category')->num_rows();
    }

    function get_subcategory($category_id) {
        $this->db->where('parent_id', $category_id);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('cms_dynamic_category')->result();
    }

    /* Function pass_tree_values takes one argument and return an array. */

    function pass_tree_values($catid_val, $c_id, $typeCheck) {
        $parent_cat_result = $this->content_model->get_first_parent($catid_val);
        $current_field = $this->content_model->GetByRow_notrash('cms_dynamic_category', $c_id, 'id');

        if ($current_field->parent_id == 0 || in_array($typeCheck, $this->cms_arr)) {
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

        $tree_arr = array(
            'category_ids' => $category_ids,
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
            $this->db->where('trash_status', 'no');
//            $this->db->where('active_status', 'a');
            $category = $this->db->get('cms_dynamic_category')->row();
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

    function select_content_slug() {

        if ($this->input->post('url_type') == 'seo_url') {

            $full_slug = $this->input->post('full_url_sec') . '/' . $this->input->post('route');
        } elseif ($this->input->post('url_type') == 'force_url') {

            $full_slug = $this->input->post('route');
        }
        $this->db->where('full_slug', $full_slug);
        return $this->db->get('cms_media')->row();
    }

    function select_content_slug1() {

        $id = $this->uri->segment(3);

        if ($this->input->post('url_type') == 'seo_url') {

            $full_slug = $this->input->post('full_url_sec') . '/' . $this->input->post('route');
        } elseif ($this->input->post('url_type') == 'force_url') {

            $full_slug = $this->input->post('route');
        }
        $this->db->where('full_slug', $full_slug);
        $this->db->where('id !=', $id);
        return $this->db->get('cms_media')->row();
    }

    /*
     * cat tree
     */

    function list_content_sorting() {

        if (isset($_GET['sort_radio'])) {
            if (isset($_GET['custom_sort'])) {
                $custom_value = $_GET['custom_sort'];
                $sort_value = $_GET['sort_radio'];

                switch ($sort_value) {
                    case 'id':
                        $this->db->order_by('id', $custom_value);
                        break;

                    case 'order':
                        $this->db->order_by('order', $custom_value);
                        break;
                    case 'title':
                        $this->db->order_by('title', $custom_value);
                        break;
                }
            }
        } else {
            $this->db->order_by('id', 'DESC');
        }


        if (isset($_GET['name'])) {

            $search = $_GET['name'];
            
            $s_a = str_replace("-", " ", $search);

            $this->db->like('title', $s_a);
//			$this->db->like('content_title', $search);
        }

        if (isset($_GET['category']) && ($_GET['category'] != "")) {

            $cat = $_GET['category'];

            $this->db->like('category_tree', '+' . $cat . '+');
        }

        if (isset($_GET['status']) && ($_GET['status'] !== "")) {

            $status = $_GET['status'];

            $this->db->where('active_status', $status);
        }

        if (isset($_GET['cmstype_val'])) {

            $type = $_GET['cmstype_val'];

            $this->db->where('type', $type);
        } else {
            $this->db->where_in('type', $this->cms_arr);
        }


        if (isset($_GET['f_cmc_type'])) {


            if ($_GET['f_cmc_type'] == '49') {

                if (isset($_GET['product_id'])) {

                    $product_id = $_GET['product_id'];

                    $relational_product_id = '+' . $product_id . '+';

                    $this->db->like('connection_data', $relational_product_id);
                }
            }

            if ($_GET['f_cmc_type'] == '51') {

                if (isset($_GET['page_id'])) {

                    $page_id = $_GET['page_id'];

                    $relational_page_id = '+' . $page_id . '+';

                    $this->db->like('connection_data', $relational_page_id);
                }
            }


            if ($_GET['f_cmc_type'] == '62') {

                if (isset($_GET['menu_id'])) {

                    $menu_id = $_GET['menu_id'];

                    $relational_menu_id = '+' . $menu_id . '+';

                    $this->db->like('connection_data', $relational_menu_id);
                }
            }

            $f_cmc_type = $_GET['f_cmc_type'];

            $this->db->where('cms_type', $f_cmc_type);
        }

        if (isset($_GET['parent_page']) && ($_GET['parent_page'] != "")) {

            $search = trim($_GET['parent_page']);

            $this->db->where('parent_page_id', $search);
        }

        $this->db->where_in('type2', $this->cms_arr2);
        $this->db->where('trash_status', 'no');
    }

    function count_all_content() {
        $this->content_model->list_content_sorting();
        $val = $this->db->get('cms_media');
        return $val->num_rows();
    }

    function listcontent($perpage, $rec_from) {
        $this->content_model->list_content_sorting();
        $this->db->limit($perpage, $rec_from);
        return $this->db->get('cms_media')->result();
    }

    /*
     * Bulk Delete Functions
     */

    function get_full_sorted_content($starray_session) {

        $this->content_model->list_content_sorting();

        $this->db->order_by('id', 'DESC');
        $all_contents = $this->db->get('cms_media')->result_array();
        $all_contents1 = array_column($all_contents, 'id');

        $all_contents2 = json_decode($starray_session, true);

        $result = array_values(array_intersect($all_contents1, $all_contents2));

        $check_count = count($result);
        return json_encode($result, true) . '*****' . $check_count;
    }

    function get_full_content() {
        $this->content_model->list_content_sorting();

        $this->db->order_by('id', 'DESC');
        $all_contents = $this->db->get('cms_media')->result_array();
        $all_contents1 = array_column($all_contents, 'id');
        $check_count = count($all_contents1);
        return json_encode($all_contents1, true) . '*****' . $check_count;
    }

    function custom_check_id($check_type, $check_id, $all_ids) {
        $content_id = json_decode($all_ids, true);

        if ($check_type == 'remove') {

            if (($key = array_search($check_id, $content_id)) !== false) {
                unset($content_id[$key]);
            }
        } else if ($check_type == 'add') {
            if ($content_id == '') {
                $content_id = array(
                    $check_id);
            } else {
                if (!in_array($check_id, $content_id)) {
                    array_push($content_id, $check_id);
                }
            }
        }
        $result = array_values($content_id);

        $check_count = count($result);

        return json_encode($result, true) . '*****' . $check_count;
    }

    function trash_content($id) {
        $this->content_model->TrashById('cms_media', $id, 'id');
        $route_type = 'content_item';
        $quick_link_type = 'content';
        $action_type = 'trash';
        $this->route_model->routeTrashById('cms_routes', $id, 'slug_ref_id', $route_type);
        $this->route_model->save_routes($route_type);
        $this->common_model->quick_link_delete($id, $quick_link_type, $action_type);
    }

    function content_deactivate_activate($cont_id, $delete_opr) {
        if ($delete_opr == 'activate') {

            $active_status = 'a';
        } else if ($delete_opr == 'deactivate') {

            $active_status = 'd';
        }


        $data = array(
            'active_status' => $active_status,
        );

        $this->db->where('id', $cont_id);
        $this->db->update('cms_media', $data);
    }

    /*
     * EOF Bulk Delete Functions
     */

    function trash_count_all_content() {
        if ($this->uri->segment(3) != '0' && $this->uri->segment(3) != 'All') {
            $cat_id = $this->uri->segment(3);
            $totalcategories = $this->showmaincat($cat_id);

            if ($totalcategories) {
                $totalcategories = $totalcategories;
            } else {
                $totalcategories = array(
                    '0' => $cat_id);
            }
            $cat_count = count($totalcategories);
            if ($cat_count != '0') {
                foreach ($totalcategories as $catid) {
                    if ($catid['id'] != '') {
                        $catidz = $catid['id'];
                        $this->db->or_like('prod_cat', $catidz);
                    }
                }
            } else {
                $catid = $this->uri->segment(3);
                $catidz = $catid;
                $this->db->or_like('prod_cat', $catidz);
            }
        }



        if ($this->uri->segment(5) != '0') {

            $sess_val = $this->uri->segment(5);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('title', $s_a);
        }
        //
//        $this->db->where('type', 'content_management');
        $this->db->where_in('type', $this->cms_arr);
        $this->db->where_in('type2', $this->cms_arr2);
        $this->db->where('trash_status', 'yes');
        $this->db->where('active_status', 'd');
        $val = $this->db->get('cms_media');

        return $val->num_rows();
    }

    function trash_listcontent($perpage, $rec_from) {
        if ($this->uri->segment(3) != '0' && $this->uri->segment(3) != 'All') {
            $cat_id = $this->uri->segment(3);
            $totalcategories = $this->showmaincat($cat_id);

            if ($totalcategories) {
                $totalcategories = $totalcategories;
            } else {
                $totalcategories = array(
                    '0' => $cat_id);
            }
            $cat_count = count($totalcategories);
            if ($cat_count != '0') {
                foreach ($totalcategories as $catid) {
                    if ($catid['id'] != '') {
                        $catidz = $catid['id'];
                        $this->db->or_like('prod_cat', $catidz);
                    }
                }
            } else {
                $catid = $this->uri->segment(3);
                $catidz = $catid;
                $this->db->or_like('prod_cat', $catidz);
            }
        }

        if ($this->uri->segment(5) != '0') {

            $sess_val = $this->uri->segment(5);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('title', $s_a);
        }
        //
//        $this->db->where('type', 'content_management');
        $this->db->where_in('type', $this->cms_arr);
        $this->db->where_in('type2', $this->cms_arr2);
        $this->db->where('trash_status', 'yes');
        $this->db->where('active_status', 'd');
        $this->db->order_by('id', 'DESC');

        $this->db->limit($perpage, $rec_from);
        return $this->db->get('cms_media')->result();
    }

    function showsubcat($cat_id, $dashes = '') {
        $dashes .= '__';
        $this->db->where('parent_id', $cat_id);
        $this->db->where('type', 'content_management');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $rsSub = $this->db->get('cms_dynamic_category')->result();
        if (count($rsSub) >= 1) {
            foreach ($rsSub as $rows_sub) {
                $this->arrs[] = array(
                    'name' => $dashes . $rows_sub->category,
                    'id' => $rows_sub->id);
                $this->showsubcat($rows_sub->id, $dashes);
            }
        }
    }

    function showmaincat($cat) {
        $this->db->where('parent_id', $cat);
        $this->db->where('type', 'image');
        $rsMain = $this->db->get('cms_dynamic_category')->result();
        if (count($rsMain) >= 1) {
            foreach ($rsMain as $rows_main) {
                $this->arrs[] = array(
                    'name' => $rows_main->category,
                    'id' => $rows_main->id);
                $this->showsubcat($rows_main->id);
            }
            return $this->arrs;
        }
    }
    
    function list_news_gallery($id) {
        $this->db->where('id', $id);
        return $this->db->get('cms_media')->row();
    }

    function up_news_images($id, $order) {
        $data['parent_media_details'] = $this->content_model->GetByRow('cms_media', $id, 'id');

        $banner_images_str = $this->input->post('final_images');
        $banner_images = explode(',', $banner_images_str);

        $seo_alt = $this->input->post('seo_alt');
        $seo_title = $this->input->post('seo_title');
        $mediaID = $this->input->post('mediaID');
        $data['media_row_details'] = $this->content_model->GetByRow('cms_media', $mediaID, 'id');


        if (!empty($this->input->post('img_title'))) {
            $title = $this->input->post('img_title');
        } else {
            $title = '';
        }
        if (!empty($this->input->post('img_desc'))) {
            $brief_details = $this->input->post('img_desc');
        } else {
            $brief_details = '';
        }

        if ($banner_images_str != "") {

            $data_media = array(
                'type' => $data['media_row_details']->type,
                'type2' => $data['media_row_details']->type2,
                'type_trash' => 'yes',
                'title' => $data['media_row_details']->title,
                'images' => $data['media_row_details']->images,
                'parent_media_id' => $data['media_row_details']->parent_media_id,
                'prod_cat' => $data['media_row_details']->prod_cat,
                'main_parent_id' => $data['media_row_details']->main_parent_id,
                'main_parent_slug' => $data['media_row_details']->main_parent_slug,
                'main_parent_name' => $data['media_row_details']->main_parent_name,
                'category_tree' => $data['media_row_details']->category_tree,
                'categoryslugtree' => $data['media_row_details']->categoryslugtree,
                'categorynametree' => $data['media_row_details']->categorynametree,
                'brief_details' => $data['media_row_details']->brief_details
            );

            $this->db->insert('cms_media', $data_media);
            $bannerID = $this->db->insert_id();


            $image_array = array();

            foreach ($banner_images as $banner) {

                $image_array = array(
                    'image' => $banner,
                    'combo' => $this->input->post('combo'),
                    'seo_alt' => $seo_alt,
                    'seo_title' => $seo_title,
                );
            }

            $image_encode = json_encode($image_array);

            $data_mediaID = array(
//                'type_trash' => 'yes',
                'title' => $title,
                'brief_details' => $brief_details,
                'images' => $image_encode
            );

            $this->db->where('id', $mediaID);
            $this->db->update('cms_media', $data_mediaID);



            $image_array1 = array();

            foreach ($banner_images as $banner) {

                $image_array1 = array(
                    'image' => $banner,
                    'combo' => $this->input->post('combo'),
                    'media_id' => $mediaID,
                    'seo_alt' => $seo_alt,
                    'seo_title' => $seo_title
//                    'title' => $title,
//                    'brief_details' => $brief_details,
                );
            }
            $imgArray = $this->GetByRow_notrash('cms_media', $id, 'id');
            $img_array = json_decode($imgArray->images, TRUE);

            $img_array[$order] = $image_array1;

            $image_encode1 = json_encode($img_array);

            $data = array(
                'images' => $image_encode1,
            );

            $this->db->where('id', $id);
            $this->db->update('cms_media', $data);
        } else {

            $content_details = $this->GetByRow_notrash('cms_media', $id, 'id');
            $image_list = json_decode($content_details->images, true);
            $image_detail = $this->GetByRow_notrash('cms_media', $image_list[$order]['media_id'], 'id');

            $exist_image_detail = json_decode($image_detail->images, TRUE);
            $image_array = array(
                'image' => $exist_image_detail['image'],
                'combo' => $exist_image_detail['combo'],
                'seo_alt' => $seo_alt,
                'seo_title' => $seo_title,
            );

            $image_encode = json_encode($image_array);
            $data = array(
                'title' => $title,
                'brief_details' => $brief_details
            );
            $data = $this->array_push_assoc($data, 'images', $image_encode);
            $this->db->where('id', $image_list[$order]['media_id']);
            $this->db->update('cms_media', $data);


            $image_array1 = array(
                'image' => $image_list[$order]['image'],
                'combo' => $image_list[$order]['combo'],
                'media_id' => $image_list[$order]['media_id'],
                'seo_alt' => $seo_alt,
                'seo_title' => $seo_title
//                'title' => $title,
//                'brief_details' => $brief_details,
            );


            $image_list[$order] = $image_array1;
            $image_encode1 = json_encode($image_list);
            $data = array(
                'images' => $image_encode1,
            );

            $this->db->where('id', $id);
            $this->db->update('cms_media', $data);
        }
    }

    function del_media_img($id, $order) {
        $imgArray = $this->GetByRow('cms_media', $id, 'id');

        $img_array1 = json_decode($imgArray->images);
        $mediaID = $img_array1[$order]->media_id;

        $data_mediaID = array(
            'type_trash' => 'yes'
        );
        $this->db->where('id', $mediaID);
        $this->db->update('cms_media', $data_mediaID);

        $img_array = json_decode($imgArray->images, TRUE);

        array_splice($img_array, $order, 1);

        $image_encode1 = json_encode($img_array);

        $data = array(
            'images' => $image_encode1,
        );

        $this->db->where('id', $id);
        $this->db->update('cms_media', $data);
    }
    
    function targetlist() {
        $tglocation = array(
            '_self',
            '_blank');
        return $tglocation;
    }

    /*
     * EOF  Fetch target types
     */

    function pagelist() {
        $this->db->select('*');
        $this->db->from('cms_pages');
        $this->db->where('type', 'main_page');
        //        $this->db->where('trash_status', 'no');
        //        $this->db->where('active_status', 'a');
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    /*
     * Eof Fetch all Menu
     */

    function get_all_menus() {
        $this->db->where('parent_id', 0);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('order_no', 'ASC');
        $this->db->order_by('id', 'ASC');
        $rsMain = $this->db->get('cms_menu')->result();

        if (count($rsMain) >= 1) {
            foreach ($rsMain as $rows_main) {
                $this->arr_m[] = array(
                    'name' => $rows_main->category,
                    'id' => $rows_main->id,
                    'manualAuto' => $rows_main->menu_category_type_3,
                    'url_key' => $rows_main->option_url_key);
                $this->show_menu_subs($rows_main->id);
            }
            return $this->arr_m;
        }
    }

    function show_menu_subs($cat_id, $dashes = '') {
        $dashes .= '__';
        $this->db->where('parent_id', $cat_id);
        $this->db->order_by('order_no', 'ASC');
        $this->db->order_by('id', 'ASC');
        $rsSub = $this->db->get('cms_menu')->result();
        if (count($rsSub) >= 1) {
            foreach ($rsSub as $rows_sub) {
                $this->arr_m[] = array(
                    'name' => $dashes . $rows_sub->category,
                    'id' => $rows_sub->id,
                    'manualAuto' => $rows_sub->menu_category_type_3);
                $this->show_menu_subs($rows_sub->id, $dashes);
            }
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

    function slidervalues() {
        return $slidervalues = array(
            "29" => "1X3",
            "28" => "2X3",
            "3" => "3X3");
    }
      
    function findID_exist($json, $field, $to_find) {
        for ($i = 0; $i < count($json); $i++) {

            if ($json[$i][$field] == $to_find) {

                $checked_id = "yes";
                break;
            } else {
                $checked_id = "no";
            }
        }
        if (!empty($checked_id)) {
            return $checked_id;
        }
    }
    
    /*
     * end
     */

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
           
    function edit_video($id, $order) {
        $data1['parent_media_dtls'] = $this->content_model->GetByRow('cms_media', $id, 'id');
        $video_details = json_decode($data1['parent_media_dtls']->video_code);
        $media_row_id = $video_details[$order]->media_id;

        $video_encode = $this->input->post('final_video');
        $video_array1 = json_decode($video_encode);
        $video_array1[0]->media_id = $media_row_id;

        $data = array(
            'video_code' => $video_encode
        );

        $this->db->where('id', $media_row_id);
        $this->db->update('cms_media', $data);

        $vdoArray = $this->GetByRow_notrash('cms_media', $id, 'id');
        $vdo_array = json_decode($vdoArray->video_code, TRUE);

        $vdo_array[$order] = $video_array1[0];
        $video_encode1 = json_encode($vdo_array);
        $data2 = array(
            'video_code' => $video_encode1
        );

        $this->db->where('id', $id);
        $this->db->update('cms_media', $data2);
    }

    function del_media_video($id, $order) {
        $vdoArray = $this->GetByRow('cms_media', $id, 'id');

        $vdo_array1 = json_decode($vdoArray->video_code);

        $mediaID = $vdo_array1[$order]->media_id;

        $data_mediaID = array(
            'type_trash' => 'yes'
        );
        $this->db->where('id', $mediaID);
        $this->db->update('cms_media', $data_mediaID);

        $vdo_array = json_decode($vdoArray->video_code, TRUE);


        array_splice($vdo_array, $order, 1);

        $vdo_encode1 = json_encode($vdo_array);

        $data = array(
            'video_code' => $vdo_encode1,
        );
        //dump($data);die();
        $this->db->where('id', $id);
        $this->db->update('cms_media', $data);
    }

    function getFixedTypeItem($fixed_type, $table) {
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->where('fixed_type', $fixed_type);
        return $result = $this->db->get($table)->row();
    }

    function getCmsTypeValues($master_type_value) {
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->where('type', $master_type_value);
        return $result = $this->db->get("ec_categorytypes")->result();
    }

    function getProductType($product_type1_exclude_data, $product_type) {
        $this->db->select('name AS name,id AS id');
        $this->db->from('ec_categorytypes');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->where('type', $product_type);
        $this->db->where('id !=', $product_type1_exclude_data->id);
        return $result = $this->db->get()->result();
    }

    function getProdcutData() {
        $cms_type = $this->input->post("cms_type");

        switch ($cms_type) {
            case "cms_product":
                $this->db->select('prod_name AS name,id AS id');
                $this->db->from('ec_products');
                $this->db->where('trash_status', 'no');
                $this->db->where('active_status', 'a');
                $this->db->where('product_type2', $this->input->post("product_type2"));
                $this->db->where('product_categorytype_id', $this->input->post("product_type1"));
                $this->db->where('function_type', 'product');
                return $result = $this->db->get()->result();

                break;
            case "cms_product_category":
                $this->db->select('category AS name,id AS id');
                $this->db->from('ec_category');
                $this->db->where('trash_status', 'no');
                $this->db->where('active_status', 'a');
                $this->db->where('function_type', 'product');
                $this->db->where('product_type2', $this->input->post("product_type2"));
                $this->db->where('ctype', 1);
                return $result = $this->db->get()->result();
                break;
        }
    }         
  
    function up_news_images2($id, $order) {
        $data['parent_media_details'] = $this->content_model->GetByRow('cms_media', $id, 'id');

        $banner_images_str = $this->input->post('final_images');
        $banner_images = explode(',', $banner_images_str);

        $seo_alt = $this->input->post('seo_alt');
        $seo_title = $this->input->post('seo_title');
        $mediaID = $this->input->post('mediaID');
        $data['media_row_details'] = $this->content_model->GetByRow('cms_media', $mediaID, 'id');

        if (!empty($this->input->post('img_title'))) {
            $title = $this->input->post('img_title');
        } else {
            $title = '';
        }
        if (!empty($this->input->post('img_desc'))) {
            $brief_details = $this->input->post('img_desc');
        } else {
            $brief_details = '';
        }

        if ($banner_images_str != "") {

            $data_media = array(
                'type' => $data['media_row_details']->type,
                'type2' => $data['media_row_details']->type2,
                'type_trash' => 'yes',
//                'title' => $data['media_row_details']->title,
                'images2' => $data['media_row_details']->images2,
                'parent_media_id' => $data['media_row_details']->parent_media_id,
                'prod_cat' => $data['media_row_details']->prod_cat,
                'main_parent_id' => $data['media_row_details']->main_parent_id,
                'main_parent_slug' => $data['media_row_details']->main_parent_slug,
                'main_parent_name' => $data['media_row_details']->main_parent_name,
                'category_tree' => $data['media_row_details']->category_tree,
                'categoryslugtree' => $data['media_row_details']->categoryslugtree,
                'categorynametree' => $data['media_row_details']->categorynametree
            );

            $this->db->insert('cms_media', $data_media);
            $bannerID = $this->db->insert_id();

            $image_array = array();

            foreach ($banner_images as $banner) {

                $image_array = array(
                    'image' => $banner,
                    'combo' => $this->input->post('combo'),
                    'seo_alt' => $seo_alt,
                    'seo_title' => $seo_title,
                );
            }

            $image_encode = json_encode($image_array);

            $data_mediaID = array(
//                'title' => $title,
//                'brief_details' => $brief_details,
                'images2' => $image_encode
            );

            $this->db->where('id', $mediaID);
            $this->db->update('cms_media', $data_mediaID);

            $image_array1 = array();

            foreach ($banner_images as $banner) {

                $image_array1 = array(
                    'image' => $banner,
                    'combo' => $this->input->post('combo'),
                    'media_id' => $mediaID,
                    'seo_alt' => $seo_alt,
                    'seo_title' => $seo_title
                );
            }
            $imgArray = $this->GetByRow_notrash('cms_media', $id, 'id');
            $img_array = json_decode($imgArray->images2, TRUE);

            $img_array[$order] = $image_array1;

            $image_encode1 = json_encode($img_array);

            $data = array(
                'images2' => $image_encode1,
            );

            $this->db->where('id', $id);
            $this->db->update('cms_media', $data);
        } else {

            $content_details = $this->GetByRow_notrash('cms_media', $id, 'id');
            $image_list = json_decode($content_details->images2, true);
            $image_detail = $this->GetByRow_notrash('cms_media', $image_list[$order]['media_id'], 'id');

            $exist_image_detail = json_decode($image_detail->images2, TRUE);
            $image_array = array(
                'image' => $exist_image_detail['image'],
                'combo' => $exist_image_detail['combo'],
                'seo_alt' => $seo_alt,
                'seo_title' => $seo_title,
            );

            $image_encode = json_encode($image_array);
            $data = array();
            $data = $this->array_push_assoc($data, 'images2', $image_encode);
            $this->db->where('id', $image_list[$order]['media_id']);
            $this->db->update('cms_media', $data);

            $image_array1 = array(
                'image' => $image_list[$order]['image'],
                'combo' => $image_list[$order]['combo'],
                'media_id' => $image_list[$order]['media_id'],
                'seo_alt' => $seo_alt,
                'seo_title' => $seo_title
            );

            $image_list[$order] = $image_array1;
            $image_encode1 = json_encode($image_list);
            $data = array(
                'images2' => $image_encode1,
            );

            $this->db->where('id', $id);
            $this->db->update('cms_media', $data);
        }
    }

    function del_media_img2($id, $order) {
        $imgArray = $this->GetByRow('cms_media', $id, 'id');

        $img_array1 = json_decode($imgArray->images2);
        $mediaID = $img_array1[$order]->media_id;

        $data_mediaID = array(
            'type_trash' => 'yes'
        );
        $this->db->where('id', $mediaID);
        $this->db->update('cms_media', $data_mediaID);

        $img_array = json_decode($imgArray->images2, TRUE);

        array_splice($img_array, $order, 1);

        $image_encode1 = json_encode($img_array);

        $data = array(
            'images2' => $image_encode1,
        );

        $this->db->where('id', $id);
        $this->db->update('cms_media', $data);
    }

    function listMenuTypes() {
        $this->db->where('parent_id', 0);
        $this->db->where('type', 'menu_type');

        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');

        $val = $this->db->get('cms_dynamic_category')->result();
        return $val;
    }

    function listAllMenu() {
        $this->db->where('trash_status', 'no');
        return $this->db->get('cms_menu')->result();
    }
    
    function getDualListVal() {
        $menu_type = $this->input->post('menu_type');

        $existing_array = array();
        if (!empty($this->input->post('existing_array'))) {
            $existing_array = $this->input->post('existing_array');
        }

        if (!empty($menu_type)) {
            if ($menu_type != 'all') {
                $this->db->like('menu_type_tree ', '+' . $menu_type . '+');
            }
        }

        $this->db->where('trash_status', 'no');

        $result = $this->db->get('cms_menu')->result();

        foreach ($result as $item) {
            if (in_array($item->id, $existing_array)) {
                
            } else {
                echo "<option value='" . $item->id . "'>" . $item->category . "</option>";
            }
        }
    }      
           
    function addContent(){
        $cms_item_type = "content_management";
        $cat = $this->input->post('cat');
        
        $cat_details = $this->content_model->GetByRow('cms_dynamic_category', $cat, 'id');
        $cat_route = $cat_details->slug;
        $cat_name = $cat_details->category;
        $get_val_a = $this->content_model->pass_tree_values($cat, $cat, $cms_item_type);
        
        $type3 = 'content_management';
        $type4 = 'content';
        $type5 = 'content_image';
        $type6 = 'content';
        
        $newDate = '0000-00-00 00:00:00';
        
        $full_slug = "";            
                       
         $data = array(
            'title' => $this->input->post('catname'),
            'route' => $this->input->post('slug'),
            'slug2' => $this->input->post('slug'),
            'url_key' => 'content_item_route',
            'slug_type' => $this->input->post('url_type'),
            'full_slug' => $full_slug,
            'prod_cat' => $this->input->post('cat'),
            'parent_sub_name' => $cat_name,
            'parent_sub_slug' => $cat_route,
            'main_parent_id' => $get_val_a['cat_parent_id'],
            'main_parent_slug' => $get_val_a['cat_parent_route'],
            'main_parent_name' => $get_val_a['cat_parent_name'],
            'category_tree' => $get_val_a['category_ids'],
            'categoryslugtree' => $get_val_a['category_slugs'],
            'categorynametree' => $get_val_a['category_names'],
            'type' => $type3,
            'type2' => $type4,
            'order' => $this->input->post('order_number'),
            'content_date' => $newDate,
            'trash_status' => 'no',
            'active_status' => $this->input->post('active_status'),       
            'parent_page_id' => $cat_details->parent_page_id           
        );
                 
         $this->db->insert('cms_media', $data);
         $data_id = $this->db->insert_id();         

         return $data_id;
    }
    
    function editContent2($id){
        
        $data = array(
            'content_title' => $this->input->post('first_title'),
            'second_title' => $this->input->post('second_title'),
            'thirdtitle' => $this->input->post('third_title'),
            'content_short_description' => $this->input->post('short_description'),
            'brief_details' => $this->input->post('brief_description'),
            'iconClass' => $this->input->post('icon_class'),
            'content_date' => $this->input->post('content_date'),
        );
        
        $seo_alt = $this->common_model->option->project_name;
        $seo_alt = str_replace("_", " ", $seo_alt);
                
        $seo_title = $this->common_model->option->project_name;
        $seo_title = str_replace("_", " ", $seo_title);
        
        $banner_images_str = $this->input->post('final_images');
        $banner_images = explode(',', $banner_images_str);
        
         if ($banner_images_str != "") {
            $bannerID = array();
            $image_array = array();

            $i = 0;
            foreach ($banner_images as $banner) {

               

                $image_array = array(
                    'image' => $banner,
                    'combo' => $this->input->post('combo'),
                    'seo_alt' => $seo_alt,
                    'seo_title' => $seo_title,
                );

                $image_encode = json_encode($image_array);

                $data_media = array(
                    'type' => 'content_image',
                    'type2' => 'content',
                    'type_trash' => 'no',
                    'images' => $image_encode,
                );

                $this->db->insert('cms_media', $data_media);
                $bannerID[] = $this->db->insert_id();
                $i++;
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

            $imgArray = $this->GetByRow_notrash('cms_media', $id, 'id');
            $img_array = json_decode($imgArray->images, TRUE);
            
            if(!empty($img_array)){
                $newArray = array_merge($img_array, $image_array1);
            }else{
                $newArray = $image_array1;
            }

            $image_encode1 = json_encode($newArray);

            $data = $this->content_model->array_push_assoc($data, 'images', $image_encode1);
        }
        
        
        $type3 = '';
        if ($this->input->post('customlink') == 'internal') {
            $type2 = 'slug';
            $type3 = $this->input->post('custom_slug');
            

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
        
        $data = $this->content_model->array_push_assoc($data, 'custom_link', $custom_link_json);       
              
        $this->db->where('id', $id);
        $this->db->update('cms_media', $data);

    }
    
    function listAllPages() {        
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

        $this->db->where('type', 'main_page');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('page', 'ASC');
        return $this->db->get('cms_pages')->result();
    }

    function editContent($id){
        $cms_item_type = "content_management";
        $cat = $this->input->post('cat');
        
        $cat_details = $this->content_model->GetByRow('cms_dynamic_category', $cat, 'id');
        $cat_route = $cat_details->slug;
        $cat_name = $cat_details->category;
        $get_val_a = $this->content_model->pass_tree_values($cat, $cat, $cms_item_type);
        
        $type3 = 'content_management';
        $type4 = 'content';
        $type5 = 'content_image';
        $type6 = 'content';
        
        $newDate = '0000-00-00 00:00:00';
        
        $full_slug = "";       
                       
         $data = array(
            'title' => $this->input->post('catname'),
            'route' => $this->input->post('slug'),
            'slug2' => $this->input->post('slug'),
            'url_key' => 'content_item_route',
            'slug_type' => $this->input->post('url_type'),
            'full_slug' => $full_slug,
            'prod_cat' => $this->input->post('cat'),
            'parent_sub_name' => $cat_name,
            'parent_sub_slug' => $cat_route,
            'main_parent_id' => $get_val_a['cat_parent_id'],
            'main_parent_slug' => $get_val_a['cat_parent_route'],
            'main_parent_name' => $get_val_a['cat_parent_name'],
            'category_tree' => $get_val_a['category_ids'],
            'categoryslugtree' => $get_val_a['category_slugs'],
            'categorynametree' => $get_val_a['category_names'],
            'type' => $type3,
            'type2' => $type4,
            'order' => $this->input->post('order_number'),
            'active_status' => $this->input->post('active_status'), 
            'parent_page_id' => $cat_details->parent_page_id 
        );               
                         
         $this->db->where('id', $id);
         $this->db->update('cms_media', $data);         
    }
    
    function checkChildCatExists($id){
        $this->db->where('parent_id', $id);
        $this->db->where('type', 'content_management');

        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');

        $val = $this->db->get('cms_dynamic_category')->num_rows();
        return $val;
    }
    
    function showcats_sorted() {
        $this->db->where('parent_id', 0);
//        $this->db->where('show_type', 'content_item');
        $this->db->where_in('type', $this->cms_arr);
        $this->db->order_by('order', 'ASC');
        $this->db->order_by('id', 'ASC');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $rsMain = $this->db->get('cms_dynamic_category')->result();

        if (count($rsMain) >= 1) {
            foreach ($rsMain as $rows_main) {
                $this->arr[] = array(
                    'name' => $rows_main->category,
                    'id' => $rows_main->id,
                    'categoryslugtree' => $rows_main->categoryslugtree,
                    'type' => $rows_main->type,
                    'image_width' => $rows_main->image_width,
                    'image_height' => $rows_main->image_height
                    );
                $this->showsubs_sorted($rows_main->id);
            }
            return $this->arr;
        }
    }
    
    function showsubs_sorted($cat_id, $dashes = '') {
        $dashes .= '__';
        $this->db->where('parent_id', $cat_id);
//        $this->db->where('show_type', 'content_item');
        $this->db->where_in('type', $this->cms_arr);
        $this->db->order_by('order', 'ASC');
        $this->db->order_by('id', 'ASC');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $rsSub = $this->db->get('cms_dynamic_category')->result();
        if (count($rsSub) >= 1) {
            foreach ($rsSub as $rows_sub) {
                $this->arr[] = array(
                    'name' => $dashes . $rows_sub->category,
                    'id' => $rows_sub->id,
                    'categoryslugtree' => $rows_sub->categoryslugtree,
                    'type' => $rows_sub->type,
                    'image_width' => $rows_main->image_width,
                    'image_height' => $rows_main->image_height
                    );
                $this->showsubs_sorted($rows_sub->id, $dashes);
            }
        }
    }

    function listcomments($perpage, $rec_from) {
        $this->db->where('trash_status', 'no');
//        $this->db->where('active_status', 'a');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($perpage, $rec_from);
        return $this->db->get('cms_comments')->result();
    }

    function count_all_comments() {        
        $this->db->where('trash_status', 'no');
        $val = $this->db->get('cms_comments');
        return $val->num_rows();
    }

    function del_comments($commentid)
    {
        $data = array(
            'trash_status' => 'yes',
            'date_deleted' => date("Y-m-d H:i:s")
        );

        $this->db->where('id',$commentid);
        $this->db->update('cms_comments', $data); 
    }
    
    function getCategoryListByPage($page_id){       
        if($page_id != ""){
            $this->db->where('parent_page_id', $page_id);
        }        
        $this->db->where('parent_id', 0);
        // $this->db->where('type', 'content_management');
        $this->db->where_in('type', $this->cms_arr);
        $this->db->order_by('order', 'ASC');
        $this->db->order_by('id', 'ASC');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $rsMain = $this->db->get('cms_dynamic_category')->result();

        if (count($rsMain) >= 1) {
            foreach ($rsMain as $rows_main) {
                $this->arr[] = array(
                    'name' => $rows_main->category,
                    'id' => $rows_main->id,
                    'categoryslugtree' => $rows_main->categoryslugtree,
                    'type' => $rows_main->type);
                $this->showsubs($rows_main->id);
            }
            return $this->arr;
        }
    }
          
}
