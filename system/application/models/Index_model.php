<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Index_model
        extends CI_Model {

    var $data = '';

    function __construct(){
        parent::__construct();

        date_default_timezone_set('Asia/Calcutta');
    }

   function checkModelStatus(){
          echo "test";
   }

   function saveUserAcceptCookies(){
    $ip_address = $this->input->post('ip_address');
    $ip_status = $this->input->post('status');
    
    $data = array(
        'ip_address_data' => $ip_address,
        'accept_status' => $ip_status
    );
    
    $this->db->insert('cms_cookies', $data);
  }

  function checkIpAddressExists($ip_address){
    $this->db->where('ip_address_data', $ip_address);
    $this->db->where('trash_status', 'no');
    $this->db->where('active_status', 'a');
    
    $query = $this->db->get('cms_cookies');
    if ($query->num_rows() >= 1) {
        return "yes";
    } else {
        return "no";
    }
  }

  public function get_rsegment() {
    $seg_array = $this->uri->rsegment_array();
    $last_segment = end($seg_array);
    return $last_segment_splited = explode('-', $last_segment);
  }

  public function get_rsegment_last_string() {

    $seg_array = $this->uri->rsegment_array();
    return $last_segment = end($seg_array);
  }

  function GetByRow($table, $eventid, $field) {

    $this->db->where(array(
        $field => $eventid));
    $this->db->where('trash_status', 'no');
    $this->db->where('active_status', 'a');
    return $result = $this->db->get($table)->row();
  }

  function array_push_assoc($array, $key, $value) {
    $array[$key] = $value;
    return $array;
  }

  function getAllCategoryList(){
    $this->db->where('ctype', '1');
    $this->db->where('parent_id', 0);
    $this->db->where('trash_status', 'no');
    $this->db->where('active_status', 'a');
    
    $category_result = $this->db->get('ec_category')->result();
    return $category_result;
  }

  function getProductsList(){
    $this->db->where('function_type', 'product');
    $this->db->where('trash_status', 'no');
    $this->db->where('active_status', 'a');
    $this->db->order_by('id', 'asc');
    $this->db->limit(20);
    
    $products_result = $this->db->get('ec_products')->result();
    return $products_result;
  }

  function getProductsListByCategory($cat_id){
    $this->db->where('function_type', 'product');
    $this->db->where('trash_status', 'no');
    $this->db->where('active_status', 'a');
    $this->db->where('parent_sub_id', $cat_id);
    $this->db->order_by('order_no', 'asc');
//        $this->db->limit(20);
    
    $products_result = $this->db->get('ec_products')->result();
    return $products_result;
  }

  function getProductsListSearch(){
    if(isset($_POST['gl_search'])){
        $search = $_POST['gl_search'];
        $search = trim($search);
        
        if ($search != "") {
            $search_filter_string = "";
            $search_filter_string = "(product_display_name LIKE '%" . $search . "%'";
            $search_filter_string = $search_filter_string . ")";
            $this->db->where($search_filter_string, NULL, FALSE);
        }            
    }
    
    $this->db->where('function_type', 'product');
    $this->db->where('trash_status', 'no');
    $this->db->where('active_status', 'a');
    $this->db->order_by('id', 'desc');
//        $this->db->limit(20);
    
    $products_result = $this->db->get('ec_products')->result();
    return $products_result;        
  }

  function getProductsListSearchCount(){
    if(isset($_GET['s'])){
        $search = $_GET['s'];
        $search = trim($search);
        
        if ($search != "") {
            $search_filter_string = "";
            $search_filter_string = "(product_display_name LIKE '%" . $search . "%'";
            $search_filter_string = $search_filter_string . ")";
            $this->db->where($search_filter_string, NULL, FALSE);
        }            
    }
    
    $this->db->where('function_type', 'product');
    $this->db->where('trash_status', 'no');
    $this->db->where('active_status', 'a');
    $this->db->order_by('id', 'desc');
    
    $products_result_num = $this->db->get('ec_products')->num_rows();
    return $products_result_num;
 }

 function getMediaList($cat_id){        
    $conditional_array = array(
        "prod_cat" => $cat_id,
        "type" => "content_management"
    );

    $media_list_result = $this->common_model->GetByResult_Where("cms_media", "order", "asc", $conditional_array);        
    return $media_list_result;
 }

 function getMediaListGallery($cat_id){
    $conditional_array = array(
        "prod_cat" => $cat_id,
        "type" => "commonimage",
        "type2" => "gallery2",
        "type_trash" => "no"
    );
    
    $media_list_result = $this->common_model->GetByResult_Where("cms_media", "order", "asc", $conditional_array);        
    return $media_list_result;
 }

 function getMediaListMenu($type){
    $conditional_array = array(
        "menu_type_tree" => $type,
        "parent_id" => 0
    );
    
    $media_list_result = $this->common_model->GetByResult_Where("cms_menu", "order_no", "asc", $conditional_array);
    return $media_list_result;
 }

 function getCustomUrl($customized_link){
    $full_url = "";
    if ($customized_link['type2'] == 'link') {
        $full_url = $customized_link['type3'];
    } elseif ($customized_link['type2'] == 'slug') {
        $full_url = base_url() . $customized_link['type3'];
    }
    
    return $full_url;
 }

 function getServicesListCount(){
      
    $this->db->where('trash_status', 'no');
    $this->db->where('active_status', 'a');
    $this->db->order_by('order_no', 'asc');

    $services_result = $this->db->get('ec_services');
    return $services_result->num_rows();

 }

 function getServiceListAll(){

    $this->db->where('trash_status', 'no');
    $this->db->where('active_status', 'a');
    $this->db->order_by('order_no', 'asc');  
    $this->db->limit(10);
    $services_result = $this->db->get('ec_services')->result();
    return $services_result;
 }

 function getFeaturedProductsListByCategory($cat_id , $limit = ''){
    $this->db->where('function_type', 'product');
    $this->db->where('trash_status', 'no');
    $this->db->where('active_status', 'a');
    $this->db->where('parent_sub_id', $cat_id);
    $this->db->where('featured_products', 'yes');
    $this->db->order_by('id', 'desc');

    if($limit != ''){
      $this->db->limit($limit);
    }    
    
    $products_result = $this->db->get('ec_products')->result();
    return $products_result;
 }
 function getGalleryCategories(){
    $conditional_array = array(
        "type" => "commonimage",
        "trash_status" =>"no",
        "active_status" =>"a"
    );    
    $media_list_result = $this->common_model->GetByResult_Where("cms_dynamic_category", "order", "asc", $conditional_array);        
    return $media_list_result;
 }
 function getGalleryImages(){
    $conditional_array = array(
        "type" => "commonimage",
        "trash_status" =>"no",
        "active_status" =>"a"        
    );
    
    $media_list_result = $this->common_model->GetByResult_Where("cms_media", "order", "asc", $conditional_array);        
    return $media_list_result;
 }

 function getGalleryImagesByProduct($prod_id,$type){
    
    $this->db->where('type', 'product_image');
    $this->db->where('trash_status', 'no');
    $this->db->where('active_status', 'a');
    $this->db->where('prod_cat', $prod_id);
    $this->db->where('image_type', $type);
    return $this->db->get('cms_media')->row();
   
 }

 function getMoreGalleryImagesByProduct($prod_id,$type){
    
    $this->db->where('type', 'product_image');
    $this->db->where('trash_status', 'no');
    $this->db->where('active_status', 'a');
    $this->db->where('prod_cat', $prod_id);
    $this->db->where('image_type', $type);
    return $this->db->get('cms_media')->result();
   
 }
 
 function getProductDefaultImage($prod_id) {
    $this->db->where('prod_cat', $prod_id);
    $this->db->where('default_img', 'yes');
    return $this->db->get('cms_media')->row();
 }
 function getProductsListByCategory_Limit($cat_id,$limit){
    $this->db->where('function_type', 'product');
    $this->db->where('trash_status', 'no');
    $this->db->where('active_status', 'a');
    $this->db->where('parent_sub_id', $cat_id);
    $this->db->order_by('order_no', 'asc');
    $this->db->limit($limit);
    
    $products_result = $this->db->get('ec_products')->result();
    return $products_result;
  }
  function addBlogLikes($blogid)
  {   
     
    $this->db->where('id', $blogid);
    $this->db->set('total_likes', 'total_likes+1', FALSE);
    $this->db->update('ec_products'); 


  }
  function getBlogLikesCount($blogid)
  {
    $this->db->where('id', $blogid);
    $this->db->where('trash_status', 'no');
    $query = $this->db->get('ec_products');
    return $query->row();
  }

  function addComment()
{
    $name=$this->input->post('custname');
    $comment=$this->input->post('comments');
    $email=$this->input->post('email');
    $website=$this->input->post('website');
    $blogid=$this->input->post('blogid');
    $data = array(
        'customer_name' => $name,
        'comments' => $comment,
        'email' => $email,
        'website' => $website,
        'save_status' => isset($_POST['chk_save']) ? 'yes' : 'no',
        'trash_status' => 'no',
        'active_status' => 'a',
        'product_id'=> $blogid
    );    
    $this->db->insert('cms_comments', $data);

}
function addCommentLikes($productid,$commentid)
{   
     
    $this->db->where('product_id', $productid);
    $this->db->where('id', $commentid);
    $this->db->set('total_likes', 'total_likes+1', FALSE);
    $this->db->update('cms_comments');


}
function getCommentsCount($blogid)
{
    $this->db->where('product_id', $blogid);
    $this->db->where('trash_status', 'no');
    $result = $this->db->get('cms_comments');
    return $result->num_rows();
}
function getCommentsList($blogid)
{
    $this->db->where('product_id', $blogid);
    $this->db->where('trash_status', 'no');
    $this->db->order_by('id', 'desc');
    $this->db->limit(10);
    $query = $this->db->get('cms_comments');
    return $query->result();
}
function getPrevProductsList($cat_id,$id){
  //$this->db->select_max('id');
  $this->db->where('function_type', 'product');
  $this->db->where('trash_status', 'no');
  $this->db->where('active_status', 'a');
  $this->db->where('parent_sub_id', $cat_id);
  $this->db->where('id <', $id);  
  $this->db->order_by('order_no', 'asc');
  $prev_result = $this->db->get('ec_products')->row();
  //$result=$this->GetByRow('ec_products',$prev_result->id,'id');  
  return $prev_result;
}
function getNextProductsList($cat_id,$id){
  
  //$this->db->select_min('id');
  $this->db->where('function_type', 'product');
  $this->db->where('trash_status', 'no');
  $this->db->where('active_status', 'a');
  $this->db->where('parent_sub_id', $cat_id);
  $this->db->where('id >', $id);  
  $this->db->order_by('order_no', 'desc');
  $next_result = $this->db->get('ec_products')->row();
 // $result=$this->GetByRow('ec_products',$next_result->id,'id');  
  //dump($result);die();
  return $next_result;
}
function getOlderCommentsList($productid,$currentid)
{   
    $this->db->where('product_id', $productid);
    $this->db->where('trash_status', 'no');
    $this->db->where('id <', $currentid);
    $this->db->order_by('id', 'desc');
    $this->db->limit(10);
    $query = $this->db->get('cms_comments');
    //dump($query->result());die();
    return $query->result();
}
function getProductMediaListGallery($prod_id){
  $conditional_array = array(
      "prod_cat" => $prod_id,
      "type" => "product_image",
      "type2" => "product",
      "type_trash" => "no",
      "image_type" => "other"
  );
  
  $media_list_result = $this->common_model->GetByResult_Where("cms_media", "order", "asc", $conditional_array);        
  return $media_list_result;
}
function getProductBannerGallery($prod_id){
  
  $this->db->where('prod_cat', $prod_id);
  $this->db->where('type', 'product_image');
  $this->db->where('type2', 'product');
  $this->db->where('type_trash', 'no');
  $this->db->where('image_type', 'banner_img');
  $this->db->order_by('id', 'desc');
  return $this->db->get('cms_media')->row();
}
function addVisitCount($blogid)
{
   
    $data = array(
        'pageid' => $blogid,
        'datetime' =>date("Y-m-d H:i:s"),
        'date' => date('Y-m-d H:i:s'),
        'ip' => $this->input->ip_address()
    );    
    $this->db->insert('cms_visitors', $data);

}
function getVisitCount($blogid)
{
    $this->db->where('pageid', $blogid);
    $result = $this->db->get('cms_visitors');
    return $result->num_rows();
}
function getTitleWithTag($tag, $text)
{
  if(empty($tag))
  { 
    $tag=""; 
  }
  switch($tag)
  {
    case "h1":
      {
         return '<h1>'.$text.'</h1>';
      }
      case "h2":
        {
          return '<h2>'.$text.'</h2>';
        }
        case "h3":
          {
            return '<h3>'.$text.'</h3>';
          }
          case "h4":
            {
              return '<h4>'.$text.'</h4>';
            }
            case "h5":
              {
                return '<h5>'.$text.'</h5>';
              }
              case "h6":
                {
                  return '<h6>'.$text.'</h6>';
                }
                default:
                {
                  return $text;
                }
                
  }

}

function get_submenu_list($parentid)
{
       	$this->db->where('parent_id', $parentid);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('order_no', 'ASC');
        return $this->db->get('cms_menu')->result();	
}

function get_categorylist_bymenu($menuid)
{
        $this->db->select('id');
        $this->db->where('menu_id', $menuid);
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('id', 'DESC');
        return $this->db->get('ec_category')->result();	

}

function getProductsListByMenu($menu_id){
  $menu_id_string = '+' . $menu_id . '+';
  $this->db->where('function_type', 'product');
  $this->db->where('trash_status', 'no');
  $this->db->where('active_status', 'a');
  $this->db->like('menu_id_tree', $menu_id_string);
  $this->db->order_by('order_no', 'asc');
//        $this->db->limit(20);
  
  $products_result = $this->db->get('ec_products')->result();
  return $products_result;
}

function getProductMediaListGalleryFeatured($prod_id){
  $conditional_array = array(
      "prod_cat" => $prod_id,
      "type" => "product_image",
      "type2" => "product",
      "type_trash" => "no",
      "image_type" => "default_img"
  );
  
  $media_list_result = $this->common_model->GetByResult_Where("cms_media", "order", "asc", $conditional_array);        
  return $media_list_result;
}

function getProductsListByCategories($cat_id_1, $cat_id_2){
  $cat_array = array($cat_id_1, $cat_id_2);
  $this->db->where('function_type', 'product');
  $this->db->where('trash_status', 'no');
  $this->db->where('active_status', 'a');
  $this->db->where_in('parent_sub_id', $cat_array);
  $this->db->order_by('order_no', 'asc');
//        $this->db->limit(20);
  
  $products_result = $this->db->get('ec_products')->result();
  return $products_result;
}

function getProductsListBySpecialTypes($special_type , $limit = ''){
  $special_type_string = "+" . $special_type . "+";
  $this->db->where('function_type', 'product');
  $this->db->where('trash_status', 'no');
  $this->db->where('active_status', 'a');

  $like_clause_string = "featured_types_tree LIKE '%" . $special_type_string . "%'";
  $this->db->where("(" . $like_clause_string . ")", NULL, FALSE);

  $this->db->order_by('id', 'desc');

  if($limit != ''){
     $this->db->limit($limit);
  }

  $products_result = $this->db->get('ec_products')->result();
  return $products_result;  

}

function getProductThumbnailImage($prod_id) {
  $this->db->where('prod_cat', $prod_id);
  $this->db->where('type_trash', 'no');
  $this->db->where('image_type', 'thumbnail');
  $this->db->order_by('id', 'desc');
  return $this->db->get('cms_media')->row();
}

function getProductsListBySpecialTypesAll($special_type){
  $special_type_string = "+" . $special_type . "+";
  $this->db->where('function_type', 'product');
  $this->db->where('trash_status', 'no');
  $this->db->where('active_status', 'a');

  $like_clause_string = "featured_types_tree LIKE '%" . $special_type_string . "%'";
  $this->db->where("(" . $like_clause_string . ")", NULL, FALSE);

  $this->db->order_by('id', 'asc');
  
  $products_result = $this->db->get('ec_products')->result();
  return $products_result;  

}

  function getProductsListByFromLimit($last_id){
      $this->db->where('function_type', 'product');
      $this->db->where('trash_status', 'no');
      $this->db->where('active_status', 'a');
      $this->db->where('id <', $last_id);
      $this->db->order_by('id', 'desc');
      $this->db->limit(10);

      $products_result = $this->db->get('ec_products')->result();
      return $products_result;
  }

  function getVideoGalleryCategories(){
      $conditional_array = array(
          "type" => "gallery_video",
          "trash_status" =>"no",
          "active_status" =>"a"
      ); 
         
      $media_list_result = $this->common_model->GetByResult_Where("cms_dynamic_category", "order", "asc", $conditional_array);        
      return $media_list_result;
  }

  function getAllGalleryVideos(){

    $conditional_array = array(       
        "trash_status" =>"no",
        "active_status" =>"a"        
    );
    
    $media_list_result = $this->common_model->GetByResult_Where("cms_video_gallery", "order_number", "asc", $conditional_array);        
    return $media_list_result;
  }

  function getAllEvents(){
        $this->db->where('category', 0);
        $this->db->where('type', 'service');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');

        return $this->db->get('ec_services')->result();
  }

  function getAllTicketTypesByCategory($cat_id){
      $this->db->where('category', $cat_id);
      $this->db->where('type', 'ticket');
      $this->db->where('trash_status', 'no');
      $this->db->where('active_status', 'a');

      return $this->db->get('ec_services')->result();
  }

  function getPackagesByCategory($cat_id){
      $catid_string = '+' . $cat_id . '+';

      $like_clause_string = "category_tree LIKE '%" . $catid_string . "%'";
      $this->db->where("(" . $like_clause_string . ")", NULL, FALSE);

      $this->db->where('type', 'package');
      $this->db->where('trash_status', 'no');
      $this->db->where('active_status', 'a');
      
      return $this->db->get('ec_services')->result();

  }

  function getMediaListByLimit($cat_id , $limit){
        
        $this->db->where('prod_cat', $cat_id);
        $this->db->where('type', 'content_management');
        $this->db->where('trash_status', 'no');
        $this->db->where('active_status', 'a');
        $this->db->order_by('order', 'asc');
        $this->db->limit($limit);

        $result = $this->db->get('cms_media')->result();
        return $result;
  }
 
}
