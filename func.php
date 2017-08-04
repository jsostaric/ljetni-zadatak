<?php 


function checkLogin() {
	if(!isset($_SESSION["session"])) {
		header("location: ". $GLOBALS["route"] . "index.php");
		exit;
	}
}
