<html>
<head>
	<title><?php echo $page_title ?> </title>
	<?php echo style('application.css') ?>
</head>
<body>
	<div id="content">
		<?php echo $this->ocular->yield(); ?>
	</div>
</body>
</html>
