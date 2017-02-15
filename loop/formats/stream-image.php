<?php global $viewd;$post_featured_image = thb_get_post_thumbnail_src(get_the_ID(), 'thumb-300'); if($viewd == 2){$moded='text-align: center; display: inline-block;';} 
$post_featured_image2 = types_render_field("image", array("url" => "true"));
?>
<?php if( !empty($post_featured_image) ) : ?>
<div class="muestrate" style="<?php echo $moded; ?>">
<a class="Dajaxy" typelinck="image" href="<?php the_permalink(); ?>" style="width:100%; display: inline-block;" class="clsVentanaIFrame item-thumb" title="<?php the_title(); echo ' on '.get_bloginfo('name') ; ?>">
<?php

	$tamaño = getimagesize($post_featured_image);$anchura=$tamaño[0];$altura=$tamaño[1];
		
	if($anchura > 300) {
        $percent = (300 * 100) / $anchura;
        $anchura = 300;
        $altura = round($altura * ($percent / 100));
    }
    if($altura > 200) {
        $percent = (200 * 100) / $altura;
        $altura = 200;
        $anchura = round($anchura * ($percent / 100));
    }

		if($altura == 200 and $anchura < 300 and $tamaño[2]==3 or $tamaño[2]==1 ){
			$class='magess3';
			$class2='magess4';
		}else{
			$class='magess';
			$class2='magess2';
			
		}
	
	if ($anchura <= 100){
		$textlargo=ceil(100  / 7);
	}else{
		$textlargo=ceil($anchura  / 7);
	}
	
		$textlargo=$textlargo-5
		
		
		
?>
<div class="<?php echo $class ?>" >
<?php $category = get_the_category();$catlink = get_category_link( $category[0]->cat_ID );?>
<?php global $scrolly, $grup;

	if($grup){
		
		$grup2 = ' grup'.$grup;
		
	}else{
	
		$grup2 = ' grup0';
	
	}


?>
<?php if ($scrolly == 'true') : ?>
	<img src-full="<?php echo $post_featured_image2; ?>" height="<?php echo $altura; ?>" width="<?php echo $anchura; ?>" title="<?php the_title(); ?> by <?php echo get_the_author(); ?>, <?php echo get_the_date(); ?> in <?php echo esc_html($category[0]->cat_name); ?>" src="<?php echo $post_featured_image; ?>" class="<?php echo $class2.$grup2; ?>">
<?php else : ?>
	<img src-full="<?php echo $post_featured_image2; ?>" height="<?php echo $altura; ?>" width="<?php echo $anchura; ?>" title="<?php the_title(); ?> by <?php echo get_the_author(); ?>, <?php echo get_the_date(); ?> in <?php echo esc_html($category[0]->cat_name); ?>" src="<?php echo $post_featured_image; ?>" class="<?php echo $class2.$grup2; ?>">
<?php endif; ?>

</div>
</a>
<div class="vie" ><div class="small">Viewer</div><div class="mlt-icon"></div></div>

<?php else : ?>
<div class="cuadros">
<?php endif; ?>

<div class="item-wrapper<?php if( !empty($post_featured_image) ) : ?> w-featured-image<?php endif; ?>">

	<header style="text-align: left;">
		<strong style="font-size: 14px;line-height: 125%;margin: 0px;font-family: Trebuchet MS"><a typelinck="image" class="Dajaxy" href="<?php the_permalink(); ?>" rel="permalink"><?php if (strlen($post->post_title) > $textlargo) { echo substr(the_title($before = '', $after = '', FALSE), 0,$textlargo) .'...'; } else { the_title(); } ?></a></strong>
		<time pubdate class="pubdate">
				<footer class="item-footer">
				<?php echo human_time_diff(get_the_time('U'), current_time('timestamp')); ?> ago in <?php the_category(' '); ?><br>
				<span class="comments" data-icon="i"><a href="<?php comments_link(); ?>"><?php thb_comments_number(); ?></a>
				</span>
				</footer>
		</time>
	</header>


</div>



<?php if( empty($post_featured_image) ) : ?>
</div>
<?php endif; ?>
</div>