<?php
include('common/config.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$fb_id = '';
	$fb_verify = '';
	$google_id = '';
	$google_verify = '';
    $registered_from = '';
	$mobile = '';

	$post_data = json_decode(file_get_contents("php://input"));
	$post_data_array = json_decode(json_encode($post_data), True);
    $registered_from = Secure1($db_mysqli, $post_data_array['form_data']['registered_from']);
    if ($registered_from == 'facebook')
    {
        $fb_id = $_POST['data']['id'];
        $fb_verify = 1;
        $first_name = ucfirst(Secure1($db_mysqli, $post_data_array['form_data']['first_name']));
        $last_name = ucfirst(Secure1($db_mysqli, $post_data_array['form_data']['last_name']));
        $user_name = $first_name . ' ' . $last_name;
        $user_unique_slug=$user_name;
        $email =  Secure1($db_mysqli, strtolower($post_data_array['form_data']['email']));
        $gender = Secure1($db_mysqli, $post_data_array['form_data']['gender']);
    }
    else if ($registered_from == 'google_plus')
    {
        $google_id = $_POST['data']['id'];
        $google_verify = 1;
   		$first_name = ucfirst(Secure1($db_mysqli, $post_data_array['form_data']['given_name']));
        $last_name = ucfirst(Secure1($db_mysqli, $post_data_array['form_data']['family_name']));
        $user_name = $first_name . ' ' . $last_name;
        $user_unique_slug=$user_name;
        $email =  Secure1($db_mysqli, strtolower($post_data_array['form_data']['email']));
        $gender = Secure1($db_mysqli, $post_data_array['form_data']['gender']);
    }
    else
    {
        $email = Secure1($db_mysqli, strtolower($post_data_array['form_data']['email']));
        $password = md5(Secure1($db_mysqli, $post_data_array['form_data']['password']));
        
    }
    if($post_data_array['form_data']['session_cart_data']!='')
    {
        $session_cart_data = $post_data_array['form_data']['session_cart_data'];
        $_SESSION['cart_' . $company_name_session]=$session_cart_data;
    }


    $player_id='';
    $player_id_array = json_decode($post_data_array['form_data']['player_id'], True);
    $player_id       = $player_id_array['userId'];

    if($email!='')
    {
        $all_user_data_array = array();
        $get_user_query = "select * from user where email='$email' and is_deleted=0";
        $result_get_user_query = mysqli_query($db_mysqli,$get_user_query);
        while ($row_get_user_query = mysqli_fetch_assoc($result_get_user_query))
        {
          $all_user_data_array[] = $row_get_user_query;
        } 
        if(isset($all_user_data_array) && count($all_user_data_array)>0)
        {
          $user_data = $all_user_data_array[0];
        }
        else
        {
          $user_data = array();
        }

        if(count($user_data) == 0) // If email id does not exist.
        {
            $all_user_temp_data_array=array();
            $get_user_temp_query = "select * from user_temp where (email='$email') and status = 0";
            $result_get_user_temp_query = mysqli_query($db_mysqli,$get_user_temp_query);
            while ($row_get_user_temp_query = mysqli_fetch_assoc($result_get_user_temp_query))
            {
                $all_user_temp_data_array[] = $row_get_user_temp_query;
            }
            if(isset($all_user_temp_data_array) && count($all_user_temp_data_array)==0)
            {
                if ($registered_from == 'facebook' || $registered_from == 'google_plus')
                {
                    $unique_key = md5(uniqid(rand()));
                    $ip_address = $_SERVER['REMOTE_ADDR'];
                    $created_on = date("Y-m-d H:i:s");
                    $mobile_access_token = random_code_long();
                    $mobile_token_exp_date = date('Y-m-d', strtotime('+1 years'));
                    $user_type = 2;
                   
                    $registration_date = date("Y-m-d H:i:s");
                    $result_insert_user = mysqli_query($db_mysqli, "INSERT INTO `user`(`first_name`, `last_name`, `user_name`, `user_unique_slug`, `email`, `password`, `gender`, `date_of_birth`, `mobile`, `landline_no`, `mobile_verify`, `email_verify`, `user_type`, `status`, `mobile_access_token`, `mobile_token_exp_date`, `unique_key`, `registration_date`, `fb_id`, `fb_verify`, `google_id`, `google_verify`, `registered_from`, `ip_address`, `created_on`, `is_deleted`,`player_id`) VALUES ('$first_name', '$last_name','$user_name','$user_unique_slug','$email','','$gender','','$mobile','','','1','$user_type','1','$mobile_access_token','$mobile_token_exp_date','$unique_key','$registration_date','$fb_id','$fb_verify','$google_id','$google_verify','$registered_from','$ip_address','$created_on','0','$player_id')");
                    if ($result_insert_user)
                    {
                        $user_id = mysqli_insert_id($db_mysqli);
                       /* $email_array = array();
                        $email_array['email'] = $email;
                        $email_array['user_name'] = $user_name;
                        $email_array['unique_key'] = $unique_key;
                        $email_array['registered_from'] = $registered_from;
                        $email_array['email_type'] = 1;
                        $email_sent_response = send_email($email_array);*/

                        $profile_pic_100 = $base_url_images . "default_profile.jpg";
                        $profile_pic_450 = $base_url_images . "default_profile.jpg";



                        /***** Start of updating user last login time and date *****/
                        $last_login = date('Y-m-d H:i:s');
                        $module_user = "update user set player_id='$player_id',last_login='$last_login', mobile_access_token='$mobile_access_token',mobile_token_exp_date='$mobile_token_exp_date' where id='$user_id'";
                        $result_user_query = mysqli_query($db_mysqli, $module_user);
                        /***** End of updating user last login time and date *****/


                        $temp_user_data_array = array();
                        $temp_user_data_array['id'] = $user_id;
                        //$temp_user_data_array['first_name'] = $user_data_array['first_name'];
                        //$temp_user_data_array['last_name'] = $user_data_array['last_name'];
                        $temp_user_data_array['user_name'] = $user_data_array['user_name'];
                        $temp_user_data_array['email'] = $email;
                        $temp_user_data_array['mobile'] = $mobile;
                        $temp_user_data_array['mobile_verified'] = $user_data_array['mobile_verify'];

                        /***** Start of checking user group and redirecting user  *****/







                        /* Move session cart product to database */
                        $loggedin_user_id = $user_id;
                        if(isset($session_cart_data) && (count($session_cart_data)>0)) 
                        {
                            $check_user_cart_data_array = array();
                            $get_user_cart_query = "select * from user_cart where user_id='$user_id'";
                            $result_user_cart_data = mysqli_query($db_mysqli,$get_user_cart_query);
                            while ($row_user_cart_data = mysqli_fetch_assoc($result_user_cart_data))
                            {
                                $check_user_cart_data_array[] = $row_user_cart_data;
                            } 

                            include('common/cart.php');

                            foreach($session_cart_data as $key => $value)
                            {
                                $product_id = $product_seo_url = $product_variant_id = $product_variant_seo_url = $quantity = $price = $mrp = '';

                                $product_id = $session_cart_data[$key]['product_id'];
                                $category_id = $session_cart_data[$key]['category_id'];
                                $product_seo_url = $session_cart_data[$key]['product_seo_url'];
                                $product_variant_id = $session_cart_data[$key]['product_variant_id'];
                                $product_variant_seo_url = $session_cart_data[$key]['product_variant_seo_url'];

                                $quantity = $session_cart_data[$key]['product_variant_quantity'];
                                $price = $session_cart_data[$key]['product_variant_price'];
                                $mrp = $session_cart_data[$key]['product_variant_mrp'];

                                $available_quantity = $cart_all_product_data_array[$product_variant_id]['product_qty'];

                                
                                $cart_exist = '0';
                                $cart_quantity = '0';
                                
                                if($product_id!='' && $product_variant_id!='')
                                {
                                    if(count($check_user_cart_data_array)>0) 
                                    {   
                                        foreach($check_user_cart_data_array as $check_user_cart_data)
                                        {
                                            if(($check_user_cart_data['user_id'] == $user_id) && ($check_user_cart_data['product_id'] == $product_id) && ($check_user_cart_data['product_variant_id'] == $product_variant_id))
                                            {
                                                $cart_exist = '1';
                                                $cart_quantity = $check_user_cart_data['quantity'];
                                            }
                                        }

                                        
                                            
                                        if($cart_exist == '1')
                                        {   
                                            
                                            if($quantity + $cart_quantity > $available_quantity)
                                            {
                                                $quantity = $available_quantity;
                                            }
                                            else
                                            {
                                                $quantity = $quantity + $cart_quantity;
                                            }
                                            
                                            
                                            $order_date = date('Y-m-d');
                                            $order_date_time = date('Y-m-d H:i:s');
                                            $return_user_cart_data = array();
                                            $user_cart_query = "update user_cart set quantity = '$quantity', price = '$price', mrp= '$mrp', order_date = '$order_date', order_date_time = '$order_date_time' where user_id = '$user_id' and product_id = '$product_id' and product_variant_id = '$product_variant_id'";
                                            
                                            $return_user_cart_data = mysqli_query($db_mysqli,$user_cart_query);

                                            if($return_user_cart_data)
                                            {
                                                unset($session_cart_data[$key]);
                                            }
                                        }
                                        else
                                        {
                                            
                                            if($quantity + $cart_quantity > $available_quantity)
                                            {
                                                $quantity = $available_quantity;
                                            }
                                            else
                                            {
                                                $quantity = $quantity + $cart_quantity;
                                            }
                                            
                                            
                                            $order_date = date('Y-m-d');
                                            $order_date_time = date('Y-m-d H:i:s');
                                            $insert_user_cart_query = "INSERT INTO user_cart (user_id,product_id,product_variant_id,category_id,quantity,price,mrp,order_date,order_date_time) VALUES ('$user_id','$product_id','$product_variant_id','$category_id','$quantity','$price','$mrp','$order_date','$order_date_time');";
                                            $return_user_cart_data = mysqli_query($db_mysqli,$insert_user_cart_query);

                                            if($return_user_cart_data)
                                            {
                                                //unset($session_cart_data[$key]);
                                            }
                                        }
                                    }
                                    else
                                    {
                                        if($quantity>$available_quantity)
                                        {
                                            $quantity = $available_quantity;
                                        }
                                    
                                        $order_date = date('Y-m-d');
                                        $order_date_time = date('Y-m-d H:i:s');
                                        $insert_user_cart_query = "INSERT INTO user_cart (user_id,product_id,product_variant_id,category_id,quantity,price,mrp,order_date,order_date_time) VALUES ('$user_id','$product_id','$product_variant_id','$category_id','$quantity','$price','$mrp','$order_date','$order_date_time');";
                                        $return_user_cart_data = mysqli_query($db_mysqli,$insert_user_cart_query);
                                        if($return_user_cart_data)
                                        {
                                            //unset($session_cart_data[$key]);
                                        }
                                    }  
                                } 
                                
                            }
                        }
                        $is_from_login_submit = 1;  
                        include('common/cart.php');
                        /* End of Move session cart product to database */





                        if($user_type == 2) 
                        {
                            $$return["message"] = 'Registered Successfully';
                            /*$return["user_name"] = $user_name;
                            $return["email"] = $email;
                            $return["mobile"] = $mobile;*/
                            $return["data"] = $temp_user_data_array;
                           // $return["cart_items_count"] = 0;
                            $return["status"] = "success";
                            $return["status_code"] = "200";
                            echo json_encode($return);
                            exit();
                        }
                        else
                        {
                            $return["message"] = 'Oh snap! Some Error Occured..!';
                            $return["status"] = "error";
                            $return["status_code"] = "100";
                            echo json_encode($return);
                            exit();
                        }
                        /***** End of checking user group and redirecting user  *****/
                    }
                    else
                    {
                        $return["message"] = 'Some Error Occured..Please try after some time.!';
                        $return["status"] = "error";
                        $return["status_code"] = "100";
                        echo json_encode($return);
                        exit(); 
                    }
                }
                else
                {
                    $return["message"] = 'Oh snap! Email id does not exist...!';
                    $return["status"] = "error";
                    $return["status_code"] = "100";
                    echo json_encode($return);
                    exit();
                }
            }
            else
            {
     
                $temp_user_data_array = array();
                $temp_user_data_array['email'] = $all_user_temp_data_array[0]['email'];
                $temp_user_data_array['mobile'] = $all_user_temp_data_array[0]['mobile'];
                $return["message"] = 'Please verify your mobile no..!';
                $return['mobile_verified'] = 0;
                $return["data"] = $temp_user_data_array;
                $return["status"] = "success";
                $return["status_code"] = 200;
                echo json_encode($return);
                exit();
            }
        }
        else
        {

            $valid_user = 0;
            if ($user_data['registered_from'] == 'facebook')
            {
                if ($registered_from == 'facebook')
                {
                    $valid_user = 1;
                }
                else if ($registered_from == 'google_plus')
                {
                    $return["message"] = 'Account is Associate with facebook. Try to sign in using facebook.';
                    $return["status"] = "error";
                    $return["status_code"] = "100";
                    echo json_encode($return);
                    exit();
                }
                else
                {
                    $return["message"] = 'Account is Associate with facebook. Try to sign in using facebook.';
                    $return["status"] = "error";
                    $return["status_code"] = "100";
                    echo json_encode($return);
                    exit();
                }
            }
            else if ($user_data['registered_from'] == 'google_plus')
            {
                if ($registered_from == 'google_plus')
                {
                    $valid_user = 1;
                }
                else if ($registered_from == 'facebook')
                {
                    $return["message"] = 'Account is Associate with google. Try to sign in using google.';
                    $return["status"] = "error";
                    $return["status_code"] = "100";
                    echo json_encode($return);
                    exit();
                }
                else
                {
                    $return["message"] = 'Account is Associate with google. Try to sign in using google.';
                    $return["status"] = "error";
                    $return["status_code"] = "100";
                    echo json_encode($return);
                    exit();
                }
            }
            else if ($user_data['registered_from'] == '')
            {
                if ($registered_from == 'facebook' || $registered_from == 'google_plus')
                {
                    $return["message"] = 'Account is Associate with Normal login.Try to sign in using email & Password.';
                    $return["status"] = "error";
                    $return["status_code"] = "100";
                    echo json_encode($return);
                    exit();
                }
                else
                {
                    if ($user_data['email'] == $email && $user_data['password'] == $password)
                    {
                        $valid_user = 1;
                    }
                    else
                    {
                        $return["message"] = 'Oh snap! Email id & password does not match...!';
                        $return["status"] = "error";
                        $return["status_code"] = "100";
                        echo json_encode($return);
                        exit();
                    }
                }
            }
            else
            {
                $return["message"] = 'Some Error Occured..Please try after some time..!';
                $return["status"] = "error";
                $return["status_code"] = "100";
                echo json_encode($return);
                exit();
            }

            if ($valid_user == 1 && ($user_data['registered_from'] == 'facebook' || $user_data['registered_from'] == 'google_plus' || $user_data['registered_from'] == ''))
            {

                if ($user_data['status'] == 0)/***** Account is inactive. Redirect to login page with msg.*****/
                {
                    $return["message"] = 'Account is not active. Try to contact admin.';
                    $return["status"] = "error";
                    $return["status_code"] = "100";
                    echo json_encode($return);
                    exit();
                }
                else if ($user_data['status'] == 1)/***** Account is Active. *****/
                {
                    /***** Start of getting user details from db *****/

                    $user_id = $user_data['id'];
                    $mobile_access_token = random_code_long();
                    $temp_user_data_array = array();
                    $temp_user_data_array['id'] = $user_data['id'];
                    $temp_user_data_array['first_name'] = $user_data['first_name'];
                    $temp_user_data_array['last_name'] = $user_data['last_name'];
                    $temp_user_data_array['user_name'] = $user_data['user_name'];
                    $temp_user_data_array['user_unique_slug'] = $user_data['user_unique_slug'];
                    $temp_user_data_array['email'] = $user_data['email'];
                    $temp_user_data_array['gender'] = $user_data['gender'];
                    if($user_data['profile_pic'] == '')
                    {
                        $temp_user_data_array['profile_pic'] = $base_url."upload/profile_pic/size_100/default.jpg";
                    }
                    else
                    {
                        $temp_user_data_array['profile_pic'] = $base_url."upload/profile_pic/size_100/".$user_data['profile_pic'];
                    }
                    $temp_user_data_array['mobile'] = $user_data['mobile'];
                    $temp_user_data_array['user_type'] = $user_data['user_type'];
                    
                    $mobile_token_exp_date = $user_data['mobile_token_exp_date'];
                    if($mobile_token_exp_date > date('Y-m-d'))
                    {
                        $temp_user_data_array['mobile_access_token'] = $user_data['mobile_access_token'];
                        $temp_user_data_array['mobile_token_exp_date'] = $user_data['mobile_token_exp_date'];
                        $mobile_access_token = $user_data['mobile_access_token'];
                        $mobile_token_exp_date = $user_data['mobile_token_exp_date'];
                    }
                    else
                    {
                        $temp_user_data_array['mobile_access_token'] = $mobile_access_token;
                        $temp_user_data_array['mobile_token_exp_date'] = date('Y-m-d', strtotime('+1 years'));
                        $mobile_token_exp_date =  date('Y-m-d', strtotime('+1 years'));
                    }
                    
                    $temp_user_data_array['status'] = $user_data['status'];
                    $mobile_verify=0;
                    if($user_data['mobile_verify']!='')
                    {
                        $mobile_verify=$user_data['mobile_verify'];
                    }
                   
                    //$temp_user_data_array['mobile_verified'] = $user_data['mobile_verify'];
                    $user_data = $temp_user_data_array;
                    /***** End of getting user details from db. *****/




                    /***** Start of updating user last login time and date *****/
                    $last_login = date('Y-m-d H:i:s');
                    $module_user = "update user set player_id='$player_id',last_login='$last_login', mobile_access_token='$mobile_access_token',mobile_token_exp_date='$mobile_token_exp_date' where id='$user_id'";
                    $result_user_query = mysqli_query($db_mysqli, $module_user);
                    /***** End of updating user last login time and date *****/



                    /* Move session cart product to database */
                    
                    $loggedin_user_id = $user_id;
                    if(isset($session_cart_data) && (count($session_cart_data)>0)) 
                    {
                        $check_user_cart_data_array = array();
                        $get_user_cart_query = "select * from user_cart where user_id='$user_id'";
                        $result_user_cart_data = mysqli_query($db_mysqli,$get_user_cart_query);
                        while ($row_user_cart_data = mysqli_fetch_assoc($result_user_cart_data))
                        {
                            $check_user_cart_data_array[] = $row_user_cart_data;
                        } 

                        include('common/cart.php');

                        foreach($session_cart_data as $key => $value)
                        {
                            $product_id = $product_seo_url = $product_variant_id = $product_variant_seo_url = $quantity = $price = $mrp = '';

                            $product_id = $session_cart_data[$key]['product_id'];
                            $category_id = $session_cart_data[$key]['category_id'];
                            $product_seo_url = $session_cart_data[$key]['product_seo_url'];
                            $product_variant_id = $session_cart_data[$key]['product_variant_id'];
                            $product_variant_seo_url = $session_cart_data[$key]['product_variant_seo_url'];

                            $quantity = $session_cart_data[$key]['product_variant_quantity'];
                            $price = $session_cart_data[$key]['product_variant_price'];
                            $mrp = $session_cart_data[$key]['product_variant_mrp'];

                            $available_quantity = $cart_all_product_data_array[$product_variant_id]['product_qty'];

                         
                            $cart_exist = 0;
                            $cart_quantity = 0;
                            if($product_id!='' && $product_variant_id!='')
                            {
                                if(count($check_user_cart_data_array)>0) // check for update
                                {   
                                    foreach($check_user_cart_data_array as $check_user_cart_data)
                                    {
                                        if(($check_user_cart_data['user_id'] == $user_id) && ($check_user_cart_data['product_id'] == $product_id) && ($check_user_cart_data['product_variant_id'] == $product_variant_id))
                                        {
                                            $cart_exist = '1';
                                            $cart_quantity = $check_user_cart_data['quantity'];
                                        }
                                    }

                                    
                                        
                                    if($cart_exist == '1')
                                    {   
                                        /* start of quantity in cart & total available quantity */
                                        if($quantity + $cart_quantity > $available_quantity)
                                        {
                                            $quantity = $available_quantity;
                                        }
                                        else
                                        {
                                            $quantity = $quantity + $cart_quantity;
                                        }
                                        /* end of check quantity in cart and available quantity*/
                                        
                                        $order_date = date('Y-m-d');
                                        $order_date_time = date('Y-m-d H:i:s');
                                        $return_user_cart_data = array();
                                        $user_cart_query = "update user_cart set quantity = '$quantity', price = '$price', mrp= '$mrp', order_date = '$order_date', order_date_time = '$order_date_time' where user_id = '$user_id' and product_id = '$product_id' and product_variant_id = '$product_variant_id'";
                                        
                                        $return_user_cart_data = mysqli_query($db_mysqli,$user_cart_query);

                                        if($return_user_cart_data)
                                        {
                                            unset($session_cart_data[$key]);
                                        }
                                    }
                                    else
                                    {
                                        /* start of quantity in cart & total available quantity */
                                        if($quantity + $cart_quantity > $available_quantity && $available_quantity>0)
                                        {
                                            $quantity = $available_quantity;
                                        }
                                        else
                                        {
                                            $quantity = $quantity + $cart_quantity;
                                        }
                                        /* end of check quantity in cart and available quantity*/
                                      
                                   


                                        $order_date = date('Y-m-d');
                                        $order_date_time = date('Y-m-d H:i:s');
                                        $insert_user_cart_query = "INSERT INTO user_cart (user_id,product_id,product_variant_id,category_id,quantity,price,mrp,order_date,order_date_time) VALUES ('$user_id','$product_id','$product_variant_id','$category_id','$quantity','$price','$mrp','$order_date','$order_date_time');";
                                        $return_user_cart_data = mysqli_query($db_mysqli,$insert_user_cart_query);

                                        if($return_user_cart_data)
                                        {
                                            //unset($session_cart_data[$key]);
                                        }
                                    }
                                }
                                else
                                {

                                    if($quantity>$available_quantity)
                                    {
                                        $quantity = $available_quantity;
                                    }
                                
                                    $order_date = date('Y-m-d');
                                    $order_date_time = date('Y-m-d H:i:s');
                                    $insert_user_cart_query = "INSERT INTO user_cart (user_id,product_id,product_variant_id,category_id,quantity,price,mrp,order_date,order_date_time) VALUES ('$user_id','$product_id','$product_variant_id','$category_id','$quantity','$price','$mrp','$order_date','$order_date_time');";
                                    $return_user_cart_data = mysqli_query($db_mysqli,$insert_user_cart_query);
                                    if($return_user_cart_data)
                                    {
                                        //unset($session_cart_data[$key]);
                                    }
                                }     
                            }
 
                            
                        }
                    }
                    $is_from_login_submit = 1;  
                    include('common/cart.php');
                    /* End of Move session cart product to database */

                    if($user_data['user_type'] == 2) 
                    {
                        $return["message"] = 'Logged in Successfully';
                        $return["data"] = $user_data;
                        $return["mobile_verified"] = $mobile_verify;
                        
                        $return["cart_items_count"] =$total_user_cart_product;
                        $return["status"] = "success";
                        $return["status_code"] = "200";
                        echo json_encode($return);
                        exit();
                    }
                    else
                    {
                        $return["message"] = 'Oh snap! Some Error Occured..!';
                        $return["status"] = "error";
                        $return["status_code"] = "100";
                        echo json_encode($return);
                        exit();
                    }
                }
                else if ($user_data['status'] == 2)/***** Account is block. Redirect to login page. *****/
                {
                    $return["message"] = 'Account is Blocked..! Try to contact admin.';
                    $return["status"] = "error";
                    $return["status_code"] = "100";
                    echo json_encode($return);
                    exit();
                }
            }
            else
            {
                $return["message"] = 'Some Error Occured..Please try after some time..!';
                $return["status"] = "error";
                $return["status_code"] = "100";
                echo json_encode($return);
                exit();
            }
        }
    }
    else
    {
        $return["message"] = 'Some Error Occured..Please try after some time..!';
        $return["status"] = "error";
        $return["status_code"] = "100";
        echo json_encode($return);
        exit();
    }
}
?>