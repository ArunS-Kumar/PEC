<?php 
require_once('connection.php');

session_start();
if($_REQUEST['access'] == 1) {
	$success_redirect_path = 'admin/dashboard.php';
	$failure_redirect_path = 'admin/';
} else if ($_REQUEST['access'] == 2) {
	$success_redirect_path = 'staff/dashboard.php';
	$failure_redirect_path = 'staff/';
} else {
	$success_redirect_path = 'dashboard.php';
	$failure_redirect_path = 'index.php';
}

$sql = $DB->query("SELECT * FROM users where email = '".$_REQUEST['email']."' and password = '".sha1($_REQUEST['password'])."' and access = '".$_REQUEST['access']."' and activate = 1")->fetch_assoc();

if(!empty($sql)) {
	$_SESSION["email"] = $sql['email'];
	$_SESSION["name"] = $sql['name'];
	$_SESSION["access"] = $sql['access'];
	$_SESSION["activate"] = $sql['activate'];
	$_SESSION["created_at"] = $sql['created_at'];
	$_SESSION["error"] = '';

	header('Location: '.$success_redirect_path);    

} else {
	$_SESSION["error"] = 'Incorrect login credentials';
	header('Location: '.$failure_redirect_path);  
}

?>