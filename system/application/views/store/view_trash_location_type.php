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
</style>



<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->
        <div class="heading">
            <h3> Manage Locations</h3>

            <div class="resBtnSearch">
                <a href="#"><span class="icon16 icomoon-icon-search-3"></span></a>
            </div>


            <div class="search">

                <input type="text" id="tipue_search_input" name="table_search" class="top-search searchinput1" placeholder="Search here ..."
                       value="<?php
                                    if (isset($_GET['seg3'])) {
                                        $vals = $_GET['seg3'];
                                        $typed = str_replace("-", " ", $vals);
                                        $typed = str_replace("_sbn_", "&", $typed);
                                        echo $typed;
                                    }
                                    ?>"/>
                <input type="submit" id="tipue_search_button" class="search-btn searchinputbutton1" value=""/>

            </div>
            <!-- End search -->    



        </div>
        <!-- End .heading-->

        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->


 <div class="form-row row-fluid" style="width:40%; float:right ;">
            <div class="span12">
                <div class="row-fluid">
                    
                  
                </div>
            </div>
        </div>
         
                            <a href="<?php echo base_url(); ?>cmsstorefinderadmin/view_trash_location_type/" class="btn btn-inverse"><span
                class="icon16 icomoon-icon-loop white"></span>Refresh</a>
                            <?php
                            $segment_array = $this->uri->segment_array();
                            $uristrings = $_SERVER['QUERY_STRING'];
                            ?>
                            <?php
                            if (isset($_GET['seg3'])) {
                                $vals = $_GET['seg3'];
                                $typed = str_replace("-", " ", $vals);
                                $typed = str_replace("_sbn_", "&", $typed);


                                $remove_seg3 = '&seg3=' . $_GET['seg3'];

                                $newuristrings = str_replace($remove_seg3, '', $uristrings);
                                ?>
        
        <?php /* ?>
                                <a class="btn bg-purple btn-xs" style="margin-right:10px;" href="<?php echo base_url() . 'cmsstorefinderadmin/view_trash_location_type?' . $newuristrings; ?>"><?php echo $typed; ?> &nbsp;&nbsp;<i class="fa fa-times-circle"></i></a>
                                <?php /**/ ?>
                                <?php
                            }
                            ?>


        <div class="row-fluid">
            <div class="span12">
                <div class="box gradient">
                    <div class="title">
                        <h4>
                            <span>View Trash Location Types</span>
                        </h4>
                    </div>
                    <div class="content noPad clearfix">

                        <table cellpadding="0" cellspacing="0" border="0"
                               class="dynamicTable display table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Location Type</th>
                                    <th width="150px" >Restore</th>
                                    <th width="50px" >Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = $page_position;
                                foreach ($values as $row) {
                                    $i++;
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $i; ?></td>
                                    <td><?php echo ucwords($row->location_type); ?></td>
                                    
                                    
                                                    <td class="center">
                                                        <a  href="<?php echo base_url() . 'cmsstorefinderadmin/restore_location_type?id=' . $row->id . $_SERVER['QUERY_STRING']; ?>" title="Restore Location Type" class="tip"></span>Restore</a>
                                                    </td>
                                                    
                                                    <td class="center">
                                                        <a  href="javascript:void(0)" title="Delete Location Type" onClick="linkRef('<?php echo base_url() . 'cmsstorefinderadmin/permanent_delete_location_type?id=' . $row->id . $_SERVER['QUERY_STRING']; ?>')" > <span class="icon12 icomoon-icon-remove"></span></a>
                                                    </td>


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
</script>




<?php
$segmentarrays = array();


if (isset($_GET['seg3'])) {

    $segmentarrays['&seg3='] = $_GET['seg3'];
}
?>
<?php ?>
<script type="text/javascript">

    $(document).ready(function () {


        $(".searchinputbutton1").click(function () {

            searchinput1();
        });


        $(".searchinput1").keyup(function (e) {

            if (e.which == 13) {

                searchinput1();

            }

        });


    });


    function searchinput1()
    {


        if ($(".searchinput1").val() != '') {

            var name = $(".searchinput1").val();


            var name1 = name.replace("'", "");

            var name2 = name1.replace('"', '');

            var name3 = name2.replace('/', '');

            var name4 = name3.replace('&', '_sbn_');

            var splted = name4.split(" ");


            var splite_count = splted.length;


            var search_value = '';


            for (var i = 0; i < splite_count; i++) {

                search_value += splted[i] + '-';

            }


            var name = search_value.substring(0, search_value.length - 1);


<?php
$uriarrays = $this->store_model->geturiarrays($segmentarrays, 'seg3');
?>
            window.location = '<?php echo base_url() . 'cmsstorefinderadmin/view_trash_location_type?' . $uriarrays; ?>&seg3=' + name;


        } else {

            $(".searchinput1").focus();

        }


    }

</script>