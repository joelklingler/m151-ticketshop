<h5>Meine Veranstaltungen</h5>
<p>Informationen zu Ihren Veranstaltungen. Wählen Sie eine Veranstaltung zum bearbeiten aus.</p>
<div class="row">
	<?php
	if(is_array($data) || is_object($data))
	{
		$i = 0; ?>
		<script>
			// data-array for chart-data.
			var data = new Array();
		</script>
		<?php
		foreach ($data as $result) {
			$types = $result['types'];
			$ticketsLeft = $result["TicketsLeft"];
			$ticketsSold = $result["TicketQuantity"] - $ticketsLeft;
			?>
			<div class="col s6 m6 l6">
				<div class=<?php echo "'card ".$result["Id"]."'"; ?> event-id=<?php echo "'".$result["Id"]."'"?>>
					<div class="card-content">
						<span class="card-title">
							<?php echo $result["ShortName"]; ?>
							<?php
							foreach ($result['types'] as $type) {
								?>
								<div class="chip">
									<?php
									echo $type[0]["ShortName"];
									?>
								</div>
								<?php
							}
							?>
						</span>
						<p><?php echo $result["Description"] ?></p>
						<div class="canvas-holder">
							<canvas class=<?php echo "'doughnut-chart-".$i." chart'"; ?> id="chart-area"/>
							<script>
							// Chart data
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
							data.push(doughnutData);
							</script>
						</div>
						<div class="event-info-collection">
							<ul class="collection">
								<li class="collection-item avatar">
									<i class="material-icons circle green">attach_money</i>
									<span class="title">Ticketpreis</span>
									<p><?php echo $result["TicketCost"].".- CHF"; ?></p>
								</li>
								<li class="collection-item avatar">
									<i class="material-icons circle blue">place</i>
									<span class="title">Ort</span>
									<p><?php echo $result["Location"]; ?></p>
								</li>
									<li class="collection-item avatar">
									<i class="material-icons circle brown">today</i>
									<span class="title">Datum</span>
									<p><?php echo $result["EventStartDate"]." - ".$result["EventEndDate"]; ?></p>
								</li>
							</ul>
						</div>
					</div>
					<div class="card-action">
						<a class="waves-effect waves-light btn" href="<?php echo "edit_event/".$result['Id']; ?>">Bearbeiten<i class="material-icons right">mode_edit</i></a>
					</div>
				</div>
			</div>
			<?php
			$i ++;
		}
	}
?>
</div>
<script>
	window.onload = function()
	{
		// Initializes the chart foreach chart-card.
		var i = 0;
		$('.chart').each(function() {
			var ctx = $(this).get(0).getContext("2d");
			window.myDoughnut = new Chart(ctx).Doughnut(data[i], {responsive : true});
			i++;
		});
	};
</script>