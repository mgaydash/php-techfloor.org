<?php
    $pageTitle = "Techfloor.org - Upload Files";
    include("../php/headerInc.php");
?>

<div class="pageTitle">
    Manage Files
</div>

<div class="textFormat">
    Select files to upload:
</div>

<div class="textFormat">
    <form enctype="multipart/form-data" action="../php/processNewsUpload.php" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
        <div style="float:left; height:40px; width:155px;">
            Upload a Newsletter: 
        </div>
        <div style="float:left; height:40px; width:500px;">
            <input name="userfile" type="file" />
            <input type="submit" value="Send File" />
        </div>
    </form>
</div>

<div class="textFormat">
    <form enctype="multipart/form-data" action="../php/processImageUpload.php" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
        <div style="float:left; height:40px; width:155px;">
            Upload an image: 
        </div>
        <div style="float:left; height:40px; width:500px;">
            <input name="userfile" type="file" />
            <input type="submit" value="Send File" />
        </div>
    </form>
</div>

<div class="textFormat">
    <form enctype="multipart/form-data" action="../php/processQuoteUpload.php" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
        <div style="float:left; height:40px; width:155px;">
            Upload quotes: 
        </div>
        <div style="float:left; height:40px; width:400px;">
            <input name="userfile" type="file" />
            <input type="submit" value="Send File" />
        </div>
    </form>
</div>

<div style="clear:both">
<a href='../view/newsletter.php'><br /><span class='pButton'>View Newsletter</span></a>
<a href='../view/quoteList.php'><span class='pButton'>View Quotes</span></a>
</div>

<?php
    include("../php/footerInc.php");
?>