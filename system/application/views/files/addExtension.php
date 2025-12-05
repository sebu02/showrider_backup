

<div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">

                    <h3>Manage File Upload</h3>                    

                    

                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                    <div class="row-fluid">

                      <div class="span6" style="width:70%; margin-left:15%;">

                            <div class="box">

                                <div class="title">

                                    <h4> 
                                        <span>Add Extension</span>
                                    </h4>
                                    
                                </div>
                                <div class="content">
                                   
                                    <form class="form-horizontal extensionForm" action="<?php echo base_url().'fileuploadadmin/addExtension/' ; ?>" method="post" enctype="multipart/form-data" >
                                    <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                  <div class="error_messages">
                                              
                                           
                                           
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                        
<input type="hidden" name="name" value="1">
                                        
                                    
                                        <script type="text/javascript">
                                                $(document).ready(function() {
                                                 var max_fields      = 10; //maximum input boxes allowed
                                                 var wrapper         = $(".input_fields_wrap"); //Fields wrapper
                                                 var add_button      = $(".add_field_button"); //Add button ID

                                                 var x = 1; //initlal text box count
                                                 $(add_button).click(function(e){ //on add input button click
                                                  e.preventDefault();
                                                  if(x < max_fields){ //max input box allowed
                                                   x++; //text box increment
                                                   $(wrapper).append('<div><div class="form-row row-fluid"><div class="span12"><div class="row-fluid"><label class="form-label span4" for="normal">Extension<b style="color:#F00; font-size:11px;">*</b></label><input class="span8" id="suffix" type="text" name="suffix[]"  value="<?php echo set_value('suffix') ; ?>" required /><span class="error"><?php echo form_error('suffix');?></span></div></div></div><div class="form-row row-fluid"><div class="span12"><div class="row-fluid"><label class="form-label span4" for="textarea">Media Type<b style="color:#F00; font-size:11px;">*</b></label><div class="file_box" style="margin-bottom:5px; margin-top:5px;"> <textarea class="span8 elastic tinymce" id="mediatype" name="mediatype[]"  required/><?php echo set_value('mediatype') ;?></textarea></div><span class="error"><?php echo form_error('mediatype');?></span></div></div></div>&nbsp;<a href="#" class="remove_field right">Remove</a></div><br>'); //add input box
                                                  }
                                                 });

                                                 $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                                                  e.preventDefault(); $(this).parent('div').remove(); x--;
                                                 });
                                                });
                                       </script>
                                       <div class="form-row row-fluid input_fields_wrap">
                                         <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span4" for="normal">Extension<b style="color:#F00; font-size:11px;">*</b></label>
                                                    <input class="span8" id="suffix" type="text" name="suffix[]"  value="<?php echo set_value('suffix') ; ?>" required />
                                                    <span class="error">
							<?php echo form_error('suffix');?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span4" for="textarea">Media Type<b style="color:#F00; font-size:11px;">*</b></label>
                                                       <div class="file_box" style="margin-bottom:5px; margin-top:5px;"> <textarea class="span8 elastic tinymce" id="mediatype" name="mediatype[]"  required/><?php echo set_value('mediatype') ;?></textarea></div>
                                                         <span class="error">
							    <?php echo form_error('mediatype');?>
                                                         </span>
                                                </div>                                           
                                            </div>
                                       </div>
                                     </div><button class="add_field_button right" type="button">Add Next Extension</button>
                                      
                                                
                                 
                           

                                        
                                        
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

        <?php if($this->session->flashdata('message'))
		 {
		 ?>
<script type="text/javascript"> 
			$(document).ready(function() {
				//Regular success
				
					$.pnotify({
						type: 'success',
						title: '<?php echo $this->session->flashdata('message') ;?>',
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