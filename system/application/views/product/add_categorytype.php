<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->
        <div class="heading">

            <h3>Manage Category Types</h3>                    

        </div><!-- End .heading-->

        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

        <div class="row-fluid">

            <div class="span6" style="width:70%; margin-left:15%;">

                <div class="box">

                    <div class="title">

                        <h4> 
                            <span>Add Category Type</span>
                        </h4>

                    </div>
                    <div class="content">
                        <form class="form-horizontal extensionForm" action="<?php echo base_url() . 'ecproductadmin/add_categorytype/'?>" method="post" enctype="multipart/form-data" >
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <div class="error_messages">
                                            <?php echo form_error('input_name[]'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                               <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">

                                        <label class="form-label span4" for="checkboxes">Choose The Category Type</label>

                                        <div class="span8 controls">
                                            <?php
                                            if($main_category_types!=NULL){
                                                foreach ($main_category_types as $main_key=>$main_cat_type){?>
                                                    <div class="left marginT5"> 
                                                        <input type="radio" name="category_type" 
                                                               value="<?php echo $main_cat_type->category_type_value.'|'.$main_cat_type->id; ?>" 
                                                            <?php
                                                                if (isset($_POST['category_type'])) {
                                                                    if ($_POST['category_type'] == $main_cat_type->category_type_value){
                                                                        echo "checked='checked'";
                                                                    }
                                                                }else if($main_key==0){
                                                                        echo "checked='checked'";
                                                                }
                                                            ?> />
                                                        <?php echo $main_cat_type->category_type_name; ?>
                                                    </div>
                                            <?php  }
                                            }
                                            ?>
                                        </div>
                                    </div>

                                </div>
                            </div> 
                            <div class="gl_price">
                                <div class="form-row row-fluid input_fields_wrap">
                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span4" for="normal">Category Type<b style="color:#F00; font-size:11px;">*</b></label>
                                                <input class="span5" id="input_name" type="text" name="input_name[]"  value="<?php echo set_value('input_name[]'); ?>" required />
                                                <span class="error">

                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="add_field_button right " type="button">Add New Category</button>


                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">

                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-info">Submit</button>

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
<!--Script to add dynamic input field-->
<script type="text/javascript">
    $(document).ready(function () {
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function (e) { //on add input button click
            e.preventDefault();
            append_string(max_fields,x,wrapper);
        });

        $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
            e.preventDefault();
            // $(this).parent('div').remove();
            $(this).parent().parent().parent().remove();
            /*Here Remove is placed inside nested divs of level3
             * That is the reason of 3 parent().parent.parent()
             * */ 
            x--;
        });
    });
    
    
    function append_string(max_fields,x,wrapper){
             if (x < max_fields) { //max input box allowed
                x++; //text box increment
                var appendstr = "<div class='form-row row-fluid'>" +
                        "<div class='span12'>" +
                        "<div class='row-fluid'>" +
                        "<label class='form-label span4' for='normal'>Category Type<b style='color:#F00; font-size:11px;'>*</b></label>" +
                        "<input class='span5' id='suffix' type='text' name='input_name[]'  value='<?php echo set_value('input_name[]'); ?>' required />" +
                        "<a href='#' class='remove_field'>Remove</a>" +
//                        "<span class='error'><?php // echo form_error('input_name[]'); ?></span>" +
                        "</div>" +
                        "</div>" +
                        "</div>";

                $(wrapper).append(appendstr); //add input box
            }
    }
    
    
function unique_handling(){
  var obj = {};
  var status_check = 1;
  $("#suffix").each(function(){
    if($(this).value === "") {
      alert("Value can't be empty");
        $(this).focus();
        status_check = status_check*0;
        return false;
    }else if(obj.hasOwnProperty($(this).value)) {
        
      alert("There is a duplicate value " +  $(this).value);
      status_check = status_check*0;
        return false;
    } else {
      obj[$(this).value] =   $(this).value;
    }
  });
  
//  other way
      var current_value = $(this).val();
  $(this).attr('value',current_value);
console.log(current_value);
    if ($('#suffix[value="' + current_value + '"]').not($(this)).length > 0 || current_value.length == 0 ) {
      $(this).focus();
        alert('You cannot use this');
    }
//  End of other way
  
  return status_check;
}


</script>
<!-- End of Script to add dynamic input field-->