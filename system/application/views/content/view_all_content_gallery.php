<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->
        <div class="heading">
            <h3 class="gl_ftype_label">VIEW CONTENT GALLERY</h3>   

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
                                    <th></th>
                                    <th class="gl_ftype_label">CONTENT NAME</th>
                                    <th>PICTURE</th>
                                </tr>
                            </thead>
                            <tbody class="tsort">

                                <tr class="odd gradeX" id=''>
                                <tr class="odd gradeX">
                                    <td class="gl_ftype_label">Content Images1</td>
                                    <td><?php echo $content_details->title; ?></td>
                                    <td>
                                        <span aria-hidden="true" class="icomoon-icon-image-2"></span>
                                        <a href="<?php echo base_url(); ?>contentadmin/view_content_gallery/<?php echo $content_details->id . '/' . $this->uri->segment(4); ?>"><strong class="gl_ftype_label">View Gallery</strong></a>

                                    </td>
                                </tr>
                                <tr class="odd gradeX <?php echo $this->common_model->admin_or_super_admin();?>">
                                    <td>Content Images2</td>
                                    <td><?php echo $content_details->title; ?></td>
                                    <td>
                                        <span aria-hidden="true" class="icomoon-icon-image-2"></span>
                                        <a href="<?php echo base_url(); ?>contentadmin/view_content_gallery2/<?php echo $content_details->id . '/' . $this->uri->segment(4); ?>"><strong>View Gallery</strong></a>

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
<!--<input type="hidden" class="gl_seg4" value="<?php // echo $this->uri->segment(4); ?>">-->

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

