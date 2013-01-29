<?php
	$pageTitle = "Search Members";
	include("../php/headerInc.php");
?>

<div class="pageTitle">
    Search Members
</div>
<div class="formRow">
	<label class="textFormat" style="padding-right:10px;">Select Member:</label>
	<select id="SelectedMember" style="width:200px;"">
        <?php 
            echo '<option value="">Select Member</option>'; 
            foreach ($results as $row) {
                echo "<option value=\"" . $row['memberID'] . "\">" . $row['fName'] . " " . $row['lName'] . "</option>";
            }
        ?>
	</select>
     <a href="javascript:memberLookup()"><span class='pButton'>Select</span></a>        
</div>

<div class="formRow">
	<label class="textFormat" style="padding-right:28px;">Select Major:</label>
	<select id="SelectedMajor" style="width:200px;">
        <?php 
            echo '<option value="">Select Major</option>';
            echo '<option value="CS">CS</option>';
            echo '<option value="ART">ART</option>';
            echo '<option value="ACTG">ACTG</option>';
            echo '<option value="ED">ED</option>';
            echo '<option value="IS">IS</option>';
        ?>
	</select>
     <a href="javascript:majorLookup()"><span class='pButton'>Select</span></a>        
</div>

<div class="formRow">
	<label class="textFormat" >General Search:</label>
	<input type="text" id="SearchCriteria" style="width:194px;"/>
     <a href="javascript:generalSearch()"><span class='pButton'>Search</span></a>     
</div>

<div class="formRow">
	<label class="textFormat">View Current Officers:</label>
     <a href="../controller/controller.php?action=allMembers&amp;type=officerLookup"><span class='pButton'>View</span></a>     
</div>

<script type="text/javascript">
    function memberLookup(){
        if($('#SelectedMember').val() == ""){
            //intentionally empty
        }
        else{
            document.location = "../controller/controller.php?action=memberDetails&memberID=" + $('#SelectedMember').val();
        }
    }
    function majorLookup(){
        if($('#SelectedMajor').val() == ""){
            //intentionally empty
        }
        else{
            document.location = "../controller/controller.php?action=allMembers&type=majorSearch&Criteria=" + $('#SelectedMajor').val();
        }
    }
    function generalSearch(){
        if($('#SearchCriteria').val() == ""){
            
        }
        else{
            document.location = "../controller/controller.php?action=allMembers&type=genSearch&Criteria=" + encodeURIComponent($('#SearchCriteria').val());
        }
    }
</script>

<?php
	include("../php/footerInc.php");
?>
