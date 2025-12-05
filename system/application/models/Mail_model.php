<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Mail_model extends CI_Model {

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

    }

    function GetByRow($table, $eventid, $field) {
        //echo $eventid;
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->where(array($field => $eventid));

        return $result = $this->db->get($table)->row();
    }

    function GetByRow_notrash($table, $eventid, $field) {

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

    function TrashById($table, $id, $field) {
        $data = array(
            'trash_status' => 'yes',
            'active_status' => 'd',
            'date_deleted' => date("Y-m-d H:i:s")
        );

        $this->db->where(array($field => $id));
        $this->db->update($table, $data);
    }

    function RestoreById($table, $id, $field) {
        $data = array(
            'trash_status' => 'no',
            'active_status' => 'a',
            'date_restored' => date("Y-m-d H:i:s")
        );

        $this->db->where(array($field => $id));
        $this->db->update($table, $data);
    }

    function countmails() {

        $this->mail_model->list_mails_sorting();

        $val = $this->db->get('cms_form_data');
        return $val->num_rows();
    }

    function list_mails_sorting() {
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
                $this->db->where('date_created BETWEEN "' . $from_date_1 . '" AND "' . $to_date_1 . '"', NULL, FALSE);
            } else {

                $from_date_1 = $from_date . ' 00:00:00';
                $from_date_2 = $from_date . ' 23:59:59';
                $this->db->where('date_created BETWEEN "' . $from_date_1 . '" AND "' . $from_date_2 . '"', NULL, FALSE);
            }
        }





        if (isset($_GET['form_name'])) {

            $form_name = $_GET['form_name'];
            if ($form_name !== "") {
                $this->db->where('form_name', $form_name);
            }
        }

        $this->db->where('trash_status', 'no');
        $this->db->order_by('id', 'desc');
    }

    function listmails($perpage, $rec_from) {
        $this->mail_model->list_mails_sorting();


        $this->db->limit($perpage, $rec_from);
        return $query = $this->db->get('cms_form_data')->result();
    }

    function trash_count_all_mails() {
      $this->mail_model->list_trash_mails_sorting();


        $val = $this->db->get('cms_form_data');
        return $val->num_rows();
    }

        function list_trash_mails_sorting() {
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
                $this->db->where('date_created BETWEEN "' . $from_date_1 . '" AND "' . $to_date_1 . '"', NULL, FALSE);
            } else {

                $from_date_1 = $from_date . ' 00:00:00';
                $from_date_2 = $from_date . ' 23:59:59';
                $this->db->where('date_created BETWEEN "' . $from_date_1 . '" AND "' . $from_date_2 . '"', NULL, FALSE);
            }
        }





        if (isset($_GET['form_name'])) {

            $form_name = $_GET['form_name'];
            if ($form_name !== "") {
                $this->db->where('form_name', $form_name);
            }
        }

        $this->db->where('trash_status', 'yes');
        $this->db->order_by('date_deleted', 'DESC');
        $this->db->order_by('id', 'DESC');
  
    }
    function trash_list_mails($perpage, $rec_from) {

      $this->mail_model->list_trash_mails_sorting();

  
        $this->db->limit($perpage, $rec_from);
        return $this->db->get('cms_form_data')->result();
    }
    
     function downloadformlist(){
         ini_set('max_execution_time', 0);


        $filename = "Email_id_list-" . date('d-m-Y');

        $this->mail_model->list_mails_sorting();

        $cms_form_data = $this->db->get('cms_form_data')->result();

        $cms_form_excel_columns_head_list = array('SIno','form','email','date');
        $cms_form_excel_columns_list = array('id','form_name','form_json_data','date_created');

        $fielddata = array();
        $file_ending = "xls";
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=$filename.xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        /*         * *****Start of Formatting for Excel****** *///define separator (defines columns in excel & tabs in word)
        $sep = "\t";

    
        foreach ($cms_form_excel_columns_head_list as $key => $value) {
            echo $value . "\t";
        }
        print("\n");
         $j=0;
        foreach ($cms_form_data as $key => $cms_form_data_row) {
            $schema_insert = "";
             $j++;    
            foreach ($cms_form_excel_columns_list as $prod_col_name) {
                if($prod_col_name == 'form_json_data'){
                    $form_data_list = json_decode($cms_form_data_row->form_json_data, TRUE);
                    $form_data_list_array = $form_data_list["email"];
                    $attr_element_field_value = $form_data_list_array;
                }else if($prod_col_name=="id"){
                    $attr_element_field_value =$j; 
                }else if($prod_col_name=="form_name"){
                   $attr_element_field_value=str_replace("_"," ",$cms_form_data_row->$prod_col_name);
                }else {
                    
                $attr_element_field_value = $cms_form_data_row->$prod_col_name;
                
                }
                $schema_insert .= $attr_element_field_value . $sep;
            }
       
            $schema_insert = str_replace($sep . "$", "", $schema_insert);
            $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
            $schema_insert .= "\t";
            print(trim($schema_insert));
            print "\n";
            
            
         
        } 
    }

}
