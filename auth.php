<?php 

include_once 'config.php';


if(!isset($_POST["name"]) || !isset($_POST["password"])){
	header("location: " . $route . "public/login.php");
}

if($_POST["name"] === "edunova" && $_POST["password"] === "edunova") {
	$_SESSION["session"] = $_POST["name"];
	header("location: " . $route . "private/dashboard.php");
}else {
	header("location: " . $route . "public/login.php?fail=" . $_POST["name"]);
}
