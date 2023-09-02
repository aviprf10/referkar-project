<?php

include "common/config.php";
header('Content-type: application/json');
if (1 == 1)
{

    if ($_POST)
    {
        $track_num = $_POST['track_num'];
        
        $get_track_query = "SELECT * from loan_inquery WHERE loan_uniquie_key ='$track_num'";
        $result_get_track_query = mysqli_query($db_mysqli, $get_track_query);
        $all_track_data_array = array();
        while ($row_get_track_query = mysqli_fetch_assoc($result_get_track_query))
        {
            $all_track_data_array[] = $row_get_track_query;
        }


        $html_message='';
        $html_message .= '
                    <div class="col-md-12"> 
                    <table class="table table-striped table-hover table-checkable dataTable no-footer ">
                    <thead style="background: #fff">
                    ';

        foreach($all_track_data_array as $all_trackdata)
        {
            $id= $all_trackdata['loan_type'];
            $get_services_query = "SELECT * from sub_service WHERE id =$id";
            $result_get_services_query = mysqli_query($db_mysqli, $get_services_query);
            $all_services_data_array = array();
            while ($row_get_services_query = mysqli_fetch_assoc($result_get_services_query))
            {
                $all_services_data_array[] = $row_get_services_query;
            }

            if($all_trackdata['loan_status'] == '0')
            {
                $status = '<button class="btn btn-primary">Pendding</button>';
            } 
            else if($all_trackdata['loan_status'] == '1')
            {
                $status = '<button class="btn btn-info">Documents Pending</button>';
            }
            else if($all_trackdata['loan_status'] == '2')
            {
                $status = '<button class="btn btn-warning">Documents colleted</button>';
            }
            else if($all_trackdata['loan_status'] == '3')
            {
                $status = '<button class="btn btn-secondary">Loan Under Credit Proposal</button>';
            }
            else if($all_trackdata['loan_status'] == '4')
            {
                $status = '<button class="btn btn-dark">Loan Sanctioned</button>';
            }
            else if($all_trackdata['loan_status'] == '5')
            {
                $status = '<button class="btn btn-success">Loan Disbursed</button>';
            }
            else if($all_trackdata['loan_status'] == '6')
            {
                $status = '<button class="btn btn-success">Payout</button>';
            }   

            $html_message .= '<tr>
                                 <th>Name</th>
                                 <td>'.$all_trackdata['name'].'</td>
                              </tr> 
                              <tr> 
                                 <th>Email</th>
                                 <td>'.$all_trackdata['email'].'</td>
                              </tr> 
                              <tr>
                                 <th>Mobile</th> 
                                 <td>'.$all_trackdata['mobile'].'</td>
                              </tr>
                              <tr> 
                                 <th>Refer Name</th> 
                                 <td>'.$all_trackdata['refer_name'].'</td>
                              </tr>
                              <tr> 
                                 <th>Refer Email</th> 
                                 <td>'.$all_trackdata['refer_email'].'</td>
                              </tr>
                              <tr>
                                 <th>Refer Mobile</th>
                                 <td>'.$all_trackdata['refer_mobile'].'</td>
                              </tr>
                              <tr>
                                <th>Loan Type</th>
                                <td>'.$all_services_data_array[0]['sub_service_name'].'</td>
                              </tr>
                              <tr>
                                <th>Amount</th>
                                <td>'.$selected_currency_icon.'&nbsp;' .$all_trackdata['loan_amount'].'</td>
                              </tr>
                              <tr>
                                <th>Inquiry Date</th>
                                <td>'.date('d-m-Y', strtotime($all_trackdata['created_on'])).'</td>
                              </tr>
                              <tr>
                                <th>Current Status</th>
                                <td>'.$status.'</td>
                              </tr>';
        }
        $html_message .= '</thead></div>';
        $return["html_message"] = $html_message;
        $return["status"] = "success";
        echo json_encode($return);
        exit();
    }
    else
    {
        $return["html_message"] = 'Some Error Occured! Please try again.';
        $return["status"] = "error";
        echo json_encode($return);
        exit();
    }
}
else
{
    $return["html_message"] = 'Please login.';
    $return["status"] = "error";
    echo json_encode($return);
    exit();
}
?>