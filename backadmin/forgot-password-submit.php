<?php
include "common/config.php";
//include "common/check_login.php";
header('Content-type: application/json');
if ($_POST)
{
    $email = Secure1($db_mysqli, lcfirst($_POST['email']));
//    $password = md5(Secure1($db_mysqli, $_POST['password']));

    $all_user_data_array = array();
    $get_user_query = "select * from user where email='$email'";
    $result_get_user_query = mysqli_query($db_mysqli, $get_user_query);
    while ($row_get_user_query = mysqli_fetch_assoc($result_get_user_query))
    {
        $all_user_data_array[] = $row_get_user_query;
    }

    if (count($all_user_data_array) > 0)
    {
        $user_data = $all_user_data_array[0];
        if (strtolower($user_data['registered_from']) == 'facebook' || strtolower($user_data['registered_from']) == 'google_plus')
        {
            if (strtolower($user_data['registered_from']) == 'facebook')
            {
//                $return["html_message"] = 'Account is Associate with facebook. Try to signin using facebook.';
                $return["html_message"] = '
                    <div class="alert bg-danger">
						<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
						<span class="text-semibold">Oh snap!</span> Account is Associate with facebook. Try to signin using facebook.
					</div>';
                $return["status"] = "error";
                echo json_encode($return);
                exit();
            }
            else if (strtolower($user_data['registered_from']) == 'google_plus')
            {
//                $return["html_message"] = 'Account is Associate with google. Try to signin using google.';
                $return["html_message"] = '
                    <div class="alert bg-danger">
						<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
						<span class="text-semibold">Oh snap!</span> Account is Associate with google. Try to signin using google.
					</div>';
                $return["status"] = "error";
                echo json_encode($return);
                exit();
            }
            else
            {
                $return["html_message"] = ' 
				<div class="alert bg-danger">
					<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
					<span class="text-semibold">Oh snap!</span>Some Error Occured!.<a href="#" class="alert-link">Please try after some time.</a>.
				</div>';
                $return["status"] = "error";
                echo json_encode($return);
                exit();
            }
        }
        else
        {
            $unique_key = md5(uniqid(rand()));
            $current_date = _get_current_date();
            $user_id = $user_data['id'];

            $update_user_query = "update user set unique_key_forgot_password='$unique_key', forgot_password_date='$current_date' where id='$user_id'";
            $result_update_user_query = mysqli_query($db_mysqli,$update_user_query);

            $affected_rows = mysqli_affected_rows($db_mysqli);

            if($result_update_user_query)
            {
                if ($affected_rows == 0)
                {
                    $return["html_message"] = 'Nothing Updated by user.';
                    $return["status"] = "success";
                    echo json_encode($return);
                    exit();
                }
                $user_name = $user_data['first_name'] . " " . $user_data['last_name'];
                $user_type = $user_data['user_type'];

                $email_array = array();
                $email_array['email'] = $email;
                $email_array['user_name'] = $user_name;
                $email_array['base_url'] = $base_url;
                $email_array['unique_key'] = $unique_key;
                $email_array['user_type'] = $user_type;
                $email_array['email_type'] = 3;//Forgot Password Link
                $email_sent_response = send_email($email_array);
                if ($email_sent_response == 1)
                {
                    $return["html_message"] = '
					<div class="alert bg-success">
						<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
						<span class="text-semibold">Well done!</span> Please check your email for password recovery link.
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
						<span class="text-semibold">Oh snap!</span> Some Error Occured!.<a href="#" class="alert-link">Please try after some time.</a>.
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
					<span class="text-semibold">Oh snap!</span> Some Error Occured!.<a href="#" class="alert-link">Please try after some time.</a>.
				</div>';
                $return["status"] = "error";
                echo json_encode($return);
                exit();
            }

        }
    }
    else
    {
        $return["html_message"] = ' 
		<div class="alert bg-danger">
			<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
			<span class="text-semibold">Oh snap!</span> Email id does not exist.<a href="#" class="alert-link">try submitting again</a>.
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
		<span class="text-semibold">Oh snap!</span> Some Error Occured!.<a href="#" class="alert-link">Please try after some time.</a>.
	</div>';
    $return["status"] = "error";
    echo json_encode($return);
}
?>