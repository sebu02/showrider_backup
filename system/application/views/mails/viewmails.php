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
                    <input type="text" name="search" placeholder="Search..." required>
                    <i class="ti-search"></i>
                </form>
            </div>
        </div>
        <!-- profile info & task notification -->
        <div class="col-md-6 col-sm-4 clearfix">
            <ul class="notification-area pull-right">
                <li class="gl_refresh_btn" data-refresh="">
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
                <!--                            <li class="settings-btn">
                                                <i class="ti-settings"></i>
                                            </li>-->
            </ul>
        </div>
    </div>
</div>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Manage Mails</h4>

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

                    <h4 class="header-title">View Mails</h4>
                    <div class="single-table">
                        <div class="table-responsive">
                            <table class="table table-hover progress-table text-center">
                                <thead class="text-uppercase">
                                    <tr>
                                        <th scope="col">SLNO</th>
                                        <th scope="col">MAIL TYPE</th>
                                        <th scope="col">MAIL INFO</th>
                                        <th scope="col">DATE</th>
                                        <!--<th scope="col">status</th>-->
                                        <th scope="col">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $i = $page_position;
                                    if ($item_list != NULL) {

                                        $data['option'] = $this->common_model->get_options();

                                        foreach ($item_list as $item_row) {
                                            $form_data_list = json_decode($item_row->form_json_data, TRUE);
                                            $form_data = $form_data_list;
//                                            $email = $form_data[0]['email'];
                                            $date_received = date('jS F Y  H:i:s', strtotime($item_row->date_created));
                                            $i++;
                                            ?>    

                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo str_replace("_", " ", $item_row->form_name); ?></td>
                                                <td align="left">
                                                    <?php
                                                    unset($form_data['page_name']);
                                                    foreach ($form_data[0] as $form_key => $form_value) {

                                                        if (ucfirst($form_key) == "Career_File") {
                                                            $linkurl = "";
                                                            $download_link = "";
                                                            $linkurl = base_url() . 'media_library' . '/' . $form_value;
                                                            $download_link = '<a target="_blank" download  href="' . $linkurl . '">Download File</a>';

                                                            echo '<b>' . ucfirst($form_key) . ':</b> ' . $download_link . '<br/>';
                                                        } else {
                                                            echo '<label class="col-form-label" style="color: #902b2b;">' . ucfirst(str_replace("_", " ", $form_key)) . ' :</label> ' . $form_value . '<br/>';
                                                        }
                                                    }
                                                    ?>
                                                </td>

                                                <td>
                                                    <?php
                                                    echo $date_received;
                                                    ?>
                                                </td>
                                                <td>
                                                    <ul class="d-flex justify-content-center">
                                                        <!--<li class="mr-3"><a href="#" class="text-secondary"><i class="fa fa-edit"></i></a></li>-->

                                                        <li><a href="javascript:void(0);" title="Remove" class="text-danger" onclick="linkRef('<?php echo base_url(); ?>cmsmailsadmin/trash_mails/<?php echo $item_row->id . '?' . $_SERVER['QUERY_STRING']; ?>')"><i class="ti-trash"></i></a></li>
                                                    </ul>
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
            window.location.href = linkref;
        }
    }

</script>