<?php
include "common/config.php";
//include "common/check_login.php";
header('Content-type: application/json');
if ($_POST)
{
    $unique_key = $_POST['unique_key'];
//    $email = Secure1($db_mysqli, lcfirst($_POST['email']));
//    $password = md5(Secure1($db_mysqli, $_POST['password']));

    $all_user_data_array = array();
    $get_user_query = "select * from user where unique_key_forgot_password='$unique_key'";
    $result_get_user_query = mysqli_query($db_mysqli, $get_user_query);
    while ($row_get_user_query = mysqli_fetch_assoc($result_get_user_query))
    {
        $all_user_data_array[] = $row_get_user_query;
    }

    if (count($all_user_data_array) > 0)
    {
        $user_data = $all_user_data_array[0];
        $email = $user_data['email'];
        $user_name = $user_data['first_name'].' '.$user_data['last_name'];

        $current_date = _get_current_date();
        $user_id = $user_data['id'];
        $updated_password = md5($_POST['password']);

        $update_user_query = "update user set password='$updated_password' where unique_key_forgot_password='$unique_key' AND forgot_password_date='$current_date' AND id='$user_id'";
        $result_update_user_query = mysqli_query($db_mysqli, $update_user_query);

        $affected_rows = mysqli_affected_rows($db_mysqli);

        if ($result_update_user_query)
        {
            $email_array = array();
            $email_array['email'] = $email;
            $email_array['user_name'] = $user_name;
            $email_array['email_type'] = 4;//Reset Password Success
            $email_sent_response = send_email($email_array);

            $return["html_message"] = '
					<div class="alert bg-success">
						<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
						<span class="text-semibold">Well done!</span> Password Reset Successfully..Redirecting to Login.!
				    </div>';
            $return["status"] = "success";
            echo json_encode($return);
            exit();
        }
        else
        {
            $return["html_message"] = ' 
				<div class="alert bg-danger">
					<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
					<span class="text-semibold">Oh snap!</span> Some Error Occured!. <a href="#" class="alert-link">Please try after some time.</a>.
				</div>';
            $return["status"] = "error";
            echo json_encode($return);
            exit();
        }


    }
    else
    {
        $return["html_message"] = ' 
		<div class="alert bg-danger">
			<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
			<span class="text-semibold">Oh snap!</span> Email id does not exist. <a href="#" class="alert-link">try submitting again</a>.
	    </div>';
        $return["status"] = "error";
        echo json_encode($return);
    }
}

else
{
    $return["html_message"] = ' 
	<div class="alert bg-danger">
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
		<span class="text-semibold">Oh snap!</span> Some Error Occured!. <a href="#" class="alert-link">Please try after some time.</a>.
	</div>';
    $return["status"] = "error";
    echo json_encode($return);
}
?>