<?php
    $pageTitle = "$row[fName] Details";
    include("../php/headerInc.php");
    
    if(($row['picturePath'] == ""))         //check to see if member has a picture and assign a generic if they don't
        $row['picturePath']="tfLogo3.4.png";
?>

<div class="pageTitle">
	<?php echo "$row[fName]'s Details"; ?>
</div>

<div style="border:2px solid black; float:left; margin:4px;">
    <img height="258px" src="../images/<?php echo("$row[picturePath]") ?>" width="230px" alt="TF Logo" />
</div>
<div class="textFormat">
    <div class="memberDetails" style="font-weight:bold;">
        <div>
            First Name:
        </div>
        <div>
            Last Name:
        </div>
        <div>
            EMail:
        </div>
        <div>
            Major:
        </div>
        <div>
            Member Type:
        </div>
        <div>
            Nerd Score:
        </div>
        <div>
            Game Genre:
        </div>
        <div>
            Member Since:
        </div>
        <div>
            Active Member:
        </div>
        
    </div>
    <div class="memberDetails">
        <div>
            <?php echo("$row[fName]"); ?>
        </div>
        <div>
            <?php echo("$row[lName]"); ?>
        </div>
        <div>
            <?php echo("$row[email]"); ?>
        </div>
        <div style="width:300px"">
            <?php echo("$row[major]"); ?>
        </div>
        <div>
            <?php echo("$row[memberType]"); ?>
        </div>
        <div>
            <?php echo("$row[nerdScore]"); ?>
        </div>
        <div>
            <?php echo("$row[gameGenre]"); ?>
        </div>
        <div>
            <?php echo(toDisplayDate("$row[joinDate]")); ?>
        </div>
        <div>
            <?php if($row['activeMember']){echo("Yes");}else{echo("No");} ?>
        </div>
        
        <div class="sButton">
            <a href="../controller/controller.php?action=editMember&memberID=<?php echo($row['memberID']); ?>">Edit</a>
        </div>
        <div class="sButton">
		<a href="javascript: if (confirm('Are you sure you want to delete?')) { window.location.href='../controller/controller.php?action=deleteMember&memberID=<?php echo($row['memberID']); ?>' } else { void('') }; ">Delete</a>
        </div>
    </div>
</div>
<!--Ex: <a href="javascript: if (confirm('Continue?')) { window.location.href='ex_confirm_continuepressed.htm' } else { void('') }; ">-->
<?php
    include("../php/footerInc.php");
?>
