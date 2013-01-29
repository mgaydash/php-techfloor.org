<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon" />
		<title>
			<?php echo("$pageTitle"); ?>
		</title>
		<!--<link rel="stylesheet" type="text/css" href="../css/jquery-ui-1.8.23.custom.css"/>-->
		<link rel="stylesheet" type="text/css" href="../css/jquery-ui-1.9.0.custom.min.css"/>
		<link rel="stylesheet" type="text/css" href="../css/tfCss.css"/>
		<link rel="stylesheet" type="text/css" href="../css/nav.css"/>
		<script type="text/javascript" src="../js/jquery-1.8.0.min.js"></script>
		<!--<script type="text/javascript" src="../js/jquery-ui-1.8.23.custom.min.js"></script>-->
		<script type="text/javascript" src="../js/jquery-ui-1.9.0.custom.min.js"></script>
		<script type="text/javascript" src="../js/tf.ajaxForm.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery("body").addMemberForm({
					openButtonSel: "#tf_addMemberBtn"
				});
			});
		</script>
	</head>
	<body>
		<div style="display:none;">
			<?php
				require("../frag/addMemberTemp.php");
			?>
		</div>
		<div id="mainBox">
			<div id="titleBox">
				<div id="titleLeft">
					<img src="../images/tfLogo3.4.png" alt="TF Logo" />
				</div>
				<div id="titleMid">
					TechFloor
				</div>
			</div>
			<div style="clear:both"></div>
			<div id="nav">
				<?php 
					require("../frag/nav.html");
				?>
			</div>
			<div id="pageContent">
            