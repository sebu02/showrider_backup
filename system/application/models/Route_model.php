<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Route_model extends CI_Model {

    var $data = '';

    function __construct() {
        parent::__construct();
        //$this->output->enable_profiler(TRUE);
        $this->tree = array();
        $this->parent = '';
        $this->arrow = '';

        $this->arra2 = array();
    }

    public function GetByRow($table, $eventid, $field) {

        $this->db->where(array($field => $eventid));
        return $result = $this->db->get($table)->row();
    }

    public function GetByRow_notrash($table, $eventid, $field) {

        $this->db->where(array($field => $eventid));
        return $result = $this->db->get($table)->row();
    }

    public function routeTrashById($table, $id, $field, $route_type) {

        $data = array(
            'trash_status' => 'yes',
            'active_status' => 'd',
            'date_deleted' => date("Y-m-d H:i:s")
        );

        $this->db->where($field, $id);
        $this->db->where('slug_type', $route_type);
        $this->db->update($table, $data);
    }

    public function routeRestoreById($table, $id, $field, $route_type) {

        $data = array(
            'trash_status' => 'no',
            'active_status' => 'a',
            'date_restored' => date("Y-m-d H:i:s")
        );

        $this->db->where($field, $id);
        $this->db->where('slug_type', $route_type);
        $this->db->update($table, $data);
    }

    public function routeDeleteById($table, $id, $field, $route_type) {

        $this->db->where($field, $id);
        $this->db->where('slug_type', $route_type);
        $this->db->delete($table);
    }

    public function save_routes($route_type) {
        $this->load->helper('file');
        $custom_routes = $this->get_routes($route_type);
		
		//{oldoption}
        //$get_options = $this->get_options();
		//{oldoption}
		
		$get_options = $this->get_options();
		
        $route_value = json_decode($get_options->route_value, TRUE);

        $output = '<?php ';
        if ($custom_routes != NULL) {
            foreach ($custom_routes as $routes) {

                $left_side_full_url = $routes->left_side_full_url;
                $right_side_full_url = $routes->right_side_full_url;

                if ($routes->url_type == 'auto_url') {
                    $ro_value = array_search($routes->url_key, array_column($route_value, 'route_key'));
                    $output .= "\r\n\$route['" . $route_value[$ro_value]['route_value'] . '/' . $left_side_full_url . "']='" . $right_side_full_url . "';";
                } else {
                    $output .= "\r\n\$route['" . $left_side_full_url . "']='" . $right_side_full_url . "';";
                }
            }
        }


        //write to the cache file


        if ($route_type == 'menu') {

            write_file(APPPATH . "cache/menu_routes.php", $output);
        } elseif ($route_type == 'page') {

            write_file(APPPATH . "cache/page_routes.php", $output);
        } elseif ($route_type == 'content_category') {

            write_file(APPPATH . "cache/content_category_routes.php", $output);
        } elseif ($route_type == 'content_item') {

            write_file(APPPATH . "cache/content_item_routes.php", $output);
        } elseif ($route_type == 'product_category') {

            write_file(APPPATH . "cache/product_category_routes.php", $output);
        } elseif ($route_type == 'product_item') {

            write_file(APPPATH . "cache/product_item_routes.php", $output);
        } elseif ($route_type == 'custom_route') {

            write_file(APPPATH . "cache/custom_routes.php", $output);
        }
    }

    public function get_routes($route_type) {
        $this->db->order_by('id', 'DESC');
        $this->db->where('trash_status', 'no');
        $this->db->where('slug_type', $route_type);
        return $this->db->get('cms_routes')->result();
    }

    public function get_options() {

        /*$this->db->select('*');
        $this->db->from('cms_options');
        $this->db->order_by('id', 'asc');
        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }*/
	
$optiondata = $this->db->get('cms_options_setting')->result();

$option_full_array = array();

foreach($optiondata as $orow)
{
$option_full_array[$orow->columnlabel] = $orow->value ;
}

$option_full_array = json_decode (json_encode ($option_full_array), FALSE);

return $option_full_array;  	
		
		
    }

    public function route_check($full_slug, $route_type) {

        $this->db->where('left_side_full_url', $full_slug);
        $this->db->where('slug_type !=', $route_type);
        return $this->db->get('cms_routes')->row();
    }

    public function route_check_edit($full_slug, $route_type) {
        $id = $this->uri->segment(3);
        $this->db->where('left_side_full_url', $full_slug);
        $this->db->where('slug_type !=', $route_type);
        $this->db->where('id !=', $id);
        return $this->db->get('cms_routes')->row();
    }

    public function create_route($id, $route_chk_tble, $route_type, $route_type1) {
        ini_set('max_execution_time', 0);
        $current_data = $this->route_model->GetByRow($route_chk_tble, $id, 'id');


        $url_type = $current_data->slug_type;
        $left_side_full_url = $current_data->full_slug;

        if ($route_type1 == 'menu_route') {

            $separator_slug = 'm-';
        } elseif ($route_type1 == 'page_route') {

            $separator_slug = 'p-';
        } elseif ($route_type1 == 'content_category_route') {

            $separator_slug = 'contentcat-';
        } elseif ($route_type1 == 'content_item_route') {

            $separator_slug = 'contentitem-';
        } elseif ($route_type1 == 'product_category_route') {

            $separator_slug = 'productcat-';
        } elseif ($route_type1 == 'product_item_route') {

            $separator_slug = 'productitem-';
        }

        if ($url_type == 'auto_url') {
            $url_key = $route_type1;
            $right_side_full_url = 'index/page/' . $current_data->full_slug;
        } else {
            $url_key = '';
            $right_side_full_url = 'index/page/' . $current_data->full_slug . '/' . $separator_slug . $id;
        }

        $route_data = array(
            'slug_ref_id' => $id,
            'slug_type' => $route_type,
            'left_side_full_url' => $left_side_full_url,
            'right_side_full_url' => $right_side_full_url,
            'url_key' => $url_key,
            'url_type' => $url_type,
        );

        $this->db->insert('cms_routes', $route_data);
        
        $this->route_model->save_route_in_option($id, $route_type1, $left_side_full_url, $route_chk_tble, 'add');
    }

    function update_route($id, $route_chk_tble, $route_type, $route_type1) {
        ini_set('max_execution_time', 0);
        $current_data = $this->route_model->GetByRow($route_chk_tble, $id, 'id');

        $url_type = $current_data->slug_type;
        $left_side_full_url = $current_data->full_slug;


        if ($route_type1 == 'menu_route') {

            $separator_slug = 'm-';
        } elseif ($route_type1 == 'page_route') {

            $separator_slug = 'p-';
        } elseif ($route_type1 == 'content_category_route') {

            $separator_slug = 'contentcat-';
        } elseif ($route_type1 == 'content_item_route') {

            $separator_slug = 'contentitem-';
        } elseif ($route_type1 == 'product_category_route') {

            $separator_slug = 'productcat-';
        } elseif ($route_type1 == 'product_item_route') {

            $separator_slug = 'productitem-';
        }


        if ($url_type == 'auto_url') {
            $url_key = $route_type1;
            $right_side_full_url = 'index/page/' . $current_data->full_slug;
        } else {
            $url_key = '';
            $right_side_full_url = 'index/page/' . $current_data->full_slug . '/' . $separator_slug . $id;
        }

        $route_data = array(
            'slug_ref_id' => $id,
            'slug_type' => $route_type,
            'left_side_full_url' => $left_side_full_url,
            'right_side_full_url' => $right_side_full_url,
            'url_key' => $url_key,
            'url_type' => $url_type,
        );

        $this->db->select('*');
        $this->db->from('cms_routes');
        $this->db->where('slug_ref_id', $id);
        $this->db->where('slug_type', $route_type);
        $query1 = $this->db->get();
        $num = $query1->num_rows();

        if ($num == 0) {

            $this->db->insert('cms_routes', $route_data);
        } else {

            $this->db->where('slug_ref_id', $id);
            $this->db->where('slug_type', $route_type);
            $this->db->update('cms_routes', $route_data);
        }
        
        $this->route_model->save_route_in_option($id, $route_type1, $left_side_full_url, $route_chk_tble, 'edit');
    }

    function array_push_assoc_force_key($array, $key, $value) {
        $array[$key]['url'] = $value;
        $array[$key]['target'] = "_self";
        $array[$key]['url_type'] = "original";
        return $array;
}
    function GetByReturnTypeOrderType($table, $order_column, $order_type, $conditional_array, $returntype = 'result') {
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
    function save_route_in_option($id, $route_type1, $left_side_full_url, $route_chk_tble, $type) {

        $option2_cnd_arr = array();
		
		//{oldoption}
        //$option2 = $this->route_model->GetByReturnTypeOrderType('cms_options2', 'id', 'DESC', $option2_cnd_arr, 'row');
		//{oldoption}
		
		$option2 = $this->get_options();;
        
        $route_full_array = json_decode($option2->route_full_array, TRUE);
        
        $route_arr_key = '';
        if ($route_type1 == 'menu_route') {

            $route_arr_key = 'm-'.$id;
        } elseif ($route_type1 == 'page_route') {

            $route_arr_key = 'p-'.$id;
        } elseif ($route_type1 == 'content_category_route') {

            $route_arr_key = 'contentcat-'.$id;
        } elseif ($route_type1 == 'content_item_route') {

            $route_arr_key = 'contentitem-'.$id;
        } elseif ($route_type1 == 'product_category_route') {

            $route_arr_key = 'productcat-'.$id;
        } elseif ($route_type1 == 'product_item_route') {

            $route_arr_key = 'productitem-'.$id;
        }

        if (!empty($route_full_array)) {
            if (array_key_exists($route_arr_key, $route_full_array) && $type == 'add') {

                // key exist
                $data = json_encode($route_full_array);
            } else {
                $route_full_array = $this->route_model->array_push_assoc_force_key($route_full_array, $route_arr_key, $left_side_full_url);
                $data = json_encode($route_full_array);
            }
        } else {

            $route_full_array = $this->route_model->array_push_assoc_force_key($route_full_array, $route_arr_key, $left_side_full_url);
            $data = json_encode($route_full_array);
        }

		//{oldoption}
        /*$common_field = array(
            'route_full_array' => $data
        );*/
		//{oldoption}
		
		$common_field = array(
            'value' => $data
        );

		//{oldoption}
       // $this->db->where('id', $option2->id);
        //$this->db->update('cms_options2', $common_field);
		//{oldoption}
		
		 $this->db->where('columnlabel', 'route_full_array');
        $this->db->update('cms_options_setting', $common_field);
        
        $table_field = array(
            'option_url_key' => $route_arr_key
        );

        $this->db->where('id', $id);
        $this->db->update($route_chk_tble, $table_field);
    }

}
