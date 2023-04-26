<?php
include('config.php');
$username = $_POST["reg_mail"];
$passwort = $_POST["reg_passwort"];
$passwort2 = $_POST["reg_passwort2"];
$vorname = $_POST["reg_vorname"];
$nachname = $_POST["reg_nachname"];
$wohnort = $_POST["reg_wohnort"];

$passwort = md5($passwort);
$passwort2 = md5($passwort2);

$result = mysql_query("SELECT user_id FROM tb_users WHERE user_mail LIKE '$username'");
$menge = mysql_num_rows($result);

if ($passwort == $passwort2){
	
	if($menge == 0)
		{
		$eintrag = "INSERT INTO tb_users (user_id, user_mail, user_passwort) VALUES ('', '$username', '$passwort')";
		$eintragen = mysql_query($eintrag);
		
		$eintrag2 = "INSERT INTO tb_profiles (profile_id, profile_vorname, profile_nachname, profile_wohnort) VALUES ('', '$vorname', '$nachname', '$wohnort')";
		$eintragen2 = mysql_query($eintrag2);

		if($eintragen == true)
			{
			header('location: ../index.php?register=true');
			}
		else
			{
			header('location: ../index.php?register=false');
			}

		}
	else
		{
		header('location: ../index.php?register=false');
		}
	
} else {
	header('location: ../index.php?register=false');
}
?> 