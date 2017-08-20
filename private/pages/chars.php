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
							$query = "select  a.*
										from pc a
										inner join player_adventure b on a.id=b.pc
										inner join player c on b.player = c.id where c.id=:id";
							$stmt = $conn->prepare($query);
							$stmt->execute(array("id"=> $_SESSION["session"]->id));
							$result = $stmt->fetchAll(PDO::FETCH_OBJ);
							
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
				
				<div class="large-2">
				<table>
						
						<tbody>
							<?php  
							$query = "select a.*
										from stat a 
										inner join pc b on a.pc = b.id where a.pc=:id";
							$stmt = $conn->prepare($query);
							$stmt->execute(array("id"=> $_SESSION["session"]->id));
							$result = $stmt->fetchAll(PDO::FETCH_OBJ);
							
							foreach($result as $row):
								
							 ?>
							<tr>
								<th>Strength</th>
								<td><?php echo $row->strength; ?></td>
							</tr>
							<tr>
								<th>Dexterity</th>
								<td><?php echo $row->dexterity; ?></td>
							</tr>
							<tr>	
								<th>Constitution</th>
								<td><?php echo $row->constitution; ?></td>
							</tr>
							<tr>
								<th>Intelligence</th>
								<td><?php echo $row->intelligence; ?></td>
							</tr>
							<tr>
								<th>Wisdom</th>
								<td><?php echo $row->wisdom; ?></td>
							</tr>
							<tr>
								<th>Charisma</th>
								<td><?php echo $row->charisma; ?></td>
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