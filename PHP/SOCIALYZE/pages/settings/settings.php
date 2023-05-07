
	<?php
		session_start();
		include('pages/settings/scr/set_frontend.php');
	?>
	
	<head>
		<link rel='stylesheet' type='text/css' href='pages/settings/css/index.css' />
		<link rel='stylesheet' type='text/css' href='pages/settings/css/settingtab.css' />
		<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
		<script type='text/javascript' src='pages/settings/js/menu_jquery.js'></script>
	</head>

	<?php 
		box_top();
		li_setting_tab();
		if ($_GET["mode"] == "account"){
		
			if ($_GET["content"] == "profiledata"){
				li_setting_kontoeinstellungen_profilinformationen();
				exit;
			}
			
			if ($_GET["content"] == "blockeduser"){
				li_setting_kontoeinstellungen_blockiertenutzer();
				exit;
			}
			
			if ($_GET["content"] == "groups"){
				li_setting_kontoeinstellungen_gruppen();
				exit;
			}
			
			if ($_GET["content"] == "searchopt"){
				li_setting_kontoeinstellungen_sucheinstellungen();
				exit;
			}
		}

		if ($_GET["mode"] == "secure"){
			
			if ($_GET["content"] == "imageperm"){
				li_setting_sicherheitseinstellungen_bilderrechte();
				exit;
			}
			
			if ($_GET["content"] == "profile"){
				li_setting_sicherheitseinstellungen_profilzugriff();
				exit;
			}
			
			if ($_GET["content"] == "data"){
				li_setting_sicherheitseinstellungen_datendurchsicht();
				exit;
			}
			
			if ($_GET["content"] == "perm"){
				li_setting_sicherheitseinstellungen_berechtigungen();
				exit;
			}
			
		}

		if ($_GET["action"] == "friends"){
			if ($_GET["do"] == "delete"){
				friend_delete();
				exit;
			}
		}
		
		li_setting_empty();
		box_bottom();
		exit;
	?>
</body>
</html>