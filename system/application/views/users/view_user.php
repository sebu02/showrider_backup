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
                    <input type="text" name="name" placeholder="Search here..." id="tipue_search_input" required value="<?php
                    if ($this->uri->segment(3) != '0') {
                        $vals = $this->uri->segment(3);
                        $typed = str_replace("-", " ", $vals);
                        $typed = str_replace("123", "&", $typed);
                        echo $typed;
                    }
                    ?>">
                    <i class="ti-search" id="tipue_search_button" style="cursor: pointer;"></i>
                </form>
            </div>

        </div>
        <!-- profile info & task notification -->
        <div class="col-md-6 col-sm-4 clearfix">
            <ul class="notification-area pull-right">
                <li class="gl_refresh_btn" data-refresh="<?php echo base_url() . 'useradmin/viewusers/'; ?>">
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
                <h4 class="page-title pull-left">Manage Users</h4>

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

        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">View Users</h4>
                    <div class="single-table">
                        <div class="table-responsive">
                            <table class="table table-hover progress-table text-center">
                                <thead class="text-uppercase">
                                    <tr>
                                        <th scope="col">SLNO</th>
                                        <th scope="col">USER INFO</th>
                                        <th scope="col">ACCOUNT INFO</th>

                                        <th scope="col">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = $page_position;
                                    //print_r($rowegories);
                                    foreach ($values as $row) {
                                        $i++;
                                        ?>
                                        <tr align="left">
                                            <td><?php echo $i; ?></td>
                                            <td><?php
                                                echo '<label class="col-form-label">FIRST NAME:</label> ' . $row->firstname . '<br/>';
                                                echo '<label class="col-form-label">EMAIL:</label> ' . $row->email . '<br/>';
                                                echo '<label class="col-form-label">PHONE:</label> ' . $row->phone . '<br/>';
                                                ?></td>

                                            <td>

                                                <?php
                                                echo '<label class="col-form-label">USERNAME:</label> ' . $row->username . '<br/>';
                                                ?>

                                            </td>
                                            <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><a href="#" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                                    <li><a href="#" class="text-danger"><i class="ti-trash"></i></a></li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <?php
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