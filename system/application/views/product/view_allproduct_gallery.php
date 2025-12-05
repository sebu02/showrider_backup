<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->
        <div class="heading">
            <h3 class="gl_ftype_label">VIEW PRODUCT GALLERY</h3>   

        </div><!-- End .heading-->

        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

        <div class="row-fluid">
            <div class="span12">
                <div class="box gradient">
                    <div class="title">
                        <h4>
                            <span>Galleries</span>
                        </h4>
                    </div>
                    <div class="content noPad clearfix">
                        <table cellpadding="0" cellspacing="0" border="0" class="dynamicTable display table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>TYPE</th>
                                    <th class="gl_ftype_label">PRODUCT NAME</th>
                                    <th>GALLERY</th>
                                </tr>
                            </thead>
                            <tbody class="tsort">

                                <tr class="odd gradeX" id=''>
                                <tr class="odd gradeX">
                                    <td class="gl_ftype_label">Product Images</td>
                                    <td><?php echo $product->product_display_name; ?></td>
                                    <td>
                                        <span aria-hidden="true" class="icomoon-icon-image-2"></span>
                                        <a href="<?php echo base_url(); ?>ecproductadmin/view_product_gallery/<?php echo $product->id . '/' . $this->uri->segment(4); ?>"><strong class="gl_ftype_label">View Product Gallery</strong></a>

                                    </td>
                                </tr>
                                <tr class="odd gradeX <?php echo $this->common_model->admin_or_super_admin();?>">
                                    <td>Brochures</td>
                                    <td><?php echo $product->product_display_name; ?></td>
                                    <td>
                                        <span aria-hidden="true" class="icomoon-icon-image-2"></span>
                                        <a href="<?php echo base_url(); ?>ecproductadmin/view_brochure_gallery/<?php echo $product->id . '/' . $this->uri->segment(4); ?>"><strong>View Brochure Gallery</strong></a>

                                    </td>
                                </tr>                                      
                            </tbody>

                        </table>
                    </div>
                </div><!-- End .box -->
            </div><!-- End .span12 -->




        </div><!-- End .row-fluid -->






    </div><!-- End contentwrapper -->
</div>
<input type="hidden" class="gl_seg4" value="<?php echo $this->uri->segment(4); ?>">

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
    $(document).ready(function () {
        var seg4 = $('.gl_seg4').val();
        if (seg4 == 'shop') {
            $('.gl_ftype_label').each(function () {
                var str = $(this).text();
                var str = str.replace('product', 'shop');
                var str = str.replace('Product', 'Shop');
                var str = str.replace('PRODUCT', 'SHOP');
                $(this).text(str);
            });
        }
    });
</script>
