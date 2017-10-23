<?php include_once '../../config.php'; checkLogin();

if(isset($_GET["adventure"]) && isset($_GET["pc"]) && isset($_GET["player"])){
	$stmt = $conn->prepare("delete from player_adventure where  adventure=:adventure and pc=:pc  and player=:player ");
	$stmt->execute($_GET);
	echo "ok";
}
