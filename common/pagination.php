<?php
function displayPaginationBelow($db_mysqli,$per_page,$page,$page_title,$filter_array)
{
    $page_url = "?";

    if($page_title == 'wishlist')
    {
    	$loggedin_user_id = $filter_array['loggedin_user_id'];
    	$query = "select count(*) as totalCount FROM user_wishlist w LEFT JOIN product p on w.product_id = p.id WHERE w.user_id = '$loggedin_user_id' AND p.status = '1' AND p.is_deleted = '0'";
    }
    if($page_title == 'collections')
    {
    	$price_filter_query			 	= $filter_array['price_filter_query'];
    	$search_parameter_variation 	= $filter_array['search_parameter_variation'];
    	$filter_condition 				= $filter_array['filter_condition'];

    	
    	if($filter_array['request_url'] != '')
    	{
    		$request_url = $filter_array['request_url'];
    		$request_url_array = explode('collections',$request_url);
    		if(strpos($request_url_array[1], '?') !== false)
    		{	
    			if(strpos($request_url_array[1], 'page'))
    			{
    				$sub_request_url_array = explode('page',$request_url_array[1]);
    				if(substr_count($request_url_array[1], "?") > 0) 
    				{
						$page_url = $request_url_array[0]."collections".$sub_request_url_array[0];	
    				}
    				else
    				{
						$page_url = "?";
    					
    				}
    			}
    			else
    			{
    				if(substr_count($request_url_array[1], "?") > 0) 
    				{
						$page_url = $request_url_array[0]."collections".$request_url_array[1]."&";	
    				}
    				else
    				{
						$page_url = "?";
    					
    				}
    			}
    		}
    		
    	}
    	/*$query = "SELECT count(*) as totalCount,(select count(*) from product_variant p_v where p_v.product_id= p.id $search_parameter_variation) as total_variant $price_filter_query from product p $filter_condition having total_variant > 0";*/

    	$query = "SELECT
      count(*)                                                  AS totalCount,
      
    FROM product p 
     
    $filter_condition GROUP BY p.id HAVING total_variant > 0";


    }





   if ($page_title == 'collections')
	{
	    $result_count_pagination_query = mysqli_query($db_mysqli, $query);
	    $total = mysqli_num_rows($result_count_pagination_query);
	}
	else{
		$rec = mysqli_fetch_array(mysqli_query($db_mysqli,$query));
	$total = $rec['totalCount'];
	}

/*echo "<br>";
echo $total;
echo "nitin";
*/

	



    $adjacents = "2"; 

	$page = ($page == 0 ? 1 : $page);  
	$start = ($page - 1) * $per_page;								
	
	$prev = $page - 1;							
	$next = $page + 1;
    $setLastpage = ceil($total/$per_page);
	$lpm1 = $setLastpage - 1;
	
	$setPaginate = "";
	if($setLastpage > 1)
	{	
		$setPaginate .= 
		"<div class='cmsmasters_wrap_pagination'>
			<ul class='list-inline list-unstyled pagination pagination-v1'>";
	                $setPaginate .= "<span style='border: 0px;width:100px;' class='setPage' style='margin-top: 7px;'>Page $page of $setLastpage &nbsp&nbsp</span>";
			if ($setLastpage < 7 + ($adjacents * 2))
			{	
				for ($counter = 1; $counter <= $setLastpage; $counter++)
				{
					if ($counter == $page)
						$setPaginate.= "<li class='current_page_li'><a class='current_page'>$counter</a></li>";
					else
						$setPaginate.= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";					
				}
			}
			elseif($setLastpage > 5 + ($adjacents * 2))
			{
				if($page < 1 + ($adjacents * 2))		
				{
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
					{
						if ($counter == $page)
							$setPaginate.= "<li class='current_page_li'><a class='current_page'>$counter</a></li>";
						else
							$setPaginate.= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";					
					}
					$setPaginate.= "<li class='dot'>...</li>";
					$setPaginate.= "<li><a href='{$page_url}page=$lpm1'>$lpm1</a></li>";
					$setPaginate.= "<li><a href='{$page_url}page=$setLastpage'>$setLastpage</a></li>";		
				}
				elseif($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					$setPaginate.= "<li><a href='{$page_url}page=1' class='page-numbers'>1</a></li>";
					$setPaginate.= "<li><a href='{$page_url}page=2' class='page-numbers'>2</a></li>";

					$setPaginate.= "<li class='dot'>...</li>";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
					{
						if ($counter == $page)
							$setPaginate.= "<li class='current_page_li'><a class='current_page'>$counter</a></li>";
						else
							$setPaginate.= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";					
					}
					$setPaginate.= "<li class='dot'>..</li>";
					$setPaginate.= "<li><a href='{$page_url}page=$lpm1'>$lpm1</a></li>";
					$setPaginate.= "<li><a href='{$page_url}page=$setLastpage'>$setLastpage</a></li>";		
				}
				else
				{
					$setPaginate.= "<li><a href='{$page_url}page=1' class='page-numbers'>1</a></li>";
					$setPaginate.= "<li><a href='{$page_url}page=2' class='page-numbers'>2</a></li>";
					$setPaginate.= "<li class='dot'>..</li>";
					for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++)
					{
						if ($counter == $page)
							$setPaginate.= "<li class='current_page_li'><a class='current_page page-numbers'>$counter</a></li>";
						else
							$setPaginate.= "<li><a href='{$page_url}page=$counter' class='page-numbers'>$counter</a></li>";					
					}
				}
			}
			
			if ($page < $counter - 1){ 
				if($prev!=0)
				{
				$setPaginate.= "<li style='border: 0px;' class='prev'><a href='{$page_url}page=$prev'>Prev</a></li>";
				}
				$setPaginate.= "<li style='border: 0px;' class='next'><a href='{$page_url}page=$next'>Next</a></li>";
				
	            $setPaginate.= "<li style='border: 0px;' class='next'><a href='{$page_url}page=$setLastpage'>Last</a></li>";
			}
			else
			{
				if($prev!=0)
				{
				$setPaginate.= "<li class='next'><a class='current_page' href='{$page_url}page=$prev'>Prev</a></li>";
				}
				//$setPaginate.= "<li class='next'><a class='current_page'>Next</a></li>";
	            //$setPaginate.= "<li class='next'><a class='current_page'>Last</a></li>";
	        }

			$setPaginate.= "
			</ul>
		</div>\n";		
	}


    return $setPaginate;
} 
?>