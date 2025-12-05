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
                    <input type="text" name="name" placeholder="Search here..." id="tipue_search_input" value="<?php
                    if ($this->uri->segment(5) != '0' && $this->uri->segment(5) != '') {
                        $vals = $this->uri->segment(5);
//                        $typed = str_replace("-", " ", $vals);
                        $typed = str_replace("123", "&", $vals);
                        echo $typed;
                    }
                    ?>" required>
                    <i class="ti-search" id="tipue_search_button" style="cursor: pointer;"></i>
                </form>
            </div>
        </div>
        <!-- profile info & task notification -->
        <div class="col-md-6 col-sm-4 clearfix">
            <ul class="notification-area pull-right">
                <li class="dropdown gl_refresh_btn" data-refresh="<?php echo base_url() . 'videogalleryadmin/view_videos/'; ?>">
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
                <h4 class="page-title pull-left">Manage Videos</h4>

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

                    <h4 class="header-title">View Videos</h4>
                    <div class="single-table">
                        <div class="table-responsive">
                            <table class="table table-hover progress-table text-center">
                                <thead class="text-uppercase">
                                    <tr>
                                        <th scope="col">SLNO</th>
                                        <th scope="col">TITLE</th> 
                                        <th scope="col">CATEGORY</th>                                        
                                        <th scope="col">STATUS</th>
                                        <th scope="col">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $i = $page_position;
                                    if ($videos != NULL) {

                                        foreach ($videos as $p) {
                                          // $banner = json_decode($p->images, TRUE);

                                            $i++;
                                            ?>    

                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $p->title; ?></td>
                                                <td>
                                                    <?php 
                                                
                                                    $ct_id = $p->main_category;
                                                    $this->db->where('id', $ct_id);
                                                    $res1 = $this->db->get('cms_dynamic_category')->row();
                                                    echo $res1->category;
                                                                                                   
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($p->active_status == 'a') {
                                                        echo "Active";
                                                    } else {
                                                        echo "Deactive";
                                                    }
                                                    ?>
                                                </td>

                                                <td>
                                                    <ul class="d-flex justify-content-center">
                                                        <li class="mr-3"><a href="<?php echo base_url(); ?>videogalleryadmin/edit_video/<?php echo $p->id . '/' . $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6); ?>" title="Edit" class="text-secondary"><i class="fa fa-edit"></i></a></li>

                                                        <li><a href="javascript:void(0);" title="Remove" class="text-danger" onclick="linkRef('<?php echo base_url(); ?>videogalleryadmin/trash_video/<?php echo $p->id . '/' . $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6); ?>')"><i class="ti-trash"></i></a></li>
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

<?php
if ($this->uri->segment(3) != '' & $this->uri->segment(3) != '0' & $this->uri->segment(3) != 'All') {

    $seg_3 = $this->uri->segment(3);
} else {
    $seg_3 = 0;
}
?>

<?php
if ($this->uri->segment(4) != '' & $this->uri->segment(4) != '0' & $this->uri->segment(4) != 'All') {

    $seg_4 = $this->uri->segment(4);
} else {
    $seg_4 = 0;
}
?>

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


                window.location = '<?php echo base_url() . 'videogalleryadmin/view_videos/' . $seg_3 . '/' . $seg_4 . '/'; ?>' + total_name;


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


                    window.location = '<?php echo base_url() . 'videogalleryadmin/view_videos/' . $seg_3 . '/' . $seg_4 . '/'; ?>' + total_name;


                } else {

                    $("#tipue_search_input").focus();

                }

            }

        });


    });
</script>