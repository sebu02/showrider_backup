<style>
    .main_categrory {
        list-style-type: none;
    }

    .sub_category {

        list-style-type: none;
        margin: 10px 0px 0px 20px;
        clear: both;
    }

    .subcat_check {
        margin: 0px !important;
    }

    .label {
        margin-left: 10px;
        margin-bottom: 5px;
    }

    .tree, .tree ul {
        font: normal normal 14px/20px Helvetica, Arial, sans-serif;
        list-style-type: none;

        padding: 0;
        position: relative;
        overflow: hidden;
    }

    .tree li {
        margin: 0;
        padding: 0 12px;
        position: relative;
    }

    .tree li::before, .tree li::after {
        content: '';
        position: absolute;
        left: 0;
    }

    .tree li::before {
        border-top: 1px dotted #999;
        top: 10px;
        width: 10px;
        height: 0;
    }

    .tree li:after {
        border-left: 1px dotted #999;
        height: 100%;
        width: 0px;
        top: -10px;
    }

    .tree > li::after {
        top: 10px;
    }
    .subcat_check.nostyle {
        width: auto !important;
    }
    .subcat_check {
        width: auto !important;
    }
        .cat_left_radio{
        width: auto !important;
        position: relative;
        top: -2px;
    }
</style>

<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->

        <div class="heading">

            <h3>Manage Video Gallery</h3>                    



        </div><!-- End .heading-->

        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

        <div class="row-fluid">

            <div class="span12" >

                <div class="box">

                    <div class="title">

                        <h4> 
                            <span>Edit Video</span>
                        </h4>

                    </div>
                    <div class="content">

                        <form class="form-horizontal multiple_upload_form" action="<?php echo base_url() . 'contentadmin/editvideo/' . $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6) . '/' . $this->uri->segment(7); ?>" method="post" enctype="multipart/form-data" >
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <div class="error_messages">



                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                           <?php /*?> <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="normal">Order</label>
                                        <input class="span8" id="order_number" type="text" name="order_number"  value="<?php echo $videos->order; ?>" required />
                                        <span class="error">
                                            <?php echo form_error('order_number'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div><?php */?>
                            <?php 
                               $vData=json_decode($videos->video_code,TRUE);
                               $pos = $this->uri->segment(4);
//                               dump($pos);
//                               dump($vData[$pos]['video_source_title']);
                            ?>
                            <div class="form-row row-fluid">
                                <div class="form-row row-fluid source_wrap"  id="types"> 
                                        <div class="repeatvideoDiv">
                                            <div class="span12">
                                                <div class="form-row row-fluid">
                                                    <!--<div class="span2"></div>-->
                                                    <div class="span12">
                                                        <div class="row-fluid">
                                                            <div style="width:180px; height:auto; float:left; ">
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <label style="display:initial; margin:0px;">
                                                                    <div class="radio" id="uniform-cat">
                                                                        <input name="video" id="video1" value="YouTube Video Id" type="radio" <?php if($vData[$pos]['videotype']=='YouTube Video Id'){?>checked="true"<?php }?> onclick="labelvalue(this.value)">
                                                                    </div>&nbsp;&nbsp;YouTube Video Id
                                                                </label><br>
                                                            </div>
                                                            <div style="width:180px; height:auto; float:left; ">
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <label style="display:initial; margin:0px;">
                                                                    <div class="radio" id="uniform-cat">
                                                                        <input name="video" id="video2" value="Embed Code" type="radio" <?php if($vData[$pos]['videotype']=='Embed Code'){?>checked="true"<?php }?> onclick="labelvalue(this.value)">
                                                                    </div>&nbsp;&nbsp;Embed Code
                                                                </label><br>
                                                            </div>
                                                            <div style="width:180px; height:auto; float:left; ">
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <label style="display:initial; margin:0px;">
                                                                    <div class="radio" id="uniform-cat">
                                                                        <input name="video" id="video3" value="Url" type="radio" <?php if($vData[$pos]['videotype']=='Url'){?>checked="true"<?php }?> onclick="labelvalue(this.value)">
                                                                    </div>&nbsp;&nbsp;Url
                                                                </label><br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row-fluid sourceSection">
                                                    <label class="form-label span4" for="normal"><span class="textval"><?php echo $vData[$pos]['videotype'];?></span><b style="color:#F00; font-size:11px;">*</b></label>
                                                    <input class="span8 source_field"  type="text" name="source"  value='<?php echo $vData[$pos]['source'];?>'  required="required"/>
                                                    <span class="error"></span>
                                                </div>
                                                <div class="row-fluid">
                                                    <label class="form-label span4" for="normal">Video Title<b style="color:#F00; font-size:11px;">*</b></label>
                                                    <input class="span8 video_source_title"  type="text" name="video_source_title"  value="<?php echo $vData[$pos]['video_source_title'];?>"  required="required"/>
                                                    <span class="error"></span>
                                                </div>
                                                <div class="row-fluid">
                                                    <label class="form-label span4" for="normal">Video Order<b style="color:#F00; font-size:11px;">*</b></label>
                                                    <input class="span8 video_order"  type="number" name="video_order"  value="<?php echo $vData[$pos]['video_order'];?>"  required="required"/>
                                                    <span class="error"></span>
                                                </div>
                                                <div class="row-fluid">
                                                    <label class="form-label span4" for="normal">Video Description</label>
                                                    <textarea class="span8 video_source_desc" name="video_source_desc" rows="3"><?php echo $vData[$pos]['video_source_desc'];?></textarea>
                                                    <span class="error"></span>
                                                    <input type="hidden" id="final_videoResult" name="final_video" >
                                                </div>
                                            </div>
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
                                <button type="submit" class="btn btn-info showhide-btn" onclick="savevideoType()">Submit</button>

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
<script type="text/javascript">
    function labelvalue(checkValue) {

        $('.textval').text(checkValue);
    }
    function labelvalue1(classlast, checkValue) {

        $('.textval' + classlast).text(checkValue);
    }


    function savevideoType() {

        var new_video = [];
        $('#types div.repeatvideoDiv').each(function () {

            video_value = $(this).find("input[name^='video'][type=radio]:checked").val();
            source_value = $(this).find("input[name^='source']").val();
            video_source_value = $(this).find("input[name^='video_source_title']").val();
            video_desc_value = $(this).find("textarea[name^='video_source_desc']").val();
            new_video.push({videotype: video_value, source: source_value, video_source_title: video_source_value, video_source_desc: video_desc_value});
        });

//        console.log(JSON.stringify(new_video));
        document.getElementById("final_videoResult").value = JSON.stringify(new_video);

    }

</script>
   <script type="text/javascript">
       $(document).ready(function (){
        $(window).load(function(){ 
            $('.cat_left_radio').parents('.radio').removeClass('radio');
            $('.cat_left_radio').parent().css("float", "left");
        });
        
        $('.parent_checker').find('input[type=radio]').filter(':visible:first').prop('checked',true);
        $('.parent_checker1').find('input[type=radio]').filter(':visible:first').prop('checked',true);
        
      });

    </script>