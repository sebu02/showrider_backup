<style>
    .main_categrory {
        list-style-type: none;
    }

    .sub_category {

        list-style-type: none;
        margin: 10px 0px 0px 20px;
        clear: both;
    }

    .subcat_check {
        margin: 0px !important;
    }

    .label {
        margin-left: 10px;
        margin-bottom: 5px;
    }

    .tree, .tree ul {
        font: normal normal 14px/20px Helvetica, Arial, sans-serif;
        list-style-type: none;

        padding: 0;
        position: relative;
        overflow: hidden;
    }

    .tree li {
        margin: 0;
        padding: 0 12px;
        position: relative;
    }

    .tree li::before, .tree li::after {
        content: '';
        position: absolute;
        left: 0;
    }

    .tree li::before {
        border-top: 1px dotted #999;
        top: 10px;
        width: 10px;
        height: 0;
    }

    .tree li:after {
        border-left: 1px dotted #999;
        height: 100%;
        width: 0px;
        top: -10px;
    }

    .tree > li::after {
        top: 10px;
    }
    .subcat_check.nostyle {
        width: auto !important;
    }
    .subcat_check {
        width: auto !important;
    }

    .cat_left_radio{
        width: auto !important;
        position: relative;
        top: -2px;
    }

    .selectwrap .controls .selector span{
        display: none !important;  
    }
    .selectwrap .selector select {
        border:  none !important;
        height: 28px !important;
        opacity: 1 !important;
        position: absolute ;
        background-color: #FFF;
    }
</style>

<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->

        <div class="heading">

            <h3>Manage Content</h3>                    



        </div><!-- End .heading-->

        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

        <div class="row-fluid">

            <div class="span12">

                <div class="box">

                    <div class="title">

                        <h4> 
                            <span>Add Content</span>
                        </h4>

                    </div>
                    <div class="content noPad clearfix">

                        <form class="form-horizontal multiple_upload_form gl_multiple_upload_form" action="<?php echo base_url() . 'contentadmin/addcontent?' . $_SERVER['QUERY_STRING']; ?>" method="post" enctype="multipart/form-data" >


                            <div class="msg"></div>

                            <div class="wizard-steps clearfix show">

                                <a class="wstep current" data-step-num="0">
                                    <div class="donut">1</div>
                                    <span class="txt">STEP 1</span>
                                </a>

                                <a class="wstep " data-step-num="1">
                                    <div class="donut">2</div>
                                    <span class="txt">STEP 2</span>
                                </a>

                            </div>



<?php
$avoid_feature_set="";
?>
                            <input type="hidden" name="feature_id" value="<?php
                            if (isset($_GET['feature_id'])) {
                                echo $_GET['feature_id'];
                                $avoid_feature_set="yes";
                            }
                            ?>">
                            <input type="hidden" name="structure_id" value="<?php
                            if (isset($_GET['structure_id'])) {
                                echo $_GET['structure_id'];
                            }
                            ?>">
                            <input type="hidden" name="page" value="<?php
                            if (isset($_GET['page'])) {
                                echo $_GET['page'];
                            }
                            ?>">
                            
                            <input type="hidden" name="product_id" value="<?php
                            if (isset($_GET['product_id'])) {
                                echo $_GET['product_id'];
                            }
                            ?>" class="product_id">
                            
                            <input type="hidden" name="menu_id" value="<?php
                            if (isset($_GET['menu_id'])) {
                                echo $_GET['menu_id'];
                            }
                            ?>" class="menu_id">


                            <?php
                            $cont_category = '';
                            $category_id = '';
                            $cont_category_id = '';
                            $cms_type = '';
                            
                            
                             if (isset($_GET['structure_id'])) {
                            $structure_id = $_GET['structure_id'];
                            $structure_name = $this->content_model->GetByRow_notrash('cms_templates', $structure_id, 'id');
                             }
                             if (isset($_GET['page_id'])) {
                                $page_id = $_GET['page_id'];
                                $page_row = $this->content_model->GetByRow_notrash('cms_pages', $page_id, 'id');
                            }
                             if (isset($_GET['category'])) {
                                $category_id = $_GET['category'];
                                $category_row = $this->content_model->GetByRow_notrash('cms_dynamic_category', $category_id, 'id');
                            }
                            if (isset($_GET['feature_id'])) {
                                $feature_id = $_GET['feature_id'];
                                $featurebox_name = $this->content_model->GetByRow_notrash('cms_featuredbox', $feature_id, 'id');
								
								$feature_cms_type= $featurebox_name->cms_type; 
                          
                                $cont_category = $featurebox_name->content_category_type_2;
								
								$cont_category_id = $featurebox_name->content_category_type_2_value;

                                if ($cont_category == 'cms_category_content' || $cont_category == 'cms_cust_category_content') {
                                    $cms_type = 'content_management';
                                } elseif ($cont_category == 'cms_category_img' || $cont_category == 'cms_cust_category_img') {
                                    $cms_type = 'image';
                                } elseif ($cont_category == 'cms_category_video' || $cont_category == 'cms_cust_category_video') {
                                    $cms_type = 'video';
                                }



                            }
							

if (!isset($_GET['feature_id'])) 
{

if(isset($_GET['f_cmc_type'])) 
{
	
$feature_cms_type = $_GET['f_cmc_type'] ;

$cont_category = 'cms_category_content';
$cms_type = 'content_management';
$cont_category_id = $_GET['category'];

}
	
	
}



if ($cont_category == 'cms_category_content' || $cont_category == 'cms_category_img' || $cont_category == 'cms_category_video') {

$ec_category = $this->content_model->GetByRow('cms_dynamic_category', $cont_category_id, 'id');

$category_id = $cont_category_id;
if ($ec_category->parent_id == 0) {
$main_cats = $this->content_model->get_all_categories('parent', $cont_category_id);
} else {
$main_cats = $this->content_model->get_all_categories('', $cont_category_id);
}
} else {
$category_id = '';
}


if (isset($_GET['feature_id'])) {
if (isset($_GET['category'])) {
$category_id = $_GET['category'];
$main_cats = $this->content_model->get_all_categories('parent', $category_id);
}
}
							
							

                            foreach ($_GET as $get_key => $get_value) {

                                $uristrings = $_SERVER['QUERY_STRING'];
                                $remove_key_value = $get_key . '=' . $get_value;
                                $newuristrings = str_replace($remove_key_value, '', $uristrings);
                                $newuristrings = str_replace('&&', '&', $newuristrings);
                     
                                switch ($get_key) {

                                    case 'page':

                                        $newuristrings = '';
                                        break;

                                    case 'feature_id':
                                        
                                        if (isset($_GET['feature_id'])) {
                                            $get_value = $featurebox_name->name;
                                        }
                                        break;
                                    case 'structure_id':
                                        
                                        if (isset($_GET['structure_id'])) {
                                            $get_value = $structure_name->title;
                                        }
                                        break;
                                    case 'page_id':
                                        
                                        if (isset($_GET['page_id'])) {
                                            $get_value = $page_row->page;
                                        }
                                        break;
                                    case 'category':
                                        
                                        if (isset($_GET['category'])) {
                                            $get_value = $category_row->category;
                                        }
                                        break;
										
										case 'product_type1':
                                        
                                        if (isset($_GET['product_type1'])) {

$product_type1_value = $_GET['product_type1'];
$this->db->where('id', $product_type1_value);
$product_type1_data = $this->db->get('ec_categorytypes')->row();
 $get_value = $product_type1_data->name;
                                        }
                                        break;
										
											case 'product_type2':
                                        
                                        if (isset($_GET['product_type2'])) {

$product_type2_value = $_GET['product_type2'];
$this->db->where('id', $product_type2_value);
$product_type2_data = $this->db->get('ec_categorytypes')->row();
 $get_value = $product_type2_data->name;
                                        }
                                        break;
										
										case 'product_id':
                                        
                                        if (isset($_GET['product_id'])) {

$product_id_value = $_GET['product_id'];
$this->db->where('id', $product_id_value);
$product_id_data = $this->db->get('ec_products')->row();
 $get_value = $product_id_data->prod_name;
                                        }
                                        break;
										
										case 'f_cmc_type':
                                        
                                        if (isset($_GET['f_cmc_type'])) {

$f_cmc_type_value = $_GET['f_cmc_type'];
$this->db->where('id', $f_cmc_type_value);
$f_cmc_type_data = $this->db->get('ec_categorytypes')->row();
 $get_value = $f_cmc_type_data->name;
                                        }
                                        break;
										
																				case 'menu_id':
                                        
                                        if (isset($_GET['menu_id'])) {

$menu_id_value = $_GET['menu_id'];
$this->db->where('id', $menu_id_value);
$menu_id_data = $this->db->get('cms_menu')->row();
 $get_value = $menu_id_data->category;
                                        }
                                        break;
                                        
                                    default:
                                        break;
                                }
             
                                if ($newuristrings !== "") {
                                    ?>
                                    <a class="btn btn-mini btn-primary hide" 
                                       style="margin-right:10px;margin-bottom:5px;"
                                       href="<?php echo base_url() . 'contentadmin/addcontent/?'.$newuristrings; ?>" ><?php echo ucwords($get_value); ?> &nbsp;&nbsp;<span aria-hidden="true" 
                                        class="icomoon-icon-cancel"></span></a>

                                    <?php
                                }
                            }
                            ?> 
 
                            <!--subcategory id--> 
                            <input type="hidden" class="category_id" 
                                   name="category_id" 
                                   value="<?php echo $cont_category_id; ?>"> 


                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <div class="error_messages">

                                            <?php
                                            if (!empty($cat_name_val)) {
                                                $cta_val = $cat_name_val;
                                            } else {
                                                $cta_val = '';
                                            }
                                            ?>
                                            <input type="hidden" value="<?php echo $cta_val; ?>"  class="gl_cat_set_val">
                                        </div>
                                    </div>
                                </div>
                            </div>    
                            <div class="form-row row-fluid  <?php if($avoid_feature_set=="yes"){ echo " hide ";}?>">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span2">Select CMS Type</label>
                                            <div class="span8 controls">   
                                                <select class="gl_cms_type_connection gl_singleselect2 nostyle" name="cms_type" >
                                                    <?php
                                                     
                                                    foreach ($cms_types as $cms_type_conection) {
                                                        ?>
                                                    <option value="<?php echo $cms_type_conection->id;?>"
                                                                <?php
                                                                if (!empty($feature_cms_type)) {
                                                                    if ($feature_cms_type== $cms_type_conection->id) {
                                                                        echo " selected ";
                                                                        
                                                                    }
                                                                }
                                                                ?>
                                                        data-cms-type="<?php echo $cms_type_conection->fixed_type;?>"><?php echo $cms_type_conection->name;?></option>
                                                        <?php
                                                        
                                                    }
                                                    ?>
                                                </select>
                                            </div> 
                                    </div>
                                </div> 
                            </div>
                            <div class=" <?php if($avoid_feature_set=="yes"){ echo " hide ";}?>">
                            <div class="gl_product_data_block hide ">
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span2">Select Product Type 1</label>
                                            <div class="span8 controls">   
                                                <select class="gl_product_type1 gl_singleselect2 nostyle" name="product_type1" >
                                    <option value=''>--Select Product Type1--</option>                
                                                   <?php
                    foreach ($product_type1 as $data_row1) {
                        ?>
                        <option value="<?php echo $data_row1->id; ?>" <?php 
						if(isset($_GET['product_type1']))
						{
							if($_GET['product_type1'] == $data_row1->id)
							{
								echo 'selected';
							}
							
						}
						?> >
                            <?php echo $data_row1->name; ?></option>
                                <?php
                            }
                            ?>
                                                </select>
                                            </div> 
                                        </div>
                                    </div> 
                                </div>
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span2">Select Product Type 2</label>
                                            <div class="span8 controls">   
                                                <select class="gl_product_type2 gl_singleselect2 nostyle" name="product_type2" >
                                                     <option value=''>--Select Product Type2--</option>
                                                   <?php
                    foreach ($product_type2 as $data_row2) {
                        ?>
                        <option value="<?php echo $data_row2->id; ?>" <?php 
						if(isset($_GET['product_type2']))
						{
							if($_GET['product_type2'] == $data_row2->id)
							{
								echo 'selected';
							}
							
						}
						?> >
                            <?php echo $data_row2->name; ?></option>
                                <?php
                            }
                            ?>
                                                </select>
                                            </div> 
                                        </div>
                                    </div> 
                                </div>
                                
                            </div>
                                
                                

                            <div class="gl_product_category hide">
                                <div class="form-row row-fluid ">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span2">Product Category Type</label>
                                            <div class="span8 controls">   
                                                <select id="category_type" class="gl_singleselect2 gl_product_type_load1 nostyle" name="category_type">
                                                   <option value=''>--Select Category Type--</option>
                                                    <?php
                                                    foreach ($category_type_list as $cattype) {
                                                        if ($cattype->fixed_type != 'shop_category') {
                                                            ?>

                                                            <option data-fixed_ctype="<?php echo $cattype->fixed_type; ?>" value="<?php echo $cattype->id; ?>" <?php echo set_select('category_type', $cattype->id); ?>><?php echo $cattype->name; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                            </div>
                                        </div>
                                    </div> 
                                </div>


                            </div>





                            <div class="gl_product_data_content_block hide">

                              <div class="form-row row-fluid">
                                  <div class="span12">
                                        <div class="row-fluid url_wrap">
                                            <label class="form-label span2" for="seo_url">Selecting type</label>
                                            <div class="span2">
                                                <input type="radio" class="gl_select_type" checked="checked" name="select_type" id="select_type1" value="single">
                                                <label for="select_type1" class="sa-right-pull-70">Single</label>  
                                            </div>
                                            <div class="span2">
                                                <input type="radio" class="gl_select_type" name="select_type" id="select_type2" value="multiple">
                                                <label for="select_type2" class="sa-right-pull-70">Multiple</label>  
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <div class="form-row row-fluid">
                                    <div class="span12">
                                      <div class="row-fluid">
                                          <label class="form-label span2">Select Data</label>
                                          <div class="span8 controls gl_product_data_content_block_data_list">   
                                                <select class="gl_singleselect2 gl_product_data_content_block_data nostyle" name="connection_data[]">  
                                              </select>
                                          </div> 
                                      </div>
                                  </div> 
                              </div>      
                                
                                
                            </div>

                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span2">Data Type</label>
                                        <?php
                                        $i = 0;
                                        foreach ($cms_type_array as $key => $value) {
                                            ?> 
                                            <div class="left marginT5 marginR10 <?php
                                            if (!empty($cms_type)) {
                                                if ($cms_type != $value) {
                                                    echo "hide";
                                                }
                                            }
                                            ?>">
                                                <input type="radio" <?php
                                                if (!empty($cms_type)) {
                                                    if ($cms_type == $value) {
                                                        echo "checked";
                                                    }
                                                } elseif ($cms_typ_val == $value) {
                                                    echo "checked";
                                                } elseif ($i == 0) {
                                                    echo "checked";
                                                }
                                                ?> class="gl_cms_type" name="typename" value="<?php echo $value; ?>"/> 
                                                       <?php echo ucwords(str_replace("_", " ", $value)); ?>
                                            </div>
                                            <?php
                                            $i++;
                                        }
                                        ?>                                

                                    </div>
                                </div> 
                            </div> 
                            </div>
                            
                           
                                
                            <div class="form-row row-fluid  <?php //echo $this->common_model->admin_or_super_admin();?>">
                                <div class="span12 parent_checker">
                                    <label class="form-label span2">Category</label>

                                    <?php if ($category_id != '') { ?>

                                        <ul class="main_categrory tree span10" >

                                            <?php
                                            $i = 0;

                                            foreach ($main_cats as $parent) {
                                                $cid = $parent->id;
                                                ?>
                                                <li class="main_cat gl_cat_div">
                                                    <div class="row-fluid">
                                                        <div class="span12">
                                                            <?php
                                                            $check = $this->content_model->check_subcategories($cid);
                                                            if ($check == 0) {
                                                                ?>
                                                                <input type="radio" 
                                                                       name="cat" 
                                                                       id="cat<?php echo $cid . '_' . $i; ?>" 
                                                                       value="<?php echo $cid; ?>" 
                                                                       class="cat_left_radio sa_item_cat gl_cat_val"
                                                                       data-url="<?php echo $this->content_model->arr_reverse($parent->categoryslugtree); ?>"
                                                                       data-typ="<?php echo $parent->type; ?>"
                                                                       data-content_url_status="<?php echo $parent->content_seo_url_status;?>"
                                                                       >  
                                                                   <?php }
                                                                   ?>
                                                            <label class="label label-success left" for="cat<?php echo $cid . '_' . $i; ?>"><?php echo ucwords($parent->category); ?></label>
                                                        </div>
                                                    </div>
                                                    <div class="sub_category">
                                                        <?php
                                                        $catidtree = '';
                                                        $subcategories = $this->content_model->get_main_subcategories_tree($cid, 1, $catidtree, $parent->type, $cta_val);
                                                        ?>
                                                    </div>
                                                </li>
                                                <?php
                                                $i++;
                                            }
                                            ?>

                                        </ul>

                                    <?php } else { ?>

                                        <ul class="main_categrory tree span10" >

                                            <?php
                                            $i = 0;

                                            foreach ($main_categories as $parent) {
                                                $cid = $parent->id;
//                                                    $ctype = $parent->ctype; 
                                                ?>
                                                <li class="main_cat gl_cat_div">
                                                    <div class="row-fluid">
                                                        <div class="span12">
                                                            <?php
                                                            $check = $this->content_model->check_subcategories($cid);
                                                            if ($check == 0) {
                                                                ?>
                                                                <input type="radio" 
                                                                       name="cat" 
                                                                       id="cat<?php echo $cid . '_' . $i; ?>" 
                                                                       value="<?php echo $cid; ?>" <?php
                                                                       if ($cta_val == $cid) {
                                                                           echo "checked";
                                                                       }
                                                                       ?> 
                                                                       class="cat_left_radio sa_item_cat gl_cat_val"
                                                                       data-url="<?php echo $this->content_model->arr_reverse($parent->categoryslugtree); ?>" data-typ="<?php echo $parent->type; ?>">  
                                                                   <?php }
                                                                   ?>
                                                            <label class="label label-success left" for="cat<?php echo $cid . '_' . $i; ?>"><?php echo ucwords($parent->category); ?></label>
                                                        </div>
                                                    </div>
                                                    <div class="sub_category">
                                                        <?php
                                                        $catidtree = '';
                                                        $subcategories = $this->content_model->get_main_subcategories_tree($cid, 1, $catidtree, $parent->type, $cta_val);
                                                        ?>
                                                    </div>
                                                </li>
                                                <?php
                                                $i++;
                                            }
                                            ?>

                                        </ul>

                                        <?php
                                    }
                                    ?>


                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span2" for="normal">Unique Identifier</label>
                                        <input class="span8 slug_ref" id="catname" type="text" name="catname" value="<?php echo set_value('catname'); ?>" required />
                                        <span class="error">
                                            <?php echo form_error('catname'); ?>
                                            <?php 
											if (isset($_GET['feature_id'])) {
											echo form_error('route');
											}
											
											 ?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row row-fluid gl_cat_content_url_block">
                                <div class="span12">
                                    <div class="row-fluid url_wrap">
                                        <label class="form-label span2" for="seo_url">URL Type</label>
                                        <div class="span2">
                                            <input type="radio" class="url_type gl_url_type_seo"  name="url_type" id="seo_url" value="seo_url">
                                            <label for="seo_url" class="sa-right-pull-70">SEO URL</label>  
                                        </div>
                                        <div class="span2">
                                            <input type="radio" class="url_type gl_url_type_force" name="url_type" id="force_url" value="force_url">
                                            <label for="force_url" class="sa-right-pull-70">Force URL</label>  
                                        </div>
                                        <div class="span2">
                                            <input type="radio" class="url_type gl_url_type_auto" name="url_type" id="auto_url" value="auto_url">
                                            <label for="auto_url" class="sa-right-pull-70">Auto URL</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid gl_cat_content_url_block">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span2" for="route">SEO Friendly URL<b style="color:#F00; font-size:11px;">*</b></label>
                                        <span style="font-size:11px;" class="sa_base_url_section"><?php echo base_url(); ?></span> 
                                        <span style="font-size:11px;" class="sa_remain_url_section"></span> 
                                        <input class="span6 read-slug slug_url_val" readonly id="route" type="text" name="route" value="<?php echo set_value('route'); ?>" required/>
                                        <span class="right manipTxt slugShow"><a onclick="slugShow()" class="icomoon-icon-pencil">Write Mode On</a></span>
                                        <span class="right manipTxt slugHide" style="display: none;"><a onclick="slugHide()" class="icomoon-icon-link-5">Write Mode Off</a></span>
                                        <span class="error">
                                            <?php echo form_error('route'); ?>
                                        </span>
                                    </div>
                                </div>
                                <input type="hidden" name="full_url_sec" class="sa_remain_url_section_input1">
                            </div>

                           


                            <div class="form-row row-fluid <?php echo $this->common_model->admin_or_super_admin();?>">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span2" for="quick_link">Make Quick Link</label>
                                        <div class="left marginT5 marginR10">
                                            <label  for="quick_link">
                                                <input  type="checkbox" id="quick_link" name="quick_link"  class="gl_quick_link"  value="yes" />
                                            </label>
                                        </div>
                                        <div class="left marginT5 marginR10">
                                            <input disabled="" style="width: 150%;" class="span8 gl_quick_link_name" id="quick_link_name"  type="text" name="quick_link_name" value="" >
                                        </div>

                                    </div>
                                </div>
                            </div>





                            <div class="form-row row-fluid  <?php echo $this->common_model->admin_or_super_admin();?>">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span2" for="active_status">Activate Content</label>
                                        <div class="span9 controls">
                                            <div class="left marginT5 marginR10">
                                                <input type="radio" name="active_status" id="active_status1" value="a" <?php
                                                if (isset($_POST['active_status'])) {
                                                    if ($_POST['active_status'] == 'a')
                                                        echo 'checked';
                                                }
                                                else {
                                                    echo 'checked';
                                                }
                                                ?> />
                                                Active
                                            </div>
                                            <div class="left marginT5 marginL10">
                                                <input type="radio" name="active_status" id="active_status2" value="d" <?php
                                                if (isset($_POST['active_status'])) {
                                                    if ($_POST['active_status'] == 'd')
                                                        echo 'checked';
                                                }
                                                ?> />
                                                Deactivate
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                            
                           




                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">


                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">

                                <input type="hidden" name="content_title" id="content_title" />
                                <input type="hidden" name="content_short_title" id="content_short_title" /> 
                                <input type="hidden" name="content_short_description" id="content_short_description" />
                                <input type="hidden" id="cms_type_val" class="cms_type_val" value="" />
                                <button type="submit" class="btn btn-info pull-right showhide-btn" onclick="saveOrder();">Save & Continue</button>

                            </div>


                        </form>
                    </div>

                </div><!-- End .box -->

            </div><!-- End .span6 --><!-- End .span6 --><!-- End .span6 -->


        </div><!-- End .row-fluid --><!-- End .row-fluid --><!-- End .row-fluid --><!-- End .row-fluid -->





    </div><!-- End contentwrapper -->
</div>
<?php
if ($this->session->flashdata('message')) {
    ?>
    <script type="text/javascript">
        $(document).ready(function () {
            //Regular success

            $.pnotify({
                type: 'success',
                title: '<?php echo $this->session->flashdata('message'); ?>',
                text: '',
                icon: 'picon icon16 iconic-icon-check-alt white',
                opacity: 0.95,
                history: false,
                sticker: false
            });

        });
    </script>
    <?php
}
?> 
    
<?php
if (!empty($message)) {
    ?>
<script type="text/javascript">
        $(document).ready(function () {
            //Regular success
    
            $.pnotify({
                type: 'success',
                title: '<?php echo $message; ?>',
                text: '',
                icon: 'picon icon16 iconic-icon-check-alt white',
                opacity: 0.95,
                history: false,
                sticker: false
            });

        });
    </script>
    <?php
}
?> 
    
<script type="text/javascript">
    
    $(document).ready(function(){
        detail_page_select_show();
    });
$('.gl_content_detail_page_wrp').on('change', '.gl_custom_content_detail_status', function () {

        detail_page_select_show();

    });
function detail_page_select_show() {

        var content_detail_status = $('.gl_custom_content_detail_status:checked').val();

        if (content_detail_status == 'yes') {
            $('.gl_content_detail_list_wrp').show();
        } else if (content_detail_status == 'no') {
            $('.gl_content_detail_list_wrp').hide();
        }
    }
</script>

<script>
    $(function () {
        $('#toggle-one').bootstrapToggle();

        $('#toggle-one').on('change', function () {

            if ($("#toggle-one").is(':checked')) {

                $('.internal_area').show();
                $('.url_area').hide();
                $('.url_text').prop('required', false);
                $('.customlink').val('internal');
                $('.url_text').val('');

            } else {

                $('.internal_area').hide();
                $('.url_area').show();
                $('.url_text').prop('required', true);
                $('.pages').prop('required', false);
                $('.menus').prop('required', false);
                $('.slug').prop('required', false);
                $('.page_item').parent('span').removeClass('checked');
                $('.menu_item').parent('span').removeClass('checked');
                $('.slug_item').parent('span').removeClass('checked');
                $('.page_area').hide();
                $('.menu_area').hide();
                $('.slug_area').hide();
                $('.customlink').val('external');
                $('.slug').val('');
                $('.menus').val('');
                $('.pages').val('');


            }
        });

    });

    function page_item() {

        $('.page_area').show();
        $('.menu_area').hide();
        $('.slug_area').hide();
        $('.pages').prop('required', true);
        $('.menus').prop('required', false);
        $('.slug').prop('required', false);
    }

    function menu_item() {

        $('.page_area').hide();
        $('.menu_area').show();
        $('.slug_area').hide();
        $('.pages').prop('required', false);
        $('.menus').prop('required', true);
        $('.slug').prop('required', false);
    }

    function slug_item() {

        $('.page_area').hide();
        $('.menu_area').hide();
        $('.slug_area').show();
        $('.pages').prop('required', false);
        $('.menus').prop('required', false);
        $('.slug').prop('required', true);
    }
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(window).load(function () {
            $('.cat_left_radio').parents('.radio').removeClass('radio');
            $('.cat_left_radio').parent().css("float", "left");
        });

//        $('.parent_checker').find('input[type=radio]').filter(':visible:first').prop('checked', true);
        $('.parent_checker1').find('input[type=radio]').filter(':visible:first').prop('checked', true);

    });

</script>      



<?php
if (isset($_GET['feature_id'])) {
    ?>

    <script>

        $(document).ready(function () {

            var item = $('.category_id').val();
            if (item != '')
            {
                $('.sa_item_cat').each(function () {

                    var cat_id = $(this).val();

                    if (item === cat_id)
                    {
                        $(this).prop('checked', 'true');
                        $(this).hide();
                        $('.sa_item_cat').not(this).attr('disabled', true);
                    } else
                    {
                        $(this).removeAttr('checked');
                    }

                });
            }

        });

    </script>

<?php } ?>


<script type="text/javascript">
    $(document).ready(function () {

        var type_val = $(".gl_cms_type:checked").val();
        var cat_set_val1 = $(".gl_cat_set_val").val();
        var fin_img_val = $("#gl_image_upload1-final_images").val();
        var cat_set_val_arr = [];

        get_option_cats(type_val, cat_set_val1);

        if (type_val == 'image') {
            if (fin_img_val == '') {
                $(".gl_uploadimage").prop("required", true);
            }
        } else {
            $(".gl_uploadimage").prop("required", false);
        }

        $("body").on("change", ".gl_cms_type", function () {
            var cat_set_val2 = '';
            var type = $(this).val();
            get_option_cats(type, cat_set_val2);

            if (type == 'image') {
                if (fin_img_val == '') {
                    $(".gl_uploadimage").prop("required", true);
                }
            } else {
                $(".gl_uploadimage").prop("required", false);
            }
        });

        function get_option_cats(type, cat_set_val) {
            cat_set_val_arr.push(cat_set_val);

            var i = 0;
            $(".gl_cat_val").each(function () {
                var catval = $(this).attr("data-typ");
                if (type !== catval) {
                    $(this).parents(".gl_cat_div").hide();
                } else {
                    if (cat_set_val == '') {
                        if (cat_set_val_arr[0] == $(this).val()) {
                            $(this).prop("checked", true);
                        } else if (i == 0) {
                            $(this).prop("checked", true);
                        }
                    }
                    $(this).parents(".gl_cat_div").show();
                    i++;
                }

            });
        }

    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        var icon_type_val = $(".icon_type:checked").val();
//        alert(icon_type_val);  
        if(icon_type_val == 'icon_class'){
            $(".gl_icon_class").removeClass("hide");
            $(".gl_icon_image").addClass("hide");
        }else if(icon_type_val == 'icon_html'){
            $(".gl_icon_html").removeClass("hide");
            $(".gl_icon_image").addClass("hide");
        }
    });  
    

    $("body").on("change", ".gl_cms_type_connection", function () {
        var cms_type_fixed = $(".gl_cms_type_connection option:selected").attr("data-cms-type");
        autoSelectCmsType(cms_type_fixed);
        urlConfigCmsType(cms_type_fixed);
    });
    
    $(document).ready(function () {
        var cms_type_fixed = $(".gl_cms_type_connection option:selected").attr("data-cms-type");
        autoSelectCmsType(cms_type_fixed);
        urlConfigCmsType(cms_type_fixed);

    });
    
    $("body").on("change",".gl_product_type1",function(){
            productDataLoad(); 
    });
    $("body").on("change",".gl_product_type2",function(){
            productDataLoad(); 
    });
    
    function urlConfigCmsType(cms_type_fixed){

        $('.gl_url_type_auto').prop('checked', true);
        $('.gl_url_type_seo').prop('checked', false);
        $(".sa_base_url_section").hide();
        $(".sa_remain_url_section").hide();
        if(cms_type_fixed=="cms_normal"){
           $('.gl_url_type_auto').prop('checked', false);
           $('.gl_url_type_seo').prop('checked', true);
           $(".sa_base_url_section").show();
           $(".sa_remain_url_section").show();
        }
        
        $.uniform.update('.url_type');
    }
    
    function autoSelectCmsType(cms_type_fixed){
        switch(cms_type_fixed){
                case 'cms_product':
                    
                $(".gl_product_data_block").removeClass("hide");
                $(".gl_product_category").addClass("hide");

                $('.gl_product_type1').prop('required', true);
                $('.gl_product_type2').prop('required', true);
                $('.gl_product_data_content_block_data').prop('required', true);
                $('.gl_product_type_load1').prop('required', false);

            productDataLoad(); 
                    break;
                case 'cms_product_category':

                $(".gl_product_category").removeClass("hide");
            $(".gl_product_data_block").addClass("hide");
                $(".gl_product_data_content_block").removeClass("hide");

                $('.gl_product_type_load1').prop('required', true);
                $('.gl_product_data_content_block_data').prop('required', true);
                $('.gl_product_type1').prop('required', false);
                $('.gl_product_type2').prop('required', false);
                 productDataLoad(); 
                    break;
                case 'cms_page':
                $(".gl_product_data_block").addClass("hide");
                    $(".gl_product_category").addClass("hide");
                    $('.gl_product_data_content_block_data').prop('required', true);
                    get_page_list();
                    break; 
                case 'cms_menu':
                $(".gl_product_data_block").addClass("hide");
                    $(".gl_product_category").addClass("hide");
                    $('.gl_product_data_content_block_data').prop('required', true);
                    get_menu_list();
                    break;    
                default:
                    $(".gl_product_data_block").addClass("hide");
            $(".gl_product_data_content_block").addClass("hide");
                $(".gl_product_category").addClass("hide");

                $('.gl_product_type1').prop('required', false);
                $('.gl_product_type2').prop('required', false);
                $('.gl_product_type_load1').prop('required', false);
                $('.gl_product_data_content_block_data').prop('required', false);
                    break;
        }  
         
    }

    function productDataLoad() {
//        $(".gl_product_data_block").removeClass("hide");
      //  $("div.gl_product_data_content_block_data").find("ul li.select2-search-choice").remove();
        var cms_type_fixed=$(".gl_cms_type_connection option:selected").attr("data-cms-type");
        var product_type1=$(".gl_product_type1 option:selected").val();
        var product_type2=$(".gl_product_type2 option:selected").val();
		var product_id=$(".product_id").val();
        var base_url = $(".base_url").val(); 

        if(typeof cms_type_fixed!="undefined" && typeof cms_type_fixed!="" &&
           typeof product_type1!="undefined" && typeof product_type1!="" && 
           typeof product_type2!="undefined" && typeof product_type2!=""){
       
       
            var dataString = {cms_type: cms_type_fixed, 
                                product_type1: product_type1,
                                product_type2: product_type2,
								product_id: product_id};
            $.ajax({
                type: "POST",
                url: base_url + "contentadmin/loadProductData",
                data: dataString,
                cache: false,
                success: function (response)
                {
                   $(".gl_product_data_content_block").removeClass("hide");
                   $(".gl_product_data_content_block_data_list").find('select').html(response);
            $(".gl_product_data_content_block_data").select2("destroy");

$(".gl_product_data_content_block_data").select2();         
                }
            }); 
        }
    }

    
    
    

    $(document).ready(function () {

        $('#category_type').on('change', function () {

            $('#parentname').attr("disabled", true);
            var ctype = $(this).val();

            getcatlist(ctype);
        });




        $('.gl_select_type').click(function () {

            var select_type = $(this).val();
            if (select_type == 'single')
            {
                $('.gl_product_data_content_block_data').prop("multiple", false);
                $(".gl_product_data_content_block_data").select2("destroy");
                $(".gl_product_data_content_block_data").select2();
            } else if (select_type == 'multiple')
            {
                $('.gl_product_data_content_block_data').prop("multiple", true);
                $(".gl_product_data_content_block_data option[value='']").remove();
                $(".gl_product_data_content_block_data").select2("destroy");
                $(".gl_product_data_content_block_data").select2();
            }

        })


    });


    function getcatlist(ctype)
    {



        $.ajax({
            url: "<?php echo base_url() . 'contentadmin/getcatlist/'; ?>",
            data: {ctype: ctype},
            type: "POST",
            success: function (response)
            {
                $(".gl_product_data_content_block").removeClass("hide");
                $(".gl_product_data_content_block_data_list").find('select').html(response);
                $(".gl_product_data_content_block_data").select2("destroy");

                $(".gl_product_data_content_block_data").select2();

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

function get_page_list() {
        
       var feature_id= "<?php
       if(isset($_GET['feature_id']) && !empty($_GET['feature_id'])){
           echo $_GET['feature_id'];
       }else{
          echo ""; 
       }?>";
       var page_id= "<?php
       if(isset($_GET['page_id']) && !empty($_GET['page_id'])){
           echo $_GET['page_id'];
       }else{
          echo ""; 
       }?>";
        $.ajax({
            url: "<?php echo base_url() . 'contentadmin/get_page_list/'; ?>",
            data: {feature_id:feature_id,page_id:page_id },
            type: "POST",
            success: function (response)
            {
                $(".gl_product_data_content_block").removeClass("hide");
                $(".gl_product_data_content_block_data_list").find('select').html(response);
                $(".gl_product_data_content_block_data").select2("destroy");

                $(".gl_product_data_content_block_data").select2();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }
    function get_menu_list() {
		
		var menu_id=$(".menu_id").val();
		
		var dataString = {menu_id: menu_id,};

        $.ajax({
            url: "<?php echo base_url() . 'contentadmin/get_menu_list/'; ?>",
            data: dataString,
            type: "POST",
            success: function (response)
            {
                $(".gl_product_data_content_block").removeClass("hide");
                $(".gl_product_data_content_block_data_list").find('select').html(response);
                $(".gl_product_data_content_block_data").select2("destroy");

                $(".gl_product_data_content_block_data").select2();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }


    $(document).ready(function(){
       var catcontent_url_status= $(".gl_cat_val:checked").attr("data-content_url_status");
       seoblockhideshow(catcontent_url_status);
       $("body").on("change",".gl_cat_val",function(){
          var catcontent_url_status= $(this).attr("data-content_url_status");
           seoblockhideshow(catcontent_url_status); 
       });
           
           
    });
    function seoblockhideshow(catcontent_url_status){
         $(".gl_cat_content_url_block").hide();
        if(catcontent_url_status=="yes"){
            $(".gl_cat_content_url_block").show();
        }
            
    }
</script>

