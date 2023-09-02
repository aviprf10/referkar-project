<?php
if($lazy_loading_catalog == 1)
{
   $query_params = $_POST;
   $pageLimit = $query_params['last_id'];
   $last_id = $query_params['last_id'];
   $setLimit = 12;
   $page_category_id=$query_params['cat_id'];
   $page_sub_category_id=$query_params['sub_cat_id'];
   $page_sub_sub_category_id=$query_params['sub_sub_cat_id'];  
}


$view_type = 1;
if(isset($query_params['view_type']) && Secure1($db_mysqli,$query_params['view_type']) != '' && Secure1($db_mysqli,$query_params['view_type']) != 'undefined') 
{
   $view_type = Secure1($db_mysqli,$query_params['view_type']);
}

$search_parameter_variation = '';
$search_parameter_variation .= ' and p_v.variant_status=1  and p_v.is_deleted=0';
if (($query_params['min_price'] != '' && $query_params['min_price'] != 'undefined') || ($query_params['max_price'] != '' && $query_params['max_price'] != 'undefined') ) 
{  
   $min_price_filter1 = Secure1($db_mysqli,$query_params['min_price']);
   $product_min_price = Secure1($db_mysqli,$query_params['min_price']);
   $product_max_price = Secure1($db_mysqli,$query_params['max_price']); 
   $max_price_filter1 = Secure1($db_mysqli,$query_params['max_price']); 
   if($product_max_price == 0)
   {
      $search_parameter_variation .= " and p_v.product_price >= $product_min_price";
   }
   else
   {
      if($product_min_price > 0 && $product_max_price >0)
      {
         $search_parameter_variation .= " and p_v.product_price >= $product_min_price and p_v.product_price <= $product_max_price";
      }
   }
}



$discount_value = '';
if (isset($query_params['discount'])) 
{
   $discount_array = explode("-",Secure1($db_mysqli,$query_params['discount']));
   $min_discount = $discount_array[0];
   $max_discount = $discount_array[1];
   $discount_value = $min_discount.'-'.$max_discount;
   if($max_discount == 0)
   {
      $search_parameter_variation .= " and p_v.discount_per >= $min_discount";
   }
   else
   {
      $search_parameter_variation .= " and p_v.discount_per >= $min_discount and p_v.discount_per <= $max_discount";
   }
}

$filter_condition = '';
$filter_condition = "where p.status=1  and p.is_deleted=0";
if (isset($query_params['brand']) && Secure1($db_mysqli,$query_params['brand']) != '') 
{
   $product_selected_brand = Secure1($db_mysqli,$query_params['brand']);
   if($product_selected_brand!='undefined')
   {
      $selected_brand_id=$brand_slug_wise_data_array[$product_selected_brand]['id'];
      if($selected_brand_id!='')
      {
         $filter_condition .= " and p.brand_id = $selected_brand_id";
      }
   }
}

if (isset($page_category_id) && $page_category_id > 0) 
{
   $filter_condition .= " and p.category_id =".$page_category_id;
}  
if (isset($page_sub_category_id) && $page_sub_category_id > 0) 
{
   $filter_condition .= " and p.sub_category_id =".$page_sub_category_id;
}
if (isset($page_sub_sub_category_id) && $page_sub_sub_category_id > 0) 
{
   $filter_condition .= " and p.sub_sub_category_id =".$page_sub_sub_category_id;
}
if (isset($query_params['q']) && Secure1($db_mysqli,$query_params['q']) != '' && Secure1($db_mysqli,$query_params['q']) != 'undefined') 
{
   $q = '%'.Secure1($db_mysqli,$query_params['q']).'%';
   $filter_condition .= " and p.product_name  LIKE '".$q."'";
}


$sort_by = '0';
if (isset($query_params['sort_by']) && Secure1($db_mysqli,$query_params['sort_by']) != '') 
{
   $sort_by = Secure1($db_mysqli,$query_params['sort_by']);
   $sort_by_title = '';
   $sort_by_asc_dsc = '';
   if($sort_by == 1)
   {
      $sort_by_title = 'p.id';
      $sort_by_asc_dsc = 'Desc';
   }
   else if($sort_by == 4)
   {
      $sort_by_title = 'p.product_name';
      $sort_by_asc_dsc = 'Asc';
   }
   else if($sort_by == 5)
   {
      $sort_by_title = 'p.product_name';
      $sort_by_asc_dsc = 'Desc';
   }
   if($sort_by_title != '')
   {
      $order_condition = "order by $sort_by_title $sort_by_asc_dsc";
   }
   
}
else
{
   $order_condition = "order by p.id desc";
}

$variation_order_condition = '';
$price_filter_query = '';
if (isset($query_params['sort_by']) && Secure1($db_mysqli,$query_params['sort_by']) != '') 
{
   $sort_by = Secure1($db_mysqli,$query_params['sort_by']);
   $sort_by_title = '';
   $sort_by_asc_dsc = '';
   if($sort_by == 2)
   {
      $sort_by_title = 'p_v.product_price';
      $sort_by_asc_dsc = 'Asc';
   }
   else if($sort_by == 3)
   {
      $sort_by_title = 'p_v.product_price';
      $sort_by_asc_dsc = 'Desc';
   }
   if($sort_by_title != '')
   {
      $variation_order_condition = "order by $sort_by_title $sort_by_asc_dsc";
      $order_condition = "order by product_price $sort_by_asc_dsc";
   }
   
   $price_filter_query = ",(SELECT p_v.product_price FROM product_variant p_v WHERE p_v.product_id = p.id and p_v.variant_status=1  and p_v.is_deleted=0 ORDER BY p_v.product_price $sort_by_asc_dsc LIMIT 1) AS product_price";
}


$product_group_id_array = array();
$temp_product_data_array = array();
$product_data_array = array();
$all_product_id_array = array();
$product_query = "SELECT p.*,bm.brand_title,(select count(*) from product_variant p_v where p_v.product_id= p.id $search_parameter_variation) as total_variant $price_filter_query from product p  left join brand_master bm on bm.id=p.brand_id  $filter_condition having total_variant > 0  $order_condition limit $pageLimit , $setLimit";

$product_group_id_array = array();
$temp_product_data_array = array();
$product_data_array = array();
$all_product_id_array = array();

$res_product_data = mysqli_query($db_mysqli,$product_query);
while($row_product_data = mysqli_fetch_assoc($res_product_data))
{
   $product_id = $row_product_data['id'];
   $all_product_id_array[] = $row_product_data['id'];
   $temp_product_data_array[] = $row_product_data;
}


$all_product_id_string = '';
if(count($all_product_id_array) > 0)
{
   foreach($all_product_id_array as $key=>$value)
   {
      $all_product_id_string .= $value.",";
   }
   if(strlen($all_product_id_string) > 1)
   {
      $all_product_id_string = substr($all_product_id_string,0,-1);
   }

   $product_variant_query = "SELECT * from product_variant as p_v where p_v.product_id IN ($all_product_id_string) $search_parameter_variation $variation_order_condition";
   $product_variant_data_array = array();
   $res_product_variant_data = mysqli_query($db_mysqli,$product_variant_query);
   while($row_product_variant_data1 = mysqli_fetch_assoc($res_product_variant_data))
   {
      $product_variant_data_array[] = $row_product_variant_data1;
   }
   foreach($temp_product_data_array as $temp_product_data)
   {
      $current_product_id = $temp_product_data['id'];
      $current_product_variant_array = array();
      foreach($product_variant_data_array as $product_variant_data)
      {
         if($product_variant_data['product_id'] == $current_product_id)
         {
            $current_product_variant_array[] = $product_variant_data;
         }
      }
      
      $current_product_data = array();
      $current_product_data = $temp_product_data;
      $current_product_data['Product_Variant'] = $current_product_variant_array;
      $product_data_array[] = $current_product_data;
   }
}
?>