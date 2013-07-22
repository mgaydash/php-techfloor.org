<?php
    $pageTitle = "Error";
    include("../frag/header.php");
?>

<div class="pageTitle">
    Error
</div>

<div class="textFormat">
    <?php
        echo("<h3>&nbsp;$errorMessage</h3>");
        echo("<a href=\"$previousPage\"><br /><span class='pButton'>Go Back</span></a>");
    ?>
</div>

<?php
    include("../frag/footer.php");
?>