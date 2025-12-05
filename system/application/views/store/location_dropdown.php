<!--<div class="form-row row-fluid">-->
                                <div class="form-row row-fluid gl_location uniquelocation gl_current_loc_<?php echo $child_id; ?>">
                                    <div class="row-fluid">
                                        <label class="form-label span4" for="parent_id"><?php echo $child; ?></label>
                                        <div class="span8 controls">   
                                            <select id="parent_id" name="parent_id" 
                                                    data-child="<?php echo $child2->location_type; ?>"
                                                    data-child-id="<?php echo $child2->id; ?>"
                                                    data-location-key="<?php echo $parent_type_location_key; ?>"
                                                    class="parent_id locationlist gl_order_check form-control select2 locationlist_drop" 
                                                    style="width: 100%;">
                                        <option value=''>--select--</option>
                                        <?php if (!empty($values)) { ?>

                                            <?php foreach ($values as $p) { ?>

                                                <option <?php if ($p->id == $id) {
                                            echo 'disabled';
                                        } ?> value="<?php echo $p->id; ?>"><?php echo $p->location; ?></option>

                                            <?php }
                                            ?>
                                        <?php }
                                        ?>

                                    </select>
                                            <span class="error">
                                               
                                            </span>
                                        </div> 
                                    </div>
                                </div> 
                            <!--</div>-->