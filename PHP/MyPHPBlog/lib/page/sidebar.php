<?php  # Wenn diese Zeile nicht wäre erkennt GitHub PHP als Hack-Language an ?>
		<div class="sidebar">
			<ul class="nav">
				<li>
					<div class="input-container">
						<div class="icon-ph"><span class="icon-search" style="color: #333;"></span></div>
						<input class="custom-text" type="text" placeholder="Seite durchsuchen">
					</div>
				</li>
				<li> <a href="index.php"> <span class="icon-home"> Home</span> </a> </li>
				<li> <a href="index.php?page=categories"> <span class="icon-group"> Kategorien</span> </a> </li>
				<li> <a href="index.php?page=articles"> <span class="icon-comment"> Artikel</span> </a> </li>
				<li> <a href="index.php?page=gallery"> <span class="icon-attach"> Gallerie</span> </a> </li>
				<li>
					<div class="wrapper" id="sldOne" style="border-top: 1px dotted #6cf; border-bottom: 1px dotted #6cf; margin-top: 25px;">
						<div id="content">
						</div>
						<a class="next_but"><span class="icon-arrow-right"> Anmelden</span></a>
					</div>
					
					<form action="lib/login.php" method="post">
						<div class="wrapper" id="sldTwo" style="border-top: 1px dotted #6cf; border-bottom: 1px dotted #6cf; margin-top: 25px;">
						   <div id="content">
								<fieldset id="post_article" style="border: none; text-align: center;">
									<span class="icon-user" style="color: #6cf;"> Anmelden</span>
									<p style="margin-top: 2px;">
										<input class="line" name="user_mail" type="email" required placeholder="E-Mail" />
									</p>
									<p>
										<input class="line" name="user_pass" type="password" required placeholder="Passwort" />
									</p>
									<p>
										<button class="red" name="button_login"><span class="icon-darrow-right"> Anmelden</span></button>
										<a name="pwforgot" style="width: 100%"><span class="icon-sign-question"> Hilfe</span></a>
									</p>
								</fieldset>
						   </div>
						   <a class="next_but" style="margin-top: -10px;"><span class="icon-darrow-right"> Registrieren</span></a>
						</div>
					</form>
					
					<form action="lib/register.php" method="post">
						<div class="wrapper" id="sldThree" style="border-top: 1px dotted #6cf; border-bottom: 1px dotted #6cf; margin-top: 25px;">
						   <div id="content">
								<fieldset id="post_article" style="width: 100px; border: none;  margin-right: 25px; text-align: center;">
									<span class="icon-user" style="color: #6cf;"> Registrieren</span>
									<p style="margin-top: 2px;">
										<input class="line" name="user_mail" type="email" required placeholder="E-Mail" />
									</p>
									<p>
										<input class="line" name="user_pass" type="password" required placeholder="Passwort" />
									</p>
									<p>
										<input class="line" name="user_pass_c" type="password" required placeholder="Passwort" />
									</p>
									<button class="red" name="button_login"><span class="icon-darrow-right"> Registrieren</span></button>
								</fieldset>
						   </div>
						   <a class="next_but"><span class="icon-darrow-right"> Anmelden</span></a>
						</div>
					</form>
				
				</li>
			</ul>
		</div>