<?php
$result = mysqli_query($db_mysqli, "SELECT id, category_level,parent_id, category_title,status,is_deleted FROM product_category WHERE status='1' AND is_deleted='0' ORDER BY parent_id, category_title");
// prepare special array with parent-child relations
$menuData = array(
    'items' => array(),
    'parents' => array()
);

while ($menuItem = mysqli_fetch_assoc($result))
{
    $menuData['items'][$menuItem['id']] = $menuItem;
    $menuData['parents'][$menuItem['parent_id']][] = $menuItem['id'];
}

//print_r($menuData);
//exit();
function get_category_option_value($menuData, $current_id)
{
    $category_level = $menuData['items'][$current_id]['category_level'];
    if ($category_level == 1)
    {
        $category_id = $current_id;
        return $category_id . "-0-0";
    }
    else if ($category_level == 2)
    {

        $sub_category_id = $current_id;
        $parent_category_id = $menuData['items'][$current_id]['parent_id'];
        $category_id = $menuData['items'][$parent_category_id]['id'];
        return $category_id . "-" . $sub_category_id . "-0";
    }
    else if ($category_level == 3)
    {

        $sub_sub_category_id = $current_id;
        $parent_sub_category_id = $menuData['items'][$sub_sub_category_id]['parent_id'];
        $sub_category_id = $menuData['items'][$parent_sub_category_id]['id'];

        $parent_category_id = $menuData['items'][$sub_category_id]['parent_id'];
        $category_id = $menuData['items'][$parent_category_id]['id'];

        return $category_id . "-" . $sub_category_id . "-" . $sub_sub_category_id;
    }
    else
    {
        return 0;
    }

}

//get_category_option_value($menuData, 93);
// menu builder function, parentId 0 is the root
/*
function buildMenu($parent_id, $menuData)
{
    $html = '';

    if (isset($menuData['parents'][$parent_id]))
    {
        $html = '<ul>';
        foreach ($menuData['parents'][$parent_id] as $itemId)
        {
            $html .= '<li>' . $menuData['items'][$itemId]['category_title'];

            // find childitems recursively
            $html .= buildMenu($itemId, $menuData);

            $html .= '</li>';
        }
        $html .= '</ul>';
    }

    return $html;
}
*/

function buildMenu($parent_id, $menuData, $total_dash, $edit_category_parent_id)
{
    $html = '';

    if (isset($menuData['parents'][$parent_id]))
    {

        foreach ($menuData['parents'][$parent_id] as $itemId)
        {

            if ($menuData['items'][$itemId]['status'] == '1' && $menuData['items'][$itemId]['is_deleted'] == '0')
            {
                $GLOBALS['i'] = 0;
                $level = has_parent($menuData['items'][$itemId]['id']);
                $total_dash = total_dash($level);

                if ($edit_category_parent_id != "")
                {

                    $category_option_value = get_category_option_value($menuData, $menuData['items'][$itemId]['id']);
                    if ($edit_category_parent_id == $category_option_value)
                    {
                        $html .= '<option selected="selected" value=' . $category_option_value . '>' . $total_dash . $menuData['items'][$itemId]['category_title'] . '</option>';
                    }
                    else
                    {
                        $html .= '<option value=' . $category_option_value . '>' . $total_dash . $menuData['items'][$itemId]['category_title'] . '</option>';
                    }
                }
                else
                {
                    $category_option_value = get_category_option_value($menuData, $menuData['items'][$itemId]['id']);
                    $html .= '<option value=' . $category_option_value . '>' . $total_dash . $menuData['items'][$itemId]['category_title'] . '</option>';
                }


                // find childitems recursively
                $html .= buildMenu($itemId, $menuData, $GLOBALS['i'], $edit_category_parent_id);
            }


        }

    }

    return $html;
}

function has_parent($cat_id)
{ //This function checks if the menus has childs or not
    global $db_mysqli;
    $query = mysqli_query($db_mysqli, "SELECT * FROM product_category WHERE id=$cat_id");
    while ($row_result = mysqli_fetch_array($query))
    {
        $parent_id = $row_result['parent_id'];
    }
    if ($parent_id > 0)
    {
        has_parent($parent_id);
        $GLOBALS['i'] = $GLOBALS['i'] + 1;
    }
    return $GLOBALS['i'];
}

function total_dash($level)
{
    $hash = '';
    for ($i = 1; $i <= $level; $i++)
    {
        $hash .= '----';
    }
    return $hash;
}

?>