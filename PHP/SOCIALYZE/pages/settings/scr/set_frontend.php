<?php
function box_top() {echo '<div id="box">';}
function box_bottom(){echo '</div>';}

function li_setting_tab(){
	echo "
		<div id='tabpos'>
			<div id='settingtab'>
				<ul>
				   <li class='has-sub'><a href='#'><span>Kontoeinstellungen</span></a>
					  <ul>
						 <li><a href='index.php?page=settings&mode=account&content=profiledata'><span>Profilinformationen</span></a></li>
						 <li><a href='index.php?page=settings&mode=account&content=blockeduser'><span>Blockierte Nutzer</span></a></li>
						 <li><a href='index.php?page=settings&mode=account&content=groups'><span>Gruppen</span></a></li>
						 <li class='last'><a href='index.php?page=settings&mode=account&content=searchopt'><span>Sucheinstellungen</span></a></li>
					  </ul>
				   </li>
				   <li class='has-sub last'><a href='#'><span>Sicherheitseinstellungen</span></a>
					  <ul>
						 <li><a href='index.php?page=settings&mode=secure&content=imageperm'><span>Bilderrechte</span></a></li>
						 <li><a href='index.php?page=settings&mode=secure&content=profile'><span>Profilzugriff</span></a></li>
						 <li><a href='index.php?page=settings&mode=secure&content=data'><span>Datendurchsicht</span></a></li>
						 <li class='last'><a href='index.php?page=settings&mode=secure&content=perm'><span>Berechtigungen</span></a></li>
					  </ul>
				   </li>
				</ul>
			</div>
		</div>
	";
}

function li_setting_empty() {
	echo '
		<div id="content_settings">
			<h2 class="empty">Bitte w&auml;hlen sie aus den nebenstehenden Kategorien.</h2>
		</div>
	';
}

/* KONTOEINSTELLUNGEN */

function li_setting_kontoeinstellungen_profilinformationen(){
	echo '
		<div id="content_settings">
			<h2>Profilinformationen</h2>
			<form action="scr/profile_infoupdater.php" method="post">
				<div class="entry">
					<p>
						<table>
							<tr>
								<td>E-Mail: </td>
								<td> <input class="input" type="email" name="set_usermail" value="'.$_SESSION["username"].'" required /> </td>
							</tr>
							<tr>
								<td>Passwort: </td>
								<td> <input class="input" type="password" name="set_passwort" placeholder="Dein Passwort" required /> </td>
							</tr>
							<tr>
								<td>Vorname: </td>
								<td> <input class="input" type="text" name="set_vorname" value="'.$_SESSION["own_vorname"].'" required /> </td>
							</tr>
							<tr>
								<td>Nachname: </td>
								<td> <input class="input" type="text" name="set_nachname" value="'.$_SESSION["own_nachname"].'" required /> </td>
							</tr>
							<tr>
								<td>Wohnort: </td>
								<td> <input class="input" type="text" name="set_wohnort" value="'.$_SESSION["own_wohnort"].'" required /> </td>
							</tr>
							<tr>
								<td> <input class="button" type="submit" name="set_change_profiledata" value="Speichern" /></td<
							</tr>
						</table>
					</p>
	';
					if ($_GET["entry"] == "true"){
						echo '
							<div id="showstate_success">
								<p>Daten erfolgreich ge&auml;ndert.</p>
							</div>
						';
					}
					
					if ($_GET["entry"] == "false"){
						echo '
							<div id="showstate_error">
								<p>Daten konnten nicht &uuml;bernommen werden.</p>
							</div>
						';
					}
	echo '
				</div>
			</form>
		</div>
	';
}

function li_setting_kontoeinstellungen_blockiertenutzer(){
	echo '
		<div id="content_settings">
			<h2>Blockierte Nutzer</h2>
			<div class="entry">
				<p>
					Placeholder
				</p>
			</div>
		</div>
	';
}

function li_setting_kontoeinstellungen_gruppen(){
	echo '
		<div id="content_settings">
			<h2>Gruppen</h2>
			<div class="entry">
				<p>
					Placeholder
				</p>
			</div>
		</div>
	';
}

function li_setting_kontoeinstellungen_sucheinstellungen(){
	echo '
		<div id="content_settings">
			<h2>Sucheinstellungen</h2>
			<div class="entry">
				<p>
					Placeholder
				</p>
			</div>
		</div>
	';
}

function li_setting_kontoeinstellungen_accountdelete(){
	
}

/* SICHERHEITSEINSTELLUNGEN */

function li_setting_sicherheitseinstellungen_bilderrechte(){
	echo '
		<div id="content_settings">
			<h2>Bilderrechte</h2>
			<div class="entry">
				<p>
					Placeholder
				</p>
			</div>
		</div>
	';
}

function li_setting_sicherheitseinstellungen_profilzugriff(){
	echo '
		<div id="content_settings">
			<h2>Profilzugriff</h2>
			<div class="entry">
				<p>
					Placeholder
				</p>
			</div>
		</div>
	';
}

function li_setting_sicherheitseinstellungen_datendurchsicht(){
	echo '
		<div id="content_settings">
			<h2>Datendurchsicht</h2>
			<div class="entry">
				<p>
					Placeholder
				</p>
			</div>
		</div>
	';
}

function li_setting_sicherheitseinstellungen_berechtigungen(){
	echo '
		<div id="content_settings">
			<h2>Berechtigungen</h2>
			<div class="entry">
				<p>
					Placeholder
				</p>
			</div>
		</div>
	';
}

function friend_delete(){
	$to_delete = $_GET["id"];
				
				if ($to_delete == ""){
					header('location: index.php?page=settings');
				} else {
					include('scr/config.php');
					$loeschen = "DELETE FROM tb_friends WHERE friend_id = '$to_delete'";
					$loesch = mysql_query($loeschen);
					
					echo '
						<div id="content_settings">
							<h2 class="empty">Freund erfolgreich entfernt.</h2><br>
							 <a href="#" onclick="javascript:history.go(-1);">&laquo; Zur&uuml;ck</a>
						</div>
					';
				}
}
?>