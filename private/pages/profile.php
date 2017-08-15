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
			<div class="large-4 columns large-centered">
				<table>
					<tbody>
							<?php  
							$query = "select * from player where id=:id";
							$stmt = $conn->prepare($query);
							$stmt->execute(array("id" => $_SESSION["session"]->id));
							$result = $stmt->fetchAll(PDO::FETCH_OBJ);
							
							foreach($result as $row):
								
							 ?>
						<tr>
								<th>Name:</th>
								<td><?php echo $row->username; ?></td>
						</tr>
								<th>Email:</th>
								<td><?php echo $row->email; ?></td>
						<tr>
								<th>Action - </th>
								<td>						
									<a href="#">Update</a> | <a href="#">Delete</a>
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