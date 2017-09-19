
<ul class="vertical medium-horizontal menu">
	<?php if(!isset($_SESSION["session"])): ?>
	<li><a href="<?php echo $route; ?>index.php"><i class="fi-list"></i> <span>Home</span></a></li>
	<?php else: ?>
		<li><a href="<?php echo $route; ?>private/dashboard.php"><i class="fi-list"></i> <span>Dashboard</span></a></li>
	<?php endif;
	
	 if(isset($_SESSION["session"])): ?>
  <li><a href="<?php echo $route; ?>private/users/index.php"><i class="fi-list"></i> <span>Profile</span></a></li>
  <li><a href="<?php echo $route; ?>private/characters/index.php"><i class="fi-list"></i> <span>Characters</span></a></li>
  <li><a href="<?php echo $route; ?>private/adventures/index.php"><i class="fi-list"></i> <span>Adventures</span></a></li>
  <?php endif; ?>
  <li><a href="<?php echo $route; ?>public/contact.php"><i class="fi-list"></i> <span>Contact</span></a></li>
  <?php if(isset($_SESSION["session"])): ?>
  <li><a href="<?php echo $route; ?>public/logout.php"><i class="fi-list"></i> <span>Logout</span></a></li>
  <?php endif; ?>
</ul>