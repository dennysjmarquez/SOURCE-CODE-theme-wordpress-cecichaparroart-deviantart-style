<?php
	$video_url = thb_get_post_meta( get_the_ID(), 'video_url' );
?>


<div class="magess" style="">
<div class=" videod">

<?php if( !empty($video_url) ) : ?>
	<?php echo do_shortcode('[thb_video url="'. $video_url .'"]'); ?>
<?php endif; ?>


</div>
</div>

<div class="item-wrapper<?php if( !empty($post_featured_image) ) : ?> w-featured-image<?php endif; ?>">

	<header>
		<strong style="font-size: 14px;line-height: 125%;margin: 0px;font-family: Trebuchet MS"><a href="<?php the_permalink(); ?>" rel="permalink"><?php the_title(); ?></a></strong>
		<time pubdate class="pubdate">
				<footer class="item-footer">
				<?php echo human_time_diff(get_the_time('U'), current_time('timestamp')); ?> ago in <?php the_category(' '); ?><br>
				<span class="comments" data-icon="i"><a href="<?php comments_link(); ?>"><?php thb_comments_number(); ?></a>
				</span>
				</footer>
		</time>
	</header>


</div>

