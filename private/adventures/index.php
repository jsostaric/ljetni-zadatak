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
					<a href="<?php echo $route; ?>private/adventures/create.php" class="success button centered expanded">New Adventure</a> 
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="large-8 columns large-centered">
				<table>
					<h4>As Dungeon Master:</h4>
						<thead>
							<tr>
								<th>Title</th>
								<th>Action</th>
							</tr>
						</thead>
						
						<tbody>
							<?php  
							$query = "select distinct b.pc, a.id, a.name, a.dm, a.synopsis
									from adventure a 
									left join player_adventure b on a.id = b.adventure
									where dm = :id";
							$stmt = $conn->prepare($query);
							$stmt->execute(array("id"=> $_SESSION["session"]->id));
							$result = $stmt->fetchAll(PDO::FETCH_OBJ);
							
							foreach($result as $row):
								
							 ?>
							<tr>
								
								<td><?php echo $row->name; ?></td>
								<td>
									<a href="adventures.php?id=<?php echo $row->id; ?>">Show</a> | <a href="edit.php?id=<?php echo $row->id; ?>">Update</a> | <?php if($row->pc == 0): ?><a href="delete.php?id=<?php echo $row->id; ?>">Delete</a><?php endif; ?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>	
				</table>
					<hr />
				<table>
					<h4>As Player:</h4>
						<thead>
							<tr>
								<th>Title</th>
								<th>Action</th>
							</tr>
						</thead>
					
						<tbody>
							<?php  
							$query = "select distinct a.name, a.id
									from adventure a
									inner join player_adventure b on a.id = b.adventure
									where b.player = :id";
							$stmt = $conn->prepare($query);
							$stmt->execute(array("id"=> $_SESSION["session"]->id));
							$result = $stmt->fetchAll(PDO::FETCH_OBJ);
							
							foreach($result as $row):
								
							 ?>
							<tr>
								
								<td><?php echo $row->name; ?></td>
								<td>
									<a href="adventures.php?id=<?php echo $row->id; ?>">Show</a>
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