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
        <a href="<?php echo base_url(); ?>contentadmin/trash_viewcategory" class="btn btn-inverse"><span
                class="icon16 icomoon-icon-loop white"></span> Refresh</a>

        <div class="row-fluid">
            <div class="span12">
                <div class="box gradient">
                    <div class="title">
                        <h4>
                            <span>View Category Trash</span>
                        </h4>
                    </div>
                    <div class="content noPad clearfix">

                        <table cellpadding="0" cellspacing="0" border="0" class="dynamicTable display table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th width="40px">ID</th>
                                    <th>NAME</th>
                                    <th width="150px" >RESTORE</th>
                                    <th width="50px" >DELETE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = $page_position;
                                //print_r($categories);
                                foreach ($categories as $cat) {
                                    $i++;
                                    $banner= json_decode($cat->category_picture);
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $cat->category; ?></td>
                                        <td class="center"><a href="javascript:void(0)" title="Restore Category" class="tip" onClick="restoreRef('<?php echo base_url(); ?>contentadmin/restoreCategory/<?php echo $cat->id; ?>')">
                                                <span class="icon12 icomoon-icon-undo-2"></span><strong>Restore Category</strong></a></td>
                                        <td class="center"><a href="javascript:void(0)" title="Remove Category" class="tip" onClick="linkRef('<?php echo base_url(); ?>contentadmin/deleteCategory/<?php echo $cat->id; ?>')">
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
    function linkRef(yurl) {
        var linkref = yurl;
        if (confirm("Do you really want to Delete ?")) {
            window.location.href = linkref;
        }
    }
    
    function restoreRef(yurl) {
        var restoreRef = yurl;
            if (confirm("Do you really want to restore ?")) {
                window.location.href = restoreRef;
            }
    }
    
</script>    
