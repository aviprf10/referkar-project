<?php
include "common/config.php";
include "common/check_login.php";
if ($admin == 1)
{
    //error_reporting(-1);


    $requestData = $_REQUEST;
    $columns = array(
        0 => 'i.id',
        1 => 'i.loan_uniquie_key',
        2 => 'i.name',
        3 => 'i.refer_name',
        4 => 'ss.sub_service_name',
        5 => 'i.loan_amount',
        6 => 'i.created_on',
        7 => 'i.loan_status',
        8 => 'i.id',
    );

    $custom_query = "";
    $custom_filter = "i.is_deleted= '0' ";


    if (Secure1($db_mysqli, $requestData['search_refernceno']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_refernceno']);
        $custom_filter .= " and i.loan_uniquie_key LIKE '%" . $search_value . "%'";
    }

    if (Secure1($db_mysqli, $requestData['search_name']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_name']);
        $custom_filter .= " and i.name LIKE '%" . $search_value . "%'";
    }

    if (Secure1($db_mysqli, $requestData['search_refer_name']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_refer_name']);
        $custom_filter .= " and i.refer_name LIKE '%" . $search_value . "%'";
    }

    if (Secure1($db_mysqli, $requestData['search_loan_type']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_loan_type']);
        $custom_filter .= " and ss.sub_service_name LIKE '%" . $search_value . "%'";
    }

    if (Secure1($db_mysqli, $requestData['search_loan_amount']) != '')
    {
        $search_value = Secure1($db_mysqli, $requestData['search_loan_amount']);
        $custom_filter .= " and i.loan_amount =" . $search_value . "";
    }

    if (Secure1($db_mysqli, $requestData['search_created_on']) != '')
    {
        $search_value = date('Y-m-d', strtorime($requestData['search_created_on']));
        $custom_filter .= " and i.created_on =" . $search_value . "";
    }


    if (Secure1($db_mysqli, $requestData['search_status']) != '')
    {
        $search_status = Secure1($db_mysqli, $requestData['search_status']);
        $custom_filter .= " and i.loan_status = '" . $search_status . "'";
    }

    $limit_start = $requestData['start'];
    $limit_end = $requestData['length'];
    $order_by = "order by " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'];

    $get_loaninquiry_query = "select i.*, ss.sub_service_name from loan_inquery i left join  sub_service ss on i.loan_type=ss.id where $custom_filter $order_by LIMIT $limit_start,$limit_end";
    $result_get_loaninquiry_query = mysqli_query($db_mysqli, $get_loaninquiry_query);

    $count_get_loaninquiry_query = "select i.*, ss.sub_service_name from loan_inquery i left join  sub_service ss on i.loan_type=ss.id where $custom_filter";
    $result_count_get_loaninquiry_query = mysqli_query($db_mysqli, $count_get_loaninquiry_query);
    $total_data = mysqli_num_rows($result_count_get_loaninquiry_query);

    $all_loaninquiry_data_array = array();
    while ($row_get_loaninquiry_query = mysqli_fetch_assoc($result_get_loaninquiry_query))
    {
        $all_loaninquiry_data_array[] = $row_get_loaninquiry_query;
    }


    $data = array();
    $count = 1;
    if (count($all_loaninquiry_data_array) > 0)
    {
        foreach ($all_loaninquiry_data_array as $all_loaninquiry_table_data)
        {

            $row_id = $all_loaninquiry_table_data['id'];
            $loan_uniquie_key = $all_loaninquiry_table_data['loan_uniquie_key'];
            $name = $all_loaninquiry_table_data['name'];
            $refer_name = $all_loaninquiry_table_data['refer_name'];
            $sub_service_name = $all_loaninquiry_table_data['sub_service_name'];
            $loan_amount = $all_loaninquiry_table_data['loan_amount'];
            $created_on = date('d-m-Y', strtotime($all_loaninquiry_table_data['created_on']));
            $loan_status = $all_loaninquiry_table_data['loan_status'];

            $nestedData = array();
            $nestedData[] = $row_id;

           
            $nestedData[] = $loan_uniquie_key;
            $nestedData[] = $name;
            $nestedData[] = $refer_name;
            $nestedData[] = $sub_service_name;
            $nestedData[] = $selected_currency_icon. $loan_amount;
            $nestedData[] = $created_on;

            if ($loan_status == '0')
            {
                $nestedData[] = '<span class="btn btn-primary">New Inquiry</span>';
            }
            else if($loan_status == '1')
            {
                $nestedData[] = '<span class="btn btn-info">Documents Pending</span>';
            }
            else if($loan_status == '2')
            {
                $nestedData[] = '<span class="btn btn-warning">Documents colleted</span>';
            }
            else if($loan_status == '3')
            {
                $nestedData[] = '<span class="btn btn-secondary">Loan Under Credit Proposal</span>';
            }
            else if($loan_status == '4')
            {
                $nestedData[] = '<span class="btn btn-dark">Loan Sanctioned</span>';
            }
            else if($loan_status == '5')
            {
                $nestedData[] = '<span class="btn btn-success">Loan Disbursed</span>';
            }
            else if($loan_status == '6')
            {
                $nestedData[] = '<span class="btn btn-success">Commission Credit Done</span>';
            }
            else
            {
                $nestedData[] = '<span class="btn btn-danger">Rejected By Admin</span>';
            }

            $nestedData[] = '
                <center>
                    <a href="' . $base_url . 'edit-loan-inquiry/' . $row_id . '" title="Edit" class="tooltip_class" data-popup="tooltip"><i class="icon-eye text-primary"></i></a>
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
        $nestedData[] = '';
        $data[] = $nestedData;
    }
    $json_data = array("draw" => intval($requestData['draw']), "recordsTotal" => intval($total_data), "recordsFiltered" => intval($total_data), "data" => $data);
    echo json_encode($json_data);
}
?>
