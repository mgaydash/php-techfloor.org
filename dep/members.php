<?php
    $pageTitle = "Member Signup";
    include("../php/headerInc.php");
?>

<div class="pageTitle">
    Member Sign Up
</div>
<div style="padding:10px;">
    <div class="textFormat" style ="margin-bottom:10px;">
        If you want to become a member of TechFloor and receive our periodic newsletter, 
        ender you information below.
    </div>
    <form action="../controller/controller.php?action=processMember" method="post">
        <div style="float:left; height:80px; width:90px;">
            <label>First Name: </label>
            <br />
            <label>Last Name: </label>
            <br />
            <label>Email: </label>
        </div> 
        <div style="float:left; height:80px; width:200px;">
            <input type="text" name="firstName" />
            <br />
            <input type="text" name="lastName" />
            <br />
            <input type="text" name="email" />
        </div>
        
        <div style="clear:both">
            <input type="submit" value="Sign Up"/>
        </div>
    </form>
</div>

<?php
    include("../php/footerInc.php");
?>
