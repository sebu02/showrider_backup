<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->
        <div class="heading">
            <h3>VIEW CONTENT IMAGES</h3>   

        </div><!-- End .heading-->

        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

        <div class="row-fluid">
            <div class="span12">
                <div class="box gradient">
                    <div class="title">
                        <h4>
                            <span>Images</span>
                        </h4>
                    </div>
                    <div class="content noPad clearfix">

                        <table cellpadding="0" cellspacing="0" border="0" class="dynamicTable display table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>IMAGE</th>
                                    <th>COPY</th>
                                    <th>DELETE</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $images = json_decode($values->images2, TRUE);

                                $k = 0;
                                $ii = 1;
                                if (!empty($images)) {

                                foreach ($images as $im) {
                                        
                                        $media_values = $this->content_model->list_news_gallery($im['media_id']);
                                        $imagesnew = $media_values->id;


//                                    if ($im != '') {
                                            ?>         


                                            <tr class="odd gradeX">
                                                <td><?php // echo $media_values->title; ?></td>
                                                <td> <img src="<?php echo base_url() . 'media_library/' . $im['image']; ?>" width="100" /> <div style="height:30px; line-height:30px;"><a href="<?php echo base_url() . 'contentadmin/edit_content_image2/' . $values->id . '/' . $k ?>" title="Edit Image" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a> </div></td>
                                                <td><button class="btn btn_copy" data-clipboard-text="<?php echo base_url() . 'media_library/' . $im['image']; ?>"><span class="icon16 icomoon-icon-clipboard"></span>Copy Image URL</button></td>
                                                <td>&nbsp; &nbsp; &nbsp;<a href="#" title="Remove Image" class="tip" onClick="linkRef('<?php echo base_url() . 'contentadmin/delete_content_image2/' . $values->id . '/' . $k ?>')"><span class="icon12 icomoon-icon-remove"></span></a></td>
                                            </tr>



                                            <?php
//                                    }
                                        $ii++;
                                        $k++;
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
        if (confirm("do you really want to Delete ?")) {
            window.location.href = linkref;
        }
    }
</script>   