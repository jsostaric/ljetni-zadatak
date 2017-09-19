<?php
include_once '../../config.php'; checkLogin();

if(isset($_GET["id"])) {
	$stmt = $conn->prepare("delete from player where id=:id");
	$stmt->execute(array("id" => $_GET["id"]));
	header("location:". $route ."index.php");
}

session_destroy();

?>

