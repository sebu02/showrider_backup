<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_model
        extends CI_Model {

    function __construct() {
        parent::__construct();
//$this->output->enable_profiler(TRUE);
        $this->tree = array();
        $this->parent = '';
        $this->arr = array();
        $this->arr_b = array();
        $this->arr_w = array();
        $this->arr2 = array();
        $this->arrz = array();
        $this->arrs = array();
        $this->arrow = '|';
        $this->arrzz = array();



        //add all cache session
        // $this->common_model->Update_Page_Featurebox_Cache();
        //add all cache session
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

    function GetByRow($table, $eventid, $field) {
//echo $eventid;
        ini_set('max_execution_time', 0);

        $this->db->where(array(
            $field => $eventid));
        return $result = $this->db->get($table)->row();
    }

    function GetByRow_notrash($table, $eventid, $field) {
        ini_set('max_execution_time', 0);

        $this->db->where(array(
            $field => $eventid));
        return $result = $this->db->get($table)->row();
    }

    function GetByResult_notrash($table, $order_column, $order_type) {
        ini_set('max_execution_time', 0);

        $this->db->order_by($order_column, $order_type);
        return $result = $this->db->get($table)->result();
    }

    function GetByResultArray_notrash($table, $order_column, $order_type) {
        ini_set('max_execution_time', 0);

        $this->db->order_by($order_column, $order_type);
        return $result = $this->db->get($table)->result_array();
    }

    function GetByResult($table, $order_column, $order_type) {
        ini_set('max_execution_time', 0);

        $this->db->order_by($order_column, $order_type);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $result = $this->db->get($table)->result();
    }

    function GetByResult_Where($table, $order_column, $order_type,
            $conditional_array) {

        ini_set('max_execution_time', 0);

        $this->db->where($conditional_array);

        $this->db->order_by($order_column, $order_type);

        $query = $this->db->get($table);
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function array_push_assoc($array, $key, $value) {
        ini_set('max_execution_time', 0);

        $array[$key] = $value;
        return $array;
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

    /* Function pass_tree_values takes one argument and return an array. */

    function pass_tree_values($catid_val, $c_id, $typeCheck) {

        ini_set('max_execution_time', 0);
        $parent_cat_result = $this->product_model->get_first_parent($catid_val);
        $current_field = $this->product_model->GetByRow('ec_category', $c_id, 'id');

        if ($current_field->parent_id == 0 || $typeCheck == 'product') {
            $current_ids = '';
            $current_names = '';
            $current_slugs = '';
            $current_full = '';
        } else {
            $current_ids = '+' . $current_field->id;
            $current_names = '+' . strtolower($current_field->category);
            $current_slugs = '+' . $current_field->slug;
            $current_full = $current_ids . '_' . $current_names . '_' . $current_slugs;
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
//        $category_ids = '+' . $category_ids . '+';

        $category_names = $parent_cat_splited2[1];
        $category_names = explode('+', $category_names);
        $category_names = array_filter($category_names);
        $category_names = array_unique($category_names);
        $category_names = implode('+', $category_names);
        $category_names = $current_names . '+' . $category_names . '+';
//        $category_names = '+' . $category_names . '+';

        $category_slugs = $parent_cat_splited2[2];
        $category_slugs = explode('+', $category_slugs);
        $category_slugs = array_filter($category_slugs);
        $category_slugs = array_unique($category_slugs);
        $category_slugs = implode('+', $category_slugs);
        $category_slugs = $current_slugs . '+' . $category_slugs . '+';
//        $category_slugs = '+' . $category_slugs . '+';

        $category_full = $parent_cat_splited2[3];
        $category_full = explode('+', $category_full);
        $category_full = array_filter($category_full);
        $category_full = array_unique($category_full);
        $category_full = implode('+', $category_full);
        $category_full = $current_full . '+' . $category_full . '+';
//        $category_full = '+' . $category_full . '+';


        $tree_arr = array(
            'category_ids' => $category_ids,
            'category_names' => $category_names,
            'category_slugs' => $category_slugs,
            'category_full' => $category_full,
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
        ini_set('max_execution_time', 0);
        $j = '';
        $i = $cid;
        $catids = '';
        $catnames = '';
        $catslugs = '';
        $catfull = '';
        while ($i > 0) {
            $this->db->where('id', $i);
            $category = $this->db->get('ec_category')->row();
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






    /*
     * Insertion of Category Type
     */

    function add_categorytype() {


        $category_types = $this->input->post('input_name');
        $save_database = json_decode($this->input->post('save_db'), true);
        $type = explode('|', $this->input->post('category_type'));
        $main_type_val = $type[0];
        $main_type_id = $type[1];


        foreach ($category_types as $catkey => $category_type) {

            $data = array(
                'type' => $main_type_val,
                'name' => $category_type,
                'main_type_id' => $main_type_id,
                'save_database' => $save_database[$catkey],
                'trash_status' => 'no',
                'active_status' => 'a'
            );


            $this->db->insert('ec_categorytypes', $data);

            $last_id = $this->db->insert_id();
        }
    }

    /*
     * End of Insertion of Category Type
     */




    /*
     * Select Category Type by Name which is array  for unique handling
     */

    function select_by_name() {
        $input_name = $this->input->post('input_name');

        $this->db->where_in('name', $input_name);
        $query = $this->db->get('ec_categorytypes');
        if ($query->num_rows() >= 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*
     *  End of Select Category Type by Name  for unique handling
     */

    /*
     * Select Category Type by Name for unique handling while editing 
     */

    function select_by_name1() {
        $id = $this->uri->segment(3);
        $input_name = $this->input->post('input_name');
        $this->db->where('name', $input_name);
        $this->db->where('id !=', $id);
        return $this->db->get('ec_categorytypes')->row();
    }

    /*
     *  End of Select Category Type by Name  for unique handling while editing 
     */


    /*
     * Count all Category Type list which
     * Return number of rows
     */

    function count_all_categorytype() {

        if ($this->uri->segment(3) != '0') {

            $sess_val = $this->uri->segment(3);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('name', $s_a);
        }
        $this->db->where('type !=', 'main_category_type');
        $this->db->where('trash_status', 'no');
        $val = $this->db->get('ec_categorytypes');
        return $val->num_rows();
    }

    /*
     * End of Count all Category Type
     */


    /*
     * List all Category Type 
     */

    function list_categorytype($perpage, $rec_from) {

        if ($this->uri->segment(3) != '0') {

            $sess_val = $this->uri->segment(3);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('name', $s_a);
        }
        $this->db->where('type !=', 'main_category_type');
        $this->db->where('trash_status', 'no');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($perpage, $rec_from);
        return $this->db->get('ec_categorytypes')->result();
    }

    /*
     * End of List all Category Type 
     */

    /*
     * Edit Category Type 
     */

    function edit_categorytype($id) {

        $type = explode('|', $this->input->post('category_type'));
        $save_database = $this->input->post('save_database');
        $main_type_val = $type[0];
        $main_type_id = $type[1];

        if ($main_type_val == "product_category") {
            $price_prefix_status = $this->input->post("price_prefix_status");

            if ($price_prefix_status == "yes") {
                $price_prefix_main_text = $this->input->post("price_prefix_main_text");
                $price_prefix_sub_text = $this->input->post("price_prefix_sub_text");
            } else if ($price_prefix_status == "no") {

                $price_prefix_main_text = "";
                $price_prefix_sub_text = "";
            }
        } else {
            $price_prefix_status = "";
            $price_prefix_main_text = "";
            $price_prefix_sub_text = "";
        }

        $data = array(
            'name' => $this->input->post('input_name'),
            'type' => $main_type_val,
            'main_type_id' => $main_type_id,
            'price_prefix_status' => $price_prefix_status,
            'price_prefix_main_text' => $price_prefix_main_text,
            'price_prefix_sub_text' => $price_prefix_sub_text,
            'active_status' => $this->input->post('active_status'),
            'save_database' => $save_database,
            'show_admin_status' => $this->input->post('show_admin_status'),
			'show_product_category_status' => $this->input->post('show_product_category_status'),
        );



        $this->db->where('id', $id);
        $this->db->update('ec_categorytypes', $data);


        /*
         * Get data set
         */
        $table_condition_array = array();
        $table_condition_array[] = array(
            "condition_clause" => "where",
            "condition_string" => "price_prefix_status",
            "condition_value" => "yes",
            "condition_option" => "",
        );
        $table_parameter_array = array(
            "table_condition_array" => $table_condition_array,
            "table" => "ec_categorytypes",
            "table_return_type" => "result"
        );
        /*
         * EOF Get data set
         */
        $getPrefixData = $this->common_model->getCommonTableData($table_parameter_array);
        $prefixDataSet = array();
        if ($getPrefixData != NULL) {

            foreach ($getPrefixData as $prefix_row) {

                $prefixDataSet[] = array(
                    "id" => $prefix_row->id,
                    "price_prefix_main_text" => $prefix_row->price_prefix_main_text,
                    "price_prefix_sub_text" => $prefix_row->price_prefix_sub_text
                );
            }
        }
        $prefixDataSetGroup = json_encode($prefixDataSet);

        //{oldoption}
        /* $prefixData = array(
          "price_prefix_set" => $prefixDataSetGroup
          ); */
        //{oldoption}

        $prefixData = array(
            "value" => $prefixDataSetGroup
        );

        //{oldoption}
        //$this->db->where('id', $this->common_model->option->id);
        // $this->db->update('cms_options', $prefixData);
        //{oldoption}

        $this->db->where('columnlabel', 'price_prefix_set');
        $this->db->update('cms_options_setting', $prefixData);



        if ($save_database == 'yes') {

            $this->common_model->createProdAttrOptionArray('ec_product_attributes', $id, 'edit');
        } else {
            $this->product_model->removeElementFind('ec_product_attributes', $id);
        }
    }

    /*
     * End of Edit Category Type 
     */


    /*
     * Count all Category Type list which is in trash
     * Return number of rows
     */

    public function removeElementFind($table, $id) {

        //{oldoption}
        // $options = $this->product_model->get_options();
        //$option = $options[0];
        //{oldoption}

        $option = $this->common_model->get_options();


        $product_attr_field = json_decode($option->product_attribute_full_array, TRUE);

        if ($product_attr_field != NULL) {
            if (array_key_exists($id, $product_attr_field)) {

                unset($product_attr_field[$id]);
            }
        }

        $data = json_encode($product_attr_field);


        //{oldoption}
        /* $attribute_field = array(
          'product_attribute_full_array' => $data
          ); */
        //{oldoption}

        $attribute_field = array(
            'value' => $data
        );

        //{oldoption}
        //$this->db->where('id', $option->id);
        //$this->db->update('cms_options', $attribute_field);
        //{oldoption}

        $this->db->where('columnlabel', 'product_attribute_full_array');
        $this->db->update('cms_options_setting', $attribute_field);
    }

    function trash_count_all_categorytype() {

        if ($this->uri->segment(3) != '0') {

            $sess_val = $this->uri->segment(3);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('name', $s_a);
        }
        $this->db->where('type !=', 'main_category_type');
        $this->db->where('trash_status', 'yes');
        $val = $this->db->get('ec_categorytypes');
        return $val->num_rows();
    }

    /*
     * End of Count all Category Type 
     */


    /*
     * List all Trash Category Type 
     */

    function trash_list_categorytype($perpage, $rec_from) {

        if ($this->uri->segment(3) != '0') {

            $sess_val = $this->uri->segment(3);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('name', $s_a);
        }
        $this->db->where('type !=', 'main_category_type');
        $this->db->where('trash_status', 'yes');
        $this->db->order_by('date_deleted', 'DESC');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($perpage, $rec_from);
        return $this->db->get('ec_categorytypes')->result();
    }

    /*
     * End of List all Trash Category Type 
     */

    /*
     * To get all Category Type 
     * with type of default_category
     */

    function select_all_category_types() {
        $this->db->where('type', 'default_category');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('ec_categorytypes')->result();
    }

    /*
     *  End of to get all Category Type 
     *  with type of default_category
     */


    /*
     * Insertion of Category
     */

    function add_prodcategory() {

        if ($this->input->post('url_type') == 'seo_url') {

            if ($this->input->post('parentname') != 0) {

                $full_slug = $this->input->post('full_url_sec') . '/' . $this->input->post('slug');
            } else {

                $full_slug = $this->input->post('slug');
            }
        } elseif ($this->input->post('url_type') == 'force_url') {

            $full_slug = $this->input->post('slug');
        } else {

//            $full_slug = $this->input->post('slug');

            if ($this->input->post('parentname') != 0) {

                $full_slug = $this->input->post('full_url_sec') . '/' . $this->input->post('slug');
            } else {

                $full_slug = $this->input->post('slug');
            }
        }



        $data = array(
            'function_type' => 'product',
            'ctype' => 1,
            'parent_id' => $this->input->post('parentname'),
            'category' => $this->input->post('input_name'),
            'short_name' => $this->input->post('short_name'),
            'slug' => $this->input->post('slug'),
            'slug2' => $this->input->post('slug'),
            'url_key' => 'product_category_route',
            'slug_type' => $this->input->post('url_type'),
            'full_slug' => $full_slug,
            'order_no' => $this->input->post('order_number'),
            'active_status' => $this->input->post('active_status'),
            'trash_status' => 'no',
            'category_default_combo_id' => $this->input->post('default_combo_id'),
            'menu_id' => $this->input->post('menulist')

        );
        $this->db->insert('ec_category', $data);

        $catid_val = $this->db->insert_id();
        

        if ($this->input->post('url_type') == 'auto_url') {

            $full_slug = $this->input->post('slug') . '/productcat-' . $catid_val;

            $data3 = array(
                'full_slug' => $full_slug,
            );
            $this->db->where('id', $catid_val);
            $this->db->update('ec_category', $data3);
        }


        $get_val = $this->product_model->pass_tree_values($catid_val, $catid_val, 'category');




        if ($this->input->post('parentname') != 0) {


            $parent_details = $this->product_model->GetByRow('ec_category', $this->input->post('parentname'), 'id');
            $parent_category_slug = $parent_details->slug;
            $get_val = $this->product_model->pass_tree_values($this->input->post('parentname'), $catid_val, 'category');


            $data2 = array(
                'categoryidtree' => $get_val['category_ids'],
                'categorynametree' => $get_val['category_names'],
                'categoryslugtree' => $get_val['category_slugs'],
                'categoryfull' => $get_val['category_full'],
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
                'categoryfull' => $get_val['category_full'],
                'parent_main_slug' => $this->input->post('slug'),
                'parent_main_id' => $catid_val,
                'parent_sub_slug' => $this->input->post('slug'),
                'parent_sub_id' => $catid_val                

            );
        }



        $this->db->where('id', $catid_val);
        $this->db->update('ec_category', $data2);


        return $catid_val;
    }

    /*
     * End of Insertion of Category
     */
    

    function create_category_page($category_page_parameter_array) {
        $ptype = $category_page_parameter_array['ptype'];
        $pcat = $category_page_parameter_array['pcat'];
        $pctype = $category_page_parameter_array['pctype'];
        $maketype = $category_page_parameter_array['maketype'];
        $slug = $category_page_parameter_array['slug'];
        $slug2 = $category_page_parameter_array['slug2'];
        $full_slug = $category_page_parameter_array['full_slug'];
        $action_type = $category_page_parameter_array['action_type'];

        $deactive_array = array(
            "product_category_id" => $pcat,
        );
        $this->product_model->deactiveProdcutTypePages($deactive_array);

        $this->db->where('type', 'main_page');
        $this->db->where('product_type_id', $ptype);
        $this->db->where('product_category_id', $pcat);
        $this->db->where('special_page_type', "connection_page");
        $this->db->where('product_category_type', $pctype);
        $this->db->where('make_page_type', $maketype);
        $pageRow = $this->db->get('cms_pages')->row();
        if (!empty($pageRow)) {
            $this->product_model->pageActivate($pageRow);
        }



        /*
         * 
         */

        $pcat_current_id = $pcat;
        $category = $this->product_model->GetByRow("ec_category", $pcat_current_id, "id");

        $pagename = strtolower($category->category);
        $special_page_type = "connection_page";
        $special_page_type2 = "product_category";

        $header_row = $this->product_model->GetByRow_notrash('cms_pages', "header_page", 'page_type');
        $footer_row = $this->product_model->GetByRow_notrash('cms_pages', "footer_page", 'page_type');

        $data = array(
            'page' => $pagename,
            'type' => 'main_page',
            'slug' => $this->input->post('slug'),
            'slug2' => $this->input->post('slug'),
            'url_key' => 'page_route',
            'slug_type' => 'seo_url',
            'full_slug' => $full_slug,
            'page_type' => 'normal_page',
            'secure' => 'off',
            'login_requirement' => 'off',
            'default_page' => "no",
            'header_id' => $header_row->id,
            'footer_id' => $footer_row->id,
            'product_type_id' => $ptype,
            'special_page_type' => $special_page_type,
            'special_page_type2' => $special_page_type2,
            'product_category_id' => $pcat,
            'product_category_type' => $pctype,
            'make_page_type' => $maketype,
            'trash_status' => 'no',
            'active_status' => 'a'
        );

        if ($action_type == 'add') {
            
            $data['title']=$pagename;
            $data['description']=$pagename;
            $data['keywords']=$pagename;
            
            $this->db->insert('cms_pages', $data);
            $pageid = $this->db->insert_id();
            /*
             * routing section
             */
            $route_chk_tble = 'cms_pages';
            $route_type = 'page';
            $route_type1 = 'page_route';
            $this->route_model->create_route($pageid, $route_chk_tble, $route_type, $route_type1);
            $this->route_model->save_routes($route_type);
            /*
             * EOF routing section
             */
        } else if ($action_type == 'edit') {
            if (!empty($pcat)) {

                $this->db->where('product_category_id', $pcat);
                $this->db->update('cms_pages', $data);
                $pg_row = $this->product_model->GetByRow('cms_pages', $pcat, 'product_category_id');
                $pageid = $pg_row->id;

                /*
                 * routing section
                 */
                $route_chk_tble = 'cms_pages';
                $route_type = 'page';
                $route_type1 = 'page_route';
                $this->route_model->update_route($pageid, $route_chk_tble, $route_type, $route_type1);
                $this->route_model->save_routes($route_type);
                /*
                 * EOF routing section
                 */
            }
        }



        $data2 = array(
            'page_id' => $pageid
        );
        $this->db->where('id', $pageid);
        $this->db->update('cms_pages', $data2);



        /*
         * Set page Details In Full data 
         */
        $this->product_model->pageFullData($pageid);
        /*
         * EOF Set page Details In Full data 
         */



        $page_id = $pageid;


        $parameter_array = array(
            "cache_key" => "page_id",
            "cache_value" => $page_id,
            "cache_action" => "remove"
        );
        $this->common_model->createCacheBlockIdTree($parameter_array);



        /* page json section */
        $setvaluearray = array(
            "admin_key" => "page_id",
            "admin_value" => $page_id
        );
        $this->common_model->adminSessionUpdate($setvaluearray);
    }

    function select_page_slug() {
        if ($this->input->post('parentname') != 0) {

            $full_slug = $this->input->post('full_url_sec') . '/' . $this->input->post('slug');
        } else {

            $full_slug = $this->input->post('slug');
        }
        if ($this->input->post('url_type') == 'seo_url') {

            $full_slug = $this->input->post('slug');
        } elseif ($this->input->post('url_type') == 'force_url') {

            $full_slug = $this->input->post('slug');
        }
        $this->db->where('full_slug', $full_slug);
        return $this->db->get('cms_pages')->row();
    }

    function select_page_slug1() {
//        $id = $this->uri->segment(3);
        $id = $_GET['id'];
        $page_row = $this->product_model->GetByRow("cms_pages", $id, "product_category_id");
        if ($this->input->post('parentname') != 0) {

            $full_slug = $this->input->post('full_url_sec') . '/' . $this->input->post('slug');
        } else {

            $full_slug = $this->input->post('slug');
        }
        if ($this->input->post('url_type') == 'seo_url') {

            $full_slug = $this->input->post('slug');
        } elseif ($this->input->post('url_type') == 'force_url') {

            $full_slug = $this->input->post('slug');
        }
        $this->db->where('full_slug', $full_slug);
        $this->db->where('id !=', $page_row->id);
        return $this->db->get('cms_pages')->row();
    }

    function pageFullData($id) {
        $page_row = $this->product_model->GetByRow("cms_pages", $id, "id");
        $page_mandatory_array = array(
            "pageid" => $id,
            "type" => $page_row->type,
            "page_name" => $page_row->page,
            "full_slug" => $page_row->full_slug,
            "slug_type" => $page_row->slug_type,
            "title" => $page_row->title,
            "description" => $page_row->description,
            "keywords" => $page_row->keywords,
            "fixed_status" => $page_row->fixed_status,
            "fixed_type" => $page_row->fixed_type,
            "option_url_key" => $page_row->option_url_key,
            "secure" => $page_row->secure,
            "page_theme_class" => $page_row->page_theme_class,
            "product_type_id" => $page_row->product_type_id, // for product category page
            "special_page_type" => $page_row->special_page_type, // for product category page
            "special_page_type2" => $page_row->special_page_type2, // for special page
            "product_category_id" => $page_row->product_category_id, // for product category page
            "product_category_type" => $page_row->product_category_type, // for product category page
            "trash_status" => $page_row->trash_status, // for product category page
            "active_status" => $page_row->active_status, // for product category page
        );

        $page_mandatory_data = json_encode($page_mandatory_array);


        $data = array(
            'page_mandatory_data' => $page_mandatory_data,
        );
        $this->db->where('id', $id);
        $this->db->update('cms_pages', $data);


        /* page json section */
        $page_id = $id;
        $setvaluearray = array(
            "admin_key" => "page_id",
            "admin_value" => $page_id
        );
        $this->common_model->adminSessionUpdate($setvaluearray);

//        $lightweightarray = array(
//            "featurebox_id" => "",
//            "page_id" => $page_id,
//        );
//        $this->common_model->generateLightWeightPage($lightweightarray);
        /* EOF page json section */

        return;
    }

    /*
     *  page automatically function
     */

    /*
     * Select Category by Name  for unique handling
     */

    function select_by_category_slug() {
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
        return $this->db->get('ec_category')->row();
    }

    /*
     *  End of Select Category by Name  for unique handling
     */

    /*
     * Select Category by Name for unique handling while editing 
     */

    function select_by_category_slug1() {

        $id = '';
        if (isset($_GET['id'])) {

            $id = $_GET['id'];
        }
//        $id = $this->uri->segment(3);
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
        return $this->db->get('ec_category')->row();
    }

    /*
     *  End of Select Category by Name  for unique handling while editing 
     */


    /*
     * Count all Category list which
     * Return number of rows
     */

    function count_all_prodcategory() {

        if (isset($_GET['name'])) {

            $sess_val = $_GET['name'];

            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('category', $s_a);
        }
        $ftype = '';
        if (!empty($_GET['ftype'])) {
            $ftype = $_GET['ftype'];
        }
        if ($ftype == 'shop') {
            $this->db->where('function_type', 'shop');
        } else {
            $this->db->where('function_type !=', 'shop');
        }
        if (!empty($_GET['ctypeid'])) {
            $ctypeid = $_GET['ctypeid'];
            $this->db->where('ctype', $ctypeid);
        }

        if (!empty($_GET['category'])) {
            $category = $_GET['category'];
            $this->db->like('categoryidtree', '+' . $category . '+');
        }

        if (!empty($_GET['category']) || !empty($_GET['name'])) {
            $this->db->order_by('id', 'ASC');
        } else {
            $this->db->order_by('id', 'DESC');
        }

        $this->db->where('trash_status', 'no');
        $this->db->where('ctype', 1);
        $val = $this->db->get('ec_category');
        return $val->num_rows();
    }

    /*
     * End of Count all Category
     */


    /*
     * List all Category 
     */

    function list_prodcategory($perpage, $rec_from) {

        if (isset($_GET['name'])) {

            $sess_val = $_GET['name'];

            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('category', $s_a);
        }

        $ftype = '';
        if (!empty($_GET['ftype'])) {
            $ftype = $_GET['ftype'];
        }
        if ($ftype == 'shop') {
            $this->db->where('function_type', 'shop');
        } else {
            $this->db->where('function_type !=', 'shop');
        }
        if (!empty($_GET['ctypeid'])) {
            $ctypeid = $_GET['ctypeid'];
            $this->db->where('ctype', $ctypeid);
        }
        if (!empty($_GET['category'])) {
            $category = $_GET['category'];
            $this->db->like('categoryidtree', '+' . $category . '+');
        }

        if (!empty($_GET['category']) || !empty($_GET['name'])) {
            $this->db->order_by('id', 'ASC');
        } else {
            $this->db->order_by('id', 'DESC');
        }

        $this->db->where('trash_status', 'no');
        $this->db->where('ctype', 1);
        $this->db->limit($perpage, $rec_from);
        return $this->db->get('ec_category')->result();
    }

    /*
     * End of List all Category
     */




    /*
     * Edit Category
     */

    function edit_prodcategory($id) {

        $cat_details = $this->product_model->GetByRow('ec_category', $id, 'id');
        $ctype = 1;

        if ($this->input->post('url_type') == 'seo_url') {

            if ($this->input->post('parentname') != 0) {

                $full_slug = $this->input->post('full_url_sec') . '/' . $this->input->post('slug');
            } else {

                $full_slug = $this->input->post('slug');
            }
        } elseif ($this->input->post('url_type') == 'force_url') {

            $full_slug = $this->input->post('slug');
        } else {

//            $full_slug = $this->input->post('slug');
            if ($this->input->post('parentname') != 0) {

                $full_slug = $this->input->post('full_url_sec') . '/' . $this->input->post('slug');
            } else {

                $full_slug = $this->input->post('slug');
            }
        }


        
        $data = array(
            'function_type' => 'product',
            'ctype' => 1,
            'parent_id' => $this->input->post('parentname'),
            'category' => $this->input->post('input_name'),
            'short_name' => $this->input->post('short_name'),
            'slug' => $this->input->post('slug'),
            'slug2' => $this->input->post('slug'),
            'url_key' => 'product_category_route',
            'slug_type' => $this->input->post('url_type'),
            'full_slug' => $full_slug,
            'order_no' => $this->input->post('order_number'),
            'active_status' => $this->input->post('active_status'),
            'trash_status' => 'no',
            'category_default_combo_id' => $this->input->post('default_combo_id'),
            'menu_id' => $this->input->post('menulist')

        );

        $this->db->where('id', $id);
        $this->db->update('ec_category', $data);

        

        if ($this->input->post('url_type') == 'auto_url') {

            $full_slug = $this->input->post('slug') . '/productcat-' . $id;

            $data3 = array(
                'full_slug' => $full_slug,
            );
            $this->db->where('id', $id);
            $this->db->update('ec_category', $data3);
        }



        $get_val = $this->product_model->pass_tree_values($id, $id, 'category');
        if ($this->input->post('parentname') != 0) {


            $parent_details = $this->product_model->GetByRow('ec_category', $this->input->post('parentname'), 'id');
            $parent_category_slug = $parent_details->slug;
            $get_val = $this->product_model->pass_tree_values($this->input->post('parentname'), $id, 'category');



            $data2 = array(
                'categoryidtree' => $get_val['category_ids'],
                'categorynametree' => $get_val['category_names'],
                'categoryslugtree' => $get_val['category_slugs'],
                'categoryfull' => $get_val['category_full'],
                'parent_main_slug' => $get_val['cat_parent_route'],
                'parent_main_id' => $get_val['cat_parent_id'],
                'parent_sub_slug' => $parent_details->slug,
                'parent_sub_id' => $this->input->post('parentname')
                

            );


            $this->product_model->changeProductCatSlug($cat_details->slug, $this->input->post('slug'), $this->input->post('url_type'), $get_val['cat_parent_id'], $id); //oldslug, new slug,url_type, main id, current id     
        } else {


            $option = $this->common_model->get_options();


            $data2 = array(
                'categoryidtree' => $get_val['category_ids'],
                'categorynametree' => $get_val['category_names'],
                'categoryslugtree' => $get_val['category_slugs'],
                'categoryfull' => $get_val['category_full'],
                'parent_main_slug' => $this->input->post('slug'),
                'parent_main_id' => $id,
                'parent_sub_slug' => $this->input->post('slug'),
                'parent_sub_id' => $id
                

            );


            $this->product_model->changeProductCatSlug($cat_details->slug, $this->input->post('slug'), $this->input->post('url_type'), $id, $id); //oldslug, new slug,url_type, main id, current id
        }
        $this->db->where('id', $id);
        $this->db->update('ec_category', $data2);


        $data_category_main = array(
            'parent_main_slug' => $this->input->post('slug'),
        );
        $this->db->where('parent_main_id', $id);
        $this->db->update('ec_category', $data_category_main);

        $data_category_sub = array(
            'parent_sub_slug' => $this->input->post('slug'),
        );
        $this->db->where('parent_sub_id', $id);
        $this->db->update('ec_category', $data_category_sub);


        $category_name2 = $this->input->post('input_name');
        $category_name2 = strtolower($category_name2);
        $category_slug2 = $this->input->post('slug');



        $query2 = "UPDATE ec_category SET "
                . "categorynametree = REPLACE(categorynametree, '+" . strtolower($cat_details->category) . "+', '+" . $category_name2 . "+'), "
                . "categoryslugtree = REPLACE(categoryslugtree, '+" . strtolower($cat_details->slug) . "+', '+" . $category_slug2 . "+'), "
                . "categoryfull = REPLACE(categoryfull, '__" . strtolower($cat_details->category) . "__" . strtolower($cat_details->slug) . "+', '__" . $category_name2 . "__" . $category_slug2 . "+') "
                . "WHERE parent_main_id='" . $cat_details->parent_main_id . "'";

        $this->db->query($query2);

        $category_type_row = $this->product_model->GetByRow_notrash('ec_categorytypes', $ctype, 'id');

        if ($category_type_row->fixed_type == "category") {

           
            $data_product_main = array(
                'parent_main_name' => $this->input->post('input_name'),
                'parent_main_slug' => $this->input->post('slug'),
            );
            $this->db->where('parent_main_id', $id);
            $this->db->update('ec_products', $data_product_main);

            $data_product_sub = array(
                'parent_sub_name' => $this->input->post('input_name'),
                'parent_sub_slug' => $this->input->post('slug'),
            );
            $this->db->where('parent_sub_id', $id);
            $this->db->update('ec_products', $data_product_sub);


            $query = "UPDATE ec_products SET "
                    . "categorynametree = REPLACE(categorynametree, '+" . strtolower($cat_details->category) . "+', '+" . $category_name2 . "+'), "
                    . "categoryslugtree = REPLACE(categoryslugtree, '+" . strtolower($cat_details->slug) . "+', '+" . $category_slug2 . "+'), "
                    . "categoryfull = REPLACE(categoryfull, '__" . strtolower($cat_details->category) . "__" . strtolower($cat_details->slug) . "+', '__" . $category_name2 . "__" . $category_slug2 . "+') "
                    . "WHERE parent_main_id='" . $cat_details->parent_main_id . "'";

            $this->db->query($query);


        } 
             
    }
	

function update_product_attribute_with_category($parameters)
{

$categoryid = $parameters['catid'];
$category_based_product_attributes_added = $parameters['category_based_product_attributes_added'];
$category_based_product_attributes_added = explode(',',$category_based_product_attributes_added);
$category_based_product_attributes_added = array_filter($category_based_product_attributes_added);

$category_based_product_attributes_removed = $parameters['category_based_product_attributes_removed'];
$category_based_product_attributes_removed = explode(',',$category_based_product_attributes_removed);
$category_based_product_attributes_removed = array_filter($category_based_product_attributes_removed);

if(!empty($category_based_product_attributes_added))
{
foreach($category_based_product_attributes_added as $attributeid)
{
	
$attribute_detail = $this->product_model->GetByRow('ec_product_attributes', $attributeid, 'id');

$relation_category = array();
if(!empty($attribute_detail->relation_category))
{
$relation_category = json_decode($attribute_detail->relation_category,TRUE);
}

$relation_category[] = $categoryid;
$relation_category = array_unique($relation_category);
$relation_category = json_encode($relation_category);

		$data = array(

			'relation_category' => $relation_category,
        );
		
		$this->db->where('id', $attributeid);
        $this->db->update('ec_product_attributes', $data);


	
}
}


if(!empty($category_based_product_attributes_removed))
{
foreach($category_based_product_attributes_removed as $attributeid)
{
	
$attribute_detail = $this->product_model->GetByRow('ec_product_attributes', $attributeid, 'id');

$relation_category = array();
if(!empty($attribute_detail->relation_category))
{
$relation_category = json_decode($attribute_detail->relation_category,TRUE);
}

$categoryid_key = array_search($categoryid, $relation_category);
if ($categoryid_key !== false) {
    unset($relation_category[$categoryid_key]);
}

$relation_category = array_unique($relation_category);
$relation_category = json_encode($relation_category);

		$data = array(

			'relation_category' => $relation_category,
        );
		
		$this->db->where('id', $attributeid);
        $this->db->update('ec_product_attributes', $data);


	
}
}

}

    function edit_prodcategory2($id) {
		
       $ec_category_detail = $this->GetByRow_notrash('ec_category', $id, 'id');		
		
        $data = array(
            'category_description' => $this->input->post('category_description'),
            'banner_title' => $this->input->post('bannertitle'),
            'banner_description' => $this->input->post('banner_description'),           
        );
                      
        $seo_alt = $ec_category_detail->category;
        
        $seo_title = $ec_category_detail->category;
               
        /** Category Picture file control */
        $banner_images_str = $this->input->post('final_images');
        $banner_images = explode(',', $banner_images_str);

        $mediaID = $this->input->post('mediaID');
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

            $data = $this->product_model->array_push_assoc($data, 'category_picture', $image_encode1);
        } else {

            $image_detail_a = $this->GetByRow_notrash('cms_media', $mediaID, 'id');
            
            if (!empty($image_detail_a->images)) {
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
            }                       

            $image_array = array();
            $exist_image_detail = json_decode($ec_category_detail->category_picture, TRUE);
            if (!empty($exist_image_detail)) {
                $image_array[] = array(
                    'image' => $exist_image_detail[0]['image'],
                    'combo' => $exist_image_detail[0]['combo'],
                    'media_id' => $exist_image_detail[0]['media_id'],
                    'seo_alt' => $seo_alt,
                    'seo_title' => $seo_title,
                );
                $image_encode = json_encode($image_array);
                $data = $this->product_model->array_push_assoc($data, 'category_picture', $image_encode);
            }
        }
        /** EOF Category Picture file control */
              
        /** EOF Banner Picture file control */
        $this->db->where('id', $id);
        $this->db->update('ec_category', $data);

    }

    function edit_prodcategory3($id) {

        $ec_category_detail = $this->GetByRow_notrash('ec_category', $id, 'id');	

        $data = array(            
            'title' => $this->input->post('page_title'),
            'description' => $this->input->post('seo_description'),
            'keywords' => $this->input->post('seo_keywords'),
        );

        $seo_alt = $ec_category_detail->category;
        
        $seo_title = $ec_category_detail->category;

        /** Category Picture file control */
        $banner_images_str = $this->input->post('final_images');
        $banner_images = explode(',', $banner_images_str);

        $mediaID = $this->input->post('mediaID');
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

            $data = $this->product_model->array_push_assoc($data, 'banner', $image_encode1);
        } else {

            $image_detail_a = $this->GetByRow_notrash('cms_media', $mediaID, 'id');
            
            if (!empty($image_detail_a->images)) {
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
            }                       

            $image_array = array();
            $exist_image_detail = json_decode($ec_category_detail->banner, TRUE);
            if (!empty($exist_image_detail)) {
                $image_array[] = array(
                    'image' => $exist_image_detail[0]['image'],
                    'combo' => $exist_image_detail[0]['combo'],
                    'media_id' => $exist_image_detail[0]['media_id'],
                    'seo_alt' => $seo_alt,
                    'seo_title' => $seo_title,
                );
                $image_encode = json_encode($image_array);
                $data = $this->product_model->array_push_assoc($data, 'banner', $image_encode);
            }
        }
        /** EOF Category Picture file control */

        $this->db->where('id', $id);
        $this->db->update('ec_category', $data);

    }

    function deactiveProdcutTypePages($deactive_array) {

        $product_category_id = $deactive_array["product_category_id"];


        $page_data = array(
            "active_status" => 'd'
        );
        $this->db->where('type', 'main_page');
        $this->db->where('product_category_id', $product_category_id);
        $this->db->where('special_page_type', "connection_page");
        $this->db->update('cms_pages', $page_data);
    }

    function pageActivate($pageRow) {
        $page_data = array(
            "active_status" => 'a'
        );
        $this->db->where('id', $pageRow->id);
        $this->db->update('cms_pages', $page_data);
    }

    /*
     * End of Edit Category
     */

    public function sub_cat_tree_selected($category_id, $current_level,
            $top_parent, $old_tree) {

        $data['category_id'] = $category_id;
        $data['current_level'] = $current_level;
        $data['top_parent'] = $top_parent;
        $data['old_tree'] = $old_tree;

        if ($current_level == 1) {
            $data['span_class'] = 'label label-info';
        } elseif ($current_level == 2) {
            $data['span_class'] = 'label label-warning';
        } elseif ($current_level == 3) {
            $data['span_class'] = 'label label-important';
        } elseif ($current_level == 4) {
            $data['span_class'] = 'label label-inverse';
        } elseif ($current_level == 5) {
            $data['span_class'] = 'label';
        } elseif ($current_level == 6) {
            $data['span_class'] = 'label label-info';
        } elseif ($current_level == 7) {
            $data['span_class'] = 'label label-warning';
        } elseif ($current_level == 8) {
            $data['span_class'] = 'label label-important';
        } else {
            $data['span_class'] = 'label label-inverse';
        }
        $data['level'] = $current_level + 1;
        $data['subcategories'] = $this->product_model->get_subcategory($category_id);
        $result = $this->load->view('product/prodcategory/subtree.php', $data);

        echo $result;
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
     * Count all Category list which
     * Return number of rows
     */

    function trash_count_all_prodcategory() {

        if ($this->uri->segment(3) != '0') {

            $sess_val = $this->uri->segment(3);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('category', $s_a);
        }

        $this->db->where('trash_status', 'yes');
        $val = $this->db->get('ec_category');
        return $val->num_rows();
    }

    /*
     * End of Count all Category
     */


    /*
     * List all Trash Category 
     */

    function trash_list_prodcategory($perpage, $rec_from) {

        if ($this->uri->segment(3) != '0') {

            $sess_val = $this->uri->segment(3);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('category', $s_a);
        }

        $this->db->where('trash_status', 'yes');
        $this->db->order_by('date_deleted', 'DESC');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($perpage, $rec_from);
        return $this->db->get('ec_category')->result();
    }

    /*
     * End of List all Trash Category
     */

    function get_all_main_categories() {

        $ctype_row = $this->product_model->GetByRow_notrash('ec_categorytypes', 'category', 'fixed_type');

        $this->db->where('parent_id', '0');
        $this->db->where('ctype', $ctype_row->id); //To get category
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('ec_category')->result();
    }

    /*
     * nikhil 
     */

    function get_all_categories($type, $id) {

        $ctype_row = $this->product_model->GetByRow_notrash('ec_categorytypes', 'category', 'fixed_type');

        if ($type == 'parent') {
            $this->db->where('parent_id', '0');
        }
        $this->db->where('ctype', $ctype_row->id); //To get category
        $this->db->where('id', $id);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('ec_category')->result();
    }

    /*
     * nikhil 
     */

    function get_all_main_brands() {

        $ctype_row = $this->product_model->GetByRow_notrash('ec_categorytypes', 'brand', 'fixed_type');

        $this->db->where('parent_id', '0');
        $this->db->where('ctype', $ctype_row->id); //To get brand
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('ec_category')->result();
    }

    function get_main_subcategories($cid) {
        $this->db->where('parent_id', $cid);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('ec_category')->result();
    }

    function get_all_product_type_categories() {

        $this->db->where('type', 'product_category');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('id', 'ASC');
        return $this->db->get('ec_categorytypes')->result();
    }

    function get_all_product_type_product() {

        $this->db->where('type', 'product_type');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
//        $this->db->where('show_admin_status', 'yes');
        $this->db->order_by('id', 'ASC');
        return $this->db->get('ec_categorytypes')->result();
    }

    function get_all_addon_product() {
        $this->db->where('product_categorytype_id', 4); //Here id is 4 which is of Addons from table ec_categorytypes
        $this->db->order_by('prod_name', 'ASC');
        return $this->db->get('ec_products')->result();
    }

    function add_product() {

        $cat = $this->input->post('cat');
        $cat_details = $this->product_model->GetByRow('ec_category', $cat, 'id');
        $cat_route = $cat_details->slug;
        $cat_name = $cat_details->category;

        /* For getting category tree with parent values */
        $get_val_a = $this->product_model->pass_tree_values($cat, $cat, 'product');

        $product_name = $this->input->post('product_name');
        $product_clean_name = $this->input->post('slug');

        if ($this->input->post('url_type') == 'seo_url') {
            if($this->input->post('full_url_sec') != ''){
                $full_slug = $this->input->post('full_url_sec') . '/' . $this->input->post('slug');
            }else{
                $full_slug = $this->input->post('slug');
            }            
        } elseif ($this->input->post('url_type') == 'force_url') {
            $full_slug = $this->input->post('slug');
        } else {
            $full_slug = $this->input->post('slug');
        }

        $sku = $this->input->post('sku');
        $product_name = $this->input->post('product_display_name') . ' - ' . $sku;

        $active_status = $this->input->post('active_status');

        $sub_menu_array = $this->input->post('parent_sub_menu');
        $menu_id_tree = "+";

        if($sub_menu_array != NULL){
            foreach($sub_menu_array as $sub_menu_row){
                $menu_id_tree = $menu_id_tree . $sub_menu_row . '+';
            }
        }

        $featured_types_list = $this->input->post('featured_types_list');

        $featured_types_tree = "+";
        
        $featured_products_status = $this->input->post('featured_status');
        
         

         if($featured_types_list != NULL){

            // $featured_products_status = "yes";

            foreach($featured_types_list as $featured_type_val){
                $featured_types_tree = $featured_types_tree . $featured_type_val . "+";
            }

         }

         // dump($featured_types_tree);die();

        $data = array(
            'function_type' => 'product',
            'prod_name' => $product_name,
            'product_display_name' => $this->input->post('product_display_name'),           
            'product_type2' => $this->input->post('product_type2'),
            'slug' => $this->input->post('slug'),
            'slug2' => $this->input->post('slug'),
            'url_key' => 'product_item_route',
            'slug_type' => $this->input->post('url_type'),
            'full_slug' => $full_slug,
            'sku' => $this->input->post('sku'),
            'parent_sub_name' => $cat_name,
            'parent_sub_slug' => $cat_route,
            'parent_sub_id' => $this->input->post('cat'),
            'parent_main_name' => $get_val_a['cat_parent_name'],
            'parent_main_slug' => $get_val_a['cat_parent_route'],
            'parent_main_id' => $get_val_a['cat_parent_id'],
            'categoryidtree' => $get_val_a['category_ids'],
            'categorynametree' => $get_val_a['category_names'],
            'categoryslugtree' => $get_val_a['category_slugs'],
            'categoryfull' => $get_val_a['category_full'],
            'active_status' => $active_status,
             'order_no' => $this->input->post('order_number'),
            'trash_status' => 'no',            
            'sku_in_url' => $this->input->post('sku_in_url'),
            'menu_id_tree' => $menu_id_tree,

            // 'featured_products' => $featured_products_status,

            'featured_types_tree' => $featured_types_tree,
        );       

        $this->db->insert('ec_products', $data);
        $pid = $this->db->insert_id();

        if ($this->input->post('url_type') == 'auto_url') {

            $full_slug = $this->input->post('slug') . '/productitem-' . $pid;

            $data3 = array(
                'full_slug' => $full_slug,
            );
            $this->db->where('id', $pid);
            $this->db->update('ec_products', $data3);
        }

        return $pid;
    }

    /*
     * Select Product by Name  for unique handling
     */

    function selectProductSlug() {
        if ($this->input->post('url_type') == 'seo_url') {
            if($this->input->post('full_url_sec') != ''){
                $full_slug = $this->input->post('full_url_sec') . '/' . $this->input->post('slug');
            }else{
                $full_slug = $this->input->post('slug');
            }            
        } elseif ($this->input->post('url_type') == 'force_url') {
            $full_slug = $this->input->post('slug');
        }
        $this->db->where('full_slug', $full_slug);
        return $this->db->get('ec_products')->row();
    }

    /*
     *  End of Product Category by Name  for unique handling
     */

    /*
     * Select Product by Name for unique handling while editing 
     */

    function selectProductSlug1() {
//        $id = $this->uri->segment(3);
        if (isset($_GET['id'])) {

            $id = $_GET['id'];
        }
        if ($this->input->post('url_type') == 'seo_url') {
            if($this->input->post('full_url_sec') != ''){
                $full_slug = $this->input->post('full_url_sec') . '/' . $this->input->post('slug');
            }else{
                $full_slug = $this->input->post('slug');
            }
            
        } elseif ($this->input->post('url_type') == 'force_url') {

            $full_slug = $this->input->post('slug');
        }
        $this->db->where('full_slug', $full_slug);

        $this->db->where('id !=', $id);

        return $this->db->get('ec_products')->row();
    }

    /*
     *  End of Select Product by Name  for unique handling while editing 
     */

    function add_feature_product($feature_id, $content_id, $content_items) {

        $new_content_items = $content_items . $content_id . '+';

        $featured_data = array(
            'content_category_type_2_value' => $new_content_items);

        $this->db->where('id', $feature_id);
        $this->db->update('cms_featuredbox', $featured_data);

        $updated_tree = '+' . $feature_id . '+';
        $update_data = array(
            'featurebox_id_tree' => $updated_tree
        );
        $this->db->where('id', $content_id);
        $this->db->update('ec_products', $update_data);
    }

    function edit_product($id) {

        $product_details = $this->product_model->GetByRow_notrash('ec_products', $id, 'id');        

        $option = $this->common_model->get_options();

        $cat = $this->input->post('cat');
        $cat_details = $this->product_model->GetByRow('ec_category', $cat, 'id');
        $cat_route = $cat_details->slug;
        $cat_name = $cat_details->category;
        $ctypetree = '+';

        /* For getting category tree with parent values */
        $get_val_a = $this->product_model->pass_tree_values($cat, $cat, 'product');

        $product_name = $this->input->post('product_name');
        $product_clean_name = $this->input->post('slug');


        if ($this->input->post('url_type') == 'seo_url') {
            if($this->input->post('full_url_sec') != ''){
                $full_slug = $this->input->post('full_url_sec') . '/' . $this->input->post('slug');
            }else{
                $full_slug = $this->input->post('slug');
            }            
        } elseif ($this->input->post('url_type') == 'force_url') {

            $full_slug = $this->input->post('slug');
        } else {

            $full_slug = $this->input->post('slug');
        }

        $product_update_id = $id;

        
        $prod_name = $this->input->post('product_display_name');

        if (strpos($prod_name, $option->sku_prefix) === false) {
            $product_name = $prod_name . ' - ' . $this->input->post('sku');
        } else {
            $product_name = $prod_name;
        }

        $active_status = $this->input->post('active_status');

        $sub_menu_array = $this->input->post('parent_sub_menu');
        $menu_id_tree = "+";

        if($sub_menu_array != NULL){
            foreach($sub_menu_array as $sub_menu_row){
                $menu_id_tree = $menu_id_tree . $sub_menu_row . '+';
            }
        }



        $featured_types_list = $this->input->post('featured_types_list');

        $featured_types_tree = "+";

        $featured_products_status = $this->input->post('featured_status');
        
         

         if($featured_types_list != NULL){

            // $featured_products_status = "yes";

            foreach($featured_types_list as $featured_type_val){
                $featured_types_tree = $featured_types_tree . $featured_type_val . "+";
            }

         }

         // dump($featured_types_tree);die();

        $data = array(
            'function_type' => 'product',
            'prod_name' => $product_name,
            'product_display_name' => $this->input->post('product_display_name'), 
            'product_type2' => $this->input->post('product_type2'),
            'slug' => $this->input->post('slug'),
            'slug2' => $this->input->post('slug'),
            'url_key' => 'product_item_route',
            'slug_type' => $this->input->post('url_type'),
            'full_slug' => $full_slug,
            'sku' => $this->input->post('sku'),
            'parent_sub_name' => $cat_name,
            'parent_sub_slug' => $cat_route,
            'parent_sub_id' => $this->input->post('cat'),
            'parent_main_name' => $get_val_a['cat_parent_name'],
            'parent_main_slug' => $get_val_a['cat_parent_route'],
            'parent_main_id' => $get_val_a['cat_parent_id'],
            'categoryidtree' => $get_val_a['category_ids'],
            'categorynametree' => $get_val_a['category_names'],
            'categoryslugtree' => $get_val_a['category_slugs'],
            'categoryfull' => $get_val_a['category_full'],
            'active_status' => $active_status,
             'order_no' => $this->input->post('order_number'),
            'trash_status' => 'no',            
            'sku_in_url' => $this->input->post('sku_in_url'),
            'menu_id_tree' => $menu_id_tree,

            // 'featured_products' => $featured_products_status,

            'featured_types_tree' => $featured_types_tree,
        );

      
            $this->db->where('id', $product_update_id);
            $this->db->update('ec_products', $data);


        if ($this->input->post('url_type') == 'auto_url') {

            $full_slug = $this->input->post('slug') . '/productitem-' . $product_update_id;

            $data3 = array(
                'full_slug' => $full_slug,
            );
            $this->db->where('id', $product_update_id);
            $this->db->update('ec_products', $data3);
        }
		
        return $product_update_id;
    }

    function editProducts2($id) {

       /* $product_title_header = array(
            'tag' => $this->input->post('titletype'),
            'text' => $this->input->post('title'),            
        );
        $product_title_json = json_encode($product_title_header);

        $second_title_header = array(
            'tag' => $this->input->post('second_title_type'),
            'text' => $this->input->post('second_title'),            
        );
        $second_title_json = json_encode($second_title_header);

        $third_title_header = array(
            'tag' => $this->input->post('third_title_type'),
            'text' => $this->input->post('third_title'),            
        );
        $third_title_json = json_encode($third_title_header);

        $fourth_title_header = array(
            'tag' => $this->input->post('fourth_title_type'),
            'text' => $this->input->post('fourth_title'),            
        );
        $fourth_title_json = json_encode($fourth_title_header);/**/

        $quote_title_array = array(
            'tag' => $this->input->post('quote_tag'),
            'text' => $this->input->post('quote_title'),            
        );

        $quote_title_json = json_encode($quote_title_array);


        $product_update_id = $id;        

        $product_details = $this->product_model->GetByRow_notrash('ec_products', $id, 'id');
        
        $original_price = $this->input->post('original_price');
        $original_price = trim($original_price);
        
        if(!is_numeric($original_price)){
            $original_price = 1;
        }       
                
        $selling_price = $this->input->post('selling_price');
        $selling_price = trim($selling_price);
        
        if(!is_numeric($selling_price)){
            $selling_price = 1;
        }
        
        $discount_status = "no";
        if($selling_price < $original_price){
            $discount_status = "yes";
        }

        $extra_seo_details = array();
        $extra_seo_linkdetails = array();
        $extra_seo_title = $this->input->post('seotitle');
        $extra_seo_link = $this->input->post('seolink');
        
        foreach($extra_seo_title as $seo_key => $seo_val)
        {
            if($seo_val != "")
            {
               $extra_seo_details[$seo_val]=$extra_seo_link[$seo_key]; 
            }
           
        }
      
        $extra_seo_encode = json_encode($extra_seo_details);
        
        $data = array(
            'product_title' => $this->input->post('title'),
            'prod_short_description' => $this->input->post('short_description'),
            'prod_brief_description' => $this->input->post('brief_description'),
            'second_title' => $this->input->post('second_title'),
            'third_title' => $this->input->post('third_title'),
            'fourth_title' => $this->input->post('fourth_title'),
            'quote_title' => $this->input->post('quote_title'),
            'quote_description' => $this->input->post('quote_description'),
            'wedding_date' => $this->input->post('wedding_date'),
            'original_price' => $original_price,
            'selling_price' => $selling_price,
            'discount_status' => $discount_status,
            'qty' => 1,
            'featured_products' => $this->input->post('featured_status'),
            'iconClass' => $this->input->post('icon_class'),
            'extra_seo_links' => $extra_seo_encode,

            // 'product_title_json' => $product_title_json,
            // 'second_title_json' => $second_title_json,
            // 'third_title_json' => $third_title_json,
            // 'fourth_title_json' => $fourth_title_json

            'quote_title_json' => $quote_title_json,
            'post_type' => $this->input->post('post_type'),
        );

        
        
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
        
        $data = $this->product_model->array_push_assoc($data, 'custom_link', $custom_link_json); 
        
        $this->db->where('id', $product_update_id);
        $this->db->update('ec_products', $data);
        
        return $product_update_id;
    }

    function editProducts3($id) {
        
        $product_update_id = $id;        

        $product_details = $this->product_model->GetByRow_notrash('ec_products', $id, 'id');

        $data = array(

            'seo_title' => $this->input->post('seo_title'),
            'seo_description' => $this->input->post('seo_description'),
            'seo_keywords' => $this->input->post('seo_keywords')            
        );
        $image_type = $this->input->post('imagetype');
        $banner_images_str = $this->input->post('final_images');
        $imgArray = $this->GetByRow('ec_products', $product_update_id, 'id');

        $default_image_count = -1;
        
        if ($banner_images_str != "") {
            $banner_images = explode(',', $banner_images_str);

            if ($banner_images_str != "") {
                $bannerID = array();
                $image_array = array();
                $j = 0;

                $i = 0;
                
                $seo_alt = $imgArray->product_display_name;
                $seo_title = $imgArray->product_display_name;
                $current_default_image = $banner_images[0];
                
                foreach ($banner_images as $banner) {  
                    $image_array = array(
                        'image' => $banner,
                        'combo' => $this->input->post('combo'),
                        'seo_alt' => $seo_alt,
                        'seo_title' => $seo_title,
                    );

                    $image_encode = json_encode($image_array);

                    $image_size="";
                    if($image_type[$i]=='other')
                    {
                        $image_size = 'half_left';
                    }
                    else{
                        $image_size = 'normal';
                    }

                    $data_media = array(
                        'type' => 'product_image',
                        'type2' => 'product',
                        'type_trash' => 'no',
                        'images' => $image_encode,
                        'prod_cat' => $product_update_id,
                        'show_image_status' => 'yes',
                        'image_type' =>$image_type[$i],
                        'image_size' =>  $image_size
                    );
                    if ($image_type[$i] == 'default_img') {

                        $default_image_count = $i;

                        $data_default_exists = array(
                            "default_img" => "no"
                        );

                        $this->db->where('type', 'product_image');
                        $this->db->where('type2', 'product');
                        $this->db->where('prod_cat', $product_update_id);
                        $this->db->update('cms_media', $data_default_exists);
                        
                        $data_media = $this->product_model->array_push_assoc($data_media, 'default_img', 'yes');

                    } else {
                        $data_media = $this->product_model->array_push_assoc($data_media, 'default_img', 'no');
                    }

                    $this->db->insert('cms_media', $data_media);
                    $bannerID[] = $this->db->insert_id();
                    $j++;
                    $i++;
                }

                if ($default_image_count >= 0) {
                    //To save the first image as deafult to  ec_products table

                    $image_array1 = array(
                        'image' => $banner_images[$default_image_count],
                        'combo' => $this->input->post('combo'),
                        'media_id' => $bannerID[$default_image_count],
                        'seo_alt' => $seo_alt,
                        'seo_title' => $seo_title,
                    );

                    $image_encode1 = json_encode($image_array1);
                    
                    $data = $this->product_model->array_push_assoc($data, 'prod_file', $image_encode1);
                    
                }
            }
        }
    
        
        $this->db->where('id', $product_update_id);
        $this->db->update('ec_products', $data);        
        return $product_update_id;
    }
    /*
     * Count all Product list which
     * Return number of rows
     */

    function count_all_product() {

        $this->product_model->list_product_sorting();
        $val = $this->db->get('ec_products');
        return $val->num_rows();
    }

    /*
     * End of Count all Product
     */

    function list_product_sorting() {

        if (isset($_GET['sort_radio'])) {
            if (isset($_GET['custom_sort'])) {

                $custom_text = $_GET['custom_sort'];

                $sort_value = $_GET['sort_radio'];

                $this->db->order_by($custom_text, $sort_value);
            }
        } else {
            $this->db->order_by('id', 'DESC');
        }


        if (isset($_GET['name']) && ($_GET['name'] != "")) {

            $sess_val = $_GET['name'];

//            $s_a = str_replace("123", "&", $sess_val);
            $s_a = str_replace("-", " ", $sess_val);
            $s_a = strtolower($s_a);
            $like_clause_string = "product_title  LIKE '%" . $s_a . "%'"
//                    . "OR categorynametree  LIKE '%" . $s_a . "%' "
                  . " OR prod_name  LIKE '%" . $s_a . "%'  "
                    . " OR  sku LIKE '%" . $s_a . "%'   "
//                    . " OR  supplier_code LIKE '%" . $sess_val . "%'   "
                    . " OR  prod_code LIKE '%" . $s_a . "%' ";
            $this->db->where("(" . $like_clause_string . ")", NULL, FALSE);
        }

        if (isset($_GET['category']) && ($_GET['category'] != "")) {

            $cat_id = $_GET['category'];
            $this->db->like('categoryidtree', '+' . $cat_id . '+');
        }

        if (isset($_GET['category_menu']) && ($_GET['category_menu'] != "")) {

            $cat_menu_id = $_GET['category_menu'];
            $this->db->like('menu_id_tree', '+' . $cat_menu_id . '+');
        }

        if (isset($_GET['special_type']) && ($_GET['special_type'] != "")) {

            $special_type = $_GET['special_type'];
            $this->db->like('featured_types_tree', '+' . $special_type . '+');
        }
		
		if (isset($_GET['brand'])) {

            $brand_id = $_GET['brand'];
            $this->db->like('brandidtree', '+' . $brand_id . '+');
        }

        if (isset($_GET['status']) && ($_GET['status'] != "")) {

            $status = $_GET['status'];

            $this->db->where('active_status', $status);
        }
        if (isset($_GET['availability'])) {

            $availability = $_GET['availability'];

            $this->db->where('availability', $availability);
        }
        if (isset($_GET['character'])) {

            $character = $_GET['character'];

            $this->db->where('product_character', $character);
        }

        if (isset($_GET['display'])) {

            $display = $_GET['display'];

            $this->db->where('display_level', $display);
        }

        $this->db->where('trash_status', 'no');
        $ftype = '';
        if (!empty($_GET['ftype'])) {
            $ftype = $_GET['ftype'];
        }
        if ($ftype == 'shop') {
            $this->db->where('function_type', 'shop');
        } else {
            $this->db->where('function_type', 'product');
        }

        if (isset($_GET['prod_type'])) {

            $prod_type = $_GET['prod_type'];
            $this->db->where('product_categorytype_id', $prod_type);
        }
    }

    /*
     * List all Product
     */

    function list_product($perpage, $rec_from) {

        $this->product_model->list_product_sorting();

        $this->db->limit($perpage, $rec_from);
        return $this->db->get('ec_products')->result();
    }

    /*
     * End of List all Product 
     */


    /*
     * Count all Product list which is in trash
     * Return number of rows
     */

    function trash_count_all_product() {

        if ($this->uri->segment(4) == 'shop') {
            $this->db->where('function_type', 'shop');
        } else {
            $this->db->where('function_type', 'product');
        }

        if ($this->uri->segment(3) != '0') {

            $sess_val = $this->uri->segment(3);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->or_like('prod_name', $s_a);
            $sku_s_a = strtolower($s_a);
            $this->db->or_like('sku', $sku_s_a);
            $this->db->or_like('prod_code', $s_a);
        }

        $this->db->where('trash_status', 'yes');
        $val = $this->db->get('ec_products');
        return $val->num_rows();
    }

    /*
     * End of Count all Product
     */


    /*
     * List all Trash Product
     */

    function trash_list_product($perpage, $rec_from) {

        if ($this->uri->segment(4) == 'shop') {
            $this->db->where('function_type', 'shop');
        } else {
            $this->db->where('function_type', 'product');
        }

        if ($this->uri->segment(3) != '0') {

            $sess_val = $this->uri->segment(3);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->or_like('prod_name', $s_a);
            $sku_s_a = strtolower($s_a);
            $this->db->or_like('sku', $sku_s_a);
            $this->db->or_like('prod_code', $s_a);
        }

        $this->db->where('trash_status', 'yes');
        $this->db->order_by('date_deleted', 'DESC');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($perpage, $rec_from);
        return $this->db->get('ec_products')->result();
    }

    /*
     * End of List all Trash Product
     */

    function list_product_gallery($id) {
        $this->db->where('prod_cat', $id);
        $this->db->where('type', 'product_image');
        $this->db->where('type2', 'product');
        $this->db->where('type_trash', 'no');
        $this->db->order_by('order', 'ASC');
        return $this->db->get('cms_media')->result();
    }

    function list_brochure_gallery($id) {
        $this->db->where('prod_cat', $id);
        $this->db->where('type', 'product_brochure');
        $this->db->where('type2', 'product');
        $this->db->where('type_trash', 'no');
        return $this->db->get('cms_media')->result();
    }

    function up_news_images($id, $productid) {

        $media = $this->product_model->GetByRow('cms_media', $id, 'id');

        $banner_images_str = $this->input->post('final_images');
        $banner_images = explode(',', $banner_images_str);

        $seo_alt = $this->input->post('seo_alt');
        $seo_title = $this->input->post('seo_title');
        
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

        if ($banner_images_str != "") {

//To save the old existing image to trash
            $data_mediaID = array(
                'type_trash' => 'yes'
            );

            $this->db->where('id', $id);
            $this->db->update('cms_media', $data_mediaID);
//EOF To save the old existing image to trash

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

            $data_media = array(
                'type' => 'product_image',
                'type2' => 'product',
                'type_trash' => 'no',
                'images' => $image_encode,
                'prod_cat' => $productid,
                'title' => $this->input->post('image_title'),                
//                'show_image_status' => $this->input->post('show_status'),
                'order' => $this->input->post('order_number'),
                'custom_link' => $custom_link_json,
                'image_type' =>$this->input->post('imagetype'),
                'image_size' =>$this->input->post('imagesize')
            );
            
            if ($this->input->post('imagetype') == "default_img") {

                $data_default_exists = array(
                    "default_img" => "no"
                );

                $this->db->where('type', 'product_image');
                $this->db->where('type2', 'product');
                $this->db->where('prod_cat', $productid);
                $this->db->update('cms_media', $data_default_exists);

                $data_media = $this->product_model->array_push_assoc($data_media, 'default_img', 'yes');

            }elseif($media->default_img == "yes"){
                $data_media = $this->product_model->array_push_assoc($data_media, 'default_img', 'no');
            }

            $this->db->insert('cms_media', $data_media);
            $bannerID = $this->db->insert_id();

//if the existing image was default then update into ec_products table

            if ($this->input->post('imagetype') == "default_img") {

                $image_array1 = array(
                    'image' => $banner_images[0],
                    'combo' => $this->input->post('combo'),
                    'media_id' => $bannerID,
                    'seo_alt' => $seo_alt,
                    'seo_title' => $seo_title,
                );

                $image_encode1 = json_encode($image_array1);
                $data = array(
                    'prod_file' => $image_encode1,
                );

                $this->db->where('id', $productid);
                $this->db->update('ec_products', $data);

            }elseif($media->default_img == "yes"){
                $image_array1 = array(
                    'image' => "",
                    'combo' => "",
                    'media_id' => "",
                    'seo_alt' => $seo_alt,
                    'seo_title' => $seo_title,
                ); 
                
                $image_encode1 = json_encode($image_array1);
                $data = array(
                    'prod_file' => $image_encode1,
                );

                $this->db->where('id', $productid);
                $this->db->update('ec_products', $data);
            }

        } else {

            $exist_image_detail = json_decode($media->images, TRUE);

            $image_array = array(
                'image' => $exist_image_detail['image'],
                'combo' => $exist_image_detail['combo'],
                'seo_alt' => $seo_alt,
                'seo_title' => $seo_title,
            );

            $image_encode = json_encode($image_array);
            $data = array(
                'title' => $this->input->post('image_title'),
                'image_quote_title' => $this->input->post('quote_title'),
                'content_short_description' => $this->input->post('short_description'),
                'brief_details' => $this->input->post('brief_description'),
//                'show_image_status' => $this->input->post('show_status'),
                'order' => $this->input->post('order_number'),
                'custom_link' => $custom_link_json,                
                'image_type' =>$this->input->post('imagetype'),
                'image_size' =>$this->input->post('imagesize')
            );
            $data = $this->array_push_assoc($data, 'images', $image_encode);

            if ($this->input->post('imagetype') == "default_img"){

                $data_default_exists = array(
                    "default_img" => "no"
                );

                $this->db->where('type', 'product_image');
                $this->db->where('type2', 'product');
                $this->db->where('prod_cat', $productid);
                $this->db->update('cms_media', $data_default_exists);

                $data = $this->product_model->array_push_assoc($data, 'default_img', 'yes');

            }elseif($media->default_img == "yes"){
                $data = $this->product_model->array_push_assoc($data, 'default_img', 'no');
            }

            $this->db->where('id', $id);
            $this->db->update('cms_media', $data);
           

            

            

            if ($this->input->post('imagetype') == "default_img") {

                $image_array1 = array(
                    'image' => $exist_image_detail['image'],
                    'combo' => $exist_image_detail['combo'],
                    'media_id' => $id,
                    'seo_alt' => $seo_alt,
                    'seo_title' => $seo_title,
                );

                $image_encode1 = json_encode($image_array1);

                $data1 = array(
                    'prod_file' => $image_encode1,
                );

                $this->db->where('id', $productid);
                $this->db->update('ec_products', $data1);

            }elseif($media->default_img == "yes"){

                $image_array1 = array(
                    'image' => "",
                    'combo' => "",
                    'media_id' => "",
                    'seo_alt' => $seo_alt,
                    'seo_title' => $seo_title,
                );

                $image_encode1 = json_encode($image_array1);

                $data1 = array(
                    'prod_file' => $image_encode1,
                );

                $this->db->where('id', $productid);
                $this->db->update('ec_products', $data1);
                
            }

        }
    }

    function up_brochure_images($order, $id) {


        $banner_images_str = $this->input->post('final_images');
        $banner_images = explode(',', $banner_images_str);

        $imgArray = $this->GetByRow('ec_products', $id, 'id');
        $img_array = json_decode($imgArray->brochure_file, TRUE);

        $image_array1 = array(
            'image' => $img_array[$order]['image'],
            'image_title' => $this->input->post('brochure_title'),
            'combo' => $this->input->post('combo'),
            'media_id' => $this->input->post('mediaID')
        );
        $seo_alt = $this->input->post('seo_alt');
        $seo_title = $this->input->post('seo_title');

        if ($banner_images_str != "") {
            $mediaID = $this->input->post('mediaID');

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
            }

            $image_encode = json_encode($image_array);

            $data_media = array(
                'type' => 'product_brochure',
                'type2' => 'product',
                'type_trash' => 'no',
                'images' => $image_encode
            );

            $this->db->insert('cms_media', $data_media);
            $bannerID = $this->db->insert_id();


            $image_array1 = $this->product_model->array_push_assoc($image_array1, 'image', $banner_images[0]);
            $image_array1 = $this->product_model->array_push_assoc($image_array1, 'media_id', $bannerID);
        } else {

            $image_detail = $this->GetByRow_notrash('cms_media', $this->input->post('mediaID'), 'id');


            $exist_image_detail = json_decode($image_detail->images, TRUE);

            $image_array = array(
                'image' => $exist_image_detail['image'],
                'combo' => $exist_image_detail['combo'],
                'seo_alt' => $seo_alt,
                'seo_title' => $seo_title,
            );


            $image_encode = json_encode($image_array);

            $data = array();
            $data = $this->array_push_assoc($data, 'images', $image_encode);
            $this->db->where('id', $this->input->post('mediaID'));
            $this->db->update('cms_media', $data);
        }
        $img_array[$order] = $image_array1;

        $image_encode1 = json_encode($img_array);

        $data = array(
            'brochure_file' => $image_encode1,
        );

        $this->db->where('id', $id);
        $this->db->update('ec_products', $data);
    }

    function del_media_img($id, $productid) {

        $media = $this->product_model->GetByRow('cms_media', $id, 'id');
       
            $data_mediaID = array(
                'type_trash' => 'yes'
            );
            $this->db->where('id', $id);
            $this->db->update('cms_media', $data_mediaID);
            return TRUE;
       

       /*  if ($media->default_img == "yes") {
            return FALSE;
        } else {

            $data_mediaID = array(
                'type_trash' => 'yes'
            );
            $this->db->where('id', $id);
            $this->db->update('cms_media', $data_mediaID);
            return TRUE;
        } */
    }

    function del_brochure_img($order, $id) {

        $imgArray = $this->GetByRow('ec_products', $id, 'id');

        $img_array1 = json_decode($imgArray->brochure_file);
        $mediaID = $img_array1[$order]->media_id;

        $data_mediaID = array(
            'type_trash' => 'yes'
        );
        $this->db->where('id', $mediaID);
        $this->db->update('cms_media', $data_mediaID);

        $img_array = json_decode($imgArray->brochure_file, TRUE);

        array_splice($img_array, $order, 1);

        $image_encode1 = json_encode($img_array);

        $data = array(
            'brochure_file' => $image_encode1,
        );

        $this->db->where('id', $id);
        $this->db->update('ec_products', $data);
    }

    function update_deafultProductImageStatus($mediaid, $productid) {

        $data_mediaID_no = array(
            'default_img' => 'no'
        );
        $this->db->where('prod_cat', $productid);
        $this->db->update('cms_media', $data_mediaID_no);


        $data_mediaID_yes = array(
            'default_img' => 'yes'
        );
        $this->db->where('id', $mediaid);
        $this->db->update('cms_media', $data_mediaID_yes);




        $media = $this->product_model->GetByRow('cms_media', $mediaid, 'id');

        $image_array1 = json_decode($media->images, TRUE);

        $image_array1 = $this->product_model->array_push_assoc($image_array1, 'media_id', $mediaid);

        $image_encode1 = json_encode($image_array1);
        $data_upd_img = array(
            'prod_file' => $image_encode1,
        );

        $this->db->where('id', $productid);
        $this->db->update('ec_products', $data_upd_img);
    }

    /*
     * Insertion of Special features 
     */

    function add_specialfeature() {


        /** Special features Picture file control */
        $banner_images_str = $this->input->post('final_images');
        $banner_images = explode(',', $banner_images_str);

        $image_array = array();
        $i = 0;
        foreach ($banner_images as $banner) {

            $seo_alt = $seo_title = $this->input->post('input_name');
            if ($this->input->post('seo_alt')[$i] != "") {

                $seo_alt = $this->input->post('seo_alt')[$i];
            } else {

                $seo_alt = $this->input->post('page');
            }
            if ($this->input->post('seo_title')[$i] != "") {

                $seo_title = $this->input->post('seo_title')[$i];
            } else {

                $seo_title = $this->input->post('page');
            }




            $image_array[] = array(
                'image' => $banner,
                'combo' => $this->input->post('combo'),
                'seo_alt' => $seo_alt,
                'seo_title' => $seo_title,
            );

            $image_encode = json_encode($image_array);

            $data_media = array(
                'type' => 'specialfeature',
                'type2' => 'product',
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
        /** EOF Special features  Picture file control */
        $icon_type = '';
        $icon_text = '';
        if ($this->input->post('icon_type') != 'icon_image') {
            $icon_type = $this->input->post('icon_type');

            if ($icon_type == 'icon_class') {
                $icon_text = $this->input->post('iconclass');
            } else if ($icon_type == 'icon_html') {
                $icon_text = $this->input->post('iconhtml');
            }
        } else {
            $icon_type = $this->input->post('icon_customlink');

            if ($icon_type == 'internal') {
                $icon_text = $this->input->post('iconimgint');
            } else if ($icon_type == 'external') {
                $icon_text = $this->input->post('iconimgext');
            }
        }
        $array_icon = array(
            'icon_type' => $icon_type,
            'icon_text' => $icon_text,
            'icon_main_type' => $icon_type);
        $array_icon_json = json_encode($array_icon, true);


        $data = array(
            'main_cat_type' => $this->input->post('main_cat_type'),
            'type' => $this->input->post('product_attr'),
            'fieldname' => $this->input->post('input_name'),
            'slug' => $this->input->post('slug'),
            'description' => $this->input->post('feature_description'),
            'image' => $image_encode1,
            'order_no' => $this->input->post('order_number'),
            'icon_type' => $this->input->post('icon_type'),
            'icon_data' => $array_icon_json,
            'short_description' => $this->input->post('short_description'),
            'active_status' => $this->input->post('active_status'),
            'trash_status' => 'no'
        );
        
//        if(!empty($_POST['product_cat'])){
          $data["relation_category"]=json_encode($this->input->post('product_cat'));
//        }
        
        
        
        
        
        $this->db->insert('ec_product_attributes', $data);

        $prod_cat_details = $this->product_model->GetByRow('ec_categorytypes', $this->input->post('product_attr'), 'id');

        if ($prod_cat_details->save_database == 'yes') {
            $this->common_model->createProdAttrOptionArray('ec_product_attributes', $prod_cat_details->id, 'edit');
        }
    }

    /*
     * End of Insertion of Special features 
     */



    /*
     * Select Special features  by Name  for unique handling
     */

    function select_by_specialfeature_slug() {
        $input_name = $this->input->post('slug');
        $this->db->where('slug', $input_name);
        $this->db->where('type', 'specialfeature');
        return $this->db->get('ec_product_attributes')->row();
    }

    /*
     *  End of Select Special features  by Name  for unique handling
     */

    /*
     * Select Special features  by Name for unique handling while editing 
     */

    function select_by_specialfeature_slug1() {
        $id = $this->uri->segment(3);
        $input_name = $this->input->post('slug');
        $this->db->where('slug', $input_name);
// $this->db->where('type', 'specialfeature');
        $this->db->where('id !=', $id);
        return $this->db->get('ec_product_attributes')->row();
    }

    /*
     *  End of Select Special features  by Name  for unique handling while editing 
     */


    /*
     * Count all Special features  list which
     * Return number of rows
     */

    function list_sort_specialfeature() {

        if (isset($_GET['name'])) {

            $search = $_GET['name'];

            $this->db->like('fieldname', $search);
        }

        if (isset($_GET['category'])) {

            $cat = $_GET['category'];

            $this->db->where('main_cat_type', $cat);
        }
        if (isset($_GET['subcategory'])) {

            $cattype = $_GET['subcategory'];

            $this->db->where('type', $cattype);
        }



        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('id', 'DESC');
    }

    function count_all_specialfeature() {

        $this->product_model->list_sort_specialfeature();

        $this->db->where('trash_status', 'no');
//        $this->db->where('type', 'specialfeature');
        $val = $this->db->get('ec_product_attributes');
        return $val->num_rows();
    }

    /*
     * End of Count all Special features 
     */


    /*
     * List all Special features  
     */

    function list_specialfeature($perpage, $rec_from) {

        $this->product_model->list_sort_specialfeature();

//        $this->db->where('type', 'specialfeature');
        $this->db->where('trash_status', 'no');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($perpage, $rec_from);
        return $this->db->get('ec_product_attributes')->result();
    }

    /*
     * End of List all Special features 
     */




    /*
     * Edit Special features 
     */

    function edit_specialfeature($id) {




        if ($this->input->post('icon_type') != 'icon_image') {
            $icon_type = $this->input->post('icon_type');
            if ($icon_type == 'icon_class') {
                $icon_text = $this->input->post('iconclass');
            } else if ($icon_type == 'icon_html') {
                $icon_text = $this->input->post('iconhtml');
            }
        } else {
            $icon_type = $this->input->post('icon_customlink');
            if ($icon_type == 'internal') {
                $icon_text = $this->input->post('iconimgint');
            } else if ($icon_type == 'external') {
                $icon_text = $this->input->post('iconimgext');
            }
        }
        $array_icon = array(
            'icon_type' => $icon_type,
            'icon_text' => $icon_text,
            'icon_main_type' => $icon_type);
        $array_icon_json = json_encode($array_icon, true);









        $data = array(
            'main_cat_type' => $this->input->post('main_cat_type'),
            'type' => $this->input->post('product_attr'),
            'fieldname' => $this->input->post('input_name'),
            'slug' => $this->input->post('slug'),
            'description' => $this->input->post('feature_description'),
            'order_no' => $this->input->post('order_number'),
            'icon_type' => $this->input->post('icon_type'),
            'icon_data' => $array_icon_json,
            'short_description' => $this->input->post('short_description'),
            'active_status' => $this->input->post('active_status'),
            'trash_status' => 'no',
        );
        $attr_detail = $this->GetByRow_notrash('ec_product_attributes', $id, 'id');

        $prod_cat_details1 = $this->product_model->GetByRow('ec_categorytypes', $attr_detail->type, 'id');


        if ($prod_cat_details1->save_database == 'yes') {
            $this->product_model->removeElementFind('ec_product_attributes', $prod_cat_details1->id);
        }



        /** Special features  Picture file control */
        $banner_images_str = $this->input->post('final_images');
        $banner_images = explode(',', $banner_images_str);

        $seo_title = $seo_alt = $this->input->post('input_name');
        if ($this->input->post('seo_alt') != "") {
            $seo_alt = $this->input->post('seo_alt');
        }
        if ($this->input->post('seo_title') != "") {
            $seo_title = $this->input->post('seo_title');
        }

        $mediaID = $this->input->post('mediaID');
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
                'type' => 'specialfeature',
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
                    'seo_title' => $seo_title,
                );
            }

            $image_encode1 = json_encode($image_array1);

            $data = $this->product_model->array_push_assoc($data, 'image', $image_encode1);
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


            $exist_image_detail = json_decode($attr_detail->image, TRUE);
            if (!empty($exist_image_detail)) {
                $image_array[] = array(
                    'image' => $exist_image_detail[0]['image'],
                    'combo' => $exist_image_detail[0]['combo'],
                    'media_id' => $exist_image_detail[0]['media_id'],
                    'seo_alt' => $seo_alt,
                    'seo_title' => $seo_title,
                );
                $image_encode = json_encode($image_array);
                $data = $this->product_model->array_push_assoc($data, 'image', $image_encode);
            }
        }
        /** EOF Special features  Picture file control */
        
        
//         if(!empty($_POST['product_cat'])){
          $data["relation_category"]=json_encode($this->input->post('product_cat'));
//        }
        
        
        
        
        $this->db->where('id', $id);
        $this->db->update('ec_product_attributes', $data);


        $prod_cat_details = $this->product_model->GetByRow('ec_categorytypes', $this->input->post('product_attr'), 'id');

        if ($prod_cat_details->save_database == 'yes') {

            $this->common_model->createProdAttrOptionArray('ec_product_attributes', $prod_cat_details->id, 'edit');
            $this->common_model->createProdAttrOptionArray('ec_product_attributes', $prod_cat_details1->id, 'edit');
        }
    }

    /*
     * End of Edit Special features 
     */


    /*
     * Count all Trash Special features list which
     * Return number of rows
     */

    function trash_count_all_specialfeature() {

        if ($this->uri->segment(3) != '0') {

            $sess_val = $this->uri->segment(3);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('fieldname', $s_a);
        }
//$this->db->where('type', 'specialfeature');
        $this->db->where('trash_status', 'yes');
        $val = $this->db->get('ec_product_attributes');
        return $val->num_rows();
    }

    /*
     * End of Count all Special features 
     */


    /*
     * List all Trash Special features 
     */

    function trash_list_specialfeature($perpage, $rec_from) {

        if ($this->uri->segment(3) != '0') {

            $sess_val = $this->uri->segment(3);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('fieldname', $s_a);
        }
//$this->db->where('type', 'specialfeature');
        $this->db->where('trash_status', 'yes');
        $this->db->order_by('date_deleted', 'DESC');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($perpage, $rec_from);
        return $this->db->get('ec_product_attributes')->result();
    }

    /*
     * End of List all Trash Special features 
     */

    /*
     * List all Special features without Paging
     */

    function get_all_product_features() {
//$this->db->where('type', 'specialfeature');
        $this->db->where('trash_status', 'no');
        $this->db->order_by('order_no', 'ASC');
        $this->db->order_by('fieldname', 'ASC');
        return $this->db->get('ec_product_attributes')->result();
    }

    /*
     * End of List all Special features without Paging
     */



    /*
     * 25-07-2017
     * Author:Sinto
     * Use: category list 
     */

    function showcategory_classi($ctype) {
		$this->arr_b = array();
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
                    'categoryidtree' => $rows_main->categoryidtree,
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
                    'categoryidtree' => $rows_sub->categoryidtree,
                    'ctype_name' => $rows_sub->ctype_name);
                $this->showsubs_classi($rows_sub->id, $ctype, $dashes);
            }
        }
    }

    /*
     * EOF category list 
     */

    function get_category($ctype) {

        $ftype = '';
        if (!empty($_GET['ftype'])) {
            $ftype = $_GET['ftype'];
        }

        $ctype_row = $this->product_model->GetByRow_notrash('ec_categorytypes', $ctype, 'id');

        $category_type_row = $this->product_model->GetByRow_notrash('ec_categorytypes', 'category', 'fixed_type');
        $category_id = $category_type_row->id;
        if ($ftype == 'shop') {
            $shop_category_type_row = $this->product_model->GetByRow_notrash('ec_categorytypes', 'shop_category', 'fixed_type');
            $category_id = $shop_category_type_row->id;
        }

        $brand_type_row = $this->product_model->GetByRow_notrash('ec_categorytypes', 'brand', 'fixed_type');

        if ($ctype_row->fixed_type == 'category' || $ctype_row->fixed_type == 'shop_category') {

            $this->db->where('ctype', $brand_type_row->id);
        } elseif ($ctype_row->fixed_type == 'brand') {
            $this->db->where('ctype', $category_id);
        }

        //        1 - product category, 40 - shop category, 2 - brand 
//        if ($ctype == 1 || $ctype == 40) {
//            $this->db->where('ctype', 2);
//        } elseif ($ctype == 2) {
//            $this->db->where('ctype', 1);
//        }

        $this->db->where('parent_id', '0');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('ec_category')->result();
    }

    function get_subcategory($category_id) {
        $this->db->where('parent_id', $category_id);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('ec_category')->result();
    }

    function check_subcategories($category_id) {
        $this->db->where('parent_id', $category_id);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('ec_category')->num_rows();
    }

    function Getattribtues() {
        $this->db->where('db_status', 'yes');
        $this->db->where('product', 'yes');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('id', 'ASC');
        return $this->db->get('cms_commoninputs')->result();
    }

    function GetattribtuesID($id) {
        $this->db->where('db_status', 'yes');
        $this->db->where('id', $id);
        $this->db->where('product', 'yes');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('id', 'ASC');
        return $this->db->get('cms_commoninputs')->row();
    }

    public function get_main_subcategories_tree($category_id, $current_level,
            $ctype, $idtree) {

        $data['category_id'] = $category_id;
        $data['current_level'] = $current_level;
        $data['ctype'] = $ctype;
        $data['idtree'] = $idtree;


        if ($current_level == 1) {
            $data['span_class'] = 'label label-info';
        } elseif ($current_level == 2) {
            $data['span_class'] = 'label label-warning';
        } elseif ($current_level == 3) {
            $data['span_class'] = 'label label-important';
        } elseif ($current_level == 4) {
            $data['span_class'] = 'label label-inverse';
        } elseif ($current_level == 5) {
            $data['span_class'] = 'label';
        } elseif ($current_level == 6) {
            $data['span_class'] = 'label label-info';
        } elseif ($current_level == 7) {
            $data['span_class'] = 'label label-warning';
        } elseif ($current_level == 8) {
            $data['span_class'] = 'label label-important';
        } else {
            $data['span_class'] = 'label label-inverse';
        }
        $data['level'] = $current_level + 1;
        $data['subcategories'] = $this->product_model->get_subcategory($category_id);
        $result = $this->load->view('product/prodcategory/subtree_prodcat.php', $data);
        echo $result;
    }

    /*
     * End of Class product_model
     */

    public function special_attributes() {
        $this->db->where('type', 'product_attributes');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('ec_categorytypes')->result();
    }

    public function get_all_product_wizards($conditional_array = NULL) {
        ini_set('max_execution_time', 0);
        if ($conditional_array !== NULL) {
            $this->db->where($conditional_array);
        }
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('ec_wizard')->result();
    }

    /*
     * 13-11-2017
     * Author:Sinto
     * Use: product dynamic wizards,forms,fields 
     */

    public function dynamic_product_wizard($id) {
        $prod_row = $this->product_model->GetByRow('ec_products', $id, 'id');
        $prod_category_id = $prod_row->parent_sub_id;
        $prod_category_row = $this->product_model->GetByRow('ec_category', $prod_category_id, 'id');
        $wizard_id = $prod_category_row->product_wizard_id;
        return $wizard_id;
    }

    public function first_product_wizard($wiz_id) {
        $wizard_row = $this->product_model->GetByRow('ec_wizard', $wiz_id, 'id');
        $product_wizards = json_decode($wizard_row->product_wizard, TRUE);
        $wizard_group = json_decode($wizard_row->wizard_group, TRUE);
        $uniq_wizard_id = '';
        if ($product_wizards != NULL) {
            foreach ($product_wizards as $prod_wizard) {
                $wizard_use_status = $this->product_model->findID_exist($wizard_group, 'wizard_item', $prod_wizard['order']);
                if ($wizard_use_status == 'yes') {
                    $uniq_wizard_id .= $prod_wizard['order'];
                    break;
                }
            }
        }
        return $uniq_wizard_id;
    }

    public function prod_form_attr($input_id, $productId) {
        $data['common_input'] = $this->product_model->GetByRow('cms_commoninputs', $input_id, 'id');
        $data['product'] = $this->product_model->GetByRow('ec_products', $productId, 'id');
        $input_type = $data['common_input']->field_format_type;
        if ($data['common_input']->name == "discount_column") {
            $this->load->view('product/attr_commoninput_select', $data);
        } else {
            switch ($input_type) {

                case "text": $this->load->view('product/common_inputs/attr_text', $data);
                    break;
                case "email": $this->load->view('product/common_inputs/attr_email', $data);
                    break;
                case "password": $this->load->view('product/common_inputs/attr_password', $data);
                    break;
                case "number": $this->load->view('product/common_inputs/attr_number', $data);
                    break;
                case "textarea": $this->load->view('product/common_inputs/attr_textarea', $data);
                    break;
                case "select": $this->load->view('product/common_inputs/attr_select', $data);
                    break;
                case "url": $this->load->view('product/common_inputs/attr_url', $data);
                    break;
                case "checkbox": $this->load->view('product/common_inputs/attr_checkbox', $data);
                    break;
                case "radio": $this->load->view('product/common_inputs/attr_radio', $data);
                    break;
                case "ckeditor": $this->load->view('product/common_inputs/attr_ckeditor', $data);
                    break;
            }
        }
    }

    public function showprod_attr_wizard($prod_attr) {
        $this->db->where('type', $prod_attr);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('ec_product_attributes')->result();
    }

    function update_wiz23($id) {
        if (isset($_POST['product_character']) || isset($_POST['final_images']) || isset($_POST['final_video']) || isset($_POST['final_images_b'])) {

            $this->product_model->editProducts2($id);
        }

        if (isset($_POST['display_level']) || isset($_POST['title']) || isset($_POST['description']) || isset($_POST['keywords'])) {

            $this->product_model->editProducts3($id);
        }
    }

    public function dynamic_wizards($id, $option_data) {


        $this->product_model->update_wiz23($id);

        
        $product_update_id = $id;
        if (isset($_POST['associate']) || isset($_POST['copy'])) {
            if (isset($_POST['associate'])) {
                $product_update_id = $_POST['associate'];
            }

            if (isset($_POST['copy'])) {
                $product_update_id = $_POST['copy'];
            }
        }
        $data = json_decode($this->input->post('final_value_set'), TRUE);
        if (!empty($data[0]['discounttype'])) {
            if ($data[0]['discounttype'] == 99) { // extended offer
                if ($data[0]['extended_offer_type'] == 100) { // auto
                    $data[0]['offer_after_live'] = $option_data->offer_after_live;
                    $data[0]['offer_after_out_of_stock'] = $option_data->offer_after_out_of_stock;
                }
            }
        }
        
        $data_array=$data[0];
        $make_product_associate=$this->input->post('make_product_associate');
        if(!empty($make_product_associate)){
            $data_array['product_character']="associate";
            $data_array['product_associate_id']=$make_product_associate;
        }
		
		if (empty($data[0]['discount_type'])) {
			$data_array['original_price']=$data_array['selling_price'];
		}
        
        
        $this->db->where('id', $product_update_id);
        $this->db->update('ec_products', $data_array);
        /*
         * hide diplay product common input
         */
        $product = $this->product_model->GetByRow('ec_products', $product_update_id, 'id');
        $hide_product_type_id = 4;
        if ($product->product_categorytype_id != $hide_product_type_id) {
			if (!empty($data[0]['discount_type'])) {
            $this->product_model->update_discount_value($data[0], $product_update_id); // discount
			}
        }
        /*
         * EOF hide diplay product common input
         */
        return $product_update_id;
    }

    /*
     * EOF product dynamic wizards,forms,fields 
     */

    function update_discount_value($data, $id) {
        $original_price = $data['original_price'];
        $discount_status = $data['discount_status'];
        $discount_value = $data['discount_value'];
        $selling_price = $data['selling_price'];
        $discount_type = $data['discount_type'];

        if ($discount_status == "no") {
            $discount_array = array(
                "discount_type" => "",
                "discount_value" => "",
                "discount_text_type" => "",
                "discount_percentage" => "",
                "discount_text" => "",
                "discount_amount" => "",
                "selling_price" => $original_price);
        } else if ($discount_status == "yes") {

            if (($original_price > $selling_price) && !empty($selling_price)) {
                $discount_type_row = $this->common_model->GetByRow("ec_product_attributes", $discount_type, 'id');
                if ($discount_type_row->fixed_status == "yes" && $discount_type_row->fixed_type == "percentage") {
                    $price_diff_in_amount = $original_price * ($discount_value / 100);
                    $price_diff_in_percentage = $discount_value;
                }
                if ($discount_type_row->fixed_status == "yes" && $discount_type_row->fixed_type == "amount") {
                    $price_diff_in_amount = $discount_value;
                    $price_diff_in_percentage = $discount_value / ($original_price / 100);
                }

                $discount_array = array(
                    "discount_percentage" => $price_diff_in_percentage,
                    "discount_amount" => $price_diff_in_amount,
                    "selling_price" => $selling_price);
            } else {
                $discount_array = array(
                    "discount_status" => 'no',
                    "discount_type" => "",
                    "discount_text" => "",
                    "discount_value" => "",
                    "discount_text_type" => "",
                    "discount_percentage" => "",
                    "discount_amount" => "",
                    "selling_price" => $original_price);
            }
        }
        $this->db->where('id', $id);
        $this->db->update('ec_products', $discount_array);
    }

    function arr_reverse($categryslugs) {

        $categryslugs = explode('+', $categryslugs);
        $categryslugs = array_filter($categryslugs);
//        $categryslugs = array_unique($categryslugs);
        $categryslugs = array_reverse($categryslugs);
        $categryslugs = implode('/', $categryslugs);
        return $categryslugs;
    }

    function changeProductCatSlug($oldslug, $newslug, $urltype, $parent_mainid,
            $id) {
//oldslug, new slug,url_type, main id, current id 
        if ($urltype != 'force_url') {
            $query2 = "UPDATE ec_category SET "
                    . "full_slug = REPLACE(full_slug, '" . $oldslug . "/','" . $newslug . "/')"
                    . "WHERE parent_main_id='" . $parent_mainid . "'";
            $this->db->query($query2);

            $query3 = "UPDATE ec_products SET "
                    . "full_slug = REPLACE(full_slug, '" . $oldslug . "/','" . $newslug . "/')"
                    . "WHERE parent_main_id='" . $parent_mainid . "'";
            $this->db->query($query3);

            $query4 = "UPDATE cms_routes SET "
                    . "left_side_full_url = REPLACE(left_side_full_url, '" . $oldslug . "/','" . $newslug . "/'),"
                    . "right_side_full_url = REPLACE(right_side_full_url, '" . $oldslug . "/','" . $newslug . "/')"
                    . "WHERE slug_type='product_category'";
            $this->db->query($query4);

            $query5 = "UPDATE cms_routes SET "
                    . "left_side_full_url = REPLACE(left_side_full_url, '" . $oldslug . "/','" . $newslug . "/'),"
                    . "right_side_full_url = REPLACE(right_side_full_url, '" . $oldslug . "/','" . $newslug . "/')"
                    . "WHERE slug_type='product_item'";
            $this->db->query($query5);
        }
    }

    /*     * For Data Merging* */

    function insert_from_product($data_c) {
//		}


//        return $pid;
    }

    function removeProductimg($id) {
        ini_set('max_execution_time', 0);
        $this->db->where('type', 'product_image');
        $this->db->where('type2', 'product');
        $this->db->where('prod_cat', $id);
        $this->db->delete('cms_media');
    }

    function show_jewel_cats() {

        $this->db->where('parent_id', 0);

        $rsMain = $this->db->get('tb_jewellery')->result();

        if (count($rsMain) >= 1) {

            foreach ($rsMain as $rows_main) {

                $this->arr2[] = array(
                    'name' => $rows_main->category,
                    'id' => $rows_main->id);

                $this->show_jewel_subs($rows_main->id);
            }

            return $this->arr2;
        }
    }

    function show_jewel_subs($cat_id, $dashes = '') {

        $dashes .= '__';

        $this->db->where('parent_id', $cat_id);

        $rsSub = $this->db->get('tb_jewellery')->result();

        if (count($rsSub) >= 1) {

            foreach ($rsSub as $rows_sub) {

                $this->arr2[] = array(
                    'name' => $dashes . $rows_sub->category,
                    'id' => $rows_sub->id);

                $this->show_jewel_subs($rows_sub->id, $dashes);
            }
        }
    }

    /*     * For Data Merging* */





    /*     * For User Merging* */

    function insert_user_data($data_c) {
        ini_set('max_execution_time', 0);
        $tb_user_row = $data_c['tb_user_row'];


        $data = array(
            'id' => $tb_user_row->id,
            'group_id' => $tb_user_row->group_id,
            'ip_address' => $tb_user_row->ip_address,
            'username' => $tb_user_row->username,
            'password' => $tb_user_row->password,
            'salt' => $tb_user_row->salt,
            'email' => $tb_user_row->email,
            'activation_code' => $tb_user_row->activation_code,
            'forgotten_password_code' => $tb_user_row->forgotten_password_code,
            'remember_code' => $tb_user_row->remember_code,
            'created_on' => $tb_user_row->created_on,
            'last_login' => $tb_user_row->last_login,
            'active' => $tb_user_row->active,
            'merge_type' => "old",
        );





        $cms_exist = $this->common_model->GetByRow_notrash('users', $tb_user_row->id, 'id');

        if ($cms_exist == NULL) {
            $this->db->insert('users', $data);
            $pid = $this->db->insert_id();
            return $pid;
        } else {
            $this->db->where('id', $tb_user_row->id);
            $this->db->update('users', $data);
            $pid = $this->db->insert_id();
            return $pid;
//dump('true');
        }
    }

    function insert_user_meta_data($data_c) {
        ini_set('max_execution_time', 0);
        $tb_user_row = $data_c['tb_user_row'];
        //$old_key = '-godland';
        $old_password = $this->encryption->decrypt($tb_user_row->passwords);
        //$key = 'gl-godland';
        $encrypted_string = $this->encryption->encrypt($old_password);
//        dump($encrypted_string);

        $data = array(
            'id' => $tb_user_row->id,
            'user_id' => $tb_user_row->user_id,
            'fb_user_id' => $tb_user_row->fb_user_id,
            'gplus_user_id' => $tb_user_row->gplus_user_id,
            'passwords' => $encrypted_string,
            'phone' => $tb_user_row->ur_phone,
            // 'title' =>  $tb_user_row->,
            'firstname' => $tb_user_row->s_firstname,
            'lastname' => $tb_user_row->s_lastname,
            //  'address' =>  $tb_user_row->,
// 'gender' =>  $tb_user_row->,
            'activation' => $tb_user_row->activation,
            'merge_type' => "old",
        );




        $cms_exist = $this->common_model->GetByRow_notrash('users', $tb_user_row->id, 'id');

        if ($cms_exist == NULL) {
            $this->db->insert('meta', $data);
            $pid = $this->db->insert_id();
            return $pid;
        } else {
            $this->db->where('id', $tb_user_row->id);
            $this->db->update('meta', $data);
            $pid = $this->db->insert_id();
            return $pid;
//dump('true');
        }



//        dump($data);
// die();
// $this->db->insert('meta', $data);
//$pid = $this->db->insert_id();
//  return $pid;
    }

    /*     * For User Merging* */
    /*     * For Order Data Merging* */

    function insert_ec_orders_data($data_c) {
        ini_set('max_execution_time', 0);
        $tb_user_row = $data_c['tb_user_row'];

        $tb_payment_array = $data_c['tb_payment'];

        $old_payment_method = '';
        $payment_method = '';
        $payment_method_string = '';
        $tb_payment_array_key = '';
        $old_payment_method = trim($tb_user_row->method);



        $tb_payment_array_key = array_search($old_payment_method, array_column($tb_payment_array, 'payment_type'));

        if (array_search($old_payment_method, array_column($tb_payment_array, 'payment_type')) !== FALSE) {

            $payment_method = $tb_payment_array[$tb_payment_array_key]['id'];
            $payment_method_string = $tb_payment_array[$tb_payment_array_key]['payment_type'];
        } else {
            $payment_method = '0';
            $payment_method_string = $old_payment_method;
        }

        $shipping_address = $tb_user_row->ship_address;
        $billing_address = $tb_user_row->bill_address;

        if ($shipping_address != '') {

            $splited_ships = explode('***', $shipping_address);

            if (isset($splited_ships[0])) {
                $ship_email = $splited_ships[0];
            } else {
                $ship_email = '';
            }

            if (isset($splited_ships[1])) {
                $ship_name = $splited_ships[1];
            } else {
                $ship_name = '';
            }

            if (isset($splited_ships[3])) {
                $ship_country = $splited_ships[3];
            } else {
                $ship_country = '';
            }


            if (isset($splited_ships[4])) {
                $ship_state = $splited_ships[4];
            } else {
                $ship_state = '';
            }

            if (isset($splited_ships[5])) {
                $ship_zipcode = $splited_ships[5];
            } else {
                $ship_zipcode = '';
            }


            if (isset($splited_ships[6])) {
                $ship_city_locality = $splited_ships[6];
            } else {
                $ship_city_locality = '';
            }

            if (isset($splited_ships[7])) {
                $ship_address = trim($splited_ships[7]);
            } else {
                $ship_address = '';
            }

            if (isset($splited_ships[8])) {
                $ship_phone = trim($splited_ships[8]);
            } else {
                $ship_phone = '';
            }

            if (isset($splited_ships[9])) {
                $ship_state_code = $splited_ships[9];
            } else {
                $ship_state_code = '';
            }
//            $ship_email = $splited_ships[0];
//            $ship_name = $splited_ships[1];
//            $ship_country = $splited_ships[3];
//            $ship_state = $splited_ships[4];
//            $ship_zipcode = $splited_ships[5];
//            $ship_city_locality = $splited_ships[6];
//            $ship_address = trim($splited_ships[7]);
//            $ship_phone = $splited_ships[8];
//            $ship_state_code = $splited_ships[9];


            if ($ship_city_locality != '') {
                $splited_ships_cities = explode(',', $ship_city_locality);

                if (isset($splited_ships_cities[0])) {
                    $ship_city = $splited_ships_cities[0];
                } else {
                    $ship_city = '';
                }
            } else {
                $ship_city = '';
            }



//            $ship_city = $splited_ships_cities[0];  
        } else {
            $ship_email = '';
            $ship_name = '';
            $ship_country = '';
            $ship_state = '';
            $ship_zipcode = '';
            $ship_city_locality = '';
            $ship_address = '';
            $ship_phone = '';
            $ship_state_code = '';
            $splited_ships_cities = '';
            $ship_city = '';
        }



        $shipping_address_json = array(
            "frm_title" => "",
            "frm_email" => $ship_email,
            "frm_first_name" => $ship_name,
            "frm_last_name" => "",
            "frm_phoneno" => $ship_phone,
            "frm_pincode" => $ship_zipcode,
            "frm_locality" => $ship_city_locality,
            "frm_address" => $ship_address,
            "frm_city" => $ship_city,
            "frm_state" => $ship_state,
            "frm_country" => $ship_country,
            "frm_landmark" => "",
            "frm_alt_phone" => "",
            "frm_delivery_type" => ""
        );


        $shipping_address = json_encode($shipping_address_json);




        if ($billing_address != '') {

            $splited_billing = explode('***', $billing_address);

            if (isset($splited_billing[0])) {
                $bill_email = $splited_billing[0];
            } else {
                $bill_email = '';
            }

            if (isset($splited_billing[1])) {
                $bill_name = $splited_billing[1];
            } else {
                $bill_name = '';
            }

            if (isset($splited_billing[3])) {
                $bill_country = $splited_billing[3];
            } else {
                $bill_country = '';
            }


            if (isset($splited_billing[4])) {
                $bill_state = $splited_billing[4];
            } else {
                $bill_state = '';
            }

            if (isset($splited_billing[5])) {
                $bill_zipcode = $splited_billing[5];
            } else {
                $bill_zipcode = '';
            }


            if (isset($splited_billing[6])) {
                $bill_city_locality = $splited_billing[6];
            } else {
                $bill_city_locality = '';
            }


            if (isset($splited_billing[7])) {
                $bill_address = trim($splited_billing[7]);
            } else {
                $bill_address = '';
            }

            if (isset($splited_billing[8])) {
                $bill_phone = $splited_billing[8];
            } else {
                $bill_phone = '';
            }

            if (isset($splited_billing[9])) {
                $bill_state_code = $splited_billing[9];
            } else {
                $bill_state_code = '';
            }




//            $bill_email = $splited_billing[0];
//            $bill_name = $splited_billing[1];
//            $bill_country = $splited_billing[3];
//            $bill_state = $splited_billing[4];
//            $bill_zipcode = $splited_billing[5];
//            $bill_city_locality = $splited_billing[6];
//            $bill_address = trim($splited_billing[7]);
//            $bill_phone = $splited_billing[8];
//            $bill_state_code = $splited_billing[9];
//            $splited_bill_cities = explode(',', $bill_city_locality);
//
//            $bill_city = $splited_bill_cities[0];

            if ($bill_city_locality != '') {
                $splited_bill_cities = explode(',', $bill_city_locality);

                if (isset($splited_bill_cities[0])) {
                    $bill_city = $splited_bill_cities[0];
                } else {
                    $bill_city = '';
                }
            } else {
                $bill_city = '';
            }
        } else {

            $bill_email = '';
            $bill_name = '';
            $bill_country = '';
            $bill_state = '';
            $bill_zipcode = '';
            $bill_city_locality = '';
            $bill_address = '';
            $bill_phone = '';
            $bill_state_code = '';

            $splited_bill_cities = '';

            $bill_city = '';
        }


        $billing_address_json = array(
            "frm_title" => "",
            "frm_email" => $bill_email,
            "frm_first_name" => $bill_name,
            "frm_last_name" => "",
            "frm_phoneno" => $bill_phone,
            "frm_pincode" => $bill_zipcode,
            "frm_locality" => $bill_city_locality,
            "frm_address" => $bill_address,
            "frm_city" => $bill_city,
            "frm_state" => $bill_state,
            "frm_country" => $bill_country,
            "frm_landmark" => "",
            "frm_alt_phone" => "",
            "frm_delivery_type" => ""
        );

        $billing_address = json_encode($billing_address_json);



        if ($tb_user_row->status != '') {
            $tb_user_status = $tb_user_row->status;
            switch ($tb_user_status) {
                case 'Delivered':

                    /*                     * Order initiated */
                    $timeline_first_order_status = $this->product_model->GetByRow('ec_cart_order_status', '1', 'id');
                    $place_status_text = array();
                    $status_id = $timeline_first_order_status->id;
                    $place_status_text[] = array(
                        "place_reached" => '',
                        "status_textstring" => $timeline_first_order_status->message_text,
                        "admin_text" => '',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    $payment_data[] = array(
                        "status_id" => $status_id,
                        "text" => $place_status_text,
                        "sms" => 'no',
                        "smstext" => '',
                        "mail" => 'no',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    /*                     * Payment Pending */
                    $timeline_first_order_status = $this->product_model->GetByRow('ec_cart_order_status', '2', 'id');
                    $place_status_text = array();
                    $status_id = $timeline_first_order_status->id;
                    $place_status_text[] = array(
                        "place_reached" => '',
                        "status_textstring" => $timeline_first_order_status->message_text,
                        "admin_text" => '',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    $payment_data[] = array(
                        "status_id" => $status_id,
                        "text" => $place_status_text,
                        "sms" => 'no',
                        "smstext" => '',
                        "mail" => 'no',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );


                    /*                     * Payment Confirmed */
                    $timeline_first_order_status = $this->product_model->GetByRow('ec_cart_order_status', '3', 'id');
                    $place_status_text = array();
                    $status_id = $timeline_first_order_status->id;
                    $place_status_text[] = array(
                        "place_reached" => '',
                        "status_textstring" => $timeline_first_order_status->message_text,
                        "admin_text" => '',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    $payment_data[] = array(
                        "status_id" => $status_id,
                        "text" => $place_status_text,
                        "sms" => 'no',
                        "smstext" => '',
                        "mail" => 'no',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    /*                     * Order Placed */
                    $timeline_first_order_status = $this->product_model->GetByRow('ec_cart_order_status', '7', 'id');
                    $place_status_text = array();
                    $status_id = $timeline_first_order_status->id;
                    $place_status_text[] = array(
                        "place_reached" => '',
                        "status_textstring" => $timeline_first_order_status->message_text,
                        "admin_text" => '',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    $payment_data[] = array(
                        "status_id" => $status_id,
                        "text" => $place_status_text,
                        "sms" => 'no',
                        "smstext" => '',
                        "mail" => 'no',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    /*                     * Order Processed */
                    $timeline_first_order_status = $this->product_model->GetByRow('ec_cart_order_status', '11', 'id');
                    $place_status_text = array();
                    $status_id = $timeline_first_order_status->id;
                    $place_status_text[] = array(
                        "place_reached" => '',
                        "status_textstring" => $timeline_first_order_status->message_text,
                        "admin_text" => '',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    $payment_data[] = array(
                        "status_id" => $status_id,
                        "text" => $place_status_text,
                        "sms" => 'no',
                        "smstext" => '',
                        "mail" => 'no',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    /*                     * Order Dispatched */
                    $timeline_first_order_status = $this->product_model->GetByRow('ec_cart_order_status', '12', 'id');
                    $place_status_text = array();
                    $status_id = $timeline_first_order_status->id;
                    $place_status_text[] = array(
                        "place_reached" => '',
                        "status_textstring" => $timeline_first_order_status->message_text,
                        "admin_text" => '',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    $payment_data[] = array(
                        "status_id" => $status_id,
                        "text" => $place_status_text,
                        "sms" => 'no',
                        "smstext" => '',
                        "mail" => 'no',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    /*                     * Order Delivered */
                    $timeline_first_order_status = $this->product_model->GetByRow('ec_cart_order_status', '13', 'id');
                    $place_status_text = array();
                    $status_id = $timeline_first_order_status->id;
                    $place_status_text[] = array(
                        "place_reached" => '',
                        "status_textstring" => $timeline_first_order_status->message_text,
                        "admin_text" => '',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    $payment_data[] = array(
                        "status_id" => $status_id,
                        "text" => $place_status_text,
                        "sms" => 'yes',
                        "smstext" => '',
                        "mail" => 'yes',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );


                    $payment_data_list = json_encode($payment_data);



                    break;
                case 'Failed':

                    /*                     * Order initiated */
                    $timeline_first_order_status = $this->product_model->GetByRow('ec_cart_order_status', '1', 'id');
                    $place_status_text = array();
                    $status_id = $timeline_first_order_status->id;
                    $place_status_text[] = array(
                        "place_reached" => '',
                        "status_textstring" => $timeline_first_order_status->message_text,
                        "admin_text" => '',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    $payment_data[] = array(
                        "status_id" => $status_id,
                        "text" => $place_status_text,
                        "sms" => 'no',
                        "smstext" => '',
                        "mail" => 'no',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    /*                     * Payment Pending */
                    $timeline_first_order_status = $this->product_model->GetByRow('ec_cart_order_status', '2', 'id');
                    $place_status_text = array();
                    $status_id = $timeline_first_order_status->id;
                    $place_status_text[] = array(
                        "place_reached" => '',
                        "status_textstring" => $timeline_first_order_status->message_text,
                        "admin_text" => '',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    $payment_data[] = array(
                        "status_id" => $status_id,
                        "text" => $place_status_text,
                        "sms" => 'no',
                        "smstext" => '',
                        "mail" => 'no',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );
                    /*                     * Payment Failed */
                    $timeline_first_order_status = $this->product_model->GetByRow('ec_cart_order_status', '4', 'id');
                    $place_status_text = array();
                    $status_id = $timeline_first_order_status->id;
                    $place_status_text[] = array(
                        "place_reached" => '',
                        "status_textstring" => $timeline_first_order_status->message_text,
                        "admin_text" => '',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    $payment_data[] = array(
                        "status_id" => $status_id,
                        "text" => $place_status_text,
                        "sms" => 'no',
                        "smstext" => '',
                        "mail" => 'no',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );
                    /** Order Failed */
                    $timeline_first_order_status = $this->product_model->GetByRow('ec_cart_order_status', '8', 'id');
                    $place_status_text = array();
                    $status_id = $timeline_first_order_status->id;
                    $place_status_text[] = array(
                        "place_reached" => '',
                        "status_textstring" => $timeline_first_order_status->message_text,
                        "admin_text" => '',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    $payment_data[] = array(
                        "status_id" => $status_id,
                        "text" => $place_status_text,
                        "sms" => 'no',
                        "smstext" => '',
                        "mail" => 'no',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );





                    $payment_data_list = json_encode($payment_data);




                    break;
                case 'Payment Pending':

                    /*                     * Order initiated */
                    $timeline_first_order_status = $this->product_model->GetByRow('ec_cart_order_status', '1', 'id');
                    $place_status_text = array();
                    $status_id = $timeline_first_order_status->id;
                    $place_status_text[] = array(
                        "place_reached" => '',
                        "status_textstring" => $timeline_first_order_status->message_text,
                        "admin_text" => '',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    $payment_data[] = array(
                        "status_id" => $status_id,
                        "text" => $place_status_text,
                        "sms" => 'no',
                        "smstext" => '',
                        "mail" => 'no',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    /*                     * Payment Pending */
                    $timeline_first_order_status = $this->product_model->GetByRow('ec_cart_order_status', '2', 'id');
                    $place_status_text = array();
                    $status_id = $timeline_first_order_status->id;
                    $place_status_text[] = array(
                        "place_reached" => '',
                        "status_textstring" => $timeline_first_order_status->message_text,
                        "admin_text" => '',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    $payment_data[] = array(
                        "status_id" => $status_id,
                        "text" => $place_status_text,
                        "sms" => 'no',
                        "smstext" => '',
                        "mail" => 'no',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );



                    $payment_data_list = json_encode($payment_data);


                    break;
                case 'Despatched':


                    /*                     * Order initiated */
                    $timeline_first_order_status = $this->product_model->GetByRow('ec_cart_order_status', '1', 'id');
                    $place_status_text = array();
                    $status_id = $timeline_first_order_status->id;
                    $place_status_text[] = array(
                        "place_reached" => '',
                        "status_textstring" => $timeline_first_order_status->message_text,
                        "admin_text" => '',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    $payment_data[] = array(
                        "status_id" => $status_id,
                        "text" => $place_status_text,
                        "sms" => 'no',
                        "smstext" => '',
                        "mail" => 'no',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    /*                     * Payment Pending */
                    $timeline_first_order_status = $this->product_model->GetByRow('ec_cart_order_status', '2', 'id');
                    $place_status_text = array();
                    $status_id = $timeline_first_order_status->id;
                    $place_status_text[] = array(
                        "place_reached" => '',
                        "status_textstring" => $timeline_first_order_status->message_text,
                        "admin_text" => '',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    $payment_data[] = array(
                        "status_id" => $status_id,
                        "text" => $place_status_text,
                        "sms" => 'no',
                        "smstext" => '',
                        "mail" => 'no',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );


                    /*                     * Payment Confirmed */
                    $timeline_first_order_status = $this->product_model->GetByRow('ec_cart_order_status', '3', 'id');
                    $place_status_text = array();
                    $status_id = $timeline_first_order_status->id;
                    $place_status_text[] = array(
                        "place_reached" => '',
                        "status_textstring" => $timeline_first_order_status->message_text,
                        "admin_text" => '',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    $payment_data[] = array(
                        "status_id" => $status_id,
                        "text" => $place_status_text,
                        "sms" => 'no',
                        "smstext" => '',
                        "mail" => 'no',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    /*                     * Order Placed */
                    $timeline_first_order_status = $this->product_model->GetByRow('ec_cart_order_status', '7', 'id');
                    $place_status_text = array();
                    $status_id = $timeline_first_order_status->id;
                    $place_status_text[] = array(
                        "place_reached" => '',
                        "status_textstring" => $timeline_first_order_status->message_text,
                        "admin_text" => '',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    $payment_data[] = array(
                        "status_id" => $status_id,
                        "text" => $place_status_text,
                        "sms" => 'no',
                        "smstext" => '',
                        "mail" => 'no',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    /*                     * Order Processed */
                    $timeline_first_order_status = $this->product_model->GetByRow('ec_cart_order_status', '11', 'id');
                    $place_status_text = array();
                    $status_id = $timeline_first_order_status->id;
                    $place_status_text[] = array(
                        "place_reached" => '',
                        "status_textstring" => $timeline_first_order_status->message_text,
                        "admin_text" => '',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    $payment_data[] = array(
                        "status_id" => $status_id,
                        "text" => $place_status_text,
                        "sms" => 'no',
                        "smstext" => '',
                        "mail" => 'no',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    /*                     * Order Dispatched */
                    $timeline_first_order_status = $this->product_model->GetByRow('ec_cart_order_status', '12', 'id');
                    $place_status_text = array();
                    $status_id = $timeline_first_order_status->id;
                    $place_status_text[] = array(
                        "place_reached" => '',
                        "status_textstring" => $timeline_first_order_status->message_text,
                        "admin_text" => '',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    $payment_data[] = array(
                        "status_id" => $status_id,
                        "text" => $place_status_text,
                        "sms" => 'no',
                        "smstext" => '',
                        "mail" => 'no',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );






                    $payment_data_list = json_encode($payment_data);

                    break;
                case 'Processed':

                    /*                     * Order initiated */
                    $timeline_first_order_status = $this->product_model->GetByRow('ec_cart_order_status', '1', 'id');
                    $place_status_text = array();
                    $status_id = $timeline_first_order_status->id;
                    $place_status_text[] = array(
                        "place_reached" => '',
                        "status_textstring" => $timeline_first_order_status->message_text,
                        "admin_text" => '',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    $payment_data[] = array(
                        "status_id" => $status_id,
                        "text" => $place_status_text,
                        "sms" => 'no',
                        "smstext" => '',
                        "mail" => 'no',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    /*                     * Payment Pending */
                    $timeline_first_order_status = $this->product_model->GetByRow('ec_cart_order_status', '2', 'id');
                    $place_status_text = array();
                    $status_id = $timeline_first_order_status->id;
                    $place_status_text[] = array(
                        "place_reached" => '',
                        "status_textstring" => $timeline_first_order_status->message_text,
                        "admin_text" => '',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    $payment_data[] = array(
                        "status_id" => $status_id,
                        "text" => $place_status_text,
                        "sms" => 'no',
                        "smstext" => '',
                        "mail" => 'no',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );


                    /*                     * Payment Confirmed */
                    $timeline_first_order_status = $this->product_model->GetByRow('ec_cart_order_status', '3', 'id');
                    $place_status_text = array();
                    $status_id = $timeline_first_order_status->id;
                    $place_status_text[] = array(
                        "place_reached" => '',
                        "status_textstring" => $timeline_first_order_status->message_text,
                        "admin_text" => '',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    $payment_data[] = array(
                        "status_id" => $status_id,
                        "text" => $place_status_text,
                        "sms" => 'no',
                        "smstext" => '',
                        "mail" => 'no',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    /*                     * Order Placed */
                    $timeline_first_order_status = $this->product_model->GetByRow('ec_cart_order_status', '7', 'id');

                    $status_id = $timeline_first_order_status->id;
                    $place_status_text = array(
                        "place_reached" => '',
                        "status_textstring" => $timeline_first_order_status->message_text,
                        "admin_text" => '',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    $payment_data[] = array(
                        "status_id" => $status_id,
                        "text" => $place_status_text,
                        "sms" => 'no',
                        "smstext" => '',
                        "mail" => 'no',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    /*                     * Order Processed */
                    $timeline_first_order_status = $this->product_model->GetByRow('ec_cart_order_status', '11', 'id');
                    $place_status_text = array();
                    $status_id = $timeline_first_order_status->id;
                    $place_status_text[] = array(
                        "place_reached" => '',
                        "status_textstring" => $timeline_first_order_status->message_text,
                        "admin_text" => '',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    $payment_data[] = array(
                        "status_id" => $status_id,
                        "text" => $place_status_text,
                        "sms" => 'no',
                        "smstext" => '',
                        "mail" => 'no',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    $payment_data_list = json_encode($payment_data);

                    break;
                case 'Shipping Pending':
                    /*                     * Order initiated */
                    $timeline_first_order_status = $this->product_model->GetByRow('ec_cart_order_status', '1', 'id');
                    $place_status_text = array();
                    $status_id = $timeline_first_order_status->id;
                    $place_status_text[] = array(
                        "place_reached" => '',
                        "status_textstring" => $timeline_first_order_status->message_text,
                        "admin_text" => '',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    $payment_data[] = array(
                        "status_id" => $status_id,
                        "text" => $place_status_text,
                        "sms" => 'no',
                        "smstext" => '',
                        "mail" => 'no',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    /*                     * Payment Pending */
                    $timeline_first_order_status = $this->product_model->GetByRow('ec_cart_order_status', '2', 'id');
                    $place_status_text = array();
                    $status_id = $timeline_first_order_status->id;
                    $place_status_text[] = array(
                        "place_reached" => '',
                        "status_textstring" => $timeline_first_order_status->message_text,
                        "admin_text" => '',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    $payment_data[] = array(
                        "status_id" => $status_id,
                        "text" => $place_status_text,
                        "sms" => 'no',
                        "smstext" => '',
                        "mail" => 'no',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );


                    /*                     * Payment Confirmed */
                    $timeline_first_order_status = $this->product_model->GetByRow('ec_cart_order_status', '3', 'id');
                    $place_status_text = array();
                    $status_id = $timeline_first_order_status->id;
                    $place_status_text[] = array(
                        "place_reached" => '',
                        "status_textstring" => $timeline_first_order_status->message_text,
                        "admin_text" => '',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    $payment_data[] = array(
                        "status_id" => $status_id,
                        "text" => $place_status_text,
                        "sms" => 'no',
                        "smstext" => '',
                        "mail" => 'no',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    /*                     * Order Placed */
                    $timeline_first_order_status = $this->product_model->GetByRow('ec_cart_order_status', '7', 'id');
                    $place_status_text = array();
                    $status_id = $timeline_first_order_status->id;
                    $place_status_text[] = array(
                        "place_reached" => '',
                        "status_textstring" => $timeline_first_order_status->message_text,
                        "admin_text" => '',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    $payment_data[] = array(
                        "status_id" => $status_id,
                        "text" => $place_status_text,
                        "sms" => 'no',
                        "smstext" => '',
                        "mail" => 'no',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    /*                     * Order Processed */
                    $timeline_first_order_status = $this->product_model->GetByRow('ec_cart_order_status', '11', 'id');
                    $place_status_text = array();
                    $status_id = $timeline_first_order_status->id;
                    $place_status_text[] = array(
                        "place_reached" => '',
                        "status_textstring" => $timeline_first_order_status->message_text,
                        "admin_text" => '',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    $payment_data[] = array(
                        "status_id" => $status_id,
                        "text" => $place_status_text,
                        "sms" => 'no',
                        "smstext" => '',
                        "mail" => 'no',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );


                    $payment_data_list = json_encode($payment_data);
                    break;
                default:
                    /*                     * Order initiated */
                    $timeline_first_order_status = $this->product_model->GetByRow('ec_cart_order_status', '1', 'id');
                    $place_status_text = array();
                    $status_id = $timeline_first_order_status->id;
                    $place_status_text[] = array(
                        "place_reached" => '',
                        "status_textstring" => $timeline_first_order_status->message_text,
                        "admin_text" => '',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    $payment_data[] = array(
                        "status_id" => $status_id,
                        "text" => $place_status_text,
                        "sms" => 'no',
                        "smstext" => '',
                        "mail" => 'no',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    /*                     * Payment Pending */
                    $timeline_first_order_status = $this->product_model->GetByRow('ec_cart_order_status', '2', 'id');
                    $place_status_text = array();
                    $status_id = $timeline_first_order_status->id;
                    $place_status_text[] = array(
                        "place_reached" => '',
                        "status_textstring" => $timeline_first_order_status->message_text,
                        "admin_text" => '',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );

                    $payment_data[] = array(
                        "status_id" => $status_id,
                        "text" => $place_status_text,
                        "sms" => 'no',
                        "smstext" => '',
                        "mail" => 'no',
                        "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
                    );
                    $payment_data_list = json_encode($payment_data);
                    break;
            }
        } else {
            /*             * Order initiated */
            $timeline_first_order_status = $this->product_model->GetByRow('ec_cart_order_status', '1', 'id');
            $place_status_text = array();
            $status_id = $timeline_first_order_status->id;
            $place_status_text[] = array(
                "place_reached" => '',
                "status_textstring" => $timeline_first_order_status->message_text,
                "admin_text" => '',
                "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
            );

            $payment_data[] = array(
                "status_id" => $status_id,
                "text" => $place_status_text,
                "sms" => 'no',
                "smstext" => '',
                "mail" => 'no',
                "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
            );

            /*             * Payment Pending */
            $timeline_first_order_status = $this->product_model->GetByRow('ec_cart_order_status', '2', 'id');
            $place_status_text = array();
            $status_id = $timeline_first_order_status->id;
            $place_status_text[] = array(
                "place_reached" => '',
                "status_textstring" => $timeline_first_order_status->message_text,
                "admin_text" => '',
                "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
            );

            $payment_data[] = array(
                "status_id" => $status_id,
                "text" => $place_status_text,
                "sms" => 'no',
                "smstext" => '',
                "mail" => 'no',
                "datetime" => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
            );
            $payment_data_list = json_encode($payment_data);
        }



        if ($tb_user_row->purchase_id != '') {
            $user_table_row = $this->GetByRow('users', $tb_user_row->purchase_id, 'username');
            if (!empty($user_table_row->id)) {

                $uid = $user_table_row->id;
            } else {

                $uid = '';
            }
        } else {

            $uid = '';
        }



        $data = array(
            'id' => $tb_user_row->id,
            'tid' => preg_replace('/[^0-9]/', '', $tb_user_row->TransactionID),
            'order_id' => $tb_user_row->order_id,
            'invoice_id' => $tb_user_row->invoice_id,
            'user_id' => $uid,
            'currency' => $tb_user_row->currency,
            'currency_code' => $tb_user_row->currency_code,
            'amount' => $tb_user_row->amount,
            'delivery_charge' => $tb_user_row->ship_amount,
            'billing_address' => $billing_address,
            'shipping_address' => $shipping_address,
            'purchase_date' => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
            'payment_method' => $payment_method,
            'payment_method_string' => $payment_method_string,
            'payment_response' => $tb_user_row->paymentresponse,
            'payment_gateway_data' => $tb_user_row->payment_stringdata,
            'payment_gateway_xml' => $tb_user_row->xml,
            'payment_status' => $status_id,
            'payment_data' => $payment_data_list,
            'giftwrap' => $tb_user_row->giftwrap,
            // 'giftwrap_data' =>  $tb_user_row->active,
            'source' => 'website',
            'discount' => $tb_user_row->discount,
            'discount_balance' => $tb_user_row->discount_balance,
            'coupon_discount' => $tb_user_row->coupon_discount,
            'trash_status' => "no",
            'active_status' => "a",
            'merge_type' => "old",
        );
//        dump($data);
//        die();

        $cms_exist = $this->common_model->GetByRow_notrash('ec_orders', $tb_user_row->id, 'id');

        if ($cms_exist == NULL) {
            $this->db->insert('ec_orders', $data);
            $this->db->insert_id();
        } else {
            $this->db->where('id', $tb_user_row->id);
            $this->db->update('ec_orders', $data);
        }


//        dump($data);
//        die();
//$this->db->insert('ec_orders', $data);
//$pid = $this->db->insert_id();
//return $pid;
    }

    function insert_ec_order_list_data($data_c) {
        ini_set('max_execution_time', 0);
        $tb_user_row = $data_c['tb_user_row'];
//        dump($tb_user_row->id);

        $user_table_r = $this->GetByRow('users', $tb_user_row->user_id, 'username');
        if (!empty($user_table_r)) {
            $user_table_row = $user_table_r;
            $user_table_row_id = $user_table_row->id;
        } else {
            $user_table_row = '';
            $user_table_row_id = '';
        }


        $product_row = $this->product_model->GetByRow('ec_products', $tb_user_row->product_id, 'id');
        if (!empty($product_row)) {
            $product_r = $product_row;
            $product_r_id = $product_r->id;
            $product_r_sku = $product_r->sku;
            $product_r_prod_code = $product_r->prod_code;
            $product_r_prod_name = $product_r->prod_name;
            $product_r_carat = $product_r->carat;
            $product_r_categoryidtree = $product_r->categoryidtree;
            $product_r_parent_sub_id = $product_r->parent_sub_id;
            $product_r_parent_main_id = $product_r->parent_main_id;
            $product_r_full_category_id_tree = $product_r->full_category_id_tree;
        } else {
            $product_r = '';
            $product_r_id = '';
            $product_r_sku = '';
            $product_r_prod_code = '';
            $product_r_prod_name = '';
            $product_r_carat = '';
            $product_r_categoryidtree = '';
            $product_r_parent_sub_id = '';
            $product_r_parent_main_id = '';
            $product_r_full_category_id_tree = '';
        }
//dump($product_r);
//die();
        $search_text = $product_r_id . " " . $product_r_sku . " " . $product_r_prod_code . " " . $product_r_prod_name;
        $goldrate_id = $product_r_carat;

        //{oldoption}
        //$options_data = $this->common_model->get_options();
        //{oldoption}

        $options_data = $this->common_model->get_options();

        $goldrate_array = json_decode($options_data->price_list, TRUE);
        $carat_key = array_search($goldrate_id, array_column($goldrate_array, 'carat'));

        if ($tb_user_row->carat != '') {
            $tb_user_row_carat_text = $tb_user_row->carat;
            switch ($tb_user_row_carat_text) {
                case '18':

                    $carat_text = '18k';

                    break;
                case '14':

                    $carat_text = '14k';

                    break;
                case '22':

                    $carat_text = '22k';

                    break;
                case '24':

                    $carat_text = '24k';

                    break;
                case '950':

                    $carat_text = 'PT (950)';

                    break;
                default:
                    $carat_text = '';
                    break;
            }
        } else {
            $carat_text = '';
        }

        $data_input_order = array(
            "existing_table" => $product_r,
            "option" => $options_data,
        );

        $CI = & get_instance();
        $CI->load->model('common_model');
//$CI->load->model('index_model');
        if ($product_r != '') {
            $attr_id_tree_plus_product_order_json_array = $CI->common_model->GetOrderProductInfoColumns($data_input_order);
            $attributes_value_id_tree = $attr_id_tree_plus_product_order_json_array['attributes_value_id_tree'];
            $product_order_full_info_json = json_encode($attr_id_tree_plus_product_order_json_array['product_order_full_info_json']);
            $product_full_info_json = json_encode($attr_id_tree_plus_product_order_json_array['product_full_info_json']);
        } else {

            $attr_id_tree_plus_product_order_json_array = '';
            $attributes_value_id_tree = '';
            $product_order_full_info_json = '';
        }

//  $ec_product_attributes_carat_row = $CI->common_model->GetByRow('ec_product_attributes', $product_r_carat, 'id');




        $data = array(
            'id' => $tb_user_row->id,
            'ec_orders_id' => $tb_user_row->pid,
            'order_id' => $tb_user_row->order_id,
            'invoice_id' => '',
            'purchase_date' => $tb_user_row->purchase_date . " " . $tb_user_row->p_time,
            'user_id' => $user_table_row_id,
            'product_id' => $tb_user_row->product_id,
            'product_price' => $tb_user_row->price,
            'sku_code' => $product_r_sku,
            'product_code' => $product_r_prod_code,
            'product_name' => $product_r_prod_name,
            'search_text' => $search_text,
            'order_qty' => $tb_user_row->qty,
            'goldrate_id' => $product_r_carat,
            'goldrate_carat_text' => $carat_text,
            'goldrate_value' => $tb_user_row->gold,
            'source' => $tb_user_row->source,
            'waybill' => $tb_user_row->waybill,
            'file' => $tb_user_row->file,
            'shipment' => $tb_user_row->shipment,
            'categoryidtree' => $product_r_categoryidtree,
            'subcategory_id' => $product_r_parent_sub_id,
            'maincategory_id' => $product_r_parent_main_id,
            'full_category_id_tree' => $product_r_full_category_id_tree,
            'attributes_value_id_tree' => $attributes_value_id_tree,
            'product_order_full_info_json' => $product_order_full_info_json,
            'product_full_info_json' => $product_full_info_json,
            'trash_status' => "no",
            'active_status' => "a",
            'merge_type' => "old",
        );


        $cms_exist = $this->common_model->GetByRow_notrash('ec_order_list', $tb_user_row->id, 'id');

        if ($cms_exist == NULL) {
            $this->db->insert('ec_order_list', $data);
            $this->db->insert_id();
        } else {
            $this->db->where('id', $tb_user_row->id);
            $this->db->update('ec_order_list', $data);
        }


//        dump($data);
//$this->db->insert('ec_order_list', $data);
//$pid = $this->db->insert_id();
//return $pid;
    }

    function GetByPurchaseResult_notrash($table, $order_column, $order_type, $id) {
        ini_set('max_execution_time', 0);
        $this->db->where('id', $id);
        $this->db->order_by($order_column, $order_type);
        return $result = $this->db->get($table)->result();
    }

    /*     * For Order Data Merging* */






    /* for user address merging */

    public function checkaddrExist($data) {

        ini_set('max_execution_time', 0);
        $ec_orders_adrr = $data['ec_orders_adrr'];
        $order_billing_address = $ec_orders_adrr->billing_address;
        $order_shipping_address = $ec_orders_adrr->shipping_address;
        $order_user_id = $ec_orders_adrr->user_id;

        $this->db->where_in('delivery_address', array(
            $order_billing_address,
            $order_shipping_address));
        $this->db->where('user_id', $order_user_id);
        $result = $this->db->get('ec_user_address');
        return $result->num_rows();
    }

    public function insertBillUserAddress($data) {
        ini_set('max_execution_time', 0);
        $ec_orders_adrr = $data['ec_orders_adrr'];
        $data_in = array(
            'user_id' => $ec_orders_adrr->user_id,
            'delivery_address' => $ec_orders_adrr->billing_address,
            'default_delivery_address_status' => 'no',
            'default_billing_address_status' => 'no',
            'trash_status' => "no",
            'active_status' => "a",
            'merge_type' => "old",
        );

        $this->db->insert('ec_user_address', $data_in);
//          die();
    }

    public function insertShipUserAddress($data) {
        ini_set('max_execution_time', 0);
        $ec_orders_adrr = $data['ec_orders_adrr'];
        $data_in = array(
            'user_id' => $ec_orders_adrr->user_id,
            'delivery_address' => $ec_orders_adrr->shipping_address,
            'default_delivery_address_status' => 'no',
            'default_billing_address_status' => 'no',
            'trash_status' => "no",
            'active_status' => "a",
            'merge_type' => "old",
        );

        $this->db->insert('ec_user_address', $data_in);
//         die();
    }

    public function group_user_adresses() {
        ini_set('max_execution_time', 0);
        $this->db->group_by('user_id');
        $result = $this->db->get('ec_user_address');
        return $result->result();
    }

    public function upUserAddress($ecaddr) {
        ini_set('max_execution_time', 0);
        $data_in = array(
            'default_delivery_address_status' => 'yes',
            'default_billing_address_status' => 'yes',
        );
        $this->db->where('id', $ecaddr->id);
        $this->db->update('ec_user_address', $data_in);
    }

    /* EOF for user address merging */

    public function productSlugUpdate($data) {
        ini_set('max_execution_time', 0);
        $products = $data['products'];
        $cat_details = $this->product_model->GetByRow('ec_category', $products->parent_sub_id, 'id');
        $get_val_a = $this->product_model->pass_tree_values($cat_details->id, $cat_details->id, 'product');
        $full_slug = $this->product_model->arr_reverse($cat_details->categoryslugtree) . '/' . $products->slug;


        $data_p = array(
            'url_key' => 'product_item_route',
            'slug_type' => 'seo_url',
            'full_slug' => $full_slug,
            'parent_main_name' => $get_val_a['cat_parent_name'],
            'parent_main_slug' => $get_val_a['cat_parent_route'],
            'parent_main_id' => $get_val_a['cat_parent_id'],
            'categoryidtree' => $get_val_a['category_ids'],
            'categorynametree' => $get_val_a['category_names'],
            'categoryslugtree' => $get_val_a['category_slugs'],
            'categoryfull' => $get_val_a['category_full']
        );

        $this->db->where('id', $products->id);
        $this->db->update('ec_products', $data_p);

        $route_chk_tble = 'ec_products';
        $route_type = 'product_item';
        $route_type1 = 'product_item_route';
        $this->route_model->update_route($products->id, $route_chk_tble, $route_type, $route_type1);
        $this->route_model->save_routes($route_type);
    }

    /*
     * Main category type functionality
     * 25-10-2018
     */

    function add_main_category_type() {
        $category_type_name = $this->input->post('category_type_name');
        $category_type_value = $this->input->post('category_type_value');
        $data = array(
            'category_type_name' => $category_type_name,
            'category_type_value' => $category_type_value,
            'type' => 'main_category_type',
            'trash_status' => 'no',
            'active_status' => 'a'
        );
        $this->db->insert('ec_categorytypes', $data);
    }

    function select_main_val() {
        $category_type_value = $this->input->post('category_type_value');
        $this->db->where('category_type_value', $category_type_value);
        $query = $this->db->get('ec_categorytypes');
        if ($query->num_rows() >= 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function select_main_val_edit() {
        $id = $this->uri->segment(3);
        $category_type_value = $this->input->post('category_type_value');
        $this->db->where('category_type_value', $category_type_value);
        $this->db->where('id !=', $id);
        return $this->db->get('ec_categorytypes')->row();
    }

    function count_main_category_type() {

        if ($this->uri->segment(3) != '0') {

            $sess_val = $this->uri->segment(3);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('category_type_name', $s_a);
        }
        $this->db->where('type', 'main_category_type');
        $this->db->where('trash_status', 'no');
        $val = $this->db->get('ec_categorytypes');
        return $val->num_rows();
    }

    function list_main_category_type($perpage, $rec_from) {

        if ($this->uri->segment(3) != '0') {

            $sess_val = $this->uri->segment(3);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('category_type_name', $s_a);
        }
        $this->db->where('type', 'main_category_type');
        $this->db->where('trash_status', 'no');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($perpage, $rec_from);
        return $this->db->get('ec_categorytypes')->result();
    }

    function edit_main_categorytype($id) {

        $category_type_name = $this->input->post('category_type_name');
        $category_type_value = $this->input->post('category_type_value');
        $data = array(
            'category_type_name' => $category_type_name,
            'category_type_value' => $category_type_value,
            'type' => 'main_category_type',
            'trash_status' => 'no',
            'active_status' => 'a'
        );

        $this->db->where('id', $id);
        $this->db->update('ec_categorytypes', $data);

        $this->product_model->update_ctypes_main_id($id, $category_type_value);
    }

    function update_ctypes_main_id($main_type_id, $category_type_value) {
        $data = array(
            'type' => $category_type_value,
        );
        $this->db->where('main_type_id', $main_type_id);
        $this->db->update('ec_categorytypes', $data);
    }

    function trash_count_all_main_category_type() {

        if ($this->uri->segment(3) != '0') {

            $sess_val = $this->uri->segment(3);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('category_type_name', $s_a);
        }
        $this->db->where('type', 'main_category_type');
        $this->db->where('trash_status', 'yes');
        $val = $this->db->get('ec_categorytypes');
        return $val->num_rows();
    }

    function trash_list_main_category_type($perpage, $rec_from) {

        if ($this->uri->segment(3) != '0') {

            $sess_val = $this->uri->segment(3);
            $s_a = str_replace("123", "&", $sess_val);

            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('category_type_name', $s_a);
        }
        $this->db->where('type', 'main_category_type');
        $this->db->where('trash_status', 'yes');
        $this->db->order_by('date_deleted', 'DESC');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($perpage, $rec_from);
        return $this->db->get('ec_categorytypes')->result();
    }

    function load_main_category_types() {
        $this->db->where('type', 'main_category_type');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('ec_categorytypes')->result();
    }

    function load_category_types() {

        $this->db->where('type !=', 'main_category_type');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('ec_categorytypes')->result();
    }

    function get_load_category_types() {

        $this->db->where('type', 'main_category_type');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('ec_categorytypes')->result();
    }
    function get_load_subcategory_types() {

        $this->db->where('type !=', 'main_category_type');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('ec_categorytypes')->result();
    }

    /*
     *  EOF Main category type functionality
     */

    function update_search_sort_wizard_to_categories($cat_id,
            $selected_wizard_id, $product_wizard_id) {

        $data_update = array(
            'product_sort_search_wizard_id' => $selected_wizard_id,
        );
        $this->db->where('customized_search_sort_wizard', 'no');
        $like_clause_string = " categoryidtree  LIKE '%+" . $cat_id . "+%' ";
        $this->db->where("(" . $like_clause_string . ")", NULL, FALSE);
        $this->db->update('ec_category', $data_update);
    }

    function update_product_detail_wizard_to_categories($cat_id,
            $product_detail_wizard_id) {

        $data_update = array(
            'product_detail_wizard_id' => $product_detail_wizard_id,
        );
        $this->db->where('customized_product_detail_wizard', 'no');
        $like_clause_string = " categoryidtree  LIKE '%+" . $cat_id . "+%' ";
        $this->db->where("(" . $like_clause_string . ")", NULL, FALSE);
        $this->db->update('ec_category', $data_update);
    }

    function update_product_wizard_to_categories($cat_id, $product_wizard_id) {

        $data_update = array(
            'product_wizard_id' => $product_wizard_id,
        );
        $this->db->where('customized_product_wizard', 'no');
        $like_clause_string = " categoryidtree  LIKE '%+" . $cat_id . "+%' ";
        $this->db->where("(" . $like_clause_string . ")", NULL, FALSE);
        $this->db->update('ec_category', $data_update);
    }

    function getCategorywiseProducts() {
        $category_id = $this->input->post('parentname');
        $this->db->select('id,discount');
        $this->db->from('ec_products');
        $like_clause_string = " categoryidtree  LIKE '%+" . $category_id . "+%' ";
        $this->db->where("(" . $like_clause_string . ")", NULL, FALSE);
        $this->db->where('trash_status', 'no');
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function category_discount() {
        ini_set('max_execution_time', 0);
        $discount = $this->input->post('discount');
        $discount = trim($discount);
        $product_list = $this->product_model->getCategorywiseProducts();
        if ($product_list != FALSE) {
            foreach ($product_list as $product) {
//                dump($product);
                $data_update = array(
                    'discount' => $discount,
                    'discounttype' => $this->input->post('discounttype'),
                    'discount_column' => $this->input->post('discount_column'),
                    'discountby' => $this->input->post('discountby'),
                    'discount_text' => $this->input->post('discount_text'),
                    'admin_common_remarks' => $this->input->post('admin_common_remarks'),
                );
                $this->db->where('id', $product->id);
                $this->db->update('ec_products', $data_update);

                $this->common_model->ProductCalculation($product->id);
            }
        }
    }

    function insert_ec_order_product_full_info_json_list_data($data_c) {
        ini_set('max_execution_time', 0);
        $tb_user_row = $data_c['tb_user_row'];

        $product_row = $this->product_model->GetByRow('ec_products', $tb_user_row->product_id, 'id');
        if (!empty($product_row)) {
            $product_r = $product_row;
        } else {


            $product_r = '';
        }

        $options_data = $this->common_model->option;

        $data_input_order = array(
            "existing_table" => $product_r,
            "option" => $options_data,
        );



        if ($product_r != '') {
            $attr_id_tree_plus_product_order_json_array = $this->common_model->GetOrderProductInfoColumns($data_input_order);
            $attributes_value_id_tree = $attr_id_tree_plus_product_order_json_array['attributes_value_id_tree'];
            $product_order_full_info_json = json_encode($attr_id_tree_plus_product_order_json_array['product_order_full_info_json']);
            $product_full_info_json = json_encode($attr_id_tree_plus_product_order_json_array['product_full_info_json']);
        } else {

            $attr_id_tree_plus_product_order_json_array = '';
            $attributes_value_id_tree = '';
            $product_order_full_info_json = '';
            $product_full_info_json = '';
        }


        $data = array(
            'id' => $tb_user_row->id,
            'product_order_full_info_json' => $product_order_full_info_json,
            'product_full_info_json' => $product_full_info_json,
        );


        $cms_exist = $this->common_model->GetByRow_notrash('ec_order_list', $tb_user_row->id, 'id');

        if ($cms_exist == NULL) {
            $this->db->insert('ec_order_list', $data);
            $this->db->insert_id();
        } else {
            $this->db->where('id', $tb_user_row->id);
            $this->db->update('ec_order_list', $data);
        }
    }

    /*
     * Bulk Delete Functions
     */

    function get_full_sorted_product($starray_session) {

        $this->product_model->list_product_sorting();

        $this->db->order_by('id', 'DESC');
        $all_products = $this->db->get('ec_products')->result_array();
        $all_products1 = array_column($all_products, 'id');

        $all_products2 = json_decode($starray_session, true);

        $result = array_values(array_intersect($all_products1, $all_products2));

        $check_count = count($result);
        return json_encode($result, true) . '*****' . $check_count;
    }

    function get_full_product() {

        $this->product_model->list_product_sorting();

        $this->db->order_by('id', 'DESC');
        $all_products = $this->db->get('ec_products')->result_array();
        $all_products1 = array_column($all_products, 'id');
        $check_count = count($all_products1);
        return json_encode($all_products1, true) . '*****' . $check_count;
    }

    function custom_check_id($check_type, $check_id, $all_ids) {
        $product_id = json_decode($all_ids, true);

        if ($check_type == 'remove') {

            if (($key = array_search($check_id, $product_id)) !== false) {
                unset($product_id[$key]);
            }
        } else if ($check_type == 'add') {
            if ($product_id == '') {
                $product_id = array(
                    $check_id);
            } else {
                if (!in_array($check_id, $product_id)) {
                    array_push($product_id, $check_id);
                }
            }
        }
        $result = array_values($product_id);

        $check_count = count($result);

        return json_encode($result, true) . '*****' . $check_count;
    }

    function trash_product($id) {
        $this->product_model->TrashById('ec_products', $id, 'id');
        $route_type = 'product_item';
        $action_type = 'trash';
        $quick_link_type = 'product';
        $this->common_model->quick_link_delete($id, $quick_link_type, $action_type);
        $this->route_model->routeTrashById('cms_routes', $id, 'slug_ref_id', $route_type);
        $this->route_model->save_routes($route_type);
    }

    function product_deactivate_activate($prod_id, $delete_opr) {
        $product_details = $this->product_model->GetByRow('ec_products', $prod_id, 'id');


        if ($delete_opr == 'activate') {
            $availability = 'in_stock';
            $active_status = 'a';
        } else if ($delete_opr == 'deactivate') {
            $availability = 'out_of_stock';
            $active_status = 'd';
        }


        $data = array(
            'availability' => $availability,
            'active_status' => $active_status,
        );

        $this->db->where('id', $prod_id);
        $this->db->update('ec_products', $data);
    }

    /*
     * EOF Bulk Delete Functions
     */

    function get_array_by_name($arr_name) {
        $out_array = array();
        switch ($arr_name) {
            case 'associative_status':
                $out_array = array(
                    'No' => 'normal',
                    'Yes' => 'associate');
                break;
            default:
                break;
        }
        return $out_array;
    }

    function get_all_main_category_by_type($fixed_type) {

        $category_type_row = $this->product_model->GetByRow_notrash('ec_categorytypes', $fixed_type, 'fixed_type');

        $this->db->where('parent_id', '0');
        $this->db->where('ctype', $category_type_row->id); // category type
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('ec_category')->result();
    }

    function update_category_page_key($id) {

        $category_details = $this->product_model->GetByRow('ec_category', $id, 'id');

//        if ($category_details->make_as_page == 'yes') {

        $this->db->order_by('id', 'DESC');
        $this->db->where('special_page_type', 'connection_page');
        $this->db->where('product_category_id', $category_details->id);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $connection_page = $this->db->get('cms_pages')->row();

//

        $data = array(
            'option_url_key' => $connection_page->option_url_key,
            'option_url_key2' => $category_details->option_url_key,
        );
//            dump($data);
        $this->db->where('id', $category_details->id);
        $this->db->update('ec_category', $data);
//            dump($this->db->last_query()); die();
//
//        }
    }

    function custom_updation($id, $col_value, $type) {
        if ($type == 'inventory') {
            $custom_column = 'custom_inventory_status';
            $column = 'inventory_status';
            $column_val = $col_value;
        } else if ($type == 'qty_zero_action') {
            $custom_column = 'custom_qty_zero_action';
            $column = 'qty_zero_action';
            $column_val = $col_value;
        } elseif ($type == 'product_detail') {
            $custom_column = 'custom_product_detail_status';
            $column = 'product_detail_page';
            $column_val = $col_value;
        } elseif ($type == 'product_list_header') {
            $custom_column = 'custom_product_list_header_footer_status';
            $column = 'product_list_header_footer_page';
            $column_val = $col_value;
        }

        $sub_category_res = '';
        if ($type != 'product_list_header') {
            $conditional_array = array(
                $custom_column => 'no',
                'parent_id' => $id,
            );
            $sub_category_res = $this->common_model->GetByReturnTypeOrderType('ec_category', 'id', 'ASC', $conditional_array, $returntype = 'result');
        }


        $data_other = array(
            $column => $column_val);

        $this->db->where($custom_column, 'no');
        $this->db->where('parent_id', $id);
        $this->db->update('ec_category', $data_other);

        if ($type != 'product_list_header') {
            $this->db->where($custom_column, 'no');
            $this->db->where('parent_sub_id', $id);
            $this->db->update('ec_products', $data_other);


            if (!empty($sub_category_res)) {
                foreach ($sub_category_res as $sub_cat_row) {

                    $this->db->where($custom_column, 'no');
                    $this->db->where('parent_sub_id', $sub_cat_row->id);
                    $this->db->update('ec_products', $data_other);
                }
            }
        }
    }

    function resize_prod_img() {

        ini_set('max_execution_time', 0);

//        $empty_data1 = array(63, 64);
//        $this->db->where_in('id', $empty_data1);
//        $ec_product_list = $this->db->get('ec_products')->result();

        $ec_product_list = $this->product_model->GetByResult_notrash('ec_products', 'id', 'ASC');


        if (!empty($ec_product_list)) {
            foreach ($ec_product_list as $prod) {



                $banner_images = $this->product_model->list_product_gallery($prod->id);

                if (!empty($banner_images)) {

                    foreach ($banner_images as $banner) {

                        $image_arr = json_decode($banner->images, TRUE);
                        if (!empty($image_arr['image'])) {

                            /** To be changed* */
                            $config = array();
                            // create resized image
                            $config['image_library'] = 'GD2';
                            $config['source_image'] = 'media_library/' . $image_arr['image'];
                            $config['new_image'] = 'media_library/original_' . $image_arr['image'];
                            $config['create_thumb'] = false;
                            $config['maintain_ratio'] = false;
                            $config['width'] = 340;
                            $config['height'] = 340;
                            $this->load->library('image_lib', $config);
                            $this->image_lib->initialize($config);
                            $this->image_lib->resize();


                            $config = array();
                            // create resized image
                            $config['image_library'] = 'GD2';
                            $config['source_image'] = 'media_library/' . $image_arr['image'];
                            $config['new_image'] = 'media_library/large_' . $image_arr['image'];
                            $config['create_thumb'] = false;
                            $config['maintain_ratio'] = false;
                            $config['width'] = 550;
                            $config['height'] = 550;
                            $this->load->library('image_lib', $config);
                            $this->image_lib->initialize($config);
                            $this->image_lib->resize();



                            $config = array();
                            // create resized image
                            $config['image_library'] = 'GD2';
                            $config['source_image'] = 'media_library/' . $image_arr['image'];
                            $config['new_image'] = 'media_library/medium_' . $image_arr['image'];
                            $config['create_thumb'] = false;
                            $config['maintain_ratio'] = false;
                            $config['width'] = 195;
                            $config['height'] = 195;
                            $this->load->library('image_lib', $config);
                            $this->image_lib->initialize($config);
                            $this->image_lib->resize();


                            $config = array();
                            // create resized image
                            $config['image_library'] = 'GD2';
                            $config['source_image'] = 'media_library/' . $image_arr['image'];
                            $config['new_image'] = 'media_library/thumb_' . $image_arr['image'];
                            $config['create_thumb'] = false;
                            $config['maintain_ratio'] = false;
                            $config['width'] = 60;
                            $config['height'] = 60;
                            $this->load->library('image_lib', $config);
                            $this->image_lib->initialize($config);
                            $this->image_lib->resize();


                            $config = array();
                            // create resized image
                            $config['image_library'] = 'GD2';
                            $config['source_image'] = 'media_library/' . $image_arr['image'];
                            $config['new_image'] = 'media_library/size1_' . $image_arr['image'];
                            $config['create_thumb'] = false;
                            $config['maintain_ratio'] = false;
                            $config['width'] = 210;
                            $config['height'] = 210;
                            $this->load->library('image_lib', $config);
                            $this->image_lib->initialize($config);
                            $this->image_lib->resize();
                        }
                    }
                }
            }
        }
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

    function getlocation($parent_location) {
        $this->db->where('parent_id', $parent_location);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('cms_locations')->result();
    }

    function product_combo_content($id) {
        $item_values = $this->input->post('item_values');
        $cat_ids = $this->input->post('cat_ids');
        $item_ids = $this->input->post('item_ids');
        if (!empty($item_values)) {

            foreach ($item_values as $key => $item_value) {

                if (!empty($item_value)) {

                    $content_title = array();
                    $content_title[0]['left_val'] = 1187;
                    $content_title[0]['right_val'] = $item_value;
                    $content_title = json_encode($content_title);
                    $content_title = json_encode($content_title);


                    $data = array(
                        'title' => $item_value,
                        "content_title" => $content_title,
                        "prod_cat" => $cat_ids[$key],
                        "cms_type" => 49,
                        "product_type1" => 3,
                        "product_type2" => 26,
                        "connection_data" => '+' . $id . '+',
                        "trash_status" => "no",
                        "active_status" => "a",
                        "type" => "content_management",
                        "type2" => "content",
                        "selecting_type" => "single",
                        "category_tree" => '+' . $cat_ids[$key] . '+',
                    );
                    if (empty($item_ids[$key])) {
                        $this->db->insert('cms_media', $data);
                    } else {
                        $this->db->where('id', $item_ids[$key]);
                        $this->db->update('cms_media', $data);
                    }
                }
            }
        }
    }

    function product_nutri_content($id) {
        $item_values = $this->input->post('item_values');
        $item_details = $this->input->post('item_detail');
        $cat_ids = $this->input->post('cat_ids');
        $item_ids = $this->input->post('item_ids');
        if (!empty($item_values)) {
            foreach ($item_values as $key => $item_value) {
                if (!empty($item_value)) {

                    $content_title = array();
                    $content_title[0]['left_val'] = 1187;
                    $content_title[0]['right_val'] = $item_value;

                    $content_title = json_encode($content_title);


                    $data = array(
                        'title' => $item_value,
                        "prod_cat" => $cat_ids[$key],
                        "content_title" => $content_title,
                        "brief_details" => $item_details[$key],
                        "cms_type" => 49,
                        "product_type1" => 3,
                        "product_type2" => 26,
                        "connection_data" => '+' . $id . '+',
                        "trash_status" => "no",
                        "active_status" => "a",
                        "type" => "content_management",
                        "type2" => "content",
                        "selecting_type" => "single",
                        "category_tree" => '+' . $cat_ids[$key] . '+',
                    );
                    if (empty($item_ids[$key])) {
                        $this->db->insert('cms_media', $data);
                    } else {
                        $this->db->where('id', $item_ids[$key]);
                        $this->db->update('cms_media', $data);
                    }
                }
            }
        }
    }

    function update_category_pageseo($id) {
        $page_title = $this->input->post('page_title');
        $seo_description = $this->input->post('seo_description');
        $seo_keywords = $this->input->post('seo_keywords');

        $data = array(
            "title" => $page_title,
            "description" => $seo_description,
            "keywords" => $seo_keywords);
		
		$this->db->where('special_page_type', 'connection_page');	
		$this->db->where('special_page_type2', 'product_category');	
        $this->db->where('product_category_id', $id);
        $this->db->update('cms_pages', $data);
    }

function get_product_category_display_category_types()
{
       	$this->db->where('show_product_category_status', 'yes');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('id', 'DESC');
        return $this->db->get('ec_categorytypes')->result();	
}

function checkChildCatExists($id){
    $this->db->where('parent_id', $id);
    $this->db->where('ctype', 1);
    $this->db->where('trash_status', 'no');
    $this->db->where('active_status', 'a');
    
    $val = $this->db->get('ec_category')->num_rows();
    return $val;
    
}
    function addBulkProductImages($id){
        $loop_array = array();
        
        for($i=0;$i<14;$i++){
            $seo_alt = 'andzdesign';
            $seo_title = 'andzdesign';
            $banner = 'no_image.png';
            $default_img = 'no';
            
            if($i == 0){
                $default_img = 'yes';
                
                $image_array = array(
                        'image' => $banner,
                        'combo' => 7,
                        'seo_alt' => $seo_alt,
                        'seo_title' => $seo_title,
                    );
                $image_encode = json_encode($image_array);
                
                $data_media = array(
                        'type' => 'product_image',
                        'type2' => 'product',
                        'type_trash' => 'no',
                        'images' => $image_encode,
                        'prod_cat' => $id,
                        'default_img' => $default_img,
                        'title' => 'Listing Page Image',
                        'show_image_status' => 'no',
                        'order' => $i,
                        'image_width' => 324,
                        'image_height' => 315
                    );
            }
            
            if($i == 1){
                $image_array = array(
                        'image' => $banner,
                        'combo' => 41,
                        'seo_alt' => $seo_alt,
                        'seo_title' => $seo_title,
                    );
                
                $image_encode = json_encode($image_array);
                
                $data_media = array(
                        'type' => 'product_image',
                        'type2' => 'product',
                        'type_trash' => 'no',
                        'images' => $image_encode,
                        'prod_cat' => $id,
                        'default_img' => $default_img,
                        'title' => 'Detail Page Image-1 Banner',
                        'show_image_status' => 'no',
                        'order' => $i,
                        'image_width' => 1366,
                        'image_height' => 399
                    );
            }
            
            if($i == 2){
                $image_array = array(
                        'image' => $banner,
                        'combo' => 42,
                        'seo_alt' => $seo_alt,
                        'seo_title' => $seo_title,
                    );
                
                $image_encode = json_encode($image_array);
                
                $data_media = array(
                        'type' => 'product_image',
                        'type2' => 'product',
                        'type_trash' => 'no',
                        'images' => $image_encode,
                        'prod_cat' => $id,
                        'default_img' => $default_img,
                        'title' => 'Detail Page Image-2',
                        'show_image_status' => 'no',
                        'order' => $i,
                        'image_width' => 255,
                        'image_height' => 398
                    );
            }
            
            if($i == 3){
                $image_array = array(
                        'image' => $banner,
                        'combo' => 43,
                        'seo_alt' => $seo_alt,
                        'seo_title' => $seo_title,
                    );
                
                $image_encode = json_encode($image_array);
                
                $data_media = array(
                        'type' => 'product_image',
                        'type2' => 'product',
                        'type_trash' => 'no',
                        'images' => $image_encode,
                        'prod_cat' => $id,
                        'default_img' => $default_img,
                        'title' => 'Detail Page Image-3',
                        'show_image_status' => 'no',
                        'order' => $i,
                        'image_width' => 348,
                        'image_height' => 398
                    );
            }
            
            if($i == 4){
                $image_array = array(
                        'image' => $banner,
                        'combo' => 44,
                        'seo_alt' => $seo_alt,
                        'seo_title' => $seo_title,
                    );
                
                $image_encode = json_encode($image_array);
                
                $data_media = array(
                        'type' => 'product_image',
                        'type2' => 'product',
                        'type_trash' => 'no',
                        'images' => $image_encode,
                        'prod_cat' => $id,
                        'default_img' => $default_img,
                        'title' => 'Detail Page Image-4',
                        'show_image_status' => 'no',
                        'order' => $i,
                        'image_width' => 441,
                        'image_height' => 398
                    );
            }
            
            if($i == 5){
                $image_array = array(
                        'image' => $banner,
                        'combo' => 45,
                        'seo_alt' => $seo_alt,
                        'seo_title' => $seo_title,
                    );
                
                $image_encode = json_encode($image_array);
                
                $data_media = array(
                        'type' => 'product_image',
                        'type2' => 'product',
                        'type_trash' => 'no',
                        'images' => $image_encode,
                        'prod_cat' => $id,
                        'default_img' => $default_img,
                        'title' => 'Detail Page Image-5',
                        'show_image_status' => 'no',
                        'order' => $i,
                        'image_width' => 534,
                        'image_height' => 398
                    );
            }
            
            if($i == 6){
                $image_array = array(
                        'image' => $banner,
                        'combo' => 45,
                        'seo_alt' => $seo_alt,
                        'seo_title' => $seo_title,
                    );
                
                $image_encode = json_encode($image_array);
                
                $data_media = array(
                        'type' => 'product_image',
                        'type2' => 'product',
                        'type_trash' => 'no',
                        'images' => $image_encode,
                        'prod_cat' => $id,
                        'default_img' => $default_img,
                        'title' => 'Detail Page Image-6',
                        'show_image_status' => 'no',
                        'order' => $i,
                        'image_width' => 534,
                        'image_height' => 398
                    );
            }
            
            if($i == 7){
                $image_array = array(
                        'image' => $banner,
                        'combo' => 46,
                        'seo_alt' => $seo_alt,
                        'seo_title' => $seo_title,
                    );
                
                $image_encode = json_encode($image_array);
                
                $data_media = array(
                        'type' => 'product_image',
                        'type2' => 'product',
                        'type_trash' => 'no',
                        'images' => $image_encode,
                        'prod_cat' => $id,
                        'default_img' => $default_img,
                        'title' => 'Detail Page Image-7',
                        'show_image_status' => 'no',
                        'order' => $i,
                        'image_width' => 319,
                        'image_height' => 198
                    );
            }
            
            if($i == 8){
                $image_array = array(
                        'image' => $banner,
                        'combo' => 46,
                        'seo_alt' => $seo_alt,
                        'seo_title' => $seo_title,
                    );
                
                $image_encode = json_encode($image_array);
                
                $data_media = array(
                        'type' => 'product_image',
                        'type2' => 'product',
                        'type_trash' => 'no',
                        'images' => $image_encode,
                        'prod_cat' => $id,
                        'default_img' => $default_img,
                        'title' => 'Detail Page Image-8',
                        'show_image_status' => 'no',
                        'order' => $i,
                        'image_width' => 319,
                        'image_height' => 198
                    );
            }
            
            if($i == 9){
                $image_array = array(
                        'image' => $banner,
                        'combo' => 47,
                        'seo_alt' => $seo_alt,
                        'seo_title' => $seo_title,
                    );
                
                $image_encode = json_encode($image_array);
                
                $data_media = array(
                        'type' => 'product_image',
                        'type2' => 'product',
                        'type_trash' => 'no',
                        'images' => $image_encode,
                        'prod_cat' => $id,
                        'default_img' => $default_img,
                        'title' => 'Detail Page Image-9',
                        'show_image_status' => 'no',
                        'order' => $i,
                        'image_width' => 900,
                        'image_height' => 414
                    );
            }
            
            if($i == 10){
                $image_array = array(
                        'image' => $banner,
                        'combo' => 48,
                        'seo_alt' => $seo_alt,
                        'seo_title' => $seo_title,
                    );
                
                $image_encode = json_encode($image_array);
                
                $data_media = array(
                        'type' => 'product_image',
                        'type2' => 'product',
                        'type_trash' => 'no',
                        'images' => $image_encode,
                        'prod_cat' => $id,
                        'default_img' => $default_img,
                        'title' => 'Detail Page Image-10',
                        'show_image_status' => 'no',
                        'order' => $i,
                        'image_width' => 1117,
                        'image_height' => 530
                    );
            }
            
            if($i == 11){
                $image_array = array(
                        'image' => $banner,
                        'combo' => 48,
                        'seo_alt' => $seo_alt,
                        'seo_title' => $seo_title,
                    );
                
                $image_encode = json_encode($image_array);
                
                $data_media = array(
                        'type' => 'product_image',
                        'type2' => 'product',
                        'type_trash' => 'no',
                        'images' => $image_encode,
                        'prod_cat' => $id,
                        'default_img' => $default_img,
                        'title' => 'Detail Page Image-11',
                        'show_image_status' => 'no',
                        'order' => $i,
                        'image_width' => 1117,
                        'image_height' => 530
                    );
            }
            
            if($i == 12){
                $image_array = array(
                        'image' => $banner,
                        'combo' => 49,
                        'seo_alt' => $seo_alt,
                        'seo_title' => $seo_title,
                    );
                
                $image_encode = json_encode($image_array);
                
                $data_media = array(
                        'type' => 'product_image',
                        'type2' => 'product',
                        'type_trash' => 'no',
                        'images' => $image_encode,
                        'prod_cat' => $id,
                        'default_img' => $default_img,
                        'title' => 'Detail Page Image-12',
                        'show_image_status' => 'no',
                        'order' => $i,
                        'image_width' => 534,
                        'image_height' => 398
                    );
            }
            
            if($i == 13){
                $image_array = array(
                        'image' => $banner,
                        'combo' => 49,
                        'seo_alt' => $seo_alt,
                        'seo_title' => $seo_title,
                    );
                
                $image_encode = json_encode($image_array);
                
                $data_media = array(
                        'type' => 'product_image',
                        'type2' => 'product',
                        'type_trash' => 'no',
                        'images' => $image_encode,
                        'prod_cat' => $id,
                        'default_img' => $default_img,
                        'title' => 'Detail Page Image-13',
                        'show_image_status' => 'no',
                        'order' => $i,
                        'image_width' => 534,
                        'image_height' => 398
                    );
            }
            
            $this->db->insert('cms_media', $data_media);
            $bannerID = $this->db->insert_id();
            
            if ($i == 0) {
                $image_array1 = array(
                    'image' => $banner,
                    'combo' => 7,
                    'media_id' => $bannerID,
                    'seo_alt' => $seo_alt,
                    'seo_title' => $seo_title,
                );
                $image_encode1 = json_encode($image_array1);
                $data = array(
                    'prod_file' => $image_encode1,
                );

                $this->db->where('id', $id);
                $this->db->update('ec_products', $data);
            }
        }
    }
    
    function addService(){
        $service_name = trim($this->input->post('service_name'));
        
       /*  $original_price = trim($this->input->post('price'));
       
        if(!is_numeric($original_price)){
            $original_price = 0;
        } */
        
        $data = array(
            'type' => 'service',           
            'name' => $service_name,
            'short_description' => $this->input->post('short_description'),
            'part_number' => $this->input->post('part_number'),
            'order_no' => $this->input->post('order_number'),
            'active_status' => $this->input->post('active_status'),
            'alt_pn' => $this->input->post('alt_pn'),
            'cage' => $this->input->post('cage'),
            'trash_status' => 'no',
            'code' => $this->input->post('event_code'),
            'date' => $this->input->post('event_date'),
            'from_time' => $this->input->post('from_time'),
            'title' => $this->input->post('title'),
            'brief_details' => $this->input->post('brief_description'),
            'to_time' => $this->input->post('to_time'),
        );



        $banner_images_str = $this->input->post('final_images');
        $banner_images = explode(',', $banner_images_str);

        $image_array = array();

        
        if($banner_images_str != ""){

            foreach ($banner_images as $banner) {

                $image_array = array(
                    'image' => $banner,
                    'combo' => $this->input->post('combo'),
                    'seo_alt' => $service_name,
                    'seo_title' => $service_name
                );                
                
            }

            $image_encode = json_encode($image_array);

            $data = $this->product_model->array_push_assoc($data, 'image', $image_encode);

        }


        
        $this->db->insert('ec_services', $data);
    }
    
    function countAllServices(){
        if (isset($_GET['name'])) {
            $sess_val = $_GET['name'];
            $s_a = str_replace("123", "&", $sess_val);
            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('name', $s_a);
        }
        
        $this->db->where('type', 'service');
        $this->db->where('trash_status', 'no');
        $val = $this->db->get('ec_services');
        return $val->num_rows();
    }
    
    function listAllServices($perpage , $rec_from){
        if (isset($_GET['name'])) {
            $sess_val = $_GET['name'];
            $s_a = str_replace("123", "&", $sess_val);
            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('name', $s_a);
        }
        
        $this->db->order_by('id', 'DESC');
        $this->db->where('type', 'service');
        $this->db->where('trash_status', 'no');
        $this->db->limit($perpage, $rec_from);
        return $this->db->get('ec_services')->result();
    }
    
    function editService($id){
        $service_name = trim($this->input->post('service_name'));
        
        /* $original_price = trim($this->input->post('price'));
       
        if(!is_numeric($original_price)){
            $original_price = 0;
        } */
        
        $data = array(
            'type' => 'service',           
            'name' => $service_name,
            'short_description' => $this->input->post('short_description'),
            'part_number' => $this->input->post('part_number'),
            'order_no' => $this->input->post('order_number'),
            'active_status' => $this->input->post('active_status'),
            'alt_pn' => $this->input->post('alt_pn'),
            'cage' => $this->input->post('cage'),
            'trash_status' => 'no',
            'code' => $this->input->post('event_code'),
            'date' => $this->input->post('event_date'),
            'from_time' => $this->input->post('from_time'),
            'title' => $this->input->post('title'),
            'brief_details' => $this->input->post('brief_description'),
            'to_time' => $this->input->post('to_time'),
        );

        
        $banner_images_str = $this->input->post('final_images');
        $banner_images = explode(',', $banner_images_str);

        $image_array = array();

        
        if($banner_images_str != ""){

            foreach ($banner_images as $banner) {

                $image_array = array(
                    'image' => $banner,
                    'combo' => $this->input->post('combo'),
                    'seo_alt' => $service_name,
                    'seo_title' => $service_name
                );                
                
            }

            $image_encode = json_encode($image_array);

            $data = $this->product_model->array_push_assoc($data, 'image', $image_encode);

        }
        
        $this->db->where('id', $id);
        $this->db->update('ec_services', $data);
        
    }
    
    function getTotalProductCount(){
        
        if (isset($_GET['name']) && ($_GET['name'] != "")) {
            $sess_val = $_GET['name'];
//            $s_a = str_replace("123", "&", $sess_val);
            $s_a = str_replace("-", " ", $sess_val);
            $s_a = strtolower($s_a);
            $like_clause_string = "product_title  LIKE '%" . $s_a . "%'"
//                    . "OR categorynametree  LIKE '%" . $s_a . "%' "
                  . " OR prod_name  LIKE '%" . $s_a . "%'  "
                    . " OR  sku LIKE '%" . $s_a . "%'   "
//                    . " OR  supplier_code LIKE '%" . $sess_val . "%'   "
                    . " OR  prod_code LIKE '%" . $s_a . "%' ";
            $this->db->where("(" . $like_clause_string . ")", NULL, FALSE);
        }
        
        if (isset($_GET['category']) && ($_GET['category'] != "")) {
            $cat_id = $_GET['category'];
            $this->db->like('categoryidtree', '+' . $cat_id . '+');
        }

        if (isset($_GET['status']) && ($_GET['status'] != "")) {
            $status = $_GET['status'];
            $this->db->where('active_status', $status);
        }
        
        $this->db->where('function_type', 'product');
        $this->db->where('trash_status', 'no');
        $val = $this->db->get('ec_products');
        return $val->num_rows();
    }
    
    function getProductDefaultImage($prod_id) {
        $this->db->where('prod_cat', $prod_id);
        $this->db->where('default_img', 'yes');
        return $this->db->get('cms_media')->row();
    }

    function get_subcategory_list()
    {
       	$this->db->where('parent_id !=', 0);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('id', 'DESC');
        return $this->db->get('cms_menu')->result();	
    }

    function listProductGalleryByType($id , $image_type){
        $this->db->where('prod_cat', $id);
        $this->db->where('type', 'product_image');
        $this->db->where('type2', 'product');
        $this->db->where('type_trash', 'no');
        $this->db->where('image_type', $image_type);
        $this->db->order_by('order', 'ASC');
        return $this->db->get('cms_media')->result();
    }
	
    function addTicketType(){
        $ticket_name = trim($this->input->post('ticket_name'));

        $data = array(
            'type' => 'ticket',           
            'name' => $ticket_name,
            'code' => $this->input->post('ticket_code'),
            'title' => $this->input->post('title'),
            'order_no' => $this->input->post('order_number'),
            'active_status' => $this->input->post('active_status'),
            'price' => trim($this->input->post('price')),
            'total_number' => trim($this->input->post('total_number')),
            'trash_status' => 'no',
            'category' => $this->input->post('category'),
        );

        $this->db->insert('ec_services', $data);
    }

    function getAllEvents(){
        $this->db->where('category', 0);
        $this->db->where('type', 'service');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');

        return $this->db->get('ec_services')->result();
    }

    function countAllTicketTypes(){
        if (isset($_GET['name'])) {
            $sess_val = $_GET['name'];
            $s_a = str_replace("123", "&", $sess_val);
            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('name', $s_a);
        }

        $this->db->where('trash_status', 'no');
        $this->db->where('type', 'ticket');
        $val = $this->db->get('ec_services');
        return $val->num_rows();
    }

    function listAllTicketTypes($perpage , $rec_from){
        if (isset($_GET['name'])) {
            $sess_val = $_GET['name'];
            $s_a = str_replace("123", "&", $sess_val);
            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('name', $s_a);
        }

        $this->db->order_by('id', 'DESC');
        $this->db->where('type', 'ticket');
        $this->db->where('trash_status', 'no');
        $this->db->limit($perpage, $rec_from);
        return $this->db->get('ec_services')->result();
    }

    function editTicketType($id){
        $ticket_name = trim($this->input->post('ticket_name'));

        $data = array(
            'type' => 'ticket',           
            'name' => $ticket_name,
            'code' => $this->input->post('ticket_code'),
            'title' => $this->input->post('title'),
            'order_no' => $this->input->post('order_number'),
            'active_status' => $this->input->post('active_status'),
            'price' => trim($this->input->post('price')),
            'total_number' => trim($this->input->post('total_number')),
            'trash_status' => 'no',
            'category' => $this->input->post('category'),
        );

        $this->db->where('id', $id);
        $this->db->update('ec_services', $data);
        
    }

    function addPackage(){
        $category_array = $this->input->post('category');
        $category_id_tree = "+";

        if($category_array != NULL){
            foreach($category_array as $category_row){
                $category_id_tree = $category_id_tree . $category_row . '+';
            }
        }

        $package_name = trim($this->input->post('package_name'));

        $data = array(
            'type' => 'package',           
            'name' => $package_name,
            'code' => $this->input->post('package_code'),
            'price' => $this->input->post('price'),
            'order_no' => $this->input->post('order_number'),
            'active_status' => $this->input->post('active_status'),
            'category_tree' => $category_id_tree,            
            'trash_status' => 'no',
            'price_status' => $this->input->post('price_status'),
        );       

        $banner_images_str = $this->input->post('final_images');
        $banner_images = explode(',', $banner_images_str);

        $image_array = array();

        if($banner_images_str != ""){

            foreach ($banner_images as $banner) {

                $image_array = array(
                    'image' => $banner,
                    'combo' => $this->input->post('combo'),
                    'seo_alt' => $package_name,
                    'seo_title' => $package_name
                );                
                
            }

            $image_encode = json_encode($image_array);

            $data = $this->product_model->array_push_assoc($data, 'image', $image_encode);

        }

        $this->db->insert('ec_services', $data);

    }

    function countAllPackages(){
        if (isset($_GET['name'])) {
            $sess_val = $_GET['name'];
            $s_a = str_replace("123", "&", $sess_val);
            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('name', $s_a);
        }

        $this->db->where('type', 'package');
        $this->db->where('trash_status', 'no');
        $val = $this->db->get('ec_services');
        return $val->num_rows();
    }

    function listAllPackages($perpage , $rec_from){
        if (isset($_GET['name'])) {
            $sess_val = $_GET['name'];
            $s_a = str_replace("123", "&", $sess_val);
            $s_a = str_replace("-", " ", $s_a);
            $this->db->like('name', $s_a);
        }

        $this->db->order_by('id', 'DESC');
        $this->db->where('type', 'package');
        $this->db->where('trash_status', 'no');
        $this->db->limit($perpage, $rec_from);
        return $this->db->get('ec_services')->result();
    }

    function editPackage($id){
        $category_array = $this->input->post('category');
        $category_id_tree = "+";

        if($category_array != NULL){
            foreach($category_array as $category_row){
                $category_id_tree = $category_id_tree . $category_row . '+';
            }
        }

        $package_name = trim($this->input->post('package_name'));

        $data = array(
            'type' => 'package',           
            'name' => $package_name,
            'code' => $this->input->post('package_code'),
            'price' => $this->input->post('price'),
            'order_no' => $this->input->post('order_number'),
            'active_status' => $this->input->post('active_status'),
            'category_tree' => $category_id_tree,            
            'trash_status' => 'no',
            'price_status' => $this->input->post('price_status'),
        );

        $banner_images_str = $this->input->post('final_images');
        $banner_images = explode(',', $banner_images_str);

        $image_array = array();

        if($banner_images_str != ""){

            foreach ($banner_images as $banner) {

                $image_array = array(
                    'image' => $banner,
                    'combo' => $this->input->post('combo'),
                    'seo_alt' => $package_name,
                    'seo_title' => $package_name
                );                
                
            }

            $image_encode = json_encode($image_array);

            $data = $this->product_model->array_push_assoc($data, 'image', $image_encode);

        }

        $this->db->where('id', $id);
        $this->db->update('ec_services', $data);

    }

}
