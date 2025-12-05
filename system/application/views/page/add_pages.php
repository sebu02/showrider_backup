<?php
$pagename="";
$pageroute="";
 if (!empty($_GET['ptype']) && !empty($_GET['pcat'])) {
    $pcat_current_id= $_GET['pcat'];
    $ptype_current_id= $_GET['ptype'];
    $category=$this->page_model->GetByRow("ec_category", $pcat_current_id, "id"); 
    $category_types = $this->page_model->GetByRow("ec_categorytypes", $ptype_current_id, "id");

    $pagename=strtolower($category->category.'-'.$category_types->name);
    $pageroute=$this->page_model->clean_name($pagename);
 }
?>


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
                            <span>Add Page Details</span>
                        </h4>

                    </div>
                    <div class="content">

                        <form class="form-horizontal gl_multiple_upload_form multiple_upload_form" action="<?php echo base_url() . 'pageadmin/add_pages?' . $_SERVER["QUERY_STRING"]; ?>" method="post" enctype="multipart/form-data" >
                            
                                <?php
                                $category_page_hide_show="";
                            if (!empty($_GET['ptype'])) {
                                $category_page_hide_show=" hide ";
                                ?>
                                <div class="span12">  
                                    <?php
                                    $ptypes = explode('-', $_GET['ptype']);
                                    array_pop($ptypes);
                                    if (!empty($ptypes[0])) {
                                        $current_id = $ptypes[0];
                                        $current_data = $this->page_model->GetByRow("ec_categorytypes", $current_id, "id");
                                        ?> <div class="span6">
                                            <strong> Now create page </strong>
                                            <?php echo "<a class='btn btn-primary btn-mini'>" . $current_data->name . "</a>"; ?>
                                        </div>   
                                    <?php
                                    }
                                    array_shift($ptypes);
                                    if (!empty($ptypes)) {
                                        ?>
                                        <div class="span6">
                                            <strong> To be created pages </strong>                                                  <?php
                                            foreach ($ptypes as $ptype) {
                                                $to_data = $this->page_model->GetByRow("ec_categorytypes", $ptype, "id");
                                                echo " <a class='btn btn-warning btn-mini'>" . $to_data->name . "</a>";
                                            }
                                            ?>
                                        </div>
                                        <?php }
                                    ?>
                                </div>
                            <?php }
                            ?>
                            
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <div class="error_messages">


                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="normal">Page Name</label>
                                        <input class="span8 slug_ref" id="page" type="text" name="page"  value="<?php echo $pagename; ?>"  />
                                        <span class="error">
<?php echo form_error('page'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid  <?php echo $this->common_model->admin_or_super_admin();?>">
                                <div class="span12">
                                    <div class="row-fluid url_wrap">
                                        <label class="form-label span3" for="seo_url">URL Type</label>
                                        <div class="span3">
                                            <input type="radio" class="url_type" checked="checked" name="url_type" id="seo_url" value="seo_url">
                                            <label for="seo_url" class="sa-right-pull-70">SEO URL</label>  
                                        </div>
                                        <div class="span3">
                                            <input type="radio" class="url_type" name="url_type" id="force_url" value="force_url">
                                            <label for="force_url" class="sa-right-pull-70">Force URL</label>  
                                        </div>
                                        <div class="span3">
                                            <input type="radio" class="url_type" name="url_type" id="auto_url" value="auto_url">
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
                                        <input class="span6 read-slug  slug_url_val" readonly type="text" name="slug"  value="<?php echo $pageroute; ?>" required />
                                        <span class="right manipTxt slugShow"><a onclick="slugShow()" class="icomoon-icon-pencil">Write Mode On</a></span>
                                        <span class="right manipTxt slugHide" style="display: none;"><a onclick="slugHide()" class="icomoon-icon-link-5">Write Mode Off</a></span>
                                        <span class="error">
<?php echo form_error('slug'); ?>
                                        </span>
                                    </div>
                                </div>
                                <input type="hidden" name="full_url_sec" class="sa_remain_url_section_input">
                            </div>
                            <div class="title <?php echo $this->common_model->admin_or_super_admin();?> ">
                                <h4> 
                                    <span>Security Settings</span>
                                </h4>
                            </div>
                            <div class="form-row row-fluid  <?php echo $this->common_model->admin_or_super_admin();?>">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span3" for="secure">Secure</label>
                                        <div class="span9 controls">
                                            <div class="left marginT5">
                                                <input type="radio" name="secure" id="secure2" value="off" <?php
                                                if (isset($_POST['secure'])) {
                                                    if ($_POST['secure'] == 'off')
                                                        echo 'checked';
                                                } else {
                                                    echo 'checked';
                                                }
                                                ?> />
                                                Off
                                            </div>
                                            <div class="left marginT5">
                                                <input type="radio" name="secure" id="secure1" value="on" <?php
                                                if (isset($_POST['secure'])) {
                                                    if ($_POST['secure'] == 'on')
                                                        echo 'checked';
                                                }
                                                ?> />
                                                On
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="form-row row-fluid <?php echo $this->common_model->admin_or_super_admin();?>">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span3" for="login_requirement">Login requirement</label>
                                        <div class="span9 controls">
                                            <div class="left marginT5">
                                                <input type="radio" name="login_requirement" id="login_requirement1" value="off" <?php
                                                if (isset($_POST['login_requirement'])) {
                                                    if ($_POST['login_requirement'] == 'off')
                                                        echo 'checked';
                                                } else {
                                                    echo 'checked';
                                                }
                                                ?> >
                                                Off
                                            </div>
                                            <div class="left marginT5">
                                                <input type="radio" name="login_requirement" id="login_requirement2" value="on" <?php
                                                if (isset($_POST['login_requirement'])) {
                                                    if ($_POST['login_requirement'] == 'on')
                                                        echo 'checked';
                                                }
                                                ?> >
                                                On
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="title <?php echo $this->common_model->admin_or_super_admin();?>">
                                <h4> 
                                    <span>Other Settings</span>
                                </h4>
                            </div>

<?php $default_combo_list = json_decode($this->common_model->option->default_combo_list, TRUE); ?>


                            <div class="form-row row-fluid <?php echo $this->common_model->admin_or_super_admin();?> ">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="combo">Select File Property</label>
                                        <div class="span8 controls comboset">  
                                            <select name="combo" id="combo" class="combo" data-imageid="gl_image_upload1">
                                                <?php
                                                foreach ($values as $combos) {
                                                    ?>
                                                    <option data-pref='<?php echo $combos->preferences; ?>' data-manip='<?php echo $combos->manipulation_status; ?>' value="<?php echo $combos->fid; ?>" <?php
                                                    if (isset($_POST['combo'])) {
                                                        if ($_POST['combo'] == $combos->fid) {
                                                            echo 'selected';
                                                        }
                                                    } elseif (!empty($default_combo_list['page_banner'])) {
                                                        if ($default_combo_list['page_banner'] == $combos->fid) {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?> ><?php echo $combos->combo_name; ?></option>
                                                            <?php
                                                        }
                                                        ?>

                                            </select>
                                        </div>
                                        <span class="error">
<?php echo form_error('combo'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>




                            <div class="form-row row-fluid  <?php echo $this->common_model->admin_or_super_admin();?>">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="normal">Banner Picture</label>
                                        <input  type="file" data-formclass='gl_multiple_upload_form' data-formtype="add" data-controller="pageadmin" data-manipulation data-maxsize data-preference="" data-uploadtype="single" data-imageid="gl_image_upload1"  class="gl_image_upload1 gl_uploadimage ngo_proof_attach_input_file  span8" name="images[]" id="images" data-input_name="images" data-combo_name="combo">

                                        <input type="hidden" class="file_input_name" name="file_input_name" value="">
                                        <input type="hidden" class="combo_name" name="combo_name" value="">

                                        <div class="upload_note span12">
                                            <span class="span4"></span> 
                                            <span class="span8">Size:Below&nbsp;<span class="gl_image_upload1-textSize"></span>  MB for each file<span class="dimensions">, width:&nbsp;<span class="gl_image_upload1-textWidth"></span> px, Height:&nbsp;<span class="gl_image_upload1-textHeight"></span> px</span></span> <span class="manipTxt"><a onclick="manipToggle('gl_image_upload1')">Show Manipulations</a></span>
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









                            <div class="form-row row-fluid <?php echo $this->common_model->admin_or_super_admin();?>">
                                <div class="span12">
                                    <div class="row-fluid url_wrap">
                                        <label class="form-label span4" for="normal_page">Page Type</label>
                                        <div class="span8 controls">
                                            <div class="marginT5">
                                                <label>
                                                    <input type="radio" class="normal_page page_type" 
                                                       checked="checked" name="page_type"
                                                       id="normal_page" value="normal_page">
                                                Normal Page</label>  
                                            </div>
                                            <div class=" marginT5 <?php echo $category_page_hide_show;?>">
                                               <label> <input type="radio" class="header_page page_type" 
                                                       name="page_type" 
                                                       id="header_page" value="header_page">
                                                Header Page</label>  
                                            </div>
                                            <div class=" marginT5 <?php echo $category_page_hide_show;?>"><label>
                                                <input type="radio" class="header_sub_page page_type" 
                                                       name="page_type" 
                                                       id="header_sub_page" value="header_sub_page">
                                               Header Sub Page</label>
                                            </div>
                                            <div class=" marginT5 <?php echo $category_page_hide_show;?>"><label>
                                                <input type="radio" class="footer_page page_type" name="page_type" 
                                                       id="footer_page" value="footer_page">
                                                Footer Page</label>
                                            </div>
                                            <div class=" marginT5 <?php echo $category_page_hide_show;?>">
                                                <label>
                                                <input type="radio" class="footer_sub_page page_type" name="page_type" 
                                                       id="footer_sub_page" value="footer_sub_page">
                                                Footer Sub Page</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="normal_page_section">
                                <div class="form-row row-fluid <?php echo $this->common_model->admin_or_super_admin();?>">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="header_page_drop">Header</label>
                                            <div class="span8 controls">
                                                <select id="header_page_drop" name="header_page"  class="pagetypes">
                                                <option value="">Select Header</option>
                                                    <?php
                                                    if ($header != NULL) {
                                                        foreach ($header as $head) {
                                                            ?>
                                                            <option value="<?php echo $head->id; ?>" <?php
                                                            if ($head->default_page == 'yes') {
                                                                echo 'selected';
                                                            }
                                                            ?> data-default="<?php echo $head->default_page ;?>">
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
                                <div class="form-row row-fluid <?php echo $this->common_model->admin_or_super_admin();?>">
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
                                                            <option value="<?php echo $header_sub->id; ?>" <?php
                                                            if ($header_sub->default_page == 'yes') {
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
                                <div class="form-row row-fluid <?php echo $this->common_model->admin_or_super_admin();?>">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="footer_page_drop">Footer</label>
                                            <div class="span8 controls">  
                                                <select id="footer_page_drop"  name="footer_page" class="pagetypes">
                                                <option value="">Select Footer</option>
                                                    <?php
                                                    if ($footer != NULL) {
                                                        foreach ($footer as $foot) {
                                                            ?>
                                                            <option value="<?php echo $foot->id; ?>" <?php
                                                            if ($foot->default_page == 'yes') {
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
                                <div class="form-row row-fluid <?php echo $this->common_model->admin_or_super_admin();?>">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="footer_sub_page_drop">Top Footer</label>
                                            <div class="span8 controls">  
                                                <select id="footer_sub_page_drop"  name="footer_sub_page"  class="pagetypes">
                                                     <option value="">Select Top Footer</option>
                                                     <?php
                                                    if ($footer_sub_page != NULL) {
                                                        foreach ($footer_sub_page as $footer_sub) {
                                                            ?>
                                                                                                                                                                    <option value="<?php echo $footer_sub->id; ?>"    
                                                                    <?php
                                                            if ($footer_sub->default_page == 'yes') {
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


                            <div class="form-row row-fluid header_footer_section <?php echo $this->common_model->admin_or_super_admin();?>">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="default_page">Make It Default</label>
                                        <div class="marginT5">
                                            <input class="span8" type="checkbox" id="default_page" name="default_page"  value="yes"  />
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-row row-fluid <?php echo $this->common_model->admin_or_super_admin();?> ">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="quick_link">Make Quick Link</label>
                                        <div class="left marginT5 marginR10">
                                            <label  for="quick_link">
                                                <input type="checkbox" id="quick_link" name="quick_link"  class="gl_quick_link"  value="yes" />
                                            </label>
                                        </div>
                                        <div class="left marginT5 marginR10">
                                            <input disabled="" style="width: 150%;" class="span8 gl_quick_link_name" id="quick_link_name"  type="text" name="quick_link_name" value="" >
                                        </div>
                                    </div>
                                </div>
                            </div>    


                            <div class="form-row row-fluid <?php echo $this->common_model->admin_or_super_admin();?>">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="make_cache">Make It Cache</label>
                                        <div class="marginT5">
                                            <input class="span8" type="checkbox" 
                                                   id="make_cache" name="make_cache" 
                                                   value="yes"  />
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="title <?php echo $this->common_model->admin_or_super_admin();?> ">
                                <h4> 
                                    <span>Theme Class for Page</span>
                                </h4>
                            </div>
                            <div class="form-row row-fluid  <?php echo $this->common_model->admin_or_super_admin();?>">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="page_theme_class">Theme Class</label>
                                        <textarea class="span8 elastic" id="page_theme_class" rows="1" name="page_theme_class"></textarea>
                                        <span class="error">
<?php echo form_error('page_theme_class'); ?>
                                        </span>
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
                                        <textarea class="span8 elastic" id="textarea1" rows="3"  name="title" required ></textarea>
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
                                        <textarea class="span8 elastic" id="textarea1" rows="3"  name="description" required ></textarea>
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
                                            <input id="tags"  name="keywords" type="text" style="width:100%;" required />
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
                                <button type="submit" class="btn btn-info showhide-btn" >Submit</button>

                            </div>


                        </form>
                    </div>
                </div>

            </div><!-- End .box -->

        </div><!-- End .span6 --><!-- End .span6 --><!-- End .span6 -->


    </div><!-- End .row-fluid --><!-- End .row-fluid --><!-- End .row-fluid --><!-- End .row-fluid -->





</div><!-- End contentwrapper -->
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
            if(page_type=="header_sub_page" || page_type=="footer_sub_page"){
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