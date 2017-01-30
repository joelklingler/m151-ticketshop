<?php
$user = $data;
$role = $data['role'];
?>
<div id="row">
<h3>Willkommen <?php echo $user["FirstName"]; ?></h3>
<p>Du kannst hier dein Profil bearbeiten.</p>
<form id="edit-profile-form">
	<div class="row">
		<div class="col s12">
			<button class="btn waves-effect waves-light" type="button" id="edit-profile-detail">Profil Bearbeiten
				<i class="material-icons right">mode_edit</i>
			</button>
			<button class="btn waves-effect waves-light green" type="submit" value="Send" <?php echo "profile-id='".$user['Id']."'"; ?> id="save-profile-detail">Änderungen Speichern
				<i class="material-icons right">save</i>
			</button>
			<?php
			if($role == 1)
			{
				// Shows a action-button for the different roles.
				?>
				<button class="btn waves-effect waves-light red" type="button" id="go-to-events">Zu meinen Veranstaltungen
					<i class="material-icons right">apps</i>
				</button>			
				<?php
			}
			else if($role == 2)
			{
				?>
				<button class="btn waves-effect waves-light red" type="button" id="go-to-tickets">Meine Tickets anzeigen
					<i class="material-icons right">receipt</i>
				</button>
				<?php
			}
			?>
		</div>
	</div>
	<div class="row">
		<div class="col s12 m12 l12">
			<ul class="collection">
    			<li class="collection-item avatar" id="title-info">
      			<i class="material-icons circle red">short_text</i>
			      	<span class="title">Name</span>
			      	<div class="information-field">
			      		<p><?php echo $user["FirstName"]." ".$user["Name"]; ?></p>
			      	</div>
			      	<div class="row">
			      		<div class="input-field-profile-edit col s6 m6 l6">
			      			<input placeholder="Vorname" value=<?php echo "'".$user["FirstName"]."'"; ?> id="first-name" name="first-name" type="text" class="validate" required/>
			      		</div>
			      		<div class="input-field-profile-edit col s6 m6 l6">
			      			<input placeholder="Nachname" value=<?php echo "'".$user["Name"]."'"; ?> id="name" name="name" type="text" class="validate" required/>
			      		</div>
			      	</div>
    			</li>
    			<li class="collection-item avatar" id="description-info">
    	  			<i class="material-icons circle">contacts</i>
	      			<span class="title">Kontaktdaten</span>
	      			<div class="row">
	      				<div class="col s3 c3 l3">
							<b>Email:</b>
	      				</div>
	      				<div class="col s3 c3 l3">
	      					<div class="information-field">
	      						<?php echo $user["Email"]; ?>
	      					</div>
	      					<div class="input-field-profile-edit">
	      						<input placeholder="Email" value=<?php echo "'".$user["Email"]."'";?> id="email" name="email" type="email" class="validate" required />
	      					</div>
	      				</div>
	      			</div>
	      			<div class="row">
	      				<div class="col s3 c3 l3">
							<b>Telefon:</b>
	      				</div>
	      				<div class="col s3 c3 l3">
	      					<div class="information-field">
	      						<?php echo $user["Telephone"]; ?>
	      					</div>
	      					<div class="input-field-profile-edit">
	      						<input placeholder="Telefon" value=<?php echo "'".$user["Telephone"]."'";?> id="telephone" name="telephone" type="tel" class="validate" required />
	      					</div>
	      				</div>
	      			</div>
    			</li>
    			<li class="collection-item avatar" id="security-info">
    				<i class="material-icons circle blue">security</i>
    				<span clsas="title">Sicherheit</span>
    				<div class="row">
    					<div class="col s3 c3 l3">
    						<p><b>Passwort:</b></p>
    					</div>
    					<div class="col s6 c6 l6">
    						<div class="information-field">
    							<p><?php echo $user["Password"]; ?></p>
    						</div>
    						<div class="input-field-profile-edit">
    							<div class="col s6 c6 l6">
    								<input placeholder="Password" id="password-one" name="password-one" type="password" class="validate" />
    							</div>
	    						<div class="col s6 c6 l6">
    								<input placeholder="Password bestätigen" id="password-two" name="password-two" type="password" class="validate" />
    							</div>
    						</div>
    					</div>
    				</div>
    			</li>
	  		</ul>
		</div>
	</div>
</form>
</div>