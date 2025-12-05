<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->
        <div class="heading">
            <h3>Manage Content</h3>                  

        </div><!-- End .heading-->
        <div class="form-row row-fluid" style="width:40%; float:right ;">
            <div class="span12">
                <div class="row-fluid">
                    
                  
                </div>
            </div>
        </div>
        <a href="<?php echo base_url(); ?>contentadmin/subcategory" class="btn btn-inverse"><span
                class="icon16 icomoon-icon-loop white"></span> Refresh</a>

        <div class="row-fluid">
            <div class="span12">
                <div class="box gradient">
                    <div class="title">
                        <h4>
                            <span>View Content Subcategory</span>
                        </h4>
                    </div>
                    <div class="content noPad clearfix">

                        <table cellpadding="0" cellspacing="0" border="0" class="dynamicTable display table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th width="40px">ID</th>
                                    <th>NAME</th>
                                    <th>PARENT CATEGORY</th>
                                    <th>PICTURE</th>
                                    <th width="150px" >EDIT</th>
                                    <th width="50px" >DELETE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = $page_position;
                                //print_r($categories);
                                foreach ($categories as $cat) {
                                    $banner= json_decode($cat->category_picture);
                                    $i++;
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $cat->category; ?></td>
                                        <td><?php
                                $this->db->where('id', $cat->parent_id);
                                $category_details = $this->db->get('cms_dynamic_category')->row();
                                echo $category_details->category;
                                    ?></td>
                                        <td><?php if ($banner[0]->image != '') {
                                        ?>
                                                <img src="<?php echo base_url() . 'media_library/' . $banner[0]->image; ?>" width="70" height="70"  />
                                            <?php
                                            } else {
                                                ?>
                                                <img src="<?php echo base_url() . 'static/admin/'; ?>images/noimage.png" width="70" height="70">
                                                <?php
                                            }
                                            ?></td>
                                        <td class="center"> <a href="<?php echo base_url(); ?>contentadmin/editSub/<?php echo $cat->id; ?>" title="Edit Subcategory" class="tip"><span class="icon12 icomoon-icon-pencil"></span><strong>Edit Subcategory</strong></a></td>
                                        <td class="center"><a href="javascript:void(0)" title="Remove Subcategory" class="tip" onClick="linkRef('<?php echo base_url(); ?>contentadmin/trashSubcategory/<?php echo $cat->id; ?>')">
                                                <span class="icon12 icomoon-icon-remove"></span></a></td>                 
                                    </tr>

    <?php
}
?>


                            </tbody>

                        </table>
                    </div>
                </div><!-- End .box -->
            </div><!-- End .span12 -->


            <div class="pagination_wrapper">
                <div class="pagination_wrapper-cover">     
                    <div id="pagination">  <?php echo $pagination; ?>  </div>        
                </div>
            </div>

        </div><!-- End .row-fluid -->






    </div><!-- End contentwrapper -->
</div>


<?php
if ($this->session->flashdata('message')) {
    ?>
    <script type="text/javascript"> 
        $(document).ready(function() {
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
    function linkRef(yurl) {
        var linkref = yurl;
        if (confirm("Do you really want to Delete ?")) {
            window.location.href = linkref;
        }
    }
</script>   