<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->
        <div class="heading">
            <h3>VIEW Installer Manual</h3>   

        </div><!-- End .heading-->

        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

        <div class="row-fluid">
            <div class="span12">
                <div class="box gradient">
                    <div class="title">
                        <h4>
                            <span>Installer Manual</span>
                        </h4>
                    </div>
                    <div class="content noPad clearfix">
                        <input type = "hidden" name="row_order" id="row_order" /> 
                        <table cellpadding="0" cellspacing="0" border="0" class="dynamicTable display table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>TITLE</th>
                                    <th>EDIT</th>
                                    <th>DELETE</th>
                                </tr>
                            </thead>
                            <tbody class="tsort">
                                
                                <?php $i=0;
                                if($product->product_subcontent!=''){
                                    $subproduct_list = json_decode($product->product_subcontent, TRUE);
                                        foreach ($subproduct_list as $subproduct_row) {
                                        ?>         


                                        <tr class="odd gradeX" id=''>
                                            <td><?php echo  $subproduct_row['title']; ?></td>
                                            <td><?php echo $subproduct_row['image']; ?><div style="height:30px; line-height:30px;"><a href="<?php echo base_url() . 'ecproductadmin/edit_subproduct/' . $i . '/' . $product->id; ?>" title="Edit Sub Product" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a> </div></td>
                                            <td>&nbsp; &nbsp; &nbsp;<a href="javascript:void(0)" title="Remove Sub Product" class="tip" onClick="linkRef('<?php echo base_url() . 'ecproductadmin/delete_subproduct/' . $i . '/' . $product->id; ?>')"><span class="icon12 icomoon-icon-remove"></span></a></td>
                                        </tr>
                                <?php $i++; } }?>                                        
                            </tbody>

                        </table>
                    </div>
                </div><!-- End .box -->
            </div><!-- End .span12 -->




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
</script>  
   
