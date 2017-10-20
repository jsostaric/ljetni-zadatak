<?php
include_once '../../config.php'; checkLogin();

$conn->beginTransaction();

$stmt = $conn->prepare("insert into pc(name,race,class, level, background) 
						values('','','','','' )");
$stmt->execute();
$last = $conn->lastInsertId();

$stmt = $conn->prepare("insert into player_adventure(player,adventure,pc) values(:player,:adventure,:pc)");
	$stmt->execute(array("player" => $_SESSION["session"]->id, "adventure" => 1, "pc" => $last));

$stmt = $conn->prepare("insert into stat(strength,dexterity,constitution,intelligence,wisdom,charisma, pc)
		values(10,10,10,10,10,10, '" . $last ."')");
$stmt->execute();		

$conn->commit();

header("location: edit.php?id=" . $last);

