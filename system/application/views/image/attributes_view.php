<?php
if ($cat_id > 0) {
    $cat_details = $this->image_model->GetByRow_notrash('cms_dynamic_category', $cat_id, 'id');
    $cat_combo_id = $cat_details->category_default_combo_id;
} else {
    $cat_details = array();
    $cat_combo_id = 1;
}

$combo_details = $this->image_model->GetByRow_notrash('cms_image_combo', $cat_combo_id, 'id');
$upload_type = $combo_details->upload_type;

$upload_type_details = $this->image_model->GetByRow_notrash('cms_upload_types', $upload_type, 'id');
$upload_preferences = $upload_type_details->preferences;

$upload_preferences_arr = json_decode($upload_preferences, TRUE);
$max_width = $upload_preferences_arr['max_width'];
$max_height = $upload_preferences_arr['max_height'];

$file_type = $upload_type_details->file_type;

if ($file_type == "image") {
    $allowed_types = "gif , jpg , png";
} else {
    $allowed_types = "jpg , png , pdf , doc , docx , ppt , pptx , txt";
}
?>

(Allowed Types : <?php echo $allowed_types; ?>) (File size must less than 2MB) 

<?php
if ($upload_type_details->manipulation_status == "Yes") {
    ?>
    (Width : <a class="gl_current_img_width"><?php echo $max_width; ?></a>px , Height : <a class="gl_current_img_height"><?php echo $max_height; ?></a>px)
    <?php
}
?>

<input type="hidden" name="combo" id="combo" data-imageid="gl_image_upload1" value="<?php echo $cat_combo_id; ?>" />                 