<?php
include('common/config.php');
include "common/check_login.php";
if ($admin == 1)
{
    $requestData = $_REQUEST;
//    echo $requestData;
    $columns = array(
        0 => 'u.id',
        1 => 'u.usercode',
        2 => 'u.user_name',
        3 => 'u.email',
        4 => 'u.gender',
        5 => 'u.mobile',
        6 => 'ul.usercode',
        7 => 'ul.user_name',
        8 => 'u.status',
        9 => 'u.id'
    );

    $custom_query = "";
    $custom_filter = "u.is_deleted = '0' and u.user_type !='1'";

    if (Secure1($db_mysqli, $requestData['search_user_name']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_user_name']);
        $custom_filter .= " and CONCAT(u.first_name,' ',u.last_name) LIKE '%" . $search_value . "%'";
    }
    if (Secure1($db_mysqli, $requestData['search_mobile']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_mobile']);
        $custom_filter .= " and u.mobile LIKE '%" . $search_value . "%'";
    }
    if (Secure1($db_mysqli, $requestData['search_email']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_email']);
        $custom_filter .= " and u.email LIKE '%" . $search_value . "%'";
    }
    if (Secure1($db_mysqli, $requestData['search_gender']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_gender']);
        $custom_filter .= " and u.gender = '" . $search_value . "'";
    }
    if (Secure1($db_mysqli, $requestData['search_status']) != '')
    {
        $search_status = Secure1($db_mysqli, $requestData['search_status']);
        $custom_filter .= " and u.status = '" . $search_status . "'";
    }
    

    $limit_start = $requestData['start'];
    $limit_end = $requestData['length'];
    $order_by = "order by " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'];

    $get_user_query = "SELECT u.id, CONCAT(u.first_name,' ',u.last_name) AS user_name, CONCAT(ul.first_name,' ',ul.last_name) AS refraluser_name, u.email, u.gender, u.mobile, u.user_type, u.status  FROM user u LEFT JOIN user ul on u.perant_id = ul.id where $custom_filter $order_by LIMIT $limit_start,$limit_end";

    $result_get_user_query = mysqli_query($db_mysqli, $get_user_query);

    $count_get_user_query = "SELECT u.id, CONCAT(u.first_name,' ',u.last_name) AS user_name, CONCAT(ul.first_name,' ',ul.last_name) AS refraluser_name, u.email, u.gender, u.mobile, u.user_type, u.status FROM user u LEFT JOIN user ul on u.perant_id = ul.id where $custom_filter";
    $result_count_get_user_query = mysqli_query($db_mysqli, $count_get_user_query);
    $total_data = mysqli_num_rows($result_count_get_user_query);

    $all_user_data_array = array();
    while ($row_get_user_query = mysqli_fetch_assoc($result_get_user_query))
    {
        $all_user_data_array[] = $row_get_user_query;
    }
    
    $data = array();
    if (count($all_user_data_array) > 0)
    {
        foreach ($all_user_data_array as $all_user_data)
        {

            $row_id = $all_user_data['id'];
            $user_name = $all_user_data['user_name'];
            $email  = $all_user_data['email'];
            $gender = $all_user_data['gender'];
            $mobile = $all_user_data['mobile'];
            $status = $all_user_data['status'];

            $nestedData = array();
            $nestedData[] = $row_id;
            $nestedData[] = $user_name;
            $nestedData[] = $email;
            $nestedData[] = $gender;
            $nestedData[] = $mobile;
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
                 <a href="' . $base_url . 'edit-user/' . $row_id . '" title="Edit" class="tooltip_class" data-popup="tooltip"><i class="icon-pencil5 text-primary"></i></a>
                    &nbsp;&nbsp;
                    <a onclick="delete_row(' . $row_id . ')" class="tooltip_class" title="Remove" data-popup="tooltip"><i class="icon-trash text-danger "></i></a>
                </center>';

            $data[] = $nestedData;
        }

//        }
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
        $data[] = $nestedData;
    }

    $json_data = array("draw" => intval($requestData['draw']), "recordsTotal" => intval($total_data), "recordsFiltered" => intval($total_data), "data" => $data);
    echo json_encode($json_data);
}
?>