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
	
	
	header("location: chars.php?id="  . $entity->id);
}


if(isset($_POST["cancel"])) {
	
	
	header("Location: chars.php?id=" . $entity->id );
}
?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php
		include_once '../../templates/head.php';
		?>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	</head>
	<body>
		
		<?php include_once '../../templates/menu.php'; ?>
		
		<form method="post">
		<div class="large-4 columns large-centered">
						<fieldset class="fieldset">
						<legend>Equipment</legend>
						<input id="cond" type="text" placeholder="start typing name" />
						<table>
							<thead>
								<tr>
									<th>Name</th>
									<th>Quantity</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="equipment">
								<?php 
								$query = "select b.quantity, a.name, a.dmg, a.ac, a.type, a.id
										from equipment a
										inner join pc_equipment b on a.id = b.equipment
										where b.pc =" . $entity->id;
								$stmt = $conn->prepare($query);
								$stmt->execute();
								$result = $stmt->fetchAll(PDO::FETCH_OBJ);
										foreach ($result as $row) :
										?>
										<tr id="row_<?php echo $row->id; ?>">
											<td><?php echo $row->name; ?></td>
											<td><?php echo $row->quantity; ?></td>
											<td><a href="#" class="remove" id="r_<?php echo $row->id; ?>">Remove</a></td>
										</tr>
										<?php endforeach; ?>
							</tbody>
						</table>
						
						</fieldset>
						<input class="succes button expanded"  name="submit" type="submit" value="Confirm" /> 
				
						<input type="hidden" name="id" value="<?php echo $entity->id; ?>" />
											
						<input class="alert button expanded"  name="cancel" type="submit" value="Cancel" />
					</div>
				</div>
				
			
				
			</div>
		</div>
		
		<div class="reveal" id="revealQuantity" data-reveal>
		  Enter Quantity <span id="chosen"></span>
		  <input type="number" id="quantity" />
		  <a id="intoDb" href="#" class="success button expanded">Add</a>
		  <button class="close-button" data-close aria-label="Close modal" type="button">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
		</form>
		<?php
		include_once '../../templates/scripts.php';
		?>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script>
		
			var equipment;
			
		    $( "#cond" ).autocomplete({
			    source: "searchEquipment.php?pc=<?php echo $_GET["id"] ?>",
			    minLength: 3,
			    focus: function( event, ui ) {
			    	event.preventDefault();
			    	},
			    select: function(event, ui) {
			        $(this).val('').blur();
			        event.preventDefault();
			        equipment=ui.item;
			        $("#chosen").html(ui.item.name);
			        $("#revealQuantity").foundation('open');
			        $("#quantity").focus();
			       
			        
			    }
				}).data( "ui-autocomplete" )._renderItem = function( ul, objekt ) {
			      return $( "<li><a>" + objekt.name + "</a>" )
			        .appendTo( ul );
		    }
		    $("#intoDb").click(function(){
		    	intoDb();
		    	
		    	return false;
		    });
		    
		    
		    
		    function intoDb(){
		    	console.log(quantity);
		    	$.get( "addEquipment.php?pc=<?php echo $_GET["id"] ?>&equipment=" + equipment.id + "&quantity=" + $("#quantity").val(), 
					function( returnDb ) {
					if(returnDb=="ok"){
						$("#equipment").append("<tr id=\"row_" + equipment.id + "\" >" + 
						"<td>" + equipment.name + "</td><td>"  + $("#quantity").val() + "</td>" + 
						"<td><a href=\"#\" class=\"remove\" id=\"r_" + equipment.id + "\">Remove</a></td>" + 
						"</tr>");
						defineRemove();
						$("#revealQuantity").foundation('close');
						$("#quantity").val("");
						$("#row_" + equipment).fadeIn();
						
					}else{
						alert(returnDb);
					}
				});
		    }
		    
		    function defineRemove(){
		    	$(".remove").click(function(){
		    	var element = $(this);
				var id = element.attr("id").split("_")[1];
				$.get( "removeEquipment.php?pc=<?php echo $_GET["id"] ?>&equipment=" + id, 
					function( returnDb ) {
					if(returnDb=="ok"){
						var row = element.parent().parent();
						$("#" + row.attr("id")).fadeOut();
						//element.parent().parent().remove();
					}else{
						alert(vratioServer);
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