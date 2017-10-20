<?php
include_once '../../config.php'; checkLogin();

if(isset($_GET["id"])) {
	$query = "select * from pc where id = :id";
	$stmt = $conn->prepare($query);
	$stmt->execute(array("id" => $_GET["id"]));
	$entity = $stmt->fetch(PDO::FETCH_OBJ);
}

//making changes
if(isset($_POST["submit"])) {
	
	$conn->beginTransaction();
	
	$stmt = $conn->prepare("update pc set name=:name, race=:race, class=:class, level=:level, background=:background, alignment=:alignment, hd=:hd, hp=:hp, proficiency=:proficiency where id=:id");
	$stmt->execute(array(
		"name" 			=> $_POST["name"],
		"race" 			=> $_POST["race"],
		"class" 		=> $_POST["class"],
		"level" 		=> $_POST["level"],
		"background" 	=> $_POST["background"],
		"alignment" 	=> $_POST["alignment"],
		"hd" 			=> $_POST["hd"],
		"hp" 			=> $_POST["hp"],
		"proficiency" 	=> $_POST["proficiency"],
		"id"			=> $_POST["id"]	
	));	
	
	$stmt = $conn->prepare("update stat set strength=:str, dexterity=:dex, constitution=:con, intelligence=:int, wisdom=:wis, charisma=:cha where pc=:pc");
	$stmt->execute(array(
		"str" 	=> $_POST["str"],
		"dex" 	=> $_POST["dex"],
		"con" 	=> $_POST["con"],
		"int" 	=> $_POST["int"],
		"wis" 	=> $_POST["wis"],
		"cha" 	=> $_POST["cha"],
		"pc"	=> $_POST["id"]
	));
	
	
	
	
	$conn->commit();
	
	header("location: index.php");
}

//canceling and deleting creation of new character - works
if(isset($_POST["cancel"])) {
	if($_POST["name"] == "") {
		
		$conn->beginTransaction();
		
		$stmt=$conn->prepare("select id from stat where pc=:pc"); //select stat id connected to pc
		$stmt->execute(array("pc" => $_POST["id"]));
		$statId = $stmt->fetchColumn(); //store value of stat id
				
		$stmt=$conn->prepare("delete from stat where id=:id" ); //delete stat row
		$stmt->execute(array("id" => $statId));
		
		$stmt=$conn->prepare("select id from player_adventure where pc = :pc"); // query to find id in player_adventure table
		$stmt->execute(array("pc" => $_POST["id"]));
		$linkId = $stmt->fetchColumn(); //store it in variable
		
		$stmt= $conn->prepare("delete from player_adventure where id = :id"); 
		$stmt->execute(array("id" => $linkId));
		
		$stmt = $conn->prepare("delete from pc where id = :id");
		$stmt->execute(array("id" => $_POST["id"]));
		
		$conn->commit();
	}
	
	header("Location: index.php" );
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
		
		<?php include_once '../../templates/menu.php'; ?>
		<form method="post">
		<div class="row">
			<!-- upper table with name, race, class -->
			<div class="large-6 columns large-centered">
				<table>
						<thead>
							<tr>
								<th>Name</th>
								<th>Race</th>
								<th>Class</th>
								<th>Level</th>
								<th>Background</th>
								<th>Alignment</th>
								<th>Hit Dice</th>
								<th>Hit Points</th>
								<th>Proficiency</th>
							</tr>
						</thead>
						
						<tbody>
							<tr>
								<td><input type="text" name="name" value="<?php echo $entity->name; ?>" /></td>
								<td><input type="text" name="race" value="<?php echo $entity->race; ?>" /></td>
								<td><input type="text" name="class" value="<?php echo $entity->class; ?>" /></td>
								<td><input type="text" name="level" value="<?php echo $entity->level; ?>" /></td>
								<td><input type="text" name="background" value="<?php echo $entity->background; ?>" /></td>
								<td><input type="text" name="alignment" value="<?php echo $entity->alignment; ?>" /></td>
								<td><input type="text" name="hd" value="<?php echo $entity->hd; ?>" /></td>
								<td><input type="text" name="hp" value="<?php echo $entity->hp; ?>" /></td>
								<td><input type="text" name="proficiency" value="<?php echo $entity->proficiency; ?>" /></td>
							</tr>
						</tbody>	
				</table>
				
				<!-- left table with stats, ability scores, modifiers and saving throws -->
				<div class="large-6 columns">
				<table>
						<thead>
							  <tr>
							 	<th></th>
							 	<th>Ability Score</th>
							 	<th>Modifier</th>
							 	<td></td>
							 	<th>Saving Throws</th>
							 </tr>
						</thead>
						
						<tbody>
							<?php  
							$query = "select a.*, b.proficiency
										from stat a 
										inner join pc b on a.pc = b.id where a.pc=:id";
							$stmt = $conn->prepare($query);
							$stmt->execute(array("id"=> $_GET["id"]));
							$result = $stmt->fetchAll(PDO::FETCH_OBJ);
							
							foreach($result as $row):
								
							 ?>
							 
							<tr>
								<th>Strength</th>
								<td><input type="text" name="str" value="<?php echo $row->strength; ?>" /></td>
								<td><?php echo calculateModifier($row->strength); ?></td>
								<td></td>
								<td><input type="checkbox" name="proff"  /> 
									<?php echo calculateModifier($row->strength); ?>
								</td>
							</tr>
							<tr>
								<th>Dexterity</th>
								<td><input type="text" name="dex" value="<?php echo $row->dexterity; ?>" /></td>
								<td><?php echo calculateModifier($row->dexterity); ?></td>
								<td></td>
								<td><input type="checkbox" name="proff"  /> <?php echo calculateModifier($row->dexterity); ?></td>
							</tr>
							<tr>	
								<th>Constitution</th>
								<td><input type="text" name="con" id="class" value="<?php echo $row->constitution; ?>" /></td>
								<td><?php echo calculateModifier($row->constitution); ?></td>
								<td></td>
								<td><input type="checkbox" name="proff"  /> <?php echo calculateModifier($row->constitution); ?></td>
							</tr>
							<tr>
								<th>Intelligence</th>
								<td><input type="text" name="int" value="<?php echo $row->intelligence; ?>" /></td>
								<td><?php echo calculateModifier($row->intelligence); ?></td>
								<td></td>
								<td><input type="checkbox" name="proff"  /> <?php echo calculateModifier($row->intelligence); ?></td>
							</tr>
							<tr>
								<th>Wisdom</th>
								<td><input type="text" name="wis" value="<?php echo $row->wisdom; ?>" /></td>
								<td><?php echo calculateModifier($row->wisdom); ?></td>
								<td></td>
								<td><input type="checkbox" name="proff"  /> <?php echo calculateModifier($row->wisdom); ?></td>
							</tr>
							<tr>
								<th>Charisma</th>
								<td><input type="text" name="cha" value="<?php echo $row->charisma; ?>" /></td>
								<td><?php echo calculateModifier($row->charisma); ?></td>
								<td></td>
								<td><input type="checkbox" name="proff"  /> <?php echo calculateModifier($row->charisma); ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>	
				</table>
				</div>
				
				<!-- right table with skills -->
				<div class="large-4 columns">
				<table>
						<tbody>
							<?php  
							$query = "select a.*, b.proficiency
										from stat a 
										inner join pc b on a.pc = b.id where a.pc=:id";
							$stmt = $conn->prepare($query);
							$stmt->execute(array("id"=> $_GET["id"]));
							$result = $stmt->fetchAll(PDO::FETCH_OBJ);
							
							foreach($result as $row):
							 ?>
							 <thead>
							  <tr>
							  	<th></th>
							  	<th></th>
							 	<th style="text-align: center;">Skills</th>
							 </tr>
							 </thead>
							<tr>
								<td><input type="checkbox" name="proff"  /> </td>
									<td><?php echo calculateModifier($row->dexterity); ?></td>
								<th>Acrobatics<span style="color: grey;">(Dex)</span></th>
							</tr>
							
							<tr>
								<td><input type="checkbox" name="proff"  /> </td>
									<td><?php echo calculateModifier($row->wisdom); ?></td>
								<th>Animal Handling<span style="color: grey;">(Wis)</span></th>
							</tr>
							
							<tr>
								<td><input type="checkbox" name="proff"  /> </td>
									<td><?php echo calculateModifier($row->intelligence); ?></td>
								<th>Arcana<span style="color: grey;">(Int)</span></th>
							</tr>
							
							<tr>
								<td><input type="checkbox" name="proff"  /> </td>
									<td><?php echo calculateModifier($row->strength); ?></td>
								<th>Athletics<span style="color: grey;">(Str)</span></th>
							</tr>
							
							<tr>
								<td><input type="checkbox" name="proff"  /> </td>
									<td><?php echo calculateModifier($row->charisma); ?></td>
								<th>Deception<span style="color: grey;">(Cha)</span></th>
							</tr>
							
							<tr>
								<td><input type="checkbox" name="proff"  /> </td>
									<td><?php echo calculateModifier($row->intelligence); ?></td>
								<th>History<span style="color: grey;">(Int)</span></th>
							</tr>
							
							<tr>
								<td><input type="checkbox" name="proff"  /> </td>
									<td><?php echo calculateModifier($row->wisdom); ?></td>
								<th>Insight<span style="color: grey;">(Wis)</span></th>
							</tr>
							
							<tr>
								<td><input type="checkbox" name="proff"  /> </td>
									<td><?php echo calculateModifier($row->charisma); ?></td>
								<th>Intimidation<span style="color: grey;">(Cha)</span></th>
							</tr>
							
							<tr>
								<td><input type="checkbox" name="proff"  /> </td>
									<td><?php echo calculateModifier($row->intelligence); ?></td>
								<th>Investigation<span style="color: grey;">(Int)</span></th>
							</tr>
							
							<tr>
								<td><input type="checkbox" name="proff"  /> </td>
									<td><?php echo calculateModifier($row->wisdom); ?></td>
								<th>Medicine<span style="color: grey;">(Wis)</span></th>
							</tr>
							
							<tr>
								<td><input type="checkbox" name="proff"  /> </td>
									<td><?php echo calculateModifier($row->intelligence); ?></td>
								<th>Nature<span style="color: grey;">(Int)</span></th>
							</tr>
							
							<tr>
								<td><input type="checkbox" name="proff"  /> </td>
									<td><?php echo calculateModifier($row->wisdom); ?></td>
								<th>Perception<span style="color: grey;">(Wis)</span></th>
							</tr>
							
							<tr>
								<td><input type="checkbox" name="proff"  /> </td>
									<td><?php echo calculateModifier($row->charisma); ?></td>
								<th>Performance<span style="color: grey;">(Cha)</span></th>
							</tr>
							
							<tr>
								<td><input type="checkbox" name="proff"  /> </td>
									<td><?php echo calculateModifier($row->charisma); ?></td>
								<th>Persuasion<span style="color: grey;">(Cha)</span></th>
							</tr>
							
							<tr>
								<td><input type="checkbox" name="proff"  /> </td>
									<td><?php echo calculateModifier($row->intelligence); ?></td>
								<th>Religion<span style="color: grey;">(Int)</span></th>
							</tr>
							
							<tr>
								<td><input type="checkbox" name="proff"  /> </td>
									<td><?php echo calculateModifier($row->dexterity); ?></td>
								<th>Stealth<span style="color: grey;">(Dex)</span></th>
							</tr>
							
							<tr>
								<td><input type="checkbox" name="proff"  /> </td>
									<td><?php echo calculateModifier($row->wisdom); ?></td>
								<th>Survival<span style="color: grey;">(Wis)</span></th>
							</tr>
							<?php endforeach; ?>
						</tbody>	
				</table>
				</div>
				
			
				<input class="succes button expanded"  name="submit" type="submit" value="<?php if($entity->name == "") {
										echo "Create";
									} else{
										echo "Change";
									} ?>" /> 
				
				<input type="hidden" name="id" value="<?php echo $entity->id; ?>" />
									
				<input class="alert button expanded"  name="cancel" type="submit" value="Cancel" />
			</div>
		</div>
		</form>
		<?php
		include_once '../../templates/scripts.php';
		?>
	</body>
</html>