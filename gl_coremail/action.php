<?php
    //  session_start();
    //  $captcha = ""; 

  if (isset($_POST['frm_email'])) {
    
    $name = "Showrider Entertainment";                    
                       
    $first_name = '';
    if (isset($_POST['frm_first_name'])){
        $first_name = $_POST['frm_first_name'];
    }

    $last_name = '';    
    if (isset($_POST['frm_last_name'])){
        $last_name = $_POST['frm_last_name'];
    }   
    
    $email = '';
    if (isset($_POST['frm_email'])){
        $email = $_POST['frm_email'];
    }

    $phone_no = '';
    if (isset($_POST['frm_phoneno'])){
        $phone_no = $_POST['frm_phoneno'];
    }
    
    $country = '';
    if (isset($_POST['frm_country'])){
        $country = $_POST['frm_country'];
    }

    $state = '';
    if (isset($_POST['frm_state'])){
        $state = $_POST['frm_state'];
    }

    $pincode = '';
    if (isset($_POST['frm_pincode'])){
        $pincode = $_POST['frm_pincode'];
    }

    $locality = '';
    if (isset($_POST['frm_locality'])){
        $locality = $_POST['frm_locality'];
    }

    $address = '';
    if (isset($_POST['frm_address'])){
        $address = $_POST['frm_address'];
    }

    $city = '';
    if (isset($_POST['frm_city'])){
        $city = $_POST['frm_city'];
    }
     
    $landmark = '';
    if (isset($_POST['frm_landmark'])){
        $landmark = $_POST['frm_landmark'];
    }

    $alt_phone = '';
    if (isset($_POST['frm_alt_phone'])){
        $alt_phone = $_POST['frm_alt_phone'];
    }

    $event_name = '';
    if (isset($_POST['event_name'])){
        $event_name = $_POST['event_name'];
    }

    $event_code = '';
    if (isset($_POST['event_code'])){
        $event_code = $_POST['event_code'];
    }

    $total_amount = '';
    if (isset($_POST['total_amount'])){
        $total_amount = $_POST['total_amount'];
    }

    $q_name = '';
    if (isset($_POST['name'])){
        $q_name = $_POST['name'];
    }
    
    $message = '';
    if (isset($_POST['message'])){
        $message = $_POST['message'];
    }

    $comment = '';
    if (isset($_POST['comment'])){
        $comment = $_POST['comment'];
    }

    $category_name = '';
    if (isset($_POST['category_name'])){
        $category_name = $_POST['category_name'];
    }

    $ticketcode_str = '';
    $ticketcode_arr = array();
    if (isset($_POST['eventticketcode_str'])){
        $ticketcode_str = $_POST['eventticketcode_str'];
        $ticketcode_str = trim($ticketcode_str , "+");
        $ticketcode_arr = explode('+' , $ticketcode_str);

    }

    

    $ticketnumber_str = '';
    $ticketnumber_arr = array();
    if (isset($_POST['ticketnumber_str'])){
        $ticketnumber_str = $_POST['ticketnumber_str'];
        $ticketnumber_str = trim($ticketnumber_str , "+");
        $ticketnumber_arr = explode('+' , $ticketnumber_str);
    }

    

    $ticketprice_str = '';
    $ticketprice_arr = array();
    if (isset($_POST['ticketprice_str'])){
        $ticketprice_str = $_POST['ticketprice_str'];
        $ticketprice_str = trim($ticketprice_str , "+");
        $ticketprice_arr = explode('+' , $ticketprice_str);
    }

    

                                               
             $attachment_resume_name = '';

             function get_extension($filename) {

                 return substr(strrchr($filename, "."), 1);

             }

             if (isset($_FILES['resume']['name']) && !empty($_FILES['resume']['name'])) {

                 $attachment_resume = $_FILES['resume']['name'];
                 $attachment_resume_name = $name.'_'.'resume'.'.'.get_extension($_FILES['resume']['name']);

             }

             $current_form_array = array();

             $form_type = $_POST['form_type'];
             $static_subject = '';

             if ($form_type == 'book_a_show_address_form') {

                $static_subject = "Book a Show";
                $static_heading = "B O O K &nbsp; A &nbsp; S H O W &nbsp; F O R M";
              
                $name = $first_name . ' ' . $last_name;

              $current_form_array[]=array(
                "Name" => $name,  
                "Email" => $email,
                "Phone Number" => $phone_no,  
                "Country" => $country,  
                "State" => $state,
                "Pincode" => $pincode,
                "Locality" => $locality,
                "Address" => $address,
                "City" => $city,
                "Landmark" => $landmark,
                "Alternate Phone" => $alt_phone,
                "Event Name" => $event_name,
                "Event Code" => $event_code,
                "Amount" => 'Rs. ' . $total_amount,
              );
              
            }

            if ($form_type == 'quick_contact_form') {

                $static_subject = "Quick Contact";
                $static_heading = "Q U I C K &nbsp; C O N T A C T &nbsp; F O R M";
                
                $name = $q_name;

                $current_form_array[]=array( 
                  "Name" => $q_name,                 
                  "Email" => $email,
                  "Message" => $message,               
                );
                
            }     
            
            if ($form_type == 'main_contact_form'){

                $static_subject = "Contact";
                $static_heading = "C O N T A C T &nbsp; F O R M";

                $name = $first_name . ' ' . $last_name;

                $current_form_array[]=array(
                    "Name" => $name,  
                    "Email" => $email,
                    "Phone Number" => $phone_no,  
                    "Comment" => $comment,                         
                );
                
            }

            if ($form_type == 'get_a_quote_form') {
                $static_subject = "Get a Quote";
                $static_heading = "G E T &nbsp; A &nbsp; Q U O T E &nbsp; F O R M";

                $name = $first_name . ' ' . $last_name;

                $current_form_array[] = array(
                    "Name" => $name,  
                    "Email" => $email,
                    "Phone Number" => $phone_no,
                    "Address" => $address,  
                    "Message" => $message, 
                    "Service" => $category_name,
                    "Total Amount" => 'Rs. ' . $total_amount,
                );
            }
                                                  
          $current_form_json = json_encode($current_form_array);
          
          $servername = 'localhost';
          $username = 'showrider_user427';
          $password = 'p({txU#D!R}}';
          $dbname = 'showrider_admin326';

          $conn = new mysqli($servername, $username, $password, $dbname);

          if (!$conn->connect_error) {                
            $sql = "INSERT INTO cms_form_data(form_name, form_json_data, trash_status, active_status) VALUES ('".$form_type."','".$current_form_json."','no','a')";
            
            if ($conn->query($sql) === TRUE) {                
            }            
            $conn->close();
          }else{
            // die("ERROR: Could not connect. " . $conn->connect_error);
          }
                      
          $mail_subject = $static_subject." form by " . $name;  
         
          $static_logo_image_url = "https://www.godlandinfotech.com/showrider-cms/static/frontend/images/head/logo.png";  

          $static_site_url = "www.godlandinfotech.com/showrider-cms";

          $static_project_name = "S H O W R I D E R &nbsp; E N T E R T A I N M E N T";

          $static_project_address = "Door No: 794/55-50 A 1st cross Road Near, Global Public School, Panampilly Nagar, Kochi, Kerala 682036";

          $table_fields = "";

          $ticket_types_main = "";

          $ticket_types_heading = "";

          $ticket_types_fields = "";

          $ticket_types_end = "";

          foreach($current_form_array[0] as $form_key => $form_row){
           
                $table_fields = $table_fields . '<tr>
                    <th class="column-top" width="30%"
                        bgcolor="#ffffff"
                        style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; vertical-align:top;">
                        <table width="100%" border="0"
                            cellspacing="0" cellpadding="0">
                                                    
                            <tr>
                                <td class="text-title2 pb10 m-center"
                                    style="color:#902b2b; font-family:Poppins, sans-serif; font-size:14px; line-height:24px; text-align:left; padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:10px;">
                                    <multiline>'.$form_key.'</multiline>
                                </td>
                            </tr>

                            <!-- END Button -->

                        </table>
                    </th>

                    <th class="column-top" width=""
                        bgcolor="#ffffff"
                        style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; vertical-align:top;">
                        <table width="100%" border="0"
                            cellspacing="0" cellpadding="0">
                                                    
                            <tr>
                                <td class="text-title2 pb10 m-center"
                                    style="color:#000000; font-family:Poppins, sans-serif; font-size:14px; line-height:24px; text-align:left; padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:10px;">
                                    <multiline>'.$form_row.'</multiline>
                                </td>
                            </tr>

                            <!-- END Button -->

                        </table>
                    </th>
                </tr>';

          } 




          



        if($ticketcode_arr != NULL){

            $ticket_types_heading = '<tr>
                    <th class="column-top" width=""
                        bgcolor="#ffffff"
                        style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; vertical-align:top;">
                        <table width="100%" border="0"
                            cellspacing="0" cellpadding="0">
                                                    
                            <tr>
                                <td class="text-title2 pb10 m-center"
                                    style="color:#902b2b; font-family:Poppins, sans-serif; font-size:14px; line-height:24px; text-align:left; padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:10px;">
                                    <multiline>Ticket Code</multiline>
                                </td>
                            </tr>

                            <!-- END Button -->

                        </table>
                    </th>

                    <th class="column-top" width=""
                        bgcolor="#ffffff"
                        style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; vertical-align:top;">
                        <table width="100%" border="0"
                            cellspacing="0" cellpadding="0">
                                                    
                            <tr>
                                <td class="text-title2 pb10 m-center"
                                    style="color:#902b2b; font-family:Poppins, sans-serif; font-size:14px; line-height:24px; text-align:left; padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:10px;">
                                    <multiline>Price</multiline>
                                </td>
                            </tr>

                            <!-- END Button -->

                        </table>
                    </th>

                    <th class="column-top" width=""
                        bgcolor="#ffffff"
                        style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; vertical-align:top;">
                        <table width="100%" border="0"
                            cellspacing="0" cellpadding="0">
                                                    
                            <tr>
                                <td class="text-title2 pb10 m-center"
                                    style="color:#902b2b; font-family:Poppins, sans-serif; font-size:14px; line-height:24px; text-align:left; padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:10px;">
                                    <multiline>No. of Tickets</multiline>
                                </td>
                            </tr>

                            <!-- END Button -->

                        </table>
                    </th>

                </tr>';

            foreach($ticketcode_arr as $ticketcode_key => $ticketcode_val){

                if($ticketnumber_arr[$ticketcode_key] != "0"){

                
                
                $ticket_types_fields = $ticket_types_fields . '<tr>
                    <th class="column-top" width=""
                        bgcolor="#ffffff"
                        style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; vertical-align:top;">
                        <table width="100%" border="0"
                            cellspacing="0" cellpadding="0">
                                                    
                            <tr>
                                <td class="text-title2 pb10 m-center"
                                    style="color:#000000; font-family:Poppins, sans-serif; font-size:14px; line-height:24px; text-align:left; padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:10px;">
                                    <multiline>'.$ticketcode_val.'</multiline>
                                </td>
                            </tr>

                            <!-- END Button -->

                        </table>
                    </th>

                    <th class="column-top" width=""
                        bgcolor="#ffffff"
                        style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; vertical-align:top;">
                        <table width="100%" border="0"
                            cellspacing="0" cellpadding="0">
                                                    
                            <tr>
                                <td class="text-title2 pb10 m-center"
                                    style="color:#000000; font-family:Poppins, sans-serif; font-size:14px; line-height:24px; text-align:left; padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:10px;">
                                    <multiline>Rs. '.$ticketprice_arr[$ticketcode_key].'</multiline>
                                </td>
                            </tr>

                            <!-- END Button -->

                        </table>
                    </th>

                    <th class="column-top" width=""
                        bgcolor="#ffffff"
                        style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; vertical-align:top;">
                        <table width="100%" border="0"
                            cellspacing="0" cellpadding="0">
                                                    
                            <tr>
                                <td class="text-title2 pb10 m-center"
                                    style="color:#000000; font-family:Poppins, sans-serif; font-size:14px; line-height:24px; text-align:left; padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:10px;">
                                    <multiline>'.$ticketnumber_arr[$ticketcode_key].'</multiline>
                                </td>
                            </tr>

                            <!-- END Button -->

                        </table>
                    </th>

                </tr>';

                }

            } 
            
            
            $ticket_types_end = '<tr>
                    <th class="column-top" width=""
                        bgcolor="#ffffff"
                        style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; vertical-align:top;">
                        <table width="100%" border="0"
                            cellspacing="0" cellpadding="0">
                                                    
                            <tr>
                                <td class="text-title2 pb10 m-center"
                                    style="color:#902b2b; font-family:Poppins, sans-serif; font-size:14px; line-height:24px; text-align:left; padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:10px;">
                                    <multiline>Total Amount</multiline>
                                </td>
                            </tr>

                            <!-- END Button -->

                        </table>
                    </th>
                    
                    <th class="column-top" width=""
                        bgcolor="#ffffff"
                        style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; vertical-align:top;">
                        <table width="100%" border="0"
                            cellspacing="0" cellpadding="0">
                                                    
                            <tr>
                                <td class="text-title2 pb10 m-center"
                                    style="color:#000000; font-family:Poppins, sans-serif; font-size:14px; line-height:24px; text-align:left; padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:10px;">
                                    <multiline>Rs. '.$total_amount.'</multiline>
                                </td>
                            </tr>

                            <!-- END Button -->

                        </table>
                    </th>

                </tr>';




                $ticket_types_main = '<tr><td class="section-title" style="color:#000000; font-family:Noto Serif, Georgia, serif; font-size:14px; line-height:20px; padding-bottom:10px;padding-top:20px; text-transform:uppercase;">
                               </td></tr>
                               <tr><td><table width="100%" border="1" cellspacing="0" cellpadding="0"
                                                                style="border-collapse: collapse;border-color:#A9A9A9;">
                
                                                                                             '. $ticket_types_heading . $ticket_types_fields .'
                                                                                                                    
                                                                                        </table>
                
                                                                                    </td>
                                                                                </tr>
                                                                                
                                                                                <tr><td class="section-title" style="color:#000000; font-family:Noto Serif, Georgia, serif; font-size:14px; line-height:20px; padding-bottom:10px;padding-top:20px; text-transform:uppercase;">
                               </td></tr>
                               <tr><td><table width="100%" border="1" cellspacing="0" cellpadding="0"
                                                                style="border-collapse: collapse;border-color:#A9A9A9;">
                
                                                                                             '. $ticket_types_end .'
                                                                                                                    
                                                                                        </table>
                
                                                                                    </td>
                                                                                </tr>';


                
        }        

         
                

          
                                                        
          $message_template = '<!DOCTYPE html>
                <html lang="en">            
                <head>                
                    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
                    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
                    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                    <meta name="x-apple-disable-message-reformatting" />
                    <!--[if !mso]><!-->
                    <link href="https://fonts.googleapis.com/css?family=Noto+Serif:400,400i,700,700i|Raleway:400,400i,700,700i"
                        rel="stylesheet" />
                    <!--<![endif]-->
                    <title>'.$static_subject.'</title>                
                    <style type="text/css" media="screen">
                        /* Linked Styles */
                        body {
                            padding: 0 !important;
                            margin: 0 !important;
                            display: block !important;
                            min-width: 100% !important;
                            width: 100% !important;
                            background: #e6ffe6;
                            -webkit-text-size-adjust: none
                        }
                
                        a {
                            color: #032e42;
                            text-decoration: none
                        }
                
                        p {
                            padding: 0 !important;
                            margin: 0 !important
                        }
                
                        img {
                            -ms-interpolation-mode: bicubic;
                            /* Allow smoother rendering of resized image in Internet Explorer */
                        }
                
                        .mcnPreviewText {
                            display: none !important;
                        }
                
                        .text-footer a {
                            color: #7e7e7e !important;
                        }
                
                        .text-footer2 a {
                            color: #2092c7 !important;
                        }
                    </style>
                </head>                
                <body class="body"
                    style="padding:0 !important; margin:0 !important; display:block !important; min-width:100% !important; width:100% !important; background:#e6ffe6; -webkit-text-size-adjust:none;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#e6ffe6">
                        <tr>
                            <td align="center" valign="top">
                                <!-- Main -->
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td align="center">
                                            <table width="650" border="0" cellspacing="0" cellpadding="0" class="mobile-shell">
                                                <tr>
                                                    <td class="td"
                                                        style="width:650px; min-width:650px; font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal;">
                                                        <!-- Pre Header -->
                
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td class="preheader" style="padding:30px 0px 20px 0px;">
                
                                                                </td>
                                                            </tr>
                                                        </table>
                
                                                        <!-- END Pre Header -->
                
                                                        <!-- Header -->
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                                            bgcolor="#ffffff">
                                                            <tr>
                                                                <td style="padding: 30px 0px 30px 30px;">
                                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                                                        dir="rtl" style="direction: rtl;">
                                                                        <tr>
                                                                            <th class="column-dir" dir="ltr"
                                                                                style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; direction:ltr;">
                                                                                <table width="100%" border="0" cellspacing="0"
                                                                                    cellpadding="0">
                                                                                    <tr>
                
                                                                                        <td class="text-header"
                                                                                            style="color:#85868d; font-family:Poppins, sans-serif; font-size:13px; line-height:18px; text-align:right;padding-right:30px;">
                                                                                            <multiline><a
                                                                                                    href="https://'.$static_site_url.'"
                                                                                                    target="_blank" class="link2"
                                                                                                    style="color:#85868d; text-decoration:none;"><span
                                                                                                        class="link2"
                                                                                                        style="color:#85868d; text-decoration:none;">'.$static_site_url.'</span></a>
                                                                                            </multiline>
                                                                                        </td>
                
                                                                                    </tr>
                                                                                </table>
                                                                            </th>
                                                                            <th class="column-empty" width="1"
                                                                                style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal;">
                                                                            </th>
                                                                            <th class="column-dir" dir="ltr" width="200"
                                                                                style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; direction:ltr;">
                                                                                <table width="100%" border="0" cellspacing="0"
                                                                                    cellpadding="0">
                                                                                    <tr>
                                                                                        <td class="img m-center mpb10"
                                                                                            style="font-size:0pt; line-height:0pt; text-align:left;">
                                                                                            <img src="'.$static_logo_image_url.'"
                                                                                                width="75" height="" editable="true"
                                                                                                border="0" alt="logo" />
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </th>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td class="separator"
                                                                    style="border-bottom:1px solid #D3D3D3;"></td>
                                                            </tr>

                                                        </table>
                                                        <!-- END Header -->
                
                                                        <repeater>                                                                                          
                                                                          
                                                            <!-- Three Products -->

                                                            <layout label="Three Products">
                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                                                    bgcolor="#ffffff">
                                                                    <tr>
                                                                        <td class="p30-15" style="padding: 30px 30px;">
                                                                            <table width="100%" border="0" cellspacing="0"
                                                                                cellpadding="0">
                                                                                <tr>
                                                                                    <td class="section-title"
                                                                                        style="color:#000000; font-family:Noto Serif, Georgia, serif; font-size:14px; line-height:20px; text-align:center; padding-bottom:30px; text-transform:uppercase;">
                                                                                        <multiline>'.$static_heading.'</multiline>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                
                                                                                        <table width="100%" border="1" cellspacing="0"
                                                                                            cellpadding="0"
                                                                                            style="border-collapse: collapse;border-color:#A9A9A9;">
                
                                                                                             '.$table_fields.'
                                                                                                                    
                                                                                        </table>
                
                                                                                    </td>
                                                                                </tr>
                                                                              
                                                                                '.$ticket_types_main.'                                                                               

                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </layout>
                                                            <!-- END Three Products -->               
                                                                                                                                                                                                                              
                                                            <layout label="Two Columns">
                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                                                    bgcolor="#ffffff">
                                                                    <tr>
                                                                        <td class="p30-15" style="padding: 20px 30px;">                
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </layout>
                
                                                            <!-- END Two Columns -->
                                                        </repeater>
                
                                                        <!-- Footer -->
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                                            bgcolor="#4e54cb">
                                                            <tr>
                                                                <td class="footer" style="padding:50px 30px;">
                                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                        <tr>
                                                                            <td class="social-title pb30"
                                                                                style="color:#ffffff; font-family:Raleway, Arial, sans-serif; font-size:14px; line-height:22px; text-align:center; text-transform:uppercase; padding-bottom:20px;">
                                                                                <multiline>'.$static_project_name.'</multiline>
                                                                            </td>
                                                                        </tr>
                
                                                                        <tr>
                                                                            <td class="separator"
                                                                                style="border-bottom:1px solid #5e63d3;"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="text-footer pt30"
                                                                                style="color:#a9ace3; font-family:Poppins, sans-serif; font-size:12px; line-height:20px; text-align:center; padding-top:20px;">
                                                                                <multiline>'.$static_project_address.'</multiline>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <!-- END Footer -->
                
                                                        <!-- Footer Bar -->
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td class="footer-bar" style="padding:35px 15px;">
                
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <!-- END Footer Bar -->
                
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <!-- END Main -->
                            </td>
                        </tr>
                    </table>
                </body>                
              </html>';
                             
             include("class.phpmailer.php"); //you have to upload class files "class.phpmailer.php" and "class.smtp.php"

             $mail = new PHPMailer();

             $mail->IsSMTP();
             $mail->SMTPAuth = true;

             $mail->Host = "smtp.gmail.com";

             $mail->Username = "glbusiness429@gmail.com";
             $mail->Password = "vtct sjme qpbf sudx";

             $mail->From = "glbusiness429@gmail.com";
             $mail->FromName = $name;

             $mail->AddAddress("info@showrider.in","Showrider Entertainment");             

             $mail->AddCC('sherongodlandit@gmail.com', 'Showrider Entertainment');

             $mail->AddReplyTo($email, $name);
             $mail->Subject = $mail_subject;
             $mail->Body = $message_template;

             if (is_array($_FILES)) {
                  if (isset($_FILES['resume']['name']) && !empty($_FILES['resume']['name'])) {
                      $mail->AddAttachment($_FILES['resume']['tmp_name'], $attachment_resume_name);
                  }
             }

             $mail->WordWrap = 50;
             $mail->IsHTML(true);
             $mail->SMTPSecure = 'ssl'; // ssl
             $mail->Port = 465; // 465

            //  echo $message_template;            
            
             if(!$mail->Send()) {
                echo "Your Mail Not Sent, Please try after sometime.";              
             }else{
                echo "Your Mail Sent Successfully. Thank you";
             }


    }
    
?>