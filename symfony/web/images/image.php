<?php

/**
 * @author roshan
 * @copyright 2010
 */

$conn = mysql_connect('192.168.0.108', 'root' ,"hsenidsoft");

$db=mysql_select_db('hr_mysql_common');

$id = $_GET['image_id'];

$query = "SELECT trans_image FROM  hs_hr_transfer WHERE trans_id='$id'";

$result = mysql_query($query) or die('Error, query failed');
list($content) =mysql_fetch_array($result);


$desired_width =75;

$desired_height =75;
$r=stripslashes($content);

$im = imagecreatefromstring($r);

//$new = imagecreatetruecolor($desired_width, $desired_height);


//$x = imagesx($im);

//$y = imagesy($im);


//imagecopyresampled($new, $im, 0, 0, 0, 0, $desired_width, $desired_height, $x, $y);


//imagedestroy($im);


//imagestring($im, 5, $x_offset, $y_offset, 'Elankans Automobile', $textcolor);

header('Content-type: <span class="posthilit">image</span>/jpeg');

imagejpeg($im, null, 85);
//header("Content-length: $size");
//header("Content-type: $type");
//header('Content-type: image/jpg');
//header("Content-Disposition: attachment; filename=$content");

//echo $content;

?>