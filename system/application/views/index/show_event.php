<!DOCTYPE html>
<html lang="en">

<head>

    <?php $this->load->view('index/include/header_meta'); ?>

</head>

<body class="">

    <!--START theme1-Inner-Header-BLOCK-wrapper1 (wrappercode_120) OPEN SECTION-->

    <?php $this->load->view('index/include/header'); ?>

    <div class="afterload-featurebox gd_hide afterload-featurebox24" data-featurebox_id="24" data-boxtype="2"
        data-relation_with_id="382"></div>
    <!--START BlockBox-44 -->

    <?php $this->load->view('index/include/show_event_banner'); ?>

    <!--START theme1-theme1_content_image_box18-wrapper1 (wrappercode_215) OPEN SECTION-->

    <?php
    if($event_row != NULL){

        $event_date = $event_row->date;
        $event_from_time = $event_row->from_time;
        $event_to_time = $event_row->to_time;

        $event_day = "--";
        $event_month = "--";
        $event_year = "--";

        $from_time = "--";
        $to_time = "--";

        if($event_date != "0000-00-00" && $event_date != NULL){
            $event_day = date("d" , strtotime($event_date));
            $event_month = date("F" , strtotime($event_date));
            $event_year = date("Y" , strtotime($event_date));
        }

        if($event_from_time != "00:00:00" && $event_from_time != NULL){
            $from_time = date('h:ia', strtotime($event_from_time));
        }

        if($event_to_time != "00:00:00" && $event_to_time != NULL){
            $to_time = date('h:ia', strtotime($event_to_time));
        }              
    
    ?>

    <section class="full_wrapper relative_wrpr book_a_show_wrpr_details ">
        <div class="common_inner_wrpr padding_lr_primary padding_tb_primary wrpr_flex ">
            <!--START theme1-theme1_content_image_box18-wrapper1 (wrappercode_215) CLOSE SECTION-->
            <!--START theme1-  customstructurebox_243-BLOCK-wrapper1 (wrappercode_216) OPEN SECTION-->
            <div class="spcial_headig_style01">
                <!--START theme1-  customstructurebox_243-BLOCK-wrapper1 (wrappercode_216) CLOSE SECTION-->
                <!--START theme1_content_image_box18-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_218) OPEN SECTION-->
                <div class="common_heading03">
                    <!--START theme1_content_image_box18-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_218) CLOSE SECTION-->

                    <?php echo $event_row->name; ?>

                    <!--EOF theme1_content_image_box18-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_218) OPEN SECTION-->
                </div>
                <!--EOF theme1_content_image_box18-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_218) CLOSE SECTION-->
                <!--START theme1-customstructurebox_243-BLOCK-wrapper2 (wrappercode_217) OPEN SECTION-->
                <div class="date_block">
                    <!--START theme1-customstructurebox_243-BLOCK-wrapper2 (wrappercode_217) CLOSE SECTION-->
                    <!--START theme1_content_image_box18-CONTENT_TITLE_2_BOX1-wrapper1 (wrappercode_219) OPEN SECTION-->
                    <div class="day_block">
                        <!--START theme1_content_image_box18-CONTENT_TITLE_2_BOX1-wrapper1 (wrappercode_219) CLOSE SECTION-->

                        <?php echo $event_day; ?>

                        <!--EOF theme1_content_image_box18-CONTENT_TITLE_2_BOX1-wrapper1 (wrappercode_219) OPEN SECTION-->
                    </div>
                    <!--EOF theme1_content_image_box18-CONTENT_TITLE_2_BOX1-wrapper1 (wrappercode_219) CLOSE SECTION-->

                    <!--START theme1_content_image_box18-CONTENT_TITLE_3_BOX1-wrapper1 (wrappercode_220) OPEN SECTION-->
                    <div class="full_date_block">
                        <!--START theme1_content_image_box18-CONTENT_TITLE_3_BOX1-wrapper1 (wrappercode_220) CLOSE SECTION-->

                        <?php echo strtoupper($event_month) . ' ' . $event_year; ?>

                        <!--EOF theme1_content_image_box18-CONTENT_TITLE_3_BOX1-wrapper1 (wrappercode_220) OPEN SECTION-->
                    </div>
                    <!--EOF theme1_content_image_box18-CONTENT_TITLE_3_BOX1-wrapper1 (wrappercode_220) CLOSE SECTION-->

                    <!--START theme1_content_image_box18-CONTENT_TITLE_4_BOX1-wrapper1 (wrappercode_221) OPEN SECTION-->
                    <div class="time_block">
                        <!--START theme1_content_image_box18-CONTENT_TITLE_4_BOX1-wrapper1 (wrappercode_221) CLOSE SECTION-->

                        <?php echo $from_time . ' to ' . $to_time; ?>

                        <!--EOF theme1_content_image_box18-CONTENT_TITLE_4_BOX1-wrapper1 (wrappercode_221) OPEN SECTION-->
                    </div>
                    <!--EOF theme1_content_image_box18-CONTENT_TITLE_4_BOX1-wrapper1 (wrappercode_221) CLOSE SECTION-->

                    <!--START theme1_content_image_box18-CONTENT_TITLE_5_BOX1-wrapper1 (wrappercode_222) OPEN SECTION-->
                    <div class="venu_block">
                        <!--START theme1_content_image_box18-CONTENT_TITLE_5_BOX1-wrapper1 (wrappercode_222) CLOSE SECTION-->

                        <?php echo $event_row->title; ?>

                        <!--EOF theme1_content_image_box18-CONTENT_TITLE_5_BOX1-wrapper1 (wrappercode_222) OPEN SECTION-->
                    </div>
                    <!--EOF theme1_content_image_box18-CONTENT_TITLE_5_BOX1-wrapper1 (wrappercode_222) CLOSE SECTION-->
                    <!--EOF theme1-customstructurebox_243-BLOCK-wrapper2 (wrappercode_217) OPEN SECTION-->
                </div>
                <!--EOF theme1-customstructurebox_243-BLOCK-wrapper2 (wrappercode_217) CLOSE SECTION-->
                <!--EOF theme1-  customstructurebox_243-BLOCK-wrapper1 (wrappercode_216) OPEN SECTION-->
            </div>
            <!--EOF theme1-  customstructurebox_243-BLOCK-wrapper1 (wrappercode_216) CLOSE SECTION-->
            <!--START theme1_content_image_box18-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_223) OPEN SECTION-->

            <div class="common_para">

                <!--START theme1_content_image_box18-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_223) CLOSE SECTION-->

                <?php echo $event_row->brief_details; ?>

                <!--EOF theme1_content_image_box18-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_223) OPEN SECTION-->

            </div>

            <!--EOF theme1_content_image_box18-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_223) CLOSE SECTION-->

            <input class="eventid_class" type="hidden" name="eventid" value="<?php echo $event_row->id; ?>">

            <input type="hidden" name="current_eventid" value="<?php echo $event_row->id; ?>">

            <!--START BlockBox-46 -->
            <!--START theme1-theme1_content_description_box8-wrapper1 (wrappercode_225) OPEN SECTION-->

            <div class="table_block book_a_show_table">
                <!--START theme1-theme1_content_description_box8-wrapper1 (wrappercode_225) CLOSE SECTION-->
                <!--START theme1_content_description_box8-FEATURE_BOX_TITLE_BOX1-wrapper1 (wrappercode_226) OPEN SECTION-->
                <div class="tabe_head">
                    <!--START theme1_content_description_box8-FEATURE_BOX_TITLE_BOX1-wrapper1 (wrappercode_226) CLOSE SECTION-->
                    TICKET
                    TYPE
                    <!--EOF theme1_content_description_box8-FEATURE_BOX_TITLE_BOX1-wrapper1 (wrappercode_226) OPEN SECTION-->
                </div>
                <!--EOF theme1_content_description_box8-FEATURE_BOX_TITLE_BOX1-wrapper1 (wrappercode_226) CLOSE SECTION-->

                <!--START theme1_content_description_box8-CONTENT_LOOP_BOX1-wrapper1 (wrappercode_243) OPEN SECTION-->

                <form action="<?php echo base_url() . 'book-a-show-address?id=' . $event_row->id; ?>"
                    class="bookashowform" method="post">
                    <!--START theme1_content_description_box8-CONTENT_LOOP_BOX1-wrapper1 (wrappercode_243) CLOSE SECTION-->
                    <!--START theme1_content_description_box8-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_227) OPEN SECTION-->

                    <?php
                    $ticket_types_list = $this->index_model->getAllTicketTypesByCategory($event_row->id);

                    $i = 1;
                    if($ticket_types_list != NULL){

                        foreach($ticket_types_list as $ticket_types_row){
                                           
                    ?>

                    <div class="tale_row tickets_row">
                        <!--START theme1_content_description_box8-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_227) CLOSE SECTION-->
                        <!--START theme1-customstructurebox_256-BLOCK-wrapper1 (wrappercode_228) OPEN SECTION-->
                        <div class="table_split_01">
                            <!--START theme1-customstructurebox_256-BLOCK-wrapper1 (wrappercode_228) CLOSE SECTION-->
                            <!--START theme1_content_description_box8-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_229) OPEN SECTION-->
                            <div class="common_heading04">
                                <!--START theme1_content_description_box8-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_229) CLOSE SECTION-->

                                <?php echo $i; ?>

                                <!--EOF theme1_content_description_box8-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_229) OPEN SECTION-->
                            </div>
                            <!--EOF theme1_content_description_box8-CONTENT_TITLE_BOX1-wrapper1 (wrappercode_229) CLOSE SECTION-->

                            <!--START theme1_content_description_box8-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_230) OPEN SECTION-->
                            <div class="common_para">
                                <!--START theme1_content_description_box8-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_230) CLOSE SECTION-->

                                <?php echo $ticket_types_row->title; ?>

                                <!--EOF theme1_content_description_box8-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_230) OPEN SECTION-->
                            </div>
                            <!--EOF theme1_content_description_box8-CONTENT_DESCRIPTION_BOX1-wrapper1 (wrappercode_230) CLOSE SECTION-->
                            <!--EOF theme1-customstructurebox_256-BLOCK-wrapper1 (wrappercode_228) OPEN SECTION-->
                        </div>
                        <!--EOF theme1-customstructurebox_256-BLOCK-wrapper1 (wrappercode_228) CLOSE SECTION-->
                        <!--START theme1_content_description_box8-CONTENT_TITLE_2_BOX1-wrapper1 (wrappercode_231) OPEN SECTION-->
                        <div class="table_split_02 price_table_wrpr">
                            <!--START theme1_content_description_box8-CONTENT_TITLE_2_BOX1-wrapper1 (wrappercode_231) CLOSE SECTION-->
                            <!--START Icon Rupee (wrappercode_232) OPEN SECTION-->

                            <span>Rs.</span>

                            <?php echo trim($ticket_types_row->price); ?>

                            <!--EOF theme1_content_description_box8-CONTENT_TITLE_2_BOX1-wrapper1 (wrappercode_231) OPEN SECTION-->
                        </div>
                        <!--EOF theme1_content_description_box8-CONTENT_TITLE_2_BOX1-wrapper1 (wrappercode_231) CLOSE SECTION-->
                        <!--START theme1-customstructurebox_256-BLOCK-wrapper2 (wrappercode_244) OPEN SECTION-->
                        <div class="table_split_03 common_counter_wrpr">
                            <!--START theme1-customstructurebox_256-BLOCK-wrapper2 (wrappercode_244) CLOSE SECTION-->
                            <!--START theme1_content_description_box8-CONTENT_TITLE_3_BOX1-wrapper1 (wrappercode_233) OPEN SECTION-->
                            <div class="common_small_txt">
                                <!--START theme1_content_description_box8-CONTENT_TITLE_3_BOX1-wrapper1 (wrappercode_233) CLOSE SECTION-->No.
                                of Tickets
                                <!--EOF theme1_content_description_box8-CONTENT_TITLE_3_BOX1-wrapper1 (wrappercode_233) OPEN SECTION-->
                            </div>
                            <!--EOF theme1_content_description_box8-CONTENT_TITLE_3_BOX1-wrapper1 (wrappercode_233) CLOSE SECTION-->

                            <input class="common_counter_box ticketnumber_class" type="text" name="ticketnumber[]"
                                value="">

                            <input class="eventticketid_class" type="hidden" name="eventticketid[]"
                                value="<?php echo $ticket_types_row->id; ?>">
                            <input class="ticketprice_class" type="hidden" name="ticketprice[]"
                                value="<?php echo trim($ticket_types_row->price); ?>">
                            <input class="gl_max_ticket_number" type="hidden"
                                value="<?php echo $ticket_types_row->total_number; ?>">
                            <input type="hidden" name="eventticketcode[]"
                                value="<?php echo $ticket_types_row->code; ?>">

                            <!--EOF theme1-customstructurebox_256-BLOCK-wrapper2 (wrappercode_244) OPEN SECTION-->
                        </div>
                        <!--EOF theme1-customstructurebox_256-BLOCK-wrapper2 (wrappercode_244) CLOSE SECTION-->
                        <!--EOF theme1_content_description_box8-CONTENT_LOOP_ELEMENT_BOX_WRAPPER_BOX-wrapper1 (wrappercode_227) OPEN SECTION-->
                    </div>

                    <?php
                            $i++;
                            }
                        
                        ?>

                    <input class="eventshowid_class" type="hidden" name="eventshowid" value="">
                    <input class="gl_final_amount" type="hidden" name="final_amount" value="">

                    <div class="tale_row">
                        <div class="table_split_04">
                            <div class="common_heading04">Total Amount </div>
                        </div>
                        <div class="table_split_05 price_table_wrpr total"> <span>Rs.</span><span
                                class="total_bookshow_amount"></span> </div>
                    </div>

                    <div class="common_btn_3"> <input type="submit" class="btn_gradient" value="Book Now"
                            style="color: #fff; border: none; padding-top: 5px; padding-left: 10px; padding-right: 10px; padding-bottom: 5px;">
                    </div>

                    <?php
                    }
                    ?>

                </form>

                <!--EOF theme1_content_description_box8-CONTENT_LOOP_BOX1-wrapper1 (wrappercode_243) CLOSE SECTION-->
                <!--EOF theme1-theme1_content_description_box8-wrapper1 (wrappercode_225) OPEN SECTION-->
            </div>

            <!--EOF theme1-theme1_content_description_box8-wrapper1 (wrappercode_225) CLOSE SECTION-->
            <!--EOF BlockBox-46 -->
            <!--EOF theme1-theme1_content_image_box18-wrapper1 (wrappercode_215) OPEN SECTION-->
        </div>
    </section>

    <?php
    }
    ?>

    <?php $this->load->view('index/include/footer_turn_your_events'); ?>

    <?php $this->load->view('index/include/footer'); ?>

    <?php $this->load->view('index/include/footer_meta'); ?>

</body>

</html>