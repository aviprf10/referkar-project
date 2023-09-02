<?php
include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if (isset($_POST))
    {
        $order_id = Secure1($db_mysqli, $_POST['order_id']);
        $order_status = Secure1($db_mysqli, $_POST['order_status']);

        $filter_condition = " where u_o.is_deleted=0";

        $order_return_status = '';
        if ($order_status == '')
        {
            $filter_condition .= " and u_o.order_id='$order_id'";
        }
        else
        {
            $filter_condition .= " and u_o.order_id='$order_id' and u_o.order_status='$order_status'";
            if (isset($_POST['return_status']))
            {
                $order_return_status = $_POST['return_status'];
                $filter_condition .= " and u_o.return_status='$order_return_status'";
            }
        }

        $group_condition = "group by product_variant_id";
        $order_condition = "";
        $all_order_data_array = array();
        $get_order_query = "SELECT
                      u_o.*,
                      u.first_name as buyer_fname,
                      u.last_name as buyer_lname,
                      u.mobile as buyer_mobile,
                      u_o_a.first_name as u_o_a_first_name,
                      u_o_a.last_name as u_o_a_last_name,
                      u_o_a.mobile as u_o_a_mobile,
                      u_o_a.address1,
                      u_o_a.address2,
                      u_o_a.address2,
                      u_o_a.pincode,
                      u_o_a.city,
                      u_o_a.state,
                      u_o_a.country,
                      u_o.id                                                   AS user_order_table_id,
                      (SELECT SUM(price)
                       FROM user_order u_o1
                       WHERE u_o1.order_id = u_o.order_id AND u_o1.product_id = u_o.product_id AND
                             u_o1.product_variant_id = u_o.product_variant_id) AS single_product_total_price,
                      (SELECT SUM(quantity)
                       FROM user_order u_o1
                       WHERE u_o1.order_id = u_o.order_id AND u_o1.product_id = u_o.product_id AND
                             u_o1.product_variant_id = u_o.product_variant_id) AS single_product_total_quantity,
                      (SELECT count(*)
                       FROM user_order u_o1
                       WHERE u_o1.order_id = u_o.order_id AND u_o1.order_status = u_o.order_status) AS total_product,
                      p.id                                                     AS p_id,
                      p.product_name,
                      p.product_seo_url,
                      b.brand_title,
                      p.photo1,
                      pv.id                                                    AS pv_id,
                      pv.product_variant_seo_url,
                      pv.variant_one,
                      pv.variant_two,
                      u.id                                                     AS u_id,
                      u.first_name                                             AS buyer_fname,
                      u.last_name                                              AS buyer_lname,
                      u.mobile,
                      u.email
                    FROM user_order u_o LEFT JOIN product p ON u_o.product_id = p.id
                      LEFT JOIN product_variant pv ON u_o.product_variant_id = pv.id
                      LEFT JOIN brand_master b ON b.id = p.brand_id
                      LEFT JOIN user u ON u_o.user_id = u.id
                      LEFT JOIN user_order_address u_o_a ON u_o.order_address_id=u_o_a.id
                        $filter_condition $order_condition";

        $result_get_order_query = mysqli_query($db_mysqli, $get_order_query);
        while ($row_get_order_query = mysqli_fetch_assoc($result_get_order_query))
        {
            $all_order_data_array[] = $row_get_order_query;
        }


        $html_message = '';

        if (count($all_order_data_array) > 0)
        {
            //print_r($order_data_array);
            //exit();
            $html_message .= '
        <form id="return_order_status_form" method="POST">
              <div id="view_order_all_product_modal" class="modal fade">
                <div class="modal-dialog modal-md" style="width:1024px; overflow-y: auto; max-height:85%; margin-bottom:50px;">
                   <div class="modal-content">
                      <div class="modal-header">
                         <h6 class="modal-title">
                            <span class="status-mark bg-success position-left"></span> View Order All Products (Order id: ' . $all_order_data_array[0]['order_id'] . ')';
            if ($order_return_status == 1 || $order_return_status == 2 || $order_return_status == 3)
            {
                $html_message .= '<div class="heading-elements" style="top: 20%">
                                                        <button type="submit" id="return_submit"
                                                            class="btn bg-' . $theme_color . ' heading-btn legitRipple modal-one-back-button">
                                                            Submit
                                                        </button>
                                                    </div>';
            }

            $user_address = '';
            if ($all_order_data_array[0]['address1'])
            {
                $user_address .= $all_order_data_array[0]['address1'];
            }
            if ($all_order_data_array[0]['address2'])
            {
                $user_address .= ", " . $all_order_data_array[0]['address2'];
            }

            $html_message .= '
                            <br/>
                            <div style="width: 70%; padding: 2%; font-size: 13px">
                                <span style="float: left; width: 40%"><strong>User Details:</strong> <br/><strong>Username: </strong>' . $all_order_data_array[0]['buyer_fname'] . ' ' . $all_order_data_array[0]['buyer_lname'] . ',<br/> <strong>Email:</strong> ' . $all_order_data_array[0]['email'] . ',<br/> <strong>Mobile:</strong> ' . $all_order_data_array[0]['buyer_mobile'] . '</span>
                         
                                <span style="float: right; width: 40%"><strong>Shipping Details:</strong> <br/><strong>Name:</strong> ' . $all_order_data_array[0]['u_o_a_first_name'] . ' ' . $all_order_data_array[0]['u_o_a_last_name'] . ',<br/> <strong>Mobile:</strong> ' . $all_order_data_array[0]['u_o_a_mobile'] . ',<br/> <strong>Address:</strong> ' . $user_address . ',<br/> <strong>City:</strong> ' . $all_order_data_array[0]['city'] . ',<br/> <strong>State:</strong> ' . $all_order_data_array[0]['state'] . ',<br/> <strong>Pincode:</strong> ' . $all_order_data_array[0]['pincode'] . ',<br/> <strong>Country:</strong> ' . $all_order_data_array[0]['country'] . '</span>
                            </div>
                         </h6>';

            $action_column = '';
            if ($order_return_status != '')
            {
                $action_column .= '<th data-hide="phone">Action</th>';
            }
            $html_message .= '
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <table class="table table-togglable table-hover">
                            <thead>
                                <tr>
                                   <th data-toggle="phone">Image</th>
                                   <th data-toggle="true">Product Summary</th>
                                   <th data-hide="phone">Qty and Price</th>
                                   <th data-hide="phone">Order Total</th>
                                   ' . $action_column . '
                                </tr>
                            </thead>
                            <tbody>';


            $i = 0;
            foreach ($all_order_data_array as $all_order_data)
            {
                $price = 0;
                $total_price = 0;
                $full_product_title = ucfirst($all_order_data['product_name']);
                $product_title = ucfirst($all_order_data['product_name']);
                if (strlen($product_title) >= 30)
                {
                    $product_title = substr($product_title, 0, 30) . "...";
                }

                $product_seo_url = $all_order_data['product_seo_url'];
                $return_reject_order_reason = $all_order_data['return_reject_order_reason'];

                $order_date_time = date('d-M H:i', strtotime($all_order_data['order_date_time']));
                //                $single_product_total_amount = $all_order_data['single_product_total_quantity'] * $all_order_data['price'];
                //                $single_product_total_amount = number_format($single_product_total_amount, 2, '.', ',');
                //                $single_product_total_price = $all_order_data['single_product_total_price'];
                //                $single_product_total_price = $selected_currency_icon . number_format($single_product_total_price, 2, '.', ',') . '/-';
                //
                //
                //                $single_product_price = $all_order_data['price'];
                //                $single_product_price = $selected_currency_icon . number_format($single_product_price, 2, '.', ',') . '/-';

                $coupon_discount = $all_order_data['coupon_discount'];
                $price = $all_order_data['price'];
                $total_price = $price - $coupon_discount;
                //                $total_price = $selected_currency_icon . number_format($total_price, 2, '.', ',') . '/-';
                $total_price = $selected_currency_icon . moneyFormatIndia($total_price) . '/-';

                $mod_of_payment = $all_order_data['mod_of_payment'];
                if ($mod_of_payment == 1)
                {
                    $mod_of_payment = 'Prepaid';
                }
                else
                {
                    $mod_of_payment = 'COD';
                }

                $html_message .= '<tr>
                                
                                <td>
                                  <a href="' . $base_url_uploads . 'product/size_large/' . $all_order_data['photo1'] . '" data-popup="lightbox">
                                    <img src="' . $base_url_uploads . 'product/size_small/' . $all_order_data['photo1'] . '" class="img-preview" alt="' . $all_order_data['product_name'] . '">
                                  </a>
                                </td>
                                <td>
                                  <b class="text-semibold no-margin-top"><a href="' . $base_url . 'edit-listings/' . $product_seo_url . '">' . $product_title . '</a></b>
                                  <ul class="list list-unstyled">';

                if ($all_order_data['variant_one'] != '')
                {
                    $html_message .= '<li style="margin-top: 0;"><span class="text-semibold">Variant one: ' . $all_order_data['variant_one'] . '</span>';

                    if ($all_order_data['variant_two'] != '')
                    {
                        $html_message .= '<br><span class="text-semibold">Variant two: ' . $all_order_data['variant_two'] . '</span>';
                    }
                }

                $html_message .= '
                                  </ul>
                                </td>
                                <td>
                                  <ul class="list list-unstyled">
                                     <li style="margin-top: 0px;"><span class="text-semibold">Qty:</span> &nbsp;' . $all_order_data['quantity'] . '</li>';

                if ($coupon_discount)
                {
                    $html_message .= '
                                     <li style="margin-top: 0px;"><span class="text-semibold">Coupon Discount : </span> ' . $selected_currency_icon . ' ' . moneyFormatIndia($coupon_discount) . '</li>';

                }
                $html_message .= '
                                     <li style="margin-top: 0px;"><span class="text-semibold">Price : </span> ' . $selected_currency_icon . ' ' . moneyFormatIndia($price) . '</li>';

                $html_message .= '
                                  </ul>
                                </td>
                                <td>
                                  <ul class="list list-unstyled">
                                     <li style="margin-top: 0px;"><span class="text-semibold">Total : </span> ' . $total_price . '</li>
                                     <li style="margin-top: 0px;"><span class="text-semibold">Payment Type:</span> ' . $mod_of_payment . '</li>
                                  </ul>
                                </td>';


                if ($order_return_status != '')
                {
                    $row_id = $all_order_data['user_order_table_id'];
                    if ($order_return_status == ReturnOrderStatus::RETURN_PENDING)
                    {
                        $html_message .= '
                                <td width="100px">
                                     <select class=" select form-control" id="pending_return_' . $i . '" name="pending_return_' . $i . '" onchange="validate_return_reason(this.value, \'' . $i . '\')">
                                        <option value="' . ReturnOrderStatus::RETURN_PENDING . '">Pending</option>
                                        <option value="' . ReturnOrderStatus::RETURN_ACCEPTED . '">Accept</option>
                                        <option value="' . ReturnOrderStatus::RETURN_REJECTED . '">Reject</option>
                                     </select>
                                     <br/>
                                     <input type="text" class="form-control" id="pending_return_reason_' . $i . '" name="pending_return_reason_' . $i . '" placeholder="Enter Reason" data-parsley-required="false" style="display:none;">
                                     <input type="hidden" name="pending_row_id_' . $i . '" id="pending_row_id_' . $i . '" value="' . $row_id . '">
                                     <input type="hidden" name="order_id" id="order_id" value="' . $all_order_data['order_id'] . '">
                                     <input type="hidden" name="order_total_product" id="order_total_product" value="' . $all_order_data['total_product'] . '">
                                     <input type="hidden" name="update_order_status" id="update_order_status" value="7">
                                </td>
                             ';
                    }
                    else if ($order_return_status == ReturnOrderStatus::RETURN_ACCEPTED)
                    {
                        $html_message .= '
                                <td width="100px">
                                     <select class="select form-control" id="accept_return_' . $i . '" name="accept_return_' . $i . '">
                                        <option value="' . ReturnOrderStatus::RETURN_ACCEPTED . '">Accept</option>
                                        <option value="' . ReturnOrderStatus::RETURN_IN_TRANSIT . '">In Transit</option>
                                     </select>
                                     <input type="hidden" name="accept_row_id_' . $i . '" id="accept_row_id_' . $i . '" value="' . $row_id . '">
                                     <input type="hidden" name="order_id" id="order_id" value="' . $all_order_data['order_id'] . '">
                                     <input type="hidden" name="order_total_product" id="order_total_product" value="' . $all_order_data['total_product'] . '">
                                     <input type="hidden" name="update_order_status" id="update_order_status" value="7">
                                </td>
                             ';
                    }
                    else if ($order_return_status == ReturnOrderStatus::RETURN_IN_TRANSIT)
                    {
                        $html_message .= '
                                <td width="100px">
                                     <select class="select form-control" id="in_transit_return_' . $i . '" name="in_transit_return_' . $i . '">
                                        <option value="' . ReturnOrderStatus::RETURN_IN_TRANSIT . '">In Transit</option>
                                        <option value="' . ReturnOrderStatus::RETURN_DELIVERED . '">Delivered</option>
                                     </select>
                                     <input type="hidden" name="in_transit_row_id_' . $i . '" id="in_transit_row_id_' . $i . '" value="' . $row_id . '">
                                     <input type="hidden" name="order_id" id="order_id" value="' . $all_order_data['order_id'] . '">
                                     <input type="hidden" name="order_total_product" id="order_total_product" value="' . $all_order_data['total_product'] . '">
                                     <input type="hidden" name="update_order_status" id="update_order_status" value="7">
                                </td>
                             ';
                    }
                    else if ($order_return_status == ReturnOrderStatus::RETURN_REJECTED)
                    {
                        $html_message .= '
                                <td width="100px">
                                     ' . $return_reject_order_reason . '
                                </td>
                             ';
                    }
                }
                $i++;
            }

            $html_message .= ' </tr>
                            </tbody>
                          </table>
                        </div>
                       
                        
                        <div style="width: 70%; padding: 2%; font-size: 13px">
                            <ul>';


            $order_status_timestamp = $all_order_data_array[0]['order_status_timestamp'];
            $order_status_timestamp_array = explode(',', $order_status_timestamp);


            foreach ($order_status_timestamp_array as $key => $order_status_timestamp)
            {
                if ($order_status_timestamp)
                {
                    $html_message .= '
                                <li>
                                    ' . $live_status_array[$key] . ' : ' . date('d-m-Y H:i:s', strtotime($order_status_timestamp)) . '
                                </li>';
                }
            }

            if ($order_status == OrderStatus::RETURN_ORDER)
            {
                $return_order_status_timestamp = $all_order_data_array[0]['return_order_status_timestamp'];
                $return_order_status_timestamp_array = explode(',', $return_order_status_timestamp);
                $html_message .= '
                            <ul>';
                foreach ($return_order_status_timestamp_array as $key => $return_order_status_timestamp)
                {
                    if ($return_order_status_timestamp)
                    {
                        $html_message .= '
                                <li>
                                    ' . $return_status_array[$key] . ' : ' . date('d-m-Y H:i:s', strtotime($return_order_status_timestamp)) . '
                                </li>';
                    }
                }
                $html_message .= '
                            </ul>';
            }

            $html_message .= '
                            </ul>
                        </div>
                      </div>
                   </div>
                </div>
              </div>
           </form>';
            $return["html_message"] = $html_message;
            $return["status"] = "success";
            echo json_encode($return);
        }
        else
        {
            $return["html_message"] = 'Order does not exists..!';
            $return["status"] = "error";
            echo json_encode($return);
        }
    }
    else
    {
        $return["html_message"] = 'Some Error Occured! Please try again.';
        $return["status"] = "error";
        echo json_encode($return);
    }
}
else
{
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'logout">';
}
?>