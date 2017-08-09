<?php
include_once '../config.php'; checkLogin();
?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php
		include_once '../templates/head.php';
		?>
	</head>
	<body>
		
		<?php include_once '../templates/menu.php'; ?>
		
		<div class="row">
			<div class="large-12 columns large-centered">
				
			
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				
			</div>
		</div>
		
		<?php
		
		include_once '../templates/scripts.php';
		?>
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>
		<?php 
		include_once 'chartScript.php';
		?>
	</body>
</html>