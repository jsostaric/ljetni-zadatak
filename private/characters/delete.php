<?php include_once '../../config.php'; checkLogin(); 

if(isset($_GET["id"])){
	$stmt=$conn->prepare("delete from pc where id=:id");
	$stmt->execute(array("id"=>$_GET["id"]));

	header("location: index.php");
}

