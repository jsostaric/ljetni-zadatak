<?php
include_once '../config.php';
checkLogin();
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
			<div class="large-9 columns large-centered">
				<div class="callout">
					<div class="row">
						
							<form action="create_submit" method="post" accept-charset="utf-8">
					
							<div class="large-3 columns">
								<label for="name">Name:</label>
								<input type="text" name="name" id="name" />
	
								<label for="race">Race:</label>
								<input type="text" name="race" id="race" />
	
								<label for="hp">Hit Points:</label>
								<input type="text" name="hp" id="hp" />
								
								<label for="proff">Proficiency:</label>
								<input type="text" name="proff" id="proff" />
							</div>
	
							<div class="large-3 columns">
								<label for="class">Class:</label>
								<input type="text" name="class" id="class" />
	
								<label for="level">LEVEL:</label>
								<input type="text" name="level" id="level" />
							</div>
	
							<div class="large-3 columns">
								
								<label for="background">Background:</label>
								<input type="text" name="background" id="background" />
								
								<label for="alignmemt">Alignment:</label>
								<input type="text" name="alignment" id="alignment" />
	
								<label for="hd">Hit Dice:</label>
								<input type="text" name="hd" id="hd" />
							</div>
	
							
							

					
						</form>
					</div>
				</div>
			</div>
		</div>

		<?php

		include_once '../templates/scripts.php';
		?>
	</body>
</html>