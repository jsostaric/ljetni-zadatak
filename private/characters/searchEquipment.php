<?php include_once '../../config.php'; checkLogin();


if(isset($_GET["pc"])) {
	$query = "select a.name, a.id
		  	from equipment a
		  	where a.name like :cond limit 10";
	$stmt = $conn->prepare($query);
	$stmt->execute(array("cond" => "%" . $_GET["term"] . "%"));
	echo json_encode($stmt->fetchAll(PDO::FETCH_OBJ));
}
