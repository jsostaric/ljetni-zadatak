<?php 


function checkLogin() {
	if(!isset($_SESSION["session"])) {
		header("location: ". $GLOBALS["route"] . "public/login.php?stop");
		exit;
	}
}



// calculates modifier based on ability scores
function calculateModifier($param) {
	switch($param) {
		case 1:
			return -5;
		break;
		
		case 2:
		case 3:
			return -4;
		break;
		
		case 4:
		case 5:
			return -3;
		break;
		
		case 6:
		case 7:
			return -2;
		break;
		
		case 8:
		case 9:
			return -1;
		break;
		
		case 10:
		case 11:
			return 0;
		break;
		
		case 12:
		case 13:
			return "+1";
		break;
		
		case 14:
		case 15:
			return "+2";
		break;
		
		case 16:
		case 17:
			return "+3";
		break;
		
		case 18:
		case 19:
			return "+4";
		break;
		
		case 20:
		case 21:
			return "+5";
		break;
		
		case 22:
		case 23:
			return "+6";
		break;
	}
}

