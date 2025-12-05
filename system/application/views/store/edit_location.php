<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->

        <div class="heading">

            <h3>Manage Location</h3>                    

        </div><!-- End .heading-->

        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

        <div class="row-fluid">

            <div class="span6" style="width:70%; margin-left:15%;">

                <div class="box">

                    <div class="title">

                        <h4> 
                            <span>Edit Location</span>
                        </h4>

                    </div>
                    <div class="content">

                        <form role="form" name="edit_location" id="edit_location">
                            <div class="gl_location_type_wrapper">

                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <div class="error_messages">



                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="loc_type_count" class="loc_type_count" value="<?php echo count($types); ?>">
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="normal">Location Type</label>
                                            <?php
                                            foreach ($types as $t) {
                                                ?>
                                                <div class="span3">
                                                    <input data-parent-id="<?php echo $t->parent_id; ?>" 
                                                           data-id-tree="<?php echo $t->location_id_tree; ?>"
                                                           data-location-key="<?php
                                                           if ($t->parent_id != '0') {
                                                               $location_key = $this->common_model->GetByRow('cms_location_types', $t->parent_id, 'id');
                                                               echo $location_key->location_key;
                                                           } else {
                                                               echo $t->location_key;
                                                           }
                                                           ?>"
                                                           type="radio" name="location_type_id" 
                                                           class="location_type_id" value="<?php echo $t->id; ?>" 
                                                           <?php
                                                           if ($t->id == $value->location_type_id) {
                                                               echo 'checked';
                                                           }
                                                           ?>>
                                                    <label for="location_type_id" class="sa-right-pull-70"><?php echo $t->location_type; ?></label>  
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>


                                <div class="alllocation form-row row-fluid">
                                    <div class="gl_location_wrapper">
                                        <?php
                                        if ($value->parent_id != '0') {

                                            $parent_type_tree = $parent_type_value->location_id_tree;

                                            $parent_type_id_tree_array = array();
                                            $parent_type_id_tree_array = explode('+', $parent_type_tree);

                                            array_pop($parent_type_id_tree_array);
                                            $parent_type_id_tree_array = array_slice($parent_type_id_tree_array, 1);
                                            $parent_type_id_tree_array = array_reverse($parent_type_id_tree_array);

                                            $parent_location_tree = $parent_value->location_id_tree;

                                            $parent_location_id_tree_array = array();
                                            $parent_location_id_tree_array = explode('+', $parent_location_tree);

                                            array_pop($parent_location_id_tree_array);
                                            $parent_location_id_tree_array = array_slice($parent_location_id_tree_array, 1);
                                            ?>
                                            <?php
                                            if (!empty($parent_type_id_tree_array)) {
                                                foreach ($parent_type_id_tree_array as $type_id) {

                                                    $type_detail = $this->common_model->GetByRow('cms_location_types', $type_id, 'id');

//                                            $type_location_detail = $this->store_model->get_locations_by_type_id($type_id);
                                                    $type_location_detail = $this->store_model->get_locations_by_idtree($type_id, $parent_location_id_tree_array);
                                                    $child_location_type = $this->store_model->get_child_location_type($type_id);
                                                    ?>
                                                    <div class="form-row row-fluid">
                                                        <div class="span12 uniquelocation gl_fixed_dropdown">
                                                            <div class="row-fluid">
                                                                <label class="form-label span4" for="country"><?php echo $type_detail->location_type; ?></label>
                                                                <div class="span8 controls"> 

                                                                    <select id="" name="country" 
                                                                            data-location-key="<?php echo $type_detail->location_key; ?>"
                                                                            class="locationlist form-control select2 gl_uniq_loc loc_<?php echo $type_id; ?>"
                                                                            data-type="<?php echo $type_id; ?>"
                                                                            data-childtype="<?php echo $child_location_type->id; ?>"
                                                                            style="width: 100%;">
                                                                        <option value=''>--select--</option>
                                                                        <?php
                                                                        if ($type_id == 1) {
                                                                            foreach ($country_list as $key => $cl) {
                                                                                ?>
                                                                                <option value="<?php echo $cl->id; ?>"<?php
                                                                                if (in_array($cl->id, $parent_location_id_tree_array)) {
                                                                                    echo 'selected';
                                                                                }
                                                                                ?>><?php echo $cl->location; ?></option>
                                                                                        <?php
                                                                                    }
                                                                                } elseif (!empty($type_location_detail)) {
                                                                                    foreach ($type_location_detail as $p) {
                                                                                        ?>
                                                                                <option value="<?php echo $p->id; ?>"
                                                                                <?php
                                                                                if (in_array($p->id, $parent_location_id_tree_array)) {
                                                                                    echo 'selected';
                                                                                }
                                                                                ?>><?php echo $p->location; ?></option>

                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>

                                                                    </select>
                                                                    <span class="error">

                                                                    </span>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <?php
                                                }
                                            }
                                        }
                                        ?>

                                    </div>
                                    <div class="form-row row-fluid">
                                        <div class="span12 gl_main_list uniquelocation gl_current_loc_<?php echo $main->id; ?>">
                                            <div class="row-fluid">
                                                <label class="form-label span4" for="country"><?php echo $main->location_type; ?></label>
                                                <div class="span8 controls"> 

                                                    <select id="country" name="country"
                                                            data-child="<?php echo $child->location_type; ?>"
                                                            data-child-id="<?php echo $child->id; ?>"
                                                            data-location-key="<?php echo $main->location_key; ?>"
                                                            class="country locationlist_drop form-control select2"
                                                            style="width: 100%;">
                                                        <option value=''>--select--</option>
                                                        <?php if (!empty($main_list)) { ?>

                                                            <?php foreach ($main_list as $p) { ?>

                                                                <option <?php
                                                                if ($p->id == $value->id) {
                                                                    echo 'disabled';
                                                                }
                                                                ?> value="<?php echo $p->id; ?>"><?php echo $p->location; ?></option>

                                                                <?php
                                                            }
                                                        }
                                                        ?>

                                                    </select>
                                                    <span class="error">

                                                    </span>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <span class="error order_msg">

                                </span>
                                <span class="error required_msg">

                                </span>


                                <input name="id" type="hidden" class="edit_id" id="edit_id" value="<?php echo $value->id; ?>">
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="location">Location</label>
                                            <input class="span8 slug_ref location" id="location" type="text" name="location"  value="<?php echo $value->location; ?>" required />
                                            <span class="error location_required_msg">

                                            </span>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="slug">Unique location name<b style="color:#F00; font-size:11px;">*</b></label>
                                            <span style="font-size:11px;" class="sa_base_url_section"><?php echo base_url(); ?></span> 
                                            <span style="font-size:11px;" class="sa_remain_url_section"></span> 
                                            <input class="uniq_location_name span6 read-slug slug_url_val" readonly id="slug" type="text" name="uniq_location_name" value="<?php echo $value->uniq_location_name; ?>" required/>
                                            <span class="right manipTxt slugShow"><a onclick="slugShow()" class="icomoon-icon-pencil">Write Mode On</a></span>
                                            <span class="right manipTxt slugHide" style="display: none;"><a onclick="slugHide()" class="icomoon-icon-link-5">Write Mode Off</a></span>
                                            <span class="error">
                                            </span>
                                            <span class="error exist_msg">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="location_code">Location code</label>
                                            <input class="span8 location_code" id="location_code" type="text" name="location_code"  value="<?php echo $value->location_code; ?>" required />
                                            <span class="error location_code_required_msg">

                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                        <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span4" >Delivery Charge Amount</label>
                                        <input class="span8 location_deliverybyamount" type="number" name="location_deliverybyamount"  value="<?php echo $value->deliverybyamount; ?>"  />
                                        
                                    </div>
                                </div>
                            </div>

                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span4" for="normal">Active Status</label>
                                            <div class="span3">
                                                <input type="radio" class="active_status" name="active_status" value="a"
                                                <?php
                                                if ($value->active_status == 'a') {
                                                    echo 'checked';
                                                }
                                                ?>>
                                                <label for="active_status" class="sa-right-pull-70">Activate</label>  
                                            </div>
                                            <div class="span3">
                                                <input type="radio" class="active_status" name="active_status" value="d" <?php
                                                if ($value->active_status == 'd') {
                                                    echo 'checked';
                                                }
                                                ?>>
                                                <label for="active_status" class="sa-right-pull-70">Deactivate</label>  
                                            </div>

                                        </div>
                                    </div>
                                </div>



                                <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-info showhide-btn submit">Submit</button>

                            </div>


                        </form>

                    </div>

                    <div class="gl_alert_sec"> 
                    </div>
                </div><!-- End .box -->

            </div><!-- End .span6 --><!-- End .span6 --><!-- End .span6 -->

        </div><!-- End .row-fluid --><!-- End .row-fluid --><!-- End .row-fluid --><!-- End .row-fluid -->
    </div><!-- End contentwrapper -->
</div>

<script type="text/javascript">

    $(document).ready(function () {

        $('.gl_location_wrapper').on('change', '.gl_uniq_loc', function () {

            var loctype = $(this).attr('data-type');
            var child_loctype = $(this).attr('data-childtype');

            var parent_id = $('.' + 'loc_' + loctype).val();

//$('.'+'loc_'+child_loctype + 'option:first').prop('selected',true);

            $.ajax({
                url: "<?php echo base_url(); ?>cmsstorefinderadmin/get_location_list",
                type: "post",
                data: {
                    p_id: parent_id, l_id: child_loctype
                },
                success: function (msg)
                {

                    $('.' + 'loc_' + child_loctype).html(msg);
//                    $('.'+'loc_'+child_loctype + 'option:first').prop('selected',true);
                }
            });
        });

//        sessionStorage.setItem("type_change_check", "no");

        $(".gl_main_list").hide();

        var parentid = $('.location_type_id:checked').attr('data-parent-id');

        function hidelocationlist(parentid) {


            if (parentid == '0') {
//                alert(parentid);
                $(".alllocation").hide();
            } else {
                $(".alllocation").show();


            }
        }
        function locationlist_validation() {

            var err_check = '';
            var err_check1 = '';
            var err_check2 = '';
            var err_check3 = '';
            var location_val = $('.location').val();
            if (location_val == '') {


                err_check1 = 1;
                $(".location_required_msg").html('location name is required');
            } else {

                $(".location_required_msg").html('');
                err_check1 = 0;
            }

            err_check2 = 0;
//            var location_code_val = $('.location_code').val();
//            if (location_code_val == '') {
//                err_check2 = 1;
//
//                $(".location_code_required_msg").html('location code is required');
//            } else {
//                err_check2 = 0;
//
//                $(".location_code_required_msg").html('');
//            }

            var parentid = $('.location_type_id:checked').attr('data-parent-id');

            if (parentid != '0') {

//                var loc_val = $('.locationlist').val();

                $('.alllocation .locationlist').each(function () {
                    var loc_val = $(this).val();

                    if (loc_val == '') {
                        err_check3 = 1;
                        $(".required_msg").html('location selection is required');
                        return false;
                    } else {
                        err_check3 = 0;
                        $(".required_msg").html('');
                    }
                })

            } else {
                err_check3 = 0;
                $(".required_msg").html('');
            }
            err_check = err_check1 + err_check2 + err_check3;
            return err_check;
        }

        hidelocationlist(parentid);

        $('.gl_location_type_wrapper').on('change', '.location_type_id', function () {

//            $('.locationlist option:selected').val('');
//            $(".country").prop('selected', false);

//            $(".country").val('');

            $(".country").addClass("locationlist");
            $(".country").addClass("gl_order_check");
//            $(".gl_main_list").show();
            $(".gl_location_wrapper").remove();
//            $(".gl_fixed_dropdown").remove();
            $(".gl_location").remove();

//            sessionStorage.setItem("type_change_check", "yes");

            var parentid = $(this).attr('data-parent-id');

            if (parentid != 0) {
                $(".gl_main_list").show();
            } else {
                $(".gl_main_list").hide();
            }

            hidelocationlist(parentid);


        })
        $('.gl_location_type_wrapper').on('change', '.locationlist_drop', function () {


            var id = $('.edit_id').val();
            var type = 'edit';

            var location_id = $(this).val();
            if (location_id != '') {
                var child = $(this).attr('data-child');

                var child_id = $(this).attr('data-child-id');
                var loaction_type_id = $('.location_type_id:checked').val();

//            alert(loaction_type_id);


                $.ajax({
                    url: "<?php echo base_url(); ?>cmsstorefinderadmin/get_location_dropdown",
                    type: "post",
                    data: {
                        id: id,
                        type: type,
                        location_id: location_id,
                        loaction_type_id: loaction_type_id,
                        child: child,
                        child_id: child_id
                    },
                    success: function (msg)
                    {
                        $(".alllocation").show();
//        alert(msg);
//console.log('gl_current_loc_'+child_id);
//debugger;


                        if ($('.alllocation').find('.uniquelocation').hasClass('gl_current_loc_' + child_id)) {

                            var loc_type_count = $('.loc_type_count').val();

                            for (var i = child_id; i <= loc_type_count; i++) {
                                $('.gl_current_loc_' + i).remove();
                            }


//            $('.gl_current_loc_' + child_id).remove();


                            //                            $(".alllocation").append(msg);
                            var q = $('.uniquelocation').last();
                            $(msg).insertAfter(q);
                        } else {
                            //                            $(".alllocation").append(msg);
                            var lastsamelist = $('.uniquelocation').last();
                            $(msg).insertAfter(lastsamelist);
                        }

                    },
                })

            }

        });

        function unique_name_check() {
            var unique_check;
            var uniq_location_name = $('.uniq_location_name').val();
            var id = $('.edit_id').val();
            var type = 'edit';

            $.ajax({
                url: "<?php echo base_url(); ?>cmsstorefinderadmin/unique_location_name_check",
                type: "post",
                async: false,
                data: {type: type, id: id, uniq_location_name: uniq_location_name},

                success: function (msg)
                {
                    if (msg == 1) {
                        unique_check = 1;

                        $(".existt_msg").html('unique name already exists');

                    } else if (msg == 0) {
                        unique_check = 0;

                        $(".existt_msg").html('');

                    }


                }
            });
            return unique_check;
        }

        function type_key_check() {

            var type_check = '';
            var parentid = $('.location_type_id:checked').attr('data-parent-id');
            if (parentid != '0') {

                var location_type_key = $('.location_type_id:checked').attr('data-location-key');
                var order_status = '1';

                $('.alllocation .locationlist').each(function () {
                    var location_type = $(this).attr('data-location-key');

                    if (location_type == location_type_key) {
                        order_status = '0';
                    }

                })

                if (order_status == '0') {

//                $('.submit').prop('disabled', false);
                    type_check = 0;
                    $(".order_msg").html('');
                } else if (order_status == '1') {

                    $(".order_msg").html('add location in chronological order<br>');
                    type_check = 1;
//                $('.submit').prop('disabled', true);
                }
            } else {
                type_check = 0;
                $(".order_msg").html('');
            }
//            debugger;
            return type_check;
        }


        $('.gl_location_type_wrapper').on('blur', '.location', function () {

            var unique_name_check_blur = unique_name_check();
//            alert(unique_name_check_blur);
            var type_key_check_blur = type_key_check();
//            alert(type_key_check_blur);

        });


        $('.submit').on('click', function (e) {
            e.preventDefault();

            var type_key_check_sub = type_key_check();
            var unique_name_check_sub = unique_name_check();



            var error_check = locationlist_validation();



            if (error_check == '0' && type_key_check_sub == '0' && unique_name_check_sub == '0')

            {

                var parent_id_tree = '+';

                $('.alllocation .locationlist').each(function () {

                    var new_parent_id_tree = $(this).val();

                    parent_id_tree += new_parent_id_tree + '+';

                })
//                alert(parent_id_tree);
                var main_parent_id = $('.alllocation .locationlist').first().val();
                var parent_id = $('.alllocation .locationlist').last().val();


                var location_type_id = $('.location_type_id:checked').val();
//            debugger;
                var active_status = $('.active_status:checked').val();
                var id = $('.edit_id').val();
                var location = $('.location').val();
                var location_code = $('.location_code').val();
                var uniq_location_name = $('.uniq_location_name').val();
				var location_deliverybyamount = $('.location_deliverybyamount').val();
                $.ajax({
                    url: "<?php echo base_url(); ?>cmsstorefinderadmin/edit_location_detail",
                    type: "post",
                    data: {id: id,
                        active_status: active_status,
                        parent_id_tree: parent_id_tree,
                        main_parent_id: main_parent_id,
                        parent_id: parent_id,
                        location_type_id: location_type_id,
                        location: location,
                        location_code: location_code,
                        uniq_location_name: uniq_location_name,
						location_deliverybyamount: location_deliverybyamount},
                    success: function (msg)
                    {
//                    alert('added');$(".gl_alert_sec").html(msg);

                        $('.gl_alert_sec').append("<div class='alert alert-success alert-dismissible'>" +
                                "<button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>" +
                                "<h4><i class='icon fa fa-check'></i>Edited successfully</h4>" +
                                "</div>");
                        setTimeout(function () {
                            $(".alert-success").fadeOut();
                        }, 3000);

//                        window.location.reload(true);
                        window.location.href = "<?php echo base_url(); ?>cmsstorefinderadmin/view_location/";
//                        $('#edit_location')[0].reset();

                    },
                })
            }
        })
    });
</script>