<?php
include('common/config.php');
include "common/check_login.php";
if ($admin == 1 || ($sub_admin == 1 && $is_city_read == 1))
{
    $requestData = $_REQUEST;
    $columns = array(
        0 => 's.id',
        1 => 's.city_name',
        2 => 'c.name',
        3 => 'c.pincode',
        4 => 's.status',
        5 => 's.id'
    );

    $custom_query = "";
    $custom_filter = "s.is_deleted = '0'";

    if (Secure1($db_mysqli, $requestData['search_city']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_city']);
        $custom_filter .= " and c.search_city LIKE '%" . $search_value . "%'";
    }
    if (Secure1($db_mysqli, $requestData['search_country']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_country']);
        $custom_filter .= " and c.name LIKE '%" . $search_value . "%'";
    }
    if (Secure1($db_mysqli, $requestData['search_status']) != '')
    {
        $search_status = Secure1($db_mysqli, $requestData['search_status']);
        $custom_filter .= " and s.status = '" . $search_status . "'";
    }

    $limit_start = $requestData['start'];
    $limit_end = $requestData['length'];
    $order_by = "order by " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'];

//	$get_area_query = "select * from area where $custom_filter $order_by LIMIT $limit_start,$limit_end";
    $get_area_query = "SELECT
                      s.*,
                      c.city_name
                    FROM area s LEFT JOIN cities c ON s.city_id = c.id 
                    where $custom_filter $order_by LIMIT $limit_start,$limit_end";

    $result_get_area_query = mysqli_query($db_mysqli, $get_area_query);

//    print_r($result_get_area_query);
//    exit();
    $count_get_area_query = "SELECT
                      s.*,
                      c.city_name
                    FROM area s LEFT JOIN cities c ON s.city_id = c.id
                     where $custom_filter";
    $result_count_get_area_query = mysqli_query($db_mysqli, $count_get_area_query);
    $total_data = mysqli_num_rows($result_count_get_area_query);

    $all_area_data_array = array();
    while ($row_get_area_query = mysqli_fetch_assoc($result_get_area_query))
    {
        $all_area_data_array[] = $row_get_area_query;
    }

    $data = array();
    if (count($all_area_data_array) > 0)
    {
        foreach ($all_area_data_array as $all_area_data)
        {
            $row_id = $all_area_data['id'];
            $city_name = $all_area_data['city_name'];
            $name = $all_area_data['name'];
            $pincode = $all_area_data['pincode'];
            $status = $all_area_data['status'];

            $nestedData = array();
            $nestedData[] = $row_id;
            $nestedData[] = $name;
            $nestedData[] = $city_name;
            $nestedData[] = $pincode;

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
                    <a href="' . $base_url . 'edit-area/' . $row_id . '" title="Edit" class="tooltip_class" data-popup="tooltip"><i class="icon-pencil5 text-primary"></i></a>
                    &nbsp;&nbsp;
                    <a onclick="delete_rows(' . $row_id . ')" class="tooltip_class" title="Remove" data-popup="tooltip"><i class="icon-trash text-danger "></i></a>
                </center>';
            $data[] = $nestedData;
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
        $data[] = $nestedData;
    }

    $json_data = array("draw" => intval($requestData['draw']), "recordsTotal" => intval($total_data), "recordsFiltered" => intval($total_data), "data" => $data);
    echo json_encode($json_data);
}
?>