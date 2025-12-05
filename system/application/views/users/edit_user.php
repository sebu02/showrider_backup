

<div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">

                    <h3>Manage Users</h3>                    

                    

                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                    <div class="row-fluid">

                      <div class="span6" style="width:70%; margin-left:15%;">

                            <div class="box">

                                <div class="title">

                                    <h4> 
                                        <span>Editing Users</span>
                                    </h4>
                                    
                                </div>
                                <div class="content">
                                   
                                    <form class="form-horizontal" action="<?php echo base_url().'useradmin/edituser?id='.$user_details->id ; ?>" method="post" enctype="multipart/form-data" >
                                    
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
                                    <label class="form-label span4" for="normal">First name * </label>
                                    <input class="span8" id="firstname" type="text" name="firstname"  required value="<?php echo $user_details->firstname; ?>" />
                                    <span class="error">
                                        <?php echo form_error('firstname'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                              
                                        
                         <div class="form-row row-fluid ">
                            <div class="span12">
                                <div class="row-fluid">
                                   <label class="form-label span4" for="normal">Phone * </label>
                                    <input class="span8" id="phone" type="number" name="phone"  required value="<?php echo $user_details->phone; ?>" />
                                    <span class="error">
                                        <?php echo form_error('phone'); ?>
                                    </span>
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
   	 	<script type="application/javascript"> 
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
        
 
<script type="application/javascript"> 
$(document).ready(function() {       
        
			
			
					$( "#username" ).keyup(function() {
					
								var string =$( "#username" ).val();
								var string = string.replace(/[^a-zA-Z0-9,#]/g,'');	
								var string = string.replace('#','');								
								var string = string.toLowerCase(); 					
								$( "#username" ).val(string);
		
					});
				
		
});
</script>


