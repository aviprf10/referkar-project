<?php
include "common/config.php";
include "common/check_login.php";

if($admin == 1)
{
    if (isset($_POST))
    {
        $temp_location = 'uploads/product-file/';
        $source_doc_path = $temp_location . basename($_FILES['uploadfile']['name']);
        $destination_file_name = basename($_FILES['uploadfile']['name']);

        $ext = pathinfo($source_doc_path, PATHINFO_EXTENSION);
        $random_code = md5(uniqid(rand(), true));
        $destination_file_name = $random_code . "." . $ext;
        $file_size =  ($_FILES['uploadfile']['size'])/(1024*1024);
        if($file_size>10)
        {
            echo "size_error";
            exit();
        }
        
        if (file_exists($source_doc_path))
        {
            $source_doc_path = $destination_file_name;
        }
        $source_doc_path = $destination_file_name;


        if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $temp_location . $source_doc_path))
        {
            echo "success" . "$$" . $destination_file_name;
        }
        else
        {
            echo "error";
        }
    }
    else
    {
        echo "error";
    }
}
else
{
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $base_url . 'logout">';
}
?>