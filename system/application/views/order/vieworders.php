<div class="header-area">
    <div class="row align-items-center">
        <!-- nav and search button -->
        <div class="col-md-6 col-sm-8 clearfix">
            <div class="nav-btn pull-left">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="search-box pull-left">
                <form action="#">
                    <input type="text" name="order_no" placeholder="Search here..." id="tipue_search_input" value="<?php
                    if (isset($_GET['order_no'])) {
                        $vals = $_GET['order_no'];

                        echo $vals;
                    }
                    ?>" required>
                    <i class="ti-search" id="tipue_search_button" style="cursor: pointer;"></i>
                </form>
            </div>
        </div>
        <!-- profile info & task notification -->
        <div class="col-md-6 col-sm-4 clearfix">
            <ul class="notification-area pull-right">
                <li class="dropdown gl_refresh_btn" data-refresh="<?php echo base_url() . 'ecorderadmin/vieworders/'; ?>">
                    <i class="ti-reload" data-toggle="">                        
                    </i>
                </li>
                <li id="full-view"><i class="ti-fullscreen"></i></li>
                <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                <li class="dropdown">
                    <i class="ti-bell dropdown-toggle" data-toggle="dropdown">
                        <!--<span></span>-->
                    </i>

                </li>
                <li class="dropdown">
                    <i class="fa fa-envelope-o dropdown-toggle" data-toggle="dropdown">
                        <!--<span>3</span>-->
                    </i>

                </li>

            </ul>
        </div>
    </div>
</div>


<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Manage Orders</h4>

            </div>
        </div>
        <div class="col-sm-6 clearfix">
            <div class="user-profile pull-right">
                <img class="avatar user-thumb" src="<?php echo base_url() . 'static/'; ?>adminpanel/images/administrator.png" alt="Administrator">
                <h4 class="user-name dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-angle-down"></i></h4>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?php echo base_url(); ?>admin/changepassword/">Change Password</a>
                    <!--<a class="dropdown-item" href="#">Settings</a>-->
                    <a class="dropdown-item" href="<?php echo base_url(); ?>secureadmin/logout/">Log Out</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main-content-inner">
    <div class="row">
        <div class="col-lg-6 col-ml-12">
            <div class="row">
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group" style="float: right;">
                                <?php
                                $listordertotal_revenue = $this->order_model->listordersortedtotal_revenue();
                                ?>
                                <label class="col-form-label" style="font-size: 15px;color: #902b2b;">Total Revenue : $<?php echo number_format($listordertotal_revenue->amount, 2, '.', ','); ?></label>

                            </div>                                  

                            <div class="form-group gl_search_select_div" style="">
                                <!--<label class="col-form-label">Select</label>-->
                                <select name="order_status" class="custom-select gl_order_status" style="cursor: pointer;">
                                    <option value="">Sort By Status</option>                                                

                                    <?php
                                    $order_status_list = array(2 => "success", 6 => "aborted", 4 => "declined", 5 => "failed", 1 => "pending");
                                    foreach ($order_status_list as $list_key => $list_status) {
                                        ?>
                                        <option value="<?php echo $list_key; ?>" 

                                                <?php
                                                if (isset($_GET['order_status'])) {
                                                    if ($_GET['order_status'] == $list_key) {
                                                        echo ' selected ';
                                                    }
                                                }
                                                ?> >
                                                <?php echo ucfirst($list_status); ?></option>

                                    <?php } ?>

                                </select>
                            </div>    

                        </div>                                        
                    </div>                                    
                </div>
            </div>                
        </div>
    </div>        
</div>
<?php
$per_page = '';
if (isset($_GET['per_page'])) {
    $per_page = '&per_page=' . $_GET['per_page'];
}
?>

<div class="main-content-inner">
    <div class="row">

        <div class="col-12 mt-1">
            <div class="card">
                <div class="card-body">

                    <?php
                    if ($this->session->flashdata('message')) {
                        ?> 
                        <div class="alert-dismiss">

                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong><?php echo $this->session->flashdata('message'); ?></strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="fa fa-times"></span>
                                </button>
                            </div>

                        </div>
                        <?php
                    }
                    ?>

                    <h4 class="header-title">View Orders</h4>
                    <div class="single-table">
                        <div class="table-responsive">
                            <table class="table table-hover progress-table text-center">
                                <thead class="text-uppercase">
                                    <tr>
                                        <th scope="col">SLNO</th>
                                        <th scope="col">ORDER ID</th>
                                        <th scope="col">AMOUNT</th>                                        
                                        <th scope="col">USER INFO</th>
                                        <th scope="col">ORDER INFO</th>
                                        <th scope="col">ORDER DATE</th>                                        
                                        <th scope="col">DETAILS</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $i = $page_position;
                                    if ($order_list != NULL) {

                                        foreach ($order_list as $key => $myorders) {

                                            $i++;

                                            $billing_address = json_decode($myorders->billing_address, TRUE);
                                            if ($billing_address != NULL) {
                                                if (array_key_exists('frm_first_name', $billing_address) && $billing_address['frm_first_name'] != '') {

                                                    $frm_first_name = $billing_address['frm_first_name'];
                                                } else {

                                                    $frm_first_name = "";
                                                }
                                                if (array_key_exists('frm_last_name', $billing_address) && $billing_address['frm_last_name'] != '') {

                                                    $frm_last_name = $billing_address['frm_last_name'];
                                                } else {
                                                    $frm_last_name = "";
                                                }

                                                if (array_key_exists('frm_email', $billing_address) && $billing_address['frm_email'] != '') {
                                                    $frm_email = $billing_address['frm_email'];
                                                } else {
                                                    $frm_email = "";
                                                }

                                                if (array_key_exists('frm_phoneno', $billing_address) && $billing_address['frm_phoneno'] != '') {
                                                    $frm_phoneno = $billing_address['frm_phoneno'];
                                                } else {
                                                    $frm_phoneno = "";
                                                }
                                            }

                                            $name = $frm_first_name . ' ' . $frm_last_name;
                                            $items = 1;
                                            $ordr_date = date('jS F Y  H:i:s', strtotime($myorders->purchase_date));

                                            $order_status = "";
                                            if ($myorders->payment_status == '2') {
                                                $order_status = "Success";
                                            } else if ($myorders->payment_status == '6') {
                                                $order_status = "Aborted";
                                            } else if ($myorders->payment_status == '4') {
                                                $order_status = "Declined";
                                            } else if ($myorders->payment_status == '5') {
                                                $order_status = "Failed";
                                            } else {
                                                $order_status = "Pending";
                                            }
                                            ?>    

                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php
                                    if ($myorders->order_id == 0) {
                                        $ordrid = "TMPODR" . $myorders->id;
                                    } else {
                                        $ordrid = "GLTODR" . $myorders->order_id;
                                    }

                                    echo $ordrid;
                                            ?></td>
                                                <td>
                                                    <?php echo '$ ' . $myorders->amount; ?>
                                                </td>

                                                <td>
                                                    <?php
                                                    echo '<b>Name :</b> ' . $name . '<br><b>Email :</b> ' . $frm_email . '<br><b>Phone Number :</b> ' . $frm_phoneno;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo '<b>Items :</b> ' . $items . '<br/>' .
                                                    '<b>Method :</b> ' . $myorders->payment_method_string . '<br/>' .
                                                    '<b>Status :</b> ' . $order_status;
                                                    ?>
                                                </td>

                                                <td>
                                                    <?php echo $ordr_date; ?>
                                                </td>

                                                <td>

                                                    <a href="<?php echo base_url() . 'ecorderadmin/vieworderdetail/' . $myorders->id; ?>" target="_blank" style="font-family:'Lato', sans-serif;">View Details</a>

                                                </td>
                                            </tr>

                                            <?php
                                        }
                                    }
                                    ?>    

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="single-table" style="height: 20px;"></div>
                    <nav aria-label="...">
                        <ul class="pagination">

                            <?php echo $pagination; ?>

                        </ul>
                    </nav>

                </div>
            </div>
        </div>


    </div>

</div>

<script type="text/javascript">

    function linkRef(yurl) {
        var linkref = yurl;
        if (confirm("Do you really want to delete ?")) {
//            window.location.href = linkref;
        }
    }

</script>

<script type="text/javascript">

    $(document).ready(function () {


        $("#tipue_search_button").click(function () {


            /* */   if ($("#tipue_search_input").val() != '') {

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


                window.location = '<?php echo base_url() . 'ecorderadmin/vieworders?order_no='; ?>' + total_name;


            } else {

                $("#tipue_search_input").focus();

            }

            /**/
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


                    window.location = '<?php echo base_url() . 'ecorderadmin/vieworders?order_no='; ?>' + total_name;


                } else {

                    $("#tipue_search_input").focus();

                }
            }
        });
    });
</script>

<script type="text/javascript">
    $("body").on("change", ".gl_order_status", function () {
        var status = $(this).val();

        if (status != '') {
            window.location = '<?php echo base_url() . 'ecorderadmin/vieworders?order_status='; ?>' + status;
        }

    });

</script>