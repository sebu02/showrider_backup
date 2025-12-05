<div class="title">
    <h4>
        <span>Product Combo Section</span>
    </h4>
</div>
<div class="form-row row-fluid">
    <div class="span12">
        <div class="row-fluid">
            <?php
            if (!empty($product_category_combo_result)) {
                foreach ($product_category_combo_result as $product_category_combo_row) {
                    ?>


                    <label class="form-label span12" style="text-align: left;font-weight: bold;margin-left: 10px;">
                        <?php echo ucwords($product_category_combo_row->category); ?>
                    </label>
                    <?php
                    $conditional_array = array("prod_cat" => $product_category_combo_row->id,
                        "trash_status" => "no",
                        "active_status" => "a",
                        "type" => "content_management",
                        "type2" => "content",
                        "connection_data" => '+' . $product->id . '+');
                    $order_column = 'id';
                    $order_type = 'ASC';
                    $table2 = 'cms_media';
                    $item_result = $this->common_model->GetByResult_Where($table2, $order_column, $order_type, $conditional_array);
                    if (!empty($item_result)) {
                        foreach ($item_result as $item_row) {
                            ?>
                            <div class="row-fluid gl_container_combo" style="margin-bottom: 10px">
                                <input type="hidden" name="cat_ids[]" class="gl_cat_id" value="<?php echo $item_row->prod_cat; ?>">
                                <input type="hidden" name="item_ids[]" class="gl_item_id" value="<?php echo $item_row->id; ?>">
                                <input class="span6 gl_item_value" type="text" name="item_values[]" value="<?php echo $item_row->title; ?>"
                                       style="margin-left: 30px;"/>
                                <a href="javascript:void(0)"
                                   data-content_id="<?php echo $item_row->id; ?>"
                                   class="gl_pro_combo_item_remove btn btn-mini btn-danger">Remove</a>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <div class="row-fluid gl_container_combo" style="margin-bottom: 10px">
                            <input type="hidden" name="cat_ids[]" class="gl_cat_id" value="<?php echo $product_category_combo_row->id; ?>"> 
                            <input type="hidden" name="item_ids[]" class="gl_item_id">
                            <input class="span6 gl_item_value" type="text" name="item_values[]"
                                   style="margin-left: 30px;"/>
                            <a href="javascript:void(0)" 
                               data-content_id=""
                               class="gl_pro_combo_item_remove btn btn-mini btn-danger hide">Remove</a>
                        </div>
                    <?php }
                    ?>  <a href="javascript:void(0)" 
                       class="btn btn-primary btn-mini
                       gl_pro_combo_item_add_more right">Add More</a>
                    <?php
                }
            }
            ?>

        </div>
    </div>
</div>
<script>
    $("body").on("click", ".gl_pro_combo_item_remove", function () {
        if (confirm("Are you sure remove this item")) {

            $(this).parent().remove();
            $(this).remove();
            var content_id = $(this).attr('data-content_id');
            if (content_id != '') {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() . 'ecproductadmin/remove_product_related_item'; ?>",
                    data: {content_id: content_id},
                    cache: false,
                    success: function ()
                    {}
                });
            }

        }
    });


    $(".gl_pro_combo_item_add_more").click(function (e)
    {
        e.preventDefault();
        var current = $(this).prev();
        var cloned = current.clone();
        cloned.show();
        cloned.find('.gl_item_id').val('');
        cloned.find('.gl_item_value').val('');
        cloned.find('.gl_pro_combo_item_remove').show();
        cloned.insertAfter(current);
    });




</script>