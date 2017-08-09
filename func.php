<?php 


function checkLogin() {
	if(!isset($_SESSION["session"])) {
		header("location: ". $GLOBALS["route"] . "public/login.php?stop");
		exit;
	}
}
