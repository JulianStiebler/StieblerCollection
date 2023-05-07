<?php
session_start();
include('config.php');
$username = $_POST["login_mail"];
$passwort = md5($_POST["login_passwort"]);

$abfrage = "SELECT user_mail, user_passwort FROM tb_users WHERE user_mail LIKE '$username' LIMIT 1";
$ergebnis = mysql_query($abfrage);

$row = mysql_fetch_object($ergebnis);

if($row->user_passwort == $passwort)
    {
	$userid_get = "SELECT user_id FROM tb_users WHERE user_mail LIKE '$username'";
	$useridfetch = mysql_query($userid_get);
	$userid = mysql_result($useridfetch, 0);

	$data_vorname_get = "SELECT profile_vorname FROM tb_profiles WHERE profile_id LIKE '$userid'";
	$data_vorname_fetch = mysql_query($data_vorname_get);
	$data_vorname = mysql_result($data_vorname_fetch, 0);

	$data_nachname_get = "SELECT profile_nachname FROM tb_profiles WHERE profile_id LIKE '$userid'";
	$data_nachname_fetch = mysql_query($data_nachname_get);
	$data_nachname = mysql_result($data_nachname_fetch, 0);
	
	$data_wohnort_get = "SELECT profile_wohnort FROM tb_profiles WHERE profile_id LIKE '$userid'";
	$data_wohnort_fetch = mysql_query($data_wohnort_get);
	$data_wohnort = mysql_result($data_wohnort_fetch, 0);
	
	$result = mysql_query("SELECT * FROM tb_profiles WHERE profile_id LIKE '$userid'");
	
	$_SESSION["own_vorname"] = $data_vorname;
	$_SESSION["own_nachname"] = $data_nachname;
	$_SESSION["own_wohnort"] = $data_wohnort;
	$_SESSION["own_userid"] = $userid;
    $_SESSION["username"] = $username;
     header('location: ../index.php');
    }
else
    {
    header('location: ../index.php?mode=err');
    }
?> 