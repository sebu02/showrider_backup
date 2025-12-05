<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order_model
        extends CI_Model {

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
        $this->arr_m = array();

        date_default_timezone_set('Asia/Calcutta');
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

    function list_order_sorting() {

        if (isset($_GET['sort_radio'])) {
            if (isset($_GET['custom_sort'])) {
                $custom_text = $_GET['custom_sort'];

                $sort_value = $_GET['sort_radio'];

                switch ($sort_value) {
                    case 'username':

                        $this->db->like('username', $custom_text);
                        $query = $this->db->get('users')->result_array();

                        $search_userid = array_column($query, 'id');

                        if (!empty($search_userid)) {
                            $this->db->where_in('user_id', $search_userid);
                        } else {
                            $this->db->where('user_id', '');
                        }


                        break;

                    case 'name':

                        $this->db->like('firstname', $custom_text);
                        $query = $this->db->get('users')->result_array();

                        $search_userid = array_column($query, 'user_id');

                        if (!empty($search_userid)) {
                            $this->db->where_in('user_id', $search_userid);
                        } else {
                            $this->db->where('user_id', '');
                        }

                        break;


                    case 'email':

                        $this->db->like('email', $custom_text);
                        $query = $this->db->get('users')->result_array();

                        $search_userid = array_column($query, 'id');

                        if (!empty($search_userid)) {
                            $this->db->where_in('user_id', $search_userid);
                        } else {
                            $this->db->where('user_id', '');
                        }


                        break;


                    case 'phone':

                        $this->db->like('phone', $custom_text);
                        $query = $this->db->get('users')->result_array();

                        $search_userid = array_column($query, 'user_id');

                        if (!empty($search_userid)) {
                            $this->db->where_in('user_id', $search_userid);
                        } else {
                            $this->db->where('user_id', '');
                        }

                        break;


                    case 'other':

                        $this->db->like('username', $custom_text);
                        $this->db->or_like('email', $custom_text);

                        $query1 = $this->db->get('users')->result_array();

                        $this->db->like('phone', $custom_text);
                        $this->db->or_like('firstname', $custom_text);

                        $query2 = $this->db->get('users')->result_array();


                        $last_query = array_merge($query1, $query2);

                        $search_userid = array_column($last_query, 'user_id');



                        if (!empty($search_userid)) {
                            $this->db->where_in('user_id', $search_userid);
                        } else {
                            $this->db->where('user_id', '');
                        }

                        break;
                }
            }
        }








        $from_date = "";
        $to_date = "";
        if (isset($_GET['from_date'])) {
            $from_date = $_GET['from_date'];
        }
        if (isset($_GET['to_date'])) {
            $to_date = $_GET['to_date'];
        }
        if ($from_date !== "") {
            $from_date = date('Y-m-d', strtotime($from_date));

            if ($to_date !== "") {
                $to_date = date('Y-m-d', strtotime($to_date));


                $from_date_1 = $from_date . ' 00:00:00';
                $to_date_1 = $to_date . ' 23:59:59';
                $this->db->where('purchase_date BETWEEN "' . $from_date_1 . '" AND "' . $to_date_1 . '"', NULL, FALSE);
            } else {

                $from_date_1 = $from_date . ' 00:00:00';
                $from_date_2 = $from_date . ' 23:59:59';
                $this->db->where('purchase_date BETWEEN "' . $from_date_1 . '" AND "' . $from_date_2 . '"', NULL, FALSE);
            }
        }




        if (isset($_GET['order_status'])) {

            $payment_status = $_GET['order_status'];
            if ($payment_status !== "" && $payment_status > 0) {
                $this->db->where('payment_status', $payment_status);
            } else {
//                 $this->db->where('order_id >','0');
            }
        } else {
//                 $this->db->where('order_id >','0');
        }
        if (isset($_GET['payment_method'])) {

            $payment_method = $_GET['payment_method'];
            if ($payment_method !== "" && $payment_method > 0) {
                $this->db->where('payment_method', $payment_method);
            }
        }

        if (isset($_GET['id'])) {

            $userid = $_GET['id'];

            $this->db->where('user_id', $userid);
        }





        if (isset($_GET['order_type'])) {

            $order_character_type = $_GET['order_type'];
            if ($order_character_type !== "") {
                $like_clause_string = " order_character_type_tree  LIKE '%+" . $order_character_type . "+%' ";
                $this->db->where("(" . $like_clause_string . ")", NULL, FALSE);
            }
        }


        if (isset($_GET['order_no'])) {

            $order_no_text = $_GET['order_no'];
            if ($order_no_text !== "") {
                $temp_text = "tmp";
                $order_no_text = strtolower($order_no_text);
                $order_no_text = str_replace("-", " ", $order_no_text);
                $temp_pos = strpos($order_no_text, $temp_text);

                $order_onlynum = preg_replace('/[^0-9]/', '', $order_no_text);
                if ($temp_pos !== FALSE) {
                    $this->db->where('id', $order_onlynum);
                } else {
                    $this->db->where('order_id', $order_onlynum);
                }
            }
        }

        $from_amount = "";
        $to_amount = "";
        if (isset($_GET['from_amount'])) {
            $from_amount = $_GET['from_amount'];
        }
        if (isset($_GET['to_amount'])) {
            $to_amount = $_GET['to_amount'];
        }
        if ($from_amount !== "" && $from_amount > 0) {


            if ($to_amount !== "" && $to_amount > 0) {
                $this->db->where('amount BETWEEN "' . $from_amount . '" AND "' . $to_amount . '"', NULL, FALSE);
            } else {


                $this->db->where('amount >= ', $from_amount);
            }
        } else if ($to_amount !== "" && $to_amount > 0) {
            $this->db->where('amount <= ', $to_amount);
        }
		

if($this->session->userdata('logged_admin_type') == 'subadmin')
{

$logged_admin_location_city = $this->session->userdata('logged_admin_location_city');	
$logged_admin_location_city = explode('+',$logged_admin_location_city);
$logged_admin_location_city = array_filter($logged_admin_location_city);

$this->db->where_in('order_disctrict', $logged_admin_location_city);

}
		
		
		$this->db->where('order_split_type !=', 'child');
		
        $this->db->order_by('id', 'desc');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
    }

    function countOrders() {

        $this->order_model->list_order_sorting();

        $val = $this->db->get('ec_orders');
        return $val->num_rows();
    }

    function listOrders($perpage, $rec_from) {

        $this->order_model->list_order_sorting();

        $this->db->limit($perpage, $rec_from);
        $query = $this->db->get('ec_orders')->result();

//         dump($query);die();
        return $query;
    }

    function listordersortedtotal_revenue() {

        $this->order_model->list_order_sorting();

        $this->db->where('order_id !=', '');
        $this->db->where('order_id !=', '0');
        $this->db->where('payment_status', '2');
        $this->db->select_sum('amount');
        return $query = $this->db->get('ec_orders')->row();
    }

    function listordertotal_revenue() {

        $this->db->where('order_id !=', '');
        $this->db->where('order_id !=', '0');
        $this->db->where_in('payment_status', $this->common_model->green_order_status_id_array);
        $this->db->select_sum('amount');
        return $query = $this->db->get('ec_orders')->row();
    }

    function trash_count_all_order() {


        $this->db->where('trash_status', 'yes');
        $val = $this->db->get('ec_orders');
        return $val->num_rows();
    }

    function trash_list_order($perpage, $rec_from) {


        $this->db->where('trash_status', 'yes');
        $this->db->order_by('date_deleted', 'DESC');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($perpage, $rec_from);
        return $this->db->get('ec_orders')->result();
    }

    function vieworderdetail($orderid) {
        $this->db->select('*');
        $this->db->where('id', $orderid);
        $query = $this->db->get('ec_orders');
        return $query->row();
    }

    public function myorderCount($orderid) {

        $this->db->select('*');
        $this->db->where('ec_orders_id', $orderid);
        $query = $this->db->get('ec_order_list');
        return $query->num_rows();
    }

    function getOrderstatusById($id) {
        $this->db->where('id', $id);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        return $this->db->get('ec_cart_order_status')->row();
    }

    public function get_order_status() {

        $this->db->select('*');
        $this->db->order_by('status_order', 'asc');
        $query = $this->db->get('ec_cart_order_status');
        return $query->result();
    }

    function update_orderdetail($order_id) {

        $status_json = $this->input->post('status_json');

        $status_id = $this->input->post('order_status');
        $reupdate_status = $this->input->post('reupdate_status');
        $ec_orders = $pdata = $this->order_model->GetByRow('ec_orders', $order_id, 'id');
        $conditional_array = array(
            "ec_orders_id" => $order_id,
        );
        $ec_order_list = $this->common_model->GetByResult_Where('ec_order_list', 'id', 'DESC', $conditional_array);

        $payment_data = json_decode($pdata->payment_data, true);
        $statusdata = json_decode($status_json, true);


        foreach ($statusdata as $p) {
            $sms = $p['sms'];
            $smstext = $p['smstext'];
            $smstext2 = $p['smstext2'];
            $date = $p['datetime'];
            $email = $p['email'];
            $newtext = $p['text'][0];
            $newtext1 = $p['text'];
        }

        $decoded = $this->order_model->find_json_row($payment_data, 'status_id', $status_id);


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

        $count_coupons_generated = 0;
        if ($status_id == '14' && $ec_orders->ec_coupon_id_full_tree == "") {
            $ec_coupon_id_full_tree = "+";
            foreach ($ec_order_list as $ec_order_list_row) {
                if ($ec_order_list_row->product_categorytype_id == '24') {

                    $product_details = $this->common_model->GetByRowOrFalse('ec_products', $ec_order_list_row->product_id, 'id');

                    if ($product_details != FALSE) {
                        $gift_card_data_array = json_decode($product_details->gift_card_data, TRUE);
                    }


                    $ec_coupon_id_tree = '+';
                    $ec_order_list_row_qty = $ec_order_list_row->order_qty;
                    for ($index = 1; $index <= $ec_order_list_row_qty; $index++) {
                        do {
                            $new_jagc_code = 'jagc' . $this->common_model->get_rand_alphanumeric(4);
                            $table = 'ec_coupon';
                            $key_value_where_array = array(
                                'coupon_code' => $new_jagc_code,
                            );
//                            dump($new_jagc_code);
                            $unique_result = $this->common_model->GetByResultOrReturnFalse($table, $key_value_where_array);
//                            dump($unique_result);
                        } while ($unique_result !== FALSE);
//                        dump($new_jagc_code);
                        $data_coupon = array(
                            'coupon_code' => $new_jagc_code,
                            'coupon_amount' => $ec_order_list_row->product_price,
                            'coupon_balance' => $ec_order_list_row->product_price,
                            'user_id' => $ec_orders->user_id,
                            'ec_orders_id' => $ec_orders->id,
                            'ec_order_list_id' => $ec_order_list_row->id,
                            'coupon_type' => 'purchased',
                            'coupon_card_type' => 'email',
                            'trash_status' => 'no',
                            'active_status' => 'a',
                        );
                        if ($gift_card_data_array['type'] == "physical") {
                            $data_coupon = $this->common_model->array_push_assoc($data_coupon, 'active_status', 'd');
                            $data_coupon = $this->common_model->array_push_assoc($data_coupon, 'coupon_balance', '0');
                            $data_coupon = $this->common_model->array_push_assoc($data_coupon, 'coupon_balance2', $ec_order_list_row->product_price);
                            $data_coupon = $this->common_model->array_push_assoc($data_coupon, 'coupon_card_type', 'physical');
                        }
                        $this->db->insert('ec_coupon', $data_coupon);
                        $coupon_id = $this->db->insert_id();
                        $ec_coupon_id_tree = $ec_coupon_id_tree . $coupon_id . '+';
                        $ec_coupon_id_full_tree = $ec_coupon_id_full_tree . $coupon_id . '+';
                        $count_coupons_generated++;
                    }
                    $ec_order_list_row_data = array(
                        "ec_coupon_id_tree" => $ec_coupon_id_tree,
                    );
                    $this->db->where('id', $ec_order_list_row->id);
                    $this->db->update('ec_order_list', $ec_order_list_row_data);
                }
            }
//            dump($count_coupons_generated);
            if ($count_coupons_generated > 0) {
                $ec_orders_data = array(
                    "ec_coupon_id_full_tree" => $ec_coupon_id_full_tree,
                );
                $this->db->where('id', $ec_orders->id);
                $this->db->update('ec_orders', $ec_orders_data);
                if ($email == 'yes') {
                    $ec_coupon_id_full_tree_array = explode('+', $ec_coupon_id_full_tree);
                    array_pop($ec_coupon_id_full_tree_array);
                    array_shift($ec_coupon_id_full_tree_array);
                    foreach ($ec_coupon_id_full_tree_array as
                                $ec_coupon_single_id) {

                        $ec_coupon_detail = $this->common_model->GetByRow_noactive('ec_coupon', $ec_coupon_single_id, 'id');
                        if ($ec_coupon_detail->coupon_card_type != "physical") {

                            $this->common_model->SendGiftCardMail($ec_coupon_single_id);
                        }
                    }
                }
            }
        }

        if ($status_id == '3' && $pdata->order_id == 0) {
            $ec_orders_id = $pdata->id;
            $this->common_model->update_newpurchase_order_id($ec_orders_id);
            $this->common_model->UpdatePurchasedProductQuantity($ec_orders_id);
            if ($ec_orders->coupon_applied == 'yes') {

                $this->common_model->UpdateOrderAndCouponPaymentDetails($ec_orders_id);
            }
            if ($email == 'yes') {
                $this->common_model->SendOrderMail($status_id, $ec_orders_id);
            }
        }
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

    function splitorder($ec_orders_id) {

        ini_set('max_execution_time', 0);
        $split_status = FALSE;
        $ec_orders = $this->common_model->GetByRow_array('ec_orders', $ec_orders_id, 'id');
        $conditional_array = array(
            'ec_orders_id' => $ec_orders_id,
            'trash_status' => 'no',
        );
        $ec_order_list = $this->common_model->GetByResultArray_Where('ec_order_list', 'id', 'ASC', $conditional_array);

        $original_ec_orders = $ec_orders;
        $ec_orders_character_list = explode('+', $ec_orders['order_character_type_tree']);
        $ec_orders_character_list = array_filter($ec_orders_character_list);
        $temp_ec_orders_character_list = $ec_orders_character_list;
        $original_ec_orders_character_list = $ec_orders_character_list;


        $temp_ec_orders_character_list = array_unique($temp_ec_orders_character_list);

        $character_type_counts = array_count_values($ec_orders_character_list);
        $full_character_type_counts = count($ec_orders_character_list);
        $check_gift_character_type_counts = array_count_values($temp_ec_orders_character_list);
        $check_gift_full_character_type_counts = count($temp_ec_orders_character_list);


        if ($character_type_counts['gift_card'] > 0 && $full_character_type_counts > 1) {


            foreach ($ec_order_list as $ec_order_list_key =>
                        $ec_order_list_value) {

                $new_ec_orders = array();
                $new_ec_orders = $this->common_model->GetByRow_array('ec_orders', $ec_orders_id, 'id');
                if ($ec_order_list_value['product_categorytype_id'] == '24') {


                    if ($check_gift_character_type_counts['gift_card'] == 1 && $check_gift_full_character_type_counts == 1 && $ec_order_list_key == 0) {
                        
                    } else {

                        $update_order_amount = $new_ec_orders['amount'] - ($ec_order_list_value['product_price'] * $ec_order_list_value['order_qty']);
                        $amount = ($ec_order_list_value['product_price'] * $ec_order_list_value['order_qty']);
                        $order_character_type_tree = '+gift_card+';
                        $product_categorytype_id_tree = '+24+';
                        if ($ec_orders->order_id > 0) {
                            $this->db->select_max('order_id');
                            $max_order_id = $this->db->get('ec_orders')->row();
                            $new_order_id = $max_order_id->order_id + 1;

                            $this->db->select_max('invoice_id');
                            $max_invoice_id = $this->db->get('ec_orders')->row();
                            $new_invoice_id = $max_invoice_id->invoice_id + 1;
                        } else {
                            $new_order_id = '';
                            $new_invoice_id = '';
                        }
//                        if()

                        $new_ec_orders = $this->common_model->array_push_assoc($new_ec_orders, 'amount', $amount);
                        $new_ec_orders = $this->common_model->array_push_assoc($new_ec_orders, 'order_total', $amount);
                        $new_ec_orders = $this->common_model->array_push_assoc($new_ec_orders, 'order_character_type_tree', $order_character_type_tree);
                        $new_ec_orders = $this->common_model->array_push_assoc($new_ec_orders, 'product_categorytype_id_tree', $product_categorytype_id_tree);
                        $new_ec_orders = $this->common_model->array_push_assoc($new_ec_orders, 'created_new_orders_id', '');
                        $new_ec_orders = $this->common_model->array_push_assoc($new_ec_orders, 'master_order_id', $ec_orders_id);
                        $new_ec_orders = $this->common_model->array_push_assoc($new_ec_orders, 'order_id', $new_order_id);
                        $new_ec_orders = $this->common_model->array_push_assoc($new_ec_orders, 'invoice_id', $new_invoice_id);
                        unset($new_ec_orders['id']);

                        $this->db->insert('ec_orders', $new_ec_orders);
                        $new_ec_orders_id = $this->db->insert_id();

                        $ec_order_list_data = array(
                            'ec_orders_id' => $new_ec_orders_id,
                            'master_order_id' => $ec_orders_id,
                            'order_id' => $new_order_id,
                            'invoice_id' => $new_invoice_id,
                        );

                        $this->db->where('id', $ec_order_list_value['id']);
                        $this->db->update('ec_order_list', $ec_order_list_data);
                        //To update the orderid and invoiceid in the product table
                        $tabledata = array(
                            'order_id' => $new_order_id,
                            'invoice_id' => $new_invoice_id,
                        );
                        $new_ec_order_list = $this->common_model->GetByRow_notrash('ec_order_list', $new_ec_orders_id, 'id');
                        foreach ($new_ec_order_list as $new_ec_order_list_key =>
                                    $new_ec_order_list_row) {
                            if (in_array($new_ec_order_list_row->product_categorytype_id, $this->common_model->gift_product_categorytype_id_array)) {

                                $this->db->where('id', $new_ec_order_list_row->product_id);
                                $this->db->update('ec_products', $tabledata);
                            }
                        }




                        $order_character_type_tree_array = explode('+', $ec_orders['order_character_type_tree']);
                        $order_character_type_tree_array = array_filter($order_character_type_tree_array);
                        $order_character_type_tree_key = array_search('gift_card', $order_character_type_tree_array);
                        if ($order_character_type_tree_key !== FALSE) {
                            unset($order_character_type_tree_array[$order_character_type_tree_key]);
                        }
                        $order_character_type_tree_str = '+' . implode('+', $order_character_type_tree_array) . '+';

                        $product_categorytype_id_tree_array = explode('+', $ec_orders['product_categorytype_id_tree']);
                        $product_categorytype_id_tree_array = array_filter($product_categorytype_id_tree_array);
                        $product_categorytype_id_key = array_search('24', $product_categorytype_id_tree_array);
                        if ($product_categorytype_id_key !== FALSE) {
                            unset($product_categorytype_id_tree_array[$product_categorytype_id_key]);
                        }
                        $product_categorytype_id_tree_str = '+' . implode('+', $product_categorytype_id_tree_array) . '+';


                        $update_ec_order_data = array(
                            'order_character_type_tree' => $order_character_type_tree_str,
                            'product_categorytype_id_tree' => $product_categorytype_id_tree_str,
                            'amount' => $update_order_amount,
                            'order_total' => $update_order_amount,
                            'master_order_id' => $ec_orders_id,
                            'created_new_orders_id' => $new_ec_orders->created_new_orders_id . '+' . $new_ec_orders_id,
                        );

                        $this->db->where('id', $ec_orders['id']);
                        $this->db->update('ec_orders', $update_ec_order_data);
                    }
                }
            }

            $split_status = TRUE;
        }
        return $split_status;
    }

    function balance_to_pay($ec_orders_id) {
        $ec_orders_row = $this->common_model->GetByRowOrFalse('ec_orders', $ec_orders_id, 'id');

        $balance_paid_amount = $ec_orders_row->balance_to_pay;
        $balance_to_pay = $ec_orders_row->balance_to_pay;
        if ($balance_to_pay > 0) {
            $data_order_update = array(
                'balance_to_pay' => '0',
                'balance_paid_amount' => $balance_paid_amount,
                'balance_payment_status' => 'yes',
                'reason_for_balance_payment' => $this->input->post('reason_for_balance_payment'),
            );
            $this->db->where('id', $ec_orders_row->id);
            $this->db->update('ec_orders', $data_order_update);
        }
    }

}
