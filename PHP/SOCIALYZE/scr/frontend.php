<?php
/* ***************************************** *
 * Frontend erstellt am 2.2.2014, 10:56 PM   *
 * On root@stieb on Ubuntu 12.04 LTS         *
 * With Aptana Studio 3                      *
 * ***************************************** */ 

function homescreen_load_css(){
	echo '<link href="css/index.css" rel="stylesheet" type="text/css" />';
}

function static_build_homescreen(){	
	echo '
		<div id="navigation">
			<ul>
				<li class="logo"><a href="index.php"> <img src="images/logo.png"> </a></li>
				<li><a href="index.php?content=feedback">Feedback</a></li>
				<li><a href="index.php?content=about">&Uuml;ber Uns</a></li>
				<li><a href="index.php">Home</a></li>
			</ul>
		</div>
		
		<div id="footer">
			&copy; 2014 - Julian &amp; Florian Stiebler
		</div>
	';
}

function feedback_build_homescreen(){
	echo '
		<div id="content">
			<h2>Feedback abgeben</h2>
		</div>
	';
}

function about_build_homescreen(){
	echo '
		<div id="content">
			<h2>About Us</h2>
		</div>
	';
}

function build_homescreen_box(){
	echo '
		<div id="loginbox_shadow">
		</div>
		<div id="loginbox">
			<table id="Tabelle_01" width="285" height="96" border="0" cellpadding="0" cellspacing="0" style="color: #ffffff;">
				<tr>
					<td height="10" colspan="3" valign="top" bgcolor="#2E191D">&nbsp;</td>
			  </tr>
				<tr>
					<td width="10" height="19" bgcolor="#2E191D">&nbsp;</td>
					<td width="265" valign="top" bgcolor="#2E191D">
						<h4 style="margin-top: 0; margin-bottom: 15px;">Bereits dabei?</h4>
						<form action="scr/login.php" method="post">			
								<input type="email" name="login_mail" placeholder="E-Mail" maxlength="64" class="inputhome" required /><br>
								<input type="password" name="login_passwort" placeholder="Passwort" maxlength="64" class="inputhome" required /><br>
								<input type="submit" class="loginbut" name="login" value="Log-In" /> | <a href="">Passwort vergessen?</a>
	';
								if ($_GET["mode"] == "err"){
									echo '
										<p style="color: #ff6600; text-align: center;">Fehler beim Anmelden.</p>
									';
								}
	echo '
						</form>	
					</td>
					<td width="10" bgcolor="#2E191D">&nbsp;</td>
				</tr>
				<tr>
					<td height="22" colspan="3" bgcolor="#392529">
						<img src="images/box_05.png" width="285" height="22" alt=""></td>
			  </tr>
				<tr>
					<td width="10" height="19" bgcolor="#392529">&nbsp;</td>
					<td width="265" valign="top" bgcolor="#392529">
						<h4 style="margin: 0;">Nocht nicht dabei?</h4>
						<h6 style="margin-top: 0; margin-bottom: 15px;">Dann registriere dich jetzt.</h6>
						<form action="scr/register.php" method="post">
							<input type="email" name="reg_mail" placeholder="E-Mail" maxlength="64" class="inputhome" required /><br>
							<input type="password" name="reg_passwort" placeholder="Passwort" maxlength="64" class="inputhome" required /><br>
							<input type="password" name="reg_passwort2" placeholder="Passwort wiederholen" maxlength="64" class="inputhome" required /><br>
							<input type="text" name="reg_vorname" placeholder="Vorname" maxlength="32" class="inputhome" required /><br>
							<input type="text" name="reg_nachname" placeholder="Nachname" maxlength="32" class="inputhome" required /><br>
							<input type="text" name="reg_wohnort" placeholder="Stadt" maxlength="32" class="inputhome" required /><br>
							<input type="submit" class="regbut" name="register" value="Registrieren" />
							<p style="font-size: 13px;">
								Mit dem Registrieren best&auml;tigen sie die <a href="">Nutzungsbedingungen</a> und <a href="">Datenschutzrichtlinien</a> gelesen zu haben.
							</p>
	';
							if ($_GET["register"]== "true"){
								echo '
									<p style="color: #ff6600; text-align: center;">Account erfolgreich angelegt.</p>
								';
							}
							if ($_GET["register"]== "false"){
								echo '
									<p style="color: #ff6600; text-align: center;">Fehler beim Registrieren.</p>
								';
							}
							
	echo '
						</form>
					</td>
					<td width="10" bgcolor="#392529">&nbsp;</td>
				</tr>
				<tr>
					<td height="26" colspan="3" valign="top" bgcolor="#FFFFFF">
						<img src="images/box_09.png" width="285" height="26" alt=""></td>
			  </tr>
				</tr>
			</table>
		</div>
	';
}

function build_homescreen(){
	echo '
		<div id="bg">
		</div>
	';
}

function li_navigation_build(){
	echo '
		<form action="scr/search.php" method="post">
			<div id="navigation">
				<ul>
					<li><input class="usersearch" type="text" name="search" placeholder="Suche nach Personen..."></li></form>
					<li class="logo"> <a href="index.php"> <img src="images/logo.png" /> </a> </li>
					<li><a href="index.php?page=settings">Einstellungen</a></li>
					<li><a href="index.php?page=messages">Nachrichten</a></li>
					<li><a href="index.php?page=friends">Freunde</a></li>
					<li style="color: #fff;">|</li>
					<li><a href="profile.php?id='.$_SESSION["own_userid"].'">'.$_SESSION["own_vorname"].' '.$_SESSION["own_nachname"].'</a></li>
					<li><a href="index.php?mode=logout">Abmelden</a></li>
				</ul>
			</div>
			
			<div id="footer">
				&copy; 2014 - Julian &amp; Florian Stiebler
			</div>
		';
}

function li_home(){
	echo '
		<div id="content">
			<h2>Statuswrapper</h2>
		</div>
	';
}

function li_friendlist(){
	echo '
		<div id="content">
			<h2>Freunde</h2>
		</div>
	';
}

function li_news(){
	echo '
		<div id="content">
			<h2>Benachrichtigungen</h2>
		</div>
	';
}