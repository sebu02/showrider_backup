<style>
    .btn_copy {
    position: relative;
    display: inline-block;
    padding: 6px 12px;
    font-size: 13px;
    line-height: 20px;
    color: #333;
    white-space: nowrap;
    vertical-align: middle;
    cursor: pointer;
    background-color: #eee;
    background-image: linear-gradient(#fcfcfc,#eee);
    border: 1px solid #d5d5d5;
    border-radius: 3px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    -webkit-appearance: none;
}
td.image_thumb_preview img {
    height: 70px !important;
}
</style>



<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->
        <div class="heading">
            <h3>Manage Common Image</h3>

            <div class="resBtnSearch">
                <a href="#"><span class="icon16 icomoon-icon-search-3"></span></a>
            </div>


            <div class="search">

                <input type="text" id="tipue_search_input" name="name" class="top-search" placeholder="Search here ..."
                       value="<?php
                       if ($this->uri->segment(5) != '0') {
                           $vals = $this->uri->segment(5);
                           $typed = str_replace("-", " ", $vals);
                           $typed = str_replace("123", "&", $typed);
                           echo $typed;
                       }
                       ?>"/>
                <input type="submit" id="tipue_search_button" class="search-btn" value=""/>

            </div>
            <!-- End search -->    



        </div>
        <!-- End .heading-->

        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->




        <div class="form-row row-fluid" style="width:40%; float:right ;">
            <div class="span12">
                <div class="row-fluid">
                    <label class="form-label span4" for="checkboxes">Sort By Category</label>

                    <div class="span8 controls">
                        <select name="select" id="sort_category">
                            <option value="All">All Categories</option>
                            <?php
                            foreach ($list_categories as $list_cat) {
                                ?>

                                <option value="<?php echo $list_cat['id']; ?>" <?php if ($this->uri->segment(3) == $list_cat['id']) echo 'selected'; ?> ><?php echo ucfirst($list_cat['name']); ?></option><?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>

<!--commonimageadmin-->


        <a href="<?php echo base_url(); ?>commonimageadmin/trash_viewImage" class="btn btn-inverse"><span
                class="icon16 icomoon-icon-loop white"></span> Refresh</a>


        <div class="row-fluid">
            <div class="span12">
                <div class="box gradient">
                    <div class="title">
                        <h4>
                            <span>View Common Image Trash</span>
                        </h4>
                    </div>
                    <div class="content noPad clearfix">

                        <table cellpadding="0" cellspacing="0" border="0"
                               class="dynamicTable display table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th width="40px">ID</th>
                                    <th >TITLE</th>
                                    <th width="120px">PICTURE</th>
                                    <th>RESTORE</th>
                                    <th width="50px" >DELETE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = $page_position;
                                foreach ($images as $p) {
                                    $banner= json_decode($p->images,TRUE);
                                    $i++;
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $p->title; ?></td>

                                        <td class="image_thumb_preview"><img src="<?php echo base_url() . 'media_library/'.$banner['image']; ?>" height="70" width="70"  /></td>
                                         <td class="center"><a href="javascript:void(0)" title="Restore Image" class="tip" onClick="restoreRef('<?php echo base_url(); ?>commonimageadmin/restoreImage/<?php echo $p->id; ?>')">
                                                <span class="icon12 icomoon-icon-undo-2"></span><strong>Restore Image</strong></a></td>
                                        <td class="center"><a href="javascript:void(0)" title="Remove Image" class="tip" onClick="linkRef('<?php echo base_url(); ?>commonimageadmin/deleteImage/<?php echo $p->id; ?>')">
                                                <span class="icon12 icomoon-icon-remove"></span></a></td> 
                                    </tr>

                                    <?php
                                }
                                ?>


                            </tbody>

                        </table>
                    </div>
                </div>
                <!-- End .box -->
            </div>
            <!-- End .span12 -->


            <div class="pagination_wrapper">
                <div class="pagination_wrapper-cover">
                    <div id="pagination">  <?php echo $pagination; ?>  </div>
                </div>
            </div>

        </div>
        <!-- End .row-fluid -->


    </div>
    <!-- End contentwrapper -->
</div>




<script type="text/javascript">

    $(document).ready(function () {
        $("#sort_category").change(function () {
            var id = $(this).val();


            window.location = '<?php echo base_url() . 'commonimageadmin/trash_viewImage/' ?>' + id;


        });



    });
</script>



<?php
if ($this->uri->segment(3) != '' & $this->uri->segment(3) != '0' & $this->uri->segment(3) != 'All') {

    $seg_3 = $this->uri->segment(3);
} else {
    $seg_3 = 0;
}
?>


<script type="text/javascript">

    $(document).ready(function () {

        $("#sort_sports").change(function () {
            var id = $(this).val();


            window.location = '<?php echo base_url() . 'commonimageadmin/trash_viewImage/' . $seg_3 . '/'; ?>' + id;


        });



    });
</script>


<?php if ($this->session->flashdata('message')) {
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


                window.location = '<?php echo base_url() . 'commonimageadmin/trash_viewImage/' . $seg_3 . '/' . $seg_4 . '/'; ?>' + total_name;


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


                    window.location = '<?php echo base_url() . 'commonimageadmin/trash_viewImage/' . $seg_3 . '/' . $seg_4 . '/'; ?>' + total_name;


                } else {

                    $("#tipue_search_input").focus();

                }

            }

        });


    });
</script>


