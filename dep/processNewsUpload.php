<?php

    $pageTitle = "Upload Files";
    include("../php/headerInc.php");
?>

<?php
   $uploadfile = '../../dataFiles/newsletter/' . $_FILES['userfile']['name'];
   
   if (file_exists($uploadfile)) {
	   $message = "The file was overwritten.";
   } else {
	   $message = "<p>The file was successfully uploaded.</p>";
   }
   
   //echo '<p>The file type is ' . $_FILES['userfile']['type'] . "</p>";
   
   if ($_FILES['userfile']['type'] != 'text/html') {
	   echo "<p>We will only accept HTML files.  Please go back and try again. </p>";
   } else {
       
	   if (move_uploaded_file($_FILES['userfile']['tmp_name'], "../../dataFiles/newsletter/newsletter.html")) {
               
		   if ($_FILES['userfile']['size'] > 300000) {
			   echo 'Pick a smaller file.';
		   } else {
                       echo $message;		
		   }
                   
		} else if ($_FILES['userfile']['error'] == UPLOAD_ERR_NO_FILE) {
			echo '<p>First select a file and then click the Send File button.';
		} else {
			echo "File Upload Error\n Debugging info:";
			print_r($_FILES);
		}
   }
   
   echo "<a href='../view/admin.php'><br /><span class='pButton'>Go Back</span></a>";
   echo "<br />";
   echo "<a href='../view/newsletter.php'><br /><span class='pButton'>View Newsletter</span></a>";
?>

<?php
    include("footerInc.php")
?>
