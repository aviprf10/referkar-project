<?php
include('common/config.php');
include "common/check_login.php";
if ($admin == 1 || ($sub_admin == 1 && $is_city_read == 1))
{
    $requestData = $_REQUEST;
    $columns = array(
        0 => 's.id',
        1 => 's.menu_name',
        2 => 's.price',
        3 => 'c.name',
        4 => 's.status',
        5 => 's.id'
    );

    $custom_query = "";
    $custom_filter = "s.is_deleted = '0'";

    if (Secure1($db_mysqli, $requestData['search_menu_name']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_menu_name']);
        $custom_filter .= " and s.menu_name LIKE '%" . $search_value . "%'";
    }
    if (Secure1($db_mysqli, $requestData['search_price']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_price']);
        $custom_filter .= " and s.price LIKE '%" . $search_value . "%'";
    }
    if (Secure1($db_mysqli, $requestData['search_price']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_price']);
        $custom_filter .= " and s.price LIKE '%" . $search_value . "%'";
    }
    if (Secure1($db_mysqli, $requestData['search_area']) != '')
    {
        $search_area = Secure1($db_mysqli, $requestData['search_area']);
        $custom_filter .= " and c.name = '" . $search_area . "'";
    }

    $limit_start = $requestData['start'];
    $limit_end = $requestData['length'];
    $order_by = "order by " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'];

//	$get_menu_query = "select * from menu where $custom_filter $order_by LIMIT $limit_start,$limit_end";
    $get_menu_query = "SELECT
                      s.*,
                      c.name
                    FROM menu s LEFT JOIN area c ON s.area_id = c.id 
                    where $custom_filter $order_by LIMIT $limit_start,$limit_end";

    $result_get_menu_query = mysqli_query($db_mysqli, $get_menu_query);

//    print_r($result_get_menu_query);
//    exit();
    $count_get_menu_query = "SELECT
                      s.*,
                      c.name
                    FROM menu s LEFT JOIN area c ON s.area_id = c.id
                     where $custom_filter";
    $result_count_get_menu_query = mysqli_query($db_mysqli, $count_get_menu_query);
    $total_data = mysqli_num_rows($result_count_get_menu_query);

    $all_menu_data_array = array();
    while ($row_get_menu_query = mysqli_fetch_assoc($result_get_menu_query))
    {
        $all_menu_data_array[] = $row_get_menu_query;
    }

    $data = array();
    if (count($all_menu_data_array) > 0)
    {
        foreach ($all_menu_data_array as $all_menu_data)
        {
            $row_id = $all_menu_data['id'];
            $menu_name = $all_menu_data['menu_name'];
            $price = $all_menu_data['price'];
            $name = $all_menu_data['name'];
            $status = $all_menu_data['status'];

            $nestedData = array();
            $nestedData[] = $row_id;
            $nestedData[] = $menu_name;
            $nestedData[] = $price;
            $nestedData[] = $name;

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
                    <a href="' . $base_url . 'edit-menu/' . $row_id . '" title="Edit" class="tooltip_class" data-popup="tooltip"><i class="icon-pencil5 text-primary"></i></a>
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