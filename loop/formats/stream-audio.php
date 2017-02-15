<?php
	$audio_url = thb_get_post_meta( get_the_ID(), 'audio_url' );
?>

<div class="audiod">
<?php if( !empty($audio_url) ) : ?>
	<embed width="100%" height="100%" src="<?php echo $audio_url; ?>">
<?php endif; ?>
</div>

<div class="item-wrapper">
	<header>
		<div style="height:26px;width:100%;overflow:hidden !important;">
		<strong style="font-size: 14px;line-height: 125%;margin: 0px;font-family: Trebuchet MS"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" rel="permalink"><?php if (strlen($post->post_title) > 25) { echo substr(the_title($before = '', $after = '', FALSE), 0,25) . ' '.get_the_ID().' ...'; } else { the_title(); } ?> </a></strong>
		
		
		</div>
		<time pubdate class="pubdate">
				<footer class="item-footer">
				<?php echo human_time_diff(get_the_time('U'), current_time('timestamp')); ?> ago in <?php the_category(' '); ?><br>
				<span class="comments" data-icon="i"><a href="<?php comments_link(); ?>"><?php thb_comments_number(); ?></a>
				</span>
				</footer>
		</time>
	</header>
</div>