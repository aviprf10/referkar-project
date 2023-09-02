<?php
include "common/config.php";
include "common/check_login.php";
if ($admin == 1)
{
    //error_reporting(-1);

    $current_order_status = $_REQUEST['current_order_status'];
    if($current_order_status == 'new_order')
    {
        $requestData = $_REQUEST;
        $columns = array(
            0 => 'uo.id',
            1 => 'uo.order_id',
            2 => 'uo.order_date',
            3 => 'uo.user_id',
            4 => 'uo.user_id',
            5 => 'uo.product_id',
            6 => 'uo.product_id',
            7 => 'uo.quantity',
            8 => 'uo.status',
            9 => 'uo.id',
        );

        $custom_query = "";
        $custom_filter = "uo.is_deleted= '0' and (uo.order_status='0' or uo.order_status='2' or uo.order_status='6')";


        if (Secure1($db_mysqli, $requestData['search_order_id']) != '')
        {
            $search_value = Secure1($db_mysqli, $requestData['search_order_id']);
            $custom_filter .= " and uo.order_id LIKE '%" . $search_value . "%'";
        }

        if (Secure1($db_mysqli, $requestData['search_order_date']) != '')
        {
            $search_value = Secure1($db_mysqli, $requestData['search_order_date']);
            $custom_filter .= " and uo.order_date LIKE '%" . $search_value . "%'";
        }

        if (Secure1($db_mysqli, $requestData['search_user']) != '')
        {
            $search_value = Secure1($db_mysqli, $requestData['search_user']);
            $custom_filter .= " and u.user_name LIKE '%" . $search_value . "%'";
        }

        if (Secure1($db_mysqli, $requestData['search_product_name']) != '')
        {
            $search_value = Secure1($db_mysqli, $requestData['search_product_name']);
            $custom_filter .= " and p.product_name LIKE '%" . $search_value . "%'";
        }

        
        if (Secure1($db_mysqli, $requestData['search_user_mobile']) != '')
        {
            $search_value = Secure1($db_mysqli, $requestData['search_user_mobile']);
            $custom_filter .= " and u.mobile LIKE '%" . $search_value . "%'";
        }

        if (Secure1($db_mysqli, $requestData['search_product_price']) != '')
        {
            $search_value = Secure1($db_mysqli, $requestData['search_product_price']);
            $custom_filter .= " and uo.price LIKE '%" . $search_value . "%'";
        }
        
        if (Secure1($db_mysqli, $requestData['search_status']) != '')
        {
            $search_status = Secure1($db_mysqli, $requestData['search_status']);
            $custom_filter .= " and uo.status = '" . $search_status . "'";
        }

        $limit_start = $requestData['start'];
        $limit_end = $requestData['length'];
        $order_by = "order by " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'];

        $get_product_query = "select uo.id, uo.price,uo.quantity,uo.order_id, uo.order_date, uo.order_status,p.product_name, u.user_name, u.mobile from user_order uo  LEFT JOIN product p on uo.product_id = p.id LEFT JOIN user u on uo.user_id = u.id where $custom_filter group by order_id $order_by LIMIT $limit_start,$limit_end";
        $result_get_product_query = mysqli_query($db_mysqli, $get_product_query);

        $count_get_product_query = "select uo.price,uo.quantity,uo.order_id, uo.order_date, uo.order_status,p.product_name, u.user_name, u.mobile from user_order uo  LEFT JOIN product p on uo.product_id = p.id LEFT JOIN user u on uo.user_id = u.id where $custom_filter group by order_id";
        $result_count_get_product_query = mysqli_query($db_mysqli, $count_get_product_query);
        $total_data = mysqli_num_rows($result_count_get_product_query);

        $all_product_data_array = array();
        while ($row_get_product_query = mysqli_fetch_assoc($result_get_product_query))
        {
            $all_product_data_array[] = $row_get_product_query;
        }

    }
    else if($current_order_status == 'returned_order')
    {
        $requestData = $_REQUEST;
        $columns = array(
            0 => 'uo.id',
            1 => 'uo.order_id',
            2 => 'uo.order_date',
            3 => 'uo.user_id',
            4 => 'uo.user_id',
            5 => 'uo.product_id',
            6 => 'uo.product_id',
            7 => 'uo.quantity',
            8 => 'uo.status',
            9 => 'uo.id',
        );

        $custom_query = "";
        $custom_filter = "uo.is_deleted= '0' and uo.order_status='7'";


        if (Secure1($db_mysqli, $requestData['search_order_id']) != '')
        {
            $search_value = Secure1($db_mysqli, $requestData['search_order_id']);
            $custom_filter .= " and uo.order_id LIKE '%" . $search_value . "%'";
        }

        if (Secure1($db_mysqli, $requestData['search_order_date']) != '')
        {
            $search_value = Secure1($db_mysqli, $requestData['search_order_date']);
            $custom_filter .= " and uo.order_date LIKE '%" . $search_value . "%'";
        }

        if (Secure1($db_mysqli, $requestData['search_user']) != '')
        {
            $search_value = Secure1($db_mysqli, $requestData['search_user']);
            $custom_filter .= " and u.user_name LIKE '%" . $search_value . "%'";
        }

        if (Secure1($db_mysqli, $requestData['search_product_name']) != '')
        {
            $search_value = Secure1($db_mysqli, $requestData['search_product_name']);
            $custom_filter .= " and p.product_name LIKE '%" . $search_value . "%'";
        }

        
        if (Secure1($db_mysqli, $requestData['search_user_mobile']) != '')
        {
            $search_value = Secure1($db_mysqli, $requestData['search_user_mobile']);
            $custom_filter .= " and u.mobile LIKE '%" . $search_value . "%'";
        }

        if (Secure1($db_mysqli, $requestData['search_product_price']) != '')
        {
            $search_value = Secure1($db_mysqli, $requestData['search_product_price']);
            $custom_filter .= " and uo.price LIKE '%" . $search_value . "%'";
        }
        
        if (Secure1($db_mysqli, $requestData['search_status']) != '')
        {
            $search_status = Secure1($db_mysqli, $requestData['search_status']);
            $custom_filter .= " and uo.status = '" . $search_status . "'";
        }

        $limit_start = $requestData['start'];
        $limit_end = $requestData['length'];
        $order_by = "order by " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'];

        $get_product_query = "select uo.id, uo.price,uo.quantity,uo.order_id, uo.order_date, uo.order_status,p.product_name, u.user_name, u.mobile from user_order uo  LEFT JOIN product p on uo.product_id = p.id LEFT JOIN user u on uo.user_id = u.id where $custom_filter group by order_id $order_by LIMIT $limit_start,$limit_end";
        $result_get_product_query = mysqli_query($db_mysqli, $get_product_query);

        $count_get_product_query = "select uo.price,uo.quantity,uo.order_id, uo.order_date, uo.order_status,p.product_name, u.user_name, u.mobile from user_order uo  LEFT JOIN product p on uo.product_id = p.id LEFT JOIN user u on uo.user_id = u.id where $custom_filter group by order_id";
        $result_count_get_product_query = mysqli_query($db_mysqli, $count_get_product_query);
        $total_data = mysqli_num_rows($result_count_get_product_query);

        $all_product_data_array = array();
        while ($row_get_product_query = mysqli_fetch_assoc($result_get_product_query))
        {
            $all_product_data_array[] = $row_get_product_query;
        }

    }
    else if($current_order_status == 'rejected_order')
    {
        $requestData = $_REQUEST;
        $columns = array(
            0 => 'uo.id',
            1 => 'uo.order_id',
            2 => 'uo.order_date',
            3 => 'uo.user_id',
            4 => 'uo.user_id',
            5 => 'uo.product_id',
            6 => 'uo.product_id',
            7 => 'uo.quantity',
            8 => 'uo.status',
            9 => 'uo.id',
        );

        $custom_query = "";
        $custom_filter = "uo.is_deleted= '0' and (uo.order_status='8' or uo.order_status='9')";


        if (Secure1($db_mysqli, $requestData['search_order_id']) != '')
        {
            $search_value = Secure1($db_mysqli, $requestData['search_order_id']);
            $custom_filter .= " and uo.order_id LIKE '%" . $search_value . "%'";
        }

        if (Secure1($db_mysqli, $requestData['search_order_date']) != '')
        {
            $search_value = Secure1($db_mysqli, $requestData['search_order_date']);
            $custom_filter .= " and uo.order_date LIKE '%" . $search_value . "%'";
        }

        if (Secure1($db_mysqli, $requestData['search_user']) != '')
        {
            $search_value = Secure1($db_mysqli, $requestData['search_user']);
            $custom_filter .= " and u.user_name LIKE '%" . $search_value . "%'";
        }

        if (Secure1($db_mysqli, $requestData['search_product_name']) != '')
        {
            $search_value = Secure1($db_mysqli, $requestData['search_product_name']);
            $custom_filter .= " and p.product_name LIKE '%" . $search_value . "%'";
        }

        
        if (Secure1($db_mysqli, $requestData['search_user_mobile']) != '')
        {
            $search_value = Secure1($db_mysqli, $requestData['search_user_mobile']);
            $custom_filter .= " and u.mobile LIKE '%" . $search_value . "%'";
        }

        if (Secure1($db_mysqli, $requestData['search_product_price']) != '')
        {
            $search_value = Secure1($db_mysqli, $requestData['search_product_price']);
            $custom_filter .= " and uo.price LIKE '%" . $search_value . "%'";
        }
        
        if (Secure1($db_mysqli, $requestData['search_status']) != '')
        {
            $search_status = Secure1($db_mysqli, $requestData['search_status']);
            $custom_filter .= " and uo.status = '" . $search_status . "'";
        }

        $limit_start = $requestData['start'];
        $limit_end = $requestData['length'];
        $order_by = "order by " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'];

        $get_product_query = "select uo.id, uo.price,uo.quantity,uo.order_id, uo.order_date, uo.order_status,p.product_name, u.user_name, u.mobile from user_order uo  LEFT JOIN product p on uo.product_id = p.id LEFT JOIN user u on uo.user_id = u.id where $custom_filter group by order_id $order_by LIMIT $limit_start,$limit_end";
        $result_get_product_query = mysqli_query($db_mysqli, $get_product_query);

        $count_get_product_query = "select uo.price,uo.quantity,uo.order_id, uo.order_date, uo.order_status,p.product_name, u.user_name, u.mobile from user_order uo  LEFT JOIN product p on uo.product_id = p.id LEFT JOIN user u on uo.user_id = u.id where $custom_filter group by order_id";
        $result_count_get_product_query = mysqli_query($db_mysqli, $count_get_product_query);
        $total_data = mysqli_num_rows($result_count_get_product_query);

        $all_product_data_array = array();
        while ($row_get_product_query = mysqli_fetch_assoc($result_get_product_query))
        {
            $all_product_data_array[] = $row_get_product_query;
        }

    }


    $data = array();
    $count = 1;
    if (!empty($all_product_data_array))
    {
        foreach ($all_product_data_array as $all_product_table_data)
        {
            $row_id = $all_product_table_data['id'];
            $order_id = $all_product_table_data['order_id'];
            $order_date = date('d-m-Y', strtotime($all_product_table_data['order_date']));
            $user_name = $all_product_table_data['user_name'];
            $mobile = $all_product_table_data['mobile'];
            $product_name = $all_product_table_data['product_name'];
            $price = $all_product_table_data['price'];
            $quantity= $all_product_table_data['quantity'];
            $order_status = $all_product_table_data['order_status'];

            $nestedData = array();
            $nestedData[] = $row_id;

        
            $nestedData[] = $order_id;
            $nestedData[] = $order_date;
            $nestedData[] = $user_name;
            $nestedData[] = $mobile;
            $nestedData[] = $product_name;
            $nestedData[] = $price;
            $nestedData[] = $quantity;
            
            if ($order_status == '0')
            {
                $status_html_message = ' <span class="label label-primary"> In Process </span> ';
            }
            else if ($order_status == '1')
            {
                $status_html_message = ' <span class="label label-warning"> To be Picked </span> ';
            }
            else if ($order_status == '2')
            {
                $status_html_message = ' <span class="label label-default"> To Dispatch </span> ';
            }
            else if ($order_status == '3')
            {
                $status_html_message = ' <span class="label label-info"> To Handover </span> ';
            }
            else if ($order_status == '4')
            {
                $status_html_message = ' <span class="label bg-blue-400"> In Transit </span> ';
            }
            else if ($order_status == '5')
            {
                $status_html_message = ' <span class="label label-default"> Manual</span> ';
            }
            else if ($order_status == '6')
            {
                $status_html_message = ' <span class="label label-success"> Delivered</span> ';
            }
            else if ($order_status == '7')
            {
                if ($order_status == ReturnOrderStatus::RETURN_PENDING)
                {
                    $status_html_message = '<span class="label label-warning">Pending</span>';
                }
                else if ($order_status == ReturnOrderStatus::RETURN_ACCEPTED)
                {
                    $status_html_message = '<span class="label label-primary">Accepted</span>';
                }
                else if ($order_status == ReturnOrderStatus::RETURN_IN_TRANSIT)
                {
                    $status_html_message = '<span class="label label-default">In Transit</span>';
                }
                else if ($order_status == ReturnOrderStatus::RETURN_DELIVERED)
                {
                    $status_html_message = '<span class="label label-success">Delivered</span>';
                }
                else if ($order_status == ReturnOrderStatus::RETURN_REJECTED)
                {
                    $status_html_message = '<span class="label label-danger">Rejected</span>';
                }
            }
            else if ($order_status == '8')
            {
                $status_html_message = ' <span class="label label-danger"> Rejected</span> ';
            }
            else if ($order_status == '9')
            {
                $status_html_message = ' <span class="label label-danger"> Cancel by Buyer </span> ';
            }
            else if ($order_status == '10')
            {
                $status_html_message = ' <span class="label label-danger"> UnDelivered</span> ';
            }
            $nestedData[] = $status_html_message ;
            
            if($current_order_status != 'rejected_order')
            {
                $nestedData[] = '
                <center>
                    <a href="' . $base_url . 'view-order/' . $order_id . '" title="View Order" class="tooltip_class" data-popup="tooltip"><i class="icon-eye text-primary"></i></a>
                    &nbsp;&nbsp;
                    <a onclick="delete_row(' . $row_id . ')" class="tooltip_class" title="Reject" data-popup="tooltip"><i class="icon-cross2 text-danger "></i></a>
                </center>';
            }
            else 
            {
                $nestedData[] = '';
            }
            

            $data[] = $nestedData;
//         $count=$count+1;
        }
    }
    else
    {
        $nestedData = array();
        $nestedData[] = '';
        $nestedData[] = '';
        $nestedData[] = '';
        $nestedData[] = '';
        $nestedData[] = '';
        $nestedData[] = '
            <td valign = "top" colspan = "4" class="dataTables_empty">
                <center>
                    <h6><i style = "font-size: 60px;    color: #999;" class="  icon-warning22"></i></h6>
                    <h4 class="no-margin text-semibold" style = "    color: #999;"> No Records Found!</h4>
                </center>
            </td>';
        $nestedData[] = '';
        $nestedData[] = '';
        $nestedData[] = '';
        $nestedData[] = '';
        $data[] = $nestedData;
    }
    $json_data = array("draw" => intval($requestData['draw']), "recordsTotal" => intval($total_data), "recordsFiltered" => intval($total_data), "data" => $data);
    echo json_encode($json_data);
    
    
}
?>
