<?php
function applyTeam($lolForm){
	$db = getDBConnection();
	if(!isset($lolForm->tName) || $lolForm->tName == "")
		return "noTeam";
	$team = selectTeamByName($lolForm->tName);
	if($team == ""){
		$teamId = insertLolTeam($lolForm);
		$status = "new";
	}
	else{
		if($lolForm->tPw == $team["pw"]){
			$teamId = $team["id"];
			$status = "join";
		}
		else{
			$status = "badPw";
		}
	}
	if($status != "badPw")
		$lolForm->tId = $teamId;
	return $status;
}
function getDBConnection(){
	$dsn = 'mysql:host=localhost;dbname=techfloor';
	$username = 'root';
	$password = 'smelt3r';
	$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
	$db = new PDO($dsn, $username, $password, $options);
	return $db;
}
function insertLolTeam($lolForm){
	$db = getDBConnection();
	$query = 'INSERT INTO lolTeam (name, pw) VALUES (:name, :pw)';
	$statement = $db->prepare($query);
	$statement->bindValue(':name', $lolForm->tName);
	$statement->bindValue(':pw', $lolForm->tPw);
	$success = $statement->execute();
	$statement->closeCursor();
	return $db->lastInsertId();
}
function insertMember($memberForm){
	$db = getDBConnection();
	$query = 'INSERT INTO user (fName, lName, email, summoner) VALUES (:fName, :lName, :email, :summoner)';
	$statement = $db->prepare($query);
	$statement->bindValue(":fName", $memberForm->fName);
	$statement->bindValue(":lName", $memberForm->lName);
	$statement->bindValue(":email", $memberForm->email);
	$statement->bindValue(":summoner", $memberForm->summoner);
	$success = $statement->execute();
	$statement->closeCursor();
	return $success;
}
function insertPlayer($lolForm){
	$db = getDBConnection();
	$query = 'INSERT INTO lolPlayer (email, name, sName, tId, wins) VALUES (:email, :name, :sName, :tId, :wins)';
	$statement = $db->prepare($query);
	$statement->bindValue(':email', $lolForm->email);
	$statement->bindValue(':name', $lolForm->name);
	$statement->bindValue(':sName', $lolForm->sName);
	$statement->bindValue(':tId', $lolForm->tId);
	$statement->bindValue(':wins', $lolForm->wins);
	$success = $statement->execute();
	$statement->closeCursor();
	return $success;
}
function selectAllMembers(){
	$db = getDBConnection();
	$resultAr = array();
	$query = "SELECT * FROM user ORDER BY lName, fName";
	$statement = $db->prepare($query);
	$statement->execute();
	while($member = $statement->fetch()){
		$temp = new MemberForm();
		//$temp->email = $member["email"];
		$temp->fName = $member["fName"];
		$temp->id = $member["id"];
		$temp->lName = $member["lName"];
		$temp->summoner = $member["summoner"];
		$resultAr[] = convertBoToAr($temp);
	}
	$statement->closeCursor();
	return $resultAr;
}
function selectAllLolTeams(){
	$db = getDBConnection();
	$resultAr = array();
	$query = "SELECT * FROM lolTeam ORDER BY name";
	$statement = $db->prepare($query);
	$statement->execute();
	while($team = $statement->fetch()){
		$temp = new LolTeamForm();
		$temp->name = $team["name"];
		$temp->id = $team["id"];
		$resultAr[] = convertBoToAr($temp);
	}
	$statement->closeCursor();
	return $resultAr;
}
function selectMemberById($id){
	$db = getDBConnection();
	$query = "SELECT * FROM user WHERE id = :id";
	$statement = $db->prepare($query);
	$statement->bindValue(":id", $id);
	$statement->execute();
	$member = $statement->fetch();
	$temp = new MemberForm();
	$temp->email = $member["email"];
	$temp->fName = $member["fName"];
	$temp->id = $member["id"];
	$temp->lName = $member["lName"];
	$statement->closeCursor();
	return convertBoToAr($temp);
}
function selectPlayersByTeamId($id){
	$db = getDBConnection();
	$playerAr = array();
	$query = "SELECT * FROM lolPlayer WHERE tId = :id";
	$statement = $db->prepare($query);
	$statement->bindValue(":id", $id);
	$statement->execute();
	while($player = $statement->fetch()){
		$temp = new LolForm();
		$temp->email = $player["email"];
		$temp->name = $player["name"];
		$temp->sName = $player["sname"];
		$temp->wins = $player["wins"];
		$playerAr[] = $temp;
	}
	return $playerAr;
}
function selectTeamByName($name){
	$db = getDBConnection();
	$query = "SELECT * FROM lolTeam WHERE name = :name";
	$statement = $db->prepare($query);
	$statement->bindValue(":name", $name);
	$statement->execute();
	$team = $statement->fetch();
	$statement->closeCursor();
	return $team;
}
function updateMemberById($memberForm){
	$db = getDBConnection();
	$query = "UPDATE user SET fName = :fName, lName = :lName, email = :email WHERE id = :id";
	$statement = $db->prepare($query);
	$statement->bindValue(':id', $memberForm->id);
	$statement->bindValue(':fName', $memberForm->fName);
	$statement->bindValue(':lName', $memberForm->lName);
	$statement->bindValue(':email', $memberForm->email);
	$success = $statement->execute();
	//$row_count = $statement->rowCount();
	$statement->closeCursor();
	return $success;
}

/* ########## Functions used to manipulate BO's ########## */
function setLolForm(){
	global $lolForm;
	if(isset($_GET["email"]))
		$lolForm->email = $_GET["email"];
	if(isset($_GET["name"]))
		$lolForm->name = $_GET["name"];
	if(isset($_GET["sName"]))
		$lolForm->sName = $_GET["sName"];
	if(isset($_GET["wins"]))
		$lolForm->wins = $_GET["wins"];
	if(isset($_GET["tId"]))
		$lolForm->tName = $_GET["tName"];
	if(isset($_GET["tName"]))
		$lolForm->tId = $_GET["tId"];
	if(isset($_GET["tPw"]))
		$lolForm->tPw = $_GET["tPw"];
}
function setMemberForm(){
	global $memberForm;
	if(isset($_GET["email"]))
		$memberForm->email = $_GET["email"];
	if(isset($_GET["fName"]))
		$memberForm->fName = $_GET["fName"];
	if(isset($_GET["id"]))
		$memberForm->id = $_GET["id"];
	if(isset($_GET["lName"]))
		$memberForm->lName = $_GET["lName"];
	if(isset($_GET["summoner"]))
		$memberForm->summoner = $_GET["summoner"];
}
function setRpsForm(){
	global $rpsForm;
	if(isset($_GET["type"]))
		$rpsForm->type = $_GET["type"];
}
function convertBoToAr($bo){
	$reflector = new ReflectionClass(get_class($bo));
	$propertyAr = $reflector->getProperties();
	$resultAr = array();
	for($i = 0; $i < count($propertyAr); $i++){
		$name = $propertyAr[$i]->name;
		if($bo->$name != NULL)
			$resultAr[$name] = $bo->$name;
	}
	return $resultAr;
}

/* ########## System Utility Functions ########## */
function ulog($s){ //poor man's logger
	$file = fopen('../log.txt', 'ab');
	fwrite($file, $s . "\n");
	fclose($file);
}
?>