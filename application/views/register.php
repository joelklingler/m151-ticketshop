<?php
// Checks if the user is already logged-in.
if(isset($_SESSION['roleId']))
{
	// Yes - Redirect to home after 5000ms.
	?>
	<h5>Sie sind bereits eingeloggt.</h5>
	<p>Sie werden in 5 Sekunden automatisch auf die Startseite weitergeleitet, oder drücken Sie <a href="home" alt="Zum Start">hier</a>.
	<script>
		setTimeout(function() {
			window.location = "?seite=home.php";;
		}, 5000);
	</script>
	<?php
}
else
{
	// No - Show the register-form.
?>
<div class="section">
	<h5>Registrieren</h5>
	<p>Registrieren Sie sich gratis und erhalten Sie uneingeschränkten Zugriff auf alle Veranstaltungen in der Schweiz, Deutschland und Österreich zu Bestpreisen.</p>
</div>

<div id="register">
	<form class="col s6 register-form" action="" method="post">
		<div class="row">
			<div class="input-field col s6">
				<input name="first-name" id="first-name" type="text" class="register-input validate" required>
				<label for="first-name">Name</label>
			</div>
			<div class="input-field col s6">
				<input name="name" id="name" type="text" class="register-input validate" required>
				<label for="name">Nachname</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s6">
				<input name="email" id="email" type="email" class="register-input validate" required>
				<label for="email">E-Mail</label>
			</div>
			<div class="input-field col s6">
				<input name="telephone" id="telephone" type="tel" class="register-input validate" required>
				<label for="telephone">Telefon-Nr</label>
			</div>
		</div>
		<div class="row">
			<div class="input field col s6">
				<input name="passwordOne" id="passwordOne" type="password" length="30" class="register-input validate" required>
				<label for="passwordOne">Kennwort</label>
			</div>
			<div class="input field col s6">
				<input name="passwordTwo" id="passwordTwo" type="password" length="30" class="register-input validate" required>
				<label for="passwordTwo">Kennwort bestätigen</label>
			</div>
		</div>
		<div class="row">
			<div class="input field col s6">
				<div class="switch">
					<label>
						Normal-Kunde
						<input type="checkbox" name="role" class="register-input validate" id="role-type">
						<span class="lever"></span>
						Veranstalter
					</label>
				</div>
			</div>
			<div class="submit field col s6">
            	<button class="btn waves-effect waves-light" type="submit" id="register-submit">Registrieren
            	<i class="material-icons right">send</i>
            	</button>
   	    	</div>
   		</div>
	</form>
</div>
<?php
}
?>