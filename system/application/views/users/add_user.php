

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
                                        <span>Add User</span>
                                    </h4>
                                    
                                </div>
                                <div class="content">
                                   
                                    <form class="form-horizontal" action="<?php echo base_url().'useradmin/add_users/' ; ?>" method="post" enctype="multipart/form-data" />
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
                                                    <label class="form-label span4" for="normal">Name</label>
                                                    <input class="span8" id="firstname" type="text" name="firstname"  value="<?php echo set_value('firstname') ; ?>" required />
                                                    <span class="error">
													<?php echo form_error('firstname');?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        
                                       <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span4" for="normal">Email Address (Username)</label>
                                                    <input class="span8" id="email" type="email" name="email"  value="<?php echo set_value('email') ; ?>" required />
                                                    <span class="error">
													<?php echo form_error('email');?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                         <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span4" for="normal">Phone Number</label>
                                                    <input class="span8" id="phone" type="text" name="phone"  value="<?php echo set_value('phone') ; ?>" required />
                                                    <span class="error">
													<?php echo form_error('phone');?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span4" for="normal">Password</label>
                                                    <input class="span8" id="passwd1" type="password" name="passwd1"  value="<?php echo set_value('passwd1') ; ?>" required />
                                                    <span class="error">
													<?php echo form_error('passwd1');?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span4" for="normal">Confirm Password</label>
                                                    <input class="span8" id="passwd2" type="password" name="passwd2"  value="<?php echo set_value('passwd2') ; ?>" required />
                                                    <span class="error">
													<?php echo form_error('passwd2');?>
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