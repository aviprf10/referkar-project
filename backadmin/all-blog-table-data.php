<?php
include "common/config.php";
include "common/check_login.php";
if ($admin == 1)
{
    //error_reporting(-1);


    $requestData = $_REQUEST;
    $columns = array(
        0 => 'b.id',
        1 => 'b.blog_name',
        2 => 'b.category_id',
        1 => 'b.service_id',
        2 => 'b.description',
        3 => 'b.status',
        4 => 'b.id',
    );

    $custom_query = "";
    $custom_filter = "b.is_deleted= '0' ";


    if (Secure1($db_mysqli, $requestData['search_blog']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_blog']);
        $custom_filter .= " and b.blog_name LIKE '%" . $search_value . "%'";
    }

    if (Secure1($db_mysqli, $requestData['search_description']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_description']);
        $custom_filter .= " and b.sort_description LIKE '%" . $search_value . "%'";
    }

    if (Secure1($db_mysqli, $requestData['search_category']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_category']);
        $custom_filter .= " and c.category_name LIKE '%" . $search_value . "%'";
    }

    if (Secure1($db_mysqli, $requestData['search_service']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_service']);
        $custom_filter .= " and c.service_name LIKE '%" . $search_value . "%'";
    }
    
    if (Secure1($db_mysqli, $requestData['search_status']) != '')
    {
        $search_status = Secure1($db_mysqli, $requestData['search_status']);
        $custom_filter .= " and b.status = '" . $search_status . "'";
    }

    $limit_start = $requestData['start'];
    $limit_end = $requestData['length'];
    $order_by = "order by " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'];

    $get_service_query = "select b.*, s.service_name, c.category_name from blogs b LEFT JOIN service s on b.service_id = s.id LEFT JOIN category c on b.category_id = c.id where $custom_filter $order_by LIMIT $limit_start,$limit_end";
    $result_get_service_query = mysqli_query($db_mysqli, $get_service_query);

    $count_get_service_query = "select b.*, s.service_name, c.category_name from blogs b LEFT JOIN service s on b.service_id = s.id LEFT JOIN category c on b.category_id = c.id where $custom_filter";
    $result_count_get_service_query = mysqli_query($db_mysqli, $count_get_service_query);
    $total_data = mysqli_num_rows($result_count_get_service_query);

    $all_service_data_array = array();
    while ($row_get_service_query = mysqli_fetch_assoc($result_get_service_query))
    {
        $all_service_data_array[] = $row_get_service_query;
    }


    $data = array();
    $count = 1;
    if (count($all_service_data_array) > 0)
    {
        foreach ($all_service_data_array as $all_service_table_data)
        {
            $row_id = $all_service_table_data['id'];
            $blog_name = $all_service_table_data['blog_name'];
            $service_name = $all_service_table_data['service_name'];
            $category_name = $all_service_table_data['category_name'];
            $sort_description = $all_service_table_data['sort_description'];
            $blog_image = $all_service_table_data['blog_image'];
            $status = $all_service_table_data['status'];

            $nestedData = array();
            $nestedData[] = $row_id;

           
            $nestedData[] = $blog_name;
            $nestedData[] = $category_name;
            $nestedData[] = $service_name;
            $nestedData[] = $sort_description;
            $nestedData[] = '<img src="'.$base_url_uploads.'blog-images/temp_file/'.$blog_image.'" style="width:80px;">';
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
                    <a href="' . $base_url . 'edit-blog/' . $row_id . '" title="Edit" class="tooltip_class" data-popup="tooltip"><i class="icon-pencil5 text-primary"></i></a>
                    &nbsp;&nbsp;
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
        $data[] = $nestedData;
    }
    $json_data = array("draw" => intval($requestData['draw']), "recordsTotal" => intval($total_data), "recordsFiltered" => intval($total_data), "data" => $data);
    echo json_encode($json_data);
}
?>
