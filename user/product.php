<?php require_once "header.php"?>
<?php require_once "sidebar.php"?>
<?php require_once "navbar.php"?>
<?php 
if ($actype == "user") {
	// code...
	require_once "pr.php";
}elseif ($actype == "company") {
	// code...
	require_once "pro.php";
}
else{
	echo "";
}
?>
<?php require_once "footer.php"?>
