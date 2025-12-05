<script type="text/javascript">
    $(document).ready(function ()
    {
        $("#slug").keyup(function () {

            var string = $("#slug").val();
            var string = string.replace(/[^a-zA-Z0-9]/g, '-');

            var string = string.replace(/\-+/g, '-');

            var string = string.toLowerCase();

            $("#slug").val(string);

        });


        $("#catname").keyup(function () {

            var string = $("#catname").val();
            var string = string.replace(/[^a-zA-Z0-9]/g, '-');

            var string = string.replace(/\-+/g, '-');

            var string = string.toLowerCase();

            $("#slug").val(string);

        });






    });
</script>

<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->

        <div class="heading">

            <h3>Manage Content</h3>                    



        </div><!-- End .heading-->

        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

        <div class="row-fluid">

            <div class="span6" style="width:70%; margin-left:15%;">

                <div class="box">

                    <div class="title">

                        <h4> 
                            <span>Add Subcategory</span>
                        </h4>

                    </div>
                    <div class="content">

                        <form class="form-horizontal multiple_upload_form" action="<?php echo base_url() . 'contentadmin/addsubcategory/'; ?>" method="post" enctype="multipart/form-data" >

                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <div class="error_messages">



                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="checkboxes">Select Category</label>
                                        <div class="span8 controls">   
                                            <select name="parentname" required>
                                                <option value="" >--Select--</option>
                                                <?php
                                                foreach ($categorylist as $cat) {
                                                    ?>
                                                    <option value="<?php echo $cat['id']; ?>" <?php echo set_select('cat', $cat['id']); ?>><?php echo $cat['name']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <span class="error">
                                                <?php echo form_error('parentname'); ?>
                                            </span>
                                        </div> 
                                    </div>
                                </div> 
                            </div>




                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="normal">SubCategory Name</label>
                                        <input class="span8" id="catname" type="text" name="catname" value="<?php echo set_value('catname'); ?>" required />
                                        <span class="error">
                                            <?php echo form_error('catname'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="normal">Slug/Url Name</label>
                                        <input class="span8 read-slug" readonly="true" id="slug" type="text" name="slug" value="<?php echo set_value('slug'); ?>" required />
                                         <span class="right manipTxt slugShow"><a onclick="slugShow()" class="icomoon-icon-pencil">Write Mode On</a></span>
                                        <span class="right manipTxt slugHide" style="display: none;"><a onclick="slugHide()" class="icomoon-icon-link-5">Write Mode Off</a></span>
                                        <span class="error">
                                            <?php echo form_error('slug'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="normal">Order</label>
                                        <input class="span8" id="order_number" type="number" name="order_number"  value="<?php
                                        if (isset($_POST['order_number']) && $_POST['order_number'] != '') {
                                            echo set_value('order_number');
                                        } else {
                                            echo '0';
                                        }
                                        ?>" required />
                                        <span class="error">
                                               <?php echo form_error('order_number'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                             <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <input type="hidden" id="preferences" value="">
                                        <input type="hidden" id="allowed_types" value="">
                                        <input type="hidden" id="max_size" value="">
                                        <input type="hidden" id="max_width" value="">
                                        <input type="hidden" id="max_height" value="">
                                        <input type="hidden" id="manipulation" value="">
                                        <label class="form-label span4" for="combo">Select File Property</label>
                                        <div class="span8 controls comboset">  
                                            <select name="combo" id="combo" class="combo">
                                                <?php
                                                foreach ($values as $combos) {
                                                    if ($combos->manipulation_status == 'Yes') { // (IMG_MANIPULATION_COMBO) when need all combos remove this condition
                                                    ?>
                                                    <option data-pref='<?php echo $combos->preferences; ?>' data-manip='<?php echo $combos->manipulation_status; ?>' value="<?php echo $combos->fid; ?>" <?php if(isset($_POST['combo'])){if($_POST['combo']==$combos->fid){ echo 'selected'; }} ?> ><?php echo $combos->combo_name; ?></option>
                                                <?php } } ?>

                                            </select>
                                        </div>
                                        <span class="error">
                                            <?php echo form_error('combo'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                             <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="normal">Category Picture</label>
                                        <input type="file"  class="ngo_proof_attach_input_file span8" name="images[]" id="images"  required>
                                        <div class="upload_note span12">
                                            <span class="span4"></span> <span class="span8">Size:Below&nbsp;<span class="textSize"></span>  MB for each file<span class="dimensions">, width:&nbsp;<span class="textWidth"></span> px, Height:&nbsp;<span class="textHeight"></span> px</span></span>
                                            <span class="manipTxt"><a onclick="manipToggle()">Show Manipulations</a></span>
                                        </div>
                                        <div class="ImageManipulation">
                                        </div>
                                        <div class="preloader5">
                                            <span class="uploading" style="display:none;text-align: center;"><img src="<?php echo base_url(); ?>static/adminpanel/images/loaders/horizontal/018.gif" alt="" style="display: block;margin: 0 auto;"/></span>
                                        </div>
                                        <span id="output"></span>
                                        <ul class="image1 add_new_image1" id="sortable"></ul>
                                        <input type="hidden" name="final_images" value="<?php echo set_value('final_images'); ?>" id="final_images">
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
                                <button type="submit" class="btn btn-info showhide-btn" onclick="saveOrder()">Submit</button>

                            </div>


                        </form>

                    </div>

                </div><!-- End .box -->

            </div><!-- End .span6 --><!-- End .span6 --><!-- End .span6 -->


        </div><!-- End .row-fluid --><!-- End .row-fluid --><!-- End .row-fluid --><!-- End .row-fluid -->





    </div><!-- End contentwrapper -->
</div>
<!--    file upload js-->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="application/javascript" src="<?php echo base_url() . 'static/'; ?>ajaxupload/js/jquery.form.js"></script>   
       
    <script type="text/javascript">
        $(document).ready(function () {
            
            $('#images').on('change', function () {
                var finalImages=$('#final_images').val();
                
                if(finalImages==''){
                    
                //validation

                var check1 = 0;
                var check2 = 0;
                var check3 = 0;
                var check4 = 0;

                if (window.File && window.FileReader && window.FileList && window.Blob) {

                    if (!$('#images').val()) //check empty input filed
                    {
                        $("#output").html("Please choose your Image !");

                        check2 = 1;

                    } else {

                        check2 = 0;
                    }

                    // var fsize = $('#images')[0].files[0].size; //get file size

                    var ftype = $('#images')[0].files[0].type; // get file type


                    var result = $('#images')[0].files;

                    for (var x = 0; x < result.length; x++) {
                        var fle = result[x];
                        // console.log(fle.size);  
                        var fsize = fle.size;
                        var maxSize = $("#max_size").val();
                        var fileSize = maxSize * 1048576;

                        //Allowed file size is less than 5 MB (1048576)
                        if (fsize > fileSize)
                        {
                          $("#output").html("<b>" + bytesToSizenotrounded(fsize) + "</b>" + fle.name + " is too big, it should be less than "+ bytesToSizenotrounded(fileSize));
                            check4 = 1;
                            throw new Error("File Size Is Maximum!");
                        } else
                        {
                            check4 = 0;

                        }
                    }



                } else
                {
                    //Output error to older unsupported browsers that doesn't support HTML5 File API
                    $("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
                    check1 = 1;
                }


                //validation


                var checktotal = check1 + check2 + check3 + check4;


                if (checktotal == 0) {

                    var formUrl = "<?php echo base_url() . 'contentadmin/bannerUpload'; ?>";

                    var files = new FormData($(".multiple_upload_form")[0]);

                    $.ajax({
                        url: formUrl,
                        type: 'POST',
                        data: files,
                        mimeType: "multipart/form-data",
                        beforeSend: function () {
                            $('.uploading').show();
                            $('.showhide-btn').prop('disabled', true);

                        },
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (data, textSatus, jqXHR) {
                            //now get here response returned by PHP in JSON fomat you can parse it using JSON.parse(data)

                            $('.uploading').hide();
                             $('.showhide-btn').prop('disabled', false);

                            if (data.indexOf('***') != -1)
                            {

                            } else
                            {

                                //$('.image1').html('');
                                var imagearray = data.split(",");

                                var filecount = $(".imagedivs").length;

                                for (i = 0; i < imagearray.length; i++)
                                {

                                    if (imagearray[i])
                                    {

                                        var imgcount = filecount + i;

                                        var imagearray2 = "'" + imagearray[i] + "','" + imgcount + "'";

                                        if ($('#manipulation').val() == 'No') {

                                            $('.image1').append('<li class="ui-state-default productfile' + imgcount + ' imagedivs ngo_imagedivs" id="' + imagearray[i] + '" > <span aria-hidden="true" style=font-size:25px;" class="icon icomoon-icon-file-6"></span>&nbsp;&nbsp;&nbsp;<span class="deleteimage"  onClick="deleteproductimage(' + imagearray2 + ');" style="cursor:pointer;">X</span><br><a href="<?php echo base_url() . 'media_library/'; ?>' + imagearray[i] + '" target="_blank">' + imagearray[i] + '</a></li>');
                                        } else {

                                            $('.image1').append('<li class="ui-state-default productfile' + imgcount + ' imagedivs ngo_imagedivs" id="' + imagearray[i] + '" ><img width="100" height="100" src="<?php echo base_url() . 'media_library/'; ?>' + imagearray[i] + '">&nbsp;&nbsp;&nbsp;<span class="deleteimage"  onClick="deleteproductimage(' + imagearray2 + ');" style="cursor:pointer;">X</span><a href="<?php echo base_url() . 'media_library/'; ?>' + imagearray[i] + '" rel="prettyPhoto" title="' + imagearray[i] + '" class="txtcenter">' + imagearray[i] + '</a></li>');
                                            prettyPhotoLoad();
                                        }
                                    }

                                }

                               $('#images').val('');

                                $('#output').html('');

                            }


                            saveOrder();
                        }
                    });
                }
               }
            });

   

        });
    </script>

    <!--  combo values assigning  -->
    <script type="text/javascript">
        $(document).ready(function () {

            fileData();
            manipulationData();
            checkfilevalidation();
            setcheckFIle();
            
            $(".comboset").on('change', '.combo', function () {

                fileData();
                manipulationData();
                removeAllfiles();
            });
        });
    </script>
    <!--  End of combo values assigning  -->




    <script type="text/javascript">

        //      image popup function
        function prettyPhotoLoad() {

            $("a[rel^='prettyPhoto']").prettyPhoto({
                default_width: 800,
                default_height: 600,
                theme: 'facebook',
                social_tools: false,
                show_title: true
            });
        }
        //     End of image popup function  


        //      file sorting function
        $(function () {
            $("#sortable").sortable();
            $("#sortable").disableSelection();
        });
        //  End of  file sorting function 


        //      file order save function
        function saveOrder() {
            
            checkfilevalidation();
            
            var new_order = new Array();
            $('ul#sortable li').each(function () {
                new_order.push($(this).attr("id"));
            });
            document.getElementById("final_images").value = new_order;
        }
        //    End of  file order save function    


        //      file configurations fetch function 

        function fileData() {
            var prefernces = $('.combo option:selected').attr('data-pref');
            var manipulation = $('.combo').find(':selected').attr('data-manip');

            var myObj = $.parseJSON(prefernces);

            $("#preferences").val(prefernces);
            $("#allowed_types").val(myObj.allowed_types);
            $("#max_size").val(myObj.max_size);
            $("#max_width").val(myObj.max_width);
            $("#max_height").val(myObj.max_height);
            $("#manipulation").val(manipulation);
            $(".textSize").text(myObj.max_size);
            $(".textWidth").text(myObj.max_width);
            $(".textHeight").text(myObj.max_height);

            if (myObj.max_width == false) {

                $(".dimensions").css('display', 'none');

            } else {

                $(".dimensions").css({'display': 'block',
                    'float': 'right',
                    'margin-right': '119px'
                });
            }


        }

        //   End of   file configurations fetch function 


        //      file size byte to mb conversion function 
        function bytesToSizenotrounded(bytes) {

            if (bytes == 0)
                return '0 Bytes';
            var floatmb = (bytes / 1048576).toFixed(2) + "MB";
            return floatmb;

        }
        //  End of  file size byte to mb conversion function 

        //  Manipulation Div hide show
            function manipToggle(bytes) {

               $(".ImageManipulation").slideToggle();

             }

        // End of Manipulation Div hide show
        // Manipulation detauls fetch 
        function manipulationData() {;
            var manip = $('#manipulation').val();
            if (manip == 'Yes') {

                var comboid = $('#combo').val();
                var dataString = "comboid=" + comboid;

                var base_url = $(".base_url").val();
                $.ajax({
                    type: "POST",
                    url: base_url + "contentadmin/fetchManipdata/",
                    data: dataString,
                    cache: false,
                    success: function (html) {

                                $('.ImageManipulation').html(html);
                                
                    }
                });

            }else{
                
                $('.ImageManipulation').html('');
            }
        }
        //End of Manipulation detauls fetch
        
//        element remove function from array
        function remove(array, element) {
            const index = array.indexOf(element);
            array.splice(index, 1);
        }
 //      End of  element remove function from array      
  
//      file delete function 
       function deleteproductimage(img, count) {



           ajaxindicatorstart('please wait..');

           var dataString = "img=" + img;

           var base_url = $(".base_url").val();
           $.ajax({
               type: "POST",
               url: base_url + "contentadmin/delete_upload_image/",
               data: dataString,
               cache: false,
               success: function (html) {

                   if (html == 'yes')
                   {
                       $('.productfile' + count).remove();

                       var finalImages=$('#final_images').val();
                       var fileArray=[];
                       var fileArray = finalImages.split(",");
                       remove(fileArray, img);
                       var newstr = fileArray.toString(); 
                       $('#final_images').val(newstr);

                       ajaxindicatorstop();

                   }

               }
           });
       }
       //   End of  file delete function   

//      file delete on change function  
function removeAllfiles() {

    var finalFiles = $('#final_images').val();

    if (finalFiles != '') {

        var base_url = $(".base_url").val();
        var dataString = "finalFiles=" + finalFiles;

        $.ajax({
            type: "POST",
            url: base_url + "contentadmin/deleteFilechange/",
            data: dataString,
            cache: false,
            success: function (html) {

                if (html == 'yes')
                {
                    $('.image1').html("");
                    $('#final_images').val("");
                }

            }
        });
    }

}
//  End of file delete on change function    
        
//        file type required add/remove
        function checkfilevalidation(){

            if($('#final_images').val()==''){

               $("#images").attr("required");

            }else{

                $("#images").removeAttr("required");
            }

        }
 //        End of file type required add/remove 
 
// set filename after loading
  function setcheckFIle(){
      
      var valFile=$('#final_images').val();
      
      if(valFile!=''){
          
          var fileArray = valFile.split(",");
          
          var filecount = $(".imagedivs").length;

            for (i = 0; i < fileArray.length; i++)
            {

                if (fileArray[i])
                {

                    var imgcount = filecount + i;

                    var fileArray2 = "'" + fileArray[i] + "','" + imgcount + "'";

                    if ($('#manipulation').val() == 'No') {

                        $('.image1').append('<li class="ui-state-default productfile' + imgcount + ' imagedivs ngo_imagedivs" id="' + fileArray[i] + '" > <span aria-hidden="true" style=font-size:25px;" class="icon icomoon-icon-file-6"></span>&nbsp;&nbsp;&nbsp;<span class="deleteimage"  onClick="deleteproductimage(' + fileArray2 + ');" style="cursor:pointer;">X</span><br><a href="<?php echo base_url() . 'media_library/'; ?>' + fileArray[i] + '" target="_blank">' + fileArray[i] + '</a></li>');
                    } else {

                        $('.image1').append('<li class="ui-state-default productfile' + imgcount + ' imagedivs ngo_imagedivs" id="' + fileArray[i] + '" ><img width="100" height="100" src="<?php echo base_url() . 'media_library/'; ?>' + fileArray[i] + '">&nbsp;&nbsp;&nbsp;<span class="deleteimage"  onClick="deleteproductimage(' + fileArray2 + ');" style="cursor:pointer;">X</span><a href="<?php echo base_url() . 'media_library/'; ?>' + fileArray[i] + '" rel="prettyPhoto" title="' + fileArray[i] + '" class="txtcenter">' + fileArray[i] + '</a></li>');
                        prettyPhotoLoad();
                    }
                }

            }                     
      }
  }
  // End of set filename after loading
    </script>
    <!-- End of   file upload js-->
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