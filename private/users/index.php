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
							$query = "select a.id, a.username, a.password, a.email, count(b.id) as pc 
									 from player a 
									 left join player_adventure b on a.id=b.player
									 where a.id=:id
									 group by a.id, a.username, a.password,a.email ";
									 
							$stmt = $conn->prepare($query);
							$stmt->execute(array("id" => $_SESSION["session"]->id));
							$result = $stmt->fetchAll(PDO::FETCH_OBJ);
							
							foreach($result as $row):
								
							 ?>
						<tr>
								<th>Name:</th>
								<td><?php echo $row->username; ?></td>
						</tr>
						
						<tr>
								<th>Email:</th>
								<td><?php echo $row->email; ?></td>
						</tr>
						
						<tr>
								<th>Password:</th>
								<td> ****** | <a href="changePass.php?id=<?php echo $row->id; ?>">Change</a></td>
						</tr>
						
						<tr>
								<th>Characters:</th>
								<td><?php $query = "select count(b.pc)
											from player a
											inner join player_adventure b on a.id = b.player
											where a.id = :id;";
										$stmt = $conn->prepare($query);
										$stmt->execute(array("id"=> $_SESSION["session"]->id));
										echo $res = $stmt->fetchColumn(); ?>
							
						</tr>
						
						<tr>
								<th>Adventures:</th>
								<td><?php $query = "select count(a.id)
													from adventure a
													inner join player b on b.id = a.dm
													where a.dm = :id;";
										$stmt = $conn->prepare($query);
										$stmt->execute(array("id"=> $_SESSION["session"]->id)); 
										echo $result = $stmt->fetchColumn(); ?>
							
						</tr>
						
						<tr>
								<th>Action - </th>
								<td>						
									<a href="changeProfile.php?id=<?php echo $row->id; ?>">Update Profile</a> | <?php if($result === 0 || $res === 0): ?>
											<a href="delete.php?id=<?php echo $row->id; ?>">Delete</a>
											<?php	else:?> 
												<a href="#" style="visibility: hidden">Delete</a>
											<?php endif; ?>
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