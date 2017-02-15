<?php $post_featured_image = thb_get_post_thumbnail_src(get_the_ID(), 'thumbnail'); ?>
<?php if( !empty($post_featured_image) ) : ?>
<div style="display: inline-block!important;"><div style="margin-bottom: 5px;position:static  !important;display: table-cell;vertical-align: middle;text-align: center;height:165px;width: 205px;">
<a typelinck="image" style="vertical-align: top;width:100%;" class="Dajaxy" href="<?php the_permalink(); ?>">
		<?php
		$tamaño = getimagesize($post_featured_image);
		$anchura=$tamaño[0];
		$altura=$tamaño[1];
	if($anchura > 150) {
        $percent = (150 * 100) / $anchura;
        $anchura = 150;
        $altura = round($altura * ($percent / 100));
    }
    if($altura > 150) {
        $percent = (150 * 100) / $altura;
        $altura = 150;
        $anchura = round($anchura * ($percent / 100));
    }
		if($tamaño['mime'] !=='image/png' && $tamaño['mime'] !=='image/gif'){
			$style='style="box-shadow: 0px 0px 0px 1px rgba(0, 0, 0, 0.1), 0px 1px 1px rgba(0, 0, 0, 0.2), 0px 2px 2px rgba(0, 0, 0, 0.2)"';
		}			
	if ($anchura <= 100){
		$textlargo=ceil(100  / 7);
	}else{
		$textlargo=ceil($anchura  / 7);
	}
		$textlargo=$textlargo-5
?>
<?php $category = get_the_category();$catlink = get_category_link( $category[0]->cat_ID ); ?>
<img <?php echo $style ?> height="<?php echo $altura; ?>" width="<?php echo $anchura; ?>" title="<?php the_title(); ?> by <?php echo get_the_author(); ?>, <?php echo get_the_date(); ?> in <?php echo esc_html($category[0]->cat_name); ?>" src="<?php echo $post_featured_image; ?>" class="<?php echo $class2; ?>">
</a></div></div>
<?php endif; ?>