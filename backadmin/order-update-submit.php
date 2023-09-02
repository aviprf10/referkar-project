<?php
include "common/config.php";
include "common/check_login.php";
//include "email.php";

header('Content-type: application/json');
if ($admin == 1)
{
    if (isset($_POST))
    {
        //error_reporting(-1);
        $shipping_charges = 0;
        $order_update_action_done = 0;
        $error_array = array();
        $is_returnable = 0;
        $return_period_days = 0;
        $return_till_date = '0000-00-00';
        $current_timestamp = get_current_date_time();
        $current_date = _get_current_date();

        $selected_id = Secure1($db_mysqli, $_POST['order_id']);
        $order_id = Secure1($db_mysqli, $_POST['order_id']);
        $update_order_status = Secure1($db_mysqli, $_POST['update_order_status']);

        // get submitted values from return modal
        $order_total_product = Secure1($db_mysqli, $_POST['order_total_product']);
        $update_return_order_status = array();
        $order_row_id = array();
        for ($i = 0; $i < $order_total_product; $i++)
        {
            if (isset($_POST['pending_return_' . $i]) && isset($_POST['pending_row_id_' . $i]))
            {
                $update_return_order_status[] = $_POST['pending_return_' . $i];
                $order_row_id[] = $_POST['pending_row_id_' . $i];
            }
            if (isset($_POST['accept_return_' . $i]) && isset($_POST['accept_row_id_' . $i]))
            {
                $update_return_order_status[] = $_POST['accept_return_' . $i];
                $order_row_id[] = $_POST['accept_row_id_' . $i];
            }
            if (isset($_POST['in_transit_return_' . $i]) && isset($_POST['in_transit_row_id_' . $i]))
            {
                $update_return_order_status[] = $_POST['in_transit_return_' . $i];
                $order_row_id[] = $_POST['in_transit_row_id_' . $i];
            }
        }

        $financial_year = (date('m') < '04') ? date('Y', strtotime('-1 year')) : date('Y');
        $financial_year1 = substr($financial_year + 1, 2, 3);
        $current_financial_year = $financial_year . "-" . $financial_year1;

        $all_master_settings_data_array = array();
        $get_master_settings_query = "SELECT * FROM master_settings WHERE id='1'";
        $result_get_master_settings_query = mysqli_query($db_mysqli, $get_master_settings_query);
        while ($row_get_master_settings_query = mysqli_fetch_assoc($result_get_master_settings_query))
        {
            $all_master_settings_data_array[] = $row_get_master_settings_query;
        }

        $result_update_user_order_details = '';

        // $master_settings_data_array = $module_user_order->Get_User_Order_Custom($master_settings_query);
        if (count($all_master_settings_data_array) > 0)
        {
            //            $shipping_charges = $all_master_settings_data_array[0]['national_shipping'];
            $is_returnable = $all_master_settings_data_array[0]['is_returnable'];
            $return_period_days = $all_master_settings_data_array[0]['return_period'];
        }


        if ($order_total_product > 0 && $order_id != '')
        {
            //            include "pincode-validation.php";

            if (strlen($selected_id) != 0)
            {
                $all_order_id = explode(",", $selected_id);
                $order_status_html = '';
                if ($update_order_status == OrderStatus::TO_BE_PICKED)
                {
                    $order_status_html = 'has been Packed';
                }
                if ($update_order_status == OrderStatus::DISPATCH)
                {
                    $order_status_html = 'has been moved to Dispatch';
                }
                else if ($update_order_status == OrderStatus::TO_HANDOVER)
                {
                    $order_status_html = 'has been Handed Over';
                }
                else if ($update_order_status == OrderStatus::IN_TRANSIT)
                {
                    $order_status_html = ' has been Intransit';
                }
                else if ($update_order_status == OrderStatus::MANUAL)
                {
                    $order_status_html = 'has been moved in Manual status';
                }
                else if ($update_order_status == OrderStatus::DELIVERED)
                {
                    $order_status_html = 'has been Delivered';
                }
                else if ($update_order_status == OrderStatus::RETURN_ORDER)
                {
                    $order_status_html = 'has been moved';
                    //                    if ($update_return_order_status == 2)
                    //                    {
                    //                        $order_status_html = 'return has been Accepted';
                    //                    }
                    //                    else if ($update_return_order_status == 3)
                    //                    {
                    //                        $order_status_html = 'return has been In-Transit';
                    //                    }
                    //                    else if ($update_return_order_status == 4)
                    //                    {
                    //                        $order_status_html = 'return has been Delivered';
                    //                    }
                    //                    else if ($update_return_order_status == 5)
                    //                    {
                    //                        $order_status_html = 'return has been Rejected';
                    //                    }
                }
                else if ($update_order_status == OrderStatus::REJECTED)
                {
                    $order_status_html = 'has been Rejected';
                }
                else if ($update_order_status == OrderStatus::CANCEL_BY_BUYER)
                {
                    $order_status_html = 'has been Cancelled by buyer';
                }
                else if ($update_order_status == OrderStatus::UNDELIVERED)
                {
                    $order_status_html = 'has been Undelivered';
                }


                $filter_condition = '';
                $filter_condition = "where u_o.order_id IN ('$selected_id') and u_o.is_deleted=0";
                //$group_condition = "group by product_variant_id";
                $group_condition = "";
                $order_condition = "";
                $all_order_data_array = array();
                $get_order_query = "SELECT
                                  u_o.*,
                                  u_o.id                                                   AS user_order_table_id,
                                  (SELECT SUM(price)
                                   FROM user_order u_o1
                                   WHERE u_o1.order_id = u_o.order_id AND u_o1.product_id = u_o.product_id AND
                                         u_o1.product_variant_id = u_o.product_variant_id) AS single_product_total_price,
                                  (SELECT SUM(quantity)
                                   FROM user_order u_o1
                                   WHERE u_o1.order_id = u_o.order_id AND u_o1.product_id = u_o.product_id AND
                                         u_o1.product_variant_id = u_o.product_variant_id) AS single_product_total_quantity,
                                  p.id                                                     AS p_id,
                                  p.product_name,
                                  p.product_seo_url,
                                  b.brand_title,
                                  p.photo1,
                                  pv.id                                                    AS pv_id,
                                  pv.product_variant_seo_url,
                                  pv.variant_one,
                                  pv.variant_two,
                                  uoa.first_name as uoa_first_name,
                                  uoa.last_name as uoa_last_name,
                                  uoa.address1,
                                  uoa.address2,
                                  uoa.pincode,
                                  uoa.city,
                                  uoa.state,
                                  uoa.country
                                FROM user_order u_o LEFT JOIN product p ON u_o.product_id = p.id
                                  LEFT JOIN product_variant pv ON u_o.product_variant_id = pv.id
                                  LEFT JOIN brand_master b ON b.id = p.brand_id
                                  LEFT JOIN user_order_address uoa ON u_o.order_address_id = uoa.id $filter_condition $group_condition $order_condition";

                $result_get_order_query = mysqli_query($db_mysqli, $get_order_query);

                $all_order_data_array = array();
                $product_id_array = array();
                $product_variant_id_array = array();
                while ($row_get_order_query = mysqli_fetch_assoc($result_get_order_query))
                {
                    $all_order_data_array[] = $row_get_order_query;
                }
                if (count($all_order_data_array) > 0)
                {
                    $shipping_charges = $all_order_data_array[0]['shipping_charges'];
                    $all_buyer_id_array = array();
                    $all_product_id_array = array();
                    $all_product_variant_id_array = array();

                    $new_all_user_order_data_array = array();
                    $all_product_name = '';
                    $all_product_price = 0;

                    foreach ($all_order_data_array as $all_order_data)
                    {
                        if (in_array($all_order_data['user_id'], $all_buyer_id_array) == false)
                        {
                            $all_buyer_id_array[] = $all_order_data['user_id'];
                        }
                        if (in_array($all_order_data['product_id'], $all_product_id_array) == false)
                        {
                            $all_product_id_array[] = $all_order_data['product_id'];
                        }
                        if (in_array($all_order_data['product_variant_id'], $all_product_variant_id_array) == false)
                        {
                            $all_product_variant_id_array[] = $all_order_data['product_variant_id'];
                        }
                        $new_all_user_order_data_array[$all_order_data['order_id']][] = $all_order_data;
                        $all_product_name .= $all_order_data['product_name'].', ';
                        $all_product_price = $all_product_price + $all_order_data['single_product_total_quantity'];
                    }

                    //admin data
                    $admin_id = '1';            //This value comes from database 'user' table
                    $get_admin_query = "SELECT *
                                        FROM user
                                          LEFT JOIN country ON user.country_id = country.id
                                          LEFT JOIN states ON user.state_id = states.id
                                          LEFT JOIN cities ON user.city_id = cities.id
                                        WHERE user.id = '$admin_id'";
                    $result_admin_query = mysqli_query($db_mysqli, $get_admin_query);

                    $all_admin_data_array = array();
                    while ($row_admin_query = mysqli_fetch_assoc($result_admin_query))
                    {
                        $all_admin_data_array[] = $row_admin_query;
                    }
                    //                    $all_admin_data[] = $all_admin_data_array[0];

                    $admin_name = $all_admin_data_array[0]['user_name'];
                    //                    $admin_email = $all_admin_data_array[0]['email'];
                    $admin_email = $admin_email_id;
                    $admin_address_1 = $all_admin_data_array[0]['address1'];
                    $admin_address_2 = $all_admin_data_array[0]['address2'];
                    $admin_country = $all_admin_data_array[0]['country_name'];
                    $admin_state = $all_admin_data_array[0]['state_name'];
                    $admin_city = $all_admin_data_array[0]['city_name'];
                    $admin_pincode = $all_admin_data_array[0]['pincode'];
                    $admin_landline_no = $all_admin_data_array[0]['landline_no'];


                    //buyer data
                    if (count($all_buyer_id_array) > 0)
                    {
                        $all_buyer_id = implode(',', $all_buyer_id_array);
                        $all_user_data_array = array();
                        $get_user_query = "SELECT
                                      id,
                                      first_name,
                                      last_name,
                                      email,
                                      mobile
                                    FROM user
                                    WHERE id IN ($all_buyer_id);";
                        $result_user_query = mysqli_query($db_mysqli, $get_user_query);

                        $all_user_data_array = array();
                        while ($row_user_query = mysqli_fetch_assoc($result_user_query))
                        {
                            $all_user_data_array[] = $row_user_query;
                        }


                        if (count($all_user_data_array) > 0)
                        {
                            $buyer_array = array();
                            foreach ($all_user_data_array as $all_user_data)
                            {
                                $buyer_first_name = $all_user_data['first_name'];
                                $buyer_last_name = $all_user_data['last_name'];
                                $buyer_email = $all_user_data['email'];
                                $buyer_mobile = $all_user_data['mobile'];
                                $buyer_array[$all_user_data['id']] = array("first_name" => $buyer_first_name, "last_name" => $buyer_last_name, "email" => $buyer_email, "mobile" => $buyer_mobile);
                            }
                        }
                    }

                    //product data
                    $all_product_data_array = array();
                    $product_array = array();

                    if (count($all_product_id_array) > 0)
                    {
                        $all_product_id = implode(',', $all_product_id_array);
                        $all_product_data_array = array();
                        $get_product_query = "SELECT
                                          id,
                                          product_name,
                                          product_seo_url
                                          category_id,
                                          photo1,
                                          photo2,
                                          package_dimensions_length,
                                          package_dimensions_width,
                                          package_dimensions_height,
                                          package_weight,
                                          status
                                        FROM product WHERE id IN ($all_product_id);";
                        $result_product_query = mysqli_query($db_mysqli, $get_product_query);
                        while ($row_product_query = mysqli_fetch_assoc($result_product_query))
                        {
                            $all_product_data_array[] = $row_product_query;
                        }

                        foreach ($all_product_data_array as $all_product_data)
                        {
                            $product_array[$all_product_data['id']] = $all_product_data;
                        }

                    }

                    //product variant data
                    $all_product_variant_data_array = array();
                    if (count($all_product_variant_id_array) > 0)
                    {
                        $get_product_variant_query = "SELECT id
                        FROM product_variant WHERE id IN ($all_product_variant_id_array[0]);";
                        $result_product_variant_query = mysqli_query($db_mysqli, $get_product_variant_query);

                        $all_product_variant_data_array = array();
                        while ($row_product_variant_query = mysqli_fetch_assoc($result_product_variant_query))
                        {
                            $all_product_variant_data_array[] = $row_product_variant_query;
                        }

                        $product_variant_array = array();
                        foreach ($all_product_variant_data_array as $all_product_variant_data)
                        {
                            $product_variant_array[$all_product_variant_data['id']] = $all_product_variant_data;
                        }
                    }


                    $all_user_order_address_data_array = array();
                    $get_user_order_address_query = "SELECT *
                        FROM user_order_address WHERE user_order_address.order_id IN ('$all_order_id[0]');";
                    $result_user_order_address_query = mysqli_query($db_mysqli, $get_user_order_address_query);

                    $all_user_order_address_data_array = array();
                    while ($row_user_order_address_query = mysqli_fetch_assoc($result_user_order_address_query))
                    {
                        $all_user_order_address_data_array[] = $row_user_order_address_query;
                    }

                    $user_order_address_data_array = array();
                    foreach ($all_user_order_address_data_array as $all_user_order_address_data)
                    {
                        $user_order_address_data_array[$all_user_order_address_data['order_id']] = $all_user_order_address_data;
                    }


                    foreach ($all_order_id as $temp_order_id)
                    {
                        //buyer address
                        $street_address1 = $user_order_address_data_array[$temp_order_id]["address1"];
                        $street_address2 = $user_order_address_data_array[$temp_order_id]["address2"];
                        $otp_mobile = $user_order_address_data_array[$temp_order_id]["otp_mobile"];
                        $city = $user_order_address_data_array[$temp_order_id]["city"];
                        $state = $user_order_address_data_array[$temp_order_id]["state"];
                        $country = $user_order_address_data_array[$temp_order_id]["country"];
                        $buyer_pincode = $user_order_address_data_array[$temp_order_id]["pincode"];
                        $buyer_id = $new_all_user_order_data_array[$temp_order_id][0]["user_id"];
                        //$order_id=$temp_order_id;
                    }


                    $shipping_address = '';
                    if ($street_address1 != '')
                    {
                        $shipping_address .= $street_address1;
                        if ($street_address2 != '')
                        {
                            $shipping_address .= "<br>" . $street_address2;
                        }
                    }
                    $shipping_address .= "<br>" . $city . "," . $state . "-" . $buyer_pincode;

                    $buyer_name = $buyer_array[$buyer_id]['first_name'] . " " . $buyer_array[$buyer_id]['last_name'];
                    $buyer_email = $buyer_array[$buyer_id]['email'];
                    $buyer_mobile = $buyer_array[$buyer_id]['mobile'];
                    if (count($all_order_id) > 0)
                    {
                        if ($update_order_status == OrderStatus::TO_BE_PICKED)
                        {
                            // Generate invoice
                            $get_invoice_number_query = "SELECT id,invoice_number FROM user_order_invoice WHERE is_deleted='0' ORDER BY id DESC LIMIT 1";

                            $result_get_invoice_number_query = mysqli_query($db_mysqli, $get_invoice_number_query);

                            $all_invoice_number_data_array = array();
                            while ($row_get_invoice_number_query = mysqli_fetch_assoc($result_get_invoice_number_query))
                            {
                                $all_invoice_number_data_array[] = $row_get_invoice_number_query;
                            }

                            $current_financial_year = substr($current_financial_year, 2, 5);
                            //          eg. invoice number:     AR/0001/17-18
                            if (count($all_invoice_number_data_array) > 0)
                            {
                                $last_invoice_number = $all_invoice_number_data_array[0]['invoice_number'];
                                $number = substr($last_invoice_number, 3, 4);
                                ++$number;
                                $number = sprintf('%04d', $number);
                                $new_invoice_number = 'AR/' . $number . '/' . $current_financial_year;
                            }
                            else
                            {
                                $new_invoice_number = 'AR/0001/' . $current_financial_year;
                            }

                            $get_user_order_id_list_query = "SELECT group_concat(id) AS user_order_id_list
                                                                FROM user_order
                                                                WHERE order_id = '$all_order_id[0]';";

                            $result_get_user_order_id_list_query = mysqli_query($db_mysqli, $get_user_order_id_list_query);

                            $all_user_order_id_list_data_array = array();
                            while ($row_get_user_order_id_list_query = mysqli_fetch_assoc($result_get_user_order_id_list_query))
                            {
                                $all_user_order_id_list_data_array[] = $row_get_user_order_id_list_query;
                            }
                            $user_order_id_list = $all_user_order_id_list_data_array[0]['user_order_id_list'];


                            $insert_invoice_query = "INSERT INTO user_order_invoice (user_order_id_list, invoice_number, invoice_date, status, is_deleted)
                                                                  VALUES ('$user_order_id_list','$new_invoice_number', '$current_date', 1, 0);";


                            $result_insert_invoice_query = mysqli_query($db_mysqli, $insert_invoice_query);

                            $last_insert_invoice_id = mysqli_insert_id($db_mysqli);
                            $update_user_order_query = "UPDATE user_order SET user_order_invoice_id = '$last_insert_invoice_id' WHERE order_id='$all_order_id[0]';";

                            $result_update_user_order = mysqli_query($db_mysqli, $update_user_order_query);


                            $update_user_data_array = array(
                                "order_status" => $update_order_status,
                                "modified_on"  => $current_timestamp,
                            );

                            $update_user_order_details_query = "UPDATE user_order
                                                                SET order_status = '$update_user_data_array[order_status]', modified_on = '$update_user_data_array[modified_on]' 
                                                                WHERE order_id='$order_id';";

                            $result_update_user_order_details = mysqli_query($db_mysqli, $update_user_order_details_query);

                        }
                        else if ($update_order_status == OrderStatus::REJECTED) // Rejected by seller
                        {
                            $payable_seller_amount = 0;
                            //$amount_minus_seller = $check_order_data['commission'] + $check_order_data['pg_charges'];;
                            //$payable_seller_amount = '-'.$amount_minus_seller;

                            $update_user_data_array = array(
                                "order_status"          => $update_order_status,
                                "shipping_charges"      => $shipping_charges,
                                "taxes"                 => '0',
                                "payable_seller_amount" => $payable_seller_amount,
                                "modified_on"           => $current_timestamp,
                            );


                            $update_user_order_details_query = "UPDATE user_order
                                            SET order_status        = '$update_user_data_array[order_status]',
                                              shipping_charges      = '$update_user_data_array[shipping_charges]', 
                                              taxes                 = '$update_user_data_array[taxes]',
                                              payable_seller_amount = '$update_user_data_array[payable_seller_amount]',
                                              modified_on           = '$update_user_data_array[modified_on]'
                                            WHERE order_id = '$order_id'";

                            $result_update_user_order_details = mysqli_query($db_mysqli, $update_user_order_details_query);

                            $all_user_order_data_array = array();
                            $get_user_order_query = "select * from user_order where order_id='$order_id'";
                            $result_user_order_data = mysqli_query($db_mysqli, $get_user_order_query);

                            while ($row_user_order_data = mysqli_fetch_assoc($result_user_order_data))
                            {
                                $all_user_order_data_array[] = $row_user_order_data;
                            }

                            foreach ($all_user_order_data_array as $all_user_order_data)
                            {
                                $quantity = $all_user_order_data['quantity'];
                                $product_id = $all_user_order_data['product_id'];
                                $product_variant_id = $all_user_order_data['product_variant_id'];

                                $update_product_variant_query = "update product_variant set product_qty = product_qty+$quantity,total_reject_count=total_reject_count+1 where id='$product_variant_id' and product_id='$product_id'";
                                $update_product_variant_data_array = mysqli_query($db_mysqli, $update_product_variant_query);

                                $update_product_query = "update product set total_reject_count=product.total_reject_count+1 where id='$product_id'";
                                $update_product_data_array = mysqli_query($db_mysqli, $update_product_query);
                            }
                        }
                        else if ($update_order_status == OrderStatus::TO_HANDOVER)
                        {
                            if (count($all_order_id) == 1)
                            {
                                $remark = '';

                                $tracking_number = Secure1($db_mysqli, $_POST['tracking_number']);
                                if ($tracking_number == '')
                                {
                                    $tracking_number = random_code();
                                }
                                $logistic_id = Secure1($db_mysqli, $_POST['logistic_id']);
//                                $logistic_id = 1;

                                /*if ($logistic_id != '' || $tracking_number)
                                {*/
                                foreach ($all_order_id as $key => $value)
                                {
                                    //buyer address
                                    $street_address1 = $user_order_address_data_array[$value]["address1"];
                                    $street_address2 = $user_order_address_data_array[$value]["address2"];
                                    $city = $user_order_address_data_array[$value]["city"];
                                    $state = $user_order_address_data_array[$value]["state"];
                                    $country = $user_order_address_data_array[$value]["country"];
                                    $buyer_pincode = $user_order_address_data_array[$value]["pincode"];
                                    $buyer_id = $new_all_user_order_data_array[$value][0]["user_id"];
                                    $buyer_name = $buyer_array[$buyer_id]['first_name'] . " " . $buyer_array[$buyer_id]['last_name'];
                                    $buyer_email = $buyer_array[$buyer_id]['email'];
                                    $buyer_mobile = $buyer_array[$buyer_id]['mobile'];


                                    //shipping details start
                                    $shipping_details_added = 0;
                                    $package_dimensions_length = 0;
                                    $package_dimensions_width = 0;
                                    $package_dimensions_height = 0;
                                    $package_weight = 0;

                                    $package_dimensions_length = Secure1($db_mysqli, $_POST['package_dimensions_length']);
                                    $package_dimensions_width = Secure1($db_mysqli, $_POST['package_dimensions_width']);
                                    $package_dimensions_height = Secure1($db_mysqli, $_POST['package_dimensions_height']);
                                    $package_weight = Secure1($db_mysqli, $_POST['package_weight']);
                                    if ($order_total_product == 1)
                                    {
                                        $update_product_data_array = array(
                                            "package_dimensions_length" => $package_dimensions_length,
                                            "package_dimensions_width"  => $package_dimensions_width,
                                            "package_dimensions_height" => $package_dimensions_height,
                                            "package_weight"            => $package_weight,
                                        );
                                        $update_shipping_details_query = "UPDATE product
                                                      SET package_dimensions_length  = '$update_product_data_array[package_dimensions_length]',  
                                                          package_dimensions_width='$update_product_data_array[package_dimensions_width]',
                                                          package_dimensions_height='$update_product_data_array[package_dimensions_height]',
                                                          package_weight='$update_product_data_array[package_weight]'
                                                          WHERE id='$all_order_data_array[0]['product_id']';";

                                        $result_shipping_details_query = mysqli_query($db_mysqli, $update_shipping_details_query);

                                    }

                                    $add_shipping_details_query = "INSERT INTO shipping_details (order_id, package_dimensions_length, package_dimensions_width, package_dimensions_height, package_weight, shipping_charges)
                                            VALUES ('$value','$package_dimensions_length','$package_dimensions_width','$package_dimensions_height','$package_weight','$shipping_charges');";

                                    $result_add_shipping_details_query = mysqli_query($db_mysqli, $add_shipping_details_query);

                                    if ($result_add_shipping_details_query)
                                    {
                                        $shipping_details_added = 1;
                                    }

                                    //shipping details end

                                    $total_quantity = 0;
                                    $payment_mode = '';
                                    $cod_amount = 0;
                                    $total_amount = 0;
                                    $total_overall_offer = 0;
                                    $total_overall_discount = 0;
                                    $total_final_amount = 0;
                                    $total_overall_amount = 0;
                                    $product_title = '';
                                    foreach ($new_all_user_order_data_array[$value] as $temp_new_all_user_order_data)
                                    {
                                        $order_id = $temp_new_all_user_order_data["order_id"];
                                        $product_id = $temp_new_all_user_order_data["product_id"];
                                        $product_title .= $product_array[$product_id]['product_name'] . ',';

                                        $product_variant_id = $temp_new_all_user_order_data["product_variant_id"];
                                        $category_id = $temp_new_all_user_order_data["category_id"];

                                        $product_title_array = $product_title;
                                        $buyer_id = $temp_new_all_user_order_data["user_id"];
                                        $order_date = $temp_new_all_user_order_data["order_date"];
                                        $order_date_time = $temp_new_all_user_order_data["order_date_time"];
                                        $total_quantity = $total_quantity + $temp_new_all_user_order_data["quantity"];
                                        $total_amount = $temp_new_all_user_order_data['price'] * $temp_new_all_user_order_data["quantity"];

                                        //$total_overall_offer = $total_overall_offer + (($total_amount*$value1['admin_offer'])/100);
                                        //$total_overall_discount = $total_overall_discount + (($total_amount*$value1['coupon_percentage'])/100);
                                        $total_overall_amount = $total_overall_amount + $total_amount;

                                        //mod of payment
                                        if ($temp_new_all_user_order_data["mod_of_payment"] == '2')
                                        {
                                            $payment_mode = 'COD';
                                        }
                                        else
                                        {
                                            $payment_mode = 'Prepaid';
                                        }

                                        //invoice
                                        //                                                $seller_invoice_no = $temp_new_all_user_order_data["invoice_number"];
                                        //                                                $bluedart_invoice_array = explode("/", $seller_invoice_no);
                                        //                                                $bluedart_invoice = $bluedart_invoice_array[1];
                                    }


                                    $total_final_amount = $total_overall_amount - $total_overall_discount - $total_overall_offer;
                                    if ($payment_mode == 'COD')
                                    {
                                        $total_cod_amount = $total_final_amount;
                                    }
                                    else
                                    {
                                        $total_cod_amount = 0;
                                    }
                                    if ($total_cod_amount == 0)
                                    {
                                        if ($payment_mode == 'COD')
                                        {
                                            $payment_mode = 'Prepaid';
                                        }
                                    }

                                    $all_product_dimension_data_array = array();
                                    $get_product_dimension_query = "SELECT
                                                          *,
                                                          sum(product.package_weight) AS total_weight,
                                                          sum(product.package_dimensions_length) AS total_length,
                                                          sum(product.package_dimensions_width) AS total_width,
                                                          sum(product.package_dimensions_height) AS total_height
                                                        FROM user_order
                                                          LEFT JOIN product ON user_order.product_id = product.id
                                                        WHERE order_id = '$value';";
                                    $result_get_product_dimension_query = mysqli_query($db_mysqli, $get_product_dimension_query);
                                    while ($row_get_product_dimension_query = mysqli_fetch_assoc($result_get_product_dimension_query))
                                    {
                                        $all_product_dimension_data_array[] = $row_get_product_dimension_query;
                                    }

                                    $total_weight = $all_product_dimension_data_array[0]['total_weight'];
                                    $total_length = $all_product_dimension_data_array[0]['total_length'];
                                    $total_width = $all_product_dimension_data_array[0]['total_width'];
                                    $total_height = $all_product_dimension_data_array[0]['total_height'];


                                    $payment_mode_is_valid = 1;
                                    $pincode_is_valid = 1;
                                    $pincode_response_array = array();
                                    $pincode_response_array = delhivery_pincode_api($buyer_pincode, $delhivery_token_live);
                                    $pincode_is_valid = $pincode_response_array['pincode_is_valid'];
                                    $cod_available = '';

                                    if ($pincode_is_valid)
                                    {
                                        if (strtolower($payment_mode) == 'cod')
                                        {
                                            $cod_available = $pincode_response_array['cod_available'];
                                            if (strtolower($cod_available) == 'n')
                                            {
                                                $payment_mode_is_valid = 0;
                                            }
                                        }
                                    }
                                    else
                                    {
                                        $pincode_is_valid = 0;
                                    }

//                                    if ($pincode_is_valid == 1 && $payment_mode_is_valid == 1)
                                    if (1)
                                    {
                                        /*$tracking_number = '';
                                        $api_status = '';
                                        if ($logistic_id == '1')                    // Delhivery API
                                        {
                                            $current_date = get_current_date_time();
                                            $shipping_mode = 'Express';
                                            $data = array
                                            (
                                                # address from where shipments need to be picked up from
                                                // todo: delhivery data
                                                "shipments"       => array
                                                (array(
                                                        "city"             => $city,
                                                        "waybill"          => '',
                                                        "total_amount"     => "$total_final_amount",
                                                        "seller_cst"       => '',
                                                        "name"             => $buyer_name,
                                                        "weight"           => $total_weight,        // todo: check which weight
                                                        "extra_parameters" => array
                                                        (
                                                            "return_reason"       => '',
                                                            "encryptedShipmentID" => '',
                                                        ),
                                                        "country"          => $country,
                                                        "quantity"         => "$total_quantity",
                                                        "seller_tin"       => '',
                                                        "state"            => $state,
                                                        "shipping_mode"    => $shipping_mode,
                                                        "phone"            => $buyer_mobile,
                                                        "add"              => $street_address1 . " " . $street_address2,
                                                        "cod_amount"       => "$cod_amount",                     //check
                                                        "order_date"       => $current_date,
                                                        "pin"              => $buyer_pincode,
                                                        "products_desc"    => $product_title,
                                                        "payment_mode"     => $payment_mode,      //todo: check in db Prepaid/COD/Pickup/REPL
                                                        "shipment_length"  => $total_length,
                                                        "shipment_height"  => $total_height,
                                                        "order"            => $value,
                                                        "shipment_width"   => $total_width,
                                                        "return_add"       => $admin_address_1,
                                                        "return_city"      => $admin_city,
                                                        "return_country"   => $admin_country,
                                                        "return_name"      => $admin_name,
                                                        "return_phone"     => $admin_landline_no,
                                                        "return_pin"       => $admin_pincode,
                                                        "return_state"     => $admin_state
                                                    )),
                                                "pickup_location" => array
                                                (
                                                    "city"  => $admin_city,
                                                    "state" => $admin_state,
                                                    "name"  => "DADARKAR ARTS AND CREATIVE SERVICES",
                                                    //                                    "name" => $vendor_company_name,
                                                    "pin"   => $admin_pincode,
                                                ),
                                            );


                                            $params['format'] = 'json';
                                            $params['data'] = json_encode($data);

                                            $delhivery_url = "http://test.delhivery.com/cmu/push/json/?token=" . $delhivery_token_test;            // for test
                                            //                            $delhivery_url = "http://track.delhivery.com/cmu/push/json/?token=" . $delhivery_token_live;           // for live

                                            $curl = curl_init();

                                            curl_setopt_array($curl, array(
                                                CURLOPT_URL            => $delhivery_url,
                                                CURLOPT_RETURNTRANSFER => true,
                                                CURLOPT_ENCODING       => "",
                                                CURLOPT_MAXREDIRS      => 10,
                                                CURLOPT_TIMEOUT        => 30,
                                                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                                                CURLOPT_CUSTOMREQUEST  => "POST",
                                                CURLOPT_POSTFIELDS     => http_build_query($params),
                                                CURLOPT_HTTPHEADER     => array(
                                                    "content-type: application/x-www-form-urlencoded"
                                                ),
                                            ));

                                            $result = curl_exec($curl);
                                            $final_result = json_decode($result, true);
                                            $api_status = $final_result['packages'][0]['status'];
                                            curl_close($curl);

                                            if (strtolower($api_status) == 'success')
                                            {
                                                $airway_bill_no = $final_result['packages'][0]['waybill'];
                                                $token_number = $final_result['packages'][0]['refnum'];
                                            }
                                            elseif (strtolower($api_status) == 'fail')
                                            {
                                                $remark = $final_result['packages'][0]['remarks'][0];
                                            }
                                            elseif ($api_status == null)
                                            {
                                                $remark = $final_result['error'];
                                            }
                                        }*/

//                                        if (strtolower($api_status) == 'success')
                                        if (1)
                                        {
//                                            $tracking_number = $airway_bill_no;

                                            $update_user_data_array = array(
                                                "order_status"    => $update_order_status,
                                                "logistic_id"     => $logistic_id,
                                                "tracking_number" => $tracking_number,
                                                "modified_on"     => $current_timestamp,
                                            );

                                            $update_user_order_details_query = "UPDATE user_order
                                                                SET order_status = '$update_user_data_array[order_status]', logistic_id = '$update_user_data_array[logistic_id]', tracking_number = '$update_user_data_array[tracking_number]', modified_on = '$update_user_data_array[modified_on]' WHERE order_id='$order_id';";

                                            $result_update_user_order_details = mysqli_query($db_mysqli, $update_user_order_details_query);

                                            $all_user_order_details_data_array = array();
                                            while ($row_user_order_details_query = mysqli_fetch_assoc($result_update_user_order_details))
                                            {
                                                $all_user_order_details_data_array[] = $row_user_order_details_query;
                                            }

                                            if ($result_update_user_order_details)
                                            {  
                                                $logistic_id = Secure1($db_mysqli, $_POST['logistic_id']);
                                                if ($logistic_id == 1)
                                                {
                                                    $tracking_link = 'https://www.delhivery.com/track/package/' . $tracking_number;
                                                }
                                                else if ($logistic_id == 2)
                                                {
                                                    $tracking_link = 'https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber=' . $tracking_number . '&cntry_code=ca_english';
                                                }
                                                else if ($logistic_id == 3)
                                                {
                                                    $tracking_link = 'https://track.aftership.com/aramex/' . $tracking_number;
                                                }
                                                else if ($logistic_id == 4)
                                                {
                                                    $tracking_link = 'https://track.aftership.com/xpressbees/' . $tracking_number;
                                                }

                                                $get_logistics_name = "SELECT logistics_name from logistics where id='$logistic_id' and status='1' and is_deleted='0'";
                                                $result_get_logistics_name = mysqli_query($db_mysqli, $get_logistics_name);
                                                $logistics_name_array = array();
                                                while ($row_get_logistics_name_query = mysqli_fetch_assoc($result_get_logistics_name))
                                                {
                                                    $logistics_name_array[] = $row_get_logistics_name_query;
                                                }
                                                $logistics_name = $logistics_name_array[0]['logistics_name'];

                                                $order_update_action_done = 1;                      
                                                /* Send mail to buyer */
                                                $email_array = array();
                                                $email_array['base_url'] = $base_url;
                                                $email_array['email'] = $buyer_email;
                                                $email_array['logistics_name'] = $logistics_name;
                                                $email_array['user_name'] = $buyer_name;
                                                $email_array['buyer_name'] = $buyer_name;
                                                $email_array['shipping_address'] = $shipping_address;
                                                $email_array['shipping_charges'] = $shipping_charges;
                                                $email_array['order_id'] = $order_id;
                                                $email_array['tracking_number'] = $tracking_number;
                                                $email_array['tracking_link'] = $tracking_link;
                                                $email_array['order_details'] = $all_order_data_array;
                                                $email_array['modified_date_time'] = $current_timestamp;
                                                $email_array['email_type'] = 17;//(to be picked order status move to dispatch)mail to buyer
                                                $email_sent_response = send_email($email_array);
                                                /* End of Send mail to buyer */
                                                
                                                
                                                /* Send mail to Seller */
                                                $email_array = array();
                                                $email_array['base_url'] = $base_url_buyer;
                                                $email_array['email'] = $admin_email;
                                                $email_array['user_name'] = $admin_name;
                                                $email_array['buyer_name'] = $buyer_name;
                                                $email_array['shipping_address'] = $shipping_address;
                                                $email_array['shipping_charges'] = $shipping_charges;
                                                $email_array['order_id'] = $order_id;
                                                $email_array['tracking_number'] = $tracking_number;
                                                $email_array['tracking_link'] = $tracking_link;
                                                $email_array['modified_date_time'] = $current_timestamp;
                                                $email_array['order_details'] = $all_order_data_array;
                                                $email_array['email_type'] = 18;//(to be picked order status move to dispatch)mail to seller
                                                $email_sent_response = send_email($email_array);
                                                /* End of Send mail to Seller */


                                                
                                                $otp_array = array();
                                                $otp_array['mobile_no'] = $buyer_mobile;
                                                $otp_array['order_id'] = $order_id;
                                                $otp_array['tracking_number'] = $tracking_number;
                                                $otp_array['tracking_link'] = $tracking_link;
                                                $otp_array['sms_type'] = 3;                        
                                                $sms_sent_response = send_sms($otp_array);
                                            }
                                            else
                                            {
                                                $return["html_message"] = 'Some Error Occured! Please try again.';
                                                $return["status"] = "error";
                                                echo json_encode($return);
                                                exit();
                                            }
                                        }
                                        else
                                        {
                                            $error_array['api_error'] = 'Waybill generation error for the order ' . $value . " :  $remark";
                                        }
                                    }
                                    else
                                    {
                                        if ($payment_mode_is_valid == 0)
                                        {
                                            $error_array['api_error'] = 'Cod is not available in buyer Pincode for the order id: ' . $value . ".";
                                        }
                                        else
                                        {
                                            $error_array['api_error'] = 'Buyer Pincode is invalid for the order id: ' . $value . ".";
                                        }
                                    }
                                }
                                /*}
                                else
                                {
                                    $return["update"] = 0;
                                    $return["status"] = "error";
                                    $return["html_message"] = 'Invalid Logistic.';
                                    echo json_encode($return);
                                    exit();
                                }*/
                            }
                            else
                            {
                                $return["update"] = 0;
                                $return["status"] = "error";
                                $return["html_message"] = 'Please select only 1 order.';
                                echo json_encode($return);
                                exit();
                            }
                        }
                        else if ($update_order_status == OrderStatus::DELIVERED)
                        {
                            $delivery_date = date('Y-m-d');
                            if ($return_period_days > 0 && $is_returnable == 1)
                            {
                                $is_returnable = '1';
                                $total_days = ' + ' . $return_period_days . ' days';
                                $return_till_date = date('Y-m-d', strtotime($delivery_date . $total_days));
                            }

                            $update_user_data_array = array(
                                "order_status"     => $update_order_status,
                                "delivery_date"    => $delivery_date,
                                "is_returnable"    => $is_returnable,
                                "return_till_date" => $return_till_date,
                                "modified_on"      => $current_timestamp,
                            );

                            $update_user_order_details_query = "UPDATE user_order
                                                      SET order_status  = '$update_user_data_array[order_status]',  
                                                          delivery_date='$update_user_data_array[delivery_date]',
                                                          is_returnable='$update_user_data_array[is_returnable]',
                                                          return_till_date='$update_user_data_array[return_till_date]',
                                                          modified_on='$update_user_data_array[modified_on]'
                                                          WHERE order_id='$order_id';";

                            $result_update_user_order_details = mysqli_query($db_mysqli, $update_user_order_details_query);
                        }
                        else if ($update_order_status == OrderStatus::RETURN_ORDER)
                        {
                            //todo: update orders
                            /* Order update 7 is for return, and user can perform 5 different activities from modal
                            *   1=Pending
                                2=Accepted
                                3=In-Transit
                                4=Delivered
                                5=Rejected
                            */
                            for ($i = 0; $i < $order_total_product; $i++)
                            {
                                $update_user_order_details_array = array(
                                    "order_status"  => $update_order_status,
                                    "return_status" => $update_return_order_status[$i],
                                    "modified_on"   => $current_timestamp,
                                );

                                $update_user_order_details_query = "UPDATE user_order
                                                      SET order_status  = '$update_user_order_details_array[order_status]',  
                                                          return_status  = '$update_user_order_details_array[return_status]',  
                                                          modified_on='$update_user_order_details_array[modified_on]'
                                                          WHERE order_id='$order_id' AND id='$order_row_id[$i]';";

                                $result_update_user_order_details = mysqli_query($db_mysqli, $update_user_order_details_query);

                                if ($update_return_order_status[$i] == ReturnOrderStatus::RETURN_DELIVERED)
                                {
                                    $product_id = $all_product_id_array[$i];
                                    $product_variant_id = $all_product_variant_id_array[$i];
                                    $update_product_variant_query = "update product_variant set product_qty = product_qty+1,total_return_count=product_variant.total_return_count + 1 where id='$product_variant_id' and product_id='$product_id'";
                                    $update_product_variant_data_array = mysqli_query($db_mysqli, $update_product_variant_query);

                                    $update_product_query = "update product set total_return_count=product.total_return_count+1 where id='$product_id'";
                                    $update_product_data_array = mysqli_query($db_mysqli, $update_product_query);
                                }
                            }
                        }
                        else
                        {
                            $update_user_order_details_array = array(
                                "order_status" => $update_order_status,
                                "modified_on"  => $current_timestamp,
                            );

                            $update_user_order_details_query = "UPDATE user_order
                                                      SET order_status  = '$update_user_order_details_array[order_status]',  
                                                          modified_on='$update_user_order_details_array[modified_on]'
                                                          WHERE order_id='$order_id';";

                            $result_update_user_order_details = mysqli_query($db_mysqli, $update_user_order_details_query);
                        }


                        if ($result_update_user_order_details)
                        {
                            $order_update_action_done = 1;
                        }

                        if ($order_update_action_done == 1)
                        {
                            if ($update_order_status == OrderStatus::TO_BE_PICKED)
                            {
                                /* Send mail to buyer */
                                $email_array = array();
                                $email_array['base_url'] = $base_url;
                                $email_array['email'] = $buyer_email;
                                $email_array['user_name'] = $buyer_name;
                                $email_array['buyer_name'] = $buyer_name;
                                $email_array['shipping_address'] = $shipping_address;
                                $email_array['shipping_charges'] = $shipping_charges;
                                $email_array['order_id'] = $order_id;
                                $email_array['tracking_number'] = $tracking_number;
                                $email_array['order_details'] = $all_order_data_array;
                                $email_array['modified_date_time'] = $current_timestamp;
                                $email_array['email_type'] = 13;//(to be picked order status move to dispatch)mail to buyer
                                $email_sent_response = send_email($email_array);
                                /* End of Send mail to buyer */


                                /* Send mail to Seller */
                                $email_array = array();
                                $email_array['base_url'] = $base_url_buyer;
                                $email_array['email'] = $admin_email;
                                $email_array['user_name'] = $admin_name;
                                $email_array['buyer_name'] = $buyer_name;
                                $email_array['shipping_address'] = $shipping_address;
                                $email_array['shipping_charges'] = $shipping_charges;
                                $email_array['order_id'] = $order_id;
                                $email_array['tracking_number'] = $tracking_number;
                                $email_array['modified_date_time'] = $current_timestamp;
                                $email_array['order_details'] = $all_order_data_array;
                                $email_array['email_type'] = 14;//(to be picked order status move to dispatch)mail to seller
                                $email_sent_response = send_email($email_array);
                                /* End of Send mail to Seller */
                            }
                            if ($update_order_status == OrderStatus::DISPATCH)
                            {                                /* Send mail to buyer */
                                $email_array = array();
                                $email_array['base_url'] = $base_url;
                                $email_array['email'] = $buyer_email;
                                $email_array['user_name'] = $buyer_name;
                                $email_array['buyer_name'] = $buyer_name;
                                $email_array['shipping_address'] = $shipping_address;
                                $email_array['shipping_charges'] = $shipping_charges;
                                $email_array['order_id'] = $order_id;
                                $email_array['tracking_number'] = $tracking_number;
                                $email_array['order_details'] = $all_order_data_array;
                                $email_array['modified_date_time'] = $current_timestamp;
                                $email_array['email_type'] = 15;//(to be picked order status move to dispatch)mail to buyer
                                $email_sent_response = send_email($email_array);
                                /* End of Send mail to buyer */


                                /* Send mail to Seller */
                                $email_array = array();
                                $email_array['base_url'] = $base_url_buyer;
                                $email_array['email'] = $admin_email;
                                $email_array['user_name'] = $admin_name;
                                $email_array['buyer_name'] = $buyer_name;
                                $email_array['shipping_address'] = $shipping_address;
                                $email_array['shipping_charges'] = $shipping_charges;
                                $email_array['order_id'] = $order_id;
                                $email_array['tracking_number'] = $tracking_number;
                                $email_array['modified_date_time'] = $current_timestamp;
                                $email_array['order_details'] = $all_order_data_array;
                                $email_array['email_type'] = 16;//(to be picked order status move to dispatch)mail to seller
                                $email_sent_response = send_email($email_array);
                                /* End of Send mail to Seller */
                            }
                            if ($update_order_status == OrderStatus::IN_TRANSIT)
                            {
                                /* Send mail to buyer */
                                $email_array = array();
                                $email_array['base_url'] = $base_url;
                                $email_array['email'] = $buyer_email;
                                $email_array['user_name'] = $buyer_name;
                                $email_array['buyer_name'] = $buyer_name;
                                $email_array['shipping_address'] = $shipping_address;
                                $email_array['shipping_charges'] = $shipping_charges;
                                $email_array['order_id'] = $order_id;
                                $email_array['tracking_number'] = $tracking_number;
                                $email_array['order_details'] = $all_order_data_array;
                                $email_array['modified_date_time'] = $current_timestamp;
                                $email_array['email_type'] = 19;//(to be picked order status move to dispatch)mail to buyer
                                $email_sent_response = send_email($email_array);
                                /* End of Send mail to buyer */


                                /* Send mail to Seller */
                                $email_array = array();
                                $email_array['base_url'] = $base_url_buyer;
                                $email_array['email'] = $admin_email;
                                $email_array['user_name'] = $admin_name;
                                $email_array['buyer_name'] = $buyer_name;
                                $email_array['shipping_address'] = $shipping_address;
                                $email_array['shipping_charges'] = $shipping_charges;
                                $email_array['order_id'] = $order_id;
                                $email_array['tracking_number'] = $tracking_number;
                                $email_array['modified_date_time'] = $current_timestamp;
                                $email_array['order_details'] = $all_order_data_array;
                                $email_array['email_type'] = 20;//(to be picked order status move to dispatch)mail to seller
                                $email_sent_response = send_email($email_array);
                                /* End of Send mail to Seller */
                            }
                            if ($update_order_status == OrderStatus::DELIVERED)
                            {

                                $tracking_number = $all_order_data_array[0]['tracking_number'];

                                $logistic_id = $all_order_data_array[0]['logistic_id'];
                                if ($logistic_id == 1)
                                {
                                    $tracking_link = 'https://www.delhivery.com/track/package/' . $tracking_number;
                                }
                                else if ($logistic_id == 2)
                                {
                                    $tracking_link = 'https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber=' . $tracking_number . '&cntry_code=ca_english';
                                }
                                else if ($logistic_id == 3)
                                {
                                    $tracking_link = 'https://track.aftership.com/aramex/' . $tracking_number;
                                }
                                else if ($logistic_id == 4)
                                {
                                    $tracking_link = 'https://track.aftership.com/xpressbees/' . $tracking_number;
                                }

                                $get_logistics_name = "SELECT logistics_name from logistics where id='$logistic_id' and status='1' and is_deleted='0'";
                                $result_get_logistics_name = mysqli_query($db_mysqli, $get_logistics_name);
                                $logistics_name_array = array();
                                while ($row_get_logistics_name_query = mysqli_fetch_assoc($result_get_logistics_name))
                                {
                                    $logistics_name_array[] = $row_get_logistics_name_query;
                                }
                                $logistics_name = $logistics_name_array[0]['logistics_name'];
                                /* Send mail to buyer */
                                $email_array = array();
                                $email_array['base_url'] = $base_url;
                                $email_array['email'] = $buyer_email;
                                $email_array['logistics_name'] = $logistics_name;
                                $email_array['user_name'] = $buyer_name;
                                $email_array['buyer_name'] = $buyer_name;
                                $email_array['shipping_address'] = $shipping_address;
                                $email_array['shipping_charges'] = $shipping_charges;
                                $email_array['order_id'] = $order_id;
                                $email_array['tracking_number'] = $tracking_number;
                                $email_array['tracking_link'] = $tracking_link;
                                $email_array['order_details'] = $all_order_data_array;
                                $email_array['modified_date_time'] = $current_timestamp;
                                $email_array['email_type'] = 21;//(to be picked order status move to dispatch)mail to buyer
                                $email_sent_response = send_email($email_array);
                                /* End of Send mail to buyer */


                                /* Send mail to Seller */
                                $email_array = array();
                                $email_array['base_url'] = $base_url_buyer;
                                $email_array['email'] = $admin_email;
                                $email_array['user_name'] = $admin_name;
                                $email_array['buyer_name'] = $buyer_name;
                                $email_array['shipping_address'] = $shipping_address;
                                $email_array['shipping_charges'] = $shipping_charges;
                                $email_array['order_id'] = $order_id;
                                $email_array['tracking_number'] = $tracking_number;
                                $email_array['tracking_link'] = $tracking_link;
                                $email_array['modified_date_time'] = $current_timestamp;
                                $email_array['order_details'] = $all_order_data_array;
                                $email_array['email_type'] = 22;//(to be picked order status move to dispatch)mail to seller
                                $email_sent_response = send_email($email_array);
                                /* End of Send mail to Seller */

                                $all_product_name = rtrim($all_product_name,", ");
                                $otp_array = array();
                                $otp_array['mobile_no'] = $buyer_mobile;
                                $otp_array['order_id'] = $order_id;
                                $otp_array['all_product_name'] = $all_product_name;
                                $otp_array['order_link'] = $base_url.'my-order';
                                $otp_array['sms_type'] = 4;                        
                                $sms_sent_response = send_sms($otp_array);
                            }
                            if ($update_order_status == OrderStatus::RETURN_ORDER)
                            {
                            }
                            if ($update_order_status == OrderStatus::REJECTED)
                            {
                                $all_product_name = rtrim($all_product_name,", ");
                                $otp_array = array();
                                $otp_array['mobile_no'] = $buyer_mobile;
                                $otp_array['shipping_charges'] = $shipping_charges;
                                $otp_array['all_product_name'] = $all_product_name;
                                $otp_array['order_details'] = $all_order_data_array;
                                $otp_array['sms_type'] = 6;
                                $sms_sent_response = send_sms($otp_array);  

                                /* Send mail to buyer */
                                $email_array = array();
                                $email_array['base_url'] = $base_url;
                                $email_array['email'] = $buyer_email;
                                $email_array['user_name'] = $buyer_name;
                                $email_array['buyer_name'] = $buyer_name;
                                $email_array['shipping_address'] = $shipping_address;
                                $email_array['shipping_charges'] = $shipping_charges;
                                $email_array['order_id'] = $order_id;
                                $email_array['tracking_number'] = $tracking_number;
                                $email_array['order_details'] = $all_order_data_array;
                                $email_array['modified_date_time'] = $current_timestamp;
                                $email_array['email_type'] = 11;//(to be picked order status move to dispatch)mail to buyer
                                $email_sent_response = send_email($email_array);
                                /* End of Send mail to buyer */


                                /* Send mail to Seller */
                                $email_array = array();
                                $email_array['base_url'] = $base_url_buyer;
                                $email_array['email'] = $admin_email;
                                $email_array['user_name'] = $admin_name;
                                $email_array['buyer_name'] = $buyer_name;
                                $email_array['shipping_address'] = $shipping_address;
                                $email_array['shipping_charges'] = $shipping_charges;
                                $email_array['order_id'] = $order_id;
                                $email_array['tracking_number'] = $tracking_number;
                                $email_array['modified_date_time'] = $current_timestamp;
                                $email_array['order_details'] = $all_order_data_array;
                                $email_array['email_type'] = 12;//(to be picked order status move to dispatch)mail to seller
                                $email_sent_response = send_email($email_array);
                                /* End of Send mail to Seller */
                            }

                            $html_message = 'Order ' . $order_status_html . ' successfully .';
                            $return["html_message"] = $html_message;
                            $return["order_id"] = $order_id;
                            $return["error_array"] = $error_array;
                            $return["update"] = 1;
                            $return["status"] = "success";
                            echo json_encode($return);
                        }
                        else
                        {
                            $return["html_message"] = '';
                            $return["status"] = "error";
                            $return["order_id"] = $order_id;
                            $return["update"] = 0;
                            $return["error_from_api"] = 1;
                            $return["error_array"] = $error_array;
                            echo json_encode($return);
                        }
                    }
                }
                else
                {
                    $return["html_message"] = 'Order doesnot exists..!';
                    $return["status"] = "error";
                    echo json_encode($return);
                    exit();
                }
            }
            else
            {
                $return["html_message"] = 'Some Error Occured! Please try again.';
                $return["status"] = "error";
                echo json_encode($return);
                exit();
            }
        }
        else
        {
            $return["html_message"] = 'Some Error Occured! Please try again.';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }
    }
    else
    {
        $return["html_message"] = 'Some Error Occured! Please try again.';
        $return["status"] = "error";
        echo json_encode($return);
        exit();
    }
}
else
{
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'logout">';
}
?>


<?php
function delhivery_pincode_api($pincode, $delhivery_token_live)
{
    $cod_available = 'N';
    $pincode_is_valid = 1;
    $Area_code = '';
    $url = "http://track.delhivery.com/c/api/pin-codes/json/?token=" . $delhivery_token_live . "&filter_codes=" . $pincode;
    $json = file_get_contents($url);
    $data = json_decode($json, TRUE);

    if (count($data['delivery_codes']) > 0)
    {
        $cod_available = $data['delivery_codes'][0]['postal_code']['cod'];
    }
    else
    {
        $pincode_is_valid = 0;
    }

    $return_array = array();
    $return_array['pincode_is_valid'] = $pincode_is_valid;
    $return_array['cod_available'] = $cod_available;
    return $return_array;
}

?>

