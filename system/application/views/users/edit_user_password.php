

<div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">

                    <h3>Manage User</h3>                    

                    

                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                    <div class="row-fluid">

                      <div class="span6" style="width:70%; margin-left:15%;">

                            <div class="box">

                                <div class="title">

                                    <h4> 
                                        <span>Change Password</span>
                                    </h4>
                                    
                                </div>
                                <div class="content">
                                   
                                    <form class="form-horizontal" action="<?php echo base_url().'useradmin/change_user_password?id='.$user_details->id ; ?>" method="post" enctype="multipart/form-data" />
                                    
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
                                                  <label class="form-label span4" for="normal">Username * </label>
                                                    <input class="span8" id="username" type="text" name="username" readonly value="<?php echo $user_details->username; ?>" />
                                                     <span class="error">
						<?php echo form_error('username');?>
                                                     </span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    

                                        
                                        
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span4" for="normal">Password * </label>
                                                    <input class="span8" id="normalInput" type="password" name="password"  required value="<?php echo set_value('password') ; ?>" />
                                                     <span class="error">
				<?php echo form_error('password');?>
                                                     </span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <?php
										
//					dump($user_details);					
                                    $meta_password=$user_details->passwords;

                                    $msg1 = $meta_password;
                                    //$key1 = 'gl-godland';
                                    $encrypted_string1 = $this->encryption->decrypt($msg1);

                                     $old_password= $encrypted_string1 ;

										?>
                                        
                                        <input class="span8" id="normalInput" type="hidden" name="oldpassword" value="<?php echo $old_password ; ?>" />
                                        
                                        
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span4" for="normal">Confirm Password * </label>
                                                    <input class="span8" id="normalInput" type="password" name="password2"  required value="<?php echo set_value('password2') ; ?>" />
                                                     <span class="error">
													<?php echo form_error('password2');?>
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