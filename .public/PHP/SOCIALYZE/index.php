<?php
	session_start();
?>
<!DOCTYPE html>
<head>
	<?php
	   /* ****************************************
	 	* Index erstellt am 2.2.2014, 10:56 PM   *
	 	* On root@stieb on Ubuntu 12.04 LTS      *
	 	* With Aptana Studio 3                   *
	 	* ****************************************/ 
	   /*
		* Wichtige Skriptdateien
		*/
		 include ('scr/frontend.php');
		
		error_reporting(0);
		
		homescreen_load_css();
	?>
	<title>Socialyze</title>
</head>
<body>
<?php
	if(isset($_SESSION["username"])){
		error_reporting(0);
		// LOGOUT
			if ($_GET["mode"] == "logout"){
				header('location: scr/logout.php');
				exit;
			}
		
		// Navigation ist STATIC
		li_navigation_build();
		
		// Which Page?
		if ($_GET["page"] == "friends"){
			include('pages/friends/friends.php');
			exit;
		}
		
		if ($_GET["page"] == "messages"){
			include('pages/messages/messages.php');
			exit;
		}
		
		if ($_GET["page"] == "settings"){
			include('pages/settings/settings.php');
			exit;
		}
		
		if ($_GET["page"] == "news"){
			include('pages/notification/news.php');
			exit;
		}
		
		// Wenn INDEX_LOGGEDIN
		include('pages/wrapper/wrapper.php');
		
		exit;
	}
	
	if(!isset($_SESSION["username"])){
		error_reporting(0);
		static_build_homescreen();
	
		if ($_GET["content"] == "feedback"){
			feedback_build_homescreen();
			exit;
		}
		
		if ($_GET["content"] == "about"){
			about_build_homescreen();
			exit;
		}
		
		build_homescreen_box();
		build_homescreen();
		
		exit;
	}
?>
</body>
</html>