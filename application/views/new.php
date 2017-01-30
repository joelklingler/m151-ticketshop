<h5>Veranstaltung erfassen</h5>
<p>Beachten Sie das die Veranstaltung, sobald sie erstellt wurde, zum Verkauf an die Kunden freigegeben wird. Das Auflösen einer Veranstaltung ist nur möglich, solange noch keine Tickets verkauft worden sind.</p>
<div id="user" user-id=<?php echo "'".$_SESSION['userId']."'"; ?> />
<div id="new-event">
	<form class="col s12 new-event-form" enctype="multipart/form-data" action="" method="post" id="new-event-form">
		<div class="row">
			<div class="input-field col s12">
				<input name="short-name" id="short-name" type="text" class="new-event-input validate" required>
				<label for="short-name">Bezeichnung</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<div class="file-field input-field">
      				<div class="btn">
        				<span>Bild</span>
        				<input type="file" name="image" id="image-to-upload" class="new-event-input validate" required>
      				</div>
      				<div class="file-path-wrapper">
        				<input name="image-path" id="image-path" class="file-path validate" type="text">
      				</div>
    			</div>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<textarea id="description" name="description" class="materialize-textarea new-event-input validate" required></textarea>
				<label for="description">Beschreibung</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s2">
				<input type="number" name="ticket-quantity" id="ticket-quantity" class="new-event-input" required>
				<label for="ticket-quantity">Anzahl Tickets</label>
			</div>
			<div class="input-field col s2">
				<input type="number" name="ticket-cost" id="ticket-cost" class="new-event-input" required>
				<label for="ticket-cost">Preis pro Ticket</label>
			</div>
			<div class="input-field col s6">
				<input type="text" name="location" id="location" class="new-event-input" required>
				<label for="location">Veranstaltungsort</label>
			</div>
			<div class="input-field col s2">
				<select multiple="multiple" class="new-event-multiple-input" required id="type">
					<option disabled selected value="">Auswählen</option>
					<?php
                    foreach($data as $n => $array)
                    {
					   foreach ($array as $key => $type) {
					?>
					       <option value=<?php echo "".$type['Id']."";?>><?php echo "".$type['ShortName']."";?></option>
					<?php
                       }   
                    }
					?>
				</select>
				<label for="type">Veranstaltungs-Typ</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s2">
				<input type="date" class="datepicker new-event-input" required id="start-date" name="start-date" />
				<label for="start-date">Start Datum</label>
			</div>
			<div class="input-field col s2">
				<input type="time" class="new-event-input" id="start-date-time" name="start-date-time" />
			</div>
			<div class="input-field col s2">
				<input type="date" class="datepicker new-event-input" required id="end-date" name="end-date" />
				<label for="end-date">End Datum</label>
			</div>
			<div class="input-field col s2">
				<input type="time" class="new-event-input" id="end-date-time" name="end-date-time" />
			</div>
			<div class="input-field col s4">
				<input type="text" class="new-event-input" id="artist" name="artist" />
				<label for="artist">Künstler, Veranstalter oder Gastgeber</label>
			</div>
		</div>
		<div class="row">
			<div class="submit field col s6 left">
				<button class="btn waves-effect waves-light" type="reset" value="reset" id="clear-form-content">Zurücksetzen
					<i class="material-icons right">undo</i>
				</button>
			</div>
			<div class="submit field col s6 right">
				<button class="btn waves-effect waves-light" type="submit" value="submit" id="submit-form-content">Veranstaltung eröffnen
					<i class="material-icons right">send</i>
				</button>
			</div>
		</div>
	</form>
</div>