<?php include_once '../../config.php'; checkLogin(); ?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php include_once '../../templates/head.php'; ?>
	</head>
	<body>

		<?php include_once '../../templates/menu.php'; ?>
	<form method="post">
		<div class="row">
			<div class="large-8 columns large-centered">
				<div class="callout">
					<div class="row">
						<div class="large-6 columns">
							<fieldset class="fieldset">
								<legend>Character</legend>
								<label for="name">Name:</label>
								<input type="text" name="name" id="name" />
	
								<label for="race">Race:</label>
								<input type="text" name="race" id="race" />
								
								<label for="class">Class:</label>
								<input type="text" name="class" id="class" />
								
								<label for="level">LEVEL:</label>
								<input type="text" name="level" id="level" />
								
								<label for="background">Background:</label>
								<input type="text" name="background" id="background" />
								
								<label for="alignmemt">Alignment:</label>
								<input type="text" name="alignment" id="alignment" />
	
								<label for="hp">Hit Points:</label>
								<input type="text" name="hp" id="hp" />
								
								<label for="hd">Hit Dice:</label>
								<input type="text" name="hd" id="hd" />
								
								<label for="proff">Proficiency:</label>
								<input type="text" name="proff" id="proff" />
							</fieldset>
						</div>
						
						<div class="large-6 columns">
							<fieldset class="fieldset">
								<legend>Ability Scores</legend>
								<label for="strength">Strength:</label>
								<input type="text" name="strength" id="name" />
	
								<label for="dexterity">Dexterity:</label>
								<input type="text" name="dexterity" id="dexterity" />
	
								<label for="constitution">Constitution:</label>
								<input type="text" name="constitution" id="constitution" />
								
								<label for="intelligence">Intelligence:</label>
								<input type="text" name="intelligence" id="intelligence" />
							
								<label for="wisdom">Wisdom:</label>
								<input type="text" name="wisdom" id="wisdom" />
	
								<label for="charisma">Charisma:</label>
								<input type="text" name="charisma" id="charisma" />
							
								
							</fieldset>
						</div>
					</div>
					
					<input class="button expanded" type="submit" value="Create" />
					<input class="alert button expanded" type="submit" value="Cancel" />
				</div>
			</div>
		</div>			
	</form>	
		<?php

		include_once '../../templates/scripts.php';
		?>
	</body>
</html>