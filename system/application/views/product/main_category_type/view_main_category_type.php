<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->
        <div class="heading">
            <h3>Manage Products</h3>   

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

        <a href="<?php echo base_url(); ?>ecproductadmin/view_main_category_type" class="btn btn-inverse"><span
                class="icon16 icomoon-icon-loop white"></span>Refresh</a>


        <div class="row-fluid">
            <div class="span12">
                <div class="box gradient">
                    <div class="title">
                        <h4>
                            <span>View Main Category Types</span>
                        </h4>
                    </div>
                    <div class="content noPad clearfix">

                        <table cellpadding="0" cellspacing="0" border="0" class="dynamicTable display table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>CATEGORY TYPE KEY</th>
                                    <th>CATEGORY TYPE VALUE</th>
                                    <th>STATUS</th>
                                    <th>EDIT</th>
                                    <th>DELETE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = $page_position;

                                foreach ($view_items_list as $row) {

                                    $i++;
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row->category_type_name; ?></td>
                                        <td><?php echo $row->category_type_value; ?></td>
                                         <td><?php if ($row->active_status == 'a') {
                                                    echo 'Active';
                                                }elseif ($row->active_status == 'd') {
                                                    echo 'Deactive';
                                                } ?></td>
                                        <td class="center"> 
                                            <a href="<?php echo base_url(); ?>ecproductadmin/edit_main_categorytype/<?php echo $row->id; ?>" title="Edit Main Category Type" class="tip">
                                                <span class="icon12 icomoon-icon-pencil"></span>
                                            </a>
                                        </td>
                                        <td class="center">
                                            <?php
                                            if($row->fixed_status != 'yes'){
                                                ?>
                                            <a href="javascript:void(0)" title="Remove Main Category Type" class="tip" onClick="linkRef('<?php echo base_url(); ?>ecproductadmin/trash_main_category_type/<?php echo $row->id; ?>')">
                                                <span class="icon12 icomoon-icon-remove"></span>
                                            </a>
                                            <?php
                                            }
                                            ?>
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


                window.location = '<?php echo base_url() . 'ecproductadmin/view_main_category_type/'; ?>' + total_name;


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


                    window.location = '<?php echo base_url() . 'ecproductadmin/view_main_category_type/'; ?>' + total_name;


                } else {

                    $("#tipue_search_input").focus();

                }

            }

        });


    });
</script>
