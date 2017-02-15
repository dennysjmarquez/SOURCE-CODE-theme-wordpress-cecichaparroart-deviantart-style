<?php
$pagetitle = single_cat_title( '', false );
$pagesubtitle = __("Tag", 'thb_text_domain');
if ( $scroll == '' ) get_header(); 
?>

	
	<?php if ( $scroll == '' ): ?>
	<?php thb_page_before(); ?>
		<section id="content">
		<?php endif; ?>
		<?php thb_page_start(); ?>
			<?php get_template_part("loop/archive"); ?>
		<?php thb_page_end(); ?>
		<?php if ( $scroll == '' ): ?>
		</section>
	<?php thb_page_after(); ?>
	<?php endif; ?>



<?php if ( $scroll == '' ) get_footer(); ?>