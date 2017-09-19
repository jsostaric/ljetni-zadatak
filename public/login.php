<?php
include_once '../config.php';

?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php
		include_once '../templates/head.php';
		?>
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
							<form method="post" action="<?php echo $route; ?>auth.php">
					          	<label for="name">Name:</label>
					          	<input type="text" name="name" id="name" placeholder="Enter your name" value="<?php echo isset($_GET["name"]) ? $_GET["name"] : ""; ?>" />
					          	
					          	<label for="password">Password:</label>
					          	<input type="password" name="password" id="password" placeholder="e" />
					          	
					          	<input class="button alert expanded" type="submit" name="submit" value="Submit" />
				          		</form>
				          		
							<?php if(isset($_GET["oops"])) {
								echo "Wrong name or password!";
							} 
							
							if(isset($_GET["success"])) {
								echo "Registered! Try to log in.";
							}
							
							if(isset($_GET["stop"])) {
								echo "Please, log in first!";
							}
							
							?>
						
						
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