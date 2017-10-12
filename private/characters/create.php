<?php
include_once '../../config.php'; checkLogin();


$stmt = $conn->prepare("insert into pc(name,race,class, level, background) 
						values('','','','','' )");
$stmt->execute();
$last = $conn->lastInsertId();

header("location: edit.php?id=" . $last);
