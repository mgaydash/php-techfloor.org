<?php
$pageTitle = "LoL Tournament";
include("../frag/header.php");
?>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery("body").lolForm({
			openButtonSel: ".openSighupForm"
		});
	})
</script>

<div style="display:none;">
	<?php
		include("../frag/lolSignupTemp.php");
	?>
</div>
<div class="pageTitle">
    LoL ARAM Tournament
</div>
<div style="border:2px solid black; border-top:none; height:200px; margin-left:70px; width:600px;">
	<img alt="LoL Logo" src="../images/lolLogo.png"/>
</div>
<span class="mMenuButton openSighupForm" style="display:block;">Sign Up</span>
<div class="textFormat">
	<span style="line-height:22px;">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		On Saturday, November 10, 2012, TechFloor will be hosting a League of Legends Tournament.
		The tournament will be a series of 5v5 ARAM (all random, all mid) matches on the Proving Grounds.
		Teams can be made in advance by having all team mates specify the same team name on the sign-up form.
		If you don't have a full five-person team, don't worry, teams will be made the day of the tournament
		for those without a pre-made.
		<br/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		The first match of the tournament will start at noon, and the tournament will continue until all but one team is eliminated.
		We will be holding the tournament in Becker room 200 (Advanced Lab), and spectating will be done in
		Becker room 143. At the end of the tournament, the winning team will receive 50% of the collected
		entrance fees as a prize.
		<h3>About:</h3>
		<ul>
			<li>Date: Saturday, November 10, 2012</li>
			<li>Time: 12:00pm</li>
			<li>Where: Becker Advanced Lab - room 200</li>
			<li>$5 participation fee for players</li>
			<li>Single-elimination</li>
			<li>5v5 ARAM's on the Proving Grounds</li>
		</ul>
		<h3>Rules:</h3>
		<ul>
			<li>Queue dodging is forbidden.</li>
		</ul>
	</span>
</div>
<!--<span class="mMenuButton openSighupForm" style="display:block;">Sign Up</span>-->
<br/>
<?php
include("../frag/footer.php");
?>