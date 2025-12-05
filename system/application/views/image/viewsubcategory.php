<div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->
                <div class="heading">
                    <h3>Manage Gallery Sub Categories</h3>                  
                    
                </div><!-- End .heading-->
                                        
                                                   
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="box gradient">
                                <div class="title">
                                    <h4>
                                        <span>View Gallery Sub Categories</span>
                                    </h4>
                                </div>
                                <div class="content noPad clearfix">
                                
                                    <table cellpadding="0" cellspacing="0" border="0" class="dynamicTable display table table-bordered" width="100%">
                                        <thead>
                                            <tr>
                                              <th>ID</th>
                                                <th>NAME</th>
                                                <th>PARENT CATEGORY</th>
                                                <th>PICTURE</th>
                                                <th>EDIT</th>
                                                <th>DELETE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                 <?php
				$i=$page_position;
				//print_r($categories);
				foreach($categories as $cat)
				{ $banner= json_decode($cat->category_picture);
				 $i++;
				?>
                                            <tr class="odd gradeX">
                                              <td><?php echo $i; ?></td>
                                                <td><?php echo $cat->category; ?></td>
                                                <td><?php
				    $this->db->where('id',$cat->parent_id); 
			        $category_details=$this->db->get('cms_dynamic_category')->row();			 
			        echo $category_details->category ;
					?></td>
                                                <td><?php if ($banner[0]->image != '')
					{ ?>
                                                  <img src="<?php echo base_url().'media_library/' . $banner[0]->image; ?>" width="100" height="100"  />
                                                  <?php }
	else
	{
	 ?>
                                                  <img src="<?php echo base_url().'static/admin/'; ?>images/noimage.png" width="100" height="100">
                                              <?php
	 } 
	 ?></td>
                                                <td class="center"> <a href="<?php echo base_url();?>commonimageadmin/editSub/<?php echo $cat->id;?>" title="Edit Sub Category" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a></td>
                                                <td class="center"><a href="#" title="Remove Sub Category" class="tip" onClick="linkRef('<?php echo base_url();?>commonimageadmin/trashSubcategory/<?php echo $cat->id;?>')"><span class="icon12 icomoon-icon-remove"></span></a></td>                 
                                           </tr>
                                           
									   <?php
                                                    
                                        }
                                        ?>
                                            
                                           
                                        </tbody>
                                        
                                    </table>
                                </div>
                            </div><!-- End .box -->
                        </div><!-- End .span12 -->
                        
                        
                        <div class="pagination_wrapper">
                             <div class="pagination_wrapper-cover">     
                                     <div id="pagination">  <?php echo $pagination; ?>  </div>        
                             </div>
                   	   </div>
                       
                    </div><!-- End .row-fluid -->
                   
               
    			
    				
                
                
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
        
        
<script type="text/javascript">
function linkRef(yurl ){
var linkref = yurl;
if(confirm("Do you really want to Delete ?")){
window.location.href=linkref;
}
}
</script>