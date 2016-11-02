<?php
	$allowedPages = array("form", "remove");
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Slideshow CMS</title>
	<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script src="javascript/strings.js"></script>
	<script src="javascript/form.js"></script>
	<link rel="stylesheet" type="text/css" href="basicStyle.css"/>
</head>
<body>
	<?php
	include("html/menu.php");
    
        $page = ( !empty($_GET["page"]) ? $_GET["page"] : "form" );
            
        if($page == "form")
            include("html/form.php");
        elseif ($page == "remove")
            include("html/remove.php");
        else
            echo "No.";
	?>
</body>

</html>
