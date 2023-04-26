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
		 include ('scr/profiler.php');
		
		error_reporting(0);
	?>
	<link href="css/profile.css" rel="stylesheet type="text/css">
	<title>Socialyze</title>
</head>
<body>
<?php
	if(isset($_SESSION["username"])){
		error_reporting(0);
		li_navigation_build();
		
		profiler_from_id();
		
		exit;
	}
	
	if(!isset($_SESSION["username"])){
		header('location: index.php');
		exit;
	}
?>
</body>
</html>