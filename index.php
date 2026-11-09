<?php
	include 'connConfig.php';

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Demos</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
	<div class="gapBetween">
		<h2>A.) Basic Auto-scrolling</h2>
	</div>
	<div class="slider">
		<div class="slides">
			<?php
				$parts = createRadios('Basic','navigation',array('ss1','ss2','ss3','ss4'));
				echo $parts[0];
				echo $parts[1];
				echo $parts[2];
				echo $parts[3];
			?>
		</div><!--slides end-->
	</div><!--slider end-->
	<div class="gapBetween">
		<h2>B.) Side menu</h2>
	</div>
	<div class="slider2">
		<div class="row">
			<?php
			$parts = createRadios('PLlike','navi2',array('ss1','ss2','ss3','ss4'),1,array('Option 1','Option 2','Option 3','Option 4'));
			echo $parts[0];		
			?>
			<div class="col-md-9">
				<div class="slides2">	
				<?php
					echo $parts[1];
				?>	
				</div>
			</div>
			<div class="col-md-3">
				<?php
					echo $parts[2];
					echo $parts[3];
				?>
			</div>
		</div><!--row-->
	</div><!--slider2 end-->
	<div class="gapBetween">
		<h2>C.) Hidden Side Menu &amp; Fade In/Out</h2>
	</div>
	<div class="slider3">
		<div class="slides3">
		 <?php
		 	$parts = createRadios('PLlikeWithHideMenu','navi3',array('ss1','ss2','ss3','ss4'),2,array('Option 1','Option 2','Option 3','Option 4'));
			echo $parts[0];		
		 	echo $parts[1];
		 	echo $parts[2];
		 	echo $parts[3];
		 ?>
		</div><!--slides end-->
	</div><!--slider end-->
	<i class="icon-android"></i> icon-android
	</body>
</html>
