<?php
	$allowedPages = array("form", "remove");
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>mkSlider CMS</title>
	<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script src="javascript/strings.js"></script>
	<script src="javascript/form.js"></script>
	<link rel="stylesheet" type="text/css" href="basicStyle.css"/>
</head>
<body>
	<?php
	include("html/menu.php");
    
	if(isset($_GET["page"]) && in_array($_GET["page"], $allowedPages)){
		$page = $_GET["page"];
	}
	else{
		$page = "form";
	}
	include("html/{$page}.php");
	
	?>
</body>

</html>
