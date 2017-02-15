<?php
	//$post_featured_image = thb_get_post_thumbnail_src(get_the_ID(), 'thumb-360');
	global $viewd;

	if($viewd == 2){
		$moded='text-align: center; display: inline-block;';
	}elseif($viewd == 1){

	}	
?>


<div class="muestrate" style="<?php echo $moded; ?>">
<div class="degra" style="display: inline-block;">
<div class="magess5" style="position: relative" >	


<div class="cuadros" >
<div class="scro">

<q class="d2" style="min-height:200px; top: 0px; display: block;" onmouseleave="$(this).stop();scroll2(this,1)" onmouseenter="scroll2(this)">

<a typelinck="text" style="max-width: 300px;width: 100%;height: 100%;position: absolute;z-index: 1;" href="<?php the_permalink(); ?>" rel="permalink" class="Dajaxy"></a>

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
</div>
<div class="vie" ><div class="small">Viewer</div><div class="mlt-icon"></div></div>

<div class="item-wrapper w-featured-image">

	<header style="text-align: left;">
		<strong style="font-size: 14px;line-height: 125%;margin: 0px;font-family: Trebuchet MS"><a typelinck="text" class="Dajaxy" href="<?php the_permalink(); ?>" rel="permalink"><?php if (strlen($post->post_title) > 39) { echo substr(the_title($before = '', $after = '', FALSE), 0,36) .'...'; } else { the_title(); } ?></a></strong>
		<time pubdate class="pubdate">
				<footer class="item-footer">
				<?php echo human_time_diff(get_the_time('U'), current_time('timestamp')); ?> ago in <?php the_category(' '); ?><br>
				<span class="comments" data-icon="i"><a href="<?php comments_link(); ?>"><?php thb_comments_number(); ?></a>
				</span>
				</footer>
		</time>
	</header>


</div>

</div>