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
            if ($sms_type == 1)         // Registration 
            {
                $to = $otp_array['mobile_no'];
                $template_name = "Registration";
                $VAR1 = $otp_array['mobile_otp'];
                $VAR2 = $otp_array['email'];
                $VAR3 = $otp_array['password'];
                $VAR4 = '';
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
                $all_product_title = rtrim($all_product_title,", ");
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
                $VAR2 = $otp_array['tracking_number'];
                $VAR3 = $otp_array['tracking_link'];
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
            if ($sms_type == 4)     // Delivered
            {
                $to = $otp_array['mobile_no'];
                $template_name = "For Delivered";
                $VAR1 = $otp_array['order_id'];
                $VAR2 = $otp_array['all_product_name'];
                $VAR2 = 'products';
                $VAR3 = $otp_array['order_link'];
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
            if ($sms_type == 6)     // Seller Cancellation
            {
                $to = $otp_array['mobile_no'];
                $template_name = "Seller Cancellation";
                $shipping_charges = $otp_array['shipping_charges'];
                $VAR1 = $otp_array['all_product_name'];
                $VAR1 = 'products';
                $order_details_array = $otp_array['order_details'];


                $order_total_amount = 0;
                $total_coupon_discount = 0;
                if ($shipping_charges > 0 && $shipping_charges != '')
                {
                    $order_total_amount += $shipping_charges;
                }
                foreach ($order_details_array as $order_details_data)
                {
                    $is_coupon_apply = $order_details_data['is_coupon_apply'];

                    $single_product_total_quantity = $order_details_data['single_product_total_quantity'];
                    $single_product_total_price = $single_product_total_quantity * $order_details_data['price'];
                    $order_total_amount += $single_product_total_price;
                    if($is_coupon_apply)
                    {
                        $total_coupon_discount += $order_details_data['coupon_discount'];
                       
                    }
                }
                $order_total_amount = $order_total_amount - $total_coupon_discount;
                $order_total_amount = number_format((float)$order_total_amount, 2, '.', '');
                
                $post_fields = http_build_query(
                        array(
                            "TemplateName" => $template_name,
                            "From"         => $from,
                            "To"           => $to,
                            "VAR1"         => $VAR1,
                            "VAR2"         => 'Rs. '.$order_total_amount,                            
                        )
                    );
            }

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