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

            <div class="span12" >

                <div class="box">

                    <div class="title">

                        <h4> 
                            <span>Edit Content</span>
                        </h4>
                    </div>
                    <!--<div class="content">-->
                    <div class="content noPad clearfix">

                        <div class="msg"></div>
                        <div class="wizard-steps clearfix show">

                            <a class="wstep current" data-step-num="0" href="<?php echo base_url() . 'contentadmin/editcontent/' . $images->id . '/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/?' . $_SERVER['QUERY_STRING']; ?>">
                                <div class="donut">1</div>
                                <span class="txt">STEP 1</span>
                            </a>
                            <?php 
                            $newKey = 2;
                             
                                if (!empty($wizard_row->product_wizard)) {
                                    $product_wizards = json_decode($wizard_row->product_wizard, TRUE);
                                    $wizard_group = json_decode($wizard_row->wizard_group, TRUE);
//                                    $wizard_group_attributes = json_decode($wizard_row->wizard_group_attributes, TRUE);
                                } else {

                                    $product_wizards = NULL;
                                }


                                
                                if ($product_wizards != NULL) {
                                    foreach ($product_wizards as $key =>
                                                $prod_wizard) {
                                        $wizard_use_status = $this->content_model->findID_exist($wizard_group, 'wizard_item', $prod_wizard['order']);
                                        if ($wizard_use_status == 'yes') {
                                            ?>
                                            <a class=" wstep " href="<?php echo base_url() . 'contentadmin/dynamic_wizards/' . $images->id . '/' . $wizard_id . '/' . $prod_wizard['order'] . '/?' . $_SERVER['QUERY_STRING']; ?>">
                                                <div class="donut"><?php echo $newKey; ?></div>
                                                <span class="txt"> STEP <?php echo $newKey; ?></span>
                                            </a> 
                                            <?php
                                            $newKey++;
                                        }
                                    }
                                }
                           
                            
                            
                            
                            
                            
//                            if($fixedcommoninput_status == false){
//                               $newKey = 2; 
//                            }
//                            
                            
                            
                            /*if  ($fixedcommoninput_status == true) { ?>
                                <a class="wstep " data-step-num="0" href="<?php echo base_url() . 'contentadmin/editcontent2/' . $images->id . '/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/?' . $_SERVER['QUERY_STRING']; ?>">
                                    <div class="donut">2</div>
                                    <span class="txt">STEP 2</span>
                                </a>
<?php } /**/?>
                           

                        </div>
                        <div class="content">

                            <form class="form-horizontal multiple_upload_form gl_multiple_upload_form" action="<?php echo base_url() . 'contentadmin/editcontent/' . $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/?' . $_SERVER['QUERY_STRING']; ?>" method="post" enctype="multipart/form-data" >
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <div class="error_messages">



                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $avoid_feature_set="";
                            if (isset($_GET['feature_id'])) {
                                $avoid_feature_set="yes";
                            }
                            ?>
                                <div class="form-row row-fluid <?php if($avoid_feature_set=="yes"){ echo " hide ";}?>">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span2">Select CMS Type</label>
                                            <div class="span8 controls">   
                                                <select class="gl_cms_type_connection gl_singleselect2 nostyle" name="cms_type" >
                                                    <?php
                                                    foreach ($cms_types as
                                                                $cms_type_conection) {
                                                        ?>
                                                        <option 

                                                            <?php
                                                            if ($images->cms_type == "$cms_type_conection->id") {
                                                                echo " selected ";
                                                            }
                                                            ?>
                                                            value="<?php echo $cms_type_conection->id; ?>"
                                                            data-cms-type="<?php echo $cms_type_conection->fixed_type; ?>"><?php echo $cms_type_conection->name; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                </select>
                                            </div> 
                                        </div>
                                    </div> 
                                </div>
                                <div class="gl_product_data_block hide">
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span2">Select Product Type 1</label>
                                                <div class="span8 controls">   
                                                    <select class="gl_product_type1 gl_singleselect2 nostyle" name="product_type1" >
                                                        <?php
                                                        foreach ($product_type1 as
                                                                    $data_row1) {
                                                            ?>
                                                            <option value="<?php echo $data_row1->id; ?>"          <?php
                                                            if ($images->product_type1 == $data_row1->id) {
                                                                echo " selected ";
                                                            }
                                                            ?>>
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
                                                    <select class="gl_product_type2 gl_singleselect2 nostyle" name="product_type2">
                                                        <?php
                                                        foreach ($product_type2 as
                                                                    $data_row2) {
                                                            ?>
                                                            <option value="<?php echo $data_row2->id; ?>" <?php
                                                            if ($images->product_type2 == $data_row2->id) {
                                                                echo " selected ";
                                                            }
                                                            ?>>
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
                                                        <option value="" >--Select--</option>

                                                        <?php
                                                        foreach ($category_type_list as
                                                                    $cattype) {
                                                            if ($cattype->fixed_type != 'shop_category') {
                                                                ?>

                                                                <option data-fixed_ctype="<?php echo $cattype->fixed_type; ?>" value="<?php echo $cattype->id; ?>"  <?php
                                                                        if ($images->product_category_type == $cattype->id) {
                                                                            echo " selected ";
                                                                        }
                                                                        ?> ><?php echo $cattype->name; ?></option>
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
                                                    <input type="radio" class="gl_select_type" name="select_type" id="select_type1" value="single" 
                                                    <?php
                                                    if (!empty($images->selecting_type)) {
                                                        if ($images->selecting_type == 'single') {
                                                            echo 'checked';
                                                        }
                                                    } else {
                                                        echo 'checked';
                                                    }
                                                    ?>

                                                           >
                                                    <label for="select_type1" class="sa-right-pull-70">Single</label>  
                                                </div>
                                                <div class="span2">
                                                    <input type="radio" class="gl_select_type" name="select_type" id="select_type2" value="multiple" 
                                                    <?php
                                                           if ($images->selecting_type == 'multiple') {
                                                               echo 'checked';
                                                           }
                                                           ?>>
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

                                                    <select class="gl_singleselect2 gl_product_data_content_block_data nostyle"name="connection_data[]"
                                                    <?php
                                                            if ($images->selecting_type == 'multiple') {
                                                                echo 'multiple';
                                                            }
                                                            ?>> 

                                                        <?php
                                                        $categoryidtree = explode('+', $images->connection_data);
                                                        array_pop($categoryidtree);
                                                        array_shift($categoryidtree);

                                                        $category_list = $this->content_model->showcategory_classi($images->product_category_type);

                                                        if ($category_list != NULL) {
                                                            foreach ($category_list as
                                                                        $cat) {
                                                                ?>

                                                                <option data-url="<?php echo $this->content_model->arr_reverse($cat['categoryslugtree']); ?>"                                                                     value="<?php echo $cat['id']; ?>"
                                                                        data-ctype="<?php echo $cat['ctype']; ?>"
                                                                        <?php
                                                                        if (in_array($cat['id'], $categoryidtree)) {
                                                                            echo "selected";
                                                                        }
                                                                        ?> ><?php echo $cat['name']; ?></option>   
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



                                <div class="form-row row-fluid <?php if($avoid_feature_set=="yes"){ echo " hide ";}?>">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span2">CMS Type</label>
                                            <?php
                                            $cat_set_val = '';
                                            $i = 0;
                                            foreach ($cms_type_array as $key =>
                                                        $value) {
                                                ?> 
                                                <div class="left marginT5 marginR10">
                                                    <input type="radio" <?php
                                                if ($images->type == $value) {
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

                                <?php
                                if (isset($_GET['feature_id'])) {
                                    if (isset($_GET['category'])) {
                                        $category_id = $_GET['category'];
                                        $main_categories = $this->content_model->get_all_categories('parent', $category_id);
                                    }
                                }
                                ?> 


                                <div class="form-row row-fluid <?php //echo $this->common_model->admin_or_super_admin(); ?>">
                                    <div class="span12 parent_checker">
                                        <label class="form-label span2">Category</label>
                                        <ul class="main_categrory tree span10" >

                                            <?php
                                            $i = 0;
                                            foreach ($main_categories as $parent) {
                                                $cid = $parent->id;
                                                $categoryidtree = $images->category_tree;
                                                if ($categoryidtree != '') {
                                                    $cat_ids = explode('+', $categoryidtree);
                                                    array_shift($cat_ids);
                                                    array_pop($cat_ids);
                                                }
                                                ?>
                                                <li class="main_cat gl_cat_div">
                                                    <div class="row-fluid">
                                                        <div class="span12">
                                                            <?php
                                                            $check = $this->content_model->check_subcategories($cid);
                                                            if ($check == 0) {
                                                                ?>
                                                                <input type="radio" name="cat" 
                                                                <?php
                                                                if (isset($cat_ids)) {
                                                                    if ($cat_ids != NULL) {
                                                                        if ($cat_ids[0] == $cid) {
                                                                            echo 'checked="checked"';
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                                       id="cat<?php echo $cid . '_' . $i; ?>" 
                                                                       value="<?php echo $cid; ?>" 
                                                                       class="cat_left_radio sa_item_cat gl_cat_val hide"
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
    $subcategories = $this->content_model->get_main_subcategories_tree($cid, 1, $categoryidtree, $parent->type, $cat_set_val);
    ?>
                                                    </div>
                                                </li>
                                                <?php
                                                $i++;
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>





                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span2" for="normal">Unique Identifier</label>
                                            <input class="span8 slug_ref" id="catname" type="text" name="catname" value="<?php echo $images->title; ?>" required />
                                            <span class="error">
<?php echo form_error('catname'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row row-fluid gl_cat_content_url_block">
                                    <div class="span12">
                                        <div class="row-fluid url_wrap">
                                            <label class="form-label span2" for="seo_url">URL Type</label>
                                            <div class="span2">
                                                <input type="radio" class="url_type gl_url_type_seo" <?php if ($images->slug_type == 'seo_url') { ?>checked="checked"<?php } ?> name="url_type" id="seo_url" value="seo_url">
                                                <label for="seo_url" class="sa-right-pull-70">SEO URL</label>  
                                            </div>
                                            <div class="span2">
                                                <input type="radio" class="url_type gl_url_type_force" <?php if ($images->slug_type == 'force_url') { ?>checked="checked"<?php } ?> name="url_type" id="force_url" value="force_url">
                                                <label for="force_url" class="sa-right-pull-70">Force URL</label>  
                                            </div>
                                            <div class="span2">
                                                <input type="radio" class="url_type gl_url_type_auto" <?php if ($images->slug_type == 'auto_url') { ?>checked="checked"<?php } ?> name="url_type" id="auto_url" value="auto_url">
                                                <label for="auto_url" class="sa-right-pull-70">Auto URL</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="full_url_sec" value="<?php echo $images->full_slug; ?>" class="sa_remain_url_section_input1">

                                <div class="form-row row-fluid gl_cat_content_url_block">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span2" for="route">SEO Friendly URL<b style="color:#F00; font-size:11px;">*</b></label>
                                            <span style="font-size:11px;" class="sa_base_url_section"><?php echo base_url(); ?></span> 
                                            <span style="font-size:11px;" class="sa_remain_url_section"></span> 
                                            <input class="span6 read-slug slug_url_val" readonly id="route" type="text" name="route" value="<?php echo $images->route; ?>" required/>
                                            <span class="right manipTxt slugShow"><a onclick="slugShow()" class="icomoon-icon-pencil">Write Mode On</a></span>
                                            <span class="right manipTxt slugHide" style="display: none;"><a onclick="slugHide()" class="icomoon-icon-link-5">Write Mode Off</a></span>
                                            <span class="error">
<?php echo form_error('slug'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>



                                <?php
                                $quick_link_type = 'content';
                                $content_id = $images->id;
                                $quick_link_details = $this->common_model->get_quick_links($quick_link_type, $content_id);

                                $checked = '';
                                if (!empty($quick_link_details)) {
                                    if ($quick_link_details->active_status == 'a') {
                                        $checked = 'checked';
                                    }
                                }
                                ?>


                                <div class="form-row row-fluid <?php echo $this->common_model->admin_or_super_admin(); ?>">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span2" for="quick_link">Make Quick Link</label>
                                            <div class="left marginT5 marginR10">
                                                <label  for="quick_link">
                                                    <input type="checkbox" id="quick_link" name="quick_link" <?php echo $checked; ?> class="gl_quick_link"  value="yes" />
                                                </label>
                                            </div>
                                            <div class="left marginT5 marginR10">
                                                <input style="width: 150%;" class="span8 gl_quick_link_name" id="quick_link_name" <?php
                                                if ($checked == '') {
                                                    echo 'disabled';
                                                }
                                                ?> type="text" name="quick_link_name"  value="<?php
                                                       if (!empty($quick_link_details)) {
                                                           echo $quick_link_details->url_name;
                                                       }
                                                       ?>" >
                                            </div>
                                        </div>
                                    </div>
                                </div>    





                                <div class="form-row row-fluid <?php echo $this->common_model->admin_or_super_admin(); ?>">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span2" for="active_status">Activate Content</label>
                                            <div class="span9 controls">
                                                <div class="left marginT5 marginR10">
                                                    <input type="radio" name="active_status" id="active_status1" value="a" <?php
                                                    if ($images->active_status == 'a') {
                                                        echo 'checked';
                                                    }
                                                    ?> />
                                                    Active
                                                </div>
                                                <div class="left marginT5 marginL10">
                                                    <input type="radio" name="active_status" id="active_status2" value="d" <?php
                                                    if ($images->active_status == 'd') {
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
                                    <button type="submit" class="btn btn-info pull-right showhide-btn" onclick="saveOrder()">Save & Continue</button>

                                </div>


                            </form>
                            <!--</div>-->
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

        $(document).ready(function () {
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
        });
    </script>    

<!--<script type="text/javascript">




    //      file order save function
    function savejsonOrder() {
//              debugger;
        /* To save Packages and recommended and Key features,FAQ question and answer  in json format */

        saveOrder_key_features();
        debugger;
        saveOrder_faq_question_answer();
        saveOrder_packages();
//        debugger;
//        saveOrder_recommend();

        /* EOF To save Packages and recommended  in json format */
    }










    $(document).ready(function ()
    {
        /*For Content title */
        var first_a = $(".data_value_key").first();
        var firsta_a = first_a.find('a[class~="remove_source"]');
        firsta_a.hide();

        var wrapper_a = $("#main_key"); //Fields wrapper   

        $("#add_key").click(function (e)
        {
            e.preventDefault();


            var newid = 1;
            $("#main_key div.data_value_key").each(function () {
                if (parseInt($(this).data("id")) > newid) {
                    newid = parseInt($(this).data("id"));
                }
                newid++;
                //debugger;
            });



            var current = $(".data_value_key").last();
            var cloned = current.clone();
            cloned.find('input,textarea').val('');
            cloned.find('a[class~="remove_source"]').show();
            cloned.find('label[class~="key_feature_label"]').text('');
            cloned.attr("id", newid);
            cloned.insertAfter(current);

            var first = $(".data_value_key").first();
            first.find('a[class~="remove_source"]').hide();


        });

        $(wrapper_a).on("click", ".remove_source", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').parent('div').parent('div').remove();

        });

        /*END of For Content title */

        /*For Content short title */
        var first_faq_b = $(".data_value_key_faq").first();
        var firsta_faq_b = first_faq_b.find('a[class~="remove_source"]');
        firsta_faq_b.hide();

        var wrapper_faq_b = $("#main_faq_div"); //Fields wrapper   

        $("#add_key_faq").click(function (e)
        {
            e.preventDefault();


            var newid = 1;
            $("#main_faq_div div.data_value_key_faq").each(function () {
                if (parseInt($(this).data("id")) > newid) {
                    newid = parseInt($(this).data("id"));
                }
                newid++;
                // debugger;
            });



            var current = $(".data_value_key_faq").last();
            var cloned = current.clone();
            cloned.find('input,textarea').val('');
            cloned.find('a[class~="remove_source"]').show();
            cloned.find('label[class~="faq_label"]').text('');
            cloned.attr("id", newid);
            cloned.insertAfter(current);

            var first_faq = $(".data_value_key_faq").first();
            first_faq.find('a[class~="remove_source"]').hide();

        });

        $(wrapper_faq_b).on("click", ".remove_source", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').parent('div').parent('div').remove();

        });
        /*END of For Content short title */

    });

    function saveOrder_key_features() {

        var new_order = [];
        $('#main_key div.data_value_key').each(function () {
            content_title_val = $(this).find("input[name^='content_title_val']").val();
            wrappertag_id = $(this).find("select[name^='content_title_wrappertagname']").val();
            new_order.push({content_title_val: content_title_val, wrappertag_id: wrappertag_id});
        });

//        console.log(JSON.stringify(new_order));
        document.getElementById("content_title").value = JSON.stringify(new_order);
//        debugger;
    }
    function saveOrder_faq_question_answer() {

        var new_order_faq = [];
        $('#main_faq_div div.data_value_key_faq').each(function () {
            content_short_title_val = $(this).find("input[name^='content_short_title_val']").val();
            wrappertag_id = $(this).find("select[name^='content_short_title_wrappertagname']").val();
            new_order_faq.push({content_short_title_val: content_short_title_val, wrappertag_id: wrappertag_id});
        });

//        console.log(JSON.stringify(new_order));
        document.getElementById("content_short_title").value = JSON.stringify(new_order_faq);
//        debugger;
    }

</script>   -->



<!--<script type="text/javascript">
    
    
    $(document).ready(function ()
    {
        /*For Short Description  */
        var first_c = $(".data_value_key_a").first();
        var firsta_c = first_c.find('a[class~="remove_source"]');
        firsta_c.hide();

        var wrapper_c = $("#main_key_a"); //Fields wrapper   

        $("#add_key_a").click(function (e)
        {
            e.preventDefault();


            var newid = 1;
            $("#main_key_a div.data_value_key_a").each(function () {
                if (parseInt($(this).data("id")) > newid) {
                    newid = parseInt($(this).data("id"));
                }
                newid++;
                //debugger;
            });


            var current = $(".data_value_key_a").last();
            var cloned = current.clone();
            cloned.find('input,textarea').val('');
            cloned.find('a[class~="remove_source"]').show();
            cloned.find('label[class~="packages_includes_label"]').text('');
            cloned.attr("id", newid);
            cloned.insertAfter(current);

            var first = $(".data_value_key_a").first();
            first.find('a[class~="remove_source"]').hide();

        });


        $(wrapper_c).on("click", ".remove_source", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').parent('div').parent('div').remove();
        });

        /*END of For Short Description */

    });

    function saveOrder_packages() {

        var new_order_a = [];
        $('#main_key_a div.data_value_key_a').each(function () {
            content_short_description_val = $(this).find("textarea[name^='content_short_description_val']").val();
            wrappertag_id = $(this).find("select[name^='content_short_description_wrappertagname']").val();
            new_order_a.push({content_short_description_val: content_short_description_val, wrappertag_id: wrappertag_id});
        });

//        console.log(JSON.stringify(new_order));
        document.getElementById("content_short_description").value = JSON.stringify(new_order_a);
        // debugger;
    }

//    $(document).ready(function () {
//
//        var cat = $('input[name^="cat"]:checked').val();
//
//        if (cat == 3)
//        {
//
//            $("#sliderdiv").css('display', 'block');
//            var id = $('.slidercombo option:selected').attr('data-id');
//            $(".combo").val(id);
//            $('option', '.combo').not(':selected').hide();
//            manipulationData();
//
//        }
//
//        $('input[name="cat"]').on('click', function () {
//
//            var catgry = $(this).val();
//            if (catgry == 3)
//            {
//                $("#sliderdiv").css('display', 'block');
//                var comboid = $('.slidercombo option:selected').attr('data-id');
//                $("#combo").val(comboid);
//                $('option', '.combo').not(':selected').hide();
//                manipulationData();
//
//            } else
//            {
//                $('option', '.combo').show();
//                $('.combo option:eq(0)').attr('selected', 'selected');
//                $("#sliderdiv").css('display', 'none');
//
//            }
//
//        });
//
//
//        $('.slidercombo').change(function ()
//        {
//            var comboid = $('.slidercombo option:selected').attr('data-id');
//            $("#combo").val(comboid);
//            $('option', '.combo').show();
//            $('option', '.combo').not(':selected').hide();
//            manipulationData();
//        });
//
//
//    });
</script>-->


    <script type="text/javascript">
        $(document).ready(function () {
            var type_arr = [];
            var cat_val_arr = [];
            var type_val = $(".gl_cms_type:checked").val();
            var cat_val = $(".gl_cat_val:checked").val();

            get_option_cats(type_val, cat_val);


            $("body").on("change", ".gl_cms_type", function () {
                var type = $(this).val();
                var cat_val_change = 0;
                get_option_cats(type, cat_val_change);
            });

            function get_option_cats(type, cat_value) {

                cat_val_arr.push(cat_value);
                type_arr.push(type);
                var i = 0;
                $(".gl_cat_val").each(function () {
                    var catval = $(this).attr("data-typ");
                    if (type !== catval) {
                        $(this).parents(".gl_cat_div").hide();
                    } else {
                        if (type != type_arr[0]) {
                            if (i == 0) {

                                $(this).prop("checked", true);
                            }
                        } else if (($(this).val()) == cat_val_arr[0]) {
                            $(this).prop("checked", true);
                        }
                        $(this).parents(".gl_cat_div").show();
                        i++;
                    }
                });
            }

        });
        $(document).ready(function () {

            var cms_type_fixed = $(".gl_cms_type_connection option:selected").attr("data-cms-type");
            urlConfigCmsType(cms_type_fixed);
            switch (cms_type_fixed) {
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
        });

        $("body").on("change", ".gl_cms_type_connection", function () {
            var cms_type_fixed = $(".gl_cms_type_connection option:selected").attr("data-cms-type");
            urlConfigCmsType(cms_type_fixed);
            switch (cms_type_fixed) {
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

                    var catttype = $("#category_type option:selected").val();

                    getcatlist(catttype);
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


        });
        $("body").on("change", ".gl_product_type1", function () {
            productDataLoad();
        });
        $("body").on("change", ".gl_product_type2", function () {
            productDataLoad();
        });



        function urlConfigCmsType(cms_type_fixed) {

            $('.gl_url_type_auto').prop('checked', true);
            $('.gl_url_type_seo').prop('checked', false);
            $(".sa_base_url_section").hide();
            $(".sa_remain_url_section").hide();
            if (cms_type_fixed == "cms_normal") {
                $('.gl_url_type_auto').prop('checked', false);
                $('.gl_url_type_seo').prop('checked', true);
                $(".sa_base_url_section").show();
                $(".sa_remain_url_section").show();
            }

            $.uniform.update('.url_type');
        }

        function productDataLoad() {
            $(".gl_product_data_block").removeClass("hide");
            // $("div.gl_product_data_content_block_data").find("ul li.select2-search-choice").remove();

            // $('.gl_product_data_content_block_data').val(null).empty().select2('destroy')

            var cms_type_fixed = $(".gl_cms_type_connection option:selected").attr("data-cms-type");
            var product_type1 = $(".gl_product_type1 option:selected").val();
            var product_type2 = $(".gl_product_type2 option:selected").val();
            var base_url = $(".base_url").val();

            if (typeof cms_type_fixed != "undefined" && typeof cms_type_fixed != "" &&
                    typeof product_type1 != "undefined" && typeof product_type1 != "" &&
                    typeof product_type2 != "undefined" && typeof product_type2 != "") {

                var data_row_connection = "<?php echo $images->connection_data; ?>";
                var dataString = {cms_type: cms_type_fixed,
                    product_type1: product_type1,
                    product_type2: product_type2,
                    connection_data: data_row_connection,
                };
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
                    $(".gl_product_data_content_block_data").select2("destroy");
                    $(".gl_product_data_content_block_data").select2();
                }

            })


        });


        function getcatlist(ctype)
        {

            var data_row_connection = "<?php echo $images->connection_data; ?>";

            $.ajax({
                url: "<?php echo base_url() . 'contentadmin/getcatlist/'; ?>",
                data: {ctype: ctype, connection_data: data_row_connection},
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

            var data_row_connection = "<?php echo $images->connection_data; ?>";
            $.ajax({
                url: "<?php echo base_url() . 'contentadmin/get_page_list/'; ?>",
                data: {connection_data: data_row_connection},
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

            var data_row_connection = "<?php echo $images->connection_data; ?>";
            $.ajax({
                url: "<?php echo base_url() . 'contentadmin/get_menu_list/'; ?>",
                data: {connection_data: data_row_connection},
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