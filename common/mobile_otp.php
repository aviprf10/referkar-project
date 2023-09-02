<?php
function send_sms($otp_array)
{
    if (count($otp_array) > 0)
    {
        $your_api_key = 'd91322c8-dc3a-11e8-a895-0200cd936042';
        $from = "arythe";
        if (strlen($otp_array['mobile_no']) >= 10)
        {
            $sms_type = $otp_array['sms_type'];
           if ($sms_type == 0)         // Registration 
           {
               $to = $otp_array['mobile_no'];
               $template_name = "Login OTP";
               $VAR1 = $otp_array['mobile_otp'];
               $VAR2 = ' '.$otp_array['mobile_no'].'.';
               $post_fields = http_build_query(
                       array(
                           "TemplateName" => $template_name,
                           "From"         => $from,
                           "To"           => $to,
                           "VAR1"         => $VAR1,
                           "VAR2"         => $VAR2,
                       )
                   );
           }
           if ($sms_type == 1)         // Registration 
           {
               $to = $otp_array['mobile_no'];
               $template_name = "Registration";
               $first_name = $otp_array['first_name'];
               $last_name = $otp_array['last_name'];
               $VAR1 = $first_name.' '.$last_name.',';
               $VAR2 = $otp_array['email'];
               $VAR3 = $otp_array['password'];
               $VAR4 = $otp_array['login_link'];
               $post_fields = http_build_query(
                       array(
                           "TemplateName" => $template_name,
                           "From"         => $from,
                           "To"           => $to,
                           "VAR1"         => $VAR1,
                           "VAR2"         => $VAR2,
                           "VAR3"         => $VAR3,
                           "VAR4"         => $VAR4, 
                       )
                   );
           }
            if ($sms_type == 2)     // Order Placed Successfully
            {
                $to = $otp_array['mobile_no'];
                $template_name = "Order Placed Successfully";
                $VAR1 = $otp_array['order_id'];
                $all_product_title = $otp_array['all_product_title'];
                $all_product_title = 'products';
                $VAR3 = '';
                $post_fields = http_build_query(
                        array(
                            "TemplateName" => $template_name,
                            "From"         => $from,
                            "To"           => $to,
                            "VAR1"         => $VAR1,
                            "VAR2"         => $all_product_title,
                            "VAR3"         => $VAR3,
                             
                        )
                    );
            }
            if ($sms_type == 3)     // Dispatched
            {
                $to = $otp_array['mobile_no'];
                $template_name = "For Dispatched";
                $VAR1 = $otp_array['order_id'];
                $tracking_number = $otp_array['tracking_number'];
                $tracking_link = $otp_array['tracking_link'];
                $post_fields = http_build_query(
                        array(
                            "TemplateName" => $template_name,
                            "From"         => $from,
                            "To"           => $to,
                            "VAR1"         => $VAR1,
                            "VAR2"         => $tracking_number,
                            "VAR3"         => $tracking_link,
                             
                        )
                    );
            }     
            if ($sms_type == 5)     // Buyer Cancellation
            {
                $to = $otp_array['mobile_no'];
                $template_name = "Buyer Cancellation";
                $VAR1 = $otp_array['order_id'];
                $VAR2 = $otp_array['all_product_name'];
                $VAR2 = 'products';
                $VAR3 = 'https:'.$otp_array['order_cancel_link'];
                //print_r($otp_array);
                $post_fields = http_build_query(
                        array(
                            "TemplateName" => $template_name,
                            "From"         => $from,
                            "To"           => $to,
                            "VAR1"         => $VAR1,
                            "VAR2"         => $VAR2,
                            "VAR3"         => $VAR3,                             
                        )
                    );
            }
            
//             if ($sms_type == 3)     // Shipped
//             {
//                 $to = $otp_array['mobile_no'];
//                 $selected_currency_text = $otp_array['selected_currency_text'];
//                 $template_name = "Shipped";
//                 $order_details_array = $otp_array['order_details'];
//                 $order_id = $otp_array['order_id'];
//                 foreach ($order_details_array as $order_details_data)
//                 {
//                     $product_full_title = $order_details_data['product_name'];
//                     break;
//                 }

//                 $order_total_amount = 0;
//                 foreach ($order_details_array as $order_details_data)
//                 {
//                     $single_product_total_quantity = $order_details_data['single_product_total_quantity'];
//                     $single_product_total_price = $single_product_total_quantity * $order_details_data['price'];
//                     $order_total_amount += $single_product_total_price;
//                 }

//                 $order_id = $otp_array['order_id'];

//                 $post_fields = http_build_query(
//                     array(
//                         "TemplateName" => $template_name,
//                         "From"         => $from,
//                         "To"           => $to,
//                         "VAR1"         => $order_id,
//                         "VAR2"         => $product_full_title,
//                         "VAR3"         => '',
//                         "VAR4"         => '',
//                     )
//                 );
//             }

            ### DO NOT Change anything below this line
            $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
            $url = "https://2factor.in/API/V1/$your_api_key/ADDON_SERVICES/SEND/TSMS";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
            curl_setopt($ch, CURLOPT_USERAGENT, $agent);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $otp_response = curl_exec($ch);
            $otp_response_array = json_decode($otp_response, true);
            //print_r($otp_response_array);
            $otp_err = curl_error($ch);
            curl_close($ch);

            if ($otp_response_array['Status'] == 'Success')
            {
                return 1;
                exit();
            }
            else
            {
                return 0;
                exit();
            }
        }
        else
        {
            return 0;
            exit();
        }
    }
    else
    {
        return 0;
        exit();
    }
}

?>