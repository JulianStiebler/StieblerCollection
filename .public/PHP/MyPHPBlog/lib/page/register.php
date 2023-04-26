<?php  # Wenn diese Zeile nicht wäre erkennt GitHub PHP als Hack-Language an ?>
	<form action="lib/register.php" method="post">
		<fieldset id="post_article" style="width: 100px; text-align: center; border: none;">
			<p><span class="icon-user"> Registrieren</span></p>
			<p style="position: relative;">
				<input class="line" name="user_mail" type="email" required placeholder="E-Mail" />
			</p>
			<p>
				<input class="line" name="user_pass" type="password" required placeholder="Passwort" />
			</p>
			<p>
				<input class="line" name="user_pass_c" type="password" required placeholder="Passwort" />
			</p>
			<button class="red" name="button_login"><span class="icon-darrow-right"> Registrieren</span>
		</fieldset>
	</form>