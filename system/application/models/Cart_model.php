<?php

class Cart_model extends CI_Model {

    var $menu = '';
    var $menu1 = '';
    var $menu2 = '';
    var $data = '';

    function __construct() {
        parent::__construct();
        //$this->output->enable_profiler(TRUE);
        $this->tree = array();
        $this->parent = '';
        $this->arrow = '';

        $this->arra2 = array();
        
    }

    function GetByRow($table, $eventid, $field) {
        //echo $eventid;
        $this->db->where(array($field => $eventid));
        return $result = $this->db->get($table)->row();
    }

    function get_wizard_products($wizard_id) {
        $this->db->where('wizard_option_id', $wizard_id);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
//        $this->db->where('qty !=', '0');
//        $this->db->where('product_categorytype_id', 3); //Here id is 3 which is of Products from table ec_categorytypes
        $this->db->order_by('order_no', 'ASC');
        return $this->db->get('ec_products')->result();
    }

    function array_push_assoc($array, $key, $value) {
        $array[$key] = $value;
        return $array;
    }

    function totalcartcount() {
        echo $this->cart->total_items();
    }

    function total_cart_price() {
        echo $this->cart->total();
    }

}
