<?php
	
	global $viewd;
	$post_featured_image = types_render_field("image", array("url" => "true"));
	
	
	
?>

<?php if( !empty($post_featured_image) ) : ?>



<div class="muestrate" style="">
<div style="text-align: center;">
<div style="width:auto; display: inline-block;">
<a class="Dajaxy" typelinck="image" href="<?php the_permalink(); ?>" style="width:auto; display: inline-block;" class="clsVentanaIFrame item-thumb">

		<?php
		
		
		
		$tamaño = getimagesize($post_featured_image);
		$anchura=$tamaño[0];
		$altura=$tamaño[1];
		
		
		
		
		$w=$_SESSION['pantallaw'];
		$w=intval($w);
		
		$w = $w -239;
		
		
		
		
		
		if ($anchura > $w) {

			$altura = ceil($w / $anchura * $altura); 
			$anchura = $w;

		} 		

		
		
	
		$texta=$anchura;
		
		$texta = $texta - 330;
	
		$textlargo=ceil($texta  / 7);
	
	
		
		
		
		?>

<div class="magess">
  
  
	
		
		
		
					<?php $category = get_the_category();
						  $catlink = get_category_link( $category[0]->cat_ID );
						$ssss=get_the_author();
	global $grup;
	if($grup){
		
		$grup2 = ' grup'.$grup;
		
	}else{

		$grup2 = ' grup0';
		
	}	
						
						  ?>

						  
		
	    <img src-full="<?php echo $post_featured_image; ?>" height="<?php echo $altura; ?>" width="<?php echo $anchura; ?>" alt="<?php the_title(); ?> by <?php echo get_the_author(); ?>, <?php echo get_the_date(); ?> in <?php echo esc_html($category[0]->cat_name); ?>" src="<?php echo $post_featured_image; ?>" class="magess-Full<?php echo $grup2;?>">
		
		
	

</div>
</a>

<div style="text-align: left;">



	<header class="full-b">
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
</div>
<?php else : ?>
<?php 

	$w=$_SESSION['pantallaw'];
	$w=intval($w);
	$w2=$w-730;
	
		$textlargo=ceil($w2	  / 7);


?>

<div class="muestrate" style="margin-right: 20px;margin-left: 20px;">
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
			<?php the_content(); ?>
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


<?php endif; ?>












