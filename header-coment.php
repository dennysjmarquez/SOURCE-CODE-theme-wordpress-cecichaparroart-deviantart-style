<?php
/**
 * @package WordPress
 * @subpackage BigFoot
 * @since BigFoot 1.0
 */
 $pageid = get_the_ID();

$category = get_the_category(); 


if($category){

	$cate=$category[0]->cat_ID;
	$published_posts =  wt_get_category_count($cate);
	
}else{
	$count_posts = wp_count_posts();
	$published_posts =  $count_posts->publish;
}

?>
<!doctype html>
<html <?php language_attributes(); ?> <?php thb_html_class(); ?>> 
<head>

	
	
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/jquery-1.7.min.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/jquery.history.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/jquery.scrollTo-1.4.3.1-min.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.3.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/zoom.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/click.js'></script>

<script type='text/javascript'>

$.loadScript = function (url, arg1, arg2) {
var cache = false, callback = null;
if ($.isFunction(arg1)){callback = arg1;cache = arg2 || cache;} else {cache = arg1 || cache;callback = arg2 || callback;}var load = true;jQuery('script[type="text/javascript"]').each(function () { return load = (url != $(this).attr('src')); });if (load){jQuery.ajax({type: 'GET',url: url,success: callback,dataType: 'script',cache: cache});} else {if (jQuery.isFunction(callback)) {callback.call(this);};};};


</script>
	
<script type='text/javascript'>


$.wait = function( callback, seconds){return window.setTimeout( callback, seconds * 1000 );}
var espera=0;


</script>


	
	
		<?php thb_head_meta(); ?>

		<title><?php thb_title(); ?></title>

		<?php wp_head(); ?>



	</head>
	<body class="ui-page ui-body-c home page page-id-<?php echo $pageid ?> page-template page-template-template-blog-stream-php logo-left logo-left pageheader-layout-left pageheader-big thb-desktop">
	
	
<div id="loading">
	  <!--
	  <div>
		<img src="" alt="" class="logo" />
		<span></span>
		<img src="/assets/images/loading.gif" alt="" />
	  </div>
   -->
	</div>

<div class="nav">

	<div class="navOut">
	
		<nav role="navigation">
		
		<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>

		</nav>
	</div>
</div>
	

	<?php thb_body_start(); ?>
	

	
			<?php thb_header_before(); ?>

