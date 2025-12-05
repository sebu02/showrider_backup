<option value="">Category...</option>
<?php
if($cat_list != NULL){
    foreach($cat_list as $cat_val){
?> 
    <option value="<?php echo $cat_val['id']; ?>"><?php echo ucfirst($cat_val['name']); ?></option>
<?php
    }
}
?>