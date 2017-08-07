<?php include_once 'config.php'; ?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php include_once 'templates/head.php'; ?>
	</head>
	<body>
		
		<?php include_once 'templates/menu.php'; ?>
		
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
							<a href="<?php $route; ?>public/login.php" class="alert button expanded">Log In</a>
							<p style="text-align: center;">or</p>
							<a href="<?php $route; ?>public/register.php" class="button expanded">Register</a>
						<?php
						if(isset($_GET["logout"])) {
								echo "You successfully logged out!";
							}  
							?>
							
						
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php include_once 'templates/scripts.php'; ?>
	</body>
</html>