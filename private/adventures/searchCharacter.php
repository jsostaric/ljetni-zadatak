<?php include_once '../../config.php'; checkLogin(); 

if(isset($_GET["adventure"])) {
	$query = "select b.name, b.id, c.id as player
				from player_adventure a
				inner join pc b on a.pc=b.id
				inner join player c on c.id=a.player				
				where b.name like :cond and b.id not in (select pc from player_adventure where adventure = :adventure);";
	$stmt = $conn->prepare($query);
	$stmt->execute(array("adventure" => $_GET["adventure"], "cond" => "%" . $_GET["term"] . "%"));
	echo json_encode($stmt->fetchAll(PDO::FETCH_OBJ));
}

