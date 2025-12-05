<div class="span12">
    <?php
    if (!empty($loc_data)) {
        foreach ($loc_data as $loc_data_row) {
            $parent_location = $loc_data_row['parent_location'];
            $parent_location_row = $this->user_model->GetByRow('cms_locations', $parent_location, 'id');

            if (!empty($parent_location_row->location)) {
                ?>
                <div class="span12">
                    <div class="title">
                        <h4><span><?php echo $parent_location_row->location; ?></span></h4>
                    </div>


               <?php
                }
                $location_list = $this->user_model->getlocation($parent_location);
                if (!empty($location_list)) {
                    foreach ($location_list as $location_row) {
                        ?>
                        <div class="left marginT5" style="border:1px solid #000;margin-right: 5px;padding-right: 2px;"> 
                            <input type="checkbox" 
                                   class="gl_location gl_location<?php echo $location_row->location_type_id; ?>"
                                   data-location_type_id="<?php echo $location_row->location_type_id; ?>"
                                   value="<?php echo $location_row->id; ?>"
                                   name="<?php
                                   if ($location_row->location_type_id == "1") {
                                       echo "location_country[]";
                                   } else if ($location_row->location_type_id == "2") {
                                       echo "location_state[]";
                                   } else if ($location_row->location_type_id == "3") {
                                       echo "location_city[]";
                                   }
                                   ?>" 

                                   <?php
                                   if ($location_row->location_type_id == "1") {
                                       $location_country = explode("+", $single_detail->location_country);
                                       array_shift($location_country);
                                       array_pop($location_country);
                                       if (in_array($location_row->id, $location_country)) {
                                           echo " checked ";
                                       }
                                   } else if ($location_row->location_type_id == "2") {

                                       $location_state = explode("+", $single_detail->location_state);
                                       array_shift($location_state);
                                       array_pop($location_state);
                                       if (in_array($location_row->id, $location_state)) {
                                           echo " checked ";
                                       }
                                   } else if ($location_row->location_type_id == "3") {
                                       $location_city = explode("+", $single_detail->location_city);
                                       array_shift($location_city);
                                       array_pop($location_city);
                                       if (in_array($location_row->id, $location_city)) {
                                           echo " checked ";
                                       }
                                   }
                                   ?>


                                   />
                            <span><?php echo $location_row->location; ?></span> 
                        </div>  
                        <?php
                    }
                }
                if (!empty($parent_location_row->location)) {
                    ?>
                </div>

                <?php
            }
        }
    }
    ?>
</div>
