<?php include_once '../../config.php'; checkLogin(); 

$stmt = $conn->prepare("insert into adventure(name,dm,synopsis) values('',1,'')");
$stmt->execute();
$last = $conn->lastInsertId();

header("location: edit.php?id=" . $last);
