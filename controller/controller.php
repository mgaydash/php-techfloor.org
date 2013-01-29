<?php
require_once '../bo/bo.php';
require_once '../controller/action.php';
require_once '../model/model.php';

$memberForm = new MemberForm();
$lolForm = new LolForm();
$rpsForm = new RpsForm();
//checkForMagicQuotes();

if(isset($_POST['action'])){  // check get and post
	$action = $_POST['action'];
}
else if(isset($_GET['action'])){
	$action = $_GET['action'];
}
else{
	include'../view/index.php';  // load the home page by default
	exit();
}

switch ($action) {
	case "aboutPage":
		include("../view/about.php");
		break;
	case "addMember":
		setMemberForm();
		addNewMember();
		break;
	case "editMember":
		setMemberForm();
		editMember();
		break;
	case "lolTournamentTeams":
		include("../view/lolTournamentTeams.php");
		break;
	case "lolTournament":
		include("../view/lolTournament.php");
		break;
	case "lolSignup":
		setLolForm();
		lolSignup();
		break;
	case "membersPage":
		include("../view/members.php");
		break;
	case "projectsPage":
		include("../view/projects.php");
		break;
	case "retrieveMemberById":
		setMemberForm();
		retrieveMemberById();
		break;
	case "retrieveAllMembers":
		retrieveAllMembers();
		break;
	case "retrieveLolTeamInfo":
		retrieveLolTeamInfo();
		break;
	case "retrieveLolTeamNames":
		retrieveLolTeamNames();
		break;
	case "rps":
		include("../view/rps.php");
		break;
	case "submitRpsAction":
		setRpsForm();
		submitRpsAction();
		break;
	case "submitRpsCheck":
		submitRpsCheck();
		break;
	case "todoPage":
		include("../view/todo.php");
		break;
}
?>