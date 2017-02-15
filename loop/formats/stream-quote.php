<?php
	$meta = thb_get_post_meta_all( get_the_ID() );
	extract($meta);
?>

<div class="tt-fh item-wrapper" data-icon="<?php thb_get_post_icon(get_the_ID()); ?>">
<a atl="<?php the_title(); ?>" style="max-width: 300px;" href="<?php the_permalink(); ?>"  rel="permalink" class="scro">
<q class="d2" style="top: 0px; display: block;" onmouseleave="$(this).stop();scroll2(this,1)" onmouseenter="scroll2(this)">
	<header class="item-header">
	<strong><?php echo $quote; ?></strong>
		
		<?php if( !empty($quote_author) ) : ?>
			<cite>
				<?php if( !empty($quote_url) ) : ?>
					<a href="<?php echo $quote_url; ?>"><?php echo $quote_author; ?></a>
				<?php else : ?>
					<?php echo $quote_author; ?>
				<?php endif; ?>
			</cite>
		<?php endif; ?>
	</header>
</q>	
</a>	
</div>