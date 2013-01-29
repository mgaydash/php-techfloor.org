<?php
    $pageTitle = "Quote List";
    include("../php/headerInc.php");
?>
    
<div class="pageTitle">
    Quotes List
</div>

<br />
    
<?php

    $fileName = "../../dataFiles/quoteUploads/quotes.txt";
    $handle = fopen($fileName, "rb");
        
    while(!feof($handle))
    {
        
        $contents = fgets($handle, filesize($fileName));
        echo($contents . "<br />");
    }
?>
    
   
<?php
    include("../php/footerInc.php");
?>