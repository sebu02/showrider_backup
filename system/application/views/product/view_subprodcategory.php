<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->
        <div class="heading">
            <h3>Manage Sub Categories</h3>
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
        </div><!-- End .heading-->
        
        
        <div class="form-row row-fluid" style="width:40%; float:right ;">
            <div class="span12">
                <div class="row-fluid">


                </div>
            </div>
        </div>

        <a href="<?php echo base_url(); ?>ecproductadmin/view_prodcategory" class="btn btn-inverse"><span
                class="icon16 icomoon-icon-loop white"></span> View All</a>
                
                
        <div class="row-fluid">
            <div class="span12">
                <div class="box gradient">
                    <div class="title">
                        <h4>
                            <span>View Sub Categories</span>
                        </h4>
                    </div>
                    <div class="content noPad clearfix">
                        <table cellpadding="0" cellspacing="0" border="0" class="dynamicTable display table table-bordered" width="100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>NAME</th>
                                <th>PARENT CATEGORY</th>
                                <th>TYPE</th>
                                <th>ORDER</th>
                                <th>STATUS</th>
                                <th>EDIT</th>
                                <th>DELETE</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = $page_position;
             
                            foreach ($view_items_list as $row)
                            {
                                $i++;
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row->category; ?></td>
                                    <td><?php $ct_id = $row->parent_sub_id;
                                        $this->db->where('id', $ct_id);
                                        $res1 = $this->db->get('ec_category')->row();
                                        echo $res1->category;
                                        ?></td>
                                    <td><?php echo $row->cat_type; ?></td>
                                    <td><?php echo $row->order_no; ?></td>
                                    <td>
                                        <?php
                                        if ($row->active_status == 'a')
                                        {
                                            echo 'Active';
                                        }
                                        else
                                        {
                                            echo 'Deactive';
                                        }
                                        ?>
                                    </td>
                                    <td class="center">
                                        <a href="<?php echo base_url(); ?>ecproductadmin/edit_subprodcategory/<?php echo $row->id; ?>" title="Edit Category" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                                    </td>
                                    <td class="center">
                                        <a href="#" title="Remove Category" class="tip" onClick="linkRef('<?php echo base_url(); ?>ecproductadmin/trash_subprodcategory/<?php echo $row->id; ?>')"><span class="icon12 icomoon-icon-remove"></span></a>
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
<?php if ($this->session->flashdata('message'))
{
    ?>
    <script type="text/javascript">
        $(document).ready(function ()
        {
            //Regular success
            $.pnotify({
                type: 'success',
                title: '<?php echo $this->session->flashdata('message');?>',
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
    function linkRef(yurl)
    {
        var linkref = yurl;
        if (confirm("Do you really want to delete ?"))
        {
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


                window.location = '<?php echo base_url() . 'ecproductadmin/view_subprodcategory/'; ?>' + total_name;


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


                    window.location = '<?php echo base_url() . 'ecproductadmin/view_subprodcategory/'; ?>' + total_name;


                } else {

                    $("#tipue_search_input").focus();

                }

            }

        });


    });
</script>
