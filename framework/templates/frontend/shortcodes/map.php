<section class="map-container <?php echo implode(' ', $class); ?>">
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<div 
		class="map"
		data-height="<?php echo $height; ?>" 
		data-width="<?php echo $width; ?>" 
		data-latlong="<?php echo $latlong; ?>"
		data-zoom="<?php echo $zoom; ?>"
		data-marker="<?php echo $marker; ?>"
		data-type="<?php echo $type; ?>"
	></div>
</section>