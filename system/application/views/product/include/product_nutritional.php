<div class="title">
    <h4>
        <span>Product Nutritional Facts Section</span>
    </h4>
</div>
<div class="form-row row-fluid">
    <div class="span12">
        <div class="row-fluid">
            <?php
            if (!empty($item_result)) {
            foreach ($item_result as $item_row) {
                $content_title=json_decode($item_row->content_title,true);
            ?>
            <div class="row-fluid gl_container_combo" style="margin-bottom: 10px">
                <input type="hidden" name="cat_ids[]" class="gl_cat_id" value="<?php echo $item_row->prod_cat; ?>">
                <input type="hidden" name="item_ids[]" class="gl_item_id" value="<?php echo $item_row->id; ?>">
                <input class="span6 gl_item_value" type="text" name="item_values[]" value="<?php echo $content_title[0]['right_val'] ; ?>"
                       style="margin-left: 30px;"/>
                <textarea class="span6" style="margin-left: 30px;margin-top: 10px" name="item_detail[]"><?php echo $item_row->brief_details?></textarea>
                <a href="javascript:void(0)" 
                   data-content_id="<?php echo $item_row->id; ?>"
                   class="gl_pro_combo_item_remove btn btn-mini btn-danger">Remove</a>
            </div>
            <?php
            }
            } else {
            ?>
            <div class="row-fluid gl_container_combo" style="margin-bottom: 10px">
                <input type="hidden" name="cat_ids[]" class="gl_cat_id" value="<?php echo $product_parent_category_combo_row->id; ?>"> 
                <input type="hidden" name="item_ids[]" class="gl_item_id">
                <input class="span6 gl_item_value" type="text" name="item_values[]"
                       style="margin-left: 30px;"/>
                 <textarea class="span6" style="margin-left: 30px;margin-top: 10px" name="item_detail[]"></textarea>
                <a href="javascript:void(0)" 
                   data-content_id=""
                   class="gl_pro_combo_item_remove btn btn-mini btn-danger hide">Remove</a>
            </div>
            <?php }
            ?>  <a href="javascript:void(0)" 
               
               class="btn btn-primary btn-mini
               gl_pro_combo_item_add_more right">Add More</a>

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
        cloned.find('textarea').val('');
        cloned.find('.gl_pro_combo_item_remove').show();
        cloned.insertAfter(current);
    });




</script>