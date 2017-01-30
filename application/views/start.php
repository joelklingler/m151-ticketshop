<div class="row">
<?php
$i = 0;
if(isset($data))
{
	if($data != false)
	{
		foreach($data as $n => $array)
		{
			foreach ($array as $key => $event) {
			?>
		<div class="col s4 m4 l4">
			<div class="card event-home-card">
				<div class="card-image waves-effect waves-block waves-light">
					<img class="activator" <?php echo "src='".asset_url()."img/".$event->Image."'" ?>>
				</div>
				<div class="card-content">
					<span class="card-title grey-text text-darken-4"><?php echo $event->ShortName; ?><i class="material-icons right">more_vert</i></span>
				</div>
				<div class="card-reveal">
					<span class="card-title grey-text text-darken-4"><?php echo $event->ShortName; ?><i class="material-icons right">close</i></span>
					<p><?php echo $event->Description; ?></p>
					<div class="card-action">
						<button class="btn waves-effect waves-light tooltipped like-event" data-position="bottom" data-delay="50" data-tooltip="Like" type="button" event-info-id=<?php echo "'".$event->Id."'"; ?> type="button">
							<i class="material-icons">thumb_up</i>
						</button>
						<button class="btn waves-effect waves-light tooltipped share-event" data-position="bottom" data-delay="50" data-tooltip="Share" type="button" event-info-id=<?php echo "'".$event->Id."'"; ?> type="button">
							<i class="material-icons">share</i>
						</button>
						<button class="btn waves-effect waves-light tooltipped buy-event" data-position="bottom" data-delay="50" data-tooltip="Tickets" type="button" event-info-id=<?php echo "'".$event->Id."'"; ?> type="button">
							<i class="material-icons">add_shopping_cart</i>
						</button>
					</div>
				</div>
			</div>
		</div>
			<?php
			$i++;
			}
		}
	}
}
if($i == 0)
{
	?>
	<h1>Keine Daten</h1>
	<p>Offenbar ist dies Ihr erster Besuch. Klicken Sie <a href="install"><b>hier</b> um Beispieldaten zu generieren</p>
	<?php
}
?>
</div>