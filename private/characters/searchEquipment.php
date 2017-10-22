<?php include_once '../../config.php'; checkLogin();


if(isset($_GET["pc"])) {
	$query = "select distinct a.name, b.pc, a.id
		  	from equipment a
		  	inner join pc_equipment b on a.id = b.equipment
		  	where a.name like :cond limit 10";
	$stmt = $conn->prepare($query);
	$stmt->execute(array("cond" => "%" . $_GET["term"] . "%"));
	echo json_encode($stmt->fetchAll(PDO::FETCH_OBJ));
}
