<?php
/**
 * @package WordPress
 * @subpackage CeciChaparroART
 * @since CeciChaparroART 1.0
 * Template name: Blog Grid
 */
 $contact=false;
if (!empty($_COOKIE['page_mode'])){$page_mode=$_COOKIE['page_mode'];}else{$page_mode=0;}

if(!empty($_GET['contactajax'])){
	
	
	if($_GET['contactajax'] == 'true'){
	
		$contact=true;
		contact();
	}

}


?>
<?php if($contact == false): ?>
<?php if (empty($_SESSION['pantallaw'])) : ?>
<!doctype html>
<html>
<head>
<meta name="robots" content="noindex">
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/jquery-1.7.min.js'></script>
<script type="text/javascript">

window.onload = function() {

        layoutWidth = $(document).width();
        layoutHeight = $(document).height();
		
		


var xmlhttp;
if (window.XMLHttpRequest) {

xmlhttp=new XMLHttpRequest();
} else {

xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200) {

	window.location.replace('<?php echo get_bloginfo('url') ?>');
}
}
xmlhttp.open("POST","<?php echo get_bloginfo('url') ?>/set_session_pantalla.php?pantallaw=" + layoutWidth + "&pantallah=" + layoutHeight  ,true);
xmlhttp.send();

}
</script>
</head>
<body>
Loading, please wait ...
</body>
</html>



<?php endif; ?>
<?php if (!empty($_SESSION['pantallaw'])) : ?>
<?php
global $scroll;
$thb_page_id = get_the_ID();
$subtitle = thb_get_post_meta( $thb_page_id, 'subtitle' );
if ($scroll == '' ){
	if ($page_mode == 0){
		get_header(); 
	}else{
		get_header('page_mode1');
		
	}
	
}
?>
<?php if ( $scroll == '' ) : ?>
	<?php thb_page_before(); ?>
		<section id="content">
			<?php thb_page_start(); ?>
			<?php get_template_part('loop/blog', 'stream'); ?>
			<?php thb_page_end(); ?>
		</section>
	<?php thb_page_after(); ?>
		<?php thb_page_sidebar(); ?>
<?php get_footer(); ?>
<?php else : ?>
			<?php thb_page_start(); ?>
			<?php get_template_part('loop/blog', 'stream'); ?>						
			<?php thb_page_end(); ?>
<?php endif; ?>
<?php endif; ?>

<?php endif; ?>