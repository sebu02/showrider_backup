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
    .searchBox span
    {

        background: none repeat scroll 0 0 #ccc;
        display: block;
        float:right;
        font-size: 10px;
        height: 25px;
        line-height: 25px;
        margin-top: -2px;   
        margin-right: 20px;
        text-align: center;
        width: 50px;
        cursor:pointer;

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
                        <form class="form-horizontal multiple_upload_form gl_multiple_upload_form" action="<?php echo base_url() . 'contentadmin/editcontent2/' . $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/?' . $_SERVER['QUERY_STRING']; ?>" method="post" enctype="multipart/form-data" >
                            <div class="msg"></div>
                            <div class="wizard-steps clearfix show">

                                <a class="wstep " data-step-num="0" href="<?php echo base_url() . 'contentadmin/editcontent/' . $images->id . '/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/?' . $_SERVER['QUERY_STRING']; ?>">
                                    <div class="donut">1</div>
                                    <span class="txt">STEP 1</span>
                                </a>

                                <?php
                                $newKey = 3;
                                if ($fixedcommoninput_status == false) {
                                    $newKey = 2;
                                }
                                if ($fixedcommoninput_status == true) {
                                    ?>
                                    <a class="wstep " data-step-num="0" href="<?php echo base_url() . 'contentadmin/editcontent2/' . $images->id . '/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/?' . $_SERVER['QUERY_STRING']; ?>">
                                        <div class="donut">2</div>
                                        <span class="txt">STEP 2</span>
                                    </a>
                                <?php } ?>

                                <?php
                                if ($need_third == true) {
                                    if (!empty($wizard_row->product_wizard)) {
                                        $product_wizards = json_decode($wizard_row->product_wizard, TRUE);
                                        $wizard_group = json_decode($wizard_row->wizard_group, TRUE);
//                                    $wizard_group_attributes = json_decode($wizard_row->wizard_group_attributes, TRUE);
                                    } else {
                                        $product_wizards = NULL;
                                    }


                                    $newKey = 3;
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
                                }
                                ?>

                            </div>   
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <div class="error_messages">



                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $data['images'] = $images;
                            $data['values'] = $values;

                            if (empty($structure_common_input)) {
                                $data["common_input_id"] = "";
                                $data['common_array'] = [
];
                                $this->load->view('commoninputadmin/common_inputs/attr_content_image1', $data);
                                $this->load->view('commoninputadmin/common_inputs/attr_content_image2', $data);
                                $data['cat'] = $images;
                                $this->load->view("commoninputadmin/common_inputs/attr_iconset", $data);
                                $data['featurebox_list1'] = $featurebox_list;
                                $data['target'] = $target;
                                $this->load->view('commoninputadmin/common_inputs/attr_customlink', $data);
                                $this->load->view('commoninputadmin/common_inputs/attr_content_video', $data);
                                $this->load->view('commoninputadmin/common_inputs/attr_content_menutype', $data);
                                $this->load->view('commoninputadmin/common_inputs/attr_content_featurebox', $data);

                                $this->load->view('custom/attr_combo_text_contents', $data);
                            } else {

                                $data['common_array'] = $common_array = array_intersect($fixedcommoninput, $structure_common_input);
                                $data["common_input_id"] = 80;
                                $this->load->view('commoninputadmin/common_inputs/attr_content_image1', $data);

                                $data["common_input_id"] = 81;
                                $this->load->view('commoninputadmin/common_inputs/attr_content_image2', $data);

                                $data["common_input_id"] = 82;
                                $data['cat'] = $images;
                                $this->load->view("commoninputadmin/common_inputs/attr_iconset", $data);

                                $data["common_input_id"] = 83;
                                $data['featurebox_list1'] = $featurebox_list;
                                $data['target'] = $target;
                                $this->load->view('commoninputadmin/common_inputs/attr_customlink', $data);

                                $data["common_input_id"] = 84;
                                $this->load->view('commoninputadmin/common_inputs/attr_content_video', $data);

                                $data["common_input_id"] = 85;
                                $this->load->view('commoninputadmin/common_inputs/attr_content_menutype', $data);

                                $data["common_input_id"] = 86;
                                $this->load->view('commoninputadmin/common_inputs/attr_content_featurebox', $data);

                                $data["common_input_id"] = 98;
                                $this->load->view('custom/attr_combo_text_contents', $data);






//    if (in_array(74, $common_array)) {
//
//        $this->load->view('commoninputadmin/common_inputs/attr_content_image1', $data);
//    } else {
//
//        echo "<input type='hidden' name='final_images' value='$images'>";
//    }
//
//    if (in_array(75, $common_array)) {
//
//        $this->load->view('commoninputadmin/common_inputs/attr_content_image2', $data);
//    } else {
//
//        echo "<input type='hidden' name='final_images_b' >";
//    }
//
//    if (in_array(76, $common_array)) {
//        $data['cat'] = $images;
//        $this->load->view("commoninputadmin/common_inputs/attr_iconset", $data);
//    } else {
//
//        echo "<input type='hidden' name='icon_type' >";
//    }
//    if (in_array(77, $common_array)) {
//        $data['featurebox_list1'] = $featurebox_list;
//        $data['target'] = $target;
//        $this->load->view('commoninputadmin/common_inputs/attr_customlink', $data);
//    } else {
//        echo "<input type='hidden' name='show_select' value='no'>";
//    }
//
//
//    if (in_array(78, $common_array)) {
//        $this->load->view('commoninputadmin/common_inputs/attr_content_video', $data);
//    } else {
//        echo "<input type='hidden' name='final_video'>";
//    }
//
//    if (in_array(79, $common_array)) {
//
//        $this->load->view('commoninputadmin/common_inputs/attr_content_menutype', $data);
//    } else {
//        echo "<input type='hidden' name='select_menu_type'>";
//    }
//
//
//    if (in_array(80, $common_array)) {
//        $this->load->view('commoninputadmin/common_inputs/attr_content_featurebox', $data);
//    } else {
//        echo "<input type='hidden' name='content_featurebox'>";
//    }
                            }
                            ?>


                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">

                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">                                
                                <button type="submit" class="btn btn-info pull-right showhide-btn gl_button_submit" onclick="savevideoType();return title_validate();">Save & Continue</button>
                            </div>


                        </form>
                        <!--</div>-->
                    </div>

                </div><!-- End .box -->

            </div><!-- End .span6 --><!-- End .span6 --><!-- End .span6 -->


        </div><!-- End .row-fluid --><!-- End .row-fluid --><!-- End .row-fluid --><!-- End .row-fluid -->

        <?php
        if (!empty($this->uri->segment(6))) {
            $mode = $this->uri->segment(6);
        } else {
            $mode = '';
        }
        ?>       

        <input type="hidden" name="check_video" id="check_video" class="gl_check_video" value="<?php echo $mode; ?>">

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





<!-- video upload js starts-->

<script type="text/javascript">
    function labelvalue(checkValue) {

        $('.textval').text(checkValue);
    }
    function labelvalue1(classlast, checkValue) {

        $('.textval' + classlast).text(checkValue);
    }


    function savevideoType() {

        var new_video = [];
        $('#types div.repeatvideoDiv').each(function () {

            var video_value = $(this).find("input[name^='video'][type=radio]:checked").val();
            var source_value = $(this).find("input[name^='source']").val();
            var video_source_value = $(this).find("input[name^='video_source_title']").val();
            var video_desc_value = $(this).find("textarea[name^='video_source_desc']").val();
            var video_order = $(this).find("input[name^='video_order']").val();
            new_video.push({videotype: video_value, source: source_value, video_source_title: video_source_value, video_source_desc: video_desc_value, video_order: video_order});
        });

//        console.log(JSON.stringify(new_video));
        document.getElementById("final_videoResult").value = JSON.stringify(new_video);

    }

    $(document).ready(function () {
        var max_fields = 5; //maximum input boxes allowed
        var wrapper = $(".source_wrap"); //Fields wrapper
        var add_button = $(".add_source_button"); //Add button ID
        var y = 0; //initlal text box count
        var x = 1;

        $(add_button).click(function (e) { //on add input button click

            e.preventDefault();

            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                y++;
                $(wrapper).append('<div class="repeatvideoDiv"><div class="span12"><div class="form-row row-fluid"><div class="span12"><div class="row-fluid" id="types"><div style="width:180px; height:auto; float:left; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="display:initial; margin:0px;">&nbsp;&nbsp;YouTube Video Id</label><input name="video' + y + '" style="width:20px;float:left;" id="video1" value="YouTube Video Id" type="radio" checked="true" onclick="labelvalue1(' + x + ',this.value)"><br></div><div style="width:180px; height:auto; float:left; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="display:initial; margin:0px;">&nbsp;&nbsp;Embed Code</label><input name="video' + y + '" id="video2" value="Embed Code" type="radio" style="width:20px;float:left;" onclick="labelvalue1(' + x + ',this.value)"><br></div><div style="width:180px; height:auto; float:left; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="display:initial; margin:0px;">&nbsp;&nbsp;Url</label><input name="video' + y + '" id="video3" style="width:20px;float:left;" value="Url" type="radio" onclick="labelvalue1(' + x + ',this.value)"><br><br></div></div></div></div><div class="row-fluid sourceSection"><label class="form-label span4" for="normal"><span class="textval' + x + '">YouTube Video Id</span><b style="color:#F00; font-size:11px;">*</b></label><input class="span8 source_field"  type="text" name="source' + y + '"  value="<?php echo set_value('source[]'); ?>"  /><span class="error"></span></div><div class="row-fluid"><label class="form-label span4" for="normal">Video Title<b style="color:#F00; font-size:11px;">*</b></label><input class="span8 video_source_title" required type="text" name="video_source_title' + y + '"  value="<?php echo set_value('video_source_title[]'); ?>"  /><span class="error"></span></div><div class="row-fluid"><label class="form-label span4" for="normal">Video Order<b style="color:#F00; font-size:11px;">*</b></label><input class="span8 video_order" required type="number" name="video_order' + y + '"  value="<?php echo set_value('video_order[]'); ?>"  /><span class="error"></span></div><div class="row-fluid"><label class="form-label span4" for="normal">Video Description</label><textarea class="span8 video_source_desc" name="video_source_desc' + y + '" rows="3"><?php echo set_value('video_source_desc[]'); ?></textarea><span class="error"></span></div><br /></div><a href="javascript:void(0)" style= "margin-right:60px;" class="remove_source right">Remove</a></div>');
            }

            if (x == 5) {
                $('.add_source_button').css("display", "none");
            } else {
                $('.add_source_button').css("display", "block");
            }

        });

        $(wrapper).on("click", ".remove_source", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            $('.add_source_button').css("display", "block");
            x--;

        });
    });


</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(window).load(function () {
            $('.cat_left_radio').parents('.radio').removeClass('radio');
            $('.cat_left_radio').parent().css("float", "left");
        });

        $('.parent_checker').find('input[type=radio]').filter(':visible:first').prop('checked', true);
        $('.parent_checker1').find('input[type=radio]').filter(':visible:first').prop('checked', true);

    });

</script>

<!-- video upload ends -->

<script type="text/javascript">
    function title_validate()
    {
        var title_val = $('.video_source_title').val();
        var cms_type_value = $('.cms_type_val').val();
        var check_video = $('.gl_check_video').val();
//        alert(check_video)
        if (cms_type_value == 'video') {
            if (title_val === '' && check_video == 'add')
            {
                $('.title_error').html('The field should not be empty');
                return false;
            } else
            {
                return true;

            }
        }
    }
</script>

<script type="text/javascript">
    $(document).ready(function () {

        $.configureBoxes13();

        function show_hide_menu_type(type) {
            var type_val = type;
            if (type_val == 'custom') {
                $(".gl_select_menu_type_div_custom").show();
                $(".gl_select_menu_type_div_normal").hide();
            } else {
                $(".gl_select_menu_type_div_custom").hide();
                $(".gl_select_menu_type_div_normal").show();

            }
        }

        var type = $(".gl_select_type:checked").val();
        show_hide_menu_type(type);

        $("body").on("change", ".gl_select_type", function () {
            var type1 = $(this).val();
            show_hide_menu_type(type1);
        });

    });
</script>   

<script type="text/javascript">
    $(document).ready(function () {
        $("body").on("change", ".gl_select_filter_menu", function () {
            filter_menu();
        });
    });
    function filter_menu() {

        var menu_type = $("#gl_menu_type").val();

        var sort_validate = true;

        if (sort_validate == true) {
            var existing_array = new Array();//storing the selected values inside an array
            $('#box14View option').each(function () {
                existing_array.push($(this).val());
            });

            ajaxindicatorstart('please wait..');

            $.ajax({
                url: "<?php echo base_url() . 'contentadmin/get_dual_list_val/'; ?>",
                data: {menu_type: menu_type, existing_array: existing_array},
                type: "POST",
                success: function (response)
                {
                    $('#box13View').html(response);
                    ajaxindicatorstop();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }
    }

    $('#box13View').dragOptions();

</script>
