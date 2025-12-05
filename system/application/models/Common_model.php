<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common_model
        extends CI_Model {

    var $data = '';

    function __construct() {
        parent::__construct();
//        $this->output->enable_profiler(TRUE);
        // $this->load->library('ion_auth');
        $this->tree = array();
        $this->parent = '';
        $this->arrow = '';
        $this->arra2 = array();
        $this->arr = array();
        $this->arr_b = array();
        $this->arr_w = array();
        $this->arr2 = array();
        $this->arrz = array();
        $this->arrs = array();
        $this->arrzz = array();
        $this->arr_m = array();

        $this->gift_product_categorytype_id_array = array(
            '24'); //Gift categorytype id
        $this->gift_product_type2 = array(
            '23'); //Giftcard product type

        $this->green_order_status_id_array = array(
            '3',
            '7',
            '11',
            '12',
            '13',
            '14'); //Order confirmed payment/order status id
        $this->send_sms_email_order_status_id_array = array(
            '3',
            '7',
            '11',
            '12',
            '13',
            '14'); //Order confirmed payment/order status id

        $this->discount_columns_commoninputid = array(
            '36',
            '30'); //Product columns commoninput_id for Discount purpose 


        $this->clause_opeators = array(
            '=',
            '!=',
            '>',
            '<');
        $this->scrolling_fixed_segment = array(
            "m",
            "page"); // For scrolling/sorting segment purpose
			
		
		$this->cancel_reason_array = array(
'r1' => 'Product Quality Cheap',
'r2' => 'Damage Product',
'r3' => 'Other Reason'
); // Cancel order reason
        //{oldoption}
        //$options = $this->get_options();
        //$this->option = $options[0];
        //{oldoption}

        $this->option = $this->get_options();
        $this->currencySet = json_decode($this->option->currency_list, TRUE);
        $this->option_common_input_full_array = json_decode($this->option->common_input_full_array, TRUE);

        //$this->logged_user_data = "";
        // $this->logged_user_data = $this->ion_auth->user()->row();
        //$this->AdminRemoveSecurePage();
        /*---------------------------------------------------------*/

        $this->SetErrorReporting();

        $this->SetTimeZone();       

        define('digit_format', 2);
    }

    function getCommonTableData($table_parameter_array = array()) {
        if (!empty($table_parameter_array) && isset($table_parameter_array["table"])) {

            if (!empty($table_parameter_array["column_select"])) {
                $column_select = $table_parameter_array["column_select"];

                foreach ($column_select as $column_name => $alias_name) {

                    $this->db->select("$column_name AS `" . $alias_name . "`", FALSE);
                }
            }

            if (!empty($table_parameter_array["table_condition_array"])) {

                foreach ($table_parameter_array["table_condition_array"] as
                            $condition_row) {

                    $condition_option = "";
                    if (!empty($condition_row["condition_option"])) {
                        $condition_option = $condition_row["condition_option"];
                    } // Need to integrate condition option

                    $columtext = $condition_row["condition_string"];
                    $valuetext = $condition_row["condition_value"];

                    $condition_clause = $condition_row["condition_clause"];

                    $this->db->$condition_clause($columtext, $valuetext);
                }
            }
            $this->db->from($table_parameter_array["table"]);
            $results = $this->db->get();

            $table_return_type = $table_parameter_array["table_return_type"];

            $final_result = $results->$table_return_type();

            //dump($this->db->last_query());

            return $final_result;
        } else {
            return NULL;
        }
    }

    function getImageBriefInfo($imageInfoArray, $imageParameterArray) {

        $image_size = "";
        $img_offset = "0";
        $image_link = "";
        $image_name = "";
        $image_alt = "";
        $image_title = "";
        $image_string = "";
        $display_image_name = "";

//
        $base_url = base_url();
        if (isset($imageParameterArray['base_url'])) {
            $base_url = $imageParameterArray['base_url'];
        }
//		

        if (isset($imageParameterArray["img_size_type"])) {
            $image_size = $imageParameterArray["img_size_type"];
        }
        if (isset($imageParameterArray["img_offset"])) {
            $img_offset = $imageParameterArray["img_offset"];
        }



        if (empty($imageInfoArray[$img_offset]["image"]) || file_exists('media_library/' . $imageInfoArray[$img_offset]["image"]) != 1) {


            $combo_no_image_array = json_decode($this->common_model->option->combo_no_image, TRUE);

            if (array_key_exists($imageInfoArray[$img_offset]["combo"], $combo_no_image_array)) {
                $combo_no_image = $combo_no_image_array[$imageInfoArray[$img_offset]["combo"]];
                $imageInfoArray = json_decode($combo_no_image, TRUE);
                $display_image_name = $imageInfoArray[$img_offset]["image"];
            } else {
                $display_image_name = "";
            }
        } else {

            $display_image_name = $imageInfoArray[$img_offset]["image"];
        }
        $image_name = $image_size . $display_image_name;
        $image_link = $base_url . "media_library/" . $image_name;
        $image_alt = $imageInfoArray[$img_offset]["seo_alt"];
        $image_title = $imageInfoArray[$img_offset]["seo_title"];

        switch ($imageParameterArray["return_type"]) {
            case "full_image_atr":
                $image_string = " src='" . $image_link . "'  alt='" . $image_alt . "' title='" . $image_title . "'";
                return $image_string;
                break;
            case "image_url":

                return $image_link;
                break;
            case "image_name":

                return $image_name;
                break;
        }
    }

    function getVideoBriefInfo($VideoInfoArray, $VideoParameterArray) {

        $video_offset = "0";



        if (isset($VideoParameterArray["img_offset"])) {
            $video_offset = $VideoParameterArray["img_offset"];
        }


        $display_video_row = $VideoInfoArray[$video_offset];

        //

        $video_id = '';
        if ($display_video_row['source'] != "") {

            if ($display_video_row['videotype'] == "YouTube Video Id") {
                $video_id = $display_video_row['source'];
            } elseif ($display_video_row['videotype'] == "Embed Code") {

                $embed = stripslashes($display_video_row['source']);
                $pagecontent = str_replace('<iframe', '', $embed);
                $splite1 = explode('embed', $pagecontent);
                $splite2 = explode('"', $splite1[1]);
                $splite2 = str_replace('/', '', $splite2[0]);

                $video_id = $splite2;
            } elseif ($display_video_row['videotype'] == "Url") {

                $video_url = $display_video_row['source'];
                $video_url_arr = explode('/', $video_url);
                $video_id = end($video_url_arr);
            }
        }


        if (!empty($video_id)) {

            switch ($VideoParameterArray["return_type"]) {
                case "full_video_atr":
                    $video_string = 'width="100%" height="315" src="https://www.youtube.com/embed/' . $video_id . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen';
                    return $video_string;
                    break;
                case "video_url":
                    $video_link = 'https://www.youtube.com/embed/' . $video_id;
                    return $video_link;
                    break;
                case "video_name":

                    return $video_id;
                    break;
            }
        } else {
            return;
        }
    }

    /*
     * for project base
     */

    function getAttributeValues($id, $get_type) {

        $table_condition_array = array();
        $table_condition_array[] = array(
            "condition_clause" => "where",
            "condition_string" => "type",
            "condition_value" => $id,
            "condition_option" => "",
        );
        $table_condition_array[] = array(
            "condition_clause" => "where",
            "condition_string" => "trash_status",
            "condition_value" => "no",
            "condition_option" => "",
        );
        $table_condition_array[] = array(
            "condition_clause" => "where",
            "condition_string" => "active_status",
            "condition_value" => "a",
            "condition_option" => "",
        );
        $table_parameter_array = array(
            "table_condition_array" => $table_condition_array,
            "table" => "ec_product_attributes",
            "table_return_type" => "result"
        );


        $attrSet = $this->common_model->getCommonTableData($table_parameter_array);

        if ($get_type == "simple") {

            $table_condition_array = array();
            $table_condition_array[] = array(
                "condition_clause" => "where",
                "condition_string" => "id",
                "condition_value" => $id,
                "condition_option" => "",
            );
            $table_condition_array[] = array(
                "condition_clause" => "where",
                "condition_string" => "trash_status",
                "condition_value" => "no",
                "condition_option" => "",
            );
            $table_condition_array[] = array(
                "condition_clause" => "where",
                "condition_string" => "active_status",
                "condition_value" => "a",
                "condition_option" => "",
            );
            $table_parameter_array = array(
                "table_condition_array" => $table_condition_array,
                "table" => "ec_categorytypes",
                "table_return_type" => "row"
            );
            $category_type_row = $this->common_model->getCommonTableData($table_parameter_array);

            $simple_array_set = array();
            if ($attrSet != "") {
                foreach ($attrSet as $attr) {
                    $simple_array_set[$attr->id] = $attr->fieldname;
                }
                $simple_array_set[0] = $category_type_row->name;

                return $simple_array_set;
            }
        } else {
            return $attrSet;
        }
    }

    function getProductQuickData($id) {

        $table_condition_array = array();
        $table_condition_array[] = array(
            "condition_clause" => "where",
            "condition_string" => "id",
            "condition_value" => $id,
            "condition_option" => "",
        );
        $table_condition_array[] = array(
            "condition_clause" => "where",
            "condition_string" => "trash_status",
            "condition_value" => "no",
            "condition_option" => "",
        );
        $table_condition_array[] = array(
            "condition_clause" => "where",
            "condition_string" => "active_status",
            "condition_value" => "a",
            "condition_option" => "",
        );
        $table_parameter_array = array(
            "table_condition_array" => $table_condition_array,
            "table" => "ec_category",
            "table_return_type" => "row"
        );


        $Quickdata = $this->common_model->getCommonTableData($table_parameter_array);
        return $Quickdata;
    }

    /*
     * EOF for project base
     */


    /*
     * product listing sort and filter loading
     */

    function getFilterSortValues() {
        
    }

    /*
     * EOF product listing sort and filter loading
     */

    function AdminRemoveSecurePage() {


        $currentURL = current_url();

        $params = $_SERVER['QUERY_STRING'];

        $fullURL = $currentURL;

        if (!empty($params)) {
            $fullURL = $currentURL . '?' . $params;
        }

        $ci2 = & get_instance();
        $class = $ci2->router->class;

        $protocol = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';

        if ($protocol == 'https://') {

            if ($class != 'index' && $class != 'paymentoption') {
                $fullURL = str_replace('https', 'http', $fullURL);
                redirect($fullURL);
            }
        }
    }

    function SetErrorReporting() {

        error_reporting(0);
       /* $error_report_class_list = $this->option->error_report_class_tree;
        $error_report_class_array = explode('+', $error_report_class_list);
        if (in_array($this->router->class, $error_report_class_array)) {
            error_reporting(0);
        }/**/
    }

    function SetTimeZone() {

        $time_zone = $this->option->time_zone;
        if (!empty($time_zone)) {
            date_default_timezone_set($time_zone);
        }
    }

    function DeleteById($table, $id, $field) {

        $delete_row = $this->common_model->GetByRow_notrash($table, $id, $field);

        if (!empty($delete_row)) {

            if ($delete_row->fixed_for_software != 'yes') {

                $this->db->where(array(
                    $field => $id));
                $this->db->delete($table);

                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    function delete_status() {
        $delete_array = array(
            'activate',
            'deactivate'
//            'delete'
            );
        return $delete_array;
    }

    function GetByRow($table, $eventid, $field) {
        ini_set('max_execution_time', 0);

        $this->db->where(array(
            $field => $eventid));
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $result = $this->db->get($table)->row();
    }

    function GetByRowOrFalse($table, $eventid, $field, $conditional_array = NULL) {

        ini_set('max_execution_time', 0);
        if ($conditional_array !== NULL) {
            $this->db->where($conditional_array);
        }
        $this->db->where(array(
            $field => $eventid));
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $query = $this->db->get($table);
        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    function GetByRow_array_notrash($table, $eventid, $field) {
        ini_set('max_execution_time', 0);

        $this->db->where(array(
            $field => $eventid));
        return $result = $this->db->get($table)->row_array();
    }

    function GetByRow_notrash($table, $eventid, $field) {
        ini_set('max_execution_time', 0);

        $this->db->where(array(
            $field => $eventid));
        return $result = $this->db->get($table)->row();
    }

    function GetByRow_array($table, $eventid, $field) {
        ini_set('max_execution_time', 0);

        $this->db->where(array(
            $field => $eventid));
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $result = $this->db->get($table)->row_array();
    }

    function GetByFixedPageType($table, $eventid, $field) {

        $this->db->where(array(
            $field => $eventid));
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->where('fixed_status', 'yes');
        return $result = $this->db->get($table)->row();
    }

    function GetByResult($table, $order_column, $order_type) {
        ini_set('max_execution_time', 0);

        $this->db->order_by($order_column, $order_type);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $query = $this->db->get($table);

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function GetByResult_Where($table, $order_column, $order_type,
            $conditional_array) {
        ini_set('max_execution_time', 0);
        $this->db->where($conditional_array);
        $this->db->order_by($order_column, $order_type);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $query = $this->db->get($table);

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function GetByResult_noActiveStatus($table, $order_column, $order_type,
            $conditional_array) {
        ini_set('max_execution_time', 0);
        $this->db->where($conditional_array);
        $this->db->order_by($order_column, $order_type);
        $this->db->where('trash_status', 'no');
        $query = $this->db->get($table);

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function GetByResult_notrash($table, $order_column, $order_type) {
        ini_set('max_execution_time', 0);

        $this->db->order_by($order_column, $order_type);
        $query = $this->db->get($table);

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function GetByResultArray_Where($table, $order_column, $order_type,
            $conditional_array) {
        ini_set('max_execution_time', 0);
        $this->db->where($conditional_array);
        $this->db->order_by($order_column, $order_type);
        $query = $this->db->get($table);

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function GetByReturnTypeOrderType($table, $order_column, $order_type,
            $conditional_array, $returntype = 'result') {
        ini_set('max_execution_time', 0);
        $this->db->where($conditional_array);
        $this->db->order_by($order_column, $order_type);
        $query = $this->db->get($table);

        if ($query->num_rows() >= 1) {

            return $query->$returntype();
        } else {

            return false;
        }
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

    function GetLiveProducts($table, $order_column, $order_type) {
        ini_set('max_execution_time', 0);

        $this->db->order_by($order_column, $order_type);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->where('qty >', '0');
        //$this->db->where_not_in('product_categorytype_id', $this->common_model->exclude_product_categorytype_id_array);
        return $result = $this->db->get($table)->result();
    }

    function array_push_assoc($array, $key, $value) {
        $array[$key] = $value;
        return $array;
    }

    public function get_options() {

        /*        ini_set('max_execution_time', 0);    
          $this->db->select('*')
          ->from('cms_options')
          ->join('cms_options2', 'cms_options.id = cms_options2.id')
          ->join('cms_options3', 'cms_options.id = cms_options3.id');
          $query = $this->db->get();
          if ($query->num_rows() >= 1) {
          return $query->result();
          } else {
          return false;
          } */

/*        $optiondata = $this->db->get('cms_options_setting')->result();

        $option_full_array = array();

        foreach ($optiondata as $orow) {
            $option_full_array[$orow->columnlabel] = $orow->value;
        }

        $option_full_array = json_decode(json_encode($option_full_array), FALSE);

        return $option_full_array;*/
		

$options_setting = $this->db->get('cms_options_setting')->result_array();

$columnlabel_array = array_column($options_setting,"columnlabel");
$value_array = array_column($options_setting,"value");

$options_setting_array = array_combine($columnlabel_array, $value_array);

$options_setting_array = json_decode(json_encode($options_setting_array), FALSE);
		
return $options_setting_array;	
		
		
    }

    public function get_options_row() {

        $this->db->select('*')
                ->from('cms_options')
                ->join('cms_options2', 'cms_options.id = cms_options2.id');
        $query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function CheckOptionSecure($option) {
        $base_url = base_url();
        $website_security = $option->secure;
        if ($website_security == 'on') {
            if (strpos($base_url, 'https') !== false) {
                
            } else {
                $base_url = str_replace('http', 'https', $base_url);
            }
        } else {
            if (strpos($base_url, 'https') !== false) {
                $base_url = str_replace('https', 'http', $base_url);
            } else {
                
            }
        }

        return $base_url;
    }

    public function CheckPageSecure($pageid = "", $return_type = "") {
        $option = $this->common_model->option;
        $website_security = $option->secure;
        $security_type = $option->secured_pages;
        $page_details = $this->common_model->GetByRow('cms_pages', $pageid, 'id');
        $pagesecure = $page_details->secure;
        $base_url = base_url();
        $full_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";



        if ($website_security == 'on') {
            if ($security_type == "full") {

                if (strpos($full_url, 'https') !== false) {
                    
                } else {
                    $full_url = str_replace('http', 'https', $full_url);
                    if ($return_type == "") {
                        redirect($full_url);
                    } else {
                        $base_url = str_replace('http', 'https', $base_url);
                    }
                }
            } else {
                if ($pagesecure == "on") {
                    if (strpos($full_url, 'https') !== false) {
                        
                    } else {
                        $full_url = str_replace('http', 'https', $full_url);
                        if ($return_type == "") {
                            redirect($full_url);
                        } else {
                            $base_url = str_replace('http', 'https', $base_url);
                        }
                    }
                } else if ($pagesecure != "on") {
                    if (strpos($full_url, 'https') !== false) {
                        $full_url = str_replace('https', 'http', $full_url);
                        if ($return_type == "") {
                            redirect($full_url);
                        } else {
                            $base_url = str_replace('https', 'http', $base_url);
                        }
                    } else {
                        
                    }
                }
            }
        } else {
            if (strpos($full_url, 'https') !== false) {
                $full_url = str_replace('https', 'http', $full_url);
                if ($return_type == "") {
                    redirect($full_url);
                } else {
                    $base_url = str_replace('https', 'http', $base_url);
                }
            } else {
                
            }
        }

        return $base_url;
    }

    function GetAllColumngrid($table) {
        $data = $this->db->field_data($table);
        return $data;
    }

    function GetAllProductAttributes() {
        $this->db->select('*');
        $this->db->from('ec_categorytypes');
        $this->db->where('type', 'product_attributes');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('id', 'asc');
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function set_order_product_info($id) {
        $data = array(
            'order_product_info' => $this->input->post('product_order_columns'),
            'order_attribute_info' => $this->input->post('product_order_attr'),
            'product_excel_columns' => $this->input->post('product_excel_columns'),
        );

        //{oldoption}
        // $this->db->where('id', $id);
        // $this->db->update('cms_options', $data);
        //{oldoption}
        //{sbn} code

        if (!empty($data)) {

            foreach ($data as $option_data_column => $option_data_value) {
                $data_update_array = array();

                $data_update_array = array(
                    'value' => $option_data_value,
                );


                $this->db->where('columnlabel', $option_data_column);
                $this->db->update('cms_options_setting', $data_update_array);
            }
        }



//{sbn} code
    }

    function GetOrderProductInfoColumns($data_input_order) {
        ini_set('max_execution_time', 0);

        $option = $data_input_order['option'];


        $column_checked_list = explode('+', $option->order_product_info);
        array_pop($column_checked_list);
        array_shift($column_checked_list);

//        dump($column_checked_list);

        $product_attr_checked_list = explode('+', $option->order_attribute_info);
        array_pop($product_attr_checked_list);
        array_shift($product_attr_checked_list);

//        dump($product_attr_checked_list);
        $existing_table = $data_input_order['existing_table'];

        $data_input_order['product_attr_checked_list'] = $product_attr_checked_list;
        $data_input_order['attribute_value_id_tree'] = "+";
        $data_input_order['product_info_json'] = array();
        $data_input_order['product_full_info_json'] = array();

        //To get all columns value
        $column_name = $this->db->list_fields('ec_products');
        foreach ($column_name as $column_name_row) {

            $data_input_order['product_full_info_json'][] = $this->common_model->GetOrderProductValueFromCommonInputs($column_name_row, $data_input_order);
        }

        foreach ($column_checked_list as $column_checked_key =>
                    $column_checked_row) {

            $data_input_order['product_info_json'][] = $this->common_model->GetOrderProductValueFromCommonInputs($column_checked_row, $data_input_order);
        }
        foreach ($product_attr_checked_list as $product_attr_checked_key =>
                    $product_attr_checked_row) {

            $attribute_value_id = $existing_table->$product_attr_checked_row;
            $data_input_order['attribute_value_id_tree'] = $data_input_order['attribute_value_id_tree'] . $attribute_value_id . "+";
        }

        return $data_output_order = array(
            "product_full_info_json" => $data_input_order['product_full_info_json'],
            "product_order_full_info_json" => $data_input_order['product_info_json'],
            "attributes_value_id_tree" => $data_input_order['attribute_value_id_tree'],
        );
    }

    function GetOrderProductValueFromCommonInputs($prod_col_name, $data) {
        ini_set('max_execution_time', 0);
        $existing_table = $data['existing_table'];
        $option = $data['option'];
        $product_attr_checked_list = $data['product_attr_checked_list'];


        $product_field = json_decode($option->product_field, TRUE);
        $column_name_as_label = "";
        $column_name_as_label = str_replace("_", " ", $prod_col_name);
        if ($product_field != NULL) {
            if (array_key_exists($prod_col_name, $product_field)) {

                $common_input_row = $product_field[$prod_col_name];
                $common_input_row_value_type = $common_input_row["value_type"];
                switch ($common_input_row_value_type) {
                    case "Automatic":
                        $automatic_value_item = $common_input_row["automatic_value_item"];
                        switch ($automatic_value_item) {
                            case "Category":

                                break;
                            case "Brand":

                                break;
                            case "Product Attributes":

                                $prod_category_type_attr_id = $common_input_row["prod_attr"];
                                $ec_product_attributes_id = $existing_table->$prod_col_name;
                                $ec_product_attributes_row = $this->common_model->getFieldNameProductAttributesByTypeById($prod_category_type_attr_id, $ec_product_attributes_id);
                                if ($ec_product_attributes_row != NULL) {
                                    $ec_product_attributes_row_fieldname = $ec_product_attributes_row->fieldname;
                                } else {
                                    $ec_product_attributes_row_fieldname = "";
                                }

                                return array(
                                    "ref_table_name" => 'ec_product_attributes',
                                    "ref_column_name" => 'fieldname',
                                    "ref_value" => $existing_table->$prod_col_name,
                                    "table_name" => 'ec_products',
                                    "column_name" => $prod_col_name,
                                    "value" => $ec_product_attributes_row_fieldname,
                                    "common_input_id" => $common_input_row["id"],
                                    "common_input_field_label" => $common_input_row["field_label"],
                                    "type" => "common_input_attribute",
                                );

                                break;
                            default:
                                break;
                        }



                        break;
                    case "Query":


                        break;
                    case "Fixed":


                        break;
                    case "Manual":
                    default:
                        return array(
                            "table_name" => 'ec_products',
                            "column_name" => $prod_col_name,
                            "value" => $existing_table->$prod_col_name,
                            "common_input_id" => $common_input_row["id"],
                            "common_input_field_label" => $common_input_row["field_label"],
                            "type" => "common_input_normal",
                        );
                        break;
                }
            } else {
                return array(
                    "table_name" => 'ec_products',
                    "column_name" => $prod_col_name,
                    "value" => $existing_table->$prod_col_name,
                    "common_input_id" => '',
                    "common_input_field_label" => $column_name_as_label,
                    "type" => "normal",
                );
            }
        } else {
            return array(
                "table_name" => 'ec_products',
                "column_name" => $prod_col_name,
                "value" => $existing_table->$prod_col_name,
                "common_input_id" => '',
                "common_input_field_label" => $column_name_as_label,
                "type" => "normal",
            );
        }
    }

    function GetAllCommonInputs() {

        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('field_label', "ASC");
        return $this->db->get('cms_commoninputs')->result();
    }

    function GetAllCommonInputsArray() {

        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->where_in('id', $this->common_model->discount_columns_commoninputid);
        $this->db->order_by('field_label', "ASC");
        return $this->db->get('cms_commoninputs')->result_array();
    }

    function GetCommonInputsFromFormValue($common_input_id, $address_array) {

        $commoninputs_row = $this->common_model->GetByRow('cms_commoninputs', $common_input_id, 'id');

        if (array_key_exists($commoninputs_row->name, $address_array)) {
            $payment_value = $address_array[$commoninputs_row->name];
        } else {
            $payment_value = "";
        }


        return $payment_value;
    }

    function GetValueExistsFromArray($value, $array) {


        if (array_key_exists($value, $array)) {
            $payment_value = $array[$value];
        } else {
            $payment_value = "";
        }


        return $payment_value;
    }

    function GetFromCategoryByResultByTypeIdAsKeyandLabel($order_column, $order_type,$typeid,$level = NULL) {
        $this->db->select("id as 'key', category as 'label' ");
        $this->db->order_by($order_column, $order_type);
        $this->db->where('trash_status', 'no');
        $this->db->where('ctype', $typeid);
        $this->db->where('active_status', 'a');
        if($level!=NULL){
           $this->db->where('parent_id', $level); 
        }
        return $result = $this->db->get('ec_category')->result();
    }



    function GetFilterInputValueArray($common_input_element_row,
            $parameter_array) {

        if (isset($parameter_array["category_type_id"])) {
            $category_type_id = $parameter_array["category_type_id"];
        } else {
            $category_type_id = 0;
        }

        switch ($common_input_element_row["name"]) {

            case "fmcatval":
                // Common Table Data Start
                $table_condition_array = array();
                $table_condition_array[] = array(
                    "condition_clause" => "where",
                    "condition_string" => "parent_id",
                    "condition_value" => 0,
                    "condition_option" => "",
                );
                $table_condition_array[] = array(
                    "condition_clause" => "where",
                    "condition_string" => "ctype",
                    "condition_value" => $category_type_id,
                    "condition_option" => "",
                );
                $table_condition_array[] = array(
                    "condition_clause" => "where",
                    "condition_string" => "trash_status",
                    "condition_value" => "no",
                    "condition_option" => "",
                );
                $table_condition_array[] = array(
                    "condition_clause" => "where",
                    "condition_string" => "active_status",
                    "condition_value" => "a",
                    "condition_option" => "",
                );
                $table_select_array = array(
                    "id" => "key",
                    "category" => "label"
                );

                $table_parameter_array = array(
                    "column_select" => $table_select_array,
                    "table_condition_array" => $table_condition_array,
                    "table" => "ec_category",
                    "table_return_type" => "result"
                );
                $return_array_list = $this->common_model->getCommonTableData($table_parameter_array);
                // EOF Common Table Data Start
                return $return_array_list;

                break;

            case "fscatval":
                if (isset($parameter_array["category_id"])) {
                    $category_id = $parameter_array["category_id"];
                } else {
                    $category_id = 0;
                }
                // Common Table Data Start
                $table_condition_array = array();
                $table_condition_array[] = array(
                    "condition_clause" => "where",
                    "condition_string" => "parent_id",
                    "condition_value" => $category_id,
                    "condition_option" => "",
                );
                $table_condition_array[] = array(
                    "condition_clause" => "where",
                    "condition_string" => "ctype",
                    "condition_value" => $category_type_id,
                    "condition_option" => "",
                );
                $table_condition_array[] = array(
                    "condition_clause" => "where",
                    "condition_string" => "trash_status",
                    "condition_value" => "no",
                    "condition_option" => "",
                );
                $table_condition_array[] = array(
                    "condition_clause" => "where",
                    "condition_string" => "active_status",
                    "condition_value" => "a",
                    "condition_option" => "",
                );
                $table_select_array = array(
                    "id" => "key",
                    "category" => "label"
                );

                $table_parameter_array = array(
                    "column_select" => $table_select_array,
                    "table_condition_array" => $table_condition_array,
                    "table" => "ec_category",
                    "table_return_type" => "result"
                );
                $return_array_list = $this->common_model->getCommonTableData($table_parameter_array);
                // EOF Common Table Data Start
                return $return_array_list;

                break;

            case "fcatval":
                $return_array_list = "";
                return $return_array_list;
                break;

            default:

                $return_array_list = $this->common_model->GetAttributeResultValuesFromCommonInput($common_input_element_row);

                return $return_array_list;
                break;
        }
    }

    function GetAttributeResultValuesFromCommonInput($common_input_element_row) {

        $option = $this->common_model->option;
        $common_input_full_array = json_decode($option->common_input_full_array, TRUE);

        $common_col_id = $common_input_element_row["id"];
        if ($common_input_full_array != NULL) {
            if (array_key_exists($common_col_id, $common_input_full_array)) {

                $common_input_row = $common_input_full_array[$common_col_id];
                $common_input_row_value_type = $common_input_row["value_type"];
                switch ($common_input_row_value_type) {
                    case "Automatic":
                        $automatic_value_item = $common_input_row["automatic_value_item"];
                        switch ($automatic_value_item) {
                            case "Category":
                                switch ($common_input_row["auto_level"]) {
                                    case 'level1':
                                $new_array_list =  $this->common_model->GetFromCategoryByResultByTypeIdAsKeyandLabel('category','asc',1,0);
                                return $new_array_list;

                                        break;

                                    default:
                                           $new_array_list =  $this->common_model->GetFromCategoryByResultByTypeIdAsKeyandLabel('category','asc',1,NULL);
                                return $new_array_list;
                                        break;
                                }




                                break;
                            case "Brand":
                                switch ($common_input_row["auto_level"]) {
                                    case 'level1':
                                $new_array_list =  $this->common_model->GetFromCategoryByResultByTypeIdAsKeyandLabel('category','asc',2,0);
                                return $new_array_list;

                                        break;

                                    default:
                                           $new_array_list =  $this->common_model->GetFromCategoryByResultByTypeIdAsKeyandLabel('category','asc',2,NULL);
                                return $new_array_list;
                                        break;
                                }
                                break;
                            case "Product Attributes":

                                $prod_category_type_attr_id = $common_input_row["prod_attr"];

                                // Common Table Data Start
                                $table_condition_array = array();
                                $table_condition_array[] = array(
                                    "condition_clause" => "where",
                                    "condition_string" => "type",
                                    "condition_value" => $prod_category_type_attr_id,
                                    "condition_option" => "",
                                );
                                $table_condition_array[] = array(
                                    "condition_clause" => "where",
                                    "condition_string" => "trash_status",
                                    "condition_value" => "no",
                                    "condition_option" => "",
                                );
                                $table_condition_array[] = array(
                                    "condition_clause" => "where",
                                    "condition_string" => "active_status",
                                    "condition_value" => "a",
                                    "condition_option" => "",
                                );
                                $table_select_array = array(
                                    "id" => "key",
                                    "fieldname" => "label"
                                );

                                $table_parameter_array = array(
                                    "column_select" => $table_select_array,
                                    "table_condition_array" => $table_condition_array,
                                    "table" => "ec_product_attributes",
                                    "table_return_type" => "result"
                                );
                                $return_array_list = $this->common_model->getCommonTableData($table_parameter_array);
                                // EOF Common Table Data Start
                                return $return_array_list;








//                                $ec_product_attributes_result = $this->common_model->getFieldNameProductAttributesByType($prod_category_type_attr_id);
//                                $new_array_list = array();
//                                foreach ($ec_product_attributes_result as $ec_product_attributes_result_key => $ec_product_attributes_row) {
//                                    $new_array_list[] = array(
//                                        "key" => $ec_product_attributes_row->id,
//                                        "label" => $ec_product_attributes_row->fieldname,
//                                    );
//                                }
//
//                                return $new_array_list;

                                break;
                            default:
                                break;
                        }



                        break;
                    case "Query":


                        break;
                    case "Fixed":


                        break;
                    case "Manual":
                        $new_array_list = json_decode($common_input_element_row["value_list"]);
                        return $new_array_list;
                        break;
                    default:
                        $new_array_list = json_decode($common_input_element_row["value_list"]);
                        return $new_array_list;
                        break;
                }
            } else {
                $new_array_list = array();
                return $new_array_list;
            }
        } else {
            $new_array_list = array();
            return $new_array_list;
        }
    }

    function getFieldNameProductAttributesByType($prod_category_type_attr_id) {

        $this->db->where('type', $prod_category_type_attr_id);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $result = $this->db->get('ec_product_attributes')->result();
    }

    function GetPaymentMethodFormArray($ec_orders_id, $payment_method_id) {

        //{oldoption}
        //$data['options'] = $this->common_model->get_options();
        //$data['option'] = $data['options'][0];
        //{oldoption}

        $data['option'] = $this->option;

        $payment_method_row = $this->common_model->GetByRow('ec_payment_method', $payment_method_id, 'id');
        $ec_orders_row = $this->common_model->GetByRow('ec_orders', $ec_orders_id, 'id');
//dump($ec_orders_row);

        $billing_address = json_decode($ec_orders_row->billing_address, TRUE);
        $shipping_address = json_decode($ec_orders_row->shipping_address, TRUE);


        $payment_type = $payment_method_row->payment_type;
        $payment_url_data = json_decode($payment_method_row->payment_url_data, TRUE);
        $payment_form_data = json_decode($payment_method_row->payment_formdata, TRUE);
        $payment_full_form_data = array();


        //dump($payment_form_data);



        /*         * ******Customized Payment Array************* */
        /* $customized_payment_array = array(

          //'tid' => $transactionIDval,
          'tid' => 'tid123456',

          'order_id' => $Order_Id,
          'amount' => $Amount,
          'currency' => $currency,

          'merchant_param1' => '',
          'merchant_param2' => '',
          'merchant_param3' => '',
          'merchant_param4' => '',
          'merchant_param5' => '',
          'promo_code' => '',
          'customer_identifier' => ''


          ); */

//encode numbers		  
        $logged_userid = $this->common_model->logged_user_data->id;
        $ec_orders_id_encrypt = $this->common_model->encode_id($ec_orders_id, $logged_userid);
//encode numbers



        $transactionIDval = rand(1, 10000);
        $transactionIDval = $ec_orders_id . '-' . $transactionIDval;
        $Redirect_Url = base_url() . 'payment-response/' . $ec_orders_id_encrypt;

        $Redirect_Url_s = base_url() . 'payment-response/' . $ec_orders_id_encrypt . '/success';
        $Redirect_Url_f = base_url() . 'payment-response/' . $ec_orders_id_encrypt . '/error';
        $Redirect_Url_c = base_url() . 'payment-response/' . $ec_orders_id_encrypt . '/cancel';


        $amount_value = $ec_orders_row->amount * 100;

        $customized_payment_array = array(
            //CCavenue
            'tid' => $transactionIDval,
            'order_id' => $data['option']->tmp_order_string . $ec_orders_id,
            'amount' => $ec_orders_row->amount,
            'currency' => 'INR',
            'redirect_url' => $Redirect_Url,
            'cancel_url' => $Redirect_Url,
            'merchant_param1' => '',
            'merchant_param2' => '',
            'merchant_param3' => '',
            'merchant_param4' => '',
            'merchant_param5' => '',
            'promo_code' => '',
            'customer_identifier' => '',
            //CCavenue
            
            'txnid' => $transactionIDval,
            'surl' => $Redirect_Url_s,
            'furl' => $Redirect_Url_f,
			
			
            'merchantOrderReference' => $transactionIDval,
            'merchantAttributes.redirectUrl' => $Redirect_Url,
            'merchantAttributes.cancelUrl' => $Redirect_Url_c,
            'amount.value' => $amount_value,
			
			'tij_MerchReturnUrl' =>$Redirect_Url,
			'tij_MerchantPaymentTrack' =>uniqid(),
			'tij_MerchantPaymentAmount' =>$ec_orders_row->amount,
                
        );


        /*         * *****EOL Customized Payment Array************** */



        /*         * ******

          Predefined Array from form values from respective Payment Method


         * ************ */
        //dump($payment_form_data);
        foreach ($payment_form_data as $payment_form_data_row_value) {

//if($payment_form_data_row_value["p_key"] != ""){

            switch ($payment_form_data_row_value["address_type"]) {
                case 'delivery_address':
                    $payment_value = $this->common_model->GetCommonInputsFromFormValue($payment_form_data_row_value["common_input_id"], $shipping_address);

                case 'billing_address':
                    $payment_value = $this->common_model->GetCommonInputsFromFormValue($payment_form_data_row_value["common_input_id"], $billing_address);

                    break;
                case 'no_address':


                    if ($payment_form_data_row_value["p_value"] == '') {
                        $payment_value = $this->common_model->GetValueExistsFromArray($payment_form_data_row_value["p_key"], $customized_payment_array);
                    } else {
                        $payment_value = $payment_form_data_row_value["p_value"];
                    }
                    break;

                default:
                    break;
            }

            switch ($payment_form_data_row_value["p_key"]) {
                case 'billing_state':
                case 'billing_country':
                case 'delivery_state':
                case 'delivery_country':
                case 'billing_cust_state':
                case 'billing_cust_country':
                case 'delivery_cust_state':
                case 'delivery_cust_country':

                    $payment_value = trim($payment_value);

                    if (is_numeric($payment_value)) {
                        $cms_locations = $this->common_model->GetByRow('cms_locations', $payment_value, 'id');
                        $payment_value = $cms_locations->location;
                    } else {
                        $payment_value = $payment_value;
                    }



                    break;

                default:
                    break;
            }

            $payment_full_form_data[] = array(
                'key' => $payment_form_data_row_value["p_key"],
                'value' => $payment_value,
            );
            //}
        }

        /*         * ******
          EOC
          Predefined Array from form values from respective Payment Method
         * ************ */



        $payment_gateway_info = array(
            "payment_url" => $payment_url_data['payment_url'],
            "attributes" => $payment_full_form_data,
        );
        return $payment_gateway_info;
    }

//ccavenue

    /*    function encrypt($plainText, $key) {

      $secretKey = $this->hextobin(md5($key));

      $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);

      $openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');

      $blockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');

      $plainPad = $this->pkcs5_pad($plainText, $blockSize);

      if (mcrypt_generic_init($openMode, $secretKey, $initVector) != -1) {

      $encryptedText = mcrypt_generic($openMode, $plainPad);

      mcrypt_generic_deinit($openMode);
      }

      return bin2hex($encryptedText);
      } */

    /* function decrypt($encryptedText, $key) {

      $secretKey = $this->hextobin(md5($key));

      $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);

      $encryptedText = $this->hextobin($encryptedText);

      $openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');

      mcrypt_generic_init($openMode, $secretKey, $initVector);

      $decryptedText = mdecrypt_generic($openMode, $encryptedText);

      $decryptedText = rtrim($decryptedText, "\0");

      mcrypt_generic_deinit($openMode);

      return $decryptedText;
      } */

    //*********** Padding Function *********************



    /* function pkcs5_pad($plainText, $blockSize) {

      $pad = $blockSize - (strlen($plainText) % $blockSize);

      return $plainText . str_repeat(chr($pad), $pad);
      } */

    //********** Hexadecimal to Binary function for php 4.0 version ********



    /* function hextobin($hexString) {

      $length = strlen($hexString);

      $binString = "";

      $count = 0;

      while ($count < $length) {

      $subString = substr($hexString, $count, 2);

      $packedString = pack("H*", $subString);

      if ($count == 0) {

      $binString = $packedString;
      } else {

      $binString .= $packedString;
      }



      $count += 2;
      }

      return $binString;
      } */



    //new ccavenue

    /*
     * @param1 : Plain String
     * @param2 : Working key provided by CCAvenue
     * @return : Decrypted String
     */
    function encrypt($plainText, $key) {
        $key = $this->hextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $openMode = openssl_encrypt($plainText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
        $encryptedText = bin2hex($openMode);
        return $encryptedText;
    }

    /*
     * @param1 : Encrypted String
     * @param2 : Working key provided by CCAvenue
     * @return : Plain String
     */

    function decrypt($encryptedText, $key) {
        $key = $this->hextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $encryptedText = $this->hextobin($encryptedText);
        $decryptedText = openssl_decrypt($encryptedText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
        return $decryptedText;
    }

    function hextobin($hexString) {
        $length = strlen($hexString);
        $binString = "";
        $count = 0;
        while ($count < $length) {
            $subString = substr($hexString, $count, 2);
            $packedString = pack("H*", $subString);
            if ($count == 0) {
                $binString = $packedString;
            } else {
                $binString .= $packedString;
            }

            $count += 2;
        }
        return $binString;
    }

    //new ccavenue

    function getchecksum($MerchantId, $Amount, $OrderId, $URL, $WorkingKey) {
        $str = "$MerchantId|$OrderId|$Amount|$URL|$WorkingKey";
        $adler = 1;
        $adler = $this->adler32($adler, $str);
        return $adler;
    }

    function genchecksum($str) {
        $adler = 1;
        $adler = $this->adler32($adler, $str);
        return $adler;
    }

    function verifyChecksum($getCheck, $avnChecksum) {
        $verify = false;
        if ($getCheck == $avnChecksum)
            $verify = true;
        return $verify;
    }

    function adler32($adler, $str) {
        $BASE = 65521;
        $s1 = $adler & 0xffff;
        $s2 = ($adler >> 16) & 0xffff;
        for ($i = 0; $i < strlen($str); $i++) {
            $s1 = ($s1 + Ord($str[$i])) % $BASE;
            $s2 = ($s2 + $s1) % $BASE;
        }
        return $this->leftshift($s2, 16) + $s1;
    }

    function leftshift($str, $num) {

        $str = DecBin($str);

        for ($i = 0; $i < (64 - strlen($str)); $i++)
            $str = "0" . $str;

        for ($i = 0; $i < $num; $i++) {
            $str = $str . "0";
            $str = substr($str, 1);
            //echo "str : $str <BR>";
        }
        return $this->cdec($str);
    }

    function cdec($num) {
        $dec = 0;
        for ($n = 0; $n < strlen($num); $n++) {
            $temp = $num[$n];
            $dec = $dec + $temp * pow(2, strlen($num) - $n - 1);
        }

        return $dec;
    }

//ccavenue



    function payment_status() {

        $payment_status = array(
            "1" => "payment_pending",
            "2" => "payment_confirmed",
            "3" => "payment_processed",
            "4" => "payment_declined",
            "5" => "payment_failed",
            "6" => "payment_process_aborted",
        );

        return $payment_status;
    }

    function update_newpurchase_order_id($ec_orders_id) {

//
        $this->db->select_max('order_id');
        $max_order_id = $this->db->get('ec_orders')->row();
        $new_order_id = $max_order_id->order_id + 1;

        $this->db->select_max('invoice_id');
        $max_invoice_id = $this->db->get('ec_orders')->row();
        $new_invoice_id = $max_invoice_id->invoice_id + 1;



        $tabledata = array(
            'order_id' => $new_order_id,
            'invoice_id' => $new_invoice_id,
        );


        $this->db->where('id', $ec_orders_id);
        $this->db->update('ec_orders', $tabledata);

        $this->db->where('ec_orders_id', $ec_orders_id);
        $this->db->update('ec_order_list', $tabledata);


        //To update the orderid and invoiceid in the product table
        $ec_order_list = $this->common_model->GetByRow_notrash('ec_order_list', $ec_orders_id, 'id');
        foreach ($ec_order_list as $ec_order_list_key => $ec_order_list_row) {
            if (in_array($ec_order_list_row->product_categorytype_id, $this->common_model->gift_product_categorytype_id_array)) {

                $this->db->where('id', $ec_order_list_row->product_id);
                $this->db->update('ec_products', $tabledata);
            }
        }



//	
    }

    function UpdatePurchasedProductQuantity($ec_orders_id) {

        $conditional_array = array(
            'ec_orders_id' => $ec_orders_id,
        );
        $ec_orders_product_list = $this->common_model->GetByResult_Where('ec_order_list', 'id', 'ASC', $conditional_array);
        foreach ($ec_orders_product_list as $ec_orders_product_key =>
                    $ec_orders_product_value) {

            $this->common_model->UpdateProductQty($ec_orders_product_value->product_id, $ec_orders_product_value->order_qty);
        }
    }

    function UpdateProductQty($productid, $qty_to_minus) {
        $product_detail = $this->common_model->GetByRow('ec_products', $productid, 'id');

        $product_current_qty = $product_detail->qty;

        if ($product_detail->qty > 0) {
            $new_product_qty = $product_current_qty - $qty_to_minus;

            if ($new_product_qty < 0) {
                $new_product_qty = 0;
            }
        } else {
            $new_product_qty = 0;
        }
        $table_data = array(
            'qty' => $new_product_qty
        );
        $this->db->where('id', $productid);
        $this->db->update('ec_products', $table_data);

        if ($new_product_qty == 0) {

            $this->common_model->product_qty_updation($productid, 'qty');
            $this->common_model->update_display_level($productid);
        }
    }

    function UpdateOrderStatus($ec_cart_order_status_id, $ec_orders_id = 0,
            $order_status_parameter_array = NULL) {


        if ($ec_orders_id != 0) {
            $ec_orders_row = $this->common_model->GetByRow('ec_orders', $ec_orders_id, 'id');
            $payment_data = json_decode($ec_orders_row->payment_data);
            $place_status_text = array();

            $this->common_model->UpdateOrderStatusBehaviour($ec_cart_order_status_id, $ec_orders_row->id);
        } else {
            $payment_data = array();
            $place_status_text = array();
        }


        $timeline_first_order_status = $this->common_model->GetByRow('ec_cart_order_status', $ec_cart_order_status_id, 'id');

        if (isset($order_status_parameter_array['place_reached'])) {

            $place_reached = $order_status_parameter_array['place_reached'];
        } else {
            $place_reached = '';
        }

        if (isset($order_status_parameter_array['admin_text'])) {

            $admin_text = $order_status_parameter_array['admin_text'];
        } else {
            $admin_text = '';
        }

        if (isset($order_status_parameter_array['datetime'])) {

            $datetime = $order_status_parameter_array['datetime'];
        } else {
            $datetime = date('Y-m-d H:i:s');
        }
        if (isset($order_status_parameter_array['sms'])) {

            $sms = $order_status_parameter_array['sms'];
        } else {
            $sms = 'no';
        }
        if (isset($order_status_parameter_array['smstext'])) {

            $smstext = $order_status_parameter_array['smstext'];
        } else {
            $smstext = '';
        }
        if (isset($order_status_parameter_array['smstext2'])) {

            $smstext2 = $order_status_parameter_array['smstext2'];
        } else {
            $smstext2 = '';
        }
        if (isset($order_status_parameter_array['mail'])) {

            $mail = $order_status_parameter_array['mail'];
        } else {
            $mail = 'no';
        }


        $status_id = $timeline_first_order_status->id;


        $place_status_text[] = array(
            "place_reached" => $place_reached,
            "status_textstring" => $timeline_first_order_status->message_text,
            "admin_text" => $admin_text,
            "info_sent_to" => "billing",
            "sms" => $sms,
            "sms_text" => $smstext,
            "sms_text2" => $smstext2,
            "mail" => $mail,
            "datetime" => $datetime,
        );

        $payment_data[] = array(
            "status_id" => $status_id,
            "text" => $place_status_text,
            "sms" => $sms,
            "smstext" => $smstext,
            "smstext2" => $smstext2,
            "mail" => $mail,
            "datetime" => $datetime,
        );
        $payment_data_list = json_encode($payment_data);

        if ($ec_orders_id != 0) {

            $table_data = array(
                'payment_status' => $ec_cart_order_status_id,
                'payment_data' => $payment_data_list,
            );
            $this->db->where('id', $ec_orders_row->id);
            $this->db->update('ec_orders', $table_data);

            $this->db->where('ec_orders_id', $ec_orders_row->id);
            $this->db->update('ec_order_list', $table_data);
        }

        $this->common_model->GetProductOrderCount($ec_orders_id);


        if ($ec_orders_id != 0) {

            switch ($ec_cart_order_status_id) {
                case '3':
                    $this->common_model->UpdateOrderStatus('7', $ec_orders_id);

                    break;
                case '4':

                    $this->common_model->UpdateOrderStatus('8', $ec_orders_id);

                    break;
                case '5':
                    $this->common_model->UpdateOrderStatus('9', $ec_orders_id);

                    break;
                case '6':

                    $this->common_model->UpdateOrderStatus('10', $ec_orders_id);

                    break;

                default:
                    break;
            }
        } else {

            return $payment_data_list;
        }
    }

    function GetSpecifiedAddressInSpecifiedFormat($address_json,
            $seperator = '<br/>') {
        $address_array = json_decode($address_json, TRUE);
        if ($address_array != NULL) {

            if (array_key_exists('frm_title', $address_array) && $address_array['frm_title'] != '') {

                $frm_title = $address_array['frm_title'];
            } else {
                $frm_title = "";
            }
            if (array_key_exists('frm_first_name', $address_array) && $address_array['frm_first_name'] != '') {

                $frm_first_name = $address_array['frm_first_name'];
            } else {

                $frm_first_name = "";
            }
            if (array_key_exists('frm_last_name', $address_array) && $address_array['frm_last_name'] != '') {

                $frm_last_name = $address_array['frm_last_name'];
            } else {
                $frm_last_name = "";
            }
            if (array_key_exists('frm_address', $address_array) && $address_array['frm_address'] != '') {

                $frm_address = ', ' . $address_array['frm_address'];
            } else {
                $frm_address = "";
            }
            if (array_key_exists('frm_locality', $address_array) && $address_array['frm_locality'] != '') {

                $frm_locality = $address_array['frm_locality'];
            } else {
                $frm_locality = "";
            }
            if (array_key_exists('frm_landmark', $address_array) && $address_array['frm_landmark'] != '') {

                $frm_landmark = ', ' . $address_array['frm_landmark'];
            } else {
                $frm_landmark = "";
            }
            if (array_key_exists('frm_city', $address_array) && $address_array['frm_city'] != '') {

                //$frm_city = ', ' . $address_array['frm_city'];
				
				$frm_city = $address_array['frm_city'];
				
				$frm_city = trim($frm_city);
				
				if (is_numeric($frm_city)) {
				$city_id = $frm_city;
				$city_row = $this->common_model->GetByRow('cms_locations', $city_id, 'id');
				$frm_city = $city_row->location;
				}
				
				$frm_city = ', ' . $frm_city;
				
            } else {

                $frm_city = "";
            }
            if (array_key_exists('frm_state', $address_array) && $address_array['frm_state'] != '') {

                $frm_state = $address_array['frm_state'];

                $frm_state = trim($frm_state);

                if (is_numeric($frm_state)) {
                    $cms_locations = $this->common_model->GetByRow('cms_locations', $frm_state, 'id');
                    $frm_state = $cms_locations->location;
                } else {
                    $frm_state = $frm_state;
                }
                $frm_state = ', ' . $frm_state;
            } else {

                $frm_state = "";
            }
            if (array_key_exists('frm_country', $address_array) && $address_array['frm_country'] != '') {

                $frm_country = $address_array['frm_country'];

                $frm_country = trim($frm_country);

                if (is_numeric($frm_country)) {
                    $cms_locations = $this->common_model->GetByRow('cms_locations', $frm_country, 'id');
                    $frm_country = $cms_locations->location;
                } else {
                    $frm_country = $frm_country;
                }
                $frm_country = ', ' . $frm_country;
            } else {
                $frm_country = "";
            }
            if (array_key_exists('frm_pincode', $address_array) && $address_array['frm_pincode'] != '') {

                $frm_pincode = ' - ' . $address_array['frm_pincode'];
            } else {

                $frm_pincode = "";
            }
            if (array_key_exists('frm_email', $address_array) && $address_array['frm_email'] != '') {

                $frm_email = $address_array['frm_email'];
            } else {

                $frm_email = "";
            }
            if (array_key_exists('frm_phoneno', $address_array) && $address_array['frm_phoneno'] != '') {

                $frm_phoneno = $address_array['frm_phoneno'];
            } else {

                $frm_phoneno = "";
            }
            if (array_key_exists('frm_alt_phone', $address_array) && $address_array['frm_alt_phone'] != '') {

                $frm_alt_phone = ', ' . $address_array['frm_alt_phone'];
            } else {
                $frm_alt_phone = "";
            }
            if (array_key_exists('frm_delivery_type', $address_array) && $address_array['frm_delivery_type'] != '') {

                $frm_delivery_type = $address_array['frm_delivery_type'];
            } else {
                $frm_delivery_type = "";
            }
        }




        $address_string = strtoupper($frm_first_name . ' ' . $frm_last_name) . $seperator .
                $frm_locality . $frm_address . $frm_landmark . $frm_city . $frm_state . $seperator .
                $frm_country . $frm_pincode . $seperator .
                $frm_phoneno . $frm_alt_phone . $seperator .
                $frm_email;
        return $address_string;
    }

    function clean_text($string) {
        $string = trim($string);
        $string = str_replace(" ", "", $string);
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
        $string = preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
        $string = strtolower($string);
        return $string;
    }

    function SendOrderSms($ec_cart_order_status_id, $ec_orders_row) {

        //{oldoption}
        //$data['options'] = $this->common_model->get_options();
        //$data['option'] = $data['options'][0];
        //{oldoption}

        $data['option'] = $this->option;

        //$order_id = $data['option']->org_order_string . $ec_orders_row->order_id;
		//sbn orderid
		$order_id = $this->common_model->format_order_number($ec_orders_row->order_id,$ec_orders_row->id);
		//sbn orderid
//        $purchase_date = date('d-m-Y H:i:s a', strtotime($ec_orders_row->purchase_date));

        $admin_number = ""; // make this dynamic
//        $text_user_name = $this->common_model->clean_text($billing_address["frm_first_name"]);
        $text_message = "";
        $admin_message = "";

        if ($ec_cart_order_status_id == "3" || $ec_cart_order_status_id == "7") {

            $sms_array = $this->common_model->ordersmstext_bystatus($ec_orders_row->id, $ec_cart_order_status_id);

            $text_message = $sms_array['customer_sms'];
            $text_message = str_replace('{OrderId}', $order_id, $text_message);

            $admin_message = $sms_array['admin_sms'];
            $admin_message = str_replace('{OrderId}', $order_id, $admin_message);
        }


        //update to json sms

        $payment_data_array = json_decode($ec_orders_row->payment_data, TRUE);
        $payment_data_array_key = array_search($ec_cart_order_status_id, array_column($payment_data_array, 'status_id'));
        if ($payment_data_array_key !== FALSE) {

            $payment_data_array[$payment_data_array_key]["text"][0]["info_sent_to"] = "billing";
            $payment_data_array[$payment_data_array_key]["text"][0]["sms"] = "yes";
            $payment_data_array[$payment_data_array_key]["text"][0]["sms_text"] = $text_message;
            $payment_data_array[$payment_data_array_key]["text"][0]["sms_text2"] = $admin_message;
            $payment_data_array[$payment_data_array_key]["text"][0]["email"] = "yes";
            $payment_data_array[$payment_data_array_key]["smstext"] = $text_message;
            $payment_data_array[$payment_data_array_key]["smstext2"] = $admin_message;
        }

        $payment_data_list = json_encode($payment_data_array);
        $table_data = array(
            'payment_data' => $payment_data_list,
        );
        $this->db->where('id', $ec_orders_row->id);
        $this->db->update('ec_orders', $table_data);

        $ec_orders_row = $this->common_model->GetByRow('ec_orders', $ec_orders_row->id, 'id');
        $sending_address = $this->common_model->GetInfoSentToAddress($ec_orders_row, $ec_cart_order_status_id);
        if ($sending_address !== FALSE) {

            $sending_address_json = json_decode($sending_address, TRUE);
            $sending_address_phone_number = $sending_address_json["frm_phoneno"];

            $this->common_model->send_sms($sending_address_phone_number, $text_message);
            $this->common_model->send_sms($admin_number, $admin_message);
        }
    }

    function send_sms($receiver, $content) {

//type 1
/* echo "<script>sendsmsapi('$content','$receiver');</script>";*/
//type 1


/*//type 2
//Please Enter Your Details
$user=""; //your username
$password=""; //your password
$mobilenumbers=$receiver; //enter Mobile numbers comma seperated
$message = $content; //enter Your Message
$senderid=""; //Your senderid
$messagetype="N"; //Type Of Your Message
$DReports="Y"; //Delivery Reports
$url="http://www.smscountry.com/SMSCwebservice_Bulk.aspx";
$message = urlencode($message);
$ch = curl_init();
if (!$ch){die("Couldn't initialize a cURL handle");}
$ret = curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt ($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt ($ch, CURLOPT_POSTFIELDS,
"User=$user&passwd=$password&mobilenumber=$mobilenumbers&message=$message&sid=$senderid&mtype=$messagetype&DR=$DReports");
$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//If you are behind proxy then please uncomment below line and provide your proxy ip with port.
// $ret = curl_setopt($ch, CURLOPT_PROXY, "PROXY IP ADDRESS:PORT");
$curlresponse = curl_exec($ch); // execute
if(curl_errno($ch))
echo 'curl error : '. curl_error($ch);
if (empty($ret)) {
// some kind of an error happened
die(curl_error($ch));
curl_close($ch); // close cURL handler
} else {
$info = curl_getinfo($ch);
curl_close($ch); // close cURL handler
echo $curlresponse; //echo "Message Sent Succesfully" ;
}
//type 2*/
	
	
    }

    function SendOrderMail($ec_cart_order_status_id, $ec_orders_id) {

        $this->common_model->successMail($ec_orders_id);
    }

    function product_qty_updation($productid, $type) {

        $prod_details = $this->common_model->GetByRow_notrash('ec_products', $productid, 'id');

        $availability1 = $prod_details->availability;
        $active_status1 = $prod_details->active_status;
        $qty1 = $prod_details->qty;


        if ($type == 'status') {
            if ($availability1 == 'in_stock' && $active_status1 == 'a') {

                $qty = $qty1;
                $availability = 'in_stock';
                $active_status = 'a';
            } else {
                $availability = 'out_of_stock';
                $qty = 0;
                $active_status = 'd';
            }
        } else if ($type == 'qty') {
            if ($qty1 <= 0) {

                $availability = 'out_of_stock';
                $qty = 0;
                $active_status = 'd';
            } else if ($qty1 > 0) {

                $availability = 'in_stock';
                $qty = $qty1;
                $active_status = 'a';
            }
        }




        $data1 = array(
            'availability' => $availability,
            'active_status' => $active_status,
            'qty' => $qty);

        $this->db->where('id', $prod_details->id);
        $this->db->update('ec_products', $data1);

        return true;
    }

    function ProductCalculation($productid) {

        ini_set('max_execution_time', 0);

        $product_detail = $this->common_model->GetByRow_notrash('ec_products', $productid, 'id');

        $qty = 0;
        $availability = 'out_of_stock';
        $active_status = 'd';
        $product_status_out_of_stock = $product_status_offer = $product_status_live = 'out_of_stock';
        $product_status_id_out_of_stock = $product_status_id_offer = $product_status_id_live = '105';

        if ($product_detail->qty > 0) {
//            $qty = $product_detail->qty;
//            $availability = 'in_stock';
//            $active_status = 'a';

            $product_status_live = 'live';
            $product_status_offer = 'offer';
            $product_status_out_of_stock = 'out_of_stock';
            $product_status_id_live = '104';
            $product_status_id_offer = '103';
            $product_status_id_out_of_stock = '105';
        }

//        'availability' => $availability,
//        'active_status' => $active_status,
//        'qty' => $qty


        $data = array();

        if ($product_detail->discounttype == 102) { //  no offer
            $data = array(
                'selling_price' => $product_detail->original_price,
                'product_status' => $product_status_live,
                'product_status_id' => $product_status_id_live,
//                'availability' => $availability,
//                'active_status' => $active_status,
//                'qty' => $qty
            );
        } elseif ($product_detail->discounttype == 99) { // extended offer
            $offer_after_live = $product_detail->offer_after_live;
            $offer_after_out_of_stock = $product_detail->offer_after_out_of_stock;

            $live_start_date = $product_detail->live_start_date;
            if (!empty($product_detail->live_start_date)) {
                $live_start_date = $product_detail->date_created;
            }

            $offer_after_live_date = date('Y-m-d', strtotime($live_start_date . ' + ' . $offer_after_live . ' days'));
            $offer_after_out_of_stock_date = date('Y-m-d', strtotime($offer_after_live_date . ' + ' . $offer_after_out_of_stock . ' days'));

            $data = array(
                'live_end_date' => $offer_after_live_date,
                'offer_start_date' => $offer_after_live_date,
                'offer_end_date' => $offer_after_out_of_stock_date,
                'out_of_stock_date' => $offer_after_out_of_stock_date,
                'selling_price' => $product_detail->original_price,
                'product_status' => $product_status_live,
                'product_status_id' => $product_status_id_live,
//                'availability' => $availability,
//                'active_status' => $active_status,
//                'qty' => $qty
            );
        } elseif ($product_detail->discounttype == 62) { // normal
            $discount = $product_detail->discount;
            $product_prize = $product_detail->selling_price;
            $actual_price = $product_detail->original_price;
            $sub_total = $product_detail->sub_total;
            $discounttype = $product_detail->discounttype;
            $discountby = $product_detail->discountby;
//            $discount_column = $product_detail->discount_column;

            $sub_total = $actual_price;

            $discount_amount = 0;
            if ($discounttype == '62') {

                if ($discountby == '64') {

                    $discount_amount = ($discount / 100) * $sub_total;
                } else if ($discountby == '65') {

                    $discount_amount = $discount;
                }
            }

            $actual_price = round($sub_total);
            $product_prize = $sub_total - $discount_amount;

            $product_prize = round($product_prize);

            $data = array(
                'selling_price' => $product_prize,
                'original_price' => $actual_price,
                'sub_total' => $sub_total,
                'product_status' => $product_status_offer,
                'product_status_id' => $product_status_id_offer,
//                'availability' => $availability,
//                'active_status' => $active_status,
//                'qty' => $qty
            );
        }

        if (!empty($data)) {
            $this->db->where('id', $productid);
            $this->db->update('ec_products', $data);
        }
    }

    function selling_prize_calc($discountby, $discount, $sub_total) {
        $discounttype = '62';
        $discount_amount = 0;
//            if ($discounttype == '62') {
        if ($discountby == '64') {

            $discount_amount = ($discount / 100) * $sub_total;
        } else if ($discountby == '65') {

            $discount_amount = $discount;
        }
//            }
        $selling_prize = $sub_total - $discount_amount;
        $selling_prize = round($selling_prize);

        return $selling_prize;
    }

    function ProductCalculation_old($productid) {
		
		
		}

    function assign_rand_value($num) {

        // accepts 1 - 36
        switch ($num) {
            case "1" : $rand_value = "a";
                break;
            case "2" : $rand_value = "b";
                break;
            case "3" : $rand_value = "c";
                break;
            case "4" : $rand_value = "d";
                break;
            case "5" : $rand_value = "e";
                break;
            case "6" : $rand_value = "f";
                break;
            case "7" : $rand_value = "g";
                break;
            case "8" : $rand_value = "h";
                break;
            case "9" : $rand_value = "i";
                break;
            case "10" : $rand_value = "j";
                break;
            case "11" : $rand_value = "k";
                break;
            case "12" : $rand_value = "l";
                break;
            case "13" : $rand_value = "m";
                break;
            case "14" : $rand_value = "n";
                break;
            case "15" : $rand_value = "o";
                break;
            case "16" : $rand_value = "p";
                break;
            case "17" : $rand_value = "q";
                break;
            case "18" : $rand_value = "r";
                break;
            case "19" : $rand_value = "s";
                break;
            case "20" : $rand_value = "t";
                break;
            case "21" : $rand_value = "u";
                break;
            case "22" : $rand_value = "v";
                break;
            case "23" : $rand_value = "w";
                break;
            case "24" : $rand_value = "x";
                break;
            case "25" : $rand_value = "y";
                break;
            case "26" : $rand_value = "z";
                break;
            case "27" : $rand_value = "0";
                break;
            case "28" : $rand_value = "1";
                break;
            case "29" : $rand_value = "2";
                break;
            case "30" : $rand_value = "3";
                break;
            case "31" : $rand_value = "4";
                break;
            case "32" : $rand_value = "5";
                break;
            case "33" : $rand_value = "6";
                break;
            case "34" : $rand_value = "7";
                break;
            case "35" : $rand_value = "8";
                break;
            case "36" : $rand_value = "9";
                break;
        }
        return $rand_value;
    }

    function get_rand_alphanumeric($length) {
        if ($length > 0) {
            $rand_id = "";
            for ($i = 1; $i <= $length; $i++) {
                mt_srand((double) microtime() * 1000000);
                $num = mt_rand(1, 36);
                $rand_id .= $this->assign_rand_value($num);
            }
        }
        return $rand_id;
    }

    function get_rand_numbers($length) {
        if ($length > 0) {
            $rand_id = "";
            for ($i = 1; $i <= $length; $i++) {
                mt_srand((double) microtime() * 1000000);
                $num = mt_rand(27, 36);
                $rand_id .= $this->assign_rand_value($num);
            }
        }
        return $rand_id;
    }

    function get_rand_letters($length) {
        if ($length > 0) {
            $rand_id = "";
            for ($i = 1; $i <= $length; $i++) {
                mt_srand((double) microtime() * 1000000);
                $num = mt_rand(1, 26);
                $rand_id .= $this->assign_rand_value($num);
            }
        }
        return $rand_id;
    }

    //    get the id tree of parent and children
    function pass_tree_values($catid_val, $c_id, $table, $typecheck) {
        ini_set('max_execution_time', 0);

        $parent_cat_result = $this->common_model->get_first_parent($catid_val, $table);
        $current_field = $this->common_model->GetByRow_noactive($table, $c_id, 'id');
//        dump($current_field);
//echo $current_field->parent_id;
//die();
        if ($current_field->parent_id == 0 || $typecheck != 'category') {
            $current_ids = '';
            $current_names = '';
            $current_slugs = '';
            $current_full = '';
        } else {
            $current_ids = '+' . $current_field->id;
            $current_names = '+';
            $current_slugs = '+';
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

    function get_first_parent($cid, $table) {
        ini_set('max_execution_time', 0);
        $j = '';
        $i = $cid;
        $catids = '';
        $catnames = '';
        $catslugs = '';
        $catfull = '';
        while ($i > 0) {
            $this->db->where('id', $i);
            $category = $this->db->get($table)->row();
            $i = $category->parent_id;

            $catids .= $category->id . '+';
            $catnames .= '' . '+';
            $catslugs .= '' . '+';

            $catfull .= $category->id . '__' . '' . '__' . '' . '+';

            if ($i > 0) {
                $j = $category->parent_id . '**' . '' . '**' . '';

                $catids .= $category->parent_id . '+';
                $catnames .= '' . '+';
                $catslugs .= '' . '+';

                $catfull .= $category->id . '__' . '' . '__' . '' . '+';
            } else
            if ($i == '0') {
                $j = $category->id . '**' . '' . '**' . '';

                $catids .= $category->id . '+';
                $catnames .= '' . '+';
                $catslugs .= '' . '+';

                $catfull .= $category->id . '__' . '' . '__' . '' . '+';
            }
        }

        $alldata = $catids . '**' . $catnames . '**' . $catslugs . '**' . $catfull;
        return $j . '___' . $alldata;
    }

    function GetByResultActive($table, $order_column, $order_type) {

        $this->db->order_by($order_column, $order_type);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $result = $this->db->get($table)->result();
    }

    function GetByRow_noactive($table, $eventid, $field) {

        $this->db->where(array(
            $field => $eventid));
        $this->db->where('trash_status', 'no');
        return $result = $this->db->get($table)->row();
    }

    /*
     * order detail
     */

    public function getFeatureSrcAltTitleSingleImage($image_column, $image_size,
            $image_position) {
        /* For using the single image with image position from  image column of json array string   
         * parameters  of $image_array,
         * image size* */

        $image_array = json_decode($image_column, TRUE);
        $image_src = 'src="' . base_url() . 'media_library/' . $image_size . $image_array[$image_position]["image"] . '"';
        $image_detail = $this->common_model->GetByRow_notrash('cms_media', $image_array[$image_position]['media_id'], 'id');
        $seo_image = json_decode($image_detail->images, TRUE);
        $image_alt = 'alt="' . $seo_image[0]["seo_alt"] . '"';
        $image_title = 'title="' . $seo_image[0]["seo_title"] . '"';
        $image_string = $image_src . " " . $image_alt . " " . $image_title;
        echo $image_string;
    }

    public function my_order_list($orderid) {


        $this->db->select('*');
        $this->db->where('ec_orders_id', $orderid);
        $this->db->order_by('purchase_date', 'desc');
        $query = $this->db->get('ec_order_list');
        return $query->result();
    }

    public function getProductDefaultImage($image_column, $image_size) {
        /* For using the single image with image position from  image column of json array string   
         * parameters  of $image_array,
         * image size* */


        $image_array = json_decode($image_column, TRUE);
        $image_detail = $this->common_model->GetByRow_notrash('cms_media', $image_array['media_id'], 'id');
        if ($image_detail != NULL) {

            $seo_image = json_decode($image_detail->images, TRUE);

            if ($seo_image['image'] != "" && file_exists('media_library/' . $image_size . $seo_image['image']) == 1) {
                $image_src = 'src="' . base_url() . 'media_library/' . $image_size . $seo_image["image"] . '"';

                $image_alt = 'alt="' . $seo_image["seo_alt"] . '"';
                $image_title = 'title="' . $seo_image["seo_title"] . '"';
            } else if (file_exists('media_library/' . $image_size . 'product-noimage.jpg') == 1) {
                $image_src = 'src="' . base_url() . 'media_library/' . $image_size . 'product-noimage.jpg"';

                $image_alt = 'alt="' . $seo_image["seo_alt"] . '"';
                $image_title = 'title="' . $seo_image["seo_title"] . '"';
            } else {
                $image_src = 'src=""';
                $image_alt = 'alt=""';
                $image_title = 'title=""';
            }
        } else {
            $image_src = 'src=""';
            $image_alt = 'alt=""';
            $image_title = 'title=""';
        }

        $image_string = $image_src . " " . $image_alt . " " . $image_title;
        echo $image_string;
    }

    public function getProductDefaultImageURL($image_column, $image_size) {
        /* For using the single image with image position from  image column of json array string   
         * parameters  of $image_array,
         * image size* */


        $image_array = json_decode($image_column, TRUE);
        $image_detail = $this->common_model->GetByRow_notrash('cms_media', $image_array['media_id'], 'id');
        if ($image_detail != NULL) {

            $seo_image = json_decode($image_detail->images, TRUE);

            if ($seo_image['image'] != "" && file_exists('media_library/' . $image_size . $seo_image['image']) == 1) {
                $image_src = base_url() . 'media_library/' . $image_size . $seo_image["image"];
            } else if (file_exists('media_library/' . $image_size . 'product-noimage.jpg') == 1) {
                $image_src = base_url() . 'media_library/' . $image_size . 'product-noimage.jpg';
            } else {
                $image_src = '';
            }
        } else {
            $image_src = '';
        }


        echo $image_src;
    }

    public function list_timeline_status_array($current_timeline,
            $myorders_row_detail) {


        $listOfOrderPlacedStatusMessage = json_decode($myorders_row_detail->payment_data, TRUE);
        $list_timeline_status_id = json_decode($current_timeline->timeline);
        foreach ($list_timeline_status_id as $key => $timeline_status_id) {
            $single_timeline = $this->common_model->GetByRow_array('ec_cart_order_status', $timeline_status_id->order_stat_id, 'id');
            $current_key = array_search($timeline_status_id->order_stat_id, array_column($listOfOrderPlacedStatusMessage, 'status_id'));
            if ($current_key !== FALSE) {
                $single_timeline = $this->common_model->array_push_assoc($single_timeline, 'product_order_status_data_text', $listOfOrderPlacedStatusMessage[$current_key]["text"]);
                $single_timeline = $this->common_model->array_push_assoc($single_timeline, 'product_order_status_datetime', $listOfOrderPlacedStatusMessage[$current_key]["datetime"]);
            }

            $timeline[] = $single_timeline;
        }
        return $timeline;
    }

    /*
     * EOF order detail
     */

    /*
     * 25-07-2017
     * 
     * Use: Common Recursive category list 
     * Duplicate
     */

    function showcategory_classi2($ctype) {
        $this->db->select('cat.*,cattype.name as ctype_name');
        $this->db->where('cat.parent_id', 0);
        $this->db->where('cat.active_status', 'a');
        $this->db->where('cat.trash_status', 'no');
        $this->db->where('cat.parent_id', 0);
        $this->db->where('cat.ctype', $ctype);
        $this->db->where_not_in('cat.product_type2', $this->common_model->gift_product_type2);
        $this->db->join('ec_categorytypes cattype', 'cat.ctype = cattype.id', 'INNER');
        $rsMain = $this->db->get('ec_category cat')->result();
        if (count($rsMain) >= 1) {
            foreach ($rsMain as $rows_main) {
                $this->arr_b[] = array(
                    'name' => $rows_main->category,
                    'id' => $rows_main->id,
                    'parent_id' => $rows_main->parent_id,
                    'parent_main_id' => $rows_main->parent_main_id,
                    'ctype' => $rows_main->ctype,
                    'categoryslugtree' => $rows_main->categoryslugtree,
                    'ctype_name' => $rows_main->ctype_name);
                $this->showsubs_classi2($rows_main->id, $ctype);
            }
            return $this->arr_b;
        }
    }

    function showsubs_classi2($cat_id, $ctype, $dashes = '') {
        $dashes .= '__';
        $this->db->select('cat.*,cattype.name as ctype_name');
        $this->db->where('cat.parent_id', $cat_id);
        $this->db->where('cat.ctype', $ctype);
        $this->db->where('cat.active_status', 'a');
        $this->db->where('cat.trash_status', 'no');
        $this->db->where_not_in('cat.product_type2', $this->common_model->gift_product_type2);
        $this->db->join('ec_categorytypes cattype', 'cat.ctype = cattype.id', 'INNER');
        $rsSub = $this->db->get('ec_category cat')->result();
        if (count($rsSub) >= 1) {
            foreach ($rsSub as $rows_sub) {
                $this->arr_b[] = array(
                    'name' => $dashes . $rows_sub->category,
                    'id' => $rows_sub->id,
                    'parent_id' => $rows_sub->parent_id,
                    'parent_main_id' => $rows_sub->parent_main_id,
                    'ctype' => $rows_sub->ctype,
                    'categoryslugtree' => $rows_sub->categoryslugtree,
                    'ctype_name' => $rows_sub->ctype_name);
                $this->showsubs_classi2($rows_sub->id, $ctype, $dashes);
            }
        }
    }

    /*
     * EOF category list 
     */
    /*
     * Duplicate
     */

    function arr_reverse2($categryslugs) {

        $categryslugs = explode('+', $categryslugs);
        $categryslugs = array_filter($categryslugs);
        $categryslugs = array_unique($categryslugs);
        $categryslugs = array_reverse($categryslugs);
        $categryslugs = implode('/', $categryslugs);
        return $categryslugs;
    }

    /*
     * EOC arr_reverse
     */

    /*
     * List all Product
     */

    function GetAllProducts() {
        ini_set('max_execution_time', 0);


        $this->db->where('active_status', 'a');
        $this->db->where('qty > ', 0);
        $this->db->where('trash_status', 'no');
        return $this->db->get('ec_products')->result();
    }

    /*
     * End of List all Product 
     */

    function FullProductsAction($value_type) {

        $products_list = $this->common_model->GetAllProducts();
        foreach ($products_list as $products_value) {
            switch ($value_type) {
                case 'GoldRate':
                case 'McMaster':

                    $this->common_model->ProductCalculation($products_value->id);
                    break;

                default:
                    break;
            }
        }
    }

    function checkbluedartpincode($pincode) {

        $result = '';
        

        return $result;
    }

    public function OrderFailedArray() {
        $order_failed_array = array(
            "4",
            "8",
            "5",
            "9",
            "6",
            "10",
			"16");
        return $order_failed_array;
    }

    public function ShowPageByType($page_type, $data) {


        if ($page_type == 'pageid') {

            $data['page_row'] = $this->common_model->GetByFixedPageType('cms_pages', $data['pageid'], 'id');

            if (!empty($data['page_row']->fixed_type)) {
                $page_type = $data['page_row']->fixed_type;
            } else {
                $page_type = 'p';
            }
        } else {
            $data['page_row'] = $this->common_model->GetByFixedPageType('cms_pages', $page_type, 'fixed_type');
        }

        $data['relation_with_row'] = $this->relation_with_row = $data['page_row'];

        $data['page_id'] = $data['page_row']->id;

        $data['rsegment_last_string'] = 'p-' . $data['page_row']->id;

        $data['option'] = $this->common_model->option;

        $data['page_seo_title'] = $data['page_row']->title;
        $data['page_seo_description'] = $data['page_row']->description;
        $data['page_seo_keywords'] = $data['page_row']->keywords;


        $this->common_model->getPageSecuredata($data['page_row']->option_url_key);
        $data['pagetype'] = $page_type;
        $data['pagetype_id'] = $data['page_id'];



        if ($data['page_row']->make_cache == 'yes') {

            $page_cache_file = 'cache/cache_page_' . $data['page_row']->id;
            $this->template->load('master', $page_cache_file, $data);
        } else {

            $this->template->load('master', 'index/featured_view', $data);
        }
    }

    public function get_rsegment() {

        $seg_array = $this->uri->rsegment_array();
        $last_segment = end($seg_array);
        return $last_segment_splited = explode('-', $last_segment);
    }

//login

    function saveregistrationlogin1() {

//

        $inputtype = $this->input->post('inputtype');

        if ($inputtype == 'email') {
//	
            $data = array(
                'email' => $this->input->post('username'),
            );
//	
        } else {
//	
            $data = array(
                'phone' => $this->input->post('username'),
            );
//		
        }

        $this->db->insert('cms_usertemp', $data);

        $insertid = $this->db->insert_id();

//

        return $insertid;
    }

    function checkemailid($email) {

        $checkemail = 0;
        $checkemail2 = 0;

        $emailid = $email;
        if ($this->ion_auth->username_check($emailid)) {

            $checkemail = 1;
        } else {

            $checkemail = 0;
        }

//	

        $this->db->where('email', $emailid);
        $checkmeta = $this->db->get('users')->row();

        if ($checkmeta) {
            $checkemail2 = 1;
        } else {
            $checkemail2 = 0;
        }

        $checkemailfinal = $checkemail + $checkemail2;

        return $checkemailfinal;
    }

    function checkphonenumber($phone) {


        $checkphone = 0;
        $checkphone2 = 0;

        $username = $phone;
        if ($this->ion_auth->username_check($username)) {

            $checkphone = 1;
        } else {

            $checkphone = 0;
        }

//	

        $this->db->where('phone', $username);
        $checkmeta = $this->db->get('users')->row();

        if ($checkmeta) {
            $checkphone2 = 1;
        } else {
            $checkphone2 = 0;
        }


        $checkphonefinal = $checkphone + $checkphone2;


        return $checkphonefinal;
    }

    function updateverifycode($id, $type = 'old') {

        $verification_code = $this->common_model->get_rand_numbers(5);

        $data = array(
            'verifycode' => $verification_code,
        );


        if ($type == 'new') {
            $this->db->where('id', $id);
            $this->db->update('cms_usertemp', $data);
        } else {

            $this->db->where('user_id', $id);
            $this->db->update('users', $data);
        }
    }

    function get_login_verification_details($userid, $type) {

        if ($type == 'new') {
            $user_details = $this->common_model->GetByRow_notrash('cms_usertemp', $userid, 'id');
        } else {
            $user_details = $this->common_model->get_full_userinfo($userid);
        }
//

        $content = $user_details->verifycode . ' is the Verification Code for ' . $this->option->project_name . '.';

        if ($type == 'new') {
            $phone = $user_details->phone;
        } else
        if ($type == 'profile') {


            if ($user_details->phone2 != '') {
                $phone = $user_details->phone2;
            } else {
                $phone = $user_details->phone;
            }
        } else {
            $phone = $user_details->phone;
        }


        return $content . '***' . $phone;
//	
    }

    function get_full_userinfo($userid) {

        $this->db->from('users');
		$this->db->where('id', $userid);
        $query = $this->db->get();
        return $query->row();
    }

    function check_verification_code($userid, $type) {
        $code = $this->input->post('verifycode');

        if ($type == 'new') {
            $user_valz = $this->common_model->GetByRow_notrash('cms_usertemp', $userid, 'id');
        } else {
            $user_valz = $this->common_model->GetByRow_notrash('users', $userid, 'user_id');
        }




        if ($user_valz) {

            if ($code == $user_valz->verifycode) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    function validate_phonenumber($phone) {
//
        //
	$checkphone = 0;
        $checkphone2 = 0;

        $username = $phone;
        if ($this->ion_auth->username_check($username)) {

            $checkphone = 1;
        } else {

            $checkphone = 0;
        }

//	

        $this->db->where('phone', $username);
        $checkmeta = $this->db->get('users')->row();

        if ($checkmeta) {
            $checkphone2 = 1;
        } else {
            $checkphone2 = 0;
        }


        $checkphonefinal = $checkphone + $checkphone2;

        return $checkphonefinal;
//	
    }

    function validate_useremailid($email) {


//
        $checkemail = 0;
        $checkemail2 = 0;

        $emailid = $email;
        if ($this->ion_auth->username_check($emailid)) {

            $checkemail = 1;
        } else {

            $checkemail = 0;
        }

//	

        $this->db->where('email', $emailid);
        $checkmeta = $this->db->get('users')->row();

        if ($checkmeta) {
            $checkemail2 = 1;
        } else {
            $checkemail2 = 0;
        }

        $checkemailfinal = $checkemail + $checkemail2;

        return $checkemailfinal;
    }

    public function showAllprod_attrForDetailPage() {



        $this->db->where('show_vary_attributes', 'yes');

        $this->db->where('trash_status', 'no');

        $this->db->where('active_status', 'a');

        return $this->db->get('cms_commoninputs')->result();
    }

    public function showprod_attr_wizard($prod_attr) {

        $this->db->where('type', $prod_attr);

        $this->db->where('trash_status', 'no');

        $this->db->where('active_status', 'a');

        $this->db->order_by('CAST(fieldname AS unsigned)', 'ASC');

        return $this->db->get('ec_product_attributes')->result();
    }

    function savevisitors() {

        $ipaddress = '';
        if (isset($_SERVER['HTTP_X_REAL_IP'])) {
            $ipaddress = $_SERVER['HTTP_X_REAL_IP'];
            $iptype = "real";
        } else if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
            $iptype = "real";
        } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {

            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
            $iptype = "fake";
        } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
            $iptype = "fake";
        } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
            $iptype = "fake";
        } else if (isset($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
            $iptype = "fake";
        } else if (isset($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
            $iptype = "real";
        } else {
            $ipaddress = 'UNKNOWN';
            $iptype = "fake";
        }


        $u_agent = $_SERVER['HTTP_USER_AGENT'];
//
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        } elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }
//
// Next get the name of the useragent yes seperately and for good reason
        if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
            $browsername = 'Internet Explorer';
            $browsertype = "MSIE";
        } elseif (preg_match('/Firefox/i', $u_agent)) {
            $browsername = 'Mozilla Firefox';
            $browsertype = "Firefox";
        } elseif (preg_match('/OPR/i', $u_agent)) {
            $browsername = 'Opera';
            $browsertype = "Opera";
        } elseif (preg_match('/Chrome/i', $u_agent)) {
            $browsername = 'Google Chrome';
            $browsertype = "Chrome";
        } elseif (preg_match('/Safari/i', $u_agent)) {
            $browsername = 'Apple Safari';
            $browsertype = "Safari";
        } elseif (preg_match('/Netscape/i', $u_agent)) {
            $browsername = 'Netscape';
            $browsertype = "Netscape";
        } else {
            $browsername = 'Other';
            $browsertype = "Other";
        }


// finally get the correct version number
        $known = array(
            'Version',
            $browsertype,
            'other');
        $pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
// we have no matching number just continue
        }
// see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
//we will have two since we are not using 'other' argument yet
//see if version is before or after the name
            if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
                $version = $matches['version'][0];
            } else {
                $version = $matches['version'][1];
            }
        } else {
            $version = $matches['version'][0];
        }

// check if we have a number
        if ($version == null || $version == "") {
            $version = "";
        }



        $hostname = gethostbyaddr($ipaddress);

        $servername = $_SERVER['SERVER_NAME'];

        $domain = $_SERVER['HTTP_HOST'];


        date_default_timezone_set('asia/kolkata');
        $datetime = date(date("Y-m-d H:i:s"), strtotime($_SERVER['REQUEST_TIME']));

//	

        $sessionid = session_id();


        $date = date('Y-m-d');
        $hours = date('H');
        $minutes = date('i');

        $page = $this->input->post('page');
        $width = $this->input->post('width');
        $rsegment = $this->input->post('rsegment');


//

        $usertype = 'guest';
        $userid = 0;
        if (!$this->ion_auth->logged_in() || $this->ion_auth->is_admin()) {
            $usertype = 'guest';
        } else {
            $logged_user_data = $this->ion_auth->user()->row();
            $userid = $logged_user_data->id;
            $usertype = 'user';
        }
//


        $this->db->where('pageid', $page);
        $this->db->where('ip', $ipaddress);
        $this->db->where('sessionid', $sessionid);
        $this->db->where('date', $date);
        $this->db->where('hours', $hours);
        $this->db->where('usertype', $usertype);
        $this->db->order_by('id', 'DESC');
        $check = $this->db->get('cms_visitors')->row();

        $start = 'yes';
        if ($check) {
//

            $indertdate = $check->datetime;

            $indertdate = strtotime($indertdate); //1373673600
// getting current date 
            $currentdayDate = strtotime(date('Y-m-d H:i:s'));

// Getting the value of old date + 24 hours
            $oldinsertdate = $indertdate + 300; // 86400 seconds in 24 hrs

            if ($oldinsertdate < $currentdayDate) {
                $start = 'yes';
            } else {
                $start = 'no';
            }

//	
        } else {
            $start = 'yes';
        }


        if ($start == 'yes') {

            $data = array(
                'userAgent' => $u_agent,
                'sessionid' => $sessionid,
                'browser' => $browsername,
                'browsertype' => $browsertype,
                'browserversion' => $version,
                'os' => $platform,
                'device' => '',
                'ip' => $ipaddress,
                'iptype' => $iptype,
                'hostname' => $hostname,
                'servername' => $servername,
                'datetime' => $datetime,
                'date' => $date,
                'hours' => $hours,
                'minutes' => $minutes,
                'domain' => $domain,
                'pageid' => $page,
                'rsegment' => $rsegment,
                'userid' => $userid,
                'usertype' => $usertype,
                'width' => $width,
            );

            $this->db->insert('cms_visitors', $data);


//

            if (strpos($rsegment, 'p-') !== false) {

                $split_rsegment = explode('-', $rsegment);

                $this->db->where('rsegment', $rsegment);
                $visitors_count = $this->db->get('cms_visitors')->num_rows();

                $data_update = array(
                    'visitors' => $visitors_count,
                );

                $this->db->where('id', $split_rsegment[1]);
                $this->db->update('cms_pages', $data_update);
            }

//
            //

if (strpos($rsegment, 'productitem-') !== false) {

                $split_rsegment = explode('-', $rsegment);

                $this->db->where('rsegment', $rsegment);
                $visitors_count = $this->db->get('cms_visitors')->num_rows();

                $data_update = array(
                    'visitors' => $visitors_count,
                );

                $this->db->where('id', $split_rsegment[1]);
                $this->db->update('ec_products', $data_update);
            }

//
        }


//	
    }

    function OrderListingStatusInfo($order_row) {
        $data_orderinfo = array();
        $current_timeline = $this->common_model->GetByRow('ec_cart_order_status', $order_row->payment_status, 'id');
        $timeline_list = $this->common_model->list_timeline_status_array($current_timeline, $order_row);
        $data_orderinfo['1']['status_title'] = $timeline_list[0]['status_title'] . ' on ';
        $data_orderinfo['1']['status_date'] = date("D, jS M Y", strtotime($timeline_list[0]['product_order_status_datetime']));
        $data_orderinfo['1']['status_text'] = $timeline_list[0]['message_text'];

//        if ($order_row->payment_status < 3) {


        $current_key = array_search($order_row->payment_status, array_column($timeline_list, 'id'));


        if ($current_key !== FALSE) {
//                dump($timeline_list[$current_key]);
            $data_orderinfo['2']['status_title'] = $timeline_list[$current_key]['status_title'] . ' on ';
            $data_orderinfo['2']['status_date'] = date("D, jS M Y", strtotime($timeline_list[$current_key]['product_order_status_datetime']));
            $data_orderinfo['2']['status_text'] = $timeline_list[$current_key]['message_text'];
        }
//        }

        return $data_orderinfo;
    }

    function ordersmstext_bystatus($order_id, $status_id) {

        $myorders = $this->common_model->GetByRow_notrash('ec_orders', $order_id, 'id');

        //{oldoption}
        //$options = $this->common_model->get_options();
        //$option = $options[0];
        //{oldoption}

        $option = $this->option;

       // $orderId = $option->org_order_string . $myorders->order_id;
		//sbn orderid
		$orderId = $this->common_model->format_order_number($myorders->order_id,$myorders->id);
		//sbn orderid


        $current_timeline = json_decode($myorders->payment_data, true);
        $purchased_date = date("d-M-Y");

        $current_key = array_search($status_id, array_column($current_timeline, 'status_id'));
        if ($current_key !== FALSE) {
            $purchased_date = date("d-M-Y", strtotime($current_timeline[$current_key]["datetime"]));
        }

        if ($myorders->payment_status < $status_id) {
            $purchased_date = date("d-M-Y");

            if ($status_id == '3') {
                $orderId = '{OrderId}';
            }
        }

        $billing_address_array = json_decode($myorders->billing_address, TRUE);
        $billing_customer_name = $billing_address_array["frm_first_name"];


        $my_order_products = $this->common_model->GetByRow_notrash('ec_order_list', $myorders->id, 'ec_orders_id');
        $text_message_array = array();


        if ($status_id == '3' || $status_id == '7') {
            $text_message = 'Dear ' . $billing_customer_name . ', We Thank you for your Orderid ' . $orderId . ' placed on ' . $this->option->project_name . ' for Rs ' . $myorders->amount . '.00 , You will be updated again on the shipment of the order';

            $admin_message = "Confirmed Order From " . $this->option->project_name . " Orderid " . $orderId . " for Rs " . $myorders->amount . " on " . $purchased_date;

            $text_message_array['customer_sms'] = $text_message;
            $text_message_array['admin_sms'] = $admin_message;
        } else if ($status_id == '15') {
            $text_message = 'Dear ' . $billing_customer_name . ', We Thank you for your Orderid ' . $orderId . ' placed on ' . $this->option->project_name . ' for Rs ' . $myorders->amount . '.00 using Balance Payment, You will be updated again on the shipment of the order';

            $admin_message = "Confirmed Order From " . $this->option->project_name . " Orderid " . $orderId . " for Rs " . $myorders->amount . " on " . $purchased_date . " using Balance Payment";

            $text_message_array['customer_sms'] = $text_message;
            $text_message_array['admin_sms'] = $admin_message;
        } else
        if ($status_id == '11') {
            $text_message = 'Your packet from ' . $this->option->project_name . ' Order  ' . $orderId . ' is ready for shipping. Expect delivery within 3-5 days. Will update with Tracking Details soon. Thank you.';
            $admin_message = $text_message;
            $text_message_array['customer_sms'] = $text_message;
            $text_message_array['admin_sms'] = $admin_message;
        } else if ($status_id == '12') {

            $text_message = 'Your ' . $this->option->project_name . ' Order ' . $orderId . ' is successfully shipped.';
            $admin_message = $text_message;
            $text_message_array['customer_sms'] = $text_message;
            $text_message_array['admin_sms'] = $admin_message;
        } else if ($status_id == '13') {

            $text_message = 'Thank you for confirming that ' . $this->option->project_name . ' Item(s) was delivered to you on ' . $purchased_date . '. Once again thank you for shopping with ' . $this->option->project_name . '.';
            $admin_message = $text_message;
            $text_message_array['customer_sms'] = $text_message;
            $text_message_array['admin_sms'] = $admin_message;
        } else if ($status_id == '14') {

            $text_message = 'Dear ' . $billing_customer_name . ', Your Gift Card Coupon Code of your Orderid ' . $orderId . '  is activated and approved successfully. See mail for details.';
            $admin_message = "Gift Coupon Card Code approved and activated From " . $this->option->project_name . " Orderid " . $orderId . " for Rs " . $myorders->amount;
            $text_message_array['customer_sms'] = $text_message;
            $text_message_array['admin_sms'] = $admin_message;
        }

        return $text_message_array;
    }

    function SendOrderstatusSms($order_status_id, $ec_orders_row) {

        $current_timeline = json_decode($ec_orders_row->payment_data, true);

        //{oldoption}
        // $data['options'] = $this->common_model->get_options();
        //$data['option'] = $data['options'][0];
        //{oldoption}

        $data['option'] = $this->option;



        //$order_id = $data['option']->org_order_string . $ec_orders_row->order_id;		
		//sbn orderid
		$order_id = $this->common_model->format_order_number($ec_orders_row->order_id,$ec_orders_row->id);
		//sbn orderid

        $current_key = array_search($order_status_id, array_column($current_timeline, 'status_id'));
        if ($current_key !== FALSE) {
            $current_info = $current_timeline[$current_key]["text"][0];
            $info_sent_to = $current_info["info_sent_to"];

            switch ($info_sent_to) {
                case "billing":
                    $sending_address = $ec_orders_row->billing_address;
                    break;
                case "shipping":
                    $sending_address = $ec_orders_row->shipping_address;
                    break;
            }
            $sending_address_array = json_decode($sending_address, TRUE);
            $phone_number = $sending_address_array["frm_phoneno"];

            $admin_number = ""; // make this dynamic

            $sms = $current_info["sms"];
            if ($sms == "yes") {

                $sms_text = $current_info["sms_text"];
                $sms_text = str_replace('{OrderId}', $order_id, $sms_text);


                $sms_text2 = $current_info["sms_text2"];
                $sms_text2 = str_replace('{OrderId}', $order_id, $sms_text2);


                $this->common_model->send_sms($phone_number, $sms_text);
                $this->common_model->send_sms($admin_number, $sms_text2);
            }
        }
    }

    function GetProductValueFromCommonInputs($prod_col_name, $existing_table) {

        //{oldoption}
        //$options = $this->common_model->get_options();
        //$option = $options[0];
        //{oldoption}

        $option = $this->option;

        $product_field = json_decode($option->product_field, TRUE);
        if ($product_field != NULL) {
            if (array_key_exists($prod_col_name, $product_field)) {

                $common_input_row = $product_field[$prod_col_name];
                $common_input_row_value_type = $common_input_row["value_type"];
                switch ($common_input_row_value_type) {
                    case "Automatic":
                        $automatic_value_item = $common_input_row["automatic_value_item"];
                        switch ($automatic_value_item) {
                            case "Category":
//                                $prod_category_type_attr_id = $common_input_row["prod_attr"];
//                                $ec_categorytypes = $this->index_model->GetByRow('ec_categorytypes', $prod_category_type_attr_id, 'id');
//                                $ec_categorytypes_name = $ec_categorytypes->name;
                                break;
                            case "Brand":
//                                $prod_category_type_attr_id = $common_input_row["prod_attr"];
//                                $ec_categorytypes = $this->index_model->GetByRow('ec_categorytypes', $prod_category_type_attr_id, 'id');
//                                $ec_categorytypes_name = $ec_categorytypes->name;
                                break;
                            case "Product Attributes":
                                $prod_category_type_attr_id = $common_input_row["prod_attr"];
                                $ec_product_attributes_id = $existing_table->$prod_col_name;
                                $ec_product_attributes_row = $this->common_model->getFieldNameProductAttributesByTypeById($prod_category_type_attr_id, $ec_product_attributes_id);
                                if ($ec_product_attributes_row != NULL) {
                                    return $ec_product_attributes_row->fieldname;
                                } else {
                                    return $existing_table->$prod_col_name;
                                }


                                break;
                            default:
                                break;
                        }



                        break;
                    case "Query":


                        break;
                    case "Fixed":


                        break;
                    case "Manual":
                    default:
                        return $existing_table->$prod_col_name;
                        break;
                }
            } else {
                return $existing_table->$prod_col_name;
            }
        } else {
            return $existing_table->$prod_col_name;
        }
    }

    function GetProductValueFromCommonInputsData($prod_col_name, $data) {
        ini_set('max_execution_time', 0);
        $existing_table = $data['existing_table'];
        $option = $data['option'];
        $product_field = json_decode($option->product_field, TRUE);
        if ($product_field != NULL) {
            if (array_key_exists($prod_col_name, $product_field)) {

                $common_input_row = $product_field[$prod_col_name];
                $common_input_row_value_type = $common_input_row["value_type"];
                switch ($common_input_row_value_type) {
                    case "Automatic":
                        $automatic_value_item = $common_input_row["automatic_value_item"];
                        switch ($automatic_value_item) {
                            case "Category":
//                                $prod_category_type_attr_id = $common_input_row["prod_attr"];
//                                $ec_categorytypes = $this->index_model->GetByRow('ec_categorytypes', $prod_category_type_attr_id, 'id');
//                                $ec_categorytypes_name = $ec_categorytypes->name;
                                break;
                            case "Brand":
//                                $prod_category_type_attr_id = $common_input_row["prod_attr"];
//                                $ec_categorytypes = $this->index_model->GetByRow('ec_categorytypes', $prod_category_type_attr_id, 'id');
//                                $ec_categorytypes_name = $ec_categorytypes->name;
                                break;
                            case "Product Attributes":
                                $prod_category_type_attr_id = $common_input_row["prod_attr"];
                                $ec_product_attributes_id = $existing_table->$prod_col_name;
                                $ec_product_attributes_row = $this->common_model->getFieldNameProductAttributesByTypeById($prod_category_type_attr_id, $ec_product_attributes_id);
                                if ($ec_product_attributes_row != NULL) {
                                    return $ec_product_attributes_row->fieldname;
                                } else {
                                    return $existing_table->$prod_col_name;
                                }



                                break;
                            default:
                                break;
                        }



                        break;
                    case "Query":


                        break;
                    case "Fixed":


                        break;
                    case "Manual":
                    default:
                        return $existing_table->$prod_col_name;
                        break;
                }
            } else {
                return $existing_table->$prod_col_name;
            }
        } else {
            return $existing_table->$prod_col_name;
        }
    }

    function GetValueFromCommonInputsByProductColumnName($prod_col_name, $data) {

        ini_set('max_execution_time', 0);

        $option = $data['option'];

        $product_field = json_decode($option->product_field, TRUE);
        $column_name_as_label = "";
        $column_name_as_label = str_replace("_", " ", $prod_col_name);

        if ($product_field != NULL) {

            if (array_key_exists($prod_col_name, $product_field)) {

                $common_input_row = $product_field[$prod_col_name];
                if (isset($common_input_row["frontend_field_label"]) && $common_input_row["frontend_field_label"] !== "") {
                    $column_name_as_label = $common_input_row["frontend_field_label"];
                }
//                else if(isset($common_input_row["field_label"]) && $common_input_row["field_label"] !== ""){
//                    $column_name_as_label = $common_input_row["field_label"];
//                }  
            }
        }

        return array(
            "column_name_as_label" => $column_name_as_label,
        );
    }

    function getFieldNameProductAttributesByTypeById($prod_category_type_attr_id,
            $ec_product_attributes_id) {
        ini_set('max_execution_time', 0);

        $this->db->where('id', $ec_product_attributes_id);
        $this->db->where('type', $prod_category_type_attr_id);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $row = $this->db->get('ec_product_attributes')->row();
    }

    function createwaybillapi($pid, $listid, $no) {



    }

    function createwaybillapi2($pid, $listid, $no) {



    }

    function pushnotification($message, $title, $to) {

//        $body = $message; //Message to be sent
//        $title = $title; //Push  Title
//        /*         * url and header for firebase */
//        $url = "https://fcm.googleapis.com/fcm/send";
//        $headers = array("Authorization:", "Content-Type: application/json"); //$setting->auth_key ->  key from firebase
//        $message = array('message' => $body);
//        $notification = array("title" => $title, "body" => $body, "sound" => "default", "click_action" => "FCM_PLUGIN_ACTIVITY", "icon" => "fcm_push_icon"); //Default settings no need to change
////'icon'	=> 'myicon',/*Default Icon*/
//        /*         * */
//        $fields = array('notification' => $notification, 'data' => $message, 'registration_ids' => $to, 'priority' => "high", 'restricted_package_name' => ""); //$to token
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_POST, true);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
//        $result = curl_exec($ch);
//        curl_close($ch);
    }

    function get_all_main_categories() {
        $this->db->where('parent_id', '0');
        $this->db->where('ctype', '1'); //To get category
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('ec_category')->result();
    }

    function get_all_main_brands() {
        $this->db->where('parent_id', '0');
        $this->db->where('ctype', '2'); //To get brand
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('ec_category')->result();
    }

    function add_gift_product($data_gift) {

        $gift_card_data = json_encode($data_gift);

        $data_c['main_categories'] = $this->common_model->get_all_main_categories();
        $data_c['brand_categories'] = $this->common_model->get_all_main_brands();
        $product_sku = 'ja' . $this->common_model->get_rand_alphanumeric(4);

        $cat = "37";
        $cat_details = $this->common_model->GetByRow('ec_category', $cat, 'id');

        $cat_route = $cat_details->slug;
        $cat_name = $cat_details->category;
        $ctypetree = '+';
        /* For getting category tree with parent values */
        $get_val_a = $this->common_model->product_pass_tree_values($cat, $cat, 'product');

        if ($cat != '') {

            $ctypetree .= $data_c['main_categories']['0']->ctype . '+';
        }


        $brandid = "";
        if ($brandid != '') {

            $prod_type_details = $this->common_model->GetByRow('ec_category', $brandid, 'id');
            $prod_type_id = $brandid;
            $prod_type_name = $prod_type_details->category;
            $prod_type_route = $prod_type_details->slug;


            $ctypetree .= $data_c['brand_categories']['0']->ctype . '+';

            /* For getting category tree with parent values */
            $get_val_b = $this->common_model->product_pass_tree_values($brandid, $brandid, 'product');
        } else {
            $get_val_b = array();
            $prod_type_id = '';
            $prod_type_name = '';
            $prod_type_route = '';

            $get_val_b['cat_parent_id'] = '';
            $get_val_b['cat_parent_name'] = '';
            $get_val_b['cat_parent_route'] = '';
            $get_val_b['category_ids'] = '';
            $get_val_b['category_names'] = '';
            $get_val_b['category_slugs'] = '';
            $get_val_b['category_full'] = '';
        }





        $product_character = "normal";
        $product_associate_id = "0";
        $product_name = "Gift card " . $this->input->post('giftamount');
        $sku = $product_sku;
        $product_name = $product_name . ' - ' . $sku;
        $product_clean_name = $this->common_model->clean_text($product_name);

        $full_slug = $cat_details->full_slug . '/' . $product_clean_name;
        $availability = "in_stock";
        $data = array(
            'product_categorytype_id' => "24",
            'prod_name' => $product_name,
            'p_name' => $product_name,
            'product_type2' => "23",
            'slug' => $product_clean_name,
            'slug2' => $product_clean_name,
            'url_key' => 'product_item_route',
            'slug_type' => 'seo_url',
            'full_slug' => $full_slug,
            'prod_code' => '',
            'sku' => $sku,
            'qty' => $this->input->post('qty'),
            'original_price' => $this->input->post('giftamount'),
            'selling_price' => $this->input->post('giftamount'),
            'availability' => $availability,
            'ctypetree' => $ctypetree,
            'parent_sub_name' => $cat_name,
            'parent_sub_slug' => $cat_route,
            'parent_sub_id' => $cat,
            'parent_main_name' => $get_val_a['cat_parent_name'],
            'parent_main_slug' => $get_val_a['cat_parent_route'],
            'parent_main_id' => $get_val_a['cat_parent_id'],
            'categoryidtree' => $get_val_a['category_ids'],
            'categorynametree' => $get_val_a['category_names'],
            'categoryslugtree' => $get_val_a['category_slugs'],
            'categoryfull' => $get_val_a['category_full'],
            'parent_brand_sub_name' => $prod_type_name,
            'parent_brand_sub_slug' => $prod_type_route,
            'parent_brand_sub_id' => $prod_type_id,
            'parent_brand_main_name' => $get_val_b['cat_parent_name'],
            'parent_brand_main_slug' => $get_val_b['cat_parent_route'],
            'parent_brand_main_id' => $get_val_b['cat_parent_id'],
            'brandidtree' => $get_val_b['category_ids'],
            'brandnametree' => $get_val_b['category_names'],
            'brandslugtree' => $get_val_b['category_slugs'],
            'brandfull' => $get_val_b['category_full'],
            'prod_short_description' => "",
            'prod_brief_description' => "",
            'active_status' => 'a',
            'trash_status' => 'no',
            'featurebox_id_tree' => '+',
            'menu_id_tree' => '+',
            'full_category_id_tree' => $get_val_a['category_ids'],
            'gift_card_data' => $gift_card_data,
        );


        $this->db->insert('ec_products', $data);
        $pid = $this->db->insert_id();

        return $pid;
    }

    /* Function pass_tree_values takes one argument and return an array. */

    function product_pass_tree_values($catid_val, $c_id, $typeCheck) {

        ini_set('max_execution_time', 0);
        $parent_cat_result = $this->common_model->product_get_first_parent($catid_val);
        $current_field = $this->common_model->GetByRow('ec_category', $c_id, 'id');

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

    function product_get_first_parent($cid) {
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

    public function CheckAndReturnProtocolUrl($full_url) {

        $parsed_url = parse_url($full_url);
        $host = isset($parsed_url['host']) ? $parsed_url['host'] : '';
        $path = isset($parsed_url['path']) ? $parsed_url['path'] : '';
        $base = base_url();

        $parsedbase_url = parse_url($base);
        $basehost = isset($parsedbase_url['host']) ? $parsedbase_url['host'] : '';
        $return_full_url = $full_url;
        if ($host === $basehost) {


            $path_array = explode($base, $full_url);
            array_shift($path_array);

            $left_url = implode('/', $path_array);

            $cms_routes = $this->common_model->GetByRow('cms_routes', $left_url, 'left_side_full_url');
            if ($cms_routes != NULL) {
                $right_side_full_url = $cms_routes->right_side_full_url;

                $seg_array = explode('/', $right_side_full_url);
                $last_segment = end($seg_array);
                $last_segment_splited = explode('-', $last_segment);

                $query = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : '';
                $fragment = isset($parsed_url['fragment']) ? '#' . $parsed_url['fragment'] : '';

                $pagetype = $last_segment_splited[0];
                $pagetype_id = $last_segment_splited[1];
                switch ($pagetype) {
                    case 'm':
                        $menu_row = $this->common_model->GetByRow('cms_menu', $pagetype_id, 'id');
                        $data['page_id'] = $menu_row->page_id;
                        $base = $this->common_model->CheckPageSecure($data['page_id'], "return");
                        break;
                    case 'p':
                        $data['page_id'] = $pagetype_id;
                        $base = $this->common_model->CheckPageSecure($data['page_id'], "return");

                        break;
                    case 'contentcat':

                        $fixed_pagetype = 'content_category';
                        $catrow = $this->common_model->GetByFixedPageType('cms_pages', $fixed_pagetype, 'fixed_type');
                        $data['page_id'] = $catrow->id;
                        $data['catid'] = $pagetype_id;
                        $base = $this->common_model->CheckPageSecure($data['page_id'], "return");
                        break;
                    case 'contentitem':

                        $fixed_pagetype = 'content_item';
                        $catrow = $this->common_model->GetByFixedPageType('cms_pages', $fixed_pagetype, 'fixed_type');
                        $data['page_id'] = $catrow->id;
                        $base = $this->common_model->CheckPageSecure($data['page_id'], "return");

                        break;
                    case 'productcat':

                        if (isset($_GET['m']) != FALSE) {
                            $menu_row = $this->common_model->GetByRow('cms_menu', $_GET['m'], 'id');
                            $data['page_id'] = $menu_row->page_id;
                        } else {

                            $data['prod_row'] = $category_row = $this->common_model->GetByRow('ec_category', $pagetype_id, 'id');
                            $data['main_category_row'] = $main_category_row = $this->common_model->GetByRow('ec_category', $category_row->parent_main_id, 'id');


                            $menu_id_array = explode('+', $main_category_row->menu_id_tree);
                            array_shift($menu_id_array);
                            array_pop($menu_id_array);

                            if ($menu_id_array[0] != "") {
                                $menu_row = $this->common_model->GetByRow('cms_menu', $menu_id_array[0], 'id');
                                $data['page_id'] = $menu_row->page_id;
                            } else {
                                $fixed_pagetype = 'product_category';
                                $catrow = $this->common_model->GetByFixedPageType('cms_pages', $fixed_pagetype, 'fixed_type');
                                $data['page_id'] = $catrow->id;
                            }
                        }

                        $base = $this->common_model->CheckPageSecure($data['page_id'], "return");

                        break;
                    case 'productitem':

                        $fixed_pagetype = 'product';
                        $data['page_details'] = $this->common_model->GetByFixedPageType('cms_pages', $fixed_pagetype, 'fixed_type');
                        $data['page_id'] = $data['page_details']->id;
                        $base = $this->common_model->CheckPageSecure($data['page_id'], "return");

                        break;
                    default:
                        break;
                }

                $return_full_url = $base . $left_url . $query . $fragment;
            }
        }
        return $return_full_url;
    }

    function GetShippingMethodByType($shipping_method_type) {
        ini_set('max_execution_time', 0);
        $this->db->where('shipping_method_type', $shipping_method_type);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('ec_shipping_method');

        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function delivery_country_list() {

        $shipping_method_details = $this->common_model->GetShippingMethodByType('location_based_shipping_type');
        $shipping_method_type_data_exist_array = json_decode($shipping_method_details->availablecountriesid, TRUE);
        $location_id_list = array_column($shipping_method_type_data_exist_array, 'id');

        $this->db->where_in('id', $location_id_list);
        $this->db->where('location_type_id', '1');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');

        $query = $this->db->get('cms_locations');

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_location_list($parent_location_id, $get_location_type_id) {

        $this->db->like('location_id_tree', '+' . $parent_location_id . '+');
        $this->db->where('location_type_id', $get_location_type_id);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $query = $this->db->get('cms_locations');

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function SetSelectedLocationFormatData() {

        $shipping_method_details = $this->common_model->GetShippingMethodByType('location_based_shipping_type');
        if ($shipping_method_details != FALSE) {
            $selectedtypetocheck = $shipping_method_details->selectedtypetocheck;
            $shipping_method_type_data_exist_array = json_decode($shipping_method_details->shipping_method_type_data, TRUE);


            if ($shipping_method_type_data_exist_array != NULL && $selectedtypetocheck > 0 && $selectedtypetocheck !== '') {

                $selected_location_format_data_array = array();
                $merge_location_array = array();
                foreach ($shipping_method_type_data_exist_array as
                            $shipping_method_type_data_key =>
                            $shipping_method_type_data) {

                    $location_id_list = $this->common_model->GetLocationIdResultArrayByIdAndLocationType($shipping_method_type_data['id'], $selectedtypetocheck);

                    $location_id_list = array_column($location_id_list, 'id');

                    $new_group_location_array = array_diff($location_id_list, $merge_location_array);

                    $selected_location_format_data_array[] = array(
                        'id' => $shipping_method_type_data['id'],
                        'location_id_list' => '+' . implode('+', $new_group_location_array) . '+',
                    );
                    $merge_location_array = array_merge($merge_location_array, $new_group_location_array);
                }

                $shipping_data = array(
                    'selected_location_format_data' => json_encode($selected_location_format_data_array),
                );

                $this->db->where('id', $shipping_method_details->id);
                $this->db->update('ec_shipping_method', $shipping_data);
            }
        }
    }

    function GetLocationIdResultArrayByIdAndLocationType($parent_location_id,
            $get_location_type_id) {

        $this->db->select('id');
        $this->db->like('location_id_tree', '+' . $parent_location_id . '+');
        $this->db->where('location_type_id', $get_location_type_id);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $query = $this->db->get('cms_locations');

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function GetProductDeliveryCharge($product_id, $location_id) {
//$product_id = '517',$location_id = '1818'
//$product_id = '516',$location_id = '1818'
//$product_id = '547',$location_id = '1818'
//$product_id = '547', $location_id = '6000'
//        dump($product_id);
        //{oldoption}
        //$options = $this->common_model->get_options();
        // $option = $options[0];
        //{oldoption}

        $option = $this->option;

        $shipping_method_details = $this->common_model->GetShippingMethodByType('location_based_shipping_type');
        $selected_location_format_data = json_decode($shipping_method_details->selected_location_format_data, TRUE);
        $product_delivery_charge = 0.00;
//        dump($selected_location_format_data);
        $found_key = FALSE;
        foreach ($selected_location_format_data as $selected_key =>
                    $selected_value) {
            $pos = strpos($selected_value["location_id_list"], "+" . $location_id . "+");
            if ($pos !== FALSE) {
                $found_key = $selected_key;
                break;
            }
        }
        if ($found_key !== FALSE) {
            $product_details = $this->common_model->GetByRow('ec_products', $product_id, 'id');
            if ($product_details->deliverycharge_pay_status == "yes") {
                $deliverycharge_data = json_decode($product_details->deliverycharge_data, TRUE);
//        dump($deliverycharge_data[$found_key]["deliverycharge"]);
                if ($deliverycharge_data[$found_key]["deliverycharge"] > 0) {
                    $product_delivery_charge = number_format($deliverycharge_data[$found_key]["deliverycharge"], 2, '.', ',');
//                    dump($product_delivery_charge);
                } else {
                    $categoryidtree = explode('+', $product_details->categoryidtree);
                    array_shift($categoryidtree);
                    array_pop($categoryidtree);
                    foreach ($categoryidtree as $categoryidvalue) {
                        $category_details = $this->common_model->GetByRow('ec_category', $categoryidvalue, 'id');
                        if ($category_details->deliverycharge_pay_status == "yes") {
                            $deliverycharge_data = json_decode($category_details->deliverycharge_data, TRUE);
                            if ($deliverycharge_data[$found_key]["deliverycharge"] > 0) {
                                $product_delivery_charge = number_format($deliverycharge_data[$found_key]["deliverycharge"], 2, '.', ',');
                                break;
                            }
                        }
                    }
                    if ($product_delivery_charge <= 0) {
                        if ($option->deliverycharge_pay_status == "yes") {
                            $deliverycharge_data = json_decode($option->deliverycharge_data, TRUE);
                            if ($deliverycharge_data[$found_key]["deliverycharge"] > 0) {
                                $product_delivery_charge = number_format($deliverycharge_data[$found_key]["deliverycharge"], 2, '.', ',');
                            }
                        }
                    }
                }
            }
        } else {
            /** Other than location group Charge* */
            $product_delivery_charge = number_format($option->default_deliverycharge, 2, '.', ',');
//           dump($product_delivery_charge);
        }
        return $product_delivery_charge;
    }

    function total_cart_price() {
        $total_cart_price = '0.00';
        $gl_cart_total_only_product_price = floatval(str_replace(",", "", $this->common_model->gl_cart_total_only_product_price()));
        $gl_cart_coupon_amount = floatval(str_replace(",", "", $this->common_model->gl_cart_coupon_amount()));
        $total_cart_price = $gl_cart_total_only_product_price - $gl_cart_coupon_amount;
        if ($total_cart_price <= 0) {
            $total_cart_price = '0.00';
        }
        return $total_cart_price;
    }

    function gl_cart_total_only_product_price() {
        $gl_cart_total_only_product_price = '0.00';
        $ci_cart_items = $this->cart->contents();
        if ($ci_cart_items != NULL) {
            foreach ($ci_cart_items as $key => $item) {

                $ec_product = $this->common_model->GetByRowOrFalse('ec_products', $item["id"], 'id');
                if ($ec_product != FALSE) {

                    $gl_cart_total_only_product_price = $gl_cart_total_only_product_price + ($item['qty'] * $ec_product->selling_price);
                } else {

                    $gl_cart_total_only_product_price = $gl_cart_total_only_product_price + ($item['qty'] * $item['price']);
                }
            }
        }
        return $gl_cart_total_only_product_price;
    }

    function gl_delivery_cart_price() {
        $gl_total_product_qty_delivery_charge = '0.00';
        $location_id = '0';
        $gl_cart_session = $this->session->userdata('gl_cart');
        if (isset($gl_cart_session['session_delivery_address_id'])) {
            $session_delivery_address_id = $gl_cart_session['session_delivery_address_id'];
            $default_delivery_address = $this->common_model->GetByRow('ec_user_address', $session_delivery_address_id, 'id');
        } else {
            $data['logged_user_data'] = $this->ion_auth->user()->row();
            $userid = $data['logged_user_data']->id;
            $default_delivery_address = $this->common_model->get_default_delivery_user_address($userid);
        }

        if ($default_delivery_address != FALSE) {

            $default_delivery_address_array = json_decode($default_delivery_address->delivery_address, TRUE);
            $frm_state = $default_delivery_address_array['frm_state'];

            if (is_numeric($frm_state)) {
                $location_id = $frm_state;
            }
            $ci_cart_items = $this->cart->contents();
            if ($ci_cart_items != NULL) {

                foreach ($ci_cart_items as $key => $item) {

                    $product_delivery_charge = $this->common_model->GetProductDeliveryCharge($item['pid'], $location_id);
                    $gl_total_product_qty_delivery_charge = $gl_total_product_qty_delivery_charge + ($item['qty'] * $product_delivery_charge);
                }
            }
        }
        return $gl_total_product_qty_delivery_charge;
    }

    function get_socialdata() {

        $this->db->order_by('order', 'ASC');
        $this->db->order_by('id', 'ASC');
        $this->db->where('type', 'social_media');
        $this->db->where('type2', 'social');
        $query = $this->db->get('cms_media');

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function GetAllMailTypes() {
        $this->db->select('form_name');
        $this->db->group_by('form_name');
        return $this->db->get('cms_form_data')->result_array();
    }

    function GetAllOrderStatus() {
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('status_order', 'asc');
        return $this->db->get('ec_cart_order_status')->result_array();
    }

    function GetAllPaymentMethod() {
        $this->db->where('trash_status', 'no');
//        $this->db->where('active_status', 'a');
        return $this->db->get('ec_payment_method')->result_array();
    }

    function GetAllOrderCharacterTypes() {

        $order_character_type_list = array(
            0 => array(
                "value" => "normal",
                "text" => "Normal"),
            1 => array(
                "value" => "gift_card",
                "text" => "Gift Card"),
        );
        return $order_character_type_list;
    }

    function savewindowwidth() {

        $gl_cart_session = $this->session->userdata('gl_cart');
        $width = $this->input->post('width');
        $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'session_window_width', $width);
        $this->session->set_userdata('gl_cart', $gl_cart_session);
    }

    function get_default_delivery_user_address($userid) {

        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->where('default_delivery_address_status', 'yes');
        $this->db->where('user_id', $userid);
        $query = $this->db->get('ec_user_address');

        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function update_cart_settings() {

        $ci_cart_items = $this->cart->contents();

        if ($ci_cart_items != NULL) {

            foreach ($ci_cart_items as $item) {

                $prod_id = $item['pid'];
                $this->db->where('id', $prod_id);
                $prodct = $this->db->get('ec_products')->row();
                if ($prodct->qty <= 0) {

                    $qty = 0;
                    $row_id = $item['rowid'];
                    $data = array(
                        'rowid' => $row_id,
                        'qty' => $qty,
                    );

                    $this->cart->update($data);
                    $this->common_model->update_gl_cart_session($prod_id, $qty);
                }
            }
        }
    }

    function update_gl_cart_session($prod_id, $qty) {
        if ($qty == '0') {
            if ($this->session->userdata('gl_cart') != FALSE) {

                $gl_cart_session = array();
                $product_id_list_session = array();

                $gl_cart_session = $this->session->userdata('gl_cart');
                $product_id_list_session = $gl_cart_session['product_id_list'];


                $item_session_key = array_search($prod_id, $product_id_list_session);
                if ($item_session_key !== FALSE) {
                    unset($product_id_list_session[$item_session_key]);
                }
                $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'product_id_list', $product_id_list_session);
                if ($prod_id != FALSE) {
                    //unsetting  'wizard_1_product_id' session For wizard1
                    unset($gl_cart_session['wizard_1_product_id']);
                }
                if (isset($gl_cart_session['wizard_1_product_id'])) {
                    if ($gl_cart_session['wizard_1_product_id'] == $prod_id) {
                        //unsetting  'wizard_1_product_id' session For wizard1
                        unset($gl_cart_session['wizard_1_product_id']);
                    }
                }
                $this->session->set_userdata('gl_cart', $gl_cart_session);
            }
        }
    }

    function GetByResultOrReturnFalse($table, $key_value_where_array) {


        ini_set('max_execution_time', 0);
        foreach ($key_value_where_array as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get($table);
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function SendGiftCardMail($ec_coupon_id) {


        $ec_coupon = $this->common_model->GetByRow('ec_coupon', $ec_coupon_id, 'id');
        $ec_orders = $this->common_model->GetByRow('ec_orders', $ec_coupon->ec_orders_id, 'id');
        //        $ec_orders_payment_status = $ec_orders->payment_status;

        $ec_orders_payment_status = '14';

        $sending_address = $this->common_model->GetInfoSentToAddress($ec_orders, $ec_orders_payment_status);
        if ($sending_address !== FALSE) {
            $sending_address_array = json_decode($sending_address, TRUE);
            $frm_phoneno = $sending_address_array["frm_phoneno"];
            $frm_email = $sending_address_array["frm_email"];
            $frm_first_name = $sending_address_array["frm_first_name"];
            $frm_last_name = $sending_address_array["frm_last_name"];

            $full_name = ucfirst($frm_first_name . ' ' . $frm_last_name);

            $coupon_code = strtoupper($ec_coupon->coupon_code);
            $coupon_balance_amount = $ec_coupon->coupon_balance;

            $ec_orders_payment_method_string = $ec_orders->payment_method_string;
            $sending_address_string = $this->common_model->GetSpecifiedAddressInSpecifiedFormat($sending_address);

            $encrypted_string1 = "";

            $coupon_amnt = number_format($coupon_balance_amount, 2, '.', ',');

            $order_id = $coupon_code;
            $order_date = $ec_orders->purchase_date;

//mail
        }
    }

    function GetInfoSentToAddress($ec_orders, $ec_orders_payment_status) {
        $current_timeline = json_decode($ec_orders->payment_data, true);
        $current_key = array_search($ec_orders_payment_status, array_column($current_timeline, 'status_id'));
        if ($current_key !== FALSE) {
            $current_info = $current_timeline[$current_key]["text"][0];
            $info_sent_to = $current_info["info_sent_to"];

            switch ($info_sent_to) {
                case "billing":
                    $sending_address = $ec_orders->billing_address;
                    break;

                case "shipping":
                    $sending_address = $ec_orders->shipping_address;

                    break;
                default :
                    $sending_address = $ec_orders->billing_address;
                    break;
            }
        } else {
            $sending_address = $ec_orders->billing_address;
        }
        return $sending_address;
    }

    function UpdateOrderStatusBehaviour($ec_cart_order_status_id,
            $ec_orders_row_id) {
        /*         * * For updating order status behaviour to ec_orders and ec_order_list * */
        $ec_cart_order_status_row = $this->common_model->GetByRow('ec_cart_order_status', $ec_cart_order_status_id, 'id');
        $status_behaviour = $ec_cart_order_status_row->status_behaviour;

        $order_status_data = array(
            'status_behaviour' => $status_behaviour,
        );
        $this->db->where('id', $ec_orders_row_id);
        $this->db->update('ec_orders', $order_status_data);
        $this->db->where('ec_orders_id', $ec_orders_row_id);
        $this->db->update('ec_order_list', $order_status_data);
        /*         * * EOL For updating order status behaviour to ec_orders and ec_order_list * */
    }

    function gl_cart_coupon_amount() {

        $gl_cart_coupon_amount = '0.00';
        if ($this->cart->total() > 1 && $this->cart->total() > 0) {
            $gl_cart_session = $this->session->userdata('gl_cart');
            if (isset($gl_cart_session['coupon_applied'])) {
                if ($gl_cart_session['coupon_applied'] == "yes") {
                    $gl_cart_coupon_amount = $gl_cart_session['coupon_balance'];
                }
            }
        }
      
        return $gl_cart_coupon_amount;
    }

    function UpdateOrderAndCouponPaymentDetails($ec_orders_row_id) {

        $ec_orders_row = $this->common_model->GetByRowOrFalse('ec_orders', $ec_orders_row_id, 'id');
        $couponstatus = FALSE;
        $balance_to_pay = 0;
        $coupon_applied_amount = floatval($ec_orders_row->coupon_applied_amount);
        $ec_orders_old_amount = floatval($ec_orders_row->amount);
        $ec_orders_order_total = floatval($ec_orders_row->order_total);


        if ($ec_orders_row->coupon_applied == 'yes' && $ec_orders_row->coupon_balance_redeemed == 'no') {

            $coupon_balance = 0;
            $discount = 0;
            $coupon_balance_redeemed = "no";
            $coupon_redeemed_amount = 0;
            $balance_to_pay = 0;
            $ec_orders_new_amount = $ec_orders_old_amount;
            $coupon_new_balance = 0;
            $coupon_current_balance = 0;

            $coupon_detail = $this->common_model->GetByRowOrFalse('ec_coupon', strtolower($ec_orders_row->coupon_code), 'coupon_code');

            if ($coupon_detail != FALSE) {
                $used_users_id_array = explode('+', $coupon_detail->used_users_id);
                $used_users_log_array = json_decode($coupon_detail->used_users_log, TRUE);
                $coupon_balance_redeemed = 'yes';
                //

                $coupon_current_balance = $coupon_detail->coupon_balance;
                $ec_orders_new_amount = $ec_orders_order_total - $coupon_current_balance;
                $coupon_new_balance = $coupon_current_balance - $coupon_applied_amount;
                if ($coupon_new_balance < 0) {
                    $coupon_new_balance = 0;
                }


                if ($coupon_current_balance >= $coupon_applied_amount) {
                    $coupon_redeemed_amount = $coupon_applied_amount;
                } else {
                    $coupon_redeemed_amount = $coupon_current_balance;
                }
                if ($coupon_redeemed_amount <= 0) {
                    $coupon_balance_redeemed = 'no';
                }

                $balance_to_pay = $ec_orders_new_amount - $ec_orders_old_amount;
//            if ($balance_to_pay < 0) {
//                $balance_to_pay
//            }


                $used_users_id_array = array_filter($used_users_id_array);
                $used_users_id_array = array_unique($used_users_id_array);

                array_push($used_users_id_array, $ec_orders_row->user_id);
                $used_users_id_array = array_unique($used_users_id_array);

                $used_users_log_array[] = array(
                    'user_id' => $ec_orders_row->user_id,
                    'ec_order_id' => $ec_orders_row->id,
                    'used_amount' => $coupon_redeemed_amount,
                    'datetime' => date('Y-m-d H:i:s'),
                );

                $used_users_id_data = implode('+', $used_users_id_array);
                $used_users_log_data = json_encode($used_users_log_array);

                $data_coupon_update = array(
                    'coupon_balance' => $coupon_new_balance,
                    'used_users_id' => $used_users_id_data,
                    'used_users_log' => $used_users_log_data,
                    'last_applied_date' => date('Y-m-d H:i:s')
                );
                $this->db->where('id', $coupon_detail->id);
                $this->db->update('ec_coupon', $data_coupon_update);
            } else {
                $balance_to_pay = $coupon_applied_amount;
                $ec_orders_new_amount = $ec_orders_old_amount + $coupon_applied_amount;
            }

            if ($balance_to_pay < 0) {
                $balance_to_pay = 0;
            }
            if ($ec_orders_new_amount < 0) {
                $ec_orders_new_amount = 0;
            }

            $data_order_update = array(
                'coupon_balance_redeemed' => $coupon_balance_redeemed,
                'coupon_redeemed_amount' => $coupon_redeemed_amount,
                'balance_to_pay' => $balance_to_pay,
                'discount' => $coupon_redeemed_amount,
                'amount' => $ec_orders_new_amount,
                'coupon_balance' => $coupon_new_balance,
                'coupon_amount' => $coupon_current_balance,
            );
            $this->db->where('id', $ec_orders_row->id);
            $this->db->update('ec_orders', $data_order_update);


            //start
        }
        return $couponstatus;
    }

    function gl_remove_coupon() {

        $gl_cart_session = $this->session->userdata('gl_cart');
        $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'coupon_applied', 'no');
        $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'coupon_code', '');
        $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'coupon_amount', '');
        $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'coupon_balance', '');
        $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'coupon_applied_amount', '');
        $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'coupon_remaining_balance', '');
        $this->session->set_userdata('gl_cart', $gl_cart_session);
        $status = array(
            'status' => 'removed',
            'status_text' => 'Coupon removed',
        );
        return json_encode($status);
    }

    function searcharray($value, $key, $array) {
        foreach ($array as $k => $val) {
            if ($val[$key] == $value) {
                return $k;
            }
        }
        return null;
    }

    function GetKeyFromArrayOrNull($value, $key, $array) {
        if ($array !== NULL) {
            return $this->common_model->searcharray($value, $key, $array);
        }
        return null;
    }

    function GetProductOrderCount($ec_orders_id) {
        ini_set('max_execution_time', 0);
        //To update the product's order count from order list to products table
        if ($ec_orders_id != 0 && $ec_orders_id > 0) {
            $conditional_array = array(
                'id' => $ec_orders_id,
            );
            $ec_orders_row = $this->common_model->GetByReturnTypeOrderType('ec_orders', 'id', 'ASC', $conditional_array, $returntype = 'row');

            if ($ec_orders_row != FALSE) {
                if ($ec_orders_row->order_id > 0) {
                    $conditional_array = array(
                        'ec_orders_id' => $ec_orders_id,
                    );
                    $ec_order_list_result = $this->common_model->GetByReturnTypeOrderType('ec_order_list', 'id', 'ASC', $conditional_array, $returntype = 'result');
                    if ($ec_order_list_result != FALSE) {
                        foreach ($ec_order_list_result as $ec_order_list_row) {
                            $product_id = $ec_order_list_row->product_id;

                            $ec_order_product_list = $this->common_model->GetActiveConfirmedOrderlistByProductID($product_id);
                            if ($ec_order_product_list != FALSE) {

                                $ec_order_product_list_count = count($ec_order_product_list);
                                $product_data = array(
                                    "order_count" => $ec_order_product_list_count,
                                );
                                $this->db->where('id', $product_id);
                                $this->db->update('ec_products', $product_data);
                            }
                        }
                    }
                }
            }
        }
    }

    function GetProductListingDiscountText($product_details) {
        $discount_text = "";
        $discount_text = $product_details->discount_text;
        if (trim($discount_text) == "") {
            $conditional_array = array(
                'id' => $product_details->parent_sub_id,
                'trash_status' => 'no',
                'active_status' => 'a',
            );

            $parent_sub_category_details = $this->common_model->GetByReturnTypeOrderType('ec_category', 'id', 'ASC', $conditional_array, $returntype = 'row');

            if ($parent_sub_category_details != FALSE) {
                $discount_text = $parent_sub_category_details->discount_text;
                if (trim($discount_text) == "") {
                    $conditional_array = array(
                        'id' => $product_details->parent_main_id,
                        'trash_status' => 'no',
                        'active_status' => 'a',
                    );

                    $parent_main_category_details = $this->common_model->GetByReturnTypeOrderType('ec_category', 'id', 'ASC', $conditional_array, $returntype = 'row');
                    if ($parent_main_category_details != FALSE) {
                        $discount_text = $parent_main_category_details->discount_text;
                    }
                }
            }
        }
        return $discount_text;
    }

    function GetProductDiscountText($product_details,
            $parent_sub_category_details, $parent_main_category_details) {
        $discount_text = "";
        $discount_text = $product_details->discount_text;
        if (trim($discount_text) == "") {
            if ($parent_sub_category_details != FALSE) {
                $discount_text = $parent_sub_category_details->discount_text;
                if (trim($discount_text) == "") {
                    if ($parent_main_category_details != FALSE) {
                        $discount_text = $parent_main_category_details->discount_text;
                    }
                }
            }
        }
        return $discount_text;
    }

    function GetProductSubCategoryMainCategoryExpectedDeliveryDayCount($product_details,
            $parent_sub_category_details, $parent_main_category_details) {

        $delivery_text = 0;
        if ($product_details->priority_date_delivery == "yes") {

            $delivery_text = trim($product_details->expected_day_count);
        }
        if ($parent_sub_category_details->priority_date_delivery == "yes" && ($delivery_text <= 0 || $delivery_text == "")) {

            $delivery_text = trim($parent_sub_category_details->expected_day_count);
        }
        if ($parent_main_category_details->priority_date_delivery == "yes" && ($delivery_text <= 0 || $delivery_text == "")) {

            $delivery_text = trim($parent_main_category_details->expected_day_count);
        }
        if ($delivery_text <= 0 || $delivery_text == "") {

            $delivery_text = $this->common_model->option->expected_day_count;
        }

        return $delivery_text;
    }

    function GetProductSubCategoryMainCategoryExpectedDeliveryDayText($product_details,
            $parent_sub_category_details, $parent_main_category_details) {

        $delivery_text = "";
        if ($product_details->priority_date_delivery == "yes") {

            $delivery_text = trim($product_details->delivery_text);
        }

        if ($parent_sub_category_details->priority_date_delivery == "yes" && $delivery_text == "") {

            $delivery_text = trim($parent_sub_category_details->delivery_text);
        }

        if ($parent_main_category_details->priority_date_delivery == "yes" && $delivery_text == "") {

            $delivery_text = trim($parent_main_category_details->delivery_text);
        }
        if ($delivery_text == "") {

            $delivery_text = $this->common_model->option->delivery_text;
        }
        return $delivery_text;
    }

    function Error_Level_ToString($intval, $separator = ',') {
        /*
         * Returns the old error_reporting level or the current level if no level parameter is given.
         * Error_Level_ToString(error_reporting(), ',');
         */
        $errorlevels = array(
            E_ALL => 'E_ALL',
            E_USER_DEPRECATED => 'E_USER_DEPRECATED',
            E_DEPRECATED => 'E_DEPRECATED',
            E_RECOVERABLE_ERROR => 'E_RECOVERABLE_ERROR',
            E_STRICT => 'E_STRICT',
            E_USER_NOTICE => 'E_USER_NOTICE',
            E_USER_WARNING => 'E_USER_WARNING',
            E_USER_ERROR => 'E_USER_ERROR',
            E_COMPILE_WARNING => 'E_COMPILE_WARNING',
            E_COMPILE_ERROR => 'E_COMPILE_ERROR',
            E_CORE_WARNING => 'E_CORE_WARNING',
            E_CORE_ERROR => 'E_CORE_ERROR',
            E_NOTICE => 'E_NOTICE',
            E_PARSE => 'E_PARSE',
            E_WARNING => 'E_WARNING',
            E_ERROR => 'E_ERROR');
        $result = '';
        foreach ($errorlevels as $number => $name) {
            if (($intval & $number) == $number) {
                $result .= ($result != '' ? $separator : '') . $name;
            }
        }
        return $result;
    }

    function GetActiveConfirmedOrderlistByProductID($product_id) {
        ini_set('max_execution_time', 0);
        $this->db->where('product_id', $product_id);
        $this->db->where('order_id !=', '');
        $this->db->where('order_id !=', '0');
        $this->db->where_in('payment_status', $this->common_model->green_order_status_id_array);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $query = $this->db->get('ec_order_list');

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function successMail($orderid, $address_type = "") {
        //{oldoption}
        //$data['options'] = $this->common_model->get_options();
        // $data['option'] = $data['options'][0];
        //{oldoption}

        $data['option'] = $this->option;


        $data['option_header'] = $this->common_model->option_header();
        $data['option_footer'] = $this->common_model->option_footer();
        $data['myorders'] = $ec_orders_row = $this->common_model->GetByRow('ec_orders', $orderid, 'id');
        $data['ec_cart_order_status'] = $ec_cart_order_status = $this->common_model->GetByRow('ec_cart_order_status', $ec_orders_row->payment_status, 'id');

        $logged_user_data = $this->ion_auth->user()->row();
        $user_address = json_decode($logged_user_data->address, TRUE);
        $billing_address_json = $ec_orders_row->billing_address;
        $billing_address = json_decode($billing_address_json, TRUE);
        $shipping_address_json = $ec_orders_row->shipping_address;
        $shipping_address = json_decode($shipping_address_json, TRUE);
        $shipping_email = $shipping_address["frm_email"];
        $billing_email = $billing_address["frm_email"];

        switch ($address_type) {
            case 'shipping':
                $customer_email = $shipping_email;
                $customer_name = $shipping_address['frm_first_name'] . ' ' . $shipping_address['frm_last_name'];

                break;
            case 'billing':
            default:
                $customer_email = $billing_email;
                $customer_name = $billing_address['frm_first_name'] . ' ' . $billing_address['frm_last_name'];
                break;
        }
        $order_status_text = ucwords($ec_cart_order_status->status_title);
        
		//if ($data['myorders']->order_id == 0) {
//
//            $order_number = $data['option']->tmp_order_string . $data['myorders']->id;
//        } else {
//            $order_number = $data['option']->org_order_string . $data['myorders']->order_id;
//        }		
		//sbn orderid
		$order_number = $this->common_model->format_order_number($data['myorders']->order_id,$data['myorders']->id);
		//sbn orderid
		
        /*
         * order mail delivery area
         */
        switch ($ec_orders_row->payment_status) {
            case '3':
            case '7':
            case '11':
                $order_status = 'success';
                break;
            default:
                $order_status = 'fail';
                break;
        }

        $option_contact_email = $data['option']->contact_email;
        $option_contact_from_email = $data['option']->contact_from_email;

        $from_mail = $option_contact_from_email;
        $reply_mail = $option_contact_from_email;


        if ($order_status == "success") {


            /*
             * order succcessmail to admin
             */
            $subject = ucwords($data['option']->project_name) . " - " . ' Order ' . $order_number . ' ' . $order_status_text . ' of ' . $customer_name;
            $data['customer_name'] = $customer_name;
            $data['mail_user'] = 'admin';
            $message = $this->load->view('index/success_mail', $data, true);
            $to_mail = $option_contact_email;
            $to_name = $customer_name;
            $this->common_model->sendmails_1($reply_mail, $to_mail, $to_name, $message, $subject, $from_mail);
            /*
             * EOF order succcessmail to admin
             */


            /*
             * order succcessmail to user
             */
            $subject = ucwords($data['option']->project_name) . " - " . $order_status_text . ' of order ' . $order_number;
            $data['customer_name'] = $customer_name;
            $data['mail_user'] = 'user';
            $message1 = $this->load->view('index/success_mail', $data, true);
            $to_mail = $customer_email;
            $to_name = $customer_name;
            $this->common_model->sendmails_1($reply_mail, $to_mail, $to_name, $message1, $subject, $from_mail);
            /*
             * EOF order succcessmail to user
             */
        }
        /*
         * EOF order mail delivery area
         */
    }

    function sendmails_1($reply, $to, $name, $content, $subject, $from_mail) {

        //{oldoption}
        //$data['options'] = $this->common_model->get_options();
        //$data['option'] = $data['options'][0];
        //{oldoption}

        $data['option'] = $this->option;


//        $from_mail = $data['option']->contact_from_email;
        $this->load->library('email');
        $this->email->from($from_mail, ucwords($data['option']->project_name));
        $this->email->to($to);
        $this->email->cc($to);
        $this->email->reply_to($reply);
        $this->email->subject($subject);
        $this->email->message($content);

        if (!$this->email->send()) {

            return "NO";
        } else {

            return "YES";
        }
    }

    public function option_header() {
        $this->db->where('page', 'header');

        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $query = $this->db->get('cms_options_meta');

        if ($query->num_rows() > 0) {
            $optionmeta = $query->result();
            return $this->common_model->option_meta_filter($optionmeta);
        }
    }

    public function option_footer() {
        $this->db->where('page', 'footer');

        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $query = $this->db->get('cms_options_meta');

        if ($query->num_rows() > 0) {
            $optionmeta = $query->result();
            return $this->common_model->option_meta_filter($optionmeta);
        }
    }

    public function option_meta_filter($optionmeta) {
        $metacharsetstring = "";
        $metastring = "";
        $cssstring = "";
        $jsstring = "";
        $scriptstring = "";

        foreach ($optionmeta as $optionmeta_row) {
            $library = $optionmeta_row->library;
            $page = $optionmeta_row->page;
            $type = $optionmeta_row->type;
            $id = $optionmeta_row->id;
            switch ($library) {
                case 'metacharset':

                    $metacharsetstring .= $optionmeta_row->filepath;

                    break;
                case 'meta':

                    $metastring .= $optionmeta_row->filepath;

                    break;

                case 'css':

                    switch ($type) {
                        case 'internal':
                            $cssstring .= '<link href="' . base_url() . str_replace(' ', '', $optionmeta_row->filepath) . '" rel="stylesheet">';
                            break;

                        case 'external':
                            $cssstring .= '<link href="' . str_replace(' ', '', $optionmeta_row->filepath) . '" rel="stylesheet">';
                            break;
                        case 'manual':
                            $cssstring .= $optionmeta_row->filepath;
                            break;
                    }

                    break;

                case 'js':

                    switch ($type) {
                        case 'internal':
                            $jsstring .= '<script src="' . base_url() . str_replace(' ', '', $optionmeta_row->filepath) . '"></script>';
                            break;

                        case 'external':
                            $jsstring .= '<script src="' . str_replace(' ', '', $optionmeta_row->filepath) . '"></script>';
                            break;
                        case 'manual':
                            $jsstring .= $optionmeta_row->filepath;
                            break;
                    }

                    break;
                case 'script':
                    $scriptstring .= $optionmeta_row->filepath;

                    break;
            }
        }

        $data['metacharset'] = $metacharsetstring;
        $data['meta'] = $metastring;
        $data['css'] = $cssstring;
        $data['js'] = $jsstring;
        $data['script'] = $scriptstring;
        return $data;
    }

    function GetVaryProductRowByArray($option_value_array,
            $gl_product_associate_id) {
        foreach ($option_value_array as $option_value_row) {
            $option_value_row_array = explode('-', $option_value_row);
            $column_name = $option_value_row_array[0];
            $column_value = $option_value_row_array[1];

            $this->db->where($column_name, $column_value);
        }

        $this->db->where('product_associate_id', $gl_product_associate_id);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $query = $this->db->get('ec_products');
        return $query;
    }

    /* EOF TakeoffSports */

    function get_currency_by_key($key) {

        $currency_list_arr = json_decode($this->option->currency_list, TRUE);

        $currency_arr_detail = '';
        if (!empty($currency_list_arr)) {
            $cur_currency = array_search($key, array_filter(array_combine(array_keys($currency_list_arr), array_column($currency_list_arr, 'key'))));
            if (!empty($currency_list_arr[$cur_currency])) {
                $currency_arr_detail = $currency_list_arr[$cur_currency];
            }
        }
        return $currency_arr_detail;
    }

    public function offer_cron_job() {

        $this->db->where('discounttype', 99); // extended offer type
        $this->db->where('offer_start_date', date('Y-m-d'));
//        $this->db->where('offer_start_date', date('2019-03-06'));
        $offer_start_result = $this->db->get('ec_products')->result();

        if (!empty($offer_start_result)) {
            foreach ($offer_start_result as $offer_start_prod) {

                $discount = $offer_start_prod->discount;
                $actual_price = $offer_start_prod->original_price;
                $discountby = $offer_start_prod->discountby;

                $sub_total = $actual_price;
                $selling_prize = $this->common_model->selling_prize_calc($discountby, $discount, $sub_total);
                $actual_price = round($sub_total);

                $product_status = 'out_of_stock';
                $product_status_id = '105';
                $availability = 'out_of_stock';
                $active_status = 'd';
                $qty = 0;

                if ($offer_start_prod->qty > 0) {
                    $product_status = 'offer';
                    $product_status_id = '103';
                    $availability = 'in_stock';
                    $active_status = 'a';
                    $qty = $offer_start_prod->qty;
                }

                $offer_start_data = array(
                    'selling_price' => $selling_prize,
                    'original_price' => $actual_price,
                    'sub_total' => $sub_total,
                    'product_status' => $product_status,
                    'product_status_id' => $product_status_id,
                    'availability' => $availability,
                    'active_status' => $active_status,
                    'qty' => $qty
                );
                $this->db->where('id', $offer_start_prod->id);
                $this->db->update('ec_products', $offer_start_data);
            }
        }


        $this->db->where('discounttype', 99); // extended offer type
        $this->db->where('out_of_stock_date', date('Y-m-d'));
//        $this->db->where('out_of_stock_date', date('2019-03-06'));
        $out_of_stock_result = $this->db->get('ec_products')->result();

        if (!empty($out_of_stock_result)) {
            foreach ($out_of_stock_result as $out_of_stock_prod) {

                $out_of_stock_data = array(
                    'selling_price' => $out_of_stock_prod->original_price,
                    'product_status' => 'out_of_stock',
                    'product_status_id' => '105',
                    'availability' => 'out_of_stock',
                    'active_status' => 'd',
                    'qty' => '0'
                );
                $this->db->where('id', $out_of_stock_prod->id);
                $this->db->update('ec_products', $out_of_stock_data);
            }
        }
    }

    /*
     *  quick link codes
     */

    function get_quick_links($quick_link_type, $content_id) {

      /*   $this->db->where('link_type', $quick_link_type);
        $this->db->where('link_parent_id', $content_id);
//        $this->db->where('trash_status','no');
//        $this->db->where('active_status','a');
        $query = $this->db->get('cms_quick_links')->row();


        return $query;/**/
    }

    function manage_quick_link($id, $quick_link_name, $controller_name,
            $function_name, $quick_link_type, $insert_type, $url) {

      /*   $this->db->select_max('order_no');
        $order_no_max = $this->db->get('cms_quick_links')->row();

        if ($insert_type == 'addtype') {


            if (!empty($order_no_max)) {
                $order_no = $order_no_max->order_no + 1;
            } else {
                $order_no = 1;
            }


            $quick_link_data = array(
                'link_parent_id' => $id,
                'module_type' => $controller_name,
                'link_type' => $quick_link_type,
                'url' => $url,
                'url_name' => $this->input->post('quick_link_name'),
                'order_no' => $order_no,
            );

            $this->db->insert('cms_quick_links', $quick_link_data);
        } else if ($insert_type == 'edittype') {

            $row_exists = $this->db->get('cms_quick_links')->num_rows();

            if (empty($row_exists)) {
                $order_no = 1;

                $quick_link_data = array(
                    'link_parent_id' => $id,
                    'module_type' => $controller_name,
                    'url' => $url,
                    'link_type' => $quick_link_type,
                    'url_name' => $this->input->post('quick_link_name'),
                    'order_no' => $order_no,
                );

                $this->db->insert('cms_quick_links', $quick_link_data);
            } else {
                $this->db->where('link_parent_id', $id);
                $this->db->where('link_type', $quick_link_type);
                $link_exists = $this->db->get('cms_quick_links')->row();


                if (empty($link_exists)) {
                    $order_no = $order_no_max->order_no + 1;
                    $quick_link_data = array(
                        'link_parent_id' => $id,
                        'module_type' => $controller_name,
                        'url' => $url,
                        'link_type' => $quick_link_type,
                        'url_name' => $this->input->post('quick_link_name'),
                        'order_no' => $order_no,
                    );

                    $this->db->insert('cms_quick_links', $quick_link_data);
                } else {

                    $order_no = $link_exists->order_no;
                    $quick_link_data = array(
                        'url' => $url,
                        'module_type' => $controller_name,
                        'link_type' => $quick_link_type,
                        'url_name' => $this->input->post('quick_link_name'),
                        'order_no' => $order_no,
                        'trash_status' => 'no',
                        'active_status' => 'a',
                    );
                    $this->db->where('id', $link_exists->id);
                    $this->db->update('cms_quick_links', $quick_link_data);
                }
            }
        }/**/
    }

    function quick_link_delete($id, $quick_link_type, $action_type) {

      /*   $this->db->where('link_type', $quick_link_type);
        $this->db->where('link_parent_id', $id);
        $delete_row = $this->db->get('cms_quick_links')->row();

        if (!empty($delete_row)) {
            switch ($action_type) {
                case 'trash':

                    $delete_data = array(
                        'trash_status' => 'yes',
                        'active_status' => 'd',
                    );

                    $this->db->where('id', $delete_row->id);
                    $this->db->update('cms_quick_links', $delete_data);

                    break;

                case 'restore':
                    $delete_data = array(
                        'trash_status' => 'no',
                        'active_status' => 'a',
                    );

                    $this->db->where('id', $delete_row->id);
                    $this->db->update('cms_quick_links', $delete_data);

                    break;

                case 'delete':

                    $this->db->where('id', $delete_row->id);
                    $this->db->delete('cms_quick_links');

                    break;
            }
            return true;
        }/**/
    }

    /*
     * EOF quick link codes
     */

    /*
     * Dynamic wiazrd looping
     * 03-05-2019
     */

    public function prod_form_attr($need_array) {
        $input_id = "";
        $productId = "";
        $wizard_id = "";
        $custom_common_input_array = array();
        if (!empty($need_array['inputFieldId'])) {
            $input_id = $need_array['inputFieldId'];
        }
        if (!empty($need_array['productId'])) {
            $productId = $need_array['productId'];
        }
        if (!empty($need_array['wizard_id'])) {
            $wizard_id = $need_array['wizard_id'];
        }
        if (!empty($need_array['custom_common_inputs'])) {
            $custom_common_input_array = $need_array['custom_common_inputs'];
        }

        $data['custom_common_input_array'] = $custom_common_input_array;
        $data['common_input'] = $this->common_model->GetByRow_notrash('cms_commoninputs', $input_id, 'id');
        $data['wizard_details'] = $this->common_model->GetByRow('ec_wizard', $wizard_id, 'id');
        $data['product_id'] = $productId;
        $data['wizard_type_id'] = $wizard_id;




        $data['main_categories'] = $this->admin_model->get_all_main_categories();
        $data['target'] = $this->common_model->targetlist();
        $data['menulist'] = $this->common_model->get_all_menus();
        $data['pagelist'] = $this->common_model->pagelist();
        $data['values'] = $this->uploadlibrary_model->Get_fileData();
        $data['wrappertaglist'] = $this->common_model->listwrappertag();
        $data['slidervalues'] = $this->common_model->slidervalues();
        $data['list_all_menu_type'] = $this->common_model->listMenuTypes();
        $data['featurebox_list'] = $this->common_model->getFeatureboxList();
        $data['list_all_menu'] = $this->common_model->listAllMenu();
        $data['cms_featureboxes'] = $this->common_model->listAllFeatureboxes();

        if ($data['wizard_details']->wizard_type == "product_form_type" || $data['wizard_details']->wizard_type == "content_form_type") {
//           $data['product'] = $this->common_model->GetByRow_notrash('ec_products', $productId, 'id');

            $input_type = $data['common_input']->field_format_type;

            if ($data['common_input']->name == "discount_column") {
                $this->load->view('commoninputadmin/attr_commoninput_select', $data);
            } else {
                switch ($input_type) {

                    case "text": $this->load->view('commoninputadmin/common_inputs/attr_text', $data);
                        break;
                    case "email": $this->load->view('commoninputadmin/common_inputs/attr_email', $data);
                        break;
                    case "password": $this->load->view('commoninputadmin/common_inputs/attr_password', $data);
                        break;
                    case "number": $this->load->view('commoninputadmin/common_inputs/attr_number', $data);
                        break;
                    case "textarea": $this->load->view('commoninputadmin/common_inputs/attr_textarea', $data);
                        break;
                    case "select": $this->load->view('commoninputadmin/common_inputs/attr_select', $data);
                        break;
                    case "url": $this->load->view('commoninputadmin/common_inputs/attr_url', $data);
                        break;
                    case "checkbox": $this->load->view('commoninputadmin/common_inputs/attr_checkbox', $data);
                        break;
                    case "radio": $this->load->view('commoninputadmin/common_inputs/attr_radio', $data);
                        break;
                    case "ckeditor": $this->load->view('commoninputadmin/common_inputs/attr_ckeditor', $data);
                        break;
                    case "wrappertag_combo_with_text": $this->load->view('commoninputadmin/common_inputs/attr_wrappertag_combo', $data);
                        break;
                    case "wrappertag_combo_with_textarea": $this->load->view('commoninputadmin/common_inputs/attr_wrappertag_combo', $data);
                        break;
                    case "textarea_text_combo": $this->load->view('commoninputadmin/common_inputs/attr_textarea_text', $data);
                        break;
                    case "datepicker1": $this->load->view('commoninputadmin/common_inputs/attr_datepicker1', $data);
                        break;
                    case "datepicker2": $this->load->view('commoninputadmin/common_inputs/attr_datepicker2', $data);
                        break;
                    case "colorpicker1": $this->load->view('commoninputadmin/common_inputs/attr_colorpicker1', $data);
                        break;
                    case "product_addon_combo": $this->load->view('commoninputadmin/common_inputs/attr_product_addon_combo', $data);
                        break;
                    case "content_image_1": $this->load->view('commoninputadmin/common_inputs/attr_content_image1', $data);
                        break;
                    case "content_image_2": $this->load->view('commoninputadmin/common_inputs/attr_content_image2', $data);
                        break;
                    case "icon_set": $this->load->view("commoninputadmin/common_inputs/attr_iconset", $data);
                        break;
                    case "custom_link": $this->load->view('commoninputadmin/common_inputs/attr_customlink', $data);
                        break;
                    case "content_video": $this->load->view('commoninputadmin/common_inputs/attr_content_video', $data);
                        break;
                    case "content_menu_type": $this->load->view('commoninputadmin/common_inputs/attr_content_menutype', $data);
                        break;
                    case "content_featurebox": $this->load->view('commoninputadmin/common_inputs/attr_content_featurebox', $data);
                        break;
                    case "product_image_1": $this->load->view('commoninputadmin/common_inputs/attr_product_image1', $data);
                        break;
                    case "product_image_2": $this->load->view('commoninputadmin/common_inputs/attr_product_image2', $data);
                        break;
                    case "product_video": $this->load->view('commoninputadmin/common_inputs/attr_product_video', $data);
                        break;
                    case "product_associate": $this->load->view('commoninputadmin/common_inputs/attr_associative_product', $data);
                        break;
                    case "product_seo": $this->load->view('commoninputadmin/common_inputs/attr_seo_product', $data);
                        break;
                    case "product_level": $this->load->view('commoninputadmin/common_inputs/attr_level_product', $data);
                        break;
                    case "connection_featurebox": $this->load->view('commoninputadmin/common_inputs/attr_connection_featurebox', $data);
                        break;
                    case "content_sub_content": $this->load->view('commoninputadmin/common_inputs/attr_content_sub_content', $data);
                        break;
                    case "make_associate": $this->load->view('commoninputadmin/common_inputs/attr_make_associate', $data);
                        break;
                }
            }
        }
    }

    function showcategory_wizard($ctype, $level) {
        $this->db->select('cat.*,cattype.name as ctype_name');
        $this->db->where('cat.parent_id', 0);
        $this->db->where('cat.active_status', 'a');
        $this->db->where('cat.trash_status', 'no');
        $this->db->where('cat.parent_id', 0);
        $this->db->where('cat.ctype', $ctype);
        $this->db->join('ec_categorytypes cattype', 'cat.ctype = cattype.id', 'INNER');
        $rsMain = $this->db->get('ec_category cat')->result();
        if ($level != 1) {
            if (count($rsMain) >= 1) {
                foreach ($rsMain as $rows_main) {
                    $this->arr_w[] = array(
                        'name' => $rows_main->category,
                        'id' => $rows_main->id,
                        'ctype' => $rows_main->ctype,
                        'parent_id' => $rows_main->parent_id);
                    $this->showsubs_wizard($rows_main->id, $ctype, $level);
                }

                return $this->arr_w;
            }
        } else {

            foreach ($rsMain as $rows_main) {
                $this->arr_w[] = array(
                    'name' => $rows_main->category,
                    'id' => $rows_main->id,
                    'ctype' => $rows_main->ctype,
                    'parent_id' => $rows_main->parent_id);
            }
            return $this->arr_w;
        }
    }

    public function showsubs_wizard($cat_id, $ctype, $level, $dashes = '') {

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
                $this->arr_w[] = array(
                    'name' => $dashes . $rows_sub->category,
                    'id' => $rows_sub->id,
                    'ctype' => $rows_sub->ctype,
                    'parent_id' => $rows_sub->parent_id);
                if ($level == 'all') {
                    $this->showsubs_wizard($rows_sub->id, $ctype, $level, $dashes);
                }
            }
        }
    }

    function check_subcategories($category_id) {
        $this->db->where('parent_id', $category_id);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('ec_category')->num_rows();
    }

    function show_prod_type($prod_attr, $product_data) {
        if (!empty($product_data)) {

            $prod_sub_id = $product_data->parent_sub_id;
            $product_id = $product_data->id;
            if (!empty($prod_sub_id)) {
                $this->db->where('parent_sub_id', $prod_sub_id);
                $this->db->where('id !=', $product_id);
            }
        }
        $this->db->where('product_categorytype_id', $prod_attr);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('ec_products')->result();
    }

    /*
     * EOF Dynamic wiazrd looping
     */

    function listwrappertag() {

        $where_array = array(
            'wrapper',
            'tag'); //, 'split_wrapper'
        $this->db->where_in('type', $where_array);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('cms_wrappertagbox')->result();
    }

    function listsplitwrappertag() {

        $where_array = array(
            'split_wrapper');
        $this->db->where_in('type', $where_array);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('cms_wrappertagbox')->result();
    }

    function update_display_level($product_id) {

        $product_details = $this->common_model->GetByRow_notrash('ec_products', $product_id, 'id');

        if ($product_details->qty == 0 && $product_details->display_level == 'master') {

            $conditional_array = array(
                'product_associate_id' => $product_details->product_associate_id,
                'qty !=' => '0',
                'display_level' => 'master',
            );


            $prod_associative_list = $this->common_model->GetByReturnTypeOrderType('ec_products', 'id', 'DESC', $conditional_array, 'result');


            if (empty($prod_associative_list)) {

                $conditional_array2 = array(
                    'product_associate_id' => $product_details->product_associate_id,
                    'qty !=' => '0',
                );
                $prod_associative_list2 = $this->common_model->GetByReturnTypeOrderType('ec_products', 'id', 'DESC', $conditional_array2, 'row');


                $data1 = array(
                    'display_level' => ''
                );

                $data2 = array(
                    'display_level' => 'master'
                );



                $this->db->where('id', $product_id);
                $this->db->update('ec_products', $data1);

                $this->db->where('id', $prod_associative_list2->id);
                $this->db->update('ec_products', $data2);
            }
        }
    }

    function default_page_view_array($array_name) {/*

      $data_array = json_decode($this->common_model->option->fixed_page_data, TRUE);

      switch ($array_name) {
      case 'content_list':

      $return_arr = $data_array[$array_name];

      break;
      case 'content_detail':
      $return_arr = $data_array[$array_name];

      case 'product_list':

      $return_arr = $data_array[$array_name];

      case 'product_detail':

      $return_arr = $data_array[$array_name];
      break;

      case 'product_list_header':

      $return_arr = $data_array[$array_name];
      break;
      }

      return $return_arr;
     */ }

    //add to cart section  
    function common_ec_action() {
        $action_type = $this->input->post("action_type");

        if ($action_type == "add_to_cart" || $action_type == "add_to_wishlist" || $action_type == "add_to_compare" || $action_type == "check_qty" || $action_type == "delete_from_cart" || $action_type == "delete_from_wishlist" || $action_type == "delete_from_compare") {

            $pid = $this->input->post("pid");
            $qty = $this->input->post("qty");
            $product_detail = $this->common_model->GetByRow('ec_products', $pid, 'id');
        }

        $boxcheck = 0;

        //add_to_cart       
        if ($action_type == "add_to_cart") {

//

            $cart_array = $this->cart->contents();

            $cart_array = array_values($cart_array);

            $cart_key = array_search($pid, array_filter(array_combine(array_keys($cart_array), array_column($cart_array, 'pid'))));


            $check_product_qty = 0;
            if ($cart_key !== FALSE) {
                $check_product_qty += $cart_array[$cart_key]['qty'];
            }

            $check_product_qty += $qty;


            if ($check_product_qty > $product_detail->qty) {

                echo 'nostock';

                $boxcheck = 1;
            } else {

//	

                if ($this->ion_auth->logged_in()) {
                    $logged_user_data = $this->common_model->logged_user_data;
                    $userid = $logged_user_data->id;
                } else {
                    $userid = session_id();
                }


                $product_images = $product_detail->prod_file;
                $pro_img = json_decode($product_images, true);
                $cart_qty = $qty;


$process_pickup_delivery_type = "";
$pickup_delivery_city_id = "";	
			
if($this->common_model->option->order_pickup_status == 'yes')
{

//		
$gl_cart_session = $this->session->userdata('gl_cart');

if (!empty($gl_cart_session["process"])) {
    $process = json_decode($gl_cart_session["process"], true);
    $process_pickup_delivery_type = $process['process_type'];
   
}
//


//

if (!empty($gl_cart_session['location_group'])) {
	
    $location_group_array = $gl_cart_session['location_group'];
    $location_group_row = json_decode($location_group_array, true);
    $pickup_delivery_city_id = $location_group_row['city'];
    
}
//



	
}
				

                $data = array(
                    'id' => $product_detail->id,
                    'qty' => $cart_qty,
                    'price' => $product_detail->selling_price,
                    'name' => '1',
                    'pname' => $product_detail->prod_name,
                    'pid' => $product_detail->id,
                    'parent_sub_id' => $product_detail->parent_sub_id,
                    'parent_main_id' => $product_detail->parent_main_id,
                    'image' => $pro_img['image'],
                    'ptype' => $product_detail->product_categorytype_id,
					'process_pickup_delivery_type' => $process_pickup_delivery_type,
					'pickup_delivery_city_id' => $pickup_delivery_city_id,
                );

                $this->cart->insert($data);
            }
        }
//add_to_cart
//addtoCustomerproductbox
        if ($boxcheck == 0) {

            if ($action_type == "add_to_cart" || $action_type == "add_to_wishlist" || $action_type == "add_to_compare") {

                $this->common_model->addProductToUserdata($pid, $product_detail, $action_type);

                $this->common_model->addtoCustomerproductbox($pid, $qty, $action_type);
            }
        }
//addtoCustomerproductbox
//check cart product qty		
        if ($action_type == "check_qty") {

            if ($qty > $product_detail->qty) {
                echo '1';
//no
            } else {
                echo '2';
//yes	
            }
        }
//check cart product qty
//cart total price
        if ($action_type == "total_cart_price") {

            $carttotalprice = $this->cart->total();
            $cart_coupon_amount=$this->common_model->gl_cart_coupon_amount();
            $carttotalprice =$carttotalprice-$cart_coupon_amount;

//echo number_format($carttotalprice, 2, '.', ',');

            
			

//cart based delivery charge

$this->common_model->calculate_cart_based_delivery_charge($carttotalprice);

//cart based delivery charge

$gl_cart_session = $this->session->userdata('gl_cart');

//

if (isset($gl_cart_session['delivery_charge'])) {
if (!empty($gl_cart_session['delivery_charge'])) {
$delivery_charge = $gl_cart_session['delivery_charge'];	
if($carttotalprice > 0)
{
$carttotalprice = $carttotalprice + $delivery_charge ;	
}
}
}

//

			

            $gl_cart_product_session_variables_array_by_type = $gl_cart_session['gl_cart_product_session_variables_array_by_type'];

            $cart_total_split_array = array();

            $cart_total_split_array['total_cart_price'] = $this->common_model->fetch_num_format($carttotalprice);
			
			
$gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'total_cart_amount', $carttotalprice);
$this->session->set_userdata('gl_cart', $gl_cart_session);	
$gl_cart_session = $this->session->userdata('gl_cart');			
			

            foreach ($gl_cart_product_session_variables_array_by_type as
                        $session_variables_array_by_type) {

                $gl_cart_product_session_variable_by_type = $gl_cart_session[$session_variables_array_by_type];

                $total = 0;
                if (is_array($gl_cart_product_session_variable_by_type)) {

//

                    foreach ($gl_cart_product_session_variable_by_type as
                                $product_id) {

                        $session_product_detail = $this->common_model->GetByRow('ec_products', $product_id, 'id');

//

                        $cart_array = $this->cart->contents();

                        $cart_array = array_values($cart_array);

                        $cart_key = array_search($product_id, array_filter(array_combine(array_keys($cart_array), array_column($cart_array, 'pid'))));

                        if ($cart_key !== FALSE) {

                            $product_qty = $cart_array[$cart_key]['qty'];

                            $total += $session_product_detail->selling_price * $product_qty;
                        }

//
                    }

//	
                } else {

//

                    $product_id = $gl_cart_product_session_variable_by_type;

                    $session_product_detail = $this->common_model->GetByRow('ec_products', $product_id, 'id');

                    $cart_array = $this->cart->contents();

                    $cart_array = array_values($cart_array);

                    $cart_key = array_search($product_id, array_filter(array_combine(array_keys($cart_array), array_column($cart_array, 'pid'))));

                    if ($cart_key !== FALSE) {

                        $product_qty = $cart_array[$cart_key]['qty'];

                        $total += $session_product_detail->selling_price * $product_qty;
                    }

//	
                }

                $cart_total_split_array[$session_variables_array_by_type] =$this->common_model->fetch_num_format($total);
            }


            echo json_encode($cart_total_split_array);
        }
//cart total price
//update cart qty
        if ($action_type == "update_qty") {

            $cartrowid = $this->input->post("cartrowid");
            $cartqty = $this->input->post("qty");

            $qtydata = array(
                'rowid' => $cartrowid,
                'qty' => $cartqty,
            );

            $this->cart->update($qtydata);
        }
//update cart qty
//delete from cart
        if ($action_type == "delete_from_cart") {

            $cartrowid = $this->input->post("cartrowid");
            $cartqty = 0;

            $qtydata = array(
                'rowid' => $cartrowid,
                'qty' => $cartqty,
            );

            $this->cart->update($qtydata);


            $this->common_model->addProductToUserdata($pid, $product_detail, $action_type);

            $this->common_model->RemovetoCustomerproductbox($pid, $action_type);

//
        //
					
}
//delete from cart
//delete from Wishlist
        if ($action_type == "delete_from_wishlist" || $action_type == "delete_from_compare") {

            $this->common_model->addProductToUserdata($pid, $product_detail, $action_type);

            $this->common_model->RemovetoCustomerproductbox($pid, $action_type);
        }
//delete from Wishlist
//total_cart_count
        if ($action_type == "total_cart_count") {

             $total_cart_items = 0;
              foreach($this->cart->contents() as $cart_row)
              {

              $total_cart_items+=$cart_row['qty'];

              } 
			  
			  echo $total_cart_items;

            //echo count($this->cart->contents());
        }
//total_cart_count
//total_wishlit_count
        if ($action_type == "total_wishlit_count") {

//	

            if ($this->ion_auth->logged_in()) {

                $logged_user_data = $this->common_model->logged_user_data;
                $userid = $logged_user_data->id;
            } else {

                $userid = session_id();
            }

            $type = 'wishlist';


            $table_condition_array = array();
            $table_condition_array[] = array(
                "condition_clause" => "where",
                "condition_string" => "user_id",
                "condition_value" => $userid,
                "condition_option" => "",
            );
            $table_condition_array[] = array(
                "condition_clause" => "where",
                "condition_string" => "type",
                "condition_value" => $type,
                "condition_option" => "",
            );


            $table_condition_array[] = array(
                "condition_clause" => "where",
                "condition_string" => "trash_status",
                "condition_value" => "no",
                "condition_option" => "",
            );
            $table_condition_array[] = array(
                "condition_clause" => "where",
                "condition_string" => "active_status",
                "condition_value" => "a",
                "condition_option" => "",
            );
            $table_parameter_array = array(
                "table_condition_array" => $table_condition_array,
                "table" => "ec_customer_product_box",
                "table_return_type" => "result"
            );
            $results = $this->common_model->getCommonTableData($table_parameter_array);

            echo count($results);


//	
        }
//total_wishlit_count
//total_cart_split_count
        if ($action_type == "total_cart_split_count") {

            $gl_cart_session = $this->session->userdata('gl_cart');

            $gl_cart_product_session_variables_array_by_type = $gl_cart_session['gl_cart_product_session_variables_array_by_type'];

            $total_cart_split_count_array = array();

            foreach ($gl_cart_product_session_variables_array_by_type as
                        $session_variables_array_by_type) {

                $gl_cart_product_session_variable_by_type = $gl_cart_session[$session_variables_array_by_type];

                $total = 0;
                if (is_array($gl_cart_product_session_variable_by_type)) {

//

                    foreach ($gl_cart_product_session_variable_by_type as
                                $product_id) {

                        $cart_array = $this->cart->contents();

                        $cart_array = array_values($cart_array);

                        $cart_key = array_search($product_id, array_filter(array_combine(array_keys($cart_array), array_column($cart_array, 'pid'))));

                        if ($cart_key !== FALSE) {

                            $product_qty = $cart_array[$cart_key]['qty'];

                            $total += $product_qty;
                        }

//
                    }

//	
                } else {

//

                    $product_id = $gl_cart_product_session_variable_by_type;

                    $cart_array = $this->cart->contents();

                    $cart_array = array_values($cart_array);

                    $cart_key = array_search($product_id, array_filter(array_combine(array_keys($cart_array), array_column($cart_array, 'pid'))));

                    if ($cart_key !== FALSE) {

                        $product_qty = $cart_array[$cart_key]['qty'];

                        $total += $product_qty;
                    }

//	
                }

                $total_cart_split_count_array[$session_variables_array_by_type] = $this->common_model->fetch_num_format($total);
            }


            echo json_encode($total_cart_split_count_array);
        }
//total_cart_split_count
//total_cart_product_split_amount
        if ($action_type == "total_cart_product_split_amount") {

            $ci_cart_items = $this->cart->contents();

            $total_cart_product_split_amount_array = array();
            if (!empty($ci_cart_items)) {
                foreach ($ci_cart_items as $item) {

                    $product_detail = $this->common_model->GetByRow('ec_products', $item["pid"], 'id');

                    $product_subtotal_variable = 'gl_product_subtotal_' . $product_detail->id;

                    $total_cart_product_split_amount_array[$product_subtotal_variable] = $this->common_model->fetch_num_format($product_detail->selling_price * $item["qty"]);
                }
            }

            echo json_encode($total_cart_product_split_amount_array);
        }
//total_cart_product_split_amount

//check_minimum_cart
if ($action_type == "check_minimum_cart") {

$continue_checkout_link = base_url() . 'checkout' ;

$continue_to_checkout_status = $this->common_model->check_continue_to_checkout_conditions();

if($continue_to_checkout_status == 'no')
{
$continue_checkout_link = 'javascript:void(0);' ;	
}

echo $continue_checkout_link;
	
}
//check_minimum_cart


    }

    function addProductToUserdata($pid, $product_detail, $action_type) {


        $product_to_push = $pid;
        $cart_product_list = array();
        $cart_product_list_by_type = array();
        $gl_cart_session = array();
        $gl_cart_product_session_variables_array_by_type = array();
        $push_session_variables_array_by_type = 'yes';

        if ($action_type == "add_to_cart" || $action_type == "delete_from_cart") {
            $gl_cart_product_session_variable = 'cart_product_list';

            $gl_cart_product_session_variable_by_type = 'cart_product_list_by_' . $product_detail->product_categorytype_id;
        } else
        if ($action_type == "add_to_wishlist" || $action_type == "delete_from_wishlist") {
            $gl_cart_product_session_variable = 'wishlist_product_list';
        } else
        if ($action_type == "add_to_compare" || $action_type == "delete_from_compare") {
            $gl_cart_product_session_variable = 'compare_product_list';
        }

        if ($this->session->userdata('gl_cart') != FALSE) {

            $gl_cart_session = $this->session->userdata('gl_cart');

            if (isset($gl_cart_session[$gl_cart_product_session_variable])) {

                $cart_product_list = $gl_cart_session[$gl_cart_product_session_variable];

                if (in_array($pid, $cart_product_list)) {

                    $product_to_push = 0;
                }
            }


            if ($action_type == "add_to_cart" || $action_type == "delete_from_cart") {

                if (isset($gl_cart_session[$gl_cart_product_session_variable_by_type])) {

                    $cart_product_list_by_type = $gl_cart_session[$gl_cart_product_session_variable_by_type];
                }




                if (isset($gl_cart_session['gl_cart_product_session_variables_array_by_type'])) {


                    $gl_cart_product_session_variables_array_by_type = $gl_cart_session['gl_cart_product_session_variables_array_by_type'];

                    if (in_array($gl_cart_product_session_variable_by_type, $gl_cart_product_session_variables_array_by_type)) {

                        $push_session_variables_array_by_type = 'no';
                    }
                }
            }
        }


        if ($action_type == "add_to_cart" || $action_type == "delete_from_cart") {

            if ($push_session_variables_array_by_type == 'yes') {
                array_push($gl_cart_product_session_variables_array_by_type, $gl_cart_product_session_variable_by_type);
            }

            $gl_cart_session['gl_cart_product_session_variables_array_by_type'] = $gl_cart_product_session_variables_array_by_type;


            if ($product_detail->product_categorytype_id == '3' || $product_detail->product_categorytype_id == '4') {

                if ($product_to_push > 0) {
                    array_push($cart_product_list_by_type, $product_to_push);

                    $gl_cart_session[$gl_cart_product_session_variable_by_type] = $cart_product_list_by_type;
                } else {

                    if ($action_type == "delete_from_cart") {

                        $item_to_remove_key2 = array_search($pid, $cart_product_list_by_type);
                        if ($item_to_remove_key2 !== FALSE) {
                            unset($cart_product_list_by_type[$item_to_remove_key2]);
                        }

                        $gl_cart_session[$gl_cart_product_session_variable_by_type] = $cart_product_list_by_type;
                    }
                }
            } else {



                if (!empty($cart_product_list_by_type)) {


                    if ($cart_product_list_by_type != $pid) {

                        $cart_array = $this->cart->contents();

                        $cart_array = array_values($cart_array);

                        $cart_key = array_search($cart_product_list_by_type, array_filter(array_combine(array_keys($cart_array), array_column($cart_array, 'pid'))));

                        if ($cart_key !== FALSE) {

                            $remove_rowid = $cart_array[$cart_key]['rowid'];

                            $removedata = array(
                                'rowid' => $remove_rowid,
                                'qty' => 0,
                            );

                            $this->cart->update($removedata);


                            $cart_product_list_remove_key = array_search($cart_product_list_by_type, $cart_product_list);
                            if ($cart_product_list_remove_key !== FALSE) {
                                unset($cart_product_list[$cart_product_list_remove_key]);
                            }
                        }
                    }
                }



                if ($action_type == "delete_from_cart") {
                    $gl_cart_session[$gl_cart_product_session_variable_by_type] = '';
                } else {
                    $gl_cart_session[$gl_cart_product_session_variable_by_type] = $pid;
                }
            }
        }


        $returnmsg = '';
        if ($product_to_push > 0) {
            array_push($cart_product_list, $product_to_push);
//
            if ($action_type == "add_to_cart" || $action_type == "add_to_wishlist" || $action_type == "add_to_compare") {
                $returnmsg = 'add';
            }
//
        } else {
//			
            if ($action_type == "add_to_cart" || $action_type == "add_to_wishlist" || $action_type == "add_to_compare") {
                $returnmsg = 'update';
            }
//

            if ($action_type == "delete_from_cart" || $action_type == "delete_from_wishlist" || $action_type == "delete_from_compare") {
//

                $item_to_remove_key = array_search($pid, $cart_product_list);
                if ($item_to_remove_key !== FALSE) {
                    unset($cart_product_list[$item_to_remove_key]);
                }

                $returnmsg = 'remove';
//	
            }
        }

        $gl_cart_session[$gl_cart_product_session_variable] = $cart_product_list;

        //update gl_cart userdata

        $this->session->set_userdata('gl_cart', $gl_cart_session);

//dump($this->session->userdata['gl_cart']);

        echo $returnmsg;
    }

    function addtoCustomerproductbox($pid, $qty, $action_type) {

        $option = $this->common_model->option;

        if ($action_type == "add_to_cart") {
            $type = 'cart';
        } else
        if ($action_type == "add_to_wishlist") {
            $type = 'wishlist';
        } else
        if ($action_type == "add_to_compare") {
            $type = 'compare';
        }



        switch ($type) {

            case 'wishlist':
                $option_limit = $option->wishlist_option;
                break;

            case 'compare':
                $option_limit = $option->compare_option;
                break;

            case 'cart':
                $option_limit = $option->addtocart_option;
                break;

            default:
                break;
        }
        $list_limit = json_decode($option_limit, TRUE);


        if ($this->ion_auth->logged_in()) {

            $logged_user_data = $this->common_model->logged_user_data;
            $userid = $logged_user_data->id;
            $limit = $list_limit['user_limit'];
        } else {

            $userid = session_id();
            $limit = $list_limit['guest_limit'];
        }


        $status = $list_limit['limit_status'];

        $goaction = 'yes';
        if ($status == 'yes') {
            //
            //  condition based userid and type  from  ec_customer_product_box

            $table_condition_array = array();
            $table_condition_array[] = array(
                "condition_clause" => "where",
                "condition_string" => "user_id",
                "condition_value" => $userid,
                "condition_option" => "",
            );
            $table_condition_array[] = array(
                "condition_clause" => "where",
                "condition_string" => "type",
                "condition_value" => $type,
                "condition_option" => "",
            );

            $table_condition_array[] = array(
                "condition_clause" => "where",
                "condition_string" => "trash_status",
                "condition_value" => "no",
                "condition_option" => "",
            );
            $table_condition_array[] = array(
                "condition_clause" => "where",
                "condition_string" => "active_status",
                "condition_value" => "a",
                "condition_option" => "",
            );
            $table_parameter_array = array(
                "table_condition_array" => $table_condition_array,
                "table" => "ec_customer_product_box",
                "table_return_type" => "num_rows"
            );
            $user_box_count = $this->common_model->getCommonTableData($table_parameter_array);

            $goaction = 'yes';
            if ($limit > 0) {
                if ($user_box_count >= $limit) {
                    $goaction = 'no';
                }
            }
        }

        if ($goaction == 'yes') {

            // Existence cheking prodcut under current user.

            $table_condition_array = array();
            $table_condition_array[] = array(
                "condition_clause" => "where",
                "condition_string" => "user_id",
                "condition_value" => $userid,
                "condition_option" => "",
            );
            $table_condition_array[] = array(
                "condition_clause" => "where",
                "condition_string" => "type",
                "condition_value" => $type,
                "condition_option" => "",
            );
            $table_condition_array[] = array(
                "condition_clause" => "where",
                "condition_string" => "product_id",
                "condition_value" => $pid,
                "condition_option" => "",
            );

            $table_condition_array[] = array(
                "condition_clause" => "where",
                "condition_string" => "trash_status",
                "condition_value" => "no",
                "condition_option" => "",
            );
            $table_condition_array[] = array(
                "condition_clause" => "where",
                "condition_string" => "active_status",
                "condition_value" => "a",
                "condition_option" => "",
            );
            $table_parameter_array = array(
                "table_condition_array" => $table_condition_array,
                "table" => "ec_customer_product_box",
                "table_return_type" => "num_rows"
            );
            $user_product_box_check = $this->common_model->getCommonTableData($table_parameter_array);

            $data = array(
                'product_id' => $pid,
                'user_id' => $userid,
                'type' => $type,
                'qty' => $qty,
                'datetime' => date("Y-m-d H:i:s"),
                'trash_status' => 'no',
                'active_status' => 'a',
            );
            if ($user_product_box_check > 0) {

                $this->db->where('product_id', $pid);
                $this->db->where('user_id', $userid);
                $this->db->where('type', $type);
                $this->db->update('ec_customer_product_box', $data);
            } else {
                $this->db->insert('ec_customer_product_box', $data);
            }
        } else {
            echo 'box full';
        }
    }

    function RemovetoCustomerproductbox($pid, $action_type) {

        if ($this->ion_auth->logged_in()) {
            $logged_user_data = $this->common_model->logged_user_data;
            $userid = $logged_user_data->id;
        } else {
            $userid = session_id();
        }


        if ($action_type == "add_to_cart" || $action_type == "delete_from_cart") {
            $type = 'cart';
        } else
        if ($action_type == "add_to_wishlist" || $action_type == "delete_from_wishlist") {
            $type = 'wishlist';
        } else
        if ($action_type == "add_to_compare" || $action_type == "delete_from_compare") {
            $type = 'compare';
        }

        $this->db->where('product_id', $pid);
        $this->db->where('user_id', $userid);
        $this->db->where('type', $type);
        $this->db->delete('ec_customer_product_box');
    }

    //add to cart section  
    function add_wrp_from_structure($wrapper_name, $start_section, $end_section) {



        $data = array(
            'type' => 'wrapper',
            'name' => $wrapper_name,
            'start_section' => $start_section,
            'end_section' => $end_section,
            'default_status' => 'no',
            'trash_status' => 'no',
            'active_status' => 'a'
        );




        $this->db->insert('cms_wrappertagbox', $data);
        $insert_id = $this->db->insert_id();

        $this->common_model->createWrapperTagOptionArray('cms_wrappertagbox', $insert_id, 'add');

        return $insert_id;
    }

    function createWrapperTagOptionArray($table, $id, $type) {

        $wrapper_tag_row = $this->common_model->GetByRow($table, $id, 'id');

        //{oldoption}
        //$options = $this->common_model->get_options();
        // $option = $options[0];
        //{oldoption}

        $option = $this->option;

        $wrapper_tag_full_array = json_decode($option->wrapper_tag_full_array, TRUE);
        $wrapper_tagColumn_row = $wrapper_tag_row;
//        $wrapper_tagColumn_row=(array)$wrapper_tag_row;


        $save_option_status = '';
        if (!empty($wrapper_tagColumn_row->save_option_status)) { $save_option_status = $wrapper_tagColumn_row->save_option_status; }

        $data = json_encode($wrapper_tag_full_array);

        if ($save_option_status == 'yes') {

            if ($wrapper_tag_full_array != NULL) {
                if (array_key_exists($id, $wrapper_tag_full_array) && $type == 'add') {
                    // key exist
                    $data = json_encode($wrapper_tag_full_array);
                } else {
                    $wrapper_tag_full_array = $this->common_model->array_push_assoc($wrapper_tag_full_array, $wrapper_tag_row->id, $wrapper_tagColumn_row);
                    $data = json_encode($wrapper_tag_full_array);
                }
            } else {
                $wrapper_tag_full_array = $this->common_model->array_push_assoc($wrapper_tag_full_array, $wrapper_tag_row->id, $wrapper_tagColumn_row);
                $data = json_encode($wrapper_tag_full_array);
            }
        } else {
            if (array_key_exists($id, $wrapper_tag_full_array)) {
                // key exist
                unset($wrapper_tag_full_array[$id]);
                $data = json_encode($wrapper_tag_full_array);
            }
        }

        //{oldoption}
        /* $common_field = array(
          'wrapper_tag_full_array' => $data
          ); */
        //{oldoption}

        $common_field = array(
            'value' => $data
        );


        //{oldoption}
        // $this->db->where('id', $option->id);
        // $this->db->update('cms_options', $common_field);
        //{oldoption}

        $this->db->where('columnlabel', 'wrapper_tag_full_array');
        $this->db->update('cms_options_setting', $common_field);
    }

    function createProdAttrOptionArray($table, $id, $type) {
        $conditional_array = array(
            'type' => $id,
            'trash_status' => 'no',);

        $prod_attr_result = $this->common_model->GetByReturnTypeOrderType($table, 'id', 'DESC', $conditional_array, 'result');

        //{oldoption}
        //$options = $this->common_model->get_options();
        //$option = $options[0];
        //{oldoption}

        $option = $this->option;

        $prod_attr_full_array = json_decode($option->product_attribute_full_array, TRUE);
        $prod_attrColumn_row = $prod_attr_result;




        if (!empty($prod_attr_result)) {

            foreach ($prod_attr_result as $prod_attr_row) {

                if ($prod_attr_full_array != NULL) {
                    if (array_key_exists($id, $prod_attr_full_array) && $type == 'add') {

                        $data = json_encode($prod_attr_full_array);
                    } else {

                        $prod_attr_full_array = $this->common_model->array_push_assoc($prod_attr_full_array, $prod_attr_row->type, $prod_attrColumn_row);
                        $data = json_encode($prod_attr_full_array);
                    }
                } else {

                    $prod_attr_full_array = $this->common_model->array_push_assoc($prod_attr_full_array, $prod_attr_row->type, $prod_attrColumn_row);
                    $data = json_encode($prod_attr_full_array);
                }
            }
        } else {

            if ($prod_attr_full_array != NULL) {
                if (array_key_exists($id, $prod_attr_full_array)) {

                    unset($prod_attr_full_array[$id]);
                }
            }

            $data = json_encode($prod_attr_full_array);
        }

        //{oldoption}
        /* $common_field = array(
          'product_attribute_full_array' => $data
          ); */
        //{oldoption}

        $common_field = array(
            'value' => $data
        );


        //{oldoption}
        // $this->db->where('id', $option->id);
        //$this->db->update('cms_options', $common_field);
        //{oldoption}

        $this->db->where('columnlabel', 'product_attribute_full_array');
        $this->db->update('cms_options_setting', $common_field);
    }

    function getCommonContentHrefLink($urlkey) {

        if ($urlkey) {
            $route_full_array = $this->common_model->option->route_full_array;

            $route_full_array = json_decode($route_full_array, TRUE);
            if (isset($route_full_array[$urlkey])) {

//
                $route_array = $route_full_array[$urlkey];

                $urlkey_array = array(
                    'key' => $urlkey,
                );

                $route_array = array_merge($route_array, $urlkey_array);
//	

                return $route_array;
            } else {
                return;
            }
        } else {
            return;
        }
    }

    function GetUrlByKey($key) {

        $element_data = $this->common_model->getCommonContentHrefLink($key);

        $link_url = 'javascript:void(0);';

        $base_url = base_url();
        if (isset($element_data['url'])) {
            $base_url = $this->common_model->getPageSecuredata($element_data['key'], 'return');
        }

        if (isset($element_data['url'])) {
            $link_url = $base_url . $element_data['url'];
        }


        if (isset($element_data['url_type'])) {
            if ($element_data['url_type'] == 'external') {

                $link_url = $element_data['url'];
            }
        }


        return $link_url;
    }

    function update_type_wrp($wrp_id, $type) {

        if (!empty($wrp_id)) {
            $wrp_row = $this->common_model->GetByRow_notrash('cms_wrappertagbox', $wrp_id, 'id');
            $wrp_row_arr = (array) $wrp_row;

            $this->db->like('wrapper_tag_full_tree', '+' . $wrp_id . '+');

            if ($type == 'structure') {
                $struct_result = $this->db->get('cms_templates')->result();
            } elseif ($type == 'featurebox') {
                $struct_result = $this->db->get('cms_featuredbox')->result();
            }



            if (!empty($struct_result)) {
                foreach ($struct_result as $struct_row) {
                    $wrapper_tag_full_array = json_decode($struct_row->wrapper_tag_full_array, TRUE);
                    if (!empty($wrapper_tag_full_array)) {

//                        $wrp_key = array_search($wrp_id, array_column($wrapper_tag_full_array, 'id'));

                        $wrapper_tag_full_array[$wrp_id] = $wrp_row_arr;
                        $wrapper_tag_full_json = json_encode($wrapper_tag_full_array);
                        $data = array(
                            'wrapper_tag_full_array' => $wrapper_tag_full_json,
                        );

                        $this->db->where('id', $struct_row->id);


                        //{sbn} code

                        if ($type == 'featurebox') {

                            $this->db->update('cms_featuredbox', $data);


                            /* page json section */

                            $featureboxid = $struct_row->id;
                            $setvaluearray = array(
                                "admin_key" => "featurebox_id",
                                "admin_value" => $featureboxid
                            );
                            $this->common_model->adminSessionUpdate($setvaluearray);

                            /* EOF page json section */
                        } elseif ($type == 'structure') {

                            $this->db->update('cms_templates', $data);

                            $struct_row = $this->common_model->GetByRow_notrash('cms_templates', $struct_row->id, 'id');
                            $structure_row_array = (array) $struct_row;
                            $structure_row_json = json_encode($structure_row_array, TRUE);
                            $data_f = array(
                                'featurebox_structure_details' => $structure_row_json
                            );
                            $this->db->where('featured_types', $struct_row->id);
                            $this->db->update('cms_featuredbox', $data_f);

                            /* page json section */

                            $structure_id = $struct_row->id;
                            $setvaluearray = array(
                                "admin_key" => "structure_id",
                                "admin_value" => $structure_id
                            );
                            $this->common_model->adminSessionUpdate($setvaluearray);

                            /* EOF page json section */
                        }

                        /* page json section */


                        /*    $setvaluearray = array(
                          "admin_key" => "featurebox_id",
                          "admin_value" => $featureboxid
                          );
                          $this->common_model->adminSessionUpdate($setvaluearray); */

                        /* EOF page json section */
                        /*
                         * cache function 
                         */
                        /* $cacheparameterarray = array(
                          "cache_value" => $featureboxid,
                          "key" => "featurebox_id"
                          );
                          $this->common_model->updateAllOptionCache($cacheparameterarray); */
                        /*
                         * EOF cache function
                         */
                    }
                }
            }
        }
    }

    function save_type_wrp($id, $type) {

        $wrp_id_arr = array();

        if ($type == 'structure') {
            $structure_row = $this->common_model->GetByRow_notrash('cms_templates', $id, 'id');
            $struc_wrp_column_arr = $this->common_model->get_array_by_name('struc_wrp_column_arr');
            $wrapper_extra_set_arr = json_decode($structure_row->wrapper_extra_set_data, TRUE);

            if (!empty($struc_wrp_column_arr)) {
                foreach ($struc_wrp_column_arr as $struc_wrp_column) {
                    if (!empty($wrapper_extra_set_arr[$struc_wrp_column])) {
                        $wrp_id_arr[] = $wrapper_extra_set_arr[$struc_wrp_column];
                    }
                }
            }
        }


        if ($type == 'structure') {
            //$field_cond = array('featurebox_structure' => $id, 'trash_status' => 'no', 'active_status' => 'a', 'featurebox_type !=' => 'no');

            $featuredbox_structure_row = $this->admin_model->GetByRow('cms_templates', $id, 'id');
        } elseif ($type == 'featurebox') {
            // $field_cond = array('featurebox_id' => $id, 'trash_status' => 'no', 'active_status' => 'a', 'featurebox_type !=' => 'no');

            $featuredbox_structure_row = $this->admin_model->GetByRow('cms_featuredbox', $id, 'id');
        }

        if (!empty($field_cond)) {
            //  $feature_field_list = $this->common_model->GetByReturnTypeOrderType('cms_feature_wrapper', 'id', 'ASC', $field_cond, $returntype = 'result');
        }

        $feature_field_list = json_decode($featuredbox_structure_row->feature_wrapper_details);

        $field_wrp_column_arr = $this->common_model->get_array_by_name('field_wrp_column_arr');
        $fwrp_id_arr = array();


        if (!empty($feature_field_list)) {
            foreach ($feature_field_list as $feature_field) {
                $wrapper_extra_set_data = json_decode($feature_field->wrapper_extra_set_data, TRUE);

                if (!empty($field_wrp_column_arr)) {
                    foreach ($field_wrp_column_arr as $field_wrp_column) {
                        if (!empty($wrapper_extra_set_data[$field_wrp_column])) {
                            $fwrp_id_arr[] = $wrapper_extra_set_data[$field_wrp_column];
                        }
                    }
                }


                $split_wrapper_set_arr = json_decode($feature_field->split_wrapper_set_data, TRUE);
                if (!empty($split_wrapper_set_arr)) {
                    $split_wrp_key = array_keys($split_wrapper_set_arr);
                    $split_wrp_val = array_values($split_wrapper_set_arr);

                    $split_wrp_arr = array_merge($split_wrp_key, $split_wrp_val);
                    $fwrp_id_arr = array_merge($fwrp_id_arr, $split_wrp_arr);
                }
            }
        }


        if ($type == 'featurebox') {

            if (!empty($featuredbox_structure_row->custom_structure_wrapper_tag_full_tree)) {

                $custom_structure_wrapper_tag_full_tree = explode('+', $featuredbox_structure_row->custom_structure_wrapper_tag_full_tree);
                $custom_structure_wrapper_tag_full_tree = array_filter($custom_structure_wrapper_tag_full_tree);
                $custom_structure_wrapper_tag_full_tree = array_unique($custom_structure_wrapper_tag_full_tree);

                $wrp_id_arr = array_merge($wrp_id_arr, $custom_structure_wrapper_tag_full_tree);
            }
        }


        $wrp_id_arr = array_merge($wrp_id_arr, $fwrp_id_arr);
        $wrp_id_arr = array_filter($wrp_id_arr);
        $wrp_id_arr = array_unique($wrp_id_arr);
        $wrp_id_tree = implode('+', $wrp_id_arr);


        if (!empty($wrp_id_arr)) {
            $this->db->where_in('id', $wrp_id_arr);
            $wrapper_result_arr = $this->db->get('cms_wrappertagbox')->result_array();

            $wrapper_id_arr = array_column($wrapper_result_arr, 'id');
            $wrapper_result = array_combine($wrapper_id_arr, $wrapper_result_arr);

            $wrapper_result_json = json_encode($wrapper_result);

            $data = array(
                'wrapper_tag_full_array' => $wrapper_result_json,
                'wrapper_tag_full_tree' => '+' . $wrp_id_tree . '+',
            );

            $this->db->where('id', $id);

            if ($type == 'structure') {
                $this->db->update('cms_templates', $data);

                /* page json section */
                $structure_id = $id;
                $setvaluearray = array(
                    "admin_key" => "structure_id",
                    "admin_value" => $structure_id
                );
                $this->common_model->adminSessionUpdate($setvaluearray);
                /* EOF page json section */
            } elseif ($type == 'featurebox') {
                $this->db->update('cms_featuredbox', $data);


                /* page json section */
                $featureboxid = $id;
                $setvaluearray = array(
                    "admin_key" => "featurebox_id",
                    "admin_value" => $featureboxid
                );
                $this->common_model->adminSessionUpdate($setvaluearray);
                /* EOF page json section */
                /*
                 * cache function 
                 */
                /* $cacheparameterarray = array(
                  "cache_value" => $featureboxid,
                  "key" => "featurebox_id"
                  );
                  $this->common_model->updateAllOptionCache($cacheparameterarray); */
                /*
                 * EOF cache function
                 */
            }
        } else {
            $data = array(
                'wrapper_tag_full_array' => '',
                'wrapper_tag_full_tree' => '',
            );

            $this->db->where('id', $id);

            if ($type == 'structure') {
                $this->db->update('cms_templates', $data);

                /* page json section */
                $structure_id = $id;
                $setvaluearray = array(
                    "admin_key" => "structure_id",
                    "admin_value" => $structure_id
                );
                $this->common_model->adminSessionUpdate($setvaluearray);
                /* EOF page json section */
            } elseif ($type == 'featurebox') {
                $this->db->update('cms_featuredbox', $data);


                /* page json section */
                $featureboxid = $id;
                $setvaluearray = array(
                    "admin_key" => "featurebox_id",
                    "admin_value" => $featureboxid
                );
                $this->common_model->adminSessionUpdate($setvaluearray);
                /* EOF page json section */
                /*
                 * cache function 
                 */
                /* $cacheparameterarray = array(
                  "cache_value" => $featureboxid,
                  "key" => "featurebox_id"
                  );
                  $this->common_model->updateAllOptionCache($cacheparameterarray); */
                /*
                 * EOF cache function
                 */
            }
        }



        if ($type == 'structure') {
            $structure_row = $this->common_model->GetByRow_notrash('cms_templates', $id, 'id');
            $structure_row_array = (array) $structure_row;
            $structure_row_json = json_encode($structure_row_array, TRUE);
            $data_f = array(
                'featurebox_structure_details' => $structure_row_json
            );
            $this->db->where('featured_types', $id);
            $this->db->update('cms_featuredbox', $data_f);


            //{sbn} code
            /* page json section */

            $structure_id = $id;
            $setvaluearray = array(
                "admin_key" => "structure_id",
                "admin_value" => $structure_id
            );
            $this->common_model->adminSessionUpdate($setvaluearray);

            /* EOF page json section */




            /* page json section */
            /* $featurebox_row = $this->admin_model->GetByRow('cms_featuredbox', $id, 'featured_types');
              $featureboxid = $featurebox_row->id;
              $setvaluearray = array(
              "admin_key" => "featurebox_id",
              "admin_value" => $featureboxid
              );
              $this->common_model->adminSessionUpdate($setvaluearray); */
            /* EOF page json section */

            /*
             * cache function 
             */
            /* $cacheparameterarray = array(
              "cache_value" => $featureboxid,
              "key" => "featurebox_id"
              );
              $this->common_model->updateAllOptionCache($cacheparameterarray); */
            /*
             * EOF cache function
             */
        }
    }

    function get_array_by_name($arr_name) {
        // arrays are protected
        $out_arr = array();
        switch ($arr_name) {
            case 'struc_wrp_column_arr':
                $out_arr = array(
                    'wrapper_id',
                    'loop_wrapper_id',
                    'extra_outer_wrapper_id',
                    'loop_wrapper_id_l1',
                    'extra_outer_wrapper_id_l1',
                    'inner_box_wrapper_id',
                    'loop_wrapper_id2',
                    'loop_wrapper_id_l12',
                    'loop_wrapper_id_l2',
                    'third_wrapper_id',
                    'third_class_wrapper',
                    'structure_extra_outer_wrapper_id');
                break;
            case 'field_wrp_column_arr':
                $out_arr = array(
                    'primary_wrapper_id',
                    'primary_class_wrapper',
                    'secondary_wrapper_id',
                    'secondary_class_wrapper',
                    'third_wrapper_id',
                    'third_class_wrapper',
                    'field_prefix',
                    'field_suffix',
                    'field_prefix_wrapper_id',
                    'field_suffix_wrapper_id');
                break;
        }
        return $out_arr;
    }

    function generateLightWeightPage($lightweightarray) {
        ini_set('max_execution_time', 0);
        $featurebox_id = $lightweightarray['featurebox_id'];
        $page_id = $lightweightarray['page_id'];
        if (!empty($page_id)) {

            $this->db->where("id", $page_id);
            $total_page_result = $this->db->get("cms_pages")->result();
            $this->common_model->updatePageChildBlock($total_page_result);
        } else if (!empty($featurebox_id)) {

            $this->db->where("featured_id", $featurebox_id);
            $feature_page_result = $this->db->get("cms_pages")->result();

            if (!empty($feature_page_result)) {
                foreach ($feature_page_result as $feature_page_row) {

                    $this->db->where("id", $feature_page_row->page_id);
                    $total_page_result = $this->db->get("cms_pages")->result();
                    $this->common_model->updatePageChildBlock($total_page_result);
                }
            }
        }
    }

    function updatePageChildBlock($total_page_result) {

        foreach ($total_page_result as $page_result) {

            $data_null = array(
                "full_page_block" => "");
            $this->db->where('id', $page_result->id);
            $this->db->update('cms_pages', $data_null);

            $this->db->where("page_id", $page_result->id);
            $this->db->where('type', 'child_page');
            $this->db->where("status", "a");
            $this->db->where("trash_status", "no");
            $this->db->where("active_status", "a");
            $this->db->order_by('order_no', 'ASC');
            $child_page_result = $this->db->get("cms_pages")->result();

            $child_array = array();
            if (!empty($child_page_result)) {
                foreach ($child_page_result as $child_page_row) {
                    $featurebox_id = $child_page_row->featured_id;

                    if (!empty($featurebox_id)) {
                        $featurebox_row = $this->common_model->GetByRow("cms_featuredbox", $featurebox_id, "id");
                        $feature_box_row = json_encode($featurebox_row);
                        $feature_json_data = array(
                            "feature_box_row" => $feature_box_row);

                        $this->db->where('featured_id', $featurebox_id);
                        $this->db->update('cms_pages', $feature_json_data);
                    }

                    $combo_id = $child_page_row->combo_id;

                    if (!empty($combo_id)) {
                        $combobox_row = $this->common_model->GetByRow("cms_pages", $combo_id, "id");
                        $combobox_row_array = (array) $combobox_row;

                        unset($combobox_row_array['full_page_block']);

                        $combobox_row = json_encode($combobox_row_array);

                        $combobox_json_data = array(
                            "combo_box_row" => $combobox_row);

                        $this->db->where('combo_id', $combo_id);
                        $this->db->update('cms_pages', $combobox_json_data);
                    }

                    $current_page_row = $this->common_model->GetByRow("cms_pages", $child_page_row->id, "id");
                    $master_page_row = $this->common_model->GetByRow("cms_pages", $child_page_row->page_id, "page_id");

                    $latest_page_block = (array) $current_page_row;
                    $exist_page_block_array = json_decode($master_page_row->full_page_block, TRUE);

                    if (empty($exist_page_block_array)) {
                        $exist_page_block_array = array();
                    }

                    //$child_array[]=$latest_page_block;

                    if ($child_page_row->type2 == 'combo') {
                        //
                        $combobox_page_row = $this->common_model->GetByRow("cms_pages", $child_page_row->combo_id, "id");
                        $combo_box_full_page_block = json_decode($combobox_page_row->full_page_block, TRUE);

                        $child_array = array_merge($child_array, $combo_box_full_page_block);
                        //
                    } else {
                        $child_array[] = $latest_page_block;
                    }
                }
            }


            $final_page_block = json_encode($child_array);
            $final_page_block_data = array(
                "full_page_block" => $final_page_block);

            $this->db->where('id', $page_result->id);
            $this->db->update('cms_pages', $final_page_block_data);
        }
    }

    function adminSessionUpdate($setvaluearray) {
        $admin_key = $setvaluearray["admin_key"];
        $admin_value = $setvaluearray["admin_value"];
        $admin_action = "";
        if (isset($setvaluearray["action"])) {
            $admin_action = $setvaluearray["action"];
        }

        if ($admin_key == 'structure_id') {

            $all_featurebox = $this->common_model->get_featurebox_by_structure($admin_value);

            foreach ($all_featurebox as $row) {

                /* page json section */

                $featureboxid = $row->id;

                $setvaluearray = array(
                    "admin_key" => "featurebox_id",
                    "admin_value" => $featureboxid
                );
                $this->common_model->adminSessionUpdate($setvaluearray);

                /*
                 * cache function 
                 */
            }
        } else {

            $gl_admin_session = array();
            $gl_id_array = array();
            if ($this->session->userdata('gl_admin') != FALSE) {
                $gl_admin_session = $this->session->userdata('gl_admin');
                if (isset($gl_admin_session[$admin_key])) {
                    $gl_id_array = $gl_admin_session[$admin_key];
                }
            }

            if ($admin_action == "remove" || $admin_action == "cache_remove") {
                if (isset($gl_admin_session[$admin_key])) {
                    $item_to_remove_key2 = array_search($admin_value, $gl_admin_session[$admin_key]);
                    if ($item_to_remove_key2 !== FALSE) {
                        unset($gl_admin_session[$admin_key][$item_to_remove_key2]);
                    }
                    $gl_id_array = $gl_admin_session[$admin_key];
                }
            } else {
                array_push($gl_id_array, $admin_value);
            }

            $gl_id_array = array_unique($gl_id_array);

            $gl_admin_session = $this->common_model->array_push_assoc($gl_admin_session, $admin_key, $gl_id_array);
            $this->session->set_userdata('gl_admin', $gl_admin_session);


//

            if ($admin_key == 'page_id') {
                $page_details = $this->admin_model->GetByRow('cms_pages', $admin_value, 'id');

                if ($page_details->type == 'combobox') {

//commonsessionupdate
                    $setsessionarray = array(
                        "main_session_array" => "gl_admin",
                        "session_key" => "combo_box_id",
                        "session_value" => $page_details->id,
                    );
                    $this->common_model->CommonSessionUpdate($setsessionarray);
//commonsessionupdate	

                    $this->common_model->update_combo_with_used_pages($page_details->id);
                }
            }

            if ($admin_key == 'featurebox_id') {

                $all_featurebox_used_chilpages = $this->common_model->Get_Featurebox_Used_Childpages($admin_value);

                foreach ($all_featurebox_used_chilpages as $child) {

                    $page_details = $this->admin_model->GetByRow('cms_pages', $child->page_id, 'id');

                    if ($page_details->type == 'combobox') {

//commonsessionupdate
                        $setsessionarray = array(
                            "main_session_array" => "gl_admin",
                            "session_key" => "combo_box_id",
                            "session_value" => $page_details->id,
                        );
                        $this->common_model->CommonSessionUpdate($setsessionarray);
//commonsessionupdate

                        $this->common_model->update_combo_with_used_pages($page_details->id);
                    }
                }
            }


//


            if ($admin_action !== "remove" && $admin_action !== "cache_remove") {
                $cache_session_array = array(
                    "cache_key" => $setvaluearray["admin_key"],
                    "cache_value" => $setvaluearray["admin_value"]
                );

                $this->common_model->createCacheSessionArray($cache_session_array);
            }
        }
    }

    function createCacheBlockIdTree($parameter_array) {

        $cache_key = $parameter_array["cache_key"];
        $cache_value = $parameter_array["cache_value"];
        $cache_action = "";

        $cache_main_array = array();
        $cache_block_array = array();

        $option_row = $this->common_model->option;
        $cache_main_array = json_decode($option_row->cache_block, TRUE);
        if (isset($cache_main_array[$cache_key])) {
            $cache_block_array = $cache_main_array[$cache_key];
        }

        if (isset($parameter_array["cache_action"])) {
            $cache_action = $parameter_array["cache_action"];
        }

        if ($cache_action == "remove") {
            if (isset($cache_main_array[$cache_key])) {
                $item_to_remove_key = array_search($cache_value, $cache_main_array[$cache_key]);
                if ($item_to_remove_key !== FALSE) {
                    unset($cache_main_array[$cache_key][$item_to_remove_key]);
                }
                $cache_block_array = $cache_main_array[$cache_key];
            }
        } else {
            array_push($cache_block_array, $cache_value);
        }

        $cache_block_array = array_values($cache_block_array);

        $cache_block_array = array_unique($cache_block_array);

        $cache_main_array = $this->common_model->array_push_assoc($cache_main_array, $cache_key, $cache_block_array);

        $cache_block_encoded = json_encode($cache_main_array);

        //{oldoption}
        //$data=array("cache_block"=>$cache_block_encoded);
        //{oldoption}

        $data = array(
            "value" => $cache_block_encoded);

        //{oldoption}
        //$this->db->where('id', 1);
        // $this->db->update('cms_options2', $data);
        ////{oldoption}

        $this->db->where('columnlabel', 'cache_block');
        $this->db->update('cms_options_setting', $data);
    }

    function createCacheSessionArray($cache_session_array) {

        $option_row = $this->common_model->get_options();
        $cache_array = json_decode($option_row->cache_block, TRUE);

        $cache_key = $cache_session_array["cache_key"];
        $new_cache_key = "cache_" . $cache_session_array["cache_key"];
        $cache_value = $cache_session_array["cache_value"];

        $cache_option_main_array = $cache_array[$cache_key];

        $cache_main_array = array();
        $cache_block_array = array();
        if ($this->session->userdata('gl_admin') != FALSE) {
            $cache_main_array = $this->session->userdata('gl_admin');

            if (isset($cache_main_array[$new_cache_key])) {
                $cache_block_array = $cache_main_array[$new_cache_key];
            }
        }

        if ($new_cache_key == "cache_featurebox_id") {

            if (in_array($cache_value, $cache_option_main_array)) {
                array_push($cache_block_array, $cache_value);

                $cache_main_array = $this->common_model->pushAccociateSession($cache_main_array, $new_cache_key, $cache_block_array);

                /* $action = "add";
                  $cache_main_array=$this->common_model->featurePageCache($cache_value, $cache_array, $cache_main_array, $action); */
            } else {
                $cache_block_array = $this->common_model->removeElementFromArray($cache_value, $cache_main_array, $new_cache_key);
                $cache_main_array = $this->common_model->pushAccociateSession($cache_main_array, $new_cache_key, $cache_block_array);

                /* $action = "remove";
                  $cache_main_array=$this->common_model->featurePageCache($cache_value, $cache_array, $cache_main_array, $action); */
            }

            $action = '';
            $cache_main_array = $this->common_model->featurePageCache($cache_value, $cache_array, $cache_main_array, $action);
        } elseif ($new_cache_key == "cache_page_id") {

            if (in_array($cache_value, $cache_option_main_array)) {
                array_push($cache_block_array, $cache_value);
            } else {
                $cache_block_array = $this->common_model->removeElementFromArray($cache_value, $cache_main_array, $new_cache_key);
            }

            $cache_main_array = $this->common_model->pushAccociateSession($cache_main_array, $new_cache_key, $cache_block_array);
        }

        $this->session->set_userdata('gl_admin', $cache_main_array);
    }

    function pushAccociateSession($cache_main_array, $new_cache_key,
            $cache_block_array) {
        if (!empty($cache_block_array)) {
            $cache_block_array = array_unique($cache_block_array);
        }
        $cache_main_array = $this->common_model->array_push_assoc($cache_main_array, $new_cache_key, $cache_block_array);
        return $cache_main_array;
    }

    function removeElementFromArray($cache_value, $cache_main_array, $cache_key) {
        if (isset($cache_main_array[$cache_key])) {
            $item_to_remove_key = array_search($cache_value, $cache_main_array[$cache_key]);
            if ($item_to_remove_key !== FALSE) {
                unset($cache_main_array[$cache_key][$item_to_remove_key]);
            }

            $cache_block_array = $cache_main_array[$cache_key];
            return $cache_block_array;
        }
    }

    function featurePageCache($cache_value, $cache_array, $cache_main_array,
            $action) {
        ini_set('max_execution_time', 0);
        $this->db->where('featured_id', $cache_value);
        $feature_page_list = $this->db->get('cms_pages')->result();
        if (!empty($feature_page_list)) {

            $cache_block_array = array();
            $cache_value = "";
            $new_cache_key = "cache_feature_page_id";

            foreach ($feature_page_list as $feature_page_row) {

                $cache_value = $feature_page_row->page_id;
                $cache_option_main_array = $cache_array["page_id"];
                if (isset($cache_main_array["cache_feature_page_id"])) {
                    $cache_block_array = $cache_main_array[$new_cache_key];
                }


                /*                if ($action == "add") {
                  if (in_array($cache_value, $cache_option_main_array)) {
                  array_push($cache_block_array, $cache_value);
                  }
                  } elseif ($action == "remove") {
                  $cache_block_array = $this->common_model->removeElementFromArray($cache_value, $cache_main_array, $new_cache_key);
                  } */

                if (in_array($cache_value, $cache_option_main_array)) {
                    array_push($cache_block_array, $cache_value);
                }

                $cache_main_array = $this->common_model->pushAccociateSession($cache_main_array, $new_cache_key, $cache_block_array);
                return $cache_main_array;
            }
        }
    }

    function updateAllOptionCache($parameterarray) {


        $cache_main_array = array();
        $cache_block_array = array();

        $option_row = $this->common_model->get_options();

        $cache_array = json_decode($option_row->cache_block, TRUE);

        if (isset($cache_array['page_id'])) {

            $page_id_array = $cache_array['page_id'];

            if (!empty($page_id_array)) {

                foreach ($page_id_array as $page_id) {
                    //		

                    $cache_session_array = array(
                        "cache_key" => 'page_id',
                        "cache_value" => $page_id,
                    );

                    $this->common_model->createCacheSessionArray($cache_session_array);

                    //	
                }
            }
        }


        if (isset($cache_array['featurebox_id'])) {

            $featurebox_id_array = $cache_array['featurebox_id'];

            if (!empty($page_id_array)) {

                foreach ($featurebox_id_array as $featurebox_id) {
                    //		

                    $cache_session_array = array(
                        "cache_key" => 'featurebox_id',
                        "cache_value" => $featurebox_id,
                    );

                    $this->common_model->createCacheSessionArray($cache_session_array);

                    //	
                }
            }
        }
    }

    function featureBoxListing($cache_block_array, $cache_array,
            $cache_main_array) {
        ini_set('max_execution_time', 0);
        $action = "add";
        if (!empty($cache_block_array)) {
            foreach ($cache_block_array as $cache_value) {
                $cache_main_array = $this->common_model->featurePageCache($cache_value, $cache_array, $cache_main_array, $action);
                return $cache_main_array;
            }
        }
    }

//{sbn} code
    function save_securepage_keys_to_options($id) {

        $page_details = $this->admin_model->GetByRow('cms_pages', $id, 'id');

        $page_option_url_key = $page_details->option_url_key;

        $option = $this->common_model->get_options();

        $securepages_array = array();

        if (!empty($option->securepages)) {
            $securepages_array = json_decode($option->securepages, TRUE);
        }

        if ($this->input->post('secure') == 'on') {

            array_push($securepages_array, $page_option_url_key);
        } else {

            $page_key = array_search($page_option_url_key, $securepages_array);

            if ($page_key !== FALSE) {
                unset($securepages_array[$page_key]);
            }
        }

        $securepages_value = json_encode($securepages_array);

//{oldoption}
        /* $data = array(

          'securepages' => $securepages_value,

          ); */
//{oldoption}

        $data = array(
            'value' => $securepages_value,
        );

//{oldoption}
//$this->db->where('id', $option->id);
//$this->db->update('cms_options2', $data);
//{oldoption}

        $this->db->where('columnlabel', 'securepages');
        $this->db->update('cms_options_setting', $data);
    }

    public function getPageSecuredata($key, $return_type = "") {
        $option = $this->common_model->option;
        $website_security = $option->secure;
        $security_type = $option->secured_pages;

//

        $securepages_array = array();

        if (!empty($option->securepages)) {
            $securepages_array = json_decode($option->securepages, TRUE);
        }

        $pagesecure = 'off';
        if (in_array($key, $securepages_array)) {
            $pagesecure = 'on';
        }


//

        $base_url = base_url();
        $full_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


        if ($website_security == 'on') {
            if ($security_type == "full") {

                if (strpos($full_url, 'https') !== false) {
                    
                } else {
                    $full_url = str_replace('http', 'https', $full_url);
                    if ($return_type == "") {
                        redirect($full_url);
                    } else {
                        $base_url = str_replace('http', 'https', $base_url);
                    }
                }
            } else {
                if ($pagesecure == "on") {
                    if (strpos($full_url, 'https') !== false) {
                        
                    } else {
                        $full_url = str_replace('http', 'https', $full_url);
                        if ($return_type == "") {
                            redirect($full_url);
                        } else {
                            $base_url = str_replace('http', 'https', $base_url);
                        }
                    }
                } else if ($pagesecure != "on") {
                    if (strpos($full_url, 'https') !== false) {
                        $full_url = str_replace('https', 'http', $full_url);
                        if ($return_type == "") {
                            redirect($full_url);
                        } else {
                            $base_url = str_replace('https', 'http', $base_url);
                        }
                    } else {
                        
                    }
                }
            }
        } else {
            if (strpos($full_url, 'https') !== false) {
                $full_url = str_replace('https', 'http', $full_url);
                if ($return_type == "") {
                    redirect($full_url);
                } else {
                    $base_url = str_replace('https', 'http', $base_url);
                }
            } else {
                
            }
        }

        return $base_url;
    }

    function save_cart_paymenttype() {

        $gl_cart_session = $this->session->userdata('gl_cart');
        $payment_typeid = $this->input->post('payment_typeid');

        $gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'cart_payment_type', $payment_typeid);

        $this->session->set_userdata('gl_cart', $gl_cart_session);
    }

    function get_featurebox_by_structure($structure_id) {

        $this->db->where('featured_types', $structure_id);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('id', 'DESC');
        return $this->db->get('cms_featuredbox')->result();
    }

    function UpdateElementUsedByType($id, $type) {

        if ($type == 'structure_id') {

            $box_row = $this->admin_model->GetByRow('cms_templates', $id, 'id');
            $box_column = 'used_structure_tree';
        } else {

            $box_row = $this->admin_model->GetByRow('cms_featuredbox', $id, 'id');
            $box_column = 'used_featurebox_tree';
        }

//
        $feature_wrapper_details = json_decode($box_row->feature_wrapper_details);

        if (!empty($feature_wrapper_details)) {


            foreach ($feature_wrapper_details as $key => $row2) {

                $field_row = $this->common_model->GetByRow_notrash('cms_feature_wrapper', $row2->id, 'id');

                $used_column_tree = array();
                if (!empty($field_row->$box_column)) {
                    $used_column_tree = explode('+', $field_row->$box_column);
                }

                $used_column_tree[] = $id;

                $used_column_tree = array_filter($used_column_tree);
                $used_column_tree = array_unique($used_column_tree);
                $used_column_tree = implode('+', $used_column_tree);
                $used_column_tree = '+' . $used_column_tree . '+';

//

                $data = array(
                    $box_column => $used_column_tree,
                );

                $this->db->where('id', $row2->id);
                $this->db->update('cms_feature_wrapper', $data);


//
            }
        }
//
    }

    function get_elements_fields_by_type($id, $boxtype, $type) {

        if ($boxtype == 'structure') {
            if ($type == 'own') {
                $structureid = $id;
                $this->db->where('featurebox_structure', $structureid);
            } else if ($type == 'used') {
                $used_structid = '+' . $id . '+';
                $this->db->like('used_structure_tree', $used_structid);
            }
        }

        if ($boxtype == 'featurebox') {
            if ($type == 'own') {
                $featurebox_id = $id;
                $this->db->where('featurebox_id', $featurebox_id);
            } else if ($type == 'used') {
                $used_featid = '+' . $id . '+';
                $this->db->like('used_featurebox_tree', $used_featid);
            }
        }

        $this->db->where('featurebox_type !=', 'no');

        $this->db->where('trash_status', 'no');

        $query = $this->db->get('cms_feature_wrapper');

        return $query->result();
    }

    function copy_featurebox_with_structure($parameter_array) {

        $structure_id = $parameter_array['structure_id'];
        $default_combo_id = $parameter_array['default_combo_id'];
        $default_combo_id2 = $parameter_array['default_combo_id2'];

        $structure_row = $this->common_model->GetByRow_notrash('cms_templates', $structure_id, 'id');

        $featurebox_row = $this->common_model->GetByRow_notrash('cms_featuredbox', 'demo', 'fixed_type');


        $featurebox_new_row = (array) $featurebox_row;

        $featurebox_new_row['id'] = '';
        $featurebox_new_row['name'] = $structure_row->short_title;


//
        $new_title = json_decode($featurebox_new_row['title'], TRUE);

        $new_title[0]['right_val'] = $structure_row->short_title;

        $new_title = json_encode($new_title);

//


        $featurebox_new_row['title'] = $new_title;
        $featurebox_new_row['slug'] = $structure_row->short_title;
        $featurebox_new_row['featured_types'] = $structure_row->id;
        $featurebox_new_row['row_encode_data'] = '';

        $structure_row_array = (array) $structure_row;
        $structure_row_json = json_encode($structure_row_array, TRUE);

        $featurebox_new_row['featurebox_structure_details'] = $structure_row_json;

        $featurebox_new_row['fixed_status'] = '';
        $featurebox_new_row['fixed_type'] = '';

        $featurebox_new_row['date_created'] = '';

        $featurebox_new_row['default_combo_id'] = $default_combo_id;
        $featurebox_new_row['default_combo_id2'] = $default_combo_id2;


        $this->db->insert('cms_featuredbox', $featurebox_new_row);

        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    function create_filecombo_with_structure($parameter_array) {

        $structure_id = $parameter_array['structure_id'];
        $max_width_image = $parameter_array['max_width_image'];
        $max_height_image = $parameter_array['max_height_image'];
        $manipualtion_image = $parameter_array['manipualtion_image'];
        $final_manipulation_image = $parameter_array['final_manipulation_image'];
        $type = $parameter_array['type'];
        $compresscropvalue = $parameter_array['compresscropvalue'];

        $structure_row = $this->common_model->GetByRow_notrash('cms_templates', $structure_id, 'id');

//cms_upload_types
        $cms_upload_types_row = $this->common_model->GetByRow_notrash('cms_upload_types', 'demo', 'fixed_type');

        $cms_upload_types_row = (array) $cms_upload_types_row;


        $uploadtype_preferences = json_decode($cms_upload_types_row['preferences'], TRUE);

        $uploadtype_preferences['max_width'] = $max_width_image;
        $uploadtype_preferences['max_height'] = $max_height_image;

        $uploadtype_preferences = json_encode($uploadtype_preferences);


        $cms_upload_types_row['id'] = '';
        $cms_upload_types_row['type_name'] = $structure_row->short_title . '_' . $type;
        $cms_upload_types_row['manipulation_status'] = $manipualtion_image;

        $cms_upload_types_row['fixed_status'] = '';
        $cms_upload_types_row['fixed_type'] = '';

        $cms_upload_types_row['preferences'] = $uploadtype_preferences;

        unset($cms_upload_types_row['date_created']);

        $this->db->insert('cms_upload_types', $cms_upload_types_row);
        $cms_upload_types_insert_id = $this->db->insert_id();

//cms_upload_types
//cms_image_manipulation
        if ($manipualtion_image == 'Yes') {
            $cms_image_manipulation_row = $this->common_model->GetByRow_notrash('cms_image_manipulation', 'demo', 'fixed_type');

            $cms_image_manipulation_row = (array) $cms_image_manipulation_row;
            $cms_image_manipulation_row['id'] = '';
            $cms_image_manipulation_row['manipulation_name'] = $structure_row->short_title . '_' . $type;
            $cms_image_manipulation_row['size_details'] = $final_manipulation_image;
            $cms_image_manipulation_row['compresscropvalue'] = $compresscropvalue;

            $cms_image_manipulation_row['fixed_status'] = '';
            $cms_image_manipulation_row['fixed_type'] = '';

            unset($cms_image_manipulation_row['date_created']);

            $this->db->insert('cms_image_manipulation', $cms_image_manipulation_row);
            $cms_image_manipulation_insert_id = $this->db->insert_id();
        } else {
            $cms_image_manipulation_insert_id = 0;
        }

//cms_image_manipulation
//cms_image_combo

        $cms_image_combo_row = $this->common_model->GetByRow_notrash('cms_image_combo', 'demo', 'fixed_type');

        $cms_image_combo_row = (array) $cms_image_combo_row;
        $cms_image_combo_row['id'] = '';
        $cms_image_combo_row['combo_name'] = $structure_row->short_title . '_' . $type;
        $cms_image_combo_row['upload_type'] = $cms_upload_types_insert_id;
        $cms_image_combo_row['manipulation'] = $cms_image_manipulation_insert_id;

        $cms_image_combo_row['fixed_status'] = '';
        $cms_image_combo_row['fixed_type'] = '';

        unset($cms_image_combo_row['date_created']);

        $this->db->insert('cms_image_combo', $cms_image_combo_row);
        $cms_image_combo_insert_id = $this->db->insert_id();


        return $cms_image_combo_insert_id;

//cms_image_combo
    }

    function Get_All_Pages() {
        $this->db->where('type', 'main_page');
        $this->db->where('page_type', 'normal_page');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('cms_pages')->result();
    }

    function create_childpage_by_featurebox($contentid) {

        $newstring = explode('|', $contentid);
        $page_id = $newstring['0'];
        $featured_id = $newstring['1'];
        $this->db->select('id');
        $this->db->where('featured_id', $featured_id);
        $this->db->where('page_id', $page_id);
        $this->db->where('type', 'child_page');
        $id = $this->db->get('cms_pages')->row();

        $child_order = $this->common_model->get_page_maximum_orderno($page_id);
        $feature_order = $child_order->order_no + 1;
//        dump($child_order);die();
        if (isset($id->id)) {

            $data = array(
                'type2' => 'featured',
                'status' => 'a',
                'trash_status' => 'no',
                'active_status' => 'a'
            );
            $this->db->where('id', $id->id);
            $this->db->update('cms_pages', $data);
        } else {

            $data = array(
                'featured_id' => $featured_id,
                'page_id' => $page_id,
                'type' => 'child_page',
                'order_no' => $feature_order,
                'type2' => 'featured',
                'status' => 'a',
                'trash_status' => 'no',
                'active_status' => 'a'
            );
            $this->db->insert('cms_pages', $data);
        }


        /* page json section */
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
    }

    function create_childpage_by_combobox($contentid) {

        $newstring = explode('|', $contentid);
        $page_id = $newstring['0'];
        $combo_id = $newstring['1'];
        $this->db->select('id');
        $this->db->where('combo_id', $combo_id);
        $this->db->where('page_id', $page_id);
        $this->db->where('type', 'child_page');
        $id = $this->db->get('cms_pages')->row();

        $child_order = $this->common_model->get_page_maximum_orderno($page_id);
        $combo_order = $child_order->order_no + 1;
//        dump($child_order);die();
        if (isset($id->id)) {

            $data = array(
                'type2' => 'combo',
                'status' => 'a',
                'trash_status' => 'no',
                'active_status' => 'a'
            );
            $this->db->where('id', $id->id);
            $this->db->update('cms_pages', $data);
        } else {

            $data = array(
                'combo_id' => $combo_id,
                'page_id' => $page_id,
                'type' => 'child_page',
                'order_no' => $combo_order,
                'type2' => 'combo',
                'status' => 'a',
                'trash_status' => 'no',
                'active_status' => 'a'
            );
            $this->db->insert('cms_pages', $data);
        }


        /* page json section */
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
    }

    function get_page_maximum_orderno($page_id) {
        $this->db->select_max('order_no');
        $this->db->where('page_id', $page_id);
        return $this->db->get('cms_pages')->row();
    }

    function get_child_pages_by_featurebox($featurebox_id) {

        $this->db->where('featured_id', $featurebox_id);
        $this->db->where('type', 'child_page');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('order_no', 'ASC');
        return $this->db->get('cms_pages')->result();
    }

    function get_wrapper_used_blocks($wrapper_id, $type) {
        $this->db->like('wrapper_tag_full_tree', '+' . $wrapper_id . '+');

        if ($type == 'structure') {
            return $this->db->get('cms_templates')->result();
        } elseif ($type == 'featurebox') {
            return $this->db->get('cms_featuredbox')->result();
        }
    }

    function customize_structure_for_featurebox($parameter_array) {

        $structure_id = $parameter_array['structure_id'];
        $featurebox_id = $parameter_array['featurebox_id'];
        $data = $parameter_array['data'];


//new
        $new_structure_wrapper_extra_set_data = json_decode($data['wrapper_extra_set_data'], TRUE);

        $new_structure_data = array(
            'depending_element' => $data['depending_element'],
        );

        $new_structure_full_array = array_merge($new_structure_data, $new_structure_wrapper_extra_set_data);
//new


        $old_structure_full_array = $this->common_model->get_full_row_as_single_array_by_type($structure_id, 'structure');


        $custimized_structure_full_array = array_diff_assoc($new_structure_full_array, $old_structure_full_array);



//wrapper
        $wrp_id_arr = array();
        $struc_wrp_column_arr = $this->common_model->get_array_by_name('struc_wrp_column_arr');

        if (!empty($struc_wrp_column_arr)) {
            foreach ($struc_wrp_column_arr as $struc_wrp_column) {
                if (!empty($custimized_structure_full_array[$struc_wrp_column])) {
                    $wrp_id_arr[] = $custimized_structure_full_array[$struc_wrp_column];
                }
            }
        }


        $wrp_id_arr = array_unique($wrp_id_arr);
        $wrp_id_arr = array_filter($wrp_id_arr);
        $wrp_id_tree = implode('+', $wrp_id_arr);

        $custom_structure_wrapper_tag_full_tree = '';

        if (!empty($wrp_id_arr)) {

            $custom_structure_wrapper_tag_full_tree = '+' . $wrp_id_tree . '+';
        }


//wrapper


        $custimized_structure_full_array_json = json_encode($custimized_structure_full_array);

        $custom_structure_data = array(
            'custom_structure_details' => $custimized_structure_full_array_json,
            'custom_structure_wrapper_tag_full_tree' => $custom_structure_wrapper_tag_full_tree,
        );


        $this->db->where('id', $featurebox_id);
        $this->db->update('cms_featuredbox', $custom_structure_data);

        $this->common_model->save_type_wrp($featurebox_id, 'featurebox');
    }

    function get_full_row_as_single_array_by_type($id, $type) {

        if ($type == 'structure') {

            $structure_row = $this->common_model->GetByRow('cms_templates', $id, 'id');

            /* $structure_row_array = (array) $structure_row;

              unset($structure_row_array['wrapper_extra_set_data']);
              unset($structure_row_array['feature_wrapper_details']);
              unset($structure_row_array['field_elements_id_tree']);
              unset($structure_row_array['wrapper_tag_full_array']);
              unset($structure_row_array['wrapper_tag_full_tree']); */

            $structure_data = array(
                'depending_element' => $structure_row->depending_element,
            );

            $wrapper_extra_set_data = json_decode($structure_row->wrapper_extra_set_data, TRUE);

            $full_array = array_merge($structure_data, $wrapper_extra_set_data);
        }


        return $full_array;
    }

    function CheckElementFieldExistByType($parameter_data) {

//

        $typeid = $parameter_data['typeid'];
        $type = $parameter_data['type'];
        $typekey = $parameter_data['typekey'];
        $old_field_key = $parameter_data['old_field_key'];
        $formtype = $parameter_data['formtype'];
//


        if ($type == 'structure') {

            $featuredbox_structure_row = $this->admin_model->GetByRow('cms_templates', $typeid, 'id');
        } elseif ($type == 'featurebox') {

            $featuredbox_structure_row = $this->admin_model->GetByRow('cms_featuredbox', $typeid, 'id');
        }

        $feature_field_list = json_decode($featuredbox_structure_row->feature_wrapper_details, TRUE);

        $return_value = 0;

        if ($formtype == 'edit') {

            if ($typekey != $old_field_key) {
                if (isset($feature_field_list[$typekey])) {
                    $return_value = 1;
                }
            }
        } else {
            if (isset($feature_field_list[$typekey])) {
                $return_value = 1;
            }
        }

        return $return_value;
    }

    function save_combo_option($comboid) {

        $combo_array = array();
        $combo_detail = $this->common_model->GetByRow_notrash('cms_image_combo', $comboid, 'id');

        $combo_detail_array = (array) $combo_detail;

        $combo_array['combo_details'] = json_encode($combo_detail_array);

        $upload_type_detail = $this->common_model->GetByRow_notrash('cms_upload_types', $combo_detail->upload_type, 'id');

        if ($combo_detail->manipulation > 0) {
            $manupulation_detail = $this->common_model->GetByRow_notrash('cms_image_manipulation', $combo_detail->manipulation, 'id');

            $size_details = json_decode($manupulation_detail->size_details);
            $size_array = array();
            foreach ($size_details as $size) {

                $size_array[$size->size_name] = array(
                    'width' => $size->width,
                    'height' => $size->height,
                );
            }

            $combo_array['combo_size'] = json_encode($size_array);
        }



        $combo_array_jsn = json_encode($combo_array);



//

        $combo_full_array = array();
        $combo_full_array = $this->common_model->option->combo_full_array;
        $combo_full_array = json_decode($combo_full_array, TRUE);
        if (!empty($combo_full_array)) {
            if (isset($combo_full_array[$comboid])) {
                $combo_full_array[$comboid] = $combo_array_jsn;
            } else {
                $combo_full_array = $this->common_model->array_push_assoc($combo_full_array, $comboid, $combo_array_jsn);
            }
        } else {
            $combo_full_array = array(
                $comboid => $combo_array_jsn);
        }


        $combo_full_array = json_encode($combo_full_array);


        $data_opt = array(
            'value' => $combo_full_array);


        $this->db->where('columnlabel', 'combo_full_array');
        $this->db->update('cms_options_setting', $data_opt);


//
    }

    function Update_Cache_Session_Element_Field($element_id) {

        $featuredbox_field_row = $this->common_model->GetByRow_notrash('cms_feature_wrapper', $element_id, 'id');


//structure

        $used_structure_tree = array();
        if (!empty($featuredbox_field_row->used_structure_tree)) {
            $used_structure_tree = explode('+', $featuredbox_field_row->used_structure_tree);
            $used_structure_tree = array_filter($used_structure_tree);
            $used_structure_tree = array_unique($used_structure_tree);
        }

        if (!empty($used_structure_tree)) {


            foreach ($used_structure_tree as $featurebox_structure) {

                $structure_id = $featurebox_structure;

                $setvaluearray = array(
                    "admin_key" => "structure_id",
                    "admin_value" => $structure_id
                );
                $this->common_model->adminSessionUpdate($setvaluearray);
            }
        }


//structure
//featurebox


        $used_featurebox_tree = array();
        if (!empty($featuredbox_field_row->used_featurebox_tree)) {
            $used_featurebox_tree = explode('+', $featuredbox_field_row->used_featurebox_tree);

            $used_featurebox_tree = array_filter($used_featurebox_tree);
            $used_featurebox_tree = array_unique($used_featurebox_tree);
        }



        if (!empty($used_featurebox_tree)) {

            foreach ($used_featurebox_tree as $featurebox_id) {


                $featureboxid = $featurebox_id;
                $setvaluearray = array(
                    "admin_key" => "featurebox_id",
                    "admin_value" => $featurebox_id
                );
                $this->common_model->adminSessionUpdate($setvaluearray);
            }
        }


//featurebox
    }

    function update_filecombo_by_manipulation($manipulationid) {

        $conditional_array = array(
            'manipulation' => $manipulationid,
        );

        $combo_list = $this->common_model->GetByResult_Where('cms_image_combo', 'id', 'ASC', $conditional_array);

        foreach ($combo_list as $combo) {

            $this->common_model->save_combo_option($combo->id);
        }
    }

    function Update_Page_Featurebox_Cache() {
        /*
         * cache function 
         */
        $cacheparameterarray = array(
            "cache_value" => "",
            "key" => ""
        );
        $this->common_model->updateAllOptionCache($cacheparameterarray);
        /*
         * EOF cache function
         */
    }

    function create_childpage_by_elementtype($contentid) {

        $newstring = explode('|', $contentid);
        $page_id = $newstring['0'];
        $element_type = $newstring['1'];

        $this->db->select('id');
        $this->db->where('element_type', $element_type);
        $this->db->where('page_id', $page_id);
        $this->db->where('type', 'child_page');
        $id = $this->db->get('cms_pages')->row();

        $child_order = $this->common_model->get_page_maximum_orderno($page_id);
        $feature_order = $child_order->order_no + 1;
//        dump($child_order);die();
        if (isset($id->id)) {

            $data = array(
                'type2' => 'elementbox',
                'status' => 'a',
                'trash_status' => 'no',
                'active_status' => 'a'
            );
            $this->db->where('id', $id->id);
            $this->db->update('cms_pages', $data);
        } else {

            $data = array(
                'element_type' => $element_type,
                'page_id' => $page_id,
                'type' => 'child_page',
                'order_no' => $feature_order,
                'type2' => 'elementbox',
                'status' => 'a',
                'trash_status' => 'no',
                'active_status' => 'a'
            );
            $this->db->insert('cms_pages', $data);
        }



        /* page json section */
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
    }

    function CommonSessionUpdate($setvaluearray) {

        $session_key = $setvaluearray["session_key"];
        $session_value = $setvaluearray["session_value"];
        $main_session_array = $setvaluearray["main_session_array"];
        $action = "";
        if (isset($setvaluearray["action"])) {
            $action = $setvaluearray["action"];
        }

//    
        $gl_current_session = array();
        $gl_id_array = array();
        if ($this->session->userdata($main_session_array) != FALSE) {
            $gl_current_session = $this->session->userdata($main_session_array);
            if (isset($gl_current_session[$session_key])) {
                $gl_id_array = $gl_current_session[$session_key];
            }
        }

        if ($action == "remove") {
            if (isset($gl_current_session[$session_key])) {
                $item_to_remove_key2 = array_search($session_value, $gl_current_session[$session_key]);
                if ($item_to_remove_key2 !== FALSE) {
                    unset($gl_current_session[$session_key][$item_to_remove_key2]);
                }
                $gl_id_array = $gl_current_session[$session_key];
            }
        } else {
            array_push($gl_id_array, $session_value);
        }

        $gl_id_array = array_unique($gl_id_array);

        $gl_current_session = $this->common_model->array_push_assoc($gl_current_session, $session_key, $gl_id_array);
        $this->session->set_userdata($main_session_array, $gl_current_session);
//
    }

    function update_custom_structurebox_wrapper($wrp_id) {

        if (!empty($wrp_id)) {


            $condition_array = array(
                'cms_wrappertagbox_id' => $wrp_id,
            );

            $all_wrapper_used_child_pages = $this->common_model->GetByResult_Where('cms_pages', 'id', 'asc', $condition_array);

            foreach ($all_wrapper_used_child_pages as $childpage) {

                $main_page = $this->admin_model->GetByRow('cms_pages', $childpage->page_id, 'id');

                if ($main_page->type == 'custom_struturebox') {

                    $page_id = $main_page->id;

//commonsessionupdate
                    $setsessionarray = array(
                        "main_session_array" => "gl_admin",
                        "session_key" => "custom_structurebox_id",
                        "session_value" => $page_id,
                    );
                    $this->common_model->CommonSessionUpdate($setsessionarray);
//commonsessionupdate	
                }
            }
        }
    }

    function Get_Combo_featurebox_childs($comboid) {
        $this->db->where('featured_id >', '0');
        $this->db->where('type2', 'featured');
        $this->db->where('page_id', $comboid);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('order_no', 'ASC');
        return $this->db->get('cms_pages')->result();
    }

    function Get_Featurebox_Used_Childpages($featured_id) {

        $this->db->where('featured_id', $featured_id);
        $this->db->where('type2', 'featured');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('order_no', 'ASC');
        return $this->db->get('cms_pages')->result();
    }

    function update_combo_with_used_pages($comboid) {

        $conditional_array = array(
            'combo_id' => $comboid);

        $all_combo_used_pages = $this->common_model->GetByResult_Where('cms_pages', 'id', 'DESC', $conditional_array);

        foreach ($all_combo_used_pages as $child) {
//

            $page_id = $child->page_id;
            //	page json section 

            $setvaluearray = array(
                "admin_key" => "page_id",
                "admin_value" => $page_id
            );
            $this->common_model->adminSessionUpdate($setvaluearray);

            //	page json section 
//	
        }
    }

    function get_custom_structurebox_used_templates($custom_structure_id) {

        $this->db->where('custom_structure_id', $custom_structure_id);

        return $this->db->get('cms_templates')->result();
    }

    function get_child_pages_by_combobox($combo_id) {

        $this->db->where('combo_id', $combo_id);
        $this->db->where('type', 'child_page');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('order_no', 'ASC');
        return $this->db->get('cms_pages')->result();
    }

    function get_wrappers_used_in_page($pageid) {

        $this->db->where('page_id', $pageid);
        $this->db->where('cms_wrappertagbox_id >', 0);
        $this->db->where('type', 'child_page');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('order_no', 'ASC');
        return $this->db->get('cms_pages')->result();
    }

    function create_elements_for_structure($parameter_array) {

        $structure_id = $parameter_array['structure_id'];
        $include_elements = $parameter_array['include_elements'];

        $structure_row = $this->common_model->GetByRow_notrash('cms_templates', $structure_id, 'id');


        $feature_wrapper_row = $this->common_model->GetByRow_notrash('cms_feature_wrapper', 'demo', 'fixed_type');

        $feature_wrapper_row = (array) $feature_wrapper_row;

        unset($feature_wrapper_row['id']);
        unset($feature_wrapper_row['featurebox_id']);
        unset($feature_wrapper_row['date_created']);
        unset($feature_wrapper_row['fixed_status']);
        unset($feature_wrapper_row['fixed_type']);

        $feature_wrapper_row['featurebox_structure'] = $structure_id;
        $feature_wrapper_row['used_structure_tree'] = '+' . $structure_id . '+';
        $feature_wrapper_row['used_featurebox_tree'] = '++';



        foreach ($include_elements as $element) {
//	

            $feature_wrapper_row['title'] = 'AutoElement-' . $structure_row->short_title . '-' . $element;
            $feature_wrapper_row['identifiername'] = $structure_row->short_title . '-' . $element . '-field1';
            $feature_wrapper_row['field_key'] = 'element-' . $element;
            $feature_wrapper_row['element'] = $element;

//

            $this->db->insert('cms_feature_wrapper', $feature_wrapper_row);


//
//	
        }
    }

    function show_dynamic_category_subcat($cat_id, $dashes = '') {
        $dashes .= '__';
        $this->db->where('parent_id', $cat_id);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $rsSub = $this->db->get('cms_dynamic_category')->result();
        if (count($rsSub) >= 1) {
            foreach ($rsSub as $rows_sub) {
                $this->arrs[] = array(
                    'name' => $dashes . $rows_sub->category,
                    'id' => $rows_sub->id);
                $this->show_dynamic_category_subcat($rows_sub->id, $dashes);
            }
        }
    }

    function show_dynamic_category_maincat($cat) {
        $this->db->where('parent_id', $cat);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $rsMain = $this->db->get('cms_dynamic_category')->result();
        if (count($rsMain) >= 1) {
            foreach ($rsMain as $rows_main) {
                $this->arrs[] = array(
                    'name' => $rows_main->category,
                    'id' => $rows_main->id);
                $this->show_dynamic_category_subcat($rows_main->id);
            }
            return $this->arrs;
        }
    }

    function get_product_theme_page($product_row) {

        $data['option'] = $option = $this->common_model->option;

//fixed_page_data

        $fixed_page_data = json_decode($option->fixed_page_data, true);
        $fixed_theme_page_array = json_decode($option->fixed_theme_page_array, true);
        $fixed_theme_page = $fixed_theme_page_array['product_detail'];
        $key = array_search($fixed_theme_page, array_column($fixed_page_data['product_detail'], 'theme_value'));
        $theme_page_row = $fixed_page_data['product_detail'][$key];

//fixed_page_data
//prod_type_fixed_page
        $prod_type_fixed_page_data = json_decode($option->prod_type_fixed_page, true);
        $prod_typefixed_theme_page = 'product_detail_' . $product_row->product_categorytype_id;


        $key2 = array_search($prod_typefixed_theme_page, array_column($prod_type_fixed_page_data['product_detail'], 'theme_value'));

        $prod_type_fixed_page_theme_page_row = $prod_type_fixed_page_data['product_detail'][$key2];

        $prod_type_fixed_page_theme_page = $prod_type_fixed_page_theme_page_row['theme_page'];

        if (!empty($prod_type_fixed_page_theme_page)) {
            $key3 = array_search($prod_type_fixed_page_theme_page, array_column($fixed_page_data['product_detail'], 'theme_value'));
            $theme_page_row = $fixed_page_data['product_detail'][$key3];
        }


//dump($theme_page_row);
//prod_type_fixed_page

        return $theme_page_row;
    }

    function get_page_theme_page($theme_parameter_array) {


        $make_page_type = $theme_parameter_array['make_page_type'];
        $categorytype_id = $theme_parameter_array['categorytype_id'];

        $data['option'] = $option = $this->common_model->option;

//fixed_page_data

        $fixed_page_data = json_decode($option->fixed_page_data, true);
        $fixed_theme_page_array = json_decode($option->fixed_theme_page_array, true);
        $fixed_theme_page = $fixed_theme_page_array[$make_page_type];
        $key = array_search($fixed_theme_page, array_column($fixed_page_data[$make_page_type], 'theme_value'));
        $theme_page_row = $fixed_page_data[$make_page_type][$key];

//fixed_page_data
//prod_type_fixed_page
        $prod_type_fixed_page_data = json_decode($option->prod_type_fixed_page, true);
        $prod_typefixed_theme_page = $make_page_type . '_' . $categorytype_id;


        $key2 = array_search($prod_typefixed_theme_page, array_column($prod_type_fixed_page_data[$make_page_type], 'theme_value'));

        $prod_type_fixed_page_theme_page_row = $prod_type_fixed_page_data[$make_page_type][$key2];

        $prod_type_fixed_page_theme_page = $prod_type_fixed_page_theme_page_row['theme_page'];

        if (!empty($prod_type_fixed_page_theme_page)) {
            $key3 = array_search($prod_type_fixed_page_theme_page, array_column($fixed_page_data[$make_page_type], 'theme_value'));
            $theme_page_row = $fixed_page_data[$make_page_type][$key3];
        }


//dump($theme_page_row);
//prod_type_fixed_page

        return $theme_page_row;
    }

    function get_element_main_types_array($element) {
//

        $element_type_value_combos = $this->common_model->option->element_type_value_combos;
        $element_type_value_combos_array = json_decode($element_type_value_combos, TRUE);

        $element_main_types = $this->common_model->option->element_main_types;
        $element_main_types_array = json_decode($element_main_types, TRUE);



        $main_element_type_row = array();

        $child_element = $element;
        if (isset($element_type_value_combos_array[$child_element])) {

            $child_element_type = $element_type_value_combos_array[$child_element];

            $main_element_type_id = array_search($child_element_type, array_filter(array_combine(array_keys($element_main_types_array), array_column($element_main_types_array, 'data_element_main_type_key'))));

            if ($main_element_type_id !== FALSE) {

                $main_element_type_row = $element_main_types_array[$main_element_type_id];
            }
        }

        return $main_element_type_row;

//	
    }

    function product_rating_calcultion($contentid) {

        $content_row = $this->common_model->GetByRow('cms_media', $contentid, 'id');

        $products_array = $content_row->connection_data;
        $products_array = explode('+', $products_array);
        $products_array = array_filter($products_array);
        $products_array = array_unique($products_array);


        foreach ($products_array as $productid) {
            $catid = $content_row->prod_cat;
            $productid = '+' . $productid . '+';

            $this->db->select('AVG(overallrating) as overallrating');
            $this->db->where('connection_data', $productid);
            $this->db->where('type', 'content_management');
            $this->db->where('prod_cat', $catid);
            $this->db->where('trash_status', 'no');
            $this->db->where('active_status', 'a');
            $result = $this->db->get('cms_media')->row();

//
            $rating = $result->overallrating;
            $rating = round($rating, 1);
            $data_update_array = array(
                'rating' => $rating,
            );


            $this->db->where('id', $productid);
            $this->db->update('ec_products', $data_update_array);
//
        }
    }

    function get_wizard_column_arrays($wizardid, $groupid) {
        $wizarddata = $this->common_model->GetByRow("ec_wizard", $wizardid, "id");
        $wizard_group_attributes = json_decode($wizarddata->fullInputs, true);
        $return_array = array();
        if (!empty($wizard_group_attributes)) {
            foreach ($wizard_group_attributes as $key => $attributes) {
                $attr_groupid = $attributes["groupid"];
                if ($attr_groupid == $groupid) {

                    $common_input_id = $attributes["common_input_id"];
                    $common_input_data = $this->common_model->GetByRow("cms_commoninputs", $common_input_id, "id");
					$return_array[$key]['common_input_id'] = $common_input_data->id;
                    $return_array[$key]['type'] = $common_input_data->field_format_type;
                    $return_array[$key]['title'] = $common_input_data->name;
                    $return_array[$key]['label'] = $common_input_data->field_label;
					$return_array[$key]['frontend_field_label'] = $common_input_data->frontend_field_label;
					$return_array[$key]['prod_attr'] = $common_input_data->prod_attr;

                    $return_array[$key]['column_name'] = $common_input_data->product_column_name;
                }
            }
        }
        return $return_array;
    }

    function get_wizard_based_inputdata($wizardid, $groupid, $productdata) {
        $wizarddata = $this->common_model->GetByRow("ec_wizard", $wizardid, "id");
        $wizard_group_attributes = json_decode($wizarddata->fullInputs, true);
        $return_array = array();
        if (!empty($wizard_group_attributes)) {
            foreach ($wizard_group_attributes as $key => $attributes) {
                $attr_groupid = $attributes["groupid"];
                if ($attr_groupid == $groupid) {

                    $common_input_id = $attributes["common_input_id"];
                    $common_input_data = $this->common_model->GetByRow("cms_commoninputs", $common_input_id, "id");

                    $product_column_name = $common_input_data->product_column_name;
                    $product_value = $productdata->$product_column_name;
					
					$return_array[$key]['common_input_id'] = $common_input_data->id;
                    $return_array[$key]['type'] = $common_input_data->field_format_type;
                    $return_array[$key]['title'] = $common_input_data->name;
                    $return_array[$key]['label'] = $common_input_data->field_label;
					$return_array[$key]['frontend_field_label'] = $common_input_data->frontend_field_label;
					$return_array[$key]['prod_attr'] = $common_input_data->prod_attr;
                    $return_array[$key]['value'] = $product_value;
                    $return_array[$key]['column_name'] = $product_column_name;
                }
            }
        }
        return $return_array;
    }

function get_cart_input_extra_data($wizardid, $groupid, $productdata)
{

$wizarddata = $this->common_model->GetByRow("ec_cart_group", $wizardid, "id");
$wizard_group_attributes = json_decode($wizarddata->group_values, true);	


//get key
$row_key = array_search($groupid, array_filter(array_combine(array_keys($wizard_group_attributes),array_column($wizard_group_attributes, 'groupid'))));	

$attributes_array = array();
if ($row_key !== FALSE) {
$row_array = $wizard_group_attributes[$row_key];	
$attributes_array = $row_array['attributes'];
}
//get key

$return_array = array();
if(!empty($attributes_array))
{

foreach ($attributes_array as $key=>$attribute) {
	
 $common_input_id = $attribute['id'];
 $common_input_data = $this->common_model->GetByRow("cms_commoninputs", $common_input_id, "id");

$product_column_name = $common_input_data->product_column_name;
$product_value = $productdata->$product_column_name;
$return_array[$key]['type'] = $common_input_data->field_format_type;
$return_array[$key]['title'] = $common_input_data->name;
$return_array[$key]['label'] = $common_input_data->field_label;
$return_array[$key]['frontend_field_label'] = $common_input_data->frontend_field_label;
$return_array[$key]['column_value'] = $product_value;
$return_array[$key]['column_name'] = $product_column_name;

$attr_element_field_value = $this->index_model->GetProductValueFromCommonInputs($product_column_name, $productdata);
$return_array[$key]['value'] = $attr_element_field_value;

}
	
	
}

return $return_array ;
	
}
	

//{sbn} code


    function get_current_language_data($language, $table, $column) {
        $table_column_name = "";
        $user_purpose_language = json_decode($this->common_model->option->user_purpose_language, TRUE);
        if (!empty($language) && !empty($table) && !empty($column) && !empty($user_purpose_language)) {
            $current_language = $user_purpose_language[$language];
            $table_column_name = $current_language[$table . '-' . $column];
        }
        return $table_column_name;
    }

    function get_language_column_data($parameters) {

        $language_column_value = '';
        $gl_cart_session = $this->session->userdata('gl_cart');

        $website_language = $gl_cart_session['website_language'];

        $language = $website_language;

        if ($parameters['element_value_type'] == 'theme') {

            $table = $parameters['tablename_element'];

            $column = $parameters['columnname_element'];

            $language_column = $this->common_model->get_current_language_data($language, $table, $column);
            if ($language_column) {
                $language_column_value = $language_column;
            }
        }

        return $language_column_value;
    }

    function get_current_language_class() {

        $language_class = '';

        $gl_cart_session = $this->session->userdata('gl_cart');
        $website_language = $gl_cart_session['website_language'];
        $language_type_array = json_decode($this->common_model->option->language_type, TRUE);

        $language_key = array_search($website_language, array_filter(array_combine(array_keys($language_type_array), array_column($language_type_array, 'language'))));

        if ($language_key !== FALSE) {

            $language_value_array = $language_type_array[$language_key];

            $language_class = $language_value_array['language_class'];
        }

        return $language_class;
    }

    function getwizardgroupdetail($wizardid, $groupid) {
        $wizard_row = $this->admin_model->GetByRow('ec_wizard', $wizardid, 'id');
        $fullInputs = json_decode($wizard_row->fullInputs);
        $return_array = array();
        if (!empty($fullInputs)) {
            foreach ($fullInputs as $fullInput) {
                if ($fullInput->groupid == $groupid) {
                    array_push($return_array, $fullInput->common_input_id);
                }
            }
        }

//

        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->where_in('id', $return_array);
        $this->db->order_by('field_label', "ASC");
        return $this->db->get('cms_commoninputs')->result();

//	
    }

//encode/decode number
//$length is the expected lentgth of the encoded id
    function encode_id($id, $seed, $length = 9) {

        return $id;
    }

//$length is the expected lentgth of the original id
    function decode_id($encoded_id, $seed, $length = 6) {

        return $encoded_id;
    }

//encode/decode number




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
            $show_hide = " style='display:none;' ";
        }
        return $show_hide;
    }

    function find_new_orders() {
        $this->db->where('payment_status', '7');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $order_count = $this->db->get('ec_orders')->num_rows();
        echo $order_count;
    }

    function current_currency() {
        $currency_list = $this->common_model->option->currency_list;
        $currency_list = json_decode($currency_list, true);
        $currency_array_key = array_search("yes", array_column($currency_list, 'def_status'));
        $current_currency = $currency_list[$currency_array_key]['name'];
        return $current_currency;
    }

    function current_currency_icon() {
        $currency_list = $this->common_model->option->currency_list;
        $currency_list = json_decode($currency_list, true);
        $currency_array_key = array_search("yes", array_column($currency_list, 'def_status'));
        $current_currency = $currency_list[$currency_array_key]['icon'];
        return $current_currency;
    }

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

    function list_news_gallery($id) {
        $this->db->where('id', $id);
        return $this->db->get('cms_media')->row();
    }

    function list_product_gallery($id) {
        $this->db->where('prod_cat', $id);
        $this->db->where('type', 'product_image');
        $this->db->where('type2', 'product');
        $this->db->where('type_trash', 'no');
        return $this->db->get('cms_media')->result();
    }

    function list_brochure_gallery($id) {
        $this->db->where('prod_cat', $id);
        $this->db->where('type', 'product_brochure');
        $this->db->where('type2', 'product');
        $this->db->where('type_trash', 'no');
        return $this->db->get('cms_media')->result();
    }

    /*
     *  Below two functions product category and category page updation option url key
     */

    function product_category_related_url_option($id, $catoldslug) {
        ini_set('max_execution_time', 0);

        $option_row = $this->common_model->option;
        $route_full_array = json_decode($option_row->route_full_array, TRUE);

        $main_row = $this->common_model->GetByRow('ec_category', $id, 'id');
        $parent_main_id = $main_row->parent_main_id;
        $main_slug = $main_row->slug;
        /*
         * category option url updation
         */
        $this->db->where('active_status', 'a');
        $this->db->where('trash_status', 'no');
        $this->db->where('parent_main_id', $parent_main_id);
        $category_result = $this->db->get('ec_category')->result();

        if (!empty($category_result)) {
            foreach ($category_result as $category_row) {

                $catvalue = $category_row->full_slug;
                $catkey = 'productcat-' . $category_row->id;
                $route_full_array[$catkey]['url'] = $catvalue;
                $route_full_array[$catkey]['target'] = "_self";
                $route_full_array[$catkey]['url_type'] = "original";
                $category_option_route = json_encode($route_full_array);

                $this->common_model->update_option_route_category($category_option_route, $catkey, 'ec_category', $category_row->id);


                $pagerow = $this->common_model->GetByRow('cms_pages', $category_row->id, 'product_category_id');
                if (!empty($pagerow)) {

                    $this->common_model->update_page_slug($main_slug, $pagerow, $catoldslug);
                    $product_cat_page = $this->common_model->GetByRow('cms_pages', $category_row->id, 'product_category_id');
                    $pagevalue = $product_cat_page->full_slug;
                    $pagekey = 'p-' . $product_cat_page->id;
                    $route_full_array[$pagekey]['url'] = $pagevalue;
                    $route_full_array[$pagekey]['target'] = "_self";
                    $route_full_array[$pagekey]['url_type'] = "original";
                    $page_option_route = json_encode($route_full_array);

                    $this->common_model->update_option_route_category($page_option_route, $pagekey, 'cms_pages', $product_cat_page->id);
                }


                $this->common_model->update_category_page_key($category_row->id);
            }
        }



        /*
         * EOF category option url updation
         */


        /*
         * product option url updation based category updation
         */


        $this->db->where('active_status', 'a');
        $this->db->where('trash_status', 'no');
        $this->db->where('parent_main_id', $parent_main_id);
        $product_result = $this->db->get('ec_products')->result();

        if (!empty($product_result)) {
            foreach ($product_result as $product_row) {

                $productvalue = $product_row->full_slug;
                $productkey = 'productitem-' . $product_row->id;
                $route_full_array[$productkey]['url'] = $productvalue;
                $route_full_array[$productkey]['target'] = "_self";
                $route_full_array[$productkey]['url_type'] = "original";
                $product_option_route = json_encode($route_full_array);

                $this->common_model->update_option_route_category($product_option_route, $productkey, 'ec_products', $product_row->id);
            }
        }

        /*
         * EOF product option url updation based category updation
         */
        $route_type_cat = 'product_category';
        $this->route_model->save_routes($route_type_cat);

        $route_type_page = 'page';
        $this->route_model->save_routes($route_type_page);

        $route_type_pro = 'product_item';
        $this->route_model->save_routes($route_type_pro);
    }

    function update_option_route_category($data, $url_key, $related_table, $id) {

        ini_set('max_execution_time', 0);

        $data_array = array(
            'value' => $data);
        $this->db->where('columnlabel', 'route_full_array');
        $this->db->update('cms_options_setting', $data_array);

        $table_data = array(
            'option_url_key' => $url_key
        );

        $this->db->where('id', $id);
        $this->db->update($related_table, $table_data);
    }

    function update_category_page_key($id) {

        $category_details = $this->common_model->GetByRow('ec_category', $id, 'id');

        $this->db->order_by('id', 'DESC');
        $this->db->where('special_page_type', 'connection_page');
        $this->db->where('product_category_id', $category_details->id);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $connection_page = $this->db->get('cms_pages')->row();

        $data = array(
            'option_url_key' => $connection_page->option_url_key,
            'option_url_key2' => $category_details->option_url_key,
        );
        $this->db->where('id', $category_details->id);
        $this->db->update('ec_category', $data);
    }

    function update_page_slug($newslug, $page_row, $catoldslug) {
        $page_id = $page_row->id;
        $oldslug = $catoldslug;
//        $oldslug=$page_row->full_slug;

        $query = "UPDATE cms_pages SET "
                . "full_slug = REPLACE(full_slug, '" . $oldslug . "/','" . $newslug . "/')"
                . " WHERE id='" . $page_id . "'";

        $this->db->query($query);

        $query1 = "UPDATE cms_routes SET "
                . "left_side_full_url = REPLACE(left_side_full_url, '" . $oldslug . "/','" . $newslug . "/'),"
                . "right_side_full_url = REPLACE(right_side_full_url, '" . $oldslug . "/','" . $newslug . "/')"
                . " WHERE slug_type='page'"
                . "AND slug_ref_id='" . $page_id . "'";

        $this->db->query($query1);
    }

    /*
     * Above two functions  product category and category page updation option url key
     */

    function get_ec_cattypes() {
        $this->db->order_by('id', 'DESC');
        $this->db->where('type', 'product_attributes');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $result = $this->db->get('ec_categorytypes')->result();
        return $result;
    }

    function targetlist() {

        $tglocation = array(
            '_self',
            '_blank');
        return $tglocation;
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

//        function listwrappertag() {
//
//        $this->db->where('trash_status', 'no');
//        $this->db->where('active_status', 'a');
//        return $this->db->get('cms_wrappertagbox')->result();
//    }
    function slidervalues() {
        return $slidervalues = array(
            "29" => "1X3",
            "28" => "2X3",
            "3" => "3X3");
    }

    function listMenuTypes() {
        $this->db->where('parent_id', 0);
        $this->db->where('type', 'menu_type');

        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');

        $val = $this->db->get('cms_dynamic_category')->result();
        return $val;
    }

    public function getFeatureboxList() {
        $this->db->where('type !=', 'pop_up');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('cms_featuredbox')->result();
    }

    function listAllMenu() {
        $this->db->where('trash_status', 'no');
        return $this->db->get('cms_menu')->result();
    }

    function listAllFeatureboxes() {
        $this->db->where('trash_status', 'no');
        return $this->db->get('cms_featuredbox')->result();
    }

    function get_array_by_name_assoc($arr_name) {
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

    function connection_array() {
        $connection_array = array(
            "product_category_main_menu" => "Product Category In Dropdown Menu");
        return $connection_array;
    }

    function product_categories($parent_id) {
        $this->db->where('ctype', 1); // category type
        $this->db->where('parent_id', $parent_id);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $product_categories = $this->db->get('ec_category')->result();
        return $product_categories;
    }

    function get_menu_products($parent_id) {
        $this->db->where('function_type', 'product'); // product type
        $this->db->like('categoryidtree', '+' . $parent_id . '+');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->limit(15);
        $this->db->order_by("id", "desc");
        $products = $this->db->get('ec_products')->result();
        return $products;
    }

    function fetch_num_format($number) {
        $return_number=$number;
        switch (digit_format) {
            case 2:
                $return_number=number_format($number,2);
                return $return_number;
                break;
            case 3:
                $return_number=number_format($number,3);
                return $return_number;
                break;
            case 4:
                $return_number=number_format($number,4);
                return $return_number;
                break;
            default:
               $return_number=number_format($number);
               return $return_number;
        }
    }
	
	function GetCouponEcOrderCount($id) {
        $this->db->where('coupon_id', $id);
        $this->db->where('order_id >', 0);
//        $this->db->where('active_status', 'a');
        return $result = $this->db->get('ec_orders')->num_rows;
    }


function get_shiprocket_service_charge($parameters)
{
	

$pickup_pincodes = array(
'',//removed

);

$pickup_pincodes_string = implode('|',$pickup_pincodes);	

//
$resulttype = $parameters['resulttype'];
$delivery_postcode = $parameters['delivery_pincode'];
$cod = $parameters['cod'];
$weight = $parameters['weight'];

//	

$distance_map_url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$pickup_pincodes_string."&destinations=".$delivery_postcode."&key=keyvaluehere";
$distance_result_string = file_get_contents($distance_map_url);
$distance_array = json_decode($distance_result_string, true);

$distance_array_row_array = $distance_array['rows'];

$distance_return_data = array();
$i=0;
foreach($distance_array_row_array as $distance_value)
{
$distance_return_data[$pickup_pincodes[$i]] = $distance_value['elements'][0]['distance']['value'];	


$i++;
}

asort($distance_return_data);

$distance_pincodes_asc = array_keys($distance_return_data);
$nearest_pincode = $distance_pincodes_asc[0];



        $api_email="";
        $api_password="";
        
        $api_request=json_encode(array('email'=>$api_email,'password'=>$api_password));

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/auth/login",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $api_request,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);

        $response_out=json_decode($response);
        $token=$response_out->token;
        
        curl_close($curl);
		




		$order_array = array(
            "pickup_postcode" => $nearest_pincode, // required
            "delivery_postcode" => $delivery_postcode,// required
			"cod" => $cod,// required
			"weight" => $weight,// required
             );

        $order_array_json = json_encode($order_array);


        $curl1 = curl_init();

        curl_setopt_array($curl1, array(
            CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/courier/serviceability/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => $order_array_json,
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".$token, 
                "Content-Type: application/json",
            ),
        ));

        $response2 = curl_exec($curl1);
        $api_response=json_decode($response2);
        curl_close($curl1);	
		
$returnvalue = '';
		if(isset($api_response->data))
		{
		
			
if($resulttype == 'check')
{
$returnvalue = 'yes';
}
else
{
		
		$api_response=json_decode($response2,TRUE);
		$api_response['token'] = $token;
		$api_response = json_encode($api_response);
		$api_response=json_decode($api_response);
		$returnvalue = $api_response;	
}
		
	/*	 
	$delivery_charge = $available_courier_companies[0]->rate;
	$gl_cart_session = $this->session->userdata('gl_cart');
	$gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'delivery_charge', $delivery_charge);
	
	$this->session->set_userdata('gl_cart', $gl_cart_session);*/
		
		//return 'yes';
		
		}
		else
		{
			
if($resulttype == 'check')
{
$returnvalue = 'no';
}
else
{
	
}
			
	//return 'no';
		}
		

return $returnvalue;		
		
		

	
}


function get_address_by_pincode($pincode)
{
	
$get_address_by_pincode = "http://www.postalpincode.in/api/pincode/".$pincode;
$address_by_pincode = file_get_contents($get_address_by_pincode);
$address_by_pincode = json_decode($address_by_pincode, true);
return $address_by_pincode ;	
}


function calculate_cart_based_delivery_charge($carttotalprice)
{

if($this->common_model->option->delivery_charge_by_cart_total_status == 'yes')
{

if($this->common_model->option->delivery_charge_cart_condition == 'charge_by_minimum_cart_total')
{	
	
$minimum_cart_total = $this->common_model->option->delivery_charge_minimum_cart_amount;
$delivery_charge_amount_to_add = $this->common_model->option->delivery_charge_amount_by_cart_total;
	
if($carttotalprice < $minimum_cart_total)
{
//

$gl_cart_session = $this->session->userdata('gl_cart');
$gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'delivery_charge', $delivery_charge_amount_to_add);

$this->session->set_userdata('gl_cart', $gl_cart_session);	


//	
}
else
{
	
$gl_cart_session = $this->session->userdata('gl_cart');
$gl_cart_session = $this->common_model->array_push_assoc($gl_cart_session, 'delivery_charge', '');
$this->session->set_userdata('gl_cart', $gl_cart_session);
	
}

}

}
	
	
}


    function create_shiprocket_order($order_id,$boxno) {
		
        $type="shiprocket";
        $option = $this->common_model->get_options();
		
		$shipping_box_set_array = json_decode($option->shipping_box_set, TRUE);
		
        $order_row=$this->common_model->GetByRow('ec_orders', $order_id, 'id');
		
		
        /* if ($order_row->order_id == 0) {
           $ordrid = $option->tmp_order_string . $order_row->id;
        } else {
           $ordrid = $option->org_order_string . $order_row->order_id;
        }*/
		
		//sbn orderid
		//$ordrid = $this->common_model->format_order_number($order_row->order_id,$order_row->id);
		//sbn orderid
		
if($order_row->order_split_status == 'yes' && $order_row->order_split_type == 'child')
{
	
	
$master_order_details = $this->common_model->GetByRow('ec_orders', $order_row->split_order_master_id , 'id');

//if ($master_order_details->order_id == 0) {
//$ordrid = $option->tmp_order_string . $master_order_details->id;
//} else {
//$ordrid = $option->org_order_string . $master_order_details->order_id.'-'.$order_row->order_id_split_reference;
//}

//sbn orderid
$ordrid = $this->common_model->format_order_number($master_order_details->order_id,$master_order_details->id);
//sbn orderid

if ($master_order_details->order_id == 0) {

} else {
$ordrid = $ordrid.'-'.$order_row->order_id_split_reference;
}


}
else
{
	
//if ($order_row->order_id == 0) {
//$ordrid = $option->tmp_order_string . $order_row->id;
//} else {
//$ordrid = $option->org_order_string . $order_row->order_id;
//}

//sbn orderid
$ordrid = $this->common_model->format_order_number($order_row->order_id,$order_row->id);
//sbn orderid

}
		
		
        $purchase_date=$order_row->purchase_date;
        $payment_method_string=$order_row->payment_method_string;
        $order_total=$order_row->order_total;

        if($payment_method_string=="cod"){
            $payment_method="COD";
        }else{
            $payment_method="Prepaid";
        }
        $billing_address_json=$order_row->billing_address;
        $billing_address_array=json_decode($billing_address_json,TRUE);
        $billing_phone=$billing_address_array['frm_phoneno'];
        $billing_email=$billing_address_array['frm_email'];
        $billing_customer_name=$billing_address_array['frm_first_name'];
        $billing_last_name=$billing_address_array['frm_first_name'];
        $billing_address=$billing_address_array['frm_address'];
		
        //city
		$billing_city=$billing_address_array['frm_city'];
		
$billing_city = trim($billing_city);	
if (is_numeric($billing_city)) {
$city_id = $billing_city;
$city_row = $this->common_model->GetByRow('cms_locations', $city_id, 'id');
$billing_city = $city_row->location;
}
	//city
		
        $billing_pincode=$billing_address_array['frm_pincode'];
		
		//state
        $billing_state=$billing_address_array['frm_state'];	
		
$billing_state = trim($billing_state);
if(is_numeric($billing_state)){
$state_id=$billing_state;
$state_row = $this->common_model->GetByRow('cms_locations', $state_id, 'id');
$billing_state=$state_row->location;
}
		//state
		
        $billing_country_id=$billing_address_array['frm_country'];
        $billing_country_row=$this->common_model->GetByRow_notrash('cms_locations', $billing_country_id, 'id');
       
        $billing_country=$billing_country_row->location;
        
        $shipping_address_json=$order_row->shipping_address;
        $shipping_address_array=json_decode($shipping_address_json,TRUE);
        $shipping_phone=$shipping_address_array['frm_phoneno'];
        $shipping_email=$shipping_address_array['frm_email'];
        $shipping_customer_name=$shipping_address_array['frm_first_name'];
        $shipping_last_name=$shipping_address_array['frm_first_name'];
        $shipping_address=$shipping_address_array['frm_address'];
        

//city
$shipping_city=$shipping_address_array['frm_city'];
		
$shipping_city = trim($shipping_city);	
if (is_numeric($shipping_city)) {
$city_id = $shipping_city;
$city_row = $this->common_model->GetByRow('cms_locations', $city_id, 'id');
$shipping_city = $city_row->location;
}
	//city
		
        $shipping_pincode=$shipping_address_array['frm_pincode'];
		
        
//state
        $shipping_state=$shipping_address_array['frm_state'];
		
$shipping_state = trim($shipping_state);
if(is_numeric($shipping_state)){
$state_id=$shipping_state;
$state_row = $this->common_model->GetByRow('cms_locations', $state_id, 'id');
$shipping_state=$state_row->location;
}
		//state
		
        $shipping_country_id=$shipping_address_array['frm_country'];
        $shipping_country_row=$this->common_model->GetByRow_notrash('cms_locations', $shipping_country_id, 'id');
        $shipping_country=$shipping_country_row->location;

        $table="ec_order_list";
        $order_column="id";
        $order_type="ASC";
        $conditional_array=array("ec_orders_id"=>$order_id);
        $order_list=$this->common_model->GetByResult_Where($table, $order_column, $order_type,
            $conditional_array);
			
		$order_total_weight = 0;	
        $array_order_items=array();
        if(!empty($order_list)){
            foreach($order_list as $okey=> $order_item){
             $array_order_items[$okey]["name"]=$order_item->product_name;  
             $array_order_items[$okey]["sku"]=$order_item->sku_code;  
             $array_order_items[$okey]["units"]=$order_item->order_qty;  
             $array_order_items[$okey]["selling_price"]=$order_item->product_price;  
             $array_order_items[$okey]["discount"]="";  
             $array_order_items[$okey]["tax"]="";  
             $array_order_items[$okey]["hsn"]=1; 
			 
//

$product_full_info_json = json_decode($order_item->product_full_info_json, TRUE);
$product_full_info_key = $this->common_model->GetKeyFromArrayOrNull('weightinkg', 'column_name', $product_full_info_json);

if ($product_full_info_key !== NULL) {

$weightinkg = $product_full_info_json[$product_full_info_key]["value"];
} else {

$weightinkg = $product_details->weightinkg;
}

//
			 
			 
			 $order_total_weight+=$weightinkg; 

            }
        }			
			
			
//nearest pincode

$pickup_locations_bypincodes = array(
'' => '',


);

$pickup_pincodes = array(

'',

);

$pickup_pincodes_string = implode('|',$pickup_pincodes);	

//
$codvalue = 0;
if($payment_method_string == "cod"){
$codvalue = 1;	
}

$delivery_postcode = $shipping_pincode;
$cod = $codvalue;
$weight = $order_total_weight;

//	

$distance_map_url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$pickup_pincodes_string."&destinations=".$delivery_postcode."&key=keyhere";
$distance_result_string = file_get_contents($distance_map_url);
$distance_array = json_decode($distance_result_string, true);

$distance_array_row_array = $distance_array['rows'];

$distance_array = array();
$distance_return_data = array();
$i=0;
foreach($distance_array_row_array as $distance_value)
{
$distance_return_data[$pickup_pincodes[$i]] = $distance_value['elements'][0]['distance']['value'];	
$distance_array[] = $distance_value['elements'][0]['distance']['value'];

$i++;
}

asort($distance_return_data);

$distance_pincodes_asc = array_keys($distance_return_data);
$nearest_pincode = $distance_pincodes_asc[0];

$nearest_location_name = $pickup_locations_bypincodes[$nearest_pincode];


//nearest pincode
$pickup_assigned = 'distance';
if(empty($distance_array))
{
$pickup_assigned = 'primary';
}



				//
				$pickup_data = array(
				"pickup_pincode" => $nearest_pincode,
				"pickup_assigned" => $pickup_assigned,
				);
				
				
				$this->db->where('id', $order_id);
				$this->db->update('ec_orders', $pickup_data); 
				//
			
			
			
        
        $api_email="";
        $api_password="";
        
        $api_request=json_encode(array('email'=>$api_email,'password'=>$api_password));

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/auth/login",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $api_request,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);

        $response_out=json_decode($response);
        $token=$response_out->token;
        
        curl_close($curl);
		
		

//get key
$shipping_box_key = array_search($boxno, array_filter(array_combine(array_keys($shipping_box_set_array),array_column($shipping_box_set_array, 'shipping_box_key'))));
if ($shipping_box_key !== FALSE) {
$shipping_box_row = $shipping_box_set_array[$shipping_box_key];	
}
//get key

$shipping_length = $shipping_box_row['shipping_box_length'];
$shipping_breadth = $shipping_box_row['shipping_box_breadth']; 
$shipping_height = $shipping_box_row['shipping_box_height'];


//
				$boxdata_data = array(
				"deliveryboxid" => $boxno,
				"deliveryboxdata" => json_encode($shipping_box_row),
				);
				
				
				$this->db->where('id', $order_id);
				$this->db->update('ec_orders', $boxdata_data); 
				
//	




        $order_array = array(
            "order_id" => $ordrid, // required
            "order_date" => $purchase_date,// required
            "pickup_location" => $nearest_location_name,// required
            "channel_id" => "",// not required
            "comment" => $ordrid,// not required
            "billing_customer_name" => $billing_customer_name,// required
            "billing_last_name" => $billing_last_name,// not required
            "billing_address" => $billing_address,// not required
            "billing_address_2" => "",// not required
            "billing_city" => $billing_city, // required
            "billing_pincode" => $billing_pincode, // required
            "billing_state" => $billing_state,// required
            "billing_country" => $billing_country,// required
            "billing_email" => $billing_email,// required
            "billing_phone" => $billing_phone,// required
            "shipping_is_billing" => false,// required
            "shipping_customer_name" =>$shipping_customer_name, // required
            "shipping_last_name" => $shipping_last_name,
            "shipping_address" => $shipping_address,// required
            "shipping_address_2" => "",// not required
            "shipping_city" => $shipping_city,// required
            "shipping_pincode" => $shipping_pincode,// required
            "shipping_country" => $shipping_country,// required
            "shipping_state" => $shipping_state,// required
            "shipping_email" => $shipping_email,// required
            "shipping_phone" => $shipping_phone,// required
            "order_items" => $array_order_items,// required
            "payment_method" => $payment_method,// required
            "shipping_charges" => 0,// not required
            "giftwrap_charges" => 0,// not required
            "transaction_charges" => 0,// not required
            "total_discount" => 0,// not required
            "sub_total" => $order_total,// required
            "length" => $shipping_length,// required
            "breadth" => $shipping_breadth,// required
            "height" => $shipping_height,// required
            "weight" => $order_total_weight);

        $order_array_json = json_encode($order_array);


        $curl1 = curl_init();

        curl_setopt_array($curl1, array(
            CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/create/adhoc",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $order_array_json,
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".$token, 
                "Content-Type: application/json",
            ),
        ));

        $response2 = curl_exec($curl1);
        curl_close($curl1);
		
		$api_response=json_decode($response2,TRUE);
		$api_response['token'] = $token;
		$api_response = json_encode($api_response);
		$api_response = json_decode($api_response);

        return $api_response;		
		
	
    }


function create_shiprocket_airwaybill($parameters)
{

//
$shipment_id = $parameters['shipment_id'];
$courier_id = $parameters['courier_id'];
//	

        $api_email="";
        $api_password="";
        
        $api_request=json_encode(array('email'=>$api_email,'password'=>$api_password));

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/auth/login",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $api_request,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);

        $response_out=json_decode($response);
        $token=$response_out->token;
        
        curl_close($curl);
		




		$order_array = array(
            "shipment_id" => $shipment_id, // required
            "courier_id" => $courier_id,// required
             );

        $order_array_json = json_encode($order_array);


        $curl1 = curl_init();

        curl_setopt_array($curl1, array(
            CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/courier/assign/awb",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $order_array_json,
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".$token, 
                "Content-Type: application/json",
            ),
        ));

        $response2 = curl_exec($curl1);
        $api_response=json_decode($response2);
        curl_close($curl1);	
		
		if(isset($api_response->awb_assign_status))
		{
		$api_response=json_decode($response2,TRUE);
		$api_response['token'] = $token;
		$api_response = json_encode($api_response);
		$api_response = json_decode($api_response);
		}
		
		return $api_response;

	
}


function create_shiprocket_pickup($parameters)
{

//
$shipment_id = $parameters['shipment_id'];
//	

        $api_email="";
        $api_password="";
        
        $api_request=json_encode(array('email'=>$api_email,'password'=>$api_password));

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/auth/login",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $api_request,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);

        $response_out=json_decode($response);
        $token=$response_out->token;
        
        curl_close($curl);
		




		$order_array = array(
            'shipment_id' => array($shipment_id), // required
             );

        $order_array_json = json_encode($order_array);


        $curl1 = curl_init();

        curl_setopt_array($curl1, array(
            CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/courier/generate/pickup",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $order_array_json,
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".$token, 
                "Content-Type: application/json",
            ),
        ));

        $response2 = curl_exec($curl1);
        $api_response=json_decode($response2);
        curl_close($curl1);	
		
		if(isset($api_response->response))
		{
		$api_response=json_decode($response2,TRUE);
		$api_response['token'] = $token;
		$api_response = json_encode($api_response);
		$api_response = json_decode($api_response);
		}
		
		return $api_response;

	
}



function create_shiprocket_maifest($parameters)
{

//
$shipment_id = $parameters['shipment_id'];
//	

        $api_email="";
        $api_password="";
        
        $api_request=json_encode(array('email'=>$api_email,'password'=>$api_password));

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/auth/login",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $api_request,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);

        $response_out=json_decode($response);
        $token=$response_out->token;
        
        curl_close($curl);
		




		$order_array = array(
            'shipment_id' => array($shipment_id), // required
             );

        $order_array_json = json_encode($order_array);


        $curl1 = curl_init();

        curl_setopt_array($curl1, array(
            CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/manifests/generate",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $order_array_json,
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".$token, 
                "Content-Type: application/json",
            ),
        ));

        $response2 = curl_exec($curl1);
        $api_response=json_decode($response2);
        curl_close($curl1);	
		
		if(isset($api_response->response))
		{
		$api_response=json_decode($response2,TRUE);
		$api_response['token'] = $token;
		$api_response = json_encode($api_response);
		$api_response = json_decode($api_response);
		}
		
		return $api_response;

	
}



function create_shiprocket_label($parameters)
{

//
$shipment_id = $parameters['shipment_id'];
//	

        $api_email="";
        $api_password="";
        
        $api_request=json_encode(array('email'=>$api_email,'password'=>$api_password));

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/auth/login",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $api_request,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);

        $response_out=json_decode($response);
        $token=$response_out->token;
        
        curl_close($curl);
		




		$order_array = array(
            'shipment_id' => array($shipment_id), // required
             );

        $order_array_json = json_encode($order_array);


        $curl1 = curl_init();

        curl_setopt_array($curl1, array(
            CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/courier/generate/label",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $order_array_json,
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".$token, 
                "Content-Type: application/json",
            ),
        ));

        $response2 = curl_exec($curl1);
        $api_response=json_decode($response2);
        curl_close($curl1);	
		
		if(isset($api_response->response))
		{
		$api_response=json_decode($response2,TRUE);
		$api_response['token'] = $token;
		$api_response = json_encode($api_response);
		$api_response = json_decode($api_response);
		}
		
		return $api_response;

	
}




function create_shiprocket_invoice($parameters)
{

//
$shipping_order_id = $parameters['shipping_order_id'];
//	

        $api_email="";
        $api_password="";
        
        $api_request=json_encode(array('email'=>$api_email,'password'=>$api_password));

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/auth/login",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $api_request,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);

        $response_out=json_decode($response);
        $token=$response_out->token;
        
        curl_close($curl);
		




		$order_array = array(
            'ids' => array($shipping_order_id), // required
             );

        $order_array_json = json_encode($order_array);


        $curl1 = curl_init();

        curl_setopt_array($curl1, array(
            CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/print/invoice",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $order_array_json,
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".$token, 
                "Content-Type: application/json",
            ),
        ));

        $response2 = curl_exec($curl1);
        $api_response=json_decode($response2);
        curl_close($curl1);	
		
		if(isset($api_response->response))
		{
		$api_response=json_decode($response2,TRUE);
		$api_response['token'] = $token;
		$api_response = json_encode($api_response);
		$api_response = json_decode($api_response);
		}
		
		return $api_response;

	
}



function InsertTableRowToOptionColumnArray($parameters) {
		

$table = $parameters['table'];
$id = $parameters['id'];
$type = $parameters['type'];
$optioncolumn = $parameters['optioncolumn'];

        $table_value_row = $this->common_model->GetByRow($table, $id, 'id');

        //{oldoption}
        //$options = $this->common_model->get_options();
        // $option = $options[0];
        //{oldoption}

        $option = $this->option;

        $option_value_array_column = json_decode($option->$optioncolumn, TRUE);
        $option_columnvalue_new_row = $table_value_row;
//        $option_columnvalue_new_row=(array)$table_value_row;



         //insert/update
		
		
if ($table_value_row->active_status == 'a' && $table_value_row->trash_status == 'no') 
{
	
            if ($option_value_array_column != NULL) {
                if (array_key_exists($id, $option_value_array_column) && $type == 'add') {
                    // key exist
                    $data = json_encode($option_value_array_column);
                } else {
                    $option_value_array_column = $this->common_model->array_push_assoc($option_value_array_column, $table_value_row->id, $option_columnvalue_new_row);
                    $data = json_encode($option_value_array_column);
                }
            } else {
                $option_value_array_column = $this->common_model->array_push_assoc($option_value_array_column, $table_value_row->id, $option_columnvalue_new_row);
                $data = json_encode($option_value_array_column);
            }
			
} 
else 
{
            if (array_key_exists($id, $option_value_array_column)) {
                // key exist
                unset($option_value_array_column[$id]);
                $data = json_encode($option_value_array_column);
            }
}
        
		
		//insert/update
		
		

        //{oldoption}
        /* $common_field = array(
          'option_value_array_column' => $data
          ); */
        //{oldoption}

        $common_field = array(
            'value' => $data
        );


        //{oldoption}
        // $this->db->where('id', $option->id);
        // $this->db->update('cms_options', $common_field);
        //{oldoption}

        $this->db->where('columnlabel', $optioncolumn);
        $this->db->update('cms_options_setting', $common_field);
    } 
	

function Update_Order_Status_Manually($order_id,$status_id)
{

        $reupdate_status = 'no';
        $ec_orders = $pdata = $this->common_model->GetByRow('ec_orders', $order_id, 'id');
        $conditional_array = array(
            "ec_orders_id" => $order_id,
        );
        $ec_order_list = $this->common_model->GetByResult_Where('ec_order_list', 'id', 'DESC', $conditional_array);

        $payment_data = json_decode($pdata->payment_data, true);
		
		
		
$status_textstring = '';
if($status_id == '9')  
{
$status_textstring = 'Order being cancelled by customer';	
}
else
if($status_id == '16')  
{
$status_textstring = 'Order Return requested by customer';	
}

$text_array[] = array(
"place_reached"=>"",
"status_textstring"=>$status_textstring ,
"admin_text"=>"",
"info_sent_to"=>"billing",
"sms"=>"no",
"sms_text"=>"",
"sms_text2"=>"",
"mail"=>"no",
"datetime"=>date("Y-m-d H:i:s")
);

//$text = json_encode($text_array);

$text = $text_array;

       
            $sms = 'no';
            $smstext = '';
            $smstext2 = '';
            $date = date("Y-m-d H:i:s");
            $email = 'no';
            $newtext = '';
            $newtext1 = $text;
			


			
        

        $decoded = $this->common_model->find_json_row($payment_data, 'status_id', $status_id);


        if ($payment_data == '') {
            $statusarray = $status_json;
        } else {

            if ($decoded != '' || $decoded == '0') {

                $newdata = $payment_data[$decoded];
                $paydatkey = $decoded;
                array_unshift($newdata['text'], $newtext);
                $text = $newdata['text'];
                $starray = array(
                    'status_id' => $status_id,
                    'text' => $text,
                    'sms' => $sms,
                    'smstext' => $smstext,
                    "smstext2" => $smstext2,
                    'email' => $email,
                    'datetime' => $date);
                $replacement = array(
                    $paydatkey => $starray);
                $full_json = array_replace($payment_data, $replacement);
                $statusarray = json_encode($full_json, true);
            } else {


                $text = $newtext1;
                $starray = array(
                    'status_id' => $status_id,
                    'text' => $text,
                    'sms' => $sms,
                    'smstext' => $smstext,
                    "smstext2" => $smstext2,
                    'email' => $email,
                    'datetime' => $date);
                array_unshift($payment_data, $starray);
                $statusarray = json_encode($payment_data, true);
            }
        }


        if ($reupdate_status == 'yes' && $pdata->payment_status > $status_id) {
            $data = array(
                "payment_data" => $statusarray,
            );
        } else {
            $data = array(
                "payment_status" => $status_id,
                "payment_data" => $statusarray,
            );
        }

        $this->db->where('id', $order_id);
        $this->db->update('ec_orders', $data);

        $this->db->where('ec_orders_id', $order_id);
        $this->db->update('ec_order_list', $data);

        $this->common_model->UpdateOrderStatusBehaviour($status_id, $order_id);

        
        //To update product's order count
        $this->common_model->GetProductOrderCount($order_id);

        if ($reupdate_status != 'yes') {

            switch ($status_id) {
                case '3':

                    $this->common_model->UpdateOrderStatus('7', $order_id);


                    break;
                case '4':

                    $this->common_model->UpdateOrderStatus('8', $order_id);

                    break;
                case '5':
                    $this->common_model->UpdateOrderStatus('9', $order_id);

                    break;
                case '6':

                    $this->common_model->UpdateOrderStatus('10', $order_id);

                    break;

                default:
                    break;
            }
        }


	
}


 function find_json_row($json, $field, $to_find) {

        for ($i = 0, $len = count($json); $i < $len; ++$i) {
            if ($json[$i][$field] === $to_find) {

                return $i;
                exit();
            }
        }
    }
	

 function get_order_total_qty($orderid) {
	 
        $this->db->select_sum('order_qty');
        $this->db->where('ec_orders_id', $orderid);
        return $this->db->get('ec_order_list')->row();
        
    }	
	

 function get_order_split_child_orders($orderid) {
	 
        $this->db->where('split_order_master_id', $orderid);
        return $this->db->get('ec_orders')->result();
        
    }		
	   

function get_products_count()
{
		$this->db->where('qty >', 0);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('ec_products')->num_rows();
	
}

function get_deactivated_products_count()
{
		$this->db->where('qty', 0);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('ec_products')->num_rows();
	
}

function get_users_count()
{

return $this->db->get('users')->num_rows();	
	
}


function get_total_orders() {
	
        $this->db->where('order_id >', 0);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('ec_orders')->num_rows();
      
    }

function get_total_pending_orders() {
        $this->db->where('payment_status', '2');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('ec_orders')->num_rows();
      
    }



function create_shiprocket_orderreturn($order_id) {
		
        $type="shiprocket";
        $option = $this->common_model->get_options();
		
        $order_row=$this->common_model->GetByRow('ec_orders', $order_id, 'id');
		
		
        /* if ($order_row->order_id == 0) {
           $ordrid = $option->tmp_order_string . $order_row->id;
        } else {
           $ordrid = $option->org_order_string . $order_row->order_id;
        }*/
		
//sbn orderid
//$ordrid = $this->common_model->format_order_number($order_row->order_id,$order_row->id);
//sbn orderid
		
if($order_row->order_split_status == 'yes' && $order_row->order_split_type == 'child')
{
	
$master_order_details = $this->common_model->GetByRow('ec_orders', $order_row->split_order_master_id , 'id');

//if ($master_order_details->order_id == 0) {
//$ordrid = $option->tmp_order_string . $master_order_details->id;
//} else {
//$ordrid = $option->org_order_string . $master_order_details->order_id.'-'.$order_row->order_id_split_reference;
//}

//sbn orderid
$ordrid = $this->common_model->format_order_number($master_order_details->order_id,$master_order_details->id);
//sbn orderid

if ($master_order_details->order_id == 0) {

} else {
$ordrid = $ordrid.'-'.$order_row->order_id_split_reference;
}

}
else
{
	
//if ($order_row->order_id == 0) {
//$ordrid = $option->tmp_order_string . $order_row->id;
//} else {
//$ordrid = $option->org_order_string . $order_row->order_id;
//}

//sbn orderid
$ordrid = $this->common_model->format_order_number($order_row->order_id,$order_row->id);
//sbn orderid

}
		
		
        $purchase_date=$order_row->purchase_date;
        $payment_method_string=$order_row->payment_method_string;
        $order_total=$order_row->order_total;

        if($payment_method_string=="cod"){
            $payment_method="COD";
        }else{
            $payment_method="Prepaid";
        }
        $billing_address_json=$order_row->billing_address;
        $billing_address_array=json_decode($billing_address_json,TRUE);
        $billing_phone=$billing_address_array['frm_phoneno'];
        $billing_email=$billing_address_array['frm_email'];
        $billing_customer_name=$billing_address_array['frm_first_name'];
        $billing_last_name=$billing_address_array['frm_first_name'];
        $billing_address=$billing_address_array['frm_address'];
        
				
//city
		$billing_city=$billing_address_array['frm_city'];
		
$billing_city = trim($billing_city);	
if (is_numeric($billing_city)) {
$city_id = $billing_city;
$city_row = $this->common_model->GetByRow('cms_locations', $city_id, 'id');
$billing_city = $city_row->location;
}
//city
		
		
        $billing_pincode=$billing_address_array['frm_pincode'];
		
       
	   
//state
        $billing_state=$billing_address_array['frm_state'];
		
$billing_state = trim($billing_state);
if(is_numeric($billing_state)){
$state_id=$billing_state;
$state_row = $this->common_model->GetByRow('cms_locations', $state_id, 'id');
$billing_state=$state_row->location;
}
//state
		
        $billing_country_id=$billing_address_array['frm_country'];
        $billing_country_row=$this->common_model->GetByRow_notrash('cms_locations', $billing_country_id, 'id');
       
        $billing_country=$billing_country_row->location;
        
        $shipping_address_json=$order_row->shipping_address;
        $shipping_address_array=json_decode($shipping_address_json,TRUE);
        $shipping_phone=$shipping_address_array['frm_phoneno'];
        $shipping_email=$shipping_address_array['frm_email'];
        $shipping_customer_name=$shipping_address_array['frm_first_name'];
        $shipping_last_name=$shipping_address_array['frm_first_name'];
        $shipping_address=$shipping_address_array['frm_address'];
        
		
//city
$shipping_city=$shipping_address_array['frm_city'];
		
$shipping_city = trim($shipping_city);	
if (is_numeric($shipping_city)) {
$city_id = $shipping_city;
$city_row = $this->common_model->GetByRow('cms_locations', $city_id, 'id');
$shipping_city = $city_row->location;
}
//city
		
		
        $shipping_pincode=$shipping_address_array['frm_pincode'];
		
       
//state
        $shipping_state=$shipping_address_array['frm_state'];
		
$shipping_state = trim($shipping_state);
if(is_numeric($shipping_state)){
$state_id=$shipping_state;
$state_row = $this->common_model->GetByRow('cms_locations', $state_id, 'id');
$shipping_state=$state_row->location;
}
//state
		
        $shipping_country_id=$shipping_address_array['frm_country'];
        $shipping_country_row=$this->common_model->GetByRow_notrash('cms_locations', $shipping_country_id, 'id');
        $shipping_country=$shipping_country_row->location;

        $table="ec_order_list";
        $order_column="id";
        $order_type="ASC";
        $conditional_array=array("ec_orders_id"=>$order_id);
        $order_list=$this->common_model->GetByResult_Where($table, $order_column, $order_type,
            $conditional_array);
			
		$order_total_weight = 0;	
        $array_order_items=array();
        if(!empty($order_list)){
            foreach($order_list as $okey=> $order_item){
             $array_order_items[$okey]["name"]=$order_item->product_name;  
             $array_order_items[$okey]["sku"]=$order_item->sku_code;  
             $array_order_items[$okey]["units"]=$order_item->order_qty;  
             $array_order_items[$okey]["selling_price"]=$order_item->product_price;  
             $array_order_items[$okey]["discount"]="";  
             $array_order_items[$okey]["tax"]="";  
             $array_order_items[$okey]["hsn"]=1; 
			 
//

$product_full_info_json = json_decode($order_item->product_full_info_json, TRUE);
$product_full_info_key = $this->common_model->GetKeyFromArrayOrNull('weightinkg', 'column_name', $product_full_info_json);

if ($product_full_info_key !== NULL) {

$weightinkg = $product_full_info_json[$product_full_info_key]["value"];
} else {

$weightinkg = $product_details->weightinkg;
}

//
			 
			 
			 $order_total_weight+=$weightinkg; 

            }
        }			
			
			
//nearest pincode

$pickup_locations_bypincodes = array(
'' => '',


);


$pickup_location_address_bypincodes = array(

'' => array(

'code'=>'',
'location_id'=>'',
'address'=>'',
'city'=>'',
'state'=>'',
'country'=>'',
'email'=>'',
'phone'=>'',
'name'=>'',
'company_id'=>'',
'status'=>'',

),


);



$pickup_pincode = $order_row->pickup_pincode;

$pickup_location_address = $pickup_location_address_bypincodes[$pickup_pincode];


$pickup_code = $pickup_location_address['code'];
$pickup_location_id = $pickup_location_address['location_id'];
$pickup_address = $pickup_location_address['address'];
$pickup_city = $pickup_location_address['city'];
$pickup_state = $pickup_location_address['state'];
$pickup_country = $pickup_location_address['country'];
$pickup_email = $pickup_location_address['email'];
$pickup_phone = $pickup_location_address['phone'];
$pickup_name = $pickup_location_address['name'];
$pickup_company_id = $pickup_location_address['company_id'];
$pickup_status = $pickup_location_address['status'];
			
			
        
        $api_email="";
        $api_password="";
        
        $api_request=json_encode(array('email'=>$api_email,'password'=>$api_password));

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/auth/login",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $api_request,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);

        $response_out=json_decode($response);
        $token=$response_out->token;
        
        curl_close($curl);
		
		
$boxno = $order_row->deliveryboxid;
//get key
$shipping_box_key = array_search($boxno, array_filter(array_combine(array_keys($shipping_box_set_array),array_column($shipping_box_set_array, 'shipping_box_key'))));
if ($shipping_box_key !== FALSE) {
$shipping_box_row = $shipping_box_set_array[$shipping_box_key];	
}
//get key

$shipping_length = $shipping_box_row['shipping_box_length'];
$shipping_breadth = $shipping_box_row['shipping_box_breadth']; 
$shipping_height = $shipping_box_row['shipping_box_height'];	




        $order_array = array(
            "order_id" => $ordrid, // required
            "order_date" => $purchase_date,// required
           
            "channel_id" => "",// not required
            "comment" => $ordrid,// not required
			
			
			"shipping_customer_name" =>$shipping_customer_name, // required
            "shipping_last_name" => $shipping_last_name,
            "shipping_address" => $shipping_address,// required
            "shipping_address_2" => "",// not required
            "shipping_city" => $shipping_city,// required
            "shipping_pincode" => $shipping_pincode,// required
            "shipping_country" => $shipping_country,// required
            "shipping_state" => $shipping_state,// required
            "shipping_email" => $shipping_email,// required
			"shipping_isd_code" => '91',// required
            "shipping_phone" => $shipping_phone,// required
			
			
			
			
            "pickup_customer_name" => $pickup_name,// required
            "pickup_last_name" => '',// not required
            "pickup_address" => $pickup_address,// not required
            "pickup_address_2" => "",// not required
            "pickup_city" => $pickup_city, // required
            "pickup_state" => $pickup_state, // required
            "pickup_country" => $pickup_country,// required
            "pickup_pincode" => $pickup_pincode,// required
            "pickup_email" => $pickup_email,// required
            "pickup_phone" => $pickup_phone,// required
            "pickup_isd_code" => '91',// required,
			"pickup_location_id" => $pickup_location_id,// required
			
           
            "order_items" => $array_order_items,// required
            "payment_method" => $payment_method,// required
            "shipping_charges" => 0,// not required
            "giftwrap_charges" => 0,// not required
            "transaction_charges" => 0,// not required
            "total_discount" => 0,// not required
            "sub_total" => $order_total,// required
            "length" => $shipping_length,// required
            "breadth" => $shipping_breadth,// required
            "height" => $shipping_height,// required
            "weight" => $order_total_weight);

        $order_array_json = json_encode($order_array);


        $curl1 = curl_init();

        curl_setopt_array($curl1, array(
            CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/create/return",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $order_array_json,
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".$token, 
                "Content-Type: application/json",
            ),
        ));

        $response2 = curl_exec($curl1);
        curl_close($curl1);
		
		$api_response=json_decode($response2,TRUE);
		$api_response['token'] = $token;
		$api_response = json_encode($api_response);
		$api_response = json_decode($api_response);

        return $api_response;		
		
	
    }	

function get_shipping_method_option_array($type)
{
	
$shipping_methods = $this->common_model->option->shipping_methods;
$shipping_methods = json_decode($shipping_methods,true);

if($type == 'shipping_type')
{
$shipping_methods_first_value = array_values($shipping_methods);
$shipping_methods_first_value = $shipping_methods_first_value[0];
return $shipping_methods_first_value['fixed_type'];
}
	
}


function update_parent_category_based_location($catid)
{
	

$ec_parent_category_detail = $this->GetByRow_notrash('ec_category', $catid , 'id');


 				$data_location = array(
                    "location_country" => $ec_parent_category_detail->location_country,
                    "location_state" => $ec_parent_category_detail->location_state,
                    "location_city" => $ec_parent_category_detail->location_city,
					);

                $this->db->where('parent_main_id', $ec_parent_category_detail->id);
                $this->db->update('ec_category', $data_location);

                $this->db->where('parent_main_id', $ec_parent_category_detail->id);
                $this->db->update('ec_products', $data_location);
				
					
	
}


 public function location_bytype_and_parent($parentid,$typeid) {

        $this->db->select('*');
        $this->db->from('cms_locations');
        $this->db->where('parent_id', $parentid);
        $this->db->where('location_type_id', $typeid);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }



function empty_cart_box()
{
$this->common_model->RemoveCustomerproductbox_by_type('cart');	
$this->cart->destroy();
}


function adminUsers() {
        $admin_users = array(
            "1" => "Admin",
			);
        return $admin_users;
    }



function check_continue_to_checkout_conditions()
{

$continue_to_checkout_status = 'yes';

if($this->common_model->option->minimum_cart_status == 'yes')
{

if($this->common_model->option->minimum_cart_special_condition == 'delivery_dubai_food')
{

$cart_array = $this->cart->contents();
$cart_array = array_values($cart_array);	
$gl_cart_session = $this->session->userdata('gl_cart');	

$process_type = "";
if (!empty($gl_cart_session["process"])) {
    $process = json_decode($gl_cart_session["process"], true);
    $process_type = $process['process_type'];
}

$pickup_delivery_city_id = "";
if (!empty($gl_cart_session['location_group'])) {
	
    $location_group_array = $gl_cart_session['location_group'];
    $location_group_row = json_decode($location_group_array, true);
    $pickup_delivery_city_id = $location_group_row['city'];
    
}


//$parent_main_id = '2';
//$parent_main_id_key = array_search($parent_main_id, array_filter(array_combine(array_keys($cart_array), array_column($cart_array, 'parent_main_id'))));
//&& $parent_main_id_key !== FALSE

if($process_type == 'delivery' && $pickup_delivery_city_id == '4762' )
{	
	

if($this->common_model->option->minimum_cart_amount > 0)
{


$this->session->set_userdata('gl_cart', $gl_cart_session);	

$total_cart_amount = $gl_cart_session['total_cart_amount'];	



if($total_cart_amount >= $this->common_model->option->minimum_cart_amount)
{
	
	
}
else
{
$continue_to_checkout_status = 'no';
}

}


	
}
	
	
}


}	


return $continue_to_checkout_status;	
	
}


function format_order_number($order_id,$ec_order_id)
{

if($this->common_model->option->order_number_type == 'orderyeartype1')
{
	
		if ($order_id == 0) {
           $new_order_id = $this->common_model->option->tmp_order_string . $ec_order_id;
        } else {
           $new_order_id = date('Y').'00'. $order_id;
        }
		
}
else
{
		if ($order_id == 0) {
           $new_order_id = $this->common_model->option->tmp_order_string . $ec_order_id;
        } else {
           $new_order_id = $this->common_model->option->org_order_string . $order_id;
        }
		
}

return $new_order_id ;	
}


    function get_customer_product_box_data($type) {
        $userid = '';
        if ($this->ion_auth->logged_in()) {
            $logged_user_data = $this->ion_auth->user()->row();
            $userid = $logged_user_data->id;
        } else {
            $userid = session_id();
        }
        $this->db->where('user_id', $userid);
        $this->db->where('type', $type);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('id', 'desc');
        $this->db->from('ec_customer_product_box');
        return $result = $this->db->get()->result();
    }
	


	
	function update_customer_product_box($sessionid)
	{		  
		  
		  $this->db->where('user_id',$sessionid);
		  $val= $this->db->get('ec_customer_product_box');
		  $total= $val->num_rows();
		 
		 if($total > 0)
		 {
			 $logged_user_data = $this->ion_auth->user()->row();
			 $user_id=$logged_user_data->id; 
			 
			 $data = array('user_id' => $user_id);
			 
			 $this->db->where('user_id',$sessionid);
			 $this->db->update('ec_customer_product_box', $data);	
		 }
	}	
	

function customer_cart_product_box_data_to_mycart()
{

$mycart_customer_product_box_data = $this->common_model->get_customer_product_box_data('cart');	

foreach($mycart_customer_product_box_data as $mycart_row)
{

$product_id = $mycart_row->	product_id;
$qty = $mycart_row->qty;

$product_row = $this->common_model->GetByRow('ec_products', $product_id, 'id');

if($product_row)
{
if($product_row->qty > 0)
{

if($product_row->qty < $qty)
{
$qty = $product_row->qty ;
}

$product_images = $product_row->prod_file;
$pro_img = json_decode($product_images, true);

$cart_array = $this->cart->contents();

$proceed_to_next = 'yes';
if(!empty($cart_array))
{
$cart_array = array_values($cart_array);

$cart_key = array_search($product_id, array_filter(array_combine(array_keys($cart_array), array_column($cart_array, 'pid'))));



if ($cart_key !== FALSE) {
$proceed_to_next = 'no';	
}
	
}

if($proceed_to_next == 'yes')
{

echo '<script>var dataString = "action_type=add_to_cart&gorequest=yes&requestfrom=manualcart&pid='.$product_id.'&qty='.$qty.'&image='.$pro_img['image'].'&pname='.$product_row->prod_name.'&productprice='.$product_row->selling_price.'";';
echo 'common_request_results("add_to_cart", dataString);</script>';
}
}
}
}

	
}

function RemoveCustomerproductbox_by_type($type) {

        if ($this->ion_auth->logged_in()) {
            $logged_user_data = $this->common_model->logged_user_data;
            $userid = $logged_user_data->id;
        } else {
            $userid = session_id();
        }
       
        $this->db->where('user_id', $userid);
        $this->db->where('type', $type);
        $this->db->delete('ec_customer_product_box');
    }

function RemoveCustomerproductbox_by_days($days) {
       
	    $date = date("Y-m-d H:i:s", strtotime("-".$days." days"));
		
	    $this->db->where('datetime <=',$date);
        $this->db->where('type', 'cart');
        $this->db->delete('ec_customer_product_box');
	  
    }

function delete_user_cart_data_by_interval($days)
{
	
echo '<script>delete_user_cart_data_by_interval("'.$days.'");</script>';
	
}

}
