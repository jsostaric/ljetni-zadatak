<?php include_once '../../config.php'; checkLogin();

if(isset($_GET["pc"]) && isset($_GET["equipment"])){
	$stmt = $conn->prepare("delete from pc_equipment where pc=:pc and equipment=:equipment");
	$stmt->execute($_GET);
	echo "ok";
}
