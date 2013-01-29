<?php

require_once '../model/model.php';
require_once '../php/generalFuncs.php';
require_once '../php/checkEmail.php';
checkForMagicQuotes();
if (isset($_POST['action'])) {  // check get and post
	$action = $_POST['action'];
} else if (isset($_GET['action'])) {
	$action = $_GET['action'];
} else {
	include('../view/index.php');  // load the home page by default
	exit();
}

switch ($action) {
	case 'about':
		include("../view/about.php");
		break;
	case 'aboutSite':
		include("../view/aboutSite.php");
		break;
	case 'addMember':
		addMember();
		break;
	case 'admin':
		include("../view/admin.php");
		break;
	case 'allMembers':
		listAllMembers();
		break;
	case 'checkSheet':
		include("../view/checkSheet3.php");
		break;
	case 'editMember':
		editMember();
		break;
	case 'deleteMember';
		deleteMember();
		break;
	case 'members':
		include("../view/members.php");
		break;
	case 'memberDetails':
		memberDetails();
		break;
	case 'newsletter':
		include("../view/newsletter.php");
		break;
	case 'processAdd':
		processAdd();
		break;
	case 'projects':
		include("../view/projects.php");
		break;
	case 'quoteList':
		include("../view/quoteList.php");
		break;
	case 'searchMembers':
		searchMembers();
		break;
	
	case 'todo':
		include("../view/todo.php");
		break;
	case 'logMembers':
		msgLog();
		break;
}

function addMember() {
	$mode = "Add";
	$memberID = "";
	$fName = "";
	$lName = "";
	$email = "";
	$major = "";
	$memberType = "Normal";
	$nerdScore = "1337";
	$gameGenre = "";
	$joinDate = date("F d, Y");
	$active = "1";

	include '../view/addMember.php'; //in hindsight, this page is poorly named
}
function msgLog(){
	$firstName = $_GET['firstName'];
	$lastName = $_GET['lastName'];
	$email = $_GET['email'];
	
	$file = fopen('../log.txt', 'ab');
	fwrite($file, "$firstName $lastName $email\n");
	fclose($file);
	
	$response = array('action' => 'logMembers', 'status' => 'success', 'message' => 'Member Logged');
	echo json_encode($response);
}

function editMember() {
	if (!isset($_GET['memberID'])) {
		$errorMessage = "You must provide a Member ID.";
		$previousPage = "../controller/controller.php?action=allMembers";
		include '../view/errorPage.php';
	} else {
		$row = getMember($_GET['memberID']);
		if (!$row) {
			$errorMessage = 'The member you requested is not on file';
			$previousPage = "../controller/controller.php?action=editMember&memberId=$memberID";
			include('../view/errorPage.php');
		} else {
			$mode = 'Edit';
			$memberID = $row['memberID'];
			$fName = $row['fName'];
			$lName = $row['lName'];
			$email = $row['email'];
			$major = $row['major'];
			$memberType = $row['memberType'];
			$nerdScore = $row['nerdScore'];
			$gameGenre = $row['gameGenre'];
			$joinDate = toDisplayDate($row['joinDate']);
			$active = $row['activeMember'];
		}
		include '../view/addMember.php';
	}
}

function deleteMember() {
	if (!isset($_GET['memberID'])) {
		$errorMessage = "You must provide a Member ID.";
		$previousPage = "../controller/controller.php?action=allMembers";
		include '../view/errorPage.php';
	} else {
		$row = getMember($_GET['memberID']);
		if (!$row) {
			$errorMessage = 'The member you requested is not on file';
			$previousPage = "../controller/controller.php?action=editMember&memberId=$memberID";
			include('../view/errorPage.php');
		} else {
			$rowCount = removeMember($row['memberID']);
			if ($rowCount != 1) {
				$errorMessage = "There were $rowCount rows deleted.";
				include '../view/errorPage.php';
			} else {
				header('Location: ../controller/controller.php?action=allMembers');
			}
		}
	}
}

function memberDetails() {
	if (!isset($_GET['memberID'])) {
		$errorMessage = "MemberID is not set";
		$previousPage = "../controller/controller.php?action=allMembers";
		include '../view/errorPage.php';
	} else {
		$row = getMember($_GET['memberID']);
		if (!$row) {
			$errorMessage = "The member could not be found.";
			$previousPage = "../controller/controller.php?action=allMembers";
			include '../view/errorPage.php';
		} else {
			include '../view/memberDetails.php';
		}
	}
}

function processAdd() {
	$mode = $_POST['mode'];
	$memberID = $_POST['memberID'];
	$fName = $_POST['fName'];
	$lName = $_POST['lName'];
	$email = $_POST['email'];
	$major = $_POST['major'];
	$memberType = $_POST['memberType'];
	$nerdScore = $_POST['nerdScore'];
	$gameGenre = $_POST['gameGenre'];
	$joinDate = $_POST['joinDate'];
	$active = $_POST['active'];

	$errorMessage = "";
	if ($fName == "") {
		$errorMessage .= "\\n\\t* The First Name field is blank.  ";
	}
	if ($lName == "") {
		$errorMessage .= "\\n\\t* The Last Name is blank.  ";
	}
	if ($email == "") {
		$errorMessage .= "\\n\\t* The Email address field is blank.  ";
	}
	if (!isValidEmail($email)) {
		$errorMessage .= "\\n\\t* The Email address is invalid.  ";
	}
	if ($major == "") {
		$errorMessage .= "\\n\\t* A major has not been specified.  ";
	}
	if ($memberType != "Normal") {
		$errorMessage .= "\\n\\t* The member type must be set to normal at this time.  ";
	}
	if (!is_numeric($nerdScore)) {
		$errorMessage .= "\\n\\t* The nerd score must be a number.  ";
	}
	if (isset($_POST['active'])) {
		$active = "1";
	} else {
		$active = "0";
	}

	if ($errorMessage != "") {
		include '../view/addMember.php';
	} else { // No errors found
		if ($mode == "Add") {
			$memberID = insertMember($fName, $lName, $email, $major, $memberType, $nerdScore, $gameGenre, $joinDate, $active);
		} else {
			updateMember($memberID, $fName, $lName, $email, $major, $memberType, $nerdScore, $gameGenre, $joinDate, $active);
		}
		header("Location: ../controller/controller.php?action=memberDetails&memberID=$memberID");
	}
}

function processMember() {
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$email = $_POST['email'];

	if ($firstName == "" || $lastName == "") {
		$errorMessage = "Please enter your name.";
		$previousPage = "../controller/controller.php?action=members";
		include("../view/errorPage.php");
	} else if (isValidEmail($email)) {
		saveName($firstName, $lastName);
		saveEmail($email);
		include("../view/processMember.php");
	} else {
		$errorMessage = "Please enter a valid email address.";
		$previousPage = "../controller/controller.php?action=members";
		include("../view/errorPage.php");
	}
}

function listAllMembers() {
	if (isset($_GET['type'])) {
		if ($_GET['type'] == 'genSearch')
			$results = getMembersByGeneralSearch($_GET['Criteria']);
		if ($_GET['type'] == 'majorSearch')
			$results = getMembersByMajor($_GET['Criteria']);
		if ($_GET['type'] == 'officerLookup')
			$results = officerLookup();
	}
	else {
		$results = getAllMembers();
	}
	if (count($results) == 0) {
		$errorMessage = "There are currently no members.";
		$previousPage = "../controller/controller.php";
		include '../view/errorPage.php';
	} else if (count($results) == 1) {
		$row = $results[0];
		include '../view/memberDetails.php';
	} else {
		include '../view/allMembers.php';
	}
}

function searchMembers() {
	$results = getAllMembers();
	include("../view/search.php");
}

class test{
	private $num = 0;
	
	private function printTest(){
		echo $num;
	}
}

?>
