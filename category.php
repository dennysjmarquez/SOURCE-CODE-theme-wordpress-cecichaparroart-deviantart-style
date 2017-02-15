<?php
global $offset;

if (!empty($_COOKIE['page_mode'])){$page_mode=$_COOKIE['page_mode'];}else{$page_mode=0;}

$proce=true;
$search = !empty($_GET['q']) || false;

global $grup;
$grup = !empty($_GET['grup']) || false;

if($grup){

	$grup = $_GET['grup'];

}

$pagetitle = single_cat_title( '', false );

$term = get_queried_object();

$pagesubtitle = __("Category", 'thb_text_domain');
$category = get_the_category();
	
	global $viewd;
	global $cuan;
	global $scroll;
	$thb_page_id = thb_get_page_ID();
	thb_post_query();
	
	if (!empty($_COOKIE['view_mode'])){
		$viewd=$_COOKIE['view_mode'];
	}else{
		$viewd=1;
	}
	if($viewd == 2){
	$moded='margin-left: 5px!important; margin-right: 5px!important; text-align: center!important; width: 320px; display: inline-block!important;';
	$modedtable='text-align: center !important;padding-left: 20px;padding-right: 10px;';
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


 global $offset;
 

if($offset == null){$offsetini=0;}else{$offsetini=$offset;}


if (is_tag()){

$action=esc_url( home_url( '/' ));

}else if (count(get_the_category()) > 0 ){
global $term;
//$category = get_the_category();

//$term->slug

//die(print_r($term));
		$WP_PATH = implode("/", (explode("/", $_SERVER['SCRIPT_NAME'], -1)));
		
		 $showingpage = explode("/", $_SERVER[REQUEST_URI],-1);
		 
		 $showingpage=$showingpage[(count($showingpage) - 1)];
		
		$WP_PATH .= '/category/';
		$resul = str_ireplace($WP_PATH,'',$_SERVER[REQUEST_URI]);
		$resul2 = preg_replace('~[?]q=(.*)+~', '', $resul);
		$resul2 = preg_replace('~[?]offset=[0-9]+~', '', $resul2);
		$resul2 = preg_replace('~[&]offset=[0-9]+~', '', $resul2);
		$resul2 = preg_replace('~[&]q=(.*)+~', '', $resul2);
		
		
		
		$action=get_bloginfo('url').'/category/'.$resul2;

	
	
}else{
	$action=esc_url( home_url( '/' ));
}
	
 ?>

<?php if ( $scroll == '' ) : ?>
<?php get_header(); ?>
<section id="content">
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
                  <button class="toolbarButton pageUp" title="Página anterior" id="previous" tabindex="6" data-l10n-id="previous">
                    <span data-l10n-id="previous_label">Anterior</span>
                  </button>
                  <div class="splitToolbarButtonSeparator"></div>
                  <button class="toolbarButton pageDown" title="Página siguiente" id="next" tabindex="7" data-l10n-id="next">
                    <span data-l10n-id="next_label">Siguiente</span>
                  </button>
                </div>
			
			<label id="pageNumberLabel" class="toolbarLabel" for="pageNumber" >Page 1: </label>
			<input id="pageNumber" class="toolbarField pageNumber" value="1" size="4" min="1" tabindex="8" type="number">
			<span id="numPages" class="toolbarLabel">of 1</span>
		</div>
		</td>
		
		<td width="240px" id="botv" style="display:none">
		
<div id="bottonv" class="right-buttons">
<a id="simplestring" class="ui-btn ui-btn-corner-all ui-shadow ui-btn-up-c" href="#">
</a>


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

<table width="100%" style="min-width:900px;table-layout: fixed;border-collapse: separate;border-spacing: 0px" id="result-0" class="scrollblock" data-page="1" data-cont="<?php echo $offsetini; ?>">
	<tr >
		<td width="100%" style="<?php echo $modedtable; ?>">

<?php
/*
	if($offset !== null){
		
		$offset=$offset-1;
	}
*/



if($search){
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$ppp = get_option('posts_per_page');
	$page_offset = $offset + ( ($paged -1) * $ppp );
	
	$searchID=$_SESSION['SEARCHID'];

		

$args=array(
    'post__in' => $searchID,
    'posts_per_page' => $ppp,
	'offset' => $page_offset,
	'order' => 'DESC'
  );
  
  

$wp_query->query($args);
$published_posts=count($searchID);



if(count($searchID) > 0){
if(count($searchID) > 1){
	$rr=' results.';
}else{
	$rr=' result.';
}
$wp_query->query($args);
$Found ='<div class="showing-page">
        Found <strong>'.count($searchID).'</strong> relevant'.$rr.'
    </div>';

}else{
$proce=false;
}
	



}else{

	
	if (count($category) > 0){
			
		$cate=$term->cat_ID;
		
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$ppp = get_option('posts_per_page');
		$page_offset = $offset + ( ($paged -1) * $ppp );
		$wp_query->query('offset='.$page_offset.'&posts_per_page='.$ppp.'&cat='.$cate);
		
		$published_posts =  wp_get_cat_postcount($cate);
	
		
	}else{
		$published_posts = 0;
		$proce=false;
	}
	

}

?>
<div class="hr2"></div>
<table border="0" width="100%" cellspacing="0" cellpadding="0" style="margin-top: 80px;">
	<tr>
		<td valign="bottom">
		
<div style="" class="widget widget_categories">
<a href='<?php echo esc_url( home_url( '/' )) ?>' class="home2" title="<?php echo get_option('blogname') ?>"></a>
<div class="cct" style="display: inline-block;">
<header><h1 style="display: inline-block;" class="widgettitle">Categories<div style="width: 3px; border-left: 1px solid rgb(204, 204, 204); display: inline-block; height: 14px; line-height: 14px; vertical-align: bottom; margin: 2px 0px 0px 8px;"></div><div style="width: 16px; height: 16px; display: inline-block; background: url('<?php echo get_template_directory_uri(); ?>/css/abaj.png') no-repeat scroll 0% 0% transparent; vertical-align: bottom; position: relative; left: 7px; top: 6px;"></div></h1>
    
</header>

<?php echo Decate(true); ?>

</div>



</div>		
<div class="well">Wellcome My Galerry</div>
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


<?php if( $offset > 0 ) : ?>
<span class="showing-page">Category: <?php echo $showingpage; ?> | Starting from <?php echo $offset; ?><sup>th</sup> result</span>
<?php if ($Found){echo $Found;} ?>
<?php else: ?>
<span class="showing-page">Category: <?php echo $showingpage; ?></span>
<?php if ($Found){echo $Found;} ?>
<?php endif; ?>
	<?php if( have_posts()  && $proce==true ) : $i=1; while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
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
	<?php $i++; endwhile;  echo '<div id="cuan" cuan="'.($cuan=$i-1).'" ></div>'; ?>

	<?php else : ?>
			
		<div class="notice warning">
			<?php if(($offset+1) > $published_posts && $published_posts !==0 ): ?>
				<?php if($search) : ?>
				
				<p>Sorry, we don't have that many results. Try <a href="<?php echo esc_url( $action ); ?>?offset=0&q=<?php echo $_GET['q'] ?>">starting from the beginning</a></p>
				<?php else: ?>
				<p>Sorry, we don't have that many results. Try <a href="<?php echo esc_url( $action ); ?>">starting from the beginning</a></p>
				<?php endif; ?>
			<?php else: ?>
				<p>Sorry, we found no relevant results.</p>
			<?php endif; ?>
			
		</div>

	<?php endif; ?>

</div>		
		
		</td>
		
		
	</tr>
</table>
<div id="content2"></div>



<?php 
if($proce){

if($search){

	
	thb_pagination( array( 'type' => 'stream', 'search' => true,'querysd' => $_GET['q'],'page_mode' => $page_mode));


}else{

	thb_pagination( array( 'type' => 'stream', 'search' => false, 'page_mode' => $page_mode));

}

}

?>


</section>
<div id="footer-stripe">

    <div class="wrapper">
        <div class="thb-footer-stripe-content">
            <div class="thb-twitter-livefeed"></div>
        </div>
    </div>

</div>
<?php get_footer(); ?>
<?php else : ?>


<?php

if($search){
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$ppp = get_option('posts_per_page');
	$page_offset = $offset + ( ($paged -1) * $ppp );

$searchID=$_SESSION['SEARCHID'];


$args=array(
    'post__in' => $searchID,
    'posts_per_page' => $ppp,
	'offset' => $page_offset,
	'order' => 'DESC'
  );
  
  

$wp_query->query($args);
$published_posts=count($searchID);

}else{



	if (count($category) > 0){
			
		$cate=$term->cat_ID;
		
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$ppp = get_option('posts_per_page');
		$page_offset = $offset + ( ($paged -1) * $ppp );
		$wp_query->query('offset='.$page_offset.'&posts_per_page='.$ppp.'&cat='.$cate);
		$published_posts =  wp_get_cat_postcount($cate);
		
			
		
		
	}else{
		$published_posts = 0;
		$proce=false;
	}
	 
	 

	 

}


?>
		

	<?php if( have_posts() ) : $i=1; while( have_posts() ) : the_post(); ?>
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



