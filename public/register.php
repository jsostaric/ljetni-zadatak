<?php
include_once '../config.php';

$err = array();



if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"])) {
	if (trim($_POST["username"]) === "") {
		$err["username"] = "Please enter a name!";
	}

	if ($_POST["password"] === "") {
		$err["password"] = "Please enter a password!";
	}

	if (trim($_POST["email"]) === "") {
		$err["email"] = "Please enter an email address!";
	}

	if (count($err == 0)) {
		try {
			$stmt = $conn -> prepare("INSERT INTO player(username, password, email) values(:username, md5(:password), :email)");
			$insert = $stmt -> execute($_POST);

			header("location: " . $route . "public/login.php?success");
		} catch(PDOException $e) {
			echo $e -> getMessage();

		}
	}
}
?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php
		include_once '../templates/head.php';
		?>
	</head>
	<body>

		<?php
	include_once '../templates/menu.php';
		?>

		<div class="row">
			<div class="large-12 columns large-centered">
				<h1 style="text-align: center;">TRUE SIGHT</h1>
				<p style="text-align: center;">
					Characters and Adventures at your hand.
				</p>
			</div>
		</div>

		<div class="row">
			<div class="large-12 columns">
				<div class="row">
					<div class="large-3 columns large-centered">
						<div class="callout">
							<form method="post">
								<label for="username">Name:</label>
								<input type="text" name="username" id="username" placeholder="Enter your name" value="<?php echo isset($_POST["username"]) ? $_POST["username"] : ""; ?>" />

								<label for="password">Password:</label>
								<input type="password" name="password" id="password" />

								<label for="email">Email:</label>
								<input type="email" name="email" id="email" />

								<input class="button expanded" type="submit" name="submit" value="Register" />
							</form>

						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
	include_once '../templates/scripts.php';
		?>
	</body>
</html>