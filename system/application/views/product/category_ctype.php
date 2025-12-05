<option value="">--Select--</option>
<option value="0"
<?php
if ($parent_id == 0) {
    echo "selected";
}
?>  data-url="">--Parent--</option>
        <?php
        foreach ($categorylist as $cat) {
            ?>
    <option data-url="<?php echo $this->product_model->arr_reverse($cat['categoryslugtree']); ?>" value="<?php echo $cat['id']; ?>" 
    <?php 
    if ($crid == $cat['id']) { echo "disabled"; } ?>
            data-ctype="<?php echo $cat['ctype']; ?>" 
            <?php echo set_select('cat', $cat['id']); ?>

            <?php
            if ($cat['id'] == $parent_id) {
                echo "selected";
            }
            ?>

            >
        <?php echo $cat['name'];
                
//              $cat_row= $this->product_model->GetByRow("ec_category",$cat['id'],"id");    
//              $cattype_row= $this->product_model->GetByRow("ec_categorytypes",$cat_row->product_type,"id");    
//               if($cat_row->ctype=="1"){
//                  echo "---( ".$cattype_row->name." )"; 
//               } 
                ?></option>
        <?php
}
?>