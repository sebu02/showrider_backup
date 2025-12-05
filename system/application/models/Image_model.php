<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Image_model extends CI_Model {

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
        $category_clean_name = $this->image_model->clean_name($category_name);     
        $image_encode1 = '';
        $data = array(
            'parent_id' => $this->input->post('parent_type'),
            'type' => 'commonimage',
            'category_picture' => $image_encode1,
            'category' => $this->input->post('catname'),
            'slug' => $this->input->post('slug'),
            'route' => $category_clean_name,
            'order' => $this->input->post('order_number'),
            'date' => date('Y-m-d H:i:s'),
            'active_status' => $this->input->post('active_status'),
            'category_default_combo_id' => $this->input->post('default_combo_id')
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

    function select_category_slug() {
        $slug = $this->input->post('slug');
        $this->db->where('slug', $slug);
        $this->db->where('type', 'commonimage');
        return $this->db->get('cms_dynamic_category')->row();
    }

    function select_category_slug1() {
        $id = $this->uri->segment(3);

        $slug = $this->input->post('slug');
        $this->db->where('slug', $slug);
        $this->db->where('id !=', $id);
        $this->db->where('type', 'commonimage');
        return $this->db->get('cms_dynamic_category')->row();
    }

    function count_all_cate() {

        // $this->db->where('parent_id', 0);

        $this->db->where('type', 'commonimage');
        $this->db->where('trash_status', 'no');
//        $this->db->where('active_status', 'a');

        $val = $this->db->get('cms_dynamic_category');
        return $val->num_rows();
    }

    function listcate($perpage, $rec_from) {

        // $this->db->where('parent_id', 0);

        $this->db->where('type', 'commonimage');
        $this->db->limit($perpage, $rec_from);
        $this->db->where('trash_status', 'no');
//        $this->db->where('active_status', 'a');
        return $this->db->get('cms_dynamic_category')->result();
    }

    function edit_category($id) {
        $category_name = $this->input->post('catname');
        $category_clean_name = $this->image_model->clean_name($category_name);      
        $image_encode1 = '';
        $data = array(
            'parent_id' => $this->input->post('parent_type'),
            'type' => 'commonimage',
            'category_picture' => $image_encode1,
            'category' => $this->input->post('catname'),
            'slug' => $this->input->post('slug'),
            'route' => $category_clean_name,
            'order' => $this->input->post('order_number'),
            'date' => date('Y-m-d H:i:s'),
            'active_status' => $this->input->post('active_status'),
            'category_default_combo_id' => $this->input->post('default_combo_id')
        );

        $this->db->where('id', $id);
        $this->db->update('cms_dynamic_category', $data);
    }

    function showsubs($cat_id, $dashes = '') {
        $dashes .= '__';
        $this->db->where('parent_id', $cat_id);
        $this->db->where('type', 'commonimage');
        $this->db->order_by('order', 'ASC');
        $this->db->order_by('id', 'ASC');
        $rsSub = $this->db->get('cms_dynamic_category')->result();
        if (count($rsSub) >= 1) {
            foreach ($rsSub as $rows_sub) {
                $this->arr[] = array('name' => $dashes . $rows_sub->category, 'id' => $rows_sub->id);
                $this->showsubs($rows_sub->id, $dashes);
            }
        }
    }

    function showcats() {
        $this->db->where('parent_id', 0);
        $this->db->where('type', 'commonimage'); 
        $this->db->order_by('order', 'ASC');
        $this->db->order_by('id', 'ASC');
        $rsMain = $this->db->get('cms_dynamic_category')->result();

        if (count($rsMain) >= 1) {
            foreach ($rsMain as $rows_main) {
                $this->arr[] = array('name' => $rows_main->category, 'id' => $rows_main->id);
                $this->showsubs($rows_main->id);
            }
            return $this->arr;
        }
    }

    function add_subcategory() {
        $category_name = $this->input->post('catname');
        $category_clean_name = $this->image_model->clean_name($category_name);
        $cat_details = $this->image_model->GetByRow('cms_dynamic_category', $this->input->post('parentname'), 'id');
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
            'type'=>'common_g_sub_cat_banner',
            'type2'=>'common_g',
            'type_trash'=>'no',
            'images' => $image_encode    
        );

        $this->db->insert('cms_media', $data_media);
        $bannerID = $this->db->insert_id();
        
        $image_array1 = array();

        foreach ($banner_images as $banner) {

            $image_array1[] = array(
                'image' => $banner,
                'combo' => $this->input->post('combo'),
                'media_id'=>$bannerID
            );
        }

        $image_encode1 = json_encode($image_array1);

        $data = array(
            'parent_id' => $this->input->post('parentname'),
            'type' => 'commonimage',
            'route' => $category_clean_name,
            'parent_route' => $parent_category_name,
            'slug' => $this->input->post('slug'),
            'category_picture' => $image_encode1,
            'category' => $this->input->post('catname'),
            'order' => $this->input->post('order_number'),
            'date' => date('Y-m-d H:i:s')
        );

        $this->db->insert('cms_dynamic_category', $data);
    }

    function count_all_subcate() {
        $this->db->where('parent_id !=', 0);
        $this->db->where('type', 'commonimage');
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
        $this->db->order_by('id','DESC');
        $this->db->where('type', 'commonimage');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('cms_dynamic_category')->result();
    }

    function edit_subcategory($id) {
        $category_name = $this->input->post('catname');
        $category_clean_name = $this->image_model->clean_name($category_name);
        $cat_details = $this->image_model->GetByRow('cms_dynamic_category', $this->input->post('parentname'), 'id');
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
                'type'=>'common_g_sub_cat_banner',
                'type2'=>'common_g',
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
                        'media_id'=>$bannerID
                    );
                }

           $image_encode1 = json_encode($image_array1);
            $data = array(
                'parent_id' => $this->input->post('parentname'),
                'category' => $this->input->post('catname'),
                'slug' => $this->input->post('slug'),
                'type' => 'commonimage',
                'route' => $category_clean_name,
                'parent_route' => $parent_category_name,
                'order' => $this->input->post('order_number'),
                'category_picture' => $image_encode1
            );
        } else {
            $data = array(
                'parent_id' => $this->input->post('parentname'),
                'slug' => $this->input->post('slug'),
                'type' => 'commonimage',
                'route' => $category_clean_name,
                'parent_route' => $parent_category_name,
            'order' => $this->input->post('order_number'),
                'category' => $this->input->post('catname'),
            );
        }

        $this->db->where('id', $id);
        $this->db->update('cms_dynamic_category', $data);
    }

    function chk_parent_category($catid) {
        $this->db->select('id,category');
        $this->db->where('parent_id', $catid);
        return $cat = $this->db->get('cms_dynamic_category')->row();
    }

       /*
     * cat tree
     */
    function get_all_main_categories() {

        // $this->db->where('parent_id', '0');

        $this->db->where('type', 'commonimage');
//        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('cms_dynamic_category')->result();
    } 
    
   function check_subcategories($category_id){
        $this->db->where('parent_id',$category_id);
//        $this->db->where('trash_status', 'no');
//        $this->db->where('active_status', 'a');
        return $this->db->get('cms_dynamic_category')->num_rows();
    }
    
    function get_subcategory($category_id)  {
        $this->db->where('parent_id',$category_id);
//        $this->db->where('trash_status', 'no');
//        $this->db->where('active_status', 'a');
        return $this->db->get('cms_dynamic_category')->result();
    }      
    
    function insertimages() {        

        $banner_images_str = $this->input->post('final_images');
        $banner_images = explode(',', $banner_images_str);

        $image_array = array();

        $i = 0;
        foreach ($banner_images as $banner) {

            $parent_details = $this->image_model->get_first_parent($this->input->post('cat'));
            $parent_splited = explode('**', $parent_details);

            $image_array = array(
                'image' => $banner,
                'combo' => $this->input->post('combo'),
                'seo_alt' => $this->input->post('seo_alt'),
                'seo_title' => $this->input->post('seo_title')
            );

            $image_encode = json_encode($image_array);
           
            $data = array(
                'title' => $this->input->post('title'),
                'prod_cat' => $this->input->post('cat'),
                'main_parent_id' => $parent_splited[0],
                'main_parent_slug' => $parent_splited[2],
                'type' => 'commonimage',
                'type2' => 'gallery2',
                'type_trash' => 'no',
                'brief_details' => $this->input->post('description'),
                'images' => $image_encode,
                'order' => $this->input->post('order_number'),
                'image_type' => $this->input->post('image_type'),
                'product_id' => $this->input->post('parent_product'),
            );

            $this->db->insert('cms_media', $data);
            $i++;
        }

    }

    function count_all_imag() {
        if ($this->uri->segment(3) != '0' && $this->uri->segment(3) != 'All' && $this->uri->segment(3) != '') {
            $cat_id = $this->uri->segment(3);
            $totalcategories = $this->showmaincat($cat_id);
            
            if ($totalcategories) {
                $totalcategories = $totalcategories;
            } else {
                $totalcategories = array('0' => $cat_id);
            }
            $cat_count = count($totalcategories);
            if ($cat_count > 1) {
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

        if ($this->uri->segment(4) != '0' && $this->uri->segment(4) != 'All' && $this->uri->segment(4) != '') {
            $spid = $this->uri->segment(4);
//            $this->db->where('sports', $spid);
        }

        //
        if ($this->uri->segment(5) != '0' && $this->uri->segment(5) != '') {

            $sess_val = $this->uri->segment(5);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('title', $s_a);
        }
        //

        $this->db->where('type', 'commonimage');
        $this->db->where('type_trash', 'no');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $val = $this->db->get('cms_media');

        return $val->num_rows();
    }

    function listimages($perpage, $rec_from) {
        if ($this->uri->segment(3) != '0' && $this->uri->segment(3) != 'All' && $this->uri->segment(3) != '') {
            $cat_id = $this->uri->segment(3);
            $totalcategories = $this->showmaincat($cat_id);

            if ($totalcategories) {
                $totalcategories = $totalcategories;
            } else {
                $totalcategories = array('0' => $cat_id);
            }
            $cat_count = count($totalcategories);
            if ($cat_count > 1) {
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

        //
        if ($this->uri->segment(5) != '0' && $this->uri->segment(5) != '') {
            $sess_val = $this->uri->segment(5);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('title', $s_a);
        }
        //

        $this->db->where('type', 'commonimage');
        $this->db->where('type_trash', 'no');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('id', 'DESC');

        $this->db->limit($perpage, $rec_from);
        return $this->db->get('cms_media')->result();
    }

    function showsubcat($cat_id, $dashes = '') {
        $dashes .= '__';
        $this->db->where('parent_id', $cat_id);
        $this->db->where('type', 'commonimage');
        $rsSub = $this->db->get('cms_dynamic_category')->result();
        if (count($rsSub) >= 1) {
            foreach ($rsSub as $rows_sub) {
                $this->arrs[] = array('name' => $dashes . $rows_sub->category, 'id' => $rows_sub->id);
                $this->showsubcat($rows_sub->id, $dashes);
            }
        }
    }

    function showmaincat($cat) {
        $this->db->where('parent_id', $cat);
        $this->db->where('type', 'commonimage');
        $rsMain = $this->db->get('cms_dynamic_category')->result();
        if (count($rsMain) >= 1) {
            foreach ($rsMain as $rows_main) {
                $this->arrs[] = array('name' => $rows_main->category, 'id' => $rows_main->id);
                $this->showsubcat($rows_main->id);
            }
            return $this->arrs;
        }
    }

    function edit_images($id) {
        $parent_details = $this->image_model->get_first_parent($this->input->post('cat'));
        $parent_splited = explode('**', $parent_details);

        $banner_images_str = $this->input->post('final_images');
        $banner_images = explode(',', $banner_images_str);

        $data = array(
            'title' => $this->input->post('title'),
            'prod_cat' => $this->input->post('cat'),
            'main_parent_id' => $parent_splited[0],
            'main_parent_slug' => $parent_splited[2],
            'type' => 'commonimage',
            'type2' => 'gallery2',
            'type_trash' => 'no',
            'brief_details' => $this->input->post('description'),
            'order' => $this->input->post('order_number'),
            'image_type' => $this->input->post('image_type'),
            'product_id' => $this->input->post('parent_product'),
        );
      
        if ($banner_images_str != "") {
            $image_array = array();
            foreach ($banner_images as $banner) {
                $image_array = array(
                    'image' => $banner,
                    'combo' => $this->input->post('combo'),
                    'seo_alt' => $this->input->post('seo_alt'),
                    'seo_title' => $this->input->post('seo_title')
                );
            }

            $image_encode = json_encode($image_array);
            $data = $this->image_model->array_push_assoc($data, 'images', $image_encode);            
//            $this->db->insert('cms_media', $data);
            
        } else {            
            $current_row_details = $this->GetByRow_notrash('cms_media', $id, 'id');
            $exist_image_detail = json_decode($current_row_details->images, true);
            
            $image_array = array(
                'image' => $exist_image_detail['image'],
                'combo' => $exist_image_detail['combo'],
                'seo_alt' => $this->input->post('seo_alt'),
                'seo_title' => $this->input->post('seo_title')
            );
            
            $image_encode = json_encode($image_array);
            $data = $this->array_push_assoc($data, 'images', $image_encode);            
        }

        $this->db->where('id', $id);
        $this->db->update('cms_media', $data);
    }
    
    function removeImg($id){        
          $data_media = array(
                'type_trash' => 'yes'
            );

            $this->db->where('id', $id);
            $this->db->update('cms_media', $data_media);
    }
    
    function get_first_parent($cid) {
        $j = '';
        $i = $cid;
        while ($i > 0) {
            $this->db->where('id', $i);
            $category = $this->db->get('cms_dynamic_category')->row();
            $i = $category->parent_id;
            if ($i > 0) {
                $j = $category->parent_id . '**' . $category->category . '**' . $category->slug;
            } else
            if ($i == '0') {
                $j = $category->id . '**' . $category->category . '**' . $category->slug;
            }
        }
        return $j;
    }

    function get_fetred_images() {
        $this->db->where('type', 'commonimage');
        $this->db->where('featured_products', 'f');
        return $this->db->get('cms_media')->result();
    }

    function trash_count_all_cate() {
        $this->db->where('parent_id', 0);
        $this->db->where('type', 'commonimage');
        $this->db->where('trash_status', 'yes');
        $this->db->where('active_status', 'd');

        $val = $this->db->get('cms_dynamic_category');
        return $val->num_rows();
    }

    function trash_listcate($perpage, $rec_from) { 
        $this->db->where('parent_id', 0);
        $this->db->where('type', 'commonimage');
        $this->db->where('trash_status', 'yes');
        $this->db->where('active_status', 'd');
        $this->db->limit($perpage, $rec_from);
        return $this->db->get('cms_dynamic_category')->result();
    }

    function trash_count_all_subcate() {
        $this->db->where('parent_id !=', 0);
        $this->db->where('type', 'commonimage');
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
        $this->db->where('type', 'commonimage');
        $this->db->where('trash_status', 'yes');
        $this->db->where('active_status', 'd');
        return $this->db->get('cms_dynamic_category')->result();
    }
    
    function trash_count_all_imag() {
        $catidz1 = NULL;
        $cat_count = NULL;
        $catidz1 = array();
        if ($this->uri->segment(3) != '0' && $this->uri->segment(3) != 'All' && $this->uri->segment(3) != '') {
            $cat_id = $this->uri->segment(3);

//            $this->db->where('prod_cat', $cat_id);
            $totalcategories = $this->showmaincat($cat_id);

            if ($totalcategories) {
                $totalcategories = $totalcategories;
            } else {
                $totalcategories = array('0' => $cat_id);
            }
            $cat_count = count($totalcategories);
            if ($cat_count > 1) {

                foreach ($totalcategories as $catid) {
                    if ($catid['id'] != '') {
                        $catidz1[] = $catid['id'];
                    }
                }
                $catidz1[] = $this->uri->segment(3);
                $this->db->where_in('prod_cat', $catidz1);
            } else {
                $catid = $this->uri->segment(3);
                $catidz = $catid;
                $this->db->where('prod_cat', $catidz);
            }
        }



        if ($this->uri->segment(5) != '0' && $this->uri->segment(5) != '') {

            $sess_val = $this->uri->segment(5);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('title', $s_a);
        }
        //


        $this->db->where('type', 'commonimage');
        $this->db->where('type_trash', 'no');

        $this->db->where('trash_status', 'yes');
        $this->db->where('active_status', 'd');
        $val = $this->db->get('cms_media');

        return $val->num_rows();
    }
    
    function trash_listimages($perpage, $rec_from) {
        $catidz1 = NULL;
        $cat_count = NULL;
        $catidz1 = array();
        if ($this->uri->segment(3) != '0' && $this->uri->segment(3) != 'All' && $this->uri->segment(3) != '') {
            $cat_id = $this->uri->segment(3);

//            $this->db->where('prod_cat', $cat_id);
            $totalcategories = $this->showmaincat($cat_id);

            if ($totalcategories) {
                $totalcategories = $totalcategories;
            } else {
                $totalcategories = array('0' => $cat_id);
            }
            $cat_count = count($totalcategories);
            if ($cat_count > 1) {

                foreach ($totalcategories as $catid) {
                    if ($catid['id'] != '') {
                        $catidz1[] = $catid['id'];
                    }
                }
                $catidz1[] = $this->uri->segment(3);
                $this->db->where_in('prod_cat', $catidz1);
            } else {
                $catid = $this->uri->segment(3);
                $catidz = $catid;
                $this->db->where('prod_cat', $catidz);
            }
        }

        if ($this->uri->segment(5) != '0' && $this->uri->segment(5) != '') {

            $sess_val = $this->uri->segment(5);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('title', $s_a);
        }
        //


        $this->db->where('type', 'commonimage');
        $this->db->where('type_trash', 'no');

        $this->db->where('trash_status', 'yes');
        $this->db->where('active_status', 'd');
        $this->db->order_by('id', 'DESC');

        $this->db->limit($perpage, $rec_from);
        return $this->db->get('cms_media')->result();
    }

    function GetByRow_notrash($table, $eventid, $field) {
        $this->db->where(array(
            $field => $eventid));
        return $result = $this->db->get($table)->row();
    }
    
    function getProductsList(){
        $this->db->where('function_type', 'product');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('order_no', 'asc');

        $products_result = $this->db->get('ec_products')->result();
        return $products_result;
    }
    
}
