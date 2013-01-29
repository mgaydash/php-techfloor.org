<?php
	function toDisplayDate($dateIn) {	// Take in a MySQL format date and return in MM/DD/YYYY
		if ($timeStamp = strtotime($dateIn)) {
			return date('F d, Y', $timeStamp);
		} else {
			return "";
		}
	}
	function toMySQLDate($dateIn) {	// Take in a MM/DD/YYYY format date and return in YYYY-MM-DD
		if ($timeStamp = strtotime($dateIn)) {
			return date('Y-m-d', $timeStamp);
		} else {
			return "";
		}
	}
	function checkForMagicQuotes() {
		if (get_magic_quotes_gpc()) {
			function stripslashes_gpc(&$value) {
				$value = stripslashes($value);
			}
			array_walk_recursive($_GET, 'stripslashes_gpc');
			array_walk_recursive($_POST, 'stripslashes_gpc');
			array_walk_recursive($_COOKIE, 'stripslashes_gpc');
			array_walk_recursive($_REQUEST, 'stripslashes_gpc');
		}
	}

?>
