<?php
$pageTitle = "LoL Teams";
include("../frag/header.php");
?>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery("body").lolTeamManager();
	});
</script>
<div class="pageTitle">
    LoL Teams
</div>
<table cellspacing="0" class="memberTable" style="border-bottom:2px solid black; width:100%;">
	<thead style="background:gray;	">
		<tr>
			<th>Team</th>
			<th>Name</th>
			<th>Summoner</th>
			<th>Wins</th>
			<th>Email</th>
		</tr>
	</thead>
	<tbody class="tf_teamTable_tbody">
		<tr>
			<td class="teamName" style="text-align:center;"></td>
			<td class="pName" style="padding-left:5px;"></td>
			<td class="tSName" style="padding-left:5px;"></td>
			<td class="wins" style="padding-left:5px;"></td>
			<td class="pEmail" style="padding-left:5px;"></td>
		</tr>
	</tbody>
</table>

<?php
include("../frag/footer.php");
?>