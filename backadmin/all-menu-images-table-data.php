<?php
include('common/config.php');
include "common/check_login.php";
if ($admin == 1)
{
    $requestData = $_REQUEST;
    $columns = array(
        0 => 'pi.id',
        1 => 'pi.menu_id',
        2 => 'pi.menu_small_image',
        3 => 'pi.id'
    );

    $custom_query = "";
    $custom_filter = "pi.is_deleted = '0' ";

    if (Secure1($db_mysqli, $requestData['search_title1']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_title1']);
        $custom_filter .= " and p.menu_name LIKE '%" . $search_value . "%'";
    }
   
    if (Secure1($db_mysqli, $requestData['search_status']) != '')
    {
        $search_status = Secure1($db_mysqli, $requestData['search_status']);
        $custom_filter .= " and pi.status = '" . $search_status . "'";
    }

    $limit_start = $requestData['start'];
    $limit_end = $requestData['length'];
    $order_by = "order by " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'];

    $get_menu_images_query = "select pi.*, p.menu_name from menu_images pi LEFT JOIN menu p on pi.menu_id = p.id where $custom_filter $order_by LIMIT $limit_start,$limit_end";
    $result_get_menu_images_query = mysqli_query($db_mysqli, $get_menu_images_query);

    $count_get_menu_images_query = "select * from menu_images pi LEFT JOIN menu p on pi.menu_id = p.id where $custom_filter";
    $result_count_get_menu_images_query = mysqli_query($db_mysqli, $count_get_menu_images_query);
    $total_data = mysqli_num_rows($result_count_get_menu_images_query);

    $all_menu_images_data_array = array();
    while ($row_get_menu_images_query = mysqli_fetch_assoc($result_get_menu_images_query))
    {
        $all_menu_images_data_array[] = $row_get_menu_images_query;
    }

    $data = array();
    if (count($all_menu_images_data_array) > 0)
    {
        foreach ($all_menu_images_data_array as $all_menu_images_data)
        {
            $row_id = $all_menu_images_data['id'];
            $menu_name = $all_menu_images_data['menu_name'];
            $menu_small_images = $all_menu_images_data['menu_small_images'];
            $status = $all_menu_images_data['status'];

            $nestedData = array();
            $nestedData[] = $row_id;
            $nestedData[] = $menu_name;
            $nestedData[] = '<img src="'.$base_url_uploads.'menu-small-images/size_extra_small/'.$menu_small_images.'">';
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
                    <a href="' . $base_url . 'edit-menu-images/' . $row_id . '" title="Edit" class="tooltip_class" data-popup="tooltip"><i class="icon-pencil5 text-primary"></i></a>
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
        $nestedData[] = '
            <td valign = "top" colspan = "4" class="dataTables_empty">
                <center>
                    <h6><i style = "font-size: 60px;    color: #999;" class="  icon-warning22"></i></h6>
                    <h4 class="no-margin text-semibold" style = "color: #999;"> No Records Found!</h4>
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