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
			<div class="large-8 columns large-centered">
				<div class="large-4 columns">
					<a href="<?php echo $route; ?>/private/create.php" class="success button centered expanded">New Character</a> 
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="large-8 columns large-centered">
				<table>
						<thead>
							<tr>
								<th>Name</th>
								<th>Race</th>
								<th>Class</th>
								<th>Level</th>
								<th>Action</th>
							</tr>
						</thead>
						
						<tbody>
							<?php  
							$query = "select c.id, a.name, a.race, a.class, a.level
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
								<td>
									<a href="chars.php?id=<?php echo $row->id; ?>">Show</a> | <a href="#">Update</a> | <a href="#">Delete</a>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>	
				</table>
				
			</div>
		</div>
		
		<?php
		include_once '../../templates/scripts.php';
		?>
	</body>
</html>