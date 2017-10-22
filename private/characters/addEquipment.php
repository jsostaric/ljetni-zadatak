<?php include_once '../../config.php'; checkLogin();

if(isset($_GET["pc"]) && isset($_GET["equipment"])) {
	$stmt = $conn->prepare("insert into pc_equipment(pc,equipment,quantity) values(:pc,:equipment,:quantity)");
	$stmt->execute($_GET);
	echo "ok";
}
