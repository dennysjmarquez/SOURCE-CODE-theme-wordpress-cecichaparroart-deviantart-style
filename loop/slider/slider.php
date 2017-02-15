<?php

	$post_featured_image = types_render_field("image", array("url" => "true"));
	

?>


	<li data-transition="random" data-slotamount="7" data-masterspeed="300"  data-saveperformance="off" >
		
		<img src="<?php echo $post_featured_image;?>"  alt="raspberry_part_1_by_ariane_saint_amour-d7b7dzh"  data-bgposition="center top" data-kenburns="on" data-duration="9000" data-ease="Linear.easeNone" data-bgfit="100" data-bgfitend="100" data-bgpositionend="center bottom">
		
		<div class="tp-caption very_large_text randomrotate tp-resizeme" 
			 data-x="center" 
			 data-y="center"  
			data-speed="300" 
			data-start="500" 
			data-easing="Power3.easeInOut" 
			data-splitin="none" 
			data-splitout="none" 
			data-elementdelay="0.1" 
			data-endelementdelay="0.1" 
			 data-endspeed="300" 

			style="z-index: 5; max-width: auto; max-height: auto; white-space: nowrap;">
			<a href='<?php the_permalink(); ?>' class='Dajaxy boton'>Go to this page Photo</a> 
		</div>
	</li>