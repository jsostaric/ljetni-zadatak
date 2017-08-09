<?php 
include_once 'config.php';


if(!isset($_POST["name"]) || !isset($_POST["password"])){
	header("location: " . $route . "public/login.php");
}



//prepare query
$stmt = $conn->prepare("SELECT * FROM player where username = :username AND password = md5(:password)");

// using array find user in db
$stmt->execute(array("username" => trim($_POST["name"]), "password"=>$_POST["password"]));

// fetch object
$user = $stmt->fetch(PDO::FETCH_OBJ);

//if stmt  where user log successfully or did not
if($user !=null) {
	$_SESSION["session"] = $user;
	header("location: " . $route . "private/dashboard.php");
} else {
	header("location: " . $route . "public/login.php?oops=" . $_POST["name"]);
}
