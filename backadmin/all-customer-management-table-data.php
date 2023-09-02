<?php
include "common/config.php";
include "common/check_login.php";
if ($admin == 1)
{
    //error_reporting(-1);


    $requestData = $_REQUEST;
    $columns = array(
        0 => 'id',
        1 => 'name',
        2 => 'email',
        3 => 'mobile',
        4 => 'address',
        5 => 'created_on',
        6 => 'status',
        7 => 'id',
    );

    $custom_query = "";
    $custom_filter = "is_deleted= '0' ";

    if (Secure1($db_mysqli, $requestData['search_name']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_name']);
        $custom_filter .= " and name LIKE '%" . $search_value . "%'";
    }

    if (Secure1($db_mysqli, $requestData['search_email']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_email']);
        $custom_filter .= " and email LIKE '%" . $search_value . "%'";
    }

    if (Secure1($db_mysqli, $requestData['search_mobile']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_mobile']);
        $custom_filter .= " and mobile LIKE '%" . $search_value . "%'";
    }

    if (Secure1($db_mysqli, $requestData['search_address']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_address']);
        $custom_filter .= " and address LIKE '%" . $search_value . "%'";
    }
    
    if (Secure1($db_mysqli, $requestData['search_status']) != '')
    {
        $search_status = Secure1($db_mysqli, $requestData['search_status']);
        $custom_filter .= " and status = '" . $search_status . "'";
    }

    $limit_start = $requestData['start'];
    $limit_end = $requestData['length'];
    $order_by = "order by " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'];

    $get_customer_feedback_query = "select * from customer_feedback where $custom_filter $order_by LIMIT $limit_start,$limit_end";
    $result_get_customer_feedback_query = mysqli_query($db_mysqli, $get_customer_feedback_query);

    $count_get_customer_feedback_query = "select * from customer_feedback where $custom_filter";
    $result_count_get_customer_feedback_query = mysqli_query($db_mysqli, $count_get_customer_feedback_query);
    $total_data = mysqli_num_rows($result_count_get_customer_feedback_query);

    $all_customer_feedback_data_array = array();
    while ($row_get_customer_feedback_query = mysqli_fetch_assoc($result_get_customer_feedback_query))
    {
        $all_customer_feedback_data_array[] = $row_get_customer_feedback_query;
    }


    $data = array();
    $count = 1;
    if (count($all_customer_feedback_data_array) > 0)
    {
        foreach ($all_customer_feedback_data_array as $all_customer_feedback_table_data)
        {
            $row_id     = $all_customer_feedback_table_data['id'];
            $name       = $all_customer_feedback_table_data['name'];
            $email      = $all_customer_feedback_table_data['email'];
            $mobile     = $all_customer_feedback_table_data['mobile'];
            $address    = $all_customer_feedback_table_data['address'];
            $created_on = $all_customer_feedback_table_data['created_on'];
            $status     = $all_customer_feedback_table_data['status'];

            $nestedData = array();
            $nestedData[] = $row_id;
            $nestedData[] = $name;
            $nestedData[] = $email;
            $nestedData[] = $mobile;
            $nestedData[] = $address;
            $nestedData[] = date('d-m-Y', strtotime($created_on));
            if ($status == '1')
            {
                $nestedData[] = '<span class="label label-success">Active</span>';
            }
            else
            {
                $nestedData[] = '<span class="label label-danger">Inactive</span>';
            }

            $nestedData[] = '
                <center>
                    <a onclick="delete_row(' . $row_id . ')" class="tooltip_class" title="Remove" data-popup="tooltip"><i class="icon-trash text-danger "></i></a>
                </center>';

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
        $nestedData[] = '';
        $data[] = $nestedData;
    }
    $json_data = array("draw" => intval($requestData['draw']), "recordsTotal" => intval($total_data), "recordsFiltered" => intval($total_data), "data" => $data);
    echo json_encode($json_data);
}
?>
