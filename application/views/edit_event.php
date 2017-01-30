<?php
	$id = $data['event']['Id'];
	$event = $data['event'];
	$ticketsLeft = $event["TicketsLeft"];
	$ticketsSold = $event["TicketQuantity"] - $ticketsLeft;
?>
<div id="event-data" event-id=<?php echo "'".$id."'"; ?> />
<h5><?php echo $event["ShortName"]; ?></h5>
<p><?php echo $event["Description"]; ?></p>
<div class="row">
	<div class="col s12 m6 l6">
		<div class="card-panel">
			<div id="canvas-holder-detail">
				<canvas class='doughnut-chart-1 chart' id="doughnut-chart-area"/>
			</div>
		</div>
	</div>
	<div class="col s12 m6 l6">
		<div class="card-panel">
			<div id="canvas-holder-detail">
				<canvas class='bar-chart-1 chart' id="bar-chart-area"/>
			</div>
		</div>
	</div>
</div>
<form id="edit-event-form">
	<div class="row">
		<div class="col s12">
			<button class="btn waves-effect waves-light" type="button" id="edit-event-detail">Bearbeiten
				<i class="material-icons right">mode_edit</i>
			</button>
			<button class="btn waves-effect waves-light green" type="submit" value="Send" id="save-event-detail">Speichern
				<i class="material-icons right">save</i>
			</button>
			<button class="btn waves-effect waves-light red" type="button" id="delete-event-detail">Veranstaltung auflösen
				<i class="material-icons right">delete</i>
			</button>			
			<p>Beachten Sie das Änderungen nach dem speichern sofort aktiv werden. Preisänderungen werden nur für zukünftige Kunden übernommen. Bei jeglichen anderen Änderungen werden die bestehende Kunden per E-Mail benachrichtigt und haben 10 Tage Zeit das Ticket zurückzu erstatten.</p>
		</div>
	</div>
	<div class="row">
		<div class="col s12 m12 l12">
			<ul class="collection">
    			<li class="collection-item avatar" id="title-info">
      			<i class="material-icons circle red">short_text</i>
			      	<span class="title">Titel</span>
			      	<div class="information-field">
			      		<p><?php echo $event["ShortName"]; ?></p>
			      	</div>
			      	<div class="input-field-event-edit">
			      		<input placeholder="Titel" value=<?php echo "'".$event["ShortName"]."'"; ?> id="short-name" name="short-name" type="text" class="validate" required/>
			      	</div>
    			</li>
    			<li class="collection-item avatar" id="description-info">
    	  			<i class="material-icons circle">subject</i>
	      			<span class="title">Beschreibung</span>
	      			<div class="information-field">
      					<p><?php echo $event["Description"]; ?></p>
      				</div>
      				<div class="input-field-event-edit">
			      		<textarea placeholder="Beschreibung" value= id="description" name="description" class="materialize-textarea new-event-input validate" required></textarea>
			      		<script>
			      			// Sets the description value and triggers an auto resize.
			      			$('#description').val(<?php echo "'".$event["Description"]."'"; ?>);
			      			$('#description').trigger('autoresize');
			      		</script>
			      	</div>
    			</li>
    			<li class="collection-item avatar" id="price-info">
					<i class="material-icons circle green">attach_money</i>
					<span class="title">Ticketpreis</span>
					<div class="information-field">
						<p><?php echo $event["TicketCost"].".- CHF"; ?></p>
					</div>
					<div class="input-field-event-edit">
			      		<input placeholder="Ticketkosten" value=<?php echo "'".$event["TicketCost"]."'"; ?> id="ticket-cost" name="ticket-cost" type="number" class="validate" required/>
			      	</div>
				</li>
				<li class="collection-item avatar" id="quantity-info">
					<i class="material-icons circle deep-purple"><i class="material-icons">view_module</i></i>
					<span class="title">Anzahl Tickets</span>
					<div class="information-field">
						<p><?php echo $event["TicketQuantity"]." Stück"; ?></p>
					</div>
					<div class="input-field-event-edit">
			      		<input placeholder="Anzahl Tickets" value=<?php echo "'".$event["TicketQuantity"]."'"; ?> id="ticket-quantity" name="ticket-quantity" type="number" class="validate" required/>
			      	</div>
				</li>
				<li class="collection-item avatar" id="place-info">
					<i class="material-icons circle blue">place</i>
					<span class="title">Ort</span>
					<div class="information-field">
						<p><?php echo $event["Location"]; ?></p>
					</div>
					<div class="input-field-event-edit">
			      		<input placeholder="Ort" value=<?php echo "'".$event["Location"]."'"; ?> id="location" name="location" type="text" class="validate" required/>
			      	</div>
				</li>
				<li class="collection-item avatar" id="date-info">
					<i class="material-icons circle brown">today</i>
					<span class="title">Datum</span>
					<div class="information-field">
						<p><?php echo $event["EventStartDate"]." - ".$event["EventEndDate"]; ?></p>
					</div>
					<div class="row">
						<div class="input-field-event-edit col s6">
				      		<input placeholder="Start-Datum" type="date" class="datepicker new-event-input" required id="start-date" name="start-date" value=<?php echo "'".$event["EventStartDate"]."'"; ?>/>
				      	</div>
				      	<div class="input-field-event-edit col s6">
			      			<input placeholder="End-Datum" type="date" class="datepicker new-event-input" required id="start-date" name="end-date" value=<?php echo "'".$event["EventEndDate"]."'"; ?>/>
			      		</div>
			      	</div>
				</li>
				<li class="collection-item avatar" id="artist-info">
					<i class="material-icons circle lime">person</i>
					<span class="title">Veranstalter, Künstler, Gastgeber</span>
					<div class="information-field">
						<p><?php echo $event["Artist"]; ?></p>
					</div>
					<div class="input-field-event-edit">
			      		<input value=<?php echo "'".$event["Artist"]."'"; ?> id="artist" name="artist" type="text" class="validate" required/>
			      	</div>
				</li>
				<li class="collection-item avatar" id="image-info">
						<?php 
							// Shows an image if one's existing.
							if(isset($event["Image"]) && $event["Image"] == "-")
							{
								echo "<img src='img/".$event["Image"]."' alt='' class='circle'>"; 
							}
							else
							{
								echo "<i class='material-icons circle purple'>insert_photo</i>";
							}
						?> 
					<span class="title">Bild</span>
					<div class="information-field">
						<p><?php echo "'img/".$event["Image"]."'"; ?></p>
					</div>
					<div class="file-field input-field-edit-event">
    	  				<div class="btn" id="input-field-edit-event-btn">
        					<span>Bild</span>
        					<input type="file" id="image-to-upload" class="new-event-input validate">
      					</div>
      					<div class="file-path-wrapper">
	        				<input class="file-path validate" placeholder="Bild" name="image-path" value=<?php echo "'".$event["Image"]."'" ?> type="text" required>
	    	  			</div>
	    	  		</div>
				</li>
				<li class="collection-item avatar" id="type-info">
					<i class="material-icons circle orange">mode_comment</i>
					<span class="title">Veranstaltungstyp</span>
					<div class="information-field">
						
							<?php
							// Shows all event-types associated with this event in a chip-div.
							foreach ($event['types'] as $type) {
								?>
								<div class="chip">
									<?php
									echo $type[0]["ShortName"];
									?>
								</div>
								<?php
							}
							?>
						
					</div>
					<div class="input-field-event-edit">
						<select multiple="multiple" class="new-event-multiple-input" required id="edit-type">
							<option disabled selected value="">Auswählen</option>
							<?php
							$results = $data['types'];
							if(is_array($results) || is_object($results))
							{
								foreach ($results as $result) 
								{
									foreach ($result as $type) 
									{
									?>
										<option value=<?php echo "".$type["Id"]."";?>><?php echo "".$type["ShortName"]."";?></option>
									<?php
									}
								}
							}
							?>-->
						</select>
					</div>
				</li>
	  		</ul>
		</div>
	</div>
</form>

<script>
	// Script for chart-data.
	var doughnutData = [
	{
		value: <?php echo $ticketsSold; ?>,
		color: "#4caf50 ",
		highlight: "#66bb6a",
		label: "Verkauft"
	},
	{
		value: <?php echo $ticketsLeft; ?>,
		color: "#f44336",
		highlight: "#ef5350",
		label: "Verfügbar"
	}
	];

	var data = {
		// Sample data vor bar-chart.
    labels: ["January", "February", "March", "April", "May", "June", "July"],
    datasets: [
        {
            label: "My First dataset",
            fillColor: "rgba(220,220,220,0.5)",
            strokeColor: "rgba(220,220,220,0.8)",
            highlightFill: "rgba(220,220,220,0.75)",
            highlightStroke: "rgba(220,220,220,1)",
            data: [65, 59, 80, 81, 56, 55, 40]
        },
        {
            label: "My Second dataset",
            fillColor: "rgba(151,187,205,0.5)",
            strokeColor: "rgba(151,187,205,0.8)",
            highlightFill: "rgba(151,187,205,0.75)",
            highlightStroke: "rgba(151,187,205,1)",
            data: [28, 48, 40, 19, 86, 27, 90]
        }
    	]
	};

window.onload = function()
{
	// Initializes the charts.
	var d_ctx = document.getElementById("doughnut-chart-area").getContext("2d");
	var b_ctx = document.getElementById("bar-chart-area").getContext("2d");
	var myDoughnutChart = new Chart(d_ctx).Doughnut(doughnutData, { responsive : true });
	var myBarChart = new Chart(b_ctx).Bar(data, { responsive : true });
};
</script>