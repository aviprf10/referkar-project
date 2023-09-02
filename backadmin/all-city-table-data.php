<?php
include('common/config.php');
include "common/check_login.php";
if ($admin == 1 || ($sub_admin == 1 && $is_city_read == 1))
{
	$requestData= $_REQUEST;
//    echo $requestData;
	$columns = array( 
		0 =>'ci.id',
		1 =>'ci.city_name',
		2 =>'s.state_name',
		3 =>'c.country_name',
		4 =>'ci.status',
		5 =>'ci.id',
	);

	$custom_query = "";
	$custom_filter = "ci.is_deleted = 0  and ci.state_id BETWEEN 1 and 41";

	if (Secure1($db_mysqli, $requestData['search_city']) != '')
	{
		$search_value = Secure1($db_mysqli, $requestData['search_city']);
		$custom_filter .= " and ci.city_name LIKE '%" . $search_value . "%'";
	}
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
	$order_by = "order by ".$columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir'];
	
//	$get_state_query = "select * from state where $custom_filter $order_by LIMIT $limit_start,$limit_end";
	$get_city_query = "SELECT
					  ci.*,
					  s.state_name,
					  c.country_name,
					  c.id AS country_id
					FROM cities ci INNER JOIN states s ON ci.state_id = s.id
					  INNER JOIN country c ON s.country_id = c.id 
					  where $custom_filter $order_by LIMIT $limit_start,$limit_end";

	$result_get_city_query = mysqli_query($db_mysqli,$get_city_query);

	$count_get_city_query = "SELECT
					  ci.*,
					  s.state_name,
					  c.country_name,
					  c.id AS country_id
					FROM cities ci INNER JOIN states s ON ci.state_id = s.id
					  INNER JOIN country c ON s.country_id = c.id 
					  where $custom_filter";
	$result_count_get_city_query = mysqli_query($db_mysqli,$count_get_city_query);
	$total_data = mysqli_num_rows($result_count_get_city_query);

	$all_city_data_array = array();
	while ($row_get_city_query = mysqli_fetch_assoc($result_get_city_query))
	{
		$all_city_data_array[] = $row_get_city_query;
	}
	
	$data = array();
	if(count($all_city_data_array)>0)
	{
		foreach ($all_city_data_array as $all_city_data)
		{
			$row_id = $all_city_data['id'];
			$city_title = $all_city_data['city_name'];
			$state_title = $all_city_data['state_name'];
			$country_title = $all_city_data['country_name'];
			$status = $all_city_data['status'];
			
			$nestedData = array(); 
			$nestedData[] = $row_id;
			$nestedData[] = $city_title;
			$nestedData[] = $state_title;
			$nestedData[] = $country_title;

			if($status == '1')
			{
				$nestedData[] = '<span class="label label-success">Active</span>';
			}
			else
			{
				$nestedData[] = '<span class="label label-danger">Inactive</span>';
			}
			if($admin == 1 || ($sub_admin == 1 && $is_city_write == 1)){
			$nestedData[] = '
                <center>
                    <a href="' . $base_url . 'edit-city/' . $row_id . '" title="Edit" class="tooltip_class" data-popup="tooltip"><i class="icon-pencil5 text-primary"></i></a>
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
		$nestedData[] = '';

		$nestedData[] = '
            <td valign="top" colspan="6" class="dataTables_empty">
                <center>
                    <h6><i style = "font-size: 60px;    color: #999;" class="  icon-warning22"></i></h6>
                    <h4 class="no-margin text-semibold" style = "    color: #999;"> No Records Found!</h4>
                </center>
            </td>';


		$nestedData[] = '';
		$nestedData[] = '';
		$data[] = $nestedData;
	}
   
	$json_data = array("draw"=> intval($requestData['draw'] ),"recordsTotal"=> intval( $total_data ),"recordsFiltered" => intval( $total_data ), "data"=> $data);
	echo json_encode($json_data);
}
?>