

<div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">

                    <h3>Manage Sub Admin Users</h3>                    

                    

                </div><!-- End .heading-->
    				
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                    <div class="row-fluid">

                      <div class="span12" >

                            <div class="box">

                                <div class="title">

                                    <h4> 
                                        <span>Editing Sub Admin User</span>
                                    </h4>
                                    
                                </div>
                                <div class="content">
                                   
                                    <form class="form-horizontal" action="<?php echo base_url().'useradmin/edit_subadmin_user/'.$user_details->id.'?'.$_SERVER['QUERY_STRING'] ; ?>" method="post" enctype="multipart/form-data" >
                                    
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
                                    if ($user_details->type == $userkey)
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
                                    <input class="span8" id="name" type="text" name="name"  required value="<?php echo $user_details->name; ?>" />
                                    <span class="error">
                                        <?php echo form_error('name'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                              
                                        
                         <div class="form-row row-fluid ">
                            <div class="span12">
                                <div class="row-fluid">
                                   <label class="form-label span4" for="normal">Phone</label>
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
                                        <label class="form-label span4 gl_ftype_label" for="active_status">Status</label>
                                        <div class="span8 controls">
                                            <div class="left marginT5">
                                                <input type="radio" name="active_status"  value="a" <?php
                                                if ($user_details->active_status == 'a') {
                                                    echo 'checked';
                                                }
                                                ?> />
                                                Active
                                            </div>
                                            <div class="left marginT5">
                                                <input type="radio" name="active_status"  value="d" <?php
                                                if ($user_details->active_status == 'd') {
                                                    echo 'checked';
                                                }
                                                ?> />
                                                Deactivate
                                            </div>
                                        </div>
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

$location_city = $single_detail->location_city;	
$location_city = explode('+',$location_city);
$location_city = array_filter($location_city);
	
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
    
    <option value="<?php echo $locations_details->id; ?>" <?php
	
if (in_array($cityid, $location_city))
{
	echo 'selected';
}
	  ?> >
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
        
			
			
					$( "#username" ).keyup(function() {
					
								var string =$( "#username" ).val();
								var string = string.replace(/[^a-zA-Z0-9,#]/g,'');	
								var string = string.replace('#','');								
								var string = string.toLowerCase(); 					
								$( "#username" ).val(string);
		
					});
				
		
});
</script>



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
            data: {loc_data: loc_data,row_id:"<?php echo $single_detail->id; ?>"},
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


