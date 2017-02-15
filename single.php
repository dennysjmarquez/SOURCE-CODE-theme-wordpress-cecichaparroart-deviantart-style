<?php
$imgurl=types_render_field("image", array("url" => "true"));
$thumbnail = thb_get_post_thumbnail_src(get_the_ID(), 'thumbnail');

$solocomentw = isset($_GET['comentw']) ? $_GET['comentw'] : false;
$comentajax = isset($_GET['comentajax']) ? $_GET['comentajax'] : false;
if($comentajax == true || $solocomentw == true)header("Content-Type:text/plain");
$thb_page_id = get_the_ID();
$meta = thb_get_post_meta_all($thb_page_id);
$meta2=get_post_custom(get_the_ID());
extract($meta);
$subtitle = get_the_date();
if( $solocomentw == false && $comentajax == false){
get_header('single');
global $id;
	if ( null === $post_id ){
		$post_id = (int) isset($_POST['post_id']) ? $_POST['post_id']: $post->ID;
	}
		wp_enqueue_script( 'saicl_js_script' );
		wp_localize_script('saicl_js_script','SAIC_WP',
			array(
				'bloqueactual' => '',
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'ajaxurl2' => get_permalink( $post_id ),
				'saicNonce' => wp_create_nonce('saicl-nonce'),
				'jpages' => $options['jpages'],
				'jPagesNum' => $options['num_comments_by_page'],
				'textCounter' => $options['text_counter'],
				'textCounterNum' => $options['text_counter_num'],
				'widthWrap' => $options['width_comments'],
				'autoLoad' => 'true',
			)
		);
		
}
?>
<?php if( $comentajax == false) : ?>
<?php if( $solocomentw == false) : ?>
<?php if( $solocoment == false) : ?>
<?php if($imgurl !==''): ?>
<script type="text/javascript">

$(document).ready( function(){

	var cantenedorimg;
	cantenedorimg = {
		'viewportWidth' : '100%',
		'viewportHeight' : '100%',
		'fitToViewportShortSide' : true,  
		'contentSizeOver100' : false,
		'startScale' : 0,
		'animTime' : 500,
		'draggInertia' : 10,
		'zoomLevel' : 1,
		'zoomStep' : 0.1,
		'contentUrl' : '<?php echo $imgurl; ?>',
		'intNavEnable' : true,
		'intNavPos' : 'B',
		'intNavAutoHide' : true,
		'intNavMoveDownBtt' : false,
		'intNavMoveUpBtt' : false,
		'intNavMoveRightBtt' : false,
		'intNavMoveLeftBtt' : false,
		'intNavZoomBtt' : true,
		'intNavUnzoomBtt' : true,
		'intNavFitToViewportBtt' : true,
		'intNavFullSizeBtt' : true,
		'intNavBttSizeRation' : 1,
		'mapEnable' : true,
		'mapThumb' : '<?php echo $thumbnail; ?>',
		'mapPos' : 'BL',
		'popupShowAction' : 'click'
		
	};

	$('#wrapper_img').lhpMegaImgViewer(cantenedorimg);
	
	


	tinymce.init({
			selector: "#saicl-textarea2-<?php echo $post_id;?>",
			object_resizing :true,
			relative_urls: true,
			inline: true,
			image_advtab: true,
			menubar:false,
			toolbar:true,
			statusbar : true,
			plugins: [ "advlist autolink lists link image charmap print preview hr anchor pagebreak","searchreplace wordcount visualblocks visualchars code fullscreen","insertdatetime media nonbreaking save table contextmenu directionality", "emoticons template paste textcolor" ],
			formats: {bold : {inline : 'b' },  italic : {inline : 'i' },underline : {inline : 'u'}
			},toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
			toolbar2: "print preview media | forecolor backcolor emoticons",
			content_css : thb_system.root_url + "/wp-content/themes/cecichaparroart/js/tinymce/stule.css",
			
				setup: function(editor) {
				
					editor.on('init', function() {
						
						$('#saicl-textarea2-<?php echo $post_id;?>').trigger('blur');
						$('#saicl-textarea2-<?php echo $post_id;?>').trigger('focus');
						$('.mce-btn-small').css('display','block');
			

				});
				
					
				
				}
		


		
		});	
	

	

	saicl_script();
	textevencall();
	

	
	
	
});
	
	


	

//visibility: hidden;
//-->
</script>
<?php endif; ?>
<div id="content">
<table id="conte" border="0" width="100%" height="100%" cellpadding="0" style="table-layout: fixed;border-collapse: separate;border-spacing: 0px">
<colgroup>
	<col  style="width:100%;">
    <col style="width:330px;">
</colgroup>
	<tr class="print">
		<td colspan="2" width="100%">
<?php if( thb_get_post_format() == 'standard') : ?>
<div style="background-color: rgb(255, 255, 255); margin: 10px 10px -10px;" >
<?php endif; ?>
<span class="post-content" style="display:block;overflow:hidden;">
	<?php thb_post_before(); ?>
	<section>
	<?php if( thb_get_post_format() == 'image') : ?>
	<div id="wrapper_img" data-tyle="<?php echo thb_get_post_format() ?>" style="box-shadow: -3px 3px 10px #000;position: relative;width:100%; height:550px;">


	</div>
	<?php endif; ?>
	<?php echo types_render_field("descripcion", array("output"=>"html"))?>
<div>
<h1 class="post-title"><?php the_title(); ?></h1>
<div class="post-info clearfix">
	<?php if( thb_get_post_format() == 'standard') : ?>
	<div class="details2">
	<?php else : ?>
	<div class="details3">
	<?php endif; ?>	
	<?php echo human_time_diff(get_the_time('U'), current_time('timestamp')); ?> ago in <?php the_category(' '); ?>
	</div>
		
		<div class="social-bar top">

			</div>
</div>
		<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
			<?php thb_post_start(); ?>
			<?php if( thb_get_post_format() == 'video') : {
					echo '<div class="thb-single-video-wrapper">';
						thb_post_format_video();
					echo '</div>';
				} endif; ?>
			<?php if( thb_get_post_format() == 'audio	') : {
					thb_post_format_audio();
				} endif; ?>
			<?php if( thb_get_post_format() == 'gallery') : {
					thb_post_format_gallery(array(
						'size' => 'large-cropped'
					));
				} endif; ?>
			<?php if( thb_get_post_format() == 'quote') : {
					$quote = thb_get_post_format_quote_text();
					$quote_url = thb_get_post_format_quote_url();
					$quote_author = thb_get_post_format_quote_author();
				?>
				<div class="single-post-quote">
				<?php if( !empty($quote) ) : ?>
					<blockquote>
						<p><?php echo $quote; ?></p>
					</blockquote>
				<?php endif; ?>
				<?php if( !empty($quote_author) || !empty($quote_url) ) : ?>
				<p>
					<cite>
						<?php if( !empty($quote_url) ) : ?>
							<a href="<?php echo $quote_url; ?>">&mdash; <?php echo $quote_author; ?></a>
						<?php else : ?>
							<?php echo '&mdash; ' . $quote_author; ?>
						<?php endif; ?>
					</cite>
				</p>
				<?php endif; ?>
				</div>
			<?php } endif; ?>
			
			<?php if( get_the_content() != '' ) : ?>
				<div class="thb-text2">
					<?php 
										
					$content = get_the_content();
					print $content;
					
					?>
					<?php
						wp_link_pages(array(
							'pagelink' => '<span>%</span>',
							'before'   => '<div id="page-links"><p><span class="pages">'. __('Pages', 'thb_text_domain').'</span>',
							'after'    => '</p></div>'
						));
					?>
				</div>
			<?php endif; ?>
			<?php thb_post_end(); ?>
		<?php endwhile; endif; ?>
		</div>		
	</section>
	<?php thb_post_after(); ?>
	<?php thb_page_sidebar(); ?>
</span>
<?php if( thb_get_post_format() == 'text') : ?>
</div>
<?php endif; ?>
		</td>
	</tr>
	<tr class="coment">
		<td width="100%" rowspan="2">
			<?php if( thb_show_comments() ) : ?>
				<section id="Dcoment">
				<?php if( thb_show_comments() ) : ?>
					<?php if(function_exists("display_saic")) { echo display_saic();} ?>
				<?php endif; ?>
				</section>
			<?php endif; ?>		
		</td>
		<td height="40" >
		<?php 
		$imgurl=types_render_field("image", array("url" => "true"));
		$caption1='<a href="'.get_permalink( $post_id ).'">'.get_the_title($post_id).'</a>';
		$urlb='<a href="'.get_bloginfo('url').'">By Ceci Chaparro Photography</a>';
		$share1='http://www.tumblr.com/share/photo?source='. encodeURIComponent($imgurl).'&caption='.encodeURIComponent($caption1.$urlb).'&clickthru='.encodeURIComponent(get_permalink( $post_id ));
		$caption1=get_the_title($post_id).' By Ceci Chaparro Photography';
		$share2='http://twitter.com/share?text=Check+out+'.encodeURIComponent($caption1).'&url='.encodeURIComponent($imgurl).'&related='.get_bloginfo('url');
		$caption1='The '.get_the_title($post_id).' By Ceci Chaparro Photography on '.get_bloginfo('url');
		$share3='http://pinterest.com/pin/create/button/?url='.get_permalink( $post_id ).'&media='.encodeURIComponent($imgurl).'&description='.encodeURIComponent($caption1);
		$share4='http://reddit.com/submit?url='.encodeURIComponent(get_permalink( $post_id ));
		$share5='https://plus.google.com/share?url='.encodeURIComponent(get_permalink( $post_id ));
		$share6='http://www.stumbleupon.com/submit?url='.encodeURIComponent(get_permalink( $post_id ));
		?>
		<div style="height:40px; border-bottom: 2px solid rgba(0, 39, 59, 0.08);background: none repeat scroll 0% 0% #FFF;">
		<span class="Share" >Share:</span>
		<a class="tumblr" title="Share tumblr" id="Share" href="<?php echo $share1; ?>" target="_blank" ></a>
		<a class="facebook" title="Share facebook" id="Share" href="http://www.facebook.com/sharer.php?u=<?php echo get_permalink( $post_id ) ?>" target="_blank" ></a>
		<a class="twitter" title="Share twitter" id="Share" href="<?php echo $share2; ?>" target="_blank" ></a>
		<a class="pin" title="Share Pin" id="Share" href="<?php echo $share3; ?>" target="_blank" ></a>
		<a class="reddit" title="Share Reddit" id="Share" href="<?php echo $share4; ?>" target="_blank" ></a>
		<a class="googleplus" title="Share Google+" id="Share" href="<?php echo $share5; ?>" target="_blank" ></a>
		<a class="stumbleupon" title="Share StumbleUpon" id="Share" href="<?php echo $share6; ?>" target="_blank" ></a>
		</div>
<!-- Related Posts -->
<?php $orig_post = $post;
global $id;
global $post; 
$tags = wp_get_post_tags($id);


if ($tags):
  $tag_ids = array(); 
  $names = array(); 
  foreach($tags as $individual_tag) 
  $tag_ids[] = $individual_tag->term_id;
  $names[] = $individual_tag->name;
  
  
  
  
  
    //echo implode(",",$tag_ids);
  
  
  
  $number_of_posts = 9; // number of posts to display
  $query = "
    SELECT ".$wpdb->posts.".*, COUNT(".$wpdb->posts.".ID) as q
    FROM ".$wpdb->posts." INNER JOIN ".$wpdb->term_relationships."
    ON (".$wpdb->posts.".ID = ".$wpdb->term_relationships.".object_id)
    WHERE ".$wpdb->posts.".ID NOT IN (".$id.")
    AND ".$wpdb->term_relationships.".term_taxonomy_id IN (".implode(",",$tag_ids).")
    AND ".$wpdb->posts.".post_type = 'post'
    AND ".$wpdb->posts.".post_status = 'publish'
    GROUP BY ".$wpdb->posts.".ID
    ORDER BY q
    DESC LIMIT ".$number_of_posts."";
	$related_posts = $wpdb->get_results($query, OBJECT);

	
  
  
  if($related_posts): ?>
  
  
<div style="margin-right: 10px; margin-top: 10px;">
		
		
		<div class="metainfo">
		<h3 class="dev-right-bar-title more-from-da-title">
                <b>More from Ceci Chaparro photagraphy</b>
		</h3>  
    
    
    <?php foreach($related_posts as $post): ?>
    <?php $post_featured_image = thb_get_post_thumbnail_src(get_the_ID(), 'thumbnail'); ?>
	
	<div class="tt-crop thumb" >
		
		<a href="<?php the_permalink()?>" title="<?php the_title(); ?>" class="Dajaxy" typelinck="<?php echo thb_get_post_format() ?>">
			<?php get_template_part( 'loop/formats-relate/stream-' . thb_get_post_format() ); ?>
		</a>

	</div>		

    <?php endforeach; ?>
		
	  
	  
	  <div class="box post-tags">
				<div class="title">
					<h2>Tags</h2>
				</div>
				<div class="tag">
				
				
				
				<?php  
				
				$tags2 = wp_get_post_tags($id);
					
				foreach ($tags2 as $tag) {
				
					
					echo '<a href="' . get_tag_link( $tag->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $tag->name ) . '" ' . '>' . $tag->name.'</a>';
	}

				
				
				
				
				?>
				

				
				
									</div>
			</div>
	  
  <?php endif;
endif;
$post = $orig_post; 
wp_reset_query(); ?>				
		
		
		</div>
		
		
		</div>		
		
		
		<?php 
		
		
		if($imgurl !==''){
			$titldata='Other Data';
			$datoscamara1='';
$TAG=$meta2[Make][0];
if($TAG !==null){
	$titldata='Camera Data';
	$datoscamara1 .= '<dt>Make</dt><dd>' . $TAG .'</dd>';
}
$TAG=$meta2[Model][0];
if($TAG !==null){
$titldata='Camera Data';
$datoscamara1 .= '<dt>Model</dt><dd>' . $TAG .'</dd>';
}
$TAG=$meta2[ShutterSpeedValue][0];
if($TAG !==null){
$titldata='Camera Data';
$datoscamara1 .= "<dt>Shutter Speed</dt><dd>" . $TAG . "</dd>";
}
$TAG=$meta2[ApertureValue][0];
if($TAG !==null){
$titldata='Camera Data';
$datoscamara1 .= "<dt>Aperture</dt><dd>" . $TAG . "</dd>";
}
$TAG=$meta2[FocalLength][0];
if($TAG !==null){
	$titldata='Camera Data';
	$datoscamara1 .= "<dt>Focal Length</dt><dd>" . $TAG . "</dd>";
}
$TAG=$meta2[ExposureTime][0];

if($TAG !==null){
	$titldata='Camera Data';
	$datoscamara1 .= "<dt>Exposure Time</dt><dd>" . $TAG . "</dd>";
}	
$TAG=$meta2[ISOSpeedRatings][0];
if($TAG !==null){
	$titldata='Camera Data';
	$datoscamara1 .= "<dt>ISO Speed</dt><dd>" . $TAG . "</dd>";
}
$TAG=$meta2[DateTimeOriginal][0];
if($TAG !==null){
	$datoscamara1 .= "<dt>Date Taken</dt><dd>" . $TAG . "</dd>";
}
$TAG=$meta2[Software][0];
if($TAG !==null){
	$datoscamara1 .= "<dt>Software</dt><dd>" . $TAG . "</dd>";
}

			
		}else{
			$datoscamara1='';
		}
		
		

		
		
		
		if( thb_get_post_format() == 'image' && $datoscamara1 !=='') 
		
		
		
		: ?>
		<div style="margin-right: 10px; margin-top: 10px;">
		
		
		<div class="metainfo">
		<h3 class="metainfo-title"><?php echo $titldata; ?></h3>
		
		



<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td><?php echo $datoscamara1;?></td>
		
	</tr>
</table>


		</div>
		
		
		</div>
		<?php endif; ?>
		
		
		</td>
	</tr>
	<tr class="coment">
		<td width="300" style="display: inline-block; width: 100%;">

		</td>
	</tr>
	<tr>
		<td colspan="2">
			<?php get_footer('single'); ?>		
		</td>
	</tr>
</table>


</div><!-- /.wrapper -->






	</body>
</html>


<?php endif; ?>
<?php else : ?>
<?php  //comentw ?>
				
				<?php if( thb_show_comments() ) : ?>
					<?php comments_template();?>	
				<?php endif; ?>
<?php endif; ?>
<?php else : ?>
<?php  //comentajax  ?>


<div id="content">
<table id="conte" border="0" width="100%" height="100%" cellpadding="0" style="table-layout: fixed;border-collapse: separate;border-spacing: 0px">

<colgroup>
	<col  style="width:100%;">
    <col style="width:330px;">
</colgroup>

	<tr class="print">
		<td colspan="2" width="100%">

<?php if( thb_get_post_format() == 'standard') : ?>

<div style="background-color: rgb(255, 255, 255); margin: 10px 10px -10px;" >

<?php endif; ?>
<span class="post-content" style="display:block;overflow:hidden;">


	<?php thb_post_before(); ?>
	<section>
	
	
	<?php if( thb_get_post_format() == 'image') : ?>
	
	<div id="wrapper_img" data-thumb="<?php echo $thumbnail; ?>" data-content="<?php echo $imgurl; ?>" style="box-shadow: -3px 3px 10px #000;position: relative;width:100%; height:550px;">

	</div>
	<?php endif; ?>
	
	
	
	
	
	<?php echo types_render_field("descripcion", array("output"=>"html"))?>

<div>
<h1 class="post-title"><?php the_title(); ?></h1>

<div class="post-info clearfix">
	<?php if( thb_get_post_format() == 'standard') : ?>
	<div class="details2">
	<?php else : ?>
	<div class="details3">
	<?php endif; ?>	
	<?php echo human_time_diff(get_the_time('U'), current_time('timestamp')); ?> ago in <?php the_category(' '); ?>
	
	</div>
		<div class="social-bar top">

			</div>
</div>
	
		<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
			<?php thb_post_start(); ?>

			<?php if( thb_get_post_format() == 'video') : {
					echo '<div class="thb-single-video-wrapper">';
						thb_post_format_video();
					echo '</div>';
				} endif; ?>

			<?php if( thb_get_post_format() == 'audio	') : {
					thb_post_format_audio();
				} endif; ?>

			<?php if( thb_get_post_format() == 'gallery') : {
					thb_post_format_gallery(array(
						'size' => 'large-cropped'
					));
				} endif; ?>

			<?php if( thb_get_post_format() == 'quote') : {
					$quote = thb_get_post_format_quote_text();
					$quote_url = thb_get_post_format_quote_url();
					$quote_author = thb_get_post_format_quote_author();
				?>
				<div class="single-post-quote">
				<?php if( !empty($quote) ) : ?>
					<blockquote>
						<p><?php echo $quote; ?></p>
					</blockquote>
				<?php endif; ?>
				<?php if( !empty($quote_author) || !empty($quote_url) ) : ?>
				<p>
					<cite>
						<?php if( !empty($quote_url) ) : ?>
							<a href="<?php echo $quote_url; ?>">&mdash; <?php echo $quote_author; ?></a>
						<?php else : ?>
							<?php echo '&mdash; ' . $quote_author; ?>
						<?php endif; ?>
					</cite>
				</p>
				<?php endif; ?>
				</div>
			<?php } endif; ?>
			
			<?php if( get_the_content() != '' ) : ?>
				<div class="thb-text2">
					<?php 
					
					$content = get_the_content();
					print $content;					
					
					?>
					<?php
						wp_link_pages(array(
							'pagelink' => '<span>%</span>',
							'before'   => '<div id="page-links"><p><span class="pages">'. __('Pages', 'thb_text_domain').'</span>',
							'after'    => '</p></div>'
						));
					?>
				</div>
			<?php endif; ?>
			

			<?php thb_post_end(); ?>
		<?php endwhile; endif; ?>
		</div>		
	</section>
	<?php thb_post_after(); ?>

	<?php thb_page_sidebar(); ?>
</span>
<?php if( thb_get_post_format() == 'text') : ?>
</div>
<?php endif; ?>


		
		
		</td>
	</tr>
	<tr class="coment">
		<td width="100%" rowspan="2">
		
			<?php if( thb_show_comments() ) : ?>
				<section id="Dcoment">
				<?php if( thb_show_comments() ) : ?>
					<?php if(function_exists("display_saic")) { echo display_saic();} ?>
				<?php endif; ?>
				</section>
			<?php endif; ?>		
		
		</td>
		<td height="40">
		<div style="height:40px; border-bottom: 2px solid rgba(0, 39, 59, 0.08);background: none repeat scroll 0% 0% #FFF;">
		<span class="Share" >Share:</span>
		
		<?php 
		
		$imgurl=types_render_field("image", array("url" => "true"));
		$caption1='<a href="'.get_permalink( $post_id ).'">'.get_the_title($post_id).'</a>';
		$urlb='<a href="'.get_bloginfo('url').'">By Ceci Chaparro Photography</a>';
		$share1='http://www.tumblr.com/share/photo?source='. encodeURIComponent($imgurl).'&caption='.encodeURIComponent($caption1.$urlb).'&clickthru='.encodeURIComponent(get_permalink( $post_id ));
		$caption1=get_the_title($post_id).' By Ceci Chaparro Photography';
		$share2='http://twitter.com/share?text=Check+out+'.encodeURIComponent($caption1).'&url='.encodeURIComponent($imgurl).'&related='.get_bloginfo('url');
		$caption1='The '.get_the_title($post_id).' By Ceci Chaparro Photography on '.get_bloginfo('url');
		$share3='http://pinterest.com/pin/create/button/?url='.get_permalink( $post_id ).'&media='.encodeURIComponent($imgurl).'&description='.encodeURIComponent($caption1);
		$share4='http://reddit.com/submit?url='.encodeURIComponent(get_permalink( $post_id ));
		$share5='https://plus.google.com/share?url='.encodeURIComponent(get_permalink( $post_id ));
		$share6='http://www.stumbleupon.com/submit?url='.encodeURIComponent(get_permalink( $post_id ));
		
		?>		
		
		<a class="tumblr" title="Share tumblr" id="Share" href="<?php echo $share1; ?>" target="_blank" ></a>
		<a class="facebook" title="Share facebook" id="Share" href="http://www.facebook.com/sharer.php?u=<?php echo get_permalink( $post_id ) ?>" target="_blank" ></a>
		<a class="twitter" title="Share twitter" id="Share" href="<?php echo $share2; ?>" target="_blank" ></a>
		<a class="pin" title="Share Pin" id="Share" href="<?php echo $share3; ?>" target="_blank" ></a>
		<a class="reddit" title="Share Reddit" id="Share" href="<?php echo $share4; ?>" target="_blank" ></a>
		<a class="googleplus" title="Share Google+" id="Share" href="<?php echo $share5; ?>" target="_blank" ></a>
		<a class="stumbleupon" title="Share StumbleUpon" id="Share" href="<?php echo $share6; ?>" target="_blank" ></a>
		</div>
		
		
		
<!-- Related Posts -->
<?php $orig_post = $post;
global $id;
global $post; 
$tags = wp_get_post_tags($id);


if ($tags):
  $tag_ids = array(); 
  $names = array(); 
  foreach($tags as $individual_tag) 
  $tag_ids[] = $individual_tag->term_id;
  $names[] = $individual_tag->name;
  
  
  
  
  
    //echo implode(",",$tag_ids);
  
  
  
  $number_of_posts = 9; // number of posts to display
  $query = "
    SELECT ".$wpdb->posts.".*, COUNT(".$wpdb->posts.".ID) as q
    FROM ".$wpdb->posts." INNER JOIN ".$wpdb->term_relationships."
    ON (".$wpdb->posts.".ID = ".$wpdb->term_relationships.".object_id)
    WHERE ".$wpdb->posts.".ID NOT IN (".$id.")
    AND ".$wpdb->term_relationships.".term_taxonomy_id IN (".implode(",",$tag_ids).")
    AND ".$wpdb->posts.".post_type = 'post'
    AND ".$wpdb->posts.".post_status = 'publish'
    GROUP BY ".$wpdb->posts.".ID
    ORDER BY q
    DESC LIMIT ".$number_of_posts."";
	$related_posts = $wpdb->get_results($query, OBJECT);

	
  
  
  if($related_posts): ?>
  
  
<div style="margin-right: 10px; margin-top: 10px;">
		
		
		<div class="metainfo">
		<h3 class="dev-right-bar-title more-from-da-title">
                <b>More from Ceci Chaparro photagraphy</b>
		</h3>  
    
    
    <?php foreach($related_posts as $post): ?>
    <?php $post_featured_image = thb_get_post_thumbnail_src(get_the_ID(), 'thumbnail'); ?>
	
	<div class="tt-crop thumb" >
		
		<a href="<?php the_permalink()?>" title="<?php the_title(); ?>" class="Dajaxy" typelinck="<?php echo thb_get_post_format() ?>">
			<?php get_template_part( 'loop/formats-relate/stream-' . thb_get_post_format() ); ?>
		</a>

	</div>		

    <?php endforeach; ?>
		
	  
	  
	  <div class="box post-tags">
				<div class="title">
					<h2>Tags</h2>
				</div>
				<div class="tag">
				
				
				
				<?php  
				
				$tags2 = wp_get_post_tags($id);
					
				foreach ($tags2 as $tag) {
				
					
					echo '<a href="' . get_tag_link( $tag->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $tag->name ) . '" ' . '>' . $tag->name.'</a>';
	}

				
				
				
				
				?>
				

				
				
									</div>
			</div>
	  
  <?php endif;
endif;
$post = $orig_post; 
wp_reset_query(); ?>				
		
		
		</div>
		
		
		</div>		
		
		
		<?php 
		
		
		if($imgurl !==''){
			$titldata='Other Data';
			$datoscamara1='';
$TAG=$meta2[Make][0];
if($TAG !==null){
	$titldata='Camera Data';
	$datoscamara1 .= '<dt>Make</dt><dd>' . $TAG .'</dd>';
}
$TAG=$meta2[Model][0];
if($TAG !==null){
$titldata='Camera Data';
$datoscamara1 .= '<dt>Model</dt><dd>' . $TAG .'</dd>';
}
$TAG=$meta2[ShutterSpeedValue][0];
if($TAG !==null){
$titldata='Camera Data';
$datoscamara1 .= "<dt>Shutter Speed</dt><dd>" . $TAG . "</dd>";
}
$TAG=$meta2[ApertureValue][0];
if($TAG !==null){
$titldata='Camera Data';
$datoscamara1 .= "<dt>Aperture</dt><dd>" . $TAG . "</dd>";
}
$TAG=$meta2[FocalLength][0];
if($TAG !==null){
$titldata='Camera Data';
	$datoscamara1 .= "<dt>Focal Length</dt><dd>" . $TAG . "</dd>";
}
$TAG=$meta2[ExposureTime][0];
if($TAG !==null){
$titldata='Camera Data';
	$datoscamara1 .= "<dt>Exposure Time</dt><dd>" . $TAG . "</dd>";
}	
$TAG=$meta2[ISOSpeedRatings][0];
if($TAG !==null){
$titldata='Camera Data';
	$datoscamara1 .= "<dt>ISO Speed</dt><dd>" . $TAG . "</dd>";
}
$TAG=$meta2[DateTimeOriginal][0];
if($TAG !==null){

	$datoscamara1 .= "<dt>Date Taken</dt><dd>" . $TAG . "</dd>";
}
$TAG=$meta2[Software][0];
if($TAG !==null){
	$datoscamara1 .= "<dt>Software</dt><dd>" . $TAG . "</dd>";
}
			
		}else{
			
			$datoscamara1='';
		
		}
				
		
		if( thb_get_post_format() == 'image' && $datoscamara1 !=='') 
		
		: ?>
		<div style="margin-right: 10px; margin-top: 10px;">
		
		
		<div class="metainfo">
		<h3 class="metainfo-title"><?php echo $titldata; ?></h3>


<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td><?php echo $datoscamara1;?></td>
		
	</tr>
</table>


		</div>
		
		
		</div>
		<?php endif; ?>
		
		
		
		</td>
	</tr>
	<tr class="coment">
		<td width="300" style="display: inline-block; width: 100%;">

		</td>
	</tr>
</table>

<?php endif; ?>
