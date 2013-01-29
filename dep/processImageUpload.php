<?php

    $pageTitle = "Upload Files";
    include("../php/headerInc.php");
?>

<?php
   $uploadfile = '../images/imageUploads/' . $_FILES['userfile']['name'];
   
   if (file_exists($uploadfile)) {
	   $message = "The file was overwritten.";
   } else {
	   $message = "<p>The file was successfully uploaded.</p>";
   }
   
   //echo '<p>The file type is ' . $_FILES['userfile']['type'] . "</p>";
   
   if ($_FILES['userfile']['type'] != 'image/jpg' && $_FILES['userfile']['type'] != 'image/png' && $_FILES['userfile']['type'] != 'image/bmp' && $_FILES['userfile']['type'] != 'image/jpeg') {
	   echo "<p>We will only accept picture files.  Go back and try again. </p>";
   } else {
       
           echo($uploadfile);
	   if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
               
		   if ($_FILES['userfile']['size'] > 300000) {
			   echo 'Pick a smaller file.';
		   } else {
                       
                          echo $message;
			  $current_dir = '../images/imageUploads';
			  $dir = opendir($current_dir);

			  echo '<p>Images Uploaded: </p><ul>';
                           
			  while(false !== ($file = readdir($dir)))
				//strip out the two entries of . and ..
                              
				if($file != "." && $file != ".."){
					  echo "<li>$file</li>";
				}
			  echo '</ul>';
			  closedir($dir);
		   }
                   
            } else if ($_FILES['userfile']['error'] == UPLOAD_ERR_NO_FILE) {
                    echo '<p>First select a file and then click the Send File button.';
            } else {
                    echo "File Upload Error\n Debugging info:";
                    print_r($_FILES);
            }
            
            
        }
   echo "<a href='../view/admin.php'><br /><span class='pButton'>Go Back</span></a>";
?>

<?php
    include("footerInc.php")
?>
