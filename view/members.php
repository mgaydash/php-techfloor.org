<?php
$pageTitle = "Members";
include("../frag/header.php");
?>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery("body").memberManager({});
		jQuery("body").editMemberForm({});
	});
</script>
<div style="display:none;">
	<?php
		include("../frag/editMemberTemp.php");
	?>
	<img alt="preLoad" src="../images/gradDDDDDD.png"/>
	<img alt="preLoad" src="../images/gradBBBBBB.png"/>
	<img alt="preLoad" src="../images/gradAAAAFF.png"/>
</div>
<div class="pageTitle">
    Members
</div>
<table cellspacing="0" class="memberTable" style="table-layout:fixed; height:1px; visibility:hidden; width:1px;">
	<thead>
		<tr>
			<th style="border-left:0px; width:150px;">Last Name</th>
			<th style="width:150px;">First Name</th>
			<th style="width:439px;">LoL Summoner</th>
		</tr>
	</thead>
	<tbody class="tf_memberTable_tbody">
		<tr class="tf_memberTable_memberRow">
			<td style="border-left:0px;">
				<div style="height:22px;  overflow:hidden;">
					<div class="tf_memberTable_overlay" style='background-repeat:repeat-y; float:right; height:22px; position:relative; width:30px; z-index:2;'></div>
					<div class="tf_memberTable_lName" style="height:22px; padding-left:3px; z-index:1;"></div>
				</div>
			</td>
			<td>
				<div class="tf_memberTable_overlay" style='background-repeat:repeat-y; float:right; height:22px; position:relative; width:30px; z-index:2;'></div>
				<div class="tf_memberTable_fName" style="height:22px; padding-left:3px; z-index:1;"></div>
			</td>
			<td>
				<div class="tf_memberTable_overlay" style='background-repeat:repeat-y; float:right; height:22px; position:relative; width:30px; z-index:2;'></div>
				<div class="tf_memberTable_summoner" style="height:22px; padding-left:3px; z-index:1;"></div>
			</td>
		</tr>
	</tbody>
</table>

<?php
include("../frag/footer.php");
?>