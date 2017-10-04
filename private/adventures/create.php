<?php include_once '../../config.php'; checkLogin(); 





if(isset($_POST["cancel"])) {
	header("Location: index.php" );
}




?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php include_once '../../templates/head.php'; ?>
	</head>
	<body>

		<?php include_once '../../templates/menu.php'; ?>
	<form method="post">
		<div class="row">
			<div class="large-4 columns large-centered">
				
					<div class="row">
						<div class="large-12 columns">
							<fieldset class="fieldset">
								<legend>Adventure</legend>
								<label for="title">Title:</label>
								<input type="text" name="title" id="title" />
	
								<label for="dm">Dungeon Master:</label>
								<input type="text" name="dm" id="dm" />
								
								<label for="synopsis">Synopsis:</label>
								<textarea id="synopsis" name="synopsis" rows="10px"></textarea>
								
								
								<input class="button expanded" type="submit" value="Create" />
								<input class="alert button expanded"  name="cancel" type="submit" value="Cancel" />
							</fieldset>
					
						
						
					</div>
					
					
				</div>
			</div>
		</div>			
	</form>	
		<?php

		include_once '../../templates/scripts.php';
		?>
	</body>
</html>