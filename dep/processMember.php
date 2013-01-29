<?php
    $pageTitle = "Member Signup";
    include("../php/headerInc.php");
?>

<div class="pageTitle">
    Member Sign Up
</div>

<div>
    <?php
        echo "<h3>Thanks for signing up,$firstName.</h3>";
        echo("<a href='../controller/controller.php'><br /><span class='pButton'>Continue</span></a>");
    ?>
</div>

<?php
    include("../php/footerInc.php");
?>