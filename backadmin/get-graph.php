<?php
/**
 * Created by PhpStorm.
 * User: Ravi
 * Date: 05-04-2017
 * Time: 10:35 AM
 */

include "common/config.php";
include "common/check_login.php";
header('Content-type: application/json');
if ($admin == 1)
{
    if (isset($_POST))
    {
        $current_year = $_POST['year'];

        if (isset($_POST['month']))
        {
            $current_month = $_POST['month'];
        }

        $all_year_list_array = ['2015', '2016', '2017', '2018'];

        //Get list of all months in 'Jan' format
        $all_month_list_array = array();
        for ($m = 1; $m <= 12; $m++)
        {
            $all_month_list_array[] = date('M', mktime(0, 0, 0, $m, 1, date('Y')));
        }

//        $current_year = date('Y');
//        $current_month = date('m');
        if ($current_month == 0)
        {
            $current_month_abbr = date('M');
        }
        else
        {
            $current_month_abbr = date('M', mktime(0, 0, 0, $current_month, 0, 0));
        }

        $sort_name = $_POST['sort_name'];

        if ($current_month != 0)
        {
            $number_of_days_in_month = cal_days_in_month(CAL_GREGORIAN, $current_month, $current_year); // 31
            $all_days_array = array();
            for ($d = 1; $d <= $number_of_days_in_month; $d++)
            {
                $all_days_array[] = date('d', mktime(0, 0, 0, $current_month, $d, date('Y')));
            }


            if ($sort_name == 'views')
            {
                $panel_title = 'Product Views';

                if ($current_month != 12)
                {
                    $get_product_days_query = "SELECT
                          DATE_FORMAT(created_on, '%d') AS the_date,
                          COUNT(*)                            AS count
                        FROM product_views
                        WHERE created_on BETWEEN DATE_FORMAT('" . $current_year . "-" . $current_month . "-01', '%Y-%m-%d') AND DATE_FORMAT('" . $current_year . "-" . ($current_month + 1) . "-01', '%Y-%m-%d')
                        GROUP BY the_date 
                        ORDER BY created_on ASC;";
                }
                else
                {
                    $get_product_days_query = "SELECT
                          DATE_FORMAT(created_on, '%d') AS the_date,
                          COUNT(*)                            AS count
                        FROM product_views
                        WHERE created_on BETWEEN DATE_FORMAT('" . $current_year . "-" . $current_month . "-01', '%Y-%m-%d') AND DATE_FORMAT('" . ($current_year + 1) . "-01-01', '%Y-%m-%d')
                        GROUP BY the_date 
                        ORDER BY created_on ASC;";
                }
            }
            elseif ($sort_name == 'reviews')
            {
                $panel_title = 'Product Reviews';

                if ($current_month != 12)
                {
                    $get_product_days_query = "SELECT
                          DATE_FORMAT(created_on, '%d') AS the_date,
                          COUNT(*)                            AS count
                        FROM product_reviews
                        WHERE created_on BETWEEN DATE_FORMAT('" . $current_year . "-" . $current_month . "-01', '%Y-%m-%d') AND DATE_FORMAT('" . $current_year . "-" . ($current_month + 1) . "-01', '%Y-%m-%d') AND is_deleted=0 
                        GROUP BY the_date 
                        ORDER BY created_on ASC ;";
                }
                else
                {
                    $get_product_days_query = "SELECT
                          DATE_FORMAT(created_on, '%d') AS the_date,
                          COUNT(*)                            AS count
                        FROM product_reviews
                        WHERE created_on BETWEEN DATE_FORMAT('" . $current_year . "-" . $current_month . "-01', '%Y-%m-%d') AND DATE_FORMAT('" . ($current_year + 1) . "-01-01', '%Y-%m-%d') AND is_deleted=0
                        GROUP BY the_date 
                        ORDER BY created_on ASC;";
                }

            }
            elseif ($sort_name == 'orders')
            {
                $panel_title = 'Product Orders';

                if ($current_month != 12)
                {
                    $get_product_days_query = "SELECT
                          DATE_FORMAT(order_date_time, '%d') AS the_date,
                          COUNT(*)                            AS count
                        FROM user_order
                        WHERE order_date_time BETWEEN DATE_FORMAT('" . $current_year . "-" . $current_month . "-01', '%Y-%m-%d') AND DATE_FORMAT('" . $current_year . "-" . ($current_month + 1) . "-01', '%Y-%m-%d') AND is_deleted=0
                        GROUP BY the_date 
                        ORDER BY order_date_time ASC;";
                }
                else
                {
                    $get_product_days_query = "SELECT
                          DATE_FORMAT(order_date_time, '%d') AS the_date,
                          COUNT(*)                            AS count
                        FROM user_order
                        WHERE order_date_time BETWEEN DATE_FORMAT('" . $current_year . "-" . $current_month . "-01', '%Y-%m-%d') AND DATE_FORMAT('" . ($current_year + 1) . "-01-01', '%Y-%m-%d') AND is_deleted=0
                        GROUP BY the_date 
                        ORDER BY order_date_time ASC;";
                }
            }
            elseif ($sort_name == 'rejected')
            {
                $panel_title = 'Product Rejected';

                if ($current_month != 12)
                {
                    $get_product_days_query = "SELECT
                          DATE_FORMAT(order_date_time, '%d') AS the_date,
                          COUNT(*)                            AS count
                        FROM user_order
                        WHERE order_date_time BETWEEN DATE_FORMAT('" . $current_year . "-" . $current_month . "-01', '%Y-%m-%d') AND DATE_FORMAT('" . $current_year . "-" . ($current_month + 1) . "-01', '%Y-%m-%d') AND order_status='8' AND is_deleted=0
                        GROUP BY the_date 
                        ORDER BY order_date_time ASC;";
                }
                else
                {
                    $get_product_days_query = "SELECT
                          DATE_FORMAT(order_date_time, '%d') AS the_date,
                          COUNT(*)                            AS count
                        FROM user_order
                        WHERE order_date_time BETWEEN DATE_FORMAT('" . $current_year . "-" . $current_month . "-01', '%Y-%m-%d') AND DATE_FORMAT('" . ($current_year + 1) . "-01-01', '%Y-%m-%d') AND order_status='8' AND is_deleted=0
                        GROUP BY the_date 
                        ORDER BY order_date_time ASC;";
                }
            }
            elseif ($sort_name == 'cancelled')
            {
                $panel_title = 'Product Cancelled';

                if ($current_month != 12)
                {
                    $get_product_days_query = "SELECT
                          DATE_FORMAT(order_date_time, '%d') AS the_date,
                          COUNT(*)                            AS count
                        FROM user_order
                        WHERE order_date_time BETWEEN DATE_FORMAT('" . $current_year . "-" . $current_month . "-01', '%Y-%m-%d') AND DATE_FORMAT('" . $current_year . "-" . ($current_month + 1) . "-01', '%Y-%m-%d') AND order_status='9' AND is_deleted=0
                        GROUP BY the_date 
                        ORDER BY order_date_time ASC;";
                }
                else
                {
                    $get_product_days_query = "SELECT
                          DATE_FORMAT(order_date_time, '%d') AS the_date,
                          COUNT(*)                            AS count
                        FROM user_order
                        WHERE order_date_time BETWEEN DATE_FORMAT('" . $current_year . "-" . $current_month . "-01', '%Y-%m-%d') AND DATE_FORMAT('" . ($current_year + 1) . "-01-01', '%Y-%m-%d') AND order_status='9' AND is_deleted=0
                        GROUP BY the_date 
                        ORDER BY order_date_time ASC;";
                }
            }
            elseif ($sort_name == 'wishlist')
            {
                $panel_title = 'Product Wishlisted';

                if ($current_month != 12)
                {
                    $get_product_days_query = "SELECT
                          DATE_FORMAT(order_date_time, '%d') AS the_date,
                          COUNT(*)                            AS count
                        FROM user_order
                        WHERE order_date_time BETWEEN DATE_FORMAT('" . $current_year . "-" . $current_month . "-01', '%Y-%m-%d') AND DATE_FORMAT('" . $current_year . "-" . ($current_month + 1) . "-01', '%Y-%m-%d') AND order_status='7' AND is_deleted=0
                        GROUP BY the_date 
                        ORDER BY order_date_time ASC;";
                }
                else
                {
                    $get_product_days_query = "SELECT
                          DATE_FORMAT(order_date_time, '%d') AS the_date,
                          COUNT(*)                            AS count
                        FROM user_order
                        WHERE order_date_time BETWEEN DATE_FORMAT('" . $current_year . "-" . $current_month . "-01', '%Y-%m-%d') AND DATE_FORMAT('" . ($current_year + 1) . "-01-01', '%Y-%m-%d') AND order_status='7' AND is_deleted=0
                        GROUP BY the_date 
                        ORDER BY order_date_time ASC;";
                }
            }
            elseif ($sort_name == 'returned')
            {
                $panel_title = 'Product Returned';

                if ($current_month != 12)
                {
                    $get_product_days_query = "SELECT
                          DATE_FORMAT(order_date_time, '%d') AS the_date,
                          COUNT(*)                            AS count
                        FROM user_order
                        WHERE order_date_time BETWEEN DATE_FORMAT('" . $current_year . "-" . $current_month . "-01', '%Y-%m-%d') AND DATE_FORMAT('" . $current_year . "-" . ($current_month + 1) . "-01', '%Y-%m-%d') AND order_status='7' AND is_deleted=0
                        GROUP BY the_date 
                        ORDER BY order_date_time ASC;";
                }
                else
                {
                    $get_product_days_query = "SELECT
                          DATE_FORMAT(order_date_time, '%d') AS the_date,
                          COUNT(*)                            AS count
                        FROM user_order
                        WHERE order_date_time BETWEEN DATE_FORMAT('" . $current_year . "-" . $current_month . "-01', '%Y-%m-%d') AND DATE_FORMAT('" . ($current_year + 1) . "-01-01', '%Y-%m-%d') AND order_status='7' AND is_deleted=0
                        GROUP BY the_date 
                        ORDER BY order_date_time ASC;";
                }
            }
            elseif ($sort_name == 'abandoned')
            {
                $panel_title = 'Product Abandoned';

                if ($current_month != 12)
                {
                    $get_product_days_query = "SELECT
                          DATE_FORMAT(order_date_time, '%d') AS the_date,
                          COUNT(*)                            AS count
                        FROM user_cart
                        WHERE order_date_time BETWEEN DATE_FORMAT('" . $current_year . "-" . $current_month . "-01', '%Y-%m-%d') AND DATE_FORMAT('" . $current_year . "-" . ($current_month + 1) . "-01', '%Y-%m-%d')
                        GROUP BY the_date 
                        ORDER BY order_date_time ASC;";
                }
                else
                {
                    $get_product_days_query = "SELECT
                          DATE_FORMAT(order_date_time, '%d') AS the_date,
                          COUNT(*)                            AS count
                        FROM user_cart
                        WHERE order_date_time BETWEEN DATE_FORMAT('" . $current_year . "-" . $current_month . "-01', '%Y-%m-%d') AND DATE_FORMAT('" . ($current_year + 1) . "-01-01', '%Y-%m-%d')
                        GROUP BY the_date 
                        ORDER BY order_date_time ASC;";
                }
            }



            $result_product_days_query = mysqli_query($db_mysqli, $get_product_days_query);

            $all_product_days_query = array();
            $days_array = array();
            $total_count = 0;
            while ($row_get_product_days_query = mysqli_fetch_assoc($result_product_days_query))
            {
                $all_product_days_query[$row_get_product_days_query['the_date']] = $row_get_product_days_query;
                $days_array[] = $row_get_product_days_query['the_date'];
                $total_count += $row_get_product_days_query['count'];
            }

            $month_data = array();
            foreach ($all_days_array as $day)
            {
                if (in_array($day, $days_array))
                {
                    $month_data[] = $all_product_days_query[$day];
                }
                else
                {
                    $month_data[] = array(
                        "the_date" => $day,
                        "count" => 0);
                }
            }

//    print_r($year_data);
//    exit();

//        $month_wise_data = '';
//        foreach ($year_data as $month_data)
//        {
//            $month_wise_data .= '["' . $month_data['the_month'] . '",' . $month_data['count'] . '],';
//        }


            $return["month_data"] = $month_data;
            $return["panel_title"] = $panel_title;
            $return["total_count"] = $total_count;
            $return["status"] = "success";
            $return["graph_type"] = "month";
            echo json_encode($return);
            exit();
        }
        else
        {
            $twelve_months_array = array();
            for ($m = 1; $m <= 12; $m++)
            {
                $twelve_months_array[] = date('M', mktime(0, 0, 0, $m, 1, date('Y')));
            }

            if ($sort_name == 'views')
            {
                $panel_title = 'Product Views';
                $get_product_month_query = "SELECT
                      DATE_FORMAT(created_on, '%b') AS the_month,
                      COUNT(*)                      AS count
                    FROM product_views
                    WHERE created_on BETWEEN DATE_FORMAT('" . $current_year . "-01-01', '%Y-%m-%d') AND DATE_FORMAT('" . ($current_year + 1) . "-01-01', '%Y-%m-%d')
                    GROUP
                    BY the_month
                    ORDER BY created_on ASC;";
            }
            elseif ($sort_name == 'reviews')
            {
                $panel_title = 'Product Reviews';
                $get_product_month_query = "SELECT
                      DATE_FORMAT(created_on, '%b') AS the_month,
                      COUNT(*)                      AS count
                    FROM product_reviews
                    WHERE created_on BETWEEN DATE_FORMAT('" . $current_year . "-01-01', '%Y-%m-%d') AND DATE_FORMAT('" . ($current_year + 1) . "-01-01', '%Y-%m-%d') AND is_deleted=0
                    GROUP
                    BY the_month
                    ORDER BY created_on ASC;";
            }
            elseif ($sort_name == 'orders')
            {
                $panel_title = 'Product Orders';
                $get_product_month_query = "SELECT
                      DATE_FORMAT(order_date_time, '%b') AS the_month,
                      COUNT(*)                      AS count
                    FROM user_order
                    WHERE order_date_time BETWEEN DATE_FORMAT('" . $current_year . "-01-01', '%Y-%m-%d') AND DATE_FORMAT('" . ($current_year + 1) . "-01-01', '%Y-%m-%d') AND is_deleted=0
                    GROUP
                    BY the_month
                    ORDER BY order_date_time ASC;";
            }
            elseif ($sort_name == 'rejected')
            {
                $panel_title = 'Product Rejected';
                $get_product_month_query = "SELECT
                      DATE_FORMAT(order_date_time, '%b') AS the_month,
                      COUNT(*)                      AS count
                    FROM user_order
                    WHERE order_date_time BETWEEN DATE_FORMAT('" . $current_year . "-01-01', '%Y-%m-%d') AND DATE_FORMAT('" . ($current_year + 1) . "-01-01', '%Y-%m-%d') AND order_status='8' AND is_deleted=0
                    GROUP
                    BY the_month
                    ORDER BY order_date_time ASC;";
            }
            elseif ($sort_name == 'cancelled')
            {
                $panel_title = 'Product Cancelled';
                $get_product_month_query = "SELECT
                      DATE_FORMAT(order_date_time, '%b') AS the_month,
                      COUNT(*)                      AS count
                    FROM user_order
                    WHERE order_date_time BETWEEN DATE_FORMAT('" . $current_year . "-01-01', '%Y-%m-%d') AND DATE_FORMAT('" . ($current_year + 1) . "-01-01', '%Y-%m-%d') AND order_status='9' AND is_deleted=0
                    GROUP
                    BY the_month
                    ORDER BY order_date_time ASC;";
            }
            elseif ($sort_name == 'wishlist')
            {
                $panel_title = 'Product Wishlisted';
                $get_product_month_query = "SELECT
                      DATE_FORMAT(date_time, '%b') AS the_month,
                      COUNT(*)                      AS count
                    FROM user_wishlist
                    WHERE date_time BETWEEN DATE_FORMAT('" . $current_year . "-01-01', '%Y-%m-%d') AND DATE_FORMAT('" . ($current_year + 1) . "-01-01', '%Y-%m-%d')
                    GROUP
                    BY the_month
                    ORDER BY date_time ASC;";
            }
            elseif ($sort_name == 'returned')
            {
                $panel_title = 'Product Returned';
                $get_product_month_query = "SELECT
                      DATE_FORMAT(order_date_time, '%b') AS the_month,
                      COUNT(*)                      AS count
                    FROM user_order
                    WHERE order_date_time BETWEEN DATE_FORMAT('" . $current_year . "-01-01', '%Y-%m-%d') AND DATE_FORMAT('" . ($current_year + 1) . "-01-01', '%Y-%m-%d') AND order_status='7' AND is_deleted=0
                    GROUP
                    BY the_month
                    ORDER BY order_date_time ASC;";
            }
            elseif ($sort_name == 'abandoned')
            {
                $panel_title = 'Product Abandoned';
                $get_product_month_query = "SELECT
                      DATE_FORMAT(order_date_time, '%b') AS the_month,
                      COUNT(*)                      AS count
                    FROM user_cart
                    WHERE order_date_time BETWEEN DATE_FORMAT('" . $current_year . "-01-01', '%Y-%m-%d') AND DATE_FORMAT('" . ($current_year + 1) . "-01-01', '%Y-%m-%d')
                    GROUP
                    BY the_month
                    ORDER BY order_date_time ASC;";
            }


            $result_product_month_query = mysqli_query($db_mysqli, $get_product_month_query);

            $all_product_month_query = array();
            $months_array = array();
            $total_count = 0;
            while ($row_get_product_month_query = mysqli_fetch_assoc($result_product_month_query))
            {
                $all_product_month_query[$row_get_product_month_query['the_month']] = $row_get_product_month_query;
                $months_array[] = $row_get_product_month_query['the_month'];
                $total_count += $row_get_product_month_query['count'];
            }

            $year_data = array();
            foreach ($twelve_months_array as $month)
            {
                if (in_array($month, $months_array))
                {
                    $year_data[] = $all_product_month_query[$month];
                }
                else
                {
                    $year_data[] = array(
                        "the_month" => $month,
                        "count" => 0);
                }
            }

//    print_r($year_data);
//    exit();

//        $month_wise_data = '';
//        foreach ($year_data as $month_data)
//        {
//            $month_wise_data .= '["' . $month_data['the_month'] . '",' . $month_data['count'] . '],';
//        }

            $return["year_data"] = $year_data;
            $return["panel_title"] = $panel_title;
            $return["total_count"] = $total_count;
            $return["status"] = "success";
            $return["graph_type"] = "year";
            echo json_encode($return);
            exit();
        }

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

function dates_month($month, $year)
{
    $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $dates_month = array();

    for ($i = 1; $i <= $num; $i++)
    {
        $mktime = mktime(0, 0, 0, $month, $i, $year);
        $date = date("d", $mktime);
        $dates_month[$i] = $date;
    }

    return $dates_month;
}

?>
