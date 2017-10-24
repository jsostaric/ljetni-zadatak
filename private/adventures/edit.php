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
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	</head>
	<body>

		<?php include_once '../../templates/menu.php'; ?>
	<form method="post">
		<div class="row">
			<div class="large-6 columns large-centered">
				<div class="callout">
					<div class="row">
						<div class="large-6 columns">
							
							<fieldset class="fieldset">
								
								<legend>Adventure</legend>
								<label for="name">Title:</label>
								<input type="text" name="name" id="name" value="<?php echo $entity->name; ?>" />
								
								<?php 
								$query 	= "select id, username from player";
								$stmt 	= $conn->prepare($query);
								$stmt->execute();
								$result	= $stmt->fetchAll(PDO::FETCH_OBJ);
								
								 ?>
								
								<label for="dm">Dungeon Master</label>
								  <select name="dm">
								  	<?php foreach($result as $row): ?>
								    <option value="<?php echo $row->id; ?>"><?php echo $row->username; ?></option>
								    <?php endforeach; ?>
								  </select>
								
																
								<label for="synopsis">Synopsis:</label>
								<textarea id="synopsis" name="synopsis" rows="10px" ><?php echo $entity->synopsis; ?></textarea>
								
							</fieldset>
					
					</div>
					
					
					<div class="large-6 columns">
							<fieldset class="fieldset">
								<legend>Characters</legend>
								
								<label for="name">Add Character</label>
								<input type="text" id="cond" placeholder="Type name of the character" />
								
								<table>
									<thead>
										<tr>
											<th>Name</th>
											<th>Action</th>
										</tr>
									</thead>
										<tbody id="adventurers">
											<?php 
											
											$query 	= "select a.pc, b.name, a.player
														from player_adventure a
														inner join pc b on b.id = a.pc
														where a.adventure=" . $entity->id;
											
											$stmt 	= $conn->prepare($query);
											$stmt->execute();
											$result	= $stmt->fetchAll(PDO::FETCH_OBJ);
											
											foreach($result as $row):
											 ?>
											 <tr id="row_<?php echo $row->id; ?>">
											 	<td><?php echo $row->name; ?></td>
											 	<td><a class="remove" href="#" id="r_<?php echo $row->pc;?>_<?php echo $row->player; ?>">Remove</a></td>
											 </tr>
											 <?php endforeach; ?>
										</tbody>
								</table>
								
							</fieldset>
					
					</div>
					
						<input class="button expanded" name="submit" type="submit" value="<?php if($entity->name == "") {
										echo "Create";
									} else{
										echo "Change";
									} ?>" />
									
						<input type="hidden" name="id" value="<?php echo $entity->id; ?>" />
									
						<input class="alert button expanded"  name="cancel" type="submit" value="Cancel" />
						
					</div>
				</div>
			</div>
		</div>			
	</form>	
		<?php include_once '../../templates/scripts.php';?>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		
		<script>
			var pc;
			
		    $( "#cond" ).autocomplete({
			    source: "searchCharacter.php?adventure=<?php echo $_GET["id"] ?>",
			    minLength: 3,
			    focus: function( event, ui ) {
			    	event.preventDefault();
			    	},
			    select: function(event, ui) {
			        $(this).val('').blur();
			        event.preventDefault();
			        pc=ui.item;
			        intoDb();
			    }
				}).data( "ui-autocomplete" )._renderItem = function( ul, objekt ) {
			      return $( "<li><img style=\"width: 50px\" src=\"https://vignette.wikia.nocookie.net/mafiagame/images/2/23/Unknown_Person.png/revision/latest?cb=20151119092211\" />" )
			        .append( "<a>" + objekt.name + "</a>" )
			        .appendTo( ul );
		    }
		    
		    
		    
		    function intoDb(){
		    	console.log();
		    	$.get( "addCharacter.php?adventure=<?php echo $_GET["id"] ?>&pc=" + pc.id + "&player=" + pc.player, 
					function( returnDb ) {
					if(returnDb=="ok"){
						$("#adventurers").append("<tr id=\"row_" + pc.id + "\" >" + 
						"<td>" + pc.name + "</td>" + 
						"<td><a href=\"#\" class=\"remove\" id=\"r_" + pc.id + "\">Remove</a></td>" + 
						"</tr>");
						defineRemove();
						//$("#row_" + pc).fadeIn();
						
					}else{
						alert(returnDb);
					}
				});
		    }
		    
		    function defineRemove(){
		    	$(".remove").click(function(){
		    	var element = $(this);
				var id = element.attr("id").split("_")[1][1];
				$.get( "removeCharacter.php?adventure=<?php echo $_GET["id"] ?>&pc=" + id, 
					function( returnDb ) {
					if(returnDb=="ok"){
						var row = element.parent().parent();
						$("#" + row.attr("id")).fadeOut();
						//element.parent().parent().remove();
						console.log(id);
					}else{
						alert(returnDb);
						console.log(id);
					}
				});
		    	return false;
		    	});
		    }
		    
		    defineRemove();
		    
		    
		    $( "#cond" ).focus(function() {
  				$('html,body').animate({ scrollTop: 9999 }, 'slow');
			});
		    
			
			
		</script>
		
	</body>
</html>