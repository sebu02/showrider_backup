<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->

        <div class="heading">

            <h3>Manage Page Details</h3>                    



        </div><!-- End .heading-->

        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

        <div class="row-fluid">

            <div class="span6" style="width:70%; margin-left:15%;">

                <div class="box">

                    <div class="title">

                        <h4> 
                            <span>Edit Page Details</span>
                        </h4>

                    </div>
                    <div class="content">

                        <form class="form-horizontal gl_multiple_upload_form multiple_upload_form" action="<?php echo base_url() . 'pageadmin/edit_pages/' . $meta_details->id.'?'.$_SERVER['QUERY_STRING']; ?>" method="post" enctype="multipart/form-data" >
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <div class="error_messages">



                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <?php  
                            $category_page_hide_show="";
                            if($meta_details->special_page_type=="connection_page"){
                                $category_page_hide_show=" hide ";
                            }
                           if (isset($_GET['copy'])) {
                                $random_code = $this->common_model->get_rand_alphanumeric(3);
                                $page_slug = $meta_details->slug . $random_code;
                                $page_name = $meta_details->page . $random_code;
                                
                            } else {
                                $page_slug = $meta_details->slug;
                                $page_name = $meta_details->page;
                            } 
                           ?> 
                           
<?php
if (isset($_GET['copy'])) {
?>
                           <div class="title">
                                <h4> 
                                    <span>Copy page</span>
                                </h4>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="secure">Page Creation Type</label>
                                        <div class="span8 controls">
                                            <div class="left marginT5">
<input type="radio" class="gl_pagecopytype" name="pagecopytype" id="pagecopytype1" value="new"  checked />
                                                New Page
                                            </div>
                                            <div class="left marginT5 ">
<input type="radio" class="gl_pagecopytype" name="pagecopytype" id="pagecopytype1" value="exist"   />
                                                Overwrite With Existing Page
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
   
   
   <div class="form-row row-fluid gl_pages_list_wrp" style="display:none;">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" >Pages List</label>
                                            <div class="span8 controls">  
                                                <select id="exist_page_id" name="exist_page_id" class="gl_singleselect2 nostyle">
                                                    <option value="" >--Select Page--</option>
                                                    <?php
                                                    foreach ($all_pages as $page_row) {
                                                        ?>
                                                        <option value="<?php echo $page_row->id; ?>" ><?php echo $page_row->page; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                </select>
                                                
                                                <span class="span8" style="color:#DF080C;">NB : All Child pages will be deleted and insert copied</span>
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>                         
                            
                            
<?php
}
?>

<div class="title">
                                <h4> 
                                    <span>Page Info</span>
                                </h4>
                            </div>
                            

                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="normal">Page Name</label>
                                        <input class="span8 slug_ref" id="page" type="text" name="page"  value="<?php echo $page_name; ?>" required />
                                        <span class="error">
                                            <?php echo form_error('page'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            

                            <div class="form-row row-fluid <?php echo $this->page_model->admin_or_super_admin();?>">
                                <div class="span12">
                                    <div class="row-fluid url_wrap">
                                        <label class="form-label span3" for="seo_url">URL Type</label>
                                        <div class="span3">
                                            <input type="radio" class="url_type" <?php if ($meta_details->slug_type == 'seo_url') { ?>checked="checked"<?php } ?> name="url_type" id="seo_url" value="seo_url">
                                            <label for="seo_url" class="sa-right-pull-70">SEO URL</label>  
                                        </div>
                                        <div class="span3">
                                            <input type="radio" class="url_type" <?php if ($meta_details->slug_type == 'force_url') { ?>checked="checked"<?php } ?> name="url_type" id="force_url" value="force_url">
                                            <label for="force_url" class="sa-right-pull-70">Force URL</label>  
                                        </div>
                                        <div class="span3">
                                            <input type="radio" class="url_type" <?php if ($meta_details->slug_type == 'auto_url') { ?>checked="checked"<?php } ?> name="url_type" id="auto_url" value="auto_url">
                                            <label for="auto_url" class="sa-right-pull-70">Auto URL</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="normal">SEO Friendly URL</label>
                                        <span style="font-size:11px;" class="sa_base_url_section"><?php echo base_url(); ?></span> 
                                        <span style="font-size:11px;" class="sa_remain_url_section"></span> 
                                        <input class="span6 read-slug slug_url_val" readonly id="slug" type="text" name="slug"  value="<?php echo $page_slug; ?>" required />
                                        <span class="right manipTxt slugShow"><a onclick="slugShow()" class="icomoon-icon-pencil">Write Mode On</a></span>
                                        <span class="right manipTxt slugHide" style="display: none;"><a onclick="slugHide()" class="icomoon-icon-link-5">Write Mode Off</a></span>
                                        <span class="error">
                                            <?php echo form_error('slug'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="title <?php echo $this->page_model->admin_or_super_admin();?>">
                                <h4> 
                                    <span>Security Settings</span>
                                </h4>
                            </div>
                            <div class="form-row row-fluid <?php echo $this->page_model->admin_or_super_admin();?>">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="secure">Secure</label>
                                        <div class="span8 controls">
                                            <div class="left marginT5">
                                                <input type="radio" name="secure" id="secure2" value="off" <?php
                                                if ($meta_details->secure == 'off') {
                                                    echo 'checked';
                                                }
                                                ?> />
                                                Off
                                            </div>
                                            <div class="left marginT5 ">
                                                <input type="radio" name="secure" id="secure1" value="on" <?php
                                                if ($meta_details->secure == 'on') {
                                                    echo 'checked';
                                                }
                                                ?> />
                                                On
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid <?php echo $this->page_model->admin_or_super_admin();?>">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="login_requirement">Login Requirement</label>
                                        <div class="span8 controls">
                                            <div class="left marginT5">
                                                <input type="radio" name="login_requirement" id="login_requirement2" value="off" <?php
                                                if (!empty($meta_details->login_requirement)) {
                                                    if ($meta_details->login_requirement == 'off') {
                                                        echo 'checked';
                                                    }
                                                } else {
                                                    echo 'checked';
                                                }
                                                ?> >
                                                Off
                                            </div>
                                            <div class="left marginT5 ">
                                                <input type="radio" name="login_requirement" id="login_requirement1" value="on" <?php
                                                if ($meta_details->login_requirement == 'on') {
                                                    echo 'checked';
                                                }
                                                ?> >
                                                On
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="title <?php echo $this->page_model->admin_or_super_admin();?>">
                                <h4> 
                                    <span>Other Settings</span>
                                </h4>
                            </div>
                            <?php
                            $banner_seo_alt = ''; $banner_seo_title = '';
                            $banner = json_decode($meta_details->page_banner);
                            
                            if(!empty($banner[0]->seo_alt)){ $banner_seo_alt = $banner[0]->seo_alt; }
                            if(!empty($banner[0]->seo_title)){ $banner_seo_title = $banner[0]->seo_title; }
                                                            
                            if ($banner != '') {                                
                                if ($banner[0]->image != '') {
                                    ?>

                                    <div class="form-row row-fluid ">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span4" for="normal">Current Structure</label>
                                                <img  class="span4"  src="<?php echo base_url() . 'media_library/' . $banner[0]->image; ?>" />  
                                                <input type="hidden" name="mediaID" value="<?php echo $banner[0]->media_id; ?>" >
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                }
                                ?>  

                                <?php
//                                $image_seo = $this->common_model->GetByRow_notrash('cms_media', $banner[0]->media_id, 'id');
//                                $image_seo_details = json_decode($image_seo->images, true);
                                ?>

                                <div class="form-row row-fluid <?php echo $this->page_model->admin_or_super_admin();?>">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="seo_alt">SEO Alt <b style="color:#F00; font-size:11px;">*</b></label>
                                            <textarea class="span8 elastic tinymce" id="seo_alt"  name="seo_alt"  required /><?php echo $banner_seo_alt; ?></textarea>
                                            <span class="error">
                                                <?php echo form_error('seo_alt'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row row-fluid <?php echo $this->page_model->admin_or_super_admin();?>">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="seo_title">SEO Title <b style="color:#F00; font-size:11px;">*</b></label>
                                <textarea class="span8 elastic tinymce" id="seo_title"  name="seo_title"  required /><?php echo $banner_seo_title; ?></textarea>
                                            <span class="error">
                                                <?php echo form_error('seo_title'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>



                                <div class="form-row row-fluid <?php echo $this->page_model->admin_or_super_admin();?>">
                                    <div class="span12">
                                        
                                        
                                        <div class="row-fluid combo-currentCombo">
                                            <label class="form-label span4" for="normal">File Property</label>
                                            <?php
                                            foreach ($values as $combos) {


                                                if ($banner[0]->combo == $combos->fid) {
                                                    ?>
                                                    <input class="span8" readonly value="<?php echo $combos->combo_name; ?>"  />
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                        
                                        
                                        <span class="manipTxt combo-findAllcombo"><a onclick="allComboshow('combo')">Show/ Change All File Properties</a></span>
                                        
                                        
                                        <div class="row-fluid combo-comboSection" style="display: none">
                                            <label class="form-label span4" for="combo">Select File Property</label>
                                            <div class="span8 controls comboset">  
                                                <select name="combo" id="combo" class="combo" data-imageid="gl_image_upload1">
                                                    <?php
                                                    foreach ($values as $combos) {
//                                                    if ($combos->manipulation_status == 'Yes') { // (IMG_MANIPULATION_COMBO) when need all combos remove this condition
                                                        ?>
                                                        <option data-pref='<?php echo $combos->preferences; ?>' data-manip='<?php echo $combos->manipulation_status; ?>' <?php
                                                        if ($banner[0]->combo == $combos->fid) {
                                                            echo 'selected';
                                                        }
                                                        ?> value="<?php echo $combos->fid; ?>" <?php
                                                                if (isset($_POST['combo'])) {
                                                                    if ($_POST['combo'] == $combos->fid) {
                                                                        echo 'selected';
                                                                    }
                                                                }
                                                                ?> ><?php echo $combos->combo_name; ?></option>
                                                                <?php
                                                            }

//                                                    } 
                                                            ?>

                                                </select>
                                            </div>
                                            <span class="error">
                                                <?php echo form_error('combo'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>


                                <?php
                            } else {
                                ?>

                                <div class="form-row row-fluid <?php echo $this->page_model->admin_or_super_admin();?>">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="combo">Select File Property</label>
                                            <div class="span8 controls comboset">  
                                                <select name="combo" id="combo" class="combo" data-imageid="gl_image_upload1">
                                                    <?php
                                                    foreach ($values as $combos) {
//                                                    if ($combos->manipulation_status == 'Yes') { // (IMG_MANIPULATION_COMBO) when need all combos remove this condition
                                                        ?>
                                                        <option data-pref='<?php echo $combos->preferences; ?>' data-manip='<?php echo $combos->manipulation_status; ?>' value="<?php echo $combos->fid; ?>" <?php
                                                        if (isset($_POST['combo'])) {
                                                            if ($_POST['combo'] == $combos->fid) {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?> ><?php echo $combos->combo_name; ?></option>
                                                                <?php
                                                            }

//                                                } 
                                                            ?>

                                                </select>
                                            </div>
                                            <span class="error">
                                                <?php echo form_error('combo'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            <?php }
                            ?>




                            <div class="form-row row-fluid <?php echo $this->page_model->admin_or_super_admin();?>">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="normal">Banner Picture</label>
                                        
                                        <input  type="file" data-formclass='gl_multiple_upload_form' data-formtype="edit" data-controller="pageadmin" data-manipulation data-maxsize data-preference="" data-uploadtype="single" data-imageid="gl_image_upload1"  class="gl_image_upload1 gl_uploadimage ngo_proof_attach_input_file  span8" name="images[]" id="images" data-input_name="images" data-combo_name="combo">
                                        
                                        <input type="hidden" class="file_input_name" name="file_input_name" value="">
                                        <input type="hidden" class="combo_name" name="combo_name" value="">
                                        
                                        <div class="upload_note span12">
                                            
                                            <span class="span4"></span> 
                                            <span class="span8">Size:Below&nbsp;<span class="gl_image_upload1-textSize"></span>  MB for each file<span class="dimensions">, width:&nbsp;<span class="gl_image_upload1-textWidth"></span> px, Height:&nbsp;<span class="gl_image_upload1-textHeight"></span> px</span></span>
                                            <span class="manipTxt"><a onclick="manipToggle('gl_image_upload1')">Show Manipulations</a></span>
                                        </div>
                                        <div class="ImageManipulation gl_image_upload1-ImageManipulation">
                                        </div>
                                        <div class="preloader5">
                                            <span class="gl_image_upload1-uploading" style="display:none;text-align: center;"><img src="<?php echo base_url(); ?>static/adminpanel/images/loaders/horizontal/018.gif" alt="" style="display: block;margin: 0 auto;"/></span>
                                        </div>
                                        <span id="gl_image_upload1-output"></span>
                                        <ul class="gl_image_upload1-image1 add_new_image1 sortable" id="sortable" data-img_id="gl_image_upload1"></ul>
                                        <input type="hidden" name="final_images" value="<?php echo set_value('final_images'); ?>" id="gl_image_upload1-final_images">
                                    </div>
                                </div>
                            </div>




                            <div class="form-row row-fluid <?php echo $this->page_model->admin_or_super_admin();?>">
                                <div class="span12">
                                    <div class="row-fluid url_wrap">
                                        <label class="form-label span4" for="normal_page">Page Type</label>
                                        <div class="span8 controls">
                                            <div class="marginT5">
                                                  <label>
                                                <input type="radio" class="normal_page page_type" 
                                                <?php
                                                if ($meta_details->page_type == 'normal_page') {
                                                    echo "checked";
                                                }
                                                ?>
                                                       name="page_type" id="normal_page" 
                                                       value="normal_page">
                                                Normal Page</label>  
                                            </div>
                                            <div class="marginT5 <?php echo $category_page_hide_show;?>">
                                                  <label>
                                                <input type="radio" class="header_page page_type"
                                                <?php
                                                if ($meta_details->page_type == 'header_page') {
                                                    echo "checked";
                                                }
                                                ?>
                                                       name="page_type" 
                                                       id="header_page" value="header_page">
                                                Header Page</label>  
                                            </div>
                                             <div class="marginT5 <?php echo $category_page_hide_show;?>">
                                                   <label>
                                                <input type="radio" class="header_sub_page page_type" 
                                                        <?php
                                                if ($meta_details->page_type == 'header_sub_page') {
                                                    echo "checked";
                                                }
                                                ?>
                                                       name="page_type" 
                                                       id="header_sub_page" value="header_sub_page">
                                               Header Sub Page</label>
                                            </div>
                                            <div class="marginT5 <?php echo $category_page_hide_show;?>">
                                                  <label>
                                                <input type="radio" class="footer_page page_type" name="page_type"
                                                <?php
                                                if ($meta_details->page_type == 'footer_page') {
                                                    echo "checked";
                                                }
                                                ?>
                                                       id="footer_page" value="footer_page">
                                            Footer Page</label>
                                            </div>
                                            <div class="marginT5 <?php echo $category_page_hide_show;?>">
                                                  <label>
                                                <input type="radio" class="footer_sub_page page_type" name="page_type" 
                                                        <?php
                                                if ($meta_details->page_type == 'footer_sub_page') {
                                                    echo "checked";
                                                }
                                                ?>
                                                       id="footer_sub_page" value="footer_sub_page">
                                              Footer Sub Page</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

<?php
//                            if ($meta_details->page_type == 'normal_page') {
//                                echo 'style="display:block"';
//                            } else if ($meta_details->page_type == 'header_page' ||
//                                    $meta_details->page_type == 'footer_page') {
//                                echo 'style="display:none"';
//                            }
                            ?>

                            <div class="normal_page_section " >
                                <div class="form-row row-fluid <?php echo $this->page_model->admin_or_super_admin();?>">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="header_page_drop">Header</label>
                                            <div class="span8 controls">
                                                <select id="header_page_drop"  name="header_page" class="pagetypes" >
                                                <option value="">Select Header</option>
                                                    <?php
                                                    if ($header != NULL) {
                                                        foreach ($header as $head) {
                                                            ?>
                                                            <option value="<?php echo $head->id; ?>" 
                                                            <?php
                                                            if ($meta_details->header_id == $head->id) {
                                                                echo 'selected';
                                                            }
                                                            ?> data-default="<?php echo $head->default_page ;?>" >
                                                                        <?php echo $head->page; ?>
                                                            </option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <span class="error">
                                                <?php echo form_error('header_page'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row row-fluid <?php echo $this->page_model->admin_or_super_admin();?>">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="header_sub_page_drop">Bottom Header</label>
                                            <div class="span8 controls">
                                                <select id="header_sub_page_drop" name="header_sub_page" class="pagetypes" >
                                                    <option value="">Select Bottom Header</option>
                                                    <?php
                                                    if ($header_sub_page != NULL) {
                                                        foreach ($header_sub_page as $header_sub) {
                                                            ?>
                                                            <option value="<?php echo $header_sub->id; ?>" 
                                                             <?php
                                                            if ($meta_details->header_sub_id == $header_sub->id) {
                                                                echo 'selected';
                                                            }
                                                            ?> data-default="<?php echo $header_sub->default_page ;?>" >
                                                            <?php echo $header_sub->page; ?>
                                                            </option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <span class="error">
                                                <?php echo form_error('header_sub_page'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row row-fluid <?php echo $this->page_model->admin_or_super_admin();?>">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="footer_page_drop">Footer</label>
                                            <div class="span8 controls">  
                                                <select id="footer_page_drop"  name="footer_page" class="pagetypes" >
                                                <option value="">Select Footer</option>
                                                    <?php
                                                    if ($footer != NULL) {
                                                        foreach ($footer as $foot) {
                                                            ?>
                                                            <option value="<?php echo $foot->id; ?>" 
                                                            <?php
                                                            if ($meta_details->footer_id == $foot->id) {
                                                                echo 'selected';
                                                            }
                                                            ?> data-default="<?php echo $foot->default_page ;?>" >
                                                                        <?php echo $foot->page; ?>
                                                            </option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <span class="error">
                                                <?php echo form_error('footer_page'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row row-fluid <?php echo $this->page_model->admin_or_super_admin();?>">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="footer_sub_page_drop">Top Footer</label>
                                            <div class="span8 controls">  
                                                <select id="footer_sub_page_drop"  name="footer_sub_page" class="pagetypes" >
                                                     <option value="">Select Top Footer</option>
                                                    <?php
                                                    if ($footer_sub_page != NULL) {
                                                        foreach ($footer_sub_page as $footer_sub) {
                                                            ?>
                                                            <option value="<?php echo $footer_sub->id; ?>"
<?php
                                                            if ($meta_details->footer_sub_id == $footer_sub->id) {
                                                                echo 'selected';
                                                            }
                                                            ?> data-default="<?php echo $footer_sub->default_page ;?>" >
                                                            <?php echo $footer_sub->page; ?>
                                                            </option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <span class="error">
<?php echo form_error('footer_sub_page'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <?php
                            $quick_link_type='page';
                            $content_id=$meta_details->id;
                            $quick_link_details=$this->common_model->get_quick_links($quick_link_type,$content_id);
                            
                            $checked='';
                            if(!empty($quick_link_details))
                            {
                            if($quick_link_details->active_status=='a')
                            {
                                $checked='checked';
                            }
                            }
                            
                            ?>
                                
                                
                            <div class="form-row row-fluid <?php echo $this->page_model->admin_or_super_admin();?>">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="quick_link">Make Quick Link</label>
                                        <div class="left marginT5 marginR10">
                                            <label  for="quick_link">
                                                <input type="checkbox" id="quick_link" name="quick_link" <?php echo $checked; ?> class="gl_quick_link"  value="yes" />
                                            </label>
                                        </div>
                                        <div class="left marginT5 marginR10">
                                            <input style="width: 150%;" class="span8 gl_quick_link_name" id="quick_link_name" <?php if ($checked == '') {
                                echo 'disabled';
                            } ?>  type="text" name="quick_link_name"  value="<?php if (!empty($quick_link_details)) {
                                echo $quick_link_details->url_name;
                            } ?>" >
                                        </div>
                                    </div>
                                </div>
                            </div>   
                            

                            <div class="form-row row-fluid header_footer_section" 
                            <?php
                            if ($meta_details->page_type == 'normal_page') {
                                echo 'style="display:none"';
                            } else if ($meta_details->page_type == 'header_page' || $meta_details->page_type == 'footer_page') {
                                echo 'style="display:block"';
                            }
                            ?>>
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="default_page">Make It Default</label>
                                        <div class="marginT5">
                                            <input class="span8" 
                                                   type="checkbox" 
                                                   id="default_page" 
                                                   name="default_page" 
                                                   <?php
                                                   if ($meta_details->default_page == 'yes') {
                                                       echo "checked";
                                                   }
                                                   ?>
                                                   value="yes"  />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="form-row row-fluid <?php echo $this->page_model->admin_or_super_admin();?>">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="make_cache">Make It Cache</label>
                                        <div class="marginT5">
                                            <input class="span8" type="checkbox" 
                                                   <?php
                                                   if ($meta_details->make_cache == 'yes') {
                                                       echo "checked";
                                                   }
                                                   ?>
                                                   id="make_cache" name="make_cache"  value="yes"  />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="title <?php echo $this->page_model->admin_or_super_admin();?>">
                                <h4> 
                                    <span>Theme Class for Page</span>
                                </h4>
                            </div>
                                <div class="form-row row-fluid <?php echo $this->page_model->admin_or_super_admin();?>">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="page_theme_class">Theme Class</label>
                                        <textarea class="span8 elastic" id="page_theme_class" rows="1" name="page_theme_class"><?php echo $meta_details->page_theme_class; ?></textarea>
                                        <span class="error">
                                            <?php echo form_error('page_theme_class'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="title <?php echo $this->page_model->admin_or_super_admin();?>">
                                <h4> 
                                    <span>Admin Level Permissions</span>
                                </h4>
                            </div>
                            <div class="form-row row-fluid <?php echo $this->page_model->admin_or_super_admin();?>">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="secure">Show For Superadmin Only</label>
                                        <div class="span8 controls">
                                            <div class="left marginT5">
                                                <input type="radio" name="showsuper" id="showsuper1" value="yes" <?php
                                                if ($meta_details->showsuper == 'yes') {
                                                    echo 'checked';
                                                }
                                                ?> />
                                                For Super Admin Only
                                            </div>
                                            <div class="left marginT5 ">
                                                <input type="radio" name="showsuper" id="showsuper2" value="no" <?php
                                                if ($meta_details->showsuper == 'no') {
                                                    echo 'checked';
                                                }
                                                ?> />
                                                For All Admins
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="title">
                                <h4> 
                                    <span>Basic On-Page Seo Settings</span>
                                </h4>
                            </div>

                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="textarea">Page Title</label>
                                        <textarea class="span8 elastic" id="textarea1" rows="3" required name="title"><?php echo $meta_details->title; ?></textarea>
                                        <span class="error">
                                            <?php echo form_error('title'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="textarea">Meta Description</label>
                                        <textarea class="span8 elastic" id="textarea1" rows="3" required name="description"><?php echo $meta_details->description; ?></textarea>
                                        <span class="error">
                                            <?php echo form_error('description'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="tags">Meta Keywords</label>
                                        <div class="span8 controls">
                                            <input id="tags" required name="keywords" type="text" value="<?php echo $meta_details->keywords; ?>" style="width:100%;" />
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
                                <button type="submit" class="btn btn-info showhide-btn">Submit</button>

                            </div>


                        </form>
                    </div>
                </div>

            </div><!-- End .box -->

        </div><!-- End .span6 --><!-- End .span6 --><!-- End .span6 -->


    </div><!-- End .row-fluid --><!-- End .row-fluid --><!-- End .row-fluid --><!-- End .row-fluid -->





</div><!-- End contentwrapper -->
</div>


<script type="text/javascript">

    $("#url").keyup(function () {

        var string = $("#url").val();
        var string = string.replace(/\//g, '');

        $("#url").val(string);

    });

</script>

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

    <script type="text/javascript">
        
        $(document).ready(function(){
            
            var page_type= $(".page_type:checked").val();
            page_type_hide_show(page_type);
            
            $("body").on("change",".page_type",function(){
               var page_type= $(this).val();
               page_type_hide_show(page_type);
			   switch_btwn_types();
            });
        });
        
        
  function page_type_hide_show(page_type){
            $(".normal_page_section").show();
            $(".header_footer_section").hide();
            if(page_type=="header_sub_page" || page_type=="footer_sub_page" || page_type == 'header_page' || page_type == 'footer_page'){
                $(".normal_page_section").hide();
                $(".header_footer_section").show();
            }
        }

function switch_btwn_types()
{
$(".pagetypes option[value='']").attr('selected', 'selected');	

var page_type = $(".page_type:checked").val();

if(page_type == 'normal_page')
{

	$(".pagetypes").each(function() {
		
	$(this).find("option[data-default='yes']").attr('selected', 'selected');		
		
	});

}

$.uniform.update();
	
	
}		
		
		
    </script>
    
    
    <script type="text/javascript">
  $(document).ready(function(){  
  
 $('body').on('click', '.gl_pagecopytype', function () {
	 

var pagecopytype = $(this).val();

        if (pagecopytype == 'exist') {
            $('.gl_pages_list_wrp').show();
			
			$('.gl_pages_list_wrp').find('select').prop('required',true);
			
			
        } else if (pagecopytype == 'new') {
			
            $('.gl_pages_list_wrp').hide();
			
			$('.gl_pages_list_wrp').find('select').prop('required',false);
			
        }
	 
       
    });
	

	
  });
</script>
