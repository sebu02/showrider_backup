<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->
        <div class="heading">

            <h3>Manage Category Types</h3>                    

        </div><!-- End .heading-->

        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

        <div class="row-fluid">

            <div class="span6" style="width:70%; margin-left:15%;">

                <div class="box">

                    <div class="title">

                        <h4> 
                            <span>Edit Category Type</span>
                        </h4>

                    </div>
                    <div class="content">

                        <form class="form-horizontal extensionForm" action="<?php echo base_url() . 'ecproductadmin/edit_categorytype/' . $this->uri->segment(3); ?>" method="post" enctype="multipart/form-data" >
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

                                        <label class="form-label span4" for="checkboxes">Choose The Category Type</label>

                                        <div class="span8 controls">

                                            <?php
                                            if ($main_category_types != NULL) {
                                                foreach ($main_category_types as $main_key => $main_cat_type) {
                                                    ?>
                                                    <div class="left marginT5"> 
                                                        <input type="radio" name="category_type" 
                                                               value="<?php echo $main_cat_type->category_type_value . '|' . $main_cat_type->id; ?>" 
                                                               <?php
                                                               if ($single_detail->type == $main_cat_type->category_type_value) {
                                                                   echo "checked='checked'";
                                                               }
                                                               ?> class="gl_main_cat_types" />
                                                               <?php echo $main_cat_type->category_type_name; ?>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>   
                                        </div>
                                    </div>

                                </div>
                            </div> 


                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="normal">Category Type<b style="color:#F00; font-size:11px;">*</b></label>
                                        <input class="span5" id="input_name" type="text" name="input_name"  value="<?php echo $single_detail->name; ?>" required />
                                        <span class="error">
                                            <?php echo form_error('input_name'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid gl_price_display_prefix_section">
                                <div class="span12">
                                    <div class="row-fluid">

                                        <label class="form-label span4" for="checkboxes">Price Prefix Status</label>

                                        <div class="span8 controls">
                                            <div class="left marginT5"> 
                                                <input type="radio" class="gl_price_prefix_status"
                                                       name="price_prefix_status" <?php
                                                       if ($single_detail->price_prefix_status == "yes") {
                                                           echo "checked='checked'";
                                                       }
                                                       ?> value="yes" />Yes
                                                <input type="radio" class="gl_price_prefix_status"  
                                                       name="price_prefix_status" <?php
                                                       if ($single_detail->price_prefix_status == "no") {
                                                           echo "checked='checked'";
                                                       } else if ($single_detail->price_prefix_status == "") {
                                                           echo "checked='checked'";
                                                       }
                                                       ?>  value="no" /> No
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="gl_price_display_prefix gl_price_display_prefix_section ">
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="normal">Main text</label>
                                            <input class="span5 gl_main_text"  type="text" name="price_prefix_main_text"  value="<?php echo $single_detail->price_prefix_main_text; ?>" />
                                            <span class="error">
                                                <?php echo form_error('price_prefix_main_text'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="normal">Sub Text(optional)</label>
                                            <input class="span5 gl_sub_text" type="text" name="price_prefix_sub_text" value="<?php echo $single_detail->price_prefix_sub_text; ?>"  />
                                            <span class="error">
                                                <?php echo form_error('price_prefix_status'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid hide">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span5" for="show_vary_attributes">Show Variations in Page</label>
                                        <div class="left marginT5 marginR10">
                                            <input type="checkbox" id="show_vary_attributes" name="show_vary_attributes" value="yes" class="styled" <?php
                                            if ($single_detail->show_vary_attributes == 'yes') {
                                                echo 'checked';
                                            }
                                            ?> /> Yes
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="form-row row-fluid hide">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="attribute_style">Attribute Style</label>
                                        <div class="span8 controls">
                                            <div class="left marginT5">
                                                <input type="radio" name="attribute_style" id="attribute_style1" value="dropdown" <?php
                                                if ($single_detail->attribute_style == 'dropdown') {
                                                    echo 'checked';
                                                }
                                                ?> />
                                                DropDown
                                            </div>
                                            <div class="left marginT5">
                                                <input type="radio" name="attribute_style" id="attribute_style2" value="box" <?php
                                                if ($single_detail->attribute_style == 'box') {
                                                    echo 'checked';
                                                }
                                                ?> />
                                                Box
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="save_database1">Save To Option</label>
                                        <div class="span8 controls">

                                            <div class="left marginT5"> 
                                                <input <?php
                                                if ($single_detail->save_database == 'yes') {
                                                    echo 'checked';
                                                }
                                                ?> type="checkbox" class="save_database" id="save_database" name="save_database" value="yes" />
                                                <span>yes</span> 
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>




                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="active_status">Activate Category Type Status</label>
                                        <div class="span8 controls">
                                            <div class="left marginT5">
                                                <input type="radio" name="active_status" id="active_status1" value="a" <?php
                                                if ($single_detail->active_status == 'a') {
                                                    echo 'checked';
                                                }
                                                ?> />
                                                Active
                                            </div>
                                            <div class="left marginT5">
                                                <input type="radio" name="active_status" id="active_status2" value="d" <?php
                                                if ($single_detail->active_status == 'd') {
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
                                        <label class="form-label span4" for="show_admin_status">Show In Admin Status</label>
                                        <div class="span8 controls">
                                            <div class="left marginT5">
                                                <input type="radio" name="show_admin_status" id="show_admin_status1" value="yes" <?php
                                                if ($single_detail->show_admin_status == 'yes') {
                                                    echo 'checked';
                                                }
                                                ?> />
                                                Yes
                                            </div>
                                            <div class="left marginT5">
                                                <input type="radio" name="show_admin_status" id="show_admin_status2" value="no" <?php
                                                if ($single_detail->show_admin_status == 'no') {
                                                    echo 'checked';
                                                }
                                                ?> />
                                                No
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="show_product_category_status">Show In Product Category</label>
                                        <div class="span8 controls">
                                            <div class="left marginT5">
                                                <input type="radio" name="show_product_category_status" id="show_product_category_status1" value="yes" <?php
                                                if ($single_detail->show_product_category_status == 'yes') {
                                                    echo 'checked';
                                                }
                                                ?> />
                                                Yes
                                            </div>
                                            <div class="left marginT5">
                                                <input type="radio" name="show_product_category_status" id="show_product_category_status2" value="no" <?php
                                                if ($single_detail->show_product_category_status == 'no') {
                                                    echo 'checked';
                                                }
                                                ?> />
                                                No
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
                                <button type="submit" class="btn btn-info">Submit</button>

                            </div>


                        </form>

                    </div>

                </div><!-- End .box -->

            </div><!-- End .span6 --><!-- End .span6 --><!-- End .span6 -->


        </div><!-- End .row-fluid --><!-- End .row-fluid --><!-- End .row-fluid --><!-- End .row-fluid -->





    </div><!-- End contentwrapper -->
</div>
<script type="text/javascript">
    $(document).ready(function () {
        main_cat_types_price_dispaly_status();
        price_dispaly_status();

    });

    $("body").on("change", ".gl_price_prefix_status", function () {

        price_dispaly_status();
    });
    $("body").on("change", ".gl_main_cat_types", function () {

        main_cat_types_price_dispaly_status();
    });

    function price_dispaly_status() {

        if ($(".gl_price_prefix_status:checked").val() == "yes") {
            $(".gl_price_display_prefix").show();
            $(".gl_main_text").prop('required', true);
        } else {
            $(".gl_price_display_prefix").hide();
            $(".gl_main_text").prop("required", false);
        }
    }

    function main_cat_types_price_dispaly_status() {

        var main_cat_types = $(".gl_main_cat_types:checked").val();
        var main_cat_types_div = main_cat_types.split("|");

        if (main_cat_types_div[0] == "product_category") {
            $(".gl_price_display_prefix_section").show();
        } else {
            $(".gl_price_display_prefix_section").hide();
            $(".gl_main_text").prop("required", false);
        }
    }
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
