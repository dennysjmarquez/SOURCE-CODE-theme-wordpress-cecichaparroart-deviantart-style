<div class="muestrate" style="display: inline-block!important;">
<div style="text-align: center;position:static  !important;display: table-cell;vertical-align: middle; height:165px;width: 205px;">


<a style="width:250px;" class="linkurl" href="<?php echo $link_url; ?>" title="<?php the_title(); ?>">
	<?php if (strlen($link_url) > 25) { echo substr($link_url, 0,25) .' ...'; } else { echo $link_url; } ?>
	
</a>


<a style="max-width: 300px;" href="<?php the_permalink(); ?>" rel="permalink" class="Dajaxy scro-thu cuadros-thu">

<q class="thu" style="top: 0px; display: block;" onmouseleave="$(this).stop();scroll2(this,1)" onmouseenter="scroll2(this)">

	<?php if( get_the_content() != '' ) : ?>
		<div class="text">
		
			<?php the_content(); ?>
		</div>
	<?php endif; ?>
</q>	
</a>


</div>


</div>