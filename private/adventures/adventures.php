<?php include_once '../../config.php'; checkLogin(); ?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php include_once '../../templates/head.php';	?>
	</head>
	<body>
		
		<?php include_once '../../templates/menu.php'; ?>
		
		<div class="row">
			<div class="large-8 columns large-centered">
				<div class="row">
					<div class="large-5 columns callout">
						<h3>Characters</h3>
						
						<table>
						<thead>
							<tr>
								<th>Name</th>
								<th>Race</th>
								<th>Class</th>
								<th>Level</th>
							</tr>
						</thead>
						
						<tbody>
							<?php $query = "select a.id, a.name, a.race, a.class, a.level 
										from pc a
										inner join player_adventure b on a.id = b.pc
										where b.adventure = :id"; 
								$stmt = $conn->prepare($query);
								$stmt->execute(array("id" => $_GET["id"]));
								$result = $stmt->fetchAll(PDO::FETCH_OBJ);
								
								foreach($result as $row):		
							?>
							
							<tr>
								<td><a href="<?php echo $route; ?>private/characters/chars.php?id=<?php echo $row->id; ?>"><?php echo $row->name; ?></a></td>
								<td><?php echo $row->race; ?></td>
								<td><?php echo $row->class; ?></td>
								<td><?php echo $row->level; ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>	
						</table>
						
					</div>
					
					
					<div class="large-6 columns callout">
						<?php $query = "select a.* from adventure a
						inner join player b on a.dm = b.id where a.id = :id";
						$stmt = $conn->prepare($query);
						$stmt->execute(array("id" => $_GET["id"]));
						$result = $stmt->fetchAll(PDO::FETCH_OBJ);
						
						foreach($result as $row):
						
						
						 ?>
						<h3 style="text-align: center;"><?php echo $row->name; ?></h3>
						
						<textarea name="synopsis" rows="35" readonly="true">
							<?php echo $row->synopsis; ?>
							
							
						</textarea>
						<?php endforeach; 
						
						if($row->dm == $_SESSION["session"]->id):
						?>
						<a href="edit.php?id=<?php echo $row->id; ?>" class= "success button expanded">Update</a>
						<?php endif; ?>
						<a href="index.php" class= "alert button expanded">Back</a>
						
					</div>
				</div>
			</div>
		</div>
		
		<?php
		include_once '../../templates/scripts.php';
		?>
	</body>
</html>