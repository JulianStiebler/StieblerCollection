<!DOCTYPE html>
<head>
	<link href="css/errors.css" rel="stylesheet" type="text/css" />
	<style>
		#error_showtable {
			width: 100%;
			border-collapse: collapse;
		}
		
		#error_showtable td {
			width: 50%;
			border: 1px solid #000;
		}
		
		#error_showtable tr {
		}
	</style>
</head>
<body>
	<?php
		include('scr/errors.php');
		error_reporting(0);
		if($_GET["error"] == "falschesprofil"){
			err_falsches_profil();
			exit;
		}
	?>
	<table id="error_showtable">
		<tr>
			<td>
				<ul>
					<li>Allgemeine Fehler
						<ul>
							<li><a href="errors.php?">Ung&uuml;ltige Seite</a></li>
						</ul>
					</li>
				</ul>
			</td>
			
			<td>
				<ul>
					<li>Profil-Fehler
						<ul>
							<li><a href="errors.php?">Ung&uuml;ltiges Profil</a></li>
						</ul>
					</li>
				</ul>
			</td>
		</tr>
		
		<tr>
			<td>
				<ul>
					<li>Nachrichten-Fehler
						<ul>
							<li><a href="errors.php?">Ung&uuml;tige Nachricht</a></li>
						</ul>
					</li>
				</ul>
			</td>
			
			<td>
				<ul>
					<li>Einstellungen-Fehler
						<ul>
							<li><a href="errors.php?">Fehler beim &uuml;bernehmen</a></li>
						</ul>
					</li>
				</ul>
			</td>
		</tr>
		
		<tr>
			<td>
				<ul>
					<li>Status-Fehler
						<ul>
							<li><a href="errors.php?">Fehler beim Auslesen von Status-Nachrichten</a></li>
						</ul>
					</li>
				</ul>
			</td>
			
			<td>
				<ul>
					<li>Freunde-Fehler
						<ul>
							<li><a href="errors.php?">Fehler beim Auslesen der Freundesliste</a></li>
						</ul>
					</li>
				</ul>
			</td>
		</tr>
	</table>
</body>