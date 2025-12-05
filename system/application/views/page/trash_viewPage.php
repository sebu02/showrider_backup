<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->
        <div class="heading">
            <h3>Manage Page Details</h3>   

            <div class="resBtnSearch">
                <a href="#"><span class="icon16 icomoon-icon-search-3"></span></a>
            </div>


        </div><!-- End .heading-->





        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

        <div class="row-fluid">

            <div class="span12">

                <div class="box">

                    <div class="title">

                        <h4>
                            <span class="icon16 icomoon-icon-equalizer-2"></span>
                            <span>Manage Search</span>
                        </h4>
                        <a href="#" class="minimize">Minimize</a>
                    </div>
                    <div class="content">
                        <form class="form-horizontal gl_search_sorting_form" action="<?php echo base_url() . 'pageadmin/trash_viewPage'; ?>" method="get" enctype="multipart/form-data" >
                            <div class="form-row row-fluid">
                                <div class="span12">

                                    <div class="row-fluid" style="width: 30%; float:left;">
                                        <label class="form-label span4" for="order_no">Search</label>
                                        <div class="span2" style="width: 60%;">



                                            <input type="text" id="tipue_search_input" name="name" class="top-search gl_enter_submit" placeholder="Search here ..." value="<?php
                                            if (isset($_GET['name'])) {
                                                echo $_GET['name'];
                                            }
                                            ?>" />
                                        </div>
                                    </div>



                                    <div class="row-fluid" style="width: 30%; float:left">
                                        <label class="form-label span4" for="status">Sort By Id</label>
                                        <div class="span2" style="width: 60%;">

                                            <?php $status_array = array('asc' => 'ascending', 'desc' => 'descending', 'random' => 'random'); ?>

                                            <select name="order" id="sort_status" class="gl_enter_submit">
                                                <option value="">Order</option>
                                                <?php
                                                foreach ($status_array as $key => $order) {
                                                    ?>
                                                    <option value="<?php echo $key; ?>" 

                                                            <?php
                                                            if (isset($_GET['order'])) {
                                                                if ($_GET['order'] === $key) {
                                                                    echo ' selected ';
                                                                }
                                                            }
                                                            ?>



                                                            >
                                                        <?php echo ucfirst($order); ?></option>

                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>




                                </div>
                            </div>
                            <div class="form-actions" style="padding-left: 20px;">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <div class="span3">
                                            <a href="<?php echo base_url(); ?>pageadmin/trash_viewPage" class="btn btn-inverse pull-left"><span
                                                    class="icon16 icomoon-icon-loop white"></span>Refresh/Reset</a>
                                        </div>
                                        <div class="span6">
                                        </div>
                                        <div class="span3">
                                            <input type="hidden" class="base_url" id="base_url" value="<?php echo base_url(); ?>"   >
                                            <button onclick="return custom_validate();" type="submit" class="btn btn-info pull-right"><span class="icon16 icomoon-icon-search-3"></span>Search</button>
                                        </div>
                                    </div>
                                </div>

                            </div>



                        </form>
                        <div id="glresults"></div>

                        <?php
                        foreach ($_GET as $get_key => $get_value) {


                            $uristrings = $_SERVER['QUERY_STRING'];
                            $remove_key_value = $get_key . '=' . $get_value;
                            $newuristrings = str_replace($remove_key_value, '', $uristrings);
                            $newuristrings = str_replace('&&', '&', $newuristrings);
                            $newuristrings = str_replace('&&', '&', $newuristrings);

                            switch ($get_key) {
                                case 'per_page':

                                    $newuristrings = "";
                                    break;

                                case 'order' :

                                    if (isset($_GET['order'])) {
                                        $order = $_GET['order'];


                                        if ($order == 'asc') {
                                            $get_value = 'ascending';
                                        } else if ($order == 'desc') {
                                            $get_value = 'descending';
                                        } else if ($order == 'random') {
                                            $get_value = 'random';
                                        }
                                    }

                                    break;
                            }




                            if ($newuristrings !== "") {
                                ?>
                                <a class="btn btn-mini btn-primary" style="margin-right:10px;" href="<?php echo base_url() . 'pageadmin/trash_viewPage?' . $newuristrings; ?>"><?php echo ucwords($get_value); ?> &nbsp;&nbsp;<span aria-hidden="true" class="icomoon-icon-cancel"></span></a>

                                <?php
                            }
                        }
                        ?>



                    </div>

                </div><!-- End .box -->

            </div><!-- End .span12 -->

        </div><!-- End .row-fluid -->






        <div class="form-row row-fluid" style="width:40%; float:right ;">
            <div class="span12">
                <div class="row-fluid">


                </div>
            </div>
        </div>


        <div class="row-fluid">
            <div class="span12">
                <div class="box gradient">
                    <div class="title">
                        <h4>
                            <span>View Trash Page</span>
                        </h4>
                    </div>
                    <div class="content noPad clearfix">

                        <table cellpadding="0" cellspacing="0" border="0" class="dynamicTable display table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th width="40px">ID</th>
                                    <th>PAGE</th>
                                    <th>RESTORE</th>
                                    <th width="50px" >DELETE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = $page_position;

                                //print_r($categories);

                                foreach ($metas as $row) {

                                    $i++;
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row->page; ?></td>
                                        <td class="center">
                                            <a href="javascript:void(0)" title="Restore page" class="tip" onClick="restoreRef('<?php echo base_url(); ?>pageadmin/restorePage/<?php echo $row->id; ?>')">
                                                <span class="icon12 icomoon-icon-undo-2"></span><strong>Restore Page</strong></a>
                                        </td>   
                                        <td class="center">
                                            <a href="javascript:void(0)" title="Remove page" class="tip" onClick="linkRef('<?php echo base_url(); ?>pageadmin/deletePage/<?php echo $row->id; ?>')"><span class="icon12 icomoon-icon-remove"></span></a>
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

    function restoreRef(yurl) {
        var restoreRef = yurl;
        if (confirm("Do you really want to restore ?")) {
            window.location.href = restoreRef;
        }
    }

</script>      


<!--<script type="text/javascript">

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


                window.location = '<?php // echo base_url() . 'pageadmin/trash_viewPage/';    ?>' + total_name;


            } else {

                $("#tipue_search_input").focus();

            }


        });


    });
</script>-->


<!--<script type="text/javascript">

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


                    window.location = '<?php // echo base_url() . 'pageadmin/trash_viewPage/';    ?>' + total_name;


                } else {

                    $("#tipue_search_input").focus();

                }

            }

        });


    });
</script>-->

