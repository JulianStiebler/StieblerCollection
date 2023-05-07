<head>
	<link href="../css/search.css" rel="stylesheet">
</head>
<?php
	include('config.php');
	$search = $_POST["search"];
	$search_query =  mysql_query("SELECT * FROM tb_profiles WHERE profile_vorname = '$search' OR profile_nachname = '$search' or profile_wohnort = '$search'");
	
	echo '<div id="content">';
	while($row = mysql_fetch_row($search_query))
		echo '
			<p><a href="../profile.php?id='.$row[0].'">'.$row[1].' '.$row[2].'</a></p>
		';
	echo '</div>';
?>