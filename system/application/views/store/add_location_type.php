<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->

        <div class="heading">

            <h3>Manage Location</h3>                    

        </div><!-- End .heading-->

        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

        <div class="row-fluid">

            <div class="span6" style="width:70%; margin-left:15%;">

                <div class="box">

                    <div class="title">

                        <h4> 
                            <span>Add Location Type</span>
                        </h4>

                    </div>
                    <div class="content">

                        <form class="form-horizontal multiple_upload_form" action="<?php echo base_url() . 'cmsstorefinderadmin/add_location_type/'; ?>" method="post" enctype="multipart/form-data" >
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
                                        <label class="form-label span4" for="parent_id">Select Parent</label>
                                        <div class="span8 controls">   
                                            <select class="parent_id" id="parent_id" name="parent_id" required>
                                                <option value="0" data-url=''>--parent--</option>
                                                <?php
                                                if (!empty($values)) {
                                                    foreach ($values as $p) { ?>
                                    
                                    <option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                                       
                                                <?php }
                                                }
                                                ?>
                                            </select>
                                            <span class="error">
                                                <?php echo form_error('parent_id'); ?>
                                            </span>
                                        </div> 
                                    </div>
                                </div> 
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="location_type">Location type</label>
                                        <input class="span8 slug_ref" id="location_type" type="text" name="location_type"  value="<?php echo set_value('location_type'); ?>" required />
                                        <span class="error">
                                            <?php echo form_error('location_type'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="slug">Location key<b style="color:#F00; font-size:11px;">*</b></label>
                                        <span style="font-size:11px;" class="sa_base_url_section"><?php echo base_url(); ?></span> 
                                        <span style="font-size:11px;" class="sa_remain_url_section"></span> 
                                        <input class="span6 read-slug slug_url_val" readonly="true" id="slug" type="text" name="location_key" value="<?php echo set_value('location_key'); ?>" required/>
                                        <span class="right manipTxt slugShow"><a onclick="slugShow()" class="icomoon-icon-pencil">Write Mode On</a></span>
                                        <span class="right manipTxt slugHide" style="display: none;"><a onclick="slugHide()" class="icomoon-icon-link-5">Write Mode Off</a></span>
                                        <span class="error">
                                            <?php echo form_error('location_key'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="normal">Order</label>
                                        <input class="span8" id="order_number" type="number" name="order_no"  value="<?php
                                        if (isset($_POST['order_no']) && $_POST['order_no'] != '') {
                                            echo set_value('order_no');
                                        } else {
                                            echo '0';
                                        }
                                        ?>" required />
                                        <span class="error">
                                            <?php echo form_error('order_no'); ?>
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

                            <div class="form-actions">
                                <button type="submit" class="btn btn-info showhide-btn">Submit</button>

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