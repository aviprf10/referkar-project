<?php
include('common/config.php');
include "common/check_login.php";
if ($admin == 1 || ($sub_admin == 1 && $is_state_read == 1))
{
    $requestData = $_REQUEST;
    $columns = array(
        0 => 's.id',
        1 => 's.state_name',
        2 => 'c.country_name',
        3 => 's.status',
        4 => 's.id'
    );

    $custom_query = "";
    $custom_filter = "s.is_deleted = 0 and country_id='101'";

    if (Secure1($db_mysqli, $requestData['search_state']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_state']);
        $custom_filter .= " and s.state_name LIKE '%" . $search_value . "%'";
    }
    if (Secure1($db_mysqli, $requestData['search_country']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_country']);
        $custom_filter .= " and c.country_name LIKE '%" . $search_value . "%'";
    }
    if (Secure1($db_mysqli, $requestData['search_status']) != '')
    {
        $search_status = Secure1($db_mysqli, $requestData['search_status']);
        $custom_filter .= " and s.status = '" . $search_status . "'";
    }

    $limit_start = $requestData['start'];
    $limit_end = $requestData['length'];
    $order_by = "order by " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'];

//	$get_state_query = "select * from state where $custom_filter $order_by LIMIT $limit_start,$limit_end";
    $get_state_query = "SELECT
                      s.*,
                      c.country_name
                    FROM states s LEFT JOIN country c ON s.country_id = c.id 
                    where $custom_filter $order_by LIMIT $limit_start,$limit_end";

    $result_get_state_query = mysqli_query($db_mysqli, $get_state_query);

//    print_r($result_get_state_query);
//    exit();
    $count_get_state_query = "SELECT
                      s.*,
                      c.country_name
                    FROM states s LEFT JOIN country c ON s.country_id = c.id
                     where $custom_filter";
    $result_count_get_state_query = mysqli_query($db_mysqli, $count_get_state_query);
    $total_data = mysqli_num_rows($result_count_get_state_query);

    $all_state_data_array = array();
    while ($row_get_state_query = mysqli_fetch_assoc($result_get_state_query))
    {
        $all_state_data_array[] = $row_get_state_query;
    }

    $data = array();
    if (count($all_state_data_array) > 0)
    {
        foreach ($all_state_data_array as $all_state_data)
        {
            $row_id = $all_state_data['id'];
            $state_name = $all_state_data['state_name'];
            $country_name = $all_state_data['country_name'];
            $status = $all_state_data['status'];

            $nestedData = array();
            $nestedData[] = $row_id;
            $nestedData[] = $state_name;
            $nestedData[] = $country_name;

            if ($status == '1')
            {
                $nestedData[] = '<span class="label label-success">Active</span>';
            }
            else
            {
                $nestedData[] = '<span class="label label-danger">Inactive</span>';
            }
            if($admin == 1 || ($sub_admin == 1 && $is_state_write == 1)){
            $nestedData[] = '
                <center>
                    <a href="' . $base_url . 'edit-state/' . $row_id . '" title="Edit" class="tooltip_class" data-popup="tooltip"><i class="icon-pencil5 text-primary"></i></a>
                    &nbsp;&nbsp;
                    <a onclick="delete_rows(' . $row_id . ')" class="tooltip_class" title="Remove" data-popup="tooltip"><i class="icon-trash text-danger "></i></a>
                </center>';
            }
            else
            {
                $nestedData[] = '';
            }
            $data[] = $nestedData;
        }
    }
    else
    {
        $nestedData = array();
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
        $data[] = $nestedData;
    }

    $json_data = array("draw" => intval($requestData['draw']), "recordsTotal" => intval($total_data), "recordsFiltered" => intval($total_data), "data" => $data);
    echo json_encode($json_data);
}
?>