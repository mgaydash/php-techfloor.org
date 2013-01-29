<?php

    $pageTitle = "Upload Files";
    include("../php/headerInc.php");
?>

<?php
   $uploadfile = '../../dataFiles/quoteUploads/' . $_FILES['userfile']['name'];
   
   if (file_exists($uploadfile)) {
	   $message = "The file was overwritten.";
   } else {
	   $message = "<p>The file was successfully uploaded.</p>";
   }
   
   echo '<p>The file type is ' . $_FILES['userfile']['type'] . "</p>";
   
   if ($_FILES['userfile']['type'] != 'text/plain') {
	   echo "<p>We will only accept text files.  Go back and try again. </p>";
   } else {
       
	   if (move_uploaded_file($_FILES['userfile']['tmp_name'], "../../dataFiles/quoteUploads/quotes.txt")) {
               
		   if ($_FILES['userfile']['size'] > 300000) {
			   echo 'Pick a smaller file.';
		   } else {
                       
			  echo $message;
			  $current_dir = '../../dataFiles/quoteUploads';
			  
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
    echo "<a href='../view/quoteList.php'><br /><span class='pButton'>View Quotes</span></a>";
?>

<?php
    include("footerInc.php")
?>
