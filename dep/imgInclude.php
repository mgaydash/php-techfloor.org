<?php

$images = array();

$current_dir = '../images/imageUploads/';
$dir = opendir($current_dir);
$numFiles = 0;

while(false !== ($file = readdir($dir)))
{    
    //strip out the two entries of . and ..
    if($file != "." && $file != ".."){
        $images[] = $file;       
        $numFiles += 1;
    }
}
$whichImage = $images[rand(0, $numFiles - 1)];

echo("<img src='" . $current_dir . "/" . $whichImage . "' height='107' width='92' alt='Image' />")
//echo('<img src="../../dataFiles/imageUploads/Moreaccurate.png" />')
//echo("<img src='../images/imageUploads/More accurate.png' />");

?>
