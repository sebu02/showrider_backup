<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->
        <div class="heading">
            <h3>VIEW CONTENT VIDEOS</h3>   

        </div><!-- End .heading-->

        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

        <div class="row-fluid">
            <div class="span12">
                <div class="box gradient">
                    <div class="title">
                        <h4>
                            <span>VIDEOS</span>
                        </h4>
                    </div>
                    <div class="content noPad clearfix">

                        <table cellpadding="0" cellspacing="0" border="0" class="dynamicTable display table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>TITLE</th>
                                    <th>VIDEO</th>                                    
                                    <th>DELETE</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
  
//                                $images= json_decode($values->images,TRUE);
                                $videos= json_decode($values->video_code,TRUE);

                                $k = 0;
                                $ii = 1;
                                
                              if($videos!=''){  
                                foreach ($videos as $vid) {

                                    if ($vid != '') {
                                        ?>         


                                        <tr class="odd gradeX">
                                            <td><?php echo $values->title; ?></td>
                                            <td><?php 
                                                  echo $vid['videotype'].'<br>'.$vid['video_source_title'];                                            
                                            ?><div style="height:30px; line-height:30px;"><a href="<?php echo base_url().'contentadmin/editvideo/'.$values->id.'/'.$k ?>" title="Edit Video" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a> </div></td>
                                            
                                            <td>&nbsp; &nbsp; &nbsp;<a href="#" title="Remove Image" class="tip" onClick="linkRef('<?php echo base_url().'contentadmin/delete_content_video/'.$values->id.'/'.$k ?>')"><span class="icon12 icomoon-icon-remove"></span></a></td>
                                        </tr>


                                        <?php }
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
        if (confirm("do you really want to Delete ?")) {
            window.location.href = linkref;
        }
    }
</script>   