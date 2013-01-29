<?php
    $pageTitle = "Member List";
    include("../php/headerInc.php");
?>

<div class="pageTitle">
    Member List
</div>
<div class="textFormat">
    <table border="1" cellpadding="3" cellspacing="0" class="tableGeneral">
        <thead class="tableHeader">
            <tr>
                <th style="color:#77f;">Name</th>
                <th style="color:#77f;">EMail</th>
                <th style="color:#77f;">Major</th>
                <th style="color:#77f;">Member Type</th>
                <th style="color:#77f;">Nerd Score</th>
                <th style="color:#77f;">Genre</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($results as $row){
                    echo("<tr>");
                        $hrefString='<a href="../controller/controller.php?action=memberDetails&amp;memberID=' . $row['memberID'] . '">';
                        //$test = urlencode("../controller/controller.php?action=memberDetails&memberID=' . $row['memberID']'");
                        echo("<td>" . $hrefString . $row['fName'] . " " . $row['lName'] . "</a></td>");
                        echo("<td>" . $row['email'] . "</td>");
                        echo("<td>" . $row['major'] . "</td>");
                        echo("<td>" . $row['memberType'] . "</td>");
                        echo("<td>" . $row['nerdScore'] . "</td>");
                        echo("<td>" . $row['gameGenre'] . "</td>");
                    echo("</tr>");
                }
            ?>
        </tbody>
    </table>
</div>
     
<?php
    include("../php/footerInc.php");
?>