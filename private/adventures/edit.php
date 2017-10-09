<?php include_once '../../config.php'; checkLogin(); 

if(isset($_GET["id"])) {
	$query = "select * from adventure where id = :id";
	$stmt = $conn->prepare($query);
	$stmt->execute(array("id" => $_GET["id"]));
	$entity = $stmt->fetch(PDO::FETCH_OBJ);
	
	
}

if(isset($_POST["submit"])) {
	
	$query = "update adventure set name=:name, dm=:dm, synopsis=:synopsis where id = :id";
	$stmt = $conn->prepare($query);
	$stmt->execute(array(
			"name" 		=> $_POST["name"],
			"dm" 		=> $_POST["dm"],
			"synopsis" 	=> $_POST["synopsis"],
			"id" 		=> $_POST["id"]));
	
	header("location: index.php");
}


if(isset($_POST["cancel"])) {
	if($_POST["name"] == "") {
		$query = "delete from adventure where id = :id";
		$stmt = $conn->prepare($query);
		$stmt->execute(array("id" => $_POST["id"]));
	}
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
								<label for="name">Title:</label>
								<input type="text" name="name" id="name" value="<?php echo $entity->name; ?>" />
								
								<?php 
								$query = "select id, username from player";
								$stmt = $conn->prepare($query);
								$stmt->execute();
								$result = $stmt->fetchAll(PDO::FETCH_OBJ);
								
								 ?>
								
								<label for="dm">Dungeon Master</label>
								  <select name="dm">
								  	<?php foreach($result as $row): ?>
								    <option value="<?php echo $row->id; ?>"><?php echo $row->username; ?></option>
								    <?php endforeach; ?>
								  </select>
								
																
								<label for="synopsis">Synopsis:</label>
								<textarea id="synopsis" name="synopsis" rows="10px" ><?php echo $entity->synopsis; ?></textarea>
								
								
								<input class="button expanded" name="submit" type="submit" value="<?php if($entity->name == "") {
									echo "Create";
								} else{
									echo "Change";
								} ?>" />
								
								<input type="hidden" name="id" value="<?php echo $entity->id; ?>" />
								
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