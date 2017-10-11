<?php
include_once '../../config.php'; checkLogin();
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
		
		<div class="row">
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
							<?php  
							if(isset($_GET['id'])) {
								$query = "select * from pc where id = :id";
							$stmt = $conn->prepare($query);
							$stmt->execute(array("id"=> $_GET["id"]));
							$result = $stmt->fetchAll(PDO::FETCH_OBJ);
							
							}
							
							foreach($result as $row):
								
							 ?>
							
							<tr>
								<td><?php echo $row->name; ?></td>
								<td><?php echo $row->race; ?></td>
								<td><?php echo $row->class; ?></td>
								<td><?php echo $row->level; ?></td>
								<td><?php echo $row->background; ?></td>
								<td><?php echo $row->alignment; ?></td>
								<td><?php echo $row->hd; ?></td>
								<td><?php echo $row->hp; ?></td>
								<td><?php echo $row->proficiency; ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>	
				</table>
				
				<div class="large-6 columns">
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
							  <tr>
							 	<th></th>
							 	<th>Ability Score</th>
							 	<th>Modifier</th>
							 	<td></td>
							 	<th>Saving Throws</th>
							 </tr>
							<tr>
								<th>Strength</th>
								<td><?php echo $row->strength; ?></td>
								<td><?php echo calculateModifier($row->strength); ?></td>
								<td></td>
								<td><input type="checkbox" name="proff"  /> 
									<?php echo calculateModifier($row->strength); ?>
								</td>
							</tr>
							<tr>
								<th>Dexterity</th>
								<td><?php echo $row->dexterity; ?></td>
								<td><?php echo calculateModifier($row->dexterity); ?></td>
								<td></td>
								<td><input type="checkbox" name="proff"  /> <?php echo calculateModifier($row->dexterity); ?></td>
							</tr>
							<tr>	
								<th>Constitution</th>
								<td><?php echo $row->constitution; ?></td>
								<td><?php echo calculateModifier($row->constitution); ?></td>
								<td></td>
								<td><input type="checkbox" name="proff"  /> <?php echo calculateModifier($row->constitution); ?></td>
							</tr>
							<tr>
								<th>Intelligence</th>
								<td><?php echo $row->intelligence; ?></td>
								<td><?php echo calculateModifier($row->intelligence); ?></td>
								<td></td>
								<td><input type="checkbox" name="proff"  /> <?php echo calculateModifier($row->intelligence); ?></td>
							</tr>
							<tr>
								<th>Wisdom</th>
								<td><?php echo $row->wisdom; ?></td>
								<td><?php echo calculateModifier($row->wisdom); ?></td>
								<td></td>
								<td><input type="checkbox" name="proff"  /> <?php echo calculateModifier($row->wisdom); ?></td>
							</tr>
							<tr>
								<th>Charisma</th>
								<td><?php echo $row->charisma; ?></td>
								<td><?php echo calculateModifier($row->charisma); ?></td>
								<td></td>
								<td><input type="checkbox" name="proff"  /> <?php echo calculateModifier($row->charisma); ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>	
				</table>
				</div>
				
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
							  <tr>
							  	<th></th>
							  	<th></th>
							 	<th>Skills</th>
							 </tr>
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
				
				<div class="row">
			<div class="large-8 columns large-centered">
				<div class="large-4 columns">
					<a href="#" class="success button centered expanded">Update</a> 
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