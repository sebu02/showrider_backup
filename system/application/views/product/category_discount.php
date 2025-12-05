<style>

    label.radio-inline, label.checkbox-inline {
        background-color: #E5E5E5;
        cursor: pointer;
        font-weight: 400;
        margin-bottom: 10px !important;
        margin-right: 2%;
        margin-left:0;
        padding: 10px;
    }
    label.radio-inline.checked, label.checkbox-inline.checked {
        background-color: #49afcd;
        color: #fff !important;
        text-shadow: 1px 1px 2px #000 !important;
    }
    .checkbox-inline + .checkbox-inline, .radio-inline + .radio-inline {
        margin-left: 0;
    }
    .gl-columns label.radio-inline, .gl-columns label.checkbox-inline {
        min-width: 220px;
        vertical-align: top;
        width: 25%;
    }
    .gl-columns label {
        cursor: move;
    }

</style>

<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->
        <div class="heading">
            <h3>Manage Product Discount</h3>
        </div><!-- End .heading-->
        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->
        <div class="row-fluid">
            <div class="span12">
                <div class="box">
                    <div class="title">
                        <h4>
                            <span>Category wise Discount</span>
                        </h4>
                    </div>
                    <div class="content noPad clearfix">
                        <form id="wizard" class="form-horizontal ui-formwizard multiple_upload_form gl_dynamicform" action="<?php echo base_url() . 'ecproductadmin/category_discount/'; ?>" method="post" enctype="multipart/form-data">
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
                                        <label class="form-label span4" for="checkboxes">Product Category <b style="color:#F00; font-size:11px;">*</b></label>
                                        <div class="span8 controls">   
                                            <select id="category_type" name="category_type" required>
                                                <option value="" >--Select--</option>
                                                <?php
                                                foreach ($category_type_list as $cattype) {
                                                    ?>
                                                    <option value="<?php echo $cattype->id; ?>" <?php echo set_select('category_type', $cattype->id); ?>><?php echo $cattype->name; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <span class="error">
                                                <?php echo form_error('category_type'); ?>
                                            </span>
                                        </div> 
                                    </div>
                                </div> 
                            </div>
                            <div class="form-row row-fluid gl_category_container">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="parentname">Select Parent <b style="color:#F00; font-size:11px;">*</b></label>
                                        <div class="span8 controls">   
                                            <select class="parentid" id="parentname" name="parentname" required>
                                                <option value="" data-url="" >--Select--</option>
                                            </select>
                                            <span class="error">
                                                <?php echo form_error('parentname'); ?>
                                            </span>
                                        </div> 
                                    </div>
                                </div> 
                            </div>

                            <!--                            <div class="form-row row-fluid">
                                                            <div class="span12">
                                                                <div class="row-fluid">
                                                                    <label class="form-label span4" for="discount">Discount
                                                                    </label>
                                                                    <input class="span8" id="discount" min="0" type="number" name="discount"  value="<?php echo set_value('discount'); ?>"/>
                                                                    <span class="error"><?php echo form_error('discount'); ?></span>
                                                                </div>
                                                            </div>
                                                        </div>-->

                            <div class="form-row row-fluid  gl_common_input_wrapper_discounttype">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4">Discount Type</label>
                                        <div class="marginT5 span8">
                                            <div class='span12'>
                                                <div class='span12'>
                                                    <input class="span8 discounttype " name="discounttype" value="80" type="radio" checked id="discounttype80">
                                                    <label class='sa_text_label' for="discounttype80">Common Discount</label>  
                                                </div> 
                                                <div class='span12'>
                                                    <input class="span8 discounttype " name="discounttype" value="81"  type="radio" id="discounttype81">
                                                    <label class='sa_text_label' for="discounttype81">Column Discount</label>  
                                                </div> 
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>





                            <div class="form-row row-fluid  gl_common_input_wrapper_discount_column">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="discount_column">Discount Column</label>
                                        <div class="span8 controls">   
                                            <select id="discount_column" name="discount_column">
                                                <option value="" >--Select--</option>
                                                <option  value="36">Labour Value (Rs)</option>      
                                                <option  value="30">Total Diamond Net Value(Rs)</option>      
                                            </select>
                                            <span class="error">
                                            </span>
                                        </div> 
                                    </div>
                                </div> 
                            </div>

                            <div class="form-row row-fluid  gl_common_input_wrapper_discountby">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4">Discount By</label>
                                        <div class="marginT5 span8">
                                            <div class='span12'>
                                                <div class='span12'>
                                                    <input class="span8 discountby " name="discountby" value="82" type="radio" checked id="discountby82">
                                                    <label class='sa_text_label' for="discountby82">Percent</label>  
                                                </div> 
                                                <div class='span12'>
                                                    <input class="span8 discountby " name="discountby" value="83"  type="radio" id="discountby83">
                                                    <label class='sa_text_label' for="discountby83">Amount</label>  
                                                </div> 
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>





                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="discount">Discount
                                            <b style="color:#F00; font-size:11px;">*</b>
                                        </label>
                                        <input class="span8 only_amount_numeric" id="discount"  type="text" name="discount"  value="<?php echo set_value('discount'); ?>"/>
                                        <span class="error"><?php echo form_error('discount'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="discount_text">Discount Text</label>
                                        <textarea class="span8 " id="discount_text"
                                                  name="discount_text"/></textarea>
                                        <span class="error">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="admin_common_remarks">Admin Common Remarks</label>
                                        <textarea class="span8" id="admin_common_remarks"
                                                  name="admin_common_remarks"/></textarea>
                                        <span class="error">
                                        </span>
                                    </div>
                                </div>
                            </div>




                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions full">
                                <button class="btn btn-info pull-right showhide-btn" type="submit">Save & Continue</button>
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
        $(document).ready(function ()
        {
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

    $(document).ready(function () {


        var discounttype = $(".gl_dynamicform .gl_common_input_wrapper_discounttype").find(".discounttype:checked").val();

        if (discounttype == "81") {
            $(".gl_dynamicform .gl_common_input_wrapper_discount_column ").show();
            $(".gl_dynamicform .gl_common_input_wrapper_discount_column ").find("#discount_column").prop('required', true);
        } else {
            $(".gl_dynamicform .gl_common_input_wrapper_discount_column ").hide();
            $(".gl_dynamicform .gl_common_input_wrapper_discount_column ").find("#discount_column").prop('required', false);
        }

        $(".gl_dynamicform").on("change", ".discounttype", function () {
            var discounttype = $(this).val();
            if (discounttype == "81") {
                $(".gl_dynamicform .gl_common_input_wrapper_discount_column ").show();
                $(".gl_dynamicform .gl_common_input_wrapper_discount_column ").find("#discount_column").prop('required', true);
            } else {
                $(".gl_dynamicform .gl_common_input_wrapper_discount_column ").hide();
                $(".gl_dynamicform .gl_common_input_wrapper_discount_column ").find("#discount_column").prop('required', false);
            }

        });


    });
</script>
<script type="text/javascript">

    $(document).ready(function () {

        $('#category_type').on('change', function () {

            $('#parentname').attr("disabled", true);
            var ctype = $(this).val();


            $.ajax({
                url: "<?php echo base_url() . 'ecproductadmin/getcatlist/'; ?>",
                data: {ctype: ctype},
                type: "POST",
                success: function (response)
                {
                    $('#parentname').html(response);
                    $('#parentname').attr("disabled", false);

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        });




    });


</script>
