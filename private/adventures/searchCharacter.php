<?php include_once '../../config.php'; checkLogin(); 

if(isset($_GET["adventure"])) {
	$query = "select distinct a.name, a.id
			from pc a
			inner join player_adventure b on a.id = b.pc
			where a.name like :cond 
			and a.id not in (select pc from player_adventure where adventure = :adventure)";
	$stmt = $conn->prepare($query);
	$stmt->execute(array("adventure" => $_GET["adventure"], "cond" => "%" . $_GET["term"] . "%"));
	echo json_encode($stmt->fetchAll(PDO::FETCH_OBJ));
}

