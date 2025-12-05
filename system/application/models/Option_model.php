<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Option_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // $this->output->enable_profiler(TRUE);
        $this->tree = array();
        $this->parent = '';
        $this->arr = array();
        $this->arr2 = array();
        $this->arrz = array();
        $this->arrs = array();
        $this->arrow = '|';
        $this->arrzz = array();
        //date_default_timezone_set('Asia/Calcutta');

    }

    function array_push_assoc($array, $key, $value) {
        $array[$key] = $value;
        return $array;
    }

    function GetByRow($table, $eventid, $field) {

        $this->db->where(array($field => $eventid));

        return $result = $this->db->get($table)->row();
    }

    function GetByResult_Where_notrash($table, $order_column, $order_type, $conditional_array) {
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

    function get_all_country() {

        $this->db->order_by('country', 'ASC');
        return $this->db->get('cms_country')->result();
    }

    function get_all_option() {

        $this->db->order_by('id', 'ASC');
        return $this->db->get('cms_options')->result();
    }

    function get_current_option($id) {

        $this->db->where('id', $id);
        return $this->db->get('cms_options')->row();
    }
    function get_current_option2($id) {

        $this->db->where('id', $id);
        return $this->db->get('cms_options2')->row();
    }

    /*
     * Select all types of wizard templates
     */

    function select_all_wizard_template() {
        $wizard_template = array(
            "wizard_1" => "Service",
            "wizard_2" => "Express",
        );
        return $wizard_template;
    }

    /*
     * End of Select all types of  wizard templates
     */
  
    function update_filename($forcefully_filename, $query) {
        foreach ($query as $type) {

            $preferences = json_decode($type->preferences, true);

            $new_preference = array('allowed_types' => $preferences['allowed_types'],
                'file_name' => $forcefully_filename,
                'overwrite' => $preferences['overwrite'],
                'max_size' => $preferences['max_size'],
                'max_width' => $preferences['max_width'],
                'max_height' => $preferences['max_height'],
                'max_filename' => $preferences['max_filename'],
                'encrypt_name' => $preferences['encrypt_name'],
                'remove_spaces' => $preferences['remove_spaces'],
            );

            $new_preference_encode = json_encode($new_preference, true);
            $data = array('preferences' => $new_preference_encode);

            $this->db->where('id', $type->id);
            $this->db->update('cms_upload_types', $data);
        }
    }

    //    nikhil  EOF options upadte  

    function get_library_group() {
        $library_group = array('js' => 'JS File',
            'css' => 'CSS',
            'script' => 'Script',
            'meta' => 'Meta',
            'metacharset' => 'Meta Charset');
        return $library_group;
    }

    function get_file_type_asset() {
        return $filetype = array('internal', 'external', 'manual');
    }
   
    function get_array_by_name($array_name) {
        switch ($array_name) {
            case 'file_upload_type' :

                $array_result = array('content', 'content_category_picture', 'feature_box', 'logo', 'structure', 'product', 'product_category_picture', 'product_category_banner', 'page_banner', 'product_brochure', 'branch_banner', 'common_image_category', 'common_image', 'gift_card', 'product_attribute', 'menu', 'product_default_banner', 'page_default_banner', 'wrapper');

                break;
        }

        return $array_result;
    }
   
    public function DeleteById1($id) {
        $this->db->where('id', $id);
        $this->db->delete('cms_options');
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
     
    function get_upload_types() {
        $result = $this->db->get('cms_upload_types')->result();
        return $result;
    }

    function list_product_gallery($id) {
        $this->db->where('prod_cat', $id);
        $this->db->where('type', 'product_image');
        $this->db->where('type2', 'product');
        $this->db->where('type_trash', 'no');
        return $this->db->get('cms_media')->result();
    }

    function get_result_by_id_arr($table, $id_arr) {
        ini_set('max_execution_time', 0);

        $this->db->where_in('id', $id_arr);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $query = $this->db->get($table);

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }
       
    function rename_image_file($image_detail_arr, $forcefully_filename) {

        $combo_details = $this->option_model->GetByRow('cms_image_combo', $image_detail_arr['combo'], 'id');
        if (!empty($combo_details)) {

            $upload_type_details = $this->option_model->GetByRow('cms_upload_types', $combo_details->upload_type, 'id');
            if (!empty($upload_type_details)) {
                $preferences = json_decode($upload_type_details->preferences);
                if (!empty($preferences)) {
                    $current_file_name = $preferences->file_name;


//                    $current_file_name = 'a';


                    $image_name = explode('-', $image_detail_arr['image']);

                    $image_name_end = end($image_name);
                    $image_new_name = $forcefully_filename . '-' . $image_name_end;

                    $image_name_arr = array($image_new_name => $image_detail_arr['image']);
                    $extra_data = array();
                    if ($upload_type_details->manipulation_status == 'Yes') {
                        $manipulation_details = $this->option_model->GetByRow('cms_image_manipulation', $combo_details->manipulation, 'id');
                        $size_details_arr = json_decode($manipulation_details->size_details);
                        if (!empty($size_details_arr)) {
                            foreach ($size_details_arr as $size_detail) {

                                $image_new_name_size = $size_detail->size_name . '_' . $image_new_name;
                                $extra_data[$image_new_name_size] = $size_detail->size_name . '_' . $image_detail_arr['image'];
                            }
                        }
                        $image_name_arr = array_merge($image_name_arr, $extra_data);
                    }


                    if ($image_name_arr) {
                        foreach ($image_name_arr as $img_new_name => $img_name) {

//                            $image_name_new = str_replace($current_file_name, $forcefully_filename, $img_name);

                            $img_file1 = 'media_library/' . $img_name;
                            $img_file_new1 = 'media_library/' . $img_new_name;
                            if (file_exists($img_file1)) {

                                rename($img_file1, $img_file_new1);
                            }
                        }
                    }
                }
            }
        }
    }

    function update_image_file_name($image_detail_arr, $forcefully_filename, $table, $table_id, $column_name, $type) {

        if ($type == 'ar_r') {
            if (!empty($image_detail_arr)) {
                foreach ($image_detail_arr as $key => $image_detail) {

                    $combo_details = $this->option_model->GetByRow('cms_image_combo', $image_detail['combo'], 'id');
                    if (!empty($combo_details)) {
                        $upload_type_details = $this->option_model->GetByRow('cms_upload_types', $combo_details->upload_type, 'id');
                        if (!empty($upload_type_details)) {
                            $preferences = json_decode($upload_type_details->preferences);
                            if (!empty($preferences)) {
                                $current_file_name = $preferences->file_name;


//                                $current_file_name = 'a';
//                                $new_image_name = str_replace($current_file_name, $forcefully_filename, $image_detail['image']);

                                $image_name = explode('-', $image_detail['image']);

                                $image_name_end = end($image_name);

                                $image_new_name = $forcefully_filename . '-' . $image_name_end;

                                $image_detail_arr[$key]['image'] = $image_new_name;
//                                $image_detail['image'] = $new_image_name;
                            }
                        }
                    }
                }
            }
        } else {
            $combo_details = $this->option_model->GetByRow('cms_image_combo', $image_detail_arr['combo'], 'id');
            if (!empty($combo_details)) {
                $upload_type_details = $this->option_model->GetByRow('cms_upload_types', $combo_details->upload_type, 'id');
                if (!empty($upload_type_details)) {
                    $preferences = json_decode($upload_type_details->preferences);
                    if (!empty($preferences)) {
                        $current_file_name = $preferences->file_name;


//                        $current_file_name = 'a';
//                        $new_image_name = str_replace($current_file_name, $forcefully_filename, $image_detail_arr['image']);
                        $image_name = explode('-', $image_detail_arr['image']);

                        $image_name_end = end($image_name);

                        $image_new_name = $forcefully_filename . '-' . $image_name_end;

                        $image_detail_arr['image'] = $image_new_name;
                    }
                }
            }
        }

        $image_detail_json = json_encode($image_detail_arr);
		
		if($table == 'cms_options_setting')
		{
			
		$data = array('value' => $image_detail_json);	
			
		$this->db->where('columnlabel', $column_name);
        $this->db->update('cms_options_setting', $data);
			
		}
		else
		{
        $data = array($column_name => $image_detail_json);

        $this->db->where('id', $table_id);
        $this->db->update($table, $data);
		}
		
    }

    function get_all_media() {

        ini_set('max_execution_time', 0);

        $this->db->where('type_trash !=', 'yes');
        $query = $this->db->get('cms_media');

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function table_file_rename($forcefully_filename, $table, $column, $page_result) {

        if (!empty($page_result)) {
            foreach ($page_result as $page) {
//                if ($page->id == 1 || $page->id == 2 || $page->id == 3) {
	
				if($table == 'cms_options_setting')
				{
					$page_img_arr = json_decode($page_result->$column, TRUE);
                	$page_img_check = json_decode($page_result->$column);
				}
				else
				{

                $page_img_arr = json_decode($page->$column, TRUE);
                $page_img_check = json_decode($page->$column);
				
				}

                if (!empty($page_img_arr)) {
                    if (is_object($page_img_check)) {
                        $this->option_model->rename_image_file($page_img_arr, $forcefully_filename);
                        $this->option_model->update_image_file_name($page_img_arr, $forcefully_filename, $table, $page->id, $column, 'ob_j');
                    } elseif (is_array($page_img_check)) {

                        foreach ($page_img_arr as $page_img) {
                            $this->option_model->rename_image_file($page_img, $forcefully_filename);
                        }
                        $this->option_model->update_image_file_name($page_img_arr, $forcefully_filename, $table, $page->id, $column, 'ar_r');
                    }
                }
//                }
            }
        }
    }

    function custom_cms_updation($col_value, $type) {

        if ($type == 'cms_detail') {
            $custom_column = 'custom_content_detail_status';
            $column = 'content_detail_page';
            $column_val = $col_value;
        }



        $data_other = array($column => $column_val);

        $this->db->where($custom_column, 'no');
        $this->db->where('parent_id', '0');
        $this->db->update('cms_dynamic_category', $data_other);


        $conditional_array = array(
            $custom_column => 'no',
            'parent_id' => '0',
        );

        $parent_category_res = $this->common_model->GetByReturnTypeOrderType('cms_dynamic_category', 'id', 'ASC', $conditional_array, $returntype = 'result');
        if (!empty($parent_category_res)) {
            foreach ($parent_category_res as $cat_row) {

                $conditional_array = array(
                    $custom_column => 'no',
                    'parent_id' => $cat_row->id,
                );
                $sub_category_res = $this->common_model->GetByReturnTypeOrderType('cms_dynamic_category', 'id', 'ASC', $conditional_array, $returntype = 'result');

                $this->db->where($custom_column, 'no');
                $this->db->where('parent_id', $cat_row->id);
                $this->db->update('cms_dynamic_category', $data_other);


                $this->db->where($custom_column, 'no');
                $this->db->where('prod_cat', $cat_row->id);
                $this->db->update('cms_media', $data_other);

                if (!empty($sub_category_res)) {
                    foreach ($sub_category_res as $sub_cat_row) {

                        $this->db->where($custom_column, 'no');
                        $this->db->where('prod_cat', $sub_cat_row->id);
                        $this->db->update('cms_media', $data_other);
                    }
                }
            }
        }
    }

    function custom_prod_updation($col_value, $type) {

        if ($type == 'product_detail') {
            $custom_column = 'custom_product_detail_status';
            $column = 'product_detail_page';
            $column_val = $col_value;
        } else if ($type == 'inventory') {
            $custom_column = 'custom_inventory_status';
            $column = 'inventory_status';
            $column_val = $col_value;
        } else if ($type == 'qty_zero_action') {
            $custom_column = 'custom_qty_zero_action';
            $column = 'qty_zero_action';
            $column_val = $col_value;
        }

        $data_other = array($column => $column_val);

        $this->db->where($custom_column, 'no');
        $this->db->where('parent_id', '0');
        $this->db->update('ec_category', $data_other);

        $conditional_array = array(
            $custom_column => 'no',
            'parent_id' => '0',
        );

        $parent_category_res = $this->common_model->GetByReturnTypeOrderType('ec_category', 'id', 'ASC', $conditional_array, $returntype = 'result');
        if (!empty($parent_category_res)) {
            foreach ($parent_category_res as $cat_row) {

                $conditional_array = array(
                    $custom_column => 'no',
                    'parent_id' => $cat_row->id,
                );
                $sub_category_res = $this->common_model->GetByReturnTypeOrderType('ec_category', 'id', 'ASC', $conditional_array, $returntype = 'result');

                $this->db->where($custom_column, 'no');
                $this->db->where('parent_id', $cat_row->id);
                $this->db->update('ec_category', $data_other);


                $this->db->where($custom_column, 'no');
                $this->db->where('parent_sub_id', $cat_row->id);
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
    }
       
    public function sliderAttributeSet(){        
      return $slider_item_type= json_decode($this->common_model->option->slider_item_type,true);
    }

public function addContentFixedAreaSet(){        
      return $add_content_fixed_areas = json_decode($this->common_model->option->add_content_fixed_areas,true);
    }	
	

function update_user_option()
{


$data = array(

'delivery_charge_minimum_cart_amount' => $this->input->post('delivery_charge_minimum_cart_amount'),
'delivery_charge_amount_by_cart_total' => $this->input->post('delivery_charge_amount_by_cart_total'),

);	
	

if(!empty($data))
{
	
foreach($data as $option_data_column => $option_data_value)
{
$data_update_array = array();

$data_update_array = array(

'value' =>$option_data_value, 

);


$this->db->where('columnlabel', $option_data_column);
$this->db->update('cms_options_setting', $data_update_array);

	
	
}
	
}	
	
	
}
	
    function addMailData(){
                $data = array(
                    'contact_email' => $this->input->post('contact_email'),
                    'contact_from_email' => $this->input->post('contact_from_email'),
                    'mail_formtype' => $this->input->post('mail_json'),
                    'mail_message' => $this->input->post('mail_msg'),
                );
                
                if(!empty($data))
                {
                    foreach($data as $option_data_column => $option_data_value)
                    {
                        $data_update_array = array();

                        $data_update_array = array(

                        'value' =>$option_data_value, 

                        );

                        $this->db->where('columnlabel', $option_data_column);
                        $this->db->update('cms_options_setting', $data_update_array);
                    }
                }
    }
    
    function addProjectData(){
        $data = array(
            'project_name' => strtolower($this->input->post('project_name'))
        );
        if(!empty($data)){
                    foreach($data as $option_data_column => $option_data_value)
                    {
                        $data_update_array = array();

                        $data_update_array = array(

                        'value' =>$option_data_value, 

                        );

                        $this->db->where('columnlabel', $option_data_column);
                        $this->db->update('cms_options_setting', $data_update_array);
                    }
        }
    }

    function addSeoContents(){
        $seo_title_array = array(
            'tag' => $this->input->post('seo_tag'),
            'text' => $this->input->post('seo_title'),            
        );

        $seo_title_json = json_encode($seo_title_array);
        
        $data = array(
            "value" => $seo_title_json,
        );

        $this->db->where('columnlabel', 'common_seo_contents');
        $this->db->update('cms_options_setting', $data);
    }

    function addSocialMediaData(){
        $facebook_fans = trim($this->input->post('facebook_fans'));
        $twitter_followers = trim($this->input->post('twitter_followers'));
        $youtube_subscribers = trim($this->input->post('youtube_subscribers'));
        $instagram_followers = trim($this->input->post('instagram_followers'));

        $social_array = array(
            "facebook_fans" => $facebook_fans,
            "twitter_followers" => $twitter_followers,
            "youtube_subscribers" => $youtube_subscribers,
            "instagram_followers" => $instagram_followers
        );

        $social_json = json_encode($social_array);

        $data = array(
            'value' => $social_json
        );
        
        $this->db->where('columnlabel', 'social_media_data');
        $this->db->update('cms_options_setting', $data);
        
    }

    function addSpecialTypesData(){
        $hot_this_week_title = trim($this->input->post('hot_this_week_title'));
        $past_stories_title = trim($this->input->post('past_stories_title'));
        $must_read_title = trim($this->input->post('must_read_title'));
        $recent_article_title = trim($this->input->post('recent_article_title'));
        $trending_now_title = trim($this->input->post('trending_now_title'));

        $special_types_array = array(
            "hot_this_week" => $hot_this_week_title,
            "past_stories" => $past_stories_title,
            "must_read" => $must_read_title,
            "recent_article" => $recent_article_title,
            "trending_now" => $trending_now_title
        );

        $special_types_json = json_encode($special_types_array);

        $data = array(
            'value' => $special_types_json
        );

        $this->db->where('columnlabel', 'special_types_data');
        $this->db->update('cms_options_setting', $data);
    }
	
}
