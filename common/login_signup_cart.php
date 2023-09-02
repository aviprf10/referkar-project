<?php
if(isset($_SESSION['cart_'.$company_name_session]) && (count($_SESSION['cart_'.$company_name_session])>0)) 
{
	$check_user_cart_data_array = array();
    $get_user_cart_query = "select * from user_cart where user_id='$user_id'";
    $result_user_cart_data = mysqli_query($db_mysqli,$get_user_cart_query);
    while ($row_user_cart_data = mysqli_fetch_assoc($result_user_cart_data))
	{
	  	$check_user_cart_data_array[] = $row_user_cart_data;
	} 

	$is_from_login_submit = 0;	
	include('common/cart.php');
	

	foreach($_SESSION['cart_'.$company_name_session] as $key => $value)
	{
		$product_id = $product_seo_url = $product_variant_id = $product_variant_seo_url = $quantity = $price = $mrp = '';

		$product_id = $_SESSION['cart_'.$company_name_session][$key]['product_id'];
		$category_id = $_SESSION['cart_'.$company_name_session][$key]['category_id'];
		$product_seo_url = $_SESSION['cart_'.$company_name_session][$key]['product_seo_url'];
		$product_variant_id = $_SESSION['cart_'.$company_name_session][$key]['product_variant_id'];
		$product_variant_seo_url = $_SESSION['cart_'.$company_name_session][$key]['product_variant_seo_url'];

		$quantity = $_SESSION['cart_'.$company_name_session][$key]['quantity'];
		$price = $_SESSION['cart_'.$company_name_session][$key]['price'];
		$mrp = $_SESSION['cart_'.$company_name_session][$key]['mrp'];

		$available_quantity = $cart_all_product_data_array[$product_variant_id]['product_qty'];

		
		$cart_exist = '0';
		$cart_quantity = '0';
		//$current_cart_data = array();
		
		if(count($check_user_cart_data_array)>0) // check for update
		{	
			foreach($check_user_cart_data_array as $check_user_cart_data)
			{
				if(($check_user_cart_data['user_id'] == $user_id) && ($check_user_cart_data['product_id'] == $product_id) && ($check_user_cart_data['product_variant_id'] == $product_variant_id))
				{
					$cart_exist = '1';
					$cart_quantity = $check_user_cart_data['quantity'];
					//$current_cart_data = $cart_data;
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
					unset($_SESSION['cart_'.$company_name_session][$key]);
				}
			}
			else
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
				$insert_user_cart_query = "INSERT INTO user_cart (user_id,product_id,product_variant_id,category_id,quantity,price,mrp,order_date,order_date_time) VALUES ('$user_id','$product_id','$product_variant_id','$category_id','$quantity','$price','$mrp','$order_date','$order_date_time');";
				$return_user_cart_data = mysqli_query($db_mysqli,$insert_user_cart_query);

				if($return_user_cart_data)
				{
					unset($_SESSION['cart_'.$company_name_session][$key]);
				}
			}
		}
		else
		{
			if($quantity > $available_quantity)
			{
				$quantity = $available_quantity;
			}
		
			$order_date = date('Y-m-d');
			$order_date_time = date('Y-m-d H:i:s');
			$insert_user_cart_query = "INSERT INTO user_cart (user_id,product_id,product_variant_id,category_id,quantity,price,mrp,order_date,order_date_time) VALUES ('$user_id','$product_id','$product_variant_id','$category_id','$quantity','$price','$mrp','$order_date','$order_date_time');";
			$return_user_cart_data = mysqli_query($db_mysqli,$insert_user_cart_query);
			if($return_user_cart_data)
			{
				unset($_SESSION['cart_'.$company_name_session][$key]);
			}
		}	
		
	}
}
?>