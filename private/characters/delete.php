<?php include_once '../../config.php'; checkLogin(); 

if(isset($_GET["id"])){
	$conn->beginTransaction();
		
		$stmt=$conn->prepare("select id from stat where pc=:pc"); //select stat id connected to pc
		$stmt->execute(array("pc" => $_GET["id"]));
		$statId = $stmt->fetchColumn(); //store value of stat id
				
		$stmt=$conn->prepare("delete from stat where id=:id" ); //delete stat row
		$stmt->execute(array("id" => $statId));
		
		$stmt=$conn->prepare("select id from player_adventure where pc = :pc"); // query to find id in player_adventure table
		$stmt->execute(array("pc" => $_GET["id"]));
		$linkId = $stmt->fetchColumn(); //store it in variable
		
		$stmt= $conn->prepare("delete from player_adventure where id = :id"); 
		$stmt->execute(array("id" => $linkId));
		
		$stmt = $conn->prepare("delete from pc where id = :id");
		$stmt->execute(array("id" => $_GET["id"]));
		
		$conn->commit();

	header("location: index.php");
}

