<?php
function resize_image($source_image, $tn_w, $tn_h, $destination,$destination_folder,$quality)
{
    $info = getimagesize($source_image);
    $imgtype = image_type_to_mime_type($info[2]);
	#assuming the mime type is correct
    switch ($imgtype) {
        case 'image/jpeg':
            $source = imagecreatefromjpeg($source_image);
            break;
        case 'image/gif':
            $source = imagecreatefromgif($source_image);
            break;
        case 'image/png':
            $source = imagecreatefrompng($source_image);
            break;
        default:
            die('Invalid image type.');
    }

    #Figure out the dimensions of the image and the dimensions of the desired thumbnail
    $src_w = imagesx($source);
    $src_h = imagesy($source);
	#Do some math to figure out which way we'll need to crop the image
    #to get it proportional to the new size, then crop or adjust as needed
	$x_ratio = $tn_w / $src_w;
    $y_ratio = $tn_h / $src_h;

    if (($src_w <= $tn_w) && ($src_h <= $tn_h)) {
        /*
		$new_w = $src_w;
        $new_h = $src_h;
		*/
		
		if (($x_ratio * $src_h) < $tn_h) 
		{
			$new_h = ceil($x_ratio * $src_h);
			$new_w = $tn_w;
		} 
		else 
		{
			$new_w = ceil($y_ratio * $src_w);
			$new_h = $tn_h;
		}
	}
	elseif (($x_ratio * $src_h) < $tn_h) {
        $new_h = ceil($x_ratio * $src_h);
        $new_w = $tn_w;
    } else {
        $new_w = ceil($y_ratio * $src_w);
        $new_h = $tn_h;
    }
	
	if($imgtype == 'image/png' || $imgtype == 'image/gif')
	{
		$final = imagecreatetruecolor($tn_w, $tn_h);
		imagealphablending($final, false);
		imagesavealpha($final,true);
		$transparent = imagecolorallocatealpha($final, 255, 255, 255, 127);
		imagefilledrectangle($final, 0, 0, $tn_w, $tn_h, $transparent);
		
		$newpic = imagecreatetruecolor(round($new_w), round($new_h));
		imagealphablending($newpic, false);
		imagesavealpha($newpic,true);
		$transparent = imagecolorallocatealpha($newpic, 255, 255, 255, 127);
		imagefilledrectangle($newpic, 0, 0, $new_w, $new_h, $transparent);
		imagecopyresampled($newpic, $source, 0, 0, 0, 0, $new_w, $new_h, $src_w, $src_h);
		imagecopy($final, $newpic, (($tn_w - $new_w)/ 2), (($tn_h - $new_h) / 2), 0, 0, $new_w, $new_h);
		
		imagepng($final,$destination_folder.$destination); 
		return $destination;
    }
	else
	{
		$newpic = imagecreatetruecolor(round($new_w), round($new_h));
		imagecopyresampled($newpic, $source, 0, 0, 0, 0, $new_w, $new_h, $src_w, $src_h);
		$final = imagecreatetruecolor($tn_w, $tn_h);
		$backgroundColor = imagecolorallocate($final, 255, 255, 255);
		imagefill($final, 0, 0, $backgroundColor);
		imagecopy($final, $newpic, (($tn_w - $new_w)/ 2), (($tn_h - $new_h) / 2), 0, 0, $new_w, $new_h);
		if (imagejpeg($final, $destination_folder.$destination, $quality)) 
		{
			return $destination;
		}
	}
	return false;
}
function resize_image_without_background($source_image, $tn_w, $tn_h, $destination,$destination_folder,$quality)
{
    $info = getimagesize($source_image);
    $imgtype = image_type_to_mime_type($info[2]);
	#assuming the mime type is correct
    switch ($imgtype) {
        case 'image/jpeg':
            $source = imagecreatefromjpeg($source_image);
            break;
        case 'image/gif':
            $source = imagecreatefromgif($source_image);
            break;
        case 'image/png':
            $source = imagecreatefrompng($source_image);
            break;
        default:
            die('Invalid image type.');
    }

    #Figure out the dimensions of the image and the dimensions of the desired thumbnail
    $src_w = imagesx($source);
    $src_h = imagesy($source);
	#Do some math to figure out which way we'll need to crop the image
    #to get it proportional to the new size, then crop or adjust as needed
	$x_ratio = $tn_w / $src_w;
    $y_ratio = $tn_h / $src_h;

    if (($src_w <= $tn_w) && ($src_h <= $tn_h)) {
        /*
		$new_w = $src_w;
        $new_h = $src_h;
		*/
		
		if (($x_ratio * $src_h) < $tn_h) 
		{
			$new_h = ceil($x_ratio * $src_h);
			$new_w = $tn_w;
			
		} 
		else 
		{
			$new_w = ceil($y_ratio * $src_w);
			$new_h = $tn_h;
			
		}
	}
	elseif (($x_ratio * $src_h) < $tn_h) {
        $new_h = ceil($x_ratio * $src_h);
        $new_w = $tn_w;
		
    } else {
        $new_w = ceil($y_ratio * $src_w);
        $new_h = $tn_h;
		
    }
	
	if($imgtype == 'image/png' || $imgtype == 'image/gif')
	{
		$final = imagecreatetruecolor($new_w, $new_h);
		imagealphablending($final, false);
		imagesavealpha($final,true);
		$transparent = imagecolorallocatealpha($final, 255, 255, 255, 127);
		imagefilledrectangle($final, 0, 0, $new_w, $new_h, $transparent);
		
		$newpic = imagecreatetruecolor(round($new_w), round($new_h));
		imagealphablending($newpic, false);
		imagesavealpha($newpic,true);
		$transparent = imagecolorallocatealpha($newpic, 255, 255, 255, 127);
		imagefilledrectangle($newpic, 0, 0, $new_w, $new_h, $transparent);
		imagecopyresampled($newpic, $source, 0, 0, 0, 0, $new_w, $new_h, $src_w, $src_h);
		imagecopy($final, $newpic, 0, 0, 0, 0, $new_w, $new_h);
		
		imagepng($final,$destination_folder.$destination); 
		return $destination;
    }
	else
	{
		$newpic = imagecreatetruecolor(round($new_w), round($new_h));
		imagecopyresampled($newpic, $source, 0, 0, 0, 0, $new_w, $new_h, $src_w, $src_h);
		$final = imagecreatetruecolor($new_w, $new_h);
		$backgroundColor = imagecolorallocate($final, 255, 255, 255);
		imagefill($final, 0, 0, $backgroundColor);
		imagecopy($final, $newpic, 0, 0, 0, 0, $new_w, $new_h);
		if (imagejpeg($final, $destination_folder.$destination, $quality)) 
		{
			return $destination;
		}
	}
	return false;
}

?>
