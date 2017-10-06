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
	$stmt = $conn->prepare("update player set username=:username, email=:email where id=:id");
	$stmt->execute(array("username" => $_POST["username"], "email" => $_POST["email"], "id" => $_POST["id"]));
	header("location: index.php");
}

if(isset($_POST["cancel"])) {
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
								<label for="username">Name:</label>
								<input type="text" name="username" id="username" placeholder="Enter your name" value="<?php echo $user->username; ?>" />

								<!--<label for="password">Password:</label>
								<input type="password" name="password" id="password" />-->

								<label for="email">Email:</label>
								<input type="email" name="email" id="email" value="<?php echo $user->email; ?>" />

								<input class="button expanded" type="submit" name="change" value="Update" />
								
								<input type="hidden" name="id" value="<?php echo $user->id; ?>" />
								
								<input class="alert button expanded" type="submit" name="cancel" value="Cancel" />
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