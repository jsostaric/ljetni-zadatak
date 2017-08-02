<?php include_once '../config.php'; ?>

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
							<form method="post" action="<?php $route; ?>reg.php">
								<label for="name">Name:</label>
								<input type="" name="name" id="name" value="" placeholder="Enter Your Username"  />
								<label for="password">Password:</label>
								<input type="password" name="password" id="password" placeholder="Enter Your Password"  />
								
								<input class="button expanded" type="sumbit" name="submit" value="Login" />
							</form>
						
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php include_once '../templates/scripts.php'; ?>
	</body>
</html>