<?php 

session_start();

include_once 'func.php';

$title = "True Sight";


if($_SERVER["HTTP_HOST"] == "localhost") {
	$route = "/ljetni-zadatak/";
	$mysqlHost="localhost";
	$mysqlDB="dndapp";
	$mysqlUser="edunova";
	$mysqlPass="edunova";
} else if($_SERVER["HTTP_HOST"] == "jsostaric.byethost7.com") {
	$route = "/ljetniZadatak/";
	$mysqlHost="sql306.byethost7.com";
	$mysqlDB="b7_20129419_dnd";
	$mysqlUser="b7_20129419";
	$mysqlPass="Jura10os";
} else {
	$route = "/";
}


try{
	$conn = new PDO("mysql:host=".$mysqlHost.";dbname=". $mysqlDB, $mysqlUser, $mysqlPass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$conn->exec("SET CHARACTER SET utf8");
	$conn->exec("SET NAMES utf8");
}catch(PDO_Exception $e){
	echo "Somethin went wrong!";
}
