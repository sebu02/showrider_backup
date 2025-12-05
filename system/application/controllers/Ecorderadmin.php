<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ecorderadmin extends CI_Controller {
	
	var $data = array();

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('common_model');
        $this->load->model('order_model');
        $this->load->model('uploadlibrary_model');
        $this->load->model('route_model');

        // $this->load->library('ion_auth');

        //$this->output->enable_profiler(TRUE);
//        date_default_timezone_set('Asia/Calcutta');
        // error_reporting(0);
        //session_start();



        if ($this->session->userdata('logged_adminpanel') != 'true') {
            redirect('admin/login');
        }

        /* if (! $this->ion_auth->logged_in())
          {
          redirect('secureadmin/index');
          } */
    }

    public function index() {
        
    }

    function vieworders() {

        $urisegments = $_SERVER['QUERY_STRING'];

        $offset = 0;

        if (isset($_GET['per_page'])) {

            $remove_segment = '&per_page=' . $_GET['per_page'];

            $urisegments = str_replace($remove_segment, '', $urisegments);
//            $urisegments = str_replace('&&', '&', $urisegments);
            if ($_GET['per_page'] != '') {
                $offset = $_GET['per_page'];
            } else {
                $offset = 0;
            }
        }

        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'ecorderadmin/vieworders/?' . $urisegments;
        $config['total_rows'] = $this->order_model->countOrders();
        $config['enable_query_strings'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['per_page'] = '10';
        $config['num_links'] = 5;
        $config['uri_segment'] = 4;
        $config['prev_link'] = ' Previous';
        $config['prev_tag_open'] = '';
        $config['prev_tag_close'] = '';
        $config['next_link'] = ' Next';
        $config['next_tag_open'] = '';
        $config['next_tag_close'] = '';

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['order_list'] = $this->order_model->listOrders($config['per_page'], $offset);
        $data['page_position'] = $offset;

        $this->template->load('admin', 'order/vieworders', $data);
    }

    function trash_order($id) {
        $this->order_model->TrashById('ec_orders', $id, 'id');
        $this->session->set_flashdata('message', "Deleted Successfully!..");
        redirect('ecorderadmin/vieworders?' . $_SERVER['QUERY_STRING']);
    }

    function restore_order($id) {
        $this->order_model->RestoreById('ec_orders', $id, 'id');
        $this->session->set_flashdata('message', "Restored Successfully!..");
        redirect('ecorderadmin/trash_view_order/');
    }

    function delete_order($id) {
        $delete_status = $this->common_model->DeleteById('ec_orders', $id, 'id');
        if ($delete_status == TRUE) {
            $this->session->set_flashdata('message', "Deleted Successfully!..");
        } else {
            $this->session->set_flashdata('message', "This data can not be deleted.");
        }

        redirect('ecorderadmin/trash_view_order/');
    }

    function trash_view_order($sear = 0, $page_position = 0) {
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'ecorderadmin/trash_view_order/' . $sear;
        $config['total_rows'] = $this->order_model->trash_count_all_order();
        $config['per_page'] = '10';
        $config['num_links'] = 5;
        $config['uri_segment'] = 4;
        $config['prev_link'] = ' Previous';
        $config['prev_tag_open'] = '';
        $config['prev_tag_close'] = '';
        $config['next_link'] = ' Next';
        $config['next_tag_open'] = '';
        $config['next_tag_close'] = '';
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['view_items_list'] = $this->order_model->trash_list_order($config['per_page'], $page_position);
        $data['page_position'] = $page_position;
        $this->template->load('admin', 'order/trash_view_order', $data);
    }

    public function vieworderdetail($order_id) {		
				
        $data['myorders'] = $this->order_model->vieworderdetail($order_id);

        $this->template->load('admin', 'order/vieworderdetail', $data);
       
    }

    function getordersmstext_bystatus() {
        $order_id = $this->input->post('order_id');
        $status_id = $this->input->post('status_id');

        $sms_array = $this->common_model->ordersmstext_bystatus($order_id, $status_id);
        echo json_encode($sms_array);
    }

    function createwbn($pid, $listid, $no, $type) {
        if ($type == '1') {
            $result = $this->common_model->createwaybillapi($pid, $listid, $no);
        } else {
            $result = $this->common_model->createwaybillapi2($pid, $listid, $no);
        }

//print_r($result);

        $GenerateWayBillResult = $result->GenerateWayBillResult;

        $AWBNo = $GenerateWayBillResult->AWBNo;

        if ($AWBNo != '') {

            $data = array(
                'waybill' => $AWBNo,
                'waybilltype' => $type,
            );

            $this->db->where('id', $listid);
            $this->db->update('ec_order_list', $data);
        }


        redirect('ecorderadmin/vieworderdetail/' . $pid);
    }

    function saveorderlistwaybill($id) {

        $newwaybill = $this->input->post('newwaybill');
        $orderid = $this->input->post('orderid');
        $listid = $this->input->post('listid');

        $waybill_info = $this->common_model->GetByRow_notrash('ec_order_list', $newwaybill, 'waybill');

        $data = array(
            'waybill' => $newwaybill,
            'waybilltype' => $waybill_info->waybilltype,
        );

        $this->db->where('id', $listid);
        $this->db->update('ec_order_list', $data);
    }

    function print_waybill($pid, $cid) {

        $data['pid'] = $pid;
        $data['cid'] = $cid;
		
        $purchase_details = $this->order_model->GetByRow('ec_orders', $pid, 'id');

        $option = $this->common_model->get_options();

        //$order_id = $option->org_order_string . $purchase_details->order_id;
        //sbn orderid
        $order_id = $this->common_model->format_order_number($purchase_details->order_id,$purchase_details->id);
        //sbn orderid

        $data['print_title'] = $order_id;
        $this->template->load('admin_print', 'order/print_waybill', $data);
    }

    function update_ec_order_list_data() {
        ini_set('max_execution_time', 0);

        $ec_orders = $this->common_model->GetByResult_notrash('ec_orders', 'id', 'DESC');

        foreach ($ec_orders as $ec_orders_key => $ec_orders_row) {

            $tabledata = array(
                'order_id' => $ec_orders_row->order_id,
                'invoice_id' => $ec_orders_row->invoice_id,
                'payment_status' => $ec_orders_row->payment_status,
                'payment_data' => $ec_orders_row->payment_data,
            );
            $this->db->where('ec_orders_id', $ec_orders_row->id);
            $this->db->update('ec_order_list', $tabledata);
        }
    }

    function splitorder($ec_orders_id) {
        $ec_orders_split_status = $this->order_model->splitorder($ec_orders_id);

        $ec_orders_split_status_json = array(
            'status' => $ec_orders_split_status
        );
        echo json_encode($ec_orders_split_status_json);
    }

    function balance_to_pay($ec_orders_id) {
        $ec_orders_split_status = $this->order_model->balance_to_pay($ec_orders_id);

        $ec_orders_split_status_json = array(
            'status' => $ec_orders_split_status
        );
        if ($ec_orders_split_status != FALSE) {
            $this->session->set_flashdata('message', 'Balance Payment status has been updated.');
        } else {

            $this->session->set_flashdata('message', 'Balance payment status has not updated.');
        }
        echo json_encode($ec_orders_split_status_json);
    }

    function update_ec_order_order_total() {
        ini_set('max_execution_time', 0);

        $ec_orders = $this->common_model->GetByResult_notrash('ec_orders', 'id', 'DESC');

        foreach ($ec_orders as $ec_orders_key => $ec_orders_row) {

            if ($ec_orders_row->coupon_applied == '') {
                $tabledata = array(
                    'order_total' => $ec_orders_row->amount,
                );
                $this->db->where('id', $ec_orders_row->id);
                $this->db->update('ec_orders', $tabledata);
            }
        }
        echo "Finished execution";
    }

    function GetProductOrderCount($ec_orders_id) {
        ini_set('max_execution_time', 0);
        $this->common_model->GetProductOrderCount($ec_orders_id);
    }    
    
    function create_shiprocket_order(){
		
        if(!empty($_GET['id']) && !empty($_GET['api']) && !empty($_GET['boxno'])){
            $order_id=$_GET['id'];
            $api=$_GET['api'];
			$boxno=$_GET['boxno'];
			
            /*//
            $ship_products_qty_array = array();
            if(!empty($custom_products_qty))
            {
            $custom_products_qty_array = explode("_",$custom_products_qty);
            }

            if(!empty($custom_products_qty_array))
            {

            foreach($custom_products_qty_array as $custom_product)
            {

            $custom_product_array = explode("-",$custom_product);

            $ship_products_qty_array[$custom_product_array[0]] = $custom_product_array[1];	
                
            }
                
            }

            //*/		
				
            
            switch ($api) {
                case "shiprocket":
				
				$type="shiprocket";
				
                $order_response=$this->common_model->create_shiprocket_order($order_id,$boxno);
				
				if(isset($order_response->shipment_id))
				{
				//
				$shipment_id=$order_response->shipment_id;

				$response_data = array(
				"shipment_id"=>$shipment_id,
				"waybilltype" => $type,
				"shipment_order_response"=>json_encode($order_response),
				"shipment_order_error"=>'',
				);
				
				
				$this->db->where('id', $order_id);
				$this->db->update('ec_orders', $response_data); 
				//
				
				}
				else
				{
				
				//
				
				$response_data = array(
				"shipment_order_error"=>json_encode($order_response)
				);
				
				
				$this->db->where('id', $order_id);
				$this->db->update('ec_orders', $response_data); 
				
				
				//
				
				$this->session->set_flashdata('shipmentiderror', 'yes');
				
				
				}
				
                 
                break;
				
              }
			  
            
            redirect('ecorderadmin/vieworderdetail/'.$order_id);
			
        }
		else
		{        
        redirect('ecorderadmin/vieworders/');
		}
    }
	
	
    function create_shiprocket_waybill(){
		
        if(!empty($_GET['id']) && !empty($_GET['api'])){
			
            $order_id=$_GET['id'];
            $api=$_GET['api'];
			            
            switch ($api) {
                case "shiprocket":
				
				$type="shiprocket";
				
                    $order_details = $this->common_model->GetByRow('ec_orders', $order_id, 'id');				

                    $delivery_address_array = json_decode($order_details->shipping_address, TRUE);
                    $delivery_pincode = $delivery_address_array['frm_pincode'];

                    $shiprocket_parameters  = array(
                    'resulttype' => '',
                    'delivery_pincode' => $delivery_pincode,
                    'cod' => '0',
                    'weight' => '1',
                    );	
                    $shiprocket_delivery_couriers = $this->common_model->get_shiprocket_service_charge($shiprocket_parameters);

                    if(isset($shiprocket_delivery_couriers->data))
                    {
                    $shipping_charge_return_data = $shiprocket_delivery_couriers->data;
                    $available_courier_companies = $shipping_charge_return_data->available_courier_companies;

                    $cheaptest_courier = $available_courier_companies[0];

                    $courier_data = array(
                    "courier_id"=>$cheaptest_courier->courier_company_id,
                    "courier_json"=>json_encode($cheaptest_courier),
                    "shipping_serviceability"=>json_encode($shiprocket_delivery_couriers),
                    "shipping_serviceability_error"=>''
                    );
								
                    $this->db->where('id', $order_id);
                    $this->db->update('ec_orders', $courier_data); 
			    	//
                    }
                    else
                    {
                    $courier_data = array(
                    "shipping_serviceability_error"=>json_encode($shiprocket_delivery_couriers)
                    );
                    
                    
                    $this->db->where('id', $order_id);
                    $this->db->update('ec_orders', $courier_data); 
                    }


                    $order_details = $this->common_model->GetByRow('ec_orders', $order_id, 'id');

                    $shiprocket_parameters2  = array(
                    'shipment_id' => $order_details->shipment_id,
                    'courier_id' => $order_details->courier_id,
                    );	
                    $get_shiprocket_airwaybill = $this->common_model->create_shiprocket_airwaybill($shiprocket_parameters2);
                    //print_r($get_shiprocket_airwaybill);

                    if(isset($get_shiprocket_airwaybill->response))
                    {

                    $get_shiprocket_airwaybill_response_array = $get_shiprocket_airwaybill->response;

                    $get_shiprocket_airwaybill_response_data_array =$get_shiprocket_airwaybill_response_array->data;

                    $awb_code = $get_shiprocket_airwaybill_response_data_array->awb_code;

				    //
                    $waybill_data = array(
                    "waybill"=>$awb_code,
                    "waybill_response"=>json_encode($get_shiprocket_airwaybill),
                    "waybill_response_error"=>'',
                    );
                    
                    
                    $this->db->where('id', $order_id);
                    $this->db->update('ec_orders', $waybill_data); 
                    //
                    }
                    else
                    {

                    //
                    $waybill_data = array(
                    
                    "waybill_response_error"=>json_encode($get_shiprocket_airwaybill),
                    );
                                        
                    $this->db->where('id', $order_id);
                    $this->db->update('ec_orders', $waybill_data); 
                    //	
                    
                    $this->session->set_flashdata('waybillerror', 'yes');
                
                    }
                    
                    break;
				
                    }
			              
            redirect('ecorderadmin/vieworderdetail/'.$order_id);
			
        }
		else
		{        
        redirect('ecorderadmin/vieworders/');
		}
    }	

    function create_shiprocket_pickup(){
		
        if(!empty($_GET['id']) && !empty($_GET['api'])){
			
            $order_id=$_GET['id'];
            $api=$_GET['api'];
			            
            switch ($api) {
                case "shiprocket":
				
				$type="shiprocket";

                $order_details = $this->common_model->GetByRow('ec_orders', $order_id, 'id');

                $shiprocket_parameters  = array(
                'shipment_id' => $order_details->shipment_id,

                );	
                $get_shiprocket_pickup = $this->common_model->create_shiprocket_pickup($shiprocket_parameters);

                if(isset($get_shiprocket_pickup->response))
                {

				//
				$pickup_data = array(
				"pickup_request"=>'yes',
				"pickup_request_response"=>json_encode($get_shiprocket_pickup),
				"pickup_request_error"=>'',
				);
								
				$this->db->where('id', $order_id);
				$this->db->update('ec_orders', $pickup_data); 
				//
                }
                else
                {

				//
				$pickup_data = array(
				
				"pickup_request_error"=>json_encode($get_shiprocket_pickup),
				);
								
				$this->db->where('id', $order_id);
				$this->db->update('ec_orders', $pickup_data); 
				//	
				
				$this->session->set_flashdata('pickuperror', 'yes');
			
                }
                 
                break;
				
              }			  
            
            redirect('ecorderadmin/vieworderdetail/'.$order_id);
			
        }
		else
		{        
        redirect('ecorderadmin/vieworders/');
		}
    }	

    function create_shiprocket_maifest(){
		
        if(!empty($_GET['id']) && !empty($_GET['api'])){
			
            $order_id=$_GET['id'];
            $api=$_GET['api'];
			            
            switch ($api) {
                case "shiprocket":
				
				$type="shiprocket";

                $order_details = $this->common_model->GetByRow('ec_orders', $order_id, 'id');

                $shiprocket_parameters  = array(
                'shipment_id' => $order_details->shipment_id,

                );	
                $get_shiprocket_maifest = $this->common_model->create_shiprocket_maifest($shiprocket_parameters);

                if(isset($get_shiprocket_maifest->manifest_url))
                {
                    
                    if(!empty($get_shiprocket_maifest->manifest_url))
                    {
                    $manifest_status = 'yes';		
                    }
                    else
                    {
                    $manifest_status = 'no';		
                    }
                    
                }
                else
                {
                $manifest_status = 'no';	
                }

                if($manifest_status == 'yes')
                {

				//
				$maifest_data = array(
				"maifest_request"=>'yes',
				"maifest_request_response"=>json_encode($get_shiprocket_maifest),
				"maifest_request_error"=>'',
				);
								
				$this->db->where('id', $order_id);
				$this->db->update('ec_orders', $maifest_data); 
				//
                }
                else
                {

				//
				$maifest_data = array(
				
				"maifest_request_error"=>json_encode($get_shiprocket_maifest),
				);
								
				$this->db->where('id', $order_id);
				$this->db->update('ec_orders', $maifest_data); 
				//	
				
				$this->session->set_flashdata('maifesterror', 'yes');
			
                }
                 
                break;
				
              }
			              
            redirect('ecorderadmin/vieworderdetail/'.$order_id);
			
        }
		else
		{        
        redirect('ecorderadmin/vieworders/');
		}
    }	

    function create_shiprocket_label(){
		
        if(!empty($_GET['id']) && !empty($_GET['api'])){
			
            $order_id=$_GET['id'];
            $api=$_GET['api'];
			            
            switch ($api) {
                case "shiprocket":
				
				$type="shiprocket";

                $order_details = $this->common_model->GetByRow('ec_orders', $order_id, 'id');

                $shiprocket_parameters  = array(
                'shipment_id' => $order_details->shipment_id,

                );	
                $get_shiprocket_label = $this->common_model->create_shiprocket_label($shiprocket_parameters);

                if(isset($get_shiprocket_label->label_url))
                {

				//
				$label_data = array(
				"label_request"=>'yes',
				"label_request_response"=>json_encode($get_shiprocket_label),
				"label_request_error"=>'',
				);
				
				
				$this->db->where('id', $order_id);
				$this->db->update('ec_orders', $label_data); 
				//
                }
                else
                {
			//
				$label_data = array(
				
				"label_request_error"=>json_encode($get_shiprocket_label),
				);
								
				$this->db->where('id', $order_id);
				$this->db->update('ec_orders', $label_data); 
				//	
				
				$this->session->set_flashdata('labelerror', 'yes');
			
                }
                 
                break;
				
              }
			              
            redirect('ecorderadmin/vieworderdetail/'.$order_id);
			
        }
		else
		{        
        redirect('ecorderadmin/vieworders/');
		}
    }
	
    function create_shiprocket_invoice(){
		
        if(!empty($_GET['id']) && !empty($_GET['api'])){
			
            $order_id=$_GET['id'];
            $api=$_GET['api'];
			            
            switch ($api) {
                case "shiprocket":
				
				$type="shiprocket";

                $option = $this->common_model->get_options();
                $order_details = $this->common_model->GetByRow('ec_orders', $order_id, 'id');

                $shipment_order_response = json_decode($order_details->shipment_order_response);

                $shiprocket_parameters  = array(
                'shipping_order_id' => $shipment_order_response->order_id,

                );	

                $get_shiprocket_invoice = $this->common_model->create_shiprocket_invoice($shiprocket_parameters);

                if(isset($get_shiprocket_invoice->invoice_url))
                {

				//
				$invoice_data = array(
				"invoice_request"=>'yes',
				"invoice_request_response"=>json_encode($get_shiprocket_invoice),
				"invoice_request_error"=>'',
				);
								
				$this->db->where('id', $order_id);
				$this->db->update('ec_orders', $invoice_data); 
				//
                }
                else
                {
			    //
				$invoice_data = array(
				
				"invoice_request_error"=>json_encode($get_shiprocket_invoice),
				);
								
				$this->db->where('id', $order_id);
				$this->db->update('ec_orders', $invoice_data); 
				//	
				
				$this->session->set_flashdata('invoiceerror', 'yes');
			
                }
                 
                break;
				
              }			  
            
            redirect('ecorderadmin/vieworderdetail/'.$order_id);
			
        }
		else
		{        
        redirect('ecorderadmin/vieworders/');
		}
    }	
	
    function testp()
    {

        $all_order_list = $this->db->get('ec_order_list')->result();

        foreach($all_order_list as $row)
        {
            
        $product_details = $this->order_model->GetByRow('ec_products', $row->product_id , 'id');

            $tabledata = array(
            'sku_code' => $product_details->sku,
            );
            $this->db->where('id', $row->id);
            $this->db->update('ec_order_list', $tabledata);	
            
        }
	
   }


    function split_order_by_qty()
    {
        error_reporting(-1);	
        if(!empty($_GET['id']) && !empty($_GET['api']))
        {

        $order_id=$_GET['id'];
        $api=$_GET['api'];
        $pid=$_GET['pid'];

        $pid_array = substr($pid, 0, -1);
        $pid_array = explode('_',$pid_array);

        $order_details = $this->common_model->GetByRow('ec_orders', $order_id, 'id');

        $order_split_child_orders = $this->common_model->get_order_split_child_orders($order_id);

        $order_id_split_reference = 0;
        if(!empty($order_split_child_orders))
        {
        $order_id_split_reference = count($order_split_child_orders);
        }

        $order_id_split_reference = $order_id_split_reference+1;

        $order_details_array = (array) $order_details;
        $order_details_array['id'] = '';
        $order_details_array['order_id'] = 0;
        $order_details_array['invoice_id'] = '';
        $order_details_array['splited_order_json'] = '';
        $order_details_array['order_split_status'] = 'yes';
        $order_details_array['order_split_type'] = 'child';
        $order_details_array['split_order_master_id'] = $order_id;
        $order_details_array['splited_order_total_qty'] = '';

        $order_details_array['coupon_applied'] = '';
        $order_details_array['coupon_applied_amount'] = 0;
        $order_details_array['coupon_code'] = '';
        $order_details_array['coupon_amount'] = 0;
        $order_details_array['coupon_balance_redeemed'] = '';
        $order_details_array['coupon_redeemed_amount'] = 0;
        $order_details_array['delivery_charge'] = 0;
        $order_details_array['order_id_split_reference'] = $order_id_split_reference;

        $this->db->insert('ec_orders', $order_details_array);
        $new_order_id = $this->db->insert_id();

        $order_total = 0;
        $order_list_qty_total = 0;
        $order_list_split_array = array();

        if(!empty($order_details->splited_order_json))
        {
        $splited_order_json = $order_list_split_array =  json_decode($order_details->splited_order_json,TRUE);
        }

        foreach($pid_array as $prow)
        {

        $prow_split = explode('-',$prow);	

        $order_list_id = $prow_split[0];
        $order_list_qty = $prow_split[1];
            
        $order_list_details = $this->common_model->GetByRow('ec_order_list', $order_list_id, 'id');

        $product_details = $this->common_model->GetByRow_notrash('ec_products', $order_list_details->product_id, 'id');

        $order_list_details_array = (array) $order_list_details;
        $order_list_details_array['id'] = '';
        $order_list_details_array['order_qty'] = $order_list_qty;
        $order_list_details_array['ec_orders_id'] = $new_order_id;
        $order_list_details_array['order_id'] = 0;
        $order_list_details_array['invoice_id'] = 0;

        $this->db->insert('ec_order_list', $order_list_details_array);

        $order_total += $order_list_details->product_price*$order_list_qty;	

        $order_list_qty_total += $order_list_qty;

        $order_list_json_qty = $order_list_qty;

        if(!empty($splited_order_json))
        {
        if(isset($splited_order_json[$product_details->id]))
        {
        $order_list_json_qty = $order_list_json_qty+$splited_order_json[$product_details->id];	
        }
        }

        $order_list_split_array[$product_details->id] = $order_list_json_qty;
            
        }

        $order_list_qty_total = $order_details->splited_order_total_qty + $order_list_qty_total;

        $data2 = array(

        'amount' => $order_total,
        'order_total' => $order_total,

        );

        $this->db->where('id', $new_order_id);
        $this->db->update('ec_orders', $data2);

        $data1 = array(

        'splited_order_json' => json_encode($order_list_split_array),
        'order_split_status' => 'yes',
        'order_split_type' => 'master',
        'splited_order_total_qty' => $order_list_qty_total,

        );

        $this->db->where('id', $order_details->id);
        $this->db->update('ec_orders', $data1);

        redirect('ecorderadmin/vieworderdetail/'.$order_details->id);

       }
	
    }

    function create_shiprocket_orderreturn(){
		
        if(!empty($_GET['id']) && !empty($_GET['api'])){
            $order_id=$_GET['id'];
            $api=$_GET['api'];
			            
            switch ($api) {
                case "shiprocket":
				
				$type="shiprocket";
				
                $order_return_response=$this->common_model->create_shiprocket_orderreturn($order_id);
				
				if(isset($order_return_response->shipment_id))
				{
				//
				$order_id=$order_return_response->order_id;
				$shipment_id=$order_return_response->shipment_id;

				$response_data = array(
				"order_return_api_data"=>json_encode($order_return_response),
				"order_return_api_error" => '',
				"order_return_order_id"=>$order_id,
				"order_return_shipment_id"=>$shipment_id,
				);
								
				$this->db->where('id', $order_id);
				$this->db->update('ec_orders', $response_data); 
				//
				
				}
				else
				{
				
				//
				
				$response_data = array(
				"order_return_api_error"=>json_encode($order_return_response)
				);
								
				$this->db->where('id', $order_id);
				$this->db->update('ec_orders', $response_data); 
								
				//
				
				$this->session->set_flashdata('returnrequesterror', 'yes');
								
				}
				                 
                break;
				
              }
			              
            redirect('ecorderadmin/vieworderdetail/'.$order_id);
			
        }
		else
		{        
        redirect('ecorderadmin/vieworders/');
		}
    }

    function testlabel()
    {
    
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
            "shipment_id" => array(''), // required
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
		
		dump($response2);
        curl_close($curl1);			
				
    }

    function test2()
    {
        error_reporting(-1);	
        $get_shiprocket_airwaybill = '';
        $get_shiprocket_airwaybill = json_decode($get_shiprocket_airwaybill);
        $get_shiprocket_airwaybill_response_array = $get_shiprocket_airwaybill->response;
        $get_shiprocket_airwaybill_response_data_array =$get_shiprocket_airwaybill_response_array->data;
        $awb_code = $get_shiprocket_airwaybill_response_data_array->awb_code;        
    }

//force order details edit

    function update_order_total_amount() {
        $input_adminuser = $this->input->post('input_adminuser');
        $input_ordertotal = $this->input->post('input_ordertotal');
        $input_order_grand_total = $this->input->post('input_order_grand_total');		
		$orderid = $this->input->post('orderid');		
		$edit_reason = $this->input->post('edit_reason');		
		$order_detail = $this->common_model->GetByRow_notrash('ec_orders', $orderid, 'id');
        $payment_response = str_replace($order_detail->amount,$input_ordertotal,$order_detail->payment_response);
        $payment_data = str_replace($order_detail->amount,$input_ordertotal,$order_detail->payment_data);

        $user_data = array(
        'lastamount' => $order_detail->amount,
        'newamount' => $input_ordertotal,
        'user' => $input_adminuser,
        'reason' => $edit_reason,
        'date' => date('Y-m-d H:i:s'),
        );

        $force_edit_json = array();
        if(!empty($order_detail->force_edit_json))
        {
            
        $force_edit_json = json_decode($order_detail->force_edit_json,TRUE);
            
        }

        $force_edit_json[] = $user_data;
        $force_edit_json = json_encode($force_edit_json);
        
		$data = array(		
            'amount' => $input_ordertotal,
            'order_total' => $input_order_grand_total,
			'payment_response' => $payment_response,
			'payment_data' => $payment_data,
			'force_edit_json' => $force_edit_json,
			
        );

        $this->db->where('id', $orderid);
        $this->db->update('ec_orders', $data);
				
        $this->session->set_flashdata('message', 'Order Amount Updated Successfully..!');	
        redirect('ecorderadmin/vieworderdetail/' . $orderid);		
		
    }	
	
    function update_order_product_amount() {
        $input_adminuser = $this->input->post('input_adminuser');
        $order_product_order_id = $this->input->post('order_product_order_id');
        $input_product_price = $this->input->post('input_product_price');		
		$input_product_goldrate = $this->input->post('input_product_goldrate');		
		$edit_reason = $this->input->post('edit_reason');				
		$order_product_detail = $this->common_model->GetByRow_notrash('ec_order_list', $order_product_order_id, 'id');
        $product_order_full_info_json = str_replace($order_product_detail->product_price,$input_product_price,$order_product_detail->product_order_full_info_json);
        $product_full_info_json = str_replace($order_product_detail->product_price,$input_product_price,$order_product_detail->product_full_info_json);

        $user_data = array(
        'lastamount' => $order_product_detail->product_price,
        'newamount' => $input_product_price,
        'lastgoldrate' => $order_product_detail->goldrate_value,
        'newgoldrate' => $input_product_goldrate,
        'user' => $input_adminuser,
        'reason' => $edit_reason,
        'date' => date('Y-m-d H:i:s'),
        );

        $force_edit_json = array();
        if(!empty($order_product_detail->force_edit_json))
        {            
          $force_edit_json = json_decode($order_product_detail->force_edit_json,TRUE);            
        }

        $force_edit_json[] = $user_data; 
        $force_edit_json = json_encode($force_edit_json);
        
		$data = array(		
            'product_price' => $input_product_price,
			'goldrate_value' => $input_product_goldrate,
			'product_order_full_info_json' => $product_order_full_info_json,
			'product_full_info_json' => $product_full_info_json,
			'force_edit_json' => $force_edit_json,
			
        );

        $this->db->where('id', $order_product_order_id);
        $this->db->update('ec_order_list', $data);		
		
        $this->session->set_flashdata('message', 'Order Product Price Updated Successfully..!');	
        redirect('ecorderadmin/vieworderdetail/' . $order_product_detail->ec_orders_id);		
		
    }	
	
    function update_order_delivery_address() {
        $input_adminuser = $this->input->post('input_adminuser');
        $input_order_id = $this->input->post('input_order_id');
        $address_keys = $this->input->post('address_keys');		
		$edit_reason = $this->input->post('edit_reason');		
		
        $order_detail = $this->common_model->GetByRow_notrash('ec_orders', $input_order_id, 'id');
        $address_keys_array = explode(',',$address_keys);
        $postarray = $_POST;
        $address_array = array();
        foreach($address_keys_array as $address_key_row)
        {
        $address_array[$address_key_row] = $postarray[$address_key_row];	
        }

        $user_data = array(
        'lastaddress' => $order_detail->shipping_address,
        'newaddress' => json_encode($address_array),
        'user' => $input_adminuser,
        'reason' => $edit_reason,
        'date' => date('Y-m-d H:i:s'),
        );

        $force_edit_json = array();
        if(!empty($order_detail->shipping_address_force_edit_json))
        {            
          $force_edit_json = json_decode($order_detail->shipping_address_force_edit_json,TRUE);            
        }

        $force_edit_json[] = $user_data; 
        $force_edit_json = json_encode($force_edit_json);
        
		$data = array(		
            'shipping_address' => json_encode($address_array),
			'shipping_address_force_edit_json' => $force_edit_json,			
        );

        $this->db->where('id', $input_order_id);
        $this->db->update('ec_orders', $data);
				
        $this->session->set_flashdata('message', 'Order Delivery Updated Successfully..!');	
        redirect('ecorderadmin/vieworderdetail/' . $input_order_id);	
		
    }	

    function update_order_billing_address() {
        $input_adminuser = $this->input->post('input_adminuser');
        $input_order_id = $this->input->post('input_order_id');
        $address_keys = $this->input->post('address_keys');		
		$edit_reason = $this->input->post('edit_reason');			
		
        $order_detail = $this->common_model->GetByRow_notrash('ec_orders', $input_order_id, 'id');
        $address_keys_array = explode(',',$address_keys);
        $postarray = $_POST;
        $address_array = array();
        foreach($address_keys_array as $address_key_row)
        {
          $address_array[$address_key_row] = $postarray[$address_key_row];            
        }

        $user_data = array(
        'lastaddress' => $order_detail->billing_address,
        'newaddress' => json_encode($address_array),
        'user' => $input_adminuser,
        'reason' => $edit_reason,
        'date' => date('Y-m-d H:i:s'),
        );

        $force_edit_json = array();
        if(!empty($order_detail->billing_address_force_edit_json))
        {	
          $force_edit_json = json_decode($order_detail->billing_address_force_edit_json,TRUE);	
        }

        $force_edit_json[] = $user_data; 
        $force_edit_json = json_encode($force_edit_json);
        
		$data = array(		
            'billing_address' => json_encode($address_array),
			'billing_address_force_edit_json' => $force_edit_json,			
        );

        $this->db->where('id', $input_order_id);
        $this->db->update('ec_orders', $data);		
		
        $this->session->set_flashdata('message', 'Order Billing Updated Successfully..!');	
        redirect('ecorderadmin/vieworderdetail/' . $input_order_id);	
		
    }
	
    function update_order_product_status() {
        $input_adminuser = $this->input->post('input_adminuser');
        $order_product_order_id = $this->input->post('order_product_item_id');		
		$edit_reason = $this->input->post('edit_reason');
		
		$order_product_detail = $this->common_model->GetByRow_notrash('ec_order_list', $order_product_order_id, 'id');
		
        if($order_product_detail->active_status == 'a')
        {
        $newstatus = 'd';	
        }
        else
        {
        $newstatus = 'a';
        }
		
        $user_data = array(
        'laststatus' => $order_product_detail->active_status,
        'newstatus' => $newstatus,
        'user' => $input_adminuser,
        'reason' => $edit_reason,
        'date' => date('Y-m-d H:i:s'),
        );

        $force_edit_json = array();
        if(!empty($order_product_detail->force_status_json))
        {	
        $force_edit_json = json_decode($order_product_detail->force_status_json,TRUE);	
        }

        $force_edit_json[] = $user_data; 
        $force_edit_json = json_encode($force_edit_json);
        
		$data = array(		
            'active_status' => $newstatus,
			'force_status_json' => $force_edit_json,			
        );

        $this->db->where('id', $order_product_order_id);
        $this->db->update('ec_order_list', $data);
				
        $this->session->set_flashdata('message', 'Order Product Status Updated Successfully..!');	
        redirect('ecorderadmin/vieworderdetail/' . $order_product_detail->ec_orders_id);		
		
    }	
	
//force order details edit
	
}
