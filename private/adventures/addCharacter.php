<?php include_once '../../config.php'; checkLogin();

if(isset($_GET["adventure"]) && isset($_GET["pc"]) && isset($_GET["player"])) {
	$stmt = $conn->prepare("insert into player_adventure(player,adventure,pc) values(:player,:adventure,:pc)");
	$stmt->execute($_GET);
	echo "ok";
}
