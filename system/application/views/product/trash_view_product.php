<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->
        <div class="heading">
            <h3 class="gl_ftype_label">Manage Products</h3>   

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

        <a href="<?php echo base_url(); ?>ecproductadmin/trash_view_product/0/<?php echo $this->uri->segment(4); ?>" class="btn btn-inverse"><span
                class="icon16 icomoon-icon-loop white"></span>View All</a>


        <div class="row-fluid">
            <div class="span12">
                <div class="box gradient">
                    <div class="title">
                        <h4>
                            <span class="gl_ftype_label">View Trash Products</span>
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
                                $tip_type = 'Product';
                                $ftype = $this->uri->segment(4);
                                if ($ftype == 'shop') {
                                    $tip_type = 'Shop';
                                }
                                ?>
                                <?php
                                $i = $page_position;

                                foreach ($view_items_list as $row) {

                                    $i++;
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row->prod_name; ?></td>


                                        <td class="center">
                                            <a href="javascript:void(0)" title="Restore <?php echo $tip_type; ?>" class="tip" onClick="restoreRef('<?php echo base_url(); ?>ecproductadmin/restore_product/<?php echo $row->id; ?>/<?php echo $this->uri->segment(4); ?>')">
                                                <span class="icon12 icomoon-icon-undo-2"></span><strong class="gl_ftype_label">Restore Product</strong>
                                            </a>
                                        </td>   
                                        <td class="center">
                                            <a href="javascript:void(0)" title="Remove <?php echo $tip_type; ?>" class="tip" onClick="linkRef('<?php echo base_url(); ?>ecproductadmin/delete_product/<?php echo $row->id; ?>/<?php echo $this->uri->segment(4); ?>')">
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

            <input type="hidden" class="gl_seg4" value="<?php echo $this->uri->segment(4); ?>">

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
    $(document).ready(function () {
        var seg4 = $('.gl_seg4').val();
        if (seg4 == 'shop') {
            $('.gl_ftype_label').each(function () {
                var str = $(this).text();
                var str = str.replace('product', 'shop');
                var str = str.replace('Product', 'Shop');
                var str = str.replace('PRODUCT', 'SHOP');
                $(this).text(str);
            });
        }
    });
</script>
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

            trash_prod_search();


        });
        $("#tipue_search_input").keyup(function (e) {

            if (e.which == 13) {

                trash_prod_search();


                }

        });


    });


    function trash_prod_search() {

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

            var seg4 = $('.gl_seg4').val();

            window.location = '<?php echo base_url() . 'ecproductadmin/trash_view_product/'; ?>' + total_name + '/' + seg4;


                } else {

                    $("#tipue_search_input").focus();

                }
            }


</script>
