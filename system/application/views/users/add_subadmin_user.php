

<div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">

                    <h3>Manage Subadmin Users</h3>                    

                    

                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                    <div class="row-fluid">

                      <div class="span12" >

                            <div class="box">

                                <div class="title">

                                    <h4> 
                                        <span>Add Subadmin User</span>
                                    </h4>
                                    
                                </div>
                                <div class="content">
                                   
                                    <form class="form-horizontal" action="<?php echo base_url().'useradmin/add_subadmin_users/' ; ?>" method="post" enctype="multipart/form-data" />
                                    <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                  <div class="error_messages">
                                              
                                           
                                           
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
 
<?php
$user_type_array = array(
//'super' => 'Super Admin',
//'admin' => 'Administrator',
'subadmin' => 'Sub Admin',
);

if($this->common_model->option->dealer_subadmin_status == 'yes')
{
$user_type_array = array(
'dealeradmin' => 'Dealer Admin',
);
}

?>                                        

                      <div class="form-row row-fluid ">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" >Status</label>
                                        <div class="span8 controls">
                                        
<?php
foreach($user_type_array as $userkey=>$uservalue)
{
?>                                        
                            <div class="left marginT5">
                            <label>
                                <input type="radio" name="usertype"  value="<?php echo $userkey ; ?>" <?php
                                if (isset($_POST['usertype'])) {
                                    if ($_POST['usertype'] == $userkey)
                                        echo 'checked';
                                }
								else
								{
								echo 'checked';	
								}
                                
                                ?> />
                                <?php echo ucwords($uservalue) ; ?>
                                </label>
                            </div>
 <?php
}
?>
                                   
                                        </div>
                                    </div>
                                </div>
                            </div>
                                        
                                        <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span4" for="normal">Name</label>
                                                    <input class="span8" id="name" type="text" name="name"  value="<?php echo set_value('name') ; ?>" required />
                                                    <span class="error">
													<?php echo form_error('name');?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        
                                       <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span4" for="normal">Username</label>
                                                    <input class="span8" id="username" type="text" name="username"  value="<?php echo set_value('username') ; ?>" required />
                                                    <span class="error">
													<?php echo form_error('username');?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                         <div class="form-row row-fluid">
                                            <div class="span12">
                                                <div class="row-fluid">
                                                    <label class="form-label span4" for="normal">Phone Number</label>
                                                    <input class="span8" id="phone" type="number" name="phone"  value="<?php echo set_value('phone') ; ?>" required />
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
                                        
<?php
if($this->session->userdata('logged_admin_type') == 'super' || $this->session->userdata('logged_admin_type') == 'admin')
{
?>                                        

                                <div class="title">
                                    <h4> 
                                        <span>Location Setting</span>
                                    </h4>
                                </div>
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <div class="span12 controls">
                                                <div class="title opdwn">
                                                    <h4>
                                                        <span class="icon16 icomoon-icon-copy"></span>
                                                        <span>Country</span>
                                                    </h4>  
                                                    <a href="#" class="maximize">maximize</a>
                                                </div>
                                                <div class="content opdwn">
                                                    <div class="row-fluid gl_country_block">
                                                        <?php
                                                        $loc_data = array(0 => array("parent_location" => 0));
                                                        $data['loc_data'] = $loc_data;
                                                        $this->load->view('users/location_block', $data);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span12 controls">
                                                <div class="title opdwn">
                                                    <h4>
                                                        <span class="icon16 icomoon-icon-copy"></span>
                                                        <span>Emirates</span>
                                                    </h4>  
                                                    <a href="#" class="maximize">maximize</a>
                                                </div>
                                                <div class="content opdwn">
                                                    <div class="row-fluid gl_state_block" >
                                                         <?php
                                                        $location_country= $single_detail->location_country;
                                                        if(!empty($location_country)){
                                                            $location_country=explode("+",$location_country);
                                                            array_shift($location_country);
                                                            array_pop($location_country);
                                                            if(!empty($location_country)){
                                                                $needed_array_state=array();
                                                                foreach($location_country as $location_country_key=>$location_country_row){
                                                                    $needed_array_state[$location_country_key]['parent_location']=$location_country_row;
                                                                }
                                                              $loc_data = $needed_array_state;
                                                              $data['loc_data'] = $loc_data;
                                                              $this->load->view('users/location_block', $data);   
                                                            }
                                                            
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span12 controls">
                                                <div class="title opdwn">
                                                    <h4>
                                                        <span class="icon16 icomoon-icon-copy"></span>
                                                        <span>City</span>
                                                    </h4>  
                                                    <a href="#" class="maximize">maximize</a>
                                                </div>
                                                <div class="content opdwn ">
                                                    <div class="row-fluid gl_city_block" >
                                                         <?php
                                                        $location_state= $single_detail->location_state;
                                                        if(!empty($location_state)){
                                                            $location_state=explode("+",$location_state);
                                                            array_shift($location_state);
                                                            array_pop($location_state);
                                                            if(!empty($location_state)){
                                                                $needed_array_city=array();
                                                                foreach($location_state as $location_state_key=>$location_state_row){
                                                                    $needed_array_city[$location_state_key]['parent_location']=$location_state_row;
                                                                }
                                                              $loc_data = $needed_array_city;
                                                              $data['loc_data'] = $loc_data;
                                                              $this->load->view('users/location_block', $data);   
                                                            }
                                                            
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                        

<?php
}
?>


<?php
if($this->session->userdata('logged_admin_type') == 'subadmin')
{
$logged_admin_location_city = $this->session->userdata('logged_admin_location_city');	
$logged_admin_location_city = explode('+',$logged_admin_location_city);
$logged_admin_location_city = array_filter($logged_admin_location_city);

if(!empty($logged_admin_location_city))
{
?>

<div class="form-row row-fluid  ">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" >Assign District</label>
                                        <div class="span8 controls">  
    <select name="user_district" id="user_district" class="user_district" required>
    <option value="" >Choose District</option>
    <?php foreach ($logged_admin_location_city as $cityid) { 
	 $locations_details = $this->common_model->GetByRow('cms_locations', $cityid, 'id');
    ?>
    
    <option value="<?php echo $locations_details->id; ?>" >
    <?php echo $locations_details->location; ?></option>
    <?php
    }
    ?>
    
    </select>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
<?php
}
}
?>
                                        
                                        
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
 
 $(document).on('change', '.gl_location', function () {
        var location_type_id = $(this).attr("data-location_type_id");
        if(location_type_id=="1" || location_type_id=="2"){
            get_loc_data(location_type_id);
        } 
    });

    function get_loc_data(location_type_id) {
        var loc_data = [];
        $(".gl_location" + location_type_id + ":checked").each(function () {
            var parent_location = $(this).val();
            loc_data.push({
                parent_location: parent_location
            });
        });
        get_current_loc_data(loc_data, location_type_id);
    }

    function get_current_loc_data(loc_data, location_type_id) {
        ajaxindicatorstart('please wait..');
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'useradmin/get_current_loc_data'; ?>",
            data: {loc_data: loc_data,row_id:""},
            cache: false,
            success: function (response)
            {
                if (location_type_id == 1) {
                    $(".gl_state_block").html(response);
                    $(".gl_city_block").html("");
                } else if (location_type_id == 2) {
                    $(".gl_city_block").html(response);
                }
                 ajaxindicatorstop();

            }
        });

    }       
               
});
</script>			   