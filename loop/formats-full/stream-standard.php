<?php
	$post_featured_image = thb_get_post_thumbnail_src(get_the_ID(), 'thumb-360');
	global $viewd;

	if($viewd == 2){
		$moded='text-align: center; display: inline-block;';
	}elseif($viewd == 1){

	}	
	
	$w=$_SESSION['pantallaw'];
	
	$textlargo=ceil(($w-330)  / 7);
?>


<div class="muestrate" style="<?php echo $moded; ?>">
<div style="display: block;margin: 0px auto;width:<?php echo ($w -216); ?>px">
<div class="magess5" >

<div class="cuadrosG">

<span class="post-content" style="display:block;overflow:hidden;">
		<section>
		<div>
<a style="max-width: 300px;" href="<?php the_permalink(); ?>" rel="permalink" class="Dajaxy">		
<h1 class="post-title"><?php the_title() ?></h1>
</a>
<div class="post-info clearfix">
		<div class="details2" style="margin-bottom: 10px;">
		<?php echo human_time_diff(get_the_time('U'), current_time('timestamp')); ?> ago in <?php the_category(' '); ?>	

		</div>
		
</div>
	<a style="max-width: 300px;" href="<?php the_permalink(); ?>" rel="permalink" class="Dajaxy">
	<div class="thb-text2">
		<?php if( get_the_content() != '' ) : ?>
			<?php print get_the_content(); ?>
		<?php endif; ?>							

	</div>
	</a>
		</div>		
	</section>
		</span>





</div>		
		
	
	

</div>

<div style="text-align: left;">



	<header class="full-b" style="width:<?php echo ($w -235); ?>px; margin: -4px 0px 50px;">
		<div style="display: inline-block;">
		<strong style="margin: 10px;font-size: 14px;line-height: 100%;font-family: Trebuchet MS;display: inline-block;"><a typelinck="image" class="Dajaxy" href="<?php the_permalink(); ?>" rel="permalink"><?php if (strlen($post->post_title) > $textlargo) { echo substr(the_title($before = '', $after = '', FALSE), 0,$textlargo) .'...'; } else { the_title(); } ?></a></strong>
		</div>
				<div style="display: inline-block;float: right;border-left: 1px solid;height: 32px;">
				<footer class="item-footer" style="margin: 6px 20px 0px 10px;">
				<?php echo human_time_diff(get_the_time('U'), current_time('timestamp')); ?> ago in <?php the_category(' '); ?>
				<span class="comments" data-icon="i"><a href="<?php comments_link(); ?>"><?php thb_comments_number(); ?></a></span>
				</footer>
				</div>
	</header>

	

</div>
</div>
</div>

