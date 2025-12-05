<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->
        <div class="heading">
            <h3>Manage Orders</h3>   

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


        <div class="form-row row-fluid" style="width:40%; float:right ;">
            <div class="span12">
                <div class="row-fluid">


                </div>
            </div>
        </div>

        <a href="<?php echo base_url(); ?>ecorderadmin/trash_view_order" class="btn btn-inverse"><span
                class="icon16 icomoon-icon-loop white"></span>View All</a>


        <div class="row-fluid">
            <div class="span12">
                <div class="box gradient">
                    <div class="title">
                        <h4>
                            <span>View Trash Orders</span>
                        </h4>
                    </div>
                    <div class="content noPad clearfix">

                        <table cellpadding="0" cellspacing="0" border="0" class="dynamicTable display table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NAME</th>
                                    <th>RESTORE</th>
                                    <th>DELETE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = $page_position;
								
								//{oldoption}
                                //$data['options'] = $this->common_model->get_options();
                               // $data['option'] = $data['options'][0];
							   //{oldoption}
							   
							   $data['option'] = $this->common_model->get_options();
								

                                foreach ($view_items_list as $myorders) {

                                    $i++;
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $i; ?></td>
                                        <td><a style=" <?php
                                            if ($myorders->order_id == 0) {
                                                echo ' color: #b40707 !important';
                                            } else {
                                                echo '  color: #389004 !important ';
                                            }
                                            ?> " href="<?php echo base_url() . 'ecorderadmin/vieworderdetail/' . $myorders->id; ?>"><strong><?php
                                                       //if ($myorders->order_id == 0) {
//                                                           $ordrid = $data['option']->tmp_order_string . $myorders->id;
//                                                       } else {
//                                                           $ordrid = $data['option']->org_order_string . $myorders->order_id;
//                                                       }
													   
//sbn orderid
$ordrid = $this->common_model->format_order_number($myorders->order_id,$myorders->id);
//sbn orderid
													   
													   
                                                       echo $ordrid;
                                                       ?></strong></a></td>


                                        <td class="center">
                                            <a href="javascript:void(0)" title="Restore Order" class="tip" onClick="restoreRef('<?php echo base_url(); ?>ecorderadmin/restore_order/<?php echo $myorders->id; ?>')">
                                                <span class="icon12 icomoon-icon-undo-2"></span><strong>Restore Order</strong>
                                            </a>
                                        </td>   
                                        <td class="center">
                                            <a href="javascript:void(0)" title="Remove Order" class="tip" onClick="linkRef('<?php echo base_url(); ?>ecorderadmin/delete_order/<?php echo $myorders->id; ?>')">
                                                <span class="icon12 icomoon-icon-remove"></span>
                                            </a>
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
        if (confirm("Do you really want to delete ?")) {
            window.location.href = linkref;
        }
    }
    function restoreRef(yurl) {
        var restoreRef = yurl;
        if (confirm("Do you really want to restore ?")) {
            window.location.href = restoreRef;
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


                window.location = '<?php echo base_url() . 'ecorderadmin/trash_view_order/'; ?>' + total_name;


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


                    window.location = '<?php echo base_url() . 'ecorderadmin/trash_view_order/'; ?>' + total_name;


                } else {

                    $("#tipue_search_input").focus();

                }

            }

        });


    });
</script>
