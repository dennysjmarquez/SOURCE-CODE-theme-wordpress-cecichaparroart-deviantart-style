<?php

	if (!empty($_COOKIE['page_mode'])){$page_mode=$_COOKIE['page_mode'];}else{$page_mode=0;}
	
	global $cuan;
	global $scroll;
	global $offset;	
	global $viewd;
	$thb_page_id = thb_get_page_ID();

	if (!empty($_COOKIE['view_mode'])){$viewd=$_COOKIE['view_mode'];}else{$viewd=1;}

	if($viewd == 2){
	$moded='margin-left: 5px!important; margin-right: 5px!important; text-align: center!important; width: 320px; display: inline-block!important;';
	$modedtable='text-align: center !important;display: inline-block !important;';
		$modeactive2='active';
	}elseif($viewd == 1){
	$moded='display: inline-block;vertical-align: top;';
	$modedtable='padding-right: 10px; padding-left: 20px;';
		$modeactive1='active';
	}elseif($viewd == 3){
		$modeactive3='active';
		$modedtable='padding-right: 10px; padding-left: 20px;';
	}else{
		$moded='display: inline-block;vertical-align: top;';
		$modeactive1='active';
	} 
	if($offset == null){$offsetini=0;}else{$offsetini=$offset;}	

 
 
if($offset == null){$offsetini=0;}else{$offsetini=$offset;}
?>
<?php if ( $scroll == '' ) : ?>
<div id="pocicion" pocicion-data=""></div>

<table id="barra" class="barra2" align="center" border="0" width="100%" cellspacing="0" cellpadding="0" >
	<tr>
		<td style="text-align: center;">
		<div id="hiden" class="hiden">
		<div class="splitToolbarButton2">
		<span id="numDisplay" class="toolbarLabel"></span>
		</div>
		</div>
		</td>
		<td>
			<div id="hiden" style="text-align: center;" class="hiden">
			<div class="splitToolbarButton">
                  <button class="toolbarButton pageUp" title="Página anterior" id="previous" >
                    <span>Anterior</span>
                  </button>
                  <div class="splitToolbarButtonSeparator"></div>
                  <button class="toolbarButton pageDown" title="Página siguiente" id="next" >
                    <span>Siguiente</span>
                  </button>
                </div>
			
			<label id="pageNumberLabel" class="toolbarLabel" for="pageNumber" >Page 1: </label>
			<input id="pageNumber" class="toolbarField pageNumber" value="1" size="4" min="1"  type="number">
			<span id="numPages" class="toolbarLabel">of 1</span>
		</div>
		</td>
		
		<td width="240px" id="botv" style="display:none">
		
		
		
<div id="bottonv" class="right-buttons">



				<a class="button left thumb-wall <?php echo $modeactive1; ?>" title="Wall of Thumbs View" href="?view_mode=1">
                    <span></span>
                </a>
                <a class="button middle thumb-grid <?php echo $modeactive2; ?>" title="Grid of Thumbs View" href="?view_mode=2" >
                    <span></span>
                </a>
                <a class="button right full <?php echo $modeactive3; ?>" title="Full View" href="?view_mode=3" >
                    <span></span>
                </a>
                <a class="button sitback " style="display: none;" title="Launch Slideshow..." href="#" ><span></span></a>
				</div>		
		
		</td>
	</tr>
</table>


<table width="100%" style="min-width:900px;table-layout: fixed;border-collapse: separate;border-spacing: 0px" id="result-0" class="scrollblock" data-page="1"  data-displayd="" data-displayoff="" data-cont="<?php echo $offsetini; ?>">
	<tr>
		<td width="100%" style="<?php echo $modedtable; ?>">
<?php
global $offset;

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$ppp = get_option('posts_per_page');

$page_offset = $offset + ( ($paged -1) * $ppp );



$tag=single_tag_title( '', false );

$wp_query->query('offset='.$page_offset.'&posts_per_page='.$ppp.'&tag='.$tag);
$published_posts =  wt_get_category_count(single_tag_title( '', false ));

if($published_posts > 1){
	$rr=' results.';
}else{
	$rr=' result.';
}

$Found ='Found <strong>'.$published_posts.'</strong> relevant'.$rr;


?>
<div class="hr2"></div>
<table border="0" width="100%" cellspacing="0" cellpadding="0" style="margin-top: 20px;">
	<tr>
		<td valign="bottom">
		
<div style="" class="widget widget_categories">
<a href='<?php echo esc_url( home_url( '/' )) ?>' class="home2" title="<?php echo get_option('blogname') ?>"></a>
<div class="cct" style="display: inline-block;">
<header><h1 style="display: inline-block;" class="widgettitle">Categories<div style="width: 3px; border-left: 1px solid rgb(204, 204, 204); display: inline-block; height: 14px; line-height: 14px; vertical-align: bottom; margin: 2px 0px 0px 8px;"></div><div style="width: 16px; height: 16px; display: inline-block; background: url('<?php echo get_template_directory_uri(); ?>/css/abaj.png') no-repeat scroll 0% 0% transparent; vertical-align: bottom; position: relative; left: 7px; top: 6px;"></div></h1>
    
</header>

<?php echo Decate(); ?>

</div>



</div>		
		
		</td>
		<td align="center">
		
<div class="sosial_contenedor">
<header><h1 class="follo">Follow In
<div class="sosial">
<img src="<?php echo esc_url( home_url( '/' )) ?>wp-content/themes/cecichaparroart/css/images/facebook.png" alt="">
<img src="<?php echo esc_url( home_url( '/' )) ?>wp-content/themes/cecichaparroart/css/images/twitter.png" alt="">
<img src="<?php echo esc_url( home_url( '/' )) ?>wp-content/themes/cecichaparroart/css/images/google.png" alt="">


</div>

</h1>
    
</header>  
</div>		
		
		</td>
		<td valign="bottom" style="display: none;">
		
				<div id="bottonv" class="right-buttons">

				<a class="button left thumb-wall <?php echo $modeactive1; ?>" title="Wall of Thumbs View" href="?view_mode=1">
                    <span></span>
                </a>
                <a class="button middle thumb-grid <?php echo $modeactive2; ?>" title="Grid of Thumbs View" href="?view_mode=2" >
                    <span></span>
                </a>
                <a class="button right full <?php echo $modeactive3; ?>" title="Full View" href="?view_mode=3" >
                    <span></span>
                </a>
                <a class="button sitback" style="display: none;" title="Launch Slideshow..." href="#" data-grup="grup0"><span></span></a>
				</div>				
		
		
		</td>
	</tr>
</table>


<span class="showing-page">Tag: <?php echo $tag; ?> | <?php echo $Found; ?></span>


<?php if( $offset > 0 ) : ?>
<span class="showing-page">Starting from <?php echo $offset; ?><sup>th</sup> result</span>
<?php endif; ?>
	<?php if( have_posts() ) : $i=1; while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
		<?php thb_post_before(); ?>
		<?php
			$post_id = get_the_ID();
			$post_classes = thb_get_post_classes( $i, array('item list'), 2 );
			$post_classes[] = 'stream';
			
		?>
	
		<div id="post-<?php echo $post_id; ?>"  style="<?php echo $moded ?>" <?php post_class($post_classes); ?>>
<div <?php if($viewd != 3) {echo 'class="d-box"';} ?>>
			<?php thb_post_start(); ?>
			<?php 
			if($viewd ==1){
				get_template_part( 'loop/formats/stream-' . thb_get_post_format() ); 
			}else if($viewd ==3){
				get_template_part( 'loop/formats-full/stream-' . thb_get_post_format() ); 
			}else{
				get_template_part( 'loop/formats/stream-' . thb_get_post_format() ); 
			}
			?>	
			<?php thb_post_end(); ?>
</div>
</div>

		<?php thb_post_after(); ?>
	<?php $i++; endwhile; echo '<div id="cuan" cuan="'.($cuan=$i-1).'" ></div>'; ?>
	

	<?php else : ?>

		<div class="notice warning">
			<p><?php _e('Sorry, there aren\'t posts to be shown!', 'thb_text_domain'); ?></p>
		</div>

	<?php endif; ?>


		
		</td>
		
	
	</tr>
	
</table>



<?php thb_pagination( array( 'type' => 'stream', 'search' => false, 'page_mode' => $page_mode,'sitag' => true)); ?>


<div id="content2"></div>


<?php else: ?>

<?php

global $offset;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$ppp = get_option('posts_per_page');
$page_offset = $offset + ( ($paged -1) * $ppp );
$tag=single_tag_title( '', false );
$wp_query->query('offset='.$page_offset.'&posts_per_page='.$ppp.'&tag='.$tag);
$published_posts =  wt_get_category_count(single_tag_title( '', false ));





?>

	<?php if( have_posts() ) : $i=1; while( have_posts() ) : the_post();?>
		<?php thb_post_before(); ?>
		<?php
			$post_id = get_the_ID();
			$post_classes = thb_get_post_classes( $i, array('item list'), 2 );
			$post_classes[] = 'stream';
			
			
		?>
	
				<div id="post-<?php echo $post_id; ?>"  style="<?php echo $moded ?>" <?php post_class($post_classes); ?>>
		<div <?php if($viewd != 3) {echo 'class="d-box"';} ?>>
			<?php thb_post_start(); ?>
			<?php 
			if($viewd ==1){
				get_template_part( 'loop/formats/stream-' . thb_get_post_format() ); 
			}else if($viewd ==3){
				get_template_part( 'loop/formats-full/stream-' . thb_get_post_format() );
			}else{
				get_template_part( 'loop/formats/stream-' . thb_get_post_format() ); 
			}
			?>
			<?php thb_post_end(); ?>
		</div>
		</div>

		<?php thb_post_after(); ?>
	<?php $i++; endwhile; echo '<div id="cuan" cuan="'.($cuan=$i-1).'" ></div>'. '<div id="cuan2" cuan="'.($cuan=$i-1).'" ></div>'; ?>
	
	<?php endif; ?>



<?php endif; ?>