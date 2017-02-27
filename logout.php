<?php
session_start();
if($_SESSION['access'] == 1) {
	$success_redirect_path = 'admin/';
} else if ($_SESSION['access'] == 2) {
	$success_redirect_path = 'staff/';
} else {
	$success_redirect_path = 'index.php';
}

if(!empty($_SESSION['email']) && !empty($_SESSION['name']))
{
	session_destroy();
	header('Location: '.$success_redirect_path);  
} else {
	session_destroy();
	header('Location: index.php'); 
}

?>