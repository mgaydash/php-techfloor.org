<?php
function addNewMember(){
	global $memberForm;
	$message = array();
	try{
		$success = insertMember($memberForm);
	}
	catch(Exception $e){
		$message[] = $e->getMessage();
		$success = false;
	}
	$response = array(
		'action' => 'addNewMember',
		'message' => $message,
		'success' => $success
	);
	echo json_encode($response);
}
function editMember(){
	global $memberForm;
	$message = array();
	$success = true;
	try{
		$success = updateMemberById($memberForm);
	}
	catch(Exception $e){
		$message[] = $e->getMessage();
		$success = false;
	}
	$response = array(
		'action' => 'editMember',
		'message' => $message,
		'success' => $success
	);
	echo json_encode($response);
}
function lolSignup(){
	global $lolForm;
	$message = array();
	$success = true;
	$status = "";
	try{
		$status = applyTeam($lolForm);
		$success = insertPlayer($lolForm);
	}
	catch(Exception $e){
		$message[] = $e->getMessage();
		$success = false;
	}
	$response = array(
		'action' => 'lolSignup',
		'message' => $message,
		'success' => $success,
		'status' => $status
	);
	echo json_encode($response);
}
function retrieveLolTeamInfo(){
	$message = array();
	$success = true;
	$teamAr = array();
	try{
		$teams = selectAllLolTeams();
		for($i = 0; $i < count($teams); $i++){
			$temp = array();
			$temp["name"] = $teams[$i]["name"];
			$playerAr = selectPlayersByTeamId($teams[$i]["id"]);
			for($j = 0; $j < count($playerAr); $j++)
				$playerAr[$j] = convertBoToAr ($playerAr[$j]);
			$temp["players"] = $playerAr;
			$teamAr[] = $temp;
		}
		$temp = array();
		$temp["name"] = "No Team";
		$playerAr = selectPlayersByTeamId(0);
		for($j = 0; $j < count($playerAr); $j++)
			$playerAr[$j] = convertBoToAr ($playerAr[$j]);
		$temp["players"] = $playerAr;
		$teamAr[] = $temp;
	}
	catch(Exception $e){
		$message[] = $e->getMessage();
		$success = false;
	}
	$response = array(
		'action' => 'retrieveLolTeamInfo',
		'message' => $message,
		'success' => $success, 
		'teamAr' => $teamAr
	);
	echo json_encode($response);
}
function retrieveLolTeamNames(){
	$message = array();
	$success = true;
	$teamNameAr = array();
	try{
		$teamAr = selectAllLolTeams();
		for($i = 0; $i < count($teamAr); $i++)
			$teamNameAr[] = $teamAr[$i]["name"];
	}
	catch(Exception $e){
		$message[] = $e->getMessage();
		$success = false;
	}
	$response = array(
		'action' => 'retrieveLolTeams',
		'message' => $message,
		'success' => $success, 
		'teamNameAr' => $teamNameAr
	);
	echo json_encode($response);
}
function retrieveAllMembers(){
	$message = array();
	$success = true;
	$memberArray = array();
	try{
		$memberArray = selectAllMembers();
	}
	catch(Exception $e){
		$message[] = $e->getMessage();
		$success = false;
	}
	$response = array(
		'action' => 'retrieveAllMembers',
		'message' => $message,
		'success' => $success, 
		'memberAr' => $memberArray
	);
	echo json_encode($response);
}
function retrieveMemberById(){
	global $memberForm;
	$message = array();
	$success = true;
	$member = NULL;
	try{
		$member = selectMemberById($memberForm->id);
	}
	catch(Exception $e){
		$message[] = $e->getMessage();
		$success = false;
	}
	$response = array(
		'action' => 'retrieveMemberById',
		'message' => $message,
		'success' => $success, 
		'member' => $member
	);
	echo json_encode($response);
}
function submitRpsAction(){
	global $rpsForm;
	$message = array();
	$status = "";
	$success = true;
	$winner = "";
	try{
		$rps2Str = $rpsForm->type;
		$rps1 = fopen('../file/rps1.txt', 'r+');
		$rps1Str = fread($rps1, 128);
		if($rps1Str == ""){
			fwrite($rps1, $rps2Str);
			$status = "rps1Saved";
		}
		else{
			$status = "cleared";
			file_put_contents("../file/rps1.txt", "");
			if($rps1Str == "rock" && $rps2Str == "rock")
				$winner = "tie";
			if($rps1Str == "rock" && $rps2Str == "paper")
				$winner = "paper";
			if($rps1Str == "rock" && $rps2Str == "scissors")
				$winner = "rock";
			if($rps1Str == "paper" && $rps2Str == "rock")
				$winner = "paper";
			if($rps1Str == "paper" && $rps2Str == "paper")
				$winner = "tie";
			if($rps1Str == "paper" && $rps2Str == "scissors")
				$winner = "scissors";
			if($rps1Str == "scissors" && $rps2Str == "rock")
				$winner = "rock";
			if($rps1Str == "scissors" && $rps2Str == "paper")
				$winner = "scissors";
			if($rps1Str == "scissors" && $rps2Str == "scissors")
				$winner = "tie";
			
			$rps2 = fopen('../file/rps2.txt', 'w+');
			fwrite($rps2, $winner);
			fclose($rps2);
		}
		fclose($rps1);
	}
	catch(Exception $e){
		$message[] = $e->getMessage();
		$success = false;
	}
	$response = array(
		'action' => 'submitRpsAction',
		'message' => $message,
		'status' => $status,
		'success' => $success, 
		'winner' => $winner
	);
	echo json_encode($response);
}
function submitRpsCheck(){
	$message = array();
	$status = "";
	$success = true;
	$winner = "";
	try{
		$rps2 = fopen('../file/rps2.txt', 'r+');
		$winner = fread($rps2, 128);
		if($winner != ""){
			file_put_contents("../file/rps2.txt", "");
			$status = "rps2Cleared";
		}
		else{
			$status = "noWinner";
		}
		fclose($rps2);
	}
	catch(Exception $e){
		$message[] = $e->getMessage();
		$success = false;
	}
	$response = array(
		'action' => 'submitRpsCheck',
		'message' => $message,
		'status' => $status,
		'success' => $success, 
		'winner' => $winner
	);
	echo json_encode($response);
}
?>
