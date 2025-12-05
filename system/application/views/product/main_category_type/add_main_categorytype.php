<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->
        <div class="heading">

            <h3>Manage Products</h3>                    

        </div><!-- End .heading-->

        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

        <div class="row-fluid">

            <div class="span6" style="width:70%; margin-left:15%;">

                <div class="box">

                    <div class="title">

                        <h4> 
                            <span>Add Main Category Type</span>
                        </h4>

                    </div>
                    <div class="content">
                        <form class="form-horizontal extensionForm" action="<?php echo base_url() . 'ecproductadmin/add_main_category_type/' ?>" method="post" enctype="multipart/form-data" >
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="category_type_name">Category Type Key<b style="color:#F00; font-size:11px;">*</b></label>
                                        <input class="span5"
                                               id="category_type_name"
                                               type="text" name="category_type_name" 
                                               value="<?php echo set_value('category_type_name'); ?>" 
                                               required />
                                        <span class="error"><?php echo form_error('category_type_name'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="category_type_value">Category Type Value<b style="color:#F00; font-size:11px;">*</b></label>
                                        <input class="span5"
                                               id="category_type_value"
                                               type="text" name="category_type_value" 
                                               value="<?php echo set_value('category_type_value'); ?>" 
                                               required />
                                        <span class="error"><?php echo form_error('category_type_value'); ?></span>
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
