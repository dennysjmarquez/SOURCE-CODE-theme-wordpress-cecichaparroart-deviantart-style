<?php
	$link_url = thb_get_post_meta( get_the_ID(), 'link_url' );
?>



<div class="tt-fh item-wrapper<?php if( !empty($post_featured_image) ) : ?> w-featured-image<?php endif; ?>">

<div class="magess5" >
<div class="cuadros" >
<a style="width:250px;" class="linkurl" href="<?php echo $link_url; ?>" title="<?php the_title(); ?>">
	<?php if (strlen($link_url) > 25) { echo substr($link_url, 0,25) .' ...'; } else { echo $link_url; } ?>
	
</a>
<a style="max-width: 300px;" href="<?php the_permalink(); ?>" rel="permalink" class="scrolink">
<q class="d2" style="top: 0px; display: block;" onmouseleave="$(this).stop();scroll2(this,1)" onmouseenter="scroll2(this)">
	<?php if( get_the_content() != '' ) : ?>
		<div class="text">
			<?php the_content(); ?>
		</div>
	<?php endif; ?>
</q>	
</a>
</div>
</div>
	<header>
		<strong style="font-size: 14px;line-height: 125%;margin: 0px;font-family: Trebuchet MS"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" rel="permalink"><?php if (strlen($post->post_title) > 25) { echo substr(the_title($before = '', $after = '', FALSE), 0,25) . ' '.get_the_ID().' ...'; } else { the_title(); } ?> </a></strong>
		<time pubdate class="pubdate">
				<footer class="item-footer">
				<?php echo human_time_diff(get_the_time('U'), current_time('timestamp')); ?> ago in <?php the_category(' '); ?><br>
				<span class="comments" data-icon="i"><a href="<?php comments_link(); ?>"><?php thb_comments_number(); ?></a>
				</span>
				</footer>
		</time>
	</header>

</div>
