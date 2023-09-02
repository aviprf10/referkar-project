<?php
$total_cart_product = 0;
$order_total_amount = 0;
$save_total_amount = 0;
$is_coupon_apply = 0;
$discount = 0;
$total_discount = 0;
$total_qty_wise_discount = 0;
$temp_user_wallet_amount = 0;
$final_order_total = 0;
$product_total_quantity = 0;
$cart_product_id_array = array();
$cart_product_variant_id_array = array();
$local_shipping=0;
$master_settings_data_array = array();
$master_settings_query = "select * from master_settings where id='1'";
$result_master_settings_data = mysqli_query($db_mysqli,$master_settings_query);
while ($row_master_settings_data = mysqli_fetch_assoc($result_master_settings_data))
{
    $master_settings_data_array[] = $row_master_settings_data;
    if($current_page != 'cart')
    {
        $local_shipping=$row_master_settings_data['local_shipping'];
    }
}
if($user == 1)
{
    $cart_product_id_array = array();
    $cart_product_variant_id_array = array();

    $cart_data_array = array();
    $get_user_cart_query = "select * from user_cart where user_id='$loggedin_user_id'";
    $result_user_cart_data = mysqli_query($db_mysqli, $get_user_cart_query);
    while ($row_user_cart_data = mysqli_fetch_assoc($result_user_cart_data))
    {
        $cart_data_array[] = $row_user_cart_data;
    }
    foreach ($cart_data_array as $cart_data)
    {
        if ($cart_data['product_id'] > 0)
        {
            if (!in_array($cart_data['product_id'], $cart_product_id_array))
            {
                $cart_product_id_array[] = $cart_data['product_id'];
            }
        }
    }

    $cart_product_id_array1 = implode(",", $cart_product_id_array);

    $cart_product_data_array = array();
    $cart_all_product_data_array = array();
    if (count($cart_product_id_array) > 0)
    {
        $cart_product_data_array = array();
        $get_cart_product_query = "select p.*, pi.product_small_images from product p LEFT JOIN product_images pi on pi.product_id = p.id where p.id IN ($cart_product_id_array1)";
        $result_cart_product_data = mysqli_query($db_mysqli, $get_cart_product_query);
        while ($row_cart_product_data = mysqli_fetch_assoc($result_cart_product_data))
        {
            $cart_product_data_array[] = $row_cart_product_data;
        }
        if(count($cart_product_data_array) > 0)
        {
            foreach ($cart_product_data_array as $cart_product_data)
            {
                $cart_all_product_data_array[$cart_product_data['id']] = $cart_product_data;

                if ($cart_product_data['status'] != '1' || $cart_product_data['is_deleted'] == '1' || $cart_product_data['product_qty'] == '0')
                {
                    $product_id = $cart_product_data['id'];
                    $return_cart_data = array();
                    $user_cart_query = "delete from user_cart where product_id='$product_id' and user_id='$loggedin_user_id'";
                    $return_cart_data = mysqli_query($db_mysqli, $user_cart_query);
                }
            }
        }
    }


    $cart_data_array1 = array();
    $temp_cart_data_array = array();
    $get_temp_cart_query = "select * from user_cart where user_id = '$loggedin_user_id'";
    $result_temp_cart_data = mysqli_query($db_mysqli, $get_temp_cart_query);
    while ($row_temp_cart_data = mysqli_fetch_assoc($result_temp_cart_data))
    {
        $temp_cart_data_array[] = $row_temp_cart_data;
    }

    $temp_cart_data_array1 = array();
    
    foreach ($temp_cart_data_array as $temp_cart_data)
    {
        //print_r($cart_all_product_data_array); exit;
        $temp_cart_data_array1 = array();
        $temp_cart_data_array1["id"] = $temp_cart_data['id'];
        $temp_cart_data_array1["user_id"] = $temp_cart_data['user_id'];
        $temp_cart_data_array1["product_id"] = $temp_cart_data['product_id'];
        $temp_cart_data_array1["category_id"] = $temp_cart_data['category_id'];
        $temp_cart_data_array1["product_seo_url"] = $cart_all_product_data_array[$temp_cart_data["product_id"]]['product_unique_slug'];
        $temp_cart_data_array1["product_name"] = $cart_all_product_data_array[$temp_cart_data["product_id"]]['product_name'];
        if ($cart_all_product_data_array[$temp_cart_data["product_id"]]['product_small_images'] != '')
        {
            $temp_cart_data_array1["product_image"] = $cart_all_product_data_array[$temp_cart_data["product_id"]]['product_small_images'];
        }
        else
        {
            $temp_cart_data_array1["product_image"] = 'default_profile.jpg';
        }

        if($cart_all_product_data_array[$temp_cart_data["product_id"]]['product_qty'] < $temp_cart_data['quantity'])
        {
            $temp_cart_data_array1["quantity"] = $cart_all_product_data_array[$temp_cart_data["product_id"]]['product_qty'];
        }
        else
        {
            $temp_cart_data_array1["quantity"] = $temp_cart_data['quantity'];

        }


        if($cart_all_product_data_array[$temp_cart_data["product_id"]]['product_price'] != $temp_cart_data['price'])
        {
            $temp_cart_data_array1["price"] = $cart_all_product_data_array[$temp_cart_data["product_id"]]['product_price'];
        }
        else
        {
            $temp_cart_data_array1["price"] = $temp_cart_data['price'];
        }

        if($cart_all_product_data_array[$temp_cart_data["product_id"]]['product_spacial_price'] != $temp_cart_data['mrp'])
        {
            $temp_cart_data_array1["mrp"] = $cart_all_product_data_array[$temp_cart_data["product_id"]]['product_spacial_price'];
        }
        else
        {
            $temp_cart_data_array1["mrp"] = $temp_cart_data['mrp'];
        }

        if($cart_all_product_data_array[$temp_cart_data["product_id"]]['discount_type'] != $temp_cart_data['discount_type'])
        {
            $temp_cart_data_array1["discount_type"] = $cart_all_product_data_array[$temp_cart_data["product_id"]]['discount_type'];
        }
        else
        {
            $temp_cart_data_array1["discount_type"] = $temp_cart_data['discount_type'];
        }

        if($cart_all_product_data_array[$temp_cart_data["product_id"]]['discount'] != $temp_cart_data['discount'])
        {
            $temp_cart_data_array1["discount"] = $cart_all_product_data_array[$temp_cart_data["product_id"]]['discount'];
        }
        else
        {
            $temp_cart_data_array1["discount"] = $temp_cart_data['discount'];
        }





        $temp_cart_data_array1["address_id"] = $temp_cart_data['address_id'];
        $temp_cart_data_array1["is_coupon_apply"] = $temp_cart_data['is_coupon_apply'];
        $cart_data_array1[$temp_cart_data['product_id']] = $temp_cart_data_array1;
        $is_coupon_apply = $temp_cart_data['is_coupon_apply'];
        $save_total_amount += ($temp_cart_data_array1["mrp"] - $temp_cart_data_array1["price"]) * $temp_cart_data_array1["quantity"];
        $order_total_amount += $temp_cart_data_array1["quantity"] * $temp_cart_data_array1["price"];
        
        if ($temp_cart_data_array1["discount_type"] == 'percentage')
        {
            $discount = $order_total_amount*$temp_cart_data_array1["discount"];
            $total_discount += $discount/100;
        }
        else if($temp_cart_data_array1["discount_type"] == 'price')
        {
            $total_discount += $temp_cart_data_array1["discount"];
        }
        
        $product_total_quantity += $temp_cart_data_array1["quantity"];
    }

    $final_order_total = $order_total_amount - $total_discount;
    $final_order_total+= $local_shipping;
    if (count($temp_cart_data_array1) > 0)
    {
        $_SESSION['total_user_cart_data_' . $company_name_session] = count($temp_cart_data_array);
        $_SESSION['order_total_amount_' . $company_name_session] = $order_total_amount;
        $_SESSION['save_total_amount_' . $company_name_session] = $save_total_amount;
        $_SESSION['final_order_total_' . $company_name_session] = $final_order_total;
    }
    else
    {
        $_SESSION['total_user_cart_data_' . $company_name_session] = 0;
        $_SESSION['order_total_amount_' . $company_name_session] = 0;
        $_SESSION['save_total_amount_' . $company_name_session] = 0;
        $_SESSION['final_order_total_' . $company_name_session] = 0;
    }
    $total_user_cart_product = $_SESSION['total_user_cart_data_' . $company_name_session];
}
else
{
    $cart_product_id_array = array();
    $cart_product_variant_id_array = array();
    $cart_data_array = $_SESSION['cart_' . $company_name_session];
    foreach ($cart_data_array as $cart_data)
    {
        if ($cart_data['product_id'] > 0)
        {
            if (!in_array($cart_data['product_id'], $cart_product_id_array))
            {
                $cart_product_id_array[] = $cart_data['product_id'];
            }

        }
        $save_total_amount += ($cart_data['mrp'] - $cart_data['price']) * $cart_data['quantity'];
        $order_total_amount += $cart_data['quantity'] * $cart_data['price'];
        $final_order_total += $cart_data['quantity'] * $cart_data['price'];
    }
    $final_order_total+= $local_shipping;


    $cart_product_id_array1 = implode(",", $cart_product_id_array);
    $cart_product_variant_id_array1 = implode(",", $cart_product_variant_id_array);
    $cart_product_data_array = array();
    $cart_all_product_data_array = array();
    if (count($cart_product_id_array) > 0)
    {
        $cart_product_data_array = array();
        $get_cart_product_query = "select * from product p LEFT JOIN product_images pi on pi.product_id = p.id where p.id IN ($cart_product_id_array1)";

        $result_cart_product_data = mysqli_query($db_mysqli, $get_cart_product_query);
        while ($row_cart_product_data = mysqli_fetch_assoc($result_cart_product_data))
        {
            $cart_product_data_array[] = $row_cart_product_data;
        }

        foreach ($cart_product_data_array as $cart_product_data)
        {
            $cart_all_product_data_array[$cart_product_data['id']] = $cart_product_data;
            if ($cart_product_data['status'] != '1' || $cart_product_data['is_deleted'] == '1' || $cart_product_data['product_qty'] == '0')
            {
                $save_total_amount -= ($cart_product_data['mrp'] * $cart_product_data['price']) * $cart_product_data['quantity'];
                $order_total_amount -= $cart_product_data['quantity'] * $cart_product_data['price'];
                if ($cart_product_data["discount_type"] == 'percentage')
                {
                    $discount = $order_total_amount*$cart_product_data["discount"];
                    $total_discount += $discount/100;
                }
                else if($cart_product_data["discount_type"] == 'price')
                {
                    $total_discount += $cart_product_data["discount"];
                }
                $final_order_total -= $order_total_amount - $total_discount;;
                unset($_SESSION['cart_' . $company_name_session][$cart_product_data['product_seo_url']]);
            }
        }
    }

    if ($_SESSION['cart_' . $company_name_session])
    {
        $total_cart_product = count($_SESSION['cart_' . $company_name_session]);
        $_SESSION['total_user_cart_data_' . $company_name_session] = $total_cart_product;
        $_SESSION['order_total_amount_' . $company_name_session] = $order_total_amount;
        $_SESSION['save_total_amount_' . $company_name_session] = $save_total_amount;
        $_SESSION['final_order_total_' . $company_name_session] = $final_order_total;
    }
    else
    {
        $_SESSION['total_user_cart_data_' . $company_name_session] = 0;
        $_SESSION['cart_' . $company_name_session] = array();
        $_SESSION['order_total_amount_' . $company_name_session] = 0;
        $_SESSION['save_total_amount_' . $company_name_session] = 0;
        $_SESSION['final_order_total_' . $company_name_session] = 0;
    }
    $total_user_cart_product = $_SESSION['total_user_cart_data_' . $company_name_session];
}
?>