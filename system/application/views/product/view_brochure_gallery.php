<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->
        <div class="heading">
            <h3>VIEW BROCHURES</h3>   

        </div><!-- End .heading-->

        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

        <div class="row-fluid">
            <div class="span12">
                <div class="box gradient">
                    <div class="title">
                        <h4>
                            <span>Brochures</span>
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

                                <?php
                                $i = 0;
                                if ($product->brochure_file != '') {
                                    $brochure_img = json_decode($product->brochure_file, TRUE);
                                    foreach ($brochure_img as $brohure) {
                                        ?>         


                                        <tr class="odd gradeX" id=''>
                                            <td><?php echo $product->prod_name; ?>  - <a href="<?php echo base_url().'media_library/'.$brohure['image']; ?>" title="View Brochure" class="tip" target="_blank">View</a></td>
                                            <td><?php echo $brohure['image']; ?><div style="height:30px; line-height:30px;"><a href="<?php echo base_url() . 'ecproductadmin/edit_product_brochure/' . $i . '/' . $product->id . '/' . $this->uri->segment(4); ?>" title="Edit Brochure" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a> </div></td>
                                            <td>&nbsp; &nbsp; &nbsp;<a href="#" title="Remove Brochure" class="tip" onClick="linkRef('<?php echo base_url() . 'ecproductadmin/delete_product_brochure/' . $i . '/' . $product->id . '/' . $this->uri->segment(4); ?>')"><span class="icon12 icomoon-icon-remove"></span></a></td>
                                        </tr>
                                        <?php
                                        $i++;
    }
                                }
                                ?>                                        
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

