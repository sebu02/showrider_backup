<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->
        <div class="heading">
            <h3>Manage Sub Admin Users</h3>  


            <div class="resBtnSearch">
                <a href="#"><span class="icon16 icomoon-icon-search-3"></span></a>
            </div>


            <div class="search">

                <input type="text" id="tipue_search_input" name="name" class="top-search" placeholder="Search here ..."
                       value="<?php
                       if ($this->uri->segment(3) != '0') {
                           $vals = $this->uri->segment(3);
                           $typed = str_replace("-", " ", $vals);
                           $typed = str_replace("123", "&", $typed);
                           echo $typed;
                       }
                       ?>"/>
                <input type="submit" id="tipue_search_button" class="search-btn" value=""/>


            </div>
            <!-- End search -->                  



        </div><!-- End .heading-->





        <a href="<?php echo base_url(); ?>useradmin/viewusers" class="btn btn-inverse"><span
                class="icon16 icomoon-icon-loop white"></span> Refresh</a><br><br>


        <div class="row-fluid">
            <div class="span12">
                <div class="box gradient">
                    <div class="title">
                        <h4>
                            <span>View Sub Admin Users</span>
                        </h4>
                    </div>
                    <div class="content noPad clearfix">

                        <table cellpadding="0" cellspacing="0" border="0" class="dynamicTable display table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th width="40px">SINO</th>
                                    <th>USER INFO</th>

                                    <th>ACCOUNT INFO</th>
                                    
                                    <th>EDIT</th>
  
                                    <th class="<?php echo $this->common_model->admin_or_super_admin();?>">DELETE</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = $page_position;
                                //print_r($rowegories);
                                foreach ($values as $row) {
                                    $i++;

                                   
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $i; ?></td>
                                        <td>
                                        
                                         <b>NAME : </b><?php echo $row->name ; ?><br/>
                                         <b>PHONE : </b><?php echo $row->phone ;?><br/>
                                         <b>TYPE : </b><?php echo $row->type ;?><br/>
                                         <b>STATUS : </b><?php 
										 if($row->active_status == 'a')
										 {
											 echo 'Active';
										 }
										 else
										 {
											 echo 'Deactive';
										 }
										 
										 ?><br/>
                                           
                                        </td>
                                        <td><?php
                                            echo '<b>USERNAME:</b> ' . $row->username . '<br/>';
											?>
                                            <a href="<?php echo base_url(); ?>useradmin/change_subadmin_user_username/<?php echo $row->id.'?'.$_SERVER['QUERY_STRING']; ?>" title="Change Username" class="tip <?php echo $this->common_model->admin_or_super_admin();?>">Change Username</a><br>
											
											<?php                         echo '<b>PASSWORD: </b> ';

                                           // $key1 = 'gl-godland';
                                            $old_password = $this->encryption->decrypt($row->password);
                                            echo $old_password . '&nbsp;&nbsp;&nbsp;&nbsp;';
                                            ?>
                                            <br>
                                           <a href="<?php echo base_url(); ?>useradmin/change_subadmin_password/<?php echo $row->id.'?'.$_SERVER['QUERY_STRING']; ?>" title="Change Password" class="tip <?php echo $this->common_model->admin_or_super_admin();?>">Change Password</a><br/>
                                           
                                           
                                        </td>
                                        <td class="center">

                                            <a href="<?php echo base_url() . 'useradmin/edit_subadmin_user/'.$row->id.'?'.$_SERVER['QUERY_STRING']; ?>" title="Edit Subadmin User" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>

                                        </td>
                                        <td class="<?php echo $this->common_model->admin_or_super_admin();?>">
                                            
                                            <a href="javascript:void(0);" title="Remove User" class="tip" onClick="linkRef('<?php echo base_url(); ?>useradmin/trash_subadmin_user/<?php echo $row->id . '?'.$_SERVER['QUERY_STRING'] ; ?>')"><span class="icon12 icomoon-icon-remove"></span></a>
                                           
                                        </td>                 
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


<script type="text/javascript">
    function linkRef(yurl) {
        var linkref = yurl;
        if (confirm("Do you really want to Delete ?")) {
            window.location.href = linkref;
        }
    }
</script>





<?php
if ($this->uri->segment(3) != '' & $this->uri->segment(3) != '0' & $this->uri->segment(3) != 'All') {

    $seg_3 = $this->uri->segment(3);
} else {
    $seg_3 = 0;
}

//if ($this->uri->segment(4) != '' & $this->uri->segment(4) != '0' & $this->uri->segment(4) != 'All') {
//
//    $seg_4 = $this->uri->segment(4);
//} else {
//    $seg_4 = 0;
//}
?>




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


                window.location = '<?php echo base_url() . 'useradmin/viewusers/'; ?>' + total_name;


            } else {

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


                    window.location = '<?php echo base_url() . 'useradmin/viewusers/'; ?>' + total_name;


                } else {

                    $("#tipue_search_input").focus();

                }

            }

        });


    });
</script>


