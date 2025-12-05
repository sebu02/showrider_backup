<option value=''>--select--</option>
            <?php
            if (!empty($val)) {

                foreach ($val as $v) {
                    ?>

<option value="<?php echo $v->id; ?>"><?php echo $v->location; ?></option>

                    <?php
                }
            }
            ?>