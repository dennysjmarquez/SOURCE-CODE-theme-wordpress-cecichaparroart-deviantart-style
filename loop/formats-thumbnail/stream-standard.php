

<div class="muestrate" style="display: inline-block!important;">
<div style="text-align: center;position:static  !important;display: table-cell;vertical-align: middle; height:165px;width: 205px;">



<div class="scro-thu cuadros-thu">

<q class="thu" style="min-height:125px; top: 0px; display: block;" onmouseleave="$(this).stop();scroll2(this,1)" onmouseenter="scroll2(this)">
<a typelinck="text" style="max-width: 150px;width: 100%;height: 100%;position: absolute;z-index: 1;" href="<?php the_permalink(); ?>" rel="permalink" class="Dajaxy"></a>
	<?php if( get_the_content() != '' ) : ?>
		<div class="text">
		
			<?php 

					$content = get_the_content();
					print $content;
			
			?>
		</div>
	<?php endif; ?>
</q>	

</div>

</div>


</div>