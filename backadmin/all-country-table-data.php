<?php
include('common/config.php');
include "common/check_login.php";
if ($admin == 1)
{
    $requestData = $_REQUEST;
    $columns = array(
        0 => 'id',
        1 => 'country_name',
        2 => 'status',
        3 => 'id'
    );

    $custom_query = "";
    $custom_filter = "is_deleted = 0 and id='101'";

    if (Secure1($db_mysqli, $requestData['search_title']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_title']);
        $custom_filter .= " and country_name LIKE '%" . $search_value . "%'";
    }
    if (Secure1($db_mysqli, $requestData['search_status']) != '')
    {
        $search_status = Secure1($db_mysqli, $requestData['search_status']);
        $custom_filter .= " and status = '" . $search_status . "'";
    }

    $limit_start = $requestData['start'];
    $limit_end = $requestData['length'];
    $order_by = "order by " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'];

    $get_country_query = "select * from country where $custom_filter $order_by LIMIT $limit_start,$limit_end";
    $result_get_country_query = mysqli_query($db_mysqli, $get_country_query);

    $count_get_country_query = "select id from country where $custom_filter";
    $result_count_get_country_query = mysqli_query($db_mysqli, $count_get_country_query);
    $total_data = mysqli_num_rows($result_count_get_country_query);

    $all_country_data_array = array();
    while ($row_get_country_query = mysqli_fetch_assoc($result_get_country_query))
    {
        $all_country_data_array[] = $row_get_country_query;
    }

    $data = array();
    if (count($all_country_data_array) > 0)
    {
        foreach ($all_country_data_array as $all_country_data)
        {
            $row_id = $all_country_data['id'];
            $country_name = $all_country_data['country_name'];
            $status = $all_country_data['status'];

            $nestedData = array();
            $nestedData[] = $row_id;
            $nestedData[] = $country_name;

            if ($status == '1')
            {
                $nestedData[] = '<span class="label label-success">Active</span>';
            }
            else
            {
                $nestedData[] = '<span class="label label-danger">Inactive</span>';
            }
              if($admin == 1 || ($sub_admin == 1 && $is_country_write == 1)){
            $nestedData[] = '
                <center>
                    <a href="' . $base_url . 'edit-country/' . $row_id . '" title="Edit" class="tooltip_class" data-popup="tooltip"><i class="icon-pencil5 text-primary"></i></a>
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
                    <h4 class="no-margin text-semibold" style = "color: #999;"> No Records Found!</h4>
                </center>
            </td>';


        $nestedData[] = '';
        $data[] = $nestedData;
    }

    $json_data = array("draw" => intval($requestData['draw']), "recordsTotal" => intval($total_data), "recordsFiltered" => intval($total_data), "data" => $data);
    echo json_encode($json_data);
}
?>