<?php include_once '../config.php'; ?>

<?php 

if(isset($_POST["name"])) {
	$izraz = $conn->prepare("INSERT INTO player(user_name, password, email) values(:user_name, md5(:password), :email)");
	$uneseno = $izraz->execute($_POST);
}
 ?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php include_once '../templates/head.php'; ?>
	</head>
	<body>
		
		<?php include_once '../templates/menu.php'; ?>
		
		<div class="row">
			<div class="large-12 columns large-centered">
				<h1 style="text-align: center;">TRUE SIGHT</h1>
				<p style="text-align: center;">Characters and Adventures at your hand.</p>
			</div>
		</div>
		
		<div class="row">
			<div class="large-12 columns">
				<div class="row">
					<div class="large-3 columns large-centered">
						<div class="callout">
							<form method="post">
					          	<label for="name">Name:</label>
					          	<input type="text" name="name" id="name" placeholder="Enter your name" value="<?php echo isset($_GET["name"]) ? $_GET["name"] : ""; ?>" />
					          	
					          	<label for="email">Email:</label>
					          	<input type="email" name="email" id="email" />
					          	
					          	<label for="password">Password:</label>
					          	<input type="password" name="password" id="password" />
					          	
					          	<input class="button expanded" type="submit" name="submit" value="Register" />
				          		</form>
				          		
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php include_once '../templates/scripts.php'; ?>
	</body>
</html>