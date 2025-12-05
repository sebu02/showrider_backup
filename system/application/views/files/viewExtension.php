<div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->
                <div class="heading">
                    <h3>Manage File Upload</h3>           
                    
                    
                    <div class="resBtnSearch">
                <a href="#"><span class="icon16 icomoon-icon-search-3"></span></a>
            </div>


            <div class="search">

                <input type="text" id="tipue_search_input" name="name" class="top-search" placeholder="Search here ..."
                       value="<?php if ($this->uri->segment(3) != '0') {
                           $vals = $this->uri->segment(3);
                           $typed = str_replace("-", " ", $vals);
                           $typed = str_replace("123", "&", $typed);
                           echo $typed;
                       }  ?>"/>
                <input type="submit" id="tipue_search_button" class="search-btn" value=""/>


            </div>
            <!-- End search -->                  
                    
                                    
                    
                </div><!-- End .heading-->
                
                  <a href="<?php echo base_url(); ?>fileuploadadmin/viewExtension/" class="btn btn-inverse"><span
                class="icon16 icomoon-icon-loop white"></span> View All</a><br><br>
                                        
                                                   
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="box gradient">
                                <div class="title">
                                    <h4>
                                        <span>View Extensions</span>
                                    </h4>
                                </div>
                                <div class="content noPad clearfix">
                                
                                    <table cellpadding="0" cellspacing="0" border="0" class="dynamicTable display table table-bordered" width="100%">
                                        <thead>
                                            <tr>
                                               <th width="40px">ID</th>
                                                <th>EXTENSION</th>
                                                <th>MEDIA TYPE</th>
                                                <th width="150px">EDIT</th>
                                                <th width="50px">DELETE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                 <?php
				$i=$page_position;
				foreach($values as $sizevalues)
				{
				 $i++;
				?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $sizevalues->suffix; ?></td>
                                                <td><?php echo $sizevalues->mediatype; ?></td>
                                                <td class="center"> <a href="<?php echo base_url();?>fileuploadadmin/editExtension/<?php echo $sizevalues->id.'/'.$this->uri->segment(3).'/'.$this->uri->segment(4);?>" title="Edit Extension" class="tip"><span class="icon12 icomoon-icon-pencil"></span><strong>Edit Extension</strong></a></td>
                                                <td class="center"><a href="#" title="Remove Extension" class="tip" onClick="linkRef('<?php echo base_url();?>fileuploadadmin/trashExtensions/<?php echo $sizevalues->id.'/'.$this->uri->segment(3).'/'.$this->uri->segment(4);?>')"><span class="icon12 icomoon-icon-remove"></span></a></td>                 
                                           </tr>
                                           
				 <?php  }?>
                                            
                                           
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


<script type="text/javascript">

    $(document).ready(function () {


        $("#tipue_search_button").click(function () {


            if ($("#tipue_search_input").val() != '') {

                var name = $("#tipue_search_input").val();


                var name1 = name.replace("'", "");

                var name2 = name1.replace('"', '');

                var name3 = name2.replace('/', '');

                var name4 = name3.replace('&', '123');

                var splted = name4.split(" ");


                var splite_count = splted.length;


                var search_value = '';


                for (var i = 0; i < splite_count; i++) {

                    search_value += splted[i] + '-';

                }


                var total_name = search_value.substring(0, search_value.length - 1);


                window.location = '<?php echo base_url().'fileuploadadmin/viewExtension/' ?>' + total_name;


            }

            else {

                $("#tipue_search_input").focus();

            }


        });


    });
</script>


<script type="text/javascript">

    $(document).ready(function () {


        $("#tipue_search_input").keyup(function (e) {

            if (e.which == 13) {


                if ($("#tipue_search_input").val() != '') {

                    var name = $("#tipue_search_input").val();


                    var name1 = name.replace("'", "");

                    var name2 = name1.replace('"', '');

                    var name3 = name2.replace('/', '');

                    var name4 = name3.replace('&', '123');

                    var splted = name4.split(" ");


                    var splite_count = splted.length;


                    var search_value = '';


                    for (var i = 0; i < splite_count; i++) {

                        search_value += splted[i] + '-';

                    }


                    var total_name = search_value.substring(0, search_value.length - 1);


                    window.location = '<?php echo base_url().'fileuploadadmin/viewExtension/' ?>' + total_name;


                }

                else {

                    $("#tipue_search_input").focus();

                }

            }

        });


    });
</script>