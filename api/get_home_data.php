<?php
include('common/config.php');
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $post_data = json_decode(file_get_contents("php://input"));
    $post_data_array = json_decode(json_encode($post_data), True);
    $user=0;
    $mobile_access_token = '';
    $mobile_access_token = Secure1($db_mysqli, $post_data_array['mobile_access_token']);

    $temp_cart_data_array = array();
    if($mobile_access_token!='')
    {
        $all_user_data_array = array();
        $get_user_query = "select id from user where mobile_access_token='$mobile_access_token' and is_deleted=0 and status=1";
        $result_get_user_query = mysqli_query($db_mysqli,$get_user_query);
        while ($row_get_user_query = mysqli_fetch_assoc($result_get_user_query))
        {
          $all_user_data_array[] = $row_get_user_query;
        } 
        if(isset($all_user_data_array) && count($all_user_data_array)>0)
        {
            $loggedin_user_id = $all_user_data_array[0]['id'];
            $user=1;

            $get_temp_cart_query = "select * from user_cart where user_id = '$loggedin_user_id'";
            $result_temp_cart_data = mysqli_query($db_mysqli, $get_temp_cart_query);
            while ($row_temp_cart_data = mysqli_fetch_assoc($result_temp_cart_data))
            {
                $temp_cart_data_array[] = $row_temp_cart_data;
            }
        }
    }


    $home_big_slider_data_array = array();
    $get_home_big_slider_query = "select big_image_name_mobile from home_big_slider where status='1' and is_deleted='0' order by sequence asc limit 4";
    $result_get_home_big_slider_data = mysqli_query($db_mysqli, $get_home_big_slider_query);
    while ($row_get_home_big_slider_data = mysqli_fetch_assoc($result_get_home_big_slider_data))
    {
        $slider_image = $row_get_home_big_slider_data['big_image_name_mobile'];
        if ($slider_image != '')
        {
            $slider_image = $base_url_uploads . "home-big-slider/mobile/" . $slider_image;
        }
        else
        {
            $slider_image = $base_url_images . "default/slider-default-image.png";
        }

        $row_get_home_big_slider_data['big_image_name'] = $slider_image;
        $home_big_slider_data_array[] = $row_get_home_big_slider_data;
    }


    $banner_count = 1;
    $banner_image1 = '';
    $banner_image2 = '';
    $banner_image3 = '';
    $banner_image4 = '';
    $banner_image5 = '';


    $home_offer_banner_data_array = array();
    //$get_home_offer_banner_query = "select image_name_mobile from home_offer_banner where status='1' and is_deleted='0' and id!=4";
    $get_home_offer_banner_query = "select image_name_mobile from home_offer_banner where status='1' and is_deleted='0'";
    $result_get_home_offer_banner_data = mysqli_query($db_mysqli, $get_home_offer_banner_query);
    $banner_count = 1;
    while ($row_get_home_offer_banner_data = mysqli_fetch_assoc($result_get_home_offer_banner_data))
    {
        $banner_image = $row_get_home_offer_banner_data['image_name_mobile'];
        if ($banner_image != '')
        {
            $banner_image = $base_url_uploads . "home-offer-banner/mobile/" . $banner_image;
        }
        else
        {
            $banner_image = $base_url_images . "default/banner-default-image.png";
        }
        $row_get_home_banner_data['image_name_mobile'] = $banner_image;
        if ($banner_count == 1)
        {
            $banner_image1 = $banner_image;
        }
        else if ($banner_count == 2)
        {
            $banner_image2 = $banner_image;
        }
        else if ($banner_count == 3)
        {
            $banner_image3 = $banner_image;
        }
        else if ($banner_count == 4)
        {
            $banner_image4 = $banner_image;
        }
        else if ($banner_count == 5)
        {
            $banner_image5 = $banner_image;
        }

        $banner_count++;
        //$home_banner_data_array[] = $row_get_home_banner_data;
    }



    $bg_image1 = $base_url_images . "default/bg1.jpg";
    $bg_image2 = $base_url_images . "default/bg2.jpg";
    $bg_image3 = $base_url_images . "default/bg3.jpg";



	$all_home_offer_product_variant_id_array = array();
    $new_arrival_product_id_array = array();
    $featured_product_id_array = array();
    $new_product_id_array = array();
    $best_selling_product_id_array = array();
    $get_home_offer_product_temp_query = "select * from home_offer_product where status='1'";
    $result_get_home_offer_product_temp_data = mysqli_query($db_mysqli,$get_home_offer_product_temp_query);
    while($row_get_home_offer_product_temp_data = mysqli_fetch_assoc($result_get_home_offer_product_temp_data))
    {
        $all_product_variant_id_array = explode(',',$row_get_home_offer_product_temp_data['product_variant_id']);
        if($row_get_home_offer_product_temp_data['product_variant_id'] != '')
        {    
            if($row_get_home_offer_product_temp_data['id'] == 1)
            {
                $new_arrival_product_id_array = explode(',',$row_get_home_offer_product_temp_data['product_variant_id']);
            }
            if($row_get_home_offer_product_temp_data['id'] == 2)
            {
                $featured_product_id_array = explode(',',$row_get_home_offer_product_temp_data['product_variant_id']);
                if ($row_get_home_offer_product_temp_data['offer_image_mobile'] != '')
                {
                    $bg_image2 = $base_url_uploads . "home-offer-products/mobile/" . $row_get_home_offer_product_temp_data['offer_image_mobile'];
                }
                else
                {
                    $bg_image2 = $base_url_images . "default/bg2.jpg";
                }
            }
            if($row_get_home_offer_product_temp_data['id'] == 3)
            {
                $best_selling_product_id_array = explode(',',$row_get_home_offer_product_temp_data['product_variant_id']);
                 if ($row_get_home_offer_product_temp_data['offer_image_mobile'] != '')
                {
                    $bg_image1 = $base_url_uploads . "home-offer-products/mobile/" . $row_get_home_offer_product_temp_data['offer_image_mobile'];
                }
                else
                {
                    $bg_image1 = $base_url_images . "default/bg2.jpg";
                }
            }
            if($row_get_home_offer_product_temp_data['id'] == 4)
            {
                $new_product_id_array = explode(',',$row_get_home_offer_product_temp_data['product_variant_id']);
            }
        }
        foreach($all_product_variant_id_array as $all_product_variant_id)
        {
            if($all_product_variant_id != '')
            {
                if(!in_array($all_product_variant_id,$all_home_offer_product_variant_id_array))
                {
                    $all_home_offer_product_variant_id_array[] = $all_product_variant_id;
                }
            }
            
        } 
    } 
    $all_home_offer_product_id_string = '';
    foreach($all_home_offer_product_variant_id_array as $key=>$value)
    {
        $all_home_offer_product_id_string .= $value.",";
    }
    if(strlen($all_home_offer_product_id_string)>1)
    {
        $all_home_offer_product_id_string = substr($all_home_offer_product_id_string,0,-1);
    }

    $all_home_offer_product_array = array();
    $all_new_arrival_product_data_array=array();
    $all_featured_product_data_array=array();
    $all_best_selling_product_data_array=array();

    if($all_home_offer_product_id_string != '')
    {
        $get_product_query = "select p.product_name,p.product_seo_url,p.id as product_id,p.photo1,p.status as product_status,p_v.id as product_variant_id,p_v.product_variant_name,p_v.product_variant_seo_url,p_v.variant_one,p_v.variant_two,p_v.product_qty,p_v.product_mrp,p_v.product_price,p_v.variant_status from product p left join product_variant p_v on p.id = p_v.product_id where p.status='1' and p.is_deleted='0' and p_v.variant_status='1' and p_v.id IN ($all_home_offer_product_id_string)";
        $result_get_product_data = mysqli_query($db_mysqli,$get_product_query);
        while ($row_get_product_data = mysqli_fetch_assoc($result_get_product_data))
        {
            $product_variant_id = $row_get_product_data['product_variant_id'];
            $all_home_offer_product_array[$row_get_product_data['product_variant_id']] = $row_get_product_data;
        } 

        if(count($all_home_offer_product_array)>0)
        {
            foreach ($new_arrival_product_id_array as $new_arrival_product_id)
            {
                $product_data_array=array();
                $product_id=$all_home_offer_product_array[$new_arrival_product_id]['product_id'];
                $product_seo_url=$all_home_offer_product_array[$new_arrival_product_id]['product_seo_url'];
                $product_title = $all_home_offer_product_array[$new_arrival_product_id]['product_name'];
                $variant_one = $all_home_offer_product_array[$new_arrival_product_id]['variant_one'];
                $variant_two = $all_home_offer_product_array[$new_arrival_product_id]['variant_two'];

                $product_full_title = $product_title."".$variant_one."".$variant_two;
                $product_title = $product_title."".$variant_one."".$variant_two;
                if(strlen($product_title)>=15)
                {
                $product_title = substr($product_title,0,15)."...";
                }

                $product_variant_id=$all_home_offer_product_array[$new_arrival_product_id]['product_variant_id'];
                $product_variant_seo_url=$all_home_offer_product_array[$new_arrival_product_id]['product_variant_seo_url'];
                


                $is_wishlisted=0;
                if($user == 1)
                {
                    if(in_array($new_arrival_product_id, $wishlist_array))
                    {
                        $is_wishlisted=1;
                    }
                }    


                $product_image1=$all_home_offer_product_array[$new_arrival_product_id]['photo1'];
                if($product_image1 != '')
                {
                $product_image1=$base_url_uploads."product/size_medium/".$product_image1;
                }
                else
                {
                    $product_image1=$base_url_images."default/product-default-image.jpg";
                } 
               
                $product_data_array['product_title']=$product_title;
                $product_data_array['product_variant_seo_url']=$all_home_offer_product_array[$new_arrival_product_id]['product_variant_seo_url'];
                $product_data_array['product_image1']=$product_image1;
                $product_data_array['product_mrp']=$all_home_offer_product_array[$new_arrival_product_id]['product_mrp'];
                $product_data_array['product_price']=$all_home_offer_product_array[$new_arrival_product_id]['product_price'];
                $product_data_array['is_wishlisted']=$is_wishlisted;
                $all_new_arrival_product_data_array[]=$product_data_array;
            }

            foreach ($featured_product_id_array as $featured_product_id)
            {
                $product_data_array=array();
                $product_id=$all_home_offer_product_array[$featured_product_id]['product_id'];
                $product_title = $all_home_offer_product_array[$featured_product_id]['product_name'];
                $variant_one = $all_home_offer_product_array[$featured_product_id]['variant_one'];
                $variant_two = $all_home_offer_product_array[$featured_product_id]['variant_two'];

                $product_full_title = $product_title."".$variant_one."".$variant_two;
                $product_title = $product_title."".$variant_one."".$variant_two;
                if(strlen($product_title)>=15)
                {
                $product_title = substr($product_title,0,15)."...";
                }

                $product_variant_id=$all_home_offer_product_array[$featured_product_id]['product_variant_id'];
                $product_variant_seo_url=$all_home_offer_product_array[$featured_product_id]['product_variant_seo_url'];
                

                $is_wishlisted=0;
                if($user == 1)
                {
                    if(in_array($featured_product_id, $wishlist_array))
                    {
                        $is_wishlisted=1;
                    }
                }    


                $product_image1=$all_home_offer_product_array[$featured_product_id]['photo1'];
                if($product_image1 != '')
                {
                $product_image1=$base_url_uploads."product/size_medium/".$product_image1;
                }
                else
                {
                    $product_image1=$base_url_images."default/product-default-image.jpg";
                } 
  

                $product_data_array['product_title']=$product_title;
                $product_data_array['product_variant_seo_url']=$all_home_offer_product_array[$featured_product_id]['product_variant_seo_url'];
                $product_data_array['product_image1']=$product_image1;
                $product_data_array['product_mrp']=$all_home_offer_product_array[$featured_product_id]['product_mrp'];
                $product_data_array['product_price']=$all_home_offer_product_array[$featured_product_id]['product_price'];
                $product_data_array['is_wishlisted']=$is_wishlisted;
                $all_featured_product_data_array[]=$product_data_array;

            }

            foreach ($best_selling_product_id_array as $best_selling_product_id)
            {
                $product_data_array=array();
                $product_id=$all_home_offer_product_array[$best_selling_product_id]['product_id'];
                $product_seo_url=$all_home_offer_product_array[$best_selling_product_id]['product_seo_url'];
                $product_title = $all_home_offer_product_array[$best_selling_product_id]['product_name'];
                $variant_one = $all_home_offer_product_array[$best_selling_product_id]['variant_one'];
                $variant_two = $all_home_offer_product_array[$best_selling_product_id]['variant_two'];

                $product_full_title = $product_title."".$variant_one."".$variant_two;
                $product_title = $product_title."".$variant_one."".$variant_two;
                if(strlen($product_title)>=15)
                {
                $product_title = substr($product_title,0,15)."...";
                }

                $product_variant_id=$all_home_offer_product_array[$best_selling_product_id]['product_variant_id'];
                $product_variant_seo_url=$all_home_offer_product_array[$best_selling_product_id]['product_variant_seo_url'];
                

                $is_wishlisted=0;
                if($user == 1)
                {
                    if(in_array($best_selling_product_id, $wishlist_array))
                    {
                        $is_wishlisted=1;
                    }
                }    


                $product_image1=$all_home_offer_product_array[$best_selling_product_id]['photo1'];
                if($product_image1 != '')
                {
                $product_image1=$base_url_uploads."product/size_medium/".$product_image1;
                }
                else
                {
                    $product_image1=$base_url_images."default/product-default-image.jpg";
                } 


                $product_data_array['product_title']=$product_title;
                $product_data_array['product_variant_seo_url']=$all_home_offer_product_array[$best_selling_product_id]['product_variant_seo_url'];
                $product_data_array['product_image1']=$product_image1;
                $product_data_array['product_mrp']=$all_home_offer_product_array[$best_selling_product_id]['product_mrp'];
                $product_data_array['product_price']=$all_home_offer_product_array[$best_selling_product_id]['product_price'];
                $product_data_array['is_wishlisted']=$is_wishlisted;
                $all_best_selling_product_data_array[]=$product_data_array;

            }
        }
    }


    $return["status"] = "success";
    $return["status_code"] = "200";
    $return["slider_data"] = $home_big_slider_data_array;
    $return["banner_image1"] = $banner_image1;
    $return["banner_image2"] = $banner_image2;
    $return["banner_image3"] = $banner_image3;
    $return["banner_image4"] = $banner_image4;
    $return["banner_image5"] = $banner_image5;

    $return["bg_image1"] = $bg_image1;
    $return["bg_image1_color"] = '#FFF';
    $return["bg_image2"] = $bg_image2;
    $return["bg_image2_color"] = '#FFF';
    $return["bg_image3"] = $bg_image3;
    $return["bg_image3_color"] = '#FFF';

	$return["cart_items_count"] = count($temp_cart_data_array);
    $return["new_arrival_product_data"] = $all_new_arrival_product_data_array;
    $return["featured_product_data"] = $all_featured_product_data_array;
	$return["best_selling_product_data"] = $all_best_selling_product_data_array;
	echo json_encode($return);
}
?>