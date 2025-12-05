

<div class="title">
    <h4> 
        <span>Product Category Relation</span>
    </h4>
</div>
    <div class="span12">

        <div class="row-fluid">
            <label class="form-label span4">Choose Category</label>
            <div class="span8">
                <?php
                if (!empty($all_category)) {
                    foreach ($all_category as $category) {
                        $cid=$category["id"];
                        $check = $this->product_model->check_subcategories($cid);
                        ?>
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="span10">
                                    <?php  if ($check == 0) { ?>
                                    <input type="checkbox" name="product_cat[]"
                                           <?php
                                           if(in_array($category["id"], $exist_data)){
                                               echo " checked ";
                                           }
                                           ?>
                                           data-parentid="<?php echo $category["parent_id"];?>"
                                           class="gl_category gl_category_rel<?php echo $category["parent_id"];?>"
                                           value="<?php echo $category["id"];?>" >
                                    <?php }?>
                                    <strong><?php echo $category["name"];?></strong>
                                </div>
                            </div>
                        </div>
                    <?php }
                }
                ?>
            </div>
        </div>
    </div>

<script>
    $(document).on("click",".gl_category",function(){
        var current_cat=$(this).val();
        if($(this).prop("checked") == true){
           $(".gl_category_rel"+current_cat).prop("checked",true);
           $(".gl_category_rel"+current_cat).parent().addClass("checked");
        }else{
           $(".gl_category_rel"+current_cat).prop("checked",false);  
           $(".gl_category_rel"+current_cat).parent().removeClass("checked");
        }
    });
</script>