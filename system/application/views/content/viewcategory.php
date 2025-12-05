<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->
        <div class="heading">
            <h3>Manage Content Category</h3>                  

        </div><!-- End .heading-->



<?php 

$hide_field="";
$special_action = "no";

if(!empty($_GET['catid']) && !empty($_GET['actiontype'])){

if($_GET['actiontype'] == 'subcategory')
{
$hide_field=" hide ";
$special_action = "yes";
}

}
?> 



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
                        <form class="form-horizontal gl_search_sorting_form" action="<?php echo base_url() . 'contentadmin/viewcategory'; ?>" method="get" enctype="multipart/form-data" >
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



                                    <div class="row-fluid <?php echo $hide_field ; ?> " style="width: 50%; float:left;">
                                        <label class="form-label span3" for="status">Filter By CMS Type</label>
                                        <div class="span2" style="width: 40%;">
                                            <select name="category" id="cms_type" class="gl_cms_type gl_enter_submit">
                                                <option value="">Type</option>
                                                <?php
                                                foreach ($cms_type_array as $key => $list_types) {
                                                    ?>
                                                    <option value="<?php echo $list_types; ?>" 

                                                            <?php
                                                            if (isset($_GET['category'])) {
                                                                if ($_GET['category'] === $list_types) {
                                                                    echo ' selected ';
                                                                }
                                                            }
                                                            ?>
                                                            >
                                                        <?php echo ucwords(str_replace('_', ' ', ($list_types))); ?></option>

                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>



                                    <div class="form-row row-fluid <?php echo $hide_field ; ?> ">
                                        <div class="span12">
                                            <label style="float: left; margin-right: 21px;" for="order_no">Custom sort</label>

                                            <?php
                                            $sort_array = array('id', 'order', 'name');
                                            ?>


                                            <div class="row-fluid" style="width: 22%; float:left;">

                                                <div class="span2" style="width:85%;">

                                                    <select name="sort_radio"  class="sort_radio gl_enter_submit">
                                                        <option value="" >--Sort Type--</option>
                                                        <?php
                                                        foreach ($sort_array as $sort) {
                                                            ?>

                                                            <option value="<?php echo $sort; ?>" 
                                                            <?php
                                                            if (isset($_GET['sort_radio'])) {
                                                                if ($_GET['sort_radio'] === $sort) {
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            ?>  ><?php echo ucfirst($sort); ?></option>     

                                                        <?php }
                                                        ?>

                                                    </select>
                                                    <label style="font-size: 11px;color: red;" class="sort_radio_error"></label>

                                                </div>
                                            </div>




                                            <div class="row-fluid <?php echo $hide_field ; ?> " style="width: 30%; float:left">
                                                <label class="form-label span4" for="status">Sort Order</label>
                                                <div class="span2" style="width: 68%;">

                                                    <?php $status_array = array('asc' => 'ascending', 'desc' => 'descending', 'random' => 'random'); ?>

                                                    <select name="custom_sort" id="custom_sort" class="custom_sort gl_enter_submit">
                                                        <option value="">Select Order</option>
                                                        <?php
                                                        foreach ($status_array as $key => $order) {
                                                            ?>
                                                            <option value="<?php echo $key; ?>" 

                                                                    <?php
                                                                    if (isset($_GET['custom_sort'])) {
                                                                        if ($_GET['custom_sort'] === $key) {
                                                                            echo 'selected';
                                                                        }
                                                                    }
                                                                    ?>



                                                                    >
                                                                <?php echo ucfirst($order); ?></option>

                                                        <?php } ?>
                                                    </select>
                                                    <label style="font-size: 11px;color: red;" class="custom_sort_error"></label>
                                                </div>
                                            </div>

                                        </div>
                                    </div> 


                                </div>
                            </div>
                            <div class="form-actions" style="padding-left: 20px;">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <div class="span3">
                                            <a href="<?php echo base_url(); ?>contentadmin/viewcategory" class="btn btn-inverse pull-left"><span
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

                            switch ($get_key) {
                                case 'per_page':

                                    $newuristrings = "";
                                    break;

                                case 'category' :

                                    if (isset($_GET['category'])) {
                                        $category = $_GET['category'];
                                    }

                                    break;


                                case 'sort_radio' :

                                    if (isset($_GET['sort_radio'])) {
                                        $sort_radio = $_GET['sort_radio'];
                                        $get_value = $sort_radio;
                                    }

                                    break;

                                case 'custom_sort' :

                                    if (isset($_GET['custom_sort'])) {
                                        $order = $_GET['custom_sort'];


                                        if ($order == 'asc') {
                                            $get_value = 'ascending';
                                        } else if ($order == 'desc') {
                                            $get_value = 'descending';
                                        } else if ($order == 'random') {
                                            $get_value = 'random';
                                        }
                                    }

                                    break;

                                default:

                                    break;
                            }




                            if ($newuristrings !== "") {

if($special_action != 'yes')
{
                                ?>
                                <a class="btn btn-mini btn-primary" style="margin-right:10px;" href="<?php echo base_url() . 'contentadmin/viewcategory?' . $newuristrings; ?>"><?php echo ucwords($get_value); ?> &nbsp;&nbsp;<span aria-hidden="true" class="icomoon-icon-cancel"></span></a>

                                <?php
}
                            }
                        }
                        ?>



                    </div>

                </div><!-- End .box -->

            </div><!-- End .span12 -->

        </div><!-- End .row-fluid -->


        <div class="form-row row-fluid" style="width:40%; float:right;">
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
                            <span>View Content Category</span>
                        </h4>
                    </div>
                    <div class="content noPad clearfix">

                        <table cellpadding="0" cellspacing="0" border="0" class="dynamicTable display table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th width="40px">ID</th>
                                    <th>NAME</th>
                                    
                                    <th>INFO</th>
                                    <!--<th  >ACTION</th>-->
                                    <?php /*?><th class="hide">PICTURE</th><?php */?>
                                    <!--<th>DETAIL STATUS</th>-->
                                   
                                    <th width="150px" >EDIT</th>
                                    <th width="50px" >DELETE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = $page_position;
//print_r($categories);
                                foreach ($categories as $cat) {
                                    $i++;
                                    $banner = json_decode($cat->category_picture);
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $cat->category; ?></td>
                                        
                                        <td><b>Parent : </b> <?php
                                            if ($cat->parent_id != 0) {
                                                $main_parent = $this->content_model->GetByRow('cms_dynamic_category', $cat->parent_id, 'id');
                                            } elseif ($cat->parent_id == 0) {
                                                $main_parent = $this->content_model->GetByRow('cms_dynamic_category', $cat->id, 'id');
                                            }

                                            echo $main_parent->category;
                                            ?>
                                            <hr>
                                            <b>Type : </b>
                                            <?php echo ucwords(str_replace("_", " ", $cat->type)); ?>
                                            
                                            
                                            </td>
                                           
                                        <!--<td class="center">
                                             <?php /*?>
                                            ASSIGN COMMONINPUTS : <br>
                                                 <a
                                                href="<?php echo base_url() . 'appearanceadmin/assign_common_input?id=' . $cat->id. '&type=category'; ?>"
                                                title="Assign Commoninput" class="tip" target="_blank" style="color:#462AD3;">Assign Commoninput</a>
                                                
                                                <hr> <?php /**/?>
                                                
                                               <?php /*?> VIEW CONTENTS : <br>
                                                 <a
                                                href="<?php echo base_url() . 'contentadmin/viewcontent?category=' . $cat->id. '&'; ?>"
                                                title="View Contents" class="tip" target="_blank" style="color:#462AD3;">View Contents</a><?php */?>
                                                
                                                </td>-->
                                        <?php /*?><td  class="hide"><?php if ($banner[0]->image != '') {
                                                ?>
                                                <img src="<?php echo base_url() . 'media_library/' . $banner[0]->image; ?>" width="70" height="70"  />
                                                <?php
                                            } else {
                                                ?>
                                                <img src="<?php echo base_url() . 'static/admin/'; ?>images/noimage.png" width="70" height="70">
                                                <?php
                                            }
                                            ?></td><?php */?>

                                        <?php /* ?> <td><?php echo $cat->content_detail_page; ?></td><?php /* */ ?>
                                        
                                        <td class="center"> 

                                            <a href="<?php echo base_url() . 'contentadmin/edit?id=' . $cat->id . '&'.$_SERVER['QUERY_STRING']; ?>" title="Edit Category" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>

                                        </td> 
                                        <td class="center">
                                            <a href="javascript:void(0)" title="Remove Category" class="tip" onClick="linkRef('<?php echo base_url() . 'contentadmin/trashCategory?id=' . $cat->id . '&' . $_SERVER['QUERY_STRING']; ?>')"> <span class="icon12 icomoon-icon-remove"></span></a>

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
$seg3 = 0;
$seg4 = 0;
$seg5 = 0;
if (!empty($this->uri->segment(5))) {
    $seg5 = $this->uri->segment(5);
}
?>   

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




