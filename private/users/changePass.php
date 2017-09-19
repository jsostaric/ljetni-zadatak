<?php
include_once '../../config.php'; checkLogin();


//pass id with GET method
if(isset($_GET["id"])) {
	$stmt = $conn->prepare("select * from player where id = :id");
	$stmt->execute(array("id" => $_GET["id"]));
	$user = $stmt->fetch(PDO::FETCH_OBJ);
} else {
	header("location: index.php");
}


// if update triggered update db player table
if(isset($_POST["change"])) {
	$stmt = $conn->prepare("update player set password=md5(:password) where id=:id");
	$stmt->execute(array("password"=>$_POST["password"], "id"=>$_POST["id"]));
	
	header("location: index.php");
}





?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php
		include_once '../../templates/head.php';
		?>
	</head>
	<body>

		<?php
	include_once '../../templates/menu.php';
		?>

		
		<div class="row">
			<div class="large-12 columns">
				<div class="row">
					<div class="large-3 columns large-centered">
						<div class="callout">
							<form method="post">
								<label for="password">Password:</label>
								<input type="password" name="password" id="password" />
								
								<input class="button expanded" type="submit" name="change" value="Change" />
								
								<input type="hidden" name="id" value="<?php echo $user->id; ?>" />
								
								<a href="index.php" class="alert button expanded">Cancel</a>
							</form>

						</div>
					</div>
				</div>
			</div>
		</div>


		<?php

		include_once '../../templates/scripts.php';
		?>
	</body>
</html>