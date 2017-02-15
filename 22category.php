<?php
global $scroll;
$pagetitle = single_cat_title( '', false );
$pagesubtitle = __("Category", 'thb_text_domain');
global $viewd;
$viewd=$_COOKIE['view_mode'];

if($viewd == 2){
	$moded='margin-left: 5px!important; margin-right: 5px!important; text-align: center!important; width: 320px; display: inline-block!important;';
	$modedtable='text-align: center !important;display: inline-block !important;';
		$modeactive2='active';
	}elseif($viewd == 1){
	$moded='display: inline-block;vertical-align: top;';
		$modeactive1='active';
	}else{
		$moded='display: inline-block;vertical-align: top;';
		$modeactive1='active';
	} 
	
 ?>

<?php if ( $scroll == '' ) : ?>
<?php get_header(); ?>

<section id="content">
<div id="pocicion" pocicion-data=""></div>
<table width="100%" style="min-width:900px;">
	<tr >
		<td width="130px" style="padding: 12px 14px 12px 12px;!important;">
		<a href="http://localhost/Ceci/" style="border: 0px none;font-size: 12.5pt;padding: 0px;line-height: 26px;font-family: Trebuchet MS,sans-serif;color:#F9A939;">
		<span class="Browseico"></span>Browse</a>		
		<div class="todos"></div>
		<?php thb_display_sidebar('post-sidebar', 'main-left'); ?>
		
		</td>
		<td id="selector" width="100%" style="<?php echo $modedtable; ?>">
		
		
<div id="stream-container2">
<div class="barra2">
<div class="container-search"><?php get_search_form(); ?></div>


<div class="right-buttons ">
                <a class="button left thumb-wall  <?php echo $modeactive1; ?>" title="Wall of Thumbs View" href="?view_mode=1">
                    <span></span>
                </a>
                <a class="button middle thumb-grid <?php echo $modeactive2; ?>" title="Grid of Thumbs View" href="?view_mode=2">
                    <span></span>
                </a>
                                <a class="button right full " title="Full View" href="index696b.html?view_mode=2" data-param="view_mode" data-value="full" data-view_mode_id="2">
                    <span></span>
                </a>
                <a class="button sitback" title="Launch SitBack and enjoy..." href="#" onclick="return popupSitback(&quot;&quot;,&quot;boost:popular meta:all max_age:24h&quot;, 400, 300);" target="SitBack"><span></span></a>        
				</div>

</div>
<?php 

die(print_r($wp_query));

?>
	<?php if( have_posts() ) : $i=1; while( have_posts() ) : the_post(); ?>
		<?php thb_post_before(); ?>
		<?php
			$post_id = get_the_ID();
			$post_classes = thb_get_post_classes( $i, array('item list'), 2 );
			$post_classes[] = 'stream';
		?>

		<div id="post-<?php echo $post_id; ?>"  style="<?php echo $moded ?>" <?php post_class($post_classes); ?>>
			<?php thb_post_start(); ?>

			<?php
			
			    if($_COOKIE['view_mode'] == 1) {
					get_template_part( 'loop/formats/stream-' . thb_get_post_format() );
				} elseif($_COOKIE['view_mode'] == 3) {
					get_template_part( 'loop/formats/classic-' . thb_get_post_format() );
				}else{
					get_template_part( 'loop/formats/stream-' . thb_get_post_format() );
				}
			
			?>
			
			
			
			<?php thb_post_end(); ?>
		</div>

		<?php thb_post_after(); ?>
	<?php $i++; endwhile;  echo '<div id="cuan" cuan="'.($cuan=$i-1).'" ></div>'; ?>

	<?php else : ?>

		<div class="notice warning">
			<p><?php _e('Sorry, there aren\'t posts to be shown!', 'thb_text_domain'); ?></p>
		</div>

	<?php endif; ?>

</div>		
		
		</td>
	</tr>
</table>
<div id="content2"></div>



<?php thb_pagination( array( 'type' => 'cate' ) ); ?>
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


		

	<?php if( have_posts() ) : $i=1; while( have_posts() ) : the_post(); ?>
		<?php thb_post_before(); ?>
		<?php
			$post_id = get_the_ID();
			$post_classes = thb_get_post_classes( $i, array('item list'), 2 );
			$post_classes[] = 'stream';
		?>
		
		
		<div id="post-<?php echo $post_id; ?>"  style="<?php echo $moded ?>" <?php post_class($post_classes); ?>>
			<?php thb_post_start(); ?>

			<?php
			
			    if($_COOKIE['view_mode'] == 1) {
					get_template_part( 'loop/formats/stream-' . thb_get_post_format() );
				} elseif($_COOKIE['view_mode'] == 3) {
					get_template_part( 'loop/formats/classic-' . thb_get_post_format() );
				}else{
					get_template_part( 'loop/formats/stream-' . thb_get_post_format() );
				}
			
			?>


			
			<?php thb_post_end(); ?>
		</div>
		
		
		<?php thb_post_after(); ?>
		<?php $i++; endwhile; echo '<div id="cuan" cuan="'.($cuan=$i-1).'" ></div>'; ?>

	<?php else : ?>

		<div class="notice warning">
			<p><?php _e('Sorry, there aren\'t posts to be shown!', 'thb_text_domain'); ?></p>
		</div>

	<?php endif; ?>



<?php endif; ?>



