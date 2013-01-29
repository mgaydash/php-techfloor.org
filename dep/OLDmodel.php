<?php

require_once("../php/checkEmail.php");

function saveName($firstName, $lastName) {
	$file = fopen('../../dataFiles/members.txt', 'ab');
	fwrite($file, "$firstName $lastName\n");
	fclose($file);
}

function saveEmail($email) {
	$file = fopen('../../dataFiles/email.txt', 'ab');
	fwrite($file, "$email\n");
	fclose($file);
}

function getAllMembers() {
	try {
		$db = getDBConnection();
		$query = "select * from member order by lName, fName";
		$statement = $db->prepare($query);
		$statement->execute();
		$results = $statement->fetchAll();
		$statement->closeCursor();
		return $results;		   //array of associative arrays
	} catch (PDOException $e) {
		$errorMessage = $e->getMessage();
		$previousPage = "../controller/controller.php";
		include '../view/errorPage.php';
	}
}

function getMember($memberID) {
	try {
		$db = getDBConnection();
		$query = "SELECT * FROM member WHERE MemberID = :memberID ";
		$statement = $db->prepare($query);
		$statement->bindValue(":memberID", $memberID);
		$statement->execute();
		$result = $statement->fetch();
		$statement->closeCursor();
		return $result;
	} catch (PDOException $e) {
		$errorMessage = $e->getMessage();
		$previousPage = "../controller/allMembers.php";
		include '../view/errorPage.php';
	}
}

function getMembersByGeneralSearch($criteria) {
	try {
		$criteria = "%" . $criteria . "%";
		$db = getDBConnection();
		$query = "select * from member where fName like :criteria or lName like :criteria order by lName, fName";
		$statement = $db->prepare($query);
		$statement->bindValue(":criteria", $criteria);
		$statement->execute();
		$results = $statement->fetchAll();
		$statement->closeCursor();
		return $results;		   // Assoc Array of indexed arrays
	} catch (PDOException $e) {
		$errorMessage = $e->getMessage();
		$previousPage = "../controller/controller.php?action=searchMembers";
		include '../view/errorPage.php';
	}
}

function getMembersByMajor($criteria) {
	try {
		$db = getDBConnection();
		$query = "select * from member where major = :criteria order by lName, fName";
		$statement = $db->prepare($query);
		$statement->bindValue(":criteria", $criteria);
		$statement->execute();
		$results = $statement->fetchAll();
		$statement->closeCursor();
		return $results;		   // Assoc Array of indexed arrays
	} catch (PDOException $e) {
		$errorMessage = $e->getMessage();
		$previousPage = "../controller/controller.php?action=searchMembers";
		include '../view/errorPage.php';
	}
}

function insertMember($fName, $lName, $email, $major, $memberType, $nerdScore, $gameGenre, $joinDate, $activeMember) {
	try {
		$db = getDBConnection();
		$query = 'INSERT INTO member (fName, lName, email, major, memberType, nerdScore, gameGenre, joinDate, activeMember)
							     VALUES (:fName, :lName, :email, :major, :memberType, :nerdScore, :gameGenre, :joinDate, :activeMember)';
		$statement = $db->prepare($query);
		$statement->bindValue(':fName', $fName);
		$statement->bindValue(':lName', $lName);
		$statement->bindValue(':email', $email);
		$statement->bindValue(':major', $major);
		$statement->bindValue(':memberType', $memberType);
		$statement->bindValue(':nerdScore', $nerdScore);
		if (empty($gameGenre)) {
			$statement->bindValue(':gameGenre', null, PDO::PARAM_NULL);
		} else {
			$statement->bindValue(':gameGenre', $gameGenre);
		}
		$statement->bindValue(':joinDate', toMySQLDate($joinDate));
		$statement->bindValue(':activeMember', $activeMember);
		$success = $statement->execute();
		$row_count = $statement->rowCount();
		$statement->closeCursor();

		return $db->lastInsertId(); // Get generated MemberID
	} catch (PDOException $e) {
		$errorMessage = $e->getMessage();
		include '../view/errorPage.php';
	}
}

function updateMember($memberID, $fName, $lName, $email, $major, $memberType, $nerdScore, $gameGenre, $joinDate, $activeMember) {
	try {
		$db = getDBConnection();
		$query = 'UPDATE member SET fName = :fName, lName = :lName, email = :email, major = :major, memberType = :memberType, nerdScore = :nerdScore, gameGenre = :gameGenre, joinDate = :joinDate, activeMember = :activeMember
					WHERE memberID = :memberID';
		$statement = $db->prepare($query);
		$statement->bindValue(':memberID', $memberID);
		$statement->bindValue(':fName', $fName);
		$statement->bindValue(':lName', $lName);
		$statement->bindValue(':email', $email);
		$statement->bindValue(':major', $major);
		$statement->bindValue(':memberType', $memberType);
		$statement->bindValue(':nerdScore', $nerdScore);
		if (empty($gameGenre)) {
			$statement->bindValue(':gameGenre', null, PDO::PARAM_NULL);
		} else {
			$statement->bindValue(':gameGenre', $gameGenre);
		}
		$statement->bindValue(':joinDate', toMySQLDate($joinDate));
		$statement->bindValue(':activeMember', $activeMember);
		$success = $statement->execute();
		$row_count = $statement->rowCount();
		$statement->closeCursor();
		return $row_count;
	} catch (PDOException $e) {
		$errorMessage = $e->getMessage();
		include '../view/errorPage.php';
	}
}

function removeMember($memberID) {
	try {
		$db = getDBConnection();
		$query = "DELETE FROM member WHERE MemberID = :memberID ";
		$statement = $db->prepare($query);
		$statement->bindValue(":memberID", $memberID);
		$statement->execute();
		//$result = $statement->fetch();
		$row_count = $statement->rowCount();
		$statement->closeCursor();
		return $row_count;
		//return $result;
	} catch (PDOException $e) {
		$errorMessage = $e->getMessage();
		$previousPage = "../controller/allMembers.php";
		include '../view/errorPage.php';
	}
}

function officerLookup() {
	try {
		$db = getDBConnection();
		$query = "SELECT * FROM member WHERE memberType != 'Normal'";
		$statement = $db->prepare($query);
		$statement->execute();
		$results = $statement->fetchAll();
		$statement->closeCursor();
		return $results;		   // Assoc Array of indexed arrays
	} catch (PDOException $e) {
		$errorMessage = $e->getMessage();
		$previousPage = "../controller/controller.php?action=searchMembers";
		include '../view/errorPage.php';
	}
}

function getDBConnection() {
	$dsn = 'mysql:host=localhost;dbname=s_mjgaydash_techfloor';
	$username = 's_mjgaydash';
	$password = 'techfloor99';
	//$username = 'root';
	//$password = '';
	$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
	try {
		$db = new PDO($dsn, $username, $password, $options);
	} catch (PDOException $e) {
		$errorMessage = $e->getMessage();
		$previousPage = "../controller/controller.php";
		include '../view/errorPage.php';
	}
	return $db;
}

?>
