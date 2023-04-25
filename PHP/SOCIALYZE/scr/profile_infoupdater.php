<?php
include('config.php');
$ownid = $_SESSION["own_userid"];
$update_email = $_POST["set_usermail"];
$update_passwort = md5($_POST["set_passwort"]);
$update_vorname = $_POST["set_vorname"];
$update_nachname = $_POST["set_nachname"];
$update_wohnort = $_POST["set_wohnort"];

$query1 = "UPDATE tb_users SET user_mail = '$update_email', user_passwort = '$update_passwort' WHERE user_mail = '$ownid'";
$query2 = "UPDATE tb_profiles SET profile_vorname = '', profile_nachname = '', profile_wohnort = '' WHERE user_id = '$ownid'";

	$update1 = mysql_query($query1); 
	$update2 = mysql_query($query2);
	
	if($update1 == true){
		header('location: ../index.php?page=settings&mode=account&content=profiledata&entry=true');
	} else {
		header('location: ../index.php?page=settings&mode=account&content=profiledata&entry=false');
	}
?>